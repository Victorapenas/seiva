{{--
    Modal: Painel de Boas-Vindas Inteligente (Quick Launch)
    Aparece ao entrar no sistema com:
      1. Saudação contextual com resumo do dia
      2. Notificações reais do banco de dados
      3. Ações rápidas personalizáveis (fixáveis pelo usuário)
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="modalBoasVindas" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4"
     role="dialog" aria-modal="true" aria-labelledby="boasVindasTitle">

    {{-- Overlay escuro com blur --}}
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"
         onclick="fecharBoasVindas()"></div>

    {{-- Painel principal - sheet mobile / modal desktop --}}
    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh]"
         style="animation: slideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1)">

        {{-- ══ CABEÇALHO COM DRAG HANDLE MOBILE ══ --}}
        <div class="flex-shrink-0">
            {{-- Drag handle para mobile --}}
            <div class="flex justify-center pt-3 pb-1 sm:hidden">
                <div class="w-10 h-1 rounded-full bg-muted"></div>
            </div>

            {{-- Header com saudação e botões de controle --}}
            <div class="px-5 pt-2 pb-4 sm:pt-5 border-b border-border/60">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-base">🌱</span>
                            <p class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                                Onde seu dinheiro cria raízes
                            </p>
                        </div>
                        <h2 id="boasVindasTitle" class="text-lg font-extrabold text-foreground leading-tight">
                            <span id="bvSaudacao">Bom dia</span>, <span id="bvNome">...</span>
                        </h2>
                        <p id="bvSubtitulo" class="text-xs text-muted-foreground mt-0.5">
                            Carregando resumo do dia...
                        </p>
                    </div>
                    <div class="flex items-center gap-1.5 shrink-0">
                        {{-- Botão de personalizar --}}
                        <button type="button" onclick="abrirPersonalizacaoBoasVindas()"
                                id="btnPersonalizarBV"
                                title="Personalizar ações rápidas"
                                class="size-8 rounded-xl border border-border bg-muted/50 text-muted-foreground hover:text-foreground hover:bg-muted flex items-center justify-center transition">
                            <i data-lucide="settings-2" class="size-3.5"></i>
                        </button>
                        {{-- Botão fechar --}}
                        <button type="button" onclick="fecharBoasVindas()"
                                class="size-8 rounded-xl border border-border bg-muted/50 text-muted-foreground hover:text-foreground hover:bg-muted flex items-center justify-center transition">
                            <i data-lucide="x" class="size-3.5"></i>
                        </button>
                    </div>
                </div>

                {{-- Resumo financeiro compacto (3 pills) --}}
                <div id="bvResumoFinanceiro" class="mt-3 flex flex-wrap gap-2">
                    <div class="flex items-center gap-1.5 rounded-xl bg-emerald-50 border border-emerald-200/60 px-3 py-1.5">
                        <i data-lucide="trending-up" class="size-3 text-emerald-600 shrink-0"></i>
                        <div>
                            <p class="text-[9px] text-emerald-700 font-medium leading-none">Entradas</p>
                            <p id="bvValorEntradas" class="text-xs font-extrabold text-emerald-800 leading-tight">R$ ---</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 rounded-xl bg-rose-50 border border-rose-200/60 px-3 py-1.5">
                        <i data-lucide="trending-down" class="size-3 text-rose-500 shrink-0"></i>
                        <div>
                            <p class="text-[9px] text-rose-600 font-medium leading-none">Saídas</p>
                            <p id="bvValorSaidas" class="text-xs font-extrabold text-rose-700 leading-tight">R$ ---</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 rounded-xl bg-blue-50 border border-blue-200/60 px-3 py-1.5">
                        <i data-lucide="wallet" class="size-3 text-blue-600 shrink-0"></i>
                        <div>
                            <p class="text-[9px] text-blue-700 font-medium leading-none">Livre</p>
                            <p id="bvValorLivre" class="text-xs font-extrabold text-blue-800 leading-tight">R$ ---</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ CORPO ROLÁVEL ══ --}}
        <div class="flex-1 overflow-y-auto no-scrollbar">

            {{-- ── PAINEL DE PERSONALIZAÇÃO (oculto por padrão) ── --}}
            <div id="painelPersonalizacaoBV" class="hidden border-b border-border/60 bg-muted/30 px-5 py-4">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="text-xs font-bold text-foreground flex items-center gap-1.5">
                        <i data-lucide="settings-2" class="size-3.5 text-primary"></i>
                        Personalizar ações rápidas
                    </h4>
                    <button type="button" onclick="fecharPersonalizacaoBoasVindas()"
                            class="text-xs text-primary font-semibold hover:underline">
                        Concluir
                    </button>
                </div>
                <p class="text-xs text-muted-foreground mb-3">Marque as ações que quer ver aqui ao entrar no sistema:</p>
                <div class="space-y-2" id="listaPersonalizacaoBV">
                    <!-- Itens injetados via JS -->
                </div>
            </div>

            {{-- ── NOTIFICAÇÕES ── --}}
            <div class="px-5 py-4 border-b border-border/60">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="flex items-center gap-1.5 text-xs font-bold text-foreground">
                        <i data-lucide="bell" class="size-3.5 text-primary"></i>
                        Notificações
                        <span id="bvBadgeNotif" class="hidden ml-1 size-4 rounded-full bg-rose-500 text-white text-[9px] font-bold flex items-center justify-center"></span>
                    </h3>
                    <button type="button" onclick="marcarTodasLidasBV()"
                            class="text-xs text-muted-foreground hover:text-primary font-medium transition">
                        Marcar todas como lidas
                    </button>
                </div>
                <div id="bvListaNotificacoes" class="space-y-2">
                    {{-- Loading placeholder --}}
                    <div class="flex items-center gap-3 p-3 rounded-2xl bg-muted/40 animate-pulse">
                        <div class="size-9 rounded-xl bg-muted shrink-0"></div>
                        <div class="flex-1 space-y-1.5">
                            <div class="h-3 bg-muted rounded w-3/4"></div>
                            <div class="h-2.5 bg-muted rounded w-1/2"></div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 rounded-2xl bg-muted/40 animate-pulse">
                        <div class="size-9 rounded-xl bg-muted shrink-0"></div>
                        <div class="flex-1 space-y-1.5">
                            <div class="h-3 bg-muted rounded w-2/3"></div>
                            <div class="h-2.5 bg-muted rounded w-1/3"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── AÇÕES RÁPIDAS ── --}}
            <div class="px-5 py-4">
                <h3 class="flex items-center gap-1.5 text-xs font-bold text-foreground mb-3">
                    <i data-lucide="zap" class="size-3.5 text-primary"></i>
                    Ações rápidas
                </h3>
                <div id="bvAcoesRapidas" class="grid grid-cols-2 gap-2">
                    {{-- Injetado via JS conforme preferências salvas --}}
                </div>
            </div>
        </div>

        {{-- ══ RODAPÉ FIXO COM CTA PRINCIPAL ══ --}}
        <div class="flex-shrink-0 px-5 pb-5 pt-3 border-t border-border/60 bg-card">
            <button type="button" onclick="fecharBoasVindas()"
                    class="w-full py-3 rounded-2xl bg-primary hover:bg-primary/90 text-white font-bold text-sm transition shadow-soft flex items-center justify-center gap-2">
                <i data-lucide="layout-dashboard" class="size-4"></i>
                Ir para o dashboard
            </button>
            <label class="flex items-center justify-center gap-2 mt-2.5 cursor-pointer select-none">
                <input type="checkbox" id="bvNaoMostrarHoje" class="rounded border-border size-3.5 accent-primary"
                       onchange="atualizarNaoMostrarBV(this.checked)">
                <span class="text-xs text-muted-foreground">Não mostrar hoje</span>
            </label>
        </div>
    </div>
</div>

<style>
@keyframes slideUp {
    from { transform: translateY(40px); opacity: 0; }
    to   { transform: translateY(0);    opacity: 1; }
}
</style>
