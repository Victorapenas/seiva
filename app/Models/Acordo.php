<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Acordo extends Model
{
    protected $table = 'acordos';
    protected $primaryKey = 'id_acordo';
    protected $fillable = ['lar_id','criado_por','tipo','titulo','imagem','valor_total','valor_arrecadado','divisao','valor_mensal','conta_destino','vencimento_descricao','parcelas_total','parcelas_pagas','status'];

    public function lar() { return $this->belongsTo(Lar::class, 'lar_id', 'id_lar'); }
    public function criador() { return $this->belongsTo(Usuario::class, 'criado_por', 'id_usuario'); }
    public function participantes() { return $this->belongsToMany(Usuario::class, 'acordo_participantes', 'acordo_id', 'usuario_id', 'id_acordo', 'id_usuario')->withPivot('contribuicao_mensal'); }
    public function historicos() { return $this->hasMany(AcordoHistorico::class, 'acordo_id', 'id_acordo'); }

    public function getProgressoAttribute() {
        return $this->valor_total > 0 ? round(($this->valor_arrecadado / $this->valor_total) * 100) : 0;
    }
}