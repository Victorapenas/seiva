{{-- 
    Módulo: Cobrador Diplomata (RF005)
    Responsável Acadêmico: Victor Hugo
    Funcionalidade: Notificações neutras disparadas pelo sistema, cópia de PIX e eliminação de atritos financeiros
--}}
<div id="pane-cobrador" class="sub-screen space-y-6 hidden">
    <!-- Header Hero do Cobrador Diplomata -->
    <header class="rounded-3xl bg-primary p-6 text-primary-foreground shadow-card">
        <div class="flex items-center gap-3">
            <span class="flex size-11 items-center justify-center rounded-2xl bg-primary-foreground/15">
                <i data-lucide="bell-ring" class="size-5 text-sky-200"></i>
            </span>
            <div>
                <h1 class="text-xl font-extrabold tracking-tight">Cobrador Diplomata</h1>
                <p class="text-xs opacity-80">Lembretes afetuosos e neutros disparados pelo SEIVA</p>
            </div>
        </div>
        <p class="mt-4 text-xs sm:text-sm leading-relaxed opacity-90 max-w-xl">
            As cobranças partem do sistema com mensagem gentil e chave PIX pronta. Ninguém passa por constrangimentos — o SEIVA cuida do diálogo financeiro do casal.
        </p>
    </header>

    <!-- Lista de Pendências de Rateio -->
    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-3">
        <div class="flex items-center justify-between border-b border-border pb-3">
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Pendências de Rateio no Lar</h3>
                <p class="text-[11px] text-muted-foreground">Despesas divididas que aguardam reembolso</p>
            </div>
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold">
                <i data-lucide="shield-check" class="size-3"></i> Zero Atrito
            </span>
        </div>
        <div id="cobradorPendenciasGrid" class="space-y-3">
            <p class="text-xs text-muted-foreground py-6 text-center">Nenhuma pendência no momento. Tudo em dia!</p>
        </div>
    </div>
</div>
