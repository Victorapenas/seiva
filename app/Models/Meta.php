<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table = 'metas';
    protected $primaryKey = 'id_meta';
    protected $fillable = ['usuario_id','lar_id','responsavel_id','titulo','emoji','categoria','valor_alvo','valor_atual','contribuicao_mensal','data_limite','onde_guardado','conta_destino','pix_destino','imagem','status'];
    protected $casts = ['data_limite' => 'date', 'valor_alvo' => 'decimal:2', 'valor_atual' => 'decimal:2'];

    public function usuario() { return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario'); }
    public function lar() { return $this->belongsTo(Lar::class, 'lar_id', 'id_lar'); }

    public function getProgressoAttribute() {
        return $this->valor_alvo > 0 ? round(($this->valor_atual / $this->valor_alvo) * 100) : 0;
    }
    public function getCompartilhadaAttribute() { return $this->lar_id !== null; }
}