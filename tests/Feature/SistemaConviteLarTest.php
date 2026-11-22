<?php

namespace Tests\Feature;

use App\Models\ConviteLar;
use App\Models\Lar;
use App\Models\LarMembro;
use App\Models\Notificacao;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SistemaConviteLarTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_individual_pode_gerar_convite_criando_lar_automaticamente()
    {
        $user = Usuario::create([
            'nome' => 'Victor Hugo',
            'email' => 'victor@seiva.com',
            'senha_hash' => bcrypt('senha123'),
            'renda_mensal' => 5000,
        ]);

        $this->actingAs($user);

        $response = $this->postJson('/api/lar/convidar', [
            'email_convidado' => 'ana.luisa@gmail.com',
            'nome_lar' => 'Lar do Victor & Ana',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'sucesso' => true,
            ]);

        $this->assertDatabaseHas('convites_lar', [
            'convidado_por' => $user->id_usuario,
            'email_convidado' => 'ana.luisa@gmail.com',
            'status' => 'pendente',
        ]);

        // Verifica se o Lar foi criado e o usuário vinculado como admin
        $this->assertDatabaseHas('lares', [
            'nome' => 'Lar do Victor & Ana',
            'criado_por' => $user->id_usuario,
        ]);

        $this->assertDatabaseHas('lar_membros', [
            'usuario_id' => $user->id_usuario,
            'papel' => 'administrador',
        ]);
    }

    public function test_usuario_nao_pode_convidar_proprio_email()
    {
        $user = Usuario::create([
            'nome' => 'Victor Hugo',
            'email' => 'victor@seiva.com',
            'senha_hash' => bcrypt('senha123'),
        ]);

        $this->actingAs($user);

        $response = $this->postJson('/api/lar/convidar', [
            'email_convidado' => 'victor@seiva.com',
        ]);

        $response->assertStatus(422);
    }

    public function test_visualizacao_publica_de_convite_valido()
    {
        $remetente = Usuario::create([
            'nome' => 'Victor Hugo',
            'email' => 'victor@seiva.com',
            'senha_hash' => bcrypt('senha123'),
        ]);

        $lar = Lar::create([
            'nome' => 'Nosso Cantinho',
            'criado_por' => $remetente->id_usuario,
        ]);

        $convite = ConviteLar::create([
            'lar_id' => $lar->id_lar,
            'convidado_por' => $remetente->id_usuario,
            'email_convidado' => 'ana.luisa@gmail.com',
            'token_convite' => 'token_teste_123456789',
            'status' => 'pendente',
            'expira_em' => now()->addDays(7),
        ]);

        $response = $this->getJson('/api/convite/token_teste_123456789');

        $response->assertStatus(200)
            ->assertJson([
                'valido' => true,
                'email_convidado' => 'ana.luisa@gmail.com',
                'lar' => [
                    'nome' => 'Nosso Cantinho',
                ],
                'remetente' => [
                    'nome' => 'Victor Hugo',
                ],
            ]);
    }

    public function test_aceitar_convite_vincula_parceiro_ao_lar_e_notifica_remetente()
    {
        $remetente = Usuario::create([
            'nome' => 'Victor Hugo',
            'email' => 'victor@seiva.com',
            'senha_hash' => bcrypt('senha123'),
        ]);

        $lar = Lar::create([
            'nome' => 'Nosso Cantinho',
            'criado_por' => $remetente->id_usuario,
        ]);

        LarMembro::create([
            'lar_id' => $lar->id_lar,
            'usuario_id' => $remetente->id_usuario,
            'papel' => 'administrador',
            'renda_declarada' => 5000,
            'percentual_contribuicao' => 50,
            'aceito_em' => now(),
        ]);

        $convite = ConviteLar::create([
            'lar_id' => $lar->id_lar,
            'convidado_por' => $remetente->id_usuario,
            'email_convidado' => 'ana.luisa@gmail.com',
            'token_convite' => 'token_aceite_abc123',
            'status' => 'pendente',
            'expira_em' => now()->addDays(7),
        ]);

        $parceira = Usuario::create([
            'nome' => 'Ana Luísa',
            'email' => 'ana.luisa@gmail.com',
            'senha_hash' => bcrypt('senha123'),
            'renda_mensal' => 4500,
        ]);

        $this->actingAs($parceira);

        $response = $this->postJson('/api/lar/aceitar-convite', [
            'token' => 'token_aceite_abc123',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'sucesso' => true,
            ]);

        // Verifica que o convite foi marcado como aceito
        $this->assertDatabaseHas('convites_lar', [
            'id_convite_lar' => $convite->id_convite_lar,
            'status' => 'aceito',
        ]);

        // Verifica que a Ana agora é membro do Lar
        $this->assertDatabaseHas('lar_membros', [
            'lar_id' => $lar->id_lar,
            'usuario_id' => $parceira->id_usuario,
            'papel' => 'membro',
        ]);

        // Verifica que o remetente (Victor) recebeu notificação
        $this->assertDatabaseHas('notificacoes', [
            'usuario_id' => $remetente->id_usuario,
            'tipo' => 'lar',
        ]);
    }
}
