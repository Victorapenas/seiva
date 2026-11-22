{{-- 
    Modal: Aceitar Convite para o Lar
    Permite ao parceiro aceitar a união no Lar com 1 clique
--}}
<div id="modalAceitarConviteLar" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="fecharModalId('modalAceitarConviteLar')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <div class="p-6 text-center space-y-4">
            <div class="size-16 rounded-3xl bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 mx-auto flex items-center justify-center shadow-soft">
                <i data-lucide="home" class="size-8"></i>
            </div>

            <div class="space-y-1">
                <h3 class="text-lg font-extrabold text-foreground" id="aceitarConviteTitulo">Convite para o Lar</h3>
                <p class="text-xs text-muted-foreground leading-relaxed" id="aceitarConviteDesc">
                    Você foi convidado(a) para compartilhar o Lar no SEIVA!
                </p>
            </div>

            <!-- Informações do Lar e Remetente -->
            <div class="p-4 rounded-2xl bg-muted/50 border border-border text-left space-y-2 text-xs">
                <div class="flex justify-between items-center">
                    <span class="text-muted-foreground">Quem convidou:</span>
                    <strong class="text-foreground" id="aceitarConviteRemetenteNome">Parceiro</strong>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-muted-foreground">Nome do Lar:</span>
                    <strong class="text-emerald-700 dark:text-emerald-400" id="aceitarConviteNomeLar">Nosso Cantinho</strong>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-muted-foreground">Sua Caixa Preta:</span>
                    <strong class="text-emerald-600 flex items-center gap-1">
                        <i data-lucide="lock" class="size-3"></i> 100% Protegida
                    </strong>
                </div>
            </div>

            <input type="hidden" id="aceitarConviteToken" value="">

            <div class="flex items-center gap-2 pt-2">
                <button type="button" onclick="recusarConviteLarAtual()" class="flex-1 py-3 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition">
                    Agora não
                </button>
                <button type="button" onclick="confirmarAceiteConviteLar()" id="btnConfirmarAceiteConvite" class="flex-1 py-3 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs transition shadow-soft flex items-center justify-center gap-1.5">
                    <i data-lucide="check" class="size-4"></i>
                    <span>Aceitar Convite</span>
                </button>
            </div>
        </div>
    </div>
</div>
