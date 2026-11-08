<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContaController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $contas = Conta::where('usuario_id', $userId)->get();
        return response()->json($contas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'tipo' => 'required|in:corrente,poupanca,cartao,carteira',
            'saldo' => 'nullable|numeric',
            'comprometido' => 'nullable|numeric',
            'funcao' => 'nullable|in:gasto,reserva,carteira',
            'cor' => 'nullable|string',
            'chave_pix' => 'nullable|string',
            'limite' => 'nullable|numeric',
        ]);

        $conta = Conta::create([
            'usuario_id' => Auth::id(),
            'nome' => $request->nome,
            'tipo' => $request->tipo,
            'saldo' => $request->saldo ?? 0,
            'comprometido' => $request->comprometido ?? 0,
            'funcao' => $request->funcao ?? 'gasto',
            'cor' => $request->cor ?? '#10b981',
            'chave_pix' => $request->chave_pix,
            'limite' => $request->limite,
        ]);

        return response()->json($conta, 201);
    }

    public function update(Request $request, $id)
    {
        $conta = Conta::where('usuario_id', Auth::id())->where('id_conta', $id)->firstOrFail();
        $conta->update($request->only(['nome', 'saldo', 'comprometido', 'cor', 'chave_pix', 'limite']));
        return response()->json($conta);
    }

    public function destroy($id)
    {
        $conta = Conta::where('usuario_id', Auth::id())->where('id_conta', $id)->firstOrFail();
        $conta->delete();
        return response()->json(['message' => 'Conta removida com sucesso.']);
    }
}
