<?php

namespace App\Http\Controllers;

use App\Models\RegistroCaixaPreta;
use App\Models\Conta;
use App\Models\Transacao;
use App\Models\Cobranca;
use App\Models\Notificacao;
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
     * Retorna o pacote de dados completo do protótipo da Caixa Preta.
     */
    public function dadosCompletos(Request $request)
    {
        $user = Auth::user();
        if (!$user) return response()->json(['error' => 'Não autenticado'], 401);

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
            $cobranca->update([
                'valor' => $novoValor,
                'estado' => 'pendente',
                'mensagem' => 'Contraproposta: R$ ' . number_format($novoValor, 2, ',', '.'),
            ]);
            if ($solicitante) {
                Notificacao::create([
                    'usuario_id' => $solicitante->id_usuario,
                    'tipo' => 'info',
                    'titulo' => 'Nova contraproposta de ajuda',
                    'mensagem' => explode(' ', $user->nome)[0] . ' propôs ajudar com R$ ' . number_format($novoValor, 2, ',', '.'),
                    'lida' => false,
                ]);
            }
            return response()->json(['sucesso' => true, 'mensagem' => 'Contraproposta de R$ ' . number_format($novoValor, 2, ',', '.') . ' enviada!']);
        }

        if ($request->acao === 'aceitar') {
            return DB::transaction(function () use ($request, $user, $cobranca, $solicitante) {
                $cobranca->update(['estado' => 'confirmada']);

                if ($request->conta_id) {
                    $conta = Conta::where('usuario_id', $user->id_usuario)->where('id_conta', $request->conta_id)->first();
                    if ($conta) {
                        $conta->decrement('saldo', $cobranca->valor);
                    }
                }

                Transacao::create([
                    'usuario_id' => $user->id_usuario,
                    'conta_id' => $request->conta_id,
                    'titulo' => 'Ajuda para ' . ($solicitante ? explode(' ', $solicitante->nome)[0] : 'Parceiro') . ': ' . $cobranca->titulo,
                    'valor' => $cobranca->valor,
                    'tipo' => 'saida',
                    'data' => now()->format('Y-m-d'),
                    'emoji' => '🤝',
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
                    'mensagem' => 'Você ajudou com R$ ' . number_format($cobranca->valor, 2, ',', '.') . '! 🌿💚'
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
}

