<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RegraDivisao extends Model
{
    protected $table = 'regras_divisao';
    protected $primaryKey = 'id_regra_divisao';
    protected $fillable = ['lar_id','tipo','ativa'];

    public function lar() { return $this->belongsTo(Lar::class, 'lar_id', 'id_lar'); }
    public function detalhes() { return $this->hasMany(RegraDivisaoDetalhe::class, 'regra_id', 'id_regra_divisao'); }
}