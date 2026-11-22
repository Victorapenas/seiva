{{-- 
    Modal: Divisão Personalizada de Despesas do Lar (RF004 / RF010)
    Responsável Acadêmico: Jhon Abner
    Permite ao casal definir a proporção justa da divisão das contas do lar
    (50/50, Proporcional ou Personalizada livre como 90%/10%, 70%/30%, etc.)
--}}
<div id="modalDivisaoPersonalizada" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalDivisaoPersonalizada')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center border border-emerald-500/20">
                    <i data-lucide="scale" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Regra de Divisão do Lar</h3>
                    <p class="text-xs text-muted-foreground">Como o casal divide os custos da casa</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalDivisaoPersonalizada')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarDivisaoLar(event)" class="p-6 space-y-5 overflow-y-auto no-scrollbar">
            <!-- 3 Opções de Regra de Divisão -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-foreground block">Modelo de Rateio</label>
                <div class="grid grid-cols-1 gap-2">
                    <!-- Opção 1: 50% / 50% -->
                    <button type="button" onclick="selecionarTipoDivisaoLar('igualitaria')" id="btnDivisao5050"
                            class="opcao-divisao p-3.5 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition flex items-center justify-between">
                        <div>
                            <strong class="text-xs font-black text-foreground block">50% / 50% (Igualitária)</strong>
                            <span class="text-[11px] text-muted-foreground">Cada um paga exatamente a metade de todas as contas da casa.</span>
                        </div>
                        <i data-lucide="check" class="size-4 text-emerald-600 shrink-0"></i>
                    </button>

                    <!-- Opção 2: Proporcional à renda -->
                    <button type="button" onclick="selecionarTipoDivisaoLar('proporcional')" id="btnDivisaoProporcional"
                            class="opcao-divisao p-3.5 rounded-2xl border border-border bg-card text-left transition flex items-center justify-between hover:border-emerald-500/50">
                        <div>
                            <div class="flex items-center gap-1.5">
                                <strong class="text-xs font-black text-foreground block">Proporcional à Renda</strong>
                                <span class="px-1.5 py-0.5 rounded bg-emerald-600 text-white text-[9px] font-black">Justo</span>
                            </div>
                            <span class="text-[11px] text-muted-foreground">Calculado automaticamente de acordo com o salário de cada um.</span>
                        </div>
                        <i data-lucide="check" class="size-4 text-emerald-600 shrink-0 hidden"></i>
                    </button>

                    <!-- Opção 3: Personalizada Livre -->
                    <button type="button" onclick="selecionarTipoDivisaoLar('customizada')" id="btnDivisaoCustomizada"
                            class="opcao-divisao p-3.5 rounded-2xl border border-border bg-card text-left transition flex items-center justify-between hover:border-emerald-500/50">
                        <div>
                            <strong class="text-xs font-black text-foreground block">Personalizada Livre (%)</strong>
                            <span class="text-[11px] text-muted-foreground">Defina livremente qualquer percentual (ex: 90%/10%, 70%/30%, 80%/20%).</span>
                        </div>
                        <i data-lucide="check" class="size-4 text-emerald-600 shrink-0 hidden"></i>
                    </button>
                </div>
                <input type="hidden" id="formDivisaoTipo" value="igualitaria">
            </div>

            <!-- Box Interativo de Slider para Divisão Personalizada -->
            <div id="boxDivisaoCustomizada" class="hidden p-4 rounded-2xl border border-emerald-300/80 bg-emerald-50/50 dark:bg-emerald-950/30 space-y-3">
                <div class="flex items-center justify-between text-xs font-black text-foreground">
                    <span id="labelNomeMeuPct">Você: 50%</span>
                    <span id="labelNomeParceiroPct">Parceiro: 50%</span>
                </div>

                <input type="range" min="5" max="95" step="5" value="50" id="sliderDivisaoPct" oninput="atualizarSliderDivisao(this.value)"
                       class="w-full accent-emerald-600 cursor-pointer">

                <div class="grid grid-cols-2 gap-2 pt-1">
                    <div class="p-2.5 rounded-xl bg-card border border-border text-center">
                        <span class="text-[10px] text-muted-foreground block font-bold">Sua participação</span>
                        <strong class="text-lg font-black text-emerald-600" id="txtMeuPctDisplay">50%</strong>
                    </div>
                    <div class="p-2.5 rounded-xl bg-card border border-border text-center">
                        <span class="text-[10px] text-muted-foreground block font-bold">Participação do parceiro</span>
                        <strong class="text-lg font-black text-foreground" id="txtParceiroPctDisplay">50%</strong>
                    </div>
                </div>

                <input type="hidden" id="formDivisaoMeuPct" value="50">
                <input type="hidden" id="formDivisaoParceiroPct" value="50">
            </div>

            <div class="pt-2 flex gap-2">
                <button type="submit" class="flex-1 py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs shadow-soft transition cursor-pointer flex items-center justify-center gap-1.5">
                    <i data-lucide="check" class="size-4"></i>
                    <span>Confirmar Divisão do Lar</span>
                </button>
                <button type="button" onclick="fecharModalId('modalDivisaoPersonalizada')" class="py-3.5 px-4 rounded-2xl border border-border bg-card hover:bg-muted text-foreground font-bold text-xs shadow-2xs transition">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>
