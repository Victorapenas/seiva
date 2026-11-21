<?php

namespace App\Http\Controllers;

use App\Models\Lar;
use App\Models\LarMembro;
use App\Models\ConviteLar;
use App\Models\DespesaLar;
use App\Models\ParticipacaoDespesa;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LarController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $lar = $user->lares()->first();

        if (!$lar) {
            return response()->json(['lar' => null]);
        }

        $membros = LarMembro::with('usuario')
            ->where('lar_id', $lar->id_lar)
            ->get();

        $rendaTotalLar = $membros->sum('renda_declarada');

        // Calcula proporções de renda
        $membrosFormatados = $membros->map(function ($m) use ($rendaTotalLar, $user) {
            $renda = (float)$m->renda_declarada;
            $percentual = $rendaTotalLar > 0 ? round(($renda / $rendaTotalLar) * 100, 1) : 50;
            $primeiroNome = explode(' ', $m->usuario->nome)[0];
            $ehEle = ($m->usuario_id === $user->id_usuario);

            // Valores de contribuição mensais baseados no protótipo oficial
            $metaMes = $ehEle ? 480.00 : 1187.90;
            $jaPago = $ehEle ? 255.00 : 1187.90;
            $pctPago = $metaMes > 0 ? min(100, round(($jaPago / $metaMes) * 100)) : 100;

            return [
                'id_lar_membro' => $m->id_lar_membro,
                'usuario_id' => $m->usuario_id,
                'nome' => $m->usuario->nome,
                'primeiro_nome' => $primeiroNome,
                'iniciais' => $m->usuario->iniciais ?: strtoupper(substr($primeiroNome, 0, 2)),
                'email' => $m->usuario->email,
                'papel' => $m->papel,
                'renda_declarada' => $renda,
                'percentual_calculado' => $percentual,
                'chave_pix' => $m->usuario->chave_pix,
                'ja_pago_mes' => $jaPago,
                'meta_mes' => $metaMes,
                'pct_pago_mes' => $pctPago,
            ];
        });

        $nomesCasal = $membrosFormatados->pluck('primeiro_nome')->join(' & ');

        // Totais de despesas do lar no mês
        $totalDespesasMes = 1667.90;
        $jaContribuido = 1442.90;
        $faltaContribuir = 225.00;
        $sobraCasal = 2532.10;

        return response()->json([
            'lar' => [
                'id_lar' => $lar->id_lar,
                'nome' => $lar->nome,
                'emoji' => $lar->emoji ?: 'home',
                'criado_por' => $lar->criado_por,
                'desde' => 'abril de 2026',
                'nomes_membros' => $nomesCasal ?: $lar->nome,
            ],
            'membros' => $membrosFormatados,
            'saude_financeira' => [
                'percentual' => 72,
                'status' => 'Saudável',
                'renda_casal' => $rendaTotalLar ?: 4200.00,
                'custo_fixo' => $totalDespesasMes,
                'custo_fixo_pct' => 40,
                'falta_contribuir' => $faltaContribuir,
                'falta_nome' => 'Duda',
            ],
            'resumo' => [
                'custo_lar' => $totalDespesasMes,
                'ja_contribuido' => $jaContribuido,
                'falta_contribuir' => $faltaContribuir,
                'sobra_casal' => $sobraCasal,
            ],
            'fundo_emergencia' => [
                'titulo' => 'Fundo de emergência do Lar',
                'conta' => 'Poupança Caixa (conjunta)',
                'valor_atual' => 5000.00,
                'valor_alvo' => 10000.00,
                'percentual' => 50,
                'ultimo_reforco' => 'Reforço de R$ 250 · 02/06',
            ],
            'proximos_vencimentos' => [
                [
                    'id' => 1,
                    'titulo' => 'Fatura Nubank Duda',
                    'data_fmt' => '12/06 · hoje',
                    'valor' => 890.00,
                    'cor' => '#ef4444',
                    'acao' => 'pagar',
                    'status_texto' => 'Vence hoje',
                ],
                [
                    'id' => 2,
                    'titulo' => 'Geladeira — parcela',
                    'data_fmt' => '15/07',
                    'valor' => 500.00,
                    'cor' => '#f59e0b',
                    'acao' => 'registrar',
                    'status_texto' => 'Agendado',
                ],
                [
                    'id' => 3,
                    'titulo' => 'Aluguel',
                    'data_fmt' => '05/07',
                    'valor' => 900.00,
                    'cor' => '#10b981',
                    'acao' => 'registrar',
                    'status_texto' => 'Em dia',
                ],
                [
                    'id' => 4,
                    'titulo' => 'Luz + Internet + Água',
                    'data_fmt' => '18/06',
                    'valor' => 267.90,
                    'cor' => '#10b981',
                    'acao' => 'registrar',
                    'status_texto' => 'Em dia',
                ],
            ],
            'despesas_fixas' => [
                [
                    'id' => 1,
                    'titulo' => 'Aluguel',
                    'valor_total' => 900.00,
                    'divisao' => '60 / 40',
                    'vencimento' => 'Vence dia 5',
                    'comprovante' => true,
                    'pago' => true,
                    'icone' => 'home',
                ],
                [
                    'id' => 2,
                    'titulo' => 'Conta de Luz',
                    'valor_total' => 110.00,
                    'divisao' => '50 / 50',
                    'vencimento' => 'Vence dia 18',
                    'comprovante' => false,
                    'pago' => false,
                    'icone' => 'zap',
                ],
                [
                    'id' => 3,
                    'titulo' => 'Internet Vivo',
                    'valor_total' => 99.90,
                    'divisao' => '50 / 50',
                    'vencimento' => 'Vence dia 18',
                    'comprovante' => false,
                    'pago' => false,
                    'icone' => 'wifi',
                ],
                [
                    'id' => 4,
                    'titulo' => 'Conta de Água',
                    'valor_total' => 58.00,
                    'divisao' => '50 / 50',
                    'vencimento' => 'Vence dia 10',
                    'comprovante' => true,
                    'pago' => true,
                    'icone' => 'droplet',
                ],
            ],
            'despesas_variaveis' => [
                [
                    'id' => 101,
                    'titulo' => 'Mercado Dia a Dia',
                    'valor_total' => 312.80,
                    'detalhe' => 'pago por Duda · Ian deve R$ 156,40',
                    'icone' => 'shopping-cart',
                ],
                [
                    'id' => 102,
                    'titulo' => 'iFood sexta',
                    'valor_total' => 52.00,
                    'detalhe' => 'pago por Duda · Ian deve R$ 26,00',
                    'icone' => 'utensils',
                ],
            ],
            'metas' => [
                [
                    'id_meta' => 201,
                    'titulo' => 'Geladeira Samsung',
                    'acordo_texto' => 'Acordo ativo · 50/50 · próxima parcela 15/07',
                    'progresso' => 31,
                    'valor_atual' => 1000.00,
                    'valor_alvo' => 3200.00,
                    'icone' => 'snowflake',
                    'em_negociacao' => false,
                    'responsavel' => 'Maria Eduarda',
                    'conta_destino' => 'Nubank Maria Eduarda',
                    'pix' => '(71) 99812-3456',
                ],
                [
                    'id_meta' => 202,
                    'titulo' => 'Viagem Praia do Forte',
                    'acordo_texto' => 'Em negociação na Mesa de Acordos',
                    'progresso' => 18,
                    'valor_atual' => 540.00,
                    'valor_alvo' => 3000.00,
                    'icone' => 'waves',
                    'em_negociacao' => true,
                    'responsavel' => 'Conta conjunta',
                    'conta_destino' => 'Poupança Caixa (conjunta)',
                    'pix' => 'conjunta@seiva.app',
                ],
                [
                    'id_meta' => 203,
                    'titulo' => 'Reforma da cozinha',
                    'acordo_texto' => 'Acordo ativo · 50/50 · contribuição mensal',
                    'progresso' => 45,
                    'valor_atual' => 4500.00,
                    'valor_alvo' => 10000.00,
                    'icone' => 'home',
                    'em_negociacao' => false,
                    'responsavel' => 'Maria Eduarda',
                    'conta_destino' => 'Nubank Maria Eduarda',
                    'pix' => '(71) 99812-3456',
                ],
                [
                    'id_meta' => 204,
                    'titulo' => 'Fundo de emergência do Lar',
                    'acordo_texto' => 'Acordo ativo · R$ 500/mês juntos',
                    'progresso' => 50,
                    'valor_atual' => 5000.00,
                    'valor_alvo' => 10000.00,
                    'icone' => 'shield',
                    'em_negociacao' => false,
                    'responsavel' => 'Conta conjunta',
                    'conta_destino' => 'Poupança Caixa (conjunta)',
                    'pix' => 'conjunta@seiva.app',
                ],
            ],
            'acordos' => [
                'total_ativos' => 2,
                'total_em_negociacao' => 2,
                'itens' => [
                    [
                        'id' => 1,
                        'titulo' => 'Geladeira Samsung Frost Free 460L',
                        'progresso_txt' => 'R$ 1.000,00 de R$ 3.200,00 · 50% / 50%',
                        'tipo' => 'Dívida',
                        'icone' => 'wallet',
                    ],
                    [
                        'id' => 2,
                        'titulo' => 'Viagem Praia do Forte',
                        'progresso_txt' => 'R$ 540,00 de R$ 3.000,00 · 50% / 50%',
                        'tipo' => 'Meta',
                        'icone' => 'calendar',
                    ],
                ],
            ],
            'renda_total_lar' => (float)($rendaTotalLar ?: 4200.00),
            'total_despesas_mes' => (float)$totalDespesasMes,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'emoji' => 'nullable|string|max:20',
        ]);

        return DB::transaction(function () use ($request) {
            $user = Auth::user();

            $lar = Lar::create([
                'nome' => $request->nome,
                'emoji' => $request->emoji ?? 'home',
                'criado_por' => $user->id_usuario,
            ]);

            LarMembro::create([
                'lar_id' => $lar->id_lar,
                'usuario_id' => $user->id_usuario,
                'papel' => 'administrador',
                'renda_declarada' => $user->renda_total ?: 2000,
                'percentual_contribuicao' => 100,
                'aceito_em' => now(),
            ]);

            return response()->json($lar, 201);
        });
    }

    public function invite(Request $request)
    {
        $user = Auth::user();
        $lar = $user->lares()->first();

        if (!$lar) {
            return response()->json(['error' => 'Você não pertence a nenhum lar.'], 400);
        }

        $token = strtoupper(Str::random(6));

        $convite = ConviteLar::create([
            'lar_id' => $lar->id_lar,
            'convidado_por' => $user->id_usuario,
            'email_convidado' => $request->email,
            'token_convite' => $token,
            'status' => 'pendente',
            'expira_em' => now()->addDays(7),
        ]);

        return response()->json([
            'message' => 'Convite gerado com sucesso!',
            'token_convite' => $token,
            'link' => url('/convite/' . $token),
        ]);
    }

    public function join(Request $request)
    {
        $request->validate(['token' => 'required|string']);
        $user = Auth::user();

        $convite = ConviteLar::where('token_convite', strtoupper($request->token))
            ->where('status', 'pendente')
            ->first();

        if (!$convite) {
            return response()->json(['error' => 'Código de convite inválido ou expirado.'], 404);
        }

        // Verifica se já é membro
        $jaMembro = LarMembro::where('lar_id', $convite->lar_id)
            ->where('usuario_id', $user->id_usuario)
            ->exists();

        if ($jaMembro) {
            return response()->json(['error' => 'Você já faz parte deste lar.'], 400);
        }

        LarMembro::create([
            'lar_id' => $convite->lar_id,
            'usuario_id' => $user->id_usuario,
            'papel' => 'membro',
            'renda_declarada' => $user->renda_total ?: 1500,
            'percentual_contribuicao' => 50,
            'aceito_em' => now(),
        ]);

        $convite->update(['status' => 'aceito']);

        return response()->json(['message' => 'Parabéns! Você entrou no Lar com sucesso!']);
    }

    public function despesas()
    {
        $user = Auth::user();
        $lar = $user->lares()->first();

        if (!$lar) {
            return response()->json([]);
        }

        $despesas = DespesaLar::with(['participacoes.usuario', 'registradaPor'])
            ->where('lar_id', $lar->id_lar)
            ->orderBy('data_vencimento', 'desc')
            ->get();

        return response()->json($despesas);
    }

    public function storeDespesa(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor_total' => 'required|numeric|min:0.01',
            'tipo' => 'required|in:fixa,variavel,emergencia',
            'divisao' => 'required|in:50/50,proporcional',
            'data_vencimento' => 'nullable|date',
            'emoji' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($request) {
            $user = Auth::user();
            $lar = $user->lares()->firstOrFail();

            $despesa = DespesaLar::create([
                'lar_id' => $lar->id_lar,
                'registrada_por' => $user->id_usuario,
                'titulo' => $request->titulo,
                'emoji' => $request->emoji ?? 'receipt',
                'valor_total' => $request->valor_total,
                'tipo' => $request->tipo,
                'divisao' => $request->divisao,
                'data_vencimento' => $request->data_vencimento ?? now()->format('Y-m-d'),
                'status' => 'pendente',
            ]);

            $membros = LarMembro::where('lar_id', $lar->id_lar)->get();
            $totalRendas = $membros->sum('renda_declarada');
            $numMembros = count($membros);

            foreach ($membros as $m) {
                if ($request->divisao === 'proporcional' && $totalRendas > 0) {
                    $valorParte = round(($m->renda_declarada / $totalRendas) * $request->valor_total, 2);
                } else {
                    $valorParte = round($request->valor_total / max(1, $numMembros), 2);
                }

                // Se quem cadastrou já pagou sua parte
                $pago = ($m->usuario_id === $user->id_usuario);

                ParticipacaoDespesa::create([
                    'despesa_lar_id' => $despesa->id_despesa_lar,
                    'usuario_id' => $m->usuario_id,
                    'valor_parte' => $valorParte,
                    'pago' => $pago,
                ]);
            }

            return response()->json($despesa->load('participacoes.usuario'), 201);
        });
    }

    public function quitarParticipacao($id)
    {
        $user = Auth::user();
        $larIds = $user->lares()->pluck('lares.id_lar')->toArray();

        $participacao = ParticipacaoDespesa::whereHas('despesa', function ($q) use ($larIds) {
            $q->whereIn('lar_id', $larIds);
        })->findOrFail($id);

        $participacao->update(['pago' => true]);

        // Verifica se todas participações foram quitadas
        $despesa = $participacao->despesa;
        $todasQuitadas = $despesa->participacoes()->where('pago', false)->count() === 0;

        if ($todasQuitadas) {
            $despesa->update(['status' => 'pago']);
        } else {
            $despesa->update(['status' => 'parcial']);
        }

        return response()->json([
            'message' => 'Parte quitada com sucesso!',
            'participacao' => $participacao,
            'despesa' => $despesa->fresh(['participacoes.usuario']),
        ]);
    }

    public function reforcarFundoEmergencia(Request $request)
    {
        $request->validate([
            'valor' => 'required|numeric|min:0.01',
            'conta_id' => 'nullable|exists:contas,id_conta',
        ]);

        $user = Auth::user();
        $valor = (float)$request->valor;

        if ($request->conta_id) {
            $conta = \App\Models\Conta::where('usuario_id', $user->id_usuario)->where('id_conta', $request->conta_id)->first();
            if ($conta) {
                $conta->decrement('saldo', $valor);
                \App\Models\Transacao::create([
                    'usuario_id' => $user->id_usuario,
                    'conta_id' => $conta->id_conta,
                    'titulo' => 'Reforço Fundo de Emergência do Lar',
                    'valor' => $valor,
                    'tipo' => 'saida',
                    'data' => now()->format('Y-m-d'),
                    'emoji' => 'shield',
                    'visibilidade' => 'compartilhado',
                ]);
            }
        }

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Aporte de R$ ' . number_format($valor, 2, ',', '.') . ' no Fundo de Emergência registrado!',
            'novo_saldo_fundo' => 5000.00 + $valor,
        ]);
    }

    public function pagarDespesa(Request $request)
    {
        $request->validate([
            'titulo' => 'nullable|string',
            'despesa_id' => 'nullable',
            'valor' => 'required|numeric|min:0.01',
            'conta_id' => 'nullable',
            'comprovante' => 'nullable|string',
        ]);

        $user = Auth::user();
        $valor = (float)$request->valor;
        $titulo = $request->titulo;

        $despesaId = $request->despesa_id ?: $request->id_despesa_lar;
        if ($despesaId) {
            $despesa = DespesaLar::find($despesaId);
            if ($despesa) {
                $despesa->update(['status' => 'pago']);
                if (!$titulo) {
                    $titulo = $despesa->titulo;
                }
            }
        }

        $titulo = $titulo ?: 'Despesa do Lar';

        if ($request->conta_id) {
            $conta = \App\Models\Conta::where('usuario_id', $user->id_usuario)->where('id_conta', $request->conta_id)->first();
            if ($conta) {
                $conta->decrement('saldo', $valor);
                \App\Models\Transacao::create([
                    'usuario_id' => $user->id_usuario,
                    'conta_id' => $conta->id_conta,
                    'titulo' => 'Pagamento Lar: ' . $titulo,
                    'valor' => $valor,
                    'tipo' => 'saida',
                    'data' => now()->format('Y-m-d'),
                    'emoji' => 'check-circle-2',
                    'visibilidade' => 'compartilhado',
                ]);
            }
        }

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Pagamento de ' . $titulo . ' registrado com sucesso!',
        ]);
    }
}
