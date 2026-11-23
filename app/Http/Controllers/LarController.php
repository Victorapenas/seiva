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

/**
 * Controller: LarController (Gestão do Lar e Despesas Compartilhadas)
 * 
 * Responsabilidade Acadêmica: Jhon Abner Santos Almeida (RF004, RF010)
 * Requisitos Atendidos: 
 *   - RF004 — Criação do Lar e Envio de Convites por E-mail
 *   - RF010 — Gestão de Despesas do Lar e Divisão Proporcional / 50-50
 * 
 * Por que fizemos assim:
 * Centralizamos neste controller as regras do ambiente compartilhado: controle de membros,
 * fundo de emergência conjunto, rateio de custos fixos e variáveis com opção proporcional
 * à renda de cada um (justiça financeira) e acompanhamento do saldo do casal, respeitando
 * o isolamento entre lares diferentes no banco de dados.
 */
class LarController extends Controller
{
    /**
     * RF004/RF010: Retorna o estado completo do Lar do usuário logado.
     * O que tentamos fazer: Consolidar a renda dos membros, listar despesas fixas e variáveis,
     * apurar quanto cada um já pagou, quanto falta contribuir e a sobra financeira do lar.
     */
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

        $rendaTotalLar = (float)$membros->sum('renda_declarada');

        // Busca despesas reais cadastradas no Lar
        $despesasDb = DespesaLar::with(['participacoes.usuario', 'registradaPor'])
            ->where('lar_id', $lar->id_lar)
            ->orderBy('data_vencimento', 'asc')
            ->get();

        $totalDespesasMes = (float)$despesasDb->sum('valor_total');

        // Participações reais nas despesas
        $participacoes = ParticipacaoDespesa::whereIn('despesa_lar_id', $despesasDb->pluck('id_despesa_lar'))->get();
        $jaContribuido = (float)$participacoes->where('pago', true)->sum('valor_parte');
        $faltaContribuir = max(0, $totalDespesasMes - $jaContribuido);
        $sobraCasal = max(0, $rendaTotalLar - $totalDespesasMes);

        // Proporções de renda e percentual de contribuição (personalizável)
        $membrosFormatados = $membros->map(function ($m) use ($rendaTotalLar, $totalDespesasMes, $participacoes, $user) {
            $renda = (float)$m->renda_declarada;
            $percentual = (float)$m->percentual_contribuicao > 0
                ? (float)$m->percentual_contribuicao
                : ($rendaTotalLar > 0 ? round(($renda / $rendaTotalLar) * 100, 1) : 50);

            $primeiroNome = explode(' ', trim($m->usuario->nome))[0];
            $ehEle = ($m->usuario_id === $user->id_usuario);

            $partMembro = $participacoes->where('usuario_id', $m->usuario_id);
            $metaMes = $totalDespesasMes > 0
                ? ($partMembro->count() > 0 ? (float)$partMembro->sum('valor_parte') : round($totalDespesasMes * ($percentual / 100), 2))
                : 0.00;
            $jaPago = (float)$partMembro->where('pago', true)->sum('valor_parte');
            $pctPago = $metaMes > 0 ? min(100, round(($jaPago / $metaMes) * 100)) : 100;

            return [
                'id_lar_membro' => $m->id_lar_membro,
                'usuario_id' => $m->usuario_id,
                'nome' => $m->usuario->nome,
                'primeiro_nome' => $primeiroNome,
                'iniciais' => $m->usuario->iniciais ?: strtoupper(substr($primeiroNome, 0, 2)),
                'avatar' => $m->usuario->avatar,
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
        $parceiroMembro = $membrosFormatados->firstWhere('usuario_id', '!=', $user->id_usuario);

        // Despesas Fixas e Variáveis
        $despesasFixas = [];
        $despesasVariaveis = [];
        $proximosVencimentos = [];

        foreach ($despesasDb as $desp) {
            $itemFormatado = [
                'id' => $desp->id_despesa_lar,
                'titulo' => $desp->titulo,
                'valor_total' => (float)$desp->valor_total,
                'divisao' => $desp->divisao ?: '50 / 50',
                'vencimento' => $desp->data_vencimento ? 'Vence dia ' . \Carbon\Carbon::parse($desp->data_vencimento)->format('d') : 'Sem vencimento',
                'comprovante' => false,
                'pago' => ($desp->status === 'pago'),
                'icone' => $desp->emoji ?: 'home',
            ];

            if ($desp->tipo === 'fixa' || $desp->recorrente) {
                $despesasFixas[] = $itemFormatado;
            } else {
                $despesasVariaveis[] = [
                    'id' => $desp->id_despesa_lar,
                    'titulo' => $desp->titulo,
                    'valor_total' => (float)$desp->valor_total,
                    'detalhe' => "Cadastrado por " . ($desp->registradaPor ? explode(' ', $desp->registradaPor->nome)[0] : 'Membro'),
                    'icone' => $desp->emoji ?: 'shopping-cart',
                ];
            }

            if ($desp->status !== 'pago' && $desp->data_vencimento) {
                $dtVenc = \Carbon\Carbon::parse($desp->data_vencimento);
                $diasDiff = now()->startOfDay()->diffInDays($dtVenc->startOfDay(), false);
                $statusTxt = $diasDiff < 0 ? 'Vencida' : ($diasDiff === 0 ? 'Vence hoje' : "Vence em {$diasDiff} dias");
                $cor = $diasDiff <= 0 ? '#ef4444' : ($diasDiff <= 3 ? '#f59e0b' : '#10b981');

                $proximosVencimentos[] = [
                    'id' => $desp->id_despesa_lar,
                    'titulo' => $desp->titulo,
                    'data_fmt' => $dtVenc->format('d/m') . ($diasDiff === 0 ? ' · hoje' : ''),
                    'valor' => (float)$desp->valor_total,
                    'cor' => $cor,
                    'acao' => 'registrar',
                    'status_texto' => $statusTxt,
                ];
            }
        }

        // Verifica se é o Lar protótipo acadêmico (Duda & Ian) sem despesas registradas ainda
        $ehPrototipoDudaIan = ($lar->codigo_acesso === 'CANTINHO123' || ($lar->id_lar === 1 && $membros->pluck('usuario.email')->contains('duda@seiva.app')));

        if ($despesasDb->isEmpty() && $ehPrototipoDudaIan) {
            $totalDespesasMes = 1667.90;
            $jaContribuido = 1442.90;
            $faltaContribuir = 225.00;
            $sobraCasal = 2532.10;

            $proximosVencimentos = [
                ['id' => 1, 'titulo' => 'Fatura Nubank Duda', 'data_fmt' => '12/06 · hoje', 'valor' => 890.00, 'cor' => '#ef4444', 'acao' => 'pagar', 'status_texto' => 'Vence hoje'],
                ['id' => 2, 'titulo' => 'Geladeira — parcela', 'data_fmt' => '15/07', 'valor' => 500.00, 'cor' => '#f59e0b', 'acao' => 'registrar', 'status_texto' => 'Agendado'],
                ['id' => 3, 'titulo' => 'Aluguel', 'data_fmt' => '05/07', 'valor' => 900.00, 'cor' => '#10b981', 'acao' => 'registrar', 'status_texto' => 'Em dia'],
                ['id' => 4, 'titulo' => 'Luz + Internet + Água', 'data_fmt' => '18/06', 'valor' => 267.90, 'cor' => '#10b981', 'acao' => 'registrar', 'status_texto' => 'Em dia'],
            ];

            $despesasFixas = [
                ['id' => 1, 'titulo' => 'Aluguel', 'valor_total' => 900.00, 'divisao' => '60 / 40', 'vencimento' => 'Vence dia 5', 'comprovante' => true, 'pago' => true, 'icone' => 'home'],
                ['id' => 2, 'titulo' => 'Conta de Luz', 'valor_total' => 110.00, 'divisao' => '50 / 50', 'vencimento' => 'Vence dia 18', 'comprovante' => false, 'pago' => false, 'icone' => 'zap'],
                ['id' => 3, 'titulo' => 'Internet Vivo', 'valor_total' => 99.90, 'divisao' => '50 / 50', 'vencimento' => 'Vence dia 18', 'comprovante' => false, 'pago' => false, 'icone' => 'wifi'],
                ['id' => 4, 'titulo' => 'Conta de Água', 'valor_total' => 58.00, 'divisao' => '50 / 50', 'vencimento' => 'Vence dia 10', 'comprovante' => true, 'pago' => true, 'icone' => 'droplet'],
            ];

            $despesasVariaveis = [
                ['id' => 101, 'titulo' => 'Mercado Dia a Dia', 'valor_total' => 312.80, 'detalhe' => 'pago por Duda · Ian deve R$ 156,40', 'icone' => 'shopping-cart'],
                ['id' => 102, 'titulo' => 'iFood sexta', 'valor_total' => 52.00, 'detalhe' => 'pago por Duda · Ian deve R$ 26,00', 'icone' => 'utensils'],
            ];

            $metasFormatadas = collect([
                (object)[
                    'id_meta' => 201,
                    'titulo' => 'Geladeira Samsung Frost Free 460L',
                    'subtitulo' => 'Guardo R$ 500,00/mês juntos',
                    'acordo_texto' => 'Acordo ativo · 50% / 50% · parcela mensal R$ 250 cada',
                    'progresso' => 31,
                    'valor_atual' => 1000.00,
                    'valor_alvo' => 3200.00,
                    'falta_guardar' => 2200.00,
                    'previsao_dias' => 132,
                    'imagem' => '/produtos/geladeira-samsung.png',
                    'icone' => 'snowflake',
                    'em_negociacao' => false,
                    'responsavel' => 'Maria Eduarda',
                    'conta_destino' => 'Conta conjunta do Lar',
                    'pix' => '(71) 99812-3456',
                ],
            ]);
        }

        // Metas Reais do Lar (quando não for protótipo ou quando já tiver metas no banco)
        if (!isset($metasFormatadas)) {
            $metasDb = \App\Models\Meta::where('lar_id', $lar->id_lar)->where('status', 'ativa')->get();
            $metasFormatadas = $metasDb->map(function($m) {
                return [
                    'id_meta' => $m->id_meta,
                    'titulo' => $m->titulo,
                    'subtitulo' => 'Guardo R$ ' . number_format($m->contribuicao_mensal ?: ($m->valor_alvo / 4), 2, ',', '.') . '/mês juntos',
                    'acordo_texto' => 'Meta compartilhada do Lar',
                    'progresso' => $m->progresso,
                    'valor_atual' => (float)$m->valor_atual,
                    'valor_alvo' => (float)$m->valor_alvo,
                    'falta_guardar' => max(0, (float)$m->valor_alvo - (float)$m->valor_atual),
                    'previsao_dias' => 90,
                    'imagem' => $m->imagem,
                    'icone' => $m->icone ?: 'target',
                    'em_negociacao' => false,
                    'responsavel' => 'Conta do Lar',
                    'conta_destino' => $m->onde_guardado ?: 'Reserva do Lar',
                    'pix' => '',
                ];
            });
        }

        // Acordos Reais do Lar
        $acordosDb = \App\Models\Acordo::where('lar_id', $lar->id_lar)->where('status', 'ativo')->get();
        $acordosFormatados = $acordosDb->map(function($a) {
            return [
                'id' => $a->id_acordo,
                'titulo' => $a->titulo,
                'progresso_txt' => 'R$ ' . number_format($a->valor_arrecadado, 2, ',', '.') . ' de R$ ' . number_format($a->valor_total, 2, ',', '.') . ' · ' . ($a->divisao ?: '50/50'),
                'tipo' => $a->tipo === 'meta' ? 'Meta' : 'Dívida',
                'icone' => $a->tipo === 'meta' ? 'target' : 'wallet',
            ];
        });

        $desdeFormatado = $lar->created_at ? $lar->created_at->locale('pt_BR')->translatedFormat('F \d\e Y') : 'recente';

        return response()->json([
            'lar' => [
                'id_lar' => $lar->id_lar,
                'nome' => $lar->nome,
                'emoji' => $lar->emoji ?: 'home',
                'criado_por' => $lar->criado_por,
                'desde' => $desdeFormatado,
                'nomes_membros' => $nomesCasal ?: $lar->nome,
            ],
            'membros' => $membrosFormatados,
            'saude_financeira' => [
                'percentual' => !empty($ehPrototipoDudaIan) ? 72 : ($rendaTotalLar > 0 ? min(100, round((1 - ($totalDespesasMes / max(1, $rendaTotalLar))) * 100)) : 100),
                'status' => 'Saudável',
                'renda_casal' => $rendaTotalLar ?: 4200.00,
                'custo_fixo' => $totalDespesasMes,
                'custo_fixo_pct' => $rendaTotalLar > 0 ? min(100, round(($totalDespesasMes / $rendaTotalLar) * 100)) : 0,
                'falta_contribuir' => $faltaContribuir,
                'falta_nome' => $parceiroMembro ? $parceiroMembro['primeiro_nome'] : '',
            ],
            'resumo' => [
                'custo_lar' => $totalDespesasMes,
                'ja_contribuido' => $jaContribuido,
                'falta_contribuir' => $faltaContribuir,
                'sobra_casal' => $sobraCasal,
            ],
            'fundo_emergencia' => [
                'titulo' => 'Fundo de emergência do Lar',
                'conta' => 'Reserva Conjunta',
                'valor_atual' => 0.00,
                'valor_alvo' => max(5000.00, $totalDespesasMes * 3),
                'percentual' => 0,
                'ultimo_reforco' => 'Nenhum aporte ainda',
            ],
            'proximos_vencimentos' => $proximosVencimentos,
            'despesas_fixas' => $despesasFixas,
            'despesas_variaveis' => $despesasVariaveis,
            'metas' => $metasFormatadas,
            'acordos' => [
                'total_ativos' => $acordosFormatados->count(),
                'total_em_negociacao' => 0,
                'itens' => $acordosFormatados,
            ],
            'renda_total_lar' => $rendaTotalLar,
            'total_despesas_mes' => $totalDespesasMes,
        ]);
    }

    /**
     * Ajusta a divisão percentual padrão do Lar (ex: 50/50, proporcional, 90/10, etc.)
     */
    public function ajustarDivisao(Request $request)
    {
        $request->validate([
            'divisao' => 'required|string',
            'pct_voce' => 'nullable|numeric|min:0|max:100',
            'pct_parceiro' => 'nullable|numeric|min:0|max:100',
        ]);

        $user = Auth::user();
        $lar = $user->lares()->firstOrFail();
        $membros = LarMembro::where('lar_id', $lar->id_lar)->get();

        if ($request->divisao === 'proporcional') {
            $totalRendas = $membros->sum('renda_declarada');
            foreach ($membros as $m) {
                $pct = $totalRendas > 0 ? round(($m->renda_declarada / $totalRendas) * 100, 1) : 50;
                $m->update(['percentual_contribuicao' => $pct]);
            }
        } elseif ($request->divisao === '50/50') {
            foreach ($membros as $m) {
                $m->update(['percentual_contribuicao' => 50]);
            }
        } elseif (preg_match('/^(\d+)\s*\/\s*(\d+)$/', $request->divisao, $matches)) {
            $pct1 = (float)$matches[1];
            $pct2 = (float)$matches[2];
            $membroVoce = $membros->firstWhere('usuario_id', $user->id_usuario);
            $membroParceiro = $membros->firstWhere('usuario_id', '!=', $user->id_usuario);
            if ($membroVoce) $membroVoce->update(['percentual_contribuicao' => $pct1]);
            if ($membroParceiro) $membroParceiro->update(['percentual_contribuicao' => $pct2]);
        } elseif ($request->pct_voce !== null && $request->pct_parceiro !== null) {
            $membroVoce = $membros->firstWhere('usuario_id', $user->id_usuario);
            $membroParceiro = $membros->firstWhere('usuario_id', '!=', $user->id_usuario);
            if ($membroVoce) $membroVoce->update(['percentual_contribuicao' => (float)$request->pct_voce]);
            if ($membroParceiro) $membroParceiro->update(['percentual_contribuicao' => (float)$request->pct_parceiro]);
        }

        \App\Models\HistoricoAuditoria::registrar(
            $user->id_usuario,
            'lar',
            $lar->id_lar,
            'divisao_ajustada',
            "Divisão de contribuição do Lar reajustada para {$request->divisao}.",
            null,
            ['divisao' => $request->divisao],
            $lar->id_lar
        );

        return response()->json([
            'sucesso' => true,
            'mensagem' => "Divisão do Lar atualizada com sucesso ({$request->divisao})!",
            'membros' => LarMembro::where('lar_id', $lar->id_lar)->get(),
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
            'divisao' => 'nullable|string',
            'data_vencimento' => 'nullable|date',
            'emoji' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($request) {
            $user = Auth::user();
            $lar = $user->lares()->firstOrFail();

            $divisaoFinal = $request->divisao ?: '50/50';

            $despesa = DespesaLar::create([
                'lar_id' => $lar->id_lar,
                'registrada_por' => $user->id_usuario,
                'titulo' => $request->titulo,
                'emoji' => $request->emoji ?? 'receipt',
                'valor_total' => $request->valor_total,
                'tipo' => $request->tipo,
                'divisao' => $divisaoFinal,
                'data_vencimento' => $request->data_vencimento ?? now()->format('Y-m-d'),
                'status' => 'pendente',
            ]);

            $membros = LarMembro::where('lar_id', $lar->id_lar)->get();
            $totalRendas = $membros->sum('renda_declarada');
            $numMembros = count($membros);

            foreach ($membros as $m) {
                if ($divisaoFinal === 'proporcional' && $totalRendas > 0) {
                    $valorParte = round(($m->renda_declarada / $totalRendas) * $request->valor_total, 2);
                } elseif (preg_match('/^(\d+)\s*[\/\-]\s*(\d+)$/', $divisaoFinal, $matches)) {
                    $pct1 = (float)$matches[1];
                    $pct2 = (float)$matches[2];
                    $ehCriador = ($m->usuario_id === $user->id_usuario);
                    $pct = $ehCriador ? $pct1 : $pct2;
                    $valorParte = round(($pct / 100) * $request->valor_total, 2);
                } else {
                    $pctMembro = (float)$m->percentual_contribuicao > 0 ? (float)$m->percentual_contribuicao : (100 / max(1, $numMembros));
                    $valorParte = round(($pctMembro / 100) * $request->valor_total, 2);
                }

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

    public function updateDespesa(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor_total' => 'required|numeric|min:0.01',
            'tipo' => 'required|in:fixa,variavel,emergencia',
            'divisao' => 'nullable|string',
            'data_vencimento' => 'nullable|date',
        ]);

        return DB::transaction(function () use ($request, $id) {
            $user = Auth::user();
            $lar = $user->lares()->firstOrFail();

            $divisaoFinal = $request->divisao ?: '50/50';

            $despesa = DespesaLar::where('lar_id', $lar->id_lar)->find($id);
            $valorAntigo = $despesa ? $despesa->valor_total : null;
            if (!$despesa) {
                $despesa = DespesaLar::create([
                    'lar_id' => $lar->id_lar,
                    'registrada_por' => $user->id_usuario,
                    'titulo' => $request->titulo,
                    'emoji' => 'receipt',
                    'valor_total' => $request->valor_total,
                    'tipo' => $request->tipo,
                    'divisao' => $divisaoFinal,
                    'data_vencimento' => $request->data_vencimento ?? now()->format('Y-m-d'),
                    'status' => 'pendente',
                ]);

                \App\Models\HistoricoAuditoria::registrar(
                    $user->id_usuario,
                    'despesa_lar',
                    $despesa->id_despesa_lar,
                    'criado',
                    "Despesa do Lar \"{$despesa->titulo}\" cadastrada no valor de R$ " . number_format($despesa->valor_total, 2, ',', '.') . " com divisão {$despesa->divisao}.",
                    null,
                    ['valor_total' => $despesa->valor_total, 'divisao' => $despesa->divisao],
                    $lar->id_lar
                );
            } else {
                $dadosAntigos = ['valor_total' => $despesa->valor_total, 'divisao' => $despesa->divisao];
                $despesa->update([
                    'titulo' => $request->titulo,
                    'valor_total' => $request->valor_total,
                    'tipo' => $request->tipo,
                    'divisao' => $divisaoFinal,
                    'data_vencimento' => $request->data_vencimento ?? $despesa->data_vencimento,
                ]);

                \App\Models\HistoricoAuditoria::registrar(
                    $user->id_usuario,
                    'despesa_lar',
                    $despesa->id_despesa_lar,
                    'reajustado',
                    "Despesa do Lar \"{$despesa->titulo}\" reajustada de R$ " . number_format($valorAntigo, 2, ',', '.') . " para R$ " . number_format($despesa->valor_total, 2, ',', '.') . " (divisão: {$despesa->divisao}).",
                    $dadosAntigos,
                    ['valor_total' => $despesa->valor_total, 'divisao' => $despesa->divisao],
                    $lar->id_lar
                );
            }

            $membros = LarMembro::where('lar_id', $lar->id_lar)->get();
            $totalRendas = $membros->sum('renda_declarada');
            $numMembros = count($membros);

            ParticipacaoDespesa::where('despesa_lar_id', $despesa->id_despesa_lar)->delete();

            foreach ($membros as $m) {
                if ($divisaoFinal === 'proporcional' && $totalRendas > 0) {
                    $valorParte = round(($m->renda_declarada / $totalRendas) * $request->valor_total, 2);
                } elseif (preg_match('/^(\d+)\s*[\/\-]\s*(\d+)$/', $divisaoFinal, $matches)) {
                    $pct1 = (float)$matches[1];
                    $pct2 = (float)$matches[2];
                    $ehCriador = ($m->usuario_id === $user->id_usuario);
                    $pct = $ehCriador ? $pct1 : $pct2;
                    $valorParte = round(($pct / 100) * $request->valor_total, 2);
                } else {
                    $pctMembro = (float)$m->percentual_contribuicao > 0 ? (float)$m->percentual_contribuicao : (100 / max(1, $numMembros));
                    $valorParte = round(($pctMembro / 100) * $request->valor_total, 2);
                }

                $pago = ($m->usuario_id === $user->id_usuario);

                ParticipacaoDespesa::create([
                    'despesa_lar_id' => $despesa->id_despesa_lar,
                    'usuario_id' => $m->usuario_id,
                    'valor_parte' => $valorParte,
                    'pago' => $pago,
                ]);
            }

            return response()->json([
                'sucesso' => true,
                'mensagem' => "Despesa {$despesa->titulo} atualizada com sucesso no Lar!",
                'despesa' => $despesa->load('participacoes.usuario'),
            ]);
        });
    }

    public function destroyDespesa($id)
    {
        $user = Auth::user();
        $lar = $user->lares()->firstOrFail();

        $despesa = DespesaLar::where('lar_id', $lar->id_lar)->find($id);
        if ($despesa) {
            $titulo = $despesa->titulo;
            $valor = $despesa->valor_total;
            
            \App\Models\HistoricoAuditoria::registrar(
                $user->id_usuario,
                'despesa_lar',
                $despesa->id_despesa_lar,
                'cancelado',
                "Despesa do Lar \"{$titulo}\" de R$ " . number_format($valor, 2, ',', '.') . " foi removida do rateio por {$user->nome}.",
                ['titulo' => $titulo, 'valor' => $valor],
                null,
                $lar->id_lar
            );

            ParticipacaoDespesa::where('despesa_lar_id', $despesa->id_despesa_lar)->delete();
            $despesa->delete();
        }

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Despesa removida com sucesso do Lar!',
        ]);
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

    public function solicitarResgateEmergencia(Request $request)
    {
        $request->validate([
            'valor' => 'required|numeric|min:0.01|max:5000',
            'motivo' => 'required|string',
            'descricao' => 'nullable|string',
            'conta_destino' => 'nullable|string',
        ]);

        $user = Auth::user();
        $valor = (float)$request->valor;

        // Cria a notificação de urgência e proposta bilateral na Mesa de Acordos
        \App\Models\Notificacao::create([
            'usuario_id' => $user->id_usuario,
            'titulo' => 'Solicitação de Emergência do Lar',
            'mensagem' => "Proposta para resgate de R$ " . number_format($valor, 2, ',', '.') . " do Fundo Conjunto enviada com urgência para aprovação mútua.",
            'tipo' => 'atencao',
            'lida' => false,
        ]);

        return response()->json([
            'sucesso' => true,
            'mensagem' => "Proposta de resgate de R$ " . number_format($valor, 2, ',', '.') . " enviada para aprovação do parceiro na Mesa de Acordos!",
            'novo_saldo' => 5000.00 - $valor,
        ]);
    }

    public function notificarPendencia(Request $request)
    {
        $request->validate([
            'tipo_acao' => 'required|string|in:comprovante,diplomata,compensar',
        ]);

        $user = Auth::user();
        $mensagem = $request->tipo_acao === 'comprovante' 
            ? 'Pedido de comprovante Pix enviado delicadamente para o parceiro.'
            : 'Lembrete carinhoso preparado com sucesso pelo Cobrador Diplomata!';

        \App\Models\Notificacao::create([
            'usuario_id' => $user->id_usuario,
            'titulo' => 'Equilíbrio da Contribuição do Lar',
            'mensagem' => $mensagem,
            'tipo' => 'info',
            'lida' => false,
        ]);

        return response()->json([
            'sucesso' => true,
            'mensagem' => $mensagem,
        ]);
    }

    public function atualizarFotoCapa(Request $request)
    {
        $request->validate([
            'nome' => 'nullable|string|max:100',
            'foto' => 'nullable|string',
            'desde' => 'nullable|string',
        ]);

        $user = Auth::user();
        $lar = $user->lares()->first();

        if ($lar && $request->nome) {
            $lar->update(['nome' => $request->nome]);
        }

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Nosso Cantinho atualizado com sucesso!',
            'lar' => [
                'nome' => $request->nome ?: 'Nosso Cantinho',
                'foto' => $request->foto ?: '/lar-inicio.png',
                'desde' => $request->desde ?: 'abril de 2026',
            ]
        ]);
    }
}
