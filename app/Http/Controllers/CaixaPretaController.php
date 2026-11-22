<?php

namespace App\Http\Controllers;

use App\Models\RegistroCaixaPreta;
use App\Models\Conta;
use App\Models\Transacao;
use App\Models\Cobranca;
use App\Models\Notificacao;
use App\Models\ProdutoWatchlist;
use App\Models\DespesaIndividual;
use App\Models\HistoricoAuditoria;
use App\Dominio\CaixaPretaIndividual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * CaixaPretaController
 * Responsável pelo controle de acesso criptográfico (PIN) e gestão da Área Privada Individual.
 * 
 * Responsável Acadêmico: Victor Hugo (RF002 - Caixa Preta, RF003 - Organização Individual)
 */
class CaixaPretaController extends Controller
{
    public function verifyPin(Request $request)
    {
        $request->validate(['pin' => 'required|string']);
        $user = Auth::user();

        $dominio = new CaixaPretaIndividual($user);
        $correto = $dominio->validarPin($request->pin);

        if ($correto) {
            session(['caixa_preta_unlocked' => true]);
            return response()->json([
                'unlocked' => true,
                'message' => 'Acesso concedido à Caixa Preta.'
            ]);
        }

        return response()->json(['unlocked' => false, 'error' => 'PIN incorreto. Tente novamente.'], 403);
    }

    /**
     * Tranca a Caixa Preta e invalida o acesso na sessão.
     */
    public function trancar(Request $request)
    {
        session()->forget('caixa_preta_unlocked');
        return response()->json([
            'unlocked' => false,
            'message' => 'Caixa Preta trancada com segurança.'
        ]);
    }

    /**
     * Retorna o pacote de dados completo do protótipo da Caixa Preta.
     */
    public function dadosCompletos(Request $request)
    {
        $user = Auth::user();
        if (!$user) return response()->json(['error' => 'Não autenticado'], 401);

        // Se a Caixa Preta estiver trancada e não foi autenticada nesta sessão, retorna 403
        if (!session('caixa_preta_unlocked', false)) {
            return response()->json(['error' => 'Caixa Preta trancada. Digite seu PIN de 4 dígitos.'], 403);
        }

        $dominio = new CaixaPretaIndividual($user);
        $lar = $user->lares()->first();
        $isCasal = !empty($lar);

        $membroParceiro = $lar ? $lar->membros()->where('usuarios.id_usuario', '!=', $user->id_usuario)->first() : null;
        $nomeParceiro = $membroParceiro ? explode(' ', $membroParceiro->nome)[0] : 'Parceiro';

        // Pedido de ajuda pendente direcionado a este usuário
        $pedidoAjuda = null;
        if ($lar) {
            $cobrancaPendente = Cobranca::where('destinatario_id', $user->id_usuario)
                ->where('lar_id', $lar->id_lar)
                ->where('estado', 'pendente')
                ->latest()
                ->first();

            if ($cobrancaPendente) {
                $solicitante = $cobrancaPendente->criador;
                $nomeSol = $solicitante ? explode(' ', $solicitante->nome)[0] : $nomeParceiro;
                $pedidoAjuda = [
                    'id_cobranca' => $cobrancaPendente->id_cobranca,
                    'solicitante' => $nomeSol,
                    'solicitante_iniciais' => $solicitante ? $solicitante->iniciais : 'IM',
                    'valor' => (float)$cobrancaPendente->valor,
                    'motivo' => $cobrancaPendente->mensagem ?: $cobrancaPendente->titulo,
                    'tag' => ($solicitante ? $solicitante->iniciais : 'IM') . ' ' . $cobrancaPendente->titulo . ' · há 20 min',
                ];
            }
        }

        $patrimonio = $dominio->calcularPatrimonio();
        $contasECartoes = $dominio->obterContasECartoes();
        $oQueVoceDeve = $dominio->obterOQueVoceDeve();
        $despesasSoSuas = $dominio->obterDespesasSoSuas();
        $metasEWishlist = $dominio->obterMetasEWishlist();
        $aReceber = $dominio->obterAReceber();
        $gastosERecebimentos = $dominio->obterGastosERecebimentosRecentes();

        return response()->json([
            'usuario' => [
                'id_usuario' => $user->id_usuario,
                'nome' => $user->nome,
                'iniciais' => $user->iniciais,
            ],
            'is_casal' => $isCasal,
            'parceiro_nome' => $nomeParceiro,
            'patrimonio' => $patrimonio,
            'pedido_ajuda' => $pedidoAjuda,
            'contas_e_cartoes' => $contasECartoes,
            'o_que_voce_deve' => $oQueVoceDeve,
            'despesas_so_suas' => $despesasSoSuas,
            'metas' => $metasEWishlist['metas'],
            'produtos_de_olho' => $metasEWishlist['produtos_de_olho'],
            'a_receber' => $aReceber,
            'gastos_recentes' => $gastosERecebimentos['gastos_recentes'],
            'o_que_entrou' => $gastosERecebimentos['entradas'],
            'total_recebido' => $gastosERecebimentos['total_recebido'],
        ]);
    }

