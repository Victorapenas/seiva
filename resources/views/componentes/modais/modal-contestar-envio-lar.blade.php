{{-- 
    Modal: Gestão de Contribuição e Solicitação Diplomática de Comprovante
    Responsável Acadêmico: Jhon Abner (RF004, RF010)
    Bordão Oficial: "Onde seu dinheiro cria raízes"
    Resolve casos em que um membro ainda não contribuiu ou informou que enviou mas o valor não foi identificado.
--}}
<div id="modalContestarEnvioLar" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalContestarEnvioLar')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-xl bg-amber-100 dark:bg-amber-950/70 text-amber-800 dark:text-amber-300 flex items-center justify-center border border-amber-500/20">
                    <i data-lucide="handshake" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Equilíbrio da Contribuição</h3>
                    <p class="text-xs text-muted-foreground">Comunicação leve, transparente e sem cobranças chatas</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalContestarEnvioLar')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <div class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Card de Status do Rateio -->
            <div class="p-4 rounded-2xl border border-amber-300/60 dark:border-amber-800/40 bg-amber-50/60 dark:bg-amber-950/20 space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-amber-900 dark:text-amber-200">Aporte pendente do mês</span>
                    <strong class="text-sm font-black text-amber-950 dark:text-amber-100">R$ 225,00</strong>
                </div>
                <p class="text-xs text-amber-900/80 dark:text-amber-300/80 leading-relaxed">
                    A cota mensal de <strong>Maria Eduarda</strong> é de R$ 480,00 e já foram registrados R$ 255,00 (53%). 
                    Abaixo você pode escolher a melhor forma de conciliar esse valor com carinho.
                </p>
            </div>

            <!-- OPÇÃO 1: Cobrador Diplomata (Lembrete carinhoso) -->
            <div class="p-4 rounded-2xl border border-border bg-card space-y-2.5 hover:border-emerald-500/40 transition">
                <div class="flex items-center gap-2 text-xs font-extrabold text-foreground">
                    <i data-lucide="sparkles" class="size-4 text-emerald-600"></i>
                    <span>1. Lembrar com carinho (Cobrador Diplomata)</span>
                </div>
                <p class="text-xs text-muted-foreground leading-relaxed">
                    Envia uma mensagem pronta e amorosa no WhatsApp do parceiro, sem tom de cobrança:
                </p>
                <div class="p-3 rounded-xl bg-muted/40 text-[11px] text-foreground italic border border-border/50">
                    "Oi meu bem! Passando só pra gente fechar nosso rateio do cantinho esse mês e deixar tudo verdinho no SEIVA. Faltam R$ 225,00 quando puder me dá um toque! Te amo ❤️"
                </div>
                <button type="button" onclick="enviarLembreteDiplomataWhatsapp()" 
                        class="w-full py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs shadow-soft transition flex items-center justify-center gap-1.5">
                    <i data-lucide="send" class="size-3.5"></i>
                    <span>Copiar / Enviar no WhatsApp</span>
                </button>
            </div>

            <!-- OPÇÃO 2: O parceiro disse que enviou mas não caiu? -->
            <div class="p-4 rounded-2xl border border-border bg-card space-y-2.5 hover:border-amber-500/40 transition">
                <div class="flex items-center gap-2 text-xs font-extrabold text-foreground">
                    <i data-lucide="search" class="size-4 text-amber-600"></i>
                    <span>2. O parceiro disse que enviou, mas não caiu?</span>
                </div>
                <p class="text-xs text-muted-foreground leading-relaxed">
                    Às vezes o Pix agendou ou foi para outra chave. Você pode solicitar delicadamente o envio do comprovante para conciliar:
                </p>
                <button type="button" onclick="solicitarComprovantePixParceiro()" 
                        class="w-full py-2.5 rounded-xl border border-border bg-card hover:bg-muted text-foreground font-bold text-xs transition flex items-center justify-center gap-1.5 shadow-2xs">
                    <i data-lucide="file-text" class="size-3.5 text-amber-600"></i>
                    <span>Pedir comprovante Pix pelo app</span>
                </button>
            </div>

            <!-- OPÇÃO 3: Compensação por outra despesa paga -->
            <div class="p-4 rounded-2xl border border-border bg-card space-y-2.5 hover:border-primary/40 transition">
                <div class="flex items-center gap-2 text-xs font-extrabold text-foreground">
                    <i data-lucide="scale" class="size-4 text-primary"></i>
                    <span>3. Abater com outra despesa que ela pagou</span>
                </div>
                <p class="text-xs text-muted-foreground leading-relaxed">
                    Se Maria Eduarda pagou compras do mercado ou farmácia diretamente do bolso dela, esse valor pode ser abatido automaticamente na Mesa de Acordos.
                </p>
                <button type="button" onclick="trocarAbaApp('acordos'); fecharModalId('modalContestarEnvioLar')" 
                        class="w-full py-2.5 rounded-xl border border-border bg-muted/30 hover:bg-muted text-foreground font-bold text-xs transition flex items-center justify-center gap-1.5 shadow-2xs">
                    <i data-lucide="handshake" class="size-3.5 text-emerald-600"></i>
                    <span>Compensar na Mesa de Acordos</span>
                </button>
            </div>
        </div>
    </div>
</div>
