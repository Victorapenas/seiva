<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RecuperacaoSenhaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Usuario::create([
            'nome' => 'Quételi Teste',
            'email' => 'queteli@seiva.com',
            'senha_hash' => bcrypt('senhaAntiga123'),
            'tipo_renda' => 'clt',
            'renda_mensal' => 3500.00,
            'banco_principal' => 'Nubank',
            'pin_caixa_preta' => '1234',
        ]);
    }

    public function test_tela_esqueci_senha_retorna_sucesso(): void
    {
        $response = $this->get('/esqueci-senha');
        $response->assertStatus(200);
        $response->assertSee('Recuperar Senha');
    }

    public function test_solicitar_recuperacao_cria_token_e_envia_email(): void
    {
        $response = $this->postJson('/esqueci-senha', [
            'email' => 'queteli@seiva.com'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Se este e-mail estiver cadastrado, você receberá as instruções em breve.'
        ]);

        $this->assertDatabaseHas('recuperacao_senha_tokens', [
            'email' => 'queteli@seiva.com',
        ]);
    }

    public function test_solicitar_com_email_inexistente_mantem_mesma_mensagem_de_seguranca(): void
    {
        $response = $this->postJson('/esqueci-senha', [
            'email' => 'inexistente@seiva.com'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Se este e-mail estiver cadastrado, você receberá as instruções em breve.'
        ]);

        $this->assertDatabaseMissing('recuperacao_senha_tokens', [
            'email' => 'inexistente@seiva.com',
        ]);
    }

    public function test_tela_redefinir_senha_com_token_retorna_sucesso(): void
    {
        $token = Str::random(60);
        $response = $this->get('/redefinir-senha/' . $token);
        $response->assertStatus(200);
        $response->assertSee('Criar Nova Senha');
        $response->assertSee($token);
    }

    public function test_redefinir_senha_com_sucesso_permite_novo_login(): void
    {
        $token = Str::random(60);
        DB::table('recuperacao_senha_tokens')->insert([
            'email' => 'queteli@seiva.com',
            'token' => $token,
            'criado_em' => now(),
        ]);

        $response = $this->postJson('/redefinir-senha', [
            'token' => $token,
            'nova_senha' => 'novaSenha456',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Senha redefinida com sucesso!']);

        // Token deve ter sido excluído
        $this->assertDatabaseMissing('recuperacao_senha_tokens', [
            'token' => $token,
        ]);

        // Login deve funcionar com a nova senha
        $this->assertTrue(Auth::attempt([
            'email' => 'queteli@seiva.com',
            'password' => 'novaSenha456'
        ]));
    }

    public function test_redefinir_com_token_invalido_retorna_erro(): void
    {
        $response = $this->postJson('/redefinir-senha', [
            'token' => 'token_totalmente_invalido_123',
            'nova_senha' => 'novaSenha456',
        ]);

        $response->assertStatus(422);
        $response->assertJson(['message' => 'Token inválido ou expirado.']);
    }
}
