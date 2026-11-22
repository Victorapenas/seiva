<?php

namespace App\Dominio;

use App\Models\Usuario;
use App\Models\Conta;
use App\Models\Meta;
use App\Models\Transacao;
use App\Models\Cobranca;
use App\Models\DespesaLar;
use App\Models\ParticipacaoDespesa;
use App\Models\ProdutoWatchlist;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Classe: CaixaPretaIndividual
 * Responsabilidade: Encapsular a lógica de negócios da área privada individual (Caixa Preta).
 * Calcula o patrimônio individual consolidado, distribuições entre saldo livre, comprometido e guardado,
 * faturas de cartões de crédito com monitoramento de limites e despesas estritamente pessoais.
 * 
 * Responsável Acadêmico: Victor Hugo (RF002, RF003)
 */
class CaixaPretaIndividual
{
    private Usuario $usuario;

    public function __construct(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Valida o PIN de segurança de 4 dígitos da Caixa Preta.
     */
    public function validarPin(string $pin): bool
    {
        $savedPin = $this->usuario->pin_caixa_preta ?: '1234';
        if (str_starts_with($savedPin, '$2y$')) {
            return \Illuminate\Support\Facades\Hash::check($pin, $savedPin);
        }
        return $pin === $savedPin;
    }

    /**
     * Consolida o patrimônio individual: somando todas as contas do usuário.
     * Retorna saldo total, livre para usar, comprometido e guardado.
     */
    public function calcularPatrimonio(): array
    {
        $contas = Conta::where('usuario_id', $this->usuario->id_usuario)->get();
        $saldoTotal = (float)$contas->sum('saldo');

        // Contas com função reserva ou do tipo poupança contam como guardado
        $guardado = (float)$contas->filter(function ($c) {
            return $c->funcao === 'reserva' || $c->tipo === 'poupanca';
        })->sum('saldo');

        // Valores comprometidos nas contas (ex: faturas e provisões)
        $comprometido = (float)$contas->sum('comprometido');

        // Saldo livre pra usar (apenas de contas do dia a dia desimpedidas)
        $livre = max(0, $saldoTotal - $guardado - $comprometido);

        return [
            'total_individual' => $saldoTotal,
            'livre_pra_usar' => $livre,
            'comprometido' => $comprometido,
            'guardado' => $guardado,
        ];
    }

    /**
     * Retorna contas bancárias e cartões de crédito detalhados para a Caixa Preta.
     */
    public function obterContasECartoes(): array
    {
        $contas = Conta::where('usuario_id', $this->usuario->id_usuario)->get();

        $contasBancarias = [];
        $cartoes = [];

        foreach ($contas as $c) {
            $saldo = (float)$c->saldo;
            $comp = (float)$c->comprometido;
            $livre = max(0, $saldo - $comp);

            if ($c->tipo === 'cartao') {
                $limite = (float)($c->limite ?: 3500.00);
                $faturaAtual = (float)($c->comprometido > 0 ? $c->comprometido : ($c->usado ?: 890.00));
                $limiteDisponivel = max(0, $limite - $faturaAtual);
                $pctUsado = $limite > 0 ? min(100, round(($faturaAtual / $limite) * 100)) : 0;
                $diaVenc = $c->vencimento_fatura ?: 12;

                $cartoes[] = [
                    'id_conta' => $c->id_conta,
                    'nome' => $c->nome,
                    'tipo' => 'Cartão de crédito · vence ' . str_pad($diaVenc, 2, '0', STR_PAD_LEFT) . '/' . now()->format('m'),
                    'vence_hoje' => now()->day === $diaVenc || $diaVenc === 12,
                    'fatura_atual' => $faturaAtual,
                    'limite_disponivel' => $limiteDisponivel,
                    'limite_total' => $limite,
                    'percentual_usado' => $pctUsado,
                    'cor' => $c->cor ?: '#8b5cf6',
                ];
            } else {
                $tipoLabel = match($c->funcao) {
                    'reserva' => 'Reserva + metas',
                    'carteira' => 'Espécie',
                    default => ($c->tipo === 'corrente' ? 'Conta corrente' : ($c->tipo === 'poupanca' ? 'Poupança' : 'Conta salário')),
                };

                $contasBancarias[] = [
                    'id_conta' => $c->id_conta,
                    'nome' => $c->nome,
                    'tipo' => $tipoLabel,
                    'saldo' => $saldo,
                    'livre' => $c->funcao === 'reserva' ? 0.00 : $livre,
                    'comprometido' => $comp,
                    'badge' => $c->funcao === 'reserva' ? 'Guardando' : null,
                    'atualizado' => $c->updated_at ? 'Atualizado ' . $c->updated_at->diffForHumans() : 'Atualizado hoje',
                    'cor' => $c->cor ?: '#10b981',
                    'icone' => $c->tipo === 'poupanca' ? 'piggy-bank' : ($c->tipo === 'carteira' ? 'banknote' : 'wallet'),
                ];
            }
        }

        return [
            'contas' => $contasBancarias,
            'cartoes' => $cartoes,
            'total_contas' => count($contasBancarias),
            'total_cartoes' => count($cartoes),
        ];
    }

    /**
     * Retorna a lista "O que você deve" (compromissos fixos, faturas e acordos).
     */
    public function obterOQueVoceDeve(): array
    {
        $userId = $this->usuario->id_usuario;
        $lar = $this->usuario->lares()->first();
        $itens = [];

        // 1. Fatura de cartão
        $cartao = Conta::where('usuario_id', $userId)->where('tipo', 'cartao')->first();
        $valorFatura = $cartao ? (float)($cartao->comprometido ?: 890.00) : 890.00;
        $itens[] = [
            'id' => $cartao ? 'conta_' . $cartao->id_conta : 'cartao_default',
            'titulo' => 'Fatura ' . ($cartao ? $cartao->nome : 'Nubank'),
            'subtitulo' => 'Cartão roxo · limite R$ ' . number_format($cartao->limite ?? 3500, 2, ',', '.'),
            'valor' => $valorFatura,
            'vence_hoje' => true,
            'tipo' => 'fatura',
            'icone' => 'credit-card',
            'progresso_pct' => 0,
            'status_label' => 'Vence HOJE',
        ];

        // 2. Acordo do casal (se houver)
        if ($lar) {
            $itens[] = [
                'id' => 'acordo_geladeira',
                'titulo' => 'Geladeira Samsung',
                'subtitulo' => 'Acordo com parceiro · ' . $lar->nome,
                'valor' => 500.00,
                'vence_hoje' => false,
                'tipo' => 'acordo',
                'icone' => 'shopping-bag',
                'progresso_pct' => 31,
                'status_label' => 'Pendente este mês',
            ];

            $itens[] = [
                'id' => 'despesa_aluguel',
                'titulo' => 'Aluguel — minha parte',
                'subtitulo' => '40% do aluguel · ' . $lar->nome,
                'valor' => 360.00,
                'vence_hoje' => false,
                'tipo' => 'lar',
                'icone' => 'home',
                'progresso_pct' => 100,
                'status_label' => 'Pago este mês',
            ];
        }

        $totalComprometido = array_sum(array_column($itens, 'valor'));
        $renda = (float)($this->usuario->renda_mensal ?: 1700.00);
        $pctRenda = $renda > 0 ? min(100, round(($totalComprometido / $renda) * 100)) : 81;

        return [
            'itens' => $itens,
            'total_comprometido_mes' => $totalComprometido,
            'percentual_renda' => $pctRenda,
        ];
    }

    /**
     * Retorna as despesas estritamente pessoais (que podem ser divididas ou pagas).
     */
    public function obterDespesasSoSuas(): array
    {
        return [
            [
                'id' => 'desp_psi',
                'titulo' => 'Consulta psicóloga',
                'detalhe' => 'Sessão quinzenal · Dra. Helena · Vence dia 20',
                'valor' => 180.00,
                'privada' => true,
                'icone' => 'brain',
            ],
            [
                'id' => 'desp_dental',
                'titulo' => 'Clareamento dental',
                'detalhe' => 'Parcela 2 de 3 · Odonto Vida · Vence dia 15',
                'valor' => 240.00,
                'privada' => true,
                'icone' => 'stethoscope',
            ],
            [
                'id' => 'desp_alura',
                'titulo' => 'Curso UX Alura',
                'detalhe' => 'Assinatura mensal · Vence dia 28',
                'valor' => 89.00,
                'privada' => true,
                'icone' => 'graduation-cap',
            ],
        ];
    }

    /**
     * Retorna as metas individuais e os produtos monitorados (wishlist).
     */
    public function obterMetasEWishlist(): array
    {
        $userId = $this->usuario->id_usuario;
        $metasDb = Meta::where('usuario_id', $userId)->where('status', 'ativa')->get();

        $metasFormatadas = [];
        if ($metasDb->count() > 0) {
            foreach ($metasDb as $m) {
                $metasFormatadas[] = [
                    'id_meta' => $m->id_meta,
                    'titulo' => $m->titulo,
                    'atual' => (float)$m->valor_atual,
                    'alvo' => (float)$m->valor_alvo,
                    'percentual' => $m->progresso,
                    'icone' => $m->categoria === 'reserva' ? 'shield' : ($m->categoria === 'viagem' ? 'plane' : 'laptop'),
                    'tipo' => $m->lar_id ? 'Do Lar' : 'Só minha',
                ];
            }
        } else {
            $metasFormatadas = [
                ['id_meta' => 1, 'titulo' => 'Notebook Dell', 'atual' => 4050.00, 'alvo' => 4500.00, 'percentual' => 90, 'icone' => 'laptop', 'tipo' => 'Só minha'],
                ['id_meta' => 2, 'titulo' => 'Viagem Portugal', 'atual' => 2100.00, 'alvo' => 9000.00, 'percentual' => 23, 'icone' => 'plane', 'tipo' => 'Só minha'],
                ['id_meta' => 3, 'titulo' => 'Curso UX Alura', 'atual' => 720.00, 'alvo' => 1800.00, 'percentual' => 40, 'icone' => 'graduation-cap', 'tipo' => 'Só minha'],
                ['id_meta' => 4, 'titulo' => 'Fundo de emergência', 'atual' => 2100.00, 'alvo' => 8400.00, 'percentual' => 25, 'icone' => 'shield', 'tipo' => 'Só minha'],
            ];
        }

        $produtosDb = ProdutoWatchlist::where('usuario_id', $userId)->orderByDesc('created_at')->get();
        if ($produtosDb->count() > 0) {
            $produtosWatchlist = $produtosDb->map(function ($p) {
                return [
                    'id_produto' => $p->id_produto,
                    'nome' => $p->nome,
                    'loja' => $p->loja ?: 'Loja online',
                    'preco' => (float)$p->preco_alvo,
                    'link' => $p->link_referencia,
                    'imagem' => $p->imagem ?: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=120&auto=format&fit=crop&q=60',
                ];
            })->toArray();
        } else {
            $produtosWatchlist = [
                [
                    'id_produto' => 1,
                    'nome' => 'Câmera Sony ZV-E10',
                    'loja' => 'MercadoLivre',
                    'preco' => 2890.00,
                    'link' => 'https://mercadolivre.com.br',
                    'imagem' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=120&auto=format&fit=crop&q=60',
                ],
                [
                    'id_produto' => 2,
                    'nome' => 'Nike Air Force 1',
                    'loja' => 'Nike.com',
                    'preco' => 489.90,
                    'link' => 'https://nike.com.br',
                    'imagem' => 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?w=120&auto=format&fit=crop&q=60',
                ],
            ];
        }

        return [
            'metas' => $metasFormatadas,
            'produtos_de_olho' => $produtosWatchlist,
        ];
    }

    /**
     * Retorna a lista de valores "A receber" e histórico de ajudas do parceiro.
     */
    public function obterAReceber(): array
    {
        $lar = $this->usuario->lares()->first();
        if (!$lar) {
            return ['tem_a_receber' => false, 'itens' => [], 'ajudas_recebidas_count' => 0];
        }

        $membroParceiro = $lar->membros()->where('usuarios.id_usuario', '!=', $this->usuario->id_usuario)->first();
        $nomeParceiro = $membroParceiro ? explode(' ', $membroParceiro->nome)[0] : 'Parceiro';

        return [
            'tem_a_receber' => true,
            'parceiro_nome' => $nomeParceiro,
            'itens' => [
                [
                    'id' => 'receber_mercado',
                    'titulo' => "{$nomeParceiro} aceitou te pagar",
                    'descricao' => 'Mercado Dia a Dia · pendente',
                    'valor' => 156.40,
                    'icone' => 'shopping-cart',
                ]
            ],
            'ajudas_recebidas_count' => 3,
        ];
    }

    /**
     * Retorna gastos privados recentes e entradas do mês.
     */
    public function obterGastosERecebimentosRecentes(): array
    {
        $userId = $this->usuario->id_usuario;

        $gastosRecentes = Transacao::where('usuario_id', $userId)
            ->where('tipo', 'saida')
            ->orderByDesc('data')
            ->orderByDesc('id_transacao')
            ->limit(4)
            ->get();

        $gastosFormatados = [];
        if ($gastosRecentes->count() > 0) {
            foreach ($gastosRecentes as $g) {
                $gastosFormatados[] = [
                    'id' => $g->id_transacao,
                    'titulo' => $g->titulo,
                    'subtitulo' => ($g->conta ? $g->conta->nome : 'Nubank') . ' · ' . Carbon::parse($g->data)->format('d/m'),
                    'valor' => (float)$g->valor,
                    'privado' => true,
                    'icone' => 'sparkles',
                    'pode_compartilhar' => true,
                ];
            }
        } else {
            $gastosFormatados = [
                ['id' => 1, 'titulo' => 'Sephora — Hidratante + Sérum', 'subtitulo' => 'Nubank · Hoje', 'valor' => 187.00, 'privado' => true, 'icone' => 'sparkles', 'pode_compartilhar' => true],
                ['id' => 2, 'titulo' => 'Presente surpresa parceiro', 'subtitulo' => 'Nubank · 08/06', 'valor' => 320.00, 'privado' => true, 'icone' => 'gift', 'pode_compartilhar' => false],
                ['id' => 3, 'titulo' => 'Consulta psicóloga', 'subtitulo' => 'Nubank · 05/06', 'valor' => 180.00, 'privado' => true, 'icone' => 'heart', 'pode_compartilhar' => true],
            ];
        }

        $entradasRecentes = [
            ['id' => 1, 'titulo' => 'Salário Florais Design', 'data' => 'dia 05/06', 'valor' => 1500.00, 'status' => 'em dia'],
            ['id' => 2, 'titulo' => 'Freela cliente Bruna', 'data' => 'dia 09/06', 'valor' => 200.00, 'status' => 'em dia'],
        ];

        return [
            'gastos_recentes' => $gastosFormatados,
            'entradas' => $entradasRecentes,
            'total_recebido' => 1700.00,
        ];
    }
}
