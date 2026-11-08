<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ParticipacaoDespesa extends Model
{
    protected $table = 'participacoes_despesas';
    protected $primaryKey = 'id_participacao';
    protected $fillable = ['despesa_lar_id','usuario_id','valor_parte','pago','transacao_quitacao_id'];

    public function despesa() { return $this->belongsTo(DespesaLar::class, 'despesa_lar_id', 'id_despesa_lar'); }
    public function usuario() { return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario'); }
}