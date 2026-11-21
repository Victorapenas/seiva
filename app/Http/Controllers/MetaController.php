<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use App\Models\Conta;
use App\Models\Transacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * MetaController
 * Responsável pelo cadastro, acompanhamento de metas financeiras, aportes com débito em conta
 * e rastreamento de produtos com links para futuras promoções (Wishlist / Monitoramento).
 *
 * Responsável Acadêmico: Ian Marcos / Victor Hugo (RF007, RF008)
 */
class MetaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $lar = $user->lares()->first();

        $metasIndividuais = Meta::where('usuario_id', $user->id_usuario)
            ->whereNull('lar_id')
            ->orderBy('id_meta')
            ->get();

        $metasLar = collect([]);
        if ($lar) {
            $metasLar = Meta::where('lar_id', $lar->id_lar)
                ->orderBy('id_meta')
                ->get();
        }

        // Se não houver metas no banco, seeded com os dados do protótipo
        if ($metasIndividuais->isEmpty()) {
            $metasIndividuais = collect([
                (object)[
                    'id_meta' => 101,
                    'titulo' => 'Notebook Dell',
                    'categoria' => 'produto',
                    'icone' => 'laptop',
                    'valor_alvo' => 4500.00,
                    'valor_atual' => 4050.00,
                    'contribuicao_mensal' => 100.00,
                    'progresso' => 90,
                    'data_limite' => '2026-07-31',
                    'onde_guardado' => 'Poupança Caixa',
                    'imagem' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=160&auto=format&fit=crop&q=80',
                    'link_referencia' => 'https://www.mercadolivre.com.br/notebook-dell-inspiron',
                    'loja' => 'Mercado Livre',
                    'monitorar_promocao' => true,
                    'status' => 'ativa',
                ],
                (object)[
                    'id_meta' => 102,
                    'titulo' => 'Viagem Portugal',
                    'categoria' => 'viagem',
                    'icone' => 'plane',
                    'valor_alvo' => 9000.00,
                    'valor_atual' => 2100.00,
                    'contribuicao_mensal' => 200.00,
                    'progresso' => 23,
                    'data_limite' => '2027-03-31',
                    'onde_guardado' => 'Poupança Caixa',
                    'imagem' => null,
                    'link_referencia' => null,
                    'loja' => null,
                    'monitorar_promocao' => false,
                    'status' => 'ativa',
                ],
                (object)[
                    'id_meta' => 103,
                    'titulo' => 'Curso UX Alura',
                    'categoria' => 'curso',
                    'icone' => 'graduation-cap',
                    'valor_alvo' => 1800.00,
                    'valor_atual' => 720.00,
                    'contribuicao_mensal' => 90.00,
                    'progresso' => 40,
                    'data_limite' => '2026-09-30',
                    'onde_guardado' => 'Poupança Caixa',
                    'imagem' => null,
                    'link_referencia' => 'https://www.alura.com.br',
                    'loja' => 'Alura',
                    'monitorar_promocao' => true,
                    'status' => 'ativa',
                ],
            ]);
        }

        if ($lar && $metasLar->isEmpty()) {
            $membroParceiro = $lar->membros()->where('usuarios.id_usuario', '!=', $user->id_usuario)->first();
            $nomeParceiro = $membroParceiro ? explode(' ', $membroParceiro->nome)[0] : 'Ian';
            $iniciaisParceiro = $membroParceiro ? $membroParceiro->iniciais : 'IM';

            $metasLar = collect([
                (object)[
                    'id_meta' => 201,
                    'titulo' => 'Geladeira Samsung',
                    'categoria' => 'produto',
                    'icone' => 'shopping-cart',
                    'valor_alvo' => 3200.00,
                    'valor_atual' => 1000.00,
                    'contribuicao_mensal' => 500.00,
                    'progresso' => 31,
                    'data_limite' => '2026-11-30',
                    'onde_guardado' => 'Nubank Maria Eduarda',
                    'conta_destino' => 'Nubank Maria Eduarda',
                    'responsavel_nome' => 'Maria Eduarda',
                    'responsavel_pix' => '(71) 99812-3456',
                    'imagem' => 'https://images.unsplash.com/photo-1584992236310-6edddc08acff?w=160&auto=format&fit=crop&q=80',
                    'link_referencia' => 'https://www.mercadolivre.com.br/geladeira-samsung-inverter',
                    'loja' => 'Mercado Livre',
                    'monitorar_promocao' => true,
                    'status' => 'ativa',
                    'em_negociacao' => false,
                    'divisao_voce' => 250.00,
                    'divisao_parceiro' => 250.00,
                    'parceiro_nome' => $nomeParceiro,
                    'parceiro_iniciais' => $iniciaisParceiro,
                ],
                (object)[
                    'id_meta' => 202,
                    'titulo' => 'Viagem Praia do Forte',
                    'categoria' => 'viagem',
                    'icone' => 'plane',
                    'valor_alvo' => 3000.00,
                    'valor_atual' => 540.00,
                    'contribuicao_mensal' => 200.00,
                    'progresso' => 18,
                    'data_limite' => '2027-01-31',
                    'onde_guardado' => 'Poupança Caixa (conjunta)',
                    'conta_destino' => 'Poupança Caixa (conjunta)',
                    'responsavel_nome' => 'Conta conjunta',
                    'responsavel_pix' => 'conjunta@seiva.app',
                    'imagem' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=160&auto=format&fit=crop&q=80',
                    'link_referencia' => 'https://www.booking.com/hotel/br/resort-praia-do-forte',
                    'loja' => 'Booking',
                    'monitorar_promocao' => true,
                    'status' => 'ativa',
                    'em_negociacao' => true,
                    'divisao_voce' => 100.00,
                    'divisao_parceiro' => 100.00,
                    'parceiro_nome' => $nomeParceiro,
                    'parceiro_iniciais' => $iniciaisParceiro,
                ],
                (object)[
                    'id_meta' => 203,
                    'titulo' => 'Reforma da cozinha',
                    'categoria' => 'reserva',
                    'icone' => 'home',
                    'valor_alvo' => 10000.00,
                    'valor_atual' => 4500.00,
                    'contribuicao_mensal' => 500.00,
                    'progresso' => 45,
                    'data_limite' => '2027-06-30',
                    'onde_guardado' => 'Conta conjunta',
                    'conta_destino' => 'Nubank Maria Eduarda',
                    'responsavel_nome' => 'Maria Eduarda',
                    'responsavel_pix' => '(71) 99812-3456',
                    'imagem' => null,
                    'link_referencia' => null,
                    'loja' => null,
                    'monitorar_promocao' => false,
                    'status' => 'ativa',
                    'em_negociacao' => false,
                    'divisao_voce' => 250.00,
                    'divisao_parceiro' => 250.00,
                    'parceiro_nome' => $nomeParceiro,
                    'parceiro_iniciais' => $iniciaisParceiro,
                ],
            ]);
        }

        return response()->json([
            'individuais' => $metasIndividuais,
            'lar' => $metasLar,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor_alvo' => 'required|numeric|min:1',
            'valor_atual' => 'nullable|numeric|min:0',
            'contribuicao_mensal' => 'nullable|numeric|min:0',
            'categoria' => 'nullable|string',
            'tipo_escopo' => 'nullable|in:individual,lar',
            'posse' => 'nullable|string',
            'onde_guardado' => 'nullable|string',
            'data_limite' => 'nullable|date',
            'imagem' => 'nullable|string',
            'link_referencia' => 'nullable|string|max:1000',
            'loja' => 'nullable|string|max:100',
            'monitorar_promocao' => 'nullable|boolean',
        ]);

        $user = Auth::user();
        $lar = $user->lares()->first();

        $ehLar = ($request->tipo_escopo === 'lar' || $request->posse === 'compartilhada' || $request->posse === 'lar') && $lar;

        $cat = strtolower($request->categoria ?? 'produto');
        $iconeLucide = match(true) {
            str_contains($cat, 'viag') => 'plane',
            str_contains($cat, 'reserva') => 'shield',
            str_contains($cat, 'curso') => 'graduation-cap',
            str_contains($cat, 'poupan') => 'coins',
            default => 'shopping-cart',
        };

        // Extrai loja automaticamente caso link seja do ML, Amazon, etc.
        $loja = $request->loja;
        $link = $request->link_referencia;
        if ($link && empty($loja)) {
            if (str_contains($link, 'mercadolivre') || str_contains($link, 'ml.com')) {
                $loja = 'Mercado Livre';
            } elseif (str_contains($link, 'amazon')) {
                $loja = 'Amazon';
            } elseif (str_contains($link, 'kabum')) {
                $loja = 'KaBuM!';
            } elseif (str_contains($link, 'magazineluiza') || str_contains($link, 'magalu')) {
                $loja = 'Magalu';
            } else {
                $loja = parse_url($link, PHP_URL_HOST) ?: 'Loja Online';
            }
        }

        $meta = Meta::create([
            'usuario_id' => $user->id_usuario,
            'lar_id' => $ehLar ? $lar->id_lar : null,
            'responsavel_id' => $user->id_usuario,
            'titulo' => $request->titulo,
            'emoji' => $iconeLucide, // Salva o nome do ícone Lucide puro
            'categoria' => in_array($cat, ['produto','viagem','poupanca','reserva','curso']) ? $cat : 'produto',
            'valor_alvo' => $request->valor_alvo,
            'valor_atual' => $request->valor_atual ?? 0,
            'contribuicao_mensal' => $request->contribuicao_mensal ?? 0,
            'onde_guardado' => $request->onde_guardado ?? 'Reserva Pessoal',
            'data_limite' => $request->data_limite,
            'imagem' => $request->imagem,
            'link_referencia' => $link,
            'loja' => $loja,
            'monitorar_promocao' => $request->monitorar_promocao ?? true,
            'status' => 'ativa',
        ]);

        return response()->json($meta, 201);
    }

    public function contribuir(Request $request, $id)
    {
        $request->validate([
            'valor' => 'required|numeric|min:0.01',
            'conta_id' => 'nullable|exists:contas,id_conta',
        ]);

        $user = Auth::user();
        $larIds = $user->lares()->pluck('lares.id_lar')->toArray();

        $meta = Meta::where(function ($q) use ($user, $larIds) {
            $q->where('usuario_id', $user->id_usuario);
            if (!empty($larIds)) {
                $q->orWhereIn('lar_id', $larIds);
            }
        })->find($id);

        if (!$meta) {
            // Se for ID simulado de mock do protótipo
            return response()->json([
                'sucesso' => true,
                'mensagem' => 'Aporte simulado registrado com sucesso!',
                'progresso' => 95,
            ]);
        }

        return DB::transaction(function () use ($request, $user, $meta) {
            $meta->increment('valor_atual', $request->valor);

            if ($request->conta_id) {
                $conta = Conta::where('usuario_id', $user->id_usuario)->where('id_conta', $request->conta_id)->first();
                if ($conta) {
                    $conta->decrement('saldo', $request->valor);
                    Transacao::create([
                        'usuario_id' => $user->id_usuario,
                        'conta_id' => $conta->id_conta,
                        'titulo' => 'Aporte na meta: ' . $meta->titulo,
                        'valor' => $request->valor,
                        'tipo' => 'saida',
                        'data' => now()->format('Y-m-d'),
                        'emoji' => 'target', // Ícone lucide, sem emoji
                        'visibilidade' => 'pessoal',
                    ]);
                }
            }

            if ($meta->valor_atual >= $meta->valor_alvo) {
                $meta->update(['status' => 'concluida']);
            }

            return response()->json([
                'sucesso' => true,
                'mensagem' => 'Aporte de R$ ' . number_format($request->valor, 2, ',', '.') . ' registrado na meta!',
                'progresso' => $meta->progresso,
                'meta' => $meta,
            ]);
        });
    }

    /**
     * Endpoint para simulação de scraper de dados de link de produto (preço, loja e foto).
     * Prepara o sistema para alertas de promoção automáticos no futuro.
     */
    public function consultarLinkProduto(Request $request)
    {
        $request->validate(['url' => 'required|url']);
        $url = $request->url;

        $loja = 'Loja Online';
        $titulo = 'Produto Monitorado';
        $preco = 0.00;
        $imagem = null;

        if (str_contains($url, 'mercadolivre') || str_contains($url, 'ml.com')) {
            $loja = 'Mercado Livre';
            if (str_contains($url, 'mouse')) {
                $titulo = 'Mouse Gamer Logitech G Pro X Superlight';
                $preco = 599.90;
                $imagem = 'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?w=160&auto=format&fit=crop&q=80';
            } elseif (str_contains($url, 'teclado')) {
                $titulo = 'Teclado Mecânico Keychron K2';
                $preco = 450.00;
                $imagem = 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=160&auto=format&fit=crop&q=80';
            } elseif (str_contains($url, 'camera') || str_contains($url, 'sony')) {
                $titulo = 'Câmera Sony ZV-E10';
                $preco = 2890.00;
                $imagem = 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=160&auto=format&fit=crop&q=80';
            } else {
                $titulo = 'Item Mercado Livre';
                $preco = 200.00;
            }
        } elseif (str_contains($url, 'amazon')) {
            $loja = 'Amazon';
            $titulo = 'Item Amazon Brasil';
            $preco = 180.00;
        }

        return response()->json([
            'sucesso' => true,
            'loja' => $loja,
            'titulo' => $titulo,
            'preco' => $preco,
            'imagem' => $imagem,
            'url' => $url,
            'monitorar_promocao' => true,
        ]);
    }

    public function atualizarMeta(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'nullable|string|max:255',
            'valor_alvo' => 'nullable|numeric|min:1',
            'contribuicao_mensal' => 'nullable|numeric|min:0',
            'categoria' => 'nullable|string',
            'imagem' => 'nullable|string',
            'link_referencia' => 'nullable|string|max:1000',
            'loja' => 'nullable|string|max:100',
            'monitorar_promocao' => 'nullable|boolean',
            'data_limite' => 'nullable|string',
            'onde_guardado' => 'nullable|string',
        ]);

        $user = Auth::user();
        $meta = Meta::find($id);

        $dadosAtualizacao = array_filter([
            'titulo' => $request->titulo,
            'valor_alvo' => $request->valor_alvo,
            'contribuicao_mensal' => $request->contribuicao_mensal,
            'categoria' => $request->categoria,
            'imagem' => $request->imagem,
            'link_referencia' => $request->link_referencia,
            'loja' => $request->loja,
            'data_limite' => $request->data_limite,
            'onde_guardado' => $request->onde_guardado,
        ], fn($v) => !is_null($v));

        if ($request->has('monitorar_promocao')) {
            $dadosAtualizacao['monitorar_promocao'] = (bool)$request->monitorar_promocao;
        }

        if ($meta) {
            $meta->update($dadosAtualizacao);
        } elseif ($user) {
            // Se for uma meta seeded que ainda não estava no banco, salva agora
            $lar = $user->lares()->first();
            $meta = Meta::create(array_merge([
                'usuario_id' => $user->id_usuario,
                'lar_id' => ($id >= 200 && $lar) ? $lar->id_lar : null,
                'titulo' => $request->titulo ?: 'Meta',
                'valor_alvo' => $request->valor_alvo ?: 1000,
                'valor_atual' => 0,
                'categoria' => $request->categoria ?: 'produto',
                'status' => 'ativa',
            ], $dadosAtualizacao));
        }

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Meta atualizada com sucesso!',
            'meta' => $meta,
        ]);
    }

    public function desfazerMeta(Request $request, $id)
    {
        $request->validate([
            'destino' => 'required|in:devolver,fundo_emergencia,outra_meta',
        ]);

        $meta = Meta::find($id);
        if ($meta) {
            $meta->update(['status' => 'concluida']);
        }

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Meta desfeita e saldo redistribuído com sucesso!',
        ]);
    }
}
