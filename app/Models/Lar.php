<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: Lar
 *
 * Tabela: lares
 * Requisito: RF004 — Lar compartilhado (criação e convite de membros)
 *             RF010 — Divisão de despesas do lar
 *
 * O que tentamos fazer:
 * Representar um "lar" — o grupo doméstico compartilhado entre dois ou mais
 * usuários (ex.: casal, roommates). O lar é o ponto central de toda a
 * funcionalidade compartilhada do SEIVA.
 *
 * Por que fizemos assim:
 * Um lar tem um criador (quem criou o grupo) e vários membros.
 * Optamos por usar uma tabela pivot "lar_membros" para guardar o papel
 * (ex.: administrador, membro) e a renda declarada de cada pessoa —
 * isso é necessário para calcular a divisão proporcional de despesas (RF010).
 *
 * Relacionamentos:
 * - criador (N:1) — usuário que criou o lar
 * - membros (N:N via lar_membros) — usuários participantes
 * - larMembros (1:N) — registros diretos da tabela pivot
 * - despesas (1:N) — despesas compartilhadas do lar
 * - acordos (1:N) — acordos financeiros do grupo
 * - metas (1:N) — metas compartilhadas
 * - convites (1:N) — convites enviados para novos membros
 * - cobrancas (1:N) — cobranças entre membros
 * - propostas (1:N) — propostas de compra compartilhada
 */
class Lar extends Model
{
    protected $table = 'lares';
    protected $primaryKey = 'id_lar';
    protected $fillable = ['nome', 'emoji', 'criado_por'];

    /**
     * O lar foi criado por um usuário específico.
     * Requisito: RF004
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function criador()
    {
        return $this->belongsTo(Usuario::class, 'criado_por', 'id_usuario');
    }

    /**
     * Lista todos os usuários membros deste lar via tabela pivot.
     * Incluímos papel, renda e percentual do pivot para cálculos de divisão.
     * Requisito: RF004, RF010
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function membros()
    {
        return $this->belongsToMany(
            Usuario::class, 'lar_membros', 'lar_id', 'usuario_id', 'id_lar', 'id_usuario'
        )->withPivot('papel', 'renda_declarada', 'percentual_contribuicao', 'aceito_em');
    }

    /**
     * Acesso direto aos registros da tabela pivot lar_membros.
     * Útil quando precisamos manipular os dados de membro diretamente.
     * Requisito: RF004, RF010
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function larMembros()
    {
        return $this->hasMany(LarMembro::class, 'lar_id', 'id_lar');
    }

    /**
     * Despesas compartilhadas registradas para este lar.
     * Requisito: RF010 — Divisão de despesas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function despesas()
    {
        return $this->hasMany(DespesaLar::class, 'lar_id', 'id_lar');
    }

    /**
     * Acordos financeiros do lar (ex.: juntar dinheiro para comprar algo).
     * Requisito: RF006 — Acordos e negociações
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function acordos()
    {
        return $this->hasMany(Acordo::class, 'lar_id', 'id_lar');
    }

    /**
     * Metas compartilhadas pelos membros do lar.
     * Requisito: RF007 — Metas financeiras compartilhadas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metas()
    {
        return $this->hasMany(Meta::class, 'lar_id', 'id_lar');
    }

    /**
     * Convites enviados para adicionar novos membros ao lar.
     * Requisito: RF004 — Convite de membros
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function convites()
    {
        return $this->hasMany(ConviteLar::class, 'lar_id', 'id_lar');
    }

    /**
     * Cobranças criadas entre membros do lar.
     * Requisito: RF005 — Cobranças entre membros
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cobrancas()
    {
        return $this->hasMany(Cobranca::class, 'lar_id', 'id_lar');
    }

    /**
     * Propostas de compra ou decisão coletiva submetidas no lar.
     * Requisito: RF006 — Propostas e negociações
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function propostas()
    {
        return $this->hasMany(Proposta::class, 'lar_id', 'id_lar');
    }
}
