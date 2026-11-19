{{-- 
    Componente: Barra Superior (Topbar)
    Responsável: Victor Hugo / Equipe SEIVA
    Funcionalidade: Cabeçalho com logo mobile, botão de perfil e notificações do Lar
--}}
<header class="sticky top-0 z-20 flex items-center justify-between border-b border-border/60 bg-background/80 px-4 py-3 backdrop-blur-sm lg:px-10 lg:justify-end">
    <!-- Logo Mobile -->
    <div class="flex items-center gap-2 lg:hidden">
        <div class="size-8 overflow-hidden rounded-xl border border-border bg-card p-1 shadow-soft">
            <img src="/seiva-logo.png" alt="SEIVA" class="object-contain w-full h-full" onerror="this.src='/icon.svg'">
        </div>
        <span class="text-sm font-extrabold text-foreground tracking-tight">SEIVA</span>
    </div>

    <!-- Ações Topbar (Configurações e Notificações) -->
    <div class="flex items-center gap-2">
        <button onclick="trocarAbaApp('perfil')" aria-label="Configurações" class="flex size-10 items-center justify-center rounded-full border border-border bg-card text-muted-foreground transition hover:text-foreground lg:hidden shadow-soft">
            <i data-lucide="settings" class="size-5"></i>
        </button>
        <button onclick="seivaNotificar('Cobrador diplomata ativo e sincronização das contas do Lar em tempo real.', 'info', 'Notificações do Lar');" aria-label="Notificações" class="relative flex size-10 items-center justify-center rounded-full border border-border bg-card text-foreground shadow-soft transition hover:bg-muted">
            <i data-lucide="bell" class="size-5"></i>
            <span class="absolute -right-0.5 -top-0.5 flex size-4 items-center justify-center rounded-full bg-destructive text-[9px] font-bold text-destructive-foreground">
                1
            </span>
        </button>
    </div>
</header>
