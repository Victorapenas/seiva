{{--
    Módulo: Metas e Objetivos Financeiros (RF007, RF008)
    Responsável Acadêmico: Ian Marcos / Victor Hugo
    Funcionalidade: Objetivos individuais e compartilhados com progresso, aportes e integração com Mesa de Acordos.
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="pane-metas" class="sub-screen space-y-5 hidden">

    <!-- HERO CARD: Resumo de Objetivos -->
    <div class="rounded-3xl bg-primary text-primary-foreground p-6 shadow-card relative overflow-hidden">
        <!-- Marca d'água decorativa -->
        <div class="absolute -right-8 -bottom-8 opacity-10 pointer-events-none">
            <i data-lucide="target" class="size-48 text-white"></i>
        </div>

        <div class="relative space-y-1">
            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold opacity-80 uppercase tracking-wider">Meus Objetivos</span>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-white/20 text-[10px] font-bold">
                    <i data-lucide="lock" class="size-3"></i> só você vê
                </span>
            </div>
            <h2 id="metasHeroTotal" class="text-3xl sm:text-4xl font-black tracking-tight text-white">R$ 0,00</h2>
            <p id="metasHeroAlvo" class="text-xs opacity-70">de R$ 0,00 planejados</p>
        </div>

        <div class="relative mt-5 grid grid-cols-2 gap-3">
            <div class="rounded-2xl bg-white/15 backdrop-blur-xs p-3.5">
                <p class="text-[11px] opacity-70 font-medium">Progresso geral</p>
                <strong id="metasHeroProgresso" class="text-xl font-black text-white mt-0.5 block">0%</strong>
            </div>
            <div class="rounded-2xl bg-white/15 backdrop-blur-xs p-3.5">
                <p class="text-[11px] opacity-70 font-medium">Guardo por mês</p>
                <strong id="metasHeroMensal" class="text-xl font-black text-white mt-0.5 block">R$ 0,00</strong>
            </div>
        </div>
    </div>

    <!-- ABAS: Meus Objetivos | Plano do Lar -->
    <div class="p-1 rounded-2xl bg-muted/60 flex gap-1 shadow-2xs">
        <button id="tabMeusObjetivos"
                onclick="alternarAbaMetas('individual')"
                class="flex-1 py-2.5 px-3 rounded-xl text-sm font-semibold transition-all bg-card text-foreground shadow-2xs flex items-center justify-center gap-2">
            <i data-lucide="target" class="size-4"></i>
            Meus Objetivos
        </button>
        <button id="tabPlanoLar"
                onclick="alternarAbaMetas('lar')"
                class="flex-1 py-2.5 px-3 rounded-xl text-sm font-semibold transition-all text-muted-foreground hover:text-foreground flex items-center justify-center gap-2">
            <i data-lucide="users" class="size-4"></i>
            Plano do Lar
        </button>
    </div>

    <!-- PAINEL: MEUS OBJETIVOS (Individual) -->
    <div id="painelMeusObjetivos" class="space-y-4">
        <div id="metasListaMeusObjetivos" class="space-y-4">
            <div class="flex items-center justify-center py-12">
                <div class="text-center space-y-2">
                    <i data-lucide="target" class="size-10 text-muted-foreground/40 mx-auto"></i>
                    <p class="text-sm text-muted-foreground">Nenhuma meta cadastrada ainda.</p>
                </div>
            </div>
        </div>

        <!-- Botão Criar Nova Meta -->
        <button onclick="abrirModalCriarMeta()"
                class="w-full py-3.5 rounded-2xl border-2 border-dashed border-border hover:border-primary/50 bg-card hover:bg-primary/5 text-sm font-bold text-foreground transition flex items-center justify-center gap-2 shadow-2xs">
            <i data-lucide="plus" class="size-4 text-primary"></i>
            Criar nova meta
        </button>
    </div>

    <!-- PAINEL: PLANO DO LAR (Metas Compartilhadas) -->
    <div id="painelPlanoLar" class="space-y-4 hidden">
        <div id="metasListaPlanoLar" class="space-y-4">
            <div class="flex items-center justify-center py-12">
                <div class="text-center space-y-2">
                    <i data-lucide="home" class="size-10 text-muted-foreground/40 mx-auto"></i>
                    <p class="text-sm text-muted-foreground">Nenhuma meta compartilhada.</p>
                    <p class="text-xs text-muted-foreground">Crie uma meta e selecione "Compartilhada" para incluir o casal.</p>
                </div>
            </div>
        </div>

        <!-- Botão criar meta do lar -->
        <button onclick="abrirModalCriarMeta()"
                class="w-full py-3.5 rounded-2xl border-2 border-dashed border-border hover:border-primary/50 bg-card hover:bg-primary/5 text-sm font-bold text-foreground transition flex items-center justify-center gap-2 shadow-2xs">
            <i data-lucide="plus" class="size-4 text-primary"></i>
            Adicionar meta do Lar
        </button>
    </div>
</div>
