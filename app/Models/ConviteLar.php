<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConviteLar extends Model
{
    protected $table = 'convites_lar';
    protected $primaryKey = 'id_convite_lar';

    protected $fillable = [
        'lar_id',
        'convidado_por',
        'email_convidado',
        'token_convite',
        'status',
        'expira_em',
    ];

    protected $casts = [
        'expira_em' => 'datetime',
    ];

    public function remetente()
    {
        return $this->belongsTo(Usuario::class, 'convidado_por', 'id_usuario');
    }

    public function lar()
    {
        return $this->belongsTo(Lar::class, 'lar_id', 'id_lar');
    }
}
