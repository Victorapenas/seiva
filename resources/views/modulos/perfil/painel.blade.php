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
            <!-- Avatar circular com imagem ou iniciais -->
            <div id="perfilAvatarCircle"
                 class="size-20 rounded-full bg-primary-foreground/20 text-primary-foreground font-black text-xl flex items-center justify-center ring-4 ring-primary-foreground/20 shrink-0 select-none overflow-hidden">
                <img id="perfilAvatarImg" src="" alt="Foto de perfil" class="hidden size-full object-cover">
                <span id="perfilAvatarIniciais">--</span>
            </div>
            <div class="flex-1 min-w-0 space-y-1">
                <p id="perfilNomeTxt" class="text-lg font-black text-primary-foreground truncate">Carregando...</p>
                <p id="perfilEmailTxt" class="text-sm text-primary-foreground/70 truncate">...</p>
                <p id="perfilApelido" class="text-xs text-primary-foreground/60 italic hidden"></p>
                <p id="perfilMembroDesde" class="text-[11px] text-primary-foreground/50">Membro SEIVA</p>
            </div>
        </div>
        <div class="mt-5 flex gap-2">
            <button onclick="abrirModalEditarPerfil()"
                    class="flex-1 h-10 rounded-xl bg-primary-foreground/15 hover:bg-primary-foreground/25 text-primary-foreground text-xs font-bold flex items-center justify-center gap-1.5 transition-colors cursor-pointer">
                <i data-lucide="pencil" class="size-4"></i> Editar perfil
            </button>
        </div>
    </div>

    <!-- 2A. NOSSO CANTINHO (EXIBIDO APENAS SE FOR CASAL) -->
    <div id="perfilCardNossoCantinho" class="rounded-3xl border border-border bg-card shadow-card p-5 space-y-4 hidden">
        <div class="flex items-center gap-2.5">
            <div class="size-9 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 flex items-center justify-center">
                <i data-lucide="home" class="size-4"></i>
            </div>
            <div>
                <p id="perfilLarNome" class="text-sm font-black text-foreground">Lar Compartilhado</p>
                <p id="perfilLarDesde" class="text-[10px] text-muted-foreground">Recente</p>
            </div>
        </div>
        <!-- Membros do lar -->
        <div class="space-y-2">
            <div class="flex items-center gap-3 p-3 rounded-2xl bg-muted/40">
                <div id="perfilLarMeuIniciaisCircle" class="size-9 rounded-full bg-emerald-100 text-emerald-800 font-black text-xs flex items-center justify-center shrink-0">--</div>
                <div class="flex-1 min-w-0">
                    <p id="perfilLarMeuNome" class="text-xs font-black text-foreground">Você</p>
                    <p id="perfilLarMeuEmail" class="text-[10px] text-muted-foreground">...</p>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-primary/10 text-primary">Você</span>
            </div>
            <div id="perfilLarLinhaParceiro" class="flex items-center gap-3 p-3 rounded-2xl bg-muted/40">
                <div id="perfilLarParceiroIniciaisCircle" class="size-9 rounded-full bg-emerald-100 text-emerald-800 font-black text-xs flex items-center justify-center shrink-0">--</div>
                <div class="flex-1 min-w-0">
                    <p id="perfilLarParceiroNome" class="text-xs font-black text-foreground">Parceiro(a)</p>
                    <p id="perfilLarParceiroEmail" class="text-[10px] text-muted-foreground">...</p>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-muted text-muted-foreground">Parceiro</span>
            </div>
        </div>
        <!-- Divisão padrão -->
        <div class="flex items-center justify-between py-2 border-t border-border">
            <div>
                <span class="text-xs text-muted-foreground block">Divisão padrão do lar</span>
                <span id="perfilDivisaoValorTxt" class="text-xs font-black text-foreground">50% / 50% (Igualitária)</span>
            </div>
            <button type="button" onclick="abrirModalDivisaoPersonalizada()" class="px-3.5 py-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white text-xs font-black shadow-xs transition flex items-center gap-1.5 cursor-pointer">
                <i data-lucide="sliders" class="size-3.5"></i>
                <span>Ajustar divisão</span>
            </button>
        </div>
    </div>

    <!-- 2B. GESTÃO INDIVIDUAL / SOLTEIRO (SE USUÁRIO NÃO FOR CASAL) -->
    <div id="perfilCardIndividualSolo" class="hidden rounded-3xl border border-border bg-card shadow-card p-5 space-y-4">
        <div class="flex items-center gap-2.5">
            <div class="size-9 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 flex items-center justify-center">
                <i data-lucide="user" class="size-4"></i>
            </div>
            <div>
                <p class="text-sm font-black text-foreground">Gestão Financeira Individual</p>
                <p class="text-[10px] text-muted-foreground">Conta Pessoal & Autonomia Total</p>
            </div>
        </div>
        <p class="text-xs text-muted-foreground leading-relaxed">
            Sua conta está configurada como <strong>Individual</strong>. Todas as suas receitas, despesas fixas, transações e metas pertencem exclusivamente a você, com privacidade absoluta e sem rateio com terceiros.
        </p>
        <div class="p-3 rounded-2xl bg-muted/40 flex items-center justify-between text-xs">
            <span class="text-muted-foreground font-semibold">Modalidade de Acesso</span>
            <span class="font-black text-emerald-700 dark:text-emerald-400">100% Autônomo / Solo</span>
        </div>

        <!-- Ação: Convidar Parceiro para o Lar -->
        <div class="pt-2 border-t border-border flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <span class="text-xs font-bold text-foreground block">Deseja formar um Lar com seu parceiro(a)?</span>
                <span class="text-[11px] text-muted-foreground">Convide sua namorada ou parceiro(a) para organizar despesas do lar mantendo sua Caixa Preta 100% privada.</span>
            </div>
            <button type="button" onclick="abrirModalConvidarParceiro()" 
                    class="px-4 py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-black text-xs transition shadow-soft flex items-center justify-center gap-2 shrink-0">
                <i data-lucide="heart-handshake" class="size-4"></i>
                <span>Convidar Parceiro(a)</span>
            </button>
        </div>
    </div>

    <!-- 3. RECURSOS -->
    <div class="rounded-3xl border border-border bg-card shadow-card overflow-hidden">
        <div class="px-5 py-4 border-b border-border">
            <p class="text-sm font-black text-foreground">Recursos</p>
        </div>
        <div class="divide-y divide-border">
            <button onclick="trocarAbaApp('caixa-preta')"
                    class="w-full flex items-center gap-3 px-5 py-3.5 hover:bg-muted/50 transition-colors text-left cursor-pointer">
                <div class="size-8 rounded-xl bg-emerald-950 text-emerald-400 flex items-center justify-center shrink-0">
                    <i data-lucide="lock" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Caixa Preta</p>
                    <p class="text-[10px] text-muted-foreground">Área privada individual protegida por senha</p>
                </div>
                <i data-lucide="chevron-right" class="size-4 text-muted-foreground shrink-0"></i>
            </button>
            <button id="recursoItemCobrador" onclick="trocarAbaApp('cobrador')"
                    class="w-full flex items-center gap-3 px-5 py-3.5 hover:bg-muted/50 transition-colors text-left cursor-pointer">
                <div class="size-8 rounded-xl bg-primary text-primary-foreground flex items-center justify-center shrink-0">
                    <i data-lucide="shield-check" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Cobrador Diplomata</p>
                    <p class="text-[10px] text-muted-foreground">Lembretes automáticos sem conflito</p>
                </div>
                <span id="badgeSoloCobrador" class="hidden px-2 py-0.5 rounded-full text-[9px] font-bold bg-muted text-muted-foreground">Casal</span>
                <i data-lucide="chevron-right" class="size-4 text-muted-foreground shrink-0"></i>
            </button>
            <button id="recursoItemLar" onclick="trocarAbaApp('lar')"
                    class="w-full flex items-center gap-3 px-5 py-3.5 hover:bg-muted/50 transition-colors text-left cursor-pointer">
                <div class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                    <i data-lucide="home" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Área do Lar</p>
                    <p class="text-[10px] text-muted-foreground">Gestão compartilhada do casal</p>
                </div>
                <span id="badgeSoloLar" class="hidden px-2 py-0.5 rounded-full text-[9px] font-bold bg-muted text-muted-foreground">Casal</span>
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
                    <p class="text-[10px] text-muted-foreground">Exigir PIN numérico para acessar área privada</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer shrink-0">
                    <input type="checkbox" id="toggleBloqueioCaixaPreta" checked onchange="alternarBloqueioCaixaPreta(this)" class="sr-only peer">
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
                    <p class="text-[10px] text-muted-foreground">Impressão digital ou Face ID (Em desenvolvimento mobile v2.0)</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer shrink-0">
                    <input type="checkbox" id="toggleBiometriaPerfil" onchange="alternarBiometriaPerfil(this)" class="sr-only peer">
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
                        <p class="text-[10px] text-muted-foreground">Define se novos gastos começam privados ou visíveis no lar</p>
                    </div>
                </div>
                <div class="ml-11 flex gap-1 p-1 rounded-xl bg-muted/50">
                    <button type="button" id="btnVisibPessoal" onclick="alternarVisibilidadePadrao('pessoal')" class="flex-1 py-1.5 rounded-lg bg-card text-xs font-bold text-foreground shadow-sm text-center transition-all cursor-pointer">Pessoal (Privado)</button>
                    <button type="button" id="btnVisibCompartilhado" onclick="alternarVisibilidadePadrao('compartilhado')" class="flex-1 py-1.5 rounded-lg text-xs font-semibold text-muted-foreground text-center hover:text-foreground transition-all cursor-pointer">Compartilhado (Lar)</button>
                </div>
                <div class="ml-11 p-2.5 rounded-xl bg-muted/40 border border-border/60 text-[11px] text-muted-foreground leading-relaxed">
                    <strong class="text-foreground">Como funciona:</strong> Ao lançar uma despesa, se estiver como <em>Pessoal</em> ela fica guardada em sigilo na sua Caixa Preta. Se estiver como <em>Compartilhado</em>, entra automaticamente na prestação de contas do Lar.
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
                    <input type="checkbox" checked onchange="alternarNotificacaoPerfil('vencimento', this.checked)" class="sr-only peer">
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
                    <input type="checkbox" checked onchange="alternarNotificacaoPerfil('resumo', this.checked)" class="sr-only peer">
                    <div class="w-11 h-6 bg-muted rounded-full peer-checked:bg-primary transition-all after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:size-5 after:transition-all peer-checked:after:translate-x-5"></div>
                </label>
            </div>
            <button onclick="navegarParaAba('cobrador')"
                    class="w-full flex items-center gap-3 px-5 py-3.5 hover:bg-muted/50 transition-colors text-left cursor-pointer">
                <div class="size-8 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                    <i data-lucide="shield-check" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Configurar Cobrador Diplomata</p>
                    <p class="text-[10px] text-muted-foreground">Personalizar lembretes automáticos e antecedência</p>
                </div>
                <i data-lucide="chevron-right" class="size-4 text-muted-foreground shrink-0"></i>
            </button>
        </div>
    </div>

    <!-- 6. PREFERÊNCIAS -->
    <div class="rounded-3xl border border-border bg-card shadow-card overflow-hidden">
        <div class="px-5 py-4 border-b border-border">
            <p class="text-sm font-black text-foreground">Preferências do Sistema</p>
        </div>
        <div class="divide-y divide-border">
            <div class="flex items-center gap-3 px-5 py-3.5">
                <div class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                    <i data-lucide="zap" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Entrada rápida ao carregar o site</p>
                    <p class="text-[10px] text-muted-foreground">Focar direto no formulário de novo lançamento</p>
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
                    <div>
                        <p class="text-xs font-black text-foreground">Tema visual da plataforma</p>
                        <p class="text-[10px] text-muted-foreground">Alternar entre modo claro, escuro ou do navegador</p>
                    </div>
                </div>
                <div class="ml-11 flex gap-1 p-1 rounded-xl bg-muted/50">
                    <button type="button" id="btnTemaClaro" onclick="alternarTemaSeiva('claro')"
                            class="flex-1 py-1.5 rounded-lg text-xs font-semibold text-muted-foreground text-center hover:text-foreground transition-all flex items-center justify-center gap-1 cursor-pointer">
                        <i data-lucide="sun" class="size-3"></i> Claro
                    </button>
                    <button type="button" id="btnTemaEscuro" onclick="alternarTemaSeiva('escuro')"
                            class="flex-1 py-1.5 rounded-lg text-xs font-semibold text-muted-foreground text-center hover:text-foreground transition-all flex items-center justify-center gap-1 cursor-pointer">
                        <i data-lucide="moon" class="size-3"></i> Escuro
                    </button>
                    <button type="button" id="btnTemaSistema" onclick="alternarTemaSeiva('sistema')"
                            class="flex-1 py-1.5 rounded-lg bg-card text-xs font-bold text-foreground shadow-sm text-center transition-all flex items-center justify-center gap-1 cursor-pointer">
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
                <button type="button" onclick="abrirModalEditarPerfil()" class="text-[10px] text-primary font-bold hover:underline shrink-0 cursor-pointer">Editar</button>
            </div>
            <!-- Parceiro no lar -->
            <div id="perfilLinhaParceiro" class="flex items-center gap-3 px-5 py-3.5">
                <div class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                    <i data-lucide="user-check" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Parceiro no Lar</p>
                    <p id="perfilParceiroInfo" class="text-[10px] text-muted-foreground">Carregando parceiro...</p>
                </div>
            </div>
            <!-- Exportar dados LGPD -->
            <button onclick="executarExportarDados()"
                    class="w-full flex items-center gap-3 px-5 py-3.5 hover:bg-muted/50 transition-colors text-left cursor-pointer">
                <div class="size-8 rounded-xl bg-blue-50 dark:bg-blue-950/40 text-blue-600 flex items-center justify-center shrink-0">
                    <i data-lucide="download" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Exportar meus dados</p>
                    <p class="text-[10px] text-muted-foreground">Baixar relatório CSV completo (LGPD Art. 18)</p>
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
            <button type="button" onclick="abrirModalCentralAjuda()" class="w-full flex items-center gap-3 px-5 py-3.5 hover:bg-muted/50 transition-colors text-left cursor-pointer">
                <div class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                    <i data-lucide="life-buoy" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Central de ajuda & FAQ</p>
                    <p class="text-[10px] text-muted-foreground">Dúvidas frequentes e suporte do SEIVA</p>
                </div>
                <i data-lucide="chevron-right" class="size-4 text-muted-foreground shrink-0"></i>
            </button>
            <button type="button" onclick="abrirModalTermosUso()" class="w-full flex items-center gap-3 px-5 py-3.5 hover:bg-muted/50 transition-colors text-left cursor-pointer">
                <div class="size-8 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0">
                    <i data-lucide="file-text" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Termos de Uso e Política de Privacidade</p>
                    <p class="text-[10px] text-muted-foreground">Direitos e garantias legais LGPD</p>
                </div>
                <i data-lucide="chevron-right" class="size-4 text-muted-foreground shrink-0"></i>
            </button>
            <div class="flex items-center gap-3 px-5 py-3.5">
                <div class="size-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 flex items-center justify-center shrink-0">
                    <i data-lucide="leaf" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-foreground">Sobre o SEIVA</p>
                    <p class="text-[10px] text-muted-foreground">SEIVA v2.0 · Segundo Semestre de 2026 · Onde seu dinheiro cria raízes</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 9. AÇÕES DE CONTA (LOGOUT & EXCLUSÃO DEFINITIVA LGPD) -->
    <div class="space-y-2 pt-2">
        <button onclick="executarLogout()"
                class="w-full py-3.5 rounded-2xl border border-border bg-card hover:bg-muted text-foreground font-black text-sm flex items-center justify-center gap-2 transition-colors cursor-pointer">
            <i data-lucide="log-out" class="size-4 text-muted-foreground"></i>
            <span>Sair da conta</span>
        </button>

        <button type="button" onclick="abrirModalApagarConta()"
                class="w-full py-3.5 rounded-2xl border border-rose-300 dark:border-rose-900/60 bg-rose-50/50 dark:bg-rose-950/20 text-rose-600 hover:bg-rose-100 dark:hover:bg-rose-950/40 font-bold text-xs flex items-center justify-center gap-2 transition-colors cursor-pointer">
            <i data-lucide="trash-2" class="size-4"></i>
            <span>Excluir minha conta (LGPD Art. 18)</span>
        </button>
    </div>

</div>
