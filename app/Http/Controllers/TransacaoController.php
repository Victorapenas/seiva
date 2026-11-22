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

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        if ($request->filled('conta_id')) {
            $query->where('conta_id', $request->conta_id);
        }

        if ($request->filled('categoria')) {
            $catFiltro = trim($request->categoria);
            $query->where(function($q) use ($catFiltro) {
                $q->whereHas('categoria', function($cq) use ($catFiltro) {
                    $cq->where('nome', 'like', "%{$catFiltro}%")
                       ->orWhere('id_categoria', $catFiltro);
                })
                ->orWhere('titulo', 'like', "%{$catFiltro}%");
            });
        }

        if ($request->filled('periodo')) {
            $hoje = now()->format('Y-m-d');
            if ($request->periodo === 'hoje') {
                $query->whereDate('data', $hoje);
            } elseif ($request->periodo === 'semana') {
                $query->whereDate('data', '>=', now()->subDays(7)->format('Y-m-d'));
            } elseif ($request->periodo === 'mes') {
                $query->whereRaw("strftime('%Y-%m', data) = ?", [now()->format('Y-m')]);
            }
        } elseif ($request->filled('mes')) {
            $query->whereRaw("strftime('%Y-%m', data) = ?", [$request->mes]);
        }

        if ($request->filled('q') || $request->filled('busca')) {
            $termo = trim($request->q ?? $request->busca);
            $query->where(function($q) use ($termo) {
                $q->where('titulo', 'like', "%{$termo}%")
                  ->orWhereHas('categoria', fn($cq) => $cq->where('nome', 'like', "%{$termo}%"))
                  ->orWhereHas('conta', fn($cq) => $cq->where('nome', 'like', "%{$termo}%"));
            });
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
            'categoria_nome' => 'nullable|string',
            'is_imprevisto' => 'nullable|boolean',
            'data' => 'nullable|date',
            'emoji' => 'nullable|string',
            'visibilidade' => 'nullable|in:pessoal,compartilhado,lar',
            'compartilhado' => 'nullable|boolean',
        ]);

        $userId = Auth::id();
        $conta = Conta::where('usuario_id', $userId)->where('id_conta', $request->conta_id)->first();
        if (!$conta) {
            return response()->json(['error' => 'A conta informada não pertence ao usuário.'], 403);
        }

        // Mapeamento e resolução de Categoria por Nome ou ID
        $categoriaId = $request->categoria_id;
        $iconeSugerido = null;

        if (!$categoriaId && $request->filled('categoria_nome')) {
            $mapaIcones = [
                'Moradia' => 'home',
                'Alimentação' => 'utensils',
                'Transporte' => 'car',
                'Saúde' => 'pill',
                'Lazer' => 'film',
                'Mercado' => 'shopping-cart',
                'Beleza' => 'sparkles',
                'Presente' => 'gift',
            ];
            $catNome = trim($request->categoria_nome);
            $iconeSugerido = $mapaIcones[$catNome] ?? 'tag';

            $categoria = \App\Models\Categoria::firstOrCreate(
                ['nome' => $catNome],
                [
                    'emoji' => $iconeSugerido,
                    'cor' => '#10b981',
                    'sistema' => true,
                ]
            );
            $categoriaId = $categoria->id_categoria;
        }

        $visibilidade = $request->visibilidade;
        if (!$visibilidade) {
            $visibilidade = $request->compartilhado ? 'compartilhado' : 'pessoal';
        }

        return DB::transaction(function () use ($request, $userId, $conta, $categoriaId, $iconeSugerido, $visibilidade) {
            $iconeFinal = $request->emoji ?: ($iconeSugerido ?: ($request->tipo === 'entrada' ? 'trending-up' : 'credit-card'));

            $transacao = Transacao::create([
                'usuario_id' => $userId,
                'conta_id' => $request->conta_id,
                'categoria_id' => $categoriaId,
                'titulo' => $request->titulo,
                'emoji' => $iconeFinal,
                'valor' => $request->valor,
                'tipo' => $request->tipo,
                'data' => $request->data ?? now()->format('Y-m-d'),
                'visibilidade' => $visibilidade,
            ]);

            // Atualiza saldo da conta
            if ($request->tipo === 'entrada') {
                $conta->increment('saldo', $request->valor);
            } else {
                $conta->decrement('saldo', $request->valor);
            }

            return response()->json($transacao->load(['conta', 'categoria']), 201);
        });
    }

    public function destroy($id)
    {
        $userId = Auth::id();
        $transacao = Transacao::where('usuario_id', $userId)->where('id_transacao', $id)->firstOrFail();

        return DB::transaction(function () use ($transacao, $userId) {
            // Reverte saldo da conta caso ela pertença ao usuário
            $conta = Conta::where('usuario_id', $userId)->where('id_conta', $transacao->conta_id)->first();
            if ($conta) {
                if ($transacao->tipo === 'entrada') {
                    $conta->decrement('saldo', $transacao->valor);
                } else {
                    $conta->increment('saldo', $transacao->valor);
                }
            }

            $transacao->delete();
            return response()->json(['message' => 'Transação excluída e saldo revertido.']);
        });
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

    /**
     * Retorna transações relacionadas ao Lar (compartilhadas/lar) do usuário logado e do parceiro.
     */
    public function indexLar(Request $request)
    {
        $user = Auth::user();
        $lar  = $user->lares()->first();

        if (!$lar) {
            return response()->json([
                'lar'           => null,
                'eu_enviei'     => 0,
                'parceiro_enviou' => 0,
                'total'         => 0,
                'transacoes'    => [],
            ]);
        }

        // Pega todos os membros do lar
        $membros = $lar->membros()->get();
        $parceiro = $membros->where('id_usuario', '!=', $user->id_usuario)->first();

        $mes = $request->mes ?? now()->format('Y-m');

        // Transações do usuário para o lar
        $minhasLar = Transacao::where('usuario_id', $user->id_usuario)
            ->whereIn('visibilidade', ['lar', 'compartilhado'])
            ->whereRaw("strftime('%Y-%m', data) = ?", [$mes])
            ->with('categoria')
            ->orderByDesc('data')
            ->get();

        // Transações do parceiro para o lar (visíveis)
        $parceiroLar = collect([]);
        if ($parceiro) {
            $parceiroLar = Transacao::where('usuario_id', $parceiro->id_usuario)
                ->whereIn('visibilidade', ['lar', 'compartilhado'])
                ->whereRaw("strftime('%Y-%m', data) = ?", [$mes])
                ->with('categoria')
                ->orderByDesc('data')
                ->get();
        }

        $euEnviei       = (float) $minhasLar->sum('valor');
        $parceiroEnviou = (float) $parceiroLar->sum('valor');

        $todasTransacoes = $minhasLar->map(fn($t) => [
            'id'          => $t->id_transacao,
            'titulo'      => $t->titulo,
            'subtitulo'   => ($user->iniciais ?? 'EU') . ' · ' . \Carbon\Carbon::parse($t->data)->format('d/m') . ' · ' . ($t->categoria?->nome ?? 'Geral'),
            'valor'       => (float) $t->valor,
            'membro'      => 'eu',
            'iniciais'    => $user->iniciais ?? 'EU',
            'icone'       => ($t->emoji && !preg_match('/[\x{1F300}-\x{1F9FF}]/u', $t->emoji)) ? $t->emoji : 'home',
        ])->concat($parceiroLar->map(fn($t) => [
            'id'          => $t->id_transacao,
            'titulo'      => $t->titulo,
            'subtitulo'   => ($parceiro ? ($parceiro->iniciais ?? 'IM') : 'IM') . ' · ' . \Carbon\Carbon::parse($t->data)->format('d/m'),
            'valor'       => (float) $t->valor,
            'membro'      => 'parceiro',
            'iniciais'    => $parceiro ? ($parceiro->iniciais ?? 'IM') : 'IM',
            'icone'       => ($t->emoji && !preg_match('/[\x{1F300}-\x{1F9FF}]/u', $t->emoji)) ? $t->emoji : 'home',
        ]))->sortByDesc('valor')->values();

        return response()->json([
            'lar'              => ['nome' => $lar->nome],
            'eu_iniciais'      => $user->iniciais ?? 'EU',
            'parceiro_iniciais' => $parceiro ? ($parceiro->iniciais ?? 'IM') : 'IM',
            'parceiro_nome'    => $parceiro ? explode(' ', $parceiro->nome)[0] : 'Parceiro',
            'eu_enviei'        => $euEnviei,
            'parceiro_enviou'  => $parceiroEnviou,
            'total'            => $euEnviei + $parceiroEnviou,
            'transacoes'       => $todasTransacoes,
        ]);
    }

    /**
     * Permite ao usuário escolher e alterar o ícone e categoria de uma transação (RF003, UX)
     */
    public function atualizarIcone(Request $request, $id)
    {
        $request->validate([
            'icone' => 'nullable|string|max:50',
            'categoria_nome' => 'nullable|string|max:100',
            'categoria_id' => 'nullable',
        ]);

        $userId = Auth::id();
        $transacao = Transacao::where('usuario_id', $userId)->where('id_transacao', $id)->first();
        if (!$transacao) {
            $transacao = Transacao::find($id);
        }

        if (!$transacao) {
            return response()->json(['erro' => 'Transação não encontrada.'], 404);
        }

        $dados = [];
        if ($request->filled('icone')) {
            $dados['emoji'] = $request->icone;
        }

        if ($request->filled('categoria_id') && is_numeric($request->categoria_id)) {
            $dados['categoria_id'] = $request->categoria_id;
        } elseif ($request->filled('categoria_nome')) {
            $cat = Categoria::firstOrCreate(
                ['nome' => $request->categoria_nome],
                ['emoji' => $request->icone ?: 'tag', 'cor' => '#10b981', 'sistema' => true]
            );
            $dados['categoria_id'] = $cat->id_categoria;
        }

        $transacao->update($dados);

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Ícone e categoria atualizados com sucesso!',
            'transacao' => $transacao->load('categoria'),
        ]);
    }
}
