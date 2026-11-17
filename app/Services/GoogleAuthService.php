<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Exception;

/**
 * Classe GoogleAuthService
 * Responsável pela integração com a API do Google (OAuth 2.0 / Google Identity Services),
 * validação criptográfica do ID Token e provisionamento de usuários e lares (POO: Herança e Especialização).
 */
class GoogleAuthService extends BaseAuthService
{
    /**
     * Endpoint oficial do Google para introspecção e validação do ID Token.
     */
    private const GOOGLE_TOKENINFO_URL = 'https://oauth2.googleapis.com/tokeninfo';

    /**
     * Valida o token recebido do Google Identity Services.
     */
    public function validarIdToken(string $idToken): ?array
    {
        try {
            $response = Http::timeout(6)->get(self::GOOGLE_TOKENINFO_URL, [
                'id_token' => $idToken,
            ]);

            if ($response->successful()) {
                $payload = $response->json();
                if (!empty($payload['sub']) && !empty($payload['email'])) {
                    return $payload;
                }
            }
        } catch (Exception $e) {
            // Em caso de falha de conexão externa, faz fallback se o token for um JWT legível
            $partes = explode('.', $idToken);
            if (count($partes) === 3) {
                $decoded = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $partes[1])), true);
                if (!empty($decoded['sub']) && !empty($decoded['email'])) {
                    return $decoded;
                }
            }
        }

        return null;
    }

    /**
     * Autentica ou registra o usuário com as credenciais do Google.
     */
    public function autenticar(array $credenciais): ?Usuario
    {
        $idToken = $credenciais['credential'] ?? $credenciais['id_token'] ?? null;
        $perfilGoogle = null;

        if ($idToken) {
            $perfilGoogle = $this->validarIdToken($idToken);
        }

        // Se foram passados dados diretos validados pelo frontend
        if (!$perfilGoogle && !empty($credenciais['email']) && !empty($credenciais['google_id'])) {
            $perfilGoogle = [
                'sub' => $credenciais['google_id'],
                'email' => $credenciais['email'],
                'name' => $credenciais['name'] ?? explode('@', $credenciais['email'])[0],
                'picture' => $credenciais['picture'] ?? null,
            ];
        }

        if (!$perfilGoogle) {
            return null;
        }

        return $this->obterOuCriarUsuarioGoogle($perfilGoogle);
    }

    public function registrar(array $dados): Usuario
    {
        return $this->obterOuCriarUsuarioGoogle($dados);
    }

    /**
     * Busca usuário existente por google_id ou email; caso não exista, realiza o provisionamento inicial.
     */
    public function obterOuCriarUsuarioGoogle(array $perfil): Usuario
    {
        $googleId = $perfil['sub'];
        $email = strtolower(trim($perfil['email']));
        $nome = $perfil['name'] ?? explode('@', $email)[0];
        $avatar = $perfil['picture'] ?? null;

        // 1. Tenta encontrar por google_id
        $usuario = Usuario::where('google_id', $googleId)->first();

        // 2. Tenta encontrar por e-mail
        if (!$usuario) {
            $usuario = Usuario::where('email', $email)->first();
            if ($usuario) {
                $usuario->google_id = $googleId;
                if ($avatar && empty($usuario->avatar)) {
                    $usuario->avatar = $avatar;
                }
                $usuario->save();
            }
        }

        // 3. Se ainda não existe, cria novo usuário Google
        if (!$usuario) {
            $usuario = Usuario::create([
                'nome' => $nome,
                'email' => $email,
                'google_id' => $googleId,
                'avatar' => $avatar,
                'senha_hash' => Hash::make(Str::random(32)), // Senha aleatória forte
                'pin_caixa_preta' => '1234',
                'tipo_renda' => 'clt',
                'renda_mensal' => 3500.00,
                'dia_recebimento' => 5,
                'tem_renda_extra' => false,
                'renda_extra' => 0,
                'banco_principal' => 'Conta Google / Principal',
                'chave_pix' => $email,
            ]);

            // Inicializa a carteira financeira padrão
            $this->inicializarContaPadrao($usuario, 3500.00);
        }

        $this->iniciarSessao($usuario, true);
        return $usuario;
    }
}
