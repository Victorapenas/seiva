<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DespesaLar extends Model
{
    protected $table = 'despesas_lares';
    protected $primaryKey = 'id_despesa_lar';
    protected $fillable = ['lar_id','registrada_por','regra_divisao_id','titulo','emoji','valor_total','data_vencimento','tipo','status','divisao','comprovante'];

    public function lar() { return $this->belongsTo(Lar::class, 'lar_id', 'id_lar'); }
    public function autor() { return $this->belongsTo(Usuario::class, 'registrada_por', 'id_usuario'); }
    public function participacoes() { return $this->hasMany(ParticipacaoDespesa::class, 'despesa_lar_id', 'id_despesa_lar'); }
}