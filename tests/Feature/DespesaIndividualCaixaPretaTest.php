<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Conta;
use App\Models\DespesaIndividual;
use App\Models\Categoria;
use App\Models\Transacao;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DespesaIndividualCaixaPretaTest extends TestCase
{
    use RefreshDatabase;

    private Usuario $user;
    private Conta $conta;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = Usuario::create([
            'nome' => 'Victor Hugo',
            'email' => 'victor@seiva.com',
            'senha_hash' => bcrypt('senha123'),
            'renda_mensal' => 5200.00,
            'pin_caixa_preta' => '1234',
        ]);

        $this->conta = Conta::create([
            'usuario_id' => $this->user->id_usuario,
            'nome' => 'Nubank Victor',
            'tipo' => 'corrente',
            'saldo' => 3500.00,
            'cor' => '#820ad1',
        ]);

        Categoria::create([
            'nome' => 'Moradia',
            'icone' => 'home',
            'cor' => '#10b981',
            'sistema' => true,
        ]);
    }

    /**
     * Testa criação, edição, quitação e exclusão de despesa fixa individual na Caixa Preta.
     */
    public function test_crud_e_quitacao_despesa_individual()
    {
        // 1. Criar despesa individual
        $responseCriar = $this->actingAs($this->user)->postJson('/caixa-preta/despesas', [
            'titulo' => 'Academia Teste',
            'valor' => 129.90,
            'dia_vencimento' => 15,
            'icone' => 'dumbbell',
            'detalhe' => 'Plano SmartFit'
        ]);
        $responseCriar->assertStatus(201);
        $despesaId = $responseCriar->json('despesa.id');
        $this->assertNotNull($despesaId);

        // 2. Atualizar despesa
        $responseAtualizar = $this->actingAs($this->user)->postJson("/caixa-preta/despesas/{$despesaId}/atualizar", [
            'titulo' => 'Academia Black',
            'valor' => 139.90,
            'dia_vencimento' => 18,
            'icone' => 'dumbbell',
            'detalhe' => 'Plano Black'
        ]);
        $responseAtualizar->assertStatus(200);
        $this->assertDatabaseHas('despesas_individuais', [
            'id_despesa_individual' => $despesaId,
            'titulo' => 'Academia Black',
            'valor' => 139.90
        ]);

        // 3. Quitar despesa individual
        $saldoAntes = (float)$this->conta->fresh()->saldo;
        $responseQuitar = $this->actingAs($this->user)->postJson("/caixa-preta/despesas/{$despesaId}/quitar", [
            'conta_id' => $this->conta->id_conta
        ]);
        $responseQuitar->assertStatus(200);
        $this->assertDatabaseHas('despesas_individuais', [
            'id_despesa_individual' => $despesaId,
            'status' => 'pago'
        ]);
        $this->assertEquals($saldoAntes - 139.90, (float)$this->conta->fresh()->saldo);

        // 4. Excluir despesa
        $responseExcluir = $this->actingAs($this->user)->deleteJson("/caixa-preta/despesas/{$despesaId}");
        $responseExcluir->assertStatus(200);
        $this->assertDatabaseMissing('despesas_individuais', ['id_despesa_individual' => $despesaId]);
    }

    /**
     * Testa filtro de categoria em transações.
     */
    public function test_filtro_categoria_transacoes()
    {
        $response = $this->actingAs($this->user)->getJson('/api/transacoes?categoria=Moradia');
        $response->assertStatus(200);
    }

    /**
     * Testa navegação mês a mês em recebimentos.
     */
    public function test_relatorio_recebimentos_navegacao_mes()
    {
        $response = $this->actingAs($this->user)->getJson('/api/recebimentos?mes=2026-11');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'mes',
            'mes_anterior',
            'proximo_mes',
            'mes_label',
            'meses_disponiveis',
            'total_entradas',
            'total_saidas',
            'sobra',
            'taxa_economia'
        ]);
    }
}
