<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LgpdController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'tipo_renda' => 'nullable|in:clt,pj,autonomo,outro',
            'renda_mensal' => 'nullable|numeric|min:0',
            'renda_extra' => 'nullable|numeric|min:0',
            'banco_principal' => 'nullable|string|max:100',
            'chave_pix' => 'nullable|string|max:100',
            'pin_caixa_preta' => 'nullable|string|max:10',
        ]);

        $user->update($request->only([
            'nome', 'telefone', 'tipo_renda', 'renda_mensal',
            'renda_extra', 'banco_principal', 'chave_pix', 'pin_caixa_preta'
        ]));

        return response()->json([
            'message' => 'Perfil atualizado com sucesso!',
            'usuario' => $user->fresh(),
        ]);
    }

    public function exportData()
    {
        $user = Auth::user();
        $user->load(['contas', 'transacoes', 'metas', 'registrosCaixaPreta', 'lares']);

        $exportData = [
            'relatorio' => 'Exportação de Dados Pessoais - LGPD (Lei nº 13.709/2018)',
            'gerado_em' => now()->toIso8601String(),
            'titular_dos_dados' => [
                'id' => $user->id_usuario,
                'nome' => $user->nome,
                'email' => $user->email,
                'telefone' => $user->telefone,
                'renda_declarada' => $user->renda_total,
                'banco_principal' => $user->banco_principal,
                'chave_pix' => $user->chave_pix,
                'cadastrado_em' => $user->created_at,
            ],
            'contas_bancarias' => $user->contas,
            'historico_transacoes' => $user->transacoes,
            'metas_financeiras' => $user->metas,
            'registros_privados_caixa_preta' => $user->registrosCaixaPreta,
            'lares_compartilhados' => $user->lares,
        ];

        return response()->json($exportData, 200, [
            'Content-Disposition' => 'attachment; filename="seiva-lgpd-dados-' . $user->id_usuario . '.json"',
        ]);
    }

    public function deleteAccount()
    {
        $user = Auth::user();

        DB::transaction(function () use ($user) {
            $user->contas()->delete();
            $user->transacoes()->delete();
            $user->metas()->delete();
            $user->registrosCaixaPreta()->delete();
            $user->delete();
        });

        Auth::logout();
        request()->session()->invalidate();

        return response()->json(['message' => 'Conta e todos os dados foram definitivamente anonimizados e excluídos (LGPD).']);
    }
}
