<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: HistoricoAuditoria
 *
 * Tabela: historico_auditoria
 * Requisito: Auditoria geral do sistema (boa prática de desenvolvimento)
 *
 * O que tentamos fazer:
 * Registrar automaticamente as ações importantes feitas no sistema — como
 * criação, edição e exclusão de entidades — para fins de rastreabilidade.
 *
 * Por que fizemos assim:
 * Em um sistema financeiro, saber "quem fez o quê e quando" é essencial.
 * Usamos o método estático "registrar()" como uma espécie de log estruturado.
 * Os campos "dados_anteriores" e "dados_novos" guardam o estado antes e depois
 * da alteração em formato JSON, facilitando auditorias futuras.
 *
 * Relacionamentos:
 * - usuario (N:1) — quem realizou a ação
 * - lar (N:1) — lar relacionado à ação (opcional)
 */
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
        'dados_novos'      => 'array',
        'created_at'       => 'datetime',
    ];

    /**
     * Quem realizou a ação registrada neste histórico.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

    /**
     * Lar relacionado a esta ação de auditoria (pode ser nulo para ações pessoais).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lar()
    {
        return $this->belongsTo(Lar::class, 'lar_id', 'id_lar');
    }

    /**
     * Registra um evento de auditoria no banco de dados.
     * Usamos um método estático para facilitar o uso nos controllers
     * sem precisar instanciar o model manualmente.
     *
     * @param int|null    $usuarioId     ID do usuário que realizou a ação
     * @param string      $entidadeTipo  Nome da entidade afetada (ex.: 'Conta', 'Meta')
     * @param int|null    $entidadeId    ID do registro afetado
     * @param string      $acao          Tipo de ação: 'criou', 'editou', 'excluiu'
     * @param string      $descricao     Descrição legível do que aconteceu
     * @param array|null  $dadosAnteriores Estado anterior do registro (antes da edição)
     * @param array|null  $dadosNovos    Estado novo do registro (após a edição)
     * @param int|null    $larId         ID do lar relacionado (opcional)
     * @return self       O registro de auditoria criado
     */
    public static function registrar(
        ?int $usuarioId,
        string $entidadeTipo,
        ?int $entidadeId,
        string $acao,
        string $descricao,
        ?array $dadosAnteriores = null,
        ?array $dadosNovos = null,
        ?int $larId = null
    ): self {
        return self::create([
            'usuario_id'       => $usuarioId,
            'lar_id'           => $larId,
            'entidade_tipo'    => $entidadeTipo,
            'entidade_id'      => $entidadeId,
            'acao'             => $acao,
            'descricao'        => $descricao,
            'dados_anteriores' => $dadosAnteriores,
            'dados_novos'      => $dadosNovos,
        ]);
    }
}
