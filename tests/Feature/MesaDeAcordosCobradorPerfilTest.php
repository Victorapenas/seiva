<?php

namespace Tests\Feature;

use App\Models\Acordo;
use App\Models\Lar;
use App\Models\LarMembro;
use App\Models\Proposta;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * MesaDeAcordosCobradorPerfilTest
 * Valida a cobertura dos módulos:
 *  - RF006: Mesa de Acordos e Consenso Mútuo (Ian Marcos)
 *  - RF005: Cobrador Diplomata (Victor Hugo)
 *  - RF011: Perfil do Usuário e LGPD (Maria Eduarda)
 * 
 * Bordão Oficial: "Onde seu dinheiro cria raízes"
 */
class MesaDeAcordosCobradorPerfilTest extends TestCase
{
    use RefreshDatabase;

    private function criarCasalComLar(): array
    {
        $duda = Usuario::create([
            'nome' => 'Maria Eduarda',
            'email' => 'duda@seiva.com',
            'senha_hash' => bcrypt('123456'),
            'renda_mensal' => 4000.00,
            'chave_pix' => 'duda@seiva.com',
        ]);

        $ian = Usuario::create([
            'nome' => 'Ian Marcos',
            'email' => 'ian@seiva.com',
            'senha_hash' => bcrypt('123456'),
            'renda_mensal' => 6000.00,
            'chave_pix' => 'ian@seiva.com',
        ]);

        $lar = Lar::create([
            'nome' => 'Nosso Cantinho',
            'criado_por' => $duda->id_usuario,
        ]);

        LarMembro::create(['lar_id' => $lar->id_lar, 'usuario_id' => $duda->id_usuario, 'papel' => 'administrador', 'renda_declarada' => 4000]);
        LarMembro::create(['lar_id' => $lar->id_lar, 'usuario_id' => $ian->id_usuario, 'papel' => 'membro', 'renda_declarada' => 6000]);

        return [$duda, $ian, $lar];
    }

    public function test_mesa_acordos_retorna_estruturas_completas(): void
    {
        [$duda, $ian, $lar] = $this->criarCasalComLar();

        $res = $this->actingAs($duda)->getJson('/api/acordos');

        $res->assertStatus(200);
        $res->assertJsonStructure([
            'acordos',
            'propostas',
            'negociacoes_em_aberto',
            'poupando_juntos',
            'dividas_divididas',
        ]);

        $this->assertNotEmpty($res->json('negociacoes_em_aberto'));
        $this->assertNotEmpty($res->json('poupando_juntos'));
        $this->assertNotEmpty($res->json('dividas_divididas'));
    }

    public function test_criar_e_aceitar_proposta_acordo(): void
    {
        [$duda, $ian, $lar] = $this->criarCasalComLar();

        // Ian cria uma proposta de acordo
        $proposta = Proposta::create([
            'lar_id' => $lar->id_lar,
            'autor_id' => $ian->id_usuario,
            'tipo' => 'meta',
            'titulo' => 'Fogão Brastemp 5 bocas',
            'descricao' => 'Vamos juntar para trocar o fogão',
            'valor_total' => 1600.00,
            'divisao' => '50/50',
            'status' => 'pendente',
        ]);

        // Duda aceita
        $res = $this->actingAs($duda)->postJson("/api/acordos/propostas/votar/{$proposta->id_proposta}", [
            'acao' => 'aceitar',
        ]);

        $res->assertStatus(200);
        $res->assertJsonPath('sucesso', true);

        $this->assertEquals('aceita', $proposta->fresh()->status);
        $this->assertDatabaseHas('acordos', [
            'lar_id' => $lar->id_lar,
            'titulo' => 'Fogão Brastemp 5 bocas',
            'status' => 'ativo',
        ]);
    }

    public function test_recusar_e_contrapor_proposta(): void
    {
        [$duda, $ian, $lar] = $this->criarCasalComLar();

        $prop1 = Proposta::create([
            'lar_id' => $lar->id_lar,
            'autor_id' => $ian->id_usuario,
            'tipo' => 'divida',
            'titulo' => 'Item Teste Recusa',
            'valor_total' => 200.00,
            'divisao' => '50/50',
            'status' => 'pendente',
        ]);

        // Duda recusa
        $resRecusa = $this->actingAs($duda)->postJson("/api/acordos/propostas/votar/{$prop1->id_proposta}", [
            'acao' => 'recusar',
        ]);
        $resRecusa->assertStatus(200);
        $this->assertEquals('recusada', $prop1->fresh()->status);

        $prop2 = Proposta::create([
            'lar_id' => $lar->id_lar,
            'autor_id' => $ian->id_usuario,
            'tipo' => 'divida',
            'titulo' => 'Item Teste Contraproposta',
            'valor_total' => 289.90,
            'divisao' => '50/50',
            'status' => 'pendente',
        ]);

        // Duda contrapropõe R$ 50/mês
        $resContra = $this->actingAs($duda)->postJson("/api/acordos/propostas/votar/{$prop2->id_proposta}", [
            'acao' => 'contrapor',
            'novo_valor' => 50.00,
        ]);
        $resContra->assertStatus(200);
        $this->assertStringContainsString('50', $prop2->fresh()->mensagem);
    }

    public function test_cobrador_configurar_salva_na_sessao(): void
    {
        [$duda, $ian, $lar] = $this->criarCasalComLar();

        $res = $this->actingAs($duda)->postJson('/api/cobrancas/configurar', [
            'canal' => 'whatsapp',
            'dias_antecedencia' => 3,
        ]);

        $res->assertStatus(200);
        $res->assertJsonPath('sucesso', true);
        $res->assertSessionHas('cobrador_canal', 'whatsapp');
        $res->assertSessionHas('cobrador_dias_antecedencia', 3);
    }

    public function test_perfil_retorna_dados_completos_do_usuario_e_lar(): void
    {
        [$duda, $ian, $lar] = $this->criarCasalComLar();

        $res = $this->actingAs($duda)->getJson('/api/perfil');

        $res->assertStatus(200);
        $res->assertJsonPath('usuario.nome', 'Maria Eduarda');
        $res->assertJsonPath('usuario.email', 'duda@seiva.com');
        $res->assertJsonPath('lar.nome', 'Nosso Cantinho');
    }
}
