{{-- 
    Módulo: Dashboard Oficial SEIVA (Fidelidade Absoluta ao Protótipo)
    Responsável Acadêmico: Victor Hugo / Equipe SEIVA
    Bordão Oficial: "Onde seu dinheiro cria raízes 🌱"
    Telas Implementadas:
      1. Header do Usuário com Data Contextual & Badge "Você registra, o SEIVA organiza"
      2. Banner Interativo "Pedido de ajuda" (Duda & Ian)
      3. Seção "Seu mês de junho" com Toggle Hero [ Minha renda (Dark Card) | Custo do Lar (Deep Green) ]
      4. 4 Ações Rápidas (Registrar gasto, Registrar entrada, Ver extrato, Relatórios)
      5. "Onde está meu dinheiro" com Somando todas as contas, Já tem dono vs Livre pra gastar & Grid de contas
      6. "Sua saúde financeira em junho" com Gauge circular 58% e Insights inteligentes
      7. "Pra registrar hoje" com botões diretos de registro de faturas/parcelas
      8. "Minhas metas" com barras de progresso (Notebook Dell 90%, Geladeira Samsung 31%)
      9. 4 Indicadores Rápidos (Entradas, Saídas, Livre pra gastar, Poupança Caixa)
      10. "Fluxo dos 2 meses no SEIVA" (Gráfico de barras Maio vs Junho)
      11. "Despesas fixas do mês" (Cards com badges de status de pagamento)
      12. "Atividade recente" com extrato das últimas transações
--}}

