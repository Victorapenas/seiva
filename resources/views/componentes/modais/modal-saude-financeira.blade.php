{{-- 
    Modal: Sua Saúde Financeira (Protótipo Imagem 4)
    Exibe a análise profunda com o Score, os 3 pilares detalhados e recomendações
--}}
<div id="modalSaudeFinanceira" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="fecharModalId('modalSaudeFinanceira')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header com Abas: Individual vs Casal / Lar -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="size-8 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center border border-emerald-500/20">
                        <i data-lucide="heart-pulse" class="size-4.5"></i>
                    </span>
                    <h3 id="modalSaudeHeaderTitulo" class="text-base font-extrabold text-foreground">Sua saúde financeira</h3>
                </div>
                <button type="button" onclick="fecharModalId('modalSaudeFinanceira')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                    <i data-lucide="x" class="size-4"></i>
                </button>
            </div>

            <!-- Seletor de Visão: Individual vs Casal / Lar -->
            <div id="modalSaudeToggleAbas" class="grid grid-cols-2 p-1 rounded-2xl bg-muted/60 border border-border/60 gap-1 shadow-2xs">
                <button type="button" id="modalSaudeBtnIndiv" onclick="alternarAbaModalSaude('individual')"
                        class="py-2 px-3 rounded-xl text-xs font-bold transition shadow-2xs bg-card text-foreground flex items-center justify-center gap-1.5 cursor-pointer">
                    <i data-lucide="user" class="size-3.5 text-emerald-600"></i>
                    <span>Individual (Você)</span>
                </button>
                <button type="button" id="modalSaudeBtnLar" onclick="alternarAbaModalSaude('lar')"
                        class="py-2 px-3 rounded-xl text-xs font-bold transition text-muted-foreground hover:text-foreground flex items-center justify-center gap-1.5 cursor-pointer">
                    <i data-lucide="home" class="size-3.5 text-muted-foreground"></i>
                    <span>Casal / Lar</span>
                </button>
            </div>
        </div>

        <div class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Gauge Semicírculo -->
            <div class="flex flex-col items-center justify-center py-2">
                <div class="relative size-36 sm:size-40 flex items-center justify-center">
                    <svg class="size-full -rotate-90" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="40" stroke="#f1f5f9" stroke-width="10" fill="none" class="dark:stroke-slate-800"/>
                        <circle id="modalSaudeCircleProgress" cx="50" cy="50" r="40" stroke="#10b981" stroke-width="10" stroke-linecap="round" fill="none" stroke-dasharray="251.2" stroke-dashoffset="38" class="transition-all duration-700"/>
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                        <span id="modalSaudeScoreTxt" class="text-3xl font-black text-foreground tracking-tight">85%</span>
                        <span id="modalSaudeStatusTxt" class="text-xs font-bold text-emerald-600">Excelente</span>
                    </div>
                </div>
            </div>

            <!-- Banner Explicativo com Alto Contraste (WCAG AAA Garantido - Sem Texto Apagado) -->
            <div id="modalSaudeBannerBox" class="p-3.5 rounded-2xl border border-emerald-300/80 bg-emerald-50 dark:bg-emerald-950/50 text-emerald-950 dark:text-emerald-100 text-xs font-extrabold text-center shadow-2xs transition-colors">
                <span id="modalSaudeNotaTxt" class="block leading-relaxed">
                    Seu score é 85% — excelente ao equilíbrio. Veja o que compõe essa nota:
                </span>
            </div>

            <!-- 3 Cards Detalhados dos Pilares (Sem Emojis, com Ícones Lucide SVG de Alto Contraste) -->
            <div class="space-y-3 pt-1">
                <!-- Pilar 1: Compromissos fixos vs. renda -->
                <div class="rounded-2xl border border-border bg-card p-4 shadow-2xs space-y-2">
                    <div class="flex items-center gap-2 text-xs font-bold text-foreground">
                        <span id="modalSaudeIconeComp" class="size-6 rounded-lg flex items-center justify-center shrink-0 border bg-amber-50 dark:bg-amber-950/50 text-amber-700 dark:text-amber-300 border-amber-300/80">
                            <i data-lucide="alert-triangle" class="size-3.5"></i>
                        </span>
                        <span id="modalSaudePilar1Nome" class="font-extrabold text-foreground">Compromissos fixos vs. renda</span>
                    </div>
                    <p id="modalSaudePilar1Titulo" class="text-xs font-extrabold text-foreground">
                        58% da sua renda já tem destino (R$ 2.990,00 de R$ 5.200,00).
                    </p>
                    <p id="modalSaudePilar1Desc" class="text-[11px] text-muted-foreground leading-relaxed flex items-start gap-1.5">
                        <i data-lucide="info" class="size-3 text-muted-foreground shrink-0 mt-0.5"></i>
                        <span id="modalSaudePilar1DescTxt">Fatura do cartão + despesas somam parte importante da renda. Acima de 70% sobra pouca folga — vale rever os gastos variáveis para abrir espaço.</span>
                    </p>
                </div>

                <!-- Pilar 2: Reserva de emergência -->
                <div class="rounded-2xl border border-border bg-card p-4 shadow-2xs space-y-2">
                    <div class="flex items-center gap-2 text-xs font-bold text-foreground">
                        <span id="modalSaudeIconeReserva" class="size-6 rounded-lg flex items-center justify-center shrink-0 border bg-amber-50 dark:bg-amber-950/50 text-amber-700 dark:text-amber-300 border-amber-300/80">
                            <i data-lucide="alert-triangle" class="size-3.5"></i>
                        </span>
                        <span id="modalSaudePilar2Nome" class="font-extrabold text-foreground">Reserva de emergência</span>
                    </div>
                    <p id="modalSaudePilar2Titulo" class="text-xs font-extrabold text-foreground">
                        Reserva em 66% da meta (R$ 2.100,00 de R$ 3.200,00).
                    </p>
                    <p id="modalSaudePilar2Desc" class="text-[11px] text-muted-foreground leading-relaxed flex items-start gap-1.5">
                        <i data-lucide="info" class="size-3 text-muted-foreground shrink-0 mt-0.5"></i>
                        <span id="modalSaudePilar2DescTxt">O ideal é ter pelo menos 3x a sua renda guardada. Continue contribuindo aos poucos para cobrir imprevistos com segurança.</span>
                    </p>
                </div>

                <!-- Pilar 3: Gastos do dia a dia / Rateio -->
                <div class="rounded-2xl border border-border bg-card p-4 shadow-2xs space-y-2">
                    <div class="flex items-center gap-2 text-xs font-bold text-foreground">
                        <span id="modalSaudeIconeGastos" class="size-6 rounded-lg flex items-center justify-center shrink-0 border bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-300 border-emerald-300/80">
                            <i data-lucide="check-circle-2" class="size-3.5"></i>
                        </span>
                        <span id="modalSaudePilar3Nome" class="font-extrabold text-foreground">Gastos do dia a dia</span>
                    </div>
                    <p id="modalSaudePilar3Titulo" class="text-xs font-extrabold text-foreground">
                        Gastos do mês menores que sua renda.
                    </p>
                    <p id="modalSaudePilar3Desc" class="text-[11px] text-muted-foreground leading-relaxed flex items-start gap-1.5">
                        <i data-lucide="info" class="size-3 text-muted-foreground shrink-0 mt-0.5"></i>
                        <span id="modalSaudePilar3DescTxt">Você gastou menos do que entrou no mês, mantendo sobra livre. Registrar cada gasto ajuda a manter esse equilíbrio.</span>
                    </p>
                </div>
            </div>

            <!-- Link para Análise Metodológica Completa do Lar (quando em modo Lar) -->
            <div id="modalSaudeLinkMetodologiaLar" class="hidden text-center pt-1">
                <button type="button" onclick="fecharModalId('modalSaudeFinanceira'); abrirModalId('modalSaudeFinanceiraLar');"
                        class="text-xs font-bold text-emerald-700 dark:text-emerald-400 hover:underline inline-flex items-center gap-1">
                    <span>Ver os 4 critérios detalhados com pesos e fórmula do Lar</span>
                    <i data-lucide="arrow-right" class="size-3.5"></i>
                </button>
            </div>

            <!-- Botão Fechar -->
            <div class="pt-2">
                <button type="button" onclick="fecharModalId('modalSaudeFinanceira')" class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs shadow-soft transition">
                    Fechar análise
                </button>
            </div>
        </div>
    </div>
</div>