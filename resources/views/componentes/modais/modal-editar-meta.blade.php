{{-- 
    Modal: Editar Meta / Objetivo (RF007, RF008)
    Permite atualizar dados da meta: foto, link do produto, monitoramento de promoção,
    categoria, ícone condizente e valor alvo planejado.
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="modalEditarMeta" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="fecharModalId('modalEditarMeta')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Mobile drag handle -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60 flex items-start justify-between gap-3">
            <div class="flex items-center gap-2.5">
                <span class="size-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300 flex items-center justify-center border border-emerald-500/20">
                    <i data-lucide="edit-3" class="size-4"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Editar objetivo</h3>
                    <p class="text-xs text-muted-foreground mt-0.5">Atualize imagem, produto ou valor</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalEditarMeta')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarEdicaoMeta(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <input type="hidden" id="editMetaId" value="">

            <!-- Tipo de Meta / Categoria com Ícones Lucide -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Categoria e Ícone</label>
                <div class="flex flex-wrap gap-2" id="editGridCategoriasMeta">
                    <button type="button" onclick="selecionarTipoMetaEdicao(this, 'produto', 'shopping-cart')" class="chip-cat-meta-edit flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-emerald-600 bg-emerald-800 text-white font-bold text-xs transition">
                        <i data-lucide="shopping-cart" class="size-3.5"></i>
                        <span>Comprar produto</span>
                    </button>
                    <button type="button" onclick="selecionarTipoMetaEdicao(this, 'viagem', 'plane')" class="chip-cat-meta-edit flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="plane" class="size-3.5"></i>
                        <span>Viajar</span>
                    </button>
                    <button type="button" onclick="selecionarTipoMetaEdicao(this, 'poupanca', 'piggy-bank')" class="chip-cat-meta-edit flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="piggy-bank" class="size-3.5"></i>
                        <span>Poupança livre</span>
                    </button>
                    <button type="button" onclick="selecionarTipoMetaEdicao(this, 'reserva', 'shield')" class="chip-cat-meta-edit flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="shield" class="size-3.5"></i>
                        <span>Reserva</span>
                    </button>
                    <button type="button" onclick="selecionarTipoMetaEdicao(this, 'curso', 'graduation-cap')" class="chip-cat-meta-edit flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="graduation-cap" class="size-3.5"></i>
                        <span>Curso</span>
                    </button>
                    <button type="button" onclick="selecionarTipoMetaEdicao(this, 'outros', 'sparkles')" class="chip-cat-meta-edit flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="sparkles" class="size-3.5 text-amber-500"></i>
                        <span>Outros</span>
                    </button>
                </div>
                <input type="hidden" id="editMetaCategoria" value="produto">
            </div>

            <!-- Link do Produto (Wishlist / Scraper) -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Link do produto (Mercado Livre, Amazon...)</label>
                <div class="flex items-center gap-2">
                    <input type="url" id="editMetaLinkProduto" class="flex-1 rounded-2xl border border-border bg-background px-4 py-2.5 text-xs text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none shadow-2xs" placeholder="https://...">
                    <button type="button" id="btnBuscarLinkMetaEdit" onclick="buscarDadosLinkProdutoEdit()" class="px-4 py-2.5 rounded-2xl bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 font-bold text-xs hover:bg-emerald-200 transition shrink-0 flex items-center gap-1.5">
                        <i data-lucide="search" class="size-3.5"></i>
                        <span>Buscar</span>
                    </button>
                </div>
                <input type="hidden" id="editMetaLoja" value="">
            </div>

            <!-- Opção de Monitoramento de Promoções -->
            <div class="p-3 rounded-2xl border border-emerald-500/30 bg-emerald-50/50 dark:bg-emerald-950/20 flex items-center justify-between gap-3">
                <div class="flex items-center gap-2.5 min-w-0">
                    <span class="size-8 rounded-xl bg-emerald-100 text-emerald-800 dark:bg-emerald-900/60 dark:text-emerald-300 flex items-center justify-center shrink-0">
                        <i data-lucide="bell" class="size-4"></i>
                    </span>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-foreground leading-tight">Acompanhar promoções</p>
                        <p class="text-[10px] text-muted-foreground leading-tight">Receber alerta quando o preço baixar</p>
                    </div>
                </div>
                <label class="relative inline-flex items-center cursor-pointer shrink-0">
                    <input type="checkbox" id="editMetaMonitorarPromocao" class="sr-only peer" checked>
                    <div class="w-10 h-5 bg-muted peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-border after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-600"></div>
                </label>
            </div>

            <!-- Nome da Meta -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Nome da meta</label>
                <input type="text" id="editMetaNome" required class="w-full rounded-2xl border border-border bg-background px-4 py-2.5 text-xs text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none shadow-2xs" placeholder="Ex: Mouse Gamer Logitech">
            </div>

            <!-- Valor Total -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Valor total planejado</label>
                <div class="relative flex items-center justify-between rounded-2xl border-2 border-emerald-600/70 bg-background px-4 py-2.5 shadow-2xs">
                    <span class="text-xl font-black text-muted-foreground select-none pr-2">R$</span>
                    <input type="text" id="editMetaValor" inputmode="decimal" required class="w-full bg-transparent text-2xl font-black text-foreground text-right focus:outline-none" placeholder="0,00">
                </div>
            </div>

            <!-- Foto do Produto (opcional) -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Foto do objetivo</label>
                <input type="file" id="editMetaFotoArquivo" accept="image/*" class="hidden" onchange="aoSelecionarFotoMetaEdit(this)">
                <input type="hidden" id="editMetaFotoUrl" value="">
                
                <div id="boxUploadFotoMetaEdit" onclick="document.getElementById('editMetaFotoArquivo').click()" 
                     class="flex flex-col items-center justify-center p-4 rounded-2xl border-2 border-dashed border-border bg-muted/20 text-center cursor-pointer hover:border-emerald-500 hover:bg-emerald-50/10 transition group">
                    <div class="size-10 rounded-xl bg-muted/60 text-muted-foreground group-hover:text-emerald-600 group-hover:bg-emerald-100 flex items-center justify-center mb-1.5 transition">
                        <i data-lucide="image-plus" class="size-5"></i>
                    </div>
                    <span class="text-xs font-bold text-foreground">Alterar ou adicionar foto</span>
                    <span class="text-[11px] text-muted-foreground mt-0.5">Adicione foto do item ou comprovante</span>
                </div>

                <!-- Preview de Foto carregada -->
                <div id="previewFotoMetaEditContainer" class="hidden relative rounded-2xl border border-border bg-card p-2 flex items-center gap-3">
                    <img id="previewFotoMetaEditImg" src="" alt="Produto" class="size-14 rounded-xl object-cover shrink-0 border border-border">
                    <div class="min-w-0 flex-1">
                        <span class="text-xs font-bold text-foreground block truncate" id="previewFotoMetaEditTitulo">Foto do produto</span>
                        <span class="text-[10px] text-emerald-600 font-medium flex items-center gap-1">
                            <i data-lucide="check-circle-2" class="size-3"></i> Imagem vinculada
                        </span>
                    </div>
                    <button type="button" onclick="removerFotoMetaEdit(event)" class="size-8 rounded-xl bg-muted hover:bg-rose-50 text-muted-foreground hover:text-rose-600 flex items-center justify-center transition">
                        <i data-lucide="trash-2" class="size-4"></i>
                    </button>
                </div>
            </div>

            <!-- Botões de Ação: Salvar e Excluir -->
            <div class="pt-2 flex flex-col sm:flex-row gap-2">
                <button type="submit" class="flex-1 py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs transition shadow-soft flex items-center justify-center gap-2">
                    <i data-lucide="save" class="size-4"></i>
                    <span>Salvar alterações</span>
                </button>
                <button type="button" onclick="executarExcluirMeta()" class="py-3.5 px-4 rounded-2xl border border-rose-300 dark:border-rose-800 bg-rose-50/50 dark:bg-rose-950/20 hover:bg-rose-100 text-rose-700 dark:text-rose-300 font-extrabold text-xs transition flex items-center justify-center gap-1.5 shadow-2xs">
                    <i data-lucide="trash-2" class="size-4"></i>
                    <span>Excluir</span>
                </button>
            </div>
        </form>
    </div>
</div>
