<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    protected $fillable = ['nome','emoji','cor','sistema','usuario_id'];

    public function usuario() { return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario'); }
}