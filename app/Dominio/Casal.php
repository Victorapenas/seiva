<?php

namespace App\Dominio;

use App\Models\Lar;
use App\Models\Usuario;
use Illuminate\Support\Collection;

/**
 * Classe: Casal (ou GerenciarLares)
 * Responsabilidade: Encapsular regras de negócios de Lares Compartilhados,
 * membros parceiros e cálculo automático de rateio proporcional justo.
 * 
 * Responsável Acadêmico: Jhon Abner (RF004, RF010)
 */
class Casal
{
    /** @var Lar Instância do lar gerenciado */
    private Lar $lar;

    /**
     * Construtor da classe Casal.
     * 
     * @param Lar $lar Instância do Lar compartilhado
     */
    public function __construct(Lar $lar)
    {
        $this->lar = $lar;
    }

    /**
     * Adiciona um novo parceiro/membro ao lar.
     * 
     * @param Usuario $usuario Usuário parceiro
     * @param string $papel 'administrador' ou 'membro'
     * @return void
     */
    public function adicionarMembro(Usuario $usuario, string $papel = 'membro'): void
    {
        $this->lar->membros()->attach($usuario->id_usuario, [
            'papel' => $papel,
            'renda_declarada' => $usuario->renda_mensal ?? 0,
            'percentual_contribuicao' => 50.00,
            'aceito_em' => now(),
        ]);
    }

    /**
     * Calcula o percentual de rateio proporcional de cada morador baseado na renda declarada.
     * Regra: Mais justo que 50/50 — quem ganha mais apoia proporcionalmente mais.
     * 
     * @return Collection Coleção de membros com percentual calculado
     */
    public function calcularRateioProporcional(): Collection
    {
        $membros = $this->lar->membros()->get();
        $rendaTotal = $membros->sum(function ($m) {
            return $m->pivot->renda_declarada > 0 ? $m->pivot->renda_declarada : ($m->renda_mensal ?? 0);
        });

        return $membros->map(function ($membro) use ($rendaTotal, $membros) {
            $renda = (float) ($membro->pivot->renda_declarada > 0 ? $membro->pivot->renda_declarada : ($membro->renda_mensal ?? 0));
            $percentual = 50.0;
            if ($rendaTotal > 0) {
                $percentual = round(($renda / $rendaTotal) * 100, 1);
            } elseif ($membros->count() > 0) {
                $percentual = round(100 / $membros->count(), 1);
            }

            return [
                'id_usuario' => $membro->id_usuario,
                'nome' => $membro->nome,
                'renda_declarada' => $renda,
                'papel' => $membro->pivot->papel ?? 'membro',
                'percentual_calculado' => $percentual,
            ];
        });
    }

    /**
     * Retorna a entidade Lar associada.
     * 
     * @return Lar
     */
    public function obterLar(): Lar
    {
        return $this->lar;
    }
}
