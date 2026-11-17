{{-- 
    Módulo: Inserção de Transações e Extrato (RF003)
    Responsáveis Acadêmicos: Victor Hugo / Jhon Abner
    Funcionalidade: Listagem cronológica de receitas e despesas, filtro por categorias e status financeiro
--}}
<div id="pane-transacoes" class="sub-screen space-y-5 hidden">
    <header>
        <h1 class="text-2xl font-bold tracking-tight text-foreground">Transações</h1>
        <p class="mt-1 text-sm text-muted-foreground">Acompanhe suas entradas, saídas e movimentações</p>
    </header>

    <div class="rounded-3xl border border-border bg-card p-5 shadow-card">
        <div class="flex items-center justify-between border-b border-border pb-3 mb-3">
            <span class="text-xs font-bold text-foreground">Extrato Completo</span>
            <button onclick="abrirModalGasto()" class="text-xs font-semibold text-primary hover:underline">+ Lançar</button>
        </div>
        <div id="extratoList" class="space-y-2 divide-y divide-border/60">
            <p class="text-xs text-muted-foreground py-8 text-center">Nenhuma transação encontrada.</p>
        </div>
    </div>
</div>
