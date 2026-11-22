{{-- 
    Modal: Lançar Gasto (Protótipo Oficial Imagens 3 e 4)
    Design ágil, intuitivo, 100% orientado a ícones Lucide, sem nenhum uso de emojis.
--}}
<div id="modalLancarGasto" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/45 backdrop-blur-xs" onclick="fecharModalId('modalLancarGasto')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.22s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/50 flex items-start justify-between gap-3">
            <div>
                <h3 class="text-base font-extrabold text-foreground">Lançar gasto</h3>
                <p class="text-xs text-muted-foreground mt-0.5">Registre uma saída rapidinho</p>
            </div>
            <button type="button" onclick="fecharModalId('modalLancarGasto')" class="size-8 rounded-xl border border-border bg-muted/30 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarGastoRapido(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Campo de Valor em Destaque -->
            <div class="relative flex items-center rounded-2xl border-2 border-emerald-700/60 bg-background px-4 py-3 shadow-2xs focus-within:border-emerald-700 focus-within:ring-2 focus-within:ring-emerald-700/20 transition">
                <span class="text-lg font-black text-foreground select-none pr-2">R$</span>
                <input type="text" id="gastoInputValor" inputmode="decimal" required 
                       class="w-full bg-transparent text-2xl sm:text-3xl font-black text-foreground focus:outline-none tracking-tight" placeholder="0,00">
            </div>

            <!-- Campo Descrição: O que foi? -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">O que foi?</label>
                <input type="text" id="gastoInputTitulo" required 
                       class="w-full rounded-2xl border border-border bg-background px-4 py-3 text-xs text-foreground placeholder:text-muted-foreground focus:border-emerald-700 focus:outline-none shadow-2xs transition" 
                       placeholder="Ex: Mercado Dia a Dia">
            </div>

            <!-- Categoria: Grid de 8 Botões com Ícones (Protótipo Imagens 3 e 4) -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-foreground">Categoria</label>
                <div id="gastoGridCategorias" class="grid grid-cols-4 gap-2">
                    <!-- 1. Moradia (ativo por padrão) -->
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Moradia', 'home')" 
                            class="cat-chip active flex flex-col items-center justify-center p-3 rounded-2xl border-2 border-emerald-800 bg-emerald-800 text-white font-bold text-xs transition shadow-2xs">
                        <i data-lucide="home" class="size-5 mb-1.5 stroke-[2.2]"></i>
                        <span>Moradia</span>
                    </button>
                    <!-- 2. Alimentação -->
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Alimentação', 'utensils')" 
                            class="cat-chip flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/40 font-bold text-xs transition shadow-2xs">
                        <i data-lucide="utensils" class="size-5 mb-1.5 stroke-[2]"></i>
                        <span>Alimentação</span>
                    </button>
                    <!-- 3. Transporte -->
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Transporte', 'car')" 
                            class="cat-chip flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/40 font-bold text-xs transition shadow-2xs">
                        <i data-lucide="car" class="size-5 mb-1.5 stroke-[2]"></i>
                        <span>Transporte</span>
                    </button>
                    <!-- 4. Saúde -->
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Saúde', 'pill')" 
                            class="cat-chip flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/40 font-bold text-xs transition shadow-2xs">
                        <i data-lucide="pill" class="size-5 mb-1.5 stroke-[2]"></i>
                        <span>Saúde</span>
                    </button>
                    <!-- 5. Lazer -->
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Lazer', 'film')" 
                            class="cat-chip flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/40 font-bold text-xs transition shadow-2xs">
                        <i data-lucide="film" class="size-5 mb-1.5 stroke-[2]"></i>
                        <span>Lazer</span>
                    </button>
                    <!-- 6. Mercado -->
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Mercado', 'shopping-cart')" 
                            class="cat-chip flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/40 font-bold text-xs transition shadow-2xs">
                        <i data-lucide="shopping-cart" class="size-5 mb-1.5 stroke-[2]"></i>
                        <span>Mercado</span>
                    </button>
                    <!-- 7. Beleza -->
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Beleza', 'sparkles')" 
                            class="cat-chip flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/40 font-bold text-xs transition shadow-2xs">
                        <i data-lucide="sparkles" class="size-5 mb-1.5 stroke-[2]"></i>
                        <span>Beleza</span>
                    </button>
                    <!-- 8. Presente -->
                    <button type="button" onclick="selecionarCategoriaGasto(this, 'Presente', 'gift')" 
                            class="cat-chip flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/40 font-bold text-xs transition shadow-2xs">
                        <i data-lucide="gift" class="size-5 mb-1.5 stroke-[2]"></i>
                        <span>Presente</span>
                    </button>
                </div>
                <input type="hidden" id="gastoCategoriaSelecionada" value="Moradia">
                <input type="hidden" id="gastoIconeSelecionado" value="home">
            </div>

            <!-- Seleção de Conta: Chips Arredondados tipo Pílula -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-foreground">Conta</label>
                <div id="gastoChipsContas" class="flex flex-wrap gap-2">
                    <button type="button" onclick="selecionarContaGastoChip(this, 'Nubank', 1)" 
                            class="chip-conta-btn active px-4 py-2 rounded-full border-2 border-emerald-800 bg-emerald-800 text-white font-bold text-xs transition shadow-2xs">
                        Nubank
                    </button>
                    <button type="button" onclick="selecionarContaGastoChip(this, 'Poupança', 2)" 
                            class="chip-conta-btn px-4 py-2 rounded-full border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition shadow-2xs">
                        Poupança
                    </button>
                    <button type="button" onclick="selecionarContaGastoChip(this, 'Dinheiro', 3)" 
                            class="chip-conta-btn px-4 py-2 rounded-full border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition shadow-2xs">
                        Dinheiro
                    </button>
                </div>
                <input type="hidden" id="gastoContaIdSelecionada" value="1">
            </div>

            <!-- Switch / Card: Despesa Extraordinária / Imprevisto -->
            <div class="space-y-2 rounded-2xl border border-emerald-600/20 bg-emerald-50/40 dark:bg-emerald-950/30 dark:border-emerald-800/40 p-3.5 transition">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2.5 text-xs font-bold text-foreground">
                        <span class="size-7 rounded-xl bg-amber-500/15 text-amber-600 dark:text-amber-400 border border-amber-500/20 flex items-center justify-center shrink-0">
                            <i data-lucide="alert-triangle" class="size-4"></i>
                        </span>
                        <div>
                            <span class="block text-xs font-bold text-foreground">Despesa Extraordinária / Imprevisto</span>
                            <span class="text-[10px] text-muted-foreground">Gastos fora do orçamento habitual do mês</span>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer shrink-0">
                        <input type="checkbox" id="gastoIsImprevisto" onchange="aoAlternarImprevistoGasto(this.checked)" class="sr-only peer">
                        <div class="w-10 h-6 bg-muted peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-700"></div>
                    </label>
                </div>

                <!-- Explicação Didática da Despesa Extraordinária e Matemática do Orçamento -->
                <div id="textoAvisoImprevistoGasto" class="hidden pt-2 border-t border-emerald-600/15 space-y-1.5 text-[11px] leading-relaxed text-muted-foreground animate-fadeIn">
                    <div class="flex items-start gap-1.5 text-foreground font-semibold">
                        <i data-lucide="help-circle" class="size-3.5 text-emerald-600 dark:text-emerald-400 shrink-0 mt-0.5"></i>
                        <span>Como isso entra na conta do Lar?</span>
                    </div>
                    <p class="text-[11px] text-muted-foreground">
                        <strong>O que é:</strong> Gastos pontuais não planejados (ex: farmácia emergencial, conserto de eletrodoméstico ou vazamento).
                    </p>
                    <p class="text-[11px] text-muted-foreground">
                        <strong>Na matemática do SEIVA:</strong> O valor sai da sua conta, mas recebe a marcação <em>[Extraordinária]</em> para não distorcer a média do seu custo fixo mensal e poder ser compensado pela <strong>Reserva de Emergência</strong> ou rateado em parcelas suaves.
                    </p>
                </div>
            </div>

            <!-- Segmented Control: Manter privado vs Compartilhar -->
            <div id="gastoContainerCompartilhar" class="space-y-2">
                <label class="text-xs font-bold text-foreground block">Destino da Despesa</label>
                <div class="grid grid-cols-2 gap-2 p-1.5 rounded-2xl bg-muted/50 border border-border/80">
                    <button type="button" id="btnGastoPrivado" onclick="selecionarVisibilidadeGasto('privado')" 
                            class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl font-bold text-xs transition-all bg-card text-foreground shadow-2xs border border-border/50">
                        <i data-lucide="lock" class="size-4 shrink-0 text-foreground"></i>
                        <span>Manter privado</span>
                    </button>
                    <button type="button" id="btnGastoCompartilhado" onclick="selecionarVisibilidadeGasto('compartilhado')" 
                            class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl font-bold text-xs transition-all text-muted-foreground hover:text-foreground">
                        <i data-lucide="share-2" class="size-4 shrink-0 text-emerald-600 dark:text-emerald-400"></i>
                        <span>Compartilhar</span>
                    </button>
                </div>
                <input type="hidden" id="gastoVisibilidade" value="privado">

                <!-- Explicação Didática: Privado vs Compartilhado -->
                <div id="gastoExplicacaoVisibilidade" class="rounded-xl border border-border/70 bg-card/60 p-2.5 text-[11px] text-muted-foreground flex items-start gap-2">
                    <i id="gastoExplicacaoIcone" data-lucide="shield" class="size-3.5 text-muted-foreground shrink-0 mt-0.5"></i>
                    <span id="gastoExplicacaoTexto" class="leading-relaxed">
                        <strong>Privado:</strong> Apenas você visualiza este gasto na sua Caixa Preta e extrato individual. O parceiro não tem acesso e o valor não entra na divisão de contas do Lar.
                    </span>
                </div>
            </div>

            <!-- Botão Submit: Registrar gasto -->
            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm transition shadow-soft flex items-center justify-center">
                    <span>Registrar gasto</span>
                </button>
            </div>
        </form>
    </div>
</div>
