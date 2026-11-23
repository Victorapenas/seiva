<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: ConviteLar
 *
 * Tabela: convites_lar
 * Requisito: RF004 — Convite de membros para o lar compartilhado
 *
 * O que tentamos fazer:
 * Gerenciar os convites enviados por um membro do lar para convidar
 * outra pessoa a participar do grupo.
 *
 * Por que fizemos assim:
 * Usamos um token único (UUID) por convite para que o link de aceitação
 * seja seguro e não adivinhável. O campo "expira_em" garante que convites
 * antigos não possam ser usados indefinidamente.
 *
 * Fluxo: membro envia convite → email é registrado → token gerado →
 * convidado acessa link → sistema valida token e adiciona ao lar.
 *
 * Relacionamentos:
 * - remetente (N:1) — quem enviou o convite
 * - lar (N:1) — para qual lar o convite é
 */
class ConviteLar extends Model
{
    protected $table = 'convites_lar';
    protected $primaryKey = 'id_convite_lar';

    protected $fillable = [
        'lar_id',
        'convidado_por',
        'email_convidado',
        'token_convite',
        'status',
        'expira_em',
    ];

    protected $casts = [
        'expira_em' => 'datetime',
    ];

    /**
     * Quem enviou este convite (membro existente do lar).
     * Requisito: RF004
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function remetente()
    {
        return $this->belongsTo(Usuario::class, 'convidado_por', 'id_usuario');
    }

    /**
     * Para qual lar este convite dá acesso.
     * Requisito: RF004
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lar()
    {
        return $this->belongsTo(Lar::class, 'lar_id', 'id_lar');
    }
}
