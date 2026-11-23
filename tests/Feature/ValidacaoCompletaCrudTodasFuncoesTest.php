<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Lar;
use App\Models\LarMembro;
use App\Models\Conta;
use App\Models\Transacao;
use App\Models\Meta;
use App\Models\DespesaLar;
use App\Models\ParticipacaoDespesa;
use App\Models\Proposta;
use App\Models\Acordo;
use App\Models\DespesaIndividual;
use App\Models\ProdutoWatchlist;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Teste: ValidacaoCompletaCrudTodasFuncoesTest
 * Valida o ciclo completo de Criar, Editar e Excluir (CRUD)
 * em todos os módulos e funcionalidades do projeto SEIVA:
 * 1. Contas Bancárias (Criar, Editar, Excluir)
 * 2. Transações (Criar, Editar, Excluir com reversão de saldo)
 * 3. Metas Financeiras (Criar, Editar/Aportar, Excluir)
 * 4. Despesas do Lar (Criar, Editar com re-rateio, Quitar, Excluir)
 * 5. Mesa de Acordos (Criar Proposta, Votar/Aprovar -> converter em Acordo)
 * 6. Caixa Preta (Validar PIN, Despesa Individual CRUD, Watchlist CRUD)
 * 7. Perfil e Divisão do Lar (Editar Perfil, Alterar Divisão, Exportar LGPD)
 */
class ValidacaoCompletaCrudTodasFuncoesTest extends TestCase
{
    use RefreshDatabase;

    private Usuario $user;
    private Usuario $parceiro;
    private Lar $lar;
    private Conta $conta;
    private Categoria $categoria;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = Usuario::create([
            'nome' => 'Victor Hugo Santana',
            'email' => 'victor_teste@seiva.com',
            'senha_hash' => bcrypt('123456'),
            'renda_mensal' => 5000.00,
            'pin_caixa_preta' => '1234',
            'chave_pix' => 'victor_teste@seiva.com',
        ]);

        $this->parceiro = Usuario::create([
            'nome' => 'Duda Silveira',
            'email' => 'duda_teste@seiva.com',
            'senha_hash' => bcrypt('123456'),
            'renda_mensal' => 5000.00,
            'pin_caixa_preta' => '1234',
            'chave_pix' => 'duda_teste@seiva.com',
        ]);

        $this->lar = Lar::create([
            'nome' => 'Lar Teste',
            'criado_por' => $this->user->id_usuario,
        ]);

        LarMembro::create([
            'lar_id' => $this->lar->id_lar,
            'usuario_id' => $this->user->id_usuario,
            'papel' => 'administrador',
            'renda_declarada' => 5000.00,
        ]);

        LarMembro::create([
            'lar_id' => $this->lar->id_lar,
            'usuario_id' => $this->parceiro->id_usuario,
            'papel' => 'membro',
            'renda_declarada' => 5000.00,
        ]);

        $this->conta = Conta::create([
            'usuario_id' => $this->user->id_usuario,
            'nome' => 'Nubank Principal',
            'tipo' => 'corrente',
            'saldo' => 2000.00,
            'comprometido' => 0.00,
            'cor' => '#820ad1',
        ]);

