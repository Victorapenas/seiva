<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: ParticipacaoDespesa
 *
 * Tabela: participacoes_despesas
 * Requisito: RF010 — Divisão de despesas do lar
 *
 * O que tentamos fazer:
 * Registrar a parte de cada membro em uma despesa do lar.
 * Depois que a despesa é criada, o sistema calcula automaticamente
 * quanto cada pessoa deve pagar e cria um registro aqui para cada um.
 *
 * Por que fizemos assim:
 * Dessa forma cada membro pode quitar sua parte individualmente.
 * O campo "pago" indica se já foi pago, e "transacao_quitacao_id" guarda
 * a referência para a transação que quitou essa participação — assim
 * conseguimos rastrear o pagamento no extrato.
 *
 * Relacionamentos:
 * - despesa (N:1) — qual despesa do lar este registro pertence
 * - usuario (N:1) — qual membro é responsável por esta parte
 */
class ParticipacaoDespesa extends Model
{
    protected $table = 'participacoes_despesas';
    protected $primaryKey = 'id_participacao';
    protected $fillable = [
        'despesa_lar_id', 'usuario_id', 'valor_parte', 'pago', 'transacao_quitacao_id',
    ];

    /**
     * Esta participação pertence a uma despesa do lar.
     * Requisito: RF010
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function despesa()
    {
        return $this->belongsTo(DespesaLar::class, 'despesa_lar_id', 'id_despesa_lar');
    }

    /**
     * Esta participação é de responsabilidade de um usuário específico.
     * Requisito: RF010
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }
}
