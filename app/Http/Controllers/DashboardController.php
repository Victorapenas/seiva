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
        $lar = $user->lares()->with('membros')->first();

        return response()->json([
            'usuario' => [
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
            'lar' => $lar,
        ]);
    }
}
