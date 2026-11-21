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
}
