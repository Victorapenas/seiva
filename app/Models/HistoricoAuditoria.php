<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricoAuditoria extends Model
{
    protected $table = 'historico_auditoria';
    protected $primaryKey = 'id_auditoria';
    protected $fillable = [
        'usuario_id',
        'lar_id',
        'entidade_tipo',
        'entidade_id',
        'acao',
        'descricao',
        'dados_anteriores',
        'dados_novos',
    ];

    protected $casts = [
        'dados_anteriores' => 'array',
        'dados_novos' => 'array',
        'created_at' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

    public function lar()
    {
        return $this->belongsTo(Lar::class, 'lar_id', 'id_lar');
    }

    /**
     * Registra um evento de auditoria e preservação de histórico.
     */
    public static function registrar(?int $usuarioId, string $entidadeTipo, ?int $entidadeId, string $acao, string $descricao, ?array $dadosAnteriores = null, ?array $dadosNovos = null, ?int $larId = null): self
    {
        return self::create([
            'usuario_id' => $usuarioId,
            'lar_id' => $larId,
            'entidade_tipo' => $entidadeTipo,
            'entidade_id' => $entidadeId,
            'acao' => $acao,
            'descricao' => $descricao,
            'dados_anteriores' => $dadosAnteriores,
            'dados_novos' => $dadosNovos,
        ]);
    }
}
