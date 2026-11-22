<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\TransacaoController;
use App\Http\Controllers\CaixaPretaController;
use App\Http\Controllers\LarController;
use App\Http\Controllers\AcordoController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\CobrancaController;
use App\Http\Controllers\LgpdController;
use App\Http\Controllers\RecebimentosController;
use App\Http\Controllers\NotificacoesController;

// Rota principal da aplicação SEIVA
Route::get('/', function () {
    return view('app');
})->name('login');

// Apresentação Interativa do Projeto SEIVA (PI - IFBA)
Route::get('/apresentacao', function () {
    $path = base_path('docs/apresentacao-pi.html');
    return response()->file($path, ['Content-Type' => 'text/html; charset=UTF-8']);
});

// Janela Popup Oficial do Google OAuth2
Route::get('/auth/google/popup', function () {
    return view('auth.google-popup');
});

// APIs Públicas / Auth (RF001)
Route::prefix('api')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/auth/google', [AuthController::class, 'googleLogin']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Categorias padrão
    Route::get('/categorias', [TransacaoController::class, 'categorias']);

    // Rotas Autenticadas
    Route::middleware('auth')->group(function () {
        // RF009: Painéis Consolidados
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::post('/pagamentos/registrar', [DashboardController::class, 'registrarPagamento']);

        // RF003: Contas e Transações
        Route::get('/contas', [ContaController::class, 'index']);
        Route::post('/contas', [ContaController::class, 'store']);
        Route::put('/contas/{id}', [ContaController::class, 'update']);
        Route::post('/contas/{id}/atualizar', [ContaController::class, 'update']);
        Route::post('/contas/{id}/saldo', [DashboardController::class, 'ajustarSaldoConta']);
        Route::delete('/contas/{id}', [ContaController::class, 'destroy']);

        Route::get('/transacoes', [TransacaoController::class, 'index']);
        Route::post('/transacoes', [TransacaoController::class, 'store']);
        Route::put('/transacoes/{id}', [TransacaoController::class, 'update']);
        Route::post('/transacoes/{id}/atualizar', [TransacaoController::class, 'update']);
        Route::post('/transacoes/{id}/icone', [TransacaoController::class, 'atualizarIcone']);
        Route::delete('/transacoes/{id}', [TransacaoController::class, 'destroy']);

        // RF002: Caixa Preta
        Route::post('/caixa-preta/verificar-pin', [CaixaPretaController::class, 'verifyPin']);
        Route::post('/caixa-preta/trancar', [CaixaPretaController::class, 'trancar']);
        Route::get('/caixa-preta/dados', [CaixaPretaController::class, 'dadosCompletos']);
        Route::post('/caixa-preta/pedir-ajuda', [CaixaPretaController::class, 'pedirAjudaCusto']);
        Route::post('/caixa-preta/responder-ajuda', [CaixaPretaController::class, 'responderAjudaCusto']);
        Route::post('/caixa-preta/confirmar-recebimento', [CaixaPretaController::class, 'confirmarRecebimento']);
        Route::post('/caixa-preta/disputar-recebimento', [CaixaPretaController::class, 'disputarRecebimento']);
        Route::post('/caixa-preta/produtos-watchlist', [CaixaPretaController::class, 'adicionarProdutoWatchlist']);
        Route::delete('/caixa-preta/produtos-watchlist/{id}', [CaixaPretaController::class, 'removerProdutoWatchlist']);
        Route::get('/caixa-preta/registros', [CaixaPretaController::class, 'index']);
        Route::post('/caixa-preta/registros', [CaixaPretaController::class, 'store']);
        Route::delete('/caixa-preta/registros/{id}', [CaixaPretaController::class, 'destroy']);

        // RF004 & RF010: Lares, Convites e Despesas Compartilhadas
        Route::get('/lar', [LarController::class, 'show']);
        Route::post('/lar', [LarController::class, 'store']);
        Route::post('/lar/convite', [LarController::class, 'invite']);
        Route::post('/lar/entrar', [LarController::class, 'join']);
        Route::get('/lar/despesas', [LarController::class, 'despesas']);
        Route::post('/lar/despesas', [LarController::class, 'storeDespesa']);
        Route::post('/lar/despesas/{id}/atualizar', [LarController::class, 'updateDespesa']);
        Route::put('/lar/despesas/{id}', [LarController::class, 'updateDespesa']);
        Route::delete('/lar/despesas/{id}', [LarController::class, 'destroyDespesa']);
        Route::post('/lar/despesas/quitar/{id}', [LarController::class, 'quitarParticipacao']);
        Route::post('/lar/despesas/pagar', [LarController::class, 'pagarDespesa']);
        Route::post('/lar/fundo-emergencia/reforcar', [LarController::class, 'reforcarFundoEmergencia']);
        Route::post('/lar/fundo-emergencia/resgatar', [LarController::class, 'solicitarResgateEmergencia']);
        Route::post('/lar/notificar-pendencia', [LarController::class, 'notificarPendencia']);
        Route::post('/lar/foto-capa', [LarController::class, 'atualizarFotoCapa']);

        // RF006: Mesa de Acordos
        Route::get('/acordos', [AcordoController::class, 'index']);
        Route::post('/acordos', [AcordoController::class, 'store']);
        Route::post('/acordos/propostas', [AcordoController::class, 'criarProposta']);
        Route::post('/acordos/propostas/votar/{id}', [AcordoController::class, 'votarProposta']);

        // RF007: Criar Metas e Monitoramento de Produtos
        Route::get('/metas', [MetaController::class, 'index']);
        Route::post('/metas', [MetaController::class, 'store']);
        Route::post('/metas/{id}/contribuir', [MetaController::class, 'contribuir']);
        Route::post('/metas/{id}/guardar', [MetaController::class, 'contribuir']);
        Route::match(['put', 'post'], '/metas/{id}', [MetaController::class, 'atualizarMeta']);
        Route::post('/metas/{id}/atualizar', [MetaController::class, 'atualizarMeta']);
        Route::delete('/metas/{id}', [MetaController::class, 'destroy']);
        Route::post('/metas/{id}/excluir', [MetaController::class, 'destroy']);
        Route::post('/metas/{id}/desfazer', [MetaController::class, 'desfazerMeta']);
        Route::post('/metas/consultar-link', [MetaController::class, 'consultarLinkProduto']);

        // RF003: Relatórios e Recebimentos
        Route::get('/recebimentos', [RecebimentosController::class, 'relatorio']);
        Route::get('/transacoes/lar', [TransacaoController::class, 'indexLar']);

        // RF008: Gerenciar Projetos
        Route::get('/projetos', [ProjetoController::class, 'index']);
        Route::post('/projetos', [ProjetoController::class, 'store']);
        Route::post('/projetos/{id}/itens', [ProjetoController::class, 'addItem']);
        Route::post('/projetos/itens/toggle/{id}', [ProjetoController::class, 'toggleItem']);

        // RF005: Cobrador Diplomata
        Route::get('/cobrancas', [CobrancaController::class, 'index']);
        Route::post('/cobrancas/lembrete', [CobrancaController::class, 'enviarLembrete']);

        // RF011: Gestão de Conta e LGPD
        Route::get('/perfil', [LgpdController::class, 'show']);
        Route::put('/perfil', [LgpdController::class, 'updateProfile']);
        Route::get('/perfil/exportar', [LgpdController::class, 'exportData']);
        Route::delete('/perfil/excluir', [LgpdController::class, 'deleteAccount']);
        Route::post('/cobrancas/configurar', [CobrancaController::class, 'salvarConfiguracao']);

        // Notificações do Painel de Boas-Vindas
        Route::get('/notificacoes', [NotificacoesController::class, 'index']);
        Route::post('/notificacoes/ler', [NotificacoesController::class, 'marcarTodasLidas']);
    });
});

