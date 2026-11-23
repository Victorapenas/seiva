<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\RecuperacaoSenhaMail;

/**
 * Controller: SenhaController
 * 
 * Responsabilidade Acadêmica: Quételi Tourinho / Victor Hugo
 * Requisito Atendido: RF001 — Cadastro, Autenticação e Recuperação de Senha Segura
 * 
 * Por que fizemos assim:
 * Decidimos separar a recuperação de senha do AuthController para manter
 * o código modular e legível. Optamos por usar tokens temporários com validade de 60
 * minutos gravados na tabela `recuperacao_senha_tokens` e envio de e-mail formatado via Blade.
 * Para evitar ataques de enumeração de e-mails (segurança), a resposta da API é sempre
 * idêntica, independente de o e-mail existir ou não na base de dados.
 */
class SenhaController extends Controller
{
    /**
     * RF001: Exibe o formulário "Esqueceu sua senha?".
     * O que tentamos fazer: Renderizar a view onde o usuário digita o e-mail para receber o link.
     */
    public function mostrarFormEsqueci()
    {
        return view('auth.esqueci-senha');
    }

    /**
     * RF001: Envia o link de recuperação por e-mail.
     * O que tentamos fazer:
     * 1. Validar o e-mail informado;
     * 2. Limpar tokens anteriores daquele e-mail para evitar duplicidades;
     * 3. Gerar um token pseudo-aleatório seguro de 60 caracteres via Str::random(60);
     * 4. Enviar o e-mail com o link contendo o token;
     * 5. Retornar resposta padronizada para proteger a existência ou não da conta (LGPD).
     */
    public function enviarLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->input('email');

        $usuario = DB::table('usuarios')->where('email', $email)->first();

        if ($usuario) {
            // Remove tokens antigos para este e-mail
            DB::table('recuperacao_senha_tokens')->where('email', $email)->delete();

            // Cria novo token
            $token = Str::random(60);
            DB::table('recuperacao_senha_tokens')->insert([
                'email'     => $email,
                'token'     => $token,
                'criado_em' => now(),
            ]);

            // Envia e-mail
            $nomeUsuario = $usuario->nome ?? 'Usuário';
            Mail::to($email)->send(new RecuperacaoSenhaMail($token, $nomeUsuario));
        }

        // Mesma mensagem independentemente de o e-mail existir (segurança contra enumeração)
        return response()->json([
            'message' => 'Se este e-mail estiver cadastrado, você receberá as instruções em breve.',
        ]);
    }

    /**
     * RF001: Exibe o formulário para redefinir a senha com o token recebido.
     */
    public function mostrarFormReset(string $token)
    {
        return view('auth.redefinir-senha', compact('token'));
    }

    /**
     * RF001: Redefine a senha do usuário.
     * O que tentamos fazer:
     * 1. Validar token e nova senha;
     * 2. Checar se o token existe e tem menos de 60 minutos de emissão;
     * 3. Criptografar a nova senha com bcrypt antes de gravar na coluna senha_hash;
     * 4. Excluir o token da tabela para garantir uso único.
     */
    public function redefinirSenha(Request $request)
    {
        $request->validate([
            'token'      => 'required|string',
            'nova_senha' => 'required|string|min:4',
        ]);

        $token = $request->input('token');
        $novaSenha = $request->input('nova_senha');

        // Busca o token na tabela
        $registro = DB::table('recuperacao_senha_tokens')
            ->where('token', $token)
            ->first();

        if (!$registro) {
            return response()->json(['message' => 'Token inválido ou expirado.'], 422);
        }

        // Verifica se tem menos de 60 minutos
        $criadoEm = \Carbon\Carbon::parse($registro->criado_em);
        if ($criadoEm->diffInMinutes(now()) > 60) {
            DB::table('recuperacao_senha_tokens')->where('token', $token)->delete();
            return response()->json(['message' => 'Token inválido ou expirado.'], 422);
        }

        // Atualiza a senha do usuário (coluna senha_hash)
        DB::table('usuarios')
            ->where('email', $registro->email)
            ->update([
                'senha_hash' => bcrypt($novaSenha),
                'updated_at' => now(),
            ]);

        // Remove o token usado
        DB::table('recuperacao_senha_tokens')->where('token', $token)->delete();

        return response()->json(['message' => 'Senha redefinida com sucesso!']);
    }
}
