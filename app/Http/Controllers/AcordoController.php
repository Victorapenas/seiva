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
            return response()->json([
                'acordos' => [],
                'propostas' => [],
                'negociacoes_em_aberto' => [],
                'poupando_juntos' => [],
                'dividas_divididas' => [],
            ]);
        }

        $acordosDb = Acordo::where('lar_id', $lar->id_lar)
            ->orderBy('id_acordo', 'desc')
            ->get();

        $propostasDb = Proposta::where('lar_id', $lar->id_lar)
            ->with('autor')
            ->orderBy('id_proposta', 'desc')
            ->get();

        // Dados oficiais estruturados conforme protótipo do casal (Maria Eduarda & Ian Marcos)
        $negociacoesEmAberto = [
            [
                'id_proposta' => 101,
                'titulo' => 'Fogão Brastemp 5 bocas',
                'tipo' => 'poupar_juntos',
                'tipo_label' => 'Poupar juntos',
                'autor_nome' => 'Ian Marcos',
                'tempo_atras' => 'há 2h',
                'link' => 'mercadolivre.com.br/fogao-brastemp-5-bocas',
                'imagem' => 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=200&auto=format&fit=crop&q=80',
                'valor_total' => 1600.00,
                'valor_mensal_cada' => 200.00,
                'prazo_texto' => '~4 meses para juntar',
                'mensagem' => 'Que tal a gente juntar pra trocar o fogão? Topo botar R$ 200/mês cada um, em uns 4 meses a gente compra à vista.',
                'ian_proposta' => 'R$ 200,00/mês',
                'divisao' => '50/50',
                'status' => 'pendente',
            ],
            [
                'id_proposta' => 102,
                'titulo' => 'Maquiagem Vult Kit Profissional',
                'tipo' => 'divida_dividida',
                'tipo_label' => 'Dívida dividida',
                'autor_nome' => 'Ian Marcos',
                'tempo_atras' => 'há 2h',
                'link' => 'mercadolivre.com.br/maquiagem-vult-kit',
                'imagem' => 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=200&auto=format&fit=crop&q=80',
                'valor_total' => 289.90,
                'valor_mensal_cada' => 72.45,
                'parcelas_texto' => 'sua parte R$ 72,45 em 2x · obrigatório',
                'mensagem' => 'Já comprei aquela maquiagem que você queria, vamos dividir em 2x de R$ 72,45?',
                'ian_proposta' => 'R$ 72,45/mês',
                'divisao' => '50/50',
                'status' => 'pendente',
            ],
        ];

        $poupandoJuntos = [
            [
                'id_acordo' => 301,
                'titulo' => 'Fogão Brastemp 5 bocas',
                'imagem' => 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=600&auto=format&fit=crop&q=80',
                'valor_total' => 1600.00,
                'valor_mensal_juntos' => 400.00,
                'valor_guardado' => 0.00,
                'progresso_pct' => 0,
                'maria_mes' => 200.00,
                'ian_mes' => 200.00,
                'divisao_rotulo' => 'Divisão 50% / 50%',
                'lembrete_rotulo' => 'Lembrete flexível · todo dia 10',
                'destino_rotulo' => 'Poupança Caixa (conjunta)',
                'banner_info' => 'Meta compartilhada: o lembrete chega todo mês, mas você pode guardar mais, menos ou pular sem atraso. É organização, não cobrança.',
                'cobrador_rotulo' => 'Lembrete gentil todo mês — sem pressão, dar mais ou menos tudo bem.',
                'badge' => 'Acordo recém-criado',
                'expandido' => true,
            ],
            [
                'id_acordo' => 302,
                'titulo' => 'Viagem Praia do Forte',
                'imagem' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600&auto=format&fit=crop&q=80',
                'valor_total' => 3000.00,
                'valor_mensal_juntos' => 300.00,
                'valor_guardado' => 540.00,
                'progresso_pct' => 18,
                'maria_mes' => 150.00,
                'ian_mes' => 150.00,
                'divisao_rotulo' => 'Divisão 50% / 50%',
                'lembrete_rotulo' => 'Todo dia 5',
                'destino_rotulo' => 'Poupança Caixa (conjunta)',
                'banner_info' => 'Meta compartilhada flexível.',
                'cobrador_rotulo' => 'Lembrete automático.',
                'badge' => 'Em andamento',
                'expandido' => false,
            ],
        ];

        $dividasDivididas = [
            [
                'id_acordo' => 401,
                'titulo' => 'Geladeira Samsung Frost Free 460L',
                'valor_total' => 3200.00,
                'valor_mensal_juntos' => 500.00,
                'parcelas_pagas' => 2,
                'parcelas_total' => 8,
                'parcelas_rotulo' => '2/8 pagas',
                'status' => 'ativo',
            ],
        ];

        return response()->json([
            'acordos' => $acordosDb,
            'propostas' => $propostasDb,
            'negociacoes_em_aberto' => $negociacoesEmAberto,
            'poupando_juntos' => $poupandoJuntos,
            'dividas_divididas' => $dividasDivididas,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor_total' => 'required|numeric|min:0',
            'divisao' => 'nullable|string',
            'tipo' => 'required|in:meta,divida,poupar_juntos,divida_dividida',
            'valor_mensal' => 'nullable|numeric',
            'link_produto' => 'nullable|string',
        ]);

        $user = Auth::user();
        $lar = $user->lares()->firstOrFail();

        $tipoNormalizado = in_array($request->tipo, ['poupar_juntos', 'meta']) ? 'meta' : 'divida';

        $acordo = Acordo::create([
            'lar_id' => $lar->id_lar,
            'criado_por' => $user->id_usuario,
            'titulo' => $request->titulo,
            'tipo' => $tipoNormalizado,
            'valor_total' => $request->valor_total,
            'valor_arrecadado' => 0,
            'divisao' => $request->divisao ?: '50/50',
            'valor_mensal' => $request->valor_mensal ?? ($request->valor_total / 4),
            'vencimento_descricao' => 'Todo dia 10',
            'imagem' => null,
            'status' => 'ativo',
        ]);

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Proposta de acordo enviada para o parceiro!',
            'acordo' => $acordo,
        ], 201);
    }

    public function criarProposta(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor' => 'nullable|numeric',
            'valor_total' => 'nullable|numeric',
            'tipo' => 'nullable|string',
            'proposta_texto' => 'nullable|string',
            'descricao' => 'nullable|string',
            'divisao' => 'nullable|string',
            'divisao_sugerida' => 'nullable|string',
        ]);

        $user = Auth::user();
        $lar = $user->lares()->firstOrFail();

        $valorTotal = $request->valor_total ?? $request->valor ?? 0;
        $descricao = $request->descricao ?? $request->proposta_texto ?? '';
        $divisao = $request->divisao ?? $request->divisao_sugerida ?? '50/50';
        $tipo = in_array($request->tipo, ['poupar_juntos', 'meta']) ? 'meta' : 'divida';

        $proposta = Proposta::create([
            'lar_id' => $lar->id_lar,
            'autor_id' => $user->id_usuario,
            'tipo' => $tipo,
            'titulo' => $request->titulo,
            'descricao' => $descricao,
            'mensagem' => $descricao,
            'valor_total' => $valorTotal,
            'divisao' => $divisao,
            'status' => 'pendente',
        ]);

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Proposta criada com sucesso!',
            'proposta' => $proposta->load('autor'),
        ], 201);
    }

    public function votarProposta(Request $request, $id)
    {
        $request->validate([
            'acao' => 'required|in:aceitar,recusar,contrapor',
            'novo_valor' => 'nullable|numeric',
        ]);

        $user = Auth::user();
        $larIds = $user->lares()->pluck('lares.id_lar')->toArray();

        // Segurança: retorna 404 se proposta não existe OU não pertence ao lar do usuário
        $proposta = Proposta::whereIn('lar_id', $larIds)->find($id);

        if (!$proposta) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Proposta não encontrada.',
            ], 404);
        }

        if ($request->acao === 'aceitar') {
            $proposta->update(['status' => 'aceita']);
            Acordo::create([
                'lar_id' => $proposta->lar_id,
                'criado_por' => $proposta->autor_id,
                'titulo' => $proposta->titulo,
                'tipo' => $proposta->tipo ?: 'meta',
                'valor_total' => $proposta->valor_total,
                'divisao' => $proposta->divisao ?: '50/50',
                'status' => 'ativo',
            ]);
            return response()->json([
                'sucesso' => true,
                'mensagem' => 'Proposta aceita! Acordo ativo criado.',
            ]);
        } elseif ($request->acao === 'contrapor') {
            $novoValor = $request->novo_valor ?: 72.45;
            $proposta->update([
                'mensagem' => "Contraproposta: sugerido R$ {$novoValor}/mês",
            ]);
            return response()->json([
                'sucesso' => true,
                'mensagem' => "Contraproposta de R\$ {$novoValor}/mês enviada com sucesso!",
            ]);
        } else {
            $proposta->update(['status' => 'recusada']);
            return response()->json([
                'sucesso' => true,
                'mensagem' => 'Proposta recusada com diplomacia.',
            ]);
        }
    }
}

