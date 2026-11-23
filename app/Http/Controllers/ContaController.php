<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller: ContaController (Contas Bancárias e Carteiras)
 * 
 * Responsabilidade Acadêmica: Victor Hugo / Ian Marcos (RF003)
 * Requisito Atendido: RF003 — Gestão de Contas Bancárias, Carteiras Físicas e Cartões de Crédito
 * 
 * Por que fizemos assim:
 * Para oferecer uma experiência intuitiva e adaptada ao contexto brasileiro, criamos
 * a detecção automática de cores dos bancos nacionais mais usados (Nubank, Inter, Itaú, BB, etc.).
 * Além disso, para preservar a integridade referencial contábil (ACID), contas que já possuem
 * transações registradas não podem ser simplesmente deletadas via DELETE físico: o sistema
 * arquiva a conta preservando o histórico financeiro do usuário.
 */
class ContaController extends Controller
{
    /**
     * RF003: Lista todas as contas do usuário logado.
     */
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
        $userId = Auth::id();
        $conta = Conta::where('usuario_id', $userId)->where('id_conta', $id)->firstOrFail();
        
        $request->validate([
            'nome' => 'nullable|string|max:255',
            'tipo' => 'nullable|string|max:50',
            'saldo' => 'nullable|numeric',
            'cor' => 'nullable|string|max:50',
            'limite' => 'nullable|numeric',
            'comprometido' => 'nullable|numeric',
        ]);

        $dadosAntigos = $conta->only(['nome', 'tipo', 'saldo', 'cor']);
        $conta->update($request->only(['nome', 'tipo', 'saldo', 'comprometido', 'cor', 'chave_pix', 'limite']));
        $dadosNovos = $conta->only(['nome', 'tipo', 'saldo', 'cor']);

        // Registrar no Histórico de Auditoria para rastreabilidade contábil
        \App\Models\HistoricoAuditoria::registrar(
            $userId,
            'conta',
            $conta->id_conta,
            'editado',
            "Conta \"{$conta->nome}\" atualizada. Saldo ajustado para R$ " . number_format($conta->saldo, 2, ',', '.'),
            $dadosAntigos,
            $dadosNovos
        );
        
        return response()->json([
            'sucesso' => true,
            'mensagem' => "Conta \"{$conta->nome}\" atualizada com sucesso!",
            'conta' => $conta
        ]);
    }

    public function destroy($id)
    {
        $userId = Auth::id();
        $conta = Conta::where('usuario_id', $userId)->where('id_conta', $id)->firstOrFail();
        $nome = $conta->nome;
        $totalTransacoes = $conta->transacoes()->count();

        // Arquitetura de Integridade Contábil: se a conta possui transações vinculadas,
        // ela NUNCA deve sofrer hard delete, preservando o histórico financeiro e relatórios.
        if ($totalTransacoes > 0) {
            $conta->update(['ativa' => false]);

            \App\Models\HistoricoAuditoria::registrar(
                $userId,
                'conta',
                $conta->id_conta,
                'arquivado',
                "Conta \"{$nome}\" arquivada. Preservadas {$totalTransacoes} transações vinculadas para integridade dos relatórios e balanço patrimonial.",
                ['nome' => $nome, 'saldo' => $conta->saldo, 'transacoes_vinculadas' => $totalTransacoes],
                ['ativa' => false]
            );

            return response()->json([
                'sucesso' => true,
                'arquivada' => true,
                'mensagem' => "A conta \"{$nome}\" possui {$totalTransacoes} transações registradas. Para preservar seu histórico financeiro, a conta foi arquivada em vez de excluída."
            ]);
        }

        // Sem transações vinculadas: exclusão segura
        \App\Models\HistoricoAuditoria::registrar(
            $userId,
            'conta',
            $conta->id_conta,
            'excluido',
            "Conta \"{$nome}\" sem lançamentos vinculados foi removida permanentemente.",
            ['nome' => $nome, 'saldo' => $conta->saldo],
            null
        );

        $conta->delete();
        
        return response()->json([
            'sucesso' => true,
            'arquivada' => false,
            'mensagem' => "Conta \"{$nome}\" removida com sucesso."
        ]);
    }
}
