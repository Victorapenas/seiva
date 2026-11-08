<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Lar;
use App\Models\LarMembro;
use App\Models\Conta;
use App\Models\Categoria;
use App\Models\Transacao;
use App\Models\DespesaLar;
use App\Models\ParticipacaoDespesa;
use App\Models\Acordo;
use App\Models\Proposta;
use App\Models\Meta;
use App\Models\Projeto;
use App\Models\ProjetoItem;
use App\Models\RegistroCaixaPreta;
use App\Models\Cobranca;
use App\Models\Notificacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DemoController extends Controller
{
    public function seedDemo()
    {
        return DB::transaction(function () {
            // Limpa dados anteriores
            $this->resetTables();

            // 1. Cria Usuária Duda (Maria Eduarda)
            $duda = Usuario::create([
                'nome' => 'Maria Eduarda Lima',
                'email' => 'maeduarda@email.com',
                'telefone' => '(71) 99812-3456',
                'senha_hash' => Hash::make('123456'),
                'pin_caixa_preta' => '1234',
                'tipo_renda' => 'clt',
                'renda_mensal' => 1500.00,
                'tem_renda_extra' => true,
                'renda_extra' => 200.00,
                'banco_principal' => 'Nubank',
                'chave_pix' => '(71) 99812-3456',
            ]);

            // 2. Cria Parceiro Ian
            $ian = Usuario::create([
                'nome' => 'Ian Marcos',
                'email' => 'ian@email.com',
                'telefone' => '(71) 99955-7788',
                'senha_hash' => Hash::make('123456'),
                'pin_caixa_preta' => '1234',
                'tipo_renda' => 'clt',
                'renda_mensal' => 2000.00,
                'tem_renda_extra' => true,
                'renda_extra' => 500.00,
                'banco_principal' => 'Inter',
                'chave_pix' => '(71) 99955-7788',
            ]);

            // 3. Contas da Duda
            $contaNu = Conta::create([
                'usuario_id' => $duda->id_usuario,
                'nome' => 'Nubank Principal',
                'tipo' => 'corrente',
                'saldo' => 1450.00,
                'comprometido' => 600.00,
                'funcao' => 'gasto',
                'cor' => '#8b5cf6',
                'chave_pix' => $duda->chave_pix,
            ]);

            $cartaoNu = Conta::create([
                'usuario_id' => $duda->id_usuario,
                'nome' => 'Cartão Roxinho',
                'tipo' => 'cartao',
                'saldo' => 0,
                'limite' => 1200.00,
                'usado' => 450.00,
                'vencimento_fatura' => 15,
                'cor' => '#6366f1',
            ]);

            $poupanca = Conta::create([
                'usuario_id' => $duda->id_usuario,
                'nome' => 'Reserva de Emergência',
                'tipo' => 'poupanca',
                'saldo' => 850.00,
                'funcao' => 'reserva',
                'cor' => '#10b981',
            ]);

            // 4. Cria Lar "Nosso Cantinho"
            $lar = Lar::create([
                'nome' => 'Nosso Cantinho',
                'emoji' => '🌿',
                'criado_por' => $duda->id_usuario,
            ]);

            // Membros
            LarMembro::create([
                'lar_id' => $lar->id_lar,
                'usuario_id' => $duda->id_usuario,
                'papel' => 'administrador',
                'renda_declarada' => 1700.00,
                'percentual_contribuicao' => 40.5,
                'aceito_em' => now(),
            ]);

            LarMembro::create([
                'lar_id' => $lar->id_lar,
                'usuario_id' => $ian->id_usuario,
                'papel' => 'membro',
                'renda_declarada' => 2500.00,
                'percentual_contribuicao' => 59.5,
                'aceito_em' => now(),
            ]);

            // 5. Transações Pessoais da Duda
            $catMercado = Categoria::where('nome', 'Alimentação & Mercado')->first();
            $catMoradia = Categoria::where('nome', 'Moradia & Contas')->first();
            $catFreela = Categoria::where('nome', 'Trabalho & Freela')->first();

            Transacao::create([
                'usuario_id' => $duda->id_usuario,
                'conta_id' => $contaNu->id_conta,
                'categoria_id' => $catFreela ? $catFreela->id_categoria : null,
                'titulo' => 'Salário Florais Design',
                'emoji' => '💼',
                'valor' => 1500.00,
                'tipo' => 'entrada',
                'data' => now()->startOfMonth()->format('Y-m-d'),
                'visibilidade' => 'pessoal',
            ]);

            Transacao::create([
                'usuario_id' => $duda->id_usuario,
                'conta_id' => $contaNu->id_conta,
                'categoria_id' => $catMercado ? $catMercado->id_categoria : null,
                'titulo' => 'Compras da Semana - GBarbosa',
                'emoji' => '🛒',
                'valor' => 180.50,
                'tipo' => 'saida',
                'data' => now()->subDays(2)->format('Y-m-d'),
                'visibilidade' => 'pessoal',
            ]);

            // 6. Despesas Compartilhadas do Lar
            $despAluguel = DespesaLar::create([
                'lar_id' => $lar->id_lar,
                'registrada_por' => $duda->id_usuario,
                'titulo' => 'Aluguel do Mês',
                'emoji' => '🏠',
                'valor_total' => 1200.00,
                'tipo' => 'fixa',
                'divisao' => 'proporcional',
                'data_vencimento' => now()->addDays(5)->format('Y-m-d'),
                'status' => 'parcial',
            ]);

            ParticipacaoDespesa::create([
                'despesa_lar_id' => $despAluguel->id_despesa_lar,
                'usuario_id' => $duda->id_usuario,
                'valor_parte' => 486.00,
                'pago' => true,
            ]);

            ParticipacaoDespesa::create([
                'despesa_lar_id' => $despAluguel->id_despesa_lar,
                'usuario_id' => $ian->id_usuario,
                'valor_parte' => 714.00,
                'pago' => false, // Pendente para demonstrar o Cobrador Diplomata!
            ]);

            $despLuz = DespesaLar::create([
                'lar_id' => $lar->id_lar,
                'registrada_por' => $ian->id_usuario,
                'titulo' => 'Energia (Coelba)',
                'emoji' => '⚡',
                'valor_total' => 180.00,
                'tipo' => 'variavel',
                'divisao' => '50/50',
                'data_vencimento' => now()->addDays(10)->format('Y-m-d'),
                'status' => 'pago',
            ]);

            ParticipacaoDespesa::create([
                'despesa_lar_id' => $despLuz->id_despesa_lar,
                'usuario_id' => $duda->id_usuario,
                'valor_parte' => 90.00,
                'pago' => true,
            ]);

            ParticipacaoDespesa::create([
                'despesa_lar_id' => $despLuz->id_despesa_lar,
                'usuario_id' => $ian->id_usuario,
                'valor_parte' => 90.00,
                'pago' => true,
            ]);

            // 7. Acordos e Propostas
            Acordo::create([
                'lar_id' => $lar->id_lar,
                'criado_por' => $duda->id_usuario,
                'titulo' => 'Geladeira Frost Free Inox',
                'tipo' => 'meta',
                'valor_total' => 3200.00,
                'valor_arrecadado' => 1600.00,
                'divisao' => '50/50',
                'valor_mensal' => 300.00,
                'vencimento_descricao' => 'Todo dia 10',
                'status' => 'ativo',
            ]);

            Proposta::create([
                'lar_id' => $lar->id_lar,
                'autor_id' => $ian->id_usuario,
                'titulo' => 'Assinatura Robô Aspirador',
                'valor' => 120.00,
                'proposta_texto' => 'Acho que vai ajudar muito na limpeza da sala e poupar nosso tempo nos finais de semana!',
                'divisao_sugerida' => '50/50',
                'status' => 'em_analise',
            ]);

            // 8. Metas Individuais e do Lar
            Meta::create([
                'usuario_id' => $duda->id_usuario,
                'lar_id' => $lar->id_lar,
                'responsavel_id' => $duda->id_usuario,
                'titulo' => 'Viagem Praia do Forte',
                'emoji' => '🏖️',
                'categoria' => 'viagem',
                'valor_alvo' => 2000.00,
                'valor_atual' => 1200.00,
                'contribuicao_mensal' => 200.00,
                'data_limite' => now()->addMonths(4)->format('Y-m-d'),
                'onde_guardado' => 'Cofrinho Nubank Lar',
                'status' => 'ativa',
            ]);

            Meta::create([
                'usuario_id' => $duda->id_usuario,
                'lar_id' => null,
                'responsavel_id' => $duda->id_usuario,
                'titulo' => 'Câmera Sony Alpha (Trabalho)',
                'emoji' => '📷',
                'categoria' => 'produto',
                'valor_alvo' => 3500.00,
                'valor_atual' => 1400.00,
                'contribuicao_mensal' => 150.00,
                'data_limite' => now()->addMonths(8)->format('Y-m-d'),
                'onde_guardado' => 'Caixa Econômica',
                'status' => 'ativa',
            ]);

            // 9. Caixa Preta (RF002)
            RegistroCaixaPreta::create([
                'usuario_id' => $duda->id_usuario,
                'titulo_cifrado' => 'Presente Surpresa de Aniversário do Ian',
                'valor_cifrado' => '250.00',
                'conta_cifrada' => 'Carteira Privada',
                'data' => now()->subDays(5)->format('Y-m-d'),
                'bloqueado' => true,
            ]);

            // 10. Notificações
            Notificacao::create([
                'usuario_id' => $duda->id_usuario,
                'lar_id' => $lar->id_lar,
                'titulo' => '🌿 Nova proposta de Ian na Mesa de Acordos',
                'mensagem' => 'Ian sugeriu "Assinatura Robô Aspirador" para o lar.',
                'tipo' => 'lar',
                'tempo' => 'Há 2 horas',
            ]);

            // Loga automaticamente como a Duda
            Auth::login($duda);

            return response()->json([
                'message' => 'Cenário de Demonstração (Duda & Ian) carregado com sucesso!',
                'usuario' => $duda->fresh(['lares']),
            ]);
        });
    }

    public function clearDemo()
    {
        $this->resetTables();
        Auth::logout();
        request()->session()->invalidate();

        return response()->json([
            'message' => 'Banco de dados limpo com sucesso! Pronto para cadastrar do zero.',
        ]);
    }

    private function resetTables()
    {
        ParticipacaoDespesa::truncate();
        DespesaLar::truncate();
        Acordo::truncate();
        Proposta::truncate();
        Meta::truncate();
        ProjetoItem::truncate();
        Projeto::truncate();
        RegistroCaixaPreta::truncate();
        Cobranca::truncate();
        Notificacao::truncate();
        Transacao::truncate();
        Conta::truncate();
        LarMembro::truncate();
        Lar::truncate();
        Usuario::truncate();
    }
}
