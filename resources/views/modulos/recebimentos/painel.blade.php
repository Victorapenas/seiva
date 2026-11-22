{{--
    Módulo: Relatórios e Recebimentos (RF003 / RF009)
    Responsável Acadêmico: Victor Hugo / Equipe SEIVA
    Funcionalidade: Painel de relatórios financeiros por período — receitas, despesas, evolução e breakdown por categoria.
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="pane-recebimentos" class="sub-screen space-y-5 hidden">

    <!-- HEADER -->
    <header>
        <h1 class="text-2xl font-black tracking-tight text-foreground">Relatórios e Recebimentos</h1>
        <p class="text-sm text-muted-foreground mt-0.5">Escolha o período e veja para onde seu dinheiro foi.</p>
    </header>

    <!-- BARRA DE NAVEGAÇÃO DE MÊS (ANTERIOR < MÊS ATIVO > PRÓXIMO) -->
    <div class="rounded-2xl border border-border bg-card p-3 shadow-2xs flex items-center justify-between gap-3">
        <button type="button" id="btnRecebMesAnterior" onclick="navegarRecebMes('anterior')" 
                class="px-3 py-2 rounded-xl border border-border hover:bg-muted text-xs font-bold text-foreground transition flex items-center gap-1.5 shadow-2xs cursor-pointer">
            <i data-lucide="chevron-left" class="size-4"></i>
            <span class="hidden sm:inline">Mês anterior</span>
        </button>

        <div class="text-center">
            <span class="text-[10px] font-black uppercase tracking-wider text-muted-foreground block">Visualizando Período</span>
            <strong id="recebMesAtivoLabel" class="text-sm sm:text-base font-black text-foreground">Carregando...</strong>
        </div>

        <button type="button" id="btnRecebMesProximo" onclick="navegarRecebMes('proximo')" 
                class="px-3 py-2 rounded-xl border border-border hover:bg-muted text-xs font-bold text-foreground transition flex items-center gap-1.5 shadow-2xs cursor-pointer">
            <span class="hidden sm:inline">Próximo mês</span>
            <i data-lucide="chevron-right" class="size-4"></i>
        </button>
    </div>

    <!-- SELETOR DE PERÍODO -->
    <div class="p-1 rounded-2xl bg-muted/60 flex gap-1 shadow-2xs">
        <button onclick="filtrarRecebPeriodo('mes')" data-receb-periodo="mes"
                class="receb-periodo-btn flex-1 py-2.5 px-3 rounded-xl text-xs font-semibold transition-all bg-primary text-primary-foreground shadow-soft">
            Mês selecionado
        </button>
        <button onclick="filtrarRecebPeriodo('trimestre')" data-receb-periodo="trimestre"
                class="receb-periodo-btn flex-1 py-2.5 px-3 rounded-xl text-xs font-semibold transition-all text-muted-foreground hover:text-foreground">
            Últimos 3 meses
        </button>
        <button onclick="filtrarRecebPeriodo('personalizado')" data-receb-periodo="personalizado"
                class="receb-periodo-btn flex-1 py-2.5 px-3 rounded-xl text-xs font-semibold transition-all text-muted-foreground hover:text-foreground">
            Personalizado
        </button>
    </div>

    <!-- CHIPS DE MÊS SELECIONÁVEL -->
    <div>
        <p class="text-[11px] text-muted-foreground font-semibold mb-2">Pular diretamente para o mês:</p>
        <div id="recebMesesChips" class="flex flex-wrap gap-2">
            <!-- Chips de meses injetados via JS -->
        </div>
    </div>

    <!-- 3 CARDS RESUMO: Receitas | Despesas | Sobra -->
    <div class="grid grid-cols-3 gap-2.5">
        <div class="rounded-2xl border border-border bg-card p-3.5 shadow-2xs space-y-1">
            <div class="flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m7 7 10 10"/><path d="M17 7v10H7"/></svg>
                <span class="text-[10px] font-semibold text-muted-foreground uppercase tracking-wide">Receitas</span>
            </div>
            <strong id="recebCardReceitas" class="text-sm font-extrabold text-emerald-600 block">R$ 0,00</strong>
        </div>
        <div class="rounded-2xl border border-border bg-card p-3.5 shadow-2xs space-y-1">
            <div class="flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#e11d48" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m17 17-10-10"/><path d="M7 17V7h10"/></svg>
                <span class="text-[10px] font-semibold text-muted-foreground uppercase tracking-wide">Despesas</span>
            </div>
            <strong id="recebCardDespesas" class="text-sm font-extrabold text-rose-500 block">R$ 0,00</strong>
        </div>
        <div class="rounded-2xl border border-border bg-card p-3.5 shadow-2xs space-y-1">
            <div class="flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/><path d="M15 12H9"/><path d="M12 9v6"/></svg>
                <span class="text-[10px] font-semibold text-muted-foreground uppercase tracking-wide">Sobra</span>
            </div>
            <strong id="recebCardSobra" class="text-sm font-extrabold text-foreground block">R$ 0,00</strong>
        </div>
    </div>

    <!-- CARD: Receitas vs Despesas -->
    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-4">
        <div>
            <h3 class="text-sm font-extrabold text-foreground">Receitas vs Despesas</h3>
            <p id="recebRDPeriodoLabel" class="text-xs text-muted-foreground">Este mês</p>
        </div>

        <div class="space-y-3">
            <!-- Barra de Receitas -->
            <div class="space-y-1.5">
                <div class="flex items-center justify-between text-xs">
                    <span class="flex items-center gap-1.5 font-semibold text-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-600"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
                        Receitas
                    </span>
                    <strong id="recebRDReceitas" class="text-emerald-600">R$ 0,00</strong>
                </div>
                <div class="h-2.5 w-full rounded-full bg-muted overflow-hidden">
                    <div id="recebGraficoReceitas" class="h-full bg-emerald-600 rounded-full transition-all duration-700" style="width: 0%"></div>
                </div>
            </div>

            <!-- Barra de Despesas -->
            <div class="space-y-1.5">
                <div class="flex items-center justify-between text-xs">
                    <span class="flex items-center gap-1.5 font-semibold text-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-rose-500"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"/><polyline points="16 17 22 17 22 11"/></svg>
                        Despesas
                    </span>
                    <strong id="recebRDDespesas" class="text-rose-500">R$ 0,00</strong>
                </div>
                <div class="h-2.5 w-full rounded-full bg-muted overflow-hidden">
                    <div id="recebGraficoDespesas" class="h-full bg-rose-500 rounded-full transition-all duration-700" style="width: 0%"></div>
                </div>
            </div>

            <!-- Taxa de economia -->
            <div class="flex items-center justify-between p-3 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200/50">
                <span class="text-xs font-semibold text-emerald-800 dark:text-emerald-300">Taxa de economia</span>
                <strong id="recebTaxaEconomia" class="text-sm font-extrabold text-emerald-600">0%</strong>
            </div>
        </div>
    </div>

    <!-- CARD: Evolução no Período (mini gráfico de barras) -->
    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-4">
        <div>
            <h3 class="text-sm font-extrabold text-foreground">Evolução no período</h3>
            <p id="recebEvolucaoLabel" class="text-xs text-muted-foreground">Últimos 3 meses</p>
        </div>

        <!-- Legenda -->
        <div class="flex items-center gap-4 text-[11px]">
            <span class="flex items-center gap-1.5"><span class="size-2.5 rounded-full bg-emerald-600 inline-block"></span>Receitas</span>
            <span class="flex items-center gap-1.5"><span class="size-2.5 rounded-full bg-rose-500 inline-block"></span>Despesas</span>
        </div>

        <!-- Gráfico de Barras -->
        <div id="recebGraficoEvolucao" class="flex items-end justify-around gap-4 h-28 px-2">
            <!-- Barras injetadas via JS -->
            <div class="flex-1 flex flex-col items-center gap-1 opacity-30">
                <div class="w-full flex items-end gap-1 justify-center" style="height:80px">
                    <div class="w-5 bg-emerald-600 rounded-t-md" style="height:40%"></div>
                    <div class="w-5 bg-rose-500 rounded-t-md" style="height:30%"></div>
                </div>
                <span class="text-[10px] text-muted-foreground">---</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-1 opacity-30">
                <div class="w-full flex items-end gap-1 justify-center" style="height:80px">
                    <div class="w-5 bg-emerald-600 rounded-t-md" style="height:60%"></div>
                    <div class="w-5 bg-rose-500 rounded-t-md" style="height:50%"></div>
                </div>
                <span class="text-[10px] text-muted-foreground">---</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-1">
                <div class="w-full flex items-end gap-1 justify-center" style="height:80px">
                    <div class="w-5 bg-emerald-600 rounded-t-md" style="height:80%"></div>
                    <div class="w-5 bg-rose-500 rounded-t-md" style="height:65%"></div>
                </div>
                <span class="text-[10px] text-muted-foreground font-semibold">Atual</span>
            </div>
        </div>
    </div>

    <!-- CARD: Recebimentos no Período -->
    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-3">
        <div>
            <h3 class="text-sm font-extrabold text-foreground">Recebimentos no período</h3>
            <p id="recebEntradasLabel" class="text-xs text-muted-foreground">Toda entrada confirmada</p>
        </div>

        <div id="recebListaEntradas" class="space-y-0 divide-y divide-border/60">
            <div class="py-8 text-center">
                <i data-lucide="trending-up" class="size-8 text-muted-foreground/30 mx-auto mb-2"></i>
                <p class="text-xs text-muted-foreground">Nenhuma entrada registrada.</p>
                <button onclick="abrirModalRegistrarRecebimento()" class="text-xs text-primary font-semibold hover:underline mt-1">+ Registrar recebimento</button>
            </div>
        </div>

        <!-- Total -->
        <div class="flex items-center justify-between pt-2 border-t border-border">
            <span class="text-xs font-semibold text-muted-foreground">Total recebido</span>
            <strong id="recebTotalEntradas" class="text-base font-extrabold text-emerald-600">R$ 0,00</strong>
        </div>
    </div>

    <!-- CARD: Para onde o dinheiro foi (por categoria) -->
    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-4">
        <div>
            <h3 class="text-sm font-extrabold text-foreground">Para onde o dinheiro foi</h3>
            <p id="recebCatLabel" class="text-xs text-muted-foreground">Gastos por categoria</p>
        </div>

        <div id="recebCategoriasLista" class="space-y-3">
            <div class="py-6 text-center">
                <p class="text-xs text-muted-foreground">Nenhuma despesa registrada neste período.</p>
            </div>
        </div>
    </div>

    <!-- Botão Registrar Recebimento -->
    <button onclick="abrirModalRegistrarRecebimento()"
            class="w-full py-3.5 rounded-2xl bg-primary text-primary-foreground font-extrabold text-sm flex items-center justify-center gap-2 shadow-soft hover:bg-primary/90 transition">
        <i data-lucide="plus" class="size-4"></i>
        Registrar novo recebimento
    </button>
</div>
