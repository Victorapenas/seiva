<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: Transacao
 *
 * Tabela: transacoes
 * Requisito: RF003 — Gestão de contas e transações financeiras
 *             RF002 — Caixa Preta (campo "visibilidade" controla acesso)
 *
 * O que tentamos fazer:
 * Registrar cada movimentação financeira do usuário: entradas (receitas)
 * e saídas (despesas), associadas a uma conta e uma categoria.
 *
 * Por que fizemos assim:
 * O campo "visibilidade" foi pensado para a integração com a Caixa Preta (RF002).
 * Quando uma transação é marcada como "privada", ela fica oculta nas listagens
 * normais e só aparece dentro da área protegida por PIN.
 *
 * O campo "lar_id" permite vincular uma transação ao contexto do lar compartilhado,
 * útil para controle de despesas conjuntas (RF010).
 *
 * Relacionamentos:
 * - usuario (N:1) — quem registrou a transação
 * - conta (N:1) — de qual conta saiu/entrou o dinheiro
 * - categoria (N:1) — categoria para classificar a transação
 * - lar (N:1) — lar associado (opcional, para despesas do lar)
 */
class Transacao extends Model
{
    protected $table = 'transacoes';
    protected $primaryKey = 'id_transacao';
    protected $fillable = [
        'usuario_id', 'conta_id', 'categoria_id', 'lar_id',
        'titulo', 'emoji', 'valor', 'tipo', 'data', 'visibilidade',
    ];

    protected $casts = [
        'data'  => 'date',
        'valor' => 'decimal:2',
    ];

    /**
     * Transação pertence a um usuário.
     * Requisito: RF003
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

    /**
     * Transação está associada a uma conta financeira.
     * Requisito: RF003
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conta()
    {
        return $this->belongsTo(Conta::class, 'conta_id', 'id_conta');
    }

    /**
     * Transação possui uma categoria (ex.: Alimentação, Moradia).
     * Requisito: RF003
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id_categoria');
    }

    /**
     * Transação pode estar vinculada a um lar compartilhado.
     * Usado para despesas do lar (RF010).
     * Requisito: RF004, RF010
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lar()
    {
        return $this->belongsTo(Lar::class, 'lar_id', 'id_lar');
    }
}
