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

    public function test_atualizar_icone_e_categoria_de_transacao(): void
    {
        $duda = Usuario::where('email', 'duda@seiva.com')->first();
        $conta = Conta::where('usuario_id', $duda->id_usuario)->first();

        // Criar uma transação para Duda
        $transacao = \App\Models\Transacao::create([
            'usuario_id' => $duda->id_usuario,
            'conta_id' => $conta->id_conta,
            'tipo' => 'saida',
            'valor' => 187.00,
            'titulo' => 'Sephora Cosméticos',
            'data' => now()->toDateString(),
            'emoji' => 'credit-card',
        ]);

        $categoriaBeleza = \App\Models\Categoria::where('nome', 'Beleza')->first();

        $response = $this->actingAs($duda)->postJson("/api/transacoes/{$transacao->id_transacao}/icone", [
            'icone' => 'sparkles',
            'categoria_id' => $categoriaBeleza ? $categoriaBeleza->id_categoria : null,
        ]);

        $response->assertStatus(200);
        $this->assertTrue($response->json('sucesso'));

        $txAtualizada = $transacao->fresh();
        $this->assertEquals('sparkles', $txAtualizada->emoji);
        if ($categoriaBeleza) {
            $this->assertEquals($categoriaBeleza->id_categoria, $txAtualizada->categoria_id);
            $this->assertEquals('Beleza', $txAtualizada->categoria_nome);
        }

        // Validar que o Dashboard retorna atividade recente com o novo ícone
        $dashResponse = $this->actingAs($duda)->getJson('/api/dashboard');
        $dashResponse->assertStatus(200);
        $atividades = $dashResponse->json('atividades');
        $this->assertNotEmpty($atividades);
        $itemSephora = collect($atividades)->first(fn($a) => str_contains($a['titulo'], 'Sephora'));
        if ($itemSephora) {
            $this->assertEquals('sparkles', $itemSephora['icone']);
        }
    }

    public function test_duda_casal_visualiza_pedido_ajuda_e_acolhe_no_banco(): void
    {
        $duda = Usuario::where('email', 'duda@seiva.com')->first();
        $this->assertNotNull($duda);

        // 1. Duda acessa o dashboard e vê o pedido de ajuda pendente de Ian
        $response = $this->actingAs($duda)->getJson('/api/dashboard');
        $response->assertStatus(200);
        $data = $response->json();

        $this->assertTrue((bool)$data['is_casal']);
        $this->assertNotNull($data['lar']);
        $this->assertEquals('Nosso Cantinho', $data['lar']['nome']);

        $this->assertNotNull($data['pedido_ajuda']);
        $this->assertTrue((bool)$data['pedido_ajuda']['tem_pedido']);
        $this->assertFalse((bool)$data['pedido_ajuda']['sou_autor']);
        $this->assertEquals('Ian', $data['pedido_ajuda']['solicitante']);
        $this->assertEquals(50.00, (float)$data['pedido_ajuda']['valor']);

        $idCobranca = $data['pedido_ajuda']['id_cobranca'];

        // 2. Duda acolhe / aceita o pedido de ajuda
        $respAcolher = $this->actingAs($duda)->postJson('/api/caixa-preta/responder-ajuda', [
            'id_cobranca' => $idCobranca,
            'acao' => 'aceitar',
        ]);
        $respAcolher->assertStatus(200);

        // 3. Cobrança no banco deve ter sido marcada como confirmada
        $cobrancaAtualizada = \App\Models\Cobranca::find($idCobranca);
        $this->assertEquals('confirmada', $cobrancaAtualizada->estado);

        // 4. No dashboard subsequente, o pedido de ajuda não deve mais aparecer como pendente
        $responsePos = $this->actingAs($duda)->getJson('/api/dashboard');
        $responsePos->assertStatus(200);
        $dataPos = $responsePos->json();
        $this->assertTrue(is_null($dataPos['pedido_ajuda']) || empty($dataPos['pedido_ajuda']['tem_pedido']));
    }

    public function test_ian_casal_eh_autor_do_pedido_ajuda_e_nao_recebe_solicitacao_propria(): void
    {
        $ian = Usuario::where('email', 'ian@seiva.com')->first();
        $this->assertNotNull($ian);

        $response = $this->actingAs($ian)->getJson('/api/dashboard');
        $response->assertStatus(200);
        $data = $response->json();

        $this->assertTrue((bool)$data['is_casal']);
        $this->assertNotNull($data['lar']);
        $this->assertEquals('Nosso Cantinho', $data['lar']['nome']);

        // Se Ian tiver pedido pendente no banco, ele deve constar como autor (aguardando parceiro)
        if (!empty($data['pedido_ajuda']) && !empty($data['pedido_ajuda']['tem_pedido'])) {
            $this->assertTrue((bool)$data['pedido_ajuda']['sou_autor']);
        }
    }

    public function test_victor_hugo_individual_isolado_sem_lar_e_sem_pedidos(): void
    {
        $victor = Usuario::where('email', 'victor@seiva.com')->first();
        $this->assertNotNull($victor);

        $response = $this->actingAs($victor)->getJson('/api/dashboard');
        $response->assertStatus(200);
        $data = $response->json();

        $this->assertFalse((bool)$data['is_casal']);
        $this->assertNull($data['lar']);
        $this->assertNull($data['detalhes_custo_lar']);
        $this->assertNull($data['pedido_ajuda']);
        $this->assertNotEmpty($data['contas']);
    }

    public function test_notificacoes_marcar_como_lida_remove_das_pendentes(): void
    {
        $duda = Usuario::where('email', 'duda@seiva.com')->first();

        // 1. Buscar notificações
        $response = $this->actingAs($duda)->getJson('/api/notificacoes');
        $response->assertStatus(200);
        $qtdInicial = $response->json('total_nao_lidas');

        // 2. Marcar todas como lidas
        $respLer = $this->actingAs($duda)->postJson('/api/notificacoes/ler');
        $respLer->assertStatus(200);

        // 3. Buscar novamente: total de não lidas deve ser 0
        $responsePos = $this->actingAs($duda)->getJson('/api/notificacoes');
        $responsePos->assertStatus(200);
        $this->assertEquals(0, $responsePos->json('total_nao_lidas'));
    }
}
