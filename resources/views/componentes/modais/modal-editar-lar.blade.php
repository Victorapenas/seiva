{{-- 
    Modal: Personalizar o Nosso Cantinho (Lar)
    Responsáveis Acadêmicos: Jhon Abner / Ian Marcos (RF004 / RF010)
    Bordão Oficial: "Onde seu dinheiro cria raízes"
    Permite escolher a foto do cantinho, nome personalizado, data de união e preferências de aconchego do casal.
--}}
<div id="modalEditarLar" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalEditarLar')"></div>

    <div class="relative w-full sm:max-w-lg bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center border border-emerald-500/20">
                    <i data-lucide="home" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Personalizar Nosso Cantinho</h3>
                    <p class="text-xs text-muted-foreground">Deixe o ambiente do Lar aconchegante e com a cara de vocês</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalEditarLar')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="salvarPersonalizacaoLar(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Nome do Lar -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Nome do Cantinho</label>
                <input type="text" id="editLarNomeInput" value="Nosso Cantinho" required
                       class="w-full h-12 px-4 rounded-2xl border border-border bg-card text-sm font-semibold text-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
            </div>

            <!-- Foto do Ambiente / Casa -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-foreground">Foto de Capa do Nosso Lar</label>
                <p class="text-[11px] text-muted-foreground">Escolha uma imagem aconchegante do cantinho de vocês:</p>

                <!-- Grid de Fotos Pré-selecionadas com Alta Resolução -->
                <div class="grid grid-cols-2 gap-2.5" id="gridFotosCapaLar">
                    <!-- Foto 1: Sala Confortável e Aconchegante -->
                    <button type="button" onclick="selecionarFotoCapaLar(this, '/lar-inicio.png')" 
                            class="chip-foto-lar active relative rounded-2xl overflow-hidden border-2 border-emerald-600 aspect-video group text-left">
                        <img src="/lar-inicio.png" alt="Sala Aconchegante" class="size-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-2.5">
                            <span class="text-white text-[11px] font-black flex items-center gap-1">
                                <i data-lucide="check" class="size-3 text-emerald-400"></i> Sala Aconchegante
                            </span>
                        </div>
                    </button>

                    <!-- Foto 2: Casal e Harmonia -->
                    <button type="button" onclick="selecionarFotoCapaLar(this, '/casal-hero.png')" 
                            class="chip-foto-lar relative rounded-2xl overflow-hidden border border-border aspect-video group text-left">
                        <img src="/casal-hero.png" alt="Nosso Momento" class="size-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-2.5">
                            <span class="text-white text-[11px] font-black">
                                Nosso Momento
                            </span>
                        </div>
                    </button>
                </div>
                <input type="hidden" id="editLarFotoEscolhida" value="/lar-inicio.png">
            </div>

            <!-- Tempo Juntos -->
            <div class="space-y-1.5 pt-1">
                <label class="text-xs font-bold text-foreground">Juntos desde</label>
                <input type="text" id="editLarDesdeInput" value="abril de 2026"
                       placeholder="Ex: abril de 2026"
                       class="w-full h-11 px-4 rounded-2xl border border-border bg-card text-xs font-semibold text-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
            </div>

            <!-- Botão Salvar -->
            <div class="pt-2">
                <button type="submit" 
                        class="w-full py-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs shadow-soft transition flex items-center justify-center gap-2">
                    <i data-lucide="check" class="size-4"></i>
                    <span>Salvar Mudanças no Cantinho</span>
                </button>
            </div>
        </form>
    </div>
</div>
