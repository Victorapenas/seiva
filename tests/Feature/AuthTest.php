<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Lar;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_login_with_poo_and_extracted_post(): void
    {
        $dadosCadastro = [
            'nome' => 'Victor Hugo Sousa',
            'email' => 'victor@seiva.app',
            'senha' => 'senhaSegura123',
            'tipo_renda' => 'clt',
            'renda_mensal' => 5000.00,
            'saldo_inicial' => 4500.00,
            'pin_caixa_preta' => '4321',
            'banco_principal' => 'Nubank',
        ];

        $registerRes = $this->postJson('/api/register', $dadosCadastro);
        $registerRes->assertStatus(201)
                    ->assertJsonPath('usuario.email', 'victor@seiva.app');

        $this->assertDatabaseHas('usuarios', [
            'email' => 'victor@seiva.app',
            'pin_caixa_preta' => '4321',
        ]);

        $this->assertDatabaseHas('contas', [
            'nome' => 'Nubank',
            'saldo' => 4500.00,
        ]);

        // Teste de Logout
        $logoutRes = $this->postJson('/api/logout');
        $logoutRes->assertStatus(200);

        // Teste de Login com lembrar
        $loginRes = $this->postJson('/api/login', [
            'email' => 'victor@seiva.app',
            'senha' => 'senhaSegura123',
            'lembrar' => true,
        ]);

        $loginRes->assertStatus(200)
                 ->assertJsonPath('usuario.email', 'victor@seiva.app');
    }

    public function test_multiple_couples_and_isolated_homes(): void
    {
        // Casal 1
        $userA = Usuario::create([
            'nome' => 'Casal 1 Morador A',
            'email' => 'casal1.a@seiva.app',
            'senha_hash' => bcrypt('123456'),
            'renda_mensal' => 4000,
        ]);
        $lar1 = Lar::create([
            'nome' => 'Lar Casal 1',
            'emoji' => '🏠',
            'criado_por' => $userA->id_usuario,
        ]);
        $userA->lares()->attach($lar1->id_lar, ['papel' => 'administrador', 'renda_declarada' => 4000]);

        // Casal 2
        $userB = Usuario::create([
            'nome' => 'Casal 2 Morador B',
            'email' => 'casal2.b@seiva.app',
            'senha_hash' => bcrypt('123456'),
            'renda_mensal' => 7000,
        ]);
        $lar2 = Lar::create([
            'nome' => 'Lar Casal 2',
            'emoji' => '🌿',
            'criado_por' => $userB->id_usuario,
        ]);
        $userB->lares()->attach($lar2->id_lar, ['papel' => 'administrador', 'renda_declarada' => 7000]);

        $this->assertEquals(1, $userA->lares()->count());
        $this->assertEquals('Lar Casal 1', $userA->lares()->first()->nome);

        $this->assertEquals(1, $userB->lares()->count());
        $this->assertEquals('Lar Casal 2', $userB->lares()->first()->nome);
        $this->assertNotEquals($userA->lares()->first()->id_lar, $userB->lares()->first()->id_lar);
    }
}
