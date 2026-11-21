{{-- 
    Modal: Novo Acordo em 3 Passos (RF006)
    Responsável Acadêmico: Ian Marcos
    Descrição: Fluxo de 3 passos para criar proposta de acordo
    (Poupar juntos, Dívida dividida, Viajar, Poupança livre, Reserva, Curso, Outros)
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="modalNovoAcordoPassos"
     class="fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4 hidden"
     role="dialog" aria-modal="true" aria-labelledby="modalNovoAcordoTitulo">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
         onclick="document.getElementById('modalNovoAcordoPassos').classList.add('hidden')"></div>

    <!-- Painel -->
    <div class="relative w-full sm:max-w-md bg-background rounded-t-3xl sm:rounded-3xl shadow-2xl overflow-hidden max-h-[92dvh] flex flex-col">

        <!-- Header fixo -->
        <div class="flex items-center justify-between px-6 pt-5 pb-4 border-b border-border shrink-0">
            <div>
                <h2 id="modalNovoAcordoTitulo" class="text-base font-black text-foreground">O que você quer conquistar?</h2>
                <p class="text-[11px] text-muted-foreground mt-0.5">Defina sua próxima meta compartilhada</p>
            </div>
            <button onclick="document.getElementById('modalNovoAcordoPassos').classList.add('hidden')"
                    class="size-8 rounded-xl hover:bg-muted flex items-center justify-center transition-colors"
                    aria-label="Fechar modal">
                <i data-lucide="x" class="size-4 text-muted-foreground"></i>
            </button>
        </div>

        <!-- Indicador de progresso (3 barras) -->
        <div class="flex items-center gap-1.5 px-6 py-3 border-b border-border shrink-0">
            <div data-dot="1" class="h-1.5 flex-1 rounded-full bg-primary transition-all duration-300"></div>
            <div data-dot="2" class="h-1.5 flex-1 rounded-full bg-muted transition-all duration-300"></div>
            <div data-dot="3" class="h-1.5 flex-1 rounded-full bg-muted transition-all duration-300"></div>
        </div>

        <!-- Conteúdo rolável -->
        <div class="overflow-y-auto flex-1">

            {{-- ===== PASSO 1: Tipo de meta, link, nome, valor, foto, visibilidade ===== --}}
            <div data-passo="1" class="p-6 space-y-5">

                <!-- Tipo de meta -->
                <div class="space-y-2">
                    <label class="text-xs font-black text-foreground">Tipo de meta</label>
                    <div class="flex flex-wrap gap-2">
                        <button type="button" data-tipo="poupar_juntos"
                                onclick="selecionarTipoNovoAcordo('poupar_juntos', this)"
                                class="flex items-center gap-1.5 px-3 py-2 rounded-xl border border-border text-xs font-semibold text-muted-foreground transition-all">
                            <i data-lucide="shopping-cart" class="size-3.5"></i> Comprar produto
                        </button>
                        <button type="button" data-tipo="viagem"
                                onclick="selecionarTipoNovoAcordo('viagem', this)"
                                class="flex items-center gap-1.5 px-3 py-2 rounded-xl border border-border text-xs font-semibold text-muted-foreground transition-all">
                            <i data-lucide="plane" class="size-3.5"></i> Viajar
                        </button>
                        <button type="button" data-tipo="poupanca_livre"
                                onclick="selecionarTipoNovoAcordo('poupanca_livre', this)"
                                class="flex items-center gap-1.5 px-3 py-2 rounded-xl border border-border text-xs font-semibold text-muted-foreground transition-all">
                            <i data-lucide="piggy-bank" class="size-3.5"></i> Poupança livre
                        </button>
                        <button type="button" data-tipo="reserva"
                                onclick="selecionarTipoNovoAcordo('reserva', this)"
                                class="flex items-center gap-1.5 px-3 py-2 rounded-xl border border-border text-xs font-semibold text-muted-foreground transition-all">
                            <i data-lucide="shield" class="size-3.5"></i> Reserva
                        </button>
                        <button type="button" data-tipo="curso"
                                onclick="selecionarTipoNovoAcordo('curso', this)"
                                class="flex items-center gap-1.5 px-3 py-2 rounded-xl border border-border text-xs font-semibold text-muted-foreground transition-all">
                            <i data-lucide="graduation-cap" class="size-3.5"></i> Curso
                        </button>
                        <button type="button" data-tipo="outros"
                                onclick="selecionarTipoNovoAcordo('outros', this)"
                                class="flex items-center gap-1.5 px-3 py-2 rounded-xl border border-border text-xs font-semibold text-muted-foreground transition-all">
                            <i data-lucide="more-horizontal" class="size-3.5"></i> Outros
                        </button>
                    </div>
                </div>

                <!-- Link do produto -->
                <div id="novoAcordoCampoLink" class="space-y-1.5">
                    <label class="text-xs font-black text-foreground">
                        Cole o link do produto <span class="text-muted-foreground font-normal">(Mercado Livre, Amazon...)</span>
                    </label>
                    <div class="flex gap-2">
                        <input id="novoAcordoLink" type="url" placeholder="https://..."
                               class="flex-1 h-10 rounded-xl border border-border bg-muted/50 px-3 text-sm text-foreground placeholder:text-muted-foreground outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                        <button type="button" class="px-4 h-10 rounded-xl bg-muted border border-border text-xs font-bold text-foreground shrink-0 hover:bg-muted/80 transition-colors">
                            Buscar
                        </button>
                    </div>
                </div>

                <!-- Nome da meta -->
                <div class="space-y-1.5">
                    <label class="text-xs font-black text-foreground">Nome da meta</label>
                    <input id="novoAcordoNome" type="text" placeholder="Ex: Viagem Portugal"
                           class="w-full h-11 rounded-xl border border-border bg-muted/50 px-3 text-sm text-foreground placeholder:text-muted-foreground outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                </div>

                <!-- Valor total -->
                <div class="space-y-1.5">
                    <label class="text-xs font-black text-foreground">Valor total da meta</label>
                    <div class="flex items-center gap-2 h-14 rounded-xl border border-border bg-muted/50 px-4 focus-within:ring-2 focus-within:ring-primary/30 focus-within:border-primary transition-all">
                        <span class="text-sm font-bold text-muted-foreground">R$</span>
                        <input id="novoAcordoValor" type="number" step="0.01" min="0" placeholder="0,00"
                               class="flex-1 bg-transparent text-2xl font-black text-foreground placeholder:text-muted-foreground/60 outline-none text-right">
                    </div>
                </div>

                <!-- Foto do produto -->
                <div class="space-y-1.5">
                    <label class="text-xs font-black text-foreground">Foto do produto <span class="text-muted-foreground font-normal">(opcional)</span></label>
                    <div class="border-2 border-dashed border-border rounded-2xl p-6 flex flex-col items-center gap-2 cursor-pointer hover:border-primary/50 transition-colors bg-muted/20">
                        <div class="size-10 rounded-xl bg-muted flex items-center justify-center">
                            <i data-lucide="image-plus" class="size-5 text-muted-foreground"></i>
                        </div>
                        <p class="text-xs font-bold text-foreground">Adicionar foto</p>
                        <p class="text-[10px] text-muted-foreground text-center">O Mercado Livre nem sempre traz imagem — adicione a sua.</p>
                    </div>
                </div>

                <!-- De quem é essa meta? -->
                <div class="space-y-2">
                    <label class="text-xs font-black text-foreground">De quem é essa meta?</label>
                    <div class="space-y-2">
                        <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-primary bg-primary/5 cursor-pointer">
                            <div class="size-5 rounded-full border-2 border-primary bg-primary flex items-center justify-center shrink-0">
                                <i data-lucide="check" class="size-3 text-primary-foreground"></i>
                            </div>
                            <div>
                                <p class="text-xs font-black text-foreground">Só minha</p>
                                <p class="text-[10px] text-muted-foreground">Objetivo pessoal, eu banco sozinha</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-border cursor-pointer hover:border-primary/40 transition-colors">
                            <div class="size-5 rounded-full border-2 border-border shrink-0"></div>
                            <div>
                                <p class="text-xs font-black text-foreground">Do Lar, pago sozinha</p>
                                <p class="text-[10px] text-muted-foreground">É para a casa, mas eu assumo o valor</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-border cursor-pointer hover:border-primary/40 transition-colors">
                            <div class="size-5 rounded-full border-2 border-border shrink-0"></div>
                            <div>
                                <p class="text-xs font-black text-foreground">Compartilhada</p>
                                <p class="text-[10px] text-muted-foreground">Para atingir juntos — cada um contribui</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- ===== PASSO 2: Divisão e contribuição mensal ===== --}}
            <div data-passo="2" class="hidden p-6 space-y-5">

                <!-- Como dividir -->
                <div class="space-y-2">
                    <label class="text-xs font-black text-foreground">Como dividir?</label>
                    <div class="flex gap-2 flex-wrap">
                        <button type="button" data-divisao="50/50"
                                onclick="selecionarDivisaoNovoAcordo('50/50', this)"
                                class="px-4 py-2 rounded-xl border border-border text-xs font-semibold text-muted-foreground transition-all ring-2 ring-primary bg-primary/10 text-primary font-black">
                            50/50
                        </button>
                        <button type="button" data-divisao="60/40"
                                onclick="selecionarDivisaoNovoAcordo('60/40', this)"
                                class="px-4 py-2 rounded-xl border border-border text-xs font-semibold text-muted-foreground transition-all">
                            60/40
                        </button>
                        <button type="button" data-divisao="70/30"
                                onclick="selecionarDivisaoNovoAcordo('70/30', this)"
                                class="px-4 py-2 rounded-xl border border-border text-xs font-semibold text-muted-foreground transition-all">
                            70/30
                        </button>
                        <button type="button" data-divisao="livre"
                                onclick="selecionarDivisaoNovoAcordo('livre', this)"
                                class="px-4 py-2 rounded-xl border border-border text-xs font-semibold text-muted-foreground transition-all">
                            Livre
                        </button>
                    </div>
                </div>

                <!-- Valor mensal de cada um -->
                <div class="space-y-1.5">
                    <label class="text-xs font-black text-foreground">Valor mensal de cada um</label>
                    <div class="flex items-center gap-2 h-12 rounded-xl border border-border bg-muted/50 px-4 focus-within:ring-2 focus-within:ring-primary/30 transition-all">
                        <span class="text-sm font-bold text-muted-foreground">R$</span>
                        <input id="novoAcordoMensalCada" type="number" step="0.01" min="0" placeholder="0,00"
                               oninput="atualizarCalculosPasso2Acordo()"
                               class="flex-1 bg-transparent text-lg font-black text-foreground placeholder:text-muted-foreground/60 outline-none">
                        <span class="text-xs text-muted-foreground shrink-0">/mês cada</span>
                    </div>
                </div>

                <!-- Lembrete mensal toggle -->
                <div class="flex items-center justify-between p-3.5 rounded-2xl bg-muted/50 border border-border">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-black text-foreground">Lembrete mensal?</p>
                        <p class="text-[10px] text-muted-foreground">Cobrador Diplomata avisa vocês todo mês</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer shrink-0 ml-3">
                        <input id="novoAcordoMensalToggle" type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-muted rounded-full peer-checked:bg-primary transition-all after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:size-5 after:transition-all peer-checked:after:translate-x-5"></div>
                    </label>
                </div>

                <!-- Cálculo automático -->
                <div id="novoAcordoDivisaoInfo" class="text-[11px] text-primary font-bold text-center py-2 min-h-[2rem]"></div>
            </div>

            {{-- ===== PASSO 3: Revisão e envio ===== --}}
            <div data-passo="3" class="hidden p-6 space-y-4">
                <div class="rounded-2xl border border-border bg-muted/40 p-4 space-y-3">
                    <p class="text-xs font-black text-foreground border-b border-border pb-2">Revisão da proposta</p>
                    <div class="space-y-2.5 text-xs">
                        <div class="flex justify-between items-center">
                            <span class="text-muted-foreground">Tipo</span>
                            <span id="novoAcordoReviTipo" class="font-black text-foreground"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-muted-foreground">Nome</span>
                            <span id="novoAcordoReviNome" class="font-black text-foreground text-right max-w-[180px] truncate"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-muted-foreground">Valor total</span>
                            <span id="novoAcordoReviValor" class="font-black text-foreground"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-muted-foreground">Contribuição</span>
                            <span id="novoAcordoReviMensal" class="font-black text-foreground"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-muted-foreground">Divisão</span>
                            <span id="novoAcordoReviDivisao" class="font-black text-foreground"></span>
                        </div>
                    </div>
                </div>
                <div class="px-3 py-2.5 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-200/60">
                    <p class="text-[11px] text-emerald-700 dark:text-emerald-300 leading-relaxed">
                        Ao enviar, o parceiro receberá uma notificação para aceitar, recusar ou contrapor este acordo na Mesa de Acordos.
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer fixo com botões de navegação por passo -->
        <div class="border-t border-border p-4 shrink-0">
            <!-- Passo 1: Cancelar + Próximo -->
            <div data-passo="1" class="flex gap-2">
                <button onclick="document.getElementById('modalNovoAcordoPassos').classList.add('hidden')"
                        class="flex-1 h-11 rounded-xl border border-border text-sm font-bold text-foreground hover:bg-muted/50 transition-colors">
                    Cancelar
                </button>
                <button onclick="avancarPassoNovoAcordo()"
                        class="flex-1 h-11 rounded-xl bg-primary text-primary-foreground text-sm font-black flex items-center justify-center gap-2 hover:bg-primary/90 transition-colors">
                    Próximo <i data-lucide="arrow-right" class="size-4"></i>
                </button>
            </div>
            <!-- Passo 2: Voltar + Revisar -->
            <div data-passo="2" class="hidden flex gap-2">
                <button onclick="voltarPassoNovoAcordo()"
                        class="flex-1 h-11 rounded-xl border border-border text-sm font-bold text-foreground hover:bg-muted/50 transition-colors flex items-center justify-center gap-2">
                    <i data-lucide="arrow-left" class="size-4"></i> Voltar
                </button>
                <button onclick="avancarPassoNovoAcordo()"
                        class="flex-1 h-11 rounded-xl bg-primary text-primary-foreground text-sm font-black flex items-center justify-center gap-2 hover:bg-primary/90 transition-colors">
                    Revisar <i data-lucide="arrow-right" class="size-4"></i>
                </button>
            </div>
            <!-- Passo 3: Voltar + Enviar proposta -->
            <div data-passo="3" class="hidden flex gap-2">
                <button onclick="voltarPassoNovoAcordo()"
                        class="flex-1 h-11 rounded-xl border border-border text-sm font-bold text-foreground hover:bg-muted/50 transition-colors flex items-center justify-center gap-2">
                    <i data-lucide="arrow-left" class="size-4"></i> Voltar
                </button>
                <button id="btnEnviarPropostaNovoAcordo"
                        onclick="executarEnviarPropostaNovoAcordo()"
                        class="flex-1 h-11 rounded-xl bg-primary text-primary-foreground text-sm font-black flex items-center justify-center gap-2 hover:bg-primary/90 transition-colors">
                    <i data-lucide="send" class="size-4"></i> Enviar proposta
                </button>
            </div>
        </div>
    </div>
</div>
