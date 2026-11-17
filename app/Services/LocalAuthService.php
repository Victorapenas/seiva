<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

/**
 * Classe LocalAuthService
 * Implementa a estratégia de autenticação e registro nativo por formulário (POO: Herança e Especialização).
 */
class LocalAuthService extends BaseAuthService
{
    /**
     * Autentica usuário local verificando e-mail e hash da senha.
     */
    public function autenticar(array $credenciais): ?Usuario
    {
        $email = $credenciais['email'] ?? '';
        $senha = $credenciais['senha'] ?? '';
        $lembrar = !empty($credenciais['lembrar']);

        $usuario = Usuario::where('email', $email)->first();

        if (!$usuario || !Hash::check($senha, $usuario->senha_hash)) {
            return null;
        }

        $this->iniciarSessao($usuario, $lembrar);
        return $usuario;
    }

    /**
     * Registra novo usuário no banco de dados e cria a conta corrente inicial.
     */
    public function registrar(array $dados): Usuario
    {
        $usuario = Usuario::create([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'telefone' => $dados['telefone'] ?? null,
            'senha_hash' => Hash::make($dados['senha']),
            'pin_caixa_preta' => !empty($dados['pin_caixa_preta']) ? $dados['pin_caixa_preta'] : '1234',
            'tipo_renda' => $dados['tipo_renda'] ?? 'clt',
            'renda_mensal' => (float)($dados['renda_mensal'] ?? 0),
            'dia_recebimento' => (int)($dados['dia_recebimento'] ?? 5),
            'tem_renda_extra' => !empty($dados['renda_extra']),
            'renda_extra' => (float)($dados['renda_extra'] ?? 0),
            'banco_principal' => $dados['banco_principal'] ?? 'Banco Principal',
            'chave_pix' => !empty($dados['chave_pix']) ? $dados['chave_pix'] : $dados['email'],
        ]);

        $saldoInicial = isset($dados['saldo_inicial']) && $dados['saldo_inicial'] !== ''
            ? (float)$dados['saldo_inicial']
            : (float)$usuario->renda_mensal;

        $this->inicializarContaPadrao($usuario, $saldoInicial);
        $this->iniciarSessao($usuario, true);

        return $usuario;
    }
}
