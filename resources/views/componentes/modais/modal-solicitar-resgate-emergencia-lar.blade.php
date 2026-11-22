{{-- 
    Modal: Solicitar Resgate do Fundo de Emergência do Lar
    Responsáveis Acadêmicos: Jhon Abner / Ian Marcos (RF004, RF006, RF010)
    Bordão Oficial: "Onde seu dinheiro cria raízes"
    Permite submeter proposta de uso do fundo emergencial conjunto com justificativa,
    simulação de impacto na reserva e aprovação bilateral na Mesa de Acordos.
--}}
<div id="modalSolicitarResgateEmergenciaLar" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalSolicitarResgateEmergenciaLar')"></div>

    <div class="relative w-full sm:max-w-lg bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-xl bg-amber-100 dark:bg-amber-950/70 text-amber-800 dark:text-amber-300 flex items-center justify-center border border-amber-500/20">
                    <i data-lucide="shield-alert" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Usar Fundo de Emergência</h3>
                    <p class="text-xs text-muted-foreground">Solicitação com consentimento mútuo do casal</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalSolicitarResgateEmergenciaLar')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSolicitarResgateEmergenciaLar(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Aviso Didático de Governança Compartilhada com Alto Contraste -->
            <div class="p-3.5 rounded-2xl space-y-1 shadow-2xs" style="background-color: #fef3c7 !important; border: 1.5px solid #f59e0b !important;">
                <div class="flex items-center gap-2 text-xs font-bold">
                    <i data-lucide="info" class="size-4 shrink-0 text-amber-700"></i>
                    <span style="color: #78350f !important; font-weight: 900 !important;">Regra de Consenso do Casal</span>
                </div>
                <p class="text-xs leading-relaxed" style="color: #451a03 !important; font-weight: 600 !important;">
                    O Fundo de Emergência é o colchão de segurança do Lar. Para proteger o orçamento de ambos, <strong style="color: #451a03 !important; font-weight: 900 !important;">toda retirada requer o consentimento mútuo do parceiro</strong> através da Mesa de Acordos antes da liberação do saldo.
                </p>
            </div>

            <!-- Saldo Disponível na Reserva -->
            <div class="rounded-2xl border border-border bg-muted/30 p-4 flex items-center justify-between">
                <div>
                    <span class="text-[11px] font-semibold text-muted-foreground block">Disponível no Fundo Conjunto</span>
                    <strong class="text-xl font-black text-foreground">R$ 5.000,00</strong>
                    <span class="text-[11px] text-emerald-600 dark:text-emerald-400 font-bold block mt-0.5">Poupança Caixa (conjunta)</span>
                </div>
                <div class="text-right">
                    <span class="text-[11px] text-muted-foreground block">Cobertura Atual</span>
                    <strong class="text-xs font-black text-foreground">~3 meses de Lar</strong>
                </div>
            </div>

            <!-- Quanto deseja retirar -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Quanto precisa retirar agora?</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold text-muted-foreground">R$</span>
                    <input type="text" id="resgateEmergenciaValorInput" value="500,00" 
                           oninput="aoDigitarValorResgateEmergencia(this.value)"
                           class="w-full h-12 pl-12 pr-4 rounded-2xl border border-border bg-card text-lg font-black text-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
                </div>

                <!-- Chips Rápidos -->
                <div class="flex flex-wrap gap-2 pt-1">
                    <button type="button" onclick="preencherValorResgateEmergencia(250)" class="px-3 py-1.5 rounded-xl border border-border bg-card text-xs font-bold text-muted-foreground hover:text-foreground hover:border-emerald-600 transition">
                        R$ 250
                    </button>
                    <button type="button" onclick="preencherValorResgateEmergencia(500)" class="px-3 py-1.5 rounded-xl border border-border bg-card text-xs font-bold text-muted-foreground hover:text-foreground hover:border-emerald-600 transition">
                        R$ 500
                    </button>
                    <button type="button" onclick="preencherValorResgateEmergencia(1000)" class="px-3 py-1.5 rounded-xl border border-border bg-card text-xs font-bold text-muted-foreground hover:text-foreground hover:border-emerald-600 transition">
                        R$ 1.000
                    </button>
                    <button type="button" onclick="preencherValorResgateEmergencia(2000)" class="px-3 py-1.5 rounded-xl border border-border bg-card text-xs font-bold text-muted-foreground hover:text-foreground hover:border-emerald-600 transition">
                        R$ 2.000
                    </button>
                </div>
            </div>

            <!-- Motivo do Resgate Emergencial -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Qual é a urgência?</label>
                <select id="resgateEmergenciaMotivoSelect" 
                        class="w-full h-11 px-3.5 rounded-2xl border border-border bg-card text-xs font-semibold text-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
                    <option value="imovel">Reparo urgente no imóvel (vazamento, chaveiro, eletricidade)</option>
                    <option value="saude">Saúde, consultas ou medicamentos de urgência</option>
                    <option value="eletro">Conserto ou reposição de eletrodoméstico essencial</option>
                    <option value="veiculo">Reparo urgente de veículo utilizado pelo casal</option>
                    <option value="outro">Outro imprevisto inadiável</option>
                </select>
            </div>

            <!-- Descrição detalhada -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Detalhe o que aconteceu (o parceiro verá isso)</label>
                <textarea id="resgateEmergenciaDescricaoInput" rows="2" 
                          placeholder="Ex: Ocorreu um vazamento no encanamento da cozinha e precisamos pagar o encanador emergencial hoje."
                          class="w-full p-3 rounded-2xl border border-border bg-card text-xs text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs resize-none"></textarea>
            </div>

            <!-- Simulação de Impacto na Reserva -->
            <div class="p-3.5 rounded-2xl bg-muted/40 border border-border space-y-1 text-xs">
                <span class="text-[11px] font-bold text-muted-foreground block">Impacto no Fundo de Emergência:</span>
                <div class="flex items-center justify-between font-extrabold text-foreground">
                    <span id="resgateEmergenciaNovoSaldoTxt">Restará no Fundo: R$ 4.500,00</span>
                    <span id="resgateEmergenciaNovoPctTxt" class="text-amber-600 dark:text-amber-400">45% da meta</span>
                </div>
            </div>

            <!-- Conta de Destino do Crédito -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Onde o dinheiro deve ser creditado?</label>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" onclick="selecionarContaCreditoResgate(this, 'nubank_duda')" 
                            class="chip-conta-resgate active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition">
                        <strong class="text-xs font-extrabold text-foreground block">Nubank Maria Eduarda</strong>
                        <span class="text-[10px] text-muted-foreground">Conta pessoal de quem paga</span>
                    </button>
                    <button type="button" onclick="selecionarContaCreditoResgate(this, 'nubank_ian')" 
                            class="chip-conta-resgate p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30">
                        <strong class="text-xs font-extrabold text-foreground block">Nubank Ian Marcos</strong>
                        <span class="text-[10px] text-muted-foreground">Conta pessoal do parceiro</span>
                    </button>
                </div>
                <input type="hidden" id="resgateEmergenciaContaDestino" value="nubank_duda">
            </div>

            <!-- Botão de Envio para Mesa de Acordos -->
            <div class="pt-2">
                <button type="submit" 
                        class="w-full py-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs shadow-soft transition flex items-center justify-center gap-2">
                    <i data-lucide="send" class="size-4"></i>
                    <span>Enviar para Aprovação na Mesa de Acordos</span>
                </button>
            </div>
        </form>
    </div>
</div>
