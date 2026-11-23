<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: RegraDivisaoDetalhe
 *
 * Tabela: regras_divisao_detalhes
 * Requisito: RF010 — Divisão proporcional de despesas por renda declarada
 *
 * O que tentamos fazer:
 * Armazenar o percentual específico de cada membro dentro de uma regra
 * de divisão proporcional. Quando a regra é proporcional, calculamos
 * quanto (em %) cada membro deve pagar com base na renda declarada.
 *
 * Por que fizemos assim:
 * Separamos os detalhes da regra principal para facilitar a atualização
 * individual de percentuais sem recriar a regra inteira.
 *
 * Relacionamentos:
 * - regra (N:1) — a regra de divisão à qual este detalhe pertence
 * - usuario (N:1) — o membro ao qual este percentual se aplica
 */
class RegraDivisaoDetalhe extends Model
{
    protected $table = 'regras_divisao_detalhes';
    protected $primaryKey = 'id_detalhe';
    protected $fillable = ['regra_id', 'usuario_id', 'percentual'];

    /**
     * Este detalhe pertence a uma regra de divisão.
     * Requisito: RF010
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function regra()
    {
        return $this->belongsTo(RegraDivisao::class, 'regra_id', 'id_regra_divisao');
    }

    /**
     * Este percentual é atribuído a um usuário específico do lar.
     * Requisito: RF010
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }
}
