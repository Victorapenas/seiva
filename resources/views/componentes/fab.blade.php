{{-- 
    Componente: Botão de Ação Rápida Flutuante (FAB)
    Responsável: Victor Hugo / Equipe SEIVA
    Funcionalidade: Menu expansível para registro instantâneo de gasto pessoal, entrada financeira ou despesa conjunta do lar
--}}
<div class="fixed bottom-24 right-5 z-40 flex flex-col items-end gap-3 lg:bottom-8">
    <!-- Menu Dropdown do FAB -->
    <div id="fabDropdown" class="hidden flex flex-col items-end gap-2">
        <button onclick="abrirModalGasto(); alternarFab();" class="flex items-center gap-2 rounded-full bg-card py-2 pl-3 pr-4 text-xs font-semibold text-foreground shadow-elevated border border-border hover:bg-muted transition">
            <span class="size-7 rounded-full bg-rose-100 text-rose-700 flex items-center justify-center">
                <i data-lucide="trending-down" class="size-3.5"></i>
            </span>
            <span>Lançar gasto</span>
        </button>
        <button onclick="abrirModalEntrada(); alternarFab();" class="flex items-center gap-2 rounded-full bg-card py-2 pl-3 pr-4 text-xs font-semibold text-foreground shadow-elevated border border-border hover:bg-muted transition">
            <span class="size-7 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                <i data-lucide="trending-up" class="size-3.5"></i>
            </span>
            <span>Registrar entrada</span>
        </button>
        <button onclick="abrirModalDespesaLar(); alternarFab();" class="flex items-center gap-2 rounded-full bg-card py-2 pl-3 pr-4 text-xs font-semibold text-foreground shadow-elevated border border-border hover:bg-muted transition">
            <span class="size-7 rounded-full bg-accent text-accent-foreground flex items-center justify-center">
                <i data-lucide="home" class="size-3.5"></i>
            </span>
            <span>Despesa do Lar</span>
        </button>
    </div>

    <!-- Botão Principal + -->
    <button onclick="alternarFab()" aria-label="Ações rápidas" class="flex size-14 items-center justify-center rounded-2xl bg-primary text-primary-foreground shadow-elevated hover:bg-primary/95 active:scale-95 transition">
        <i data-lucide="plus" class="size-6"></i>
    </button>
</div>
