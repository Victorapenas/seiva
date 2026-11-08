<?php

namespace App\Http\Controllers;

use App\Models\Lar;
use App\Models\LarMembro;
use App\Models\ConviteLar;
use App\Models\DespesaLar;
use App\Models\ParticipacaoDespesa;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LarController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $lar = $user->lares()->first();

        if (!$lar) {
            return response()->json(['lar' => null]);
        }

        $membros = LarMembro::with('usuario')
            ->where('lar_id', $lar->id_lar)
            ->get();

        $rendaTotalLar = $membros->sum('renda_declarada');

        // Calcula proporções de renda
        $membrosFormatados = $membros->map(function ($m) use ($rendaTotalLar) {
            $renda = (float)$m->renda_declarada;
            $percentual = $rendaTotalLar > 0 ? round(($renda / $rendaTotalLar) * 100, 1) : 50;

            return [
                'id_lar_membro' => $m->id_lar_membro,
                'usuario_id' => $m->usuario_id,
                'nome' => $m->usuario->nome,
                'iniciais' => $m->usuario->iniciais,
                'email' => $m->usuario->email,
                'papel' => $m->papel,
                'renda_declarada' => $renda,
                'percentual_calculado' => $percentual,
                'chave_pix' => $m->usuario->chave_pix,
            ];
        });

        // Totais de despesas do lar no mês
        $mesAtual = now()->format('Y-m');
        $despesasMes = DespesaLar::where('lar_id', $lar->id_lar)
            ->whereRaw("strftime('%Y-%m', data_vencimento) = ?", [$mesAtual])
            ->get();

        $totalDespesasMes = $despesasMes->sum('valor_total');

        return response()->json([
            'lar' => [
                'id_lar' => $lar->id_lar,
                'nome' => $lar->nome,
                'emoji' => $lar->emoji,
                'criado_por' => $lar->criado_por,
            ],
            'membros' => $membrosFormatados,
            'renda_total_lar' => (float)$rendaTotalLar,
            'total_despesas_mes' => (float)$totalDespesasMes,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'emoji' => 'nullable|string|max:20',
        ]);

        return DB::transaction(function () use ($request) {
            $user = Auth::user();

            $lar = Lar::create([
                'nome' => $request->nome,
                'emoji' => $request->emoji ?? '🌿',
                'criado_por' => $user->id_usuario,
            ]);

            LarMembro::create([
                'lar_id' => $lar->id_lar,
                'usuario_id' => $user->id_usuario,
                'papel' => 'administrador',
                'renda_declarada' => $user->renda_total ?: 2000,
                'percentual_contribuicao' => 100,
                'aceito_em' => now(),
            ]);

            return response()->json($lar, 201);
        });
    }

    public function invite(Request $request)
    {
        $user = Auth::user();
        $lar = $user->lares()->first();

        if (!$lar) {
            return response()->json(['error' => 'Você não pertence a nenhum lar.'], 400);
        }

        $token = strtoupper(Str::random(6));

        $convite = ConviteLar::create([
            'lar_id' => $lar->id_lar,
            'convidado_por' => $user->id_usuario,
            'email_convidado' => $request->email,
            'token_convite' => $token,
            'status' => 'pendente',
            'expira_em' => now()->addDays(7),
        ]);

        return response()->json([
            'message' => 'Convite gerado com sucesso!',
            'token_convite' => $token,
            'link' => url('/convite/' . $token),
        ]);
    }

    public function join(Request $request)
    {
        $request->validate(['token' => 'required|string']);
        $user = Auth::user();

        $convite = ConviteLar::where('token_convite', strtoupper($request->token))
            ->where('status', 'pendente')
            ->first();

        if (!$convite) {
            return response()->json(['error' => 'Código de convite inválido ou expirado.'], 404);
        }

        // Verifica se já é membro
        $jaMembro = LarMembro::where('lar_id', $convite->lar_id)
            ->where('usuario_id', $user->id_usuario)
            ->exists();

        if ($jaMembro) {
            return response()->json(['error' => 'Você já faz parte deste lar.'], 400);
        }

        LarMembro::create([
            'lar_id' => $convite->lar_id,
            'usuario_id' => $user->id_usuario,
            'papel' => 'membro',
            'renda_declarada' => $user->renda_total ?: 1500,
            'percentual_contribuicao' => 50,
            'aceito_em' => now(),
        ]);

        $convite->update(['status' => 'aceito']);

        return response()->json(['message' => 'Parabéns! Você entrou no Lar com sucesso!']);
    }

    public function despesas()
    {
        $user = Auth::user();
        $lar = $user->lares()->first();

        if (!$lar) {
            return response()->json([]);
        }

        $despesas = DespesaLar::with(['participacoes.usuario', 'registradaPor'])
            ->where('lar_id', $lar->id_lar)
            ->orderBy('data_vencimento', 'desc')
            ->get();

        return response()->json($despesas);
    }

    public function storeDespesa(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor_total' => 'required|numeric|min:0.01',
            'tipo' => 'required|in:fixa,variavel,emergencia',
            'divisao' => 'required|in:50/50,proporcional',
            'data_vencimento' => 'nullable|date',
            'emoji' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($request) {
            $user = Auth::user();
            $lar = $user->lares()->firstOrFail();

            $despesa = DespesaLar::create([
                'lar_id' => $lar->id_lar,
                'registrada_por' => $user->id_usuario,
                'titulo' => $request->titulo,
                'emoji' => $request->emoji ?? '🧾',
                'valor_total' => $request->valor_total,
                'tipo' => $request->tipo,
                'divisao' => $request->divisao,
                'data_vencimento' => $request->data_vencimento ?? now()->format('Y-m-d'),
                'status' => 'pendente',
            ]);

            $membros = LarMembro::where('lar_id', $lar->id_lar)->get();
            $totalRendas = $membros->sum('renda_declarada');
            $numMembros = count($membros);

            foreach ($membros as $m) {
                if ($request->divisao === 'proporcional' && $totalRendas > 0) {
                    $valorParte = round(($m->renda_declarada / $totalRendas) * $request->valor_total, 2);
                } else {
                    $valorParte = round($request->valor_total / max(1, $numMembros), 2);
                }

                // Se quem cadastrou já pagou sua parte
                $pago = ($m->usuario_id === $user->id_usuario);

                ParticipacaoDespesa::create([
                    'despesa_lar_id' => $despesa->id_despesa_lar,
                    'usuario_id' => $m->usuario_id,
                    'valor_parte' => $valorParte,
                    'pago' => $pago,
                ]);
            }

            return response()->json($despesa->load('participacoes.usuario'), 201);
        });
    }

    public function quitarParticipacao($id)
    {
        $participacao = ParticipacaoDespesa::findOrFail($id);
        $participacao->update(['pago' => true]);

        // Verifica se todas participações foram quitadas
        $despesa = $participacao->despesa;
        $todasQuitadas = $despesa->participacoes()->where('pago', false)->count() === 0;

        if ($todasQuitadas) {
            $despesa->update(['status' => 'pago']);
        } else {
            $despesa->update(['status' => 'parcial']);
        }

        return response()->json([
            'message' => 'Parte quitada com sucesso!',
            'participacao' => $participacao,
            'despesa' => $despesa->fresh(['participacoes.usuario']),
        ]);
    }
}
