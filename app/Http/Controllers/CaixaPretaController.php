<?php

namespace App\Http\Controllers;

use App\Models\RegistroCaixaPreta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaixaPretaController extends Controller
{
    public function verifyPin(Request $request)
    {
        $request->validate(['pin' => 'required|string']);
        $user = Auth::user();

        $savedPin = $user->pin_caixa_preta ?: '1234';

        if ($request->pin === $savedPin) {
            session(['caixa_preta_unlocked' => true]);
            return response()->json(['unlocked' => true, 'message' => 'Acesso concedido à Caixa Preta.']);
        }

        return response()->json(['unlocked' => false, 'error' => 'PIN incorreto.'], 403);
    }

    public function index()
    {
        $userId = Auth::id();
        $registros = RegistroCaixaPreta::where('usuario_id', $userId)
            ->orderBy('data', 'desc')
            ->get();

        $totalOculto = $registros->sum(function($r) {
            return (float) $r->valor_cifrado;
        });

        return response()->json([
            'registros' => $registros,
            'total_oculto' => $totalOculto,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0.01',
            'conta' => 'nullable|string',
            'data' => 'nullable|date',
        ]);

        $registro = RegistroCaixaPreta::create([
            'usuario_id' => Auth::id(),
            'titulo_cifrado' => $request->titulo,
            'valor_cifrado' => (string)$request->valor,
            'conta_cifrada' => $request->conta ?? 'Reserva Segreta',
            'data' => $request->data ?? now()->format('Y-m-d'),
            'bloqueado' => true,
        ]);

        return response()->json($registro, 201);
    }

    public function destroy($id)
    {
        $registro = RegistroCaixaPreta::where('usuario_id', Auth::id())
            ->where('id_registro_caixa_preta', $id)
            ->firstOrFail();

        $registro->delete();
        return response()->json(['message' => 'Registro excluído com segurança.']);
    }
}
