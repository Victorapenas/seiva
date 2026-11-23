<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: DespesaLar
 *
 * Tabela: despesas_lares
 * Requisito: RF010 — Divisão de despesas do lar compartilhado
 *
 * O que tentamos fazer:
 * Registrar despesas que pertencem ao lar (ex.: aluguel, conta de luz)
 * e que precisam ser divididas entre os membros de acordo com uma regra
 * de divisão configurada.
 *
 * Por que fizemos assim:
 * Separamos as despesas do lar das despesas individuais (DespesaIndividual)
 * porque as despesas do lar envolvem múltiplos pagadores e uma lógica de
 * rateio mais complexa. O campo "regra_divisao_id" aponta para qual regra
 * (igualitária ou proporcional à renda) deve ser aplicada.
 *
 * Relacionamentos:
 * - lar (N:1) — lar ao qual a despesa pertence
 * - autor (N:1) — quem registrou a despesa no sistema
 * - participacoes (1:N) — quanto cada membro deve pagar desta despesa
 */
class DespesaLar extends Model
{
    protected $table = 'despesas_lares';
    protected $primaryKey = 'id_despesa_lar';
    protected $fillable = [
        'lar_id', 'registrada_por', 'regra_divisao_id',
        'titulo', 'emoji', 'valor_total', 'data_vencimento',
        'tipo', 'status', 'divisao', 'comprovante',
    ];

    /**
     * Despesa pertence a um lar compartilhado.
     * Requisito: RF010
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lar()
    {
        return $this->belongsTo(Lar::class, 'lar_id', 'id_lar');
    }

    /**
     * Quem registrou esta despesa no sistema.
     * Requisito: RF010
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function autor()
    {
        return $this->belongsTo(Usuario::class, 'registrada_por', 'id_usuario');
    }

    /**
     * Lista as participações — quanto cada membro do lar deve pagar.
     * Essas participações são calculadas pelo controller com base na regra de divisão.
     * Requisito: RF010
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participacoes()
    {
        return $this->hasMany(ParticipacaoDespesa::class, 'despesa_lar_id', 'id_despesa_lar');
    }
}
