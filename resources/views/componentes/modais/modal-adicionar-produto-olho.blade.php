{{-- 
    Modal: Adicionar Produto de Olho (Wishlist / Radar de Preços)
    Permite cadastrar produtos da internet para monitorar preços e transformar em metas futuras
    Responsável Acadêmico: Ian Marcos / Victor Hugo (RF007, RF008)
--}}
<div id="modalAdicionarProdutoOlho" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="fecharModalId('modalAdicionarProdutoOlho')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] border border-border transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Header -->
        <div class="px-6 pt-5 pb-4 border-b border-border/60 flex items-start justify-between gap-3 bg-muted/20">
            <div class="flex items-center gap-3">
                <span class="size-9 rounded-2xl bg-emerald-800 text-white flex items-center justify-center shrink-0 shadow-soft">
                    <i data-lucide="shopping-bag" class="size-4.5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Novo Produto de Olho</h3>
                    <p class="text-xs text-muted-foreground">Monitore ofertas e planeje sua compra</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalAdicionarProdutoOlho')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarProdutoOlhoModal(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Link do Produto com Scraper Automático -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground flex items-center justify-between">
                    <span>Link do produto (Opcional)</span>
                    <span class="text-[10px] text-emerald-700 dark:text-emerald-400 font-semibold">Busca automática</span>
                </label>
                <div class="flex items-center gap-2">
                    <input type="url" id="modalProdOlhoLink" placeholder="https://mercadolivre.com.br/... ou amazon..." 
                           class="flex-1 px-4 py-2.5 rounded-2xl bg-background border border-border text-xs text-foreground placeholder:text-muted-foreground focus:border-emerald-500 focus:outline-none shadow-2xs">
                    <button type="button" id="btnBuscarLinkProdOlho" onclick="buscarDadosLinkProdOlhoModal()" 
                            class="px-3.5 py-2.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white text-xs font-bold transition flex items-center gap-1 shrink-0 shadow-2xs">
                        <i data-lucide="search" class="size-3.5"></i>
                        <span>Buscar</span>
                    </button>
                </div>
                <p class="text-[10px] text-muted-foreground">Cole o link da Amazon ou Mercado Livre para carregar dados direto da loja.</p>
            </div>

            <!-- Preview da Foto se encontrada -->
            <div id="modalProdOlhoPreviewFoto" class="hidden p-3 rounded-2xl bg-emerald-50/50 dark:bg-emerald-950/30 border border-emerald-500/30 flex items-center gap-3">
                <img id="modalProdOlhoImg" src="" alt="Produto" class="size-12 rounded-xl object-cover border border-emerald-500/20 shadow-2xs shrink-0">
                <div class="min-w-0 flex-1">
                    <span class="text-[10px] font-bold text-emerald-700 dark:text-emerald-300 uppercase">Foto encontrada</span>
                    <p id="modalProdOlhoImgTit" class="text-xs font-bold text-foreground truncate"></p>
                </div>
            </div>
            <input type="hidden" id="modalProdOlhoFotoUrl" value="">

            <!-- Nome do Produto -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Nome do produto *</label>
                <input type="text" id="modalProdOlhoNome" required placeholder="Ex: Notebook Dell, Geladeira Inox, Fone..." 
                       class="w-full px-4 py-2.5 rounded-2xl bg-background border border-border text-xs text-foreground placeholder:text-muted-foreground focus:border-emerald-500 focus:outline-none shadow-2xs">
            </div>

            <!-- Destino do Produto: Para mim vs Para nossa casa -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Para quem é esse desejo?</label>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" onclick="selecionarDestinoProdOlho(this, 'individual')"
                            id="btnDestinoProdIndividual"
                            class="chip-destino-prod active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/50 dark:bg-emerald-950/40 text-left transition flex items-center gap-2.5">
                        <span class="size-7 rounded-xl bg-emerald-800 text-white flex items-center justify-center shrink-0 shadow-2xs">
                            <i data-lucide="user" class="size-3.5"></i>
                        </span>
                        <div>
                            <strong class="text-xs font-black text-foreground block">Para mim</strong>
                            <span class="text-[10px] text-muted-foreground">Uso pessoal</span>
                        </div>
                    </button>
                    <button type="button" onclick="selecionarDestinoProdOlho(this, 'lar')"
                            id="btnDestinoProdLar"
                            class="chip-destino-prod p-3 rounded-2xl border border-border bg-card text-left transition flex items-center gap-2.5 hover:bg-muted/20">
                        <span class="size-7 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                            <i data-lucide="home" class="size-3.5"></i>
                        </span>
                        <div>
                            <strong class="text-xs font-black text-foreground block">Para nossa casa</strong>
                            <span class="text-[10px] text-muted-foreground">Casal / Lar</span>
                        </div>
                    </button>
                </div>
                <input type="hidden" id="modalProdOlhoTipo" value="individual">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <!-- Preço Estimado -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-foreground">Preço (R$) *</label>
                    <input type="text" id="modalProdOlhoPreco" required inputmode="decimal" placeholder="0,00" 
                           class="w-full px-4 py-2.5 rounded-2xl bg-background border border-border text-xs text-foreground placeholder:text-muted-foreground focus:border-emerald-500 focus:outline-none shadow-2xs">
                </div>

                <!-- Loja Online -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-foreground">Loja / Onde comprar</label>
                    <input type="text" id="modalProdOlhoLoja" placeholder="Ex: Amazon, Mercado Livre" 
                           class="w-full px-4 py-2.5 rounded-2xl bg-background border border-border text-xs text-foreground placeholder:text-muted-foreground focus:border-emerald-500 focus:outline-none shadow-2xs">
                </div>
            </div>

            <!-- Botões de Ação -->
            <div class="pt-2 flex gap-2">
                <button type="submit" 
                        class="flex-1 py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs transition flex items-center justify-center gap-2 shadow-soft">
                    <i data-lucide="check" class="size-4"></i>
                    <span>Salvar nos Produtos de Olho</span>
                </button>
                <button type="button" onclick="fecharModalId('modalAdicionarProdutoOlho')" 
                        class="px-4 py-3.5 rounded-2xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground text-xs font-bold transition">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>
