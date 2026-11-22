{{-- 
    Modal Universal de Diálogo e Confirmação (SEIVA)
    Substitui 100% de window.confirm() e window.prompt() nativos por uma tela profissional.
--}}
<div id="modalConfirmacaoSeiva" class="hidden fixed inset-0 z-[10000] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharSeivaDialog(false)"></div>

    <div class="relative w-full sm:max-w-sm bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated border border-border/80 p-6 space-y-4 overflow-hidden transition-all text-center" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <div id="seivaDialogIconBox" class="size-14 mx-auto rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border border-emerald-200/50 flex items-center justify-center">
            <i id="seivaDialogIcon" data-lucide="help-circle" class="size-7"></i>
        </div>

        <div class="space-y-1.5 text-center">
            <h3 id="seivaDialogTitulo" class="text-base font-extrabold text-foreground">Confirmação</h3>
            <p id="seivaDialogMensagem" class="text-xs text-muted-foreground leading-relaxed">
                Tem certeza que deseja prosseguir com esta ação?
            </p>
        </div>

        <!-- Input Opcional (Prompt) -->
        <div id="seivaDialogInputWrapper" class="hidden text-left space-y-1 pt-1">
            <label id="seivaDialogInputLabel" class="text-[11px] font-bold text-foreground">Valor</label>
            <input type="text" id="seivaDialogInput" class="w-full rounded-2xl border border-border bg-background px-4 py-2.5 text-xs text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary shadow-2xs">
        </div>

        <div class="pt-2 flex gap-2">
            <button type="button" id="seivaDialogBtnCancelar" onclick="fecharSeivaDialog(false)" 
                    class="flex-1 py-3 rounded-2xl border border-border bg-card hover:bg-muted text-foreground font-bold text-xs transition">
                Cancelar
            </button>
            <button type="button" id="seivaDialogBtnConfirmar" onclick="confirmarSeivaDialog()" 
                    class="flex-1 py-3 rounded-2xl bg-emerald-700 hover:bg-emerald-800 text-white font-extrabold text-xs transition shadow-soft flex items-center justify-center gap-1.5">
                <span>Confirmar</span>
            </button>
        </div>
    </div>
</div>
