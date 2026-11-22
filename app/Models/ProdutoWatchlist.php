<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProdutoWatchlist extends Model
{
    protected $table = 'produtos_watchlist';
    protected $primaryKey = 'id_produto';
    protected $fillable = ['usuario_id', 'lar_id', 'tipo', 'nome', 'emoji', 'link_referencia', 'preco_alvo', 'loja', 'imagem'];

    public function usuario() { return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario'); }
    public function lar() { return $this->belongsTo(Lar::class, 'lar_id', 'id_lar'); }
}