<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'senha_hash',
        'pin_caixa_preta',
        'tipo_renda',
        'renda_mensal',
        'dia_recebimento',
        'tem_renda_extra',
        'renda_extra',
        'banco_principal',
        'chave_pix',
        'avatar',
    ];

    protected $hidden = [
        'senha_hash',
        'pin_caixa_preta',
    ];

    public function getAuthPassword()
    {
        return $this->senha_hash;
    }

    public function getAuthPasswordName()
    {
        return 'senha_hash';
    }

    public function contas()
    {
        return $this->hasMany(Conta::class, 'usuario_id', 'id_usuario');
    }

    public function transacoes()
    {
        return $this->hasMany(Transacao::class, 'usuario_id', 'id_usuario');
    }

    public function metas()
    {
        return $this->hasMany(Meta::class, 'usuario_id', 'id_usuario');
    }

    public function notificacoes()
    {
        return $this->hasMany(Notificacao::class, 'usuario_id', 'id_usuario');
    }

    public function lares()
    {
        return $this->belongsToMany(Lar::class, 'lar_membros', 'usuario_id', 'lar_id', 'id_usuario', 'id_lar')
                    ->withPivot(['papel', 'renda_declarada', 'percentual_contribuicao', 'aceito_em']);
    }

    public function registrosCaixaPreta()
    {
        return $this->hasMany(RegistroCaixaPreta::class, 'usuario_id', 'id_usuario');
    }

    public function getRendaTotalAttribute()
    {
        return (float)$this->renda_mensal + (float)$this->renda_extra;
    }

    public function getIniciaisAttribute()
    {
        $parts = explode(' ', trim($this->nome));
        if (count($parts) === 1) {
            return strtoupper(substr($parts[0], 0, 2));
        }
        return strtoupper(substr($parts[0], 0, 1) . substr(end($parts), 0, 1));
    }
}
