{{-- 
    Módulo: Metas do Casal e Projetos Compartilhados (RF007, RF008)
    Responsável Acadêmico: Ian Marcos
    Funcionalidade: Planejamento financeiro de médio e longo prazo, cálculo de progresso e alvos
--}}
<div id="pane-metas" class="sub-screen space-y-6 hidden">
    <!-- Header com Card Resumo das Metas -->
    <header class="rounded-3xl bg-primary p-6 text-primary-foreground shadow-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-wider font-semibold opacity-85">Meus Objetivos & Metas do Casal</p>
                <h1 class="mt-1 text-3xl font-extrabold tracking-tight" id="metasValorTotalDisplay">R$ 0,00</h1>
                <p class="mt-1 text-xs opacity-80" id="metasAlvoTotalDisplay">de R$ 0,00 planejados</p>
            </div>
            <div class="hidden sm:flex size-12 rounded-2xl bg-white/10 backdrop-blur-xs items-center justify-center">
                <i data-lucide="target" class="size-6 text-emerald-200"></i>
            </div>
        </div>

        <div class="mt-5 grid grid-cols-2 gap-3">
            <div class="rounded-2xl bg-primary-foreground/15 px-4 py-3 backdrop-blur-xs">
                <p class="text-[11px] font-medium opacity-80">Progresso acumulado</p>
                <p class="mt-0.5 text-xl font-black" id="metasProgressoPct">0%</p>
            </div>
            <div class="rounded-2xl bg-primary-foreground/15 px-4 py-3 backdrop-blur-xs">
                <p class="text-[11px] font-medium opacity-80">Metas ativas</p>
                <p class="mt-0.5 text-xl font-black" id="metasQtdAtivas">0</p>
            </div>
        </div>
    </header>

    <!-- Lista de Metas e Ações -->
    <div class="flex items-center justify-between">
        <div>
            <span class="text-sm font-bold text-foreground">Metas em Andamento</span>
            <p class="text-xs text-muted-foreground">Poupança conjunta para sonhos e segurança</p>
        </div>
        <button onclick="adicionarMetaPrompt()" class="px-3.5 py-2 rounded-xl bg-primary text-primary-foreground text-xs font-bold shadow-soft hover:bg-primary/90 transition flex items-center gap-1.5">
            <i data-lucide="plus" class="size-3.5"></i> Nova Meta
        </button>
    </div>

    <div id="metasCardsGrid" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <p class="text-xs text-muted-foreground py-8 text-center col-span-full">Nenhuma meta cadastrada.</p>
    </div>
</div>