    /**
     * Envia pedido de ajuda de custo para o parceiro no Lar.
     */
    public function pedirAjudaCusto(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0.01',
            'mensagem' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $lar = $user->lares()->first();
        if (!$lar) {
            return response()->json(['erro' => 'Você não está em um Lar compartilhado.'], 400);
        }

        $parceiro = $lar->membros()->where('usuarios.id_usuario', '!=', $user->id_usuario)->first();
        if (!$parceiro) {
            return response()->json(['erro' => 'Nenhum parceiro encontrado no Lar.'], 400);
        }

        $cobranca = Cobranca::create([
            'lar_id' => $lar->id_lar,
            'criada_por' => $user->id_usuario,
            'destinatario_id' => $parceiro->id_usuario,
            'titulo' => $request->titulo,
            'valor' => $request->valor,
            'mensagem' => $request->mensagem ?: "Pediu ajuda com {$request->titulo}",
            'estado' => 'pendente',
        ]);

        Notificacao::create([
            'usuario_id' => $parceiro->id_usuario,
            'tipo' => 'lar',
            'titulo' => explode(' ', $user->nome)[0] . ' pediu ajuda de custo',
            'mensagem' => "{$user->nome} solicitou R$ " . number_format($request->valor, 2, ',', '.') . " para {$request->titulo}",
            'lida' => false,
        ]);

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Pedido de ajuda enviado para ' . explode(' ', $parceiro->nome)[0] . '!',
            'cobranca' => $cobranca,
        ]);
    }

    /**
     * Responde a um pedido de ajuda (aceitar, contrapor ou recusar).
     */
    public function responderAjudaCusto(Request $request)
    {
        $request->validate([
            'id_cobranca' => 'required|exists:cobrancas,id_cobranca',
            'acao' => 'required|in:aceitar,contrapor,recusar',
            'valor_contraproposta' => 'nullable|numeric|min:0.01',
            'conta_id' => 'nullable|exists:contas,id_conta',
        ]);

        $user = Auth::user();
        $cobranca = Cobranca::where('id_cobranca', $request->id_cobranca)
            ->where('destinatario_id', $user->id_usuario)
            ->firstOrFail();

        $solicitante = $cobranca->criador;

        if ($request->acao === 'recusar') {
            $cobranca->delete();
            if ($solicitante) {
                Notificacao::create([
                    'usuario_id' => $solicitante->id_usuario,
                    'tipo' => 'atencao',
                    'titulo' => 'Pedido de ajuda não aceito',
                    'mensagem' => explode(' ', $user->nome)[0] . ' não pôde ajudar com ' . $cobranca->titulo . ' agora.',
                    'lida' => false,
                ]);
            }
            return response()->json(['sucesso' => true, 'mensagem' => 'Pedido de ajuda recusado cordialmente.']);
        }

        if ($request->acao === 'contrapor') {
            $novoValor = (float)($request->valor_contraproposta ?: ($cobranca->valor / 2));
            $mensagemContra = $request->mensagem_contraproposta ? "Contraproposta: R$ " . number_format($novoValor, 2, ',', '.') . " (" . $request->mensagem_contraproposta . ")" : "Contraproposta: R$ " . number_format($novoValor, 2, ',', '.');
            $cobranca->update([
                'valor' => $novoValor,
                'estado' => 'pendente',
                'mensagem' => $mensagemContra,
            ]);
            if ($solicitante) {
                Notificacao::create([
                    'usuario_id' => $solicitante->id_usuario,
                    'tipo' => 'info',
                    'titulo' => 'Nova contraproposta de ajuda',
                    'mensagem' => explode(' ', $user->nome)[0] . ' propôs ajudar com R$ ' . number_format($novoValor, 2, ',', '.') . ($request->mensagem_contraproposta ? ": \"{$request->mensagem_contraproposta}\"" : ''),
                    'lida' => false,
                ]);
            }
            return response()->json(['sucesso' => true, 'mensagem' => 'Contraproposta de R$ ' . number_format($novoValor, 2, ',', '.') . ' enviada!']);
        }

        if ($request->acao === 'aceitar') {
            return DB::transaction(function () use ($request, $user, $cobranca, $solicitante) {
                $cobranca->update(['estado' => 'confirmada']);

                $contaId = $request->conta_id;
                if (!$contaId) {
                    $primeiraConta = Conta::where('usuario_id', $user->id_usuario)->first();
                    $contaId = $primeiraConta ? $primeiraConta->id_conta : null;
                }

                if ($contaId) {
                    $conta = Conta::where('usuario_id', $user->id_usuario)->where('id_conta', $contaId)->first();
                    if ($conta) {
                        $conta->decrement('saldo', $cobranca->valor);
                    }
                }

                Transacao::create([
                    'usuario_id' => $user->id_usuario,
                    'conta_id' => $contaId,
                    'titulo' => 'Ajuda para ' . ($solicitante ? explode(' ', $solicitante->nome)[0] : 'Parceiro') . ': ' . $cobranca->titulo,
                    'valor' => $cobranca->valor,
                    'tipo' => 'saida',
                    'data' => now()->format('Y-m-d'),
                    'emoji' => 'heart-handshake',
                    'visibilidade' => 'compartilhado',
                ]);

                if ($solicitante) {
                    Notificacao::create([
                        'usuario_id' => $solicitante->id_usuario,
                        'tipo' => 'sucesso',
                        'titulo' => 'Ajuda confirmada!',
                        'mensagem' => explode(' ', $user->nome)[0] . ' confirmou o envio de R$ ' . number_format($cobranca->valor, 2, ',', '.') . '!',
                        'lida' => false,
                    ]);
                }

                return response()->json([
                    'sucesso' => true,
                    'mensagem' => 'Você ajudou com R$ ' . number_format($cobranca->valor, 2, ',', '.') . '!'
                ]);
            });
        }
    }

    public function index()
    {
        $userId = Auth::id();
        $registros = RegistroCaixaPreta::where('usuario_id', $userId)
            ->orderBy('data', 'desc')
            ->get();

        $totalOculto = $registros->sum(function($r) {
            return (float) $r->valor_cifrado;
        });

        return response()->json([
            'registros' => $registros,
            'total_oculto' => $totalOculto,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0.01',
            'conta' => 'nullable|string',
            'data' => 'nullable|date',
        ]);

        $registro = RegistroCaixaPreta::create([
            'usuario_id' => Auth::id(),
            'titulo_cifrado' => $request->titulo,
            'valor_cifrado' => (string)$request->valor,
            'conta_cifrada' => $request->conta ?? 'Reserva Segreta',
            'data' => $request->data ?? now()->format('Y-m-d'),
            'bloqueado' => true,
        ]);

        return response()->json($registro, 201);
    }

    public function destroy($id)
    {
        $registro = RegistroCaixaPreta::where('usuario_id', Auth::id())
            ->where('id_registro_caixa_preta', $id)
            ->firstOrFail();

        $registro->delete();
        return response()->json(['message' => 'Registro excluído com segurança.']);
    }

    /**
     * Confirma o recebimento de uma ajuda financeira ou valor a receber do parceiro.
     */
    public function confirmarRecebimento(Request $request)
    {
        $user = Auth::user();
        if (!$user) return response()->json(['error' => 'Não autenticado'], 401);

        $lar = $user->lares()->first();
        $parceiro = $lar ? $lar->membros()->where('usuarios.id_usuario', '!=', $user->id_usuario)->first() : null;
        $nomeParceiro = $parceiro ? explode(' ', $parceiro->nome)[0] : 'Parceiro';

        $idItem = $request->input('id');
        $valor = (float)($request->input('valor') ?: 156.40);
        $contaId = $request->input('conta_id');

        // Busca primeira conta do usuário caso não especificada
        if (!$contaId) {
            $conta = Conta::where('usuario_id', $user->id_usuario)->first();
            $contaId = $conta ? $conta->id_conta : null;
        } else {
            $conta = Conta::where('usuario_id', $user->id_usuario)->where('id_conta', $contaId)->first();
        }

        // Credita valor na conta
        if ($conta) {
            $conta->increment('saldo', $valor);
        }

        // Registra transação de entrada
        Transacao::create([
            'usuario_id' => $user->id_usuario,
            'conta_id' => $contaId,
            'titulo' => "Ajuda recebida de {$nomeParceiro}",
            'valor' => $valor,
            'tipo' => 'entrada',
            'data' => now()->format('Y-m-d'),
            'emoji' => 'hand-coins',
            'visibilidade' => 'privado',
        ]);

        // Notifica o parceiro confirmando
        if ($parceiro) {
            Notificacao::create([
                'usuario_id' => $parceiro->id_usuario,
                'tipo' => 'sucesso',
                'titulo' => 'Recebimento confirmado!',
                'mensagem' => explode(' ', $user->nome)[0] . " confirmou que o valor de R$ " . number_format($valor, 2, ',', '.') . " caiu na conta com sucesso.",
                'lida' => false,
            ]);
        }

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Recebimento confirmado com sucesso! R$ ' . number_format($valor, 2, ',', '.') . ' creditado na sua conta.',
        ]);
    }

    /**
     * Registra que o usuário NÃO recebeu o valor do parceiro (Disputa / Cobrança de comprovante).
     */
    public function disputarRecebimento(Request $request)
    {
        $user = Auth::user();
        if (!$user) return response()->json(['error' => 'Não autenticado'], 401);

        $request->validate([
            'motivo' => 'nullable|string|max:500',
            'valor' => 'nullable|numeric',
        ]);

        $lar = $user->lares()->first();
        $parceiro = $lar ? $lar->membros()->where('usuarios.id_usuario', '!=', $user->id_usuario)->first() : null;

        $motivo = $request->input('motivo') ?: 'Valor não identificado no extrato.';
        $valorStr = $request->input('valor') ? ' (R$ ' . number_format((float)$request->valor, 2, ',', '.') . ')' : '';

        if ($parceiro) {
            Notificacao::create([
                'usuario_id' => $parceiro->id_usuario,
                'tipo' => 'atencao',
                'titulo' => 'Valor não recebido · Verifique o comprovante',
                'mensagem' => explode(' ', $user->nome)[0] . " informou que NÃO recebeu o valor{$valorStr}. Motivo: \"{$motivo}\". Por favor, confira seu extrato ou envie o comprovante do PIX.",
                'lida' => false,
            ]);
        }

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Aviso enviado para ' . ($parceiro ? explode(' ', $parceiro->nome)[0] : 'seu parceiro') . '! Uma solicitação de conferência foi registrada.',
        ]);
    }

    /**
     * Salva um novo produto monitorado (Produtos de Olho / Wishlist).
     */
    public function adicionarProdutoWatchlist(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0.01',
            'loja' => 'nullable|string|max:100',
            'link' => 'nullable|string|max:1000',
            'imagem' => 'nullable|string|max:1000',
            'tipo' => 'nullable|string|in:individual,lar',
        ]);

        $user = Auth::user();
        $lar = $user->lares()->first();
        $tipo = $request->tipo === 'lar' && $lar ? 'lar' : 'individual';
        $larId = $tipo === 'lar' && $lar ? $lar->id_lar : null;

        $produto = ProdutoWatchlist::create([
            'usuario_id' => $user->id_usuario,
            'lar_id' => $larId,
            'tipo' => $tipo,
            'nome' => $request->nome,
            'preco_alvo' => $request->preco,
            'loja' => $request->loja ?: 'Loja online',
            'link_referencia' => $request->link,
            'imagem' => $request->imagem ?: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=120&auto=format&fit=crop&q=60',
            'emoji' => $tipo === 'lar' ? 'home' : 'shopping-bag',
        ]);

        $destinatarioTexto = $tipo === 'lar' ? 'para nossa casa' : 'para você';

        return response()->json([
            'sucesso' => true,
            'mensagem' => "\"{$produto->nome}\" colocado na mira {$destinatarioTexto}!",
            'produto' => $produto,
        ], 201);
    }

    /**
     * Remove um produto monitorado da Wishlist.
     */
    public function removerProdutoWatchlist($id)
    {
        $user = Auth::user();
        $produto = ProdutoWatchlist::where('usuario_id', $user->id_usuario)
            ->where('id_produto', $id)
            ->first();

        if ($produto) {
            $produto->delete();
        }

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Produto removido dos seus Produtos de Olho.',
        ]);
    }

    /**
     * Cadastra uma nova Despesa Fixa Individual na Caixa Preta.
     */
    public function criarDespesaIndividual(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0.01',
            'dia_vencimento' => 'nullable|integer|between:1,31',
            'icone' => 'nullable|string|max:50',
            'detalhe' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        $despesa = DespesaIndividual::create([
            'usuario_id' => $user->id_usuario,
            'titulo' => $request->titulo,
            'valor' => $request->valor,
            'dia_vencimento' => $request->dia_vencimento ?: 10,
            'icone' => $request->icone ?: 'receipt',
            'detalhe' => $request->detalhe,
            'status' => 'pendente',
            'recorrente' => true,
        ]);

        HistoricoAuditoria::create([
            'usuario_id' => $user->id_usuario,
            'entidade_tipo' => 'despesa_individual',
            'entidade_id' => $despesa->id_despesa_individual,
            'acao' => 'criacao',
            'descricao' => "Cadastrou despesa fixa pessoal \"{$despesa->titulo}\" no valor de R$ " . number_format($despesa->valor, 2, ',', '.'),
            'dados_novos' => $despesa->toArray(),
        ]);

        return response()->json([
            'sucesso' => true,
            'mensagem' => "Despesa fixa pessoal \"{$despesa->titulo}\" cadastrada com sucesso!",
            'despesa' => $despesa,
        ], 201);
    }

    /**
     * Atualiza uma Despesa Fixa Individual existente.
     */
    public function atualizarDespesaIndividual(Request $request, $id)
    {
        $user = Auth::user();
        $despesa = DespesaIndividual::where('usuario_id', $user->id_usuario)
            ->where('id_despesa_individual', $id)
            ->firstOrFail();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0.01',
            'dia_vencimento' => 'nullable|integer|between:1,31',
            'icone' => 'nullable|string|max:50',
            'detalhe' => 'nullable|string|max:255',
        ]);

        $dadosAntigos = $despesa->toArray();

        $despesa->update([
            'titulo' => $request->titulo,
            'valor' => $request->valor,
            'dia_vencimento' => $request->dia_vencimento ?: $despesa->dia_vencimento,
            'icone' => $request->icone ?: $despesa->icone,
            'detalhe' => $request->detalhe,
        ]);

        HistoricoAuditoria::create([
            'usuario_id' => $user->id_usuario,
            'entidade_tipo' => 'despesa_individual',
            'entidade_id' => $despesa->id_despesa_individual,
            'acao' => 'edicao',
            'descricao' => "Atualizou despesa fixa pessoal \"{$despesa->titulo}\" para R$ " . number_format($despesa->valor, 2, ',', '.'),
            'dados_anteriores' => $dadosAntigos,
            'dados_novos' => $despesa->toArray(),
        ]);

        return response()->json([
            'sucesso' => true,
            'mensagem' => "Despesa fixa \"{$despesa->titulo}\" atualizada com sucesso!",
            'despesa' => $despesa,
        ]);
    }

    /**
     * Remove uma Despesa Fixa Individual com registro formal de auditoria.
     */
    public function removerDespesaIndividual($id)
    {
        $user = Auth::user();
        $despesa = DespesaIndividual::where('usuario_id', $user->id_usuario)
            ->where('id_despesa_individual', $id)
            ->firstOrFail();

        $dadosAntigos = $despesa->toArray();
        $despesa->delete();

        HistoricoAuditoria::create([
            'usuario_id' => $user->id_usuario,
            'entidade_tipo' => 'despesa_individual',
            'entidade_id' => $id,
            'acao' => 'exclusao',
            'descricao' => "Excluiu a despesa fixa pessoal \"{$dadosAntigos['titulo']}\"",
            'dados_anteriores' => $dadosAntigos,
        ]);

        return response()->json([
            'sucesso' => true,
            'mensagem' => "Despesa fixa pessoal \"{$dadosAntigos['titulo']}\" removida com sucesso!",
        ]);
    }

    /**
     * Quita / Paga uma Despesa Fixa Individual com débito em conta e lançamento no extrato.
     */
    public function quitarDespesaIndividual(Request $request, $id)
    {
        $request->validate([
            'conta_id' => 'required|exists:contas,id_conta',
        ]);

        $user = Auth::user();
        $despesa = DespesaIndividual::where('usuario_id', $user->id_usuario)
            ->where('id_despesa_individual', $id)
            ->firstOrFail();

        $conta = Conta::where('id_conta', $request->conta_id)
            ->where('usuario_id', $user->id_usuario)
            ->firstOrFail();

        DB::transaction(function () use ($despesa, $conta, $user) {
            // Debita da conta bancária
            $conta->saldo -= $despesa->valor;
            $conta->save();

            // Registra a transação de pagamento
            Transacao::create([
                'usuario_id' => $user->id_usuario,
                'conta_id' => $conta->id_conta,
                'titulo' => "Pagamento: {$despesa->titulo}",
                'valor' => $despesa->valor,
                'tipo' => 'saida',
                'data' => now()->format('Y-m-d'),
                'visibilidade' => 'privado',
                'pago' => true,
            ]);

            // Marca a despesa como quitada
            $despesa->status = 'pago';
            $despesa->pago_em = now()->format('Y-m-d');
            $despesa->save();

            HistoricoAuditoria::create([
                'usuario_id' => $user->id_usuario,
                'entidade_tipo' => 'despesa_individual',
                'entidade_id' => $despesa->id_despesa_individual,
                'acao' => 'quitacao',
                'descricao' => "Quitou a despesa fixa \"{$despesa->titulo}\" (R$ " . number_format($despesa->valor, 2, ',', '.') . ") na conta {$conta->nome}",
                'dados_novos' => [
                    'despesa_id' => $despesa->id_despesa_individual,
                    'conta_id' => $conta->id_conta,
                    'valor_pago' => (float)$despesa->valor,
                    'novo_saldo_conta' => (float)$conta->saldo,
                ],
            ]);
        });

        return response()->json([
            'sucesso' => true,
            'mensagem' => "Despesa \"{$despesa->titulo}\" quitada com sucesso na conta {$conta->nome}!",
            'despesa' => $despesa->fresh(),
            'novo_saldo_conta' => (float)$conta->fresh()->saldo,
        ]);
    }
}

