<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class NegociacaoRodada extends Model
{
    protected $table = 'negociacao_rodadas';
    protected $primaryKey = 'id_rodada';
    public $timestamps = false;
    protected $fillable = ['proposta_id','autor_id','mensagem','contraproposta_valor'];

    public function proposta() { return $this->belongsTo(Proposta::class, 'proposta_id', 'id_proposta'); }
    public function autor() { return $this->belongsTo(Usuario::class, 'autor_id', 'id_usuario'); }
}