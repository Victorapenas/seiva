{{-- 
    Modal: Registrar Pagamento de Despesa Fixa do Lar (Imagem 5)
    Permite quitar contas fixas com seleção de conta, comprovante e quitação do acordo
--}}
<div id="modalRegistrarPagamentoLar" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="fecharModalId('modalRegistrarPagamentoLar')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60 flex items-start justify-between gap-3">
            <div>
                <h3 class="text-base font-extrabold text-foreground">Registrar pagamento</h3>
                <p id="regPagamentoLarSubtitulo" class="text-xs text-muted-foreground mt-0.5">Despesa fixa do Lar · 50 / 50</p>
            </div>
            <button type="button" onclick="fecharModalId('modalRegistrarPagamentoLar')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarConfirmarPagamentoDespesaLar(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Card de Detalhe da Despesa -->
            <div class="rounded-2xl border border-border bg-muted/30 p-4 space-y-2.5">
                <div>
                    <h4 id="regPagamentoLarTitulo" class="text-xs font-bold text-muted-foreground">Conta de Luz</h4>
                    <span class="text-[11px] text-muted-foreground block mt-0.5">Valor desta parcela</span>
                    <strong id="regPagamentoLarValor" class="text-2xl font-black text-foreground block mt-0.5">R$ 110,00</strong>
                </div>

                <div class="h-2 w-full rounded-full bg-muted overflow-hidden">
                    <div id="regPagamentoLarBarra" class="h-full bg-emerald-600 rounded-full" style="width: 100%"></div>
                </div>

                <p id="regPagamentoLarProgressoTxt" class="text-[11px] text-muted-foreground">
                    Já guardado: R$ 0,00 de R$ 110,00 (0%) · faltam R$ 110,00
                </p>
            </div>

            <!-- De qual conta saiu -->
            <div class="space-y-1.5 pt-1">
                <label class="text-xs font-bold text-foreground">Esse dinheiro saiu de qual conta?</label>
                <p class="text-[11px] text-muted-foreground">O SEIVA só registra — o valor será descontado da conta escolhida.</p>

                <div class="flex flex-wrap gap-2 pt-1" id="regPagamentoLarContasChips">
                    <button type="button" onclick="selecionarContaPagamentoLar(this, 1)" 
                            class="chip-conta-pag-lar active flex items-center gap-1.5 px-3.5 py-2 rounded-2xl border-2 border-emerald-600 bg-emerald-800 text-white font-bold text-xs transition">
                        <i data-lucide="wallet" class="size-3.5"></i>
                        <span>Nubank</span>
                    </button>
                    <button type="button" onclick="selecionarContaPagamentoLar(this, 2)" 
                            class="chip-conta-pag-lar flex items-center gap-1.5 px-3.5 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="piggy-bank" class="size-3.5"></i>
                        <span>Poupança</span>
                    </button>
                    <button type="button" onclick="selecionarContaPagamentoLar(this, 3)" 
                            class="chip-conta-pag-lar flex items-center gap-1.5 px-3.5 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="banknote" class="size-3.5"></i>
                        <span>Dinheiro</span>
                    </button>
                    <button type="button" onclick="selecionarContaPagamentoLar(this, 4)" 
                            class="chip-conta-pag-lar flex items-center gap-1.5 px-3.5 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="smartphone" class="size-3.5"></i>
                        <span>Pix</span>
                    </button>
                </div>
                <input type="hidden" id="regPagamentoLarContaId" value="1">
                <input type="hidden" id="regPagamentoLarDespesaId" value="">
                <input type="hidden" id="regPagamentoLarValorInput" value="110.00">
                <input type="hidden" id="regPagamentoLarTituloInput" value="Conta de Luz">
            </div>

            <!-- Banner Verde Quitação -->
            <div class="p-3.5 rounded-2xl bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200/80 dark:border-emerald-800/40 flex items-center justify-center text-center gap-2">
                <i data-lucide="check-circle" class="size-4 text-emerald-700 dark:text-emerald-400 shrink-0"></i>
                <span class="text-xs font-bold text-emerald-800 dark:text-emerald-300">Com este valor você quita o acordo!</span>
            </div>

            <!-- Comprovante (opcional, mas recomendado) -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Comprovante (opcional, mas recomendado)</label>
                <input type="file" id="regPagamentoLarComprovanteInput" accept="image/*" class="hidden" onchange="aoSelecionarComprovantePagLar(this)">
                <div onclick="document.getElementById('regPagamentoLarComprovanteInput').click()" 
                     id="boxComprovantePagLar"
                     class="flex flex-col items-center justify-center p-4 rounded-2xl border-2 border-dashed border-border bg-muted/20 text-center cursor-pointer hover:border-emerald-500 transition">
                    <i data-lucide="image-plus" class="size-5 text-muted-foreground mb-1"></i>
                    <span class="text-xs font-bold text-foreground">Adicionar foto</span>
                    <span class="text-[10px] text-muted-foreground">Anexe o print do Pix ou o recibo para comprovar que de fato foi pago.</span>
                </div>
                <div id="previewComprovantePagLar" class="hidden p-2.5 rounded-xl border border-border bg-card flex items-center justify-between text-xs font-semibold text-emerald-700">
                    <span class="flex items-center gap-1.5"><i data-lucide="check" class="size-3.5"></i> Comprovante vinculado</span>
                    <button type="button" onclick="removerComprovantePagLar(event)" class="text-rose-500 text-[11px] font-bold hover:underline">Remover</button>
                </div>
            </div>

            <!-- Botão de Confirmação -->
            <div class="pt-2">
                <button type="submit" id="regPagamentoLarBtnSubmit" class="w-full py-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm transition shadow-soft flex items-center justify-center gap-2">
                    <i data-lucide="check" class="size-4"></i>
                    <span>Confirmar que paguei R$ 110,00</span>
                </button>
            </div>
        </form>
    </div>
</div>
