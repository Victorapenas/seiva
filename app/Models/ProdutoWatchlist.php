<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model: ProdutoWatchlist
 *
 * Tabela: produtos_watchlist
 * Requisito: RF008 — Watchlist de produtos e monitoramento de preços
 *
 * O que tentamos fazer:
 * Permitir que o usuário ou o lar monitore um produto que quer comprar futuramente.
 * O sistema guarda o preço-alvo e, quando o produto atingir esse preço, pode
 * gerar um alerta.
 *
 * Por que fizemos assim:
 * A watchlist pode ser pessoal (usuario_id sem lar_id) ou compartilhada com
 * o lar (lar_id preenchido). O campo "preco_alvo" é o preço que o usuário
 * quer pagar — NÃO é o preço atual do produto (esse dado viria de scraping
 * externo, funcionalidade que ficou como limitação do projeto).
 *
 * ATENÇÃO: o campo no banco é "preco_alvo" (não "preco" nem "preco_estimado").
 *
 * Relacionamentos:
 * - usuario (N:1) — quem adicionou o produto à watchlist
 * - lar (N:1) — lar associado (opcional, para watchlist compartilhada)
 */
class ProdutoWatchlist extends Model
{
    protected $table = 'produtos_watchlist';
    protected $primaryKey = 'id_produto';
    protected $fillable = [
        'usuario_id', 'lar_id', 'tipo', 'nome', 'emoji',
        'link_referencia', 'preco_alvo', 'loja', 'imagem',
    ];

    /**
     * Produto pertence ao usuário que o adicionou à watchlist.
     * Requisito: RF008
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

    /**
     * Produto pode estar associado a um lar (watchlist compartilhada).
     * Requisito: RF008
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lar()
    {
        return $this->belongsTo(Lar::class, 'lar_id', 'id_lar');
    }
}
