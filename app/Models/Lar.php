<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Lar extends Model
{
    protected $table = 'lares';
    protected $primaryKey = 'id_lar';
    protected $fillable = ['nome','emoji','criado_por'];

    public function criador() { return $this->belongsTo(Usuario::class, 'criado_por', 'id_usuario'); }
    public function membros() { return $this->belongsToMany(Usuario::class, 'lar_membros', 'lar_id', 'usuario_id', 'id_lar', 'id_usuario')->withPivot('papel','renda_declarada','percentual_contribuicao','aceito_em'); }
    public function larMembros() { return $this->hasMany(LarMembro::class, 'lar_id', 'id_lar'); }
    public function despesas() { return $this->hasMany(DespesaLar::class, 'lar_id', 'id_lar'); }
    public function acordos() { return $this->hasMany(Acordo::class, 'lar_id', 'id_lar'); }
    public function metas() { return $this->hasMany(Meta::class, 'lar_id', 'id_lar'); }
    public function convites() { return $this->hasMany(ConviteLar::class, 'lar_id', 'id_lar'); }
    public function cobrancas() { return $this->hasMany(Cobranca::class, 'lar_id', 'id_lar'); }
    public function propostas() { return $this->hasMany(Proposta::class, 'lar_id', 'id_lar'); }
}