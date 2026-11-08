<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $table = 'notificacoes';
    protected $primaryKey = 'id_notificacao';
    public $timestamps = false;
    protected $fillable = ['usuario_id','lar_id','titulo','mensagem','tipo','lida','tempo'];

    public function usuario() { return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario'); }
}