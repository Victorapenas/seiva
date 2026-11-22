{{-- 
    Modal: Critérios e Cálculo da Saúde Financeira do Lar
    Responsável Acadêmico: Jhon Abner (RF004 / RF010)
    Bordão Oficial: "Onde seu dinheiro cria raízes"
    Explica transparentemente os 4 pilares ponderados que compõem o score do Lar
--}}
<div id="modalSaudeFinanceiraLar" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalSaudeFinanceiraLar')"></div>

    <div class="relative w-full sm:max-w-xl bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center border border-emerald-500/20">
                    <i data-lucide="heart-pulse" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Saúde Financeira do Nosso Lar</h3>
                    <p class="text-xs text-muted-foreground">Entenda os critérios, pesos e a matemática da nota</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalSaudeFinanceiraLar')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <div class="p-6 space-y-5 overflow-y-auto no-scrollbar">
            <!-- Gauge Semicírculo com Score Geral -->
            <div class="flex flex-col sm:flex-row items-center gap-5 p-4 rounded-2xl bg-muted/30 border border-border">
                <div class="relative size-32 shrink-0 flex items-center justify-center">
                    <svg class="size-full -rotate-90" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="40" stroke="#e2e8f0" stroke-width="10" fill="none" class="dark:stroke-slate-800"/>
                        <circle cx="50" cy="50" r="40" stroke="#059669" stroke-width="10" stroke-linecap="round" fill="none" 
                                stroke-dasharray="251.2" stroke-dashoffset="70.3" class="transition-all duration-700"/>
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                        <span class="text-3xl font-black text-foreground tracking-tight">72%</span>
                        <span class="text-[11px] font-extrabold text-emerald-700 dark:text-emerald-400">Saudável</span>
                    </div>
                </div>

                <div class="space-y-1 text-center sm:text-left">
                    <h4 class="text-sm font-extrabold text-foreground">Como o SEIVA mede a saúde do Lar?</h4>
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        O score do casal não é um número arbitrário: ele resulta de uma <strong>média ponderada de 4 pilares essenciais</strong> que medem o risco de endividamento, a reserva conjunta e a harmonia no rateio mensal.
                    </p>
                </div>
            </div>

            <!-- OS 4 PILARES DA SAÚDE FINANCEIRA -->
            <div class="space-y-3">
                <span class="text-xs font-black uppercase tracking-wider text-muted-foreground block">
                    Parâmetros e Pesos Oficiais
                </span>

                <!-- Pilar 1: Comprometimento de Renda Fixa -->
                <div class="p-4 rounded-2xl border border-emerald-500/30 bg-emerald-50/50 dark:bg-emerald-950/20 space-y-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="size-6 rounded-lg bg-emerald-600 text-white flex items-center justify-center text-[10px] font-black">
                                35%
                            </span>
                            <h5 class="text-xs font-extrabold text-foreground">1. Comprometimento da Renda com Gastos Fixos</h5>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-900/60 dark:text-emerald-300 text-[11px] font-black">
                            90 / 100 · Excelente
                        </span>
                    </div>
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        Os custos fixos essenciais do Lar somam <strong>R$ 1.667,90</strong>, o que representa <strong>40%</strong> da renda conjunta (R$ 4.200,00). 
                        A recomendação SEIVA é não ultrapassar 50% para garantir folga para lazer e investimentos.
                    </p>
                </div>

                <!-- Pilar 2: Reserva do Fundo de Emergência -->
                <div class="p-4 rounded-2xl border border-amber-500/30 bg-amber-50/50 dark:bg-amber-950/20 space-y-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="size-6 rounded-lg bg-amber-600 text-white flex items-center justify-center text-[10px] font-black">
                                30%
                            </span>
                            <h5 class="text-xs font-extrabold text-foreground">2. Reserva do Fundo de Emergência do Lar</h5>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-900 dark:bg-amber-900/60 dark:text-amber-300 text-[11px] font-black">
                            65 / 100 · Em Construção
                        </span>
                    </div>
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        O casal acumulou <strong>R$ 5.000,00</strong> na conta conjunta (50% da meta de R$ 10.000,00). 
                        Esse montante já cobre exatamente <strong>3 meses de despesas básicas</strong>. A pontuação subirá para 100 conforme a reserva atingir 6 meses.
                    </p>
                </div>

                <!-- Pilar 3: Equilíbrio de Contribuição Mensal -->
                <div class="p-4 rounded-2xl border border-amber-500/30 bg-amber-50/50 dark:bg-amber-950/20 space-y-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="size-6 rounded-lg bg-amber-600 text-white flex items-center justify-center text-[10px] font-black">
                                20%
                            </span>
                            <h5 class="text-xs font-extrabold text-foreground">3. Cumprimento do Rateio Acordado no Mês</h5>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-900 dark:bg-amber-900/60 dark:text-amber-300 text-[11px] font-black">
                            60 / 100 · Parcial
                        </span>
                    </div>
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        Ian já quitou <strong>100%</strong> de sua cota do mês (R$ 1.187,90). Maria Eduarda contribuiu com <strong>53%</strong> (R$ 255,00 de R$ 480,00). 
                        Faltam <strong>R$ 225,00</strong> para fechar as contas do cantinho com 100% de equilíbrio.
                    </p>
                </div>

                <!-- Pilar 4: Pontualidade de Vencimentos -->
                <div class="p-4 rounded-2xl border border-emerald-500/30 bg-emerald-50/50 dark:bg-emerald-950/20 space-y-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="size-6 rounded-lg bg-emerald-600 text-white flex items-center justify-center text-[10px] font-black">
                                15%
                            </span>
                            <h5 class="text-xs font-extrabold text-foreground">4. Pontualidade de Contas e Acordos</h5>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-900/60 dark:text-emerald-300 text-[11px] font-black">
                            100 / 100 · Em Dia
                        </span>
                    </div>
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        Nenhuma conta em atraso crítico. O aluguel e a água já foram liquidados pontualmente, mantendo a credibilidade e harmonia da casa.
                    </p>
                </div>
            </div>

            <!-- DICA DO SEIVA PARA SUBIR A NOTA -->
            <div class="p-4 rounded-2xl bg-emerald-900 text-white space-y-2">
                <div class="flex items-center gap-2">
                    <i data-lucide="sparkles" class="size-4 text-emerald-300"></i>
                    <strong class="text-xs font-black text-white">Como alcançar o score de 85%+ (Excelente)?</strong>
                </div>
                <p class="text-xs text-emerald-100/90 leading-relaxed">
                    Basta a Duda registrar o aporte dos <strong>R$ 225,00 restantes</strong> e o casal realizar um reforço de <strong>R$ 250,00</strong> no Fundo de Emergência. Com isso, o score do Lar sobe imediatamente para <strong>86%</strong>!
                </p>
            </div>

            <!-- Botão Fechar -->
            <div class="pt-1">
                <button type="button" onclick="fecharModalId('modalSaudeFinanceiraLar')" 
                        class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs shadow-soft transition">
                    Entendi os Critérios
                </button>
            </div>
        </div>
    </div>
</div>
