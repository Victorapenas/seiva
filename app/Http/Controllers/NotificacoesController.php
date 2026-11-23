<?php

namespace App\Http\Controllers;

use App\Models\Notificacao;
use App\Models\Cobranca;
use App\Models\Meta;
use App\Models\Conta;
use App\Models\ParticipacaoDespesa;
use App\Models\DespesaLar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/**
 * Controller: NotificacoesController
 * 
 * Responsabilidade Acadêmica: Ian Marcos Rocha Santos / Victor Hugo
 * Requisitos Atendidos: RF005, RF006, RF007, RF010 (Central Unificada de Notificações)
 * 
 * Por que fizemos assim:
 * Criamos uma central reativa onde os acontecimentos do sistema (propostas da Mesa de Acordos,
 * avisos do Cobrador Diplomata, novos convites do Lar e aportes em metas) convergem em um
 * único ponto de atenção para o usuário, permitindo marcar como lida e navegar para a ação.
 */
class NotificacoesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) return response()->json(['error' => 'Não autenticado'], 401);

        $userId = $user->id_usuario;
        $lar = $user->lares()->first();
        $notifs = [];

        $lidasAte = session('notificacoes_lidas_ate_' . $userId, 0);

        // ── 1. Notificações persistidas no banco ──────────────────────────────
        $dbNotifs = Notificacao::where('usuario_id', $userId)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        foreach ($dbNotifs as $n) {
            $isLida = (bool)$n->lida || ($lidasAte > 0 && $n->created_at && $n->created_at->timestamp <= $lidasAte);
            // Sanitiza emojis do titulo e mensagem antes de enviar ao frontend
            $titulo  = preg_replace('/[\x{1F300}-\x{1FAFF}\x{2600}-\x{27BF}]/u', '', $n->titulo ?? '');
            $mensagem = preg_replace('/[\x{1F300}-\x{1FAFF}\x{2600}-\x{27BF}]/u', '', $n->mensagem ?? '');
            $notifs[] = [
                'id'      => 'notif_' . $n->id_notificacao,
                'titulo'  => trim($titulo),
                'texto'   => trim($mensagem),
                'tipo'    => $n->tipo ?? 'info',
                'lida'    => $isLida,
                'tempo'   => $n->tempo ?? ($n->created_at ? Carbon::parse($n->created_at)->diffForHumans() : ''),
            ];
        }

        // ── 2. Cobranças pendentes recebidas (do parceiro de Lar) ─────────────
        if ($lar) {
            $cobrancas = Cobranca::where('destinatario_id', $userId)
                ->where('lar_id', $lar->id_lar)
                ->where('estado', 'pendente')
                ->with('criador')
                ->orderByDesc('created_at')
                ->limit(5)
                ->get();

            foreach ($cobrancas as $c) {
                $nomeCriador = $c->criador ? explode(' ', $c->criador->nome)[0] : 'Parceiro(a)';
                $isLida = $lidasAte > 0 && $c->created_at && $c->created_at->timestamp <= $lidasAte;
                $notifs[] = [
                    'id'     => 'cobranca_' . $c->id_cobranca,
                    'titulo' => "{$nomeCriador} pediu R$ " . number_format($c->valor, 2, ',', '.'),
                    'texto'  => $c->mensagem ?: $c->titulo,
                    'tipo'   => 'cobranca',
                    'lida'   => $isLida,
                    'tempo'  => $c->created_at ? Carbon::parse($c->created_at)->diffForHumans() : '',
                    'acao'   => [
                        'label' => 'Responder pedido', 
                        'fn' => "abrirModalResponderAjuda({$c->id_cobranca}, '{$nomeCriador}', {$c->valor}, '" . addslashes($c->mensagem ?: $c->titulo) . "')"
                    ],
                ];
            }

            // ── 3. Despesas do Lar que vencem em 3 dias ──────────────────────
            $hoje = now();
            $em3dias = now()->addDays(3);
            $mesAtual = now()->format('Y-m');

            $participacoesPendentes = ParticipacaoDespesa::where('usuario_id', $userId)
                ->join('despesas_lares', 'participacoes_despesas.despesa_lar_id', '=', 'despesas_lares.id_despesa_lar')
                ->where('despesas_lares.lar_id', $lar->id_lar)
                ->where('participacoes_despesas.pago', false)
                ->whereRaw("date(despesas_lares.data_vencimento) <= ?", [$em3dias->format('Y-m-d')])
                ->whereRaw("date(despesas_lares.data_vencimento) >= ?", [$hoje->format('Y-m-d')])
                ->select('participacoes_despesas.*', 'despesas_lares.titulo as despesa_titulo', 'despesas_lares.data_vencimento')
                ->get();

            foreach ($participacoesPendentes as $p) {
                $diasRestantes = $hoje->diffInDays(Carbon::parse($p->data_vencimento), false);
                $textoVenc = $diasRestantes === 0 ? 'Vence hoje!' : "Vence em {$diasRestantes} " . ($diasRestantes === 1 ? 'dia' : 'dias');
                $notifs[] = [
                    'id'    => 'despesa_' . $p->id_participacao,
                    'titulo' => "{$p->despesa_titulo} · R$ " . number_format($p->valor_parte, 2, ',', '.'),
                    'texto' => $textoVenc,
                    'tipo'  => 'alerta',
                    'lida'  => $lidasAte > 0,
                    'tempo' => $textoVenc,
                    'acao'  => ['label' => 'Registrar pagamento', 'fn' => "abrirModalRegistrarPagamento('part_{$p->id_participacao}')"],
                ];
            }
        }

        // ── 4. Faturas de cartão com saldo comprometido alto ──────────────────
        $cartoes = Conta::where('usuario_id', $userId)
            ->where('tipo', 'cartao')
            ->where('comprometido', '>', 0)
            ->get();

        foreach ($cartoes as $cartao) {
            $notifs[] = [
                'id'    => 'fatura_' . $cartao->id_conta,
                'titulo' => "Fatura {$cartao->nome} · R$ " . number_format($cartao->comprometido, 2, ',', '.'),
                'texto' => 'Valor comprometido aguardando registro',
                'tipo'  => 'alerta',
                'lida'  => $lidasAte > 0,
                'tempo' => 'Este mês',
                'acao'  => ['label' => 'Registrar fatura', 'fn' => "abrirModalRegistrarPagamento('conta_{$cartao->id_conta}')"],
            ];
        }

        // ── 5. Metas próximas de completar (> 85%) ───────────────────────────
        $metasQuaseCompletas = Meta::where('usuario_id', $userId)
            ->where('status', 'ativa')
            ->whereRaw('(valor_atual * 100.0 / valor_alvo) >= 85')
            ->get();

        foreach ($metasQuaseCompletas as $m) {
            $pct = $m->valor_alvo > 0 ? round(($m->valor_atual / $m->valor_alvo) * 100) : 0;
            if ($pct < 100) {
                $notifs[] = [
                    'id'    => 'meta_' . $m->id_meta,
                    'titulo' => "Meta \"{$m->titulo}\" quase lá! {$pct}%",
                    'texto' => 'Faltam R$ ' . number_format($m->valor_alvo - $m->valor_atual, 2, ',', '.') . ' para concluir',
                    'tipo'  => 'sucesso',
                    'lida'  => $lidasAte > 0,
                    'tempo' => 'Meta ativa',
                    'acao'  => ['label' => 'Guardar agora', 'fn' => "abrirModalGuardarMeta({$m->id_meta}, '{$m->titulo}', {$m->valor_atual}, {$m->valor_alvo})"],
                ];
            }
        }

        // Se não houver nada, mensagem de inbox limpo
        if (empty($notifs)) {
            $notifs[] = [
                'id'    => 'vazio',
                'titulo' => 'Tudo em dia!',
                'texto' => 'Nenhuma notificação pendente por aqui.',
                'tipo'  => 'sucesso',
                'lida'  => true,
                'tempo' => 'Agora',
            ];
        }

        return response()->json([
            'notificacoes' => $notifs,
            'total_nao_lidas' => collect($notifs)->where('lida', false)->count(),
        ]);
    }

    public function marcarTodasLidas(Request $request)
    {
        $user = Auth::user();
        if (!$user) return response()->json(['error' => 'Não autenticado'], 401);

        $id = $request->input('id');
        if ($id && str_starts_with($id, 'notif_')) {
            $notifId = str_replace('notif_', '', $id);
            Notificacao::where('usuario_id', $user->id_usuario)
                ->where('id_notificacao', $notifId)
                ->update(['lida' => true]);
        } else {
            Notificacao::where('usuario_id', $user->id_usuario)
                ->where('lida', false)
                ->update(['lida' => true]);

            session(['notificacoes_lidas_ate_' . $user->id_usuario => now()->timestamp]);
        }

        return response()->json(['ok' => true]);
    }
}
