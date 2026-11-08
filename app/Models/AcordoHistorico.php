<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AcordoHistorico extends Model
{
    protected $table = 'acordo_historicos';
    protected $primaryKey = 'id_historico';
    public $timestamps = false;
    protected $fillable = ['acordo_id','acao','detalhes_antigos','detalhes_novos'];
    protected $casts = ['detalhes_antigos' => 'array', 'detalhes_novos' => 'array'];
}