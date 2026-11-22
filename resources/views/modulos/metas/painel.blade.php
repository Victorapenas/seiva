{{--
    Módulo: Metas e Conquistas Financeiras (RF007, RF008)
    Responsáveis Acadêmicos: Ian Marcos / Victor Hugo
    Funcionalidade: Metas individuais e compartilhadas do Lar com projeção em dias, simulação de antecipação e monitoramento de produtos.
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="pane-metas" class="sub-screen space-y-6 hidden">

    <!-- HERO CARD: Resumo Nobre de Metas e Conquistas (Verde Floresta Escuro SEIVA) -->
    <div class="rounded-3xl bg-gradient-to-br from-[#06140c] via-[#091f14] to-[#041009] text-white border border-emerald-500/25 p-5 sm:p-6 shadow-elevated relative overflow-hidden">
        <!-- Marca d'água decorativa -->
        <div class="absolute -right-8 -bottom-8 opacity-5 pointer-events-none">
            <i data-lucide="target" class="size-48 text-emerald-300"></i>
        </div>

        <div class="relative space-y-1 z-10">
            <div class="flex items-center justify-between gap-2">
                <div class="flex items-center gap-2">
                    <span class="size-7 rounded-xl bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 flex items-center justify-center">
                        <i data-lucide="target" class="size-4"></i>
                    </span>
                    <span class="text-xs font-bold text-emerald-300 tracking-wide uppercase">Metas &amp; Conquistas</span>
                </div>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-950/80 border border-emerald-500/30 text-[10px] font-bold text-emerald-300">
                    <i data-lucide="sparkles" class="size-3"></i> Onde seu dinheiro cria raízes
                </span>
            </div>

            <div class="pt-2">
                <span class="text-[11px] text-emerald-300/80 uppercase font-semibold">Total Acumulado nas Metas</span>
                <div class="flex items-baseline gap-2">
                    <h2 id="metasHeroTotal" class="text-3xl sm:text-4xl font-black tracking-tight text-white">R$ 0,00</h2>
                    <span id="metasHeroAlvo" class="text-xs text-emerald-300/80 font-medium">de R$ 0,00 planejados</span>
                </div>
            </div>
        </div>

        <!-- Métricas Rápidas: Progresso e Aporte Mensal -->
        <div class="relative mt-4 grid grid-cols-2 gap-3 z-10">
            <div class="rounded-2xl bg-white/[0.06] border border-white/10 p-3.5 backdrop-blur-xs">
                <div class="flex items-center justify-between">
                    <p class="text-[11px] text-emerald-300/80 font-medium">Progresso geral</p>
                    <i data-lucide="trending-up" class="size-3.5 text-emerald-400"></i>
                </div>
                <strong id="metasHeroProgresso" class="text-2xl font-black text-white mt-1 block">0%</strong>
            </div>
            <div class="rounded-2xl bg-white/[0.06] border border-white/10 p-3.5 backdrop-blur-xs">
                <div class="flex items-center justify-between">
                    <p class="text-[11px] text-emerald-300/80 font-medium">Guardo por mês</p>
                    <i data-lucide="calendar" class="size-3.5 text-emerald-400"></i>
                </div>
                <strong id="metasHeroMensal" class="text-2xl font-black text-white mt-1 block">R$ 0,00</strong>
            </div>
        </div>
    </div>

    <!-- ABAS PRINCIPAIS: Meus Objetivos | Planos do Lar (Sempre Visíveis e Claras) -->
    <div class="p-1.5 rounded-2xl bg-muted/60 border border-border/60 flex gap-2 shadow-2xs">
        <button id="tabMeusObjetivos"
                type="button"
                onclick="alternarAbaMetas('individual')"
                class="flex-1 py-3 px-4 rounded-xl text-xs sm:text-sm font-bold transition-all bg-card text-foreground shadow-2xs border border-border/50 flex items-center justify-center gap-2">
            <i data-lucide="target" class="size-4 text-emerald-700 dark:text-emerald-400"></i>
            <span>Meus Objetivos</span>
            <span id="badgeCountMetasIndiv" class="ml-1 text-[10px] font-black px-2 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300">0</span>
        </button>
        <button id="tabPlanoLar"
                type="button"
                onclick="alternarAbaMetas('lar')"
                class="flex-1 py-3 px-4 rounded-xl text-xs sm:text-sm font-bold transition-all text-muted-foreground hover:text-foreground flex items-center justify-center gap-2 border border-transparent">
            <i data-lucide="home" class="size-4 text-emerald-600 dark:text-emerald-400"></i>
            <span>Planos do Lar</span>
            <span id="badgeCountMetasLar" class="ml-1 text-[10px] font-black px-2 py-0.5 rounded-full bg-muted text-muted-foreground">0</span>
        </button>
    </div>

    <!-- ═══ PAINEL: MEUS OBJETIVOS (Individuais) ═══ -->
    <div id="painelMeusObjetivos" class="space-y-4">
        <!-- Subtítulo e orientação -->
        <div class="flex items-center justify-between px-1">
            <div>
                <h3 class="text-xs font-bold text-foreground">Objetivos Pessoais</h3>
                <p class="text-[11px] text-muted-foreground">Privados por padrão — visíveis apenas para você na Caixa Preta</p>
            </div>
            <button onclick="abrirModalCriarMeta('individual')" 
                    class="h-8 px-3 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs flex items-center gap-1.5 transition shadow-2xs">
                <i data-lucide="plus" class="size-3.5"></i>
                <span>Novo Objetivo</span>
            </button>
        </div>

        <!-- Lista de Metas Individuais -->
        <div id="metasListaMeusObjetivos" class="space-y-4">
            <div class="flex items-center justify-center py-12">
                <div class="text-center space-y-2">
                    <i data-lucide="target" class="size-10 text-muted-foreground/40 mx-auto"></i>
                    <p class="text-sm text-muted-foreground">Carregando seus objetivos...</p>
                </div>
            </div>
        </div>

        <!-- Botão Adicionar Meta Pessoal -->
        <button onclick="abrirModalCriarMeta('individual')"
                class="w-full py-4 rounded-3xl border-2 border-dashed border-emerald-600/30 hover:border-emerald-600 bg-card hover:bg-emerald-50/20 text-xs font-extrabold text-foreground transition flex items-center justify-center gap-2 shadow-2xs">
            <i data-lucide="plus" class="size-4 text-emerald-700 dark:text-emerald-400"></i>
            <span>+ Criar novo objetivo pessoal</span>
        </button>
    </div>

    <!-- ═══ PAINEL: PLANOS DO LAR (Compartilhadas com Parceiro) ═══ -->
    <div id="painelPlanoLar" class="space-y-4 hidden">
        <!-- Subtítulo e orientação do Lar -->
        <div class="flex items-center justify-between px-1">
            <div>
                <h3 class="text-xs font-bold text-foreground">Planos Compartilhados do Casal</h3>
                <p class="text-[11px] text-muted-foreground">Conquistas a dois com divisão proporcional justa no Nosso Cantinho</p>
            </div>
            <button onclick="abrirModalCriarMeta('compartilhada')" 
                    class="h-8 px-3 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs flex items-center gap-1.5 transition shadow-2xs">
                <i data-lucide="plus" class="size-3.5"></i>
                <span>Plano do Lar</span>
            </button>
        </div>

        <!-- Lista de Metas do Lar -->
        <div id="metasListaPlanoLar" class="space-y-4">
            <div class="flex items-center justify-center py-12">
                <div class="text-center space-y-2">
                    <i data-lucide="home" class="size-10 text-muted-foreground/40 mx-auto"></i>
                    <p class="text-sm text-muted-foreground">Carregando planos do lar...</p>
                </div>
            </div>
        </div>

        <!-- Botão Criar Meta Compartilhada -->
        <button onclick="abrirModalCriarMeta('compartilhada')"
                class="w-full py-4 rounded-3xl border-2 border-dashed border-emerald-600/30 hover:border-emerald-600 bg-card hover:bg-emerald-50/20 text-xs font-extrabold text-foreground transition flex items-center justify-center gap-2 shadow-2xs">
            <i data-lucide="plus" class="size-4 text-emerald-700 dark:text-emerald-400"></i>
            <span>+ Adicionar nova meta do Lar</span>
        </button>
    </div>

    <!-- ═══ SEÇÃO NOBRE: RADAR DE PRODUTOS DE OLHO (WISHLIST & MONITORAMENTO DE PREÇOS) ═══ -->
    <div class="rounded-3xl border border-emerald-500/25 bg-gradient-to-br from-[#06140c] via-[#091f14] to-[#041009] p-5 sm:p-6 space-y-4 text-white shadow-card relative overflow-hidden">
        <!-- Marca d'água -->
        <div class="absolute -right-6 -bottom-6 opacity-5 pointer-events-none">
            <i data-lucide="shopping-bag" class="size-40 text-emerald-300"></i>
        </div>

        <!-- Header da Seção de Produtos de Olho -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 relative z-10">
            <div>
                <div class="flex items-center gap-2">
                    <span class="size-7 rounded-xl bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 flex items-center justify-center">
                        <i data-lucide="shopping-bag" class="size-4"></i>
                    </span>
                    <h3 class="text-sm font-extrabold text-white">Produtos de Olho (Radar de Preços)</h3>
                    <span class="inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-950/80 border border-emerald-500/30 text-emerald-300">
                        <i data-lucide="bell" class="size-3 text-emerald-400"></i>
                        Radar Ativo
                    </span>
                </div>
                <p class="text-xs text-emerald-200/80 mt-1">Cole o link da loja online e orce produtos com antecedência para conquistar sem culpa</p>
            </div>

            <button type="button" onclick="abrirModalAdicionarProdutoOlho()"
                    class="h-8 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center justify-center gap-1.5 transition shrink-0 shadow-2xs">
                <i data-lucide="plus" class="size-3.5"></i>
                <span>Adicionar Produto</span>
            </button>
        </div>

        <!-- Card Explicativo Didático: Como Funciona -->
        <div class="p-3.5 rounded-2xl bg-white/[0.05] border border-white/10 backdrop-blur-xs flex items-start gap-3 relative z-10">
            <div class="size-8 rounded-xl bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 flex items-center justify-center shrink-0 mt-0.5">
                <i data-lucide="lightbulb" class="size-4"></i>
            </div>
            <div class="space-y-0.5 text-xs">
                <strong class="font-extrabold text-white block">Como funciona o Radar de Desejos?</strong>
                <p class="text-[11px] text-emerald-200/80 leading-relaxed">
                    Você cola o link do item (Amazon, Mercado Livre, Magalu...). O SEIVA monitora o valor e calcula em <strong>quantos dias</strong> você conquista o produto no seu ritmo atual. Quando quiser, você transforma o item em meta com 1 clique!
                </p>
            </div>
        </div>

        <!-- Grid de Produtos de Olho -->
        <div id="metasGridProdutosOlho" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3.5 relative z-10">
            <div class="py-8 text-center col-span-full space-y-2">
                <i data-lucide="loader-2" class="size-8 text-emerald-400 animate-spin mx-auto"></i>
                <p class="text-xs text-emerald-200/70">Carregando produtos monitorados...</p>
            </div>
        </div>
    </div>

</div>

