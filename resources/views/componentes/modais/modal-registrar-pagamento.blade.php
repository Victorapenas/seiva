{{-- 
    Modal: Registrar Pagamento (Protótipo Imagem 6)
    Permite confirmar o pagamento de faturas ou contas pendentes escolhendo a conta de saída e comprovante
--}}
<div id="modalRegistrarPagamento" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="fecharModalId('modalRegistrarPagamento')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60 flex items-start justify-between gap-3">
            <div>
                <h3 class="text-base font-extrabold text-foreground">Registrar pagamento</h3>
                <p id="modalPagSubtitulo" class="text-xs text-muted-foreground mt-0.5">Cartão de crédito · pessoal</p>
            </div>
            <button type="button" onclick="fecharModalId('modalRegistrarPagamento')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <div class="p-6 space-y-5 overflow-y-auto no-scrollbar">
            <!-- Card Resumo da Pendência -->
            <div class="rounded-2xl border border-border bg-muted/30 p-4 space-y-2">
                <h4 id="modalPagItemTitulo" class="text-sm font-extrabold text-foreground">Fatura Nubank Duda</h4>
                <div>
                    <span class="text-[11px] text-muted-foreground block">Valor desta parcela</span>
                    <strong id="modalPagItemValor" class="text-2xl font-black text-foreground tracking-tight">R$ 890,00</strong>
                </div>
                <div class="h-1.5 w-full rounded-full bg-muted overflow-hidden">
                    <div id="modalPagItemBarra" class="h-full bg-emerald-600 rounded-full" style="width: 0%"></div>
                </div>
                <p id="modalPagItemProgresso" class="text-[11px] text-muted-foreground">Já guardado: R$ 0,00 · faltam R$ 890,00</p>
            </div>

            <!-- Seleção de Conta de Saída -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-foreground block">Esse dinheiro saiu de qual conta?</label>
                <p class="text-[11px] text-muted-foreground">O SEIVA só registra — o valor será descontado da conta escolhida.</p>
                <div id="modalPagChipsContas" class="flex flex-wrap gap-2 pt-1">
                    <!-- Preenchido via JS com as contas cadastradas -->
                </div>
            </div>

            <!-- Banner Verde de Conclusão -->
            <div id="modalPagBannerSucesso" class="p-3.5 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200/60 dark:border-emerald-800/40 text-xs font-bold text-emerald-800 dark:text-emerald-300 flex items-center gap-2">
                <i data-lucide="check-circle" class="size-4 text-emerald-600 shrink-0"></i>
                <span id="modalPagBannerTexto">Com este valor você quita o acordo ou fatura!</span>
            </div>

            <!-- Comprovante (opcional) -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-foreground flex items-center gap-1.5">
                    <i data-lucide="receipt" class="size-3.5 text-primary"></i>
                    <span>Comprovante (opcional, mas recomendado)</span>
                </label>
                <label class="flex flex-col items-center justify-center p-4 rounded-2xl border-2 border-dashed border-border hover:border-emerald-500/50 bg-muted/20 hover:bg-emerald-50/20 dark:hover:bg-emerald-950/20 transition cursor-pointer text-center group">
                    <span class="size-9 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center mb-1.5 group-hover:scale-110 transition">
                        <i data-lucide="image" class="size-4"></i>
                    </span>
                    <span id="modalPagFotoTexto" class="text-xs font-bold text-foreground">Adicionar foto</span>
                    <span class="text-[11px] text-muted-foreground mt-0.5">Anexe o print do Pix ou o recibo para comprovar</span>
                    <input type="file" id="modalPagInputFile" accept="image/*" class="hidden" onchange="previewComprovantePagamento(this)">
                </label>
            </div>

            <!-- Botão CTA Principal -->
            <div class="pt-1">
                <button type="button" id="modalPagBtnConfirmar" onclick="executarConfirmacaoPagamento()" class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm transition shadow-soft flex items-center justify-center gap-2">
                    <i data-lucide="check" class="size-4"></i>
                    <span id="modalPagBtnConfirmarTexto">Confirmar que paguei</span>
                </button>
            </div>
        </div>
    </div>
</div>