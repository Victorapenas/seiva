<?php

namespace App\Http\Controllers;

use App\Models\Transacao;
use App\Models\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/**
 * RecebimentosController
 * Responsável pelo módulo de Relatórios e Recebimentos do SEIVA.
 * Consolida receitas, despesas, evolução por período e breakdown por categoria.
 *
 * Responsável Acadêmico: Victor Hugo (RF003 - Extrato, RF009 - Painel Consolidado)
 */
class RecebimentosController extends Controller
{
    /**
     * Retorna o relatório financeiro por período (mes, trimestre ou personalizado).
     * Calcula entradas, saídas, sobra, taxa de economia, gastos por categoria e histórico.
     */
    public function relatorio(Request $request)
    {
        $userId = Auth::id();

        // Período ativo (padrão = mês atual, com fallback robusto)
        $mes = $request->mes;
        if (!$mes || !preg_match('/^\d{4}-\d{2}$/', $mes)) {
            $mes = now()->format('Y-m');
        }

        try {
            $dataCarbon = Carbon::createFromFormat('Y-m-d', $mes . '-01');
        } catch (\Exception $e) {
            $dataCarbon = now()->startOfMonth();
            $mes = $dataCarbon->format('Y-m');
        }

        $mesAnterior = $dataCarbon->copy()->subMonth()->format('Y-m');
        $proximoMes = $dataCarbon->copy()->addMonth()->format('Y-m');
        $mesLabel = ucfirst($dataCarbon->locale('pt_BR')->translatedFormat('F \d\e Y'));
        $mesCurto = ucfirst($dataCarbon->locale('pt_BR')->isoFormat('MMM/YY'));

        // Histórico: 4 meses anteriores + mês ativo para o gráfico de evolução
        $historico = [];
        for ($i = 4; $i >= 0; $i--) {
            $mCarbon = $dataCarbon->copy()->subMonths($i);
            $m = $mCarbon->format('Y-m');
            $mLabel = ucfirst($mCarbon->locale('pt_BR')->isoFormat('MMM/YY'));
            $e = (float) Transacao::where('usuario_id', $userId)
                ->where('tipo', 'entrada')
                ->whereRaw("strftime('%Y-%m', data) = ?", [$m])
                ->sum('valor');
            $s = (float) Transacao::where('usuario_id', $userId)
                ->where('tipo', 'saida')
                ->whereRaw("strftime('%Y-%m', data) = ?", [$m])
                ->sum('valor');
            $historico[] = ['mes' => $mLabel, 'entradas' => $e, 'saidas' => $s, 'chave' => $m];
        }

        // Dados do mês solicitado
        $entradasQuery = Transacao::where('usuario_id', $userId)
            ->where('tipo', 'entrada')
            ->whereRaw("strftime('%Y-%m', data) = ?", [$mes])
            ->with('categoria')
            ->orderByDesc('data')
            ->get();

        $saidasQuery = Transacao::where('usuario_id', $userId)
            ->where('tipo', 'saida')
            ->whereRaw("strftime('%Y-%m', data) = ?", [$mes])
            ->with('categoria')
            ->get();

        $totalEntradas = (float) $entradasQuery->sum('valor');
        $totalSaidas   = (float) $saidasQuery->sum('valor');
        $sobra         = $totalEntradas - $totalSaidas;
        $taxaEconomia  = $totalEntradas > 0
            ? max(0, (int) round(($sobra / $totalEntradas) * 100))
            : 0;

        // Gastos por categoria (agrupado e ordenado por valor desc)
        $porCategoria = $saidasQuery
            ->groupBy(fn($t) => $t->categoria?->nome ?? 'Outros')
            ->map(fn($grupo, $nome) => [
                'nome'       => $nome,
                'valor'      => (float) $grupo->sum('valor'),
                'percentual' => $totalSaidas > 0
                    ? (int) round(($grupo->sum('valor') / $totalSaidas) * 100)
                    : 0,
            ])
            ->sortByDesc('valor')
            ->values();

        // Meses disponíveis para os chips (últimos 6 meses até o mês atual + 1 futuro)
        $mesesDisponiveis = [];
        $baseMeses = now()->startOfMonth()->addMonth(); // inclui próximo mês
        for ($i = 6; $i >= 0; $i--) {
            $d = $baseMeses->copy()->subMonths($i);
            $mesesDisponiveis[] = [
                'valor'  => $d->format('Y-m'),
                'label'  => ucfirst($d->locale('pt_BR')->isoFormat('MMM/YY')),
                'ativo'  => $d->format('Y-m') === $mes,
            ];
        }

        return response()->json([
            'mes'                  => $mes,
            'mes_anterior'         => $mesAnterior,
            'proximo_mes'          => $proximoMes,
            'mes_label'            => $mesLabel,
            'mes_curto'            => $mesCurto,
            'meses_disponiveis'    => $mesesDisponiveis,
            'historico'            => $historico,
            'por_categoria'        => $porCategoria,
            'total_entradas'       => $totalEntradas,
            'total_saidas'         => $totalSaidas,
            'sobra'                => $sobra,
            'taxa_economia'        => $taxaEconomia,
            'entradas'             => $entradasQuery->map(fn($t) => [
                'titulo'    => $t->titulo,
                'subtitulo' => ($t->categoria?->nome ?? 'Renda') . ' · ' . Carbon::parse($t->data)->locale('pt_BR')->isoFormat('MMM/YYYY'),
                'valor'     => (float) $t->valor,
                'icone'     => 'trending-up',
            ]),
            'gastos_por_categoria' => $porCategoria,
            'historico'            => $historico,
            'meses_disponiveis'    => $mesesDisponiveis,
        ]);
    }
}
