{{-- 
    Modal: Quitar Despesa Fixa Individual (Caixa Preta / Controle Pessoal)
    Responsáveis Acadêmicos: Victor Hugo (RF002 / RF003)
    Bordão Oficial: "Onde seu dinheiro cria raízes"
    Permite debitar o pagamento de uma conta bancária com lançamento no extrato e auditoria.
--}}
<div id="modalQuitarDespesaIndividual" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalQuitarDespesaIndividual')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300 flex items-center justify-center border border-emerald-500/20 shadow-2xs">
                    <i data-lucide="check-circle-2" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Quitar Despesa Fixa</h3>
                    <p class="text-xs text-muted-foreground">Confirmar pagamento e registrar no extrato</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalQuitarDespesaIndividual')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarConfirmarQuitacaoDespesaIndiv(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <input type="hidden" id="quitarDespIndivId" value="">

            <!-- Resumo da Despesa -->
            <div class="p-4 rounded-2xl border border-border bg-muted/30 space-y-1 text-center">
                <span class="text-xs text-muted-foreground font-semibold block" id="quitarDespIndivTitulo">Faculdade</span>
                <strong class="text-2xl font-black text-foreground block" id="quitarDespIndivValor">R$ 450,00</strong>
                <span class="text-[11px] text-muted-foreground block" id="quitarDespIndivVenc">Vencimento dia 10</span>
            </div>

            <!-- Seleção de Conta de Saída -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-foreground block">De onde saiu o dinheiro?</label>
                <div id="quitarDespChipsContas" class="flex flex-wrap gap-2">
                    <!-- Injetado dinamicamente via JS com as contas bancárias do usuário -->
                </div>
                <input type="hidden" id="quitarDespContaId" value="">
            </div>

            <!-- Botões de Ação -->
            <div class="pt-2 flex flex-col sm:flex-row gap-2">
                <button type="submit" class="flex-1 py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs transition shadow-soft flex items-center justify-center gap-2 cursor-pointer">
                    <i data-lucide="check-check" class="size-4"></i>
                    <span id="btnConfirmarQuitarTexto">Confirmar Pagamento</span>
                </button>
                <button type="button" onclick="fecharModalId('modalQuitarDespesaIndividual')" class="py-3.5 px-4 rounded-2xl border border-border bg-card hover:bg-muted text-foreground font-bold text-xs transition shadow-2xs">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>
