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

        // Período ativo (padrão = mês atual)
        $mes = $request->mes ?? now()->format('Y-m');

        // Histórico: último 3 meses para o gráfico de evolução
        $historico = [];
        for ($i = 2; $i >= 0; $i--) {
            $m = now()->subMonths($i)->format('Y-m');
            $mLabel = now()->subMonths($i)->locale('pt_BR')->isoFormat('MMM/YY');
            $e = (float) Transacao::where('usuario_id', $userId)
                ->where('tipo', 'entrada')
                ->whereRaw("strftime('%Y-%m', data) = ?", [$m])
                ->sum('valor');
            $s = (float) Transacao::where('usuario_id', $userId)
                ->where('tipo', 'saida')
                ->whereRaw("strftime('%Y-%m', data) = ?", [$m])
                ->sum('valor');
            $historico[] = ['mes' => $mLabel, 'entradas' => $e, 'saidas' => $s];
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

        // Meses disponíveis para os chips (últimos 3)
        $mesesDisponiveis = [];
        for ($i = 2; $i >= 0; $i--) {
            $d = now()->subMonths($i);
            $mesesDisponiveis[] = [
                'valor'  => $d->format('Y-m'),
                'label'  => $d->locale('pt_BR')->isoFormat('MMM/YY'),
                'ativo'  => $d->format('Y-m') === $mes,
            ];
        }

        return response()->json([
            'mes'                  => $mes,
            'total_entradas'       => $totalEntradas,
            'total_saidas'         => $totalSaidas,
            'sobra'                => $sobra,
            'taxa_economia'        => $taxaEconomia,
            'entradas'             => $entradasQuery->map(fn($t) => [
                'titulo'    => $t->titulo,
                'subtitulo' => ($t->categoria?->nome ?? 'Renda') . ' · ' . Carbon::parse($t->data)->locale('pt_BR')->isoFormat('MMM/YYYY'),
                'valor'     => (float) $t->valor,
                'emoji'     => $t->emoji ?? '💰',
            ]),
            'gastos_por_categoria' => $porCategoria,
            'historico'            => $historico,
            'meses_disponiveis'    => $mesesDisponiveis,
        ]);
    }
}
