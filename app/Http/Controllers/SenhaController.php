<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\RecuperacaoSenhaMail;

class SenhaController extends Controller
{
    /**
     * Exibe o formulário "Esqueceu sua senha?"
     */
    public function mostrarFormEsqueci()
    {
        return view('auth.esqueci-senha');
    }

    /**
     * Envia o link de recuperação por e-mail
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

        // Mesma mensagem independentemente de o e-mail existir (segurança)
        return response()->json([
            'message' => 'Se este e-mail estiver cadastrado, você receberá as instruções em breve.',
        ]);
    }

    /**
     * Exibe o formulário para redefinir a senha
     */
    public function mostrarFormReset(string $token)
    {
        return view('auth.redefinir-senha', compact('token'));
    }

    /**
     * Redefine a senha do usuário
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
