{{-- 
    Módulo: Cobrador Diplomata (RF005)
    Responsável Acadêmico: Victor Hugo
    Funcionalidade: Lembretes diplomáticos automáticos de cobranças entre membros do lar,
    com configuração de antecedência e canal de notificação.
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="pane-cobrador" class="sub-screen space-y-6 hidden max-w-5xl mx-auto pb-12">

    <!-- ESTADO VAZIO / SEM LAR (PARA USUÁRIOS INDIVIDUAIS) -->
    <div id="cobradorCardBloqueioSemLar" class="hidden p-8 sm:p-12 rounded-3xl border border-border bg-card shadow-card text-center space-y-5 max-w-xl mx-auto my-8">
        <div class="size-20 rounded-3xl bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 mx-auto flex items-center justify-center shadow-soft">
            <i data-lucide="bell-ring" class="size-10"></i>
        </div>
        <div class="space-y-1.5">
            <h2 class="text-xl font-black text-foreground">Cobrador Diplomata Requer um Lar</h2>
            <p class="text-xs text-muted-foreground leading-relaxed">
                O <strong>Cobrador Diplomata</strong> evita constrangimentos financeiros enviando lembretes suaves e automáticos de rateio entre parceiros do Lar. Para ativar a diplomacia financeira, convide seu parceiro(a)!
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

    <!-- CONTEÚDO OFICIAL DO COBRADOR DIPLOMATA -->
    <div id="cobradorConteudoCasal" class="space-y-6">
    <!-- HERO CARD VERDE ESCURO -->
    <div class="rounded-3xl bg-emerald-900 p-6 text-white shadow-card space-y-4">
        <div class="flex items-start justify-between">
            <div class="space-y-1.5">
                <div class="flex items-center gap-2">
                    <i data-lucide="shield-check" class="size-5 text-emerald-300"></i>
                    <span class="text-sm font-black tracking-tight">Cobrador Diplomata</span>
                </div>
                <p class="text-[11px] text-emerald-300/80 max-w-xs leading-relaxed">
                    Lembra o parceiro das pendências sem criar conflito. Diplomacia financeira automática para o casal.
                </p>
            </div>
            <div class="size-10 rounded-2xl bg-emerald-800/60 flex items-center justify-center shrink-0">
                <i data-lucide="bell" class="size-5 text-emerald-300"></i>
            </div>
        </div>

        <!-- Cards de resumo (3 colunas) -->
        <div class="grid grid-cols-3 gap-2.5">
            <div class="rounded-2xl bg-emerald-800/50 p-3 text-center">
                <p class="text-[10px] text-emerald-300 font-semibold mb-1">A receber</p>
                <p id="cobradorStatReceber" class="text-base font-black text-white">R$ 629,00</p>
            </div>
            <div class="rounded-2xl bg-emerald-800/50 p-3 text-center">
                <p class="text-[10px] text-emerald-300 font-semibold mb-1">Notificadas</p>
                <p id="cobradorStatNotificadas" class="text-base font-black text-white">1</p>
            </div>
            <div class="rounded-2xl bg-emerald-800/50 p-3 text-center">
                <p class="text-[10px] text-emerald-300 font-semibold mb-1">Agendadas</p>
                <p id="cobradorStatAgendadas" class="text-base font-black text-white">1</p>
            </div>
        </div>
    </div>

    <!-- LISTA DE NOTIFICAÇÕES -->
    <div class="space-y-3">
        <div class="flex items-center justify-between">
            <h3 class="text-sm font-black text-foreground">Pendências do lar</h3>
            <span class="text-[10px] text-muted-foreground font-semibold">Este mês</span>
        </div>
        <div id="cobradorListaNotificacoes" class="space-y-3">
            <!-- Renderizado via carregarCobradorDados() -->
            <div class="py-8 text-center">
                <div class="inline-flex items-center gap-2 text-xs text-muted-foreground">
                    <i data-lucide="loader-circle" class="size-4 animate-spin"></i>
                    Carregando pendências...
                </div>
            </div>
        </div>
    </div>

    <!-- CONFIGURAÇÕES DO COBRADOR -->
    <div class="rounded-3xl border border-border bg-card shadow-card p-5 space-y-5">
        <div class="flex items-center gap-2.5">
            <div class="size-9 rounded-xl bg-muted flex items-center justify-center">
                <i data-lucide="settings-2" class="size-4 text-muted-foreground"></i>
            </div>
            <div>
                <p class="text-xs font-black text-foreground">Configurações do Cobrador</p>
                <p class="text-[10px] text-muted-foreground">Como e quando o Ian vai ser lembrado</p>
            </div>
        </div>

        <!-- Antecedência -->
        <div class="space-y-2">
            <label class="text-xs font-bold text-foreground">Avisar com quantos dias de antecedência?</label>
            <div class="flex gap-2 flex-wrap">
                <button type="button" data-antecedencia="1" onclick="selecionarAntecedencia(this, 1)"
                        class="px-3 py-2 rounded-xl border border-border text-xs font-semibold text-muted-foreground transition-all hover:border-primary/40">
                    1 dia
                </button>
                <button type="button" data-antecedencia="2" onclick="selecionarAntecedencia(this, 2)"
                        class="px-3 py-2 rounded-xl border border-border text-xs font-black transition-all ring-2 ring-primary bg-primary/10 text-primary">
                    2 dias
                </button>
                <button type="button" data-antecedencia="3" onclick="selecionarAntecedencia(this, 3)"
                        class="px-3 py-2 rounded-xl border border-border text-xs font-semibold text-muted-foreground transition-all hover:border-primary/40">
                    3 dias
                </button>
                <button type="button" data-antecedencia="5" onclick="selecionarAntecedencia(this, 5)"
                        class="px-3 py-2 rounded-xl border border-border text-xs font-semibold text-muted-foreground transition-all hover:border-primary/40">
                    5 dias
                </button>
                <button type="button" data-antecedencia="7" onclick="selecionarAntecedencia(this, 7)"
                        class="px-3 py-2 rounded-xl border border-border text-xs font-semibold text-muted-foreground transition-all hover:border-primary/40">
                    7 dias
                </button>
            </div>
        </div>

        <!-- Canal de notificação -->
        <div class="space-y-2">
            <label class="text-xs font-bold text-foreground">Canal de lembrete preferido</label>
            <div class="flex gap-2">
                <button type="button" data-canal="push" onclick="selecionarCanalCobrador(this, 'push')"
                        class="flex-1 py-2.5 rounded-xl border border-border text-xs font-black transition-all ring-2 ring-primary bg-primary/10 text-primary flex items-center justify-center gap-1.5">
                    <i data-lucide="bell" class="size-3.5"></i> Notificação
                </button>
                <button type="button" data-canal="whatsapp" onclick="selecionarCanalCobrador(this, 'whatsapp')"
                        class="flex-1 py-2.5 rounded-xl border border-border text-xs font-semibold text-muted-foreground transition-all hover:border-primary/40 flex items-center justify-center gap-1.5">
                    <i data-lucide="message-circle" class="size-3.5"></i> WhatsApp
                </button>
                <button type="button" data-canal="email" onclick="selecionarCanalCobrador(this, 'email')"
                        class="flex-1 py-2.5 rounded-xl border border-border text-xs font-semibold text-muted-foreground transition-all hover:border-primary/40 flex items-center justify-center gap-1.5">
                    <i data-lucide="mail" class="size-3.5"></i> E-mail
                </button>
            </div>
        </div>

        <!-- Salvar -->
        <button onclick="salvarConfiguracaoCobrador()"
                class="w-full h-11 rounded-xl bg-primary text-primary-foreground text-sm font-black flex items-center justify-center gap-2 hover:bg-primary/90 transition-colors">
            <i data-lucide="save" class="size-4"></i> Salvar configurações
        </button>
    </div>
    </div>

</div>
