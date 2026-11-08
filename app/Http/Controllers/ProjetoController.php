<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\ProjetoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjetoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $lar = $user->lares()->first();

        $projetos = Projeto::with('itens')
            ->where(function($q) use ($user, $lar) {
                $q->where('usuario_id', $user->id_usuario);
                if ($lar) {
                    $q->orWhere('lar_id', $lar->id_lar);
                }
            })
            ->get();

        return response()->json($projetos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'orcamento_total' => 'nullable|numeric',
        ]);

        $user = Auth::user();
        $lar = $user->lares()->first();

        $projeto = Projeto::create([
            'usuario_id' => $user->id_usuario,
            'lar_id' => $lar ? $lar->id_lar : null,
            'titulo' => $request->titulo,
            'orcamento_total' => $request->orcamento_total ?? 0,
            'status' => 'em_andamento',
        ]);

        return response()->json($projeto, 201);
    }

    public function addItem(Request $request, $id)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'custo_estimado' => 'required|numeric',
        ]);

        $item = ProjetoItem::create([
            'projeto_id' => $id,
            'descricao' => $request->descricao,
            'custo_estimado' => $request->custo_estimado,
            'comprado' => false,
        ]);

        return response()->json($item, 201);
    }

    public function toggleItem($id)
    {
        $item = ProjetoItem::findOrFail($id);
        $item->update(['comprado' => !$item->comprado]);
        return response()->json($item);
    }
}
