{{--
    Modal / Pop-up Dedicado de Notificações SEIVA
    Abre ao clicar no ícone de sino da barra superior (Topbar)
    Completamente livre de emojis, utilizando estritamente Lucide Icons SVG
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="modalNotificacoesPopup" class="hidden fixed inset-0 z-[9999] flex items-start sm:items-start justify-end p-2 sm:p-4 sm:pt-16" role="dialog" aria-modal="true">
    {{-- Backdrop transparente com clique para fechar --}}
    <div class="fixed inset-0 bg-black/20 backdrop-blur-xs transition-opacity" onclick="fecharModalNotificacoesPopup()"></div>

    {{-- Caixa do Pop-up suspensa abaixo do sino --}}
    <div class="relative w-full max-w-sm sm:max-w-md bg-card border border-border rounded-3xl shadow-elevated overflow-hidden flex flex-col max-h-[85vh] transition-all" style="animation: slideDownFade 0.2s cubic-bezier(0.16, 1, 0.3, 1)">
        
        <!-- Header -->
        <div class="px-5 py-4 border-b border-border/60 flex items-center justify-between gap-3 bg-card shrink-0">
            <div class="flex items-center gap-2.5">
                <span class="size-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300 flex items-center justify-center border border-emerald-500/20">
                    <i data-lucide="bell" class="size-4"></i>
                </span>
                <div>
                    <h3 class="text-sm font-extrabold text-foreground flex items-center gap-2">
                        <span>Notificações</span>
                        <span id="popupNotifBadgeContador" class="hidden px-2 py-0.5 rounded-full bg-rose-600 text-white text-[10px] font-black leading-none">0</span>
                    </h3>
                    <p class="text-[11px] text-muted-foreground">Avisos do seu Lar e movimentações</p>
                </div>
            </div>

            <div class="flex items-center gap-1.5">
                <button type="button" onclick="marcarTodasLidasPopup()" title="Marcar todas como lidas" class="p-1.5 rounded-xl hover:bg-muted text-muted-foreground hover:text-foreground text-xs font-semibold flex items-center gap-1 transition">
                    <i data-lucide="check-check" class="size-4"></i>
                    <span class="text-[10px] hidden sm:inline">Lidas</span>
                </button>
                <button type="button" onclick="fecharModalNotificacoesPopup()" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                    <i data-lucide="x" class="size-4"></i>
                </button>
            </div>
        </div>

        <!-- Lista de Notificações com scroll -->
        <div id="popupNotificacoesLista" class="p-4 space-y-3 overflow-y-auto no-scrollbar flex-1">
            <!-- Loading placeholder -->
            <div class="flex items-center gap-3 p-3 rounded-2xl bg-muted/30 animate-pulse">
                <div class="size-9 rounded-xl bg-muted shrink-0"></div>
                <div class="flex-1 space-y-1.5">
                    <div class="h-3 bg-muted rounded w-3/4"></div>
                    <div class="h-2 bg-muted rounded w-1/2"></div>
                </div>
            </div>
        </div>

        <!-- Rodapé do Pop-up -->
        <div class="p-3 border-t border-border/60 bg-muted/20 flex items-center justify-between text-xs shrink-0">
            <span class="text-[11px] text-muted-foreground">Você registra, o SEIVA organiza</span>
            <button type="button" onclick="abrirModalBoasVindasCompleto()" class="text-emerald-700 dark:text-emerald-400 hover:underline font-bold text-[11px] flex items-center gap-1">
                <span>Resumo do dia</span>
                <i data-lucide="arrow-right" class="size-3"></i>
            </button>
        </div>
    </div>
</div>

<style>
@keyframes slideDownFade {
    from { opacity: 0; transform: translateY(-10px) scale(0.98); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}
</style>
