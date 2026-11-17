<?php

namespace App\Services;

use App\Models\Usuario;

/**
 * Interface AuthServiceInterface
 * Contrato de abstração para os provedores de autenticação do SEIVA (POO: Abstração e Polimorfismo).
 */
interface AuthServiceInterface
{
    /**
     * Autentica o usuário baseado nas credenciais fornecidas.
     */
    public function autenticar(array $credenciais): ?Usuario;

    /**
     * Registra um novo usuário com os dados informados.
     */
    public function registrar(array $dados): Usuario;
}
