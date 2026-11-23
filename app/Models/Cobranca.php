<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: Cobranca
 *
 * Tabela: cobrancas
 * Requisito: RF005 — Cobranças entre membros do lar
 *
 * O que tentamos fazer:
 * Permitir que um membro do lar cobre outro por uma dívida ou despesa
 * que ainda não foi paga. É como um "lembrete de pagamento" formal dentro
 * do sistema.
 *
 * Por que fizemos assim:
 * Em vez de deixar isso no "boca a boca", o SEIVA formaliza a cobrança com
 * título, valor, data de vencimento e estado (pendente/pago/cancelado).
 * Assim ambos os membros têm visibilidade do que foi cobrado e pago.
 *
 * Relacionamentos:
 * - lar (N:1) — lar onde a cobrança acontece
 * - criador (N:1) — quem gerou a cobrança
 * - destinatario (N:1) — quem deve pagar
 */
class Cobranca extends Model
{
    protected $table = 'cobrancas';
    protected $primaryKey = 'id_cobranca';
    protected $fillable = [
        'lar_id', 'criada_por', 'destinatario_id', 'titulo',
        'valor', 'data_vencimento', 'mensagem', 'estado', 'quando',
    ];

    /**
     * Cobrança pertence a um lar.
     * Requisito: RF005
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lar()
    {
        return $this->belongsTo(Lar::class, 'lar_id', 'id_lar');
    }

    /**
     * Quem criou esta cobrança.
     * Requisito: RF005
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function criador()
    {
        return $this->belongsTo(Usuario::class, 'criada_por', 'id_usuario');
    }

    /**
     * Quem é o alvo desta cobrança (deve pagar).
     * Requisito: RF005
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destinatario()
    {
        return $this->belongsTo(Usuario::class, 'destinatario_id', 'id_usuario');
    }
}
