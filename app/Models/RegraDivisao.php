<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: RegraDivisao
 *
 * Tabela: regras_divisao
 * Requisito: RF010 — Divisão de despesas do lar (igualitária ou proporcional)
 *
 * O que tentamos fazer:
 * Definir como as despesas do lar serão divididas entre os membros.
 * Pode ser de forma igualitária (todos pagam igual) ou proporcional
 * à renda declarada de cada um.
 *
 * Por que fizemos assim:
 * Cada lar pode ter sua própria regra configurada. Uma regra ativa
 * é automaticamente aplicada quando uma nova despesa é registrada.
 * Os percentuais individuais ficam em RegraDivisaoDetalhe.
 *
 * Relacionamentos:
 * - lar (N:1) — lar ao qual esta regra pertence
 * - detalhes (1:N) — percentual de cada membro nessa regra
 */
class RegraDivisao extends Model
{
    protected $table = 'regras_divisao';
    protected $primaryKey = 'id_regra_divisao';
    protected $fillable = ['lar_id', 'tipo', 'ativa'];

    /**
     * Esta regra pertence a um lar.
     * Requisito: RF010
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lar()
    {
        return $this->belongsTo(Lar::class, 'lar_id', 'id_lar');
    }

    /**
     * Detalhes de divisão por membro (percentuais individuais).
     * Usado na divisão proporcional por renda.
     * Requisito: RF010
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalhes()
    {
        return $this->hasMany(RegraDivisaoDetalhe::class, 'regra_id', 'id_regra_divisao');
    }
}
