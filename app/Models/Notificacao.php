<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: Notificacao
 *
 * Tabela: notificacoes
 * Requisito: RF005 — Alertas de cobranças
 *             RF006 — Alertas de acordos e propostas
 *             RF007 — Alertas de metas próximas do vencimento
 *             RF010 — Alertas de despesas do lar
 *
 * O que tentamos fazer:
 * Centralizar todos os alertas e avisos do sistema em uma única tabela.
 * Quando algo relevante acontece (cobrança criada, proposta aceita, despesa
 * vencendo), geramos uma notificação para o usuário correspondente.
 *
 * Por que fizemos assim:
 * Usamos $timestamps = false porque não precisamos de updated_at nesta tabela
 * — só nos importa quando foi criada, e essa data já vem no campo "tempo".
 * Isso também reduz gravações desnecessárias no banco.
 *
 * Relacionamentos:
 * - usuario (N:1) — quem deve receber esta notificação
 */
class Notificacao extends Model
{
    protected $table = 'notificacoes';
    protected $primaryKey = 'id_notificacao';

    // Não usamos updated_at nesta tabela — a data de criação fica no campo "tempo"
    public $timestamps = false;

    protected $fillable = [
        'usuario_id', 'lar_id', 'titulo', 'mensagem', 'tipo', 'lida', 'tempo',
    ];

    /**
     * Notificação pertence a um usuário específico.
     * Requisito: RF005, RF006, RF007, RF010
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }
}
