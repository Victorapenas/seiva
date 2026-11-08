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
use App\Http\Controllers\DemoController;

// Rota principal da aplicação SEIVA
Route::get('/', function () {
    return view('app');
});

// APIs Públicas / Auth (RF001)
Route::prefix('api')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Demonstração da Banca / Testes Rápidos
    Route::post('/demo/popular', [DemoController::class, 'seedDemo']);
    Route::post('/demo/limpar', [DemoController::class, 'clearDemo']);

    // Categorias padrão
    Route::get('/categorias', [TransacaoController::class, 'categorias']);

    // Rotas Autenticadas
    Route::middleware('auth')->group(function () {
        // RF009: Painéis Consolidados
        Route::get('/dashboard', [DashboardController::class, 'index']);

        // RF003: Contas e Transações
        Route::get('/contas', [ContaController::class, 'index']);
        Route::post('/contas', [ContaController::class, 'store']);
        Route::put('/contas/{id}', [ContaController::class, 'update']);
        Route::delete('/contas/{id}', [ContaController::class, 'destroy']);

        Route::get('/transacoes', [TransacaoController::class, 'index']);
        Route::post('/transacoes', [TransacaoController::class, 'store']);
        Route::delete('/transacoes/{id}', [TransacaoController::class, 'destroy']);

        // RF002: Caixa Preta
        Route::post('/caixa-preta/verificar-pin', [CaixaPretaController::class, 'verifyPin']);
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
        Route::post('/lar/despesas/quitar/{id}', [LarController::class, 'quitarParticipacao']);

        // RF006: Mesa de Acordos
        Route::get('/acordos', [AcordoController::class, 'index']);
        Route::post('/acordos', [AcordoController::class, 'store']);
        Route::post('/acordos/propostas', [AcordoController::class, 'criarProposta']);
        Route::post('/acordos/propostas/votar/{id}', [AcordoController::class, 'votarProposta']);

        // RF007: Criar Metas
        Route::get('/metas', [MetaController::class, 'index']);
        Route::post('/metas', [MetaController::class, 'store']);
        Route::post('/metas/{id}/contribuir', [MetaController::class, 'contribuir']);

        // RF008: Gerenciar Projetos
        Route::get('/projetos', [ProjetoController::class, 'index']);
        Route::post('/projetos', [ProjetoController::class, 'store']);
        Route::post('/projetos/{id}/itens', [ProjetoController::class, 'addItem']);
        Route::post('/projetos/itens/toggle/{id}', [ProjetoController::class, 'toggleItem']);

        // RF005: Cobrador Diplomata
        Route::get('/cobrancas', [CobrancaController::class, 'index']);
        Route::post('/cobrancas/lembrete', [CobrancaController::class, 'enviarLembrete']);

        // RF011: Gestão de Conta e LGPD
        Route::put('/perfil', [LgpdController::class, 'updateProfile']);
        Route::get('/perfil/exportar', [LgpdController::class, 'exportData']);
        Route::delete('/perfil/excluir', [LgpdController::class, 'deleteAccount']);
    });
});
