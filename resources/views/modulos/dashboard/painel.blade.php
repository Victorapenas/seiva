{{-- 
    Módulo: Dashboard Consolidado e Painel Pessoal (RF009)
    Responsável Acadêmico: Victor Hugo
    Funcionalidade: Saldos consolidados, fluxo de caixa (saldo livre vs comprometido), contas bancárias e atalhos rápidos
--}}
<div id="pane-dashboard" class="sub-screen space-y-6">
    <header class="flex items-center gap-3">
        <div id="dashAvatar" class="size-11 rounded-full bg-pink-100 text-pink-700 font-bold flex items-center justify-center text-sm ring-2 ring-card shadow-soft shrink-0">
            DU
        </div>
        <div class="min-w-0 flex-1">
            <p id="dashGreeting" class="text-base font-semibold text-foreground">Bom dia, Usuário</p>
            <p id="dashDate" class="text-xs text-muted-foreground">Organização financeira com total transparência</p>
        </div>
        <span class="hidden items-center gap-1.5 rounded-full bg-secondary px-3 py-1.5 text-[11px] font-medium text-secondary-foreground sm:flex">
            <i data-lucide="info" class="size-3.5"></i> Você registra, o SEIVA organiza
        </span>
    </header>

    <!-- Card Consolidado do Mês -->
    <section>
        <div class="mb-2 flex items-end justify-between">
            <div>
                <h2 class="text-sm font-semibold text-foreground">Seu mês</h2>
                <p class="text-[11px] text-muted-foreground">Visão consolidada de receitas e despesas</p>
            </div>
            <button onclick="alternarVisibilidadeSaldos()" id="btnVisSaldos" class="flex shrink-0 items-center gap-1 text-xs font-medium text-muted-foreground hover:text-foreground">
                <i data-lucide="eye" class="size-3.5"></i>
                <span>Ocultar</span>
            </button>
        </div>

        <div class="rounded-3xl border border-border bg-card p-6 shadow-card">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-border pb-5">
                <div>
                    <p class="text-xs text-muted-foreground">Saldo Líquido Disponível</p>
                    <h3 class="text-3xl font-extrabold text-foreground mt-1" id="dashValSaldoLivre">R$ 0,00</h3>
                </div>
                <div class="flex gap-2">
                    <button onclick="abrirModalGasto()" class="px-4 py-2 rounded-xl bg-destructive text-destructive-foreground text-xs font-bold transition hover:bg-destructive/90 flex items-center gap-1.5">
                        <i data-lucide="trending-down" class="size-4"></i> Lançar Gasto
                    </button>
                    <button onclick="abrirModalEntrada()" class="px-4 py-2 rounded-xl bg-primary text-primary-foreground text-xs font-bold transition hover:bg-primary/90 flex items-center gap-1.5">
                        <i data-lucide="trending-up" class="size-4"></i> Entrada
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-2 divide-x divide-border pt-4">
                <div class="pr-4">
                    <p class="flex items-center gap-1.5 text-[11px] font-medium text-destructive">
                        <span class="size-2 rounded-full bg-destructive"></span> Já tem dono
                    </p>
                    <p class="mt-1 text-lg font-bold text-destructive" id="dashValComprometido">R$ 0,00</p>
                    <p class="mt-0.5 text-[11px] text-muted-foreground">Faturas e reservas</p>
                </div>
                <div class="pl-4">
                    <p class="flex items-center gap-1.5 text-[11px] font-medium text-success">
                        <span class="size-2 rounded-full bg-success"></span> Livre pra gastar
                    </p>
                    <p class="mt-1 text-lg font-bold text-success" id="dashValLivre">R$ 0,00</p>
                    <p class="mt-0.5 text-[11px] text-muted-foreground">Saldo desimpedido</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4 Atalhos Rápidos -->
    <div class="grid grid-cols-2 gap-2 sm:grid-cols-4">
        <button onclick="abrirModalGasto()" class="flex flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-4 shadow-soft hover:bg-accent/30 transition text-center">
            <span class="size-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                <i data-lucide="trending-down" class="size-5"></i>
            </span>
            <span class="text-xs font-semibold text-foreground">Registrar gasto</span>
        </button>
        <button onclick="abrirModalEntrada()" class="flex flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-4 shadow-soft hover:bg-accent/30 transition text-center">
            <span class="size-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <i data-lucide="trending-up" class="size-5"></i>
            </span>
            <span class="text-xs font-semibold text-foreground">Registrar entrada</span>
        </button>
        <button onclick="trocarAbaApp('transacoes')" class="flex flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-4 shadow-soft hover:bg-accent/30 transition text-center">
            <span class="size-10 rounded-xl bg-secondary text-secondary-foreground flex items-center justify-center">
                <i data-lucide="receipt" class="size-5"></i>
            </span>
            <span class="text-xs font-semibold text-foreground">Ver extrato</span>
        </button>
        <button onclick="trocarAbaApp('lar')" class="flex flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-4 shadow-soft hover:bg-accent/30 transition text-center">
            <span class="size-10 rounded-xl bg-accent text-accent-foreground flex items-center justify-center">
                <i data-lucide="home" class="size-5"></i>
            </span>
            <span class="text-xs font-semibold text-foreground">Contas do Lar</span>
        </button>
    </div>

    <!-- Contas Bancárias Cadastradas -->
    <section>
        <div class="mb-3 flex items-center justify-between">
            <h2 class="flex items-center gap-1.5 text-sm font-semibold text-foreground">
                <i data-lucide="wallet" class="size-4 text-primary"></i> Onde está meu dinheiro
            </h2>
            <button onclick="adicionarContaPrompt()" class="flex items-center gap-1 text-xs font-medium text-primary hover:underline">
                <i data-lucide="plus" class="size-3.5"></i> Nova conta
            </button>
        </div>
        <div id="dashContasList" class="space-y-2">
            <p class="text-xs text-muted-foreground py-4 text-center">Nenhuma conta cadastrada.</p>
        </div>
    </section>
</div>
