<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: Meta
 *
 * Tabela: metas
 * Requisito: RF007 — Metas financeiras pessoais e compartilhadas
 *
 * O que tentamos fazer:
 * Representar uma meta de poupança ou objetivo financeiro que o usuário
 * quer atingir. Pode ser pessoal (só do usuário) ou compartilhada (vinculada
 * a um lar, onde todos os membros contribuem).
 *
 * Por que fizemos assim:
 * O campo "valor_atual" armazena o quanto já foi poupado até agora
 * (NÃO chamamos de "valor_acumulado" — isso causaria confusão com cálculos).
 * O accessor "progresso" calcula automaticamente o percentual concluído.
 *
 * Optamos por expor "progresso", "compartilhada" e "icone_lucide" via
 * $appends para o frontend não precisar calcular nada — já vem pronto no JSON.
 *
 * Relacionamentos:
 * - usuario (N:1) — quem criou a meta
 * - lar (N:1) — lar associado (nulo se for meta pessoal)
 */
class Meta extends Model
{
    protected $table = 'metas';
    protected $primaryKey = 'id_meta';
    protected $fillable = [
        'usuario_id',
        'lar_id',
        'responsavel_id',
        'titulo',
        'emoji',
        'categoria',
        'valor_alvo',
        'valor_atual',
        'contribuicao_mensal',
        'data_limite',
        'onde_guardado',
        'conta_destino',
        'pix_destino',
        'imagem',
        'link_referencia',
        'loja',
        'monitorar_promocao',
        'status',
    ];

    protected $casts = [
        'data_limite'       => 'date',
        'valor_alvo'        => 'decimal:2',
        'valor_atual'       => 'decimal:2',
        'monitorar_promocao' => 'boolean',
    ];

    // Esses atributos são calculados automaticamente e incluídos em toda resposta JSON
    protected $appends = ['progresso', 'icone_lucide', 'compartilhada'];

    /**
     * Meta pertence a um usuário.
     * Requisito: RF007
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

    /**
     * Meta pode estar vinculada a um lar (meta compartilhada).
     * Se lar_id for nulo, é uma meta pessoal.
     * Requisito: RF007, RF004
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lar()
    {
        return $this->belongsTo(Lar::class, 'lar_id', 'id_lar');
    }

    /**
     * Accessor: calcula o percentual de progresso da meta.
     * Ex.: valor_alvo=1000, valor_atual=250 → progresso=25.
     * Usamos round() para não exibir casas decimais desnecessárias.
     * Requisito: RF007
     *
     * @return int Percentual de 0 a 100
     */
    public function getProgressoAttribute()
    {
        return $this->valor_alvo > 0
            ? round(($this->valor_atual / $this->valor_alvo) * 100)
            : 0;
    }

    /**
     * Accessor: indica se a meta é compartilhada (tem lar) ou pessoal.
     * Requisito: RF007, RF004
     *
     * @return bool true se compartilhada com lar
     */
    public function getCompartilhadaAttribute()
    {
        return $this->lar_id !== null;
    }

    /**
     * Accessor: retorna o nome do ícone Lucide correspondente à categoria da meta.
     * O frontend usa esses nomes para renderizar o ícone correto sem precisar
     * de lógica extra no JavaScript.
     * Requisito: RF007
     *
     * @return string Nome do ícone Lucide
     */
    public function getIconeLucideAttribute(): string
    {
        return match($this->categoria) {
            'viagem'  => 'plane',
            'reserva' => 'shield',
            'curso'   => 'graduation-cap',
            'poupanca' => 'coins',
            default   => 'shopping-cart',
        };
    }
}
