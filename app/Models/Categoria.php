<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: Categoria
 *
 * Tabela: categorias
 * Requisito: RF003 — Categorização de transações financeiras
 *
 * O que tentamos fazer:
 * Classificar as transações em categorias para que o usuário consiga
 * analisar seus gastos por tipo (Alimentação, Transporte, Lazer etc.).
 *
 * Por que fizemos assim:
 * Existem categorias do sistema ("sistema" = true) que são padrão para
 * todos os usuários, e categorias personalizadas criadas pelo próprio usuário.
 * Se "usuario_id" for nulo, é uma categoria global do sistema.
 *
 * Relacionamentos:
 * - usuario (N:1) — criador da categoria personalizada (nulo se for do sistema)
 */
class Categoria extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    protected $fillable = ['nome', 'emoji', 'cor', 'sistema', 'usuario_id'];

    /**
     * Categoria personalizada pertence a um usuário específico.
     * Se for uma categoria do sistema, usuario_id é nulo.
     * Requisito: RF003
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }
}
