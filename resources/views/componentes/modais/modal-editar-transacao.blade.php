{{-- 
    Modal: Editar Transação (RF003)
    Responsáveis Acadêmicos: Victor Hugo / Jhon Abner
    Permite editar completamente título, valor, tipo (entrada/saída), categoria, conta, data e visibilidade,
    além de permitir a exclusão imediata com reversão automática de saldo bancário.
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="modalEditarTransacao" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalEditarTransacao')"></div>

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
                    <h3 class="text-base font-extrabold text-foreground">Editar Transação</h3>
                    <p class="text-xs text-muted-foreground">Atualize valores, categoria, conta ou remova o lançamento</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalEditarTransacao')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarEdicaoTransacao(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <input type="hidden" id="editTxId" value="">

            <!-- Tipo: Saída vs Entrada -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Tipo de Movimentação</label>
                <div class="grid grid-cols-2 gap-2 p-1.5 rounded-2xl bg-muted/50 border border-border/80" id="editTxGridTipo">
                    <button type="button" id="editTxBtnTipoSaida" onclick="selecionarEditTipoTransacao('saida')" 
                            class="w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all bg-card text-foreground shadow-2xs border border-border/50">
                        <i data-lucide="arrow-down-right" class="size-4 text-rose-500"></i>
                        <span>Despesa / Saída</span>
                    </button>
                    <button type="button" id="editTxBtnTipoEntrada" onclick="selecionarEditTipoTransacao('entrada')" 
                            class="w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all text-muted-foreground hover:text-foreground">
                        <i data-lucide="arrow-up-right" class="size-4 text-emerald-600"></i>
                        <span>Receita / Entrada</span>
                    </button>
                </div>
                <input type="hidden" id="editTxTipo" value="saida">
            </div>

            <!-- Título da Transação -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Descrição / Título</label>
                <input type="text" id="editTxTitulo" required
                       placeholder="Ex: Supermercado, Aluguel, Salário, Farmácia"
                       class="w-full h-11 px-4 rounded-2xl border border-border bg-card text-sm font-semibold text-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
            </div>

            <!-- Valor e Data -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-foreground">Valor (R$)</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-sm font-bold text-muted-foreground">R$</span>
                        <input type="number" step="0.01" id="editTxValor" required
                               placeholder="0,00"
                               class="w-full h-11 pl-10 pr-3 rounded-2xl border border-border bg-card text-base font-black text-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-foreground">Data da Movimentação</label>
                    <input type="date" id="editTxData" required
                           class="w-full h-11 px-3 rounded-2xl border border-border bg-card text-xs font-semibold text-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
                </div>
            </div>

            <!-- Conta Bancária de Origem/Destino -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Conta Bancária</label>
                <select id="editTxContaId" required
                        class="w-full h-11 px-3.5 rounded-2xl border border-border bg-card text-xs font-bold text-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
                    <!-- Preenchido dinamicamente via JS -->
                </select>
            </div>

            <!-- Categoria com Chips Visuais -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Categoria</label>
                <div class="flex flex-wrap gap-2" id="editGridCategoriasTx">
                    <button type="button" onclick="selecionarEditCategoriaTx(this, 'Moradia', 'home')" class="chip-edit-cat-tx flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="home" class="size-3.5"></i>
                        <span>Moradia</span>
                    </button>
                    <button type="button" onclick="selecionarEditCategoriaTx(this, 'Alimentação', 'utensils')" class="chip-edit-cat-tx flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="utensils" class="size-3.5"></i>
                        <span>Alimentação</span>
                    </button>
                    <button type="button" onclick="selecionarEditCategoriaTx(this, 'Transporte', 'car')" class="chip-edit-cat-tx flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="car" class="size-3.5"></i>
                        <span>Transporte</span>
                    </button>
                    <button type="button" onclick="selecionarEditCategoriaTx(this, 'Saúde', 'pill')" class="chip-edit-cat-tx flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="pill" class="size-3.5"></i>
                        <span>Saúde</span>
                    </button>
                    <button type="button" onclick="selecionarEditCategoriaTx(this, 'Lazer', 'film')" class="chip-edit-cat-tx flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="film" class="size-3.5"></i>
                        <span>Lazer</span>
                    </button>
                    <button type="button" onclick="selecionarEditCategoriaTx(this, 'Mercado', 'shopping-cart')" class="chip-edit-cat-tx flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="shopping-cart" class="size-3.5"></i>
                        <span>Mercado</span>
                    </button>
                    <button type="button" onclick="selecionarEditCategoriaTx(this, 'Beleza', 'sparkles')" class="chip-edit-cat-tx flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="sparkles" class="size-3.5"></i>
                        <span>Beleza</span>
                    </button>
                    <button type="button" onclick="selecionarEditCategoriaTx(this, 'Presente', 'gift')" class="chip-edit-cat-tx flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="gift" class="size-3.5"></i>
                        <span>Presente</span>
                    </button>
                </div>
                <input type="hidden" id="editTxCategoriaNome" value="">
                <input type="hidden" id="editTxCategoriaId" value="">
            </div>

            <!-- Destino: Privado vs Compartilhado do Lar -->
            <div class="space-y-1.5 pt-1">
                <label class="text-xs font-bold text-foreground">Visibilidade no Casal</label>
                <div class="grid grid-cols-2 gap-2 p-1.5 rounded-2xl bg-muted/50 border border-border/80">
                    <button type="button" id="editTxBtnPrivado" onclick="selecionarEditVisibilidadeTx('pessoal')" 
                            class="w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all bg-card text-foreground shadow-2xs border border-border/50">
                        <i data-lucide="lock" class="size-4 text-foreground"></i>
                        <span>Manter privado</span>
                    </button>
                    <button type="button" id="editTxBtnCompartilhado" onclick="selecionarEditVisibilidadeTx('compartilhado')" 
                            class="w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all text-muted-foreground hover:text-foreground">
                        <i data-lucide="share-2" class="size-4 text-emerald-600"></i>
                        <span>Compartilhar (Lar)</span>
                    </button>
                </div>
                <input type="hidden" id="editTxVisibilidade" value="pessoal">
            </div>

            <!-- Botões de Ação: Salvar e Excluir -->
            <div class="pt-2 flex flex-col sm:flex-row gap-2">
                <button type="submit" 
                        class="flex-1 py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs shadow-soft transition flex items-center justify-center gap-2">
                    <i data-lucide="check" class="size-4"></i>
                    <span>Salvar Alterações</span>
                </button>
                <button type="button" onclick="executarExcluirTransacaoModal()" 
                        class="py-3.5 px-4 rounded-2xl border border-rose-300 dark:border-rose-800 bg-rose-50/50 dark:bg-rose-950/20 hover:bg-rose-100 text-rose-700 dark:text-rose-300 font-extrabold text-xs transition flex items-center justify-center gap-1.5 shadow-2xs">
                    <i data-lucide="trash-2" class="size-4"></i>
                    <span>Excluir</span>
                </button>
            </div>
        </form>
    </div>
</div>
