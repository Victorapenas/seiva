<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    protected $table = 'contas';
    protected $primaryKey = 'id_conta';
    protected $fillable = ['usuario_id','nome','tipo','saldo','comprometido','funcao','objetivo','cor','chave_pix','limite','usado','vencimento_fatura'];

    public function usuario() { return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario'); }
    public function transacoes() { return $this->hasMany(Transacao::class, 'conta_id', 'id_conta'); }

    public function getLivreAttribute() { return $this->saldo - ($this->comprometido ?? 0); }
}