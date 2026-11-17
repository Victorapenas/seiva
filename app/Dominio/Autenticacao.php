<?php

namespace App\Dominio;

use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Classe: Autenticacao
 * Responsabilidade: Gerenciar regras de autenticação, login de usuários,
 * verificação de senhas com Hash e encerramento de sessões (POO).
 * 
 * Responsável Acadêmica: Quételi (RF001)
 */
class Autenticacao
{
    /** @var Usuario|null Usuário atualmente autenticado */
    private ?Usuario $usuarioLogado = null;

    /**
     * Valida credenciais e inicia a sessão de autenticação.
     * 
     * @param string $email E-mail cadastrado
     * @param string $senha Senha em texto puro
     * @param bool $lembrar Manter conectado via remember_token
     * @return Usuario
     * @throws \Exception Quando as credenciais são inválidas
     */
    public function autenticar(string $email, string $senha, bool $lembrar = true): Usuario
    {
        $usuario = Usuario::where('email', $email)->first();

        if (!$usuario || !Hash::check($senha, $usuario->senha_hash)) {
            throw new \Exception('E-mail ou senha incorretos.');
        }

        Auth::login($usuario, $lembrar);
        $this->usuarioLogado = $usuario;

        return $usuario;
    }

    /**
     * Encerra a sessão ativa do usuário.
     * 
     * @return void
     */
    public function desconectar(): void
    {
        Auth::logout();
        $this->usuarioLogado = null;
    }

    /**
     * Retorna o usuário logado no contexto da sessão.
     * 
     * @return Usuario|null
     */
    public function obterUsuarioAutenticado(): ?Usuario
    {
        return Auth::user();
    }
}
