{{-- 
    Modal: Atualizar Meta do Lar (Imagem 8)
    Permite alterar o valor alvo e o prazo da meta compartilhada
--}}
<div id="modalAtualizarMetaLar" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="fecharModalId('modalAtualizarMetaLar')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60 flex items-start justify-between gap-3">
            <div>
                <h3 id="atualizarMetaLarTituloHeader" class="text-base font-extrabold text-foreground">Atualizar "Geladeira Samsung"</h3>
            </div>
            <button type="button" onclick="fecharModalId('modalAtualizarMetaLar')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarEdicaoMetaLar(event)" class="p-6 space-y-4">
            <!-- Já guardado -->
            <div class="rounded-2xl border border-border bg-muted/30 p-4 space-y-1">
                <span class="text-xs font-semibold text-muted-foreground block">Já guardado</span>
                <strong id="atualizarMetaLarJaGuardado" class="text-xl font-black text-foreground block">R$ 1.000,00</strong>
            </div>

            <!-- Novo valor total -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Novo valor total da meta (R$)</label>
                <input type="text" id="atualizarMetaLarNovoValor" required 
                       class="w-full rounded-2xl border border-border bg-background px-4 py-3 text-sm font-bold text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none shadow-2xs" placeholder="3200">
            </div>

            <!-- Prazo -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Prazo</label>
                <input type="text" id="atualizarMetaLarNovoPrazo" 
                       class="w-full rounded-2xl border border-border bg-background px-4 py-3 text-sm font-bold text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none shadow-2xs" placeholder="nov/2026">
            </div>

            <input type="hidden" id="atualizarMetaLarId" value="">

            <!-- Botão Salvar alterações -->
            <div class="pt-2">
                <button type="submit" class="w-full py-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm transition shadow-soft flex items-center justify-center gap-2">
                    <i data-lucide="check" class="size-4"></i>
                    <span>Salvar alterações</span>
                </button>
            </div>
        </form>
    </div>
</div>
