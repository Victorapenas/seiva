{{-- 
    Módulo: Área do Lar / Painel do Lar (RF004, RF006, RF008, RF010)
    Responsáveis Acadêmicos: Jhon Abner / Ian Marcos
    Funcionalidade: Gestão financeira compartilhada do casal com 4 abas (Início, Despesas, Metas, Acordos),
    saúde financeira do casal explicada com 4 pilares, fundo de emergência bilateral, rateio proporcional,
    quitação de despesas e ambiente imersivo do cantinho do casal.
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="pane-lar" class="sub-screen space-y-6 hidden max-w-6xl mx-auto pb-12">

    <!-- 1. HERO BANNER NOBRE & IMERSIVO DO LAR (CASA ACONCHEGANTE DO CASAL) -->
    <div class="relative rounded-3xl overflow-hidden border border-border shadow-elevated bg-card">
        <!-- Foto de Capa Aconchegante com Iluminação Quente -->
        <div class="relative h-44 sm:h-52 w-full overflow-hidden">
            <img id="larFotoCapaImg" src="/lar-inicio.png" alt="Nosso Cantinho" class="size-full object-cover object-center scale-100 hover:scale-105 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-black/20"></div>

            <!-- Botão Personalizar Foto e Detalhes do Lar -->
            <button type="button" onclick="abrirModalEditarLar()" 
                    class="absolute top-3.5 right-3.5 px-3 py-1.5 rounded-full bg-white/20 hover:bg-white/30 backdrop-blur-md text-white text-xs font-bold border border-white/25 flex items-center gap-1.5 transition shadow-soft">
                <i data-lucide="camera" class="size-3.5"></i>
                <span>Personalizar Cantinho</span>
            </button>

            <!-- Textos Imersivos sobre a Foto -->
            <div class="absolute bottom-4 left-4 sm:left-6 right-4 text-white space-y-1">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-500/30 border border-emerald-400/40 text-[11px] font-black text-emerald-200 backdrop-blur-xs">
                        <i data-lucide="home" class="size-3"></i>
                        <span id="larTopoNomeBadge">Nosso Cantinho</span>
                    </span>
                    <span class="text-xs text-white/80 font-medium hidden sm:inline">· Lar Compartilhado</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white drop-shadow-xs">Painel do Lar</h1>
                <div class="flex items-center gap-2 pt-0.5 text-xs text-white/90">
                    <div class="flex items-center -space-x-1.5 shrink-0">
                        <span id="larAvatarMembro1" class="size-6 rounded-full bg-pink-500 text-white font-extrabold text-[10px] flex items-center justify-center ring-2 ring-white/40">ME</span>
                        <span id="larAvatarMembro2" class="size-6 rounded-full bg-emerald-600 text-white font-extrabold text-[10px] flex items-center justify-center ring-2 ring-white/40">IM</span>
                    </div>
                    <p id="larCasalSubtitulo" class="font-medium drop-shadow-xs">
                        Maria Eduarda & Ian Marcos · desde abril de 2026 (7 meses de parceria)
                    </p>
                </div>
            </div>
        </div>

        <!-- 4 ABAS PRINCIPAIS DO PAINEL DO LAR (Início | Despesas | Metas | Acordos) -->
        <div class="p-3 sm:p-4 bg-card border-t border-border/60">
            <div class="flex flex-wrap items-center gap-2" id="larAbasNavegacao">
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
                    <span>Metas do Lar</span>
                </button>
                <button type="button" onclick="alternarSubAbaLar('acordos', this)" 
                        class="btn-subaba-lar px-4 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition flex items-center gap-2 shadow-2xs">
                    <i data-lucide="handshake" class="size-4"></i>
                    <span>Mesa de Acordos</span>
                </button>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- ABA 1: INÍCIO (SAÚDE, RESUMO, RESERVA E PRÓXIMOS VENCIMENTOS)        -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <div id="larConteudoInicio" class="space-y-5">

        <!-- CARD HERO: SAÚDE FINANCEIRA DO LAR (COM EXPLICAÇÃO TRANSPARENTE DOS 4 PILARES) -->
        <div class="rounded-3xl border border-border bg-card p-5 sm:p-6 shadow-card space-y-5">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-2 text-xs font-bold text-emerald-800 dark:text-emerald-300">
                    <i data-lucide="heart-pulse" class="size-4 text-emerald-600"></i>
                    <span>Saúde financeira do Lar</span>
                </div>
                <div class="flex items-center gap-2 flex-wrap">
                    <button type="button" onclick="abrirModalHistoricoAuditoria()" 
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold border border-border bg-card hover:bg-muted text-foreground transition cursor-pointer shadow-2xs">
                        <i data-lucide="shield-check" class="size-3.5 text-emerald-600"></i>
                        <span>Auditoria & Histórico</span>
                    </button>
                    <!-- Botão didático para abrir modal com os 4 parâmetros e a matemática com Alto Contraste -->
                    <button type="button" onclick="abrirModalSaudeFinanceiraLar()" 
                            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-black shadow-soft transition cursor-pointer hover:opacity-95"
                            style="background-color: #047857 !important; color: #ffffff !important;">
                        <i data-lucide="info" class="size-3.5 text-emerald-200"></i>
                        <span style="color: #ffffff !important;">Critérios do cálculo</span>
                        <i data-lucide="arrow-right" class="size-3 text-emerald-200"></i>
                    </button>
                </div>
            </div>

            <div class="flex flex-col md:flex-row items-center gap-6">
                <!-- Gauge circular de 72% Saudável (Clicável para abrir critérios) -->
                <div onclick="abrirModalSaudeFinanceiraLar()" class="relative size-36 shrink-0 flex items-center justify-center cursor-pointer group" title="Clique para ver a análise completa">
                    <svg class="size-full -rotate-90" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="40" fill="none" class="stroke-muted" stroke-width="10"></circle>
                        <circle cx="50" cy="50" r="40" fill="none" class="stroke-emerald-700 group-hover:stroke-emerald-600 transition-colors" stroke-width="10" 
                                stroke-dasharray="251.2" stroke-dashoffset="70.3" stroke-linecap="round"></circle>
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                        <span id="larSaudeScore" class="text-3xl font-black text-foreground group-hover:scale-105 transition-transform">72%</span>
                        <span id="larSaudeStatus" class="text-[11px] font-extrabold text-emerald-700 dark:text-emerald-400">Saudável</span>
                    </div>
                </div>

                <!-- Detalhes e Insights da Saúde com Alto Contraste -->
                <div class="flex-1 min-w-0 space-y-2.5 text-xs">
                    <div class="flex items-center gap-2 text-foreground font-medium">
                        <i data-lucide="coins" class="size-3.5 text-emerald-600 shrink-0"></i>
                        <span>Renda combinada do casal: <strong id="larTxtRendaCasal" class="font-extrabold text-foreground">R$ 4.200,00/mês</strong></span>
                    </div>
                    <div class="flex items-center gap-2 text-foreground font-medium">
                        <i data-lucide="check-circle" class="size-3.5 text-emerald-600 shrink-0"></i>
                        <span>Custo fixo do Lar: <strong id="larTxtCustoFixo" class="font-extrabold text-foreground">R$ 1.667,90 (40% da renda — excelente!)</strong></span>
                    </div>
                    <!-- Box de Alerta com Contraste Perfeito e Legibilidade Garantida -->
                    <div class="flex flex-wrap items-center justify-between gap-2 p-3 rounded-2xl shadow-2xs"
                         style="background-color: #fef3c7 !important; border: 1.5px solid #f59e0b !important;">
                        <div class="flex items-center gap-2">
                            <i data-lucide="alert-triangle" class="size-4 shrink-0" style="color: #b45309 !important;"></i>
                            <span id="larTxtFaltaMembro" class="text-xs" style="color: #451a03 !important; font-weight: 800 !important;">
                                Falta a Duda contribuir: <strong style="color: #451a03 !important; font-weight: 900 !important;">R$ 225,00 neste mês</strong>
                            </span>
                        </div>
                        <button type="button" onclick="abrirModalContestarEnvioLar()" 
                                class="px-3 py-1.5 rounded-xl text-xs font-black shadow-2xs transition flex items-center gap-1.5 hover:opacity-95"
                                style="background-color: #d97706 !important; color: #ffffff !important;">
                            <i data-lucide="sparkles" class="size-3.5 text-amber-100"></i>
                            <span style="color: #ffffff !important;">Cobrador Diplomata</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- BARRAS DE CONTRIBUIÇÃO DOS MEMBROS (IAN & DUDA) -->
            <div class="space-y-4 pt-2 border-t border-border/60">
                <!-- Membro 1: Ian (100% pago) -->
                <div class="space-y-1.5" id="boxMembroRateio1">
                    <div class="flex items-center justify-between text-xs">
                        <div class="flex items-center gap-2">
                            <span class="size-6 rounded-full bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 font-extrabold text-[10px] flex items-center justify-center">IM</span>
                            <strong class="font-extrabold text-foreground" id="larMembro1Nome">Ian</strong>
                        </div>
                        <span class="text-xs text-muted-foreground font-bold">
                            <span id="larMembro1Valores" class="text-foreground">R$ 1.187,90 / R$ 1.187,90</span> · <strong class="text-emerald-700 dark:text-emerald-400 font-black" id="larMembro1Pct">100%</strong>
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
                            <span id="larMembro2Valores" class="text-foreground">R$ 255,00 / R$ 480,00</span> · <strong class="text-amber-700 dark:text-amber-400 font-black" id="larMembro2Pct">53%</strong>
                        </span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-muted overflow-hidden">
                        <div id="larMembro2Barra" class="h-full bg-amber-500 rounded-full transition-all duration-700" style="width: 53%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4 CARDS RÁPIDOS DE RESUMO (COM CONTRASTE FORTE E LEGIBILIDADE MÁXIMA) -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <!-- 1. Custo do Lar -->
            <div class="rounded-3xl border border-border bg-card p-4 space-y-1 shadow-2xs">
                <span class="text-[11px] font-bold text-muted-foreground flex items-center gap-1.5">
                    <i data-lucide="receipt" class="size-3.5 text-muted-foreground"></i>
                    Custo do Lar
                </span>
                <strong id="larCardCustoTotal" class="text-lg font-black text-foreground block">R$ 1.667,90</strong>
            </div>

            <!-- 2. Já contribuído -->
            <div class="rounded-3xl border border-border bg-card p-4 space-y-1 shadow-2xs">
                <span class="text-[11px] font-bold text-muted-foreground flex items-center gap-1.5">
                    <i data-lucide="download" class="size-3.5 text-emerald-600"></i>
                    Já contribuído
                </span>
                <strong id="larCardJaContribuido" class="text-lg font-black text-foreground block">R$ 1.442,90</strong>
            </div>

            <!-- 3. Falta contribuir (Contraste Perfeito: Fundo Âmbar Claro + Texto Âmbar Escuro em Negrito) -->
            <div class="rounded-3xl p-4 space-y-1 shadow-2xs cursor-pointer hover:opacity-95 transition" 
                 style="background-color: #fef3c7 !important; border: 1.5px solid #f59e0b !important;"
                 onclick="abrirModalContestarEnvioLar()" title="Clique para gerenciar cota ou pedir comprovante">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-black flex items-center gap-1.5" style="color: #78350f !important;">
                        <i data-lucide="alert-triangle" class="size-3.5" style="color: #b45309 !important;"></i>
                        Falta contribuir
                    </span>
                    <i data-lucide="chevron-right" class="size-3" style="color: #78350f !important;"></i>
                </div>
                <strong id="larCardFaltaContribuir" class="text-lg font-black block" style="color: #451a03 !important;">R$ 225,00</strong>
            </div>

            <!-- 4. Sobra do casal (Contraste Perfeito: Fundo Esmeralda Claro + Texto Esmeralda Escuro em Negrito) -->
            <div class="rounded-3xl p-4 space-y-1 shadow-2xs"
                 style="background-color: #ecfdf5 !important; border: 1.5px solid #10b981 !important;">
                <span class="text-[11px] font-black flex items-center gap-1.5" style="color: #065f46 !important;">
                    <i data-lucide="trending-up" class="size-3.5" style="color: #059669 !important;"></i>
                    Sobra do casal
                </span>
                <strong id="larCardSobraCasal" class="text-lg font-black block" style="color: #064e3b !important;">R$ 2.532,10</strong>
            </div>
        </div>

        <!-- CARD FUNDO DE EMERGÊNCIA DO LAR (COM BOTÃO DE RESGATE FUNCIONAL) -->
        <div class="rounded-3xl border border-border bg-card p-5 space-y-4 shadow-card">
            <div class="flex items-start justify-between gap-3">
                <div class="flex items-center gap-3">
                    <span class="size-11 rounded-2xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center shrink-0 border border-emerald-500/20">
                        <i data-lucide="shield-check" class="size-5"></i>
                    </span>
                    <div>
                        <h4 class="text-sm font-extrabold text-foreground">Fundo de emergência do Lar</h4>
                        <span class="text-xs text-muted-foreground">Poupança Caixa (conta conjunta do casal)</span>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950/60 text-emerald-900 dark:text-emerald-200 text-xs font-black border border-emerald-500/20">
                    50% da meta
                </span>
            </div>

            <div class="space-y-1.5">
                <div class="h-2.5 w-full rounded-full bg-muted overflow-hidden">
                    <div class="h-full bg-emerald-600 rounded-full transition-all duration-700" style="width: 50%"></div>
                </div>
                <div class="flex items-center justify-between text-xs text-muted-foreground pt-0.5">
                    <span class="font-extrabold text-foreground">R$ 5.000,00 de R$ 10.000,00 (cobre 3 meses de Lar)</span>
                    <span class="text-[11px] text-muted-foreground">Último reforço: R$ 250 · 02/06</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 pt-1">
                <button type="button" onclick="abrirModalReforcarFundoEmergencia()" 
                        class="py-3 px-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs flex items-center justify-center gap-2 shadow-soft transition">
                    <i data-lucide="plus" class="size-4"></i>
                    <span>+ Reforçar fundo</span>
                </button>
                <button type="button" onclick="abrirModalSolicitarResgateEmergenciaLar()" 
                        class="py-3 px-4 rounded-2xl border border-amber-300 dark:border-amber-800 bg-amber-50/50 dark:bg-amber-950/20 hover:bg-amber-100 text-amber-950 dark:text-amber-200 font-extrabold text-xs flex items-center justify-center gap-2 shadow-2xs transition">
                    <i data-lucide="shield-alert" class="size-4 text-amber-700 dark:text-amber-400"></i>
                    <span>Usar em emergência (com consenso)</span>
                </button>
            </div>
        </div>

        <!-- SEÇÃO: PRÓXIMOS VENCIMENTOS (CONTAS DO CASAL COM RATEIO EXPLICADO) -->
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 text-xs font-bold text-foreground">
                    <i data-lucide="calendar" class="size-4 text-emerald-600"></i>
                    <span>Próximos vencimentos do Lar</span>
                </div>
                <button type="button" onclick="abrirModalDespesaLar()" class="text-xs text-emerald-700 dark:text-emerald-400 font-extrabold hover:underline">
                    + Lançar conta
                </button>
            </div>

            <div id="larListaProximosVencimentos" class="space-y-2.5">
                <!-- Renderizado dinamicamente via JS com dados do protótipo -->
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- ABA 2: DESPESAS DO LAR (FIXAS, VARIÁVEIS E RATEIOS)                 -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <div id="larConteudoDespesas" class="space-y-5 hidden">
        <!-- Botão Registrar Gasto do Lar -->
        <button type="button" onclick="abrirModalDespesaLar()" 
                class="w-full py-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm flex items-center justify-center gap-2 shadow-soft transition">
            <i data-lucide="plus" class="size-5"></i>
            <span>+ Registrar despesa do Lar (com rateio automático)</span>
        </button>

        <!-- Segmented control: Nova despesa | Emergência -->
        <div class="grid grid-cols-2 gap-2 p-1 rounded-2xl bg-muted/60">
            <button type="button" onclick="abrirModalDespesaLar()" class="py-2.5 px-3 rounded-xl bg-card text-foreground font-extrabold text-xs shadow-2xs flex items-center justify-center gap-2">
                <i data-lucide="receipt" class="size-3.5 text-emerald-600"></i>
                <span>Lançar Nova Despesa</span>
            </button>
            <button type="button" onclick="abrirModalSolicitarResgateEmergenciaLar()" class="py-2.5 px-3 rounded-xl text-amber-900 dark:text-amber-200 font-bold text-xs hover:bg-amber-100/50 flex items-center justify-center gap-2">
                <i data-lucide="shield-alert" class="size-3.5 text-amber-600"></i>
                <span>Emergência / Imprevisto</span>
            </button>
        </div>

        <!-- DÍVIDAS FIXAS DO CASAL -->
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <h4 class="text-xs font-black uppercase tracking-wider text-muted-foreground">Contas e Dívidas Fixas do Casal</h4>
                <span class="text-[11px] text-muted-foreground">Divisão baseada na regra acordada</span>
            </div>
            <div id="larListaDividasFixas" class="space-y-2.5">
                <!-- Itens Fixos: Aluguel, Luz, Internet, Água -->
            </div>
        </div>

        <!-- DÍVIDAS VARIÁVEIS -->
        <div class="space-y-3 pt-2">
            <div class="flex items-center justify-between">
                <h4 class="text-xs font-black uppercase tracking-wider text-muted-foreground">Gastos Variáveis do Dia a Dia</h4>
                <span class="text-[11px] text-muted-foreground">Compras de mercado, feira e conveniência</span>
            </div>
            <div id="larListaDividasVariaveis" class="space-y-2.5">
                <!-- Itens Variáveis: Mercado Dia a Dia, iFood sexta -->
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- ABA 3: METAS DO LAR (COM FOTOS REAIS, PRAZOS EM DIAS E ACELERADOR)   -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <div id="larConteudoMetas" class="space-y-5 hidden">
        <!-- Banner Explicativo das Metas do Lar -->
        <div class="p-4 rounded-3xl bg-emerald-950 text-white border border-emerald-500/30 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-card">
            <div class="flex items-center gap-3">
                <span class="size-11 rounded-2xl bg-emerald-500/20 text-emerald-300 flex items-center justify-center shrink-0 border border-emerald-500/30">
                    <i data-lucide="heart" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-sm font-black text-white">Sonhos & Conquistas para a Nossa Casa</h3>
                    <p class="text-xs text-emerald-200/80">Eletrodomésticos, reformas e viagens planejadas com rateio a dois</p>
                </div>
            </div>
            <button type="button" onclick="abrirModalCriarMeta()" 
                    class="py-2.5 px-4 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs shadow-soft transition flex items-center gap-1.5 shrink-0">
                <i data-lucide="plus" class="size-4"></i>
                <span>+ Nova Meta para o Lar</span>
            </button>
        </div>

        <div id="larListaMetasCards" class="space-y-4">
            <!-- Cards de Metas renderizados com fotos reais, dias de prazo e aceleradores -->
        </div>

        <button type="button" onclick="abrirModalCriarMeta()" 
                class="w-full py-4 rounded-3xl border-2 border-dashed border-border hover:border-emerald-500/50 bg-card hover:bg-emerald-50/10 text-xs font-black text-foreground transition flex items-center justify-center gap-2 shadow-2xs">
            <i data-lucide="plus" class="size-4 text-emerald-600"></i>
            <span>Adicionar Novo Sonho ou Móvel para Nossa Casa</span>
        </button>
    </div>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- ABA 4: MESA DE ACORDOS (NEGOCIAÇÕES, PROPOSTAS E COMBINADOS CLAROS)  -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <div id="larConteudoAcordos" class="space-y-5 hidden">
        <!-- Card Mesa de Acordos Resumo -->
        <div class="rounded-3xl border border-border bg-card p-5 space-y-4 shadow-card">
            <div class="flex items-center gap-3">
                <span class="size-11 rounded-2xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center shrink-0 border border-emerald-500/20">
                    <i data-lucide="scale" class="size-5"></i>
                </span>
                <div>
                    <h4 class="text-sm font-extrabold text-foreground">Mesa de Acordos do Lar</h4>
                    <p class="text-xs text-muted-foreground" id="larAcordosDescCasal">Combinados bilaterais claros e transparentes entre você e o Ian</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 pt-1">
                <div class="rounded-2xl p-3.5 space-y-0.5 shadow-2xs"
                     style="background-color: #ecfdf5 !important; border: 1.5px solid #10b981 !important;">
                    <span class="text-[11px] font-black" style="color: #065f46 !important;">Acordos ativos</span>
                    <strong id="larAcordosAtivosContador" class="text-xl font-black block" style="color: #064e3b !important;">2</strong>
                </div>
                <div class="rounded-2xl p-3.5 space-y-0.5 shadow-2xs"
                     style="background-color: #fef3c7 !important; border: 1.5px solid #f59e0b !important;">
                    <span class="text-[11px] font-black" style="color: #78350f !important;">Em negociação</span>
                    <strong id="larAcordosNegociacaoContador" class="text-xl font-black block" style="color: #451a03 !important;">2</strong>
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
                <span>+ Abrir Mesa de Acordos Completa</span>
            </button>
            <button type="button" onclick="solicitarAcordoParceiro()" 
                    class="w-full py-3.5 rounded-2xl border border-border bg-card text-xs font-bold text-foreground hover:bg-muted transition flex items-center justify-center gap-2 shadow-2xs">
                <i data-lucide="handshake" class="size-4 text-emerald-600"></i>
                <span id="larBtnSolicitarAcordoTexto">Propor novo combinado financeiro ao Ian</span>
            </button>
        </div>
    </div>
</div>
