<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Lar;
use App\Models\Conta;
use App\Models\Meta;
use App\Models\Transacao;
use App\Models\Categoria;
use App\Models\Cobranca;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModulosCaixaPretaMetasRecebimentosTest extends TestCase
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
            'renda_mensal' => 4000.00,
            'pin_caixa_preta' => '1234',
        ]);

        $this->lar = Lar::create([
            'nome' => 'Nosso Cantinho',
            'criado_por' => $this->userDuda->id_usuario,
            'codigo_acesso' => 'CANTINHO123',
        ]);
        $this->lar->membros()->attach($this->userDuda->id_usuario, ['renda_declarada' => 4000.00, 'papel' => 'administrador']);

        $this->userIan = Usuario::create([
            'nome' => 'Ian Marcos',
            'email' => 'ian@seiva.app',
            'senha_hash' => bcrypt('senha123'),
            'renda_mensal' => 6000.00,
            'pin_caixa_preta' => '4321',
        ]);
        $this->lar->membros()->attach($this->userIan->id_usuario, ['renda_declarada' => 6000.00, 'papel' => 'membro']);

        $this->contaDuda = Conta::create([
            'usuario_id' => $this->userDuda->id_usuario,
            'nome' => 'Nubank',
            'tipo' => 'corrente',
            'saldo' => 1500.00,
            'comprometido' => 0.00,
            'funcao' => 'gasto',
        ]);
    }

    public function test_caixa_preta_validacao_pin_e_retorno_dados()
    {
        $this->actingAs($this->userDuda);

        // PIN inválido
        $resErro = $this->postJson('/api/caixa-preta/verificar-pin', ['pin' => '0000']);
        $resErro->assertStatus(403)
                ->assertJson(['unlocked' => false]);

        // PIN correto
        $resOk = $this->postJson('/api/caixa-preta/verificar-pin', ['pin' => '1234']);
        $resOk->assertStatus(200)
              ->assertJson(['unlocked' => true]);

        // Obter dados completos da Caixa Preta
        $resDados = $this->getJson('/api/caixa-preta/dados');
        $resDados->assertStatus(200)
                 ->assertJsonStructure([
                     'usuario',
                     'is_casal',
                     'patrimonio' => ['total_individual', 'livre_pra_usar', 'comprometido', 'guardado'],
                     'contas_e_cartoes',
                     'o_que_voce_deve',
                     'despesas_so_suas',
                     'metas',
                 ]);
    }

    public function test_metas_criacao_e_contribuicao_com_debito_em_conta()
    {
        $this->actingAs($this->userDuda);

        // Criar meta individual
        $resMeta = $this->postJson('/api/metas', [
            'titulo' => 'Notebook Dell',
            'valor_alvo' => 4500.00,
            'valor_atual' => 4000.00,
            'categoria' => 'produto',
            'tipo_escopo' => 'individual',
        ]);
        $resMeta->assertStatus(201);
        $metaId = $resMeta->json('id_meta');

        // Fazer aporte debitando da conta Nubank
        $resAporte = $this->postJson("/api/metas/{$metaId}/contribuir", [
            'valor' => 500.00,
            'conta_id' => $this->contaDuda->id_conta,
        ]);
        $resAporte->assertStatus(200)
                  ->assertJson(['sucesso' => true]);

        // Verifica saldo debitado
        $this->contaDuda->refresh();
        $this->assertEquals(1000.00, (float)$this->contaDuda->saldo);

        // Verifica meta concluída
        $meta = Meta::find($metaId);
        $this->assertEquals(4500.00, (float)$meta->valor_atual);
        $this->assertEquals('concluida', $meta->status);
    }

    public function test_transacoes_do_lar_retorna_movimentacao_dos_membros()
    {
        $this->actingAs($this->userDuda);

        Transacao::create([
            'usuario_id' => $this->userDuda->id_usuario,
            'conta_id' => $this->contaDuda->id_conta,
            'titulo' => 'Mercado da Semana',
            'valor' => 300.00,
            'tipo' => 'saida',
            'data' => now()->format('Y-m-d'),
            'visibilidade' => 'lar',
        ]);

        $res = $this->getJson('/api/transacoes/lar');
        $res->assertStatus(200)
            ->assertJsonStructure([
                'lar',
                'eu_enviei',
                'parceiro_enviou',
                'total',
                'transacoes',
            ]);

        $this->assertEquals(300.00, $res->json('eu_enviei'));
    }

    public function test_relatorio_recebimentos_retorna_estruturas_completas()
    {
        $this->actingAs($this->userDuda);

        $catSalario = Categoria::create(['nome' => 'Salário', 'emoji' => '💰', 'tipo' => 'entrada', 'sistema' => true]);
        $catMoradia = Categoria::create(['nome' => 'Moradia', 'emoji' => '🏠', 'tipo' => 'saida', 'sistema' => true]);

        Transacao::create([
            'usuario_id' => $this->userDuda->id_usuario,
            'conta_id' => $this->contaDuda->id_conta,
            'categoria_id' => $catSalario->id_categoria,
            'titulo' => 'Salário Florais Design',
            'valor' => 1700.00,
            'tipo' => 'entrada',
            'data' => now()->format('Y-m-d'),
            'visibilidade' => 'pessoal',
        ]);

        Transacao::create([
            'usuario_id' => $this->userDuda->id_usuario,
            'conta_id' => $this->contaDuda->id_conta,
            'categoria_id' => $catMoradia->id_categoria,
            'titulo' => 'Aluguel parte individual',
            'valor' => 480.00,
            'tipo' => 'saida',
            'data' => now()->format('Y-m-d'),
            'visibilidade' => 'pessoal',
        ]);

        $res = $this->getJson('/api/recebimentos');
        $res->assertStatus(200)
            ->assertJsonStructure([
                'mes',
                'total_entradas',
                'total_saidas',
                'sobra',
                'taxa_economia',
                'entradas',
                'gastos_por_categoria',
                'historico',
            ]);

        $this->assertEquals(1700.00, $res->json('total_entradas'));
        $this->assertEquals(480.00, $res->json('total_saidas'));
        $this->assertEquals(1220.00, $res->json('sobra'));
    }

    public function test_pedir_e_responder_ajuda_de_custo_com_parceiro()
    {
        $this->actingAs($this->userDuda);

        // Duda pede ajuda para Ian
        $resAjuda = $this->postJson('/api/caixa-preta/pedir-ajuda', [
            'titulo' => 'Mercado Extra',
            'valor' => 150.00,
            'mensagem' => 'Ajuda com compras da semana',
        ]);
        $resAjuda->assertStatus(200)
                 ->assertJson(['sucesso' => true]);

        $cobrancaId = $resAjuda->json('cobranca.id_cobranca');

        // Ian se autentica e aceita
        $this->actingAs($this->userIan);

        $contaIan = Conta::create([
            'usuario_id' => $this->userIan->id_usuario,
            'nome' => 'Inter',
            'tipo' => 'corrente',
            'saldo' => 800.00,
        ]);

        $resResp = $this->postJson('/api/caixa-preta/responder-ajuda', [
            'id_cobranca' => $cobrancaId,
            'acao' => 'aceitar',
            'conta_id' => $contaIan->id_conta,
        ]);

        $resResp->assertStatus(200)
                ->assertJson(['sucesso' => true]);

        // Saldo de Ian debitado
        $contaIan->refresh();
        $this->assertEquals(650.00, (float)$contaIan->saldo);

        // Cobrança quitada
        $cob = Cobranca::find($cobrancaId);
        $this->assertEquals('confirmada', $cob->estado);
    }

    public function test_caixa_preta_trancar_e_bloqueio_de_dados()
    {
        $this->actingAs($this->userDuda);

        // Sem desbloquear PIN, dadosCompletos deve retornar 403
        session()->forget('caixa_preta_unlocked');
        $resSemPin = $this->getJson('/api/caixa-preta/dados');
        $resSemPin->assertStatus(403)
                  ->assertJson(['error' => 'Caixa Preta trancada. Digite seu PIN de 4 dígitos.']);

        // Desbloqueia com PIN
        $this->postJson('/api/caixa-preta/verificar-pin', ['pin' => '1234'])->assertStatus(200);
        $this->getJson('/api/caixa-preta/dados')->assertStatus(200);

        // Tranca
        $resTrancar = $this->postJson('/api/caixa-preta/trancar');
        $resTrancar->assertStatus(200)
                   ->assertJson(['unlocked' => false]);

        // Novamente bloqueada
        $this->getJson('/api/caixa-preta/dados')->assertStatus(403);
    }

    public function test_caixa_preta_contraproposta_com_valor_customizado_e_mensagem()
    {
        $this->actingAs($this->userDuda);

        $resAjuda = $this->postJson('/api/caixa-preta/pedir-ajuda', [
            'titulo' => 'Filamento Impressora 3D',
            'valor' => 50.00,
        ]);
        $cobrancaId = $resAjuda->json('cobranca.id_cobranca');

        // Ian contrapropõe com valor personalizado (ex: R$ 20,00)
        $this->actingAs($this->userIan);
        $resContra = $this->postJson('/api/caixa-preta/responder-ajuda', [
            'id_cobranca' => $cobrancaId,
            'acao' => 'contrapor',
            'valor_contraproposta' => 20.00,
            'mensagem_contraproposta' => 'Consigo ajudar com 20 reais agora',
        ]);

        $resContra->assertStatus(200)
                  ->assertJson(['sucesso' => true]);

        $cob = Cobranca::find($cobrancaId);
        $this->assertEquals(20.00, (float)$cob->valor);
        $this->assertEquals('pendente', $cob->estado);
        $this->assertStringContainsString('20,00', $cob->mensagem);
    }

    public function test_caixa_preta_confirmar_recebimento_e_disputa()
    {
        $this->actingAs($this->userDuda);
        $saldoInicial = (float)$this->contaDuda->saldo;

        // Confirmar recebimento credita saldo e registra transação
        $resConf = $this->postJson('/api/caixa-preta/confirmar-recebimento', [
            'valor' => 156.40,
            'conta_id' => $this->contaDuda->id_conta,
        ]);

        $resConf->assertStatus(200)
                ->assertJson(['sucesso' => true]);

        $this->contaDuda->refresh();
        $this->assertEquals($saldoInicial + 156.40, (float)$this->contaDuda->saldo);

        // Disputar recebimento gera notificação de alerta para o parceiro
        $resDisp = $this->postJson('/api/caixa-preta/disputar-recebimento', [
            'valor' => 156.40,
            'motivo' => 'PIX não localizado na conta',
        ]);

        $resDisp->assertStatus(200)
                ->assertJson(['sucesso' => true]);

        $this->assertDatabaseHas('notificacoes', [
            'usuario_id' => $this->userIan->id_usuario,
            'tipo' => 'atencao',
        ]);
    }

    public function test_caixa_preta_crud_produtos_watchlist()
    {
        $this->actingAs($this->userDuda);

        // Adicionar produto
        $resAdd = $this->postJson('/api/caixa-preta/produtos-watchlist', [
            'nome' => 'Fone Sony WH-1000XM5',
            'preco' => 1899.90,
            'loja' => 'Amazon',
            'link' => 'https://amazon.com.br/sony',
        ]);

        $resAdd->assertStatus(201)
               ->assertJson(['sucesso' => true]);

        $idProd = $resAdd->json('produto.id_produto');

        $this->assertDatabaseHas('produtos_watchlist', [
            'id_produto' => $idProd,
            'usuario_id' => $this->userDuda->id_usuario,
            'nome' => 'Fone Sony WH-1000XM5',
        ]);

        // Remover produto
        $resDel = $this->deleteJson("/api/caixa-preta/produtos-watchlist/{$idProd}");
        $resDel->assertStatus(200)
               ->assertJson(['sucesso' => true]);

        $this->assertDatabaseMissing('produtos_watchlist', [
            'id_produto' => $idProd,
        ]);
    }

    public function test_lancar_gasto_imprevisto_compartilhado_com_rateio()
    {
        $this->actingAs($this->userDuda);

        // Lançar gasto imprevisto compartilhado
        $res = $this->postJson('/api/transacoes', [
            'tipo' => 'saida',
            'titulo' => 'Conserto Chuveiro Queimado',
            'valor' => 180.00,
            'conta_id' => $this->contaDuda->id_conta,
            'categoria_nome' => 'Moradia',
            'is_imprevisto' => true,
            'compartilhado' => true,
        ]);

        $res->assertStatus(201);

        $this->assertDatabaseHas('transacoes', [
            'usuario_id' => $this->userDuda->id_usuario,
            'titulo' => 'Conserto Chuveiro Queimado',
            'valor' => 180.00,
            'tipo' => 'saida',
            'visibilidade' => 'compartilhado',
        ]);
    }
}
