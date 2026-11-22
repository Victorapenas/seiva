{{--
    Módulo: Transações e Extrato (RF003)
    Responsáveis Acadêmicos: Victor Hugo / Jhon Abner
    Funcionalidade: Extrato individual com filtros avançados, busca, categorias e Transações do Lar com relatórios e balanço de rateio.
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="pane-transacoes" class="sub-screen space-y-5 hidden">

    <!-- HEADER -->
    <header class="flex items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-black tracking-tight text-foreground">Transações</h1>
            <p class="text-sm text-muted-foreground mt-0.5" id="txSubtitulo">Acompanhe suas entradas, saídas e divisão do lar</p>
        </div>
    </header>

    <!-- ABAS PRINCIPAIS: Minhas Transações | Transações do Lar -->
    <div class="p-1 rounded-2xl bg-muted/60 flex gap-1 shadow-2xs">
        <button id="tabMinhasTransacoes"
                onclick="alternarAbaTransacoes('minhas')"
                class="flex-1 py-2.5 px-3 rounded-xl text-sm font-semibold transition-all bg-card text-foreground shadow-2xs flex items-center justify-center gap-2">
            <i data-lucide="list" class="size-4"></i>
            <span>Minhas transações</span>
        </button>
        <button id="tabLarTransacoes"
                onclick="alternarAbaTransacoes('lar')"
                class="flex-1 py-2.5 px-3 rounded-xl text-sm font-semibold transition-all text-muted-foreground hover:text-foreground flex items-center justify-center gap-2">
            <i data-lucide="home" class="size-4"></i>
            <span>Transações do Lar</span>
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
        </div>

        <!-- Chips de Conta -->
        <div class="flex flex-wrap gap-2" id="txChipsConta">
            <button onclick="filtrarTransacoesConta('')"
                    class="tx-conta-chip inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold transition border border-primary text-primary bg-primary/10"
                    data-conta="">Todas</button>
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

    <!-- ═══ PAINEL: TRANSAÇÕES DO LAR COM RELATÓRIOS E BALANÇO DE RATEIO ═══ -->
    <div id="paneLarTransacoes" class="space-y-5 hidden">

        <!-- Banner Nobre: Ambiente Verde Floresta do Lar -->
        <div class="rounded-3xl bg-gradient-to-br from-[#06140c] via-[#091f14] to-[#041009] text-white border border-emerald-500/25 p-5 sm:p-6 space-y-4 shadow-elevated relative overflow-hidden">
            <!-- Marca d'água sutil -->
            <div class="absolute -right-8 -bottom-8 opacity-5 pointer-events-none">
                <i data-lucide="home" class="size-48 text-emerald-300"></i>
            </div>

            <!-- Topo do Banner: Título + Badge de Rateio -->
            <div class="flex flex-wrap items-center justify-between gap-3 relative z-10">
                <div class="flex items-center gap-2.5">
                    <span class="size-8 rounded-xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center">
                        <i data-lucide="home" class="size-4"></i>
                    </span>
                    <div>
                        <h3 class="text-sm font-extrabold text-white">Transações e Custo do Lar</h3>
                        <p class="text-[11px] text-emerald-300/80">Divisão transparente e sem atrito no Nosso Cantinho</p>
                    </div>
                </div>
                <div id="txLarBadgeAcordo" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-950/80 border border-emerald-500/30 text-[11px] font-bold text-emerald-300">
                    <i data-lucide="scale" class="size-3"></i>
                    <span id="txLarAcordoTexto">Rateio: Duda (40%) · Ian (60%)</span>
                </div>
            </div>

            <!-- Total do Lar no Mês -->
            <div class="space-y-1 relative z-10 pt-1">
                <span class="text-xs font-semibold text-emerald-300/90 tracking-wide uppercase">Custo Total do Lar neste Mês</span>
                <div class="flex items-baseline gap-2">
                    <strong id="txLarBannerTotal" class="text-2xl sm:text-3xl font-black text-white tracking-tight">R$ 0,00</strong>
                    <span class="text-xs text-emerald-400/80 font-medium">(despesas compartilhadas)</span>
                </div>
            </div>

            <!-- Comparativo dos Membros (Quanto cada um adiantou) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 relative z-10">
                <!-- Card Usuário -->
                <div class="rounded-2xl bg-white/[0.06] border border-white/10 p-3.5 space-y-2 backdrop-blur-xs">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span id="txLarEuIniciais" class="size-7 rounded-full bg-emerald-600 text-white text-xs font-black flex items-center justify-center">ME</span>
                            <span class="text-xs font-bold text-white">Você pagou</span>
                        </div>
                        <span id="txLarEuCotaPercentual" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">Cota 40%</span>
                    </div>
                    <div>
                        <strong id="txLarEuEnviei" class="text-xl font-black text-white block">R$ 0,00</strong>
                        <span id="txLarEuCotaIdeal" class="text-[10px] text-emerald-300/70 block mt-0.5">Sua cota ideal: R$ 0,00</span>
                    </div>
                </div>

                <!-- Card Parceiro -->
                <div class="rounded-2xl bg-white/[0.06] border border-white/10 p-3.5 space-y-2 backdrop-blur-xs">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span id="txLarParceiroIniciais" class="size-7 rounded-full bg-emerald-500 text-white text-xs font-black flex items-center justify-center">IM</span>
                            <span id="txLarParceiroLabel" class="text-xs font-bold text-white">Ian pagou</span>
                        </div>
                        <span id="txLarParceiroCotaPercentual" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">Cota 60%</span>
                    </div>
                    <div>
                        <strong id="txLarParceiroEnviou" class="text-xl font-black text-white block">R$ 0,00</strong>
                        <span id="txLarParceiroCotaIdeal" class="text-[10px] text-emerald-300/70 block mt-0.5">Cota ideal dele: R$ 0,00</span>
                    </div>
                </div>
            </div>

            <!-- Card de Balanço e Acerto Matemático entre o Casal -->
            <div id="txLarCardAcerto" class="rounded-2xl bg-emerald-950/60 border border-emerald-500/30 p-3.5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 relative z-10">
                <div class="flex items-center gap-3">
                    <span id="txLarAcertoIcone" class="size-9 rounded-xl bg-emerald-500/20 text-emerald-300 flex items-center justify-center shrink-0">
                        <i data-lucide="check-circle-2" class="size-5"></i>
                    </span>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-300 block">Acerto de Contas do Mês</span>
                        <p id="txLarAcertoMensagem" class="text-xs font-bold text-white mt-0.5">
                            Contas equilibradas de acordo com o rateio.
                        </p>
                    </div>
                </div>
                <button type="button" id="txLarBtnLembreteAcerto" onclick="abrirModalPedirAjudaCusto()" 
                        class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition flex items-center justify-center gap-1.5 shrink-0 shadow-soft">
                    <i data-lucide="send" class="size-3.5"></i>
                    <span>Solicitar Acerto</span>
                </button>
            </div>
        </div>

        <!-- Mini Relatório por Categorias do Lar -->
        <div class="rounded-2xl border border-border bg-card p-4 space-y-3 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-foreground">Distribuição dos Gastos do Lar</span>
                <span class="text-[11px] text-muted-foreground" id="txLarQtdTotalDespesas">0 despesas no mês</span>
            </div>
            <div id="txLarCategoriasGrid" class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                <!-- Injetado dinamicamente via JS -->
            </div>
        </div>

        <!-- Filtros de Listagem do Lar -->
        <div class="flex flex-wrap items-center justify-between gap-2 pt-1">
            <span class="text-xs font-extrabold text-foreground">Extrato Compartilhado</span>
            <div id="txLarFiltros" class="flex gap-1.5 p-1 rounded-xl bg-muted/60 border border-border/60">
                <button onclick="filtrarTransacoesLar('todos', this)"
                        class="tx-lar-btn px-3 py-1.5 rounded-lg bg-card text-foreground text-xs font-bold shadow-2xs transition"
                        data-membro="todos">Todos</button>
                <button onclick="filtrarTransacoesLar('eu', this)"
                        class="tx-lar-btn px-3 py-1.5 rounded-lg text-muted-foreground hover:text-foreground text-xs font-semibold transition"
                        data-membro="eu" id="txLarBtnEu">Pagos por Mim</button>
                <button onclick="filtrarTransacoesLar('parceiro', this)"
                        class="tx-lar-btn px-3 py-1.5 rounded-lg text-muted-foreground hover:text-foreground text-xs font-semibold transition"
                        data-membro="parceiro" id="txLarBtnParceiro">Pelo Parceiro</button>
                <button onclick="filtrarTransacoesLar('imprevistos', this)"
                        class="tx-lar-btn px-3 py-1.5 rounded-lg text-muted-foreground hover:text-foreground text-xs font-semibold transition flex items-center gap-1"
                        data-membro="imprevistos">
                    <i data-lucide="alert-triangle" class="size-3 text-amber-500"></i>
                    <span>Imprevistos</span>
                </button>
            </div>
        </div>

        <!-- Lista de Transações do Lar -->
        <div id="txLarLista" class="space-y-2.5">
            <div class="flex items-center justify-center py-10">
                <p class="text-sm text-muted-foreground">Carregando transações do Lar...</p>
            </div>
        </div>

        <!-- Ações do Lar -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 pt-1">
            <button onclick="abrirModalLancarGasto()"
                    class="py-3.5 px-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs flex items-center justify-center gap-2 shadow-soft transition">
                <i data-lucide="plus" class="size-4"></i>
                <span>Lançar nova despesa do Lar</span>
            </button>
            <button id="txBtnPedirAjudaLar" onclick="abrirModalPedirAjudaCusto()"
                    class="py-3.5 px-4 rounded-2xl border border-border bg-card text-xs font-bold text-foreground hover:bg-muted transition flex items-center justify-center gap-2 shadow-2xs">
                <i data-lucide="handshake" class="size-4 text-emerald-700"></i>
                <span id="txBtnPedirAjudaTexto">Pedir ajuda de custo ao parceiro</span>
            </button>
        </div>

        <!-- Rodapé explicativo -->
        <div class="rounded-2xl border border-border/60 bg-muted/30 p-3.5 text-[11px] text-muted-foreground leading-relaxed space-y-1">
            <p>
                💡 <strong>Como funciona a matemática do Lar:</strong> Cada gasto compartilhado é debitado da conta de quem realizou o pagamento e entra na Mesa de Acordos.
            </p>
            <p>
                O sistema calcula a cota proporcional de cada parceiro (ex: 40%/60%) e mantém o balanço atualizado para que o acerto final seja justo, transparente e sem cobranças constrangedoras.
            </p>
        </div>
    </div>
</div>
