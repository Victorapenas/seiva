<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $table = 'transacoes';
    protected $primaryKey = 'id_transacao';
    protected $fillable = ['usuario_id','conta_id','categoria_id','lar_id','titulo','emoji','valor','tipo','data','visibilidade'];
    protected $casts = ['data' => 'date', 'valor' => 'decimal:2'];

    public function usuario() { return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario'); }
    public function conta() { return $this->belongsTo(Conta::class, 'conta_id', 'id_conta'); }
    public function categoria() { return $this->belongsTo(Categoria::class, 'categoria_id', 'id_categoria'); }
    public function lar() { return $this->belongsTo(Lar::class, 'lar_id', 'id_lar'); }
}