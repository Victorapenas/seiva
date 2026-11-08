<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
    protected $table = 'propostas';
    protected $primaryKey = 'id_proposta';
    protected $fillable = ['lar_id','autor_id','tipo','titulo','descricao','imagem','link','valor_total','divisao','valor_mes_por_pessoa','parcelas_total','prazo_meses','mensagem','status'];

    public function lar() { return $this->belongsTo(Lar::class, 'lar_id', 'id_lar'); }
    public function autor() { return $this->belongsTo(Usuario::class, 'autor_id', 'id_usuario'); }
    public function rodadas() { return $this->hasMany(NegociacaoRodada::class, 'proposta_id', 'id_proposta'); }
}