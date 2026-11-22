{{-- 
    Modal: Personalizar Ícone e Categoria da Despesa (UX/UI SEIVA)
    Permite ao usuário definir o ícone oficial Lucide específico e a categoria correta para qualquer transação.
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="modalPersonalizarIconeTransacao" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-xs" onclick="fecharModalId('modalPersonalizarIconeTransacao')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.22s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Mobile drag handle -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60 flex items-start justify-between gap-3">
            <div class="flex items-center gap-2.5">
                <span class="size-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300 flex items-center justify-center border border-emerald-500/20">
                    <i data-lucide="tag" class="size-4"></i>
                </span>
                <div>
                    <h3 class="text-sm font-extrabold text-foreground">Personalizar Despesa</h3>
                    <p class="text-xs text-muted-foreground mt-0.5" id="personalizarTxSubHeader">Escolha o ícone e a categoria oficial</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalPersonalizarIconeTransacao')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarIconeTransacao(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <input type="hidden" id="personalizarTxId" value="">

            <!-- Resumo da Transação -->
            <div class="p-3.5 rounded-2xl border border-border bg-muted/30 flex items-center justify-between gap-3">
                <div class="flex items-center gap-3 min-w-0">
                    <span id="personalizarTxPreviewIconBox" class="size-10 rounded-2xl bg-card border border-border text-emerald-700 flex items-center justify-center shrink-0 shadow-2xs">
                        <i id="personalizarTxPreviewIcon" data-lucide="credit-card" class="size-5"></i>
                    </span>
                    <div class="min-w-0">
                        <h4 id="personalizarTxTitulo" class="text-xs font-black text-foreground truncate">Sephora</h4>
                        <span id="personalizarTxSub" class="text-[11px] text-muted-foreground">Saída</span>
                    </div>
                </div>
                <strong id="personalizarTxValor" class="text-sm font-black text-foreground shrink-0">R$ 187,00</strong>
            </div>

            <!-- Seleção de Categoria -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Categoria da Despesa</label>
                <div class="grid grid-cols-2 gap-2" id="gridCategoriasPersonalizar">
                    <!-- Gerado dinamicamente ou fixado com as 10 categorias oficiais -->
                    <button type="button" onclick="selecionarCategoriaModalTx(this, 'Beleza', 'sparkles')" class="chip-cat-tx p-2.5 rounded-xl border border-border bg-card text-xs font-bold text-left flex items-center gap-2 hover:bg-muted/40 transition">
                        <i data-lucide="sparkles" class="size-4 text-pink-500"></i>
                        <span>Beleza</span>
                    </button>
                    <button type="button" onclick="selecionarCategoriaModalTx(this, 'Saúde', 'activity')" class="chip-cat-tx p-2.5 rounded-xl border border-border bg-card text-xs font-bold text-left flex items-center gap-2 hover:bg-muted/40 transition">
                        <i data-lucide="activity" class="size-4 text-rose-500"></i>
                        <span>Saúde</span>
                    </button>
                    <button type="button" onclick="selecionarCategoriaModalTx(this, 'Alimentação', 'utensils')" class="chip-cat-tx p-2.5 rounded-xl border border-border bg-card text-xs font-bold text-left flex items-center gap-2 hover:bg-muted/40 transition">
                        <i data-lucide="utensils" class="size-4 text-emerald-600"></i>
                        <span>Alimentação</span>
                    </button>
                    <button type="button" onclick="selecionarCategoriaModalTx(this, 'Mercado', 'shopping-cart')" class="chip-cat-tx p-2.5 rounded-xl border border-border bg-card text-xs font-bold text-left flex items-center gap-2 hover:bg-muted/40 transition">
                        <i data-lucide="shopping-cart" class="size-4 text-emerald-700"></i>
                        <span>Mercado</span>
                    </button>
                    <button type="button" onclick="selecionarCategoriaModalTx(this, 'Moradia', 'home')" class="chip-cat-tx p-2.5 rounded-xl border border-border bg-card text-xs font-bold text-left flex items-center gap-2 hover:bg-muted/40 transition">
                        <i data-lucide="home" class="size-4 text-blue-600"></i>
                        <span>Moradia</span>
                    </button>
                    <button type="button" onclick="selecionarCategoriaModalTx(this, 'Transporte', 'car')" class="chip-cat-tx p-2.5 rounded-xl border border-border bg-card text-xs font-bold text-left flex items-center gap-2 hover:bg-muted/40 transition">
                        <i data-lucide="car" class="size-4 text-amber-500"></i>
                        <span>Transporte</span>
                    </button>
                    <button type="button" onclick="selecionarCategoriaModalTx(this, 'Lazer', 'clapperboard')" class="chip-cat-tx p-2.5 rounded-xl border border-border bg-card text-xs font-bold text-left flex items-center gap-2 hover:bg-muted/40 transition">
                        <i data-lucide="clapperboard" class="size-4 text-purple-600"></i>
                        <span>Lazer</span>
                    </button>
                    <button type="button" onclick="selecionarCategoriaModalTx(this, 'Presente', 'gift')" class="chip-cat-tx p-2.5 rounded-xl border border-border bg-card text-xs font-bold text-left flex items-center gap-2 hover:bg-muted/40 transition">
                        <i data-lucide="gift" class="size-4 text-rose-600"></i>
                        <span>Presente</span>
                    </button>
                    <button type="button" onclick="selecionarCategoriaModalTx(this, 'Trabalho & Freela', 'briefcase')" class="chip-cat-tx p-2.5 rounded-xl border border-border bg-card text-xs font-bold text-left flex items-center gap-2 hover:bg-muted/40 transition">
                        <i data-lucide="briefcase" class="size-4 text-indigo-600"></i>
                        <span>Trabalho & Freela</span>
                    </button>
                    <button type="button" onclick="selecionarCategoriaModalTx(this, 'Outros', 'credit-card')" class="chip-cat-tx p-2.5 rounded-xl border border-border bg-card text-xs font-bold text-left flex items-center gap-2 hover:bg-muted/40 transition">
                        <i data-lucide="credit-card" class="size-4 text-slate-500"></i>
                        <span>Outros / Cartão</span>
                    </button>
                </div>
                <input type="hidden" id="personalizarTxCategoriaNome" value="Beleza">
            </div>

            <!-- Seleção do Ícone Lucide Específico -->
            <div class="space-y-1.5 pt-1">
                <label class="text-xs font-bold text-foreground">Escolher Ícone Específico</label>
                <div class="grid grid-cols-6 gap-2" id="gridIconesPersonalizar">
                    <!-- Ícones mais comuns -->
                    <button type="button" onclick="selecionarIconeModalTx(this, 'sparkles')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Beleza">
                        <i data-lucide="sparkles" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'activity')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Atividade / Fitness">
                        <i data-lucide="activity" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'utensils')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Alimentação">
                        <i data-lucide="utensils" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'shopping-cart')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Mercado">
                        <i data-lucide="shopping-cart" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'home')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Moradia">
                        <i data-lucide="home" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'car')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Transporte">
                        <i data-lucide="car" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'pill')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Saúde">
                        <i data-lucide="pill" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'clapperboard')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Lazer">
                        <i data-lucide="clapperboard" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'gift')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Presente">
                        <i data-lucide="gift" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'briefcase')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Trabalho">
                        <i data-lucide="briefcase" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'wifi')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Internet">
                        <i data-lucide="wifi" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'zap')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Energia">
                        <i data-lucide="zap" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'credit-card')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Cartão">
                        <i data-lucide="credit-card" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'wallet')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Carteira">
                        <i data-lucide="wallet" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'heart-pulse')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Cuidado / Saúde">
                        <i data-lucide="heart-pulse" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'shield')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Segurança / Reserva">
                        <i data-lucide="shield" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'plane')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Viagem">
                        <i data-lucide="plane" class="size-4"></i>
                    </button>
                    <button type="button" onclick="selecionarIconeModalTx(this, 'graduation-cap')" class="chip-ico-tx p-2.5 rounded-xl border border-border bg-card flex items-center justify-center hover:bg-muted transition" title="Educação">
                        <i data-lucide="graduation-cap" class="size-4"></i>
                    </button>
                </div>
                <input type="hidden" id="personalizarTxIconeEscolhido" value="credit-card">
            </div>

            <!-- Botão Salvar -->
            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm transition shadow-soft flex items-center justify-center gap-2">
                    <i data-lucide="check" class="size-4"></i>
                    <span>Salvar ícone e categoria</span>
                </button>
            </div>
        </form>
    </div>
</div>
