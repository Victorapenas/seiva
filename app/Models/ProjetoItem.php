<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProjetoItem extends Model
{
    protected $table = 'projeto_itens';
    protected $primaryKey = 'id_item';
    protected $fillable = ['projeto_id','categoria_id','descricao','custo_estimado','custo_real','comprado'];

    public function projeto() { return $this->belongsTo(Projeto::class, 'projeto_id', 'id_projeto'); }
}