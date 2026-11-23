<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: RegistroCaixaPreta
 *
 * Tabela: registros_caixa_preta
 * Requisito: RF002 — Caixa Preta (área sigilosa protegida por PIN)
 *
 * O que tentamos fazer:
 * Armazenar transações e registros que o usuário quer manter em sigilo —
 * protegidos por um PIN separado da senha de acesso normal.
 *
 * Por que fizemos assim:
 * Os campos sensíveis são armazenados com criptografia simétrica (AES-256-CBC)
 * diretamente na camada da aplicação antes de salvar no banco. Por isso os
 * campos se chamam "titulo_cifrado", "valor_cifrado" e "conta_cifrada" —
 * deixamos explícito que o dado está cifrado para não causar confusão.
 *
 * O campo "bloqueado" indica se a caixa preta está travada (exige novo PIN).
 *
 * Relacionamentos:
 * - usuario (N:1) — dono destes registros sigilosos
 */
class RegistroCaixaPreta extends Model
{
    protected $table = 'registros_caixa_preta';
    protected $primaryKey = 'id_registro_caixa_preta';
    protected $fillable = [
        'usuario_id', 'titulo_cifrado', 'valor_cifrado', 'conta_cifrada', 'data', 'bloqueado',
    ];

    protected $casts = [
        'data'      => 'date',
        'bloqueado' => 'boolean',
    ];

    /**
     * Este registro pertence ao usuário dono da caixa preta.
     * Requisito: RF002
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }
}
