{{-- 
    Modal: Lançar Gasto (Protótipo Imagem 9)
    Registro rápido e visual de saídas, com categorias em chips, contas e opção de compartilhamento
--}}
<div id="modalLancarGasto" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="fecharModalId('modalLancarGasto')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60 flex items-start justify-between gap-3">
            <div>
                <h3 class="text-base font-extrabold text-foreground">Lançar gasto</h3>
                <p class="text-xs text-muted-foreground mt-0.5">Registre uma saída rapidinho</p>
            </div>
            <button type="button" onclick="fecharModalId('modalLancarGasto')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarGastoRapido(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Valor em Destaque -->
            <div class="relative flex items-center rounded-2xl border-2 border-emerald-600/70 bg-background px-4 py-3 shadow-2xs focus-within:border-emerald-600 focus-within:ring-2 focus-within:ring-emerald-500/20 transition">
                <span class="text-base font-black text-muted-foreground select-none pr-2">R$</span>
                <input type="text" id="gastoInputValor" inputmode="decimal" required class="w-full bg-transparent text-2xl sm:text-3xl font-black text-foreground focus:outline-none tracking-tight" placeholder="0,00">
            </div>

            <!-- Descrição -->
            <div class="space-y-1">
                <label class="text-xs font-bold text-foreground">O que foi?</label>
                <input type="text" id="gastoInputTitulo" required class="w-full rounded-2xl border border-border bg-background px-4 py-2.5 text-xs text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary shadow-2xs" placeholder="Ex: Mercado Dia a Dia">
            </div>

            <!-- Categoria em Grid (8 chips oficiais do protótipo) -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Categoria</label>
                <div id="gastoChipsCategorias" class="grid grid-cols-4 gap-2">
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Moradia', 'home')" class="cat-chip active flex flex-col items-center justify-center p-2.5 rounded-2xl border border-emerald-600 bg-emerald-800 text-white font-bold text-[11px] transition">
                        <i data-lucide="home" class="size-4 mb-1"></i>
                        <span>Moradia</span>
                    </button>
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Alimentação', 'utensils')" class="cat-chip flex flex-col items-center justify-center p-2.5 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-[11px] transition">
                        <i data-lucide="utensils" class="size-4 mb-1"></i>
                        <span>Alimentação</span>
                    </button>
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Transporte', 'car')" class="cat-chip flex flex-col items-center justify-center p-2.5 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-[11px] transition">
                        <i data-lucide="car" class="size-4 mb-1"></i>
                        <span>Transporte</span>
                    </button>
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Saúde', 'pill')" class="cat-chip flex flex-col items-center justify-center p-2.5 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-[11px] transition">
                        <i data-lucide="pill" class="size-4 mb-1"></i>
                        <span>Saúde</span>
                    </button>
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Lazer', 'film')" class="cat-chip flex flex-col items-center justify-center p-2.5 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-[11px] transition">
                        <i data-lucide="film" class="size-4 mb-1"></i>
                        <span>Lazer</span>
                    </button>
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Mercado', 'shopping-cart')" class="cat-chip flex flex-col items-center justify-center p-2.5 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-[11px] transition">
                        <i data-lucide="shopping-cart" class="size-4 mb-1"></i>
                        <span>Mercado</span>
                    </button>
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Beleza', 'sparkles')" class="cat-chip flex flex-col items-center justify-center p-2.5 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-[11px] transition">
                        <i data-lucide="sparkles" class="size-4 mb-1"></i>
                        <span>Beleza</span>
                    </button>
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Presente', 'gift')" class="cat-chip flex flex-col items-center justify-center p-2.5 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-[11px] transition">
                        <i data-lucide="gift" class="size-4 mb-1"></i>
                        <span>Presente</span>
                    </button>
                </div>
                <input type="hidden" id="gastoCategoriaSelecionada" value="Moradia">
            </div>

            <!-- Conta de Saída -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Conta</label>
                <div id="gastoChipsContas" class="flex flex-wrap gap-2">
                    <!-- Preenchido via JS com as contas reais -->
                </div>
                <input type="hidden" id="gastoContaIdSelecionada" value="">
            </div>

            <!-- Switch Imprevisto -->
            <div class="flex items-center justify-between p-3 rounded-2xl border border-border bg-muted/20">
                <div class="flex items-center gap-2 text-xs font-semibold text-foreground">
                    <i data-lucide="alert-triangle" class="size-4 text-amber-500"></i>
                    <span>Despesa Extraordinária / Imprevisto</span>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="gastoIsImprevisto" class="sr-only peer">
                    <div class="w-9 h-5 bg-muted peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-600"></div>
                </label>
            </div>

            <!-- Seletor Privado vs Compartilhar (Exibido para Casal) -->
            <div id="gastoContainerCompartilhar" class="space-y-1.5">
                <div class="grid grid-cols-2 gap-2 p-1 rounded-2xl bg-muted/60 border border-border">
                    <button type="button" id="btnGastoPrivado" onclick="selecionarVisibilidadeGasto('privado')" class="flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition bg-card text-foreground shadow-2xs">
                        <i data-lucide="lock" class="size-3.5"></i>
                        <span>Manter privado</span>
                    </button>
                    <button type="button" id="btnGastoCompartilhado" onclick="selecionarVisibilidadeGasto('compartilhado')" class="flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition text-muted-foreground hover:text-foreground">
                        <i data-lucide="leaf" class="size-3.5 text-emerald-600"></i>
                        <span>Compartilhar</span>
                    </button>
                </div>
                <input type="hidden" id="gastoVisibilidade" value="privado">
            </div>

            <!-- Botão Salvar -->
            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm transition shadow-soft flex items-center justify-center gap-2">
                    <i data-lucide="plus-circle" class="size-4"></i>
                    <span>Registrar gasto</span>
                </button>
            </div>
        </form>
    </div>
</div>