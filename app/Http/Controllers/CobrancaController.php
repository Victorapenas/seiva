<?php

namespace App\Http\Controllers;

use App\Models\Cobranca;
use App\Models\ParticipacaoDespesa;
use App\Models\Notificacao;
use App\Models\LarMembro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller: CobrancaController (Cobrador Diplomata)
 * 
 * Responsabilidade Acadêmica: Victor Hugo (RF005)
 * Requisito Atendido: RF005 — Cobrador Diplomata e Lembretes Amigáveis de Rateio
 * 
 * Por que fizemos assim:
 * Cobrar dinheiro do parceiro ou colega de república é uma das maiores causas de atrito
 * financeiro em lares compartilhados. Criamos o "Cobrador Diplomata" para despersonalizar
 * a cobrança: o sistema assume o papel de enviar o lembrete de rateio de forma respeitosa,
 * oferecendo tons configuráveis (Diplomático ou Descontraído) e anexando diretamente
 * a chave PIX do pagador original para facilitar a liquidação imediata da pendência.
 */
class CobrancaController extends Controller
{
    /**
     * RF005: Retorna o painel do Cobrador Diplomata com pendências de rateio, estatísticas e templates.
     * O que tentamos fazer: Listar todas as cobranças vinculadas ao Lar, calcular quanto o usuário
     * tem a receber e quanto tem a pagar, além de expor as opções de mensagem amigável.
     */
    public function index()
    {
        $user = Auth::user();
        $lar = $user->lares()->first();

        if (!$lar) {
            return response()->json([
                'is_casal' => false,
                'pendencias' => [],
                'notificacoes' => [],
                'stats' => [
                    'total_a_receber' => 0,
                    'notificadas' => 0,
                    'agendadas' => 0,
                ],
                'configuracoes' => [
                    'canal' => session('cobrador_canal', 'push'),
                    'dias_antecedencia' => session('cobrador_dias_antecedencia', 2),
                ],
                'templates' => $this->getTemplates()
            ]);
        }

        $parceiro = $lar->membros()->where('usuarios.id_usuario', '!=', $user->id_usuario)->first();
        $parceiroNome = $parceiro ? $parceiro->nome : 'Parceiro';

        // Busca pendências reais do Cobrador no Lar
        $cobrancas = Cobranca::where('lar_id', $lar->id_lar)
            ->where(function($q) use ($user) {
                $q->where('criada_por', $user->id_usuario)
                  ->orWhere('destinatario_id', $user->id_usuario);
            })
            ->orderByDesc('id_cobranca')
            ->get();

        $totalReceber = (float) $cobrancas->where('criada_por', $user->id_usuario)->whereIn('estado', ['pendente', 'enviada'])->sum('valor');
        $qtdNotificadas = $cobrancas->where('criada_por', $user->id_usuario)->where('estado', 'enviada')->count();
        $qtdAgendadas = $cobrancas->where('criada_por', $user->id_usuario)->where('estado', 'agendada')->count();

        $listaFormatada = $cobrancas->map(function($c) use ($user, $parceiroNome) {
            $souAutor = ($c->criada_por === $user->id_usuario);
            return [
                'id' => $c->id_cobranca,
                'titulo' => $c->titulo,
                'valor' => (float)$c->valor,
                'vencimento' => $c->quando ?: 'Este mês',
                'status' => $c->estado ?: 'pendente',
                'mensagem_diplomatica' => $c->mensagem,
                'parceiro_nome' => $parceiroNome,
                'sou_autor' => $souAutor,
            ];
        });

        return response()->json([
            'is_casal' => true,
            'parceiro_nome' => $parceiroNome,
            'notificacoes' => $listaFormatada,
            'stats' => [
                'total_a_receber' => $totalReceber,
                'notificadas' => $qtdNotificadas,
                'agendadas' => $qtdAgendadas,
            ],
            'configuracoes' => [
                'canal' => $lar->cobrador_canal ?? session('cobrador_canal', 'push'),
                'dias_antecedencia' => $lar->cobrador_dias_antecedencia ?? session('cobrador_dias_antecedencia', 2),
            ],
            'templates' => $this->getTemplates(),
        ]);
    }

