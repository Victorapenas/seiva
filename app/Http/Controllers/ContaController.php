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
        $tipoInput = strtolower(str_replace([' ', '_', '-'], '', $request->tipo ?? 'corrente'));
        $tipoMapeado = match($tipoInput) {
            'cartaodecredito', 'cartao', 'credit' => 'cartao',
            'poupanca', 'investimento', 'reserva' => 'poupanca',
            'carteira', 'especie', 'dinheiro' => 'carteira',
            default => 'corrente',
        };

        $funcaoMapeada = match($tipoInput) {
            'investimento', 'reserva', 'poupanca' => 'reserva',
            'carteira', 'especie' => 'carteira',
            default => ($request->funcao ?? 'gasto'),
        };

        // Paleta de cores por banco comum brasileiro
        $nomeLower = strtolower($request->nome ?? '');
        $bancoLower = strtolower($request->banco ?? '');
        $corDetectada = $request->cor ?: match(true) {
            str_contains($nomeLower, 'nubank') || str_contains($bancoLower, 'nubank') => '#8b5cf6',
            str_contains($nomeLower, 'inter') || str_contains($bancoLower, 'inter') => '#ff7a00',
            str_contains($nomeLower, 'itau') || str_contains($bancoLower, 'itau') => '#ea580c',
            str_contains($nomeLower, 'bradesco') || str_contains($bancoLower, 'bradesco') => '#dc2626',
            str_contains($nomeLower, 'santander') || str_contains($bancoLower, 'santander') => '#e11d48',
            str_contains($nomeLower, 'caixa') || str_contains($bancoLower, 'caixa') => '#2563eb',
            str_contains($nomeLower, 'picpay') || str_contains($bancoLower, 'picpay') => '#10b981',
            str_contains($nomeLower, 'mercado') || str_contains($bancoLower, 'mercado') => '#0284c7',
            default => '#10b981',
        };

        $request->validate([
            'nome' => 'required|string|max:100',
            'saldo' => 'nullable|numeric',
            'comprometido' => 'nullable|numeric',
            'limite' => 'nullable|numeric',
            'vencimento_fatura' => 'nullable|integer|min:1|max:31',
        ]);

        $limiteVal = $tipoMapeado === 'cartao' ? ($request->limite ?: ($request->saldo ?: 3500.00)) : $request->limite;
        $saldoVal = $tipoMapeado === 'cartao' ? 0.00 : ($request->saldo ?? 0.00);

        $conta = Conta::create([
            'usuario_id' => Auth::id(),
            'nome' => $request->nome,
            'tipo' => $tipoMapeado,
            'saldo' => $saldoVal,
            'comprometido' => $request->comprometido ?? 0,
            'funcao' => $funcaoMapeada,
            'cor' => $corDetectada,
            'chave_pix' => $request->chave_pix,
            'limite' => $limiteVal,
            'vencimento_fatura' => $request->vencimento_fatura ?: 12,
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
