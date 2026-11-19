<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\Transacao;
use App\Models\Categoria;
use App\Models\Lar;
use App\Models\Meta;
use App\Models\DespesaLar;
use App\Models\LarMembro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Não autenticado'], 401);
        }

        $userId = $user->id_usuario;
        $mesAtual = $request->get('mes', now()->format('Y-m'));

        // Contas do usuário
        $contas = Conta::where('usuario_id', $userId)->get();
        $saldoTotal = $contas->where('tipo', '!=', 'cartao')->sum('saldo');
        $saldoComprometido = $contas->where('tipo', '!=', 'cartao')->sum('comprometido');
        $saldoLivre = max(0, $saldoTotal - $saldoComprometido);

        // Faturas de cartões
        $faturasCartao = $contas->where('tipo', 'cartao')->sum('usado');

        // Entradas e Saídas do mês
        $transacoesMes = Transacao::where('usuario_id', $userId)
            ->where('visibilidade', '!=', 'privado')
            ->whereRaw("strftime('%Y-%m', data) = ?", [$mesAtual])
            ->get();

        $totalEntradas = $transacoesMes->where('tipo', 'entrada')->sum('valor');
        $totalSaidas = $transacoesMes->where('tipo', 'saida')->sum('valor');
        $balancoMes = $totalEntradas - $totalSaidas;

        // Gastos por categoria
        $gastosPorCategoria = Transacao::join('categorias', 'transacoes.categoria_id', '=', 'categorias.id_categoria')
            ->where('transacoes.usuario_id', $userId)
            ->where('transacoes.visibilidade', '!=', 'privado')
            ->where('transacoes.tipo', 'saida')
            ->whereRaw("strftime('%Y-%m', transacoes.data) = ?", [$mesAtual])
            ->select('categorias.nome', 'categorias.cor', 'categorias.emoji', DB::raw('SUM(transacoes.valor) as total'))
            ->groupBy('categorias.id_categoria', 'categorias.nome', 'categorias.cor', 'categorias.emoji')
            ->orderByDesc('total')
            ->get();

        // Transações recentes
        $recentes = Transacao::with(['conta', 'categoria'])
            ->where('usuario_id', $userId)
            ->where('visibilidade', '!=', 'privado')
            ->orderBy('data', 'desc')
            ->orderBy('id_transacao', 'desc')
            ->limit(8)
            ->get();

        // Lar ativo do usuário
        $lar = $user->lares()->first();
        $dadosLar = null;

        if ($lar) {
            $membros = LarMembro::with('usuario')->where('lar_id', $lar->id_lar)->get();
            $rendaTotalLar = $membros->sum('renda_declarada');
            $membrosIds = $membros->pluck('usuario_id')->toArray();

            $saldoConsolidadoLar = Conta::whereIn('usuario_id', $membrosIds)
                ->where('tipo', '!=', 'cartao')
                ->sum('saldo');

            $despesasLarMes = DespesaLar::where('lar_id', $lar->id_lar)
                ->whereRaw("strftime('%Y-%m', data_vencimento) = ?", [$mesAtual])
                ->sum('valor_total');

            $receitasLarMes = Transacao::whereIn('usuario_id', $membrosIds)
                ->where('tipo', 'entrada')
                ->whereRaw("strftime('%Y-%m', data) = ?", [$mesAtual])
                ->sum('valor');

            $membrosFormatados = $membros->map(function ($m) use ($rendaTotalLar) {
                $renda = (float)$m->renda_declarada;
                $pct = $rendaTotalLar > 0 ? round(($renda / $rendaTotalLar) * 100) : 50;
                $primeiroNome = explode(' ', trim($m->usuario->nome))[0];
                $rendaK = $renda >= 1000 ? 'R$ ' . round($renda / 1000, 1) . 'k' : 'R$ ' . number_format($renda, 0, ',', '.');

                return [
                    'id_usuario' => $m->usuario_id,
                    'nome' => $m->usuario->nome,
                    'primeiro_nome' => $primeiroNome,
                    'renda_declarada' => $renda,
                    'renda_formatada' => $rendaK,
                    'percentual' => $pct,
                ];
            });

            $nomesCasal = $membrosFormatados->pluck('primeiro_nome')->join(' & ');
            $iniciaisCasal = $membrosFormatados->map(fn($m) => substr($m['primeiro_nome'], 0, 1))->join('');

            $dadosLar = [
                'id_lar' => $lar->id_lar,
                'nome' => $lar->nome,
                'emoji' => $lar->emoji ?? '🌿',
                'nomes_casal' => $nomesCasal ?: $lar->nome,
                'iniciais_casal' => $iniciaisCasal ?: 'CL',
                'saldo_lar' => (float)($saldoConsolidadoLar ?: $saldoTotal),
                'total_despesas_mes' => (float)$despesasLarMes,
                'total_receitas_mes' => (float)$receitasLarMes,
                'renda_total_lar' => (float)$rendaTotalLar,
                'membros_rateio' => $membrosFormatados,
                'tendencia_mes' => '+R$ 2.450 este mês',
            ];
        }

        // Dados personalizados para o Protótipo Oficial (Duda / Ian / Victor)
        $isDuda = str_contains(strtolower($user->email), 'duda');
        $isIan = str_contains(strtolower($user->email), 'ian');

        // Banner de Pedido de Ajuda (apenas quando aplicável)
        $pedidoAjuda = null;
        if ($isDuda) {
            $pedidoAjuda = [
                'tem_pedido' => true,
                'solicitante' => 'Ian',
                'solicitante_iniciais' => 'IM',
                'valor' => 50.00,
                'motivo' => 'Comprar filamento pra fechar o freela da impressora 3D',
                'tag' => 'IM Filamento da Impressora 3D · há 20 min',
            ];
        }

        // Card Hero "Seu mês" (Minha renda vs Custo do Lar)
        $heroMes = [
            'mes_nome' => 'junho',
            'ano' => '2026',
            'data_extenso' => 'Quinta, 12 de junho de 2026',
            'minha_renda' => [
                'recebido_mes' => $isDuda ? 1700.00 : ($isIan ? 6000.00 : 5500.00),
                'fontes' => $isDuda ? [
                    ['nome' => 'Salário', 'valor' => 1500.00],
                    ['nome' => 'Freela', 'valor' => 200.00]
                ] : [
                    ['nome' => 'Salário', 'valor' => $isIan ? 6000.00 : 5500.00]
                ],
                'comprometido' => $isDuda ? 1550.00 : 1800.00,
                'ainda_devendo' => $isDuda ? 1115.00 : 850.00,
                'sobra_mes' => $isDuda ? 150.00 : 3350.00,
            ],
            'custo_lar' => [
                'parte_no_lar' => $isDuda ? 480.00 : 1187.90,
                'percentual_lar' => $isDuda ? 28 : 60,
                'ja_paguei' => $isDuda ? 255.00 : 930.00,
                'ainda_falta' => $isDuda ? 225.00 : 257.90,
                'custo_total_lar' => 1667.90,
            ]
        ];

        // Onde está meu dinheiro (Cards de contas com subdivisão)
        $ondeEstaMeuDinheiro = [
            'somando_todas' => $isDuda ? 3745.00 : ($isIan ? 9900.00 : 10700.00),
            'ja_tem_dono' => $isDuda ? 2990.00 : 3200.00,
            'livre_pra_gastar' => $isDuda ? 755.00 : 6700.00,
            'dica' => 'Ter saldo não é ter dinheiro livre. As metas ficam guardadas na Poupança Caixa — não no Nubank. Então os R$ 290,00 livres do Nubank são mesmo só pra gastar.',
            'contas_detalhadas' => $isDuda ? [
                [
                    'nome' => 'Nubank',
                    'tipo' => 'Dia a dia',
                    'saldo' => 1180.00,
                    'livre' => 290.00,
                    'fatura' => 890.00,
                    'atualizado' => 'Atualizado hoje às 14h',
                    'cor' => '#820ad1',
                    'icone' => 'credit-card',
                ],
                [
                    'nome' => 'PicPay',
                    'tipo' => 'Dia a dia',
                    'saldo' => 240.00,
                    'livre' => 240.00,
                    'fatura' => null,
                    'atualizado' => 'Atualizado ontem',
                    'cor' => '#11c76f',
                    'icone' => 'smartphone',
                ],
                [
                    'nome' => 'Mercado Pago',
                    'tipo' => 'Dia a dia',
                    'saldo' => 95.00,
                    'livre' => 95.00,
                    'fatura' => null,
                    'atualizado' => 'Atualizado há 3 dias',
                    'cor' => '#009ee3',
                    'icone' => 'smartphone',
                ],
                [
                    'nome' => 'Poupança Caixa',
                    'tipo' => 'Guardando',
                    'saldo' => 2100.00,
                    'livre' => null,
                    'fatura' => null,
                    'atualizado' => 'Guardado pra metas + emergência',
                    'cor' => '#005ca9',
                    'icone' => 'piggy-bank',
                ],
                [
                    'nome' => 'Dinheiro em espécie',
                    'tipo' => 'Espécie',
                    'saldo' => 130.00,
                    'livre' => 130.00,
                    'fatura' => null,
                    'atualizado' => 'Tudo livre',
                    'cor' => '#10b981',
                    'icone' => 'banknote',
                ],
            ] : $contas->map(fn($c) => [
                'nome' => $c->nome,
                'tipo' => $c->tipo,
                'saldo' => (float)$c->saldo,
                'livre' => max(0, (float)$c->saldo - (float)$c->comprometido),
                'fatura' => (float)$c->comprometido,
                'atualizado' => 'Atualizado recentemente',
                'cor' => $c->cor ?: '#10b981',
                'icone' => 'wallet',
            ])
        ];

        // Saúde Financeira
        $saudeFinanceira = [
            'score' => 58,
            'status' => 'Atenção',
            'insights' => [
                ['tipo' => 'alerta', 'texto' => '81% da sua renda já tem destino (R$ 1.370 de R$ 1.700).'],
                ['tipo' => 'alerta', 'texto' => 'Reserva em 41% da meta (R$ 2.100 de R$ 5.100).'],
                ['tipo' => 'sucesso', 'texto' => 'Gastos de junho (R$ 1.185) menores que sua renda.'],
            ]
        ];

        // Pra registrar hoje
        $praRegistrarHoje = [
            [
                'id' => 1,
                'titulo' => 'Fatura Nubank',
                'valor' => 890.00,
                'descricao' => 'Seus gastos pessoais do mês no cartão · vence hoje',
                'icone' => 'credit-card',
                'tipo' => 'fatura'
            ],
            [
                'id' => 2,
                'titulo' => 'Geladeira Samsung',
                'valor' => 500.00,
                'descricao' => 'Sua parte da parcela do mês, dividida com o Ian · vence 15/07',
                'icone' => 'snowflake',
                'tipo' => 'lar'
            ]
        ];

        // Minhas Metas
        $metas = [
            [
                'id' => 1,
                'nome' => 'Notebook Dell',
                'tipo' => 'Individual',
                'atual' => 4050.00,
                'total' => 4500.00,
                'percentual' => 90,
                'onde' => 'Guardado em Poupança Caixa',
                'icone' => 'laptop'
            ],
            [
                'id' => 2,
                'nome' => 'Geladeira Samsung',
                'tipo' => 'Do Lar',
                'atual' => 1000.00,
                'total' => 3200.00,
                'percentual' => 31,
                'onde' => 'Guardado em Conta conjunta do Lar',
                'icone' => 'snowflake'
            ]
        ];

        // Indicadores rápidos
        $indicadores = [
            'entradas_mes' => $isDuda ? 1700.00 : (float)$totalEntradas,
            'saidas_mes' => $isDuda ? 1185.00 : (float)$totalSaidas,
            'livre_gastar' => $isDuda ? 755.00 : (float)$saldoLivre,
            'reserva_poupanca' => $isDuda ? 2100.00 : 3500.00,
        ];

        // Fluxo dos 2 meses
        $fluxoMeses = [
            ['mes' => 'Maio', 'entradas' => 1600.00, 'saidas' => 1100.00],
            ['mes' => 'Junho', 'entradas' => 1700.00, 'saidas' => 1185.00],
        ];

        // Despesas fixas do mês
        $despesasFixas = [
            ['titulo' => 'Fatura Nubank', 'valor' => 890.00, 'status' => 'Vence em breve', 'vencimento' => 'Vence 12/06', 'tipo' => 'aviso', 'icone' => 'credit-card'],
            ['titulo' => 'Minha parte no Lar', 'valor' => 480.00, 'status' => 'Pendente', 'vencimento' => 'Vence dia 5', 'tipo' => 'pendente', 'icone' => 'home'],
            ['titulo' => 'Academia Bio Ritmo', 'valor' => 119.90, 'status' => 'Pago', 'vencimento' => 'Vence dia 8', 'tipo' => 'pago', 'icone' => 'activity'],
            ['titulo' => 'Netflix + Spotify', 'valor' => 59.80, 'status' => 'Pago', 'vencimento' => 'Vence dia 7', 'tipo' => 'pago', 'icone' => 'film'],
        ];

        // Atividade recente protótipo
        $atividades = [
            ['titulo' => 'Salário Florais Design', 'sub' => '05/06 · Nubank', 'valor' => 1500.00, 'tipo' => 'entrada', 'icone' => 'briefcase'],
            ['titulo' => 'Sephora', 'sub' => 'Hoje · Nubank', 'valor' => -187.00, 'tipo' => 'saida', 'icone' => 'sparkles'],
            ['titulo' => 'Rappi', 'sub' => 'Ontem · Nubank', 'valor' => -67.40, 'tipo' => 'saida', 'icone' => 'utensils'],
            ['titulo' => 'Academia Bio Ritmo', 'sub' => 'Ontem · Nubank', 'valor' => -119.90, 'tipo' => 'saida', 'icone' => 'dumbbell'],
        ];

        return response()->json([
            'usuario' => [
                'id_usuario' => $user->id_usuario,
                'nome' => $user->nome,
                'iniciais' => $user->iniciais,
                'renda_total' => $user->renda_total,
                'banco_principal' => $user->banco_principal,
                'chave_pix' => $user->chave_pix,
            ],
            'resumo' => [
                'saldo_total' => (float)$saldoTotal,
                'saldo_comprometido' => (float)$saldoComprometido,
                'saldo_livre' => (float)$saldoLivre,
                'faturas_cartao' => (float)$faturasCartao,
                'total_entradas' => (float)$totalEntradas,
                'total_saidas' => (float)$totalSaidas,
                'balanco_mes' => (float)$balancoMes,
                'mes' => $mesAtual,
            ],
            'contas' => $contas,
            'gastos_por_categoria' => $gastosPorCategoria,
            'transacoes_recentes' => $recentes,
            'lar' => $dadosLar,
            'is_casal' => $lar !== null,
            'slogan' => 'Onde seu dinheiro cria raízes',
            // Dados protótipo avançado
            'pedido_ajuda' => $pedidoAjuda,
            'hero_mes' => $heroMes,
            'onde_esta_meu_dinheiro' => $ondeEstaMeuDinheiro,
            'saude_financeira' => $saudeFinanceira,
            'pra_registrar_hoje' => $praRegistrarHoje,
            'metas' => $metas,
            'indicadores' => $indicadores,
            'fluxo_meses' => $fluxoMeses,
            'despesas_fixas' => $despesasFixas,
            'atividades' => $atividades,
        ]);
    }
}