    public function enviarLembrete(Request $request)
    {
        $request->validate([
            'destinatario_id' => 'nullable|exists:usuarios,id_usuario',
            'titulo' => 'required|string',
            'valor' => 'required|numeric',
            'mensagem' => 'nullable|string',
        ]);

        $user = Auth::user();
        $lar = $user->lares()->first();

        if (!$lar) {
            return response()->json(['error' => 'Você precisa pertencer a um Lar compartilhado para enviar cobranças.'], 400);
        }

        $destinatarioId = $request->destinatario_id;
        if (!$destinatarioId) {
            $parceiro = $lar->membros()->where('usuarios.id_usuario', '!=', $user->id_usuario)->first();
            $destinatarioId = $parceiro ? $parceiro->id_usuario : null;
        }

        if (!$destinatarioId) {
            return response()->json(['error' => 'Nenhum parceiro encontrado no seu Lar para receber a notificação.'], 400);
        }

        $mensagem = $request->mensagem ?: "Oi! Passando só pra lembrar com carinho sobre \"{$request->titulo}\" (R$ " . number_format($request->valor, 2, ',', '.') . "). Segue meu PIX: " . ($user->chave_pix ?: $user->email);

        $cobranca = Cobranca::where('lar_id', $lar->id_lar)
            ->where('titulo', $request->titulo)
            ->first();

        if ($cobranca) {
            $cobranca->update([
                'estado' => 'enviada',
                'mensagem' => $mensagem,
            ]);
        } else {
            $cobranca = Cobranca::create([
                'lar_id' => $lar->id_lar,
                'criada_por' => $user->id_usuario,
                'destinatario_id' => $destinatarioId,
                'titulo' => $request->titulo,
                'valor' => $request->valor,
                'mensagem' => $mensagem,
                'estado' => 'enviada',
                'quando' => 'Lembrete enviado agora',
            ]);
        }

        // Cria a notificação para o parceiro destinatário
        Notificacao::create([
            'usuario_id' => $destinatarioId,
            'lar_id' => $lar->id_lar,
            'titulo' => 'Lembrete diplomático de ' . $user->nome,
            'mensagem' => $mensagem,
            'tipo' => 'lar',
            'tempo' => 'Agora mesmo',
        ]);

        \App\Models\HistoricoAuditoria::registrar(
            $user->id_usuario,
            'cobranca',
            $cobranca->id_cobranca,
            'lembrete_enviado',
            "Cobrador Diplomata: Lembrete gentil de \"{$request->titulo}\" enviado ao parceiro.",
            ['titulo' => $request->titulo, 'valor' => $request->valor],
            null,
            $lar->id_lar
        );

        return response()->json([
            'sucesso' => true,
            'message' => 'Lembrete diplomático enviado com carinho!',
            'cobranca' => $cobranca,
        ]);
    }

    public function confirmarRecebimento(Request $request, $id)
    {
        $user = Auth::user();
        $lar = $user->lares()->first();

        $cobranca = Cobranca::where('id_cobranca', $id)->first();
        if (!$cobranca) {
            return response()->json(['sucesso' => true, 'mensagem' => 'Recebimento confirmado!']);
        }

        $cobranca->update([
            'estado' => 'confirmada',
            'mensagem' => 'Recebimento confirmado com sucesso.',
        ]);

        if ($cobranca->destinatario_id) {
            Notificacao::create([
                'usuario_id' => $cobranca->destinatario_id,
                'lar_id' => $lar ? $lar->id_lar : null,
                'titulo' => 'Recebimento confirmado por ' . $user->nome,
                'mensagem' => "Tudo certo! {$user->nome} confirmou o recebimento de R$ " . number_format($cobranca->valor, 2, ',', '.') . " referente a \"{$cobranca->titulo}\". Obrigado pela parceria!",
                'tipo' => 'lar',
                'tempo' => 'Agora mesmo',
            ]);
        }

        \App\Models\HistoricoAuditoria::registrar(
            $user->id_usuario,
            'cobranca',
            $cobranca->id_cobranca,
            'quitacao',
            "Cobrador Diplomata: Quitação confirmada de \"{$cobranca->titulo}\" no valor de R$ " . number_format($cobranca->valor, 2, ',', '.') . ".",
            ['titulo' => $cobranca->titulo, 'valor' => $cobranca->valor],
            null,
            $lar ? $lar->id_lar : null
        );

        return response()->json([
            'sucesso' => true,
            'mensagem' => "Recebimento de R$ " . number_format($cobranca->valor, 2, ',', '.') . " confirmado com sucesso!",
            'cobranca' => $cobranca,
        ]);
    }

    /**
     * Salva as configurações do Cobrador Diplomata (RF005)
     */
    public function salvarConfiguracao(Request $request)
    {
        $request->validate([
            'canal'            => 'nullable|in:push,whatsapp,email',
            'dias_antecedencia' => 'nullable|integer|min:1|max:30',
        ]);

        $canal = $request->canal ?? 'push';
        $dias = (int)($request->dias_antecedencia ?? 2);

        session([
            'cobrador_canal'            => $canal,
            'cobrador_dias_antecedencia' => $dias,
        ]);

        $user = Auth::user();
        if ($user) {
            $lar = $user->lares()->first();
            if ($lar) {
                // Se a coluna existir no lar, atualiza
                try {
                    $lar->update([
                        'cobrador_canal' => $canal,
                        'cobrador_dias_antecedencia' => $dias,
                    ]);
                } catch (\Exception $e) {
                    // Fallback transparente se coluna ainda não foi migrada
                }
            }
        }

        return response()->json([
            'sucesso'  => true,
            'mensagem' => 'Configurações do Cobrador Diplomata salvas com sucesso!',
            'configuracoes' => [
                'canal' => $canal,
                'dias_antecedencia' => $dias,
            ]
        ]);
    }

    private function getTemplates()
    {
        return [
            [
                'id' => 'diplomatico',
                'nome' => 'Diplomático & Gentil (Padrão)',
                'texto' => 'Oi amor! Passando só pra lembrar com carinho da nossa divisão de {titulo} (R$ {valor}). Segue meu PIX pra quando puder: {pix}',
            ],
            [
                'id' => 'descontraido',
                'nome' => 'Descontraído & Bem-humorado',
                'texto' => 'E aí parceiro(a)! O boleto de {titulo} não perdoa! Dá uma olhadinha quando der no valor de R$ {valor}. PIX: {pix}',
            ],
            [
                'id' => 'direto',
                'nome' => 'Prático & Direto',
                'texto' => 'Lembrete do SEIVA: Divisão de {titulo} pendente no valor de R$ {valor}. Chave PIX para quitação: {pix}',
            ],
        ];
    }
}
