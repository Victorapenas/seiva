{{-- 
    Modal: Apagar Conta Definitivamente (LGPD Art. 18 / Direito ao Esquecimento)
    Responsável Acadêmica: Maria Eduarda (Duda)
    Permite ao usuário eliminar todos os seus dados cadastrais, financeiros e históricos.
--}}
<div id="modalApagarConta" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalApagarConta')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-xl bg-rose-100 dark:bg-rose-950/70 text-rose-700 dark:text-rose-300 flex items-center justify-center border border-rose-500/20">
                    <i data-lucide="user-x" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Excluir Minha Conta</h3>
                    <p class="text-xs text-rose-600 font-bold">Direito ao Esquecimento (LGPD Art. 18)</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalApagarConta')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <div class="p-6 space-y-4 overflow-y-auto no-scrollbar text-xs leading-relaxed">
            <!-- Box de Alerta de Alto Contraste -->
            <div class="p-4 rounded-2xl bg-rose-50 border-2 border-rose-300 text-rose-950 space-y-2 shadow-xs">
                <div class="flex items-center gap-2 font-black text-rose-800 text-sm">
                    <i data-lucide="alert-triangle" class="size-5 shrink-0 text-rose-600"></i>
                    <span>Esta ação é irreversível</span>
                </div>
                <p class="text-xs font-semibold text-rose-900 leading-relaxed">
                    Ao confirmar, todas as suas contas, transações, metas, registros da Caixa Preta e histórico de rateio serão excluídos e anonimizados de forma permanente.
                </p>
            </div>

            <p class="text-muted-foreground">
                Se você pertence a um Lar compartilhado, seu parceiro será notificado de que a conta foi encerrada e as contas do lar serão transferidas para gestão individual dele.
            </p>

            <div class="space-y-1.5 pt-1">
                <label class="text-xs font-bold text-foreground">Digite <span class="font-black text-rose-600">EXCLUIR</span> para confirmar:</label>
                <input type="text" id="confirmarExclusaoContaInput" placeholder="EXCLUIR" oninput="validarTextoExclusaoConta(this.value)"
                       class="w-full rounded-2xl border border-border bg-background px-4 py-3 text-xs font-black uppercase tracking-wider text-foreground placeholder:text-muted-foreground focus:border-rose-600 focus:outline-none focus:ring-1 focus:ring-rose-600 shadow-2xs">
            </div>

            <div class="pt-2 flex flex-col sm:flex-row gap-2">
                <button type="button" id="btnConfirmarExcluirConta" onclick="executarExcluirContaDefinitiva()" disabled
                        class="flex-1 py-3.5 rounded-2xl bg-rose-600 hover:bg-rose-700 disabled:opacity-40 disabled:cursor-not-allowed text-white font-extrabold text-xs shadow-soft transition cursor-pointer flex items-center justify-center gap-1.5">
                    <i data-lucide="trash-2" class="size-4"></i>
                    <span>Excluir Definitivamente</span>
                </button>
                <button type="button" onclick="fecharModalId('modalApagarConta')" class="py-3.5 px-4 rounded-2xl border border-border bg-card hover:bg-muted text-foreground font-bold text-xs shadow-2xs transition">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
