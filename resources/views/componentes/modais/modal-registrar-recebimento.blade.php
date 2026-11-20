{{-- 
    Modal: Registrar Recebimento (Protótipo Imagem 10)
    Registro rápido e visual de entradas, com tipos em chips, conta de destino e opção recorrente
--}}
<div id="modalRegistrarRecebimento" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="fecharModalId('modalRegistrarRecebimento')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60 flex items-start justify-between gap-3">
            <div>
                <h3 class="text-base font-extrabold text-foreground">Registrar recebimento</h3>
                <p class="text-xs text-muted-foreground mt-0.5">Toda entrada conta</p>
            </div>
            <button type="button" onclick="fecharModalId('modalRegistrarRecebimento')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarRecebimentoRapido(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Valor em Destaque -->
            <div class="relative flex items-center rounded-2xl border-2 border-emerald-600/70 bg-background px-4 py-3 shadow-2xs focus-within:border-emerald-600 focus-within:ring-2 focus-within:ring-emerald-500/20 transition">
                <span class="text-base font-black text-muted-foreground select-none pr-2">R$</span>
                <input type="text" id="recebimentoInputValor" inputmode="decimal" required class="w-full bg-transparent text-2xl sm:text-3xl font-black text-foreground focus:outline-none tracking-tight" placeholder="0,00">
            </div>

            <!-- Tipo de Recebimento em Chips -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Tipo</label>
                <div id="recebimentoChipsTipos" class="flex flex-wrap gap-2">
                    <button type="button" onclick="selecionarTipoRecebimento(this, 'Salário')" class="rec-tipo-chip active px-3.5 py-1.5 rounded-xl border border-emerald-600 bg-emerald-800 text-white font-bold text-xs transition">
                        Salário
                    </button>
                    <button type="button" onclick="selecionarTipoRecebimento(this, 'Freela')" class="rec-tipo-chip px-3.5 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        Freela
                    </button>
                    <button type="button" onclick="selecionarTipoRecebimento(this, 'Comissão')" class="rec-tipo-chip px-3.5 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        Comissão
                    </button>
                    <button type="button" onclick="selecionarTipoRecebimento(this, 'Pix recebido')" class="rec-tipo-chip px-3.5 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        Pix recebido
                    </button>
                    <button type="button" onclick="selecionarTipoRecebimento(this, 'Outro')" class="rec-tipo-chip px-3.5 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        Outro
                    </button>
                </div>
                <input type="hidden" id="recebimentoTipoSelecionado" value="Salário">
            </div>

            <!-- Origem / De quem -->
            <div class="space-y-1">
                <label class="text-xs font-bold text-foreground">De quem / de onde?</label>
                <input type="text" id="recebimentoInputOrigem" required class="w-full rounded-2xl border border-border bg-background px-4 py-2.5 text-xs text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary shadow-2xs" placeholder="Ex: Florais Design">
            </div>

            <!-- Conta de Destino -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Conta de destino</label>
                <div id="recebimentoChipsContas" class="flex flex-wrap gap-2">
                    <!-- Preenchido via JS com as contas reais -->
                </div>
                <input type="hidden" id="recebimentoContaIdSelecionada" value="">
            </div>

            <!-- Switch Recorrente -->
            <div class="flex items-center justify-between p-3 rounded-2xl border border-border bg-muted/20">
                <div class="flex items-center gap-2 text-xs font-semibold text-foreground">
                    <i data-lucide="repeat" class="size-4 text-emerald-600"></i>
                    <span>Recebimento recorrente?</span>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="recebimentoIsRecorrente" class="sr-only peer">
                    <div class="w-9 h-5 bg-muted peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-600"></div>
                </label>
            </div>

            <!-- Botão Salvar -->
            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm transition shadow-soft flex items-center justify-center gap-2">
                    <i data-lucide="plus-circle" class="size-4"></i>
                    <span>Registrar recebimento</span>
                </button>
            </div>
        </form>
    </div>
</div>