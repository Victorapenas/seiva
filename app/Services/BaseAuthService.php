<?php

namespace App\Services;

use App\Models\Usuario;
use App\Models\Conta;
use Illuminate\Support\Facades\Auth;

/**
 * Classe Abstrata BaseAuthService
 * Contém a lógica de domínio compartilhada de persistência, inicialização de contas bancárias e gerenciamento de sessões (POO: Herança e Encapsulamento).
 */
abstract class BaseAuthService implements AuthServiceInterface
{
    /**
     * Inicializa a conta bancária padrão do usuário no sistema.
     * Encapsulamento da regra de negócio de criação de carteira financeira inicial.
     */
    protected function inicializarContaPadrao(Usuario $usuario, float $saldoInicial = 0): Conta
    {
        return Conta::create([
            'usuario_id' => $usuario->id_usuario,
            'nome' => $usuario->banco_principal ?: 'Conta Principal',
            'tipo' => 'corrente',
            'saldo' => $saldoInicial > 0 ? $saldoInicial : (float)($usuario->renda_mensal ?? 0),
            'funcao' => 'gasto',
            'cor' => '#10b981',
            'chave_pix' => $usuario->chave_pix,
        ]);
    }

    /**
     * Inicia a sessão de autenticação do usuário.
     */
    public function iniciarSessao(Usuario $usuario, bool $lembrar = true): void
    {
        Auth::login($usuario, $lembrar);
    }
}
