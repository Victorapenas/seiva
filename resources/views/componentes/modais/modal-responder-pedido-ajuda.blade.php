{{-- 
    Modal: Responder Pedido de Ajuda (Contrapor, Aceitar ou Recusar)
--}}
<div id="modalResponderPedidoAjuda" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="fecharModalId('modalResponderPedidoAjuda')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-center justify-between">
            <div>
                <h3 id="modalRespAjudaTitulo" class="text-base font-extrabold text-foreground">Pedido de ajuda</h3>
                <p id="modalRespAjudaSub" class="text-xs text-muted-foreground">Ian solicitou sua ajuda</p>
            </div>
            <button type="button" onclick="fecharModalId('modalResponderPedidoAjuda')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <div class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Valor do Pedido -->
            <div class="p-4 rounded-3xl bg-muted/30 border border-border space-y-1 text-center">
                <span class="text-xs text-muted-foreground font-medium">Valor solicitado</span>
                <strong id="modalRespAjudaValorTxt" class="text-3xl font-black text-foreground block">R$ 50,00</strong>
                <p id="modalRespAjudaMotivo" class="text-xs text-muted-foreground pt-1">Comprar filamento pra fechar o freela da impressora 3D</p>
            </div>

            <!-- Seleção de Conta de Saída (caso vá ajudar) -->
            <div id="containerRespAjudaConta" class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Debitar de qual conta?</label>
                <div id="respAjudaChipsContas" class="flex flex-wrap gap-2">
                    <!-- Preenchido via JS -->
                </div>
            </div>

            <!-- Campo de Contraproposta (caso clique em contrapor) -->
            <div id="containerRespAjudaContraproposta" class="hidden space-y-1.5">
                <label class="text-xs font-bold text-foreground">Propor outro valor menor</label>
                <div class="relative flex items-center rounded-2xl border-2 border-emerald-600 bg-background px-4 py-2.5 shadow-2xs">
                    <span class="text-xs font-black text-muted-foreground select-none pr-2">R$</span>
                    <input type="text" id="respAjudaInputContraproposta" inputmode="decimal" class="w-full bg-transparent text-sm font-extrabold text-foreground focus:outline-none" placeholder="25,00">
                </div>
            </div>

            <input type="hidden" id="respAjudaIdCobranca" value="">
            <input type="hidden" id="respAjudaContaSelecionada" value="">

            <!-- Botões de Ação -->
            <div class="grid grid-cols-3 gap-2 pt-2">
                <button type="button" onclick="executarAcaoRespostaAjuda('recusar')" 
                        class="py-3 px-2 rounded-2xl border border-border bg-card hover:bg-rose-50 text-rose-600 font-bold text-xs transition text-center shadow-2xs">
                    ✕ Recusar
                </button>
                <button type="button" onclick="alternarCampoContraproposta()" 
                        class="py-3 px-2 rounded-2xl border border-border bg-card hover:bg-muted text-foreground font-bold text-xs transition text-center shadow-2xs">
                    🤝 Contrapor
                </button>
                <button type="button" onclick="executarAcaoRespostaAjuda('aceitar')" 
                        class="py-3 px-2 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-black text-xs transition text-center shadow-soft">
                    ✓ Ajudar
                </button>
            </div>
        </div>
    </div>
</div>
