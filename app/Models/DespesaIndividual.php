<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: DespesaIndividual
 *
 * Tabela: despesas_individuais
 * Requisito: RF003 — Gestão de despesas pessoais recorrentes
 *
 * O que tentamos fazer:
 * Registrar despesas pessoais do usuário que se repetem todo mês —
 * como aluguel, plano de saúde, academia etc. — separadas das transações
 * avulsas do extrato.
 *
 * Por que fizemos assim:
 * Uma despesa individual tem dia de vencimento, pode ser recorrente
 * e tem status de pago/pendente. Quando o usuário quita uma despesa,
 * pode associá-la a uma transação do extrato.
 *
 * O accessor "getIdAttribute" expõe o campo "id_despesa_individual" como
 * simplesmente "id" no JSON — isso facilita o frontend que espera um campo "id".
 *
 * Relacionamentos:
 * - usuario (N:1) — dono desta despesa
 * - categoria (N:1) — classificação da despesa
 */
class DespesaIndividual extends Model
{
    protected $table = 'despesas_individuais';
    protected $primaryKey = 'id_despesa_individual';

    protected $fillable = [
        'usuario_id',
        'titulo',
        'valor',
        'dia_vencimento',
        'categoria_id',
        'icone',
        'status',
        'pago_em',
        'recorrente',
        'detalhe',
    ];

    // Expõe "id" no JSON para compatibilidade com o frontend
    protected $appends = ['id'];

    /**
     * Accessor: retorna o ID usando o nome padrão "id" esperado pelo frontend.
     * Como nossa primaryKey customizada é "id_despesa_individual", precisamos
     * deste accessor para que o frontend não precise conhecer o nome real.
     * Requisito: RF003
     *
     * @return int ID da despesa
     */
    public function getIdAttribute()
    {
        return $this->id_despesa_individual;
    }

    /**
     * Despesa pertence a um usuário específico.
     * Requisito: RF003
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

    /**
     * Despesa tem uma categoria para classificação (ex.: Moradia, Saúde).
     * Requisito: RF003
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id_categoria');
    }
}
