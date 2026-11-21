<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Lar;
use App\Models\Conta;
use App\Models\Meta;
use App\Models\DespesaLar;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AreaDoLarPainelTest extends TestCase
{
    use RefreshDatabase;

    private Usuario $userDuda;
    private Usuario $userIan;
    private Lar $lar;
    private Conta $contaDuda;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userDuda = Usuario::create([
            'nome' => 'Maria Eduarda',
            'email' => 'duda@seiva.app',
            'senha_hash' => bcrypt('senha123'),
            'renda_mensal' => 1700.00,
            'pin_caixa_preta' => '1234',
        ]);

        $this->lar = Lar::create([
            'nome' => 'Nosso Cantinho',
            'criado_por' => $this->userDuda->id_usuario,
            'codigo_acesso' => 'CANTINHO123',
        ]);
        $this->lar->membros()->attach($this->userDuda->id_usuario, ['renda_declarada' => 1700.00, 'papel' => 'administrador']);

        $this->userIan = Usuario::create([
            'nome' => 'Ian Marcos',
            'email' => 'ian@seiva.app',
            'senha_hash' => bcrypt('senha123'),
            'renda_mensal' => 2500.00,
            'pin_caixa_preta' => '4321',
        ]);
        $this->lar->membros()->attach($this->userIan->id_usuario, ['renda_declarada' => 2500.00, 'papel' => 'membro']);

        $this->contaDuda = Conta::create([
            'usuario_id' => $this->userDuda->id_usuario,
            'nome' => 'Nubank',
            'tipo' => 'corrente',
            'saldo' => 1180.00,
            'comprometido' => 0.00,
            'funcao' => 'gasto',
        ]);
    }

    public function test_painel_do_lar_retorna_dados_das_quatro_abas()
    {
        $this->actingAs($this->userDuda);

        $res = $this->getJson('/api/lar');
        $res->assertStatus(200);

        $data = $res->json();
        $this->assertNotNull($data['lar']);
        $this->assertEquals('Nosso Cantinho', $data['lar']['nome']);
        $this->assertCount(2, $data['membros']);

        // Saúde financeira
        $this->assertEquals(72, $data['saude_financeira']['percentual']);
        $this->assertEquals('Saudável', $data['saude_financeira']['status']);

        // 4 Cards de resumo
        $this->assertEquals(1667.90, $data['resumo']['custo_lar']);
        $this->assertEquals(1442.90, $data['resumo']['ja_contribuido']);
        $this->assertEquals(225.00, $data['resumo']['falta_contribuir']);
        $this->assertEquals(2532.10, $data['resumo']['sobra_casal']);

        // Próximos vencimentos
        $this->assertNotEmpty($data['proximos_vencimentos']);

        // Dívidas fixas e variáveis
        $this->assertNotEmpty($data['despesas_fixas']);
        $this->assertNotEmpty($data['despesas_variaveis']);

        // Metas do casal
        $this->assertNotEmpty($data['metas']);
    }

    public function test_reforcar_fundo_emergencia_lar_debita_saldo()
    {
        $this->actingAs($this->userDuda);

        $saldoAnterior = $this->contaDuda->saldo;
        $valorAporte = 250.00;

        $res = $this->postJson('/api/lar/fundo-emergencia/reforcar', [
            'valor' => $valorAporte,
            'conta_id' => $this->contaDuda->id_conta,
        ]);

        $res->assertStatus(200)
            ->assertJson(['sucesso' => true]);

        $this->contaDuda->refresh();
        $this->assertEquals($saldoAnterior - $valorAporte, $this->contaDuda->saldo);
    }

    public function test_pagar_despesa_fixa_lar_debita_saldo_e_quita()
    {
        $this->actingAs($this->userDuda);

        $despesa = DespesaLar::create([
            'lar_id' => $this->lar->id_lar,
            'registrada_por' => $this->userDuda->id_usuario,
            'titulo' => 'Conta de Luz',
            'valor_total' => 110.00,
            'divisao' => '50 / 50',
            'status' => 'pendente',
            'tipo' => 'fixa',
        ]);

        $saldoAnterior = $this->contaDuda->saldo;
        $valorPagamento = 110.00;

        $res = $this->postJson('/api/lar/despesas/pagar', [
            'despesa_id' => $despesa->id_despesa_lar,
            'valor' => $valorPagamento,
            'conta_id' => $this->contaDuda->id_conta,
        ]);

        $res->assertStatus(200)
            ->assertJson(['sucesso' => true]);

        $this->contaDuda->refresh();
        $this->assertEquals($saldoAnterior - $valorPagamento, $this->contaDuda->saldo);

        $despesa->refresh();
        $this->assertEquals('pago', $despesa->status);
    }

    public function test_atualizar_meta_do_lar()
    {
        $this->actingAs($this->userDuda);

        $meta = Meta::create([
            'lar_id' => $this->lar->id_lar,
            'usuario_id' => $this->userDuda->id_usuario,
            'titulo' => 'Geladeira Samsung',
            'valor_alvo' => 3200.00,
            'valor_atual' => 1000.00,
            'tipo' => 'compartilhada',
            'categoria' => 'produto',
        ]);

        $res = $this->postJson("/api/metas/{$meta->id_meta}/atualizar", [
            'valor_alvo' => 3500.00,
            'data_limite' => '2026-12-31',
        ]);

        $res->assertStatus(200)
            ->assertJson(['sucesso' => true]);

        $meta->refresh();
        $this->assertEquals(3500.00, $meta->valor_alvo);
    }

    public function test_desfazer_meta_do_lar()
    {
        $this->actingAs($this->userDuda);

        $meta = Meta::create([
            'lar_id' => $this->lar->id_lar,
            'usuario_id' => $this->userDuda->id_usuario,
            'titulo' => 'Geladeira Antiga',
            'valor_alvo' => 2000.00,
            'valor_atual' => 500.00,
            'tipo' => 'compartilhada',
            'categoria' => 'produto',
        ]);

        $res = $this->postJson("/api/metas/{$meta->id_meta}/desfazer", [
            'destino' => 'devolver',
        ]);

        $res->assertStatus(200)
            ->assertJson(['sucesso' => true]);

        $meta->refresh();
        $this->assertEquals('concluida', $meta->status);
    }
}