        $this->categoria = Categoria::create([
            'nome' => 'Alimentação',
            'icone' => 'shopping-cart',
            'cor' => '#10b981',
            'sistema' => true,
        ]);
    }

    /**
     * 1. CRUD COMPLETO DE CONTAS BANCÁRIAS
     */
    public function test_crud_completo_contas_bancarias(): void
    {
        $this->actingAs($this->user);

        // CREATE
        $resCreate = $this->postJson('/api/contas', [
            'nome' => 'Inter Reserva',
            'tipo' => 'poupanca',
            'saldo' => 1500.00,
            'cor' => '#ff7a00',
        ]);
        $this->assertTrue(in_array($resCreate->status(), [200, 201]));
        $contaId = $resCreate->json('id_conta') ?? Conta::where('nome', 'Inter Reserva')->first()->id_conta;
        $this->assertDatabaseHas('contas', ['id_conta' => $contaId, 'nome' => 'Inter Reserva']);

        // EDIT / UPDATE
        $resUpdate = $this->postJson("/api/contas/{$contaId}/atualizar", [
            'nome' => 'Inter Investimentos',
            'tipo' => 'poupanca',
            'saldo' => 2500.00,
            'cor' => '#ff7a00',
        ]);
        $resUpdate->assertStatus(200);
        $this->assertDatabaseHas('contas', ['id_conta' => $contaId, 'nome' => 'Inter Investimentos', 'saldo' => 2500.00]);

        // DELETE
        $resDelete = $this->deleteJson("/api/contas/{$contaId}");
        $resDelete->assertStatus(200);
        $this->assertDatabaseMissing('contas', ['id_conta' => $contaId]);
    }

    /**
     * 2. CRUD COMPLETO DE TRANSAÇÕES (Com débito e reversão de saldo)
     */
    public function test_crud_completo_transacoes_com_impacto_no_saldo(): void
    {
        $this->actingAs($this->user);

        // CREATE: Saída de R$ 300 -> Saldo inicial 2000 vai para 1700
        $resCreate = $this->postJson('/api/transacoes', [
            'titulo' => 'Mercado Mensal',
            'valor' => 300.00,
            'tipo' => 'saida',
            'conta_id' => $this->conta->id_conta,
            'categoria_id' => $this->categoria->id_categoria,
            'data' => now()->format('Y-m-d'),
            'visibilidade' => 'pessoal',
        ]);
        $this->assertTrue(in_array($resCreate->status(), [200, 201]));
        $txId = $resCreate->json('id_transacao') ?? Transacao::where('titulo', 'Mercado Mensal')->first()->id_transacao;
        $this->assertEquals(1700.00, $this->conta->fresh()->saldo);

        // EDIT / UPDATE: Altera valor para R$ 400 -> Saldo ajusta de 1700 para 1600
        $resUpdate = $this->postJson("/api/transacoes/{$txId}/atualizar", [
            'titulo' => 'Mercado Mensal Extra',
            'valor' => 400.00,
            'tipo' => 'saida',
            'conta_id' => $this->conta->id_conta,
            'categoria_id' => $this->categoria->id_categoria,
            'data' => now()->format('Y-m-d'),
            'visibilidade' => 'pessoal',
        ]);
        $resUpdate->assertStatus(200);
        $this->assertEquals(1600.00, $this->conta->fresh()->saldo);
        $this->assertDatabaseHas('transacoes', ['id_transacao' => $txId, 'titulo' => 'Mercado Mensal Extra', 'valor' => 400.00]);

        // DELETE: Exclui transação -> Saldo restaura totalmente para 2000
        $resDelete = $this->deleteJson("/api/transacoes/{$txId}");
        $resDelete->assertStatus(200);
        $this->assertEquals(2000.00, $this->conta->fresh()->saldo);
        $this->assertDatabaseMissing('transacoes', ['id_transacao' => $txId]);
    }

    /**
     * 3. CRUD COMPLETO DE METAS (Criar, Aportar/Editar, Excluir)
     */
    public function test_crud_completo_metas(): void
    {
        $this->actingAs($this->user);

        // CREATE: Cria meta de R$ 5.000
        $resCreate = $this->postJson('/api/metas', [
            'titulo' => 'Viagem Férias Salvador',
            'valor_alvo' => 5000.00,
            'data_limite' => now()->addMonths(6)->format('Y-m-d'),
            'categoria' => 'Viagem',
            'icone' => 'plane',
            'cor' => '#3b82f6',
            'tipo' => 'individual',
        ]);
        $this->assertTrue(in_array($resCreate->status(), [200, 201]));
        $metaId = Meta::where('titulo', 'Viagem Férias Salvador')->first()->id_meta;
        $this->assertNotNull($metaId);

        // EDIT / APORTAR: Adiciona aporte de R$ 500 na meta -> debita da conta (2000 - 500 = 1500)
        $resAporte = $this->postJson("/api/metas/{$metaId}/contribuir", [
            'valor' => 500.00,
            'conta_id' => $this->conta->id_conta,
        ]);
        $resAporte->assertStatus(200);
        $metaAtualizada = Meta::find($metaId);
        $this->assertEquals(500.00, $metaAtualizada->valor_atual);
        $this->assertEquals(1500.00, $this->conta->fresh()->saldo);

        // EDIT: Atualiza dados da meta
        $resUpdate = $this->postJson("/api/metas/{$metaId}/atualizar", [
            'titulo' => 'Viagem Morro de SP',
            'valor_alvo' => 6000.00,
        ]);
        $resUpdate->assertStatus(200);
        $this->assertDatabaseHas('metas', ['id_meta' => $metaId, 'titulo' => 'Viagem Morro de SP', 'valor_alvo' => 6000.00]);

        // DELETE: Exclui meta -> devolve o valor acumulado (500) para a conta (1500 + 500 = 2000)
        $resDelete = $this->deleteJson("/api/metas/{$metaId}");
        $resDelete->assertStatus(200);
        $this->assertEquals(2000.00, $this->conta->fresh()->saldo);
        $this->assertDatabaseMissing('metas', ['id_meta' => $metaId]);
    }

    /**
     * 4. CRUD COMPLETO DE DESPESAS DO LAR (Criar com rateio, Editar com re-rateio, Quitar, Excluir)
     */
    public function test_crud_completo_despesas_do_lar(): void
    {
        $this->actingAs($this->user);

        // CREATE: Cria despesa fixa de R$ 200 com divisão 50/50 (R$ 100 cada)
        $resCreate = $this->postJson('/api/lar/despesas', [
            'titulo' => 'Internet Fibra',
            'valor_total' => 200.00,
            'tipo' => 'fixa',
            'divisao' => '50/50',
            'data_vencimento' => now()->addDays(5)->format('Y-m-d'),
        ]);
        $this->assertTrue(in_array($resCreate->status(), [200, 201]));
        $despesaId = DespesaLar::where('titulo', 'Internet Fibra')->first()->id_despesa_lar;
        $this->assertNotNull($despesaId);

        // Verifica participações geradas (100 para Victor, 100 para Duda)
        $participacoes = ParticipacaoDespesa::where('despesa_lar_id', $despesaId)->get();
        $this->assertCount(2, $participacoes);

        // EDIT: Atualiza valor para R$ 300 -> recalculando participações para R$ 150 cada
        $resUpdate = $this->postJson("/api/lar/despesas/{$despesaId}/atualizar", [
            'titulo' => 'Internet Fibra 600MB',
            'valor_total' => 300.00,
            'tipo' => 'fixa',
            'divisao' => '50/50',
            'data_vencimento' => now()->addDays(5)->format('Y-m-d'),
        ]);
        $resUpdate->assertStatus(200);
        $partVictor = ParticipacaoDespesa::where('despesa_lar_id', $despesaId)
            ->where('usuario_id', $this->user->id_usuario)
            ->first();
        $this->assertEquals(150.00, $partVictor->valor_parte);

        // QUITAR: Paga a participação
        $resQuitar = $this->postJson("/api/lar/despesas/quitar/{$partVictor->id_participacao}");
        $resQuitar->assertStatus(200);
        $this->assertTrue((bool)$partVictor->fresh()->pago);

        // DELETE: Exclui a despesa do lar e suas participações
        $resDelete = $this->deleteJson("/api/lar/despesas/{$despesaId}");
        $resDelete->assertStatus(200);
        $this->assertDatabaseMissing('despesas_lares', ['id_despesa_lar' => $despesaId]);
        $this->assertDatabaseMissing('participacoes_despesas', ['despesa_lar_id' => $despesaId]);
    }

    /**
     * 5. CRUD E FLUXO COMPLETO DA MESA DE ACORDOS
     */
    public function test_crud_completo_mesa_de_acordos(): void
    {
        $this->actingAs($this->user);

        // CREATE: Victor cria uma proposta de compra conjunta de R$ 1.800
        $resProposta = $this->postJson('/api/acordos/propostas', [
            'titulo' => 'Ar-Condicionado Inverter',
            'valor_total' => 1800.00,
            'descricao' => 'Para o quarto principal',
            'tipo' => 'meta',
            'valor_mes_por_pessoa' => 150.00,
        ]);
        $this->assertTrue(in_array($resProposta->status(), [200, 201]));
        $proposta = Proposta::where('titulo', 'Ar-Condicionado Inverter')->first();
        $this->assertNotNull($proposta);
        $this->assertEquals('pendente', $proposta->status);

        // VOTAR / ACEITAR: Parceira Duda vota aceitando a proposta -> converte automaticamente em Acordo Ativo
        $resVoto = $this->actingAs($this->parceiro)->postJson("/api/acordos/propostas/votar/{$proposta->id_proposta}", [
            'acao' => 'aceitar',
        ]);
        $resVoto->assertStatus(200);
        $this->assertEquals('aceita', $proposta->fresh()->status);
        $this->assertDatabaseHas('acordos', [
            'lar_id' => $this->lar->id_lar,
            'titulo' => 'Ar-Condicionado Inverter',
            'status' => 'ativo',
        ]);
    }

    /**
     * 6. CRUD COMPLETO DA CAIXA PRETA (PIN, Despesas Individuais e Wishlist)
     */
    public function test_crud_completo_caixa_preta(): void
    {
        $this->actingAs($this->user);

        // PIN: Valida acesso à Caixa Preta
        $resPin = $this->postJson('/api/caixa-preta/verificar-pin', ['pin' => '1234']);
        $resPin->assertStatus(200);
        $resPin->assertJsonFragment(['unlocked' => true]);

        // CREATE: Despesa individual privada
        $resCriarDesp = $this->postJson('/caixa-preta/despesas', [
            'titulo' => 'Academia Pessoal',
            'valor' => 130.00,
            'dia_vencimento' => 10,
            'icone' => 'dumbbell',
            'detalhe' => 'Plano Black',
        ]);
        $this->assertTrue(in_array($resCriarDesp->status(), [200, 201]));
        $despId = DespesaIndividual::where('titulo', 'Academia Pessoal')->first()->id_despesa_individual;
        $this->assertNotNull($despId);

        // EDIT: Atualiza despesa individual privada
        $resUpdateDesp = $this->postJson("/caixa-preta/despesas/{$despId}/atualizar", [
            'titulo' => 'Academia SmartFit Black',
            'valor' => 140.00,
            'dia_vencimento' => 10,
        ]);
        $resUpdateDesp->assertStatus(200);
        $this->assertDatabaseHas('despesas_individuais', ['id_despesa_individual' => $despId, 'valor' => 140.00]);

        // QUITAR: Quita a despesa individual debitando da conta
        $resQuitarDesp = $this->postJson("/caixa-preta/despesas/{$despId}/quitar", [
            'conta_id' => $this->conta->id_conta,
        ]);
        $resQuitarDesp->assertStatus(200);
        $this->assertEquals('pago', DespesaIndividual::find($despId)->status);

        // DELETE: Exclui a despesa individual
        $resDelDesp = $this->deleteJson("/caixa-preta/despesas/{$despId}");
        $resDelDesp->assertStatus(200);
        $this->assertDatabaseMissing('despesas_individuais', ['id_despesa_individual' => $despId]);

        // WATCHLIST (PRODUTO DE OLHO): CREATE & DELETE
        $resAddProd = $this->postJson('/api/caixa-preta/produtos-watchlist', [
            'nome' => 'Fone Bluetooth Sony',
            'preco' => 450.00,
            'link' => 'https://amazon.com.br/sony',
            'tipo' => 'individual',
        ]);
        $this->assertTrue(in_array($resAddProd->status(), [200, 201]));
        $prodId = ProdutoWatchlist::where('nome', 'Fone Bluetooth Sony')->first()->id_produto;
        $this->assertNotNull($prodId);

        $resDelProd = $this->deleteJson("/api/caixa-preta/produtos-watchlist/{$prodId}");
        $resDelProd->assertStatus(200);
        $this->assertDatabaseMissing('produtos_watchlist', ['id_produto' => $prodId]);
    }

    /**
     * 7. EDIÇÃO DE PERFIL E DIVISÃO DO LAR (LGPD)
     */
    public function test_edicao_perfil_divisao_lar_e_lgpd(): void
    {
        $this->actingAs($this->user);

        // EDIT PERFIL
        $resPerfil = $this->postJson('/api/perfil/atualizar', [
            'nome' => 'Victor Hugo Santana Sousa',
            'chave_pix' => 'victor.pix@seiva.com',
            'renda_mensal' => 5500.00,
        ]);
        $resPerfil->assertStatus(200);
        $this->assertDatabaseHas('usuarios', [
            'id_usuario' => $this->user->id_usuario,
            'nome' => 'Victor Hugo Santana Sousa',
            'chave_pix' => 'victor.pix@seiva.com',
            'renda_mensal' => 5500.00,
        ]);

        // EDIT DIVISÃO DO LAR: Atualiza para Personalizada (60% / 40%)
        $resDivisao = $this->postJson('/api/perfil/divisao-lar', [
            'tipo' => 'customizada',
            'pct_usuario' => 60,
            'pct_parceiro' => 40,
        ]);
        $resDivisao->assertStatus(200);
        $this->assertDatabaseHas('regras_divisao', [
            'lar_id' => $this->lar->id_lar,
            'tipo' => 'customizada',
            'ativa' => true,
        ]);

        // EXPORTAR DADOS (LGPD)
        $resExport = $this->getJson('/api/perfil/exportar');
        $resExport->assertStatus(200);
        $this->assertNotNull($resExport->json('titular_dos_dados'));
        $this->assertNotNull($resExport->json('contas_bancarias'));
    }
}
