{{-- 
    Componente Modal: Registrar Transação (Gasto ou Entrada)
    Responsável: Victor Hugo / Jhon Abner
    Funcionalidade: Formulário rápido para lançamento de despesa pessoal ou receita financeira
--}}
<div id="modalTransacao" class="hidden fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
    <div class="rounded-3xl border border-border bg-card p-6 max-w-md w-full shadow-elevated relative">
        <button onclick="fecharModalId('modalTransacao')" class="absolute top-5 right-5 text-muted-foreground hover:text-foreground p-1 rounded-xl hover:bg-muted transition">
            <i data-lucide="x" class="size-5"></i>
        </button>
        <h3 class="text-lg font-bold text-foreground mb-4" id="modalTransacaoHeader">Registrar Gasto</h3>
        <form onsubmit="salvarTransacaoForm(event)" class="space-y-4" novalidate>
            <input type="hidden" id="formTransTipo" value="saida">
            <div>
                <label class="text-xs font-medium text-foreground">Descrição</label>
                <input type="text" id="formTransTitulo" placeholder="Ex: Mercado, Almoço, Farmácia" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none focus:border-primary">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-xs font-medium text-foreground">Valor (R$)</label>
                    <input type="number" step="0.01" id="formTransValor" placeholder="0,00" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-base font-bold text-foreground outline-none focus:border-primary">
                </div>
                <div>
                    <label class="text-xs font-medium text-foreground">Conta</label>
                    <select id="formTransContaId" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-3 text-xs text-foreground outline-none focus:border-primary"></select>
                </div>
            </div>
            <div>
                <label class="text-xs font-medium text-foreground">Categoria</label>
                <select id="formTransCategoriaId" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-3 text-xs text-foreground outline-none focus:border-primary"></select>
            </div>
            <button type="submit" class="w-full mt-2 h-12 rounded-2xl bg-primary text-primary-foreground font-semibold text-sm shadow-card hover:bg-primary/90 transition">
                Salvar Registro
            </button>
        </form>
    </div>
</div>
