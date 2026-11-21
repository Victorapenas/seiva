{{-- 
    Modal: Guardar no Fundo de Emergência do Lar (Imagem 3)
    Permite aportar diretamente na reserva do casal com seleção de contas e comprovante
--}}
<div id="modalGuardarFundoEmergenciaLar" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="fecharModalId('modalGuardarFundoEmergenciaLar')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60 flex items-start justify-between gap-3">
            <div>
                <h3 class="text-base font-extrabold text-foreground">Guardar em Fundo de emergência do Lar</h3>
                <p class="text-xs text-muted-foreground mt-0.5">Meta do Lar</p>
            </div>
            <button type="button" onclick="fecharModalId('modalGuardarFundoEmergenciaLar')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarAporteFundoEmergenciaLar(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Card de Progresso da Reserva -->
            <div class="rounded-2xl border border-border bg-muted/30 p-4 space-y-2.5">
                <div class="flex items-center gap-3">
                    <span class="size-9 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center shrink-0">
                        <i data-lucide="shield" class="size-4"></i>
                    </span>
                    <div class="min-w-0 flex-1">
                        <span class="text-[11px] font-semibold text-muted-foreground block">Progresso atual</span>
                        <strong class="text-xs font-black text-foreground">R$ 5.000,00 de R$ 10.000,00</strong>
                    </div>
                </div>
                <div class="h-2 w-full rounded-full bg-muted overflow-hidden">
                    <div class="h-full bg-amber-500 rounded-full" style="width: 50%"></div>
                </div>
                <p class="text-[11px] text-emerald-700 dark:text-emerald-400 font-bold" id="fundoEmergenciaSeraTxt">Será 50% após guardar</p>
            </div>

            <!-- Input Valor -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Quanto você quer guardar agora?</label>
                <div class="relative flex items-center rounded-2xl border-2 border-emerald-600/70 bg-background px-4 py-2.5 shadow-2xs">
                    <span class="text-xl font-black text-muted-foreground select-none pr-2">R$</span>
                    <input type="text" id="fundoEmergenciaInputValor" inputmode="decimal" required 
                           oninput="atualizarCalculoFundoEmergencia(this.value)"
                           class="w-full bg-transparent text-2xl font-black text-foreground focus:outline-none" placeholder="0,00">
                </div>
                
                <!-- Quick Chips -->
                <div class="flex flex-wrap items-center gap-2 pt-1">
                    <button type="button" onclick="preencherValorFundoEmergencia(50)" class="px-3.5 py-1.5 rounded-xl border border-border bg-card hover:bg-muted font-bold text-xs text-foreground transition shadow-2xs">R$ 50</button>
                    <button type="button" onclick="preencherValorFundoEmergencia(100)" class="px-3.5 py-1.5 rounded-xl border border-border bg-card hover:bg-muted font-bold text-xs text-foreground transition shadow-2xs">R$ 100</button>
                    <button type="button" onclick="preencherValorFundoEmergencia(200)" class="px-3.5 py-1.5 rounded-xl border border-border bg-card hover:bg-muted font-bold text-xs text-foreground transition shadow-2xs">R$ 200</button>
                    <button type="button" onclick="preencherValorFundoEmergencia(500)" class="px-3.5 py-1.5 rounded-xl border border-border bg-card hover:bg-muted font-bold text-xs text-foreground transition shadow-2xs">R$ 500</button>
                </div>

                <!-- Atalho "Usar minha parte do mês" -->
                <button type="button" onclick="preencherValorFundoEmergencia(250)" class="text-xs font-bold text-emerald-700 dark:text-emerald-400 hover:underline pt-1 inline-flex items-center gap-1">
                    <i data-lucide="check" class="size-3"></i>
                    <span>Usar minha parte do mês (R$ 250,00)</span>
                </button>
            </div>

            <!-- De qual conta você está tirando? -->
            <div class="space-y-1.5 pt-1">
                <label class="text-xs font-bold text-foreground">De qual conta você está tirando?</label>
                <p class="text-[11px] text-muted-foreground">O valor será descontado da conta escolhida.</p>
                <div class="grid grid-cols-2 gap-2 pt-1" id="fundoEmergenciaContasGrid">
                    <button type="button" onclick="selecionarContaFundoEmergencia(this, 1)" 
                            class="chip-conta-fundo active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition flex items-center gap-2.5">
                        <i data-lucide="wallet" class="size-4 text-emerald-700 dark:text-emerald-300 shrink-0"></i>
                        <div class="min-w-0">
                            <strong class="text-xs font-bold text-foreground block truncate">Nubank</strong>
                            <span class="text-[10px] text-muted-foreground">R$ 1.180</span>
                        </div>
                    </button>
                    <button type="button" onclick="selecionarContaFundoEmergencia(this, 2)" 
                            class="chip-conta-fundo p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30 flex items-center gap-2.5">
                        <i data-lucide="piggy-bank" class="size-4 text-muted-foreground shrink-0"></i>
                        <div class="min-w-0">
                            <strong class="text-xs font-bold text-foreground block truncate">Poupança Caixa</strong>
                            <span class="text-[10px] text-muted-foreground">R$ 2.100</span>
                        </div>
                    </button>
                    <button type="button" onclick="selecionarContaFundoEmergencia(this, 3)" 
                            class="chip-conta-fundo p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30 flex items-center gap-2.5">
                        <i data-lucide="smartphone" class="size-4 text-muted-foreground shrink-0"></i>
                        <div class="min-w-0">
                            <strong class="text-xs font-bold text-foreground block truncate">PicPay</strong>
                            <span class="text-[10px] text-muted-foreground">R$ 240</span>
                        </div>
                    </button>
                    <button type="button" onclick="selecionarContaFundoEmergencia(this, 4)" 
                            class="chip-conta-fundo p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30 flex items-center gap-2.5">
                        <i data-lucide="banknote" class="size-4 text-muted-foreground shrink-0"></i>
                        <div class="min-w-0">
                            <strong class="text-xs font-bold text-foreground block truncate">Dinheiro</strong>
                            <span class="text-[10px] text-muted-foreground">R$ 130</span>
                        </div>
                    </button>
                </div>
                <input type="hidden" id="fundoEmergenciaContaId" value="1">
            </div>

            <!-- Destino do Dinheiro -->
            <div class="rounded-2xl border border-emerald-200/80 dark:border-emerald-900/40 bg-emerald-50/50 dark:bg-emerald-950/20 p-3.5 space-y-1.5 text-xs">
                <span class="text-[11px] font-bold text-emerald-800 dark:text-emerald-300 flex items-center gap-1">
                    <i data-lucide="arrow-right" class="size-3"></i>
                    Para onde o dinheiro vai
                </span>
                <div class="flex items-center gap-2 text-foreground font-semibold">
                    <i data-lucide="users" class="size-3.5 text-emerald-600"></i>
                    <span>Conta de: <strong>Conta conjunta</strong></span>
                </div>
                <div class="flex items-center gap-2 text-muted-foreground">
                    <i data-lucide="wallet" class="size-3.5 text-emerald-600"></i>
                    <span>Poupança Caixa (conjunta)</span>
                </div>
            </div>

            <!-- Comprovante da transferência -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Comprovante da transferência (opcional, mas recomendado)</label>
                <input type="file" id="fundoEmergenciaComprovanteInput" accept="image/*" class="hidden" onchange="aoSelecionarComprovanteFundo(this)">
                <div onclick="document.getElementById('fundoEmergenciaComprovanteInput').click()" 
                     id="boxComprovanteFundo"
                     class="flex flex-col items-center justify-center p-3.5 rounded-2xl border-2 border-dashed border-border bg-muted/20 text-center cursor-pointer hover:border-emerald-500 transition">
                    <i data-lucide="image-plus" class="size-5 text-muted-foreground mb-1"></i>
                    <span class="text-xs font-bold text-foreground">Adicionar foto</span>
                    <span class="text-[10px] text-muted-foreground">Anexe o comprovante Pix ou recibo de transferência</span>
                </div>
                <div id="previewComprovanteFundo" class="hidden p-2 rounded-xl border border-border bg-card flex items-center justify-between text-xs font-semibold text-emerald-700">
                    <span class="flex items-center gap-1.5"><i data-lucide="check" class="size-3.5"></i> Comprovante anexado</span>
                    <button type="button" onclick="removerComprovanteFundo(event)" class="text-rose-500 text-[11px] font-bold hover:underline">Remover</button>
                </div>
            </div>

            <!-- Botão Submit -->
            <div class="pt-2">
                <button type="submit" class="w-full py-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm transition shadow-soft flex items-center justify-center gap-2">
                    <i data-lucide="shield-check" class="size-5"></i>
                    <span>Confirmar aporte no Fundo de Emergência</span>
                </button>
            </div>
        </form>
    </div>
</div>
