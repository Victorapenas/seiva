<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: ProjetoItem
 *
 * Tabela: projeto_itens
 * Requisito: RF008 — Itens detalhados de um projeto de compra
 *
 * O que tentamos fazer:
 * Representar cada item individual dentro de um projeto de compra.
 * Por exemplo: num projeto de reforma, teríamos itens como "tinta",
 * "rodapé", "mão de obra" — cada um com seu custo estimado e custo real.
 *
 * Por que fizemos assim:
 * Separar o custo estimado do custo real permite ao usuário comparar
 * o planejado vs. o gasto real ao final. O campo "comprado" marca quando
 * o item já foi adquirido.
 *
 * Relacionamentos:
 * - projeto (N:1) — projeto ao qual este item pertence
 */
class ProjetoItem extends Model
{
    protected $table = 'projeto_itens';
    protected $primaryKey = 'id_item';
    protected $fillable = [
        'projeto_id', 'categoria_id', 'descricao',
        'custo_estimado', 'custo_real', 'comprado',
    ];

    /**
     * Item pertence a um projeto específico.
     * Requisito: RF008
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function projeto()
    {
        return $this->belongsTo(Projeto::class, 'projeto_id', 'id_projeto');
    }
}
