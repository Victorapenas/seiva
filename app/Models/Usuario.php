<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Model: Usuario
 *
 * Tabela: usuarios
 * Requisito: RF001 — Cadastro e autenticação de usuários
 *             RF011 — Privacidade e exclusão de dados (LGPD)
 *
 * O que tentamos fazer:
 * Representar o usuário do sistema dentro do Laravel usando Eloquent.
 * Estendemos o Authenticatable (em vez do Model comum) para que o Laravel
 * reconheça essa classe como a entidade de login — assim o Auth::user()
 * devolve um objeto dessa classe.
 *
 * Por que fizemos assim:
 * O Laravel usa por padrão o campo "password", mas nosso banco usa "senha_hash".
 * Por isso sobrescrevemos getAuthPassword() e getAuthPasswordName() para apontar
 * para o campo correto. Sem isso, o login nunca funcionaria.
 *
 * Também escolhemos "id_usuario" como primaryKey customizada porque nosso banco
 * não segue a convenção "id" do Laravel — isso era um requisito do projeto.
 *
 * Relacionamentos:
 * - contas (1:N) — um usuário pode ter várias contas bancárias/carteiras
 * - transacoes (1:N) — transações registradas pelo usuário
 * - metas (1:N) — metas de poupança pessoais
 * - notificacoes (1:N) — notificações recebidas
 * - lares (N:N via lar_membros) — lares dos quais faz parte
 * - registrosCaixaPreta (1:N) — registros sigilosos criptografados
 */
class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nome',
        'email',
        'google_id',
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

    // Escondemos a senha e o PIN para não aparecerem em respostas JSON
    protected $hidden = [
        'senha_hash',
        'pin_caixa_preta',
    ];

    /**
     * Diz ao Laravel qual campo contém a senha do usuário.
     * Necessário porque nossa coluna se chama "senha_hash" e não "password".
     * Requisito: RF001
     *
     * @return string O hash bcrypt da senha armazenada no banco
     */
    public function getAuthPassword()
    {
        return $this->senha_hash;
    }

    /**
     * Retorna o nome do campo de senha para o guard de autenticação.
     * Requisito: RF001
     *
     * @return string Nome da coluna de senha no banco
     */
    public function getAuthPasswordName()
    {
        return 'senha_hash';
    }

    /**
     * Relacionamento: um usuário possui várias contas financeiras.
     * Requisito: RF003 — Gestão de contas e transações
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contas()
    {
        return $this->hasMany(Conta::class, 'usuario_id', 'id_usuario');
    }

    /**
     * Relacionamento: um usuário pode ter várias transações registradas.
     * Requisito: RF003 — Gestão de contas e transações
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transacoes()
    {
        return $this->hasMany(Transacao::class, 'usuario_id', 'id_usuario');
    }

    /**
     * Relacionamento: um usuário pode ter várias metas de poupança.
     * Requisito: RF007 — Metas financeiras
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metas()
    {
        return $this->hasMany(Meta::class, 'usuario_id', 'id_usuario');
    }

    /**
     * Relacionamento: um usuário recebe notificações do sistema.
     * Requisito: RF005, RF006, RF007, RF010 — eventos que geram alertas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notificacoes()
    {
        return $this->hasMany(Notificacao::class, 'usuario_id', 'id_usuario');
    }

    /**
     * Relacionamento: um usuário pode pertencer a vários lares (compartilhados).
     * Usamos belongsToMany com a tabela pivot "lar_membros" e trazemos
     * o papel, renda declarada e percentual de contribuição do pivot.
     * Requisito: RF004 — Lar compartilhado
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lares()
    {
        return $this->belongsToMany(Lar::class, 'lar_membros', 'usuario_id', 'lar_id', 'id_usuario', 'id_lar')
                    ->withPivot(['papel', 'renda_declarada', 'percentual_contribuicao', 'aceito_em']);
    }

    /**
     * Relacionamento: um usuário tem registros na sua caixa preta pessoal.
     * Requisito: RF002 — Caixa Preta (área sigilosa com PIN)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registrosCaixaPreta()
    {
        return $this->hasMany(RegistroCaixaPreta::class, 'usuario_id', 'id_usuario');
    }

    /**
     * Accessor: calcula a renda total (fixa + extra) do usuário.
     * Usado no dashboard para exibir o total disponível.
     * Requisito: RF009 — Painel de visão geral financeira
     *
     * @return float Renda mensal somada à renda extra
     */
    public function getRendaTotalAttribute()
    {
        return (float)$this->renda_mensal + (float)$this->renda_extra;
    }

    /**
     * Accessor: gera as iniciais do nome do usuário para exibir no avatar.
     * Ex.: "Victor Hugo" → "VH". Se tiver só um nome, pega as 2 primeiras letras.
     *
     * @return string Iniciais em letras maiúsculas
     */
    public function getIniciaisAttribute()
    {
        $parts = explode(' ', trim($this->nome));
        if (count($parts) === 1) {
            return strtoupper(substr($parts[0], 0, 2));
        }
        return strtoupper(substr($parts[0], 0, 1) . substr(end($parts), 0, 1));
    }
}
