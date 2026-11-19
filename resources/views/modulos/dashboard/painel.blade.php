{{-- 
    Módulo: Dashboard Consolidado e Painel do Lar / Individual (RF009)
    Responsável Acadêmico: Victor Hugo
    Conceito: "Dinheiro Sem Tabu"
    Fidelidade ao Protótipo Original: Saldo do Lar, Rateio Proporcional justo, Ações Rápidas (Rateio, Receita, Acordo),
    Cards Este Mês (Receitas e Despesas) e Pills de Destaque (Cobrador Diplomata & Caixa Preta).
--}}
<div id="pane-dashboard" class="sub-screen space-y-5">

    <!-- BARRA DE ALTERNÂNCIA RÁPIDA DE PERFIS DE TESTE (DUDA, IAN, VICTOR HUGO) -->
    <div class="flex flex-wrap items-center justify-between gap-2.5 rounded-2xl border border-emerald-500/20 bg-emerald-50/70 dark:bg-emerald-950/30 px-3.5 py-2.5 text-xs">
        <div class="flex items-center gap-2 text-emerald-800 dark:text-emerald-300 font-medium">
            <span class="size-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>Ambiente Ativo:</span>
            <strong id="dashBadgePerfilAtivo" class="font-bold underline decoration-emerald-500/40">Carregando...</strong>
        </div>
        <div class="flex flex-wrap items-center gap-1.5">
            <span class="text-muted-foreground text-[11px] mr-1 hidden sm:inline">Alternar:</span>
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

    <!-- CABEÇALHO DO DASHBOARD (ESTILO PROTÓTIPO COM IDENTIDADE VISUAL SEIVA) -->
    <header class="flex items-center justify-between gap-4 pt-1">
        <div class="flex items-center gap-3.5">
            <div id="dashAvatarBox" class="size-12 rounded-2xl bg-amber-400 text-amber-950 font-black flex items-center justify-center text-sm shadow-soft shrink-0 border border-amber-300">
                <span id="dashAvatar">DI</span>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h1 id="dashNomeLar" class="text-lg font-bold tracking-tight text-foreground">Nosso Cantinho 🌿</h1>
                    <span id="dashBadgeModo" class="inline-flex items-center gap-1 rounded-full bg-emerald-500/10 px-2 py-0.5 text-[10px] font-bold text-emerald-600">
                        Casal & Lar
                    </span>
                </div>
                <p id="dashSubtituloCasal" class="text-xs text-muted-foreground font-medium mt-0.5">Duda & Ian</p>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <button onclick="alternarVisibilidadeSaldos()" id="btnVisSaldos" class="size-9 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground flex items-center justify-center transition shadow-2xs" title="Ocultar ou exibir saldos">
                <i data-lucide="eye" class="size-4"></i>
            </button>
            <button onclick="abrirModalNotificacoes()" class="relative size-9 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground flex items-center justify-center transition shadow-2xs">
                <i data-lucide="bell" class="size-4"></i>
                <span class="absolute top-2 right-2 size-2 rounded-full bg-emerald-500"></span>
            </button>
        </div>
    </header>

    <!-- CARD PRINCIPAL: SALDO DO LAR / SALDO LIVRE (IDÊNTICO AO PROTÓTIPO) -->
    <div class="rounded-3xl border border-border bg-card p-6 shadow-card relative overflow-hidden">
        <!-- Detalhe decorativo suave de raiz/folha ao fundo -->
        <div class="absolute -right-8 -bottom-8 opacity-5 pointer-events-none text-primary">
            <svg class="size-48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M12 2L12 22M12 22C12 22 7 18 4 12C1 6 7 2 12 2M12 22C12 22 17 18 20 12C23 6 17 2 12 2" stroke-linecap="round"/>
            </svg>
        </div>

        <div class="flex items-center justify-between">
            <span id="dashLabelSaldoPrincipal" class="text-[11px] font-bold tracking-wider text-muted-foreground uppercase">
                SALDO DO LAR
            </span>
            <span class="text-[11px] font-semibold text-primary flex items-center gap-1">
                Dinheiro Sem Tabu
            </span>
        </div>

        <div class="mt-2.5 flex flex-wrap items-baseline justify-between gap-3">
            <div>
                <h2 id="dashValSaldoLivre" class="text-3xl sm:text-4xl font-extrabold tracking-tight text-foreground">
                    R$ 14.850,00
                </h2>
                <!-- Indicador de tendência com gráfico de onda fluida (Sparkline) -->
                <div class="flex items-center gap-2.5 mt-2 text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                    <span id="dashTendenciaTexto" class="flex items-center gap-1">
                        <i data-lucide="trending-up" class="size-3.5"></i> +R$ 2.450 este mês
                    </span>
                    <svg class="w-16 h-4 text-emerald-500 stroke-current shrink-0" viewBox="0 0 60 16" fill="none">
                        <path d="M2 12C12 12 16 4 28 8C38 12 44 2 58 3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>

            <!-- Divisão interna: Comprometido vs Livre -->
            <div class="flex items-center gap-4 text-xs border-l border-border pl-4">
                <div>
                    <span class="text-muted-foreground block text-[10px]">Já tem dono</span>
                    <strong id="dashValComprometido" class="font-bold text-destructive">R$ 0,00</strong>
                </div>
                <div>
                    <span class="text-muted-foreground block text-[10px]">Desimpedido</span>
                    <strong id="dashValLivre" class="font-bold text-success">R$ 0,00</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- 3 AÇÕES RÁPIDAS (IDÊNTICO AO PROTÓTIPO: RATEIO, RECEITA, ACORDO) -->
    <div class="grid grid-cols-3 gap-3">
        <!-- Ação 1: Rateio / Despesa -->
        <button type="button" onclick="abrirModalDespesaLar()" 
                class="group flex flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-4 shadow-soft hover:border-rose-400/50 hover:bg-rose-50/30 dark:hover:bg-rose-950/20 transition text-center">
            <span class="size-11 rounded-2xl bg-rose-100 text-rose-600 dark:bg-rose-950/60 dark:text-rose-400 flex items-center justify-center transition-transform group-hover:scale-105 shadow-2xs">
                <i data-lucide="arrow-up" class="size-5"></i>
            </span>
            <span class="text-xs font-bold text-foreground">Rateio</span>
            <span class="text-[10px] text-muted-foreground hidden sm:inline">Dividir despesa</span>
        </button>

        <!-- Ação 2: Receita / Entrada -->
        <button type="button" onclick="abrirModalEntrada()" 
                class="group flex flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-4 shadow-soft hover:border-emerald-400/50 hover:bg-emerald-50/30 dark:hover:bg-emerald-950/20 transition text-center">
            <span class="size-11 rounded-2xl bg-emerald-100 text-emerald-600 dark:bg-emerald-950/60 dark:text-emerald-400 flex items-center justify-center transition-transform group-hover:scale-105 shadow-2xs">
                <i data-lucide="arrow-down" class="size-5"></i>
            </span>
            <span class="text-xs font-bold text-foreground">Receita</span>
            <span class="text-[10px] text-muted-foreground hidden sm:inline">Entrada de valor</span>
        </button>

        <!-- Ação 3: Acordo / Negociação -->
        <button type="button" onclick="trocarAbaApp('acordos')" 
                class="group flex flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-4 shadow-soft hover:border-teal-400/50 hover:bg-teal-50/30 dark:hover:bg-teal-950/20 transition text-center">
            <span class="size-11 rounded-2xl bg-teal-100 text-teal-600 dark:bg-teal-950/60 dark:text-teal-400 flex items-center justify-center transition-transform group-hover:scale-105 shadow-2xs">
                <i data-lucide="handshake" class="size-5"></i>
            </span>
            <span class="text-xs font-bold text-foreground">Acordo</span>
            <span class="text-[10px] text-muted-foreground hidden sm:inline">Mesa do casal</span>
        </button>
    </div>

    <!-- CARD RATEIO PROPORCIONAL: "MAIS JUSTO QUE 50/50" (DESTAQUE CENTRAL DO PROTÓTIPO) -->
    <div id="cardRateioProporcionalBox" class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <h3 class="text-sm font-bold text-foreground">Rateio Proporcional</h3>
                <span class="text-xs text-muted-foreground hidden sm:inline">· Divisão justa por renda</span>
            </div>
            <span class="rounded-full bg-emerald-500/10 px-2.5 py-1 text-[11px] font-bold text-emerald-600 dark:text-emerald-400 flex items-center gap-1 border border-emerald-500/20">
                <i data-lucide="sparkles" class="size-3"></i> Mais justo que 50/50
            </span>
        </div>

        <!-- Barra bipartida de proporção -->
        <div class="h-3.5 w-full rounded-full bg-muted flex overflow-hidden ring-1 ring-border">
            <div id="barRateioMembro1" class="h-full bg-emerald-600 transition-all duration-500 rounded-l-full" style="width: 60%"></div>
            <div id="barRateioMembro2" class="h-full bg-amber-400 transition-all duration-500 rounded-r-full" style="width: 40%"></div>
        </div>

        <!-- Legenda com percentuais e valores de cada membro -->
        <div class="flex items-center justify-between text-xs pt-0.5">
            <div class="flex items-center gap-2">
                <span class="size-2.5 rounded-full bg-emerald-600"></span>
                <span id="legendaRateioMembro1" class="font-bold text-foreground">Ian: 60% (R$ 6k)</span>
            </div>
            <div class="flex items-center gap-2">
                <span id="legendaRateioMembro2" class="font-bold text-foreground">Duda: 40% (R$ 4k)</span>
                <span class="size-2.5 rounded-full bg-amber-400"></span>
            </div>
        </div>
    </div>

    <!-- SEÇÃO "ESTE MÊS": RECEITAS E DESPESAS (PROTÓTIPO OFICIAL) -->
    <section class="space-y-2">
        <p class="text-xs font-bold text-muted-foreground uppercase tracking-wider">Este mês</p>
        <div class="grid grid-cols-2 gap-3">
            <!-- Card Receitas -->
            <div class="rounded-2xl border border-border bg-card p-4 shadow-soft space-y-1">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium text-muted-foreground">Receitas</span>
                    <span class="text-[10px] font-bold text-emerald-600 bg-emerald-500/10 px-1.5 py-0.5 rounded-md flex items-center">
                        ▲ 12%
                    </span>
                </div>
                <p id="dashCardReceitas" class="text-2xl font-black tracking-tight text-foreground">
                    R$ 8.500
                </p>
                <span class="text-[10px] text-muted-foreground block">Entradas confirmadas</span>
            </div>

            <!-- Card Despesas -->
            <div class="rounded-2xl border border-border bg-card p-4 shadow-soft space-y-1">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium text-muted-foreground">Despesas</span>
                    <span class="text-[10px] font-bold text-rose-600 bg-rose-500/10 px-1.5 py-0.5 rounded-md flex items-center">
                        ▲ 27%
                    </span>
                </div>
                <p id="dashCardDespesas" class="text-2xl font-black tracking-tight text-foreground">
                    R$ 4.900
                </p>
                <span class="text-[10px] text-muted-foreground block">Despesas do Lar</span>
            </div>
        </div>
    </section>

    <!-- PILLS / CARDS FLUTUANTES DE DESTAQUE: COBRADOR DIPLOMATA & CAIXA PRETA (PROTÓTIPO) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <!-- Cobrador Diplomata Pill -->
        <button type="button" onclick="trocarAbaApp('cobrador')" 
                class="flex items-center gap-3.5 p-3.5 rounded-2xl border border-border bg-card hover:border-primary/40 hover:bg-accent/20 transition text-left shadow-soft group">
            <span class="size-10 rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-950/60 dark:text-blue-400 flex items-center justify-center shrink-0">
                <i data-lucide="bell-ring" class="size-5"></i>
            </span>
            <div class="min-w-0 flex-1">
                <div class="flex items-center gap-1.5">
                    <strong class="text-xs font-bold text-foreground">Cobrador Diplomata</strong>
                    <span class="size-1.5 rounded-full bg-blue-500"></span>
                </div>
                <p class="text-[11px] text-muted-foreground truncate">Lembrete neutro de internet com PIX!</p>
            </div>
            <i data-lucide="chevron-right" class="size-4 text-muted-foreground group-hover:translate-x-0.5 transition-transform"></i>
        </button>

        <!-- Caixa Preta Criptografada Pill -->
        <button type="button" onclick="trocarAbaApp('caixa-preta')" 
                class="flex items-center gap-3.5 p-3.5 rounded-2xl border border-border bg-card hover:border-amber-400/50 hover:bg-amber-50/20 dark:hover:bg-amber-950/20 transition text-left shadow-soft group">
            <span class="size-10 rounded-xl bg-amber-100 text-amber-700 dark:bg-amber-950/60 dark:text-amber-400 flex items-center justify-center shrink-0">
                <i data-lucide="lock" class="size-5"></i>
            </span>
            <div class="min-w-0 flex-1">
                <div class="flex items-center gap-1.5">
                    <strong class="text-xs font-bold text-foreground">Caixa Preta Criptografada</strong>
                    <span class="size-1.5 rounded-full bg-amber-500"></span>
                </div>
                <p class="text-[11px] text-muted-foreground truncate">PIN 4 dígitos · 100% privado</p>
            </div>
            <i data-lucide="chevron-right" class="size-4 text-muted-foreground group-hover:translate-x-0.5 transition-transform"></i>
        </button>
    </div>

    <!-- SEÇÃO: ONDE ESTÁ MEU DINHEIRO (CONTAS BANCÁRIAS CADASTRADAS) -->
    <section class="space-y-2.5 pt-1">
        <div class="flex items-center justify-between">
            <h3 class="flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-muted-foreground">
                <i data-lucide="wallet" class="size-4 text-primary"></i> Onde está meu dinheiro
            </h3>
            <button type="button" onclick="adicionarContaPrompt()" class="flex items-center gap-1 text-xs font-semibold text-primary hover:underline">
                <i data-lucide="plus" class="size-3.5"></i> Nova conta
            </button>
        </div>
        <div id="dashContasList" class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
            <p class="text-xs text-muted-foreground py-4 text-center col-span-full">Carregando carteiras financeiras...</p>
        </div>
    </section>

    <!-- RODAPÉ INSTITUCIONAL (BORDÃO OFICIAL SEIVA & LGPD) -->
    <footer class="flex flex-wrap items-center justify-between gap-2 border-t border-border pt-4 pb-2 text-[11px] text-muted-foreground">
        <span class="flex items-center gap-1.5">
            <i data-lucide="shield-check" class="size-3.5 text-emerald-600"></i>
            Privacidade & Conformidade com a LGPD (Lei nº 13.709/2018)
        </span>
        <span class="flex items-center gap-1.5 font-medium text-primary">
            Dinheiro Sem Tabu
        </span>
    </footer>

</div>
