{{-- 
    Módulo: Mesa de Acordos e Consenso Mútuo (RF006)
    Responsável Acadêmico: Ian Marcos
    Funcionalidade: Propostas colaborativas entre parceiros com votação consensual ("Apoiar" / "Recusar") e listagem de acordos selados
--}}
<div id="pane-acordos" class="sub-screen space-y-6 hidden">
    <header>
        <h1 class="text-2xl font-bold tracking-tight text-foreground">Mesa de Acordos</h1>
        <p class="mt-1 text-sm text-muted-foreground">Decisões conjuntas e compras planejadas para o lar</p>
    </header>

    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-3">
        <div class="flex items-center justify-between">
            <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Propostas em Análise</h3>
            <button onclick="adicionarPropostaPrompt()" class="text-xs font-semibold text-primary hover:underline">+ Nova Proposta</button>
        </div>
        <div id="acordosPropostasGrid" class="space-y-3">
            <p class="text-xs text-muted-foreground py-6 text-center">Nenhuma proposta pendente de votação.</p>
        </div>
    </div>

    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-3">
        <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Acordos Selados</h3>
        <div id="acordosSeladosGrid" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <p class="text-xs text-muted-foreground py-6 text-center col-span-full">Nenhum acordo ativo no momento.</p>
        </div>
    </div>
</div>
