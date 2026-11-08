<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RegistroCaixaPreta extends Model
{
    protected $table = 'registros_caixa_preta';
    protected $primaryKey = 'id_registro_caixa_preta';
    protected $fillable = ['usuario_id','titulo_cifrado','valor_cifrado','conta_cifrada','data','bloqueado'];
    protected $casts = ['data' => 'date', 'bloqueado' => 'boolean'];

    public function usuario() { return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario'); }
}