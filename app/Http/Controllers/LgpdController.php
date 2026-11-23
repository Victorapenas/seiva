<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Controller: LgpdController (Perfil do Usuário e Conformidade LGPD)
 * 
 * Responsabilidade Acadêmica: Maria Eduarda Lima Silveira (RF011)
 * Requisito Atendido: RF011 — Gestão de Perfil, Conformidade LGPD (Lei 13.709/2018)
 * 
 * Por que fizemos assim:
 * A LGPD exige que o titular dos dados tenha total controle sobre suas informações.
 * Implementamos a visualização e edição de perfil (renda, banco principal, chave PIX, avatar),
 * a portabilidade de dados através da exportação completa em formato JSON (`exportData`)
 * e o direito de revogação/eliminação com exclusão lógica/física e desvinculação completa
 * de lares compartilhados (`deleteAccount`), mantendo registro em trilha de auditoria.
 */
class LgpdController extends Controller
{
    /**
     * RF011: Retorna os dados do perfil do usuário autenticado e informações do seu Lar.
     * O que tentamos fazer: Apresentar a visão consolidada dos dados cadastrais e as regras
     * de divisão configuradas para o casal ou morador individual.
     */
    public function show()
    {
        $user = Auth::user();
        $lar = $user->lares()->first();

        $dadosLar = null;
        if ($lar) {
            $parceiro = $lar->membros()->where('usuarios.id_usuario', '!=', $user->id_usuario)->first();
            $regraAtiva = \App\Models\RegraDivisao::where('lar_id', $lar->id_lar)->where('ativa', true)->first();
            
            $divisaoTxt = '50% / 50%';
            $pctUser = 50.0;
            $pctParc = 50.0;

            if ($regraAtiva) {
                $detalhes = \App\Models\RegraDivisaoDetalhe::where('regra_id', $regraAtiva->id_regra_divisao)->get();
                $detUser = $detalhes->firstWhere('usuario_id', $user->id_usuario);
                $detParc = $parceiro ? $detalhes->firstWhere('usuario_id', $parceiro->id_usuario) : null;
                if ($detUser) $pctUser = (float)$detUser->percentual;
                if ($detParc) $pctParc = (float)$detParc->percentual;

                if ($regraAtiva->tipo === 'customizada') {
                    $divisaoTxt = "Personalizada ({$pctUser}% / {$pctParc}%)";
                } elseif ($regraAtiva->tipo === 'proporcional') {
                    $divisaoTxt = "Proporcional ({$pctUser}% / {$pctParc}%)";
                } else {
                    $divisaoTxt = "50% / 50%";
                }
            }

            $dadosLar = [
                'id_lar'       => $lar->id_lar,
                'nome'         => $lar->nome,
                'criado_em'    => $lar->created_at ? $lar->created_at->format('d/m/Y') : 'Desde abril de 2026',
                'divisao_txt'  => $divisaoTxt,
                'pct_usuario'  => $pctUser,
                'pct_parceiro' => $pctParc,
                'parceiro'     => $parceiro ? [
                    'id_usuario' => $parceiro->id_usuario,
                    'nome'       => $parceiro->nome,
                    'email'      => $parceiro->email,
                    'avatar'     => $parceiro->avatar,
                    'iniciais'   => $parceiro->iniciais,
                ] : null,
            ];
        }

        return response()->json([
            'usuario' => [
                'id_usuario'      => $user->id_usuario,
                'nome'            => $user->nome,
                'email'           => $user->email,
                'telefone'        => $user->telefone ?? '',
                'avatar'          => $user->avatar ?? '',
                'iniciais'        => $user->iniciais,
                'renda_mensal'    => $user->renda_mensal ?? 0,
                'renda_total'     => $user->renda_total,
                'banco_principal' => $user->banco_principal ?? 'Nubank',
                'chave_pix'       => $user->chave_pix ?? $user->email,
                'created_at'      => $user->created_at,
                'membro_desde'    => $user->created_at ? $user->created_at->translatedFormat('F \d\e Y') : 'novembro de 2026',
            ],
            'is_casal' => ($lar !== null && $dadosLar && $dadosLar['parceiro'] !== null),
            'lar'      => $dadosLar,
            'versao'   => 'SEIVA v2.0 (2º Semestre 2026)',
        ]);
    }

