{{-- 
    Modal Universal de Diálogo, Confirmação e Segurança Anticonflito (SEIVA)
    Responsáveis Acadêmicos: Victor Hugo / Jhon Abner / Ian Marcos
    Substitui 100% de window.confirm() e alert() nativos por diálogos diplomáticos
    com proteção de histórico, transparência bilateral e integridade contábil.
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="modalConfirmacaoSeiva" class="hidden fixed inset-0 z-[10000] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharSeivaDialog(false)"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated border border-border/80 p-6 space-y-4 overflow-hidden transition-all text-center" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        
        <!-- Badge Contextual Superior (Pessoal vs Casal vs Integridade) -->
        <div id="seivaDialogBadgeWrapper" class="hidden flex justify-center">
            <span id="seivaDialogBadge" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black border"></span>
        </div>

        <div id="seivaDialogIconBox" class="size-14 mx-auto rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border border-emerald-200/50 flex items-center justify-center">
            <i id="seivaDialogIcon" data-lucide="help-circle" class="size-7"></i>
        </div>

        <div class="space-y-1.5 text-center">
            <h3 id="seivaDialogTitulo" class="text-base font-extrabold text-foreground">Confirmação</h3>
            <p id="seivaDialogMensagem" class="text-xs text-muted-foreground leading-relaxed">
                Tem certeza que deseja prosseguir com esta ação?
            </p>
        </div>

        <!-- Box de Impacto Contábil e Relacionamento (Anti-Discordia) -->
        <div id="seivaDialogImpactoBox" class="hidden text-left p-3.5 rounded-2xl border text-xs space-y-1.5 leading-relaxed">
            <div class="flex items-center gap-1.5 font-black text-foreground">
                <i data-lucide="shield-alert" class="size-4 shrink-0 text-amber-600 dark:text-amber-400"></i>
                <span id="seivaDialogImpactoTitulo">Impacto no Histórico & Casal</span>
            </div>
            <p id="seivaDialogImpactoTexto" class="text-[11px] text-muted-foreground"></p>
        </div>

        <!-- Input Opcional (Prompt) -->
        <div id="seivaDialogInputWrapper" class="hidden text-left space-y-1 pt-1">
            <label id="seivaDialogInputLabel" class="text-[11px] font-bold text-foreground">Valor</label>
            <input type="text" id="seivaDialogInput" class="w-full rounded-2xl border border-border bg-background px-4 py-2.5 text-xs text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary shadow-2xs">
        </div>

        <!-- Botões de Ação -->
        <div class="pt-2 flex flex-col sm:flex-row gap-2">
            <button type="button" id="seivaDialogBtnCancelar" onclick="fecharSeivaDialog(false)" 
                    class="flex-1 py-3.5 rounded-2xl border border-border bg-card hover:bg-muted text-foreground font-bold text-xs transition shadow-2xs">
                Cancelar
            </button>
            <button type="button" id="seivaDialogBtnConfirmar" onclick="confirmarSeivaDialog()" 
                    class="flex-1 py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs transition shadow-soft flex items-center justify-center gap-1.5">
                <span>Confirmar</span>
            </button>
        </div>
    </div>
</div>