<div id="pane-dashboard" class="sub-screen space-y-6 max-w-6xl mx-auto pb-12">

    <!-- BARRA DISCRETA DE ALTERNÂNCIA RÁPIDA DE PERFIS (DUDA, IAN, VICTOR HUGO) -->
    <div class="flex flex-wrap items-center justify-between gap-2.5 rounded-2xl border border-emerald-500/20 bg-emerald-50/70 dark:bg-emerald-950/30 px-3.5 py-2 text-xs">
        <div class="flex items-center gap-2 text-emerald-800 dark:text-emerald-300 font-medium">
            <span class="size-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>Perfil Ativo:</span>
            <strong id="dashBadgePerfilAtivo" class="font-bold underline decoration-emerald-500/40">Carregando...</strong>
        </div>
        <div class="flex flex-wrap items-center gap-1.5">
            <span class="text-muted-foreground text-[11px] mr-1 hidden sm:inline">Testar persona:</span>
            <button type="button" onclick="trocarUsuarioRapido('duda@seiva.com')" 
                    class="btn-perfil-switch px-2.5 py-1 rounded-lg border border-border bg-card hover:bg-emerald-100 dark:hover:bg-emerald-900/40 font-semibold text-[11px] text-foreground transition shadow-2xs">
                👩 Duda (Casal · 40%)
            </button>
            <button type="button" onclick="trocarUsuarioRapido('ian@seiva.com')" 
                    class="btn-perfil-switch px-2.5 py-1 rounded-lg border border-border bg-card hover:bg-emerald-100 dark:hover:bg-emerald-900/40 font-semibold text-[11px] text-foreground transition shadow-2xs">
                👨 Ian (Casal · 60%)
            </button>
            <button type="button" onclick="trocarUsuarioRapido('victor@seiva.com')" 
                    class="btn-perfil-switch px-2.5 py-1 rounded-lg border border-border bg-card hover:bg-emerald-100 dark:hover:bg-emerald-900/40 font-semibold text-[11px] text-foreground transition shadow-2xs">
                👤 Victor Hugo (Individual)
            </button>
        </div>
    </div>

    <!-- 1. CABEÇALHO DO DASHBOARD (IMAGE 2) -->
    <header class="flex flex-wrap items-center justify-between gap-4 pt-1">
        <div class="flex items-center gap-3.5">
            <div id="dashAvatarBox" class="size-12 rounded-full bg-[#fde2e4] text-[#b02a37] font-extrabold flex items-center justify-center text-sm shadow-soft shrink-0 border border-[#f8b4b9]">
                <span id="dashAvatar">ME</span>
            </div>
            <div>
                <h1 id="dashGreeting" class="text-lg sm:text-xl font-bold tracking-tight text-foreground">
                    Boa tarde, Duda
                </h1>
                <p id="dashDateSub" class="text-xs text-muted-foreground font-medium mt-0.5">
                    Quinta, 12 de junho de 2026
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2.5">
            <!-- Badge "Você registra, o SEIVA organiza" -->
            <div class="hidden sm:inline-flex items-center gap-1.5 rounded-full bg-emerald-50/90 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300 border border-emerald-200/80 dark:border-emerald-800/40 px-3.5 py-1.5 text-xs font-semibold shadow-2xs">
                <i data-lucide="info" class="size-3.5 text-emerald-600"></i>
                <span>Você registra, o SEIVA organiza</span>
            </div>

            <!-- Botão de Notificações com Badge -->
            <button onclick="abrirModalNotificacoes()" aria-label="Notificações" class="relative size-10 rounded-full border border-border bg-card text-muted-foreground hover:text-foreground flex items-center justify-center transition shadow-2xs">
                <i data-lucide="bell" class="size-4"></i>
                <span id="dashBadgeNotifCount" class="absolute -top-1 -right-1 size-4 rounded-full bg-rose-600 text-white font-bold text-[10px] flex items-center justify-center">
                    2
                </span>
            </button>
        </div>
    </header>

    <!-- 2. BANNER DE PEDIDO DE AJUDA (IMAGE 2 & 3) -->
    <div id="bannerPedidoAjuda" class="rounded-3xl border border-emerald-500/30 bg-[#eef7f0] dark:bg-emerald-950/20 p-5 shadow-soft transition-all">
        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
            <div class="flex items-start gap-3.5">
                <div class="size-11 rounded-2xl bg-[#1b4d37] text-white flex items-center justify-center shrink-0 shadow-2xs">
                    <i data-lucide="printer" class="size-5"></i>
                </div>
                <div class="space-y-1">
                    <div class="flex items-center gap-1.5 text-emerald-800 dark:text-emerald-300 text-xs font-bold uppercase tracking-wider">
                        <i data-lucide="sprout" class="size-3.5 text-emerald-600"></i>
                        <span>Pedido de ajuda</span>
                    </div>
                    <h3 id="pedidoAjudaTitulo" class="text-sm sm:text-base font-extrabold text-foreground">
                        Ian pediu uma ajuda de <span class="text-emerald-800 dark:text-emerald-400 font-black">R$ 50,00</span>
                    </h3>
                    <p id="pedidoAjudaDesc" class="text-xs text-muted-foreground">
                        Comprar filamento pra fechar o freela da impressora 3D
                    </p>
                    <div class="pt-1">
                        <span id="pedidoAjudaTag" class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 dark:bg-emerald-900/60 text-emerald-900 dark:text-emerald-200 text-[11px] font-semibold px-2.5 py-0.5 border border-emerald-200/50">
                            <span class="font-bold">IM</span> Filamento da Impressora 3D · há 20 min
                        </span>
                    </div>
                </div>
            </div>

            <!-- Botões de Ação do Pedido -->
            <div class="flex items-center gap-2.5 self-end sm:self-center shrink-0">
                <button type="button" onclick="recusarPedidoAjuda()" class="px-4 py-2 rounded-xl border border-border bg-card hover:bg-muted font-bold text-xs text-foreground transition shadow-2xs">
                    ✕ Agora não
                </button>
                <button type="button" onclick="aceitarPedidoAjuda()" class="px-5 py-2 rounded-xl bg-[#1b4d37] hover:bg-[#153f2c] text-white font-bold text-xs transition shadow-soft flex items-center gap-1.5">
                    <i data-lucide="check" class="size-4"></i> Ajudar
                </button>
            </div>
        </div>
    </div>

    <!-- 3. SEÇÃO HERO: "SEU MÊS DE JUNHO" COM TOGGLE [ MINHA RENDA | CUSTO DO LAR ] (IMAGE 2 & 3) -->
    <section class="space-y-3.5">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <div>
                <h2 id="heroTituloSecao" class="text-sm font-bold text-foreground">Seu mês de junho</h2>
                <p class="text-xs text-muted-foreground">Valores com referência a junho — mesmo que vençam em outro mês</p>
            </div>
            <button type="button" onclick="alternarVisibilidadeSaldos()" id="btnVisSaldos" class="flex items-center gap-1.5 text-xs font-semibold text-muted-foreground hover:text-foreground transition">
                <i data-lucide="eye" class="size-3.5"></i>
                <span id="btnVisSaldosLabel">Ocultar</span>
            </button>
        </div>

        <!-- Seletor em Pílulas: [ Minha renda ] vs [ Custo do Lar ] -->
        <div class="flex items-center rounded-2xl bg-muted/60 p-1 border border-border max-w-md">
            <button type="button" id="tabHeroMinhaRenda" onclick="alternarAbaHero('renda')" 
                    class="flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all bg-card text-foreground shadow-2xs">
                <i data-lucide="trending-up" class="size-3.5 text-emerald-600"></i>
                <span>Minha renda</span>
            </button>
            <button type="button" id="tabHeroCustoLar" onclick="alternarAbaHero('lar')" 
                    class="flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all text-muted-foreground hover:text-foreground">
                <i data-lucide="home" class="size-3.5"></i>
                <span>Custo do Lar</span>
            </button>
        </div>

        <!-- CARD 1: MINHA RENDA (DARK CARD - IMAGE 2) -->
        <div id="cardHeroMinhaRenda" class="rounded-3xl bg-[#19221d] text-white p-6 shadow-card space-y-5 transition-all">
            <div class="flex items-center justify-between text-xs text-gray-300">
                <div class="flex items-center gap-2 font-medium">
                    <i data-lucide="trending-up" class="size-4 text-emerald-400"></i>
                    <span>Recebido em junho</span>
                </div>
                <i data-lucide="chevron-down" class="size-4 text-gray-400"></i>
            </div>

            <!-- Valor Principal da Renda -->
            <div class="space-y-3">
                <h3 id="heroRendaValorPrincipal" class="text-3xl sm:text-4xl font-black tracking-tight text-white">
                    R$ 1.700,00
                </h3>
                <div id="heroRendaPillsFontes" class="flex flex-wrap items-center gap-2 text-xs">
                    <span class="inline-flex items-center gap-1 rounded-lg bg-white/10 px-2.5 py-1 text-gray-200 font-medium">
                        <i data-lucide="calendar" class="size-3"></i> Junho 2026
                    </span>
                    <span class="rounded-lg bg-white/10 px-2.5 py-1 text-gray-200 font-medium">
                        Salário R$ 1.500,00
                    </span>
                    <span class="rounded-lg bg-white/10 px-2.5 py-1 text-gray-200 font-medium">
                        Freela R$ 200,00
                    </span>
                </div>
            </div>

            <!-- Sub-divisões dentro do Dark Card -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                <!-- Comprometido -->
                <div class="rounded-2xl bg-white/5 border border-white/10 p-3.5 space-y-1">
                    <div class="flex items-center gap-1.5 text-xs text-gray-400">
                        <i data-lucide="lock" class="size-3.5"></i>
                        <span>Comprometido</span>
                    </div>
                    <strong id="heroRendaComprometido" class="block text-base sm:text-lg font-extrabold text-white">
                        R$ 1.550,00
                    </strong>
                </div>

                <!-- Ainda devendo -->
                <div class="rounded-2xl bg-white/5 border border-white/10 p-3.5 space-y-1">
                    <div class="flex items-center gap-1.5 text-xs text-gray-400">
                        <i data-lucide="info" class="size-3.5"></i>
                        <span>Ainda devendo</span>
                    </div>
                    <strong id="heroRendaAindaDevendo" class="block text-base sm:text-lg font-extrabold text-[#f87171]">
                        R$ 1.115,00
                    </strong>
                </div>

                <!-- Sobra do mês -->
                <div class="rounded-2xl bg-white/5 border border-white/10 p-3.5 space-y-1">
                    <div class="flex items-center gap-1.5 text-xs text-gray-400">
                        <i data-lucide="trophy" class="size-3.5"></i>
                        <span>Sobra do mês</span>
                    </div>
                    <strong id="heroRendaSobraMes" class="block text-base sm:text-lg font-extrabold text-[#4ade80]">
                        R$ 150,00
                    </strong>
                </div>
            </div>
        </div>

        <!-- CARD 2: CUSTO DO LAR (DEEP FOREST GREEN - IMAGE 3) -->
        <div id="cardHeroCustoLar" class="hidden rounded-3xl bg-[#1b4d37] text-white p-6 shadow-card space-y-5 transition-all relative overflow-hidden">
            <!-- Folha decorativa de fundo sutil -->
            <div class="absolute -right-6 -bottom-6 opacity-10 pointer-events-none text-white">
                <svg class="size-48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M12 2L12 22M12 22C12 22 7 18 4 12C1 6 7 2 12 2M12 22C12 22 17 18 20 12C23 6 17 2 12 2" stroke-linecap="round"/>
                </svg>
            </div>

            <div class="flex items-center justify-between text-xs text-emerald-100">
                <div class="flex items-center gap-2 font-medium">
                    <i data-lucide="home" class="size-4 text-emerald-300"></i>
                    <span>Sua parte no Lar em junho</span>
                </div>
                <i data-lucide="chevron-down" class="size-4 text-emerald-300"></i>
            </div>

            <!-- Valor Principal do Lar -->
            <div class="space-y-3">
                <h3 id="heroLarValorPrincipal" class="text-3xl sm:text-4xl font-black tracking-tight text-white">
                    R$ 480,00
                </h3>
                <div class="flex flex-wrap items-center gap-2 text-xs">
                    <span class="inline-flex items-center gap-1 rounded-lg bg-white/10 px-2.5 py-1 text-emerald-100 font-medium">
                        <i data-lucide="calendar" class="size-3"></i> Junho 2026
                    </span>
                    <span id="heroLarPillPercentual" class="rounded-lg bg-white/10 px-2.5 py-1 text-emerald-100 font-medium">
                        28% do Lar é seu
                    </span>
                </div>
            </div>

            <!-- Sub-divisões do Custo do Lar -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                <!-- Já paguei -->
                <div class="rounded-2xl bg-white/10 border border-white/10 p-3.5 space-y-1">
                    <div class="flex items-center gap-1.5 text-xs text-emerald-200">
                        <i data-lucide="clock" class="size-3.5"></i>
                        <span>Já paguei</span>
                    </div>
                    <strong id="heroLarJaPaguei" class="block text-base sm:text-lg font-extrabold text-white">
                        R$ 255,00
                    </strong>
                </div>

                <!-- Ainda falta -->
                <div class="rounded-2xl bg-white/10 border border-white/10 p-3.5 space-y-1">
                    <div class="flex items-center gap-1.5 text-xs text-emerald-200">
                        <i data-lucide="info" class="size-3.5"></i>
                        <span>Ainda falta</span>
                    </div>
                    <strong id="heroLarAindaFalta" class="block text-base sm:text-lg font-extrabold text-amber-300">
                        R$ 225,00
                    </strong>
                </div>

                <!-- Custo total do Lar -->
                <div class="rounded-2xl bg-white/10 border border-white/10 p-3.5 space-y-1">
                    <div class="flex items-center gap-1.5 text-xs text-emerald-200">
                        <i data-lucide="link" class="size-3.5"></i>
                        <span>Custo do Lar</span>
                    </div>
                    <strong id="heroLarCustoTotal" class="block text-base sm:text-lg font-extrabold text-white">
                        R$ 1.667,90
                    </strong>
                </div>
            </div>
        </div>

        <!-- Indicador de Slide / Pontinhos de Navegação -->
        <div class="flex items-center justify-center gap-1.5 pt-1">
            <span id="sliderDotRenda" class="size-2 rounded-full bg-emerald-600 transition-all"></span>
            <span id="sliderDotLar" class="size-2 rounded-full bg-muted transition-all"></span>
            <span id="sliderTextoDica" class="text-[11px] text-muted-foreground ml-2">Arraste para o lado para ver o Custo do Lar</span>
        </div>
    </section>

    <!-- 4. QUATRO AÇÕES RÁPIDAS (IMAGE 4) -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        <!-- Ação 1: Registrar gasto -->
        <button type="button" onclick="abrirModalGasto()" 
                class="flex items-center justify-center gap-2.5 p-3.5 rounded-2xl border border-border bg-card hover:bg-emerald-50/30 dark:hover:bg-emerald-950/20 hover:border-emerald-500/30 shadow-soft transition group">
            <span class="size-7 rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300 flex items-center justify-center shrink-0">
                <i data-lucide="trending-down" class="size-3.5"></i>
            </span>
            <span class="text-xs font-bold text-foreground">Registrar gasto</span>
        </button>

        <!-- Ação 2: Registrar entrada -->
        <button type="button" onclick="abrirModalEntrada()" 
                class="flex items-center justify-center gap-2.5 p-3.5 rounded-2xl border border-border bg-card hover:bg-emerald-50/30 dark:hover:bg-emerald-950/20 hover:border-emerald-500/30 shadow-soft transition group">
            <span class="size-7 rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300 flex items-center justify-center shrink-0">
                <i data-lucide="trending-up" class="size-3.5"></i>
            </span>
            <span class="text-xs font-bold text-foreground">Registrar entrada</span>
        </button>

        <!-- Ação 3: Ver extrato -->
        <button type="button" onclick="trocarAbaApp('transacoes')" 
                class="flex items-center justify-center gap-2.5 p-3.5 rounded-2xl border border-border bg-card hover:bg-emerald-50/30 dark:hover:bg-emerald-950/20 hover:border-emerald-500/30 shadow-soft transition group">
            <span class="size-7 rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300 flex items-center justify-center shrink-0">
                <i data-lucide="receipt" class="size-3.5"></i>
            </span>
            <span class="text-xs font-bold text-foreground">Ver extrato</span>
        </button>

        <!-- Ação 4: Relatórios -->
        <button type="button" onclick="seivaNotificar('Relatório gerencial consolidado de junho disponível!', 'info', 'Relatórios')" 
                class="flex items-center justify-center gap-2.5 p-3.5 rounded-2xl border border-border bg-card hover:bg-emerald-50/30 dark:hover:bg-emerald-950/20 hover:border-emerald-500/30 shadow-soft transition group">
            <span class="size-7 rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300 flex items-center justify-center shrink-0">
                <i data-lucide="bar-chart-2" class="size-3.5"></i>
            </span>
            <span class="text-xs font-bold text-foreground">Relatórios</span>
        </button>
    </div>

    <!-- 5. SEÇÃO: "ONDE ESTÁ MEU DINHEIRO" (IMAGE 4) -->
    <section class="space-y-3.5">
        <div class="flex items-center justify-between">
            <h3 class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-muted-foreground">
                <i data-lucide="wallet" class="size-4 text-emerald-700"></i>
                <span>Onde está meu dinheiro</span>
            </h3>
            <button type="button" onclick="adicionarContaPrompt()" class="flex items-center gap-1 text-xs font-semibold text-emerald-700 hover:underline">
                <i data-lucide="refresh-cw" class="size-3"></i> Atualizar saldo
            </button>
        </div>

        <!-- Card de Consolidação das Contas (Image 4 Top Card) -->
        <div class="rounded-3xl border border-border bg-card p-6 shadow-card space-y-5">
            <div class="space-y-1">
                <span class="text-xs text-muted-foreground font-medium">Somando todas as contas</span>
                <h4 id="ondeTotalTodasContas" class="text-3xl sm:text-4xl font-black tracking-tight text-foreground">
                    R$ 3.745,00
                </h4>
            </div>

            <!-- Divisão: Já tem dono vs Livre pra gastar -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t border-border pt-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-1.5 text-xs text-muted-foreground">
                        <span class="size-2 rounded-full bg-rose-500"></span>
                        <span>Já tem dono</span>
                    </div>
                    <strong id="ondeJaTemDono" class="text-xl font-extrabold text-foreground block">
                        R$ 2.990,00
                    </strong>
                    <span class="text-[11px] text-muted-foreground block">Fatura + reserva das metas</span>
                </div>

                <div class="space-y-1">
                    <div class="flex items-center gap-1.5 text-xs text-muted-foreground">
                        <span class="size-2 rounded-full bg-emerald-500"></span>
                        <span>Livre pra gastar</span>
                    </div>
                    <strong id="ondeLivrePraGastar" class="text-xl font-extrabold text-foreground block">
                        R$ 755,00
                    </strong>
                    <span class="text-[11px] text-muted-foreground block">Inclui a sobra de R$ 150,00 do mês</span>
                </div>
            </div>

            <!-- Dica Educativa SEIVA -->
            <div class="rounded-2xl bg-muted/40 p-3.5 text-xs text-muted-foreground flex items-start gap-2 border border-border/50">
                <i data-lucide="info" class="size-4 text-emerald-600 shrink-0 mt-0.5"></i>
                <p>
                    Ter saldo não é ter dinheiro livre. As <strong>metas</strong> ficam guardadas na <strong>Poupança Caixa</strong> — não no Nubank. Então os <strong>R$ 290,00</strong> livres do Nubank são mesmo só pra gastar.
                </p>
            </div>
        </div>

        <!-- Grid de Contas Bancárias (Image 4 Bottom Cards) -->
        <div id="dashContasList" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            <!-- Cards injetados via JS ou Blade -->
        </div>
    </section>

    <!-- 6. SEÇÃO: "SUA SAÚDE FINANCEIRA EM JUNHO" (IMAGE 5) -->
    <section class="rounded-3xl border border-border bg-card p-6 shadow-card space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
            Sua saúde financeira em junho
        </h3>

        <div class="flex flex-col md:flex-row items-center gap-6">
            <!-- Medidor Gauge Semicircular 58% -->
            <div class="flex flex-col items-center justify-center shrink-0 w-44">
                <div class="relative size-36 flex items-center justify-center">
                    <svg class="size-36 -rotate-90" viewBox="0 0 100 100">
                        <!-- Trilha de fundo -->
                        <circle cx="50" cy="50" r="40" stroke="#f0ede6" stroke-width="12" fill="none" stroke-dasharray="125 125" stroke-dashoffset="0" stroke-linecap="round"/>
                        <!-- Arco de progresso 58% -->
                        <circle cx="50" cy="50" r="40" stroke="#f59e0b" stroke-width="12" fill="none" stroke-dasharray="251.2" stroke-dashoffset="105" stroke-linecap="round"/>
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center pt-2">
                        <span class="text-2xl font-black text-foreground">58%</span>
                        <span class="text-[11px] font-bold text-amber-600">Atenção</span>
                    </div>
                </div>
            </div>

            <!-- Lista de Insights de Saúde Financeira -->
            <div class="space-y-2.5 flex-1">
                <div class="flex items-start gap-2.5 text-xs text-foreground">
                    <span class="text-amber-500 font-bold shrink-0">⚠️</span>
                    <p><strong>81%</strong> da sua renda já tem destino (R$ 1.370 de R$ 1.700).</p>
                </div>
                <div class="flex items-start gap-2.5 text-xs text-foreground">
                    <span class="text-amber-500 font-bold shrink-0">⚠️</span>
                    <p>Reserva em <strong>41%</strong> da meta (R$ 2.100 de R$ 5.100).</p>
                </div>
                <div class="flex items-start gap-2.5 text-xs text-foreground">
                    <span class="text-emerald-600 font-bold shrink-0">✅</span>
                    <p>Gastos de junho (R$ 1.185) menores que sua renda.</p>
                </div>

                <div class="pt-2">
                    <button type="button" onclick="seivaNotificar('Diagnóstico completo: Seu controle está equilibrado e no caminho certo!', 'sucesso', 'Saúde Financeira')" class="text-xs font-bold text-emerald-700 hover:underline flex items-center gap-1">
                        Ver análise completa <i data-lucide="arrow-right" class="size-3.5"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. SEÇÃO: "PRA REGISTRAR HOJE" (IMAGE 5) -->
    <section class="rounded-3xl border border-rose-200/80 bg-[#fff5f5] dark:bg-rose-950/20 p-5 shadow-soft space-y-3.5">
        <div class="flex items-center gap-2 text-rose-800 dark:text-rose-300">
            <i data-lucide="alert-triangle" class="size-4"></i>
            <h3 class="text-xs font-bold uppercase tracking-wider">Pra registrar hoje</h3>
        </div>

        <p class="text-xs text-muted-foreground">
            O SEIVA não paga por você — ele só organiza. Ao tocar em <strong>Registrar</strong>, você confirma que pagou e escolhe de qual conta o valor saiu.
        </p>

        <!-- Itens de Registro Rápido -->
        <div class="space-y-2.5 pt-1">
            <!-- Item 1: Fatura Nubank -->
            <div class="flex items-center justify-between p-3.5 rounded-2xl bg-card border border-rose-200/60 shadow-2xs">
                <div class="flex items-center gap-3">
                    <span class="size-9 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center shrink-0">
                        <i data-lucide="credit-card" class="size-4"></i>
                    </span>
                    <div>
                        <h4 class="text-xs font-extrabold text-foreground">Fatura Nubank · R$ 890,00</h4>
                        <p class="text-[11px] text-muted-foreground">Seus gastos pessoais do mês no cartão · vence hoje</p>
                    </div>
                </div>
                <button type="button" onclick="confirmarRegistroRapido('Fatura Nubank', 890.00)" class="px-4 py-1.5 rounded-xl bg-[#c84b31] hover:bg-[#b03d25] text-white font-bold text-xs transition shadow-2xs">
                    Registrar
                </button>
            </div>

            <!-- Item 2: Geladeira Samsung -->
            <div class="flex items-center justify-between p-3.5 rounded-2xl bg-card border border-rose-200/60 shadow-2xs">
                <div class="flex items-center gap-3">
                    <span class="size-9 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center shrink-0">
                        <i data-lucide="snowflake" class="size-4"></i>
                    </span>
                    <div>
                        <h4 class="text-xs font-extrabold text-foreground">Geladeira Samsung · R$ 500,00</h4>
                        <p class="text-[11px] text-muted-foreground">Sua parte da parcela do mês, dividida com o Ian · vence 15/07</p>
                    </div>
                </div>
                <button type="button" onclick="confirmarRegistroRapido('Geladeira Samsung', 500.00)" class="px-4 py-1.5 rounded-xl bg-[#c84b31] hover:bg-[#b03d25] text-white font-bold text-xs transition shadow-2xs">
                    Registrar
                </button>
            </div>
        </div>
    </section>

    <!-- 8. SEÇÃO: "MINHAS METAS" (IMAGE 5) -->
    <section class="space-y-3.5">
        <div class="flex items-center justify-between">
            <h3 class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-muted-foreground">
                <i data-lucide="target" class="size-4 text-emerald-700"></i>
                <span>Minhas metas</span>
            </h3>
            <button type="button" onclick="trocarAbaApp('metas')" class="flex items-center gap-1 text-xs font-semibold text-emerald-700 hover:underline">
                Ver todas <i data-lucide="arrow-right" class="size-3"></i>
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            <!-- Meta 1: Notebook Dell -->
            <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="size-8 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                            <i data-lucide="laptop" class="size-4"></i>
                        </span>
                        <h4 class="text-xs font-bold text-foreground">Notebook Dell</h4>
                    </div>
                    <span class="rounded-full bg-muted px-2 py-0.5 text-[10px] font-bold text-muted-foreground">
                        Individual
                    </span>
                </div>
                <!-- Barra de Progresso 90% -->
                <div class="space-y-1">
                    <div class="h-2.5 w-full rounded-full bg-muted overflow-hidden">
                        <div class="h-full bg-emerald-600 rounded-full" style="width: 90%"></div>
                    </div>
                    <div class="flex items-center justify-between text-xs font-extrabold text-foreground pt-0.5">
                        <span>R$ 4.050,00 de R$ 4.500,00</span>
                        <span class="text-emerald-700">90%</span>
                    </div>
                </div>
                <p class="text-[11px] text-muted-foreground flex items-center gap-1">
                    <i data-lucide="piggy-bank" class="size-3 text-primary"></i> Guardado em Poupança Caixa
                </p>
            </div>

            <!-- Meta 2: Geladeira Samsung -->
            <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="size-8 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center">
                            <i data-lucide="snowflake" class="size-4"></i>
                        </span>
                        <h4 class="text-xs font-bold text-foreground">Geladeira Samsung</h4>
                    </div>
                    <span class="rounded-full bg-emerald-100 text-emerald-800 px-2 py-0.5 text-[10px] font-bold">
                        Do Lar
                    </span>
                </div>
                <!-- Barra de Progresso 31% -->
                <div class="space-y-1">
                    <div class="h-2.5 w-full rounded-full bg-muted overflow-hidden">
                        <div class="h-full bg-emerald-600 rounded-full" style="width: 31%"></div>
                    </div>
                    <div class="flex items-center justify-between text-xs font-extrabold text-foreground pt-0.5">
                        <span>R$ 1.000,00 de R$ 3.200,00</span>
                        <span class="text-emerald-700">31%</span>
                    </div>
                </div>
                <p class="text-[11px] text-muted-foreground flex items-center gap-1">
                    <i data-lucide="home" class="size-3 text-emerald-600"></i> Guardado em Conta conjunta do Lar
                </p>
            </div>
        </div>
    </section>

    <!-- 9. QUATRO INDICADORES RÁPIDOS (IMAGE 6) -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        <!-- Entradas jun -->
        <div class="rounded-2xl border border-border bg-card p-4 shadow-soft space-y-1">
            <span class="text-xs text-muted-foreground font-medium flex items-center gap-1.5">
                <i data-lucide="trending-up" class="size-3.5 text-emerald-600"></i> Entradas jun
            </span>
            <strong id="indicadorEntradas" class="text-lg font-extrabold text-foreground block">
                R$ 1.700,00
            </strong>
        </div>

        <!-- Saídas jun -->
        <div class="rounded-2xl border border-border bg-card p-4 shadow-soft space-y-1">
            <span class="text-xs text-muted-foreground font-medium flex items-center gap-1.5">
                <i data-lucide="trending-down" class="size-3.5 text-rose-600"></i> Saídas jun
            </span>
            <strong id="indicadorSaidas" class="text-lg font-extrabold text-foreground block">
                R$ 1.185,00
            </strong>
        </div>

        <!-- Livre pra gastar -->
        <div class="rounded-2xl border border-border bg-card p-4 shadow-soft space-y-1">
            <span class="text-xs text-muted-foreground font-medium flex items-center gap-1.5">
                <i data-lucide="wallet" class="size-3.5 text-emerald-600"></i> Livre pra gastar
            </span>
            <strong id="indicadorLivre" class="text-lg font-extrabold text-foreground block">
                R$ 755,00
            </strong>
        </div>

        <!-- Poupança Caixa -->
        <div class="rounded-2xl border border-border bg-card p-4 shadow-soft space-y-1">
            <span class="text-xs text-muted-foreground font-medium flex items-center gap-1.5">
                <i data-lucide="piggy-bank" class="size-3.5 text-blue-600"></i> Poupança Caixa
            </span>
            <strong id="indicadorPoupanca" class="text-lg font-extrabold text-foreground block">
                R$ 2.100,00
            </strong>
        </div>
    </div>

    <!-- 10. SEÇÃO: "FLUXO DOS 2 MESES NO SEIVA" (IMAGE 6) -->
    <section class="rounded-3xl border border-border bg-card p-6 shadow-card space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-bold text-foreground">Fluxo dos 2 meses no SEIVA</h3>
                <p class="text-xs text-muted-foreground">Maio e Junho · entradas vs. saídas</p>
            </div>
            <div class="flex items-center gap-2">
                <button type="button" class="p-1.5 rounded-lg border border-border bg-card text-muted-foreground hover:text-foreground">
                    <i data-lucide="bar-chart-2" class="size-4"></i>
                </button>
                <button type="button" class="p-1.5 rounded-lg border border-border bg-card text-muted-foreground hover:text-foreground">
                    <i data-lucide="pie-chart" class="size-4"></i>
                </button>
            </div>
        </div>

        <!-- Legenda -->
        <div class="flex items-center gap-4 text-xs">
            <span class="flex items-center gap-1.5 font-medium text-foreground">
                <span class="size-2.5 rounded-full bg-[#1b4d37]"></span> Entradas
            </span>
            <span class="flex items-center gap-1.5 font-medium text-foreground">
                <span class="size-2.5 rounded-full bg-[#d97706]"></span> Saídas
            </span>
        </div>

        <!-- Gráfico de Colunas Duplas (Maio vs Junho) -->
        <div class="flex items-end justify-center gap-12 sm:gap-20 h-44 pt-4 border-b border-border pb-2">
            <!-- Mês Maio -->
            <div class="flex flex-col items-center gap-2">
                <div class="flex items-end gap-2.5 h-32">
                    <div class="w-8 sm:w-10 bg-[#1b4d37] rounded-t-lg transition-all hover:opacity-90" style="height: 85%" title="Maio Entradas: R$ 1.600,00"></div>
                    <div class="w-8 sm:w-10 bg-[#d97706] rounded-t-lg transition-all hover:opacity-90" style="height: 60%" title="Maio Saídas: R$ 1.100,00"></div>
                </div>
                <span class="text-xs font-bold text-muted-foreground">Maio</span>
            </div>

            <!-- Mês Junho -->
            <div class="flex flex-col items-center gap-2">
                <div class="flex items-end gap-2.5 h-32">
                    <div class="w-8 sm:w-10 bg-[#1b4d37] rounded-t-lg transition-all hover:opacity-90" style="height: 92%" title="Junho Entradas: R$ 1.700,00"></div>
                    <div class="w-8 sm:w-10 bg-[#d97706] rounded-t-lg transition-all hover:opacity-90" style="height: 68%" title="Junho Saídas: R$ 1.185,00"></div>
                </div>
                <span class="text-xs font-bold text-muted-foreground">Junho</span>
            </div>
        </div>
    </section>

    <!-- 11. SEÇÃO: "DESPESAS FIXAS DO MÊS" (IMAGE 7) -->
    <section class="space-y-3.5">
        <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
            Despesas fixas do mês
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            <!-- Card 1: Fatura Nubank -->
            <div class="rounded-2xl border border-border bg-card p-4 shadow-soft space-y-2">
                <div class="flex items-center justify-between">
                    <span class="size-7 rounded-lg bg-purple-100 text-purple-700 flex items-center justify-center">
                        <i data-lucide="credit-card" class="size-3.5"></i>
                    </span>
                    <span class="inline-flex items-center gap-1 rounded-md bg-amber-500/10 text-amber-700 dark:text-amber-400 px-1.5 py-0.5 text-[10px] font-bold">
                        ⚠️ Vence em breve
                    </span>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-foreground">Fatura Nubank</h4>
                    <strong class="text-base font-extrabold text-foreground">R$ 890,00</strong>
                    <span class="text-[10px] text-muted-foreground block mt-0.5">Vence 12/06</span>
                </div>
            </div>

            <!-- Card 2: Minha parte no Lar -->
            <div class="rounded-2xl border border-border bg-card p-4 shadow-soft space-y-2">
                <div class="flex items-center justify-between">
                    <span class="size-7 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center">
                        <i data-lucide="home" class="size-3.5"></i>
                    </span>
                    <span class="inline-flex items-center gap-1 rounded-md bg-muted text-muted-foreground px-1.5 py-0.5 text-[10px] font-bold">
                        Pendente
                    </span>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-foreground">Minha parte no Lar</h4>
                    <strong class="text-base font-extrabold text-foreground">R$ 480,00</strong>
                    <span class="text-[10px] text-muted-foreground block mt-0.5">Vence dia 5</span>
                </div>
            </div>

            <!-- Card 3: Academia Bio Ritmo -->
            <div class="rounded-2xl border border-border bg-card p-4 shadow-soft space-y-2">
                <div class="flex items-center justify-between">
                    <span class="size-7 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center">
                        <i data-lucide="activity" class="size-3.5"></i>
                    </span>
                    <span class="inline-flex items-center gap-1 rounded-md bg-emerald-500/10 text-emerald-700 px-1.5 py-0.5 text-[10px] font-bold">
                        ✅ Pago
                    </span>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-foreground">Academia Bio Ritmo</h4>
                    <strong class="text-base font-extrabold text-foreground">R$ 119,90</strong>
                    <span class="text-[10px] text-muted-foreground block mt-0.5">Vence dia 8</span>
                </div>
            </div>

            <!-- Card 4: Netflix + Spotify -->
            <div class="rounded-2xl border border-border bg-card p-4 shadow-soft space-y-2">
                <div class="flex items-center justify-between">
                    <span class="size-7 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center">
                        <i data-lucide="film" class="size-3.5"></i>
                    </span>
                    <span class="inline-flex items-center gap-1 rounded-md bg-emerald-500/10 text-emerald-700 px-1.5 py-0.5 text-[10px] font-bold">
                        ✅ Pago
                    </span>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-foreground">Netflix + Spotify</h4>
                    <strong class="text-base font-extrabold text-foreground">R$ 59,80</strong>
                    <span class="text-[10px] text-muted-foreground block mt-0.5">Vence dia 7</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 12. SEÇÃO: "ATIVIDADE RECENTE" (IMAGE 7) -->
    <section class="space-y-3.5">
        <div class="flex items-center justify-between">
            <h3 class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-muted-foreground">
                <i data-lucide="history" class="size-4 text-emerald-700"></i>
                <span>Atividade recente</span>
            </h3>
            <button type="button" onclick="trocarAbaApp('transacoes')" class="flex items-center gap-1 text-xs font-semibold text-emerald-700 hover:underline">
                Ver todas <i data-lucide="arrow-right" class="size-3"></i>
            </button>
        </div>

        <div id="dashAtividadeRecenteList" class="rounded-3xl border border-border bg-card p-2 sm:p-3 shadow-card divide-y divide-border">
            <!-- Linhas de transações renderizadas dinamicamente -->
        </div>
    </section>

    <!-- 13. RODAPÉ INSTITUCIONAL (BORDÃO OFICIAL & LGPD) -->
    <footer class="flex flex-wrap items-center justify-between gap-3 border-t border-border pt-5 pb-2 text-[11px] text-muted-foreground">
        <span class="flex items-center gap-1.5">
            <i data-lucide="shield-check" class="size-3.5 text-emerald-600"></i>
            Privacidade & Conformidade com a LGPD (Lei nº 13.709/2018)
        </span>
        <span class="flex items-center gap-1.5 font-bold text-emerald-800 dark:text-emerald-300">
            <i data-lucide="sprout" class="size-3.5 text-emerald-600"></i>
            Onde seu dinheiro cria raízes
        </span>
    </footer>

</div>
