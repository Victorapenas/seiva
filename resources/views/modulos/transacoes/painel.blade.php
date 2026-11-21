{{--
    Módulo: Transações e Extrato (RF003)
    Responsáveis Acadêmicos: Victor Hugo / Jhon Abner
    Funcionalidade: Extrato individual com filtros avançados, busca, categorias e Transições do Lar.
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="pane-transacoes" class="sub-screen space-y-5 hidden">

    <!-- HEADER -->
    <header class="flex items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-black tracking-tight text-foreground">Transações</h1>
            <p class="text-sm text-muted-foreground mt-0.5" id="txSubtitulo">Acompanhe suas entradas e saídas</p>
        </div>
    </header>

    <!-- ABAS PRINCIPAIS: Minhas Transações | Transições do Lar -->
    <div class="p-1 rounded-2xl bg-muted/60 flex gap-1 shadow-2xs">
        <button id="tabMinhasTransacoes"
                onclick="alternarAbaTransacoes('minhas')"
                class="flex-1 py-2.5 px-3 rounded-xl text-sm font-semibold transition-all bg-card text-foreground shadow-2xs flex items-center justify-center gap-2">
            <i data-lucide="list" class="size-4"></i>
            Minhas transações
        </button>
        <button id="tabLarTransacoes"
                onclick="alternarAbaTransacoes('lar')"
                class="flex-1 py-2.5 px-3 rounded-xl text-sm font-semibold transition-all text-muted-foreground hover:text-foreground flex items-center justify-center gap-2">
            <i data-lucide="home" class="size-4"></i>
            Transições do Lar
        </button>
    </div>

    <!-- ═══ PAINEL: MINHAS TRANSAÇÕES ═══ -->
    <div id="paneMinhasTransacoes" class="space-y-4">

        <!-- Barra de Busca + Botão Lançar -->
        <div class="flex gap-3 items-center">
            <div class="flex-1 relative">
                <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 size-4 text-muted-foreground pointer-events-none"></i>
                <input type="text" id="txBuscaInput" placeholder="Buscar transação..."
                       oninput="buscarTransacoes(this.value)"
                       class="w-full h-11 pl-10 pr-4 rounded-2xl border border-border bg-card text-sm text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition shadow-2xs">
            </div>
            <button onclick="abrirModalLancarGasto()"
                    class="h-11 px-4 rounded-2xl bg-primary text-primary-foreground font-bold text-sm flex items-center gap-2 shadow-soft hover:bg-primary/90 transition shrink-0">
                <i data-lucide="plus" class="size-4"></i>
                <span class="hidden sm:inline">Lançar</span>
            </button>
        </div>

        <!-- Filtros de Período -->
        <div id="txFiltroPeriodo" class="grid grid-cols-3 gap-2">
            <button onclick="filtrarTransacoesPeriodo('hoje')"
                    class="tx-periodo-btn py-2.5 rounded-2xl border border-border bg-card text-xs font-semibold text-muted-foreground hover:text-foreground hover:border-primary/40 transition shadow-2xs"
                    data-periodo="hoje">Hoje</button>
            <button onclick="filtrarTransacoesPeriodo('semana')"
                    class="tx-periodo-btn py-2.5 rounded-2xl border border-border bg-card text-xs font-semibold text-muted-foreground hover:text-foreground hover:border-primary/40 transition shadow-2xs"
                    data-periodo="semana">Semana</button>
            <button onclick="filtrarTransacoesPeriodo('mes')"
                    class="tx-periodo-btn py-2.5 rounded-2xl bg-primary text-primary-foreground text-xs font-extrabold shadow-soft"
                    data-periodo="mes">Mês</button>
        </div>

        <!-- Chips de Categoria -->
        <div class="flex flex-wrap gap-2" id="txChipsCategoria">
            <button onclick="filtrarTransacoesCategoria('')"
                    class="tx-cat-chip inline-flex items-center px-3.5 py-1.5 rounded-full text-xs font-semibold transition bg-primary text-primary-foreground shadow-soft"
                    data-cat="">Todos</button>
            <!-- Chips dinâmicos injetados via JS -->
        </div>

        <!-- Chips de Conta -->
        <div class="flex flex-wrap gap-2" id="txChipsConta">
            <button onclick="filtrarTransacoesConta('')"
                    class="tx-conta-chip inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold transition border border-primary text-primary bg-primary/10"
                    data-conta="">Todas</button>
            <!-- Contas dinâmicas injetadas via JS -->
        </div>

        <!-- Resumo: Entradas | Saídas | Saldo Líquido -->
        <div class="grid grid-cols-3 gap-2.5">
            <div class="rounded-2xl border border-border bg-card p-3.5 text-center shadow-2xs">
                <span class="text-[10px] font-semibold text-muted-foreground uppercase tracking-wider block">Entradas</span>
                <strong id="txResumoEntradas" class="text-sm font-extrabold text-emerald-600 block mt-1">R$ 0,00</strong>
            </div>
            <div class="rounded-2xl border border-border bg-card p-3.5 text-center shadow-2xs">
                <span class="text-[10px] font-semibold text-muted-foreground uppercase tracking-wider block">Saídas</span>
                <strong id="txResumoSaidas" class="text-sm font-extrabold text-rose-500 block mt-1">R$ 0,00</strong>
            </div>
            <div class="rounded-2xl border border-border bg-card p-3.5 text-center shadow-2xs">
                <span class="text-[10px] font-semibold text-muted-foreground uppercase tracking-wider block">Saldo líquido</span>
                <strong id="txResumoSaldo" class="text-sm font-extrabold text-foreground block mt-1">R$ 0,00</strong>
            </div>
        </div>

        <!-- Lista de Transações agrupada por data -->
        <div id="txListaAgrupada" class="space-y-4">
            <div class="flex items-center justify-center py-12">
                <div class="text-center space-y-2">
                    <i data-lucide="receipt" class="size-10 text-muted-foreground/40 mx-auto"></i>
                    <p class="text-sm text-muted-foreground">Nenhuma transação encontrada.</p>
                    <button onclick="abrirModalLancarGasto()" class="text-xs text-primary font-semibold hover:underline">+ Lançar primeira transação</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ═══ PAINEL: TRANSIÇÕES DO LAR ═══ -->
    <div id="paneLarTransacoes" class="space-y-4 hidden">

        <!-- Banner: Movimentado para o Lar -->
        <div class="rounded-3xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200/60 dark:border-emerald-800/40 p-4 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i data-lucide="leaf" class="size-4 text-emerald-700"></i>
                    <span id="txLarBannerTitulo" class="text-xs font-bold text-emerald-800 dark:text-emerald-300">Movimentado para o Lar este mês</span>
                </div>
                <strong id="txLarBannerTotal" class="text-sm font-extrabold text-emerald-800 dark:text-emerald-300">R$ 0,00</strong>
            </div>
            <div class="grid grid-cols-2 gap-2.5">
                <div class="rounded-2xl bg-white/70 dark:bg-emerald-900/40 border border-emerald-200/50 p-3 space-y-1">
                    <div class="flex items-center gap-1.5">
                        <span id="txLarEuIniciais" class="size-6 rounded-full bg-emerald-700 text-white text-[10px] font-black flex items-center justify-center">ME</span>
                        <span class="text-[11px] text-muted-foreground font-medium">Eu enviei</span>
                    </div>
                    <strong id="txLarEuEnviei" class="text-base font-extrabold text-foreground block">R$ 0,00</strong>
                </div>
                <div class="rounded-2xl bg-white/70 dark:bg-emerald-900/40 border border-emerald-200/50 p-3 space-y-1">
                    <div class="flex items-center gap-1.5">
                        <span id="txLarParceiroIniciais" class="size-6 rounded-full bg-emerald-500 text-white text-[10px] font-black flex items-center justify-center">IM</span>
                        <span id="txLarParceiroLabel" class="text-[11px] text-muted-foreground font-medium">Parceiro enviou</span>
                    </div>
                    <strong id="txLarParceiroEnviou" class="text-base font-extrabold text-foreground block">R$ 0,00</strong>
                </div>
            </div>
        </div>

        <!-- Filtros de Membro -->
        <div id="txLarFiltros" class="grid grid-cols-3 gap-2">
            <button onclick="filtrarTransacoesLar('eu')"
                    class="tx-lar-btn py-2.5 rounded-2xl bg-primary text-primary-foreground text-xs font-extrabold shadow-soft"
                    data-membro="eu" id="txLarBtnEu">Eu</button>
            <button onclick="filtrarTransacoesLar('todos')"
                    class="tx-lar-btn py-2.5 rounded-2xl border border-border bg-card text-xs font-semibold text-muted-foreground hover:text-foreground transition shadow-2xs"
                    data-membro="todos">Todos</button>
            <button onclick="filtrarTransacoesLar('parceiro')"
                    class="tx-lar-btn py-2.5 rounded-2xl border border-border bg-card text-xs font-semibold text-muted-foreground hover:text-foreground transition shadow-2xs"
                    data-membro="parceiro" id="txLarBtnParceiro">Parceiro</button>
        </div>

        <!-- Lista de Transições do Lar -->
        <div id="txLarLista" class="space-y-2.5">
            <div class="flex items-center justify-center py-10">
                <p class="text-sm text-muted-foreground">Carregando transações do Lar...</p>
            </div>
        </div>

        <!-- Ações do Lar -->
        <div class="space-y-2 pt-1">
            <button onclick="abrirModalLancarGasto()"
                    class="w-full py-3.5 rounded-2xl bg-primary text-primary-foreground font-extrabold text-sm flex items-center justify-center gap-2 shadow-soft hover:bg-primary/90 transition">
                <i data-lucide="plus" class="size-4"></i>
                Registrar transição para o Lar
            </button>
            <button id="txBtnPedirAjudaLar" onclick="abrirModalPedirAjudaCusto()"
                    class="w-full py-3 rounded-2xl border border-border bg-card text-xs font-semibold text-muted-foreground hover:text-foreground transition flex items-center justify-center gap-2 shadow-2xs">
                <i data-lucide="handshake" class="size-4 text-primary"></i>
                <span id="txBtnPedirAjudaTexto">Pedir ajuda de custo ao parceiro</span>
            </button>
        </div>

        <!-- Rodapé informativo -->
        <p class="text-[11px] text-muted-foreground leading-relaxed border-t border-border pt-3">
            → Estas são as transferências e gastos que você já enviou para o <strong>Nosso Cantinho</strong>.
            Os valores batem com a aba do Lar e com a sua Caixa Preta.
        </p>
    </div>
</div>
