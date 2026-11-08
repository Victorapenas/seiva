<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $table = 'projetos';
    protected $primaryKey = 'id_projeto';
    protected $fillable = ['usuario_id','lar_id','titulo','orcamento_total','status'];

    public function itens() { return $this->hasMany(ProjetoItem::class, 'projeto_id', 'id_projeto'); }
    public function usuario() { return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario'); }
    public function lar() { return $this->belongsTo(Lar::class, 'lar_id', 'id_lar'); }
}