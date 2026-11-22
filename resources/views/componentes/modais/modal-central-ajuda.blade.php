{{-- 
    Modal: Central de Ajuda e Dúvidas Frequentes (FAQ)
    Responsável Acadêmica: Maria Eduarda (Duda)
    Versão Oficial: SEIVA v2.0
--}}
<div id="modalCentralAjuda" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalCentralAjuda')"></div>

    <div class="relative w-full sm:max-w-lg bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center border border-emerald-500/20">
                    <i data-lucide="help-circle" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Central de Ajuda SEIVA</h3>
                    <p class="text-xs text-muted-foreground">Perguntas frequentes e suporte</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalCentralAjuda')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <div class="p-6 space-y-3.5 overflow-y-auto no-scrollbar text-xs">
            <!-- FAQ Item 1 -->
            <div class="p-4 rounded-2xl border border-border bg-muted/30 space-y-1.5">
                <h4 class="font-extrabold text-foreground flex items-center gap-1.5">
                    <i data-lucide="shield" class="size-3.5 text-emerald-600"></i>
                    O que é a Caixa Preta e como ela protege minha privacidade?
                </h4>
                <p class="text-[11px] text-muted-foreground leading-relaxed">
                    A Caixa Preta é a sua área pessoal fechada a cadeado (PIN de 4 dígitos). Lançamentos privados, despesas fixas só suas e metas individuais não são compartilhadas com o seu parceiro nem afetam as contas do lar.
                </p>
            </div>

            <!-- FAQ Item 2 -->
            <div class="p-4 rounded-2xl border border-border bg-muted/30 space-y-1.5">
                <h4 class="font-extrabold text-foreground flex items-center gap-1.5">
                    <i data-lucide="scale" class="size-3.5 text-emerald-600"></i>
                    Como funciona a Mesa de Acordos?
                </h4>
                <p class="text-[11px] text-muted-foreground leading-relaxed">
                    A Mesa de Acordos é o local onde o casal planeja sonhos em conjunto (Poupar Juntos) ou organiza divisões suaves de compras já feitas (Dívidas Divididas). Uma pessoa propõe e o outro pode Aceitar, Contrapor ou Recusar diplomaticamente.
                </p>
            </div>

            <!-- FAQ Item 3 -->
            <div class="p-4 rounded-2xl border border-border bg-muted/30 space-y-1.5">
                <h4 class="font-extrabold text-foreground flex items-center gap-1.5">
                    <i data-lucide="bell" class="size-3.5 text-emerald-600"></i>
                    Para que serve o Cobrador Diplomata?
                </h4>
                <p class="text-[11px] text-muted-foreground leading-relaxed">
                    Ele assume o papel desconfortável de lembrar datas de vencimento de reembolsos ou divisões entre o casal, com frases gentis e bem-humoradas que evitam atritos na relação.
                </p>
            </div>

            <!-- FAQ Item 4 -->
            <div class="p-4 rounded-2xl border border-border bg-muted/30 space-y-1.5">
                <h4 class="font-extrabold text-foreground flex items-center gap-1.5">
                    <i data-lucide="sliders" class="size-3.5 text-emerald-600"></i>
                    Como personalizar a divisão das contas do Lar?
                </h4>
                <p class="text-[11px] text-muted-foreground leading-relaxed">
                    No seu perfil, acesse "Regra de Divisão do Lar" e escolha entre 50/50, proporcional à renda de cada um, ou defina qualquer proporção livre (ex: 90% Ian e 10% Duda).
                </p>
            </div>

            <!-- FAQ Item 5 -->
            <div class="p-4 rounded-2xl border border-border bg-muted/30 space-y-1.5">
                <h4 class="font-extrabold text-foreground flex items-center gap-1.5">
                    <i data-lucide="eye" class="size-3.5 text-emerald-600"></i>
                    O que é a Visibilidade Padrão dos Lançamentos?
                </h4>
                <p class="text-[11px] text-muted-foreground leading-relaxed">
                    É a sua preferência cadastral: ao lançar um gasto novo, ele pode começar por padrão como "Privado" (só para você) ou "Compartilhado" (entra na conta do casal).
                </p>
            </div>
        </div>

        <div class="p-4 border-t border-border/60">
            <button type="button" onclick="fecharModalId('modalCentralAjuda')" class="w-full py-3 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs shadow-soft transition">
                Fechar Ajuda
            </button>
        </div>
    </div>
</div>
