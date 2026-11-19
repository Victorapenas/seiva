<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Services\LocalAuthService;
use App\Services\GoogleAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * Controller AuthController
 * Gerencia os fluxos de autenticação, registro nativo e integração OAuth com o Google,
 * estruturado com princípios de Programação Orientada a Objetos (POO) e adoção
 * da extração de dados via extract($_POST) conforme metodologia acadêmica ensinada em sala.
 */
class AuthController extends Controller
{
    protected LocalAuthService $localAuthService;
    protected GoogleAuthService $googleAuthService;

    public function __construct(LocalAuthService $localAuthService, GoogleAuthService $googleAuthService)
    {
        $this->localAuthService = $localAuthService;
        $this->googleAuthService = $googleAuthService;
    }

    /**
     * Cadastro de novo usuário
     */
    public function register(Request $request)
    {
        // Garante que os dados da requisição estejam disponíveis na superglobal $_POST
        if (!empty($request->all())) {
            $_POST = array_merge($_POST, $request->all());
        }

        // Extrai os dados da requisição POST em variáveis separadas (Método acadêmico ensinado em sala)
        // Normaliza tipo_renda se vier "outros" ou em caixa alta
        if (!empty($_POST['tipo_renda'])) {
            $_POST['tipo_renda'] = strtolower(trim($_POST['tipo_renda']));
            if ($_POST['tipo_renda'] === 'outros') {
                $_POST['tipo_renda'] = 'outro';
            }
        }

        extract($_POST, EXTR_SKIP);

        $validator = Validator::make($_POST, [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'telefone' => 'nullable|string|max:30',
            'senha' => 'required|string|min:4',
            'tipo_renda' => 'nullable|string|in:clt,pj,autonomo,outro,empresario',
            'renda_mensal' => 'nullable|numeric|min:0',
            'renda_extra' => 'nullable|numeric|min:0',
            'saldo_inicial' => 'nullable|numeric|min:0',
            'dia_recebimento' => 'nullable|integer',
            'banco_principal' => 'nullable|string|max:100',
            'pin_caixa_preta' => 'nullable|string|max:10',
            'chave_pix' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        // Delega o provisionamento e regras de negócio para a classe de serviço (POO)
        $dadosUsuario = [
            'nome' => $nome ?? '',
            'email' => strtolower(trim($email ?? '')),
            'telefone' => $telefone ?? null,
            'senha' => $senha ?? '',
            'pin_caixa_preta' => !empty($pin_caixa_preta) ? $pin_caixa_preta : '1234',
            'tipo_renda' => !empty($tipo_renda) ? strtolower($tipo_renda) : 'clt',
            'renda_mensal' => isset($renda_mensal) ? (float)$renda_mensal : 0,
            'renda_extra' => isset($renda_extra) ? (float)$renda_extra : 0,
            'saldo_inicial' => isset($saldo_inicial) ? (float)$saldo_inicial : null,
            'banco_principal' => !empty($banco_principal) ? $banco_principal : 'Banco Principal',
            'chave_pix' => !empty($chave_pix) ? $chave_pix : ($email ?? ''),
            'dia_recebimento' => isset($dia_recebimento) ? (int)$dia_recebimento : 5,
        ];

        $usuario = $this->localAuthService->registrar($dadosUsuario);

        return response()->json([
            'message' => 'Cadastro realizado com sucesso!',
            'usuario' => $usuario->fresh(),
        ], 201);
    }

    /**
     * Login do usuário local
     */
    public function login(Request $request)
    {
        if (!empty($request->all())) {
            $_POST = array_merge($_POST, $request->all());
        }

        // Extrai os dados da requisição POST em variáveis separadas
        extract($_POST, EXTR_SKIP);

        $validator = Validator::make($_POST, [
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $usuario = $this->localAuthService->autenticar([
            'email' => $email ?? '',
            'senha' => $senha ?? '',
            'lembrar' => !empty($lembrar),
        ]);

        if (!$usuario) {
            return response()->json(['error' => 'E-mail ou senha incorretos.'], 401);
        }

        return response()->json([
            'message' => 'Login realizado com sucesso!',
            'usuario' => $usuario->load('lares'),
        ]);
    }

    /**
     * Autenticação via Google Identity Services / API do Google
     */
    public function googleLogin(Request $request)
    {
        if (!empty($request->all())) {
            $_POST = array_merge($_POST, $request->all());
        }

        // Extrai os dados da requisição POST em variáveis separadas
        extract($_POST, EXTR_SKIP);

        try {
            $usuario = $this->googleAuthService->autenticar($_POST);

            if (!$usuario) {
                return response()->json(['error' => 'Não foi possível validar o token da conta Google.'], 401);
            }

            return response()->json([
                'message' => 'Autenticado com sucesso via Google!',
                'usuario' => $usuario->load('lares'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Falha na comunicação com a API do Google: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Logout do usuário
     */
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return response()->json(['message' => 'Desconectado com sucesso.']);
    }

    /**
     * Retorna os dados do usuário autenticado na sessão
     */
    public function me()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['authenticated' => false], 401);
        }

        return response()->json([
            'authenticated' => true,
            'usuario' => $user->load('lares'),
        ]);
    }
}
