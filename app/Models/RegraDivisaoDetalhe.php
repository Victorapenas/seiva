<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RegraDivisaoDetalhe extends Model
{
    protected $table = 'regras_divisao_detalhes';
    protected $primaryKey = 'id_detalhe';
    protected $fillable = ['regra_id','usuario_id','percentual'];

    public function regra() { return $this->belongsTo(RegraDivisao::class, 'regra_id', 'id_regra_divisao'); }
    public function usuario() { return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario'); }
}