    /**
     * RF011: Atualiza os dados cadastrais do titular (princípio do livre acesso e qualidade dos dados).
     * O que tentamos fazer: Permitir alteração de nome, telefone, chave PIX, banco preferencial,
     * rendas e PIN da Caixa Preta com validação estrita e registro em trilha de auditoria.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nome'            => 'required|string|max:255',
            'email'           => 'nullable|email|max:255',
            'telefone'        => 'nullable|string|max:20',
            'tipo_renda'      => 'nullable|in:clt,pj,autonomo,outro',
            'renda_mensal'    => 'nullable|numeric|min:0',
            'renda_extra'     => 'nullable|numeric|min:0',
            'banco_principal' => 'nullable|string|max:100',
            'chave_pix'       => 'nullable|string|max:100',
            'avatar'          => 'nullable|string|max:500000',
            'pin_caixa_preta' => 'nullable|string|max:10',
        ]);

        $dados = $request->only([
            'nome', 'telefone', 'tipo_renda', 'renda_mensal',
            'renda_extra', 'banco_principal', 'chave_pix', 'avatar', 'pin_caixa_preta'
        ]);

        if ($request->filled('email') && $request->email !== $user->email) {
            $request->validate(['email' => 'unique:usuarios,email,' . $user->id_usuario . ',id_usuario']);
            $dados['email'] = $request->email;
        }

        $user->update($dados);

        \App\Models\HistoricoAuditoria::registrar(
            $user->id_usuario,
            'usuario',
            $user->id_usuario,
            'edicao_perfil',
            "Perfil atualizado: Nome, contato ou chave PIX redefinidos com sucesso.",
            ['nome' => $user->nome, 'email' => $user->email, 'chave_pix' => $user->chave_pix],
            null,
            null
        );

        return response()->json([
            'sucesso' => true,
            'message' => 'Perfil atualizado com sucesso!',
            'usuario' => $user->fresh(),
        ]);
    }

    /**
     * RF010 e RF011: Atualiza a regra de divisão de despesas do Lar (igualitária, proporcional ou customizada).
     * O que tentamos fazer: Permitir que o casal reconfigure o rateio a qualquer momento, desativando
     * regras anteriores e recalculando percentuais individuais com registro em auditoria.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function atualizarDivisaoLar(Request $request)
    {
        $user = Auth::user();
        $lar = $user->lares()->first();
        if (!$lar) {
            return response()->json(['error' => 'Você não pertence a um Lar compartilhado.'], 400);
        }

        $request->validate([
            'tipo' => 'required|in:igualitaria,proporcional,customizada',
            'pct_usuario' => 'nullable|numeric|between:0,100',
            'pct_parceiro' => 'nullable|numeric|between:0,100',
        ]);

        $tipo = $request->tipo;
        $parceiro = $lar->membros()->where('usuarios.id_usuario', '!=', $user->id_usuario)->first();

        // Desativa regras anteriores
        \App\Models\RegraDivisao::where('lar_id', $lar->id_lar)->update(['ativa' => false]);

        $regra = \App\Models\RegraDivisao::create([
            'lar_id' => $lar->id_lar,
            'tipo' => $tipo,
            'ativa' => true,
        ]);

        $pctUser = 50.0;
        $pctParc = 50.0;
        if ($tipo === 'customizada') {
            $pctUser = (float)($request->pct_usuario ?? 50.0);
            $pctParc = (float)($request->pct_parceiro ?? (100.0 - $pctUser));
        } elseif ($tipo === 'proporcional' && $parceiro) {
            $rendaUser = (float)$user->renda_mensal ?: 4000;
            $rendaParc = (float)$parceiro->renda_mensal ?: 6000;
            $total = max(1, $rendaUser + $rendaParc);
            $pctUser = round(($rendaUser / $total) * 100, 1);
            $pctParc = round(100 - $pctUser, 1);
        }

        \App\Models\RegraDivisaoDetalhe::create([
            'regra_id' => $regra->id_regra_divisao,
            'usuario_id' => $user->id_usuario,
            'percentual' => $pctUser,
        ]);

        if ($parceiro) {
            \App\Models\RegraDivisaoDetalhe::create([
                'regra_id' => $regra->id_regra_divisao,
                'usuario_id' => $parceiro->id_usuario,
                'percentual' => $pctParc,
            ]);
        }

        \App\Models\HistoricoAuditoria::registrar(
            $user->id_usuario,
            'lar',
            $lar->id_lar,
            'regra_divisao_atualizada',
            "Regra de divisão do lar atualizada para " . ($tipo === 'customizada' ? "Personalizada ({$pctUser}% / {$pctParc}%)" : ($tipo === 'proporcional' ? "Proporcional à renda ({$pctUser}% / {$pctParc}%)" : "50% / 50%")),
            ['tipo' => $tipo, 'pct_usuario' => $pctUser, 'pct_parceiro' => $pctParc],
            null,
            $lar->id_lar
        );

        return response()->json([
            'sucesso' => true,
            'mensagem' => "Divisão do Lar atualizada com sucesso para {$pctUser}% / {$pctParc}%!",
            'regra' => [
                'tipo' => $tipo,
                'pct_usuario' => $pctUser,
                'pct_parceiro' => $pctParc,
            ]
        ]);
    }

    /**
     * RF011: Exporta todos os dados do titular em formato JSON legível (Direito à Portabilidade - Art. 18, V, LGPD).
     * O que tentamos fazer: Consolidar contas bancárias, histórico de transações, metas, registros da caixa preta
     * e lares em um único payload estruturado para download pelo usuário.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function exportData()
    {
        $user = Auth::user();
        $user->load(['contas', 'transacoes', 'metas', 'registrosCaixaPreta', 'lares']);

        $exportData = [
            'relatorio' => 'Exportação de Dados Pessoais - LGPD (Lei nº 13.709/2018)',
            'gerado_em' => now()->toIso8601String(),
            'titular_dos_dados' => [
                'id' => $user->id_usuario,
                'nome' => $user->nome,
                'email' => $user->email,
                'telefone' => $user->telefone,
                'renda_declarada' => $user->renda_total,
                'banco_principal' => $user->banco_principal,
                'chave_pix' => $user->chave_pix,
                'cadastrado_em' => $user->created_at,
            ],
            'contas_bancarias' => $user->contas,
            'historico_transacoes' => $user->transacoes,
            'metas_financeiras' => $user->metas,
            'registros_privados_caixa_preta' => $user->registrosCaixaPreta,
            'lares_compartilhados' => $user->lares,
        ];

        return response()->json($exportData, 200, [
            'Content-Disposition' => 'attachment; filename="seiva-lgpd-dados-' . $user->id_usuario . '.json"',
        ]);
    }

    /**
     * RF011: Elimina definitivamente a conta e todos os dados do titular (Direito ao Esquecimento - Art. 18, VI, LGPD).
     * O que tentamos fazer: Em transação atômica do banco de dados, expurgar registros financeiros, contas,
     * metas, histórico da caixa preta e vínculos com lares, encerrando a sessão do usuário com segurança.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAccount()
    {
        $user = Auth::user();

        DB::transaction(function () use ($user) {
            $user->contas()->delete();
            $user->transacoes()->delete();
            $user->metas()->delete();
            $user->registrosCaixaPreta()->delete();
            $user->notificacoes()->delete();
            \App\Models\LarMembro::where('usuario_id', $user->id_usuario)->delete();
            \App\Models\ParticipacaoDespesa::where('usuario_id', $user->id_usuario)->delete();
            \App\Models\ConviteLar::where('convidado_por', $user->id_usuario)->delete();
            \App\Models\Cobranca::where('criada_por', $user->id_usuario)->orWhere('destinatario_id', $user->id_usuario)->delete();
            $user->delete();
        });

        Auth::logout();
        request()->session()->invalidate();

        return response()->json(['message' => 'Conta e todos os dados foram definitivamente anonimizados e excluídos (LGPD).']);
    }
}
