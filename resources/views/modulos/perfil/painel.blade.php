{{-- 
    Módulo: Perfil do Usuário e Conformidade com a LGPD (RF011)
    Responsável Acadêmica: Maria Eduarda (Duda)
    Funcionalidade: Gestão cadastral, configurações pessoais, segurança,
    notificações, preferências, dados do lar e direitos LGPD (Art. 18 Lei nº 13.709/2018)
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="pane-perfil" class="sub-screen space-y-5 hidden max-w-5xl mx-auto pb-16">

    <!-- 1. HERO CARD DO USUÁRIO -->
    <div class="rounded-3xl bg-primary p-6 text-primary-foreground shadow-card">
        <div class="flex items-center gap-4">
            <!-- Avatar circular com iniciais -->
            <div id="perfilAvatarCircle"
                 class="size-20 rounded-full bg-primary-foreground/20 text-primary-foreground font-black text-xl flex items-center justify-center ring-4 ring-primary-foreground/20 shrink-0 select-none">
                DU
            </div>
            <div class="flex-1 min-w-0 space-y-1">
                <p id="perfilNomeTxt" class="text-lg font-black text-primary-foreground truncate">Maria Eduarda</p>
                <p id="perfilEmailTxt" class="text-sm text-primary-foreground/70 truncate">duda@seiva.app</p>
                <p id="perfilApelido" class="text-xs text-primary-foreground/60 italic">Apelido: Duda</p>
                <p id="perfilMembroDesde" class="text-[11px] text-primary-foreground/50">Membro desde abril de 2026</p>
            </div>
        </div>
        <div class="mt-5 flex gap-2">
            <button onclick="abrirModalEditarPerfil()"
                    class="flex-1 h-10 rounded-xl bg-primary-foreground/15 hover:bg-primary-foreground/25 text-primary-foreground text-xs font-bold flex items-center justify-center gap-1.5 transition-colors">
                <i data-lucide="pencil" class="size-4"></i> Editar perfil
            </button>
        </div>
    </div>

    <!-- 2. NOSSO CANTINHO -->
    <div class="rounded-3xl border border-border bg-card shadow-card p-5 space-y-4">
        <div class="flex items-center gap-2.5">
            <div class="size-9 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 flex items-center justify-center">
                <i data-lucide="home" class="size-4"></i>
            </div>
            <div>
                <p id="perfilLarNome" class="text-sm font-black text-foreground">Nosso Cantinho</p>
                <p id="perfilLarDesde" class="text-[10px] text-muted-foreground">Desde abril de 2026</p>
            </div>
        </div>
        <!-- Membros do lar -->
        <div class="space-y-2">
            <div class="flex items-center gap-3 p-3 rounded-2xl bg-muted/40">
                <div class="size-9 rounded-full bg-pink-100 text-pink-700 font-black text-xs flex items-center justify-center shrink-0">ME</div>
                <div class="flex-1 min-w-0">
                    <p id="perfilLarMeuNome" class="text-xs font-black text-foreground">Maria Eduarda</p>
                    <p id="perfilLarMeuEmail" class="text-[10px] text-muted-foreground">duda@seiva.app</p>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-primary/10 text-primary">Você</span>
            </div>
            <div class="flex items-center gap-3 p-3 rounded-2xl bg-muted/40">
                <div class="size-9 rounded-full bg-emerald-100 text-emerald-700 font-black text-xs flex items-center justify-center shrink-0">IM</div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Ian Marcos</p>
                    <p class="text-[10px] text-muted-foreground">ian@seiva.app</p>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-muted text-muted-foreground">Parceiro</span>
            </div>
        </div>
        <!-- Divisão padrão -->
        <div class="flex items-center justify-between py-2 border-t border-border">
            <span class="text-xs text-muted-foreground">Divisão padrão do lar</span>
            <span class="text-xs font-black text-foreground">50% / 50%</span>
        </div>
    </div>

    <!-- 3. RECURSOS -->
    <div class="rounded-3xl border border-border bg-card shadow-card overflow-hidden">
        <div class="px-5 py-4 border-b border-border">
            <p class="text-sm font-black text-foreground">Recursos</p>
        </div>
        <div class="divide-y divide-border">
            <button onclick="navegarParaAba('caixa-preta')"
                    class="w-full flex items-center gap-3 px-5 py-3.5 hover:bg-muted/50 transition-colors text-left">
                <div class="size-8 rounded-xl bg-emerald-950 text-emerald-400 flex items-center justify-center shrink-0">
                    <i data-lucide="lock" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Caixa Preta</p>
                    <p class="text-[10px] text-muted-foreground">Área privada individual protegida por senha</p>
                </div>
                <i data-lucide="chevron-right" class="size-4 text-muted-foreground shrink-0"></i>
            </button>
            <button onclick="navegarParaAba('cobrador')"
                    class="w-full flex items-center gap-3 px-5 py-3.5 hover:bg-muted/50 transition-colors text-left">
                <div class="size-8 rounded-xl bg-primary text-primary-foreground flex items-center justify-center shrink-0">
                    <i data-lucide="shield-check" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Cobrador Diplomata</p>
                    <p class="text-[10px] text-muted-foreground">Lembretes automáticos sem conflito</p>
                </div>
                <i data-lucide="chevron-right" class="size-4 text-muted-foreground shrink-0"></i>
            </button>
            <button onclick="navegarParaAba('lar')"
                    class="w-full flex items-center gap-3 px-5 py-3.5 hover:bg-muted/50 transition-colors text-left">
                <div class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                    <i data-lucide="home" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Área do Lar</p>
                    <p class="text-[10px] text-muted-foreground">Gestão compartilhada do casal</p>
                </div>
                <i data-lucide="chevron-right" class="size-4 text-muted-foreground shrink-0"></i>
            </button>
        </div>
    </div>

    <!-- 4. SEGURANÇA & PRIVACIDADE -->
    <div class="rounded-3xl border border-border bg-card shadow-card overflow-hidden">
        <div class="px-5 py-4 border-b border-border">
            <p class="text-sm font-black text-foreground">Segurança & Privacidade</p>
        </div>
        <div class="divide-y divide-border">
            <!-- Bloqueio Caixa Preta -->
            <div class="flex items-center gap-3 px-5 py-3.5">
                <div class="size-8 rounded-xl bg-emerald-950 text-emerald-400 flex items-center justify-center shrink-0">
                    <i data-lucide="lock" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Bloqueio da Caixa Preta</p>
                    <p class="text-[10px] text-muted-foreground">Requer senha para acessar área privada</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer shrink-0">
                    <input type="checkbox" checked class="sr-only peer">
                    <div class="w-11 h-6 bg-muted rounded-full peer-checked:bg-primary transition-all after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:size-5 after:transition-all peer-checked:after:translate-x-5"></div>
                </label>
            </div>
            <!-- Desbloqueio biometria -->
            <div class="flex items-center gap-3 px-5 py-3.5">
                <div class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                    <i data-lucide="fingerprint" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Desbloqueio por biometria</p>
                    <p class="text-[10px] text-muted-foreground">Use impressão digital ou Face ID</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer shrink-0">
                    <input type="checkbox" class="sr-only peer">
                    <div class="w-11 h-6 bg-muted rounded-full peer-checked:bg-primary transition-all after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:size-5 after:transition-all peer-checked:after:translate-x-5"></div>
                </label>
            </div>
            <!-- Visibilidade padrão -->
            <div class="px-5 py-3.5 space-y-2.5">
                <div class="flex items-center gap-3">
                    <div class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                        <i data-lucide="eye" class="size-4"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-black text-foreground">Visibilidade padrão dos lançamentos</p>
                        <p class="text-[10px] text-muted-foreground">Como novos gastos aparecem por padrão</p>
                    </div>
                </div>
                <div class="ml-11 flex gap-1 p-1 rounded-xl bg-muted/50">
                    <button class="flex-1 py-1.5 rounded-lg bg-card text-xs font-bold text-foreground shadow-sm text-center transition-all">Pessoal</button>
                    <button class="flex-1 py-1.5 rounded-lg text-xs font-semibold text-muted-foreground text-center hover:text-foreground transition-all">Compartilhado</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 5. NOTIFICAÇÕES -->
    <div class="rounded-3xl border border-border bg-card shadow-card overflow-hidden">
        <div class="px-5 py-4 border-b border-border">
            <p class="text-sm font-black text-foreground">Notificações</p>
        </div>
        <div class="divide-y divide-border">
            <div class="flex items-center gap-3 px-5 py-3.5">
                <div class="size-8 rounded-xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 flex items-center justify-center shrink-0">
                    <i data-lucide="alarm-clock" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Alertas de vencimento</p>
                    <p class="text-[10px] text-muted-foreground">Avisado antes de contas vencerem</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer shrink-0">
                    <input type="checkbox" checked class="sr-only peer">
                    <div class="w-11 h-6 bg-muted rounded-full peer-checked:bg-primary transition-all after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:size-5 after:transition-all peer-checked:after:translate-x-5"></div>
                </label>
            </div>
            <div class="flex items-center gap-3 px-5 py-3.5">
                <div class="size-8 rounded-xl bg-blue-50 dark:bg-blue-950/40 text-blue-600 flex items-center justify-center shrink-0">
                    <i data-lucide="bar-chart-2" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Resumo semanal</p>
                    <p class="text-[10px] text-muted-foreground">Relatório financeiro toda segunda-feira</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer shrink-0">
                    <input type="checkbox" checked class="sr-only peer">
                    <div class="w-11 h-6 bg-muted rounded-full peer-checked:bg-primary transition-all after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:size-5 after:transition-all peer-checked:after:translate-x-5"></div>
                </label>
            </div>
            <button onclick="navegarParaAba('cobrador')"
                    class="w-full flex items-center gap-3 px-5 py-3.5 hover:bg-muted/50 transition-colors text-left">
                <div class="size-8 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                    <i data-lucide="shield-check" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Configurar Cobrador Diplomata</p>
                    <p class="text-[10px] text-muted-foreground">Personalizar lembretes automáticos</p>
                </div>
                <i data-lucide="chevron-right" class="size-4 text-muted-foreground shrink-0"></i>
            </button>
        </div>
    </div>

    <!-- 6. PREFERÊNCIAS -->
    <div class="rounded-3xl border border-border bg-card shadow-card overflow-hidden">
        <div class="px-5 py-4 border-b border-border">
            <p class="text-sm font-black text-foreground">Preferências</p>
        </div>
        <div class="divide-y divide-border">
            <div class="flex items-center gap-3 px-5 py-3.5">
                <div class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                    <i data-lucide="zap" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Entrada rápida ao abrir o app</p>
                    <p class="text-[10px] text-muted-foreground">Abre direto no lançamento de gasto</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer shrink-0">
                    <input type="checkbox" class="sr-only peer">
                    <div class="w-11 h-6 bg-muted rounded-full peer-checked:bg-primary transition-all after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:size-5 after:transition-all peer-checked:after:translate-x-5"></div>
                </label>
            </div>
            <!-- Tema -->
            <div class="px-5 py-3.5 space-y-2.5">
                <div class="flex items-center gap-3">
                    <div class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                        <i data-lucide="sun-moon" class="size-4"></i>
                    </div>
                    <p class="text-xs font-black text-foreground">Tema do aplicativo</p>
                </div>
                <div class="ml-11 flex gap-1 p-1 rounded-xl bg-muted/50">
                    <button class="flex-1 py-1.5 rounded-lg text-xs font-semibold text-muted-foreground text-center hover:text-foreground transition-all flex items-center justify-center gap-1">
                        <i data-lucide="sun" class="size-3"></i> Claro
                    </button>
                    <button class="flex-1 py-1.5 rounded-lg text-xs font-semibold text-muted-foreground text-center hover:text-foreground transition-all flex items-center justify-center gap-1">
                        <i data-lucide="moon" class="size-3"></i> Escuro
                    </button>
                    <button class="flex-1 py-1.5 rounded-lg bg-card text-xs font-bold text-foreground shadow-sm text-center transition-all flex items-center justify-center gap-1">
                        <i data-lucide="monitor" class="size-3"></i> Sistema
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 7. MEUS DADOS -->
    <div class="rounded-3xl border border-border bg-card shadow-card overflow-hidden">
        <div class="px-5 py-4 border-b border-border">
            <p class="text-sm font-black text-foreground">Meus Dados</p>
        </div>
        <div class="divide-y divide-border">
            <!-- Chave PIX -->
            <div class="flex items-center justify-between px-5 py-3.5 gap-3">
                <div class="flex items-center gap-3 flex-1 min-w-0">
                    <div class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                        <i data-lucide="key" class="size-4"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-black text-foreground">Chave PIX</p>
                        <p id="perfilChavePix" class="text-[10px] text-muted-foreground truncate">duda@seiva.app</p>
                    </div>
                </div>
                <button class="text-[10px] text-primary font-bold hover:underline shrink-0">Editar</button>
            </div>
            <!-- Parceiro no lar -->
            <div class="flex items-center gap-3 px-5 py-3.5">
                <div class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                    <i data-lucide="user-check" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Parceiro no Lar</p>
                    <p class="text-[10px] text-muted-foreground">Ian Marcos · ian@seiva.app</p>
                </div>
            </div>
            <!-- Exportar dados LGPD -->
            <button onclick="executarExportarDados()"
                    class="w-full flex items-center gap-3 px-5 py-3.5 hover:bg-muted/50 transition-colors text-left">
                <div class="size-8 rounded-xl bg-blue-50 dark:bg-blue-950/40 text-blue-600 flex items-center justify-center shrink-0">
                    <i data-lucide="download" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Exportar meus dados</p>
                    <p class="text-[10px] text-muted-foreground">Baixar relatório CSV (direito LGPD Art. 18)</p>
                </div>
                <i data-lucide="chevron-right" class="size-4 text-muted-foreground shrink-0"></i>
            </button>
        </div>
    </div>

    <!-- 8. SOBRE & SUPORTE -->
    <div class="rounded-3xl border border-border bg-card shadow-card overflow-hidden">
        <div class="px-5 py-4 border-b border-border">
            <p class="text-sm font-black text-foreground">Sobre & Suporte</p>
        </div>
        <div class="divide-y divide-border">
            <button class="w-full flex items-center gap-3 px-5 py-3.5 hover:bg-muted/50 transition-colors text-left">
                <div class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                    <i data-lucide="life-buoy" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Central de ajuda</p>
                </div>
                <i data-lucide="chevron-right" class="size-4 text-muted-foreground shrink-0"></i>
            </button>
            <button class="w-full flex items-center gap-3 px-5 py-3.5 hover:bg-muted/50 transition-colors text-left">
                <div class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                    <i data-lucide="file-text" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Termos de Uso e Privacidade</p>
                </div>
                <i data-lucide="chevron-right" class="size-4 text-muted-foreground shrink-0"></i>
            </button>
            <div class="flex items-center gap-3 px-5 py-3.5">
                <div class="size-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 flex items-center justify-center shrink-0">
                    <i data-lucide="leaf" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Sobre o SEIVA</p>
                    <p class="text-[10px] text-muted-foreground">Versão 1.0 · Onde seu dinheiro cria raízes</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 9. BOTÃO SAIR DA CONTA -->
    <button onclick="executarLogout()"
            class="w-full py-4 rounded-2xl border border-rose-200 dark:border-rose-900 bg-rose-50 dark:bg-rose-950/20 text-rose-600 font-black text-sm flex items-center justify-center gap-2 hover:bg-rose-100 dark:hover:bg-rose-950/40 transition-colors">
        <i data-lucide="log-out" class="size-5"></i>
        Sair da conta
    </button>

</div>
