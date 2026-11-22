{{-- 
    Modal: Histórico de Auditoria & Rastreabilidade Financeira (Fintech SEIVA)
    Responsáveis Acadêmicos: Victor Hugo / Jhon Abner / Ian Marcos
    Objetivo: Transparência contábil e rastreabilidade total de edições,
    reajustes, estornos e arquivamentos com proteção de integridade referencial.
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="modalHistoricoAuditoria" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalHistoricoAuditoria')"></div>

    <div class="relative w-full sm:max-w-xl bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[90vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center border border-emerald-500/20">
                    <i data-lucide="shield-check" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Histórico & Rastreabilidade</h3>
                    <p class="text-xs text-muted-foreground">Registro de integridade contábil e auditoria</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalHistoricoAuditoria')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <!-- Conteúdo: Linha do Tempo de Ações -->
        <div class="p-6 overflow-y-auto no-scrollbar space-y-4">
            <div class="p-3.5 rounded-2xl bg-muted/40 border border-border text-xs text-muted-foreground leading-relaxed flex items-start gap-2.5">
                <i data-lucide="info" class="size-4 text-emerald-600 shrink-0 mt-0.5"></i>
                <span>Nenhum dado é perdido ou desassociado: contas com histórico são arquivadas preservando lançamentos, valores editados guardam histórico e estornos recalculam saldos automaticamente.</span>
            </div>

            <div id="listaHistoricoAuditoriaContainer" class="space-y-3">
                <div class="py-8 text-center text-muted-foreground text-xs space-y-2">
                    <i data-lucide="loader-2" class="size-6 animate-spin mx-auto text-emerald-600"></i>
                    <p>Carregando registros de auditoria...</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-3.5 border-t border-border/60 bg-muted/20 flex justify-end">
            <button type="button" onclick="fecharModalId('modalHistoricoAuditoria')" class="px-5 py-2.5 rounded-xl bg-muted hover:bg-muted/80 text-foreground font-bold text-xs transition">
                Fechar
            </button>
        </div>
    </div>
</div>
