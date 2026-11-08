<?php

namespace App\Http\Controllers;

use App\Models\Cobranca;
use App\Models\ParticipacaoDespesa;
use App\Models\Notificacao;
use App\Models\LarMembro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CobrancaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $lar = $user->lares()->first();

        if (!$lar) {
            return response()->json(['pendencias' => [], 'templates' => $this->getTemplates()]);
        }

        // Busca participações de despesas não quitadas de outros membros
        $pendencias = ParticipacaoDespesa::with(['despesa', 'usuario'])
            ->whereHas('despesa', function($q) use ($lar) {
                $q->where('lar_id', $lar->id_lar);
            })
            ->where('pago', false)
            ->where('usuario_id', '!=', $user->id_usuario)
            ->get();

        return response()->json([
            'pendencias' => $pendencias,
            'templates' => $this->getTemplates(),
        ]);
    }

    public function enviarLembrete(Request $request)
    {
        $request->validate([
            'destinatario_id' => 'required|exists:usuarios,id_usuario',
            'titulo' => 'required|string',
            'valor' => 'required|numeric',
            'mensagem' => 'required|string',
        ]);

        $user = Auth::user();
        $lar = $user->lares()->first();

        $cobranca = Cobranca::create([
            'lar_id' => $lar ? $lar->id_lar : 1,
            'criada_por' => $user->id_usuario,
            'destinatario_id' => $request->destinatario_id,
            'titulo' => $request->titulo,
            'valor' => $request->valor,
            'mensagem' => $request->mensagem,
            'estado' => 'enviada',
            'quando' => now()->diffForHumans(),
        ]);

        // Cria a notificação para o destinatário
        Notificacao::create([
            'usuario_id' => $request->destinatario_id,
            'lar_id' => $lar ? $lar->id_lar : null,
            'titulo' => '🌿 Lembrete diplomático de ' . $user->nome,
            'mensagem' => $request->mensagem . " | Chave PIX: " . ($user->chave_pix ?: $user->email),
            'tipo' => 'lar',
            'tempo' => 'Agora mesmo',
        ]);

        return response()->json([
            'message' => 'Lembrete diplomático enviado com carinho!',
            'cobranca' => $cobranca,
        ]);
    }

    private function getTemplates()
    {
        return [
            [
                'id' => 'diplomatico',
                'nome' => 'Diplomático & Gentil (Padrão)',
                'texto' => 'Oi amor! Passando só pra lembrar com carinho da nossa divisão de {titulo} (R$ {valor}). Segue meu PIX pra quando puder: {pix} 🌿💚',
            ],
            [
                'id' => 'descontraido',
                'nome' => 'Descontraído & Bem-humorado',
                'texto' => 'E aí parceiro(a)! O boleto de {titulo} não perdoa rs! Dá uma olhadinha quando der no valor de R$ {valor}. PIX: {pix} ☕✨',
            ],
            [
                'id' => 'direto',
                'nome' => 'Prático & Direto',
                'texto' => 'Lembrete do SEIVA: Divisão de {titulo} pendente no valor de R$ {valor}. Chave PIX para quitação: {pix}',
            ],
        ];
    }
}
