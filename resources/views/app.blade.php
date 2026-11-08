<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEIVA — Dinheiro Sem Tabu | Gestão Financeira Pessoal e Compartilhada</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        seiva: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                            dark: '#0d1a14',
                            card: '#13231b',
                            border: '#1e382b',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0b1510;
            color: #e2e8f0;
        }
        .seiva-glass {
            background: rgba(19, 35, 27, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(46, 80, 62, 0.4);
        }
        .seiva-card {
            background-color: #13231b;
            border: 1px solid #1e382b;
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-emerald-500 selection:text-white">

    <!-- Top Alert / Demo Switcher Banner -->
    <header class="seiva-glass sticky top-0 z-40 border-b border-seiva-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3 cursor-pointer" onclick="navigate('dashboard')">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-400 flex items-center justify-center shadow-lg shadow-emerald-900/40">
                    <span class="text-2xl">🌿</span>
                </div>
                <div>
                    <span class="text-xl font-extrabold tracking-tight text-white flex items-center gap-1.5">
                        SEIVA <span class="text-xs px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-400 font-semibold border border-emerald-500/30">PI v2.0</span>
                    </span>
                    <p class="text-[11px] text-emerald-400/80 font-medium hidden sm:block">Dinheiro Sem Tabu · Pessoal & Casais</p>
                </div>
            </div>

            <!-- Top Right: Actions & Profile -->
            <div class="flex items-center space-x-3">
                <!-- Avaliação & Testes Dropdown -->
                <div class="relative">
                    <button onclick="toggleDropdown('demoDropdown')" class="px-3 py-1.5 rounded-lg bg-emerald-950/80 border border-emerald-700/60 text-emerald-300 text-xs font-semibold hover:bg-emerald-900/80 transition flex items-center gap-1.5">
                        <i data-lucide="flask-conical" class="w-3.5 h-3.5"></i>
                        <span class="hidden md:inline">🧪 Modo Avaliação</span>
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5"></i>
                    </button>
                    <div id="demoDropdown" class="hidden absolute right-0 mt-2 w-64 bg-seiva-card border border-seiva-border rounded-xl shadow-2xl p-2 z-50 text-xs">
                        <p class="px-2 py-1 font-bold text-gray-400 uppercase tracking-wider text-[10px]">Testes Rápidos</p>
                        <button onclick="carregarCenarioDemo()" class="w-full text-left px-3 py-2 rounded-lg hover:bg-emerald-900/50 text-emerald-300 flex items-center gap-2 transition">
                            <i data-lucide="play-circle" class="w-4 h-4 text-emerald-400"></i>
                            <div>
                                <p class="font-bold">Carregar Duda & Ian (Demo)</p>
                                <p class="text-[10px] text-gray-400">Popula contas, lar e acordos da apresentação</p>
                            </div>
                        </button>
                        <button onclick="limparBancoTeste()" class="w-full text-left px-3 py-2 rounded-lg hover:bg-red-950/50 text-red-300 flex items-center gap-2 mt-1 transition">
                            <i data-lucide="trash-2" class="w-4 h-4 text-red-400"></i>
                            <div>
                                <p class="font-bold">Limpar Banco (Zero)</p>
                                <p class="text-[10px] text-gray-400">Remove tudo para testar cadastro novo</p>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Notificações -->
                <button onclick="abrirNotificacoes()" class="relative p-2 rounded-xl bg-seiva-border/40 hover:bg-seiva-border text-gray-300 transition">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    <span id="notifBadge" class="hidden absolute top-1 right-1 w-2.5 h-2.5 rounded-full bg-emerald-500 ring-2 ring-[#0b1510]"></span>
                </button>

                <!-- Usuário Ativo / Login -->
                <div id="userProfileArea">
                    <button onclick="abrirAuthModal()" class="px-4 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-xs shadow-md shadow-emerald-900/30 transition">
                        Entrar / Cadastrar
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- App Body Layout -->
    <div class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col md:flex-row gap-6">

        <!-- Sidebar Navigation (Desktop) -->
        <aside class="hidden md:flex flex-col w-64 space-y-2 shrink-0">
            <nav class="seiva-card rounded-2xl p-3 border border-seiva-border space-y-1">
                <button onclick="navigate('dashboard')" class="nav-item flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl font-medium text-sm transition text-emerald-400 bg-emerald-950/60 border border-emerald-800/40" data-page="dashboard">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>Dashboard Geral</span>
                </button>
                <button onclick="navigate('transacoes')" class="nav-item flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl font-medium text-sm transition text-gray-400 hover:text-white hover:bg-seiva-border/50" data-page="transacoes">
                    <i data-lucide="arrow-left-right" class="w-4 h-4"></i>
                    <span>Transações & Contas</span>
                </button>
                <button onclick="navigate('lar')" class="nav-item flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl font-medium text-sm transition text-gray-400 hover:text-white hover:bg-seiva-border/50" data-page="lar">
                    <i data-lucide="home" class="w-4 h-4"></i>
                    <span>Lar & Despesas</span>
                </button>
                <button onclick="navigate('acordos')" class="nav-item flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl font-medium text-sm transition text-gray-400 hover:text-white hover:bg-seiva-border/50" data-page="acordos">
                    <i data-lucide="handshake" class="w-4 h-4"></i>
                    <span>Mesa de Acordos</span>
                </button>
                <button onclick="navigate('metas')" class="nav-item flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl font-medium text-sm transition text-gray-400 hover:text-white hover:bg-seiva-border/50" data-page="metas">
                    <i data-lucide="target" class="w-4 h-4"></i>
                    <span>Metas & Projetos</span>
                </button>
                <button onclick="navigate('caixa-preta')" class="nav-item flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl font-medium text-sm transition text-gray-400 hover:text-white hover:bg-seiva-border/50" data-page="caixa-preta">
                    <i data-lucide="lock" class="w-4 h-4 text-amber-400"></i>
                    <span>Caixa Preta (PIN)</span>
                </button>
                <button onclick="navigate('cobrador')" class="nav-item flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl font-medium text-sm transition text-gray-400 hover:text-white hover:bg-seiva-border/50" data-page="cobrador">
                    <i data-lucide="message-square-heart" class="w-4 h-4 text-teal-400"></i>
                    <span>Cobrador Diplomata</span>
                </button>
                <button onclick="navigate('perfil')" class="nav-item flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl font-medium text-sm transition text-gray-400 hover:text-white hover:bg-seiva-border/50" data-page="perfil">
                    <i data-lucide="shield-check" class="w-4 h-4 text-cyan-400"></i>
                    <span>Perfil & LGPD</span>
                </button>
            </nav>

            <!-- Quick Add Button -->
            <button onclick="abrirModalNovaTransacao()" class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-500 hover:to-teal-400 text-white font-bold text-sm shadow-lg shadow-emerald-900/40 flex items-center justify-center gap-2 transition active:scale-95">
                <i data-lucide="plus" class="w-5 h-5"></i>
                <span>Novo Lançamento</span>
            </button>

            <!-- Lar Widget Box -->
            <div id="sidebarLarBox" class="seiva-card rounded-2xl p-4 border border-seiva-border mt-auto">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Meu Lar</span>
                    <span id="sidebarLarEmoji">🌿</span>
                </div>
                <p id="sidebarLarNome" class="font-bold text-white text-sm">Sem Lar Ativo</p>
                <p id="sidebarLarMembros" class="text-xs text-gray-400 mt-0.5">Crie ou participe de um lar compartilhado</p>
                <button onclick="navigate('lar')" class="mt-3 w-full py-1.5 rounded-lg bg-seiva-border/60 hover:bg-seiva-border text-emerald-400 text-xs font-semibold transition">
                    Gerenciar Lar
                </button>
            </div>
        </aside>

        <!-- Main Content Dynamic Container -->
        <main class="flex-1 overflow-y-auto">
            
            <!-- VIEW: DASHBOARD -->
            <section id="view-dashboard" class="page-view space-y-6">
                <!-- Welcome Banner -->
                <div class="seiva-glass rounded-2xl p-6 border border-seiva-border relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <span class="px-2.5 py-1 rounded-md bg-emerald-950 text-emerald-400 border border-emerald-800 text-xs font-semibold">Visão Geral Consolidada</span>
                                <h1 class="text-2xl font-extrabold text-white mt-2" id="dashUserGreeting">Olá, Seja bem-vindo ao SEIVA!</h1>
                                <p class="text-xs text-gray-400 mt-1">Organização financeira com total transparência e sem conflitos.</p>
                            </div>
                            <div class="flex gap-2">
                                <button onclick="abrirModalNovaTransacao()" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition flex items-center gap-1.5 shadow-md">
                                    <i data-lucide="plus" class="w-4 h-4"></i> Lançar Valor
                                </button>
                                <button onclick="abrirModalNovaDespesaLar()" class="px-4 py-2 rounded-xl bg-seiva-border/80 hover:bg-seiva-border text-emerald-300 text-xs font-bold transition flex items-center gap-1.5">
                                    <i data-lucide="home" class="w-4 h-4"></i> Despesa do Lar
                                </button>
                            </div>
                        </div>

                        <!-- 4 Stat Cards -->
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
                            <div class="seiva-card rounded-xl p-4 border border-seiva-border">
                                <span class="text-xs font-semibold text-gray-400 flex items-center justify-between">
                                    Saldo Livre <i data-lucide="wallet" class="w-4 h-4 text-emerald-400"></i>
                                </span>
                                <p class="text-xl font-black text-emerald-400 mt-2" id="cardSaldoLivre">R$ 0,00</p>
                                <p class="text-[11px] text-gray-500 mt-0.5">Disponível para gastar</p>
                            </div>

                            <div class="seiva-card rounded-xl p-4 border border-seiva-border">
                                <span class="text-xs font-semibold text-gray-400 flex items-center justify-between">
                                    Comprometido <i data-lucide="lock" class="w-4 h-4 text-amber-400"></i>
                                </span>
                                <p class="text-xl font-black text-amber-400 mt-2" id="cardComprometido">R$ 0,00</p>
                                <p class="text-[11px] text-gray-500 mt-0.5">Faturas & Reservas</p>
                            </div>

                            <div class="seiva-card rounded-xl p-4 border border-seiva-border">
                                <span class="text-xs font-semibold text-gray-400 flex items-center justify-between">
                                    Entradas Mês <i data-lucide="trending-up" class="w-4 h-4 text-teal-400"></i>
                                </span>
                                <p class="text-xl font-black text-teal-300 mt-2" id="cardEntradas">R$ 0,00</p>
                                <p class="text-[11px] text-gray-500 mt-0.5">Renda e extras</p>
                            </div>

                            <div class="seiva-card rounded-xl p-4 border border-seiva-border">
                                <span class="text-xs font-semibold text-gray-400 flex items-center justify-between">
                                    Saídas Mês <i data-lucide="trending-down" class="w-4 h-4 text-rose-400"></i>
                                </span>
                                <p class="text-xl font-black text-rose-400 mt-2" id="cardSaidas">R$ 0,00</p>
                                <p class="text-[11px] text-gray-500 mt-0.5">Despesas pessoais</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle Section: Categories Chart & Recent Transactions -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Chart Card -->
                    <div class="seiva-card rounded-2xl p-5 border border-seiva-border flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-sm font-bold text-white flex items-center gap-2">
                                <i data-lucide="pie-chart" class="w-4 h-4 text-emerald-400"></i>
                                Gastos por Categoria
                            </h2>
                            <span class="text-xs text-gray-400">Mês Atual</span>
                        </div>
                        <div class="flex-1 flex items-center justify-center min-h-[220px]">
                            <canvas id="categoryChart" class="max-h-[220px]"></canvas>
                        </div>
                    </div>

                    <!-- Recent Transactions -->
                    <div class="seiva-card rounded-2xl p-5 border border-seiva-border flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-sm font-bold text-white flex items-center gap-2">
                                <i data-lucide="history" class="w-4 h-4 text-emerald-400"></i>
                                Transações Recentes
                            </h2>
                            <button onclick="navigate('transacoes')" class="text-xs text-emerald-400 hover:underline">Ver todas</button>
                        </div>
                        <div id="recentTransactionsList" class="space-y-2.5 flex-1">
                            <p class="text-xs text-gray-500 text-center py-8">Nenhuma transação cadastrada ainda.</p>
                        </div>
                    </div>
                </div>

                <!-- Contas & Cartões Strip -->
                <div class="seiva-card rounded-2xl p-5 border border-seiva-border">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-sm font-bold text-white flex items-center gap-2">
                            <i data-lucide="credit-card" class="w-4 h-4 text-emerald-400"></i>
                            Contas Bancárias & Cartões
                        </h2>
                        <button onclick="abrirModalNovaConta()" class="text-xs font-semibold px-3 py-1 rounded-lg bg-seiva-border hover:bg-emerald-800 text-emerald-300 transition">
                            + Adicionar Conta
                        </button>
                    </div>
                    <div id="dashboardAccountsList" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <p class="text-xs text-gray-500 py-4 col-span-full">Nenhuma conta bancária conectada.</p>
                    </div>
                </div>
            </section>

            <!-- VIEW: TRANSAÇÕES & CONTAS -->
            <section id="view-transacoes" class="page-view space-y-6 hidden">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-xl font-bold text-white flex items-center gap-2">
                            <i data-lucide="arrow-left-right" class="w-5 h-5 text-emerald-400"></i>
                            Transações Financeiras (Extrato)
                        </h1>
                        <p class="text-xs text-gray-400">Controle completo de entradas, saídas e movimentações</p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="abrirModalNovaTransacao()" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition flex items-center gap-1.5">
                            <i data-lucide="plus" class="w-4 h-4"></i> Nova Transação
                        </button>
                    </div>
                </div>

                <div class="seiva-card rounded-2xl border border-seiva-border overflow-hidden">
                    <div class="p-4 border-b border-seiva-border flex flex-wrap gap-2 items-center justify-between">
                        <div class="flex gap-2">
                            <button onclick="filtrarTransacoes('')" class="px-3 py-1 rounded-lg bg-emerald-950 text-emerald-300 border border-emerald-800 text-xs font-semibold">Todas</button>
                            <button onclick="filtrarTransacoes('entrada')" class="px-3 py-1 rounded-lg bg-seiva-border/40 hover:bg-seiva-border text-gray-300 text-xs font-semibold">Entradas</button>
                            <button onclick="filtrarTransacoes('saida')" class="px-3 py-1 rounded-lg bg-seiva-border/40 hover:bg-seiva-border text-gray-300 text-xs font-semibold">Saídas</button>
                        </div>
                        <span id="transacoesCount" class="text-xs text-gray-400">0 lançamentos</span>
                    </div>
                    <div id="fullTransactionsList" class="divide-y divide-seiva-border/60">
                        <p class="text-xs text-gray-500 text-center py-10">Nenhuma transação encontrada.</p>
                    </div>
                </div>
            </section>

            <!-- VIEW: LAR & DESPESAS -->
            <section id="view-lar" class="page-view space-y-6 hidden">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-xl font-bold text-white flex items-center gap-2">
                            <span id="larHeaderEmoji">🌿</span>
                            <span id="larHeaderTitle">Gestão do Lar & Rateio de Despesas</span>
                        </h1>
                        <p class="text-xs text-gray-400">Divisão transparente de contas (50/50 ou Proporcional à renda)</p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="abrirModalCriarLar()" class="px-3 py-2 rounded-xl bg-seiva-border/80 hover:bg-seiva-border text-emerald-300 text-xs font-bold transition flex items-center gap-1.5">
                            <i data-lucide="plus-circle" class="w-4 h-4"></i> Criar/Alterar Lar
                        </button>
                        <button onclick="abrirModalConviteLar()" class="px-3 py-2 rounded-xl bg-teal-800/80 hover:bg-teal-700 text-teal-200 text-xs font-bold transition flex items-center gap-1.5">
                            <i data-lucide="user-plus" class="w-4 h-4"></i> Convidar Parceiro(a)
                        </button>
                        <button onclick="abrirModalNovaDespesaLar()" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition flex items-center gap-1.5 shadow-md">
                            <i data-lucide="receipt" class="w-4 h-4"></i> Lançar Despesa Lar
                        </button>
                    </div>
                </div>

                <!-- Membros e Rendas Compartilhadas -->
                <div class="seiva-card rounded-2xl p-5 border border-seiva-border">
                    <h2 class="text-sm font-bold text-white mb-3 flex items-center gap-2">
                        <i data-lucide="users" class="w-4 h-4 text-emerald-400"></i> Membros do Lar e Regra de Rateio
                    </h2>
                    <div id="larMembersList" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <p class="text-xs text-gray-500 py-4 col-span-full">Nenhum lar configurado ainda. Clique em "Criar/Alterar Lar" para começar!</p>
                    </div>
                </div>

                <!-- Despesas Compartilhadas do Mês -->
                <div class="seiva-card rounded-2xl p-5 border border-seiva-border">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-sm font-bold text-white flex items-center gap-2">
                            <i data-lucide="receipt" class="w-4 h-4 text-emerald-400"></i> Despesas do Lar Cadastradas
                        </h2>
                    </div>
                    <div id="larExpensesList" class="space-y-3">
                        <p class="text-xs text-gray-500 text-center py-8">Nenhuma despesa compartilhada registrada ainda.</p>
                    </div>
                </div>
            </section>

            <!-- VIEW: MESA DE ACORDOS -->
            <section id="view-acordos" class="page-view space-y-6 hidden">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-xl font-bold text-white flex items-center gap-2">
                            <i data-lucide="handshake" class="w-5 h-5 text-emerald-400"></i>
                            Mesa de Acordos & Consenso
                        </h1>
                        <p class="text-xs text-gray-400">Proponha gastos, novas regras e aprovem antes de gastar</p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="abrirModalNovaProposta()" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition flex items-center gap-1.5 shadow-md">
                            <i data-lucide="plus" class="w-4 h-4"></i> Nova Proposta
                        </button>
                    </div>
                </div>

                <!-- Propostas em Análise -->
                <div class="seiva-card rounded-2xl p-5 border border-seiva-border">
                    <h2 class="text-sm font-bold text-amber-400 mb-3 flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4"></i> Propostas em Rodada de Votação
                    </h2>
                    <div id="propostasList" class="space-y-3">
                        <p class="text-xs text-gray-500 text-center py-6">Nenhuma proposta em negociação no momento.</p>
                    </div>
                </div>

                <!-- Acordos Selados -->
                <div class="seiva-card rounded-2xl p-5 border border-seiva-border">
                    <h2 class="text-sm font-bold text-emerald-400 mb-3 flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-4 h-4"></i> Acordos Selados do Lar
                    </h2>
                    <div id="acordosSeladosList" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <p class="text-xs text-gray-500 text-center py-6 col-span-full">Nenhum acordo ativo ainda.</p>
                    </div>
                </div>
            </section>

            <!-- VIEW: METAS & PROJETOS -->
            <section id="view-metas" class="page-view space-y-6 hidden">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-xl font-bold text-white flex items-center gap-2">
                            <i data-lucide="target" class="w-5 h-5 text-emerald-400"></i>
                            Metas & Cofres Virtuais
                        </h1>
                        <p class="text-xs text-gray-400">Objetivos financeiros individuais e conquistas do casal</p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="abrirModalNovaMeta()" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition flex items-center gap-1.5 shadow-md">
                            <i data-lucide="plus" class="w-4 h-4"></i> Nova Meta
                        </button>
                    </div>
                </div>

                <!-- Metas do Lar -->
                <div class="seiva-card rounded-2xl p-5 border border-seiva-border">
                    <h2 class="text-sm font-bold text-white mb-3 flex items-center gap-2">
                        <span>🌿</span> Metas Compartilhadas do Lar
                    </h2>
                    <div id="metasLarList" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <p class="text-xs text-gray-500 py-6 col-span-full">Nenhuma meta do lar cadastrada.</p>
                    </div>
                </div>

                <!-- Metas Individuais -->
                <div class="seiva-card rounded-2xl p-5 border border-seiva-border">
                    <h2 class="text-sm font-bold text-white mb-3 flex items-center gap-2">
                        <span>👤</span> Metas Individuais
                    </h2>
                    <div id="metasIndividuaisList" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <p class="text-xs text-gray-500 py-6 col-span-full">Nenhuma meta pessoal cadastrada.</p>
                    </div>
                </div>
            </section>

            <!-- VIEW: CAIXA PRETA (PRIVADO - RF002) -->
            <section id="view-caixa-preta" class="page-view space-y-6 hidden">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-xl font-bold text-amber-400 flex items-center gap-2">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                            Caixa Preta (Área Confidencial)
                        </h1>
                        <p class="text-xs text-gray-400">Proteção total com PIN. Gastos e reservas invisíveis no extrato comum.</p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="bloquearCaixaPreta()" class="px-3 py-2 rounded-xl bg-amber-950 text-amber-300 border border-amber-800 text-xs font-bold transition flex items-center gap-1.5">
                            <i data-lucide="lock" class="w-4 h-4"></i> Bloquear Agora
                        </button>
                    </div>
                </div>

                <!-- PIN Lock Screen -->
                <div id="caixaPretaLockScreen" class="seiva-card rounded-2xl p-8 border border-amber-900/60 max-w-md mx-auto text-center space-y-4">
                    <div class="w-14 h-14 mx-auto rounded-full bg-amber-950/80 border border-amber-700 flex items-center justify-center text-amber-400">
                        <i data-lucide="shield-alert" class="w-7 h-7"></i>
                    </div>
                    <h2 class="text-lg font-bold text-white">Área Protegida por Senha</h2>
                    <p class="text-xs text-gray-400">Digite seu PIN secundário de 4 dígitos para desbloquear seus registros confidenciais (padrão: 1234).</p>
                    
                    <div class="flex justify-center gap-2 my-4">
                        <input type="password" id="caixaPinInput" maxlength="6" class="w-48 text-center text-2xl tracking-widest px-4 py-2 rounded-xl bg-black border border-amber-800 text-amber-300 focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="••••">
                    </div>
                    <button onclick="desbloquearCaixaPreta()" class="w-full py-2.5 rounded-xl bg-amber-600 hover:bg-amber-500 text-black font-extrabold text-sm transition">
                        Desbloquear Caixa Preta
                    </button>
                </div>

                <!-- Unlocked Content -->
                <div id="caixaPretaContent" class="space-y-6 hidden">
                    <div class="seiva-card rounded-2xl p-5 border border-amber-800/60">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-xs font-bold text-amber-400 uppercase tracking-wider">Total Oculto Guardado</span>
                                <p class="text-2xl font-black text-white mt-1" id="caixaPretaTotal">R$ 0,00</p>
                            </div>
                            <button onclick="abrirModalNovoRegistroCaixaPreta()" class="px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-500 text-black font-bold text-xs transition">
                                + Novo Registro Secreto
                            </button>
                        </div>
                        <div id="caixaPretaList" class="space-y-2">
                            <p class="text-xs text-gray-500 text-center py-6">Nenhum registro confidencial salvo.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- VIEW: COBRADOR DIPLOMATA (RF005) -->
            <section id="view-cobrador" class="page-view space-y-6 hidden">
                <div>
                    <h1 class="text-xl font-bold text-teal-300 flex items-center gap-2">
                        <i data-lucide="message-square-heart" class="w-5 h-5"></i>
                        Cobrador Diplomata
                    </h1>
                    <p class="text-xs text-gray-400">Lembretes carinhosos e gentis para quitação de pendências sem desconforto</p>
                </div>

                <div class="seiva-card rounded-2xl p-5 border border-seiva-border">
                    <h2 class="text-sm font-bold text-white mb-3">Pendências no Lar a Acertar</h2>
                    <div id="cobradorPendenciasList" class="space-y-3">
                        <p class="text-xs text-gray-500 text-center py-6">Tudo em dia! Nenhuma pendência para cobrar.</p>
                    </div>
                </div>
            </section>

            <!-- VIEW: PERFIL & LGPD (RF011) -->
            <section id="view-perfil" class="page-view space-y-6 hidden">
                <div>
                    <h1 class="text-xl font-bold text-cyan-400 flex items-center gap-2">
                        <i data-lucide="shield-check" class="w-5 h-5"></i>
                        Meu Perfil & Gestão de Dados (LGPD)
                    </h1>
                    <p class="text-xs text-gray-400">Conformidade com a LGPD: visualize, edite, baixe ou exclua seus dados</p>
                </div>

                <div class="seiva-card rounded-2xl p-6 border border-seiva-border space-y-4 max-w-2xl">
                    <h2 class="text-sm font-bold text-white">Dados Cadastrais</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs text-gray-400">Nome Completo</label>
                            <input type="text" id="perfilNome" class="w-full mt-1 px-3 py-2 rounded-xl bg-black/60 border border-seiva-border text-white text-xs">
                        </div>
                        <div>
                            <label class="text-xs text-gray-400">E-mail</label>
                            <input type="email" id="perfilEmail" disabled class="w-full mt-1 px-3 py-2 rounded-xl bg-black/30 border border-seiva-border text-gray-400 text-xs">
                        </div>
                        <div>
                            <label class="text-xs text-gray-400">Renda Mensal Fixa (R$)</label>
                            <input type="number" id="perfilRenda" class="w-full mt-1 px-3 py-2 rounded-xl bg-black/60 border border-seiva-border text-white text-xs">
                        </div>
                        <div>
                            <label class="text-xs text-gray-400">Renda Extra / Freelas (R$)</label>
                            <input type="number" id="perfilRendaExtra" class="w-full mt-1 px-3 py-2 rounded-xl bg-black/60 border border-seiva-border text-white text-xs">
                        </div>
                        <div>
                            <label class="text-xs text-gray-400">Chave PIX</label>
                            <input type="text" id="perfilPix" class="w-full mt-1 px-3 py-2 rounded-xl bg-black/60 border border-seiva-border text-white text-xs">
                        </div>
                        <div>
                            <label class="text-xs text-gray-400">PIN da Caixa Preta (4 dígitos)</label>
                            <input type="password" id="perfilPin" maxlength="6" class="w-full mt-1 px-3 py-2 rounded-xl bg-black/60 border border-seiva-border text-white text-xs">
                        </div>
                    </div>
                    <button onclick="salvarPerfil()" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition">
                        Salvar Alterações
                    </button>
                </div>

                <!-- LGPD Actions -->
                <div class="seiva-card rounded-2xl p-6 border border-seiva-border space-y-4 max-w-2xl">
                    <h2 class="text-sm font-bold text-white flex items-center gap-2">
                        <i data-lucide="download" class="w-4 h-4 text-cyan-400"></i> Direitos do Titular (LGPD)
                    </h2>
                    <p class="text-xs text-gray-400">Em conformidade com a Lei Geral de Proteção de Dados (Lei 13.709/2018), você pode exportar todos os seus dados em formato portátil (JSON) ou solicitar a exclusão definitiva.</p>
                    
                    <div class="flex flex-wrap gap-3 pt-2">
                        <button onclick="exportarDadosLGPD()" class="px-4 py-2 rounded-xl bg-cyan-950 text-cyan-300 border border-cyan-800 text-xs font-bold hover:bg-cyan-900 transition flex items-center gap-1.5">
                            <i data-lucide="file-json" class="w-4 h-4"></i> Exportar Meus Dados (JSON)
                        </button>
                        <button onclick="excluirContaLGPD()" class="px-4 py-2 rounded-xl bg-red-950 text-red-300 border border-red-800 text-xs font-bold hover:bg-red-900 transition flex items-center gap-1.5">
                            <i data-lucide="trash-2" class="w-4 h-4"></i> Excluir Minha Conta & Dados
                        </button>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Bottom Navigation (Mobile Only) -->
    <nav class="md:hidden seiva-glass border-t border-seiva-border sticky bottom-0 z-40 px-2 py-2 flex justify-around">
        <button onclick="navigate('dashboard')" class="p-2 text-emerald-400 flex flex-col items-center text-[10px]" data-page="dashboard">
            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
            <span>Início</span>
        </button>
        <button onclick="navigate('transacoes')" class="p-2 text-gray-400 flex flex-col items-center text-[10px]" data-page="transacoes">
            <i data-lucide="arrow-left-right" class="w-5 h-5"></i>
            <span>Extrato</span>
        </button>
        <button onclick="abrirModalNovaTransacao()" class="p-2 -mt-5 rounded-full bg-emerald-600 text-white shadow-lg flex items-center justify-center w-11 h-11">
            <i data-lucide="plus" class="w-6 h-6"></i>
        </button>
        <button onclick="navigate('lar')" class="p-2 text-gray-400 flex flex-col items-center text-[10px]" data-page="lar">
            <i data-lucide="home" class="w-5 h-5"></i>
            <span>Lar</span>
        </button>
        <button onclick="navigate('acordos')" class="p-2 text-gray-400 flex flex-col items-center text-[10px]" data-page="acordos">
            <i data-lucide="handshake" class="w-5 h-5"></i>
            <span>Acordos</span>
        </button>
    </nav>

    <!-- MODAL: LOGIN / CADASTRO -->
    <div id="authModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="seiva-card rounded-3xl p-6 sm:p-8 border border-seiva-border max-w-md w-full relative">
            <button onclick="fecharModal('authModal')" class="absolute top-4 right-4 text-gray-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>

            <div class="text-center mb-6">
                <span class="text-3xl">🌿</span>
                <h3 class="text-xl font-black text-white mt-2" id="authModalTitle">Entrar no SEIVA</h3>
                <p class="text-xs text-gray-400">Sua vida financeira organizada e sem conflitos</p>
            </div>

            <!-- Tab Buttons -->
            <div class="flex rounded-xl bg-black/50 p-1 mb-5 border border-seiva-border">
                <button onclick="toggleAuthTab('login')" id="authTabLogin" class="flex-1 py-1.5 text-xs font-bold rounded-lg bg-emerald-600 text-white">Login</button>
                <button onclick="toggleAuthTab('register')" id="authTabRegister" class="flex-1 py-1.5 text-xs font-bold rounded-lg text-gray-400 hover:text-white">Criar Conta</button>
            </div>

            <!-- Form -->
            <form id="authForm" onsubmit="submitAuth(event)" class="space-y-3.5 text-xs">
                <div id="authFieldNome" class="hidden">
                    <label class="text-gray-300 font-semibold">Nome Completo</label>
                    <input type="text" id="authNome" class="w-full mt-1 px-3 py-2 rounded-xl bg-black/60 border border-seiva-border text-white text-xs">
                </div>

                <div>
                    <label class="text-gray-300 font-semibold">E-mail</label>
                    <input type="email" id="authEmail" required class="w-full mt-1 px-3 py-2 rounded-xl bg-black/60 border border-seiva-border text-white text-xs">
                </div>

                <div>
                    <label class="text-gray-300 font-semibold">Senha</label>
                    <input type="password" id="authSenha" required class="w-full mt-1 px-3 py-2 rounded-xl bg-black/60 border border-seiva-border text-white text-xs">
                </div>

                <div id="authFieldExtra" class="hidden space-y-3 pt-1">
                    <div>
                        <label class="text-gray-300 font-semibold">Renda Mensal Líquida (R$)</label>
                        <input type="number" id="authRenda" placeholder="Ex: 2000" class="w-full mt-1 px-3 py-2 rounded-xl bg-black/60 border border-seiva-border text-white text-xs">
                    </div>
                    <div>
                        <label class="text-gray-300 font-semibold">Banco Principal</label>
                        <input type="text" id="authBanco" placeholder="Ex: Nubank, Inter, Caixa" class="w-full mt-1 px-3 py-2 rounded-xl bg-black/60 border border-seiva-border text-white text-xs">
                    </div>
                    <div>
                        <label class="text-gray-300 font-semibold">PIN da Caixa Preta (4 dígitos)</label>
                        <input type="password" id="authPin" maxlength="6" placeholder="1234" class="w-full mt-1 px-3 py-2 rounded-xl bg-black/60 border border-seiva-border text-white text-xs">
                    </div>
                </div>

                <button type="submit" id="authSubmitBtn" class="w-full mt-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition shadow-lg shadow-emerald-950">
                    Entrar
                </button>
            </form>
        </div>
    </div>

    <!-- MODAL: NOVA TRANSAÇÃO -->
    <div id="modalTransacao" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="seiva-card rounded-3xl p-6 border border-seiva-border max-w-md w-full relative">
            <button onclick="fecharModal('modalTransacao')" class="absolute top-4 right-4 text-gray-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                <i data-lucide="plus" class="w-5 h-5 text-emerald-400"></i> Lançar Nova Transação
            </h3>
            <form onsubmit="salvarNovaTransacao(event)" class="space-y-3 text-xs">
                <div>
                    <label class="text-gray-400 font-semibold">Tipo</label>
                    <div class="flex gap-2 mt-1">
                        <label class="flex-1 text-center py-2 rounded-xl bg-seiva-border cursor-pointer has-[:checked]:bg-rose-900 has-[:checked]:text-rose-200">
                            <input type="radio" name="tipoTransacao" value="saida" checked class="hidden">
                            <span>💸 Saída (Gasto)</span>
                        </label>
                        <label class="flex-1 text-center py-2 rounded-xl bg-seiva-border cursor-pointer has-[:checked]:bg-emerald-900 has-[:checked]:text-emerald-200">
                            <input type="radio" name="tipoTransacao" value="entrada" class="hidden">
                            <span>💰 Entrada (Ganho)</span>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="text-gray-400 font-semibold">Descrição / Título</label>
                    <input type="text" id="transacaoTitulo" required placeholder="Ex: Supermercado, Almoço..." class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs">
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="text-gray-400 font-semibold">Valor (R$)</label>
                        <input type="number" step="0.01" id="transacaoValor" required placeholder="0,00" class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs">
                    </div>
                    <div>
                        <label class="text-gray-400 font-semibold">Conta de Origem</label>
                        <select id="transacaoContaId" class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs"></select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="text-gray-400 font-semibold">Categoria</label>
                        <select id="transacaoCategoriaId" class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs"></select>
                    </div>
                    <div>
                        <label class="text-gray-400 font-semibold">Data</label>
                        <input type="date" id="transacaoData" class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs">
                    </div>
                </div>
                <button type="submit" class="w-full mt-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition">
                    Salvar Transação
                </button>
            </form>
        </div>
    </div>

    <!-- MODAL: NOVA DESPESA DO LAR -->
    <div id="modalDespesaLar" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="seiva-card rounded-3xl p-6 border border-seiva-border max-w-md w-full relative">
            <button onclick="fecharModal('modalDespesaLar')" class="absolute top-4 right-4 text-gray-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                <i data-lucide="home" class="w-5 h-5 text-emerald-400"></i> Lançar Despesa Compartilhada do Lar
            </h3>
            <form onsubmit="salvarDespesaLar(event)" class="space-y-3 text-xs">
                <div>
                    <label class="text-gray-400 font-semibold">Nome da Conta / Despesa</label>
                    <input type="text" id="larDespesaTitulo" required placeholder="Ex: Aluguel, Internet, Mercado do Mês..." class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs">
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="text-gray-400 font-semibold">Valor Total (R$)</label>
                        <input type="number" step="0.01" id="larDespesaValor" required placeholder="0,00" class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs">
                    </div>
                    <div>
                        <label class="text-gray-400 font-semibold">Regra de Divisão</label>
                        <select id="larDespesaDivisao" class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs">
                            <option value="proporcional">Proporcional à Renda</option>
                            <option value="50/50">50% / 50% (Meio a meio)</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="text-gray-400 font-semibold">Tipo de Despesa</label>
                        <select id="larDespesaTipo" class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs">
                            <option value="fixa">Fixa Mensal</option>
                            <option value="variavel">Variável</option>
                            <option value="emergencia">Emergência</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-gray-400 font-semibold">Vencimento</label>
                        <input type="date" id="larDespesaData" class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs">
                    </div>
                </div>
                <button type="submit" class="w-full mt-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition">
                    Calcular Rateio & Salvar
                </button>
            </form>
        </div>
    </div>

    <!-- MODAL: NOVA PROPOSTA MESA DE ACORDOS -->
    <div id="modalProposta" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="seiva-card rounded-3xl p-6 border border-seiva-border max-w-md w-full relative">
            <button onclick="fecharModal('modalProposta')" class="absolute top-4 right-4 text-gray-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                <i data-lucide="handshake" class="w-5 h-5 text-emerald-400"></i> Propor Novo Acordo na Mesa
            </h3>
            <form onsubmit="salvarProposta(event)" class="space-y-3 text-xs">
                <div>
                    <label class="text-gray-400 font-semibold">Título da Proposta</label>
                    <input type="text" id="propostaTitulo" required placeholder="Ex: Assinatura TV, Compra de Sofá..." class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs">
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="text-gray-400 font-semibold">Valor Estimado (R$)</label>
                        <input type="number" step="0.01" id="propostaValor" required placeholder="0,00" class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs">
                    </div>
                    <div>
                        <label class="text-gray-400 font-semibold">Divisão Sugerida</label>
                        <select id="propostaDivisao" class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs">
                            <option value="50/50">50% / 50%</option>
                            <option value="proporcional">Proporcional</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="text-gray-400 font-semibold">Argumento / Justificativa</label>
                    <textarea id="propostaTexto" rows="3" required placeholder="Explique para o seu parceiro(a) por que essa compra/regra é importante..." class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs"></textarea>
                </div>
                <button type="submit" class="w-full mt-3 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition">
                    Enviar para Mesa de Acordo
                </button>
            </form>
        </div>
    </div>

    <!-- MODAL: NOVA META -->
    <div id="modalMeta" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="seiva-card rounded-3xl p-6 border border-seiva-border max-w-md w-full relative">
            <button onclick="fecharModal('modalMeta')" class="absolute top-4 right-4 text-gray-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                <i data-lucide="target" class="w-5 h-5 text-emerald-400"></i> Criar Nova Meta Financeira
            </h3>
            <form onsubmit="salvarNovaMeta(event)" class="space-y-3 text-xs">
                <div>
                    <label class="text-gray-400 font-semibold">Objetivo da Meta</label>
                    <input type="text" id="metaTitulo" required placeholder="Ex: Viagem de Férias, Reserva de Emergência..." class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs">
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="text-gray-400 font-semibold">Valor Alvo (R$)</label>
                        <input type="number" step="0.01" id="metaValorAlvo" required placeholder="0,00" class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs">
                    </div>
                    <div>
                        <label class="text-gray-400 font-semibold">Já guardado (R$)</label>
                        <input type="number" step="0.01" id="metaValorAtual" placeholder="0,00" class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="text-gray-400 font-semibold">Escopo</label>
                        <select id="metaEscopo" class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs">
                            <option value="lar">Meta do Lar (Casal)</option>
                            <option value="individual">Meta Individual</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-gray-400 font-semibold">Onde está guardado</label>
                        <input type="text" id="metaOnde" placeholder="Ex: Cofrinho Nubank" class="w-full mt-1 px-3 py-2 rounded-xl bg-black border border-seiva-border text-white text-xs">
                    </div>
                </div>
                <button type="submit" class="w-full mt-3 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition">
                    Criar Meta
                </button>
            </form>
        </div>
    </div>

    <!-- Script Master Logic -->
    <script>
        // State
        let currentUser = null;
        let currentLar = null;
        let accounts = [];
        let categories = [];
        let activeTab = 'dashboard';
        let categoryChartInstance = null;
        let caixaPretaDesbloqueada = false;

        const formatBRL = (val) => Number(val || 0).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

        document.addEventListener('DOMContentLoaded', async () => {
            lucide.createIcons();
            document.getElementById('transacaoData').value = new Date().toISOString().split('T')[0];
            document.getElementById('larDespesaData').value = new Date().toISOString().split('T')[0];
            await carregarCategorias();
            await checkAuth();
        });

        async function checkAuth() {
            try {
                const res = await fetch('/api/me');
                if (res.ok) {
                    const data = await res.json();
                    currentUser = data.usuario;
                    currentLar = data.lar;
                    atualizarHeaderUsuario();
                    await carregarDashboard();
                } else {
                    mostrarBotaoLogin();
                }
            } catch (e) {
                mostrarBotaoLogin();
            }
        }

        function atualizarHeaderUsuario() {
            const area = document.getElementById('userProfileArea');
            if (currentUser) {
                area.innerHTML = `
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-emerald-700 text-white text-xs font-black flex items-center justify-center border border-emerald-500">
                            ${currentUser.iniciais || 'EU'}
                        </div>
                        <span class="text-xs font-bold text-white hidden sm:block">${currentUser.nome.split(' ')[0]}</span>
                        <button onclick="logout()" title="Sair" class="p-1.5 text-gray-400 hover:text-red-400 transition">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </button>
                    </div>
                `;
                document.getElementById('dashUserGreeting').innerText = `Olá, ${currentUser.nome}!`;
            } else {
                mostrarBotaoLogin();
            }
            lucide.createIcons();
        }

        function mostrarBotaoLogin() {
            const area = document.getElementById('userProfileArea');
            area.innerHTML = `
                <button onclick="abrirAuthModal()" class="px-4 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-xs shadow-md transition">
                    Entrar / Cadastrar
                </button>
            `;
        }

        async function carregarDashboard() {
            try {
                const res = await fetch('/api/dashboard');
                if (!res.ok) return;
                const data = await res.json();

                // Cards de Resumo
                document.getElementById('cardSaldoLivre').innerText = formatBRL(data.resumo.saldo_livre);
                document.getElementById('cardComprometido').innerText = formatBRL(data.resumo.saldo_comprometido);
                document.getElementById('cardEntradas').innerText = formatBRL(data.resumo.total_entradas);
                document.getElementById('cardSaidas').innerText = formatBRL(data.resumo.total_saidas);

                // Contas
                accounts = data.contas || [];
                renderAccountsList(accounts);
                popularSelectContas(accounts);

                // Gráfico
                renderCategoryChart(data.gastos_por_categoria || []);

                // Recentes
                renderRecentTransactions(data.transacoes_recentes || []);

                // Lar
                if (data.lar) {
                    currentLar = data.lar;
                    document.getElementById('sidebarLarNome').innerText = data.lar.nome;
                    document.getElementById('sidebarLarEmoji').innerText = data.lar.emoji || '🌿';
                    document.getElementById('sidebarLarMembros').innerText = `${(data.lar.membros || []).length} moradores`;
                }
            } catch (err) {
                console.error(err);
            }
        }

        function renderAccountsList(accs) {
            const container = document.getElementById('dashboardAccountsList');
            if (!accs.length) {
                container.innerHTML = '<p class="text-xs text-gray-500 py-4 col-span-full">Nenhuma conta cadastrada.</p>';
                return;
            }
            container.innerHTML = accs.map(a => `
                <div class="seiva-card p-3 rounded-xl border border-seiva-border/80 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400">${a.tipo}</span>
                        <p class="font-bold text-white text-xs">${a.nome}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-extrabold text-sm text-emerald-400">${formatBRL(a.saldo)}</p>
                        ${a.tipo === 'cartao' ? `<span class="text-[10px] text-gray-500">Usado: ${formatBRL(a.usado)}</span>` : ''}
                    </div>
                </div>
            `).join('');
        }

        function renderRecentTransactions(txs) {
            const container = document.getElementById('recentTransactionsList');
            if (!txs.length) {
                container.innerHTML = '<p class="text-xs text-gray-500 text-center py-8">Nenhuma transação cadastrada ainda.</p>';
                return;
            }
            container.innerHTML = txs.map(t => `
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-black/40 border border-seiva-border/50 text-xs">
                    <div class="flex items-center gap-2.5">
                        <span class="text-base">${t.emoji || '💸'}</span>
                        <div>
                            <p class="font-bold text-white text-xs">${t.titulo}</p>
                            <span class="text-[10px] text-gray-400">${t.categoria ? t.categoria.nome : 'Geral'} · ${t.data}</span>
                        </div>
                    </div>
                    <span class="font-extrabold ${t.tipo === 'entrada' ? 'text-teal-400' : 'text-rose-400'}">
                        ${t.tipo === 'entrada' ? '+' : '-'} ${formatBRL(t.valor)}
                    </span>
                </div>
            `).join('');
        }

        function renderCategoryChart(data) {
            const ctx = document.getElementById('categoryChart');
            if (!ctx) return;

            if (categoryChartInstance) {
                categoryChartInstance.destroy();
            }

            if (!data.length) {
                data = [{ nome: 'Sem Gastos', total: 1, cor: '#1e382b' }];
            }

            categoryChartInstance = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.map(d => d.nome),
                    datasets: [{
                        data: data.map(d => d.total),
                        backgroundColor: data.map(d => d.cor || '#10b981'),
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { color: '#94a3b8', font: { size: 10 } } }
                    },
                    cutout: '70%',
                }
            });
        }

        // Navigation
        function navigate(pageId) {
            activeTab = pageId;
            document.querySelectorAll('.page-view').forEach(p => p.classList.add('hidden'));
            const target = document.getElementById(`view-${pageId}`);
            if (target) target.classList.remove('hidden');

            document.querySelectorAll('.nav-item').forEach(btn => {
                if (btn.getAttribute('data-page') === pageId) {
                    btn.className = "nav-item flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl font-medium text-sm transition text-emerald-400 bg-emerald-950/60 border border-emerald-800/40";
                } else {
                    btn.className = "nav-item flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl font-medium text-sm transition text-gray-400 hover:text-white hover:bg-seiva-border/50";
                }
            });

            if (pageId === 'transacoes') carregarTransacoes();
            if (pageId === 'lar') carregarLar();
            if (pageId === 'acordos') carregarAcordos();
            if (pageId === 'metas') carregarMetas();
            if (pageId === 'cobrador') carregarCobrador();
            if (pageId === 'perfil') carregarPerfil();
        }

        // Transações
        async function carregarTransacoes(tipo = '') {
            try {
                const res = await fetch(`/api/transacoes${tipo ? '?tipo=' + tipo : ''}`);
                if (!res.ok) return;
                const txs = await res.json();
                document.getElementById('transacoesCount').innerText = `${txs.length} lançamentos`;

                const container = document.getElementById('fullTransactionsList');
                if (!txs.length) {
                    container.innerHTML = '<p class="text-xs text-gray-500 text-center py-10">Nenhuma transação encontrada.</p>';
                    return;
                }
                container.innerHTML = txs.map(t => `
                    <div class="p-3.5 flex items-center justify-between hover:bg-black/30 transition text-xs">
                        <div class="flex items-center gap-3">
                            <span class="text-xl">${t.emoji || '🧾'}</span>
                            <div>
                                <p class="font-bold text-white text-xs">${t.titulo}</p>
                                <p class="text-[11px] text-gray-400">${t.conta ? t.conta.nome : ''} · ${t.data} ${t.categoria ? '· ' + t.categoria.nome : ''}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="font-black text-sm ${t.tipo === 'entrada' ? 'text-teal-400' : 'text-rose-400'}">
                                ${t.tipo === 'entrada' ? '+' : '-'} ${formatBRL(t.valor)}
                            </span>
                            <button onclick="excluirTransacao(${t.id_transacao})" class="text-gray-500 hover:text-red-400 transition">
                                <i data-lucide="trash" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                `).join('');
                lucide.createIcons();
            } catch (e) { console.error(e); }
        }

        async function excluirTransacao(id) {
            if (!confirm('Deseja excluir esta transação e reverter o saldo?')) return;
            await fetch(`/api/transacoes/${id}`, { method: 'DELETE' });
            await carregarTransacoes();
            await carregarDashboard();
        }

        // Lar
        async function carregarLar() {
            try {
                const res = await fetch('/api/lar');
                if (!res.ok) return;
                const data = await res.json();

                if (!data.lar) {
                    document.getElementById('larMembersList').innerHTML = '<p class="text-xs text-gray-500 py-4 col-span-full">Nenhum lar configurado ainda. Clique em "Criar/Alterar Lar" para começar!</p>';
                    return;
                }

                document.getElementById('larHeaderTitle').innerText = data.lar.nome;
                document.getElementById('larHeaderEmoji').innerText = data.lar.emoji || '🌿';

                // Membros e Proporção
                const membersContainer = document.getElementById('larMembersList');
                membersContainer.innerHTML = (data.membros || []).map(m => `
                    <div class="seiva-card p-4 rounded-xl border border-seiva-border/80 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-800 text-white font-black flex items-center justify-center text-sm">
                                ${m.iniciais}
                            </div>
                            <div>
                                <p class="font-bold text-white text-xs">${m.nome} <span class="text-[10px] text-emerald-400">(${m.papel})</span></p>
                                <p class="text-[11px] text-gray-400">Renda: ${formatBRL(m.renda_declarada)}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-xs font-black text-emerald-400">${m.percentual_calculado}%</span>
                            <p class="text-[10px] text-gray-500">Rateio Proporcional</p>
                        </div>
                    </div>
                `).join('');

                // Despesas do lar
                const despRes = await fetch('/api/lar/despesas');
                if (despRes.ok) {
                    const despesas = await despRes.json();
                    const expContainer = document.getElementById('larExpensesList');
                    if (!despesas.length) {
                        expContainer.innerHTML = '<p class="text-xs text-gray-500 text-center py-8">Nenhuma despesa compartilhada registrada ainda.</p>';
                        return;
                    }

                    expContainer.innerHTML = despesas.map(d => `
                        <div class="p-4 rounded-xl bg-black/40 border border-seiva-border/70 text-xs space-y-2">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="text-lg">${d.emoji || '🧾'}</span>
                                    <div>
                                        <p class="font-bold text-white text-xs">${d.titulo}</p>
                                        <span class="text-[10px] text-gray-400">Regra: ${d.divisao} · Vencimento: ${d.data_vencimento || 'N/A'}</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="font-black text-sm text-emerald-300">${formatBRL(d.valor_total)}</span>
                                    <p class="text-[10px] ${d.status === 'pago' ? 'text-teal-400 font-bold' : 'text-amber-400'}">${d.status.toUpperCase()}</p>
                                </div>
                            </div>

                            <!-- Participações -->
                            <div class="pt-2 border-t border-seiva-border/40 flex flex-wrap gap-2 justify-between items-center text-[11px]">
                                ${(d.participacoes || []).map(p => `
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-400">${p.usuario ? p.usuario.nome.split(' ')[0] : 'Membro'}:</span>
                                        <span class="font-bold text-white">${formatBRL(p.valor_parte)}</span>
                                        <span class="px-1.5 py-0.5 rounded text-[10px] font-bold ${p.pago ? 'bg-emerald-950 text-emerald-400' : 'bg-amber-950 text-amber-400'}">
                                            ${p.pago ? 'QUITADO' : 'PENDENTE'}
                                        </span>
                                        ${!p.pago ? `<button onclick="quitarParte(${p.id_participacao})" class="px-2 py-0.5 rounded bg-emerald-700 hover:bg-emerald-600 text-white font-bold text-[10px]">Quitar</button>` : ''}
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `).join('');
                }
            } catch (e) { console.error(e); }
        }

        async function quitarParte(partId) {
            const res = await fetch(`/api/lar/despesas/quitar/${partId}`, { method: 'POST' });
            if (res.ok) {
                alert('Parte quitada com sucesso!');
                await carregarLar();
            }
        }

        // Acordos
        async function carregarAcordos() {
            try {
                const res = await fetch('/api/acordos');
                if (!res.ok) return;
                const data = await res.json();

                // Propostas
                const propContainer = document.getElementById('propostasList');
                if (!data.propostas.length) {
                    propContainer.innerHTML = '<p class="text-xs text-gray-500 text-center py-6">Nenhuma proposta em negociação no momento.</p>';
                } else {
                    propContainer.innerHTML = data.propostas.map(p => `
                        <div class="p-4 rounded-xl bg-black/40 border border-amber-900/60 text-xs space-y-2">
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-white text-xs">${p.titulo}</p>
                                <span class="font-black text-amber-400">${formatBRL(p.valor)}</span>
                            </div>
                            <p class="text-gray-300 italic">"${p.proposta_texto}"</p>
                            <p class="text-[10px] text-gray-400">Proposto por: ${p.autor ? p.autor.nome : 'Membro'} · Divisão sugerida: ${p.divisao_sugerida}</p>
                            ${p.status === 'em_analise' ? `
                                <div class="flex gap-2 pt-1">
                                    <button onclick="votarProposta(${p.id_proposta}, 'aceitar')" class="px-3 py-1 rounded-lg bg-emerald-700 hover:bg-emerald-600 text-white font-bold text-xs">
                                        ✓ Apoiar Proposta
                                    </button>
                                    <button onclick="votarProposta(${p.id_proposta}, 'recusar')" class="px-3 py-1 rounded-lg bg-red-950 text-red-300 border border-red-800 text-xs">
                                        Recusar
                                    </button>
                                </div>
                            ` : `<span class="text-[10px] font-bold text-emerald-400">STATUS: ${p.status.toUpperCase()}</span>`}
                        </div>
                    `).join('');
                }

                // Acordos Selados
                const acordosContainer = document.getElementById('acordosSeladosList');
                if (!data.acordos.length) {
                    acordosContainer.innerHTML = '<p class="text-xs text-gray-500 text-center py-6 col-span-full">Nenhum acordo ativo ainda.</p>';
                } else {
                    acordosContainer.innerHTML = data.acordos.map(a => `
                        <div class="seiva-card p-4 rounded-xl border border-seiva-border text-xs space-y-2">
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-white text-xs">${a.titulo}</p>
                                <span class="font-black text-emerald-400">${formatBRL(a.valor_total)}</span>
                            </div>
                            <div class="w-full bg-black/60 rounded-full h-2 overflow-hidden border border-seiva-border">
                                <div class="bg-emerald-500 h-2 rounded-full" style="width: ${Math.min(100, (a.valor_arrecadado / a.valor_total) * 100)}%"></div>
                            </div>
                            <div class="flex justify-between text-[10px] text-gray-400">
                                <span>Arrecadado: ${formatBRL(a.valor_arrecadado)}</span>
                                <span>Divisão: ${a.divisao}</span>
                            </div>
                        </div>
                    `).join('');
                }
            } catch (e) { console.error(e); }
        }

        async function votarProposta(id, acao) {
            const res = await fetch(`/api/acordos/propostas/votar/${id}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ acao })
            });
            if (res.ok) {
                alert('Voto computado com sucesso!');
                await carregarAcordos();
            }
        }

        // Metas
        async function carregarMetas() {
            try {
                const res = await fetch('/api/metas');
                if (!res.ok) return;
                const data = await res.json();

                renderMetasContainer('metasLarList', data.lar || []);
                renderMetasContainer('metasIndividuaisList', data.individuais || []);
            } catch (e) { console.error(e); }
        }

        function renderMetasContainer(elementId, metas) {
            const container = document.getElementById(elementId);
            if (!metas.length) {
                container.innerHTML = '<p class="text-xs text-gray-500 py-6 col-span-full">Nenhuma meta cadastrada.</p>';
                return;
            }
            container.innerHTML = metas.map(m => {
                const pct = Math.min(100, Math.round((m.valor_atual / m.valor_alvo) * 100));
                return `
                    <div class="seiva-card p-4 rounded-xl border border-seiva-border text-xs space-y-2.5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-xl">${m.emoji || '🎯'}</span>
                                <div>
                                    <p class="font-bold text-white text-xs">${m.titulo}</p>
                                    <span class="text-[10px] text-gray-400">${m.onde_guardado || 'Cofrinho'}</span>
                                </div>
                            </div>
                            <span class="font-bold text-emerald-400">${pct}%</span>
                        </div>
                        <div class="w-full bg-black/60 rounded-full h-2.5 overflow-hidden border border-seiva-border">
                            <div class="bg-gradient-to-r from-emerald-600 to-teal-400 h-2.5 rounded-full" style="width: ${pct}%"></div>
                        </div>
                        <div class="flex items-center justify-between text-[11px] pt-1">
                            <span class="text-gray-400">${formatBRL(m.valor_atual)} de ${formatBRL(m.valor_alvo)}</span>
                            <button onclick="contribuirMeta(${m.id_meta})" class="px-2.5 py-1 rounded-lg bg-emerald-700 hover:bg-emerald-600 text-white font-bold text-[10px]">
                                + Depositar
                            </button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        async function contribuirMeta(metaId) {
            const valor = prompt('Digite o valor da contribuição (R$):');
            if (!valor || isNaN(valor)) return;
            const res = await fetch(`/api/metas/${metaId}/contribuir`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ valor: parseFloat(valor) })
            });
            if (res.ok) {
                alert('Contribuição realizada com sucesso!');
                await carregarMetas();
            }
        }

        // Caixa Preta
        async function desbloquearCaixaPreta() {
            const pin = document.getElementById('caixaPinInput').value;
            if (!pin) return alert('Digite o PIN de 4 dígitos.');

            const res = await fetch('/api/caixa-preta/verificar-pin', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ pin })
            });

            const data = await res.json();
            if (data.unlocked) {
                caixaPretaDesbloqueada = true;
                document.getElementById('caixaPretaLockScreen').classList.add('hidden');
                document.getElementById('caixaPretaContent').classList.remove('hidden');
                await carregarRegistrosCaixaPreta();
            } else {
                alert(data.error || 'PIN incorreto.');
            }
        }

        function bloquearCaixaPreta() {
            caixaPretaDesbloqueada = false;
            document.getElementById('caixaPinInput').value = '';
            document.getElementById('caixaPretaLockScreen').classList.remove('hidden');
            document.getElementById('caixaPretaContent').classList.add('hidden');
        }

        async function carregarRegistrosCaixaPreta() {
            try {
                const res = await fetch('/api/caixa-preta/registros');
                if (!res.ok) return;
                const data = await res.json();

                document.getElementById('caixaPretaTotal').innerText = formatBRL(data.total_oculto);

                const container = document.getElementById('caixaPretaList');
                if (!data.registros.length) {
                    container.innerHTML = '<p class="text-xs text-gray-500 text-center py-6">Nenhum registro confidencial salvo.</p>';
                    return;
                }

                container.innerHTML = data.registros.map(r => `
                    <div class="p-3.5 rounded-xl bg-black/60 border border-amber-900/60 flex items-center justify-between text-xs">
                        <div class="flex items-center gap-3">
                            <i data-lucide="shield-check" class="w-4 h-4 text-amber-400"></i>
                            <div>
                                <p class="font-bold text-white">${r.titulo_cifrado}</p>
                                <span class="text-[10px] text-gray-400">${r.conta_cifrada} · ${r.data}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="font-black text-amber-400">${formatBRL(r.valor_cifrado)}</span>
                            <button onclick="excluirRegistroCaixaPreta(${r.id_registro_caixa_preta})" class="text-gray-500 hover:text-red-400">
                                <i data-lucide="trash" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                `).join('');
                lucide.createIcons();
            } catch (e) { console.error(e); }
        }

        async function abrirModalNovoRegistroCaixaPreta() {
            const titulo = prompt('Título do gasto/reserva confidencial:');
            if (!titulo) return;
            const valor = prompt('Valor (R$):');
            if (!valor || isNaN(valor)) return;

            await fetch('/api/caixa-preta/registros', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ titulo, valor: parseFloat(valor) })
            });

            await carregarRegistrosCaixaPreta();
        }

        async function excluirRegistroCaixaPreta(id) {
            if (!confirm('Deseja excluir este registro confidencial?')) return;
            await fetch(`/api/caixa-preta/registros/${id}`, { method: 'DELETE' });
            await carregarRegistrosCaixaPreta();
        }

        // Cobrador Diplomata
        async function carregarCobrador() {
            try {
                const res = await fetch('/api/cobrancas');
                if (!res.ok) return;
                const data = await res.json();

                const container = document.getElementById('cobradorPendenciasList');
                if (!data.pendencias.length) {
                    container.innerHTML = '<p class="text-xs text-gray-500 text-center py-6">Tudo em dia! Nenhuma pendência para cobrar.</p>';
                    return;
                }

                container.innerHTML = data.pendencias.map(p => `
                    <div class="p-4 rounded-xl bg-black/40 border border-teal-900/60 text-xs space-y-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-bold text-white text-xs">${p.despesa ? p.despesa.titulo : 'Despesa'}</p>
                                <span class="text-[10px] text-gray-400">Devedor: ${p.usuario ? p.usuario.nome : 'Membro'}</span>
                            </div>
                            <span class="font-black text-rose-400 text-sm">${formatBRL(p.valor_parte)}</span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            ${(data.templates || []).map(t => `
                                <button onclick="enviarLembreteDiplomatico(${p.usuario_id}, '${p.despesa.titulo}', ${p.valor_parte}, '${t.texto}')" class="px-2.5 py-1 rounded-lg bg-teal-950 text-teal-300 border border-teal-800 text-[10px] font-semibold hover:bg-teal-900 transition">
                                    Enviar: ${t.nome}
                                </button>
                            `).join('')}
                        </div>
                    </div>
                `).join('');
            } catch (e) { console.error(e); }
        }

        async function enviarLembreteDiplomatico(destId, titulo, valor, template) {
            const pix = currentUser ? (currentUser.chave_pix || currentUser.email) : 'PIX';
            const mensagem = template.replace('{titulo}', titulo).replace('{valor}', valor).replace('{pix}', pix);

            const res = await fetch('/api/cobrancas/lembrete', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ destinatario_id: destId, titulo, valor, mensagem })
            });

            if (res.ok) {
                alert(`🕊️ Notificação diplomática disparada com sucesso!\n\nMensagem: "${mensagem}"`);
            }
        }

        // Perfil & LGPD
        async function carregarPerfil() {
            if (!currentUser) return;
            document.getElementById('perfilNome').value = currentUser.nome || '';
            document.getElementById('perfilEmail').value = currentUser.email || '';
            document.getElementById('perfilRenda').value = currentUser.renda_mensal || 0;
            document.getElementById('perfilRendaExtra').value = currentUser.renda_extra || 0;
            document.getElementById('perfilPix').value = currentUser.chave_pix || '';
            document.getElementById('perfilPin').value = currentUser.pin_caixa_preta || '1234';
        }

        async function salvarPerfil() {
            const nome = document.getElementById('perfilNome').value;
            const renda_mensal = document.getElementById('perfilRenda').value;
            const renda_extra = document.getElementById('perfilRendaExtra').value;
            const chave_pix = document.getElementById('perfilPix').value;
            const pin_caixa_preta = document.getElementById('perfilPin').value;

            const res = await fetch('/api/perfil', {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ nome, renda_mensal, renda_extra, chave_pix, pin_caixa_preta })
            });

            if (res.ok) {
                const data = await res.json();
                currentUser = data.usuario;
                alert('Perfil atualizado com sucesso!');
                atualizarHeaderUsuario();
            }
        }

        function exportarDadosLGPD() {
            window.location.href = '/api/perfil/exportar';
        }

        async function excluirContaLGPD() {
            if (!confirm('ATENÇÃO (LGPD): Deseja excluir definitivamente sua conta e anonimizar todos os seus dados? Esta ação é irreversível.')) return;
            const res = await fetch('/api/perfil/excluir', { method: 'DELETE' });
            if (res.ok) {
                alert('Conta excluída com sucesso.');
                location.reload();
            }
        }

        // Categories & Helpers
        async function carregarCategorias() {
            try {
                const res = await fetch('/api/categorias');
                if (res.ok) {
                    categories = await res.json();
                    const sel = document.getElementById('transacaoCategoriaId');
                    sel.innerHTML = categories.map(c => `<option value="${c.id_categoria}">${c.emoji || '📁'} ${c.nome}</option>`).join('');
                }
            } catch (e) {}
        }

        function popularSelectContas(accs) {
            const sel = document.getElementById('transacaoContaId');
            if (!accs.length) {
                sel.innerHTML = '<option value="">Crie uma conta primeiro</option>';
                return;
            }
            sel.innerHTML = accs.map(a => `<option value="${a.id_conta}">${a.nome} (${formatBRL(a.saldo)})</option>`).join('');
        }

        // Testes da Banca
        async function carregarCenarioDemo() {
            if (!confirm('Carregar cenário oficial de teste da apresentação (Duda & Ian, Lar "Nosso Cantinho", despesas e acordos)?')) return;
            const res = await fetch('/api/demo/popular', { method: 'POST' });
            if (res.ok) {
                alert('Cenário de teste carregado com sucesso!');
                location.reload();
            }
        }

        async function limparBancoTeste() {
            if (!confirm('Deseja limpar todo o banco de dados para testar cadastro de usuário do zero?')) return;
            const res = await fetch('/api/demo/limpar', { method: 'POST' });
            if (res.ok) {
                alert('Banco limpo com sucesso! Ninguém cadastrado.');
                location.reload();
            }
        }

        // Modais & Tabs
        function toggleDropdown(id) {
            document.getElementById(id).classList.toggle('hidden');
        }

        function abrirAuthModal() {
            document.getElementById('authModal').classList.remove('hidden');
        }

        function fecharModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function toggleAuthTab(tab) {
            if (tab === 'login') {
                document.getElementById('authTabLogin').className = "flex-1 py-1.5 text-xs font-bold rounded-lg bg-emerald-600 text-white";
                document.getElementById('authTabRegister').className = "flex-1 py-1.5 text-xs font-bold rounded-lg text-gray-400 hover:text-white";
                document.getElementById('authFieldNome').classList.add('hidden');
                document.getElementById('authFieldExtra').classList.add('hidden');
                document.getElementById('authSubmitBtn').innerText = 'Entrar';
                document.getElementById('authModalTitle').innerText = 'Entrar no SEIVA';
            } else {
                document.getElementById('authTabRegister').className = "flex-1 py-1.5 text-xs font-bold rounded-lg bg-emerald-600 text-white";
                document.getElementById('authTabLogin').className = "flex-1 py-1.5 text-xs font-bold rounded-lg text-gray-400 hover:text-white";
                document.getElementById('authFieldNome').classList.remove('hidden');
                document.getElementById('authFieldExtra').classList.remove('hidden');
                document.getElementById('authSubmitBtn').innerText = 'Criar Minha Conta';
                document.getElementById('authModalTitle').innerText = 'Cadastro no SEIVA';
            }
        }

        async function submitAuth(e) {
            e.preventDefault();
            const isRegister = !document.getElementById('authFieldNome').classList.contains('hidden');
            const url = isRegister ? '/api/register' : '/api/login';

            const payload = {
                email: document.getElementById('authEmail').value,
                senha: document.getElementById('authSenha').value,
            };

            if (isRegister) {
                payload.nome = document.getElementById('authNome').value;
                payload.renda_mensal = parseFloat(document.getElementById('authRenda').value) || 0;
                payload.banco_principal = document.getElementById('authBanco').value || 'Banco Principal';
                payload.pin_caixa_preta = document.getElementById('authPin').value || '1234';
            }

            const res = await fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            const data = await res.json();
            if (res.ok) {
                fecharModal('authModal');
                alert(data.message || 'Sucesso!');
                location.reload();
            } else {
                alert(data.error || 'Erro na autenticação.');
            }
        }

        async function logout() {
            await fetch('/api/logout', { method: 'POST' });
            location.reload();
        }

        function abrirModalNovaTransacao() {
            if (!currentUser) return abrirAuthModal();
            document.getElementById('modalTransacao').classList.remove('hidden');
        }

        async function salvarNovaTransacao(e) {
            e.preventDefault();
            const tipo = document.querySelector('input[name="tipoTransacao"]:checked').value;
            const titulo = document.getElementById('transacaoTitulo').value;
            const valor = parseFloat(document.getElementById('transacaoValor').value);
            const conta_id = document.getElementById('transacaoContaId').value;
            const categoria_id = document.getElementById('transacaoCategoriaId').value;
            const data = document.getElementById('transacaoData').value;

            const res = await fetch('/api/transacoes', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ tipo, titulo, valor, conta_id, categoria_id, data })
            });

            if (res.ok) {
                fecharModal('modalTransacao');
                await carregarDashboard();
                if (activeTab === 'transacoes') await carregarTransacoes();
            } else {
                alert('Erro ao salvar transação.');
            }
        }

        function abrirModalNovaDespesaLar() {
            if (!currentUser) return abrirAuthModal();
            document.getElementById('modalDespesaLar').classList.remove('hidden');
        }

        async function salvarDespesaLar(e) {
            e.preventDefault();
            const titulo = document.getElementById('larDespesaTitulo').value;
            const valor_total = parseFloat(document.getElementById('larDespesaValor').value);
            const divisao = document.getElementById('larDespesaDivisao').value;
            const tipo = document.getElementById('larDespesaTipo').value;
            const data_vencimento = document.getElementById('larDespesaData').value;

            const res = await fetch('/api/lar/despesas', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ titulo, valor_total, divisao, tipo, data_vencimento })
            });

            if (res.ok) {
                fecharModal('modalDespesaLar');
                alert('Despesa compartilhada calculada e salva!');
                await carregarLar();
            } else {
                const err = await res.json();
                alert(err.error || 'Erro ao salvar despesa do lar.');
            }
        }

        function abrirModalNovaProposta() {
            if (!currentUser) return abrirAuthModal();
            document.getElementById('modalProposta').classList.remove('hidden');
        }

        async function salvarProposta(e) {
            e.preventDefault();
            const titulo = document.getElementById('propostaTitulo').value;
            const valor = parseFloat(document.getElementById('propostaValor').value);
            const divisao_sugerida = document.getElementById('propostaDivisao').value;
            const proposta_texto = document.getElementById('propostaTexto').value;

            const res = await fetch('/api/acordos/propostas', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ titulo, valor, divisao_sugerida, proposta_texto })
            });

            if (res.ok) {
                fecharModal('modalProposta');
                alert('Proposta enviada para a Mesa de Acordos!');
                await carregarAcordos();
            }
        }

        function abrirModalNovaMeta() {
            if (!currentUser) return abrirAuthModal();
            document.getElementById('modalMeta').classList.remove('hidden');
        }

        async function salvarNovaMeta(e) {
            e.preventDefault();
            const titulo = document.getElementById('metaTitulo').value;
            const valor_alvo = parseFloat(document.getElementById('metaValorAlvo').value);
            const valor_atual = parseFloat(document.getElementById('metaValorAtual').value) || 0;
            const tipo_escopo = document.getElementById('metaEscopo').value;
            const onde_guardado = document.getElementById('metaOnde').value;

            const res = await fetch('/api/metas', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ titulo, valor_alvo, valor_atual, tipo_escopo, onde_guardado })
            });

            if (res.ok) {
                fecharModal('modalMeta');
                alert('Meta criada com sucesso!');
                await carregarMetas();
            }
        }

        async function abrirModalCriarLar() {
            const nome = prompt('Digite o nome para o seu lar (ex: Nosso Cantinho, Apto 402):');
            if (!nome) return;
            const res = await fetch('/api/lar', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ nome, emoji: '🌿' })
            });
            if (res.ok) {
                alert('Lar criado com sucesso!');
                location.reload();
            }
        }

        async function abrirModalConviteLar() {
            const email = prompt('Digite o e-mail do seu parceiro(a) ou deixe em branco para gerar código:');
            const res = await fetch('/api/lar/convite', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email })
            });
            if (res.ok) {
                const data = await res.json();
                prompt('Envie este CÓDIGO de convite para seu parceiro(a):', data.token_convite);
            }
        }

        async function abrirModalNovaConta() {
            const nome = prompt('Nome da Conta/Banco (ex: Inter, NuBank, Caixa):');
            if (!nome) return;
            const saldo = prompt('Saldo inicial (R$):') || '0';
            const res = await fetch('/api/contas', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ nome, tipo: 'corrente', saldo: parseFloat(saldo) })
            });
            if (res.ok) {
                await carregarDashboard();
            }
        }

        function abrirNotificacoes() {
            alert('🌿 Notificações do Lar:\n- Cobrador Diplomata ativo\n- Transações em sincronia');
        }
    </script>
</body>
</html>
