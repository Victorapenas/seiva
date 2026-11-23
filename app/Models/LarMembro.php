<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: LarMembro
 *
 * Tabela: lar_membros
 * Requisito: RF004 — Lar compartilhado (participação de membros)
 *             RF010 — Divisão proporcional de despesas por renda
 *
 * O que tentamos fazer:
 * Representar diretamente a entrada de um usuário em um lar.
 * Este model é a tabela pivot entre Usuario e Lar, mas como precisamos
 * acessar campos como "renda_declarada" e "papel" com facilidade,
 * criamos um Model dedicado para ela.
 *
 * Por que fizemos assim:
 * Usando um Model dedicado para o pivot conseguimos fazer queries diretas
 * (ex.: LarMembro::where('lar_id', ...)) sem precisar navegar pela relação
 * many-to-many, o que simplifica o cálculo da divisão de despesas (RF010).
 *
 * Relacionamentos:
 * - lar (N:1) — a qual lar este membro pertence
 * - usuario (N:1) — qual usuário é este membro
 */
class LarMembro extends Model
{
    protected $table = 'lar_membros';
    protected $primaryKey = 'id_lar_membro';
    protected $fillable = [
        'lar_id', 'usuario_id', 'papel',
        'renda_declarada', 'percentual_contribuicao', 'aceito_em',
    ];

    protected $casts = [
        'aceito_em' => 'datetime',
    ];

    /**
     * Este registro pertence a um lar.
     * Requisito: RF004
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lar()
    {
        return $this->belongsTo(Lar::class, 'lar_id', 'id_lar');
    }

    /**
     * Este registro pertence a um usuário.
     * Requisito: RF004, RF010
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }
}
