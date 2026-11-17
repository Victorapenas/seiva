{{-- 
    Componente: Sidebar Lateral Desktop
    Responsável: Victor Hugo / Equipe SEIVA
    Funcionalidade: Menu fixo com atalhos de navegação para áreas pessoais, do Lar e de perfil
--}}
<aside class="fixed inset-y-0 left-0 z-30 hidden w-64 flex-col border-r border-border bg-sidebar lg:flex">
    <!-- Header Sidebar -->
    <div class="px-6 py-6">
        <div class="flex items-center gap-2.5">
            <div class="relative size-10 overflow-hidden rounded-2xl border border-border bg-card flex items-center justify-center p-1.5 shadow-soft">
                <img src="/seiva-logo.png" alt="SEIVA" class="object-contain w-full h-full" onerror="this.src='/icon.svg'">
            </div>
            <div>
                <span class="text-base font-extrabold tracking-tight text-foreground block leading-none">SEIVA</span>
                <span class="text-[10px] font-medium text-muted-foreground">Dinheiro Sem Tabu</span>
            </div>
        </div>
    </div>

    <!-- Navegação Sidebar -->
    <nav class="flex-1 space-y-5 overflow-y-auto px-4 pb-4 no-scrollbar">
        <div>
            <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-muted-foreground flex items-center gap-1.5">
                <i data-lucide="lock" class="size-3 text-primary"></i> Minha área
            </p>
            <div class="space-y-1">
                <button onclick="trocarAbaApp('dashboard')" class="nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors bg-primary text-primary-foreground shadow-soft" data-screen="dashboard">
                    <i data-lucide="home" class="size-[18px]"></i>
                    <span>Dashboard</span>
                </button>
                <button onclick="trocarAbaApp('caixa-preta')" class="nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="caixa-preta">
                    <i data-lucide="lock" class="size-[18px]"></i>
                    <span>Caixa Preta</span>
                </button>
                <button onclick="trocarAbaApp('transacoes')" class="nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="transacoes">
                    <i data-lucide="credit-card" class="size-[18px]"></i>
                    <span>Transações</span>
                </button>
                <button onclick="trocarAbaApp('metas')" class="nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="metas">
                    <i data-lucide="target" class="size-[18px]"></i>
                    <span>Metas</span>
                </button>
            </div>
        </div>

        <div>
            <p id="labelGrupoLarSidebar" class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-muted-foreground flex items-center gap-1.5">
                <i data-lucide="home" class="size-3 text-emerald-600"></i> Nosso Cantinho
            </p>
            <div class="space-y-1">
                <button onclick="trocarAbaApp('lar')" class="nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="lar">
                    <i data-lucide="leaf" class="size-[18px]"></i>
                    <span>Área do Lar</span>
                </button>
                <button onclick="trocarAbaApp('acordos')" class="nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="acordos">
                    <i data-lucide="handshake" class="size-[18px]"></i>
                    <span>Mesa de Acordos</span>
                </button>
                <button onclick="trocarAbaApp('cobrador')" class="nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="cobrador">
                    <i data-lucide="bell-ring" class="size-[18px]"></i>
                    <span>Cobrador Diplomata</span>
                </button>
            </div>
        </div>

        <div>
            <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-muted-foreground flex items-center gap-1.5">
                <i data-lucide="shield" class="size-3 text-primary"></i> Privacidade
            </p>
            <div class="space-y-1">
                <button onclick="trocarAbaApp('perfil')" class="nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="perfil">
                    <i data-lucide="user" class="size-[18px]"></i>
                    <span>Perfil & LGPD</span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Rodapé Sidebar Usuário -->
    <div class="p-4 border-t border-border">
        <button onclick="trocarAbaApp('perfil')" class="flex items-center gap-3 w-full rounded-2xl border border-border bg-card p-3 text-left transition hover:bg-accent/40 shadow-soft">
            <div id="userAvatarSidebar" class="size-10 rounded-full bg-pink-100 text-pink-700 font-bold flex items-center justify-center text-xs shrink-0 ring-2 ring-primary/20">
                DU
            </div>
            <div class="min-w-0 flex-1">
                <p id="userNameSidebar" class="truncate text-sm font-semibold text-foreground">Usuário</p>
                <span id="userLarPillSidebar" class="mt-0.5 inline-flex items-center gap-1 rounded-full bg-accent px-2 py-0.5 text-[10px] font-semibold text-accent-foreground">
                    Nosso Cantinho 🌿
                </span>
            </div>
        </button>
    </div>
</aside>
