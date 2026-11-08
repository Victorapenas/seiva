<?php

namespace App\Http\Controllers;

use App\Models\Acordo;
use App\Models\Proposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcordoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $lar = $user->lares()->first();

        if (!$lar) {
            return response()->json(['acordos' => [], 'propostas' => []]);
        }

        $acordos = Acordo::where('lar_id', $lar->id_lar)
            ->orderBy('id_acordo', 'desc')
            ->get();

        $propostas = Proposta::where('lar_id', $lar->id_lar)
            ->with('autor')
            ->orderBy('id_proposta', 'desc')
            ->get();

        return response()->json([
            'acordos' => $acordos,
            'propostas' => $propostas,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor_total' => 'required|numeric|min:0',
            'divisao' => 'required|string',
            'tipo' => 'required|in:meta,divida',
            'valor_mensal' => 'nullable|numeric',
            'vencimento_descricao' => 'nullable|string',
            'imagem' => 'nullable|string',
        ]);

        $user = Auth::user();
        $lar = $user->lares()->firstOrFail();

        $acordo = Acordo::create([
            'lar_id' => $lar->id_lar,
            'criado_por' => $user->id_usuario,
            'titulo' => $request->titulo,
            'tipo' => $request->tipo,
            'valor_total' => $request->valor_total,
            'valor_arrecadado' => 0,
            'divisao' => $request->divisao,
            'valor_mensal' => $request->valor_mensal ?? 0,
            'vencimento_descricao' => $request->vencimento_descricao ?? 'Mensal',
            'imagem' => $request->imagem,
            'status' => 'ativo',
        ]);

        return response()->json($acordo, 201);
    }

    public function criarProposta(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'proposta_texto' => 'required|string',
            'divisao_sugerida' => 'nullable|string',
        ]);

        $user = Auth::user();
        $lar = $user->lares()->firstOrFail();

        $proposta = Proposta::create([
            'lar_id' => $lar->id_lar,
            'autor_id' => $user->id_usuario,
            'titulo' => $request->titulo,
            'valor' => $request->valor,
            'proposta_texto' => $request->proposta_texto,
            'divisao_sugerida' => $request->divisao_sugerida ?? '50/50',
            'status' => 'em_analise',
        ]);

        return response()->json($proposta->load('autor'), 201);
    }

    public function votarProposta(Request $request, $id)
    {
        $request->validate(['acao' => 'required|in:aceitar,recusar']);
        $proposta = Proposta::findOrFail($id);

        if ($request->acao === 'aceitar') {
            $proposta->update(['status' => 'aprovada']);

            // Converte proposta em Acordo ativo
            Acordo::create([
                'lar_id' => $proposta->lar_id,
                'criado_por' => $proposta->autor_id,
                'titulo' => $proposta->titulo,
                'tipo' => 'meta',
                'valor_total' => $proposta->valor,
                'divisao' => $proposta->divisao_sugerida ?: '50/50',
                'status' => 'ativo',
            ]);
        } else {
            $proposta->update(['status' => 'rejeitada']);
        }

        return response()->json(['message' => 'Voto computado!', 'proposta' => $proposta]);
    }
}
