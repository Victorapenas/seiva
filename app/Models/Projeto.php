<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: Projeto
 *
 * Tabela: projetos
 * Requisito: RF008 — Projetos e orçamentos planejados
 *
 * O que tentamos fazer:
 * Representar um projeto de compra ou reforma que o usuário planeja
 * com itens detalhados e um orçamento total estimado.
 *
 * Por que fizemos assim:
 * Diferente de uma simples transação, um projeto tem vários itens
 * com custos individuais (ProjetoItem). O usuário vai adicionando
 * itens e o sistema calcula o total automaticamente.
 *
 * Um projeto pode ser pessoal ou associado a um lar (compartilhado).
 *
 * Relacionamentos:
 * - itens (1:N) — itens que compõem o projeto
 * - usuario (N:1) — criador do projeto
 * - lar (N:1) — lar associado (opcional)
 */
class Projeto extends Model
{
    protected $table = 'projetos';
    protected $primaryKey = 'id_projeto';
    protected $fillable = ['usuario_id', 'lar_id', 'titulo', 'orcamento_total', 'status'];

    /**
     * Lista todos os itens que compõem este projeto.
     * Requisito: RF008
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itens()
    {
        return $this->hasMany(ProjetoItem::class, 'projeto_id', 'id_projeto');
    }

    /**
     * Projeto pertence a um usuário (criador).
     * Requisito: RF008
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

    /**
     * Projeto pode estar associado a um lar (projeto compartilhado).
     * Requisito: RF008, RF004
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lar()
    {
        return $this->belongsTo(Lar::class, 'lar_id', 'id_lar');
    }
}
