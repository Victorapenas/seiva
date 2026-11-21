{{-- 
    Modal: Desfazer Meta do Lar (Imagem 9)
    Permite cancelar a meta e redistribuir o saldo acumulado com 3 opções claras
--}}
<div id="modalDesfazerMetaLar" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="fecharModalId('modalDesfazerMetaLar')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60 flex items-start justify-between gap-3">
            <div>
                <h3 id="desfazerMetaLarTituloHeader" class="text-base font-extrabold text-foreground">Desfazer "Geladeira Samsung"</h3>
            </div>
            <button type="button" onclick="fecharModalId('modalDesfazerMetaLar')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarConfirmarDesfazerMetaLar(event)" class="p-6 space-y-4">
            <!-- Banner Informativo -->
            <div class="p-4 rounded-2xl border border-emerald-200/80 dark:border-emerald-900/40 bg-emerald-50/50 dark:bg-emerald-950/20 flex items-start gap-3">
                <span class="size-8 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center shrink-0">
                    <i data-lucide="piggy-bank" class="size-4"></i>
                </span>
                <p class="text-xs text-muted-foreground font-medium leading-relaxed">
                    Vocês já guardaram <strong id="desfazerMetaLarJaGuardadoTxt" class="font-extrabold text-foreground">R$ 1.000,00</strong> nesta meta. Escolha para onde esse dinheiro vai.
                </p>
            </div>

            <!-- 3 Opções de Redistribuição do Saldo -->
            <div class="space-y-2.5">
                <!-- Opção 1: Devolver para cada um -->
                <button type="button" onclick="selecionarDestinoDesfazerMeta(this, 'devolver')" 
                        class="chip-destino-desfazer active w-full p-4 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="size-8 rounded-xl bg-emerald-800 text-white flex items-center justify-center shrink-0">
                            <i data-lucide="users" class="size-4"></i>
                        </span>
                        <div>
                            <strong class="text-xs font-extrabold text-foreground block">Devolver para cada um</strong>
                            <span class="text-[11px] text-muted-foreground" id="desfazerMetaDevolucaoTxt">Duda recebe R$ 500,00 · Ian recebe R$ 500,00</span>
                        </div>
                    </div>
                    <i data-lucide="check" class="size-4 text-emerald-600"></i>
                </button>

                <!-- Opção 2: Mover para o Fundo de Emergência -->
                <button type="button" onclick="selecionarDestinoDesfazerMeta(this, 'fundo_emergencia')" 
                        class="chip-destino-desfazer w-full p-4 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                            <i data-lucide="shield" class="size-4"></i>
                        </span>
                        <div>
                            <strong class="text-xs font-extrabold text-foreground block">Mover para o Fundo de Emergência</strong>
                            <span class="text-[11px] text-muted-foreground" id="desfazerMetaFundoTxt">R$ 1.000,00 reforçam a reserva do Lar</span>
                        </div>
                    </div>
                </button>

                <!-- Opção 3: Transferir para outra meta -->
                <button type="button" onclick="selecionarDestinoDesfazerMeta(this, 'outra_meta')" 
                        class="chip-destino-desfazer w-full p-4 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                            <i data-lucide="arrow-up-right" class="size-4"></i>
                        </span>
                        <div>
                            <strong class="text-xs font-extrabold text-foreground block">Transferir para outra meta</strong>
                            <span class="text-[11px] text-muted-foreground">Vai para "Viagem Praia do Forte"</span>
                        </div>
                    </div>
                </button>
            </div>

            <input type="hidden" id="desfazerMetaLarDestinoSelecionado" value="devolver">
            <input type="hidden" id="desfazerMetaLarId" value="">

            <!-- Botões de Ação -->
            <div class="pt-2 space-y-2">
                <button type="submit" class="w-full py-4 rounded-2xl bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-sm transition shadow-soft flex items-center justify-center gap-2">
                    <i data-lucide="rotate-ccw" class="size-4"></i>
                    <span>Desfazer meta</span>
                </button>
                <button type="button" onclick="fecharModalId('modalDesfazerMetaLar')" class="w-full py-2.5 text-center text-xs font-bold text-muted-foreground hover:text-foreground transition">
                    Manter meta
                </button>
            </div>
        </form>
    </div>
</div>
