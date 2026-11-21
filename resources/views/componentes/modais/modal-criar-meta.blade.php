{{-- 
    Modal: Criar Meta / Conquistar Objetivo (Protótipo Imagens 10 e 11)
    Permite criar metas individuais, do lar ou compartilhadas, com link de produto e wishlist
--}}
<div id="modalCriarMeta" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="fecharModalId('modalCriarMeta')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60 flex items-start justify-between gap-3">
            <div>
                <h3 class="text-base font-extrabold text-foreground">O que você quer conquistar?</h3>
                <p class="text-xs text-muted-foreground mt-0.5">Defina sua próxima meta</p>
            </div>
            <button type="button" onclick="fecharModalId('modalCriarMeta')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarNovaMeta(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Tipo de Meta -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Tipo de meta</label>
                <div class="flex flex-wrap gap-2">
                    <button type="button" onclick="selecionarTipoMeta(this, 'produto', 'shopping-bag')" class="chip-cat-meta active flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-emerald-600 bg-emerald-800 text-white font-bold text-xs transition">
                        <i data-lucide="shopping-bag" class="size-3.5"></i>
                        <span>Comprar produto</span>
                    </button>
                    <button type="button" onclick="selecionarTipoMeta(this, 'viagem', 'plane')" class="chip-cat-meta flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="plane" class="size-3.5"></i>
                        <span>Viajar</span>
                    </button>
                    <button type="button" onclick="selecionarTipoMeta(this, 'poupanca', 'piggy-bank')" class="chip-cat-meta flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="piggy-bank" class="size-3.5"></i>
                        <span>Poupança livre</span>
                    </button>
                    <button type="button" onclick="selecionarTipoMeta(this, 'reserva', 'shield')" class="chip-cat-meta flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="shield" class="size-3.5"></i>
                        <span>Reserva</span>
                    </button>
                    <button type="button" onclick="selecionarTipoMeta(this, 'curso', 'graduation-cap')" class="chip-cat-meta flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                        <i data-lucide="graduation-cap" class="size-3.5"></i>
                        <span>Curso</span>
                    </button>
                </div>
                <input type="hidden" id="novaMetaCategoria" value="produto">
            </div>

            <!-- Link do Produto (Wishlist scraper) -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Cole o link do produto (Mercado Livre, Amazon...)</label>
                <div class="flex items-center gap-2">
                    <input type="url" id="novaMetaLinkProduto" class="flex-1 rounded-2xl border border-border bg-background px-4 py-2.5 text-xs text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none shadow-2xs" placeholder="https://...">
                    <button type="button" onclick="buscarDadosLinkProduto()" class="px-4 py-2.5 rounded-2xl bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 font-bold text-xs hover:bg-emerald-200 transition shrink-0">
                        Buscar
                    </button>
                </div>
            </div>

            <!-- Nome da Meta -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Nome da meta</label>
                <input type="text" id="novaMetaNome" required class="w-full rounded-2xl border border-border bg-background px-4 py-2.5 text-xs text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none shadow-2xs" placeholder="Ex: Viagem Portugal">
            </div>

            <!-- Valor Total -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Valor total da meta</label>
                <div class="relative flex items-center rounded-2xl border-2 border-emerald-600/70 bg-background px-4 py-2.5 shadow-2xs">
                    <span class="text-base font-black text-muted-foreground select-none pr-2">R$</span>
                    <input type="text" id="novaMetaValor" inputmode="decimal" required class="w-full bg-transparent text-xl font-black text-foreground focus:outline-none" placeholder="0,00">
                </div>
            </div>

            <!-- Foto do Produto (opcional) -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Foto do produto (opcional)</label>
                <div class="flex flex-col items-center justify-center p-3.5 rounded-2xl border-2 border-dashed border-border bg-muted/20 text-center cursor-pointer hover:border-emerald-500 transition">
                    <i data-lucide="image-plus" class="size-6 text-muted-foreground mb-1"></i>
                    <span class="text-xs font-bold text-foreground">Adicionar foto</span>
                    <span class="text-[11px] text-muted-foreground">O link nem sempre traz imagem — adicione a sua se quiser</span>
                </div>
            </div>

            <!-- De quem é essa meta? (3 Opções do Protótipo Imagem 11) -->
            <div class="space-y-2 pt-1">
                <label class="text-xs font-bold text-foreground block">De quem é essa meta?</label>

                <!-- Opção 1: Só minha -->
                <button type="button" onclick="selecionarPosseMeta(this, 'so_minha')" 
                        class="chip-posse-meta active w-full flex items-center justify-between p-3.5 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition">
                    <div class="flex items-center gap-3">
                        <span class="size-8 rounded-xl bg-emerald-800 text-white flex items-center justify-center shrink-0">
                            <i data-lucide="lock" class="size-4"></i>
                        </span>
                        <div>
                            <strong class="text-xs font-extrabold text-foreground block">Só minha</strong>
                            <span class="text-[11px] text-muted-foreground">Objetivo pessoal, eu banco sozinha</span>
                        </div>
                    </div>
                    <i data-lucide="check" class="size-4 text-emerald-600"></i>
                </button>

                <!-- Opção 2: Do Lar, pago sozinha -->
                <button type="button" onclick="selecionarPosseMeta(this, 'lar')" 
                        class="chip-posse-meta w-full flex items-center justify-between p-3.5 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/20">
                    <div class="flex items-center gap-3">
                        <span class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                            <i data-lucide="home" class="size-4"></i>
                        </span>
                        <div>
                            <strong class="text-xs font-extrabold text-foreground block">Do Lar, pago sozinha</strong>
                            <span class="text-[11px] text-muted-foreground">É para a casa, mas eu assumo o valor</span>
                        </div>
                    </div>
                </button>

                <!-- Opção 3: Compartilhada -->
                <button type="button" onclick="selecionarPosseMeta(this, 'compartilhada')" 
                        class="chip-posse-meta w-full flex items-center justify-between p-3.5 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/20">
                    <div class="flex items-center gap-3">
                        <span class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                            <i data-lucide="users" class="size-4"></i>
                        </span>
                        <div>
                            <strong class="text-xs font-extrabold text-foreground block">Compartilhada</strong>
                            <span class="text-[11px] text-muted-foreground">Para o Lar e preciso de ajuda do parceiro</span>
                        </div>
                    </div>
                </button>

                <!-- Aviso amarelo: visível apenas quando "Compartilhada" é selecionada -->
                <div id="avisoMetaCompartilhada" class="hidden mt-2 p-3.5 rounded-2xl bg-amber-50 dark:bg-amber-950/30 border border-amber-200 dark:border-amber-800 space-y-2.5">
                    <div class="flex items-start gap-2">
                        <i data-lucide="info" class="size-4 text-amber-600 dark:text-amber-400 shrink-0 mt-0.5"></i>
                        <p class="text-xs text-amber-800 dark:text-amber-300 font-medium">
                            Metas compartilhadas precisam de aprovação do seu parceiro. Leve para a <strong>Mesa de Acordos</strong> para negociar juntos.
                        </p>
                    </div>
                    <button type="button" onclick="levarMetaParaAcordos()" class="w-full py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs transition flex items-center justify-center gap-2">
                        <i data-lucide="handshake" class="size-3.5"></i>
                        → Levar para a Mesa de Acordos
                    </button>
                </div>

                <input type="hidden" id="novaMetaPosse" value="so_minha">
            </div>

            <!-- Botão Submit -->
            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm transition shadow-soft flex items-center justify-center gap-2">
                    <i data-lucide="shopping-cart" class="size-4"></i>
                    <span>Criar minha meta</span>
                </button>
            </div>
        </form>
    </div>
</div>
