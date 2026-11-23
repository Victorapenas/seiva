<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: NegociacaoRodada
 *
 * Tabela: negociacao_rodadas
 * Requisito: RF006 — Rodadas de negociação em propostas de compra
 *
 * O que tentamos fazer:
 * Registrar cada "rodada" de uma negociação — quando um membro responde
 * a uma proposta com uma mensagem, aceita, recusa ou faz uma contraproposta
 * com um valor diferente.
 *
 * Por que fizemos assim:
 * Uma proposta pode passar por várias rodadas de ida e volta antes de ser
 * aceita. Guardamos cada mensagem e valor de contraproposta em separado
 * para ter um histórico fiel da conversa financeira.
 *
 * Usamos $timestamps = false porque não precisamos de created_at/updated_at —
 * a sequência das rodadas já define a ordem temporal.
 *
 * Relacionamentos:
 * - proposta (N:1) — a proposta que originou esta rodada
 * - autor (N:1) — quem enviou esta mensagem/contraproposta
 */
class NegociacaoRodada extends Model
{
    protected $table = 'negociacao_rodadas';
    protected $primaryKey = 'id_rodada';

    // Sem timestamps automáticos — a ordem das rodadas define a sequência
    public $timestamps = false;

    protected $fillable = [
        'proposta_id', 'autor_id', 'mensagem', 'contraproposta_valor',
    ];

    /**
     * Esta rodada pertence a uma proposta de negociação.
     * Requisito: RF006
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proposta()
    {
        return $this->belongsTo(Proposta::class, 'proposta_id', 'id_proposta');
    }

    /**
     * Quem enviou esta rodada de negociação (mensagem ou contraproposta).
     * Requisito: RF006
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function autor()
    {
        return $this->belongsTo(Usuario::class, 'autor_id', 'id_usuario');
    }
}
