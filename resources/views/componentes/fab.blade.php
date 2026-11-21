{{-- 
    Componente: Botão de Ação Rápida Flutuante (FAB) Oficial do Protótipo
    Responsável: Victor Hugo / Equipe SEIVA
    Funcionalidade: Menu expansível com Lançar gasto, Registrar recebimento, Novo acordo e Nova meta
--}}
<div class="fixed bottom-24 right-5 z-40 flex flex-col items-end gap-3 lg:bottom-8">
    <!-- Menu Expansível do FAB -->
    <div id="fabDropdown" class="hidden flex flex-col items-end gap-2.5 transition-all">
        <!-- 1. Lançar gasto -->
        <button onclick="abrirModalLancarGasto(); alternarFab();" class="group flex items-center gap-2.5 rounded-full bg-card py-2 pl-3 pr-4 text-xs font-bold text-foreground shadow-elevated border border-border hover:bg-emerald-50/50 dark:hover:bg-emerald-950/40 transition">
            <span class="size-8 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 flex items-center justify-center shrink-0">
                <i data-lucide="trending-down" class="size-4"></i>
            </span>
            <span>Lançar gasto</span>
        </button>

        <!-- 2. Registrar recebimento -->
        <button onclick="abrirModalRegistrarRecebimento(); alternarFab();" class="group flex items-center gap-2.5 rounded-full bg-card py-2 pl-3 pr-4 text-xs font-bold text-foreground shadow-elevated border border-border hover:bg-emerald-50/50 dark:hover:bg-emerald-950/40 transition">
            <span class="size-8 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 flex items-center justify-center shrink-0">
                <i data-lucide="trending-up" class="size-4"></i>
            </span>
            <span>Registrar recebimento</span>
        </button>

        <!-- 3. Novo acordo -->
        <button onclick="abrirModalNovoAcordo(); alternarFab();" class="group flex items-center gap-2.5 rounded-full bg-card py-2 pl-3 pr-4 text-xs font-bold text-foreground shadow-elevated border border-border hover:bg-emerald-50/50 dark:hover:bg-emerald-950/40 transition">
            <span class="size-8 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 flex items-center justify-center shrink-0">
                <i data-lucide="handshake" class="size-4"></i>
            </span>
            <span>Novo acordo</span>
        </button>

        <!-- 4. Nova meta -->
        <button onclick="abrirModalCriarMeta(); alternarFab();" class="group flex items-center gap-2.5 rounded-full bg-card py-2 pl-3 pr-4 text-xs font-bold text-foreground shadow-elevated border border-border hover:bg-emerald-50/50 dark:hover:bg-emerald-950/40 transition">
            <span class="size-8 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 flex items-center justify-center shrink-0">
                <i data-lucide="target" class="size-4"></i>
            </span>
            <span>Nova meta</span>
        </button>
    </div>

    <!-- Botão Principal Redondo Verde com Efeito Toggle + / ✕ -->
    <button onclick="alternarFab()" id="btnFabPrincipal" aria-label="Ações rápidas" class="flex size-14 items-center justify-center rounded-full bg-[#1b4d37] text-white shadow-elevated hover:bg-[#153f2c] active:scale-95 transition-transform duration-200">
        <i id="iconeFab" data-lucide="plus" class="size-7 transition-transform duration-200"></i>
    </button>
</div>
