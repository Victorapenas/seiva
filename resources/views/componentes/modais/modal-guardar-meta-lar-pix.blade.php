{{-- 
    Modal: Guardar em Meta do Lar com Chave Pix (Imagem 7)
    Permite transferir o valor para o responsável pela meta do casal e anexar comprovante
--}}
<div id="modalGuardarMetaLarPix" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="fecharModalId('modalGuardarMetaLarPix')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60 flex items-start justify-between gap-3">
            <div>
                <h3 id="guardarMetaLarPixTituloHeader" class="text-base font-extrabold text-foreground">Guardar em Geladeira Samsung</h3>
                <p class="text-xs text-muted-foreground mt-0.5">Meta do Lar</p>
            </div>
            <button type="button" onclick="fecharModalId('modalGuardarMetaLarPix')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarAporteMetaLarPix(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Card de Progresso Atual -->
            <div class="rounded-2xl border border-border bg-muted/30 p-4 space-y-2.5">
                <div class="flex items-center gap-3">
                    <span class="size-9 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center shrink-0">
                        <i id="guardarMetaLarPixIcone" data-lucide="snowflake" class="size-4"></i>
                    </span>
                    <div class="min-w-0 flex-1">
                        <span class="text-[11px] font-semibold text-muted-foreground block">Progresso atual</span>
                        <strong id="guardarMetaLarPixProgressoValores" class="text-xs font-black text-foreground">R$ 1.000,00 de R$ 3.200,00</strong>
                    </div>
                </div>
                <div class="h-2 w-full rounded-full bg-muted overflow-hidden">
                    <div id="guardarMetaLarPixBarra" class="h-full bg-amber-500 rounded-full" style="width: 31%"></div>
                </div>
                <p id="guardarMetaLarPixSeraTxt" class="text-[11px] text-emerald-700 dark:text-emerald-400 font-bold">Será 31% após guardar</p>
            </div>

            <!-- Quanto você quer guardar agora? -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Quanto você quer guardar agora?</label>
                <div class="relative flex items-center rounded-2xl border-2 border-emerald-600/70 bg-background px-4 py-2.5 shadow-2xs">
                    <span class="text-xl font-black text-muted-foreground select-none pr-2">R$</span>
                    <input type="text" id="guardarMetaLarPixInputValor" inputmode="decimal" required 
                           oninput="atualizarCalculoMetaLarPix(this.value)"
                           class="w-full bg-transparent text-2xl font-black text-foreground focus:outline-none" placeholder="0,00">
                </div>

                <div class="flex flex-wrap items-center gap-2 pt-1">
                    <button type="button" onclick="preencherValorMetaLarPix(50)" class="px-3.5 py-1.5 rounded-xl border border-border bg-card hover:bg-muted font-bold text-xs text-foreground transition shadow-2xs">R$ 50</button>
                    <button type="button" onclick="preencherValorMetaLarPix(100)" class="px-3.5 py-1.5 rounded-xl border border-border bg-card hover:bg-muted font-bold text-xs text-foreground transition shadow-2xs">R$ 100</button>
                    <button type="button" onclick="preencherValorMetaLarPix(200)" class="px-3.5 py-1.5 rounded-xl border border-border bg-card hover:bg-muted font-bold text-xs text-foreground transition shadow-2xs">R$ 200</button>
                    <button type="button" onclick="preencherValorMetaLarPix(500)" class="px-3.5 py-1.5 rounded-xl border border-border bg-card hover:bg-muted font-bold text-xs text-foreground transition shadow-2xs">R$ 500</button>
                </div>

                <button type="button" onclick="preencherValorMetaLarPix(250)" class="text-xs font-bold text-emerald-700 dark:text-emerald-400 hover:underline pt-1 inline-flex items-center gap-1">
                    <i data-lucide="check" class="size-3"></i>
                    <span>Usar minha parte do mês (R$ 250,00)</span>
                </button>
            </div>

            <!-- De qual conta está tirando -->
            <div class="space-y-1.5 pt-1">
                <label class="text-xs font-bold text-foreground">De qual conta você está tirando?</label>
                <p class="text-[11px] text-muted-foreground">O valor será descontado da conta escolhida.</p>
                <div class="grid grid-cols-2 gap-2 pt-1" id="guardarMetaLarPixContasGrid">
                    <button type="button" onclick="selecionarContaMetaLarPix(this, 1)" 
                            class="chip-conta-pix active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition flex items-center gap-2.5">
                        <i data-lucide="wallet" class="size-4 text-emerald-700 dark:text-emerald-300 shrink-0"></i>
                        <div class="min-w-0">
                            <strong class="text-xs font-bold text-foreground block truncate">Nubank</strong>
                            <span class="text-[10px] text-muted-foreground">R$ 1.180</span>
                        </div>
                    </button>
                    <button type="button" onclick="selecionarContaMetaLarPix(this, 2)" 
                            class="chip-conta-pix p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30 flex items-center gap-2.5">
                        <i data-lucide="piggy-bank" class="size-4 text-muted-foreground shrink-0"></i>
                        <div class="min-w-0">
                            <strong class="text-xs font-bold text-foreground block truncate">Poupança Caixa</strong>
                            <span class="text-[10px] text-muted-foreground">R$ 2.100</span>
                        </div>
                    </button>
                    <button type="button" onclick="selecionarContaMetaLarPix(this, 3)" 
                            class="chip-conta-pix p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30 flex items-center gap-2.5">
                        <i data-lucide="smartphone" class="size-4 text-muted-foreground shrink-0"></i>
                        <div class="min-w-0">
                            <strong class="text-xs font-bold text-foreground block truncate">PicPay</strong>
                            <span class="text-[10px] text-muted-foreground">R$ 240</span>
                        </div>
                    </button>
                    <button type="button" onclick="selecionarContaMetaLarPix(this, 4)" 
                            class="chip-conta-pix p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30 flex items-center gap-2.5">
                        <i data-lucide="banknote" class="size-4 text-muted-foreground shrink-0"></i>
                        <div class="min-w-0">
                            <strong class="text-xs font-bold text-foreground block truncate">Dinheiro</strong>
                            <span class="text-[10px] text-muted-foreground">R$ 130</span>
                        </div>
                    </button>
                </div>
                <input type="hidden" id="guardarMetaLarPixContaId" value="1">
                <input type="hidden" id="guardarMetaLarPixMetaId" value="">
            </div>

            <!-- Para onde o dinheiro vai + PIX -->
            <div class="rounded-2xl border border-emerald-200/80 dark:border-emerald-900/40 bg-emerald-50/50 dark:bg-emerald-950/20 p-4 space-y-3 text-xs">
                <span class="text-[11px] font-bold text-emerald-800 dark:text-emerald-300 flex items-center gap-1">
                    <i data-lucide="arrow-right" class="size-3"></i>
                    Para onde o dinheiro vai
                </span>
                <div class="space-y-1">
                    <div class="flex items-center gap-2 text-foreground font-semibold">
                        <i data-lucide="user" class="size-3.5 text-emerald-600"></i>
                        <span>Conta de <strong id="guardarMetaLarPixNomeResp">Parceiro(a)</strong></span>
                    </div>
                    <div class="flex items-center gap-2 text-muted-foreground">
                        <i data-lucide="wallet" class="size-3.5 text-emerald-600"></i>
                        <span id="guardarMetaLarPixBancoResp">Conta do Lar</span>
                    </div>
                </div>

                <!-- Box Chave Pix com Copiar -->
                <div class="p-3 rounded-xl border border-dashed border-emerald-300 dark:border-emerald-800 bg-white/70 dark:bg-emerald-950/40 flex items-center justify-between gap-2">
                    <div class="min-w-0">
                        <span class="text-[10px] text-muted-foreground font-semibold block">Pix para transferir</span>
                        <strong id="guardarMetaLarPixChaveValor" class="text-xs font-extrabold text-foreground truncate block">(71) 99812-3456</strong>
                    </div>
                    <button type="button" onclick="copiarChavePixMetaLar()" class="px-3 py-1.5 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-[11px] transition shrink-0 flex items-center gap-1">
                        <i data-lucide="copy" class="size-3"></i>
                        <span>Copiar</span>
                    </button>
                </div>
            </div>

            <!-- Comprovante -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Comprovante da transferência (opcional, mas recomendado)</label>
                <input type="file" id="guardarMetaLarPixComprovanteInput" accept="image/*" class="hidden" onchange="aoSelecionarComprovanteMetaPix(this)">
                <div onclick="document.getElementById('guardarMetaLarPixComprovanteInput').click()" 
                     id="boxComprovanteMetaPix"
                     class="flex flex-col items-center justify-center p-3.5 rounded-2xl border-2 border-dashed border-border bg-muted/20 text-center cursor-pointer hover:border-emerald-500 transition">
                    <i data-lucide="image-plus" class="size-5 text-muted-foreground mb-1"></i>
                    <span class="text-xs font-bold text-foreground">Adicionar foto</span>
                    <span class="text-[10px] text-muted-foreground">Anexe o print do Pix para comprovar a transferência para a conta</span>
                </div>
                <div id="previewComprovanteMetaPix" class="hidden p-2 rounded-xl border border-border bg-card flex items-center justify-between text-xs font-semibold text-emerald-700">
                    <span class="flex items-center gap-1.5"><i data-lucide="check" class="size-3.5"></i> Comprovante anexado</span>
                    <button type="button" onclick="removerComprovanteMetaPix(event)" class="text-rose-500 text-[11px] font-bold hover:underline">Remover</button>
                </div>
            </div>

            <!-- Botão de Aporte -->
            <div class="pt-2">
                <button type="submit" class="w-full py-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm transition shadow-soft flex items-center justify-center gap-2">
                    <i data-lucide="plus" class="size-5"></i>
                    <span>Confirmar transferência</span>
                </button>
            </div>
        </form>
    </div>
</div>
