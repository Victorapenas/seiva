{{-- 
    Modal: Criar / Editar Despesa Fixa Individual (Caixa Preta / Controle Pessoal)
    Responsáveis Acadêmicos: Victor Hugo (RF002 / RF003)
    Bordão Oficial: "Onde seu dinheiro cria raízes"
    Permite cadastrar despesas estritamente pessoais que não convêm ao parceiro
    ou para gestão financeira de usuários solteiros (ex: faculdade, academia, plano de saúde).
--}}
<div id="modalDespesaIndividual" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalDespesaIndividual')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300 flex items-center justify-center border border-emerald-500/20 shadow-2xs">
                    <i id="iconeHeaderModalDespIndiv" data-lucide="receipt" class="size-5"></i>
                </span>
                <div>
                    <h3 id="tituloHeaderModalDespIndiv" class="text-base font-extrabold text-foreground">Nova Despesa Fixa Pessoal</h3>
                    <p class="text-xs text-muted-foreground">Privada · só você vê e administra</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalDespesaIndividual')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarDespesaIndividual(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <input type="hidden" id="formDespIndivId" value="">

            <!-- Título da Despesa -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Nome da despesa pessoal</label>
                <input type="text" id="formDespIndivTitulo" required 
                       class="w-full rounded-2xl border border-border bg-background px-4 py-3 text-xs text-foreground placeholder:text-muted-foreground focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600 shadow-2xs" 
                       placeholder="Ex: Faculdade, Academia, Plano de Saúde, Alura">
            </div>

            <!-- Valor e Vencimento -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-foreground">Valor mensal</label>
                    <div class="relative flex items-center justify-between rounded-2xl border border-border bg-background px-3.5 py-2.5 shadow-2xs">
                        <span class="text-sm font-bold text-muted-foreground select-none pr-1">R$</span>
                        <input type="text" id="formDespIndivValor" inputmode="decimal" required 
                               class="w-full bg-transparent text-base font-extrabold text-foreground text-right focus:outline-none" 
                               placeholder="0,00">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-foreground">Dia do vencimento</label>
                    <div class="relative flex items-center justify-between rounded-2xl border border-border bg-background px-3.5 py-2.5 shadow-2xs">
                        <span class="text-xs font-semibold text-muted-foreground select-none pr-1">Dia</span>
                        <input type="number" min="1" max="31" id="formDespIndivDia" required 
                               class="w-full bg-transparent text-base font-extrabold text-foreground text-right focus:outline-none" 
                               value="10" placeholder="10">
                    </div>
                </div>
            </div>

            <!-- Escolha de Ícone Representativo -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Ícone representativo</label>
                <div class="flex flex-wrap gap-2" id="gridIconesDespIndiv">
                    <button type="button" onclick="selecionarIconeDespIndiv(this, 'graduation-cap')" class="chip-icone-desp-indiv active p-2.5 rounded-xl border-2 border-emerald-600 bg-emerald-50/50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300 transition" title="Educação / Curso">
                        <i data-lucide="graduation-cap" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeDespIndiv(this, 'dumbbell')" class="chip-icone-desp-indiv p-2.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground transition" title="Academia / Saúde física">
                        <i data-lucide="dumbbell" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeDespIndiv(this, 'heart-pulse')" class="chip-icone-desp-indiv p-2.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground transition" title="Saúde / Convênio">
                        <i data-lucide="heart-pulse" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeDespIndiv(this, 'brain')" class="chip-icone-desp-indiv p-2.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground transition" title="Terapia / Psicologia">
                        <i data-lucide="brain" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeDespIndiv(this, 'wifi')" class="chip-icone-desp-indiv p-2.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground transition" title="Internet / Conexão">
                        <i data-lucide="wifi" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeDespIndiv(this, 'smartphone')" class="chip-icone-desp-indiv p-2.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground transition" title="Celular / Plano móvel">
                        <i data-lucide="smartphone" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeDespIndiv(this, 'shield')" class="chip-icone-desp-indiv p-2.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground transition" title="Seguro / Proteção">
                        <i data-lucide="shield" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeDespIndiv(this, 'receipt')" class="chip-icone-desp-indiv p-2.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground transition" title="Geral / Conta fixa">
                        <i data-lucide="receipt" class="size-4"></i>
                    </button>
                </div>
                <input type="hidden" id="formDespIndivIcone" value="graduation-cap">
            </div>

            <!-- Detalhe Opcional -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Observação ou detalhe (opcional)</label>
                <input type="text" id="formDespIndivDetalhe" 
                       class="w-full rounded-2xl border border-border bg-background px-4 py-2.5 text-xs text-foreground placeholder:text-muted-foreground focus:border-emerald-600 focus:outline-none shadow-2xs" 
                       placeholder="Ex: Pós em Engenharia, Plano Black, Mensalidade anual">
            </div>

            <!-- Botões de Ação -->
            <div class="pt-2 flex flex-col sm:flex-row gap-2">
                <button type="submit" class="flex-1 py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs transition shadow-soft flex items-center justify-center gap-2 cursor-pointer">
                    <i data-lucide="save" class="size-4"></i>
                    <span id="btnSalvarDespIndivTexto">Salvar Despesa Fixa</span>
                </button>
                <button type="button" onclick="fecharModalId('modalDespesaIndividual')" class="py-3.5 px-4 rounded-2xl border border-border bg-card hover:bg-muted text-foreground font-bold text-xs transition shadow-2xs">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>
