{{-- 
    Módulo: Área do Lar / Painel do Lar (RF004, RF006, RF008, RF010)
    Responsáveis Acadêmicos: Jhon Abner / Ian Marcos
    Funcionalidade: Gestão financeira compartilhada do casal com 4 abas (Início, Despesas, Metas, Acordos),
    saúde financeira do casal, fundo de emergência, rateio proporcional, quitação de despesas e acordos.
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="pane-lar" class="sub-screen space-y-6 hidden max-w-6xl mx-auto pb-12">

    <!-- 1. CABEÇALHO DO PAINEL DO LAR (IMAGENS 1, 4, 6, 11) -->
    <header class="space-y-3 pt-1">
        <div class="flex items-center gap-2 text-xs font-semibold text-emerald-800 dark:text-emerald-300">
            <span class="flex size-6 items-center justify-center rounded-lg bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 border border-emerald-500/20">
                <i data-lucide="home" class="size-3.5"></i>
            </span>
            <span id="larTopoNomeBadge">Nosso Cantinho</span>
        </div>

        <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-foreground">Painel do Lar</h1>

        <div class="flex items-center gap-2.5 pt-0.5">
            <div class="flex items-center -space-x-1.5 shrink-0">
                <span id="larAvatarMembro1" class="size-7 rounded-full bg-pink-100 dark:bg-pink-950/60 text-pink-700 dark:text-pink-300 font-extrabold text-[10px] flex items-center justify-center ring-2 ring-card shadow-2xs">ME</span>
                <span id="larAvatarMembro2" class="size-7 rounded-full bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 font-extrabold text-[10px] flex items-center justify-center ring-2 ring-card shadow-2xs">IM</span>
            </div>
            <p id="larCasalSubtitulo" class="text-xs text-muted-foreground font-medium">
                Maria Eduarda & Ian Marcos · desde abril de 2026
            </p>
        </div>

        <!-- 4 ABAS PRINCIPAIS DO PAINEL DO LAR (IMAGENS 1, 4, 6, 11) -->
        <div class="flex flex-wrap items-center gap-2 pt-2" id="larAbasNavegacao">
            <button type="button" onclick="alternarSubAbaLar('inicio', this)" 
                    class="btn-subaba-lar active px-4 py-2 rounded-2xl bg-emerald-800 text-white font-extrabold text-xs shadow-soft transition flex items-center gap-2">
                <i data-lucide="home" class="size-4"></i>
                <span>Início</span>
            </button>
            <button type="button" onclick="alternarSubAbaLar('despesas', this)" 
                    class="btn-subaba-lar px-4 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition flex items-center gap-2 shadow-2xs">
                <i data-lucide="receipt" class="size-4"></i>
                <span>Despesas</span>
            </button>
            <button type="button" onclick="alternarSubAbaLar('metas', this)" 
                    class="btn-subaba-lar px-4 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition flex items-center gap-2 shadow-2xs">
                <i data-lucide="target" class="size-4"></i>
                <span>Metas</span>
            </button>
            <button type="button" onclick="alternarSubAbaLar('acordos', this)" 
                    class="btn-subaba-lar px-4 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition flex items-center gap-2 shadow-2xs">
                <i data-lucide="handshake" class="size-4"></i>
                <span>Acordos</span>
            </button>
        </div>
    </header>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- ABA 1: INÍCIO (IMAGEM 1 & 2)                                         -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <div id="larConteudoInicio" class="space-y-5">

        <!-- CARD HERO: SAÚDE FINANCEIRA DO LAR -->
        <div class="rounded-3xl border border-border bg-card p-5 sm:p-6 shadow-card space-y-5">
            <div class="flex items-center gap-2 text-xs font-bold text-emerald-800 dark:text-emerald-300">
                <i data-lucide="trending-up" class="size-4 text-emerald-600"></i>
                <span>Saúde financeira do Lar</span>
            </div>

            <div class="flex flex-col md:flex-row items-center gap-6">
                <!-- Gauge circular de 72% Saudável -->
                <div class="relative size-36 shrink-0 flex items-center justify-center">
                    <svg class="size-full -rotate-90" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="40" fill="none" class="stroke-muted" stroke-width="10"></circle>
                        <circle cx="50" cy="50" r="40" fill="none" class="stroke-emerald-700" stroke-width="10" 
                                stroke-dasharray="251.2" stroke-dashoffset="70.3" stroke-linecap="round"></circle>
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                        <span id="larSaudeScore" class="text-3xl font-black text-foreground">72%</span>
                        <span id="larSaudeStatus" class="text-[11px] font-bold text-emerald-700 dark:text-emerald-400">Saudável</span>
                    </div>
                </div>

                <!-- Detalhes e Insights da Saúde -->
                <div class="flex-1 min-w-0 space-y-2 text-xs">
                    <div class="flex items-center gap-2 text-muted-foreground">
                        <i data-lucide="coins" class="size-3.5 text-emerald-600 shrink-0"></i>
                        <span>Renda do casal: <strong id="larTxtRendaCasal" class="font-extrabold text-foreground">R$ 4.200,00/mês</strong></span>
                    </div>
                    <div class="flex items-center gap-2 text-muted-foreground">
                        <i data-lucide="check-circle" class="size-3.5 text-emerald-600 shrink-0"></i>
                        <span>Custo fixo do Lar: <strong id="larTxtCustoFixo" class="font-extrabold text-foreground">R$ 1.667,90 (40% da renda)</strong></span>
                    </div>
                    <div class="flex items-center gap-2 text-amber-700 dark:text-amber-300 font-medium">
                        <i data-lucide="alert-triangle" class="size-3.5 text-amber-600 shrink-0"></i>
                        <span id="larTxtFaltaMembro">Falta a Duda contribuir: <strong>R$ 225,00 neste mês</strong></span>
                    </div>
                </div>
            </div>

            <!-- BARRAS DE CONTRIBUIÇÃO DOS MEMBROS (IAN & DUDA) -->
            <div class="space-y-4 pt-2 border-t border-border/60">
                <!-- Membro 1: Ian (100% pago) -->
                <div class="space-y-1.5" id="boxMembroRateio1">
                    <div class="flex items-center justify-between text-xs">
                        <div class="flex items-center gap-2">
                            <span class="size-6 rounded-full bg-emerald-100 dark:bg-emerald-950/70 text-emerald-700 dark:text-emerald-300 font-extrabold text-[10px] flex items-center justify-center">IM</span>
                            <strong class="font-extrabold text-foreground" id="larMembro1Nome">Ian</strong>
                        </div>
                        <span class="text-xs text-muted-foreground font-bold">
                            <span id="larMembro1Valores">R$ 1.187,90 / R$ 1.187,90</span> · <strong class="text-emerald-600 font-black" id="larMembro1Pct">100%</strong>
                        </span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-muted overflow-hidden">
                        <div id="larMembro1Barra" class="h-full bg-emerald-700 rounded-full transition-all duration-700" style="width: 100%"></div>
                    </div>
                </div>

                <!-- Membro 2: Duda (53% pago) -->
                <div class="space-y-1.5" id="boxMembroRateio2">
                    <div class="flex items-center justify-between text-xs">
                        <div class="flex items-center gap-2">
                            <span class="size-6 rounded-full bg-pink-100 dark:bg-pink-950/70 text-pink-700 dark:text-pink-300 font-extrabold text-[10px] flex items-center justify-center">ME</span>
                            <strong class="font-extrabold text-foreground" id="larMembro2Nome">Duda</strong>
                        </div>
                        <span class="text-xs text-muted-foreground font-bold">
                            <span id="larMembro2Valores">R$ 255,00 / R$ 480,00</span> · <strong class="text-amber-600 font-black" id="larMembro2Pct">53%</strong>
                        </span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-muted overflow-hidden">
                        <div id="larMembro2Barra" class="h-full bg-amber-500 rounded-full transition-all duration-700" style="width: 53%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4 CARDS RÁPIDOS DE RESUMO (IMAGEM 1) -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <!-- 1. Custo do Lar -->
            <div class="rounded-3xl border border-border bg-card p-4 space-y-1 shadow-2xs">
                <span class="text-[11px] font-semibold text-muted-foreground flex items-center gap-1.5">
                    <i data-lucide="receipt" class="size-3.5 text-muted-foreground"></i>
                    Custo do Lar
                </span>
                <strong id="larCardCustoTotal" class="text-lg font-black text-foreground block">R$ 1.667,90</strong>
            </div>

            <!-- 2. Já contribuído -->
            <div class="rounded-3xl border border-border bg-card p-4 space-y-1 shadow-2xs">
                <span class="text-[11px] font-semibold text-muted-foreground flex items-center gap-1.5">
                    <i data-lucide="download" class="size-3.5 text-emerald-600"></i>
                    Já contribuído
                </span>
                <strong id="larCardJaContribuido" class="text-lg font-black text-foreground block">R$ 1.442,90</strong>
            </div>

            <!-- 3. Falta contribuir -->
            <div class="rounded-3xl border border-amber-200/60 dark:border-amber-900/40 bg-amber-50/60 dark:bg-amber-950/20 p-4 space-y-1 shadow-2xs">
                <span class="text-[11px] font-semibold text-amber-800 dark:text-amber-300 flex items-center gap-1.5">
                    <i data-lucide="alert-triangle" class="size-3.5 text-amber-600"></i>
                    Falta contribuir
                </span>
                <strong id="larCardFaltaContribuir" class="text-lg font-black text-amber-900 dark:text-amber-200 block">R$ 225,00</strong>
            </div>

            <!-- 4. Sobra do casal -->
            <div class="rounded-3xl border border-emerald-200/60 dark:border-emerald-900/40 bg-emerald-50/60 dark:bg-emerald-950/20 p-4 space-y-1 shadow-2xs">
                <span class="text-[11px] font-semibold text-emerald-800 dark:text-emerald-300 flex items-center gap-1.5">
                    <i data-lucide="trending-up" class="size-3.5 text-emerald-600"></i>
                    Sobra do casal
                </span>
                <strong id="larCardSobraCasal" class="text-lg font-black text-emerald-900 dark:text-emerald-200 block">R$ 2.532,10</strong>
            </div>
        </div>

        <!-- CARD FUNDO DE EMERGÊNCIA DO LAR (IMAGEM 2) -->
        <div class="rounded-3xl border border-border bg-card p-5 space-y-4 shadow-card">
            <div class="flex items-start justify-between gap-3">
                <div class="flex items-center gap-3">
                    <span class="size-11 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 flex items-center justify-center shrink-0 border border-emerald-500/20">
                        <i data-lucide="shield" class="size-5"></i>
                    </span>
                    <div>
                        <h4 class="text-sm font-extrabold text-foreground">Fundo de emergência do Lar</h4>
                        <span class="text-xs text-muted-foreground">Poupança Caixa (conjunta)</span>
                    </div>
                </div>
                <strong class="text-sm font-black text-foreground">50%</strong>
            </div>

            <div class="space-y-1.5">
                <div class="h-2.5 w-full rounded-full bg-muted overflow-hidden">
                    <div class="h-full bg-amber-500 rounded-full transition-all duration-700" style="width: 50%"></div>
                </div>
                <div class="flex items-center justify-between text-xs text-muted-foreground pt-0.5">
                    <span class="font-bold text-foreground">R$ 5.000,00 de R$ 10.000,00</span>
                    <span class="text-[11px]">Reforço de R$ 250 · 02/06</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 pt-1">
                <button type="button" onclick="abrirModalReforcarFundoEmergencia()" 
                        class="py-3 px-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs flex items-center justify-center gap-2 shadow-soft transition">
                    <i data-lucide="plus" class="size-4"></i>
                    <span>+ Reforçar fundo</span>
                </button>
                <button type="button" onclick="solicitarUsoEmergenciaLar()" 
                        class="py-3 px-4 rounded-2xl border border-border bg-card hover:bg-muted text-foreground font-bold text-xs flex items-center justify-center gap-2 shadow-2xs transition">
                    <i data-lucide="flame" class="size-4 text-amber-600"></i>
                    <span>Usar em emergência</span>
                </button>
            </div>
        </div>

        <!-- SEÇÃO: PRÓXIMOS VENCIMENTOS (IMAGEM 2) -->
        <div class="space-y-3">
            <div class="flex items-center gap-2 text-xs font-bold text-foreground">
                <i data-lucide="calendar" class="size-4 text-emerald-600"></i>
                <span>Próximos vencimentos</span>
            </div>

            <div id="larListaProximosVencimentos" class="space-y-2.5">
                <!-- Renderizado dinamicamente via JS com dados do protótipo -->
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- ABA 2: DESPESAS (IMAGEM 4)                                          -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <div id="larConteudoDespesas" class="space-y-5 hidden">
        <!-- Botão Registrar Gasto do Lar -->
        <button type="button" onclick="abrirModalDespesaLar()" 
                class="w-full py-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm flex items-center justify-center gap-2 shadow-soft transition">
            <i data-lucide="plus" class="size-5"></i>
            <span>+ Registrar gasto do Lar</span>
        </button>

        <!-- Segmented control: Nova despesa | Emergência -->
        <div class="grid grid-cols-2 gap-2 p-1 rounded-2xl bg-muted/60">
            <button type="button" class="py-2 px-3 rounded-xl bg-card text-foreground font-extrabold text-xs shadow-2xs flex items-center justify-center gap-2">
                <i data-lucide="receipt" class="size-3.5"></i>
                <span>Nova despesa</span>
            </button>
            <button type="button" onclick="abrirModalEmergenciaLar()" class="py-2 px-3 rounded-xl text-amber-800 dark:text-amber-300 font-bold text-xs hover:bg-amber-100/50 flex items-center justify-center gap-2">
                <i data-lucide="flame" class="size-3.5 text-amber-600"></i>
                <span>Emergência</span>
            </button>
        </div>

        <!-- DÍVIDAS FIXAS DO CASAL -->
        <div class="space-y-3">
            <h4 class="text-xs font-black uppercase tracking-wider text-muted-foreground">Dívidas fixas do casal</h4>
            <div id="larListaDividasFixas" class="space-y-2.5">
                <!-- Itens Fixos: Aluguel, Luz, Internet, Água -->
            </div>
        </div>

        <!-- DÍVIDAS VARIÁVEIS -->
        <div class="space-y-3 pt-2">
            <h4 class="text-xs font-black uppercase tracking-wider text-muted-foreground">Dívidas variáveis</h4>
            <div id="larListaDividasVariaveis" class="space-y-2.5">
                <!-- Itens Variáveis: Mercado Dia a Dia, iFood sexta -->
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- ABA 3: METAS DO LAR (IMAGEM 6)                                      -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <div id="larConteudoMetas" class="space-y-4 hidden">
        <div id="larListaMetasCards" class="space-y-4">
            <!-- Cards de Metas: Geladeira Samsung, Viagem Praia do Forte, Reforma da cozinha, Fundo de emergência -->
        </div>

        <button type="button" onclick="abrirModalCriarMeta()" 
                class="w-full py-3.5 rounded-2xl border-2 border-dashed border-border hover:border-emerald-500/50 bg-card hover:bg-emerald-50/10 text-xs font-extrabold text-foreground transition flex items-center justify-center gap-2 shadow-2xs">
            <i data-lucide="plus" class="size-4 text-emerald-600"></i>
            <span>Adicionar nova meta para o Lar</span>
        </button>
    </div>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- ABA 4: ACORDOS DO LAR (IMAGEM 11)                                   -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <div id="larConteudoAcordos" class="space-y-5 hidden">
        <!-- Card Mesa de Acordos Resumo -->
        <div class="rounded-3xl border border-border bg-card p-5 space-y-4 shadow-card">
            <div class="flex items-center gap-3">
                <span class="size-10 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 flex items-center justify-center shrink-0 border border-emerald-500/20">
                    <i data-lucide="handshake" class="size-5"></i>
                </span>
                <div>
                    <h4 class="text-sm font-extrabold text-foreground">Mesa de Acordos</h4>
                    <p class="text-xs text-muted-foreground" id="larAcordosDescCasal">Combinados claros entre você e o Ian</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 pt-1">
                <div class="rounded-2xl border border-border bg-muted/30 p-3.5 space-y-0.5">
                    <span class="text-[11px] font-semibold text-muted-foreground">Acordos ativos</span>
                    <strong id="larAcordosAtivosContador" class="text-xl font-black text-foreground block">2</strong>
                </div>
                <div class="rounded-2xl border border-amber-200/60 dark:border-amber-900/40 bg-amber-50/60 dark:bg-amber-950/20 p-3.5 space-y-0.5">
                    <span class="text-[11px] font-semibold text-amber-800 dark:text-amber-300">Em negociação</span>
                    <strong id="larAcordosNegociacaoContador" class="text-xl font-black text-amber-900 dark:text-amber-200 block">2</strong>
                </div>
            </div>
        </div>

        <!-- Lista de Acordos Registrados -->
        <div id="larListaAcordosItens" class="space-y-2.5">
            <!-- Geladeira Samsung (Dívida) | Viagem Praia do Forte (Meta) -->
        </div>

        <!-- Ações da Mesa de Acordos -->
        <div class="space-y-2.5 pt-2">
            <button type="button" onclick="trocarAbaApp('acordos')" 
                    class="w-full py-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm flex items-center justify-center gap-2 shadow-soft transition">
                <i data-lucide="plus" class="size-5"></i>
                <span>+ Criar novo acordo</span>
            </button>
            <button type="button" onclick="solicitarAcordoParceiro()" 
                    class="w-full py-3 rounded-2xl border border-border bg-card text-xs font-bold text-foreground hover:bg-muted transition flex items-center justify-center gap-2 shadow-2xs">
                <i data-lucide="handshake" class="size-4 text-emerald-600"></i>
                <span id="larBtnSolicitarAcordoTexto">Solicitar acordo ao Ian</span>
            </button>
        </div>
    </div>
</div>
