<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Lar;
use App\Models\Conta;
use App\Models\DespesaLar;
use App\Models\ParticipacaoDespesa;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardPrototipoAvancadoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->seed(\Database\Seeders\CenariosTesteSeeder::class);
    }

    public function test_dashboard_retorna_estruturas_completas_do_prototipo(): void
    {
        $duda = Usuario::where('email', 'duda@seiva.com')->first();
        $this->assertNotNull($duda);

        $response = $this->actingAs($duda)->getJson('/api/dashboard');
        $response->assertStatus(200);

        $data = $response->json();
        $this->assertArrayHasKey('detalhes_minha_renda', $data);
        $this->assertArrayHasKey('detalhes_custo_lar', $data);
        $this->assertArrayHasKey('gastos_por_categoria', $data);
        $this->assertArrayHasKey('alertas_inteligentes', $data);
        $this->assertArrayHasKey('saude_financeira', $data);
        $this->assertArrayHasKey('pra_registrar_hoje', $data);
        $this->assertArrayHasKey('onde_esta_meu_dinheiro', $data);

        // Minha Renda tem barra com fatias coloridas e como ler
        $this->assertNotEmpty($data['detalhes_minha_renda']['barra']);
        $this->assertNotEmpty($data['detalhes_minha_renda']['como_ler']);

        // Custo do Lar para casal tem despesas e dados do parceiro
        $this->assertNotNull($data['detalhes_custo_lar']);
        $this->assertNotEmpty($data['detalhes_custo_lar']['itens']);
        $this->assertArrayHasKey('parceiro', $data['detalhes_custo_lar']);

        // Gastos por categoria tem mês atual e passado
        $this->assertArrayHasKey('mes_atual', $data['gastos_por_categoria']);
        $this->assertArrayHasKey('mes_passado', $data['gastos_por_categoria']);
        $this->assertNotEmpty($data['gastos_por_categoria']['mes_atual']['categorias']);
    }

    public function test_ajuste_rapido_saldo_conta(): void
    {
        $duda = Usuario::where('email', 'duda@seiva.com')->first();
        $conta = Conta::where('usuario_id', $duda->id_usuario)->first();

        $response = $this->actingAs($duda)->postJson("/api/contas/{$conta->id_conta}/saldo", [
            'saldo' => 1250.75,
            'motivo' => 'Ajuste rápido de teste'
        ]);

        $response->assertStatus(200);
        $this->assertEquals(1250.75, (float)$conta->fresh()->saldo);
    }

    public function test_registrar_pagamento_de_fatura_debita_saldo(): void
    {
        $duda = Usuario::where('email', 'duda@seiva.com')->first();
        $conta = Conta::where('usuario_id', $duda->id_usuario)->first();
        $conta->update(['saldo' => 2000.00, 'comprometido' => 500.00]);

        $response = $this->actingAs($duda)->postJson('/api/pagamentos/registrar', [
            'id' => 'conta_' . $conta->id_conta,
            'tipo' => 'fatura',
            'valor' => 500.00,
            'conta_id' => $conta->id_conta,
        ]);

        $response->assertStatus(200);
        $contaAtualizada = $conta->fresh();
        $this->assertEquals(1500.00, (float)$contaAtualizada->saldo);
        $this->assertEquals(0.00, (float)$contaAtualizada->comprometido);
    }

    public function test_usuario_individual_nao_tem_detalhes_custo_lar(): void
    {
        $victor = Usuario::where('email', 'victor@seiva.com')->first();
        $this->assertNotNull($victor);

        $response = $this->actingAs($victor)->getJson('/api/dashboard');
        $response->assertStatus(200);

        $data = $response->json();
        $this->assertFalse((bool)$data['is_casal']);
        $this->assertNull($data['detalhes_custo_lar']);
        $this->assertNull($data['lar']);
    }
}
