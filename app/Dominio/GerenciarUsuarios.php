<?php

namespace App\Dominio;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

/**
 * Classe: GerenciarUsuarios
 * Responsabilidade: Gestão de perfil, atualização de dados, verificação de PIN
 * e conformidade com os direitos do titular pela LGPD (Lei nº 13.709/2018).
 * 
 * Responsável Acadêmica: Maria Eduarda Lima (Duda) (RF011)
 */
class GerenciarUsuarios
{
    /** @var Usuario Instância do usuário sob gestão */
    private Usuario $usuario;

    /**
     * Construtor da classe GerenciarUsuarios.
     * 
     * @param Usuario $usuario
     */
    public function __construct(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Valida o PIN de 4 dígitos para acesso à Caixa Preta Criptografada.
     * 
     * @param string $pin PIN informado pelo usuário
     * @return bool
     */
    public function validarPinCaixaPreta(string $pin): bool
    {
        $savedPin = $this->usuario->pin_caixa_preta;
        if (!$savedPin) {
            return false;
        }

        $isBcrypt = is_string($savedPin) && str_starts_with($savedPin, '$2y$');
        return ($savedPin === $pin) || ($isBcrypt && Hash::check($pin, $savedPin));
    }

    /**
     * Exporta todos os dados do titular em formato JSON (Portabilidade LGPD - Art. 18, V).
     * 
     * @return array
     */
    public function exportarDadosLGPD(): array
    {
        return [
            'titular' => [
                'id' => $this->usuario->id_usuario,
                'nome' => $this->usuario->nome,
                'email' => $this->usuario->email,
                'telefone' => $this->usuario->telefone,
                'tipo_renda' => $this->usuario->tipo_renda,
                'renda_mensal' => $this->usuario->renda_mensal,
                'criado_em' => $this->usuario->created_at,
            ],
            'contas_financeiras' => $this->usuario->contas()->get()->toArray(),
            'transacoes_pessoais' => $this->usuario->transacoes()->get()->toArray(),
            'lares_vinculados' => $this->usuario->lares()->get()->toArray(),
            'declaracao_conformidade' => 'Dados gerados em conformidade com o Artigo 18 da Lei Federal nº 13.709/2018 (LGPD).',
            'gerado_em' => now()->toIso8601String(),
        ];
    }

    /**
     * Exclui definitivamente a conta e todos os dados associados (Direito de Eliminação - Art. 18, VI).
     * 
     * @return bool
     */
    public function excluirContaDefinitivamente(): bool
    {
        return (bool) $this->usuario->delete();
    }
}
