{{-- 
    Modal: Lançar Gasto (Protótipo Oficial Imagens 3 e 4)
    Design ágil, intuitivo, 100% orientado a ícones Lucide, sem nenhum uso de emojis.
--}}
<div id="modalLancarGasto" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/45 backdrop-blur-xs" onclick="fecharModalId('modalLancarGasto')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.22s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/50 flex items-start justify-between gap-3">
            <div>
                <h3 class="text-base font-extrabold text-foreground">Lançar gasto</h3>
                <p class="text-xs text-muted-foreground mt-0.5">Registre uma saída rapidinho</p>
            </div>
            <button type="button" onclick="fecharModalId('modalLancarGasto')" class="size-8 rounded-xl border border-border bg-muted/30 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarGastoRapido(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Campo de Valor em Destaque -->
            <div class="relative flex items-center rounded-2xl border-2 border-emerald-700/60 bg-background px-4 py-3 shadow-2xs focus-within:border-emerald-700 focus-within:ring-2 focus-within:ring-emerald-700/20 transition">
                <span class="text-lg font-black text-foreground select-none pr-2">R$</span>
                <input type="text" id="gastoInputValor" inputmode="decimal" required 
                       class="w-full bg-transparent text-2xl sm:text-3xl font-black text-foreground focus:outline-none tracking-tight" placeholder="0,00">
            </div>

            <!-- Campo Descrição: O que foi? -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">O que foi?</label>
                <input type="text" id="gastoInputTitulo" required 
                       class="w-full rounded-2xl border border-border bg-background px-4 py-3 text-xs text-foreground placeholder:text-muted-foreground focus:border-emerald-700 focus:outline-none shadow-2xs transition" 
                       placeholder="Ex: Mercado Dia a Dia">
            </div>

            <!-- Categoria: Grid de 8 Botões com Ícones (Protótipo Imagens 3 e 4) -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-foreground">Categoria</label>
                <div id="gastoGridCategorias" class="grid grid-cols-4 gap-2">
                    <!-- 1. Moradia (ativo por padrão) -->
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Moradia', 'home')" 
                            class="cat-chip active flex flex-col items-center justify-center p-3 rounded-2xl border-2 border-emerald-800 bg-emerald-800 text-white font-bold text-xs transition shadow-2xs">
                        <i data-lucide="home" class="size-5 mb-1.5 stroke-[2.2]"></i>
                        <span>Moradia</span>
                    </button>
                    <!-- 2. Alimentação -->
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Alimentação', 'utensils')" 
                            class="cat-chip flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/40 font-bold text-xs transition shadow-2xs">
                        <i data-lucide="utensils" class="size-5 mb-1.5 stroke-[2]"></i>
                        <span>Alimentação</span>
                    </button>
                    <!-- 3. Transporte -->
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Transporte', 'car')" 
                            class="cat-chip flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/40 font-bold text-xs transition shadow-2xs">
                        <i data-lucide="car" class="size-5 mb-1.5 stroke-[2]"></i>
                        <span>Transporte</span>
                    </button>
                    <!-- 4. Saúde -->
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Saúde', 'pill')" 
                            class="cat-chip flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/40 font-bold text-xs transition shadow-2xs">
                        <i data-lucide="pill" class="size-5 mb-1.5 stroke-[2]"></i>
                        <span>Saúde</span>
                    </button>
                    <!-- 5. Lazer -->
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Lazer', 'film')" 
                            class="cat-chip flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/40 font-bold text-xs transition shadow-2xs">
                        <i data-lucide="film" class="size-5 mb-1.5 stroke-[2]"></i>
                        <span>Lazer</span>
                    </button>
                    <!-- 6. Mercado -->
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Mercado', 'shopping-cart')" 
                            class="cat-chip flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/40 font-bold text-xs transition shadow-2xs">
                        <i data-lucide="shopping-cart" class="size-5 mb-1.5 stroke-[2]"></i>
                        <span>Mercado</span>
                    </button>
                    <!-- 7. Beleza -->
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Beleza', 'sparkles')" 
                            class="cat-chip flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/40 font-bold text-xs transition shadow-2xs">
                        <i data-lucide="sparkles" class="size-5 mb-1.5 stroke-[2]"></i>
                        <span>Beleza</span>
                    </button>
                    <!-- 8. Presente -->
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Presente', 'gift')" 
                            class="cat-chip flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/40 font-bold text-xs transition shadow-2xs">
                        <i data-lucide="gift" class="size-5 mb-1.5 stroke-[2]"></i>
                        <span>Presente</span>
                    </button>
                </div>
                <input type="hidden" id="gastoCategoriaSelecionada" value="Moradia">
                <input type="hidden" id="gastoIconeSelecionado" value="home">
            </div>

            <!-- Seleção de Conta: Chips Arredondados tipo Pílula -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-foreground">Conta</label>
                <div id="gastoChipsContas" class="flex flex-wrap gap-2">
                    <button type="button" onclick="selecionarContaGastoChip(this, 'Nubank', 1)" 
                            class="chip-conta-btn active px-4 py-2 rounded-full border-2 border-emerald-800 bg-emerald-800 text-white font-bold text-xs transition shadow-2xs">
                        Nubank
                    </button>
                    <button type="button" onclick="selecionarContaGastoChip(this, 'Poupança', 2)" 
                            class="chip-conta-btn px-4 py-2 rounded-full border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition shadow-2xs">
                        Poupança
                    </button>
                    <button type="button" onclick="selecionarContaGastoChip(this, 'Dinheiro', 3)" 
                            class="chip-conta-btn px-4 py-2 rounded-full border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition shadow-2xs">
                        Dinheiro
                    </button>
                </div>
                <input type="hidden" id="gastoContaIdSelecionada" value="1">
            </div>

            <!-- Switch / Card: Despesa Extraordinária / Imprevisto -->
            <div class="space-y-1.5">
                <div class="flex items-center justify-between p-3.5 rounded-2xl border border-amber-200/80 bg-amber-50/40 dark:bg-amber-950/20 dark:border-amber-800/50 transition">
                    <div class="flex items-center gap-2.5 text-xs font-bold text-foreground">
                        <span class="size-7 rounded-xl bg-amber-100 dark:bg-amber-900/60 text-amber-800 dark:text-amber-300 flex items-center justify-center shrink-0">
                            <i data-lucide="alert-triangle" class="size-4"></i>
                        </span>
                        <span>Despesa Extraordinária / Imprevisto</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="gastoIsImprevisto" onchange="aoAlternarImprevistoGasto(this.checked)" class="sr-only peer">
                        <div class="w-10 h-6 bg-muted peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-800"></div>
                    </label>
                </div>
                <p id="textoAvisoImprevistoGasto" class="hidden text-[11px] text-muted-foreground px-1">
                    Este gasto não estava no orçamento mensal.
                </p>
            </div>

            <!-- Segmented Control: Manter privado vs Compartilhar -->
            <div id="gastoContainerCompartilhar" class="space-y-1.5">
                <div class="grid grid-cols-2 gap-2 p-1.5 rounded-2xl bg-muted/40 border border-border/60">
                    <button type="button" id="btnGastoPrivado" onclick="selecionarVisibilidadeGasto('privado')" 
                            class="flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl font-bold text-xs transition bg-card text-foreground shadow-2xs border border-border/40">
                        <i data-lucide="lock" class="size-3.5"></i>
                        <span>Manter privado</span>
                    </button>
                    <button type="button" id="btnGastoCompartilhado" onclick="selecionarVisibilidadeGasto('compartilhado')" 
                            class="flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl font-bold text-xs transition text-muted-foreground hover:text-foreground">
                        <i data-lucide="share-2" class="size-3.5 text-emerald-700"></i>
                        <span>Compartilhar</span>
                    </button>
                </div>
                <input type="hidden" id="gastoVisibilidade" value="privado">
            </div>

            <!-- Botão Submit: Registrar gasto -->
            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm transition shadow-soft flex items-center justify-center">
                    <span>Registrar gasto</span>
                </button>
            </div>
        </form>
    </div>
</div>
