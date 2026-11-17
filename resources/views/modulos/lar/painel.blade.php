{{-- 
    Módulo: Área do Lar, Convites e Rateio de Despesas (RF004 & RF010)
    Responsável Acadêmico: Jhon Abner
    Funcionalidade: Divisão proporcional de contas de acordo com a renda líquida dos moradores, gestão de membros do lar e quitação
--}}
<div id="pane-lar" class="sub-screen space-y-6 hidden">
    <header>
        <div class="flex items-center gap-2 text-xs font-medium text-muted-foreground">
            <span class="flex size-6 items-center justify-center rounded-md bg-accent text-accent-foreground">
                <i data-lucide="home" class="size-3.5"></i>
            </span>
            <span id="larHeaderTitle">Nosso Cantinho</span>
        </div>
        <h1 class="mt-2 text-2xl font-bold tracking-tight text-foreground">Painel do Lar</h1>
        <div class="mt-3 flex items-center justify-between">
            <p class="text-xs text-muted-foreground">Divisão colaborativa e rateio transparente</p>
            <button onclick="abrirModalDespesaLar()" class="px-4 py-2 rounded-xl bg-primary text-primary-foreground text-xs font-bold shadow-soft">
                + Nova Despesa do Lar
            </button>
        </div>
    </header>

    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Divisão Proporcional das Contas</h3>
        <div id="larMembrosProporcaoGrid" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <p class="text-xs text-muted-foreground py-4 text-center col-span-full">Carregando membros do lar...</p>
        </div>
    </div>

    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-3">
        <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Despesas do Lar Cadastradas</h3>
        <div id="larDespesasGrid" class="space-y-3">
            <p class="text-xs text-muted-foreground py-6 text-center">Nenhuma despesa compartilhada registrada.</p>
        </div>
    </div>
</div>
