<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProdutoWatchlist extends Model
{
    protected $table = 'produtos_watchlist';
    protected $primaryKey = 'id_produto';
    protected $fillable = ['usuario_id','nome','emoji','link_referencia','preco_alvo','loja','imagem'];

    public function usuario() { return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario'); }
}