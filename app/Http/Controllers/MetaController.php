<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $lar = $user->lares()->first();

        $metasIndividuais = Meta::where('usuario_id', $user->id_usuario)
            ->whereNull('lar_id')
            ->get();

        $metasLar = $lar ? Meta::where('lar_id', $lar->id_lar)->get() : collect([]);

        return response()->json([
            'individuais' => $metasIndividuais,
            'lar' => $metasLar,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor_alvo' => 'required|numeric|min:1',
            'valor_atual' => 'nullable|numeric|min:0',
            'contribuicao_mensal' => 'nullable|numeric|min:0',
            'categoria' => 'nullable|in:produto,viagem,poupanca,reserva,curso',
            'tipo_escopo' => 'required|in:individual,lar',
            'emoji' => 'nullable|string',
            'onde_guardado' => 'nullable|string',
            'data_limite' => 'nullable|date',
            'imagem' => 'nullable|string',
        ]);

        $user = Auth::user();
        $lar = $user->lares()->first();

        $meta = Meta::create([
            'usuario_id' => $user->id_usuario,
            'lar_id' => ($request->tipo_escopo === 'lar' && $lar) ? $lar->id_lar : null,
            'responsavel_id' => $user->id_usuario,
            'titulo' => $request->titulo,
            'emoji' => $request->emoji ?? '🎯',
            'categoria' => $request->categoria ?? 'poupanca',
            'valor_alvo' => $request->valor_alvo,
            'valor_atual' => $request->valor_atual ?? 0,
            'contribuicao_mensal' => $request->contribuicao_mensal ?? 0,
            'onde_guardado' => $request->onde_guardado ?? 'Cofrinho Virtual',
            'data_limite' => $request->data_limite,
            'imagem' => $request->imagem,
            'status' => 'ativa',
        ]);

        return response()->json($meta, 201);
    }

    public function contribuir(Request $request, $id)
    {
        $request->validate(['valor' => 'required|numeric|min:0.01']);
        $meta = Meta::findOrFail($id);

        $meta->increment('valor_atual', $request->valor);

        if ($meta->valor_atual >= $meta->valor_alvo) {
            $meta->update(['status' => 'concluida']);
        }

        return response()->json([
            'message' => 'Contribuição adicionada com sucesso!',
            'meta' => $meta->fresh(),
        ]);
    }
}
