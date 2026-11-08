<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LarMembro extends Model
{
    protected $table = 'lar_membros';
    protected $primaryKey = 'id_lar_membro';
    protected $fillable = ['lar_id','usuario_id','papel','renda_declarada','percentual_contribuicao','aceito_em'];
    protected $casts = ['aceito_em' => 'datetime'];

    public function lar() { return $this->belongsTo(Lar::class, 'lar_id', 'id_lar'); }
    public function usuario() { return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario'); }
}