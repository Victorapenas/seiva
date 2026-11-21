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
            'categoria' => 'nullable|string',
            'tipo_escopo' => 'nullable|in:individual,lar',
            'posse' => 'nullable|string',
            'emoji' => 'nullable|string',
            'onde_guardado' => 'nullable|string',
            'data_limite' => 'nullable|date',
            'imagem' => 'nullable|string',
            'link_referencia' => 'nullable|string',
        ]);

        $user = Auth::user();
        $lar = $user->lares()->first();

        $ehLar = ($request->tipo_escopo === 'lar' || $request->posse === 'compartilhada' || $request->posse === 'lar') && $lar;

        $cat = strtolower($request->categoria ?? 'produto');
        $emoji = match(true) {
            str_contains($cat, 'viag') => '✈️',
            str_contains($cat, 'reserva') => '🛡️',
            str_contains($cat, 'curso') => '🎓',
            str_contains($cat, 'poupan') => '💰',
            default => '💻',
        };

        $meta = Meta::create([
            'usuario_id' => $user->id_usuario,
            'lar_id' => $ehLar ? $lar->id_lar : null,
            'responsavel_id' => $user->id_usuario,
            'titulo' => $request->titulo,
            'emoji' => $request->emoji ?: $emoji,
            'categoria' => $request->categoria ?? 'produto',
            'valor_alvo' => $request->valor_alvo,
            'valor_atual' => $request->valor_atual ?? 0,
            'contribuicao_mensal' => $request->contribuicao_mensal ?? 0,
            'onde_guardado' => $request->onde_guardado ?? 'Reserva Pessoal',
            'data_limite' => $request->data_limite,
            'imagem' => $request->imagem,
            'status' => 'ativa',
        ]);

        return response()->json($meta, 201);
    }

    public function contribuir(Request $request, $id)
    {
        $request->validate([
            'valor' => 'required|numeric|min:0.01',
            'conta_id' => 'nullable|exists:contas,id_conta',
        ]);

        $user = Auth::user();
        $larIds = $user->lares()->pluck('lares.id_lar')->toArray();

        $meta = Meta::where(function ($q) use ($user, $larIds) {
            $q->where('usuario_id', $user->id_usuario);
            if (!empty($larIds)) {
                $q->orWhereIn('lar_id', $larIds);
            }
        })->findOrFail($id);

        return \Illuminate\Support\Facades\DB::transaction(function () use ($request, $user, $meta) {
            $meta->increment('valor_atual', $request->valor);

            if ($request->conta_id) {
                $conta = \App\Models\Conta::where('usuario_id', $user->id_usuario)->where('id_conta', $request->conta_id)->first();
                if ($conta) {
                    $conta->decrement('saldo', $request->valor);
                    \App\Models\Transacao::create([
                        'usuario_id' => $user->id_usuario,
                        'conta_id' => $conta->id_conta,
                        'titulo' => 'Aporte na meta: ' . $meta->titulo,
                        'valor' => $request->valor,
                        'tipo' => 'saida',
                        'data' => now()->format('Y-m-d'),
                        'emoji' => '🎯',
                        'visibilidade' => 'pessoal',
                    ]);
                }
            }

            if ($meta->valor_atual >= $meta->valor_alvo) {
                $meta->update(['status' => 'concluida']);
            }

            return response()->json([
                'sucesso' => true,
                'message' => 'Contribuição adicionada com sucesso!',
                'meta' => $meta->fresh(),
            ]);
        });
    }
}
