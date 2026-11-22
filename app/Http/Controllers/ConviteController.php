<?php

namespace App\Http\Controllers;

use App\Models\ConviteLar;
use App\Models\Lar;
use App\Models\LarMembro;
use App\Models\Notificacao;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ConviteController extends Controller
{
    /**
     * Enviar convite para formar Lar conjunto
     */
    public function convidar(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Não autenticado'], 401);
        }

        $request->validate([
            'email_convidado' => 'required|email|max:255',
            'nome_lar'        => 'nullable|string|max:100',
        ]);

        $emailConvidado = strtolower(trim($request->email_convidado));

        if ($emailConvidado === strtolower($user->email)) {
            return response()->json(['error' => 'Você não pode convidar o seu próprio e-mail.'], 422);
        }

        // 1. Garantir que o remetente tenha um Lar para convidar
        $lar = $user->lares()->first();
        if (!$lar) {
            $nomeLarPadrao = $request->filled('nome_lar') 
                ? trim($request->nome_lar) 
                : 'Nosso Cantinho (' . explode(' ', $user->nome)[0] . ')';

            $lar = Lar::create([
                'nome'       => $nomeLarPadrao,
                'emoji'      => 'home',
                'criado_por' => $user->id_usuario,
            ]);

            LarMembro::create([
                'lar_id'                  => $lar->id_lar,
                'usuario_id'              => $user->id_usuario,
                'papel'                   => 'administrador',
                'renda_declarada'         => (float)($user->renda_mensal ?? 0),
                'percentual_contribuicao' => 50,
                'aceito_em'               => now(),
            ]);
        }

        // 2. Gerar token seguro de convite
        $token = Str::random(48);

        $convite = ConviteLar::create([
            'lar_id'          => $lar->id_lar,
            'convidado_por'   => $user->id_usuario,
            'email_convidado' => $emailConvidado,
            'token_convite'   => $token,
            'status'          => 'pendente',
            'expira_em'       => Carbon::now()->addDays(7),
        ]);

        // 3. Notificar o próprio usuário
        Notificacao::create([
            'usuario_id' => $user->id_usuario,
            'titulo'     => 'Convite do Lar Gerado 💌',
            'mensagem'   => "Convite para {$emailConvidado} gerado com sucesso. Compartilhe o link de acesso.",
            'tipo'       => 'lar',
            'lida'       => false,
        ]);

        // 4. Se o usuário convidado já possuir conta no SEIVA, notificá-lo imediatamente
        $usuarioAlvo = Usuario::where('email', $emailConvidado)->first();
        if ($usuarioAlvo) {
            Notificacao::create([
                'usuario_id' => $usuarioAlvo->id_usuario,
                'titulo'     => 'Convite para Formar Lar 🏡',
                'mensagem'   => "{$user->nome} convidou você para o Lar '{$lar->nome}'. Acesse seu perfil para aceitar.",
                'tipo'       => 'lar',
                'lida'       => false,
            ]);
        }

        $linkConvite = url('/convite/' . $token);

        return response()->json([
            'sucesso'      => true,
            'mensagem'     => "Convite gerado com sucesso para {$emailConvidado}!",
            'link_convite' => $linkConvite,
            'token'        => $token,
            'lar'          => [
                'id_lar' => $lar->id_lar,
                'nome'   => $lar->nome,
            ],
            'convite'      => $convite,
        ]);
    }

    /**
     * Listar convites enviados e recebidos pelo usuário autenticado
     */
    public function listarConvites()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Não autenticado'], 401);
        }

        $enviados = ConviteLar::with(['lar'])
            ->where('convidado_por', $user->id_usuario)
            ->orderBy('id_convite_lar', 'desc')
            ->get();

        $recebidos = ConviteLar::with(['lar', 'remetente'])
            ->where('email_convidado', strtolower($user->email))
            ->where('status', 'pendente')
            ->where('expira_em', '>', now())
            ->orderBy('id_convite_lar', 'desc')
            ->get();

        return response()->json([
            'enviados'  => $enviados,
            'recebidos' => $recebidos,
        ]);
    }

    /**
     * Obter detalhes do convite por token (público ou autenticado)
     */
    public function visualizar($token)
    {
        $convite = ConviteLar::with(['lar', 'remetente'])
            ->where('token_convite', $token)
            ->first();

        if (!$convite) {
            return response()->json(['error' => 'Convite não encontrado.'], 404);
        }

        $expirado = $convite->expira_em && $convite->expira_em->isPast();

        return response()->json([
            'valido'          => ($convite->status === 'pendente' && !$expirado),
            'status'          => $convite->status,
            'expirado'        => $expirado,
            'email_convidado' => $convite->email_convidado,
            'remetente'       => [
                'nome'  => $convite->remetente ? $convite->remetente->nome : 'Parceiro',
                'email' => $convite->remetente ? $convite->remetente->email : '',
            ],
            'lar'             => [
                'id_lar' => $convite->lar ? $convite->lar->id_lar : null,
                'nome'   => $convite->lar ? $convite->lar->nome : 'Nosso Cantinho',
            ],
            'token'           => $token,
        ]);
    }

    /**
     * Aceitar convite para o Lar
     */
    public function aceitar(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Faça login para aceitar o convite.'], 401);
        }

        $request->validate([
            'token' => 'required|string',
        ]);

        $convite = ConviteLar::with(['lar', 'remetente'])
            ->where('token_convite', $request->token)
            ->first();

        if (!$convite) {
            return response()->json(['error' => 'Convite inválido ou expirado.'], 404);
        }

        if ($convite->status === 'aceito') {
            return response()->json(['error' => 'Este convite já foi aceito anteriormente.'], 400);
        }

        if ($convite->expira_em && $convite->expira_em->isPast()) {
            return response()->json(['error' => 'Este convite expirou.'], 400);
        }

        if ($convite->convidado_por == $user->id_usuario) {
            return response()->json(['error' => 'Você não pode aceitar um convite enviado por você mesmo.'], 400);
        }

        $lar = $convite->lar;
        if (!$lar) {
            return response()->json(['error' => 'Lar vinculado não encontrado.'], 404);
        }

        // Vincular usuário ao lar se ainda não for membro
        $membroExistente = LarMembro::where('lar_id', $lar->id_lar)
            ->where('usuario_id', $user->id_usuario)
            ->first();

        if (!$membroExistente) {
            LarMembro::create([
                'lar_id'                  => $lar->id_lar,
                'usuario_id'              => $user->id_usuario,
                'papel'                   => 'membro',
                'renda_declarada'         => (float)($user->renda_mensal ?? 0),
                'percentual_contribuicao' => 50,
                'aceito_em'               => now(),
            ]);
        }

        // Atualizar status do convite
        $convite->update(['status' => 'aceito']);

        // Notificar remetente
        Notificacao::create([
            'usuario_id' => $convite->convidado_por,
            'titulo'     => 'Convite Aceito! 🏡❤️',
            'mensagem'   => "{$user->nome} aceitou seu convite! Agora vocês formam o Lar '{$lar->nome}'.",
            'tipo'       => 'lar',
            'lida'       => false,
        ]);

        // Notificar convidado
        Notificacao::create([
            'usuario_id' => $user->id_usuario,
            'titulo'     => 'Você entrou no Lar! 🌿',
            'mensagem'   => "Você agora faz parte do Lar '{$lar->nome}'. Sua Caixa Preta permanece 100% protegida.",
            'tipo'       => 'lar',
            'lida'       => false,
        ]);

        return response()->json([
            'sucesso'  => true,
            'mensagem' => "Parabéns! Você e {$convite->remetente->nome} agora compartilham o Lar '{$lar->nome}'.",
            'lar'      => [
                'id_lar' => $lar->id_lar,
                'nome'   => $lar->nome,
            ],
        ]);
    }

    /**
     * Recusar convite
     */
    public function recusar(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Não autenticado'], 401);
        }

        $request->validate([
            'token' => 'required|string',
        ]);

        $convite = ConviteLar::where('token_convite', $request->token)->first();
        if (!$convite) {
            return response()->json(['error' => 'Convite não encontrado.'], 404);
        }

        $convite->update(['status' => 'expirado']);

        return response()->json([
            'sucesso'  => true,
            'mensagem' => 'Convite recusado.',
        ]);
    }
}
