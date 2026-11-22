{{-- 
    Componente: Barra de Navegação Inferior Mobile (Bottom Nav)
    Responsável: Victor Hugo / Equipe SEIVA
    Funcionalidade: Acesso tátil aos módulos principais em telas pequenas (Dashboard, Extrato, Acordos, Metas, Lar)
--}}
<nav class="fixed inset-x-0 bottom-0 z-30 border-t border-border bg-card/95 backdrop-blur-sm lg:hidden">
    <div class="mx-auto flex max-w-lg items-center justify-around px-1 py-2">
        <button onclick="trocarAbaApp('dashboard')" class="flex flex-1 flex-col items-center gap-1 rounded-lg py-1.5 text-primary" data-screen="dashboard">
            <i data-lucide="home" class="size-5"></i>
            <span class="text-[10px] font-bold">Início</span>
        </button>
        <button onclick="trocarAbaApp('transacoes')" class="flex flex-1 flex-col items-center gap-1 rounded-lg py-1.5 text-muted-foreground" data-screen="transacoes">
            <i data-lucide="credit-card" class="size-5"></i>
            <span class="text-[10px] font-medium">Gastos</span>
        </button>
        <button id="bottomNavAcordos" onclick="trocarAbaApp('acordos')" class="flex flex-1 flex-col items-center gap-1 rounded-lg py-1.5 text-muted-foreground" data-screen="acordos">
            <i data-lucide="handshake" class="size-5"></i>
            <span class="text-[10px] font-medium">Acordos</span>
        </button>
        <button onclick="trocarAbaApp('metas')" class="flex flex-1 flex-col items-center gap-1 rounded-lg py-1.5 text-muted-foreground" data-screen="metas">
            <i data-lucide="target" class="size-5"></i>
            <span class="text-[10px] font-medium">Metas</span>
        </button>
        <button id="bottomNavLar" onclick="trocarAbaApp('lar')" class="flex flex-1 flex-col items-center gap-1 rounded-lg py-1.5 text-muted-foreground" data-screen="lar">
            <i data-lucide="leaf" class="size-5"></i>
            <span class="text-[10px] font-medium">Lar</span>
        </button>
    </div>
</nav>
