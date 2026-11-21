{{-- 
    Modal: Guardar em Meta / Aporte Financeiro (Protótipo Imagem 12)
    Permite aportar valores de contas específicas diretamente em uma meta individual ou do Lar
--}}
<div id="modalGuardarMeta" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="fecharModalId('modalGuardarMeta')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60 flex items-start justify-between gap-3">
            <div>
                <h3 id="modalGuardarMetaTituloHeader" class="text-base font-extrabold text-foreground">Guardar em Notebook Dell</h3>
                <p id="modalGuardarMetaSubHeader" class="text-xs text-muted-foreground mt-0.5">Meta pessoal</p>
            </div>
            <button type="button" onclick="fecharModalId('modalGuardarMeta')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarGuardarNaMeta(event)" class="p-6 space-y-5 overflow-y-auto no-scrollbar">
            <!-- Card de Progresso Atual -->
            <div class="p-4 rounded-3xl bg-muted/30 border border-border space-y-2.5">
                <div class="flex items-center gap-3">
                    <span class="size-9 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0">
                        <i data-lucide="target" class="size-4"></i>
                    </span>
                    <div class="flex-1 flex items-center justify-between text-xs">
                        <span class="font-bold text-muted-foreground">Progresso atual</span>
                        <strong id="modalGuardarMetaValoresTxt" class="font-extrabold text-foreground">R$ 4.050,00 de R$ 4.500,00</strong>
                    </div>
                </div>
                <div class="h-2 w-full rounded-full bg-muted overflow-hidden">
                    <div id="modalGuardarMetaBarra" class="h-full bg-emerald-600 rounded-full transition-all" style="width: 90%"></div>
                </div>
                <p id="modalGuardarMetaSeraPct" class="text-[11px] font-bold text-emerald-600 pt-0.5">Será 90% após guardar</p>
            </div>

            <!-- Quanto Guardar Agora -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-foreground">Quanto você quer guardar agora?</label>
                <div class="relative flex items-center rounded-2xl border-2 border-emerald-600/70 bg-background px-4 py-3 shadow-2xs focus-within:border-emerald-600 transition">
                    <span class="text-base font-black text-muted-foreground select-none pr-2">R$</span>
                    <input type="text" id="guardarMetaInputValor" inputmode="decimal" required class="w-full bg-transparent text-2xl font-black text-foreground focus:outline-none tracking-tight" placeholder="0,00" oninput="aoMudarValorAporteMeta(this.value)">
                </div>

                <!-- Chips de Atalho Rápido (Protótipo Imagem 12) -->
                <div class="grid grid-cols-4 gap-2 pt-1">
                    <button type="button" onclick="definirValorAporteMeta(50)" class="chip-aporte-val py-2 rounded-xl border border-border bg-card hover:bg-emerald-50 dark:hover:bg-emerald-950/40 text-foreground text-xs font-bold transition text-center shadow-2xs">
                        R$ 50
                    </button>
                    <button type="button" onclick="definirValorAporteMeta(100)" class="chip-aporte-val py-2 rounded-xl border border-border bg-card hover:bg-emerald-50 dark:hover:bg-emerald-950/40 text-foreground text-xs font-bold transition text-center shadow-2xs">
                        R$ 100
                    </button>
                    <button type="button" onclick="definirValorAporteMeta(200)" class="chip-aporte-val py-2 rounded-xl border-2 border-emerald-600 bg-emerald-50/50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300 text-xs font-black transition text-center shadow-2xs">
                        R$ 200
                    </button>
                    <button type="button" onclick="definirValorAporteMeta(500)" class="chip-aporte-val py-2 rounded-xl border border-border bg-card hover:bg-emerald-50 dark:hover:bg-emerald-950/40 text-foreground text-xs font-bold transition text-center shadow-2xs">
                        R$ 500
                    </button>
                </div>

                <!-- Atalho "Usar minha parte do mês" (Protótipo Imagem 6) -->
                <div class="pt-0.5">
                    <button type="button" onclick="definirValorAporteMeta(250)" class="text-xs font-bold text-emerald-700 dark:text-emerald-400 hover:underline inline-flex items-center gap-1">
                        <span>Usar minha parte do mês (R$ 250,00)</span>
                    </button>
                </div>
            </div>

            <!-- De qual conta está tirando -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground block">De qual conta você está tirando?</label>
                <p class="text-[11px] text-muted-foreground">O valor será descontado da conta escolhida.</p>
                <div id="guardarMetaChipsContas" class="grid grid-cols-2 gap-2 pt-1">
                    <!-- Injetado dinamicamente via JS com cards de conta -->
                </div>
                <input type="hidden" id="guardarMetaContaId" value="">
                <input type="hidden" id="guardarMetaId" value="">
            </div>

            <!-- Dica Motivacional (dinâmica via JS) -->
            <div id="guardarMetaDicaMotivacional" class="p-3 rounded-2xl bg-muted/40 text-center text-xs text-muted-foreground font-medium border border-border/40">
                Quase lá. Você vai conseguir.
            </div>

            <!-- Seção de destino (metas do lar) -->
            <div id="guardarMetaSecaoLar" class="space-y-3">
                <div class="p-4 rounded-2xl bg-emerald-50/80 dark:bg-emerald-950/30 border border-emerald-200/80 dark:border-emerald-800/50 space-y-2">
                    <div class="flex items-center gap-1.5 text-xs font-bold text-emerald-800 dark:text-emerald-300">
                        <i data-lucide="arrow-right" class="size-3.5"></i>
                        <span>Para onde o dinheiro vai</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-foreground">
                        <i data-lucide="users" class="size-4 text-emerald-600 shrink-0"></i>
                        <span>Conta de <strong id="guardarMetaDestinoNome" class="font-extrabold">Conta conjunta</strong></span>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-muted-foreground">
                        <i data-lucide="wallet" class="size-4 text-emerald-600 shrink-0"></i>
                        <span id="guardarMetaDestinoSub">Poupança Caixa (conjunta)</span>
                    </div>
                    <div class="flex items-center justify-between gap-2 pt-1 border-t border-emerald-200/50 dark:border-emerald-800/40">
                        <p id="guardarMetaDestinoPix" class="text-xs text-muted-foreground font-medium"></p>
                        <button type="button" onclick="copiarPixMeta()" class="px-3 py-1.5 rounded-xl border border-emerald-300 dark:border-emerald-700 bg-white dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300 text-xs font-bold hover:bg-emerald-100 transition flex items-center gap-1.5">
                            <i data-lucide="copy" class="size-3"></i> Copiar Chave Pix
                        </button>
                    </div>
                </div>

                <!-- Comprovante da transferência (opcional, mas recomendado) (Imagem 6) -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-foreground">Comprovante da transferência (opcional, mas recomendado)</label>
                    <div class="flex flex-col items-center justify-center p-3.5 rounded-2xl border-2 border-dashed border-border bg-muted/20 text-center cursor-pointer hover:border-emerald-500 hover:bg-emerald-50/10 transition group" onclick="document.getElementById('guardarMetaComprovante').click()">
                        <div class="size-8 rounded-xl bg-muted/60 text-muted-foreground group-hover:text-emerald-600 group-hover:bg-emerald-100 flex items-center justify-center mb-1 transition">
                            <i data-lucide="image-plus" class="size-4"></i>
                        </div>
                        <span class="text-xs font-bold text-foreground">Adicionar comprovante</span>
                        <input type="file" id="guardarMetaComprovante" accept="image/*" class="hidden">
                    </div>
                </div>
            </div>

            <!-- Botão CTA -->
            <div class="pt-1">
                <button type="submit" class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm transition shadow-soft flex items-center justify-center gap-2">
                    <i data-lucide="check" class="size-4"></i>
                    <span>Guardar agora</span>
                </button>
            </div>
        </form>
    </div>
</div>
