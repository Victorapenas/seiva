<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Lar;
use App\Models\Conta;
use App\Models\Categoria;
use App\Models\DespesaLar;
use App\Dominio\Casal;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Teste: FluxoIndividualECasalTest
 * Valida de ponta a ponta o funcionamento dos dois modos principais do SEIVA:
 * 1. Controle Individual (finanças pessoais, contas isoladas, extrato e Caixa Preta protegida).
 * 2. Casal Compartilhado (gestão a dois, cálculo de rateio 55/45, despesas conjuntas e privacidade individual preservada).
 * 
 * Responsáveis Acadêmicos: Quételi (RF001), Jhon Abner (RF004/RF010) e Victor Hugo (RF002/RF003).
 */
class FluxoIndividualECasalTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Garante as categorias do sistema disponíveis
        $this->seed();
    }

    /**
     * Teste do Cenário 1: Usuário no modo Individual (Sem Lar compartilhado).
     */
    public function test_fluxo_completo_usuario_individual(): void
    {
        // 1. Cadastro com dados pessoais completos
        $payloadCadastro = [
            'nome' => 'Lucas Almeida',
            'email' => 'lucas@individual.com',
            'telefone' => '(71) 98111-2233',
            'senha' => 'senhaLucas123',
            'tipo_renda' => 'clt',
            'renda_mensal' => 4200.00,
            'dia_recebimento' => 5,
            'renda_extra' => 0,
            'saldo_inicial' => 1500.00,
            'banco_principal' => 'Nubank',
            'chave_pix' => 'lucas@individual.com',
            'pin_caixa_preta' => '7788',
        ];

        $resCadastro = $this->postJson('/api/register', $payloadCadastro);
        $resCadastro->assertStatus(201)
                    ->assertJsonPath('usuario.email', 'lucas@individual.com')
                    ->assertJsonPath('usuario.nome', 'Lucas Almeida');

        $usuario = Usuario::where('email', 'lucas@individual.com')->first();
        $this->assertNotNull($usuario);
        $this->assertEquals(4200.00, (float)$usuario->renda_mensal);
        $this->assertEquals('7788', $usuario->pin_caixa_preta);

        // 2. Verifica se a conta individual foi criada com o saldo informado
        $conta = Conta::where('usuario_id', $usuario->id_usuario)->first();
        $this->assertNotNull($conta);
        $this->assertEquals('Nubank', $conta->nome);
        $this->assertEquals(1500.00, (float)$conta->saldo);

        // 3. Garante que NÃO foi criado nenhum Lar para o usuário individual
        $this->assertCount(0, $usuario->fresh()->lares);

        // 4. Teste de Autenticação / Login
        $resLogin = $this->postJson('/api/login', [
            'email' => 'lucas@individual.com',
            'senha' => 'senhaLucas123',
        ]);
        $resLogin->assertStatus(200);

        // 5. Teste do Dashboard Individual
        $resDash = $this->actingAs($usuario)->getJson('/api/dashboard');
        $resDash->assertStatus(200);
        $this->assertEquals(1500.00, (float)$resDash->json('resumo.saldo_livre'));

        // 6. Lançamento de Gasto Pessoal Individual
        $categoria = Categoria::first();
        $resGasto = $this->actingAs($usuario)->postJson('/api/transacoes', [
            'tipo' => 'saida',
            'titulo' => 'Almoço Individual',
            'valor' => 200.00,
            'conta_id' => $conta->id_conta,
            'categoria_id' => $categoria->id_categoria,
        ]);
        $resGasto->assertStatus(201);

        // Verifica saldo atualizado após o gasto
        $this->assertEquals(1300.00, (float)$conta->fresh()->saldo);

        // 7. Teste de Segurança da Caixa Preta com PIN
        // PIN incorreto -> Bloqueado com HTTP 403 Forbidden
        $resPinInvalido = $this->actingAs($usuario)->postJson('/api/caixa-preta/verificar-pin', [
            'pin' => '0000',
        ]);
        $resPinInvalido->assertStatus(403)
                       ->assertJson(['unlocked' => false]);

        // PIN correto -> Desbloqueado com sucesso (HTTP 200)
        $resPinValido = $this->actingAs($usuario)->postJson('/api/caixa-preta/verificar-pin', [
            'pin' => '7788',
        ]);
        $resPinValido->assertStatus(200)
                     ->assertJson(['unlocked' => true]);
    }

    /**
     * Teste do Cenário 2: Casal Compartilhado (Duda & Ian no Lar 'Nosso Cantinho').
     */
    public function test_fluxo_completo_casal_compartilhado(): void
    {
        // 1. Cadastro da Duda (Membro A do Casal - CLT R$ 5.500)
        $resDuda = $this->postJson('/api/register', [
            'nome' => 'Maria Eduarda Lima',
            'email' => 'duda@casal.com',
            'telefone' => '(71) 99111-2222',
            'senha' => 'senhaDuda123',
            'tipo_renda' => 'clt',
            'renda_mensal' => 5500.00,
            'saldo_inicial' => 3000.00,
            'banco_principal' => 'Nubank',
            'chave_pix' => 'duda@casal.com',
            'pin_caixa_preta' => '1234',
        ]);
        $resDuda->assertStatus(201);
        $duda = Usuario::where('email', 'duda@casal.com')->first();

        // 2. Duda cria o Lar compartilhado 'Nosso Cantinho 🌿'
        $resLar = $this->actingAs($duda)->postJson('/api/lar', [
            'nome' => 'Nosso Cantinho',
            'emoji' => '🌿',
        ]);
        $resLar->assertStatus(201);
        $lar = Lar::where('nome', 'Nosso Cantinho')->first();
        $this->assertNotNull($lar);
        $this->assertEquals($duda->id_usuario, $lar->criado_por);

        // 3. Cadastro do Ian (Membro B do Casal - Autônomo R$ 4.500)
        $resIan = $this->postJson('/api/register', [
            'nome' => 'Ian Ribeiro',
            'email' => 'ian@casal.com',
            'telefone' => '(71) 99333-4444',
            'senha' => 'senhaIan123',
            'tipo_renda' => 'autonomo',
            'renda_mensal' => 4500.00,
            'saldo_inicial' => 2000.00,
            'banco_principal' => 'Inter',
            'chave_pix' => 'ian@casal.com',
            'pin_caixa_preta' => '9876',
        ]);
        $resIan->assertStatus(201);
        $ian = Usuario::where('email', 'ian@casal.com')->first();

        // 4. Ian entra no Lar do casal
        $dominioCasal = new Casal($lar);
        $dominioCasal->adicionarMembro($ian, 'membro');

        $this->assertCount(2, $lar->fresh()->membros);

        // 5. Verificação Matemática do Rateio Proporcional Justo (55% / 45%)
        $rateio = $dominioCasal->calcularRateioProporcional();
        $membroDuda = $rateio->firstWhere('id_usuario', $duda->id_usuario);
        $membroIan = $rateio->firstWhere('id_usuario', $ian->id_usuario);

        $this->assertEquals(55.0, (float)$membroDuda['percentual_calculado']);
        $this->assertEquals(45.0, (float)$membroIan['percentual_calculado']);

        // 6. Lançamento de Despesa Compartilhada do Lar: Aluguel R$ 2.000,00
        $resDesp = $this->actingAs($duda)->postJson('/api/lar/despesas', [
            'titulo' => 'Aluguel do Lar',
            'valor_total' => 2000.00,
            'divisao' => 'proporcional',
            'tipo' => 'fixa',
            'data_vencimento' => '2026-12-10',
        ]);
        $resDesp->assertStatus(201);

        $despesa = DespesaLar::where('titulo', 'Aluguel do Lar')->first();
        $this->assertNotNull($despesa);
        $this->assertEquals(2000.00, (float)$despesa->valor_total);

        // 7. Envio de Lembrete Diplomático do SEIVA
        $resLembrete = $this->actingAs($duda)->postJson('/api/cobrancas/lembrete', [
            'destinatario_id' => $ian->id_usuario,
            'titulo' => 'Aluguel do Lar',
            'valor' => 900.00, // 45% de R$ 2.000
            'mensagem' => 'Oi Ian! Lembrete carinhoso do nosso aluguel 🌿',
        ]);
        $resLembrete->assertStatus(200)
                    ->assertJson(['message' => 'Lembrete diplomático enviado com carinho!']);

        // 8. Teste de Privacidade Individual DENTRO do Casal (Caixas Pretas Isoladas)
        // Duda testa com o PIN dela (1234) -> Sucesso (HTTP 200)
        $resDudaPin = $this->actingAs($duda)->postJson('/api/caixa-preta/verificar-pin', ['pin' => '1234']);
        $resDudaPin->assertStatus(200)->assertJson(['unlocked' => true]);

        // Duda tenta com o PIN do Ian (9876) -> Bloqueada (HTTP 403)
        $resDudaPinErr = $this->actingAs($duda)->postJson('/api/caixa-preta/verificar-pin', ['pin' => '9876']);
        $resDudaPinErr->assertStatus(403)->assertJson(['unlocked' => false]);

        // Ian testa com o PIN dele (9876) -> Sucesso (HTTP 200)
        $resIanPin = $this->actingAs($ian)->postJson('/api/caixa-preta/verificar-pin', ['pin' => '9876']);
        $resIanPin->assertStatus(200)->assertJson(['unlocked' => true]);

        // Ian tenta com o PIN da Duda (1234) -> Bloqueado (HTTP 403)
        $resIanPinErr = $this->actingAs($ian)->postJson('/api/caixa-preta/verificar-pin', ['pin' => '1234']);
        $resIanPinErr->assertStatus(403)->assertJson(['unlocked' => false]);
    }
}
