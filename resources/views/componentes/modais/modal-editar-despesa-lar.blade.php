{{-- 
    Modal: Editar Despesa do Lar
    Responsável Acadêmico: Jhon Abner (RF004, RF010)
    Bordão Oficial: "Onde seu dinheiro cria raízes"
    Permite atualizar valores de contas do Lar (ex: reajuste de aluguel),
    regra de rateio (proporcional 60/40 vs 50/50), vencimento e tipo de despesa.
--}}
<div id="modalEditarDespesaLar" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalEditarDespesaLar')"></div>

    <div class="relative w-full sm:max-w-lg bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center border border-emerald-500/20">
                    <i data-lucide="edit-3" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Editar Despesa do Lar</h3>
                    <p class="text-xs text-muted-foreground">Atualize valores reajustados, datas ou regra de rateio</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalEditarDespesaLar')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarEdicaoDespesaLar(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <input type="hidden" id="editLarDespId" value="">

            <!-- Título da Despesa -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Nome da Despesa</label>
                <input type="text" id="editLarDespTitulo" required
                       placeholder="Ex: Aluguel, Conta de Luz, Internet Vivo"
                       class="w-full h-12 px-4 rounded-2xl border border-border bg-card text-sm font-semibold text-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
            </div>

            <!-- Valor Reajustado e Vencimento -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-foreground">Valor Total Reajustado (R$)</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-sm font-bold text-muted-foreground">R$</span>
                        <input type="number" step="0.01" id="editLarDespValor" required
                               placeholder="0,00" oninput="atualizarSimulacaoEdicaoRateioLar()"
                               class="w-full h-12 pl-10 pr-3 rounded-2xl border border-border bg-card text-base font-black text-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-foreground">Vencimento</label>
                    <input type="date" id="editLarDespData" required
                           class="w-full h-12 px-3 rounded-2xl border border-border bg-card text-xs font-semibold text-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
                </div>
            </div>

            <!-- Tipo de Custo no Lar -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Tipo de Custo no Lar</label>
                <div class="grid grid-cols-2 gap-2" id="gridEditTipoDespesaLar">
                    <button type="button" onclick="selecionarEditTipoDespesaLar(this, 'fixa')" 
                            class="chip-edit-tipo-lar active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition flex items-center gap-2.5">
                        <i data-lucide="calendar" class="size-4 text-emerald-600"></i>
                        <div>
                            <strong class="text-xs font-extrabold text-foreground block">Despesa Fixa</strong>
                            <span class="text-[10px] text-muted-foreground">Aluguel, Luz, Água</span>
                        </div>
                    </button>
                    <button type="button" onclick="selecionarEditTipoDespesaLar(this, 'variavel')" 
                            class="chip-edit-tipo-lar p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30 flex items-center gap-2.5">
                        <i data-lucide="shopping-cart" class="size-4 text-muted-foreground"></i>
                        <div>
                            <strong class="text-xs font-extrabold text-foreground block">Gasto Variável</strong>
                            <span class="text-[10px] text-muted-foreground">Mercado, Delivery</span>
                        </div>
                    </button>
                </div>
                <input type="hidden" id="editLarDespTipo" value="fixa">
            </div>

            <!-- Regra de Divisão: Proporcional vs 50/50 -->
            <div class="space-y-1.5 pt-1">
                <label class="text-xs font-bold text-foreground">Regra de Divisão do Casal</label>
                <div class="grid grid-cols-2 gap-2" id="gridEditRegraDivisaoLar">
                    <button type="button" onclick="selecionarEditRegraDivisaoLar(this, 'proporcional')" 
                            class="chip-edit-regra-divisao active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition">
                        <div class="flex items-center justify-between">
                            <strong class="text-xs font-extrabold text-foreground">Proporcional</strong>
                            <span class="px-1.5 py-0.5 rounded-md bg-emerald-600 text-white text-[9px] font-black">Recomendado</span>
                        </div>
                        <span class="text-[10px] text-muted-foreground block mt-1">Duda (40%) · Ian (60%)</span>
                    </button>

                    <button type="button" onclick="selecionarEditRegraDivisaoLar(this, '50/50')" 
                            class="chip-edit-regra-divisao p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30">
                        <strong class="text-xs font-extrabold text-foreground block">50% / 50%</strong>
                        <span class="text-[10px] text-muted-foreground block mt-1">Metade exata para cada</span>
                    </button>
                </div>
                <input type="hidden" id="editLarDespDivisao" value="proporcional">
            </div>

            <!-- SIMULAÇÃO DO NOVO RATEIO APÓS O REAJUSTE -->
            <div class="p-3.5 rounded-2xl bg-muted/40 border border-border space-y-2">
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-muted-foreground block">
                    Novo Rateio com o Valor Atualizado
                </span>
                <div class="grid grid-cols-2 gap-2">
                    <div class="p-2.5 rounded-xl bg-card border border-border/60">
                        <div class="flex items-center gap-1.5 mb-1">
                            <span class="size-5 rounded-full bg-pink-100 text-pink-700 text-[10px] font-black flex items-center justify-center">ME</span>
                            <span class="text-[11px] font-bold text-foreground">Nova Cota Duda</span>
                        </div>
                        <strong id="editSimulacaoParteDuda" class="text-sm font-black text-foreground">R$ 0,00</strong>
                        <span id="editSimulacaoPctDuda" class="text-[10px] text-muted-foreground block mt-0.5">(40% do total)</span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-card border border-border/60">
                        <div class="flex items-center gap-1.5 mb-1">
                            <span class="size-5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-black flex items-center justify-center">IM</span>
                            <span class="text-[11px] font-bold text-foreground">Nova Cota Ian</span>
                        </div>
                        <strong id="editSimulacaoParteIan" class="text-sm font-black text-foreground">R$ 0,00</strong>
                        <span id="editSimulacaoPctIan" class="text-[10px] text-muted-foreground block mt-0.5">(60% do total)</span>
                    </div>
                </div>
            </div>

            <!-- Botões de Ação -->
            <div class="pt-2 flex flex-col sm:flex-row gap-2">
                <button type="submit" 
                        class="flex-1 py-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs shadow-soft transition flex items-center justify-center gap-2">
                    <i data-lucide="check" class="size-4"></i>
                    <span>Salvar Reajuste & Recalcular Rateio</span>
                </button>
                <button type="button" onclick="executarExcluirDespesaLar()" 
                        class="py-4 px-4 rounded-2xl border border-rose-300 dark:border-rose-800 bg-rose-50/50 dark:bg-rose-950/20 hover:bg-rose-100 text-rose-700 dark:text-rose-300 font-extrabold text-xs transition flex items-center justify-center gap-1.5 shadow-2xs">
                    <i data-lucide="trash-2" class="size-4"></i>
                    <span>Excluir</span>
                </button>
            </div>
        </form>
    </div>
</div>
