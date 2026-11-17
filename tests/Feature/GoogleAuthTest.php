<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GoogleAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_google_authentication_registers_and_authenticates_user(): void
    {
        $payload = [
            'google_id' => 'google_sub_987654',
            'name' => 'Maria Silva Teste',
            'email' => 'maria.silva@gmail.com',
            'picture' => 'https://lh3.googleusercontent.com/test.jpg',
        ];

        $response = $this->postJson('/api/auth/google', $payload);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'message',
                     'usuario' => ['id_usuario', 'nome', 'email', 'google_id']
                 ]);

        $this->assertDatabaseHas('usuarios', [
            'email' => 'maria.silva@gmail.com',
            'google_id' => 'google_sub_987654',
        ]);
    }
}
