{{-- 
    Módulo: Perfil do Usuário e Conformidade com a LGPD (RF011)
    Responsável Acadêmica: Maria Eduarda (Duda)
    Funcionalidade: Gestão cadastral, direitos do titular (Art. 18 LGPD), exportação de dados e revogação
--}}
<div id="pane-perfil" class="sub-screen space-y-6 hidden">
    <!-- Header do Usuário -->
    <header class="rounded-3xl bg-primary p-6 text-primary-foreground shadow-card">
        <div class="flex items-center gap-4">
            <div id="perfilAvatarCircle" class="size-16 rounded-full bg-pink-100 text-pink-700 font-bold flex items-center justify-center text-lg ring-2 ring-primary-foreground/30 shrink-0">
                DU
            </div>
            <div class="min-w-0 flex-1">
                <p id="perfilNomeTxt" class="text-lg font-bold tracking-tight truncate">Nome Usuário</p>
                <p id="perfilEmailTxt" class="text-xs opacity-80 truncate">email@email.com</p>
                <span class="mt-1 inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-200">
                    <i data-lucide="check-circle" class="size-3"></i> Conta Ativa
                </span>
            </div>
        </div>
        <button onclick="executarLogout()" class="mt-4 flex items-center gap-1.5 rounded-xl bg-primary-foreground/15 px-3.5 py-2 text-xs font-semibold transition hover:bg-primary-foreground/25">
            <i data-lucide="log-out" class="size-4"></i> Sair da Conta
        </button>
    </header>

    <!-- Card de Proteção de Dados e LGPD (Lei nº 13.709/2018) -->
    <div class="rounded-3xl border border-border bg-card p-6 shadow-card space-y-4">
        <div class="flex items-center gap-2.5">
            <div class="size-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                <i data-lucide="shield-check" class="size-5"></i>
            </div>
            <div>
                <h3 class="text-sm font-bold text-foreground">Privacidade & Direitos do Titular (LGPD)</h3>
                <p class="text-[11px] text-muted-foreground">Lei Federal nº 13.709/2018 · Artigo 18</p>
            </div>
        </div>
        
        <p class="text-xs text-muted-foreground leading-relaxed">
            No SEIVA, você tem total soberania sobre suas informações. Seus dados financeiros são privados e você pode exportar cópia completa ou solicitar a exclusão definitiva a qualquer momento.
        </p>

        <div class="flex flex-wrap gap-2.5 pt-2">
            <button onclick="window.location.href='/api/perfil/exportar'" class="px-4 py-2.5 rounded-xl border border-border bg-card text-foreground font-semibold text-xs hover:bg-muted transition flex items-center gap-2 shadow-soft">
                <i data-lucide="download" class="size-4 text-primary"></i> Exportar Meus Dados (JSON)
            </button>
            <button onclick="excluirMinhaConta()" class="px-4 py-2.5 rounded-xl bg-destructive text-destructive-foreground font-semibold text-xs hover:bg-destructive/90 transition flex items-center gap-2 shadow-soft">
                <i data-lucide="trash-2" class="size-4"></i> Excluir Minha Conta
            </button>
        </div>
    </div>
</div>
