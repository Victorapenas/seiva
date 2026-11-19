<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\Transacao;
use App\Models\Categoria;
use App\Models\Lar;
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

        // Gastos por categoria (para o gráfico e percentuais)
        $gastosPorCategoria = Transacao::join('categorias', 'transacoes.categoria_id', '=', 'categorias.id_categoria')
            ->where('transacoes.usuario_id', $userId)
            ->where('transacoes.visibilidade', '!=', 'privado')
            ->where('transacoes.tipo', 'saida')
            ->whereRaw("strftime('%Y-%m', transacoes.data) = ?", [$mesAtual])
            ->select('categorias.nome', 'categorias.cor', 'categorias.emoji', DB::raw('SUM(transacoes.valor) as total'))
            ->groupBy('categorias.id_categoria', 'categorias.nome', 'categorias.cor', 'categorias.emoji')
            ->orderByDesc('total')
            ->get();

        // Transações recentes (últimas 5)
        $recentes = Transacao::with(['conta', 'categoria'])
            ->where('usuario_id', $userId)
            ->where('visibilidade', '!=', 'privado')
            ->orderBy('data', 'desc')
            ->orderBy('id_transacao', 'desc')
            ->limit(6)
            ->get();

        // Lar ativo do usuário
        $lar = $user->lares()->first();
        $dadosLar = null;

        if ($lar) {
            $membros = \App\Models\LarMembro::with('usuario')->where('lar_id', $lar->id_lar)->get();
            $rendaTotalLar = $membros->sum('renda_declarada');
            $membrosIds = $membros->pluck('usuario_id')->toArray();

            // Saldo consolidado das contas dos membros do Lar
            $saldoConsolidadoLar = Conta::whereIn('usuario_id', $membrosIds)
                ->where('tipo', '!=', 'cartao')
                ->sum('saldo');

            // Despesas do Lar no mês
            $despesasLarMes = \App\Models\DespesaLar::where('lar_id', $lar->id_lar)
                ->whereRaw("strftime('%Y-%m', data_vencimento) = ?", [$mesAtual])
                ->sum('valor_total');

            // Receitas do Lar no mês
            $receitasLarMes = Transacao::whereIn('usuario_id', $membrosIds)
                ->where('tipo', 'entrada')
                ->whereRaw("strftime('%Y-%m', data) = ?", [$mesAtual])
                ->sum('valor');

            // Formatação dos membros para a barra de Rateio Proporcional
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

            // Nomes combinados do casal (ex: "Duda & Ian")
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
        ]);
    }
}
