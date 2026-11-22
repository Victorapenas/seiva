{{-- 
    Modal: Disputar / Não Recebimento de Valor (SEIVA)
    Substitui qualquer prompt nativo feio por uma interface elegante e acolhedora.
--}}
<div id="modalDisputarRecebimento" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalDisputarRecebimento')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated border border-border/80 flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-2xl bg-amber-500/10 text-amber-500 border border-amber-500/20 flex items-center justify-center shrink-0">
                    <i data-lucide="alert-circle" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Não recebi o valor</h3>
                    <p class="text-[11px] text-muted-foreground">Solicitar conferência de comprovante</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalDisputarRecebimento')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarEnvioDisputaRecebimento(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <input type="hidden" id="disputaItemRecebimentoId" value="">
            <input type="hidden" id="disputaItemRecebimentoValor" value="">

            <!-- Card com o valor contestado -->
            <div class="rounded-2xl border border-amber-500/20 bg-amber-50/50 dark:bg-amber-950/20 p-3.5 space-y-1">
                <div class="flex items-center justify-between text-xs font-bold text-foreground">
                    <span id="disputaItemRecebimentoTitulo">Valor contestado</span>
                    <strong id="disputaItemRecebimentoValorTxt" class="text-amber-600 dark:text-amber-400 font-black text-sm">R$ 156,40</strong>
                </div>
                <p class="text-[11px] text-muted-foreground">
                    Seu parceiro será avisado cordialmente para checar a transferência ou enviar o comprovante.
                </p>
            </div>

            <!-- Motivos rápidos em chips -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Qual o motivo principal?</label>
                <div class="grid grid-cols-1 gap-2">
                    <button type="button" onclick="selecionarMotivoDisputa(this, 'PIX não localizado no extrato bancário')" 
                            class="chip-motivo-disputa active w-full p-2.5 text-left rounded-xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/30 text-foreground text-xs font-bold transition flex items-center justify-between">
                        <span>PIX não localizado no extrato</span>
                        <i data-lucide="check" class="size-3.5 text-emerald-600"></i>
                    </button>
                    <button type="button" onclick="selecionarMotivoDisputa(this, 'Valor recebido diferente do combinado')" 
                            class="chip-motivo-disputa w-full p-2.5 text-left rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground text-xs font-bold transition flex items-center justify-between">
                        <span>Valor diferente do combinado</span>
                        <i data-lucide="check" class="size-3.5 opacity-0"></i>
                    </button>
                    <button type="button" onclick="selecionarMotivoDisputa(this, 'Solicito envio de comprovante com chave PIX')" 
                            class="chip-motivo-disputa w-full p-2.5 text-left rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground text-xs font-bold transition flex items-center justify-between">
                        <span>Solicito envio de comprovante</span>
                        <i data-lucide="check" class="size-3.5 opacity-0"></i>
                    </button>
                </div>
                <input type="hidden" id="disputaMotivoSelecionado" value="PIX não localizado no extrato bancário">
            </div>

            <!-- Detalhes opcionais -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Detalhes ou mensagem adicional (opcional)</label>
                <textarea id="disputaMensagemAdicional" rows="2" 
                          placeholder="Ex: Verifiquei o extrato de hoje e não caiu. Você pode conferir se foi para a chave certa?"
                          class="w-full rounded-2xl border border-border bg-background p-3 text-xs text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary shadow-2xs resize-none"></textarea>
            </div>

            <!-- Botões de Ação -->
            <div class="pt-2 flex gap-2.5">
                <button type="submit" class="flex-1 py-3.5 rounded-2xl bg-amber-600 hover:bg-amber-500 text-white font-extrabold text-xs transition shadow-soft flex items-center justify-center gap-2">
                    <i data-lucide="send" class="size-4"></i>
                    <span>Enviar aviso ao parceiro</span>
                </button>
                <button type="button" onclick="fecharModalId('modalDisputarRecebimento')" 
                        class="px-4 py-3.5 rounded-2xl border border-border bg-card hover:bg-muted text-foreground font-bold text-xs transition">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>
