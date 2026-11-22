{{-- 
    Modal: Registrar Pagamento de Despesa Fixa do Lar
    Responsável Acadêmico: Jhon Abner (RF004, RF010)
    Bordão Oficial: "Onde seu dinheiro cria raízes"
    Permite quitar contas fixas com seleção de conta, divisão do casal, comprovante e quitação do acordo
--}}
<div id="modalRegistrarPagamentoLar" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalRegistrarPagamentoLar')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-start justify-between gap-3">
            <div>
                <h3 class="text-base font-extrabold text-foreground">Registrar pagamento</h3>
                <p id="regPagamentoLarSubtitulo" class="text-xs text-muted-foreground mt-0.5">Despesa fixa do Lar · Divisão 50 / 50</p>
            </div>
            <button type="button" onclick="fecharModalId('modalRegistrarPagamentoLar')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarConfirmarPagamentoDespesaLar(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Card de Detalhe da Despesa -->
            <div class="rounded-2xl border border-border bg-muted/30 p-4 space-y-2.5">
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <h4 id="regPagamentoLarTitulo" class="text-xs font-bold text-muted-foreground">Fatura Nubank Duda</h4>
                        <span class="text-[11px] text-muted-foreground block mt-0.5">Valor total desta parcela</span>
                        <strong id="regPagamentoLarValor" class="text-2xl font-black text-foreground block mt-0.5">R$ 890,00</strong>
                    </div>
                    <span id="regPagamentoLarDivisaoBadge" class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 text-[10px] font-black border border-emerald-500/20">
                        Divisão 50 / 50
                    </span>
                </div>

                <!-- Detalhamento de Cotas do Casal -->
                <div class="pt-2 border-t border-border/60 grid grid-cols-2 gap-2 text-xs">
                    <div class="p-2 rounded-xl bg-card border border-border/60">
                        <span class="text-[10px] font-bold text-muted-foreground block">Sua cota</span>
                        <strong id="regPagamentoLarCotaEu" class="text-xs font-black text-emerald-700 dark:text-emerald-400">R$ 445,00</strong>
                    </div>
                    <div class="p-2 rounded-xl bg-card border border-border/60">
                        <span class="text-[10px] font-bold text-muted-foreground block">Cota do Ian</span>
                        <strong id="regPagamentoLarCotaParceiro" class="text-xs font-black text-foreground">R$ 445,00</strong>
                    </div>
                </div>

                <p id="regPagamentoLarProgressoTxt" class="text-[11px] text-muted-foreground pt-0.5 flex items-center gap-1.5">
                    <i data-lucide="info" class="size-3.5 text-emerald-600 shrink-0"></i>
                    <span>O valor adiantado é creditado na Mesa de Acordos para acerto automático.</span>
                </p>
            </div>

            <!-- De qual conta saiu -->
            <div class="space-y-1.5 pt-1">
                <label class="text-xs font-bold text-foreground">Esse dinheiro saiu de qual conta?</label>
                <p class="text-[11px] text-muted-foreground">O SEIVA registra a saída — o saldo será atualizado na conta escolhida.</p>

                <div class="flex flex-wrap gap-2 pt-1" id="regPagamentoLarContasChips">
                    <button type="button" onclick="selecionarContaPagamentoLar(this, 1)" 
                            class="chip-conta-pag-lar active flex items-center gap-1.5 px-3.5 py-2 rounded-2xl border-2 border-emerald-600 bg-emerald-800 text-white font-bold text-xs transition">
                        <i data-lucide="wallet" class="size-3.5"></i>
                        <span>Nubank Duda</span>
                    </button>
                    <button type="button" onclick="selecionarContaPagamentoLar(this, 2)" 
                            class="chip-conta-pag-lar flex items-center gap-1.5 px-3.5 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="piggy-bank" class="size-3.5"></i>
                        <span>Poupança Caixa</span>
                    </button>
                    <button type="button" onclick="selecionarContaPagamentoLar(this, 3)" 
                            class="chip-conta-pag-lar flex items-center gap-1.5 px-3.5 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="banknote" class="size-3.5"></i>
                        <span>Dinheiro em Espécie</span>
                    </button>
                    <button type="button" onclick="selecionarContaPagamentoLar(this, 4)" 
                            class="chip-conta-pag-lar flex items-center gap-1.5 px-3.5 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="smartphone" class="size-3.5"></i>
                        <span>PicPay</span>
                    </button>
                </div>
                <input type="hidden" id="regPagamentoLarContaId" value="1">
                <input type="hidden" id="regPagamentoLarDespesaId" value="">
                <input type="hidden" id="regPagamentoLarValorInput" value="890.00">
                <input type="hidden" id="regPagamentoLarTituloInput" value="Fatura Nubank Duda">
            </div>

            <!-- Banner Quitação com Alto Contraste -->
            <div class="p-3.5 rounded-2xl bg-emerald-100 dark:bg-emerald-950/60 border border-emerald-300 dark:border-emerald-800 flex items-center justify-center text-center gap-2">
                <i data-lucide="check-circle-2" class="size-4 text-emerald-800 dark:text-emerald-300 shrink-0"></i>
                <span class="text-xs font-black text-emerald-950 dark:text-emerald-100">Com este pagamento você quita o acordo no Lar!</span>
            </div>

            <!-- Comprovante (opcional, mas recomendado) -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Comprovante (opcional, mas recomendado)</label>
                <input type="file" id="regPagamentoLarComprovanteInput" accept="image/*" class="hidden" onchange="aoSelecionarComprovantePagLar(this)">
                <div onclick="document.getElementById('regPagamentoLarComprovanteInput').click()" 
                     id="boxComprovantePagLar"
                     class="flex flex-col items-center justify-center p-4 rounded-2xl border-2 border-dashed border-border bg-muted/20 text-center cursor-pointer hover:border-emerald-500 transition">
                    <i data-lucide="image-plus" class="size-5 text-muted-foreground mb-1"></i>
                    <span class="text-xs font-bold text-foreground">Adicionar foto do comprovante</span>
                    <span class="text-[10px] text-muted-foreground">Anexe o print do Pix ou o recibo bancário para manter o extrato transparente.</span>
                </div>
                <div id="previewComprovantePagLar" class="hidden p-2.5 rounded-xl border border-border bg-card flex items-center justify-between text-xs font-semibold text-emerald-700">
                    <span class="flex items-center gap-1.5"><i data-lucide="check" class="size-3.5"></i> Comprovante anexado</span>
                    <button type="button" onclick="removerComprovantePagLar(event)" class="text-rose-500 text-[11px] font-bold hover:underline">Remover</button>
                </div>
            </div>

            <!-- Botão de Confirmação -->
            <div class="pt-2">
                <button type="submit" id="regPagamentoLarBtnSubmit"
                        class="w-full py-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs shadow-soft transition flex items-center justify-center gap-2">
                    <i data-lucide="check" class="size-4"></i>
                    <span>Confirmar que paguei R$ 890,00</span>
                </button>
            </div>
        </form>
    </div>
</div>
