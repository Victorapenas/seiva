<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Conta;
use App\Models\Transacao;
use App\Models\Meta;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrudGeralTransacoesContasMetasTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $conta1;
    protected $conta2;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = Usuario::create([
            'nome' => 'Maria Eduarda',
            'email' => 'maria_' . uniqid() . '@seiva.app',
            'senha_hash' => bcrypt('123456'),
        ]);

        $this->conta1 = Conta::create([
            'usuario_id' => $this->user->id_usuario,
            'nome' => 'Nubank Principal',
            'tipo' => 'corrente',
            'saldo' => 1000.00,
            'cor' => '#820ad1',
        ]);

        $this->conta2 = Conta::create([
            'usuario_id' => $this->user->id_usuario,
            'nome' => 'Poupança Caixa',
            'tipo' => 'poupanca',
            'saldo' => 500.00,
            'cor' => '#003399',
        ]);
    }

    public function test_transacao_update_com_reversao_e_novo_debito_de_saldo()
    {
        $this->actingAs($this->user);

        // Cria transação de R$ 100 na conta1 (saída) -> saldo da conta1 cai para 900
        $tx = Transacao::create([
            'usuario_id' => $this->user->id_usuario,
            'conta_id' => $this->conta1->id_conta,
            'titulo' => 'Mercado Antigo',
            'valor' => 100.00,
            'tipo' => 'saida',
            'data' => now()->toDateString(),
            'visibilidade' => 'pessoal',
        ]);
        $this->conta1->decrement('saldo', 100.00);
        $this->assertEquals(900.00, $this->conta1->fresh()->saldo);

        // Atualiza transação para R$ 200 na conta2
        $res = $this->postJson("/api/transacoes/{$tx->id_transacao}/atualizar", [
            'titulo' => 'Mercado Atualizado',
            'valor' => 200.00,
            'tipo' => 'saida',
            'conta_id' => $this->conta2->id_conta,
            'categoria_nome' => 'Mercado',
            'visibilidade' => 'compartilhado',
        ]);

        $res->assertStatus(200);
        $res->assertJsonFragment(['sucesso' => true]);

        // Conta 1 deve ter seu saldo restaurado (+100 = 1000)
        $this->assertEquals(1000.00, $this->conta1->fresh()->saldo);

        // Conta 2 deve ter seu saldo debitado em 200 (500 - 200 = 300)
        $this->assertEquals(300.00, $this->conta2->fresh()->saldo);

        // Transação atualizada no banco
        $this->assertDatabaseHas('transacoes', [
            'id_transacao' => $tx->id_transacao,
            'titulo' => 'Mercado Atualizado',
            'valor' => 200.00,
            'conta_id' => $this->conta2->id_conta,
            'visibilidade' => 'compartilhado',
        ]);
    }

    public function test_transacao_destroy_reverte_saldo_corretamente()
    {
        $this->actingAs($this->user);

        $tx = Transacao::create([
            'usuario_id' => $this->user->id_usuario,
            'conta_id' => $this->conta1->id_conta,
            'titulo' => 'Jantar Romântico',
            'valor' => 150.00,
            'tipo' => 'saida',
            'data' => now()->toDateString(),
        ]);
        $this->conta1->decrement('saldo', 150.00);
        $this->assertEquals(850.00, $this->conta1->fresh()->saldo);

        // Exclui transação
        $res = $this->deleteJson("/api/transacoes/{$tx->id_transacao}");
        $res->assertStatus(200);

        // Saldo deve voltar para 1000
        $this->assertEquals(1000.00, $this->conta1->fresh()->saldo);
        $this->assertDatabaseMissing('transacoes', ['id_transacao' => $tx->id_transacao]);
    }

    public function test_conta_bancaria_update_e_destroy()
    {
        $this->actingAs($this->user);

        // Update conta
        $resUpdate = $this->postJson("/api/contas/{$this->conta1->id_conta}/atualizar", [
            'nome' => 'Nubank Ultravioleta',
            'tipo' => 'carteira',
            'saldo' => 2500.00,
            'cor' => '#4c1d95',
        ]);
        $resUpdate->assertStatus(200);
        $resUpdate->assertJsonFragment(['sucesso' => true]);

        $this->assertDatabaseHas('contas', [
            'id_conta' => $this->conta1->id_conta,
            'nome' => 'Nubank Ultravioleta',
            'tipo' => 'carteira',
            'saldo' => 2500.00,
        ]);

        // Destroy conta
        $resDel = $this->deleteJson("/api/contas/{$this->conta1->id_conta}");
        $resDel->assertStatus(200);
        $this->assertDatabaseMissing('contas', ['id_conta' => $this->conta1->id_conta]);
    }

    public function test_meta_update_e_destroy()
    {
        $this->actingAs($this->user);

        $meta = Meta::create([
            'usuario_id' => $this->user->id_usuario,
            'titulo' => 'Notebook Dell',
            'valor_alvo' => 4500.00,
            'valor_atual' => 1000.00,
            'categoria' => 'produto',
            'status' => 'ativa',
        ]);

        // Update meta
        $resUpdate = $this->postJson("/api/metas/{$meta->id_meta}/atualizar", [
            'titulo' => 'MacBook Air M2',
            'valor_alvo' => 7000.00,
            'categoria' => 'produto',
        ]);
        $resUpdate->assertStatus(200);
        $this->assertDatabaseHas('metas', [
            'id_meta' => $meta->id_meta,
            'titulo' => 'MacBook Air M2',
            'valor_alvo' => 7000.00,
        ]);

        // Destroy meta
        $resDel = $this->deleteJson("/api/metas/{$meta->id_meta}");
        $resDel->assertStatus(200);
        $resDel->assertJsonFragment(['sucesso' => true]);
        $this->assertDatabaseMissing('metas', ['id_meta' => $meta->id_meta]);
    }
}
