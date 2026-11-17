{{-- 
    Componente Modal: Lançar Despesa do Lar
    Responsável: Jhon Abner (RF004, RF010)
    Funcionalidade: Divisão proporcional ou 50/50 de despesas compartilhadas entre membros do Lar
--}}
<div id="modalDespesaLar" class="hidden fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
    <div class="rounded-3xl border border-border bg-card p-6 max-w-md w-full shadow-elevated relative">
        <button onclick="fecharModalId('modalDespesaLar')" class="absolute top-5 right-5 text-muted-foreground hover:text-foreground p-1 rounded-xl hover:bg-muted transition">
            <i data-lucide="x" class="size-5"></i>
        </button>
        <h3 class="text-lg font-bold text-foreground mb-4">Lançar Despesa do Lar</h3>
        <form onsubmit="salvarDespesaLarForm(event)" class="space-y-4">
            <div>
                <label class="text-xs font-medium text-foreground">Nome da Despesa</label>
                <input type="text" id="formLarDespTitulo" required placeholder="Ex: Aluguel, Internet, Supermercado" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none focus:border-primary">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-xs font-medium text-foreground">Valor Total (R$)</label>
                    <input type="number" step="0.01" id="formLarDespValor" required placeholder="0,00" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-base font-bold text-foreground outline-none focus:border-primary">
                </div>
                <div>
                    <label class="text-xs font-medium text-foreground">Regra de Divisão</label>
                    <select id="formLarDespDivisao" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-3 text-xs text-foreground outline-none focus:border-primary">
                        <option value="proporcional">Proporcional à renda</option>
                        <option value="50/50">50% / 50%</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="text-xs font-medium text-foreground">Vencimento</label>
                <input type="date" id="formLarDespData" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none focus:border-primary">
            </div>
            <button type="submit" class="w-full mt-2 h-12 rounded-2xl bg-primary text-primary-foreground font-semibold text-sm shadow-card hover:bg-primary/90 transition">
                Calcular Rateio & Salvar
            </button>
        </form>
    </div>
</div>
