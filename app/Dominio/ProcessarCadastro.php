<?php

namespace App\Dominio;

use App\Models\Usuario;
use App\Models\Conta;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

/**
 * Classe: ProcessarCadastro
 * Responsabilidade: Encapsular a lógica de criação de contas de usuários,
 * configuração inicial de renda, conta financeira e PIN da Caixa Preta.
 * 
 * Responsável Acadêmica: Quételi (RF001)
 */
class ProcessarCadastro
{
    /**
     * Processa os dados cadastrais enviados pelo formulário de onboarding.
     * 
     * @param array $dados Array associativo contendo os campos do formulário (compatível com extract($_POST))
     * @return Usuario
     * @throws \Exception Em caso de dados inválidos ou e-mail duplicado
     */
    public function registrar(array $dados): Usuario
    {
        // Aplicação do método extract com EXTR_SKIP para conformidade didática com a disciplina
        extract($dados, EXTR_SKIP);

        $nome = $nome ?? null;
        $email = $email ?? null;
        $senha = $senha ?? null;
        $telefone = $telefone ?? null;
        $tipo_renda = $tipo_renda ?? 'clt';
        $renda_mensal = $renda_mensal ?? 0.00;
        $dia_recebimento = $dia_recebimento ?? 5;
        $renda_extra = $renda_extra ?? 0.00;
        $banco_principal = $banco_principal ?? 'Nubank';
        $saldo_inicial = $saldo_inicial ?? null;
        $chave_pix = $chave_pix ?? null;
        $pin_caixa_preta = $pin_caixa_preta ?? '1234';

        if (!$nome || !$email || !$senha) {
            throw new \Exception('Os campos Nome, E-mail e Senha são obrigatórios.');
        }

        if (Usuario::where('email', $email)->exists()) {
            throw new \Exception('Este e-mail já está em uso.');
        }

        // Cria o registro com senha e PIN protegidos
        $usuario = Usuario::create([
            'nome' => $nome,
            'email' => $email,
            'telefone' => $telefone,
            'senha_hash' => Hash::make($senha),
            'pin_caixa_preta' => Hash::make($pin_caixa_preta),
            'tipo_renda' => $tipo_renda,
            'renda_mensal' => (float) $renda_mensal,
            'dia_recebimento' => (int) $dia_recebimento,
            'renda_extra' => (float) $renda_extra,
            'chave_pix' => $chave_pix ?? $email,
            'banco_principal' => $banco_principal,
        ]);

        // Criação automática da conta bancária padrão
        Conta::create([
            'usuario_id' => $usuario->id_usuario,
            'nome' => $banco_principal,
            'tipo' => 'corrente',
            'saldo' => (float) ($saldo_inicial ?? 0.00),
            'banco' => $banco_principal,
            'incluir_dashboard' => true,
        ]);

        // Autentica o usuário automaticamente após o cadastro
        Auth::login($usuario, true);

        return $usuario;
    }
}
