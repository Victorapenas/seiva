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

        $membrosLar = $lar->membros()->get();
        $parceiro = $membrosLar->where('id_usuario', '!=', $user->id_usuario)->first();
        $parceiroNome = $parceiro ? explode(' ', $parceiro->nome)[0] : 'Parceiro(a)';

        $dbNegociacoes = [];
        foreach ($propostasDb->where('status', 'pendente') as $p) {
            $isMeta = in_array($p->tipo, ['meta', 'poupar_juntos']);
            $mensalCada = (float)($p->valor_mes_por_pessoa > 0 ? $p->valor_mes_por_pessoa : ($p->valor_total > 0 ? $p->valor_total / 4 : 0));
            $ehAutor = ($p->autor_id === $user->id_usuario);
            $nomeAutor = $p->autor ? $p->autor->nome : ($ehAutor ? 'Você' : $parceiroNome);

            $dbNegociacoes[] = [
                'id_proposta' => $p->id_proposta,
                'titulo' => $p->titulo,
                'tipo' => $isMeta ? 'poupar_juntos' : 'divida_dividida',
                'tipo_label' => $isMeta ? 'Poupar juntos' : 'Dívida dividida',
                'autor_id' => $p->autor_id,
                'eh_autor' => $ehAutor,
                'autor_nome' => $nomeAutor,
                'tempo_atras' => $p->created_at ? $p->created_at->diffForHumans() : 'recente',
                'link' => $p->link ?? '',
                'imagem' => $p->imagem ?? ($isMeta ? 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=200&auto=format&fit=crop&q=80' : 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=200&auto=format&fit=crop&q=80'),
                'valor_total' => (float)$p->valor_total,
                'valor_mensal_cada' => $mensalCada,
                'prazo_texto' => $p->prazo_texto ?: '~4 meses para juntar',
                'mensagem' => $p->descricao ?: ($p->mensagem ?: "Proposta: {$p->titulo}"),
                'ian_proposta' => 'R$ ' . number_format($mensalCada > 0 ? $mensalCada : $p->valor_total / 2, 2, ',', '.') . '/mês',
                'proposta_rotulo' => 'R$ ' . number_format($mensalCada > 0 ? $mensalCada : $p->valor_total / 2, 2, ',', '.') . '/mês',
                'divisao' => $p->divisao ?: '50/50',
                'status' => 'pendente',
            ];
        }

        $poupandoJuntos = [];
        $dividasDivididas = [];

        foreach ($acordosDb->where('status', 'ativo') as $ac) {
            $isMeta = in_array($ac->tipo, ['meta', 'poupar_juntos']);
            if ($isMeta) {
                $poupandoJuntos[] = [
                    'id_acordo' => $ac->id_acordo,
                    'titulo' => $ac->titulo,
                    'imagem' => $ac->imagem ?: 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=600&auto=format&fit=crop&q=80',
                    'valor_total' => (float)$ac->valor_total,
                    'valor_mensal_juntos' => (float)($ac->valor_mensal ?: 400),
                    'valor_guardado' => (float)$ac->valor_arrecadado,
                    'progresso_pct' => $ac->progresso,
                    'maria_mes' => (float)($ac->valor_mensal ? $ac->valor_mensal / 2 : 200),
                    'ian_mes' => (float)($ac->valor_mensal ? $ac->valor_mensal / 2 : 200),
                    'divisao_rotulo' => "Divisão " . ($ac->divisao ?: '50/50'),
                    'lembrete_rotulo' => 'Lembrete flexível · todo dia 10',
                    'destino_rotulo' => $ac->conta_destino ?: 'Poupança Caixa (conjunta)',
                    'banner_info' => 'Meta compartilhada acordada na Mesa de Acordos.',
                    'cobrador_rotulo' => 'Lembrete gentil todo mês.',
                    'badge' => 'Acordo ativo',
                    'expandido' => false,
                ];
            } else {
                $dividasDivididas[] = [
                    'id_acordo' => $ac->id_acordo,
                    'titulo' => $ac->titulo,
                    'valor_total' => (float)$ac->valor_total,
                    'valor_mensal_juntos' => (float)($ac->valor_mensal ?: 500),
                    'parcelas_pagas' => $ac->parcelas_pagas ?: 0,
                    'parcelas_total' => $ac->parcelas_total ?: 8,
                    'parcelas_rotulo' => ($ac->parcelas_pagas ?: 0) . '/' . ($ac->parcelas_total ?: 8) . ' pagas',
                    'status' => 'ativo',
                ];
            }
        }

        return response()->json([
            'acordos' => $acordosDb,
            'propostas' => $propostasDb,
            'negociacoes_em_aberto' => array_values($dbNegociacoes),
            'poupando_juntos' => array_values($poupandoJuntos),
            'dividas_divididas' => array_values($dividasDivididas),
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
            'valor_mensal' => 'nullable|numeric',
            'tipo' => 'nullable|string',
            'proposta_texto' => 'nullable|string',
            'descricao' => 'nullable|string',
            'divisao' => 'nullable|string',
            'divisao_sugerida' => 'nullable|string',
            'link_produto' => 'nullable|string',
        ]);

        $user = Auth::user();
        $lar = $user->lares()->firstOrFail();

        $valorTotal = $request->valor_total ?? $request->valor ?? 0;
        $descricao = $request->descricao ?? $request->proposta_texto ?? '';
        $divisao = $request->divisao ?? $request->divisao_sugerida ?? '50/50';
        $tipo = in_array($request->tipo, ['poupar_juntos', 'meta']) ? 'meta' : 'divida';
        $valorMensal = $request->valor_mensal ?? ($valorTotal > 0 ? $valorTotal / 4 : 0);
        $link = $request->link_produto ?? $request->link;

        $proposta = Proposta::create([
            'lar_id' => $lar->id_lar,
            'autor_id' => $user->id_usuario,
            'tipo' => $tipo,
            'titulo' => $request->titulo,
            'descricao' => $descricao,
            'mensagem' => $descricao,
            'valor_total' => $valorTotal,
            'divisao' => $divisao,
            'valor_mes_por_pessoa' => $valorMensal,
            'link' => $link,
            'status' => 'pendente',
        ]);

        // Gera notificação diplomática para o parceiro no lar
        $parceiro = $lar->membros()->where('usuarios.id_usuario', '!=', $user->id_usuario)->first();
        if ($parceiro) {
            \App\Models\Notificacao::create([
                'usuario_id' => $parceiro->id_usuario,
                'lar_id' => $lar->id_lar,
                'titulo' => 'Nova proposta na Mesa de Acordos',
                'mensagem' => "{$user->nome} propôs: {$request->titulo} (Divisão {$divisao})",
                'tipo' => 'lar',
                'lida' => false,
                'tempo' => 'Agora',
            ]);
        }

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

        $autor = \App\Models\Usuario::find($proposta->autor_id);

        if ($request->acao === 'aceitar') {
            $proposta->update(['status' => 'aceita']);
            $acordoCriado = Acordo::create([
                'lar_id' => $proposta->lar_id,
                'criado_por' => $proposta->autor_id,
                'titulo' => $proposta->titulo,
                'tipo' => $proposta->tipo ?: 'meta',
                'valor_total' => $proposta->valor_total,
                'divisao' => $proposta->divisao ?: '50/50',
                'status' => 'ativo',
            ]);

            if ($autor && $autor->id_usuario !== $user->id_usuario) {
                \App\Models\Notificacao::create([
                    'usuario_id' => $autor->id_usuario,
                    'lar_id' => $proposta->lar_id,
                    'titulo' => 'Proposta Aceita!',
                    'mensagem' => "{$user->nome} aceitou sua proposta de {$proposta->titulo}. O acordo já está ativo no Lar!",
                    'tipo' => 'lar',
                    'lida' => false,
                    'tempo' => 'Agora',
                ]);
            }

            return response()->json([
                'sucesso' => true,
                'mensagem' => 'Proposta aceita! Acordo ativo criado e notificação enviada ao parceiro.',
                'acordo' => $acordoCriado,
            ]);
        } elseif ($request->acao === 'contrapor') {
            $novoValor = $request->novo_valor ?: 72.45;
            $proposta->update([
                'mensagem' => "Contraproposta: sugerido R$ {$novoValor}/mês",
            ]);

            if ($autor && $autor->id_usuario !== $user->id_usuario) {
                \App\Models\Notificacao::create([
                    'usuario_id' => $autor->id_usuario,
                    'lar_id' => $proposta->lar_id,
                    'titulo' => 'Contraproposta Recebida',
                    'mensagem' => "{$user->nome} propôs um novo valor de R$ " . number_format($novoValor, 2, ',', '.') . "/mês para {$proposta->titulo}.",
                    'tipo' => 'lar',
                    'lida' => false,
                    'tempo' => 'Agora',
                ]);
            }

            return response()->json([
                'sucesso' => true,
                'mensagem' => "Contraproposta de R\$ {$novoValor}/mês enviada com sucesso ao parceiro!",
            ]);
        } else {
            $proposta->update(['status' => 'recusada']);

            if ($autor && $autor->id_usuario !== $user->id_usuario) {
                \App\Models\Notificacao::create([
                    'usuario_id' => $autor->id_usuario,
                    'lar_id' => $proposta->lar_id,
                    'titulo' => 'Proposta Recusada com Diplomacia',
                    'mensagem' => "{$user->nome} não pôde assumir o compromisso de {$proposta->titulo} neste momento.",
                    'tipo' => 'lar',
                    'lida' => false,
                    'tempo' => 'Agora',
                ]);
            }

            return response()->json([
                'sucesso' => true,
                'mensagem' => 'Proposta recusada com diplomacia e autor notificado.',
            ]);
        }
    }
}

