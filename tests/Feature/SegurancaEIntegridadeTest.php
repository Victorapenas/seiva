<?php

namespace Tests\Feature;

use App\Models\Conta;
use App\Models\Lar;
use App\Models\LarMembro;
use App\Models\Meta;
use App\Models\Projeto;
use App\Models\Proposta;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Teste de Segurança, Isolamento e Integridade da Lógica de Negócio
 */
class SegurancaEIntegridadeTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_nao_pode_lancar_transacao_em_conta_de_outro_usuario(): void
    {
        $u1 = Usuario::create([
            'nome' => 'Alice Morais',
            'email' => 'alice@teste.com',
            'senha_hash' => bcrypt('123456'),
        ]);

        $u2 = Usuario::create([
            'nome' => 'Bob Santos',
            'email' => 'bob@teste.com',
            'senha_hash' => bcrypt('123456'),
        ]);

        $contaBob = Conta::create([
            'usuario_id' => $u2->id_usuario,
            'nome' => 'Nubank Bob',
            'tipo' => 'corrente',
            'saldo' => 1000.00,
        ]);

        // Alice tenta lançar gasto na conta do Bob
        $res = $this->actingAs($u1)->postJson('/api/transacoes', [
            'titulo' => 'Ataque IDOR',
            'valor' => 500.00,
            'tipo' => 'saida',
            'conta_id' => $contaBob->id_conta,
        ]);

        $res->assertStatus(403);
        $this->assertEquals(1000.00, $contaBob->fresh()->saldo);
    }

    public function test_usuario_sem_lar_nao_pode_enviar_cobranca(): void
    {
        $u1 = Usuario::create([
            'nome' => 'Carla Solo',
            'email' => 'carla@teste.com',
            'senha_hash' => bcrypt('123456'),
        ]);

        $u2 = Usuario::create([
            'nome' => 'Daniel Solo',
            'email' => 'daniel@teste.com',
            'senha_hash' => bcrypt('123456'),
        ]);

        $res = $this->actingAs($u1)->postJson('/api/cobrancas/lembrete', [
            'destinatario_id' => $u2->id_usuario,
            'titulo' => 'Aluguel',
            'valor' => 200.00,
            'mensagem' => 'Me pague',
        ]);

        $res->assertStatus(400);
    }

    public function test_usuario_nao_pode_votar_em_proposta_de_outro_lar(): void
    {
        $u1 = Usuario::create([
            'nome' => 'Lar A Dono',
            'email' => 'lara@teste.com',
            'senha_hash' => bcrypt('123456'),
        ]);

        $u2 = Usuario::create([
            'nome' => 'Lar B Dono',
            'email' => 'larb@teste.com',
            'senha_hash' => bcrypt('123456'),
        ]);

        $larA = Lar::create(['nome' => 'Lar Alpha', 'criado_por' => $u1->id_usuario]);
        LarMembro::create(['lar_id' => $larA->id_lar, 'usuario_id' => $u1->id_usuario, 'papel' => 'administrador', 'renda_declarada' => 3000]);

        $larB = Lar::create(['nome' => 'Lar Beta', 'criado_por' => $u2->id_usuario]);
        LarMembro::create(['lar_id' => $larB->id_lar, 'usuario_id' => $u2->id_usuario, 'papel' => 'administrador', 'renda_declarada' => 3000]);

        $propostaA = Proposta::create([
            'lar_id' => $larA->id_lar,
            'autor_id' => $u1->id_usuario,
            'tipo' => 'meta',
            'titulo' => 'Comprar Geladeira',
            'valor_total' => 2500.00,
            'descricao' => 'Proposta interna Lar Alpha',
            'status' => 'pendente',
        ]);

        // Usuário do Lar B tenta votar na proposta do Lar A
        $res = $this->actingAs($u2)->postJson("/api/acordos/propostas/votar/{$propostaA->id_proposta}", [
            'acao' => 'aceitar',
        ]);

        $res->assertStatus(404);
    }

    public function test_exclusao_de_conta_lgpd_elimina_completamente_os_vinculos(): void
    {
        $user = Usuario::create([
            'nome' => 'Fernanda LGPD',
            'email' => 'fernanda@lgpd.com',
            'senha_hash' => bcrypt('123456'),
            'renda_mensal' => 4500.00,
        ]);

        Conta::create([
            'usuario_id' => $user->id_usuario,
            'nome' => 'Inter',
            'tipo' => 'corrente',
            'saldo' => 200.00,
        ]);

        Meta::create([
            'usuario_id' => $user->id_usuario,
            'responsavel_id' => $user->id_usuario,
            'titulo' => 'Viagem',
            'valor_alvo' => 3000.00,
        ]);

        $res = $this->actingAs($user)->deleteJson('/api/perfil/excluir');
        $res->assertStatus(200);

        $this->assertDatabaseMissing('usuarios', ['id_usuario' => $user->id_usuario]);
        $this->assertDatabaseMissing('contas', ['usuario_id' => $user->id_usuario]);
        $this->assertDatabaseMissing('metas', ['usuario_id' => $user->id_usuario]);
    }
}
