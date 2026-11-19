<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Conta;
use App\Models\Lar;
use App\Models\LarMembro;
use App\Models\DespesaLar;
use App\Models\ParticipacaoDespesa;
use App\Models\Transacao;
use App\Models\Categoria;
use App\Models\Proposta;
use App\Models\Acordo;
use App\Models\RegistroCaixaPreta;
use App\Models\Notificacao;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder para provisionar os cenários de teste:
 * 1. Usuário Individual: Victor Hugo (RF003/RF009)
 * 2. Casal Compartilhado: Duda & Ian no Lar "Nosso Cantinho 🌿" (RF004/RF010)
 */
class CenariosTesteSeeder extends Seeder
{
    public function run(): void
    {
        // Garante categorias base
        $catMoradia = Categoria::firstOrCreate(['nome' => 'Moradia & Contas'], ['emoji' => '🏠', 'cor' => '#3b82f6', 'sistema' => true]);
        $catMercado = Categoria::firstOrCreate(['nome' => 'Alimentação & Mercado'], ['emoji' => '🛒', 'cor' => '#10b981', 'sistema' => true]);
        $catLazer = Categoria::firstOrCreate(['nome' => 'Lazer & Restaurantes'], ['emoji' => '🍔', 'cor' => '#8b5cf6', 'sistema' => true]);
        $catTrabalho = Categoria::firstOrCreate(['nome' => 'Trabalho & Freela'], ['emoji' => '💼', 'cor' => '#6366f1', 'sistema' => true]);

        // =========================================================================
        // CENÁRIO 1: USUÁRIO INDIVIDUAL - Victor Hugo
        // =========================================================================
        $victor = Usuario::updateOrCreate(
            ['email' => 'victor@seiva.com'],
            [
                'nome' => 'Victor Hugo',
                'telefone' => '71999991111',
                'senha_hash' => Hash::make('123456'),
                'pin_caixa_preta' => '1234',
                'tipo_renda' => 'clt',
                'renda_mensal' => 5500.00,
                'dia_recebimento' => 5,
                'tem_renda_extra' => true,
                'renda_extra' => 800.00,
                'banco_principal' => 'Nubank',
                'chave_pix' => 'victor@seiva.com',
            ]
        );

        $contaVictor1 = Conta::updateOrCreate(
            ['usuario_id' => $victor->id_usuario, 'nome' => 'Nubank Principal'],
            [
                'tipo' => 'corrente',
                'saldo' => 7200.00,
                'comprometido' => 1200.00,
                'funcao' => 'gasto',
                'cor' => '#820ad1',
                'chave_pix' => 'victor@seiva.com',
            ]
        );

        $contaVictor2 = Conta::updateOrCreate(
            ['usuario_id' => $victor->id_usuario, 'nome' => 'Reserva Inter'],
            [
                'tipo' => 'poupanca',
                'saldo' => 3500.00,
                'comprometido' => 0.00,
                'funcao' => 'reserva',
                'cor' => '#ff7a00',
            ]
        );

        // Transações de Victor Hugo
        Transacao::firstOrCreate(
            ['usuario_id' => $victor->id_usuario, 'titulo' => 'Salário Tech'],
            [
                'conta_id' => $contaVictor1->id_conta,
                'categoria_id' => $catTrabalho->id_categoria,
                'tipo' => 'entrada',
                'valor' => 5500.00,
                'data' => now()->format('Y-m-05'),
                'visibilidade' => 'pessoal',
            ]
        );

        Transacao::firstOrCreate(
            ['usuario_id' => $victor->id_usuario, 'titulo' => 'Supermercado Mensal'],
            [
                'conta_id' => $contaVictor1->id_conta,
                'categoria_id' => $catMercado->id_categoria,
                'tipo' => 'saida',
                'valor' => 850.00,
                'data' => now()->format('Y-m-10'),
                'visibilidade' => 'pessoal',
            ]
        );

        // =========================================================================
        // CENÁRIO 2: CASAL COMPARTILHADO - Duda & Ian ("Nosso Cantinho 🌿")
        // Ian ganha R$ 6.000 (60%) e Duda ganha R$ 4.000 (40%)
        // Saldos somam R$ 14.850,00 (exatamente o protótipo)
        // =========================================================================
        $ian = Usuario::updateOrCreate(
            ['email' => 'ian@seiva.com'],
            [
                'nome' => 'Ian Silva',
                'telefone' => '71988882222',
                'senha_hash' => Hash::make('123456'),
                'pin_caixa_preta' => '9876',
                'tipo_renda' => 'clt',
                'renda_mensal' => 6000.00,
                'dia_recebimento' => 5,
                'tem_renda_extra' => false,
                'renda_extra' => 0,
                'banco_principal' => 'Banco Inter',
                'chave_pix' => 'ian@seiva.com',
            ]
        );

        $duda = Usuario::updateOrCreate(
            ['email' => 'duda@seiva.com'],
            [
                'nome' => 'Duda Lima',
                'telefone' => '71977773333',
                'senha_hash' => Hash::make('123456'),
                'pin_caixa_preta' => '1234',
                'tipo_renda' => 'pj',
                'renda_mensal' => 4000.00,
                'dia_recebimento' => 10,
                'tem_renda_extra' => false,
                'renda_extra' => 0,
                'banco_principal' => 'Nubank',
                'chave_pix' => 'duda@seiva.com',
            ]
        );

        // Contas bancárias
        $contaIan = Conta::updateOrCreate(
            ['usuario_id' => $ian->id_usuario, 'nome' => 'Inter Ian'],
            [
                'tipo' => 'corrente',
                'saldo' => 9900.00,
                'comprometido' => 1800.00,
                'funcao' => 'gasto',
                'cor' => '#ff7a00',
                'chave_pix' => 'ian@seiva.com',
            ]
        );

        $contaDuda = Conta::updateOrCreate(
            ['usuario_id' => $duda->id_usuario, 'nome' => 'Nubank Duda'],
            [
                'tipo' => 'corrente',
                'saldo' => 4950.00,
                'comprometido' => 1200.00,
                'funcao' => 'gasto',
                'cor' => '#820ad1',
                'chave_pix' => 'duda@seiva.com',
            ]
        );
        // Total somado das contas do casal = R$ 14.850,00!

        // Cria o Lar "Nosso Cantinho 🌿"
        $lar = Lar::updateOrCreate(
            ['nome' => 'Nosso Cantinho'],
            [
                'emoji' => '🌿',
                'criado_por' => $ian->id_usuario,
            ]
        );

        // Vincula os membros ao Lar com renda declarada e proporção
        LarMembro::updateOrCreate(
            ['lar_id' => $lar->id_lar, 'usuario_id' => $ian->id_usuario],
            [
                'papel' => 'administrador',
                'renda_declarada' => 6000.00,
                'percentual_contribuicao' => 60.0,
                'aceito_em' => now(),
            ]
        );

        LarMembro::updateOrCreate(
            ['lar_id' => $lar->id_lar, 'usuario_id' => $duda->id_usuario],
            [
                'papel' => 'membro',
                'renda_declarada' => 4000.00,
                'percentual_contribuicao' => 40.0,
                'aceito_em' => now(),
            ]
        );

        // Despesas Compartilhadas do Lar (Total: R$ 4.900, exatamente o protótipo!)
        // 1. Aluguel & Condomínio: R$ 3.200 (Proporcional: Ian 60% = R$ 1.920, Duda 40% = R$ 1.280)
        $despAluguel = DespesaLar::updateOrCreate(
            ['lar_id' => $lar->id_lar, 'titulo' => 'Aluguel & Condomínio'],
            [
                'registrada_por' => $ian->id_usuario,
                'emoji' => '🏠',
                'valor_total' => 3200.00,
                'tipo' => 'fixa',
                'divisao' => 'proporcional',
                'data_vencimento' => now()->format('Y-m-10'),
                'status' => 'parcial',
            ]
        );
        ParticipacaoDespesa::updateOrCreate(
            ['despesa_lar_id' => $despAluguel->id_despesa_lar, 'usuario_id' => $ian->id_usuario],
            ['valor_parte' => 1920.00, 'pago' => true]
        );
        ParticipacaoDespesa::updateOrCreate(
            ['despesa_lar_id' => $despAluguel->id_despesa_lar, 'usuario_id' => $duda->id_usuario],
            ['valor_parte' => 1280.00, 'pago' => false]
        );

        // 2. Supermercado do Mês: R$ 1.550 (Proporcional: Ian 60% = R$ 930, Duda 40% = R$ 620)
        $despMercado = DespesaLar::updateOrCreate(
            ['lar_id' => $lar->id_lar, 'titulo' => 'Supermercado do Mês'],
            [
                'registrada_por' => $duda->id_usuario,
                'emoji' => '🛒',
                'valor_total' => 1550.00,
                'tipo' => 'variavel',
                'divisao' => 'proporcional',
                'data_vencimento' => now()->format('Y-m-15'),
                'status' => 'pago',
            ]
        );
        ParticipacaoDespesa::updateOrCreate(
            ['despesa_lar_id' => $despMercado->id_despesa_lar, 'usuario_id' => $ian->id_usuario],
            ['valor_parte' => 930.00, 'pago' => true]
        );
        ParticipacaoDespesa::updateOrCreate(
            ['despesa_lar_id' => $despMercado->id_despesa_lar, 'usuario_id' => $duda->id_usuario],
            ['valor_parte' => 620.00, 'pago' => true]
        );

        // 3. Internet Fibra: R$ 150 (50/50: R$ 75 cada)
        $despNet = DespesaLar::updateOrCreate(
            ['lar_id' => $lar->id_lar, 'titulo' => 'Internet Fibra 600MB'],
            [
                'registrada_por' => $ian->id_usuario,
                'emoji' => '🌐',
                'valor_total' => 150.00,
                'tipo' => 'fixa',
                'divisao' => '50/50',
                'data_vencimento' => now()->format('Y-m-20'),
                'status' => 'pendente',
            ]
        );
        ParticipacaoDespesa::updateOrCreate(
            ['despesa_lar_id' => $despNet->id_despesa_lar, 'usuario_id' => $ian->id_usuario],
            ['valor_parte' => 75.00, 'pago' => true]
        );
        ParticipacaoDespesa::updateOrCreate(
            ['despesa_lar_id' => $despNet->id_despesa_lar, 'usuario_id' => $duda->id_usuario],
            ['valor_parte' => 75.00, 'pago' => false]
        );

        // Receitas do Mês: Total R$ 8.500 (exatamente o protótipo!)
        Transacao::updateOrCreate(
            ['usuario_id' => $ian->id_usuario, 'titulo' => 'Salário Ian'],
            [
                'conta_id' => $contaIan->id_conta,
                'categoria_id' => $catTrabalho->id_categoria,
                'tipo' => 'entrada',
                'valor' => 5000.00,
                'data' => now()->format('Y-m-05'),
                'visibilidade' => 'lar',
            ]
        );

        Transacao::updateOrCreate(
            ['usuario_id' => $duda->id_usuario, 'titulo' => 'Honorários Design Duda'],
            [
                'conta_id' => $contaDuda->id_conta,
                'categoria_id' => $catTrabalho->id_categoria,
                'tipo' => 'entrada',
                'valor' => 3500.00,
                'data' => now()->format('Y-m-10'),
                'visibilidade' => 'lar',
            ]
        );

        // Proposta de Acordo: Lava e Seca
        Proposta::updateOrCreate(
            ['lar_id' => $lar->id_lar, 'titulo' => 'Comprar Lava e Seca Smart'],
            [
                'autor_id' => $duda->id_usuario,
                'tipo' => 'meta',
                'descricao' => 'Facilita nossa rotina de lavanderia no apartamento novo.',
                'mensagem' => 'Amor, achei essa com 20% de desconto na Black Friday!',
                'valor_total' => 3800.00,
                'divisao' => '50/50',
                'status' => 'pendente',
            ]
        );

        // Caixa Preta Confidencial
        RegistroCaixaPreta::updateOrCreate(
            ['usuario_id' => $ian->id_usuario, 'titulo_cifrado' => 'Presente Aniversário Duda (Aliança)'],
            [
                'valor_cifrado' => '1200.00',
                'conta_cifrada' => 'Nubank Secreto',
                'data' => now()->format('Y-m-02'),
                'bloqueado' => true,
            ]
        );

        RegistroCaixaPreta::updateOrCreate(
            ['usuario_id' => $duda->id_usuario, 'titulo_cifrado' => 'Reserva Viagem Surpresa'],
            [
                'valor_cifrado' => '900.00',
                'conta_cifrada' => 'Cofrinho Oculto',
                'data' => now()->format('Y-m-04'),
                'bloqueado' => true,
            ]
        );

        // Notificação de Lembrete Diplomático
        Notificacao::updateOrCreate(
            ['usuario_id' => $duda->id_usuario, 'titulo' => '🌿 Lembrete diplomático de Ian Silva'],
            [
                'lar_id' => $lar->id_lar,
                'mensagem' => 'Oi amor! Passando só pra lembrar com carinho da nossa divisão de Aluguel (R$ 1.280,00). Segue meu PIX: ian@seiva.com 🌿💚',
                'tipo' => 'lar',
                'tempo' => 'Há 15 min',
            ]
        );
    }
}
