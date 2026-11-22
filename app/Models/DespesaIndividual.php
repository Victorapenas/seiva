<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DespesaIndividual extends Model
{
    protected $table = 'despesas_individuais';
    protected $primaryKey = 'id_despesa_individual';

    protected $fillable = [
        'usuario_id',
        'titulo',
        'valor',
        'dia_vencimento',
        'categoria_id',
        'icone',
        'status',
        'pago_em',
        'recorrente',
        'detalhe',
    ];

    protected $appends = ['id'];

    public function getIdAttribute()
    {
        return $this->id_despesa_individual;
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id_categoria');
    }
}
