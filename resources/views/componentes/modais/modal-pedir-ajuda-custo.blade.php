{{-- 
    Modal: Pedir ajuda de custo para parceiro (Protótipo Imagens 8 e 13)
    Permite solicitar divisão total ou parcial de uma despesa do Lar ou pessoal com o parceiro
--}}
<div id="modalPedirAjudaCusto" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="fecharModalId('modalPedirAjudaCusto')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h3 id="modalAjudaHeaderTitulo" class="text-base font-extrabold text-foreground">Pedir ajuda de custo para Ian</h3>
                    <p class="text-xs text-muted-foreground mt-0.5">Divida uma despesa do Lar — total ou em parte</p>
                </div>
                <button type="button" onclick="fecharModalId('modalPedirAjudaCusto')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                    <i data-lucide="x" class="size-4"></i>
                </button>
            </div>

            <!-- Stepper em 4 tracinhos (Protótipo Imagens 8 e 13) -->
            <div class="flex items-center gap-1.5 pt-3">
                <div class="h-1 flex-1 rounded-full bg-emerald-600"></div>
                <div class="h-1 flex-1 rounded-full bg-muted"></div>
                <div class="h-1 flex-1 rounded-full bg-muted"></div>
                <div class="h-1 flex-1 rounded-full bg-muted"></div>
            </div>
        </div>

        <form onsubmit="executarEnvioPedidoAjuda(event)" class="p-6 space-y-5 overflow-y-auto no-scrollbar">
            <!-- Card Resumo da Despesa -->
            <div class="flex items-center gap-3.5 p-4 rounded-3xl bg-emerald-50/50 dark:bg-emerald-950/20 border border-emerald-200/60 dark:border-emerald-800/40">
                <span class="size-11 rounded-2xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300 flex items-center justify-center shrink-0">
                    <i id="modalAjudaItemIcone" data-lucide="shopping-cart" class="size-5"></i>
                </span>
                <div class="min-w-0">
                    <h4 id="modalAjudaItemTitulo" class="text-xs sm:text-sm font-extrabold text-foreground truncate">Mercado Dia a Dia</h4>
                    <p id="modalAjudaItemSub" class="text-xs text-muted-foreground mt-0.5">R$ 312,80 · pago por você</p>
                </div>
            </div>

            <!-- Seletor de Valor da Ajuda -->
            <div class="space-y-2.5">
                <label class="text-xs font-bold text-foreground block">Quanto você quer pedir de ajuda?</label>

                <!-- Opção 1: Metade (Sugestão) -->
                <button type="button" id="btnAjudaOpcaoMetade" onclick="selecionarOpcaoAjuda('metade')" 
                        class="opcao-ajuda-chip active w-full flex items-center justify-between p-3.5 rounded-2xl border-2 border-emerald-600 bg-emerald-50/50 dark:bg-emerald-950/30 text-foreground transition text-left">
                    <span id="labelAjudaMetadeTexto" class="text-xs font-extrabold">Metade — R$ 156,40</span>
                    <span class="px-2 py-0.5 rounded-md bg-emerald-200/60 text-emerald-800 text-[10px] font-black uppercase">Sugestão</span>
                </button>

                <!-- Opção 2: Valor Total -->
                <button type="button" id="btnAjudaOpcaoTotal" onclick="selecionarOpcaoAjuda('total')" 
                        class="opcao-ajuda-chip w-full flex items-center justify-between p-3.5 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/30 transition text-left">
                    <span id="labelAjudaTotalTexto" class="text-xs font-extrabold">Valor total — R$ 312,80</span>
                </button>

                <!-- Opção 3: Outro Valor -->
                <button type="button" id="btnAjudaOpcaoOutro" onclick="selecionarOpcaoAjuda('outro')" 
                        class="opcao-ajuda-chip w-full flex items-center justify-between p-3.5 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/30 transition text-left">
                    <span class="text-xs font-extrabold">Outro valor</span>
                </button>

                <!-- Input Customizado de Outro Valor -->
                <div id="containerAjudaOutroValor" class="hidden pt-1">
                    <div class="relative flex items-center rounded-2xl border-2 border-emerald-600 bg-background px-4 py-2.5 shadow-2xs">
                        <span class="text-xs font-black text-muted-foreground select-none pr-2">R$</span>
                        <input type="text" id="ajudaInputOutroValor" inputmode="decimal" class="w-full bg-transparent text-sm font-extrabold text-foreground focus:outline-none" placeholder="0,00" oninput="aoDigitarOutroValorAjuda(this.value)">
                    </div>
                </div>

                <input type="hidden" id="ajudaValorFinal" value="156.40">
                <input type="hidden" id="ajudaTituloDespesa" value="Mercado Dia a Dia">
            </div>

            <!-- Botão Continuar -->
            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm transition shadow-soft flex items-center justify-center gap-2">
                    <span>Continuar</span>
                </button>
            </div>
        </form>
    </div>
</div>
