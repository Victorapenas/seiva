<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: AcordoHistorico
 *
 * Tabela: acordo_historicos
 * Requisito: RF006 — Histórico de alterações em acordos financeiros
 *
 * O que tentamos fazer:
 * Rastrear todas as mudanças que acontecem em um acordo — como pagamentos
 * de parcelas, alterações de valor ou status — para que os membros do lar
 * possam ver o histórico completo do acordo.
 *
 * Por que fizemos assim:
 * Usamos $timestamps = false porque não usamos created_at/updated_at nesta
 * tabela — o controle de quando o evento ocorreu pode ser feito manualmente.
 * Os campos "detalhes_antigos" e "detalhes_novos" guardam o estado em JSON.
 *
 * Esta entidade não possui Model separado de relacionamentos porque é
 * acessada sempre via Acordo::historicos() e raramente de forma direta.
 */
class AcordoHistorico extends Model
{
    protected $table = 'acordo_historicos';
    protected $primaryKey = 'id_historico';

    // Sem timestamps automáticos — controle manual
    public $timestamps = false;

    protected $fillable = [
        'acordo_id', 'acao', 'detalhes_antigos', 'detalhes_novos',
    ];

    protected $casts = [
        'detalhes_antigos' => 'array',
        'detalhes_novos'   => 'array',
    ];
}
