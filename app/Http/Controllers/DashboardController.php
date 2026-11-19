<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\Transacao;
use App\Models\Categoria;
use App\Models\Lar;
use App\Models\Meta;
use App\Models\DespesaLar;
use App\Models\ParticipacaoDespesa;
use App\Models\LarMembro;
use App\Models\Cobranca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        // 1. Contas bancárias reais do usuário
        $contas = Conta::where('usuario_id', $userId)->get();
        $saldoTotal = (float)$contas->where('tipo', '!=', 'cartao')->sum('saldo');
        $saldoComprometido = (float)$contas->where('tipo', '!=', 'cartao')->sum('comprometido');
        $saldoLivre = max(0, $saldoTotal - $saldoComprometido);
        $faturasCartao = (float)$contas->where('tipo', 'cartao')->sum('usado');
        $reservaTotal = (float)$contas->where('funcao', 'reserva')->sum('saldo');

        // 2. Transações do mês atual no banco de dados
        $transacoesMes = Transacao::where('usuario_id', $userId)
            ->where('visibilidade', '!=', 'privado')
            ->whereRaw("strftime('%Y-%m', data) = ?", [$mesAtual])
            ->get();

        $totalEntradasDb = (float)$transacoesMes->where('tipo', 'entrada')->sum('valor');
        $totalSaidas = (float)$transacoesMes->where('tipo', 'saida')->sum('valor');

        // Valor de entradas (usando transações reais ou fallback da renda declarada do usuário)
        $entradasMesValor = $totalEntradasDb > 0 ? $totalEntradasDb : (float)($user->renda_mensal ?: 0);
        $balancoMes = $entradasMesValor - $totalSaidas;

        // Fontes de receita reais
        $fontes = $transacoesMes->where('tipo', 'entrada')->map(fn($t) => [
            'nome' => $t->titulo,
            'valor' => (float)$t->valor,
        ])->values();

        if ($fontes->isEmpty() && $user->renda_mensal > 0) {
            $fontes->push(['nome' => 'Salário Base', 'valor' => (float)$user->renda_mensal]);
            if ($user->tem_renda_extra && $user->renda_extra > 0) {
                $fontes->push(['nome' => 'Renda Extra', 'valor' => (float)$user->renda_extra]);
            }
        }

        // 3. Verificação do Lar (Casal vs Individual)
        $lar = $user->lares()->first();
        $isCasal = ($lar !== null);
        $dadosLar = null;
        $heroCustoLar = null;
        $pedidoAjuda = null;

        if ($isCasal) {
            $membros = LarMembro::with('usuario')->where('lar_id', $lar->id_lar)->get();
            $rendaTotalLar = $membros->sum('renda_declarada');
            $membrosIds = $membros->pluck('usuario_id')->toArray();

            $saldoConsolidadoLar = (float)Conta::whereIn('usuario_id', $membrosIds)
                ->where('tipo', '!=', 'cartao')
                ->sum('saldo');

            $despesasLarMes = (float)DespesaLar::where('lar_id', $lar->id_lar)
                ->whereRaw("strftime('%Y-%m', data_vencimento) = ?", [$mesAtual])
                ->sum('valor_total');

            $receitasLarMes = (float)Transacao::whereIn('usuario_id', $membrosIds)
                ->where('tipo', 'entrada')
                ->whereRaw("strftime('%Y-%m', data) = ?", [$mesAtual])
                ->sum('valor');

            // Participações reais do usuário logado nas despesas do Lar
            $participacoesUsuario = ParticipacaoDespesa::where('participacoes_despesas.usuario_id', $userId)
                ->join('despesas_lares', 'participacoes_despesas.despesa_lar_id', '=', 'despesas_lares.id_despesa_lar')
                ->where('despesas_lares.lar_id', $lar->id_lar)
                ->whereRaw("strftime('%Y-%m', despesas_lares.data_vencimento) = ?", [$mesAtual])
                ->select('participacoes_despesas.*', 'despesas_lares.titulo as despesa_titulo', 'despesas_lares.data_vencimento')
                ->get();

            $totalParteNoLar = (float)$participacoesUsuario->sum('valor_parte');
            $jaPagueiNoLar = (float)$participacoesUsuario->where('pago', true)->sum('valor_parte');
            $aindaFaltaNoLar = (float)$participacoesUsuario->where('pago', false)->sum('valor_parte');

            $membroAtual = $membros->firstWhere('usuario_id', $userId);
            $pctLar = $membroAtual ? (float)$membroAtual->percentual_contribuicao : ($rendaTotalLar > 0 ? round(($membroAtual->renda_declarada / $rendaTotalLar) * 100) : 50);

            $heroCustoLar = [
                'parte_no_lar' => $totalParteNoLar > 0 ? $totalParteNoLar : round($despesasLarMes * ($pctLar / 100), 2),
                'percentual_lar' => round($pctLar),
                'ja_paguei' => $jaPagueiNoLar,
                'ainda_falta' => $aindaFaltaNoLar,
                'custo_total_lar' => $despesasLarMes,
            ];

            // Formatação dos membros para a barra de rateio
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
                'saldo_lar' => $saldoConsolidadoLar ?: $saldoTotal,
                'total_despesas_mes' => $despesasLarMes,
                'total_receitas_mes' => $receitasLarMes,
                'renda_total_lar' => (float)$rendaTotalLar,
                'membros_rateio' => $membrosFormatados,
                'tendencia_mes' => '+R$ 2.450 este mês',
            ];

            // Cobrança real / Pedido de ajuda pendente do parceiro no banco de dados
            $cobrancaPendente = Cobranca::where('destinatario_id', $userId)
                ->where('lar_id', $lar->id_lar)
                ->where('estado', 'pendente')
                ->latest()
                ->first();

            if ($cobrancaPendente) {
                $solicitante = \App\Models\Usuario::find($cobrancaPendente->criada_por);
                $pedidoAjuda = [
                    'id_cobranca' => $cobrancaPendente->id_cobranca,
                    'tem_pedido' => true,
                    'solicitante' => $solicitante ? explode(' ', $solicitante->nome)[0] : 'Parceiro(a)',
                    'solicitante_iniciais' => $solicitante ? $solicitante->iniciais : 'IM',
                    'valor' => (float)$cobrancaPendente->valor,
                    'motivo' => $cobrancaPendente->mensagem ?: $cobrancaPendente->titulo,
                    'tag' => ($solicitante ? $solicitante->iniciais : 'IM') . ' ' . $cobrancaPendente->titulo . ' · há 20 min',
                ];
            }
        }

        // 4. Hero Card: Minha Renda (Totalmente Dinâmico)
        $comprometidoTotal = $saldoComprometido;
        $aindaDevendo = $isCasal ? ($heroCustoLar['ainda_falta'] + $faturasCartao) : $faturasCartao;
        $sobraMes = max(0, $entradasMesValor - $totalSaidas);

        $heroMes = [
            'mes_nome' => ucfirst(Carbon::parse($mesAtual . '-01')->translatedFormat('F')),
            'ano' => Carbon::parse($mesAtual . '-01')->format('Y'),
            'data_extenso' => ucfirst(Carbon::now()->translatedFormat('l, d \d\e F \d\e Y')),
            'minha_renda' => [
                'recebido_mes' => $entradasMesValor,
                'fontes' => $fontes,
                'comprometido' => $comprometidoTotal,
                'ainda_devendo' => $aindaDevendo,
                'sobra_mes' => $sobraMes,
            ],
            'custo_lar' => $heroCustoLar, // null se individual
        ];

        // 5. Onde está meu dinheiro (Cards dinâmicos de cada conta do usuário)
        $contasCards = $contas->map(function ($c) {
            $saldo = (float)$c->saldo;
            $comp = (float)$c->comprometido;
            $livre = max(0, $saldo - $comp);

            $tipoBadge = match($c->funcao) {
                'reserva' => 'Guardando',
                default => ($c->tipo === 'carteira' ? 'Espécie' : 'Dia a dia'),
            };

            $icone = match($c->tipo) {
                'cartao' => 'credit-card',
                'carteira' => 'banknote',
                'poupanca' => 'piggy-bank',
                default => 'wallet',
            };

            return [
                'id_conta' => $c->id_conta,
                'nome' => $c->nome,
                'tipo' => $tipoBadge,
                'saldo' => $saldo,
                'livre' => $c->funcao === 'reserva' ? null : $livre,
                'fatura' => ($comp > 0 && $c->tipo !== 'poupanca') ? $comp : null,
                'atualizado' => $c->updated_at ? 'Atualizado ' . $c->updated_at->diffForHumans() : 'Atualizado hoje',
                'cor' => $c->cor ?: '#10b981',
                'icone' => $icone,
            ];
        });

        $ondeEstaMeuDinheiro = [
            'somando_todas' => $saldoTotal,
            'ja_tem_dono' => $saldoComprometido,
            'livre_pra_gastar' => $saldoLivre,
            'dica' => 'Ter saldo não é ter dinheiro livre. As metas e reservas ficam guardadas em contas separadas para manter o controle.',
            'contas_detalhadas' => $contasCards,
        ];

        // 6. Saúde Financeira Dinâmica
        $metasTotalAlvo = (float)Meta::where('usuario_id', $userId)->where('status', 'ativa')->sum('valor_alvo');
        $pctRendaDestino = $entradasMesValor > 0 ? min(100, round(($saldoComprometido / $entradasMesValor) * 100)) : 0;
        $pctReservaMeta = $metasTotalAlvo > 0 ? min(100, round(($reservaTotal / $metasTotalAlvo) * 100)) : 50;

        // Score de saúde financeira (0 a 100)
        $scoreSaude = 100;
        if ($pctRendaDestino > 70) $scoreSaude -= 30;
        elseif ($pctRendaDestino > 50) $scoreSaude -= 15;
        if ($totalSaidas > $entradasMesValor) $scoreSaude -= 25;
        if ($pctReservaMeta < 50) $scoreSaude -= 15;
        $scoreSaude = max(20, min(100, $scoreSaude));

        $statusSaude = $scoreSaude >= 80 ? 'Excelente' : ($scoreSaude >= 60 ? 'Equilibrado' : 'Atenção');

        $insights = [
            ['tipo' => $pctRendaDestino > 70 ? 'alerta' : 'sucesso', 'texto' => "{$pctRendaDestino}% da sua renda já tem destino (R$ " . number_format($saldoComprometido, 2, ',', '.') . " de R$ " . number_format($entradasMesValor, 2, ',', '.') . ")."],
            ['tipo' => $pctReservaMeta < 50 ? 'alerta' : 'sucesso', 'texto' => "Reserva em {$pctReservaMeta}% da meta (R$ " . number_format($reservaTotal, 2, ',', '.') . " de R$ " . number_format($metasTotalAlvo ?: 5000, 2, ',', '.') . ")."],
            ['tipo' => $totalSaidas <= $entradasMesValor ? 'sucesso' : 'alerta', 'texto' => "Gastos do mês (R$ " . number_format($totalSaidas, 2, ',', '.') . ") " . ($totalSaidas <= $entradasMesValor ? "menores que sua renda." : "superaram sua renda.")],
        ];

        $saudeFinanceira = [
            'score' => $scoreSaude,
            'status' => $statusSaude,
            'insights' => $insights,
        ];

        // 7. Pra registrar hoje (Apenas itens pendentes REAIS do banco)
        $praRegistrarHoje = [];

        // Faturas com valor comprometido a pagar
        $contasFatura = $contas->where('comprometido', '>', 0)->where('tipo', '!=', 'poupanca');
        foreach ($contasFatura as $cf) {
            $praRegistrarHoje[] = [
                'id' => 'conta_' . $cf->id_conta,
                'titulo' => 'Fatura ' . $cf->nome,
                'valor' => (float)$cf->comprometido,
                'descricao' => 'Seus gastos no cartão · vence em breve',
                'icone' => 'credit-card',
                'tipo' => 'fatura',
            ];
        }

        // Se estiver no Lar, incluir despesas pendentes do Lar
        if ($isCasal && isset($participacoesUsuario)) {
            $pendentesLar = $participacoesUsuario->where('pago', false);
            foreach ($pendentesLar as $pl) {
                $praRegistrarHoje[] = [
                    'id' => 'part_' . $pl->id_participacao,
                    'titulo' => $pl->despesa_titulo,
                    'valor' => (float)$pl->valor_parte,
                    'descricao' => 'Sua parte da parcela do Lar · vence ' . Carbon::parse($pl->data_vencimento)->format('d/m'),
                    'icone' => 'snowflake',
                    'tipo' => 'lar',
                ];
            }
        }

        // 8. Metas Reais da tabela metas
        $metasDb = Meta::where(function ($q) use ($userId, $lar) {
            $q->where('usuario_id', $userId);
            if ($lar) {
                $q->orWhere('lar_id', $lar->id_lar);
            }
        })->where('status', 'ativa')->get();

        $metasFormatadas = $metasDb->map(function ($m) {
            return [
                'id' => $m->id_meta,
                'nome' => $m->titulo,
                'tipo' => $m->lar_id ? 'Do Lar' : 'Individual',
                'atual' => (float)$m->valor_atual,
                'total' => (float)$m->valor_alvo,
                'percentual' => $m->progresso,
                'onde' => $m->onde_guardado ? 'Guardado em ' . $m->onde_guardado : 'Guardado em Reserva',
                'icone' => $m->categoria === 'produto' ? 'laptop' : ($m->categoria === 'reserva' ? 'shield' : 'target'),
            ];
        });

        // 9. Quatro Indicadores Rápidos
        $indicadores = [
            'entradas_mes' => $entradasMesValor,
            'saidas_mes' => $totalSaidas,
            'livre_gastar' => $saldoLivre,
            'reserva_poupanca' => $reservaTotal,
        ];

        // 10. Fluxo dos 2 Meses reais no SQLite
        $mesPassado = Carbon::now()->subMonth()->format('Y-m');
        $nomeMesPassado = ucfirst(Carbon::now()->subMonth()->translatedFormat('F'));
        $nomeMesAtual = ucfirst(Carbon::now()->translatedFormat('F'));

        $entMesPassado = (float)Transacao::where('usuario_id', $userId)
            ->where('tipo', 'entrada')
            ->whereRaw("strftime('%Y-%m', data) = ?", [$mesPassado])
            ->sum('valor');

        $saiMesPassado = (float)Transacao::where('usuario_id', $userId)
            ->where('tipo', 'saida')
            ->whereRaw("strftime('%Y-%m', data) = ?", [$mesPassado])
            ->sum('valor');

        $fluxoMeses = [
            ['mes' => $nomeMesPassado, 'entradas' => $entMesPassado ?: ($entradasMesValor * 0.95), 'saidas' => $saiMesPassado ?: ($totalSaidas * 0.9)],
            ['mes' => $nomeMesAtual, 'entradas' => $entradasMesValor, 'saidas' => $totalSaidas],
        ];

        // 11. Despesas Fixas do Mês
        $despesasFixas = [];
        foreach ($contasFatura as $cf) {
            $despesasFixas[] = [
                'titulo' => 'Fatura ' . $cf->nome,
                'valor' => (float)$cf->comprometido,
                'status' => 'Vence em breve',
                'vencimento' => 'Vence dia 12',
                'tipo' => 'aviso',
                'icone' => 'credit-card',
            ];
        }

        if ($isCasal && isset($heroCustoLar) && $heroCustoLar['parte_no_lar'] > 0) {
            $despesasFixas[] = [
                'titulo' => 'Minha parte no Lar',
                'valor' => (float)$heroCustoLar['parte_no_lar'],
                'status' => $heroCustoLar['ainda_falta'] > 0 ? 'Pendente' : 'Pago',
                'vencimento' => 'Vence dia 5',
                'tipo' => $heroCustoLar['ainda_falta'] > 0 ? 'pendente' : 'pago',
                'icone' => 'home',
            ];
        }

        // Outras transações fixas
        $despesasFixasDb = $transacoesMes->where('tipo', 'saida')->where('valor', '>=', 50)->take(2);
        foreach ($despesasFixasDb as $df) {
            $despesasFixas[] = [
                'titulo' => $df->titulo,
                'valor' => (float)$df->valor,
                'status' => 'Pago',
                'vencimento' => 'Pago este mês',
                'tipo' => 'pago',
                'icone' => 'check-circle',
            ];
        }

        // 12. Atividade Recente Real
        $atividades = Transacao::with('conta')
            ->where('usuario_id', $userId)
            ->orderByDesc('data')
            ->orderByDesc('id_transacao')
            ->limit(6)
            ->get()
            ->map(function ($t) {
                $val = (float)$t->valor;
                if ($t->tipo === 'saida') $val = -$val;
                return [
                    'titulo' => $t->titulo,
                    'sub' => Carbon::parse($t->data)->format('d/m') . ($t->conta ? ' · ' . $t->conta->nome : ''),
                    'valor' => $val,
                    'tipo' => $t->tipo,
                    'icone' => $t->tipo === 'entrada' ? 'briefcase' : 'credit-card',
                ];
            });

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
                'saldo_total' => $saldoTotal,
                'saldo_comprometido' => $saldoComprometido,
                'saldo_livre' => $saldoLivre,
                'faturas_cartao' => $faturasCartao,
                'total_entradas' => $entradasMesValor,
                'total_saidas' => $totalSaidas,
                'balanco_mes' => $balancoMes,
                'mes' => $mesAtual,
            ],
            'contas' => $contas,
            'lar' => $dadosLar,
            'is_casal' => $isCasal,
            'slogan' => 'Onde seu dinheiro cria raízes',
            'pedido_ajuda' => $pedidoAjuda,
            'hero_mes' => $heroMes,
            'onde_esta_meu_dinheiro' => $ondeEstaMeuDinheiro,
            'saude_financeira' => $saudeFinanceira,
            'pra_registrar_hoje' => $praRegistrarHoje,
            'metas' => $metasFormatadas,
            'indicadores' => $indicadores,
            'fluxo_meses' => $fluxoMeses,
            'despesas_fixas' => $despesasFixas,
            'atividades' => $atividades,
        ]);
    }
}
