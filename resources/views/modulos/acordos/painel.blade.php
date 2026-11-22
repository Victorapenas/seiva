{{-- 
    Módulo: Mesa de Acordos e Consenso Mútuo do Casal (RF006)
    Responsável Acadêmico: Ian Marcos
    Funcionalidade: Negociações em aberto, aceitação/recusa/contraproposta diplomática,
    acordos selados em "Poupando juntos" e "Dívidas divididas".
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="pane-acordos" class="sub-screen space-y-6 hidden max-w-5xl mx-auto pb-12">

    <!-- ESTADO VAZIO / SEM LAR (PARA USUÁRIOS INDIVIDUAIS) -->
    <div id="acordosCardBloqueioSemLar" class="hidden p-8 sm:p-12 rounded-3xl border border-border bg-card shadow-card text-center space-y-5 max-w-xl mx-auto my-8">
        <div class="size-20 rounded-3xl bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 mx-auto flex items-center justify-center shadow-soft">
            <i data-lucide="handshake" class="size-10"></i>
        </div>
        <div class="space-y-1.5">
            <h2 class="text-xl font-black text-foreground">Mesa de Acordos Requer um Lar</h2>
            <p class="text-xs text-muted-foreground leading-relaxed">
                A <strong>Mesa de Acordos</strong> foi desenvolvida para consensos diplomáticos entre casais (propostas, contrapropostas e metas de poupança conjunta). Convide seu parceiro(a) para começar a selar combinados tranquilos!
            </p>
        </div>
        <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-3">
            <button type="button" onclick="trocarAbaApp('dashboard')" class="w-full sm:w-auto px-5 py-3 rounded-2xl border border-border bg-card text-foreground font-bold text-xs hover:bg-muted transition">
                Voltar ao Início
            </button>
            <button type="button" onclick="abrirModalConvidarParceiro()" 
                    class="w-full sm:w-auto px-6 py-3 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs transition shadow-soft inline-flex items-center justify-center gap-2">
                <i data-lucide="heart-handshake" class="size-4"></i>
                <span>Convidar Parceiro(a)</span>
            </button>
        </div>
    </div>

    <!-- CONTEÚDO OFICIAL DA MESA DE ACORDOS -->
    <div id="acordosConteudoCasal" class="space-y-6">
    <!-- 1. HEADER DA MESA DE ACORDOS (IMAGEM 1) -->
    <header class="space-y-1">
        <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-foreground">Mesa de Acordos</h1>
        <p class="text-xs sm:text-sm text-muted-foreground font-medium">Combinados claros, relacionamento tranquilo.</p>
    </header>

    <!-- 2 CARDS INFORMATIVOS DE TOPO: POUPAR JUNTOS & DÍVIDA DIVIDIDA (IMAGEM 1) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <!-- Card Poupar juntos -->
        <div class="p-4 rounded-3xl border border-emerald-300/60 dark:border-emerald-800/40 bg-emerald-50/50 dark:bg-emerald-950/20 space-y-2 shadow-2xs">
            <div class="flex items-center gap-2.5">
                <span class="size-8 rounded-xl bg-emerald-800 text-white flex items-center justify-center shrink-0">
                    <i data-lucide="piggy-bank" class="size-4"></i>
                </span>
                <strong class="text-xs font-black text-foreground">Poupar juntos</strong>
            </div>
            <p class="text-[11px] text-muted-foreground leading-relaxed">
                Ainda não compraram. Juntam dinheiro todo mês até dar. Contribuição flexível.
            </p>
        </div>

        <!-- Card Dívida dividida -->
        <div class="p-4 rounded-3xl border border-border bg-card space-y-2 shadow-2xs">
            <div class="flex items-center gap-2.5">
                <span class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                    <i data-lucide="credit-card" class="size-4"></i>
                </span>
                <strong class="text-xs font-black text-foreground">Dívida dividida</strong>
            </div>
            <p class="text-[11px] text-muted-foreground leading-relaxed">
                Já foi comprado. Cada um paga sua parte todo mês. Obrigatório até quitar.
            </p>
        </div>
    </div>

    <!-- 2. SEÇÃO: NEGOCIAÇÕES EM ABERTO (IMAGENS 1, 2 E 3) -->
    <div class="space-y-3.5">
        <div class="flex items-center gap-2">
            <h3 class="text-sm font-black text-foreground">Negociações em aberto</h3>
            <span id="acordosBadgeContadorNegociacoes" class="px-2 py-0.5 rounded-full bg-rose-600 text-white text-[10px] font-black">2</span>
        </div>

        <div id="acordosListaNegociacoesAbertas" class="space-y-4">
            <!-- Renderizado dinamicamente via JS com propostas do Fogão Brastemp e Maquiagem Vult -->
        </div>
    </div>

    <!-- 3. SEÇÃO: POUPANDO JUNTOS (IMAGENS 3 E 4) -->
    <div class="space-y-3.5 pt-2">
        <div class="flex items-center gap-2 text-xs font-bold text-foreground">
            <i data-lucide="piggy-bank" class="size-4 text-emerald-600"></i>
            <span>Poupando juntos</span>
        </div>

        <div id="acordosListaPoupandoJuntos" class="space-y-3.5">
            <!-- Card expansível do Fogão Brastemp 5 bocas e outros -->
        </div>
    </div>

    <!-- 4. SEÇÃO: DÍVIDAS DIVIDIDAS (IMAGEM 4) -->
    <div class="space-y-3.5 pt-2">
        <div class="flex items-center gap-2 text-xs font-bold text-foreground">
            <i data-lucide="credit-card" class="size-4 text-emerald-600"></i>
            <span>Dívidas divididas</span>
        </div>

        <div id="acordosListaDividasDivididas" class="space-y-3">
            <!-- Geladeira Samsung Frost Free 460L -->
        </div>
    </div>

    <!-- Botão Flutuante / Ação para Novo Acordo -->
    <div class="pt-2">
        <button type="button" onclick="abrirModalNovoAcordo()" 
                class="w-full py-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm flex items-center justify-center gap-2 shadow-soft transition">
            <i data-lucide="plus" class="size-5"></i>
            <span>+ Propor novo acordo ao parceiro</span>
        </button>
    </div>
    </div>

</div>
