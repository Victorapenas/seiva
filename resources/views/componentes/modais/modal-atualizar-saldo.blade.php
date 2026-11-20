{{-- 
    Modal: Atualizar Saldo (Protótipo Imagem 3)
    Permite conferir e sincronizar o saldo real de qualquer conta e fazer ajustes rápidos (+Pix, +Achei, -Espécie)
--}}
<div id="modalAtualizarSaldo" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="fecharModalId('modalAtualizarSaldo')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60 flex items-start justify-between gap-3">
            <div>
                <h3 class="text-base font-extrabold text-foreground">Atualizar saldo</h3>
                <p class="text-xs text-muted-foreground mt-0.5">Confira no app da conta e registre o valor real</p>
            </div>
            <button type="button" onclick="fecharModalId('modalAtualizarSaldo')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <div class="p-6 space-y-5 overflow-y-auto no-scrollbar">
            <!-- Seleção de Conta -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-foreground">Qual conta?</label>
                <div id="modalSaldoChipsContas" class="flex flex-wrap gap-2">
                    <!-- Preenchido via JS com as contas reais -->
                </div>
            </div>

            <!-- Campo de Saldo Atual -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Qual é o saldo atual?</label>
                <div class="relative flex items-center rounded-2xl border-2 border-emerald-600/60 bg-background px-4 py-3 shadow-2xs focus-within:border-emerald-600 focus-within:ring-2 focus-within:ring-emerald-500/20 transition">
                    <span class="text-base font-black text-muted-foreground select-none pr-2">R$</span>
                    <input type="text" id="modalSaldoInputValor" inputmode="decimal" class="w-full bg-transparent text-xl sm:text-2xl font-black text-foreground focus:outline-none tracking-tight" placeholder="0,00">
                </div>
                <p id="modalSaldoRegistradoTexto" class="text-[11px] text-muted-foreground pt-0.5">Saldo registrado: R$ 0,00</p>
            </div>

            <!-- Ajuste Rápido -->
            <div class="space-y-2">
                <label class="text-xs font-semibold text-muted-foreground">Ou faça um ajuste rápido</label>
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" onclick="aplicarAjusteRapidoSaldo(10, 'Recebi um Pix')" class="flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-muted/30 hover:bg-emerald-50 hover:border-emerald-300 dark:hover:bg-emerald-950/30 transition text-center group">
                        <span class="size-7 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center mb-1 group-hover:scale-110 transition">
                            <i data-lucide="trending-up" class="size-3.5"></i>
                        </span>
                        <span class="text-[11px] font-bold text-foreground">Recebi um Pix</span>
                        <span class="text-[10px] font-extrabold text-emerald-600">+ R$ 10,00</span>
                    </button>
                    <button type="button" onclick="aplicarAjusteRapidoSaldo(5, 'Achei dinheiro')" class="flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-muted/30 hover:bg-emerald-50 hover:border-emerald-300 dark:hover:bg-emerald-950/30 transition text-center group">
                        <span class="size-7 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center mb-1 group-hover:scale-110 transition">
                            <i data-lucide="banknote" class="size-3.5"></i>
                        </span>
                        <span class="text-[11px] font-bold text-foreground">Achei dinheiro</span>
                        <span class="text-[10px] font-extrabold text-emerald-600">+ R$ 5,00</span>
                    </button>
                    <button type="button" onclick="aplicarAjusteRapidoSaldo(-20, 'Gastei em espécie')" class="flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-muted/30 hover:bg-rose-50 hover:border-rose-300 dark:hover:bg-rose-950/30 transition text-center group">
                        <span class="size-7 rounded-xl bg-rose-100 text-rose-800 flex items-center justify-center mb-1 group-hover:scale-110 transition">
                            <i data-lucide="trending-down" class="size-3.5"></i>
                        </span>
                        <span class="text-[11px] font-bold text-foreground">Gastei espécie</span>
                        <span class="text-[10px] font-extrabold text-rose-600">- R$ 20,00</span>
                    </button>
                </div>
            </div>

            <!-- Botão Salvar -->
            <div class="pt-2">
                <button type="button" id="modalSaldoBtnSalvar" onclick="salvarNovoSaldoConta()" class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm transition shadow-soft flex items-center justify-center gap-2">
                    <i data-lucide="refresh-cw" class="size-4"></i>
                    <span id="modalSaldoBtnSalvarTexto">Salvar saldo da conta</span>
                </button>
            </div>
        </div>
    </div>
</div>