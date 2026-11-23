<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\ProjetoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller: ProjetoController (Projetos do Lar e Compras Planejadas)
 * 
 * Responsabilidade Acadêmica: Ian Marcos Rocha Santos (RF008)
 * Requisito Atendido: RF008 — Gestão de Projetos do Lar, Reformas e Lista de Compras
 * 
 * Por que fizemos assim:
 * Morar junto ou planejar uma reforma envolve múltiplos gastos pequenos que somados
 * podem estourar o orçamento do mês. Criamos o módulo de Projetos para permitir que os membros
 * do lar organizem um objetivo maior (ex: "Reforma da Sala", "Enxoval do Quarto") com um teto de
 * orçamento total estipulado e uma lista de itens com custos estimados que podem ser marcados como
 * comprados à medida que são adquiridos.
 */
class ProjetoController extends Controller
{
    /**
     * RF008: Lista os projetos do usuário ou compartilhados com o Lar.
     * O que tentamos fazer: Trazer todos os projetos ativos onde o usuário é autor ou que pertencem ao seu Lar,
     * incluindo a relação de itens e status de compra de cada um.
     */
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

    /**
     * RF008: Cadastra um novo projeto financeiro.
     * O que tentamos fazer: Registrar um novo projeto definindo o título e o orçamento total estimado.
     * Se o usuário fizer parte de um Lar, o projeto já fica vinculado para que ambos possam acompanhar.
     */
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

    /**
     * RF008: Adiciona um item de compra a um projeto existente.
     * O que tentamos fazer: Permitir detalhar os custos previstos de cada peça, material ou serviço
     * necessário para a conclusão do projeto, garantindo que o projeto pertença ao usuário ou Lar.
     */
    public function addItem(Request $request, $id)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'custo_estimado' => 'required|numeric',
        ]);

        $user = Auth::user();
        $lar = $user->lares()->first();

        $projeto = Projeto::where(function ($q) use ($user, $lar) {
            $q->where('usuario_id', $user->id_usuario);
            if ($lar) {
                $q->orWhere('lar_id', $lar->id_lar);
            }
        })->findOrFail($id);

        $item = ProjetoItem::create([
            'projeto_id' => $projeto->id_projeto,
            'descricao' => $request->descricao,
            'custo_estimado' => $request->custo_estimado,
            'comprado' => false,
        ]);

        return response()->json($item, 201);
    }

    /**
     * RF008: Alterna o status do item entre comprado e pendente (toggle).
     * O que tentamos fazer: Facilitar a marcação rápida (estilo checklist) quando um item da reforma
     * é adquirido, atualizando a visão do que ainda falta comprar.
     */
    public function toggleItem($id)
    {
        $user = Auth::user();
        $lar = $user->lares()->first();

        $item = ProjetoItem::whereHas('projeto', function ($q) use ($user, $lar) {
            $q->where('usuario_id', $user->id_usuario);
            if ($lar) {
                $q->orWhere('lar_id', $lar->id_lar);
            }
        })->findOrFail($id);

        $item->update(['comprado' => !$item->comprado]);
        return response()->json($item);
    }
}

