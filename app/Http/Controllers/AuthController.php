<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|string|min:4',
            'tipo_renda' => 'nullable|string|in:clt,pj,autonomo,outro',
            'renda_mensal' => 'nullable|numeric|min:0',
            'renda_extra' => 'nullable|numeric|min:0',
            'banco_principal' => 'nullable|string|max:100',
            'pin_caixa_preta' => 'nullable|string|max:10',
            'chave_pix' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $usuario = Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone ?? null,
            'senha_hash' => Hash::make($request->senha),
            'pin_caixa_preta' => $request->pin_caixa_preta ?: '1234',
            'tipo_renda' => $request->tipo_renda ?? 'clt',
            'renda_mensal' => $request->renda_mensal ?? 0,
            'tem_renda_extra' => !empty($request->renda_extra),
            'renda_extra' => $request->renda_extra ?? 0,
            'banco_principal' => $request->banco_principal ?? 'Banco Principal',
            'chave_pix' => $request->chave_pix ?? $request->email,
        ]);

        // Criar conta corrente padrão
        Conta::create([
            'usuario_id' => $usuario->id_usuario,
            'nome' => $usuario->banco_principal ?: 'Conta Principal',
            'tipo' => 'corrente',
            'saldo' => $usuario->renda_mensal,
            'funcao' => 'gasto',
            'cor' => '#10b981',
            'chave_pix' => $usuario->chave_pix,
        ]);

        Auth::login($usuario);

        return response()->json([
            'message' => 'Cadastro realizado com sucesso!',
            'usuario' => $usuario->fresh(),
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->senha, $usuario->senha_hash)) {
            return response()->json(['error' => 'E-mail ou senha incorretos.'], 401);
        }

        Auth::login($usuario, true);

        return response()->json([
            'message' => 'Login realizado com sucesso!',
            'usuario' => $usuario->load('lares'),
        ]);
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return response()->json(['message' => 'Desconectado com sucesso.']);
    }

    public function me()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['authenticated' => false], 401);
        }

        $user->load(['lares.membros', 'contas']);
        $lar = $user->lares->first();

        return response()->json([
            'authenticated' => true,
            'usuario' => $user,
            'lar' => $lar,
        ]);
    }
}