Route::middleware('auth')->group(function () {
    Route::post('/transacoes/{id}/icone', [TransacaoController::class, 'atualizarIcone']);
    Route::put('/transacoes/{id}', [TransacaoController::class, 'update']);
    Route::post('/transacoes/{id}/atualizar', [TransacaoController::class, 'update']);
    Route::delete('/transacoes/{id}', [TransacaoController::class, 'destroy']);

    // Aliases de Metas sem /api
    Route::delete('/metas/{id}', [MetaController::class, 'destroy']);
    Route::post('/metas/{id}/excluir', [MetaController::class, 'destroy']);
    Route::post('/metas/{id}/atualizar', [MetaController::class, 'atualizarMeta']);

    // Aliases de Contas sem /api
    Route::put('/contas/{id}', [ContaController::class, 'update']);
    Route::post('/contas/{id}/atualizar', [ContaController::class, 'update']);
    Route::delete('/contas/{id}', [ContaController::class, 'destroy']);

    // Aliases de Lar sem prefixo /api para compatibilidade total do frontend
    Route::post('/lar/despesas', [LarController::class, 'storeDespesa']);
    Route::post('/lar/despesas/{id}/atualizar', [LarController::class, 'updateDespesa']);
    Route::put('/lar/despesas/{id}', [LarController::class, 'updateDespesa']);
    Route::delete('/lar/despesas/{id}', [LarController::class, 'destroyDespesa']);
    Route::post('/lar/despesas/quitar/{id}', [LarController::class, 'quitarParticipacao']);
    Route::post('/lar/despesas/pagar', [LarController::class, 'pagarDespesa']);
    Route::post('/lar/fundo-emergencia/reforcar', [LarController::class, 'reforcarFundoEmergencia']);
    Route::post('/lar/fundo-emergencia/resgatar', [LarController::class, 'solicitarResgateEmergencia']);
    Route::post('/lar/notificar-pendencia', [LarController::class, 'notificarPendencia']);
    Route::post('/lar/foto-capa', [LarController::class, 'atualizarFotoCapa']);
});
