<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Cobranca extends Model
{
    protected $table = 'cobrancas';
    protected $primaryKey = 'id_cobranca';
    protected $fillable = ['lar_id','criada_por','destinatario_id','titulo','valor','data_vencimento','mensagem','estado','quando'];

    public function lar() { return $this->belongsTo(Lar::class, 'lar_id', 'id_lar'); }
    public function criador() { return $this->belongsTo(Usuario::class, 'criada_por', 'id_usuario'); }
    public function destinatario() { return $this->belongsTo(Usuario::class, 'destinatario_id', 'id_usuario'); }
}