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

        <!-- Header -->
        <div class="px-6 pt-3 pb-3 border-b border-border/60 flex items-center justify-between">
            <h3 class="text-base font-extrabold text-foreground">Sua saúde financeira</h3>
            <button type="button" onclick="fecharModalId('modalSaudeFinanceira')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <div class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Gauge Semicírculo -->
            <div class="flex flex-col items-center justify-center py-2">
                <div class="relative size-36 sm:size-40 flex items-center justify-center">
                    <svg class="size-full -rotate-90" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="40" stroke="#f1f5f9" stroke-width="10" fill="none" class="dark:stroke-slate-800"/>
                        <circle id="modalSaudeCircleProgress" cx="50" cy="50" r="40" stroke="#f59e0b" stroke-width="10" stroke-linecap="round" fill="none" stroke-dasharray="251.2" stroke-dashoffset="105" class="transition-all duration-700"/>
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                        <span id="modalSaudeScoreTxt" class="text-3xl font-black text-foreground tracking-tight">58%</span>
                        <span id="modalSaudeStatusTxt" class="text-xs font-bold text-amber-600">Atenção</span>
                    </div>
                </div>
            </div>

            <!-- Banner Explicativo -->
            <div class="p-3.5 rounded-2xl bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200/60 dark:border-emerald-800/40 text-xs font-semibold text-emerald-900 dark:text-emerald-200 text-center">
                <span id="modalSaudeNotaTxt">Seu score é 58% — atenção ao equilíbrio. Veja o que compõe essa nota:</span>
            </div>

            <!-- 3 Cards Detalhados dos Pilares -->
            <div class="space-y-3 pt-1">
                <!-- Pilar 1: Compromissos fixos vs. renda -->
                <div class="rounded-2xl border border-border bg-card p-4 shadow-2xs space-y-2">
                    <div class="flex items-center gap-2 text-xs font-bold text-foreground">
                        <span id="modalSaudeIconeComp" class="text-amber-500 font-extrabold text-sm">⚠️</span>
                        <span>Compromissos fixos vs. renda</span>
                    </div>
                    <p id="modalSaudePilar1Titulo" class="text-xs font-extrabold text-foreground">
                        81% da sua renda já tem destino (R$ 1.370 de R$ 1.700).
                    </p>
                    <p id="modalSaudePilar1Desc" class="text-[11px] text-muted-foreground leading-relaxed flex items-start gap-1.5">
                        <i data-lucide="info" class="size-3 text-muted-foreground shrink-0 mt-0.5"></i>
                        <span>Fatura do Nubank + despesas somam a maior parte da renda. Acima de 70% sobra pouca folga — vale rever os gastos variáveis para abrir espaço.</span>
                    </p>
                </div>

                <!-- Pilar 2: Reserva de emergência -->
                <div class="rounded-2xl border border-border bg-card p-4 shadow-2xs space-y-2">
                    <div class="flex items-center gap-2 text-xs font-bold text-foreground">
                        <span id="modalSaudeIconeReserva" class="text-amber-500 font-extrabold text-sm">⚠️</span>
                        <span>Reserva de emergência</span>
                    </div>
                    <p id="modalSaudePilar2Titulo" class="text-xs font-extrabold text-foreground">
                        Reserva em 41% da meta (R$ 2.100 de R$ 5.100).
                    </p>
                    <p id="modalSaudePilar2Desc" class="text-[11px] text-muted-foreground leading-relaxed flex items-start gap-1.5">
                        <i data-lucide="info" class="size-3 text-muted-foreground shrink-0 mt-0.5"></i>
                        <span>O ideal é ter 3x a sua renda guardada. Você já tem um valor inicial na poupança — continue contribuindo aos poucos.</span>
                    </p>
                </div>

                <!-- Pilar 3: Gastos do dia a dia -->
                <div class="rounded-2xl border border-border bg-card p-4 shadow-2xs space-y-2">
                    <div class="flex items-center gap-2 text-xs font-bold text-foreground">
                        <span id="modalSaudeIconeGastos" class="text-emerald-600 font-extrabold text-sm">✅</span>
                        <span>Gastos do dia a dia</span>
                    </div>
                    <p id="modalSaudePilar3Titulo" class="text-xs font-extrabold text-foreground">
                        Gastos do mês menores que sua renda.
                    </p>
                    <p id="modalSaudePilar3Desc" class="text-[11px] text-muted-foreground leading-relaxed flex items-start gap-1.5">
                        <i data-lucide="info" class="size-3 text-muted-foreground shrink-0 mt-0.5"></i>
                        <span>Você gastou menos do que entrou no mês, mantendo sobra livre. Registrar cada gasto ajuda a manter esse equilíbrio.</span>
                    </p>
                </div>
            </div>

            <!-- Botão Fechar -->
            <div class="pt-2">
                <button type="button" onclick="fecharModalId('modalSaudeFinanceira')" class="w-full py-3 rounded-2xl bg-muted hover:bg-muted/80 text-foreground font-bold text-xs transition">
                    Fechar análise
                </button>
            </div>
        </div>
    </div>
</div>