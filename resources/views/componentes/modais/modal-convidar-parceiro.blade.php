{{-- 
    Modal: Convidar Parceiro(a) para Formar Lar (RF004, RF010)
    Responsáveis Acadêmicos: Victor Hugo / Equipe SEIVA
    Bordão: "Onde seu dinheiro cria raízes"
--}}
<div id="modalConvidarParceiro" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="fecharModalId('modalConvidarParceiro')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60 flex items-start justify-between gap-3">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-2xl bg-emerald-800 text-white flex items-center justify-center shrink-0 shadow-2xs">
                    <i data-lucide="heart-handshake" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Convidar Parceiro(a)</h3>
                    <p class="text-xs text-muted-foreground mt-0.5">Forme um Lar e organize o futuro a dois</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalConvidarParceiro')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form id="formConvidarParceiro" onsubmit="executarEnviarConviteLar(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Box Explicativo de Privacidade & Blindagem (ALTO CONTRASTE E MÁXIMA LEGIBILIDADE) -->
            <div class="p-4 rounded-2xl bg-[#092015] text-white border border-emerald-700/80 shadow-soft space-y-2">
                <div class="flex items-center gap-2">
                    <span class="size-6 rounded-lg bg-emerald-800 text-emerald-200 flex items-center justify-center shrink-0">
                        <i data-lucide="shield-check" class="size-3.5"></i>
                    </span>
                    <strong class="text-xs font-black text-white tracking-wide">Privacidade 100% Garantida</strong>
                </div>
                <p class="text-[11px] text-gray-200 font-normal leading-relaxed">
                    Ao convidar seu parceiro(a), cada um mantém suas contas e sua <strong class="text-emerald-300 font-bold">Caixa Preta individual</strong> totalmente privativas. Vocês compartilham apenas as despesas do Lar e metas combinadas na Mesa de Acordos!
                </p>
            </div>

            <!-- Como Funciona o Convite -->
            <div class="p-3.5 rounded-2xl bg-muted/60 border border-border space-y-1.5 text-xs">
                <span class="font-bold text-foreground flex items-center gap-1.5">
                    <i data-lucide="help-circle" class="size-3.5 text-emerald-600"></i>
                    <span>Como o parceiro(a) recebe o acesso?</span>
                </span>
                <p class="text-[11px] text-muted-foreground leading-relaxed">
                    1. Geramos um <strong>link seguro de convite</strong> válido por 7 dias.<br>
                    2. Você pode copiar e enviar pelo WhatsApp, Telegram ou e-mail.<br>
                    3. Ao acessar, a pessoa entra diretamente no Lar (se já tiver conta ou ao se cadastrar)!
                </p>
            </div>

            <!-- Nome do Parceiro(a) -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground flex items-center gap-1.5">
                    <i data-lucide="user" class="size-3.5 text-muted-foreground"></i>
                    <span>Nome do Parceiro(a) (opcional)</span>
                </label>
                <input type="text" id="conviteNomeParceiro" placeholder="Nome do parceiro(a)"
                       class="w-full rounded-2xl border border-border bg-background px-4 py-2.5 text-xs text-foreground placeholder:text-muted-foreground focus:border-emerald-600 focus:outline-none shadow-2xs">
            </div>

            <!-- E-mail do Parceiro(a) -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground flex items-center gap-1.5">
                    <i data-lucide="mail" class="size-3.5 text-muted-foreground"></i>
                    <span>E-mail do Parceiro(a) <span class="text-rose-500">*</span></span>
                </label>
                <input type="email" id="conviteEmailParceiro" required placeholder="parceiro@email.com"
                       class="w-full rounded-2xl border border-border bg-background px-4 py-2.5 text-xs text-foreground placeholder:text-muted-foreground focus:border-emerald-600 focus:outline-none shadow-2xs">
                <p class="text-[10px] text-muted-foreground">
                    Se a pessoa já tiver conta no SEIVA com este e-mail, o convite aparecerá automaticamente no painel dela!
                </p>
            </div>

            <!-- Nome do Lar -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground flex items-center gap-1.5">
                    <i data-lucide="home" class="size-3.5 text-muted-foreground"></i>
                    <span>Nome do Lar (opcional)</span>
                </label>
                <input type="text" id="conviteNomeLar" placeholder="Ex: Nosso Cantinho, Lar..."
                       class="w-full rounded-2xl border border-border bg-background px-4 py-2.5 text-xs text-foreground placeholder:text-muted-foreground focus:border-emerald-600 focus:outline-none shadow-2xs">
            </div>

            <!-- Área de Exibição do Link Gerado -->
            <div id="conviteLinkArea" class="hidden p-4 rounded-2xl bg-emerald-950/20 border border-emerald-600/40 space-y-2.5">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-emerald-800 dark:text-emerald-300 flex items-center gap-1.5">
                        <i data-lucide="link" class="size-3.5 text-emerald-600"></i>
                        <span>Link de Convite Gerado</span>
                    </span>
                    <span class="text-[10px] font-bold text-emerald-700 bg-emerald-100 dark:bg-emerald-950 px-2 py-0.5 rounded-full">Válido por 7 dias</span>
                </div>
                <div class="flex items-center gap-2">
                    <input type="text" id="conviteLinkGerado" readonly
                           class="flex-1 rounded-xl border border-border bg-background px-3 py-2 text-xs font-mono text-muted-foreground select-all focus:outline-none">
                    <button type="button" onclick="copiarLinkConviteLar()" id="btnCopiarLinkConvite"
                            class="px-3.5 py-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs flex items-center gap-1.5 transition shadow-2xs shrink-0">
                        <i data-lucide="copy" class="size-3.5"></i>
                        <span id="txtBtnCopiarLink">Copiar</span>
                    </button>
                </div>
                <p class="text-[11px] text-muted-foreground leading-tight">
                    Envie este link para seu parceiro(a) por WhatsApp ou e-mail. Ao abrir, a pessoa poderá entrar diretamente no Lar!
                </p>
            </div>

            <!-- Botões de Ação -->
            <div class="pt-2 flex items-center gap-2">
                <button type="button" onclick="fecharModalId('modalConvidarParceiro')" class="flex-1 py-3 rounded-2xl border border-border bg-card text-foreground font-bold text-xs hover:bg-muted transition">
                    Fechar
                </button>
                <button type="submit" id="btnEnviarConviteLar" class="flex-1 py-3 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs transition shadow-soft flex items-center justify-center gap-2">
                    <i data-lucide="send" class="size-3.5"></i>
                    <span>Gerar Convite</span>
                </button>
            </div>
        </form>
    </div>
</div>
