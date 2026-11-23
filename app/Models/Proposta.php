<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: Proposta
 *
 * Tabela: propostas
 * Requisito: RF006 — Propostas e negociações entre membros do lar
 *
 * O que tentamos fazer:
 * Representar uma proposta formal de compra ou decisão que um membro
 * do lar apresenta para os outros. Os demais podem aceitar, recusar
 * ou fazer uma contraproposta — criando assim um fluxo de negociação.
 *
 * Por que fizemos assim:
 * Separamos "Proposta" de "Acordo": a Proposta é a sugestão inicial que
 * está em discussão; o Acordo é o resultado depois que todos concordaram.
 * As rodadas de negociação ficam em NegociacaoRodada.
 *
 * Relacionamentos:
 * - lar (N:1) — lar onde a proposta foi feita
 * - autor (N:1) — quem propôs
 * - rodadas (1:N) — histórico de contrapropostas e respostas
 */
class Proposta extends Model
{
    protected $table = 'propostas';
    protected $primaryKey = 'id_proposta';
    protected $fillable = [
        'lar_id', 'autor_id', 'tipo', 'titulo', 'descricao',
        'imagem', 'link', 'valor_total', 'divisao',
        'valor_mes_por_pessoa', 'parcelas_total', 'prazo_meses',
        'mensagem', 'status',
    ];

    /**
     * Proposta pertence a um lar.
     * Requisito: RF006
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lar()
    {
        return $this->belongsTo(Lar::class, 'lar_id', 'id_lar');
    }

    /**
     * Quem submeteu esta proposta.
     * Requisito: RF006
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function autor()
    {
        return $this->belongsTo(Usuario::class, 'autor_id', 'id_usuario');
    }

    /**
     * Rodadas de negociação desta proposta (contrapropostas e respostas).
     * O status pode ser: pendente, aceita, recusada, contraproposta.
     * Requisito: RF006
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rodadas()
    {
        return $this->hasMany(NegociacaoRodada::class, 'proposta_id', 'id_proposta');
    }
}
