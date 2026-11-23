<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: Conta
 *
 * Tabela: contas
 * Requisito: RF003 — Gestão de contas financeiras e transações
 *
 * O que tentamos fazer:
 * Representar as contas financeiras do usuário: pode ser conta corrente,
 * carteira digital, poupança, cartão de crédito etc.
 *
 * Por que fizemos assim:
 * Cada usuário pode ter mais de uma conta. O saldo é atualizado a cada
 * transação registrada. O campo "comprometido" guarda quanto do saldo já
 * está reservado para despesas futuras — assim calculamos o saldo "livre".
 *
 * O campo "funcao" distingue a conta principal das demais (ex.: poupança,
 * investimento) para exibição no dashboard.
 *
 * Relacionamentos:
 * - usuario (N:1) — conta pertence a um usuário
 * - transacoes (1:N) — transações realizadas nessa conta
 */
class Conta extends Model
{
    protected $table = 'contas';
    protected $primaryKey = 'id_conta';
    protected $fillable = [
        'usuario_id', 'nome', 'tipo', 'saldo', 'comprometido',
        'funcao', 'objetivo', 'cor', 'ativa', 'chave_pix',
        'limite', 'usado', 'vencimento_fatura',
    ];

    /**
     * Conta pertence a um usuário — chave estrangeira customizada.
     * Requisito: RF003
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

    /**
     * Conta possui várias transações associadas.
     * Requisito: RF003
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transacoes()
    {
        return $this->hasMany(Transacao::class, 'conta_id', 'id_conta');
    }

    /**
     * Accessor: calcula o saldo disponível (livre) da conta.
     * Saldo livre = saldo total - valor comprometido com despesas futuras.
     * Requisito: RF003, RF009
     *
     * @return float Saldo disponível para uso
     */
    public function getLivreAttribute()
    {
        return $this->saldo - ($this->comprometido ?? 0);
    }
}
