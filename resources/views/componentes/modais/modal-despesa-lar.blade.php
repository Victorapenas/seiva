{{-- 
    Componente Modal: Lançar Despesa do Lar
    Responsável Acadêmico: Jhon Abner (RF004, RF010)
    Bordão Oficial: "Onde seu dinheiro cria raízes"
    Funcionalidade: Cadastro de despesas compartilhadas com divisão proporcional à renda (60/40),
    50/50, categorias, indicação de despesa extraordinária/imprevisto e simulação do rateio em tempo real.
--}}
<div id="modalDespesaLar" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalDespesaLar')"></div>

    <div class="relative w-full sm:max-w-lg bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center border border-emerald-500/20">
                    <i data-lucide="receipt" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Lançar Despesa do Lar</h3>
                    <p class="text-xs text-muted-foreground">Divisão justa e sem atrito no Nosso Cantinho</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalDespesaLar')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="salvarDespesaLarForm(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Título da Despesa -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Nome da Despesa</label>
                <input type="text" id="formLarDespTitulo" required
                       placeholder="Ex: Aluguel do Mês, Supermercado, Conserto Chuveiro"
                       class="w-full h-12 px-4 rounded-2xl border border-border bg-card text-sm font-semibold text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
            </div>

            <!-- Valor e Categoria -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-foreground">Valor Total (R$)</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-sm font-bold text-muted-foreground">R$</span>
                        <input type="number" step="0.01" id="formLarDespValor" required
                               placeholder="0,00" oninput="atualizarSimulacaoRateioLar()"
                               class="w-full h-12 pl-10 pr-3 rounded-2xl border border-border bg-card text-base font-black text-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-foreground">Vencimento</label>
                    <input type="date" id="formLarDespData" required
                           class="w-full h-12 px-3 rounded-2xl border border-border bg-card text-xs font-semibold text-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
                </div>
            </div>

            <!-- Tipo de Despesa: Fixa vs Variável -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Tipo de Custo no Lar</label>
                <div class="grid grid-cols-2 gap-2" id="gridTipoDespesaLar">
                    <button type="button" onclick="selecionarTipoDespesaLar(this, 'fixa')" 
                            class="chip-tipo-desp-lar active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition flex items-center gap-2.5">
                        <i data-lucide="calendar" class="size-4 text-emerald-600"></i>
                        <div>
                            <strong class="text-xs font-extrabold text-foreground block">Despesa Fixa</strong>
                            <span class="text-[10px] text-muted-foreground">Aluguel, Luz, Internet</span>
                        </div>
                    </button>
                    <button type="button" onclick="selecionarTipoDespesaLar(this, 'variavel')" 
                            class="chip-tipo-desp-lar p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30 flex items-center gap-2.5">
                        <i data-lucide="shopping-cart" class="size-4 text-muted-foreground"></i>
                        <div>
                            <strong class="text-xs font-extrabold text-foreground block">Gasto Variável</strong>
                            <span class="text-[10px] text-muted-foreground">Mercado, Feira, Farmácia</span>
                        </div>
                    </button>
                </div>
                <input type="hidden" id="formLarDespTipo" value="fixa">
            </div>

            <!-- Switch de Despesa Extraordinária / Imprevisto (Alto Contraste WCAG AAA Garantido) -->
            <div class="p-3.5 rounded-2xl space-y-2.5 shadow-2xs"
                 style="background-color: #fef3c7 !important; border: 1.5px solid #f59e0b !important;">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="size-7 rounded-xl flex items-center justify-center shrink-0" style="background-color: #fde68a !important; color: #b45309 !important;">
                            <i data-lucide="alert-triangle" class="size-4" style="color: #b45309 !important;"></i>
                        </span>
                        <div>
                            <strong class="text-xs font-black block" style="color: #451a03 !important;">Despesa Extraordinária / Imprevisto</strong>
                            <span class="text-[10px] font-bold" style="color: #78350f !important;">Gasto fora da rotina planejada do mês</span>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="formLarDespExtraordinaria" class="sr-only peer" onchange="alternarAvisoExtraordinaria(this.checked)">
                        <div class="w-11 h-6 bg-amber-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-600"></div>
                    </label>
                </div>
                <!-- Box de Explicação com Fundo Branco Sólido e Tipografia Escura de Máximo Contraste -->
                <div id="avisoExtraordinariaTxt" class="hidden p-3 rounded-xl shadow-2xs leading-relaxed"
                     style="background-color: #ffffff !important; border: 1.5px solid #fbbf24 !important; color: #451a03 !important;">
                    <p class="text-xs font-semibold" style="color: #451a03 !important;">
                        <strong style="color: #78350f !important; font-weight: 900 !important;">💡 Como entra na conta:</strong> Despesas extraordinárias são imprevistos (ex: vazamento, conserto de eletro). Elas <strong style="color: #065f46 !important;">não distorcem o custo fixo mensal</strong> do casal e entram na <strong>Mesa de Acordos</strong> para rateio pontual sem afetar metas de longo prazo.
                    </p>
                </div>
            </div>

            <!-- Regra de Divisão: Proporcional vs 50/50 -->
            <div class="space-y-1.5 pt-1">
                <label class="text-xs font-bold text-foreground">Regra de Divisão do Casal</label>
                <div class="grid grid-cols-2 gap-2" id="gridRegraDivisaoLar">
                    <button type="button" onclick="selecionarRegraDivisaoLar(this, 'proporcional')" 
                            class="chip-regra-divisao active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition">
                        <div class="flex items-center justify-between">
                            <strong class="text-xs font-extrabold text-foreground">Proporcional</strong>
                            <span class="px-1.5 py-0.5 rounded-md bg-emerald-600 text-white text-[9px] font-black">Recomendado</span>
                        </div>
                        <span class="text-[10px] text-muted-foreground block mt-1">Duda (40%) · Ian (60%) de acordo com a renda</span>
                    </button>

                    <button type="button" onclick="selecionarRegraDivisaoLar(this, '50/50')" 
                            class="chip-regra-divisao p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30">
                        <strong class="text-xs font-extrabold text-foreground block">50% / 50%</strong>
                        <span class="text-[10px] text-muted-foreground block mt-1">Metade exata para cada um</span>
                    </button>
                </div>
                <input type="hidden" id="formLarDespDivisao" value="proporcional">
            </div>

            <!-- SIMULAÇÃO DO RATEIO EM TEMPO REAL -->
            <div class="p-3.5 rounded-2xl bg-muted/40 border border-border space-y-2">
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-muted-foreground block">
                    Simulação do Rateio Desta Despesa
                </span>
                <div class="grid grid-cols-2 gap-2">
                    <div class="p-2.5 rounded-xl bg-card border border-border/60">
                        <div class="flex items-center gap-1.5 mb-1">
                            <span class="size-5 rounded-full bg-pink-100 text-pink-700 text-[10px] font-black flex items-center justify-center">ME</span>
                            <span class="text-[11px] font-bold text-foreground">Parte da Duda</span>
                        </div>
                        <strong id="simulacaoParteDuda" class="text-sm font-black text-foreground">R$ 0,00</strong>
                        <span id="simulacaoPctDuda" class="text-[10px] text-muted-foreground block mt-0.5">(40% do total)</span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-card border border-border/60">
                        <div class="flex items-center gap-1.5 mb-1">
                            <span class="size-5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-black flex items-center justify-center">IM</span>
                            <span class="text-[11px] font-bold text-foreground">Parte do Ian</span>
                        </div>
                        <strong id="simulacaoParteIan" class="text-sm font-black text-foreground">R$ 0,00</strong>
                        <span id="simulacaoPctIan" class="text-[10px] text-muted-foreground block mt-0.5">(60% do total)</span>
                    </div>
                </div>
            </div>

            <!-- Botão de Ação -->
            <div class="pt-2">
                <button type="submit" 
                        class="w-full py-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs shadow-soft transition flex items-center justify-center gap-2">
                    <i data-lucide="check" class="size-4"></i>
                    <span>Calcular Rateio & Lançar no Lar</span>
                </button>
            </div>
        </form>
    </div>
</div>
