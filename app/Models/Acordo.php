<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: Acordo
 *
 * Tabela: acordos
 * Requisito: RF006 — Acordos financeiros e negociações entre membros
 *
 * O que tentamos fazer:
 * Representar um acordo de compra coletiva — quando os membros do lar
 * decidem juntar dinheiro para comprar algo em conjunto (ex.: geladeira,
 * viagem, eletrodoméstico).
 *
 * Por que fizemos assim:
 * Um acordo tem um valor total e os membros contribuem mensalmente.
 * Rastreamos "valor_arrecadado" e "parcelas_pagas" para saber o progresso.
 * O accessor "progresso" calcula automaticamente o percentual concluído.
 *
 * Relacionamentos:
 * - lar (N:1) — lar no qual o acordo foi criado
 * - criador (N:1) — quem propôs o acordo
 * - participantes (N:N via acordo_participantes) — membros que contribuem
 * - historicos (1:N) — histórico de alterações do acordo
 */
class Acordo extends Model
{
    protected $table = 'acordos';
    protected $primaryKey = 'id_acordo';
    protected $fillable = [
        'lar_id', 'criado_por', 'tipo', 'titulo', 'imagem',
        'valor_total', 'valor_arrecadado', 'divisao', 'valor_mensal',
        'conta_destino', 'vencimento_descricao', 'parcelas_total',
        'parcelas_pagas', 'status',
    ];

    /**
     * Acordo pertence a um lar compartilhado.
     * Requisito: RF006
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lar()
    {
        return $this->belongsTo(Lar::class, 'lar_id', 'id_lar');
    }

    /**
     * Quem criou/propôs este acordo.
     * Requisito: RF006
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function criador()
    {
        return $this->belongsTo(Usuario::class, 'criado_por', 'id_usuario');
    }

    /**
     * Membros que participam deste acordo, com a contribuição mensal de cada um.
     * Usamos belongsToMany na tabela "acordo_participantes".
     * Requisito: RF006
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function participantes()
    {
        return $this->belongsToMany(
            Usuario::class, 'acordo_participantes', 'acordo_id', 'usuario_id', 'id_acordo', 'id_usuario'
        )->withPivot('contribuicao_mensal');
    }

    /**
     * Histórico de mudanças deste acordo (pagamentos, alterações de valor etc.).
     * Requisito: RF006
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historicos()
    {
        return $this->hasMany(AcordoHistorico::class, 'acordo_id', 'id_acordo');
    }

    /**
     * Accessor: percentual de progresso do acordo em relação ao valor total.
     * Ex.: arrecadado=500, total=2000 → progresso=25.
     * Requisito: RF006
     *
     * @return int Percentual de 0 a 100
     */
    public function getProgressoAttribute()
    {
        return $this->valor_total > 0
            ? round(($this->valor_arrecadado / $this->valor_total) * 100)
            : 0;
    }
}
