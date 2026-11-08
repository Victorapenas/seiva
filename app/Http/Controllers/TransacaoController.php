<?php

namespace App\Http\Controllers;

use App\Models\Transacao;
use App\Models\Conta;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransacaoController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $query = Transacao::with(['conta', 'categoria'])
            ->where('usuario_id', $userId)
            ->where('visibilidade', '!=', 'privado') // RF002: Caixa Preta fica oculta
            ->orderBy('data', 'desc')
            ->orderBy('id_transacao', 'desc');

        if ($request->has('tipo') && $request->tipo) {
            $query->where('tipo', $request->tipo);
        }

        if ($request->has('mes') && $request->mes) {
            $query->whereRaw("strftime('%Y-%m', data) = ?", [$request->mes]);
        }

        $transacoes = $query->get();
        return response()->json($transacoes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0.01',
            'tipo' => 'required|in:entrada,saida',
            'conta_id' => 'required|exists:contas,id_conta',
            'categoria_id' => 'nullable|exists:categorias,id_categoria',
            'data' => 'nullable|date',
            'emoji' => 'nullable|string',
            'visibilidade' => 'nullable|in:pessoal,compartilhado,lar',
        ]);

        return DB::transaction(function () use ($request) {
            $userId = Auth::id();

            $transacao = Transacao::create([
                'usuario_id' => $userId,
                'conta_id' => $request->conta_id,
                'categoria_id' => $request->categoria_id,
                'titulo' => $request->titulo,
                'emoji' => $request->emoji ?? ($request->tipo === 'entrada' ? '💰' : '💸'),
                'valor' => $request->valor,
                'tipo' => $request->tipo,
                'data' => $request->data ?? now()->format('Y-m-d'),
                'visibilidade' => $request->visibilidade ?? 'pessoal',
            ]);

            // Atualiza saldo da conta
            $conta = Conta::find($request->conta_id);
            if ($conta) {
                if ($request->tipo === 'entrada') {
                    $conta->increment('saldo', $request->valor);
                } else {
                    $conta->decrement('saldo', $request->valor);
                }
            }

            return response()->json($transacao->load(['conta', 'categoria']), 201);
        });
    }

    public function destroy($id)
    {
        $transacao = Transacao::where('usuario_id', Auth::id())->where('id_transacao', $id)->firstOrFail();

        // Reverte saldo
        $conta = Conta::find($transacao->conta_id);
        if ($conta) {
            if ($transacao->tipo === 'entrada') {
                $conta->decrement('saldo', $transacao->valor);
            } else {
                $conta->increment('saldo', $transacao->valor);
            }
        }

        $transacao->delete();
        return response()->json(['message' => 'Transação excluída e saldo revertido.']);
    }

    public function categorias()
    {
        $userId = Auth::id();
        $categorias = Categoria::where('sistema', true)
            ->orWhere('usuario_id', $userId)
            ->orderBy('nome')
            ->get();
        return response()->json($categorias);
    }
}
