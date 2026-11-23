<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SEIVA — Onde seu dinheiro cria raízes | Finanças do Casal & Lares Compartilhados</title>
    
    <!-- Meta Tags Acadêmicas e de Produto -->
    <meta name="description" content="Gestão Financeira Inteligente para Lares Compartilhados e Finanças Pessoais. Entrega 2 do Projeto Interdisciplinar de ADS - IFBA.">
    <meta name="author" content="Victor Hugo, Quételi, Jhon Abner, Ian Marcos, Maria Eduarda Lima">
    <meta name="theme-color" content="#2e6b4f">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Identity Services (GIS) Oficial -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <!-- Tailwind CSS (CDN Play) & Lucide Icons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tipografia Inter Oficial -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Configuração de Identidade Visual Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#faf9f5',
                        foreground: '#1c2826',
                        card: '#ffffff',
                        'card-foreground': '#1c2826',
                        primary: '#2e6b4f',
                        'primary-foreground': '#ffffff',
                        secondary: '#e8efe9',
                        'secondary-foreground': '#2e6b4f',
                        muted: '#f0ede6',
                        'muted-foreground': '#6b7280',
                        accent: '#d4e5d9',
                        'accent-foreground': '#1b3d2b',
                        destructive: '#c84b31',
                        'destructive-foreground': '#ffffff',
                        border: '#e5e0d8',
                        sidebar: '#ffffff',
                        success: '#2e6b4f',
                    },
                    borderRadius: {
                        '3xl': '1.5rem',
                        '2xl': '1rem',
                        'xl': '0.75rem',
                    },
                    boxShadow: {
                        'soft': '0 2px 10px rgba(30, 48, 38, 0.04)',
                        'card': '0 1px 3px rgba(30, 48, 38, 0.05), 0 8px 24px -8px rgba(30, 48, 38, 0.08)',
                        'elevated': '0 8px 40px -8px rgba(30, 48, 38, 0.16)',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background-color: #faf9f5;
            color: #1c2826;
            margin: 0;
            padding: 0;
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        /* Regras absolutas de visibilidade para evitar qualquer sobreposição */
        .app-screen {
            display: none !important;
            width: 100%;
            min-height: 100vh;
        }
        .app-screen.is-active {
            display: flex !important;
        }
        #screen-app.is-active {
            display: block !important;
        }
        /* Animações Flutuantes Suaves Estilo Fintech */
        @keyframes floatSlow {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-8px);
            }
        }
        @keyframes floatGentle {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-5px) rotate(0.5deg);
            }
        }
        @keyframes pulseRings {
            0%, 100% {
                transform: scale(1);
                opacity: 0.12;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.25;
            }
        }
        .animate-float-slow {
            animation: floatSlow 5s ease-in-out infinite;
        }
        .animate-float-gentle {
            animation: floatGentle 4s ease-in-out infinite;
        }
        .animate-pulse-rings {
            animation: pulseRings 8s ease-in-out infinite;
        }
        .floating-input:focus ~ .floating-label,
        .floating-input:not(:placeholder-shown) ~ .floating-label {
            top: 0.5rem;
            font-size: 0.7rem;
            color: #2e6b4f;
        }
    </style>
</head>
<body class="min-h-screen bg-background text-foreground antialiased selection:bg-primary selection:text-white">

    <!-- ============================================================== -->
    <!-- 1. TELA DE LOGIN & APRESENTAÇÃO VISUAL DA MARCA (RF001)        -->
    <!-- Responsável Acadêmica: Quételi                                 -->
    <!-- ============================================================== -->
    @include('auth.login')

    <!-- ============================================================== -->
    <!-- 2. TELA DE ONBOARDING & CADASTRO EM ETAPAS (RF001)             -->
    <!-- Responsável Acadêmica: Quételi                                 -->
    <!-- ============================================================== -->
    @include('auth.onboarding')

    <!-- ============================================================== -->
    <!-- 3. APLICAÇÃO PRINCIPAL (APP SHELL COM ARQUITETURA MODULAR)      -->
    <!-- Responsáveis: Victor Hugo, Jhon Abner, Ian Marcos, Duda        -->
    <!-- ============================================================== -->
    <div id="screen-app" class="app-screen min-h-screen bg-background">
        <!-- Sidebar Desktop -->
        @include('componentes.sidebar')

        <!-- Área de Conteúdo da Aplicação -->
        <div class="lg:pl-64 flex flex-col min-h-screen">
            <!-- Barra Superior com Notificações -->
            @include('componentes.topbar')

            <!-- Container Principal dos Módulos Funcionais -->
            <main class="mx-auto w-full max-w-2xl px-4 pb-28 pt-6 lg:max-w-5xl lg:px-10 lg:pb-12 lg:pt-8 flex-1">
                <!-- Módulo 1: Dashboard Financeiro (Victor Hugo - RF009) -->
                @include('modulos.dashboard.painel')

                <!-- Módulo 2: Caixa Preta com Criptografia e PIN (Victor Hugo - RF002) -->
                @include('modulos.caixa-preta.painel')

                <!-- Módulo 3: Extrato e Transações Pessoais (Victor / Jhon - RF003) -->
                @include('modulos.transacoes.painel')

                <!-- Módulo 4: Gestão do Lar e Rateio Proporcional (Jhon Abner - RF004, RF010) -->
                @include('modulos.lar.painel')

                <!-- Módulo 5: Mesa de Acordos e Consenso do Casal (Ian Marcos - RF006) -->
                @include('modulos.acordos.painel')

                <!-- Módulo 6: Metas do Lar e Projetos Conjuntos (Ian Marcos - RF007, RF008) -->
                @include('modulos.metas.painel')

                <!-- Módulo 6b: Relatórios e Recebimentos (Victor Hugo - RF003/RF009) -->
                @include('modulos.recebimentos.painel')

                <!-- Módulo 7: Cobrador Diplomata sem Constrangimentos (Victor Hugo - RF005) -->
                @include('modulos.cobrador.painel')

                <!-- Módulo 8: Perfil e Conformidade com a LGPD (Maria Eduarda - RF011) -->
                @include('modulos.perfil.painel')
            </main>
        </div>

        <!-- Botão de Ação Rápida Flutuante (FAB) -->
        @include('componentes.fab')

        <!-- Barra de Navegação Inferior Mobile (Bottom Nav) -->
        @include('componentes.bottom-nav')
    </div>

    <!-- ============================================================== -->
    <!-- MODAIS DO SISTEMA                                              -->
    <!-- ============================================================== -->
    @include('componentes.modais.modal-google')
    @include('componentes.modais.modal-transacao')
    @include('componentes.modais.modal-despesa-lar')
    @include('componentes.modais.modal-boas-vindas')
    @include('componentes.modais.modal-atualizar-saldo')
    @include('componentes.modais.modal-saude-financeira')
    @include('componentes.modais.modal-registrar-pagamento')
    @include('componentes.modais.modal-lancar-gasto')
    @include('componentes.modais.modal-registrar-recebimento')
    @include('componentes.modais.modal-adicionar-conta-cartao')
    @include('componentes.modais.modal-pedir-ajuda-custo')
    @include('componentes.modais.modal-responder-pedido-ajuda')
    @include('componentes.modais.modal-criar-meta')
    @include('componentes.modais.modal-guardar-meta')
    @include('componentes.modais.modal-guardar-fundo-emergencia-lar')
    @include('componentes.modais.modal-registrar-pagamento-lar')
    @include('componentes.modais.modal-guardar-meta-lar-pix')
    @include('componentes.modais.modal-atualizar-meta-lar')
    @include('componentes.modais.modal-desfazer-meta-lar')
    @include('componentes.modais.modal-novo-acordo-passos')
    @include('componentes.modais.modal-notificacoes-popup')
    @include('componentes.modais.modal-editar-meta')
    @include('componentes.modais.modal-personalizar-icone-transacao')
    @include('componentes.modais.modal-disputar-recebimento')
    @include('componentes.modais.modal-adicionar-produto-olho')
    @include('componentes.modais.modal-confirmacao-seiva')
    @include('componentes.modais.modal-saude-financeira-lar')
    @include('componentes.modais.modal-solicitar-resgate-emergencia-lar')
    @include('componentes.modais.modal-contestar-envio-lar')
    @include('componentes.modais.modal-editar-lar')
    @include('componentes.modais.modal-editar-despesa-lar')
    @include('componentes.modais.modal-editar-transacao')
    @include('componentes.modais.modal-editar-conta')
    @include('componentes.modais.modal-historico-auditoria')
    @include('componentes.modais.modal-despesa-individual')
    @include('componentes.modais.modal-quitar-despesa-individual')
    @include('componentes.modais.modal-editar-perfil')
    @include('componentes.modais.modal-divisao-personalizada')
    @include('componentes.modais.modal-termos-uso')
    @include('componentes.modais.modal-central-ajuda')
    @include('componentes.modais.modal-apagar-conta')
    @include('componentes.modais.modal-convidar-parceiro')
    @include('componentes.modais.modal-aceitar-convite-lar')

    <!-- ============================================================== -->
    <!-- CONTAINER GLOBAL DE NOTIFICAÇÕES TOAST (FINTECH PREMIUM)       -->
    <!-- ============================================================== -->
    <div id="seivaToastContainer" class="fixed top-5 right-5 z-[99999] flex flex-col gap-2.5 pointer-events-none max-w-sm w-[calc(100%-2.5rem)] sm:w-full"></div>

    <!-- ============================================================== -->
    <!-- SCRIPT MASTER DE ORQUESTRAÇÃO & COMUNICAÇÃO COM O BACKEND       -->
    <!-- ============================================================== -->
    <script>
        // ==========================================
        // HELPERS GLOBAIS DE MODAIS & INTERFACES (FINTECH)
        // ==========================================
        window.abrirModalId = function(id) {
            const el = document.getElementById(id);
            if (el) {
                el.classList.remove('hidden');
                if (window.lucide) lucide.createIcons();
            }
        };

        window.fecharModalId = function(id) {
            const el = document.getElementById(id);
            if (el) el.classList.add('hidden');
        };

        // ==========================================
        // SISTEMA GLOBAL DE NOTIFICAÇÕES TOAST (FINTECH)
        // Substitui alertas nativos feios estilo spam por cards elegantes
        // ==========================================
        function seivaNotificar(mensagem, tipo = 'info', titulo = null) {
            let container = document.getElementById('seivaToastContainer');
            if (!container) {
                container = document.createElement('div');
                container.id = 'seivaToastContainer';
                container.className = 'fixed top-5 right-5 z-[99999] flex flex-col gap-2.5 pointer-events-none max-w-sm w-[calc(100%-2.5rem)] sm:w-full';
                document.body.appendChild(container);
            }

            const tipoFmt = String(tipo || 'info').toLowerCase();
            let borderClass = 'border-l-primary';
            let iconBgClass = 'bg-primary/10 text-primary';
            let iconName = 'info';
            let defaultTitle = 'Notificação';

            if (tipoFmt === 'erro' || tipoFmt === 'error' || tipoFmt === 'danger') {
                borderClass = 'border-l-rose-500';
                iconBgClass = 'bg-rose-500/10 text-rose-500';
                iconName = 'alert-circle';
                defaultTitle = 'Atenção';
            } else if (tipoFmt === 'sucesso' || tipoFmt === 'success') {
                borderClass = 'border-l-emerald-500';
                iconBgClass = 'bg-emerald-500/10 text-emerald-500';
                iconName = 'check-circle-2';
                defaultTitle = 'Tudo certo!';
            } else if (tipoFmt === 'aviso' || tipoFmt === 'warning') {
                borderClass = 'border-l-amber-500';
                iconBgClass = 'bg-amber-500/10 text-amber-500';
                iconName = 'alert-triangle';
                defaultTitle = 'Aviso';
            }

            const titleText = titulo || defaultTitle;
            const toastId = 'toast_' + Math.random().toString(36).slice(2, 9);

            const toast = document.createElement('div');
            toast.id = toastId;
            toast.className = `pointer-events-auto flex items-start gap-3 rounded-2xl border border-border border-l-4 ${borderClass} bg-card/95 backdrop-blur-md p-3.5 shadow-2xl transition-all duration-300 transform translate-y-[-10px] opacity-0 text-left`;

            toast.innerHTML = `
                <div class="size-8 rounded-xl ${iconBgClass} flex items-center justify-center shrink-0 mt-0.5">
                    <i data-lucide="${iconName}" class="size-4"></i>
                </div>
                <div class="flex-1 min-w-0 pr-1">
                    <p class="text-xs font-bold text-foreground leading-tight">${titleText}</p>
                    <p class="text-xs text-muted-foreground mt-0.5 leading-snug break-words">${mensagem}</p>
                </div>
                <button type="button" onclick="fecharToast('${toastId}')" class="text-muted-foreground hover:text-foreground p-1 rounded-lg hover:bg-muted transition shrink-0" aria-label="Fechar">
                    <i data-lucide="x" class="size-3.5"></i>
                </button>
            `;

            container.appendChild(toast);
            lucide.createIcons();

            // Animação suave de entrada
            requestAnimationFrame(() => {
                toast.classList.remove('translate-y-[-10px]', 'opacity-0');
                toast.classList.add('translate-y-0', 'opacity-100');
            });

            // Limite de 4 toasts na tela (remove os mais antigos)
            while (container.children.length > 4) {
                container.firstElementChild.remove();
            }

            // Fechamento automático suave
            setTimeout(() => {
                fecharToast(toastId);
            }, 4500);
        }

        function fecharToast(id) {
            const toast = document.getElementById(id);
            if (!toast) return;
            toast.classList.add('opacity-0', 'translate-x-4');
            setTimeout(() => {
                if (toast && toast.parentNode) toast.remove();
            }, 300);
        }

        // ==========================================
        // SISTEMA GLOBAL DE DIÁLOGO E CONFIRMAÇÃO (SEIVA)
        // Substitui 100% de window.confirm() e window.prompt() por modais nativos da UI
        // ==========================================
        let seivaDialogResolver = null;

        function seivaConfirm(opcoes) {
            return new Promise((resolve) => {
                seivaDialogResolver = resolve;
                const modal = document.getElementById('modalConfirmacaoSeiva');
                if (!modal) return resolve(false);

                const titEl = document.getElementById('seivaDialogTitulo');
                const msgEl = document.getElementById('seivaDialogMensagem');
                const inputWrap = document.getElementById('seivaDialogInputWrapper');
                const btnConf = document.getElementById('seivaDialogBtnConfirmar');
                const btnCanc = document.getElementById('seivaDialogBtnCancelar');
                const iconBox = document.getElementById('seivaDialogIconBox');
                const iconEl = document.getElementById('seivaDialogIcon');
                const badgeWrap = document.getElementById('seivaDialogBadgeWrapper');
                const badgeEl = document.getElementById('seivaDialogBadge');
                const impactoBox = document.getElementById('seivaDialogImpactoBox');
                const impactoTit = document.getElementById('seivaDialogImpactoTitulo');
                const impactoTxt = document.getElementById('seivaDialogImpactoTexto');

                if (titEl) titEl.innerText = opcoes.titulo || 'Confirmação';
                if (msgEl) msgEl.innerText = opcoes.mensagem || 'Deseja prosseguir com esta ação?';
                if (inputWrap) inputWrap.classList.add('hidden');

                // Badge Contextual
                if (badgeWrap && badgeEl) {
                    if (opcoes.badge) {
                        badgeWrap.classList.remove('hidden');
                        badgeEl.innerText = opcoes.badge.texto || opcoes.badge;
                        const bTipo = opcoes.badge.tipo || 'alerta';
                        if (bTipo === 'casal') {
                            badgeEl.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black border bg-emerald-50 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300 border-emerald-300 dark:border-emerald-700';
                        } else if (bTipo === 'perigo' || bTipo === 'seguranca') {
                            badgeEl.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black border bg-rose-50 dark:bg-rose-950/60 text-rose-800 dark:text-rose-300 border-rose-300 dark:border-rose-700';
                        } else {
                            badgeEl.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black border bg-amber-50 dark:bg-amber-950/60 text-amber-800 dark:text-amber-300 border-amber-300 dark:border-amber-700';
                        }
                    } else {
                        badgeWrap.classList.add('hidden');
                    }
                }

                // Box de Impacto no Histórico / Relacionamento (Anti-Discórdia)
                if (impactoBox && impactoTxt) {
                    if (opcoes.impacto) {
                        impactoBox.classList.remove('hidden');
                        if (impactoTit) impactoTit.innerText = opcoes.impacto.titulo || 'Impacto no Histórico & Casal';
                        impactoTxt.innerText = opcoes.impacto.texto || opcoes.impacto;
                    } else {
                        impactoBox.classList.add('hidden');
                    }
                }

                if (btnCanc) {
                    btnCanc.innerText = opcoes.cancelText || 'Cancelar (Manter)';
                }

                if (btnConf) {
                    btnConf.innerText = opcoes.confirmText || 'Confirmar';
                    btnConf.className = opcoes.tipo === 'perigo' 
                        ? 'flex-1 py-3.5 rounded-2xl bg-rose-600 hover:bg-rose-500 text-white font-extrabold text-xs transition shadow-soft flex items-center justify-center gap-1.5'
                        : 'flex-1 py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs transition shadow-soft flex items-center justify-center gap-1.5';
                }

                if (iconBox && iconEl) {
                    if (opcoes.tipo === 'perigo') {
                        iconBox.className = 'size-14 mx-auto rounded-2xl bg-rose-50 dark:bg-rose-950/50 text-rose-600 dark:text-rose-400 border border-rose-200/50 flex items-center justify-center';
                        iconEl.setAttribute('data-lucide', opcoes.icone || 'shield-alert');
                    } else {
                        iconBox.className = 'size-14 mx-auto rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border border-emerald-200/50 flex items-center justify-center';
                        iconEl.setAttribute('data-lucide', opcoes.icone || 'shield-check');
                    }
                }

                modal.classList.remove('hidden');
                lucide.createIcons();
            });
        }

        function seivaPrompt(opcoes) {
            return new Promise((resolve) => {
                seivaDialogResolver = resolve;
                const modal = document.getElementById('modalConfirmacaoSeiva');
                if (!modal) return resolve(null);

                const titEl = document.getElementById('seivaDialogTitulo');
                const msgEl = document.getElementById('seivaDialogMensagem');
                const inputWrap = document.getElementById('seivaDialogInputWrapper');
                const input = document.getElementById('seivaDialogInput');
                const inputLabel = document.getElementById('seivaDialogInputLabel');
                const btnConf = document.getElementById('seivaDialogBtnConfirmar');

                if (titEl) titEl.innerText = opcoes.titulo || 'Informe o valor';
                if (msgEl) msgEl.innerText = opcoes.mensagem || '';
                if (inputWrap) inputWrap.classList.remove('hidden');
                if (inputLabel) inputLabel.innerText = opcoes.label || 'Valor';
                if (input) {
                    input.value = opcoes.defaultValue || '';
                    input.placeholder = opcoes.placeholder || '';
                    setTimeout(() => input.focus(), 150);
                }

                if (btnConf) {
                    btnConf.innerText = opcoes.confirmText || 'Salvar';
                    btnConf.className = 'flex-1 py-3 rounded-2xl bg-emerald-700 hover:bg-emerald-800 text-white font-extrabold text-xs transition shadow-soft flex items-center justify-center gap-1.5';
                }

                modal.classList.remove('hidden');
                lucide.createIcons();
            });
        }

        function fecharSeivaDialog(resultado) {
            document.getElementById('modalConfirmacaoSeiva')?.classList.add('hidden');
            if (seivaDialogResolver) {
                seivaDialogResolver(resultado);
                seivaDialogResolver = null;
            }
        }

        function confirmarSeivaDialog() {
            const inputWrap = document.getElementById('seivaDialogInputWrapper');
            if (inputWrap && !inputWrap.classList.contains('hidden')) {
                const val = document.getElementById('seivaDialogInput')?.value;
                fecharSeivaDialog(val);
            } else {
                fecharSeivaDialog(true);
            }
        }

        // Override definitivo de window.alert, window.confirm e window.prompt para blindar a UX
        window.alert = function(msg) {
            if (!msg) return;
            seivaNotificar(msg, 'aviso');
        };
        window.confirm = function(msg) {
            console.warn('window.confirm nativo bloqueado para prevenir quebra de UX e anti-confusão:', msg);
            return false;
        };
        window.prompt = function(msg, def) {
            console.warn('window.prompt nativo bloqueado:', msg);
            return null;
        };

        // Estado Global da Aplicação
        let usuarioSessao = null;
        let larSessao = null;
        let listaContas = [];
        let listaCategorias = [];
        let saldosVisiveis = true;
        let stepOnboarding = 0;
        let tipoRendaOnboarding = 'CLT';
        let bancoOnboarding = 'Nubank';
        let divisaoOnboarding = 'proporcional';
        let usoLarOnboarding = true;

        // Estado da Saúde Financeira Dupla (Individual vs Lar / Casal)
        let visaoSaudeDashAtiva = 'individual';
        let cacheSaudeIndiv = null;
        let cacheSaudeLar = null;

        function alternarVisaoSaudeDashboard(visao) {
            visaoSaudeDashAtiva = visao;
            atualizarCardSaudeDashboard();
        }

        function abrirModalSaudeAtual() {
            if (visaoSaudeDashAtiva === 'lar') {
                abrirModalSaudeFinanceiraLar();
            } else {
                abrirModalSaudeFinanceira();
            }
        }

        function atualizarCardSaudeDashboard() {
            const btnIndiv = document.getElementById('btnDashSaudeIndiv');
            const btnLar = document.getElementById('btnDashSaudeLar');
            const titSecao = document.getElementById('dashSaudeTituloTexto');
            const subSecao = document.getElementById('dashSaudeSubtituloTexto');
            const iconeSecao = document.getElementById('dashSaudeIconeSecao');
            const circuloProg = document.getElementById('dashSaudeCirculoProgresso');
            const scoreVal = document.getElementById('dashSaudeScoreValor');
            const scoreStatus = document.getElementById('dashSaudeScoreStatus');
            const listaInsights = document.getElementById('dashSaudeInsightsLista');
            const btnAnaliseTxt = document.getElementById('btnDashSaudeVerAnaliseTexto');

            const ehLar = (visaoSaudeDashAtiva === 'lar' && cacheSaudeLar);
            const dadosAtivos = ehLar ? cacheSaudeLar : cacheSaudeIndiv;

            // Atualiza botões do toggle
            if (btnIndiv && btnLar) {
                if (ehLar) {
                    btnLar.className = 'px-3.5 py-1.5 rounded-xl text-xs font-bold transition shadow-2xs bg-card text-foreground flex items-center gap-1.5 cursor-pointer';
                    btnLar.querySelector('i')?.setAttribute('class', 'size-3.5 text-emerald-600');
                    btnIndiv.className = 'px-3.5 py-1.5 rounded-xl text-xs font-bold transition text-muted-foreground hover:text-foreground flex items-center gap-1.5 cursor-pointer';
                    btnIndiv.querySelector('i')?.setAttribute('class', 'size-3.5 text-muted-foreground');
                } else {
                    btnIndiv.className = 'px-3.5 py-1.5 rounded-xl text-xs font-bold transition shadow-2xs bg-card text-foreground flex items-center gap-1.5 cursor-pointer';
                    btnIndiv.querySelector('i')?.setAttribute('class', 'size-3.5 text-emerald-600');
                    btnLar.className = 'px-3.5 py-1.5 rounded-xl text-xs font-bold transition text-muted-foreground hover:text-foreground flex items-center gap-1.5 cursor-pointer';
                    btnLar.querySelector('i')?.setAttribute('class', 'size-3.5 text-muted-foreground');
                }
            }

            if (!dadosAtivos) return;

            // Título e Subtítulo
            if (titSecao) {
                titSecao.innerText = ehLar ? 'Saúde financeira do Nosso Lar' : 'Sua saúde financeira individual';
            }
            if (subSecao) {
                subSecao.innerText = ehLar 
                    ? 'Despesas da casa, fundo de emergência conjunto e equilíbrio do casal'
                    : 'Equilíbrio da sua renda pessoal, faturas e reservas';
            }
            if (iconeSecao) {
                iconeSecao.setAttribute('data-lucide', ehLar ? 'home' : 'heart-pulse');
            }

            // Gauge e Score
            const score = dadosAtivos.score || 0;
            const status = dadosAtivos.status || 'Saudável';
            if (scoreVal) scoreVal.innerText = `${score}%`;
            if (scoreStatus) {
                scoreStatus.innerText = status;
                scoreStatus.className = `text-[11px] font-extrabold ${score >= 80 ? 'text-emerald-600' : (score >= 60 ? 'text-amber-600' : 'text-rose-600')}`;
            }

            if (circuloProg) {
                const circumference = 251.2;
                const offset = circumference - (score / 100) * circumference;
                circuloProg.setAttribute('stroke-dashoffset', Math.round(offset));
                const corScore = score >= 80 ? '#10b981' : (score >= 60 ? '#f59e0b' : '#ef4444');
                circuloProg.setAttribute('stroke', corScore);
            }

            // Insights
            if (listaInsights && dadosAtivos.insights?.length) {
                listaInsights.innerHTML = dadosAtivos.insights.map(ins => {
                    const isSucesso = ins.tipo === 'sucesso';
                    return `
                    <div class="flex items-start gap-2.5 text-xs text-foreground">
                        <span class="size-5 rounded-md flex items-center justify-center shrink-0 border mt-0.5"
                              style="background-color: ${isSucesso ? '#ecfdf5' : '#fef3c7'} !important; border-color: ${isSucesso ? '#10b981' : '#f59e0b'} !important; color: ${isSucesso ? '#059669' : '#b45309'} !important;">
                            <i data-lucide="${isSucesso ? 'check-circle-2' : 'alert-triangle'}" class="size-3" style="color: ${isSucesso ? '#059669' : '#b45309'} !important;"></i>
                        </span>
                        <p class="leading-relaxed">${ins.texto}</p>
                    </div>`;
                }).join('');
            }

            // Botão Ver Análise
            if (btnAnaliseTxt) {
                btnAnaliseTxt.innerText = ehLar ? 'Ver análise completa do Lar' : 'Ver análise individual completa';
            }

            if (window.lucide) lucide.createIcons();
        }

        const BRL = (v) => Number(v || 0).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

        document.addEventListener('DOMContentLoaded', async () => {
            // Inicialização imediata do Tema Claro / Escuro
            const temaSalvo = localStorage.getItem('seiva_theme') || 'sistema';
            if (temaSalvo === 'escuro') {
                document.documentElement.classList.add('dark');
            } else if (temaSalvo === 'claro') {
                document.documentElement.classList.remove('dark');
            } else {
                const darkSys = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                document.documentElement.classList.toggle('dark', darkSys);
            }

            lucide.createIcons();
            const vencInput = document.getElementById('formLarDespData');
            if (vencInput) vencInput.value = new Date().toISOString().split('T')[0];
            await carregarCategoriasSistema();
            await validarSessaoInicial();
        });

        // ==========================================
        // GERENCIADOR DE TELAS (ISOLAMENTO PURO)
        // ==========================================
        function trocarTelaPrincipal(screenId) {
            document.querySelectorAll('.app-screen').forEach(s => {
                s.classList.remove('is-active');
            });
            const target = document.getElementById(screenId);
            if (target) {
                target.classList.add('is-active');
            }
            window.scrollTo({ top: 0, behavior: 'instant' });
            lucide.createIcons();
        }

        async function validarSessaoInicial() {
            // Checar se a URL atual contém token de convite
            const pathSegments = window.location.pathname.split('/');
            const idxConvite = pathSegments.indexOf('convite');
            if (idxConvite !== -1 && pathSegments[idxConvite + 1]) {
                window._tokenConvitePendente = pathSegments[idxConvite + 1];
            }

            try {
                const res = await fetch('/api/me');
                if (res.ok) {
                    const data = await res.json();
                    if (data.authenticated && data.usuario) {
                        usuarioSessao = data.usuario;
                        larSessao = data.lar;
                        montarAmbienteLogado();
                        trocarTelaPrincipal('screen-app');
                        return;
                    }
                }
            } catch (e) {}

            // Se não autenticado e veio por link de convite, prepara o cadastro diretamente
            if (window._tokenConvitePendente) {
                try {
                    const convRes = await fetch(`/api/convite/${window._tokenConvitePendente}`);
                    if (convRes.ok) {
                        const convData = await convRes.json();
                        if (convData.valido) {
                            const regEmail = document.getElementById('regEmail');
                            if (regEmail && convData.email_convidado) {
                                regEmail.value = convData.email_convidado;
                            }
                            seivaNotificar(`Você foi convidado(a) por ${convData.remetente.nome} para o Lar "${convData.lar.nome}"! Conclua seu cadastro para entrar.`, 'sucesso', 'Convite do Lar');
                            irParaOnboarding();
                            return;
                        }
                    }
                } catch (e) {}
            }

            trocarTelaPrincipal('screen-login');
        }

        function irParaLogin() {
            trocarTelaPrincipal('screen-login');
            alternarAbaAuth('entrar');
        }

        // ==========================================
        // ALTERNÂNCIA DE ABAS NO CARD (ENTRAR VS CRIAR CONTA)
        // ==========================================
        function alternarAbaAuth(aba) {
            const btnEntrar = document.getElementById('tabAuthEntrar');
            const btnCadastro = document.getElementById('tabAuthCadastro');
            const formLogin = document.getElementById('formLoginCard');
            const formCadastro = document.getElementById('formCadastroCard');
            const title = document.getElementById('authCardTitle');
            const subtitle = document.getElementById('authCardSubtitle');
            const footerText = document.getElementById('authCardFooterText');

            if (aba === 'cadastro') {
                // ── CRIAR CONTA: vai direto para o onboarding passo a passo ──
                irParaOnboarding();
                return;
            } else {
                if (btnEntrar) btnEntrar.className = "relative z-10 flex-1 rounded-xl py-2.5 text-sm font-semibold bg-primary text-primary-foreground shadow-soft transition-all";
                if (btnCadastro) btnCadastro.className = "relative z-10 flex-1 rounded-xl py-2.5 text-sm font-semibold text-muted-foreground hover:text-foreground transition-all";
                if (formLogin) formLogin.classList.remove('hidden');
                if (formCadastro) formCadastro.classList.add('hidden');
                if (title) title.innerText = "Bem-vindo(a) de volta";
                if (subtitle) subtitle.innerText = "Acesse seu painel pessoal e o ambiente do seu Lar";
                if (footerText) {
                    footerText.innerHTML = 'Não tem uma conta? <button type="button" onclick="alternarAbaAuth(\'cadastro\')" class="font-bold text-primary hover:underline ml-1">Criar conta no SEIVA</button>';
                }
            }
            lucide.createIcons();
        }

        async function executarCadastroCard(e) {
            e.preventDefault();
            const btn = document.getElementById('cardRegSubmitBtn');
            const nome = document.getElementById('cardRegNome').value.trim();
            const email = document.getElementById('cardRegEmail').value.trim();
            const senha = document.getElementById('cardRegSenha').value;
            const senhaConf = document.getElementById('cardRegSenhaConfirma').value;
            const renda = parseFloat(document.getElementById('cardRegRenda').value) || 0;

            if (!nome || !email || !senha) return seivaNotificar('Por favor, preencha todos os campos obrigatórios.', 'erro', 'Dados pendentes');
            if (senha !== senhaConf) return seivaNotificar('As senhas não coincidem. Verifique a digitação.', 'erro', 'Confirmação incorreta');
            if (senha.length < 6) return seivaNotificar('A senha deve ter no mínimo 6 caracteres para sua segurança.', 'erro', 'Senha fraca');

            btn.disabled = true;
            btn.innerHTML = '<span>Criando sua conta...</span>';

            try {
                const res = await fetch('/api/register', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        nome,
                        email,
                        senha,
                        renda_mensal: renda,
                        tipo_renda: 'clt',
                        banco_principal: 'Nubank',
                        pin_caixa_preta: '1234',
                    })
                });

                const data = await res.json();
                if (res.ok) {
                    usuarioSessao = data.usuario;
                    
                    // Cria automaticamente o Lar Compartilhado para o casal
                    try {
                        const larRes = await fetch('/api/lar', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ nome: 'Nosso Cantinho', emoji: 'home' })
                        });
                        if (larRes.ok) larSessao = await larRes.json();
                    } catch (e) {}

                    montarAmbienteLogado();
                    trocarTelaPrincipal('screen-app');
                } else {
                    seivaNotificar(data.error || 'Erro ao realizar cadastro.', 'erro');
                }
            } catch (err) {
                seivaNotificar('Erro de conexão ao comunicar com o servidor.', 'erro', 'Falha de Conexão');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<span>Criar minha conta no SEIVA</span><i data-lucide="arrow-right" class="size-4"></i>';
                lucide.createIcons();
            }
        }

        // ==========================================
        // CONTROLE DE VISIBILIDADE E COINCIDÊNCIA DE SENHAS
        // Permite ver as senhas para checar se são iguais e dá feedback em tempo real
        // ==========================================
        function alternarVisibilidadeSenha(inputId, iconId = null) {
            const input = document.getElementById(inputId);
            if (!input) return;
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';

            // Atualiza o texto "Ver senha" / "Ocultar" se existir
            if (inputId === 'regSenha') {
                const txt = document.getElementById('txtOlhoSenha');
                if (txt) txt.innerText = isPassword ? 'Ocultar' : 'Ver senha';
            } else if (inputId === 'regSenhaConfirma') {
                const txt = document.getElementById('txtOlhoConfirma');
                if (txt) txt.innerText = isPassword ? 'Ocultar' : 'Ver senha';
            }

            // Atualiza os ícones de olho do input e do cabeçalho
            const iconNome = isPassword ? 'eye-off' : 'eye';
            if (iconId) {
                const icon = document.getElementById(iconId);
                if (icon) icon.setAttribute('data-lucide', iconNome);
            }

            // Atualiza qualquer botão interno do input
            const parent = input.parentElement;
            if (parent) {
                const innerIcon = parent.querySelector('button i[data-lucide]');
                if (innerIcon) innerIcon.setAttribute('data-lucide', iconNome);
            }

            lucide.createIcons();
        }

        function verificarCoincidenciaSenhas() {
            const s1 = document.getElementById('regSenha')?.value || '';
            const s2 = document.getElementById('regSenhaConfirma')?.value || '';
            const boxIguais = document.getElementById('boxSenhasIguais');
            const boxDiferentes = document.getElementById('boxSenhasDiferentes');

            if (!boxIguais || !boxDiferentes) return;

            if (!s2) {
                boxIguais.classList.add('hidden');
                boxDiferentes.classList.add('hidden');
                return;
            }

            if (s1 === s2) {
                boxIguais.classList.remove('hidden');
                boxDiferentes.classList.add('hidden');
            } else {
                boxIguais.classList.add('hidden');
                boxDiferentes.classList.remove('hidden');
            }
            lucide.createIcons();
        }

        function irParaOnboarding() {
            stepOnboarding = 0;
            const faseWelcome = document.getElementById('onboardingFaseWelcome');
            const faseForm = document.getElementById('onboardingFaseForm');
            // Estrutura Fiel ao Protótipo Original: Exibe a tela de Introdução dos 4 passos
            if (faseWelcome) faseWelcome.classList.remove('hidden');
            if (faseForm) faseForm.classList.add('hidden');
            trocarTelaPrincipal('screen-onboarding');
        }

        // Fluxo especial quando autenticado pelo Google: pula a digitação de dados pessoais e vai direto para a configuração do Lar
        function irParaOnboardingGoogle(usuario) {
            usuarioSessao = usuario;
            const faseWelcome = document.getElementById('onboardingFaseWelcome');
            const faseForm = document.getElementById('onboardingFaseForm');
            if (faseWelcome) faseWelcome.classList.add('hidden');
            if (faseForm) faseForm.classList.remove('hidden');

            // Preenche dados vindos do Google
            const campoNome = document.getElementById('regNome');
            const campoEmail = document.getElementById('regEmail');
            const campoSenha = document.getElementById('regSenha');
            const campoConf = document.getElementById('regSenhaConfirma');
            if (campoNome) campoNome.value = usuario.nome || '';
            if (campoEmail) {
                campoEmail.value = usuario.email || '';
                campoEmail.readOnly = true;
            }
            if (campoSenha) campoSenha.value = 'google_authenticated';
            if (campoConf) campoConf.value = 'google_authenticated';

            // Abre no passo 1 (Renda) ou passo 3 (Lar), pois nome e email já foram validados pelo Google
            stepOnboarding = 1;
            trocarTelaPrincipal('screen-onboarding');
            renderizarPassoOnboarding();
        }

        function iniciarFormularioOnboarding() {
            const faseWelcome = document.getElementById('onboardingFaseWelcome');
            const faseForm = document.getElementById('onboardingFaseForm');
            if (faseWelcome) faseWelcome.classList.add('hidden');
            if (faseForm) faseForm.classList.remove('hidden');
            stepOnboarding = 0;
            renderizarPassoOnboarding();
        }

        function recuarPassoOnboarding() {
            fecharAlertaOnboarding();
            if (stepOnboarding === 0) {
                // Retorna à tela de introdução do Onboarding
                const faseWelcome = document.getElementById('onboardingFaseWelcome');
                const faseForm = document.getElementById('onboardingFaseForm');
                if (faseWelcome) faseWelcome.classList.remove('hidden');
                if (faseForm) faseForm.classList.add('hidden');
                window.scrollTo({ top: 0, behavior: 'instant' });
            } else {
                stepOnboarding--;
                renderizarPassoOnboarding();
            }
        }

        function renderizarPassoOnboarding() {
            fecharAlertaOnboarding();
            document.querySelectorAll('.onb-step-view').forEach((view, idx) => {
                view.classList.toggle('hidden', idx !== stepOnboarding);
                const bar = document.getElementById(`onbBar${idx}`);
                if (bar) {
                    bar.className = idx <= stepOnboarding ? "h-1.5 flex-1 rounded-full bg-primary transition-colors" : "h-1.5 flex-1 rounded-full bg-muted transition-colors";
                }
            });

            const txtVoltar = document.getElementById('btnVoltarOnboardingTxt');
            if (txtVoltar) {
                txtVoltar.innerText = stepOnboarding === 0 ? "Voltar ao Login" : "Voltar";
            }

            const stepCounter = document.getElementById('onbStepCounter');
            if (stepCounter) stepCounter.innerText = `${stepOnboarding + 1} de 4`;

            const btnAvancarLabel = document.getElementById('btnAvancarOnboardingLabel');
            if (btnAvancarLabel) {
                btnAvancarLabel.innerText = stepOnboarding === 3 ? "Concluir cadastro e entrar" : "Próximo";
            }
            window.scrollTo({ top: 0, behavior: 'instant' });
            lucide.createIcons();
        }

        function exibirErroOnboarding(msg, inputId = null) {
            fecharAlertaOnboarding();

            // Dispara o toast elegante e discreto da Fintech
            seivaNotificar(msg, 'erro', 'Atenção');

            if (inputId) {
                const input = document.getElementById(inputId);
                if (input) {
                    // Leva suavemente o usuário exatamente até o campo que não foi preenchido
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    setTimeout(() => input.focus(), 250);

                    // Destaca o campo com borda suave de atenção
                    input.classList.add('border-rose-500', 'ring-2', 'ring-rose-500/25', 'onb-input-error');

                    // Mostra o aviso contextual logo abaixo do campo
                    const errEl = document.getElementById('err_' + inputId);
                    if (errEl) {
                        errEl.innerText = msg;
                        errEl.classList.remove('hidden');
                        errEl.classList.add('onb-msg-error');
                    }

                    // Limpa o aviso assim que o usuário começar a preencher
                    const limparErro = () => {
                        input.classList.remove('border-rose-500', 'ring-2', 'ring-rose-500/25', 'onb-input-error');
                        if (errEl) {
                            errEl.classList.add('hidden');
                            errEl.classList.remove('onb-msg-error');
                        }
                        input.removeEventListener('input', limparErro);
                        input.removeEventListener('change', limparErro);
                    };
                    input.addEventListener('input', limparErro);
                    input.addEventListener('change', limparErro);
                }
            } else {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
            lucide.createIcons();
        }

        function fecharAlertaOnboarding() {
            document.querySelectorAll('.onb-input-error').forEach(el => {
                el.classList.remove('border-rose-500', 'ring-2', 'ring-rose-500/25', 'onb-input-error');
            });
            document.querySelectorAll('.onb-msg-error').forEach(el => {
                el.classList.add('hidden');
                el.classList.remove('onb-msg-error');
            });
        }

        async function avancarEtapaOnboarding() {
            fecharAlertaOnboarding();

            // ───── PASSO 1: QUEM É VOCÊ (DADOS PESSOAIS) ─────
            if (stepOnboarding === 0) {
                const nome = document.getElementById('regNome').value.trim();
                const email = document.getElementById('regEmail').value.trim();
                const telefone = document.getElementById('regTelefone').value.trim();
                const senha = document.getElementById('regSenha').value;
                const senhaConf = document.getElementById('regSenhaConfirma').value;

                if (!nome) {
                    return exibirErroOnboarding('O nome completo é obrigatório.', 'regNome');
                }
                const partesNome = nome.split(/\s+/).filter(Boolean);
                if (partesNome.length < 2 || nome.length < 5) {
                    return exibirErroOnboarding('Por favor, informe seu nome completo (nome e sobrenome).', 'regNome');
                }

                if (!email) {
                    return exibirErroOnboarding('O e-mail é obrigatório para acessar sua conta.', 'regEmail');
                }
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    return exibirErroOnboarding('Por favor, informe um endereço de e-mail válido (ex: seu.nome@email.com).', 'regEmail');
                }

                if (!telefone) {
                    return exibirErroOnboarding('O telefone/WhatsApp é obrigatório para avisos de contas e convite do Lar.', 'regTelefone');
                }
                const digitosTel = telefone.replace(/\D/g, '');
                if (digitosTel.length < 10) {
                    return exibirErroOnboarding('Informe um telefone válido com DDD (mínimo 10 dígitos, ex: 71 99999-9999).', 'regTelefone');
                }

                if (!senha) {
                    return exibirErroOnboarding('A senha de acesso é obrigatória.', 'regSenha');
                }
                if (senha.length < 6) {
                    return exibirErroOnboarding('A senha deve ter no mínimo 6 caracteres para garantir sua segurança.', 'regSenha');
                }

                if (!senhaConf) {
                    return exibirErroOnboarding('Por favor, confirme a sua senha digitada.', 'regSenhaConfirma');
                }
                if (senha !== senhaConf) {
                    return exibirErroOnboarding('As senhas digitadas não coincidem. Verifique a confirmação.', 'regSenhaConfirma');
                }

                stepOnboarding = 1;
                renderizarPassoOnboarding();
                return;
            }

            // ───── PASSO 2: SUA RENDA (BASE DO RATEIO PROPORCIONAL) ─────
            if (stepOnboarding === 1) {
                const rendaInput = document.getElementById('regRenda');
                const rendaStr = rendaInput.value.trim();
                const rendaValor = parseFloat(rendaStr);

                if (!rendaStr || isNaN(rendaValor) || rendaValor <= 0) {
                    return exibirErroOnboarding('A renda mensal líquida é obrigatória e deve ser maior que R$ 0,00 para o cálculo do rateio justo do casal.', 'regRenda');
                }

                const diaRecebe = document.getElementById('regDiaRecebe').value;
                if (diaRecebe === '' || diaRecebe === null) {
                    return exibirErroOnboarding('Por favor, selecione o dia em que costuma receber sua renda.', 'regDiaRecebe');
                }

                const temExtra = document.getElementById('regTemExtra').checked;
                if (temExtra) {
                    const extraInput = document.getElementById('regRendaExtra');
                    const extraStr = extraInput.value.trim();
                    const extraValor = parseFloat(extraStr);
                    if (!extraStr || isNaN(extraValor) || extraValor <= 0) {
                        return exibirErroOnboarding('Você marcou que possui renda extra. Por favor, informe o valor médio mensal da renda extra (maior que zero).', 'regRendaExtra');
                    }
                }

                stepOnboarding = 2;
                renderizarPassoOnboarding();
                return;
            }

            // ───── PASSO 3: CONTAS & CAIXA PRETA ─────
            if (stepOnboarding === 2) {
                // Se escolheu 'Outro', o nome do banco ou carteira é obrigatório
                if (bancoOnboarding === 'Outro') {
                    const outroInput = document.getElementById('regBancoOutroNome');
                    const outroNome = outroInput ? outroInput.value.trim() : '';
                    if (!outroNome || outroNome.length < 2) {
                        return exibirErroOnboarding('Por favor, informe o nome do seu banco ou onde o seu dinheiro está guardado.', 'regBancoOutroNome');
                    }
                }

                // Saldo inicial é obrigatório (não pode ser vazio; pode ser 0)
                const saldoInput = document.getElementById('regSaldoInicial');
                const saldoStr = saldoInput.value.trim();
                if (saldoStr === '' || isNaN(parseFloat(saldoStr)) || parseFloat(saldoStr) < 0) {
                    return exibirErroOnboarding('O saldo atual da conta principal é obrigatório (digite 0 caso a conta esteja sem saldo).', 'regSaldoInicial');
                }

                // Chave Pix é obrigatória
                const pixInput = document.getElementById('regPix');
                const pixValor = pixInput.value.trim();
                if (!pixValor || pixValor.length < 3) {
                    return exibirErroOnboarding('A chave Pix principal é obrigatória para transferências e rateio de despesas do casal.', 'regPix');
                }

                // PIN da Caixa Preta é OBRIGATÓRIO com 4 dígitos numéricos
                const pinInput = document.getElementById('regPinCaixa');
                const pinValor = pinInput.value.trim();
                if (!pinValor || !/^\d{4}$/.test(pinValor)) {
                    return exibirErroOnboarding('O PIN da Caixa Preta é obrigatório e deve conter exatamente 4 números (ex: 1234).', 'regPinCaixa');
                }

                stepOnboarding = 3;
                renderizarPassoOnboarding();
                return;
            }

            // ───── PASSO 4: SEU LAR & FINALIZAÇÃO ─────
            if (stepOnboarding === 3) {
                if (usoLarOnboarding) {
                    const larInput = document.getElementById('regNomeLar');
                    const nomeLar = larInput ? larInput.value.trim() : '';
                    if (!nomeLar || nomeLar.length < 3) {
                        return exibirErroOnboarding('Por favor, informe um nome para o seu Lar compartilhado (mínimo 3 caracteres, ex: Nosso Cantinho).', 'regNomeLar');
                    }

                    const emailParceiroInput = document.getElementById('regEmailParceiro');
                    const emailParceiro = emailParceiroInput ? emailParceiroInput.value.trim() : '';
                    if (emailParceiro) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(emailParceiro)) {
                            return exibirErroOnboarding('O e-mail do parceiro(a) informado não é válido.', 'regEmailParceiro');
                        }
                        const meuEmail = document.getElementById('regEmail').value.trim();
                        if (emailParceiro.toLowerCase() === meuEmail.toLowerCase()) {
                            return exibirErroOnboarding('O e-mail do parceiro(a) não pode ser igual ao seu próprio e-mail de cadastro.', 'regEmailParceiro');
                        }
                    }
                }

                const btnAvancar = document.getElementById('btnAvancarOnboarding');
                btnAvancar.disabled = true;
                btnAvancar.innerHTML = '<span>Criando sua conta...</span>';

                // Caso especial: Usuário já autenticado via Google (já cadastrado no banco)
                if (usuarioSessao && usuarioSessao.id_usuario && (usuarioSessao.google_id || usuarioSessao.email.includes('google') || usuarioSessao.email.includes('gmail'))) {
                    try {
                        if (usoLarOnboarding) {
                            const nomeLar = document.getElementById('regNomeLar').value.trim() || 'Nosso Cantinho';
                            const larRes = await fetch('/api/lar', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ nome: nomeLar, emoji: 'home' })
                            });
                            if (larRes.ok) {
                                larSessao = await larRes.json();
                            }
                        }
                        montarAmbienteLogado();
                        trocarTelaPrincipal('screen-app');
                        return;
                    } catch (err) {
                        console.error('Erro ao vincular Lar ao Google user:', err);
                    } finally {
                        btnAvancar.disabled = false;
                        btnAvancar.innerHTML = '<span id="btnAvancarOnboardingLabel">Concluir cadastro e entrar</span><i data-lucide="arrow-right" class="size-5"></i>';
                        lucide.createIcons();
                    }
                }

                // Determina o banco principal (se 'Outro', pega o nome digitado pela pessoa)
                let bancoFinal = bancoOnboarding;
                if (bancoOnboarding === 'Outro') {
                    const nomeOutro = document.getElementById('regBancoOutroNome')?.value.trim();
                    bancoFinal = nomeOutro || 'Outro';
                }

                // Envia os dados completos para a API Laravel com POO e extract($_POST)
                const payload = {
                    nome: document.getElementById('regNome').value.trim(),
                    email: document.getElementById('regEmail').value.trim(),
                    telefone: document.getElementById('regTelefone').value.trim(),
                    senha: document.getElementById('regSenha').value,
                    tipo_renda: tipoRendaOnboarding.toLowerCase(),
                    renda_mensal: parseFloat(document.getElementById('regRenda').value) || 0,
                    dia_recebimento: parseInt(document.getElementById('regDiaRecebe').value) || 5,
                    renda_extra: parseFloat(document.getElementById('regRendaExtra').value) || 0,
                    saldo_inicial: parseFloat(document.getElementById('regSaldoInicial').value) || 0,
                    banco_principal: bancoFinal,
                    chave_pix: document.getElementById('regPix').value.trim(),
                    pin_caixa_preta: document.getElementById('regPinCaixa').value.trim() || '1234',
                };

                try {
                    const res = await fetch('/api/register', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(payload)
                    });

                    const data = await res.json();
                    if (res.ok) {
                        usuarioSessao = data.usuario;

                        // Se veio de um link de convite pendente, aceita o convite imediatamente!
                        if (window._tokenConvitePendente) {
                            try {
                                const aceiteRes = await fetch('/api/lar/aceitar-convite', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json' },
                                    body: JSON.stringify({ token: window._tokenConvitePendente })
                                });
                                if (aceiteRes.ok) {
                                    const aceiteData = await aceiteRes.json();
                                    larSessao = aceiteData.lar;
                                    window._isCasalGlobal = true;
                                    seivaNotificar(aceiteData.mensagem || 'Você entrou no Lar!', 'sucesso', 'Lar Conectado!');
                                }
                            } catch (e) {}
                        } else if (usoLarOnboarding) {
                            const nomeLar = document.getElementById('regNomeLar')?.value?.trim() || 'Nosso Cantinho';
                            const emailParceiro = document.getElementById('regEmailParceiro')?.value?.trim();
                            const larRes = await fetch('/api/lar', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ nome: nomeLar, emoji: 'home' })
                            });
                            if (larRes.ok) {
                                larSessao = await larRes.json();
                                window._isCasalGlobal = true;
                                if (emailParceiro) {
                                    try {
                                        await fetch('/api/lar/convidar', {
                                            method: 'POST',
                                            headers: { 'Content-Type': 'application/json' },
                                            body: JSON.stringify({ email_convidado: emailParceiro, nome_lar: nomeLar })
                                        });
                                        seivaNotificar(`Convite gerado e enviado para ${emailParceiro}!`, 'sucesso', 'Convite do Lar');
                                    } catch (e) {}
                                }
                            }
                        }

                        montarAmbienteLogado();
                        trocarTelaPrincipal('screen-app');
                    } else {
                        exibirErroOnboarding(data.error || 'Erro ao realizar cadastro.');
                    }
                } catch (err) {
                    exibirErroOnboarding('Erro de conexão ao realizar cadastro.');
                } finally {
                    btnAvancar.disabled = false;
                    btnAvancar.innerHTML = '<span id="btnAvancarOnboardingLabel">Concluir cadastro e entrar</span><i data-lucide="arrow-right" class="size-5"></i>';
                    lucide.createIcons();
                }
            }
        }

        function setRendaTipo(t) {
            tipoRendaOnboarding = t;
            ['CLT', 'Autônomo', 'Empresário', 'Outros'].forEach(tipo => {
                const b = document.getElementById(`btnRenda_${tipo}`);
                if (b) {
                    b.className = tipo === t ? "min-h-11 rounded-xl border border-primary bg-primary text-primary-foreground px-4 text-sm font-medium transition" : "min-h-11 rounded-xl border border-border bg-background text-muted-foreground px-4 text-sm font-medium transition";
                }
            });
        }

        function setBancoPrincipal(banco) {
            bancoOnboarding = banco;
            document.querySelectorAll('.banco-select-btn').forEach(btn => {
                const ativo = btn.getAttribute('data-banco') === banco;
                btn.className = ativo ? "banco-select-btn flex flex-col items-center gap-1.5 rounded-2xl border border-primary bg-accent/40 text-foreground py-2.5 text-xs font-medium transition" : "banco-select-btn flex flex-col items-center gap-1.5 rounded-2xl border border-border bg-background text-muted-foreground py-2.5 text-xs font-medium transition";
            });

            // Exibe ou oculta o campo para digitar o nome quando 'Outro' é selecionado
            const boxOutro = document.getElementById('boxBancoOutroInput');
            if (boxOutro) {
                if (banco === 'Outro') {
                    boxOutro.classList.remove('hidden');
                    const inputOutro = document.getElementById('regBancoOutroNome');
                    if (inputOutro) inputOutro.focus();
                } else {
                    boxOutro.classList.add('hidden');
                }
            }
        }

        function setEscolhaLar(criar) {
            usoLarOnboarding = criar;
            const btnInd = document.getElementById('btnUsoIndividual');
            const btnLar = document.getElementById('btnUsoLar');
            const boxLar = document.getElementById('boxConfigLar');
            if (btnInd) btnInd.className = !criar ? "flex items-start gap-3 rounded-2xl border border-primary bg-accent/40 p-4 text-left shadow-soft transition" : "flex items-start gap-3 rounded-2xl border border-border bg-card p-4 text-left shadow-soft transition";
            if (btnLar) btnLar.className = criar ? "flex items-start gap-3 rounded-2xl border border-primary bg-accent/40 p-4 text-left shadow-soft transition" : "flex items-start gap-3 rounded-2xl border border-border bg-card p-4 text-left shadow-soft transition";
            if (boxLar) boxLar.classList.toggle('hidden', !criar);
        }

        function setDivisaoPadrao(div) {
            divisaoOnboarding = div;
            const btnProp = document.getElementById('btnDivProp');
            const btn50 = document.getElementById('btnDiv50');
            if (btnProp) btnProp.className = div === 'proporcional' ? "rounded-2xl border border-primary bg-accent/50 p-3 text-left transition" : "rounded-2xl border border-border bg-background p-3 text-left transition";
            if (btn50) btn50.className = div === '50/50' ? "rounded-2xl border border-primary bg-accent/50 p-3 text-left transition" : "rounded-2xl border border-border bg-background p-3 text-left transition";
        }

        function testarForcaSenha(val) {
            const b1 = document.getElementById('pwdBar1');
            const b2 = document.getElementById('pwdBar2');
            const b3 = document.getElementById('pwdBar3');
            const lbl = document.getElementById('pwdLabel');

            if (!b1 || !b2 || !b3 || !lbl) return;

            b1.className = 'h-1.5 flex-1 rounded-full bg-muted';
            b2.className = 'h-1.5 flex-1 rounded-full bg-muted';
            b3.className = 'h-1.5 flex-1 rounded-full bg-muted';

            if (!val) { lbl.innerText = ''; return; }
            if (val.length < 6) {
                b1.className = 'h-1.5 flex-1 rounded-full bg-destructive';
                lbl.innerText = 'Fraca';
            } else if (val.length < 10) {
                b1.className = 'h-1.5 flex-1 rounded-full bg-amber-500';
                b2.className = 'h-1.5 flex-1 rounded-full bg-amber-500';
                lbl.innerText = 'Média';
            } else {
                b1.className = 'h-1.5 flex-1 rounded-full bg-primary';
                b2.className = 'h-1.5 flex-1 rounded-full bg-primary';
                b3.className = 'h-1.5 flex-1 rounded-full bg-primary';
                lbl.innerText = 'Forte';
            }
        }

        // ==========================================
        // LOGIN, GOOGLE AUTH & SESSÃO
        // ==========================================
        async function executarLogin(e) {
            e.preventDefault();
            const emailInput = document.getElementById('loginEmail');
            const senhaInput = document.getElementById('loginSenha');
            const email = emailInput.value.trim();
            const senha = senhaInput.value;

            if (!email) {
                emailInput.classList.add('border-red-400', 'ring-1', 'ring-red-300');
                emailInput.focus();
                seivaNotificar('Informe seu e-mail cadastrado.', 'aviso', 'Campo obrigatório');
                emailInput.addEventListener('input', () => emailInput.classList.remove('border-red-400', 'ring-1', 'ring-red-300'), { once: true });
                return;
            }
            if (!senha) {
                senhaInput.classList.add('border-red-400', 'ring-1', 'ring-red-300');
                senhaInput.focus();
                seivaNotificar('Digite sua senha de acesso.', 'aviso', 'Campo obrigatório');
                senhaInput.addEventListener('input', () => senhaInput.classList.remove('border-red-400', 'ring-1', 'ring-red-300'), { once: true });
                return;
            }

            const btn = document.getElementById('loginSubmitBtn');
            btn.disabled = true;
            btn.innerHTML = '<span>Entrando no SEIVA...</span>';

            const lembrar = document.getElementById('loginLembrar') ? document.getElementById('loginLembrar').checked : true;

            try {
                const res = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ email, senha, lembrar })
                });

                const data = await res.json();
                if (res.ok) {
                    usuarioSessao = data.usuario;
                    larSessao = (data.usuario.lares && data.usuario.lares.length) ? data.usuario.lares[0] : null;
                    trocarTelaPrincipal('screen-app');
                    montarAmbienteLogado();
                } else {
                    seivaNotificar(data.error || 'E-mail ou senha incorretos.', 'erro', 'Falha no login');
                }
            } catch (err) {
                console.error('Erro no login:', err);
                seivaNotificar('Erro de conexão ao comunicar com o servidor.', 'erro', 'Falha de Conexão');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<span>Entrar no SEIVA</span><i data-lucide="arrow-right" class="size-4"></i>';
                lucide.createIcons();
            }
        }

        // Preenche e submete as credenciais dos perfis de teste com 1 clique
        function preencherLoginTeste(email, senha) {
            const emailInput = document.getElementById('loginEmail');
            const senhaInput = document.getElementById('loginSenha');
            if (emailInput && senhaInput) {
                emailInput.value = email;
                senhaInput.value = senha;
                const form = document.getElementById('formLoginCard');
                if (form) {
                    if (typeof form.requestSubmit === 'function') {
                        form.requestSubmit();
                    } else {
                        form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
                    }
                }
            }
        }

        // --- INTEGRAÇÃO GOOGLE IDENTITY SERVICES ---
        // Abre a janela POPUP OFICIAL DO GOOGLE (igual ao print de Escolha uma conta)
        // Se usuário existente -> Painel. Se novo -> Onboarding direto no passo do Lar!
        function iniciarGoogleAuth() {
            const width = 520;
            const height = 640;
            const left = Math.max(0, (window.screen.width / 2) - (width / 2));
            const top = Math.max(0, (window.screen.height / 2) - (height / 2));

            // Abre a janela popup oficial
            const popup = window.open(
                '/auth/google/popup',
                'GoogleSignInPopup',
                `width=${width},height=${height},top=${top},left=${left},status=no,menubar=no,toolbar=no,location=yes,resizable=yes`
            );

            // Fallback caso o navegador bloqueie popups automáticos
            if (!popup || popup.closed || typeof popup.closed === 'undefined') {
                const modal = document.getElementById('modalGoogleAuth');
                if (modal) modal.classList.remove('hidden');
                lucide.createIcons();
            }
        }

        // Listener global para capturar a resposta enviada pela janela popup do Google
        window.addEventListener('message', async (event) => {
            if (event.data && event.data.tipo === 'SEIVA_GOOGLE_AUTH_SUCCESS') {
                const payload = event.data.payload;
                await _processarDadosGoogle(payload);
            }
        });

        async function conectarContaGoogleDireta(nome, email, googleId) {
            const status = document.getElementById('googleLoadingStatus');
            if (status) status.classList.remove('hidden');

            await _processarDadosGoogle({
                google_id: googleId,
                name: nome,
                email: email,
                picture: null
            });

            if (status) status.classList.add('hidden');
        }

        async function handleGoogleCredentialResponse(response) {
            if (!response || !response.credential) return;
            try {
                const res = await fetch('/api/auth/google', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ credential: response.credential })
                });
                const data = await res.json();
                if (res.ok) {
                    fecharModalId('modalGoogleAuth');
                    usuarioSessao = data.usuario;
                    larSessao = (data.usuario.lares && data.usuario.lares.length) ? data.usuario.lares[0] : null;

                    if (!larSessao) {
                        // Primeira vez: vai direto para o onboarding passo a passo do Lar!
                        irParaOnboardingGoogle(data.usuario);
                    } else {
                        // Usuário já cadastrado com Lar: entra direto no sistema!
                        montarAmbienteLogado();
                        trocarTelaPrincipal('screen-app');
                    }
                } else {
                    seivaNotificar(data.error || 'Não foi possível validar o login com o Google.', 'erro', 'Google Auth');
                }
            } catch (err) {
                seivaNotificar('Erro de conexão com o servidor de autenticação.', 'erro', 'Falha de Conexão');
            }
        }

        async function _processarDadosGoogle(payload) {
            try {
                const res = await fetch('/api/auth/google', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();
                if (res.ok) {
                    fecharModalId('modalGoogleAuth');
                    usuarioSessao = data.usuario;
                    larSessao = (data.usuario.lares && data.usuario.lares.length) ? data.usuario.lares[0] : null;

                    if (!larSessao) {
                        // Primeira vez: vai direto para o onboarding passo a passo do Lar!
                        irParaOnboardingGoogle(data.usuario);
                    } else {
                        // Usuário já cadastrado com Lar: entra direto no sistema!
                        montarAmbienteLogado();
                        trocarTelaPrincipal('screen-app');
                    }
                } else {
                    seivaNotificar(data.error || 'Erro na autenticação com o Google.', 'erro', 'Google Auth');
                }
            } catch (err) {
                seivaNotificar('Erro de conexão ao comunicar com a API do Google.', 'erro', 'Falha de Conexão');
            }
        }

        // Pré-preenche o onboarding com os dados vindos do Google
        function _preencherOnboardingComDadosGoogle(usuario) {
            const campoNome = document.getElementById('regNome');
            const campoEmail = document.getElementById('regEmail');
            const campoSenha = document.getElementById('regSenha');
            const campoConf = document.getElementById('regSenhaConfirma');
            if (campoNome) campoNome.value = usuario.nome || '';
            if (campoEmail) { campoEmail.value = usuario.email || ''; campoEmail.readOnly = true; }
            // Senha gerada automaticamente (via Google não precisa de senha manual)
            const senhaAuto = 'google_' + Math.random().toString(36).slice(2, 10);
            if (campoSenha) campoSenha.value = senhaAuto;
            if (campoConf) campoConf.value = senhaAuto;
        }

        async function executarLogout() {
            await fetch('/api/logout', { method: 'POST' });
            usuarioSessao = null;
            larSessao = null;
            trocarTelaPrincipal('screen-login');
        }

        // ==========================================
        // AMBIENTE LOGADO (APP SHELL & SUB-TELAS)
        // ==========================================
        window._isCasalGlobal = false;

        function aplicarAvatarGlobal(avatarUrl, iniciais = 'SE') {
            const sideAv = document.getElementById('userAvatarSidebar');
            if (sideAv) {
                if (avatarUrl && avatarUrl.length > 5) {
                    sideAv.innerHTML = `<img src="${avatarUrl}" alt="Avatar" class="size-full rounded-full object-cover">`;
                } else {
                    sideAv.innerHTML = iniciais;
                }
            }

            const dashAv = document.getElementById('dashAvatar');
            if (dashAv) {
                if (avatarUrl && avatarUrl.length > 5) {
                    dashAv.innerHTML = `<img src="${avatarUrl}" alt="Avatar" class="size-full rounded-full object-cover">`;
                } else {
                    dashAv.innerHTML = iniciais;
                }
            }

            const avatarImg = document.getElementById('perfilAvatarImg');
            const avatarIniciais = document.getElementById('perfilAvatarIniciais');
            if (avatarImg && avatarIniciais) {
                if (avatarUrl && avatarUrl.length > 5) {
                    avatarImg.src = avatarUrl;
                    avatarImg.classList.remove('hidden');
                    avatarIniciais.classList.add('hidden');
                } else {
                    avatarImg.classList.add('hidden');
                    avatarIniciais.textContent = iniciais;
                    avatarIniciais.classList.remove('hidden');
                }
            }
        }

        function montarAmbienteLogado() {
            if (!usuarioSessao) return;
            const iniciais = usuarioSessao.iniciais || (usuarioSessao.nome ? usuarioSessao.nome.substring(0, 2).toUpperCase() : 'SE');
            const primeiroNome = usuarioSessao.nome ? usuarioSessao.nome.split(' ')[0] : 'Usuário';

            const elUserSide = document.getElementById('userNameSidebar');
            if (elUserSide) elUserSide.innerText = usuarioSessao.nome;

            aplicarAvatarGlobal(usuarioSessao.avatar, iniciais);

            const elDashGreet = document.getElementById('dashGreeting');
            if (elDashGreet) elDashGreet.innerText = `${getSaudacao()}, ${primeiroNome}`;

            const elPerfNome = document.getElementById('perfilNomeTxt');
            if (elPerfNome) elPerfNome.innerText = usuarioSessao.nome;

            const elPerfEmail = document.getElementById('perfilEmailTxt');
            if (elPerfEmail) elPerfEmail.innerText = usuarioSessao.email;

            const secaoLarSide = document.getElementById('secaoLarSidebar');
            const elLarPill = document.getElementById('userLarPillSidebar');
            if (larSessao) {
                window._isCasalGlobal = true;
                if (secaoLarSide) secaoLarSide.classList.remove('hidden');
                if (elLarPill) {
                    elLarPill.innerText = larSessao.nome;
                    elLarPill.className = 'mt-0.5 inline-flex items-center gap-1 rounded-full bg-accent px-2 py-0.5 text-[10px] font-semibold text-accent-foreground';
                }

                const elGrpLar = document.getElementById('labelGrupoLarSidebar');
                if (elGrpLar) elGrpLar.innerText = larSessao.nome;

                const elLarHead = document.getElementById('larHeaderTitle');
                if (elLarHead) elLarHead.innerText = larSessao.nome;
            } else {
                window._isCasalGlobal = false;
                if (secaoLarSide) secaoLarSide.classList.add('hidden');
                if (elLarPill) {
                    elLarPill.innerText = 'Individual';
                    elLarPill.className = 'mt-0.5 inline-flex items-center gap-1 rounded-full bg-muted px-2 py-0.5 text-[10px] font-semibold text-muted-foreground';
                }
            }

            carregarDashboardDados();
            carregarNotificacoesPopup();
            verificarConvitesPendentes();

            // Checar se a URL atual contém token de convite
            const pathSegments = window.location.pathname.split('/');
            const idxConvite = pathSegments.indexOf('convite');
            if (idxConvite !== -1 && pathSegments[idxConvite + 1]) {
                const tokenUrl = pathSegments[idxConvite + 1];
                fetch(`/api/convite/${tokenUrl}`)
                    .then(r => r.json())
                    .then(data => {
                        if (data && data.valido) {
                            abrirModalAceitarConvite({
                                token_convite: tokenUrl,
                                remetente: data.remetente,
                                lar: data.lar
                            });
                        }
                    })
                    .catch(() => {});
            }

            // Exibe o painel de boas-vindas ao entrar (respeitando "não mostrar hoje")
            setTimeout(() => abrirBoasVindas(), 700);
        }

        function trocarAbaApp(tabId) {
            document.querySelectorAll('.sub-screen').forEach(el => el.classList.add('hidden'));
            const target = document.getElementById(`pane-${tabId}`);
            if (target) target.classList.remove('hidden');

            // Ajuste do estado de bloqueio para abas do Lar
            const abasCasal = ['lar', 'acordos', 'cobrador'];
            if (abasCasal.includes(tabId)) {
                const cardSemLar = document.getElementById(`${tabId}CardBloqueioSemLar`);
                const conteudoCasal = document.getElementById(`${tabId}ConteudoCasal`);
                const isCasal = Boolean(window._isCasalGlobal);
                if (!isCasal) {
                    if (cardSemLar) cardSemLar.classList.remove('hidden');
                    if (conteudoCasal) conteudoCasal.classList.add('hidden');
                } else {
                    if (cardSemLar) cardSemLar.classList.add('hidden');
                    if (conteudoCasal) conteudoCasal.classList.remove('hidden');
                }
            }

            document.querySelectorAll('.nav-sidebar-item').forEach(btn => {
                if (btn.getAttribute('data-screen') === tabId) {
                    btn.className = "nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors bg-primary text-primary-foreground shadow-soft";
                } else {
                    btn.className = "nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground";
                }
            });

            if (tabId === 'dashboard') carregarDashboardDados();
            if (tabId === 'caixa-preta') inicializarOuCarregarCaixaPreta();
            if (tabId === 'transacoes') carregarExtratoDados();
            if (tabId === 'lar') carregarLarDados();
            if (tabId === 'acordos') carregarAcordosDados();
            if (tabId === 'metas') carregarMetasDados();
            if (tabId === 'cobrador') carregarCobradorDados();
            if (tabId === 'recebimentos') carregarRecebimentosDados();
            if (tabId === 'perfil') carregarPerfilDados();

            window.scrollTo({ top: 0, behavior: 'instant' });
            lucide.createIcons();
        }

        // Alias global para garantir navegação a partir de qualquer módulo ou componente
        window.navegarParaAba = trocarAbaApp;

        // --- DASHBOARD (OFICIAL DO PROTÓTIPO SEIVA) ---
        let heroAbaAtiva = 'renda';

        function alternarAbaHero(tipo) {
            heroAbaAtiva = tipo;
            const cardRenda = document.getElementById('cardHeroMinhaRenda');
            const cardLar = document.getElementById('cardHeroCustoLar');
            const tabRenda = document.getElementById('tabHeroMinhaRenda');
            const tabLar = document.getElementById('tabHeroCustoLar');
            const dotRenda = document.getElementById('sliderDotRenda');
            const dotLar = document.getElementById('sliderDotLar');
            const dicaTexto = document.getElementById('sliderTextoDica');

            if (tipo === 'renda') {
                if (cardRenda) cardRenda.classList.remove('hidden');
                if (cardLar) cardLar.classList.add('hidden');
                if (tabRenda) {
                    tabRenda.className = 'flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all bg-card text-foreground shadow-2xs';
                }
                if (tabLar) {
                    tabLar.className = 'flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all text-muted-foreground hover:text-foreground';
                }
                if (dotRenda) dotRenda.className = 'size-2 rounded-full bg-emerald-600 transition-all';
                if (dotLar) dotLar.className = 'size-2 rounded-full bg-muted transition-all';
                if (dicaTexto) dicaTexto.innerText = 'Arraste para o lado para ver o Custo do Lar';
            } else {
                if (cardRenda) cardRenda.classList.add('hidden');
                if (cardLar) cardLar.classList.remove('hidden');
                if (tabLar) {
                    tabLar.className = 'flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all bg-card text-foreground shadow-2xs';
                }
                if (tabRenda) {
                    tabRenda.className = 'flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all text-muted-foreground hover:text-foreground';
                }
                if (dotLar) dotLar.className = 'size-2 rounded-full bg-emerald-600 transition-all';
                if (dotRenda) dotRenda.className = 'size-2 rounded-full bg-muted transition-all';
                if (dicaTexto) dicaTexto.innerText = 'Arraste para o lado para ver a sua renda';
            }
            lucide.createIcons();
        }

        function alternarVisibilidadeSaldos() {
            saldosVisiveis = !saldosVisiveis;
            const btnLabel = document.getElementById('btnVisSaldosLabel');
            if (btnLabel) btnLabel.innerText = saldosVisiveis ? 'Ocultar' : 'Exibir';
            carregarDashboardDados();
        }

        let pedidoAjudaAtualId = null;

        async function recusarPedidoAjuda() {
            if (!pedidoAjudaAtualId) {
                document.getElementById('bannerPedidoAjuda')?.classList.add('hidden');
                return;
            }
            try {
                await fetch('/api/caixa-preta/responder-ajuda', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        id_cobranca: pedidoAjudaAtualId,
                        acao: 'recusar'
                    })
                });
                document.getElementById('bannerPedidoAjuda')?.classList.add('hidden');
                seivaNotificar('Pedido de ajuda arquivado.', 'info', 'Pedido de Ajuda');
                carregarDashboardDados();
                carregarNotificacoesPopup();
            } catch (e) {
                document.getElementById('bannerPedidoAjuda')?.classList.add('hidden');
            }
        }

        async function aceitarPedidoAjuda() {
            if (!pedidoAjudaAtualId) return;
            try {
                const res = await fetch('/api/caixa-preta/responder-ajuda', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        id_cobranca: pedidoAjudaAtualId,
                        acao: 'aceitar'
                    })
                });
                const data = await res.json();
                if (res.ok) {
                    document.getElementById('bannerPedidoAjuda')?.classList.add('hidden');
                    seivaNotificar(data.mensagem || 'Você acolheu o pedido de ajuda com sucesso!', 'sucesso', 'Ajuda Confirmada');
                    carregarDashboardDados();
                    carregarNotificacoesPopup();
                } else {
                    seivaNotificar(data.error || 'Não foi possível aceitar o pedido.', 'erro');
                }
            } catch (e) {
                console.error('Erro ao aceitar pedido:', e);
                seivaNotificar('Erro de conexão ao aceitar pedido de ajuda.', 'erro');
            }
        }

        function confirmarRegistroRapido(titulo, valor) {
            seivaNotificar(`Pagamento de ${titulo} (${BRL(valor)}) registrado com sucesso!`, 'sucesso', 'Registrado');
            setTimeout(carregarDashboardDados, 500);
        }

        async function carregarDashboardDados() {
            try {
                const res = await fetch('/api/dashboard', {
                    headers: { 'Accept': 'application/json' }
                });
                if (!res.ok) return;
                const data = await res.json();
                dashboardDadosCache = data;

                listaContas = data.contas || [];
                popularSelectsContas(listaContas);

                const isCasal = Boolean(data.is_casal && data.lar);

                // Badge de perfil ativo
                const badgePerfil = document.getElementById('dashBadgePerfilAtivo');
                if (badgePerfil) {
                    badgePerfil.innerText = `${data.usuario.nome} (${isCasal ? 'Casal · ' + data.lar.nome : 'Individual'})`;
                }

                // Avatar e saudação do cabeçalho
                const avatarEl = document.getElementById('dashAvatar');
                if (avatarEl) {
                    avatarEl.innerText = data.usuario.iniciais || 'DU';
                }

                const greetingEl = document.getElementById('dashGreeting');
                if (greetingEl) {
                    const primeiroNome = data.usuario.nome.split(' ')[0];
                    greetingEl.innerText = `${getSaudacao()}, ${primeiroNome}`;
                }

                const dateEl = document.getElementById('dashDateSub');
                if (dateEl) {
                    dateEl.innerText = data.hero_mes?.data_extenso || 'Hoje';
                }

                // 2. Banner de Pedido de Ajuda (Totalmente Integrado ao Banco)
                const bannerAjuda = document.getElementById('bannerPedidoAjuda');
                if (bannerAjuda) {
                    if (data.pedido_ajuda && data.pedido_ajuda.tem_pedido) {
                        bannerAjuda.classList.remove('hidden');
                        pedidoAjudaAtualId = data.pedido_ajuda.id_cobranca || null;

                        const tituloAjuda = document.getElementById('pedidoAjudaTitulo');
                        const descAjuda = document.getElementById('pedidoAjudaDesc');
                        const tempoAjuda = document.getElementById('pedidoAjudaTagTempo');
                        const badgeTexto = document.getElementById('pedidoAjudaBadgeTexto');
                        const acoesContainer = document.getElementById('pedidoAjudaAcoesContainer');

                        if (tempoAjuda) tempoAjuda.innerText = data.pedido_ajuda.tempo || 'recente';

                        if (data.pedido_ajuda.sou_autor) {
                            if (badgeTexto) badgeTexto.innerText = 'Pedido enviado por você';
                            if (tituloAjuda) {
                                tituloAjuda.innerHTML = `Você pediu uma ajuda de <span class="text-emerald-800 dark:text-emerald-400 font-black text-lg">${BRL(data.pedido_ajuda.valor)}</span> para ${data.pedido_ajuda.destinatario}`;
                            }
                            if (descAjuda) descAjuda.innerText = `${data.pedido_ajuda.motivo} (Aguardando resposta do seu parceiro)`;
                            if (acoesContainer) acoesContainer.innerHTML = `
                                <span class="px-3.5 py-2 rounded-xl bg-muted/60 text-muted-foreground text-xs font-bold border border-border flex items-center gap-1.5">
                                    <i data-lucide="clock" class="size-3.5"></i>
                                    <span>Aguardando resposta</span>
                                </span>
                            `;
                        } else {
                            if (badgeTexto) badgeTexto.innerText = 'Pedido de ajuda do parceiro';
                            if (tituloAjuda) {
                                tituloAjuda.innerHTML = `${data.pedido_ajuda.solicitante} precisa de uma ajuda de <span class="text-emerald-800 dark:text-emerald-400 font-black text-lg">${BRL(data.pedido_ajuda.valor)}</span>`;
                            }
                            if (descAjuda) descAjuda.innerText = data.pedido_ajuda.motivo;
                            if (acoesContainer) acoesContainer.innerHTML = `
                                <button type="button" onclick="recusarPedidoAjuda()" class="px-4 py-2 rounded-xl border border-border bg-card hover:bg-muted font-bold text-xs text-foreground transition shadow-2xs">
                                    ✕ Agora não
                                </button>
                                <button type="button" onclick="aceitarPedidoAjuda()" id="btnAjudarParceiro" class="px-5 py-2.5 rounded-xl bg-[#1b4d37] hover:bg-[#153f2c] text-white font-black text-xs transition shadow-soft flex items-center gap-2">
                                    <i data-lucide="check" class="size-4"></i>
                                    <span>Ajudar com ${BRL(data.pedido_ajuda.valor)}</span>
                                </button>
                            `;
                        }
                    } else {
                        bannerAjuda.classList.add('hidden');
                        pedidoAjudaAtualId = null;
                    }
                }

                // 3. Hero Card: Minha Renda
                const rendaValEl = document.getElementById('heroRendaValorPrincipal');
                if (rendaValEl) {
                    const v = data.hero_mes?.minha_renda?.recebido_mes ?? data.resumo.total_entradas;
                    rendaValEl.innerText = saldosVisiveis ? BRL(v) : 'R$ ••••••';
                }

                const rendaCompEl = document.getElementById('heroRendaComprometido');
                if (rendaCompEl) {
                    const c = data.hero_mes?.minha_renda?.comprometido ?? data.resumo.saldo_comprometido;
                    rendaCompEl.innerText = saldosVisiveis ? BRL(c) : '••••';
                }

                const rendaDevEl = document.getElementById('heroRendaAindaDevendo');
                if (rendaDevEl) {
                    const d = data.hero_mes?.minha_renda?.ainda_devendo ?? 0;
                    rendaDevEl.innerText = saldosVisiveis ? BRL(d) : '••••';
                }

                const dashSobraEl = document.getElementById('heroRendaSobraMes');
                if (dashSobraEl) {
                    const s = data.hero_mes?.minha_renda?.sobra_mes ?? data.resumo.saldo_livre;
                    dashSobraEl.innerText = saldosVisiveis ? BRL(s) : '••••';
                }

                // 3. Hero Card: Custo do Lar
                const larValEl = document.getElementById('heroLarValorPrincipal');
                if (larValEl) {
                    const lv = data.hero_mes?.custo_lar?.parte_no_lar ?? (data.lar?.total_despesas_mes || 0);
                    larValEl.innerText = saldosVisiveis ? BRL(lv) : 'R$ ••••••';
                }

                const larPctEl = document.getElementById('heroLarPillPercentual');
                if (larPctEl) {
                    larPctEl.innerText = `${data.hero_mes?.custo_lar?.percentual_lar || 50}% do Lar é seu`;
                }

                const larPagoEl = document.getElementById('heroLarJaPaguei');
                if (larPagoEl) {
                    const p = data.hero_mes?.custo_lar?.ja_paguei ?? 0;
                    larPagoEl.innerText = saldosVisiveis ? BRL(p) : '••••';
                }

                const larFaltaEl = document.getElementById('heroLarAindaFalta');
                if (larFaltaEl) {
                    const f = data.hero_mes?.custo_lar?.ainda_falta ?? 0;
                    larFaltaEl.innerText = saldosVisiveis ? BRL(f) : '••••';
                }

                const larCustoTotalEl = document.getElementById('heroLarCustoTotal');
                if (larCustoTotalEl) {
                    const ct = data.hero_mes?.custo_lar?.custo_total_lar ?? (data.lar?.total_despesas_mes || 0);
                    larCustoTotalEl.innerText = saldosVisiveis ? BRL(ct) : '••••';
                }

                // 5. Onde está meu dinheiro
                const ondeTotalEl = document.getElementById('ondeTotalTodasContas');
                if (ondeTotalEl) {
                    const tot = data.onde_esta_meu_dinheiro?.somando_todas ?? data.resumo.saldo_total;
                    ondeTotalEl.innerText = saldosVisiveis ? BRL(tot) : 'R$ ••••••';
                }

                const ondeDonoEl = document.getElementById('ondeJaTemDono');
                if (ondeDonoEl) {
                    const d = data.onde_esta_meu_dinheiro?.ja_tem_dono ?? data.resumo.saldo_comprometido;
                    ondeDonoEl.innerText = saldosVisiveis ? BRL(d) : '••••';
                }

                const ondeLivreEl = document.getElementById('ondeLivrePraGastar');
                if (ondeLivreEl) {
                    const l = data.onde_esta_meu_dinheiro?.livre_pra_gastar ?? data.resumo.saldo_livre;
                    ondeLivreEl.innerText = saldosVisiveis ? BRL(l) : '••••';
                }

                // Lista de Contas Ricas (Protótipo Image 4)
                const contList = document.getElementById('dashContasList');
                if (contList) {
                    const contasExibir = data.onde_esta_meu_dinheiro?.contas_detalhadas || listaContas;
                    if (!contasExibir.length) {
                        contList.innerHTML = '<p class="text-xs text-muted-foreground py-4 text-center col-span-full">Nenhuma conta cadastrada.</p>';
                    } else {
                        contList.innerHTML = contasExibir.map(c => `
                            <div class="p-4 rounded-3xl border border-border bg-card shadow-card space-y-3 hover:border-emerald-500/30 transition">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2.5">
                                        <span class="size-8 rounded-xl flex items-center justify-center font-bold text-xs" style="background-color: ${c.cor || '#10b981'}20; color: ${c.cor || '#10b981'}">
                                            <i data-lucide="${c.icone || 'wallet'}" class="size-4"></i>
                                        </span>
                                        <h4 class="text-xs font-bold text-foreground">${c.nome}</h4>
                                    </div>
                                    <span class="rounded-full bg-emerald-50 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 px-2 py-0.5 text-[10px] font-bold border border-emerald-200/50">
                                        ${c.tipo || c.badge || 'Dia a dia'}
                                    </span>
                                </div>
                                <div class="space-y-0.5">
                                    <strong class="text-lg font-black tracking-tight text-foreground block">
                                        ${saldosVisiveis ? BRL(c.saldo) : '••••'}
                                    </strong>
                                    ${c.livre !== null && c.livre !== undefined ? `
                                        <div class="flex items-center justify-between text-[11px] pt-1">
                                            <span class="text-muted-foreground">Livre</span>
                                            <span class="font-bold text-emerald-600">${saldosVisiveis ? BRL(c.livre) : '••••'}</span>
                                        </div>
                                    ` : ''}
                                    ${c.fatura ? `
                                        <div class="flex items-center justify-between text-[11px]">
                                            <span class="text-muted-foreground">Fatura a pagar</span>
                                            <span class="font-bold text-rose-600">${saldosVisiveis ? BRL(c.fatura) : '••••'}</span>
                                        </div>
                                    ` : ''}
                                </div>
                                <div class="flex items-center justify-between pt-1 border-t border-border/50 text-[10px] text-muted-foreground">
                                    <span>${c.atualizado || 'Atualizado hoje'}</span>
                                    <div class="flex items-center gap-2">
                                        <button type="button" onclick="abrirModalEditarConta(${JSON.stringify(c).replace(/"/g, '&quot;')})" class="text-foreground hover:text-emerald-700 dark:hover:text-emerald-400 font-bold flex items-center gap-1 transition" title="Editar conta">
                                            <i data-lucide="edit-3" class="size-3"></i> Editar
                                        </button>
                                        <button type="button" onclick="abrirModalAtualizarSaldo('${c.id_conta}')" class="text-emerald-700 dark:text-emerald-400 font-bold hover:underline flex items-center gap-1">
                                            <i data-lucide="refresh-cw" class="size-3"></i> Saldo
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `).join('');
                    }
                }

                // 9. Quatro Indicadores Rápidos (Image 6)
                const indEntradas = document.getElementById('indicadorEntradas');
                if (indEntradas) indEntradas.innerText = saldosVisiveis ? BRL(data.indicadores?.entradas_mes || data.resumo.total_entradas) : '••••';

                const indSaidas = document.getElementById('indicadorSaidas');
                if (indSaidas) indSaidas.innerText = saldosVisiveis ? BRL(data.indicadores?.saidas_mes || data.resumo.total_saidas) : '••••';

                const indLivre = document.getElementById('indicadorLivre');
                if (indLivre) indLivre.innerText = saldosVisiveis ? BRL(data.indicadores?.livre_gastar || data.resumo.saldo_livre) : '••••';

                const indPoupanca = document.getElementById('indicadorPoupanca');
                if (indPoupanca) indPoupanca.innerText = saldosVisiveis ? BRL(data.indicadores?.reserva_poupanca || 0) : '••••';

                // 12. Atividade Recente (Sem emojis, ícones Lucide mapeados e personalização)
                const atividadeList = document.getElementById('dashAtividadeRecenteList');
                if (atividadeList) {
                    const itens = data.atividades || [
                        { id_transacao: null, titulo: 'Salário Florais Design', sub: '05/06 · Nubank', categoria: 'Trabalho', valor: 1500, tipo: 'entrada', icone: 'briefcase', categoria_cor: '#10b981' },
                        { id_transacao: null, titulo: 'Sephora', sub: 'Hoje · Nubank', categoria: 'Beleza', valor: -187, tipo: 'saida', icone: 'sparkles', categoria_cor: '#ec4899' },
                        { id_transacao: null, titulo: 'Rappi', sub: 'Ontem · Nubank', categoria: 'Alimentação', valor: -67.4, tipo: 'saida', icone: 'utensils', categoria_cor: '#f97316' },
                        { id_transacao: null, titulo: 'Academia Bio Ritmo', sub: 'Ontem · Nubank', categoria: 'Saúde', valor: -119.9, tipo: 'saida', icone: 'activity', categoria_cor: '#ef4444' }
                    ];

                    atividadeList.innerHTML = itens.map(item => {
                        const iconeFinal = item.icone || 'credit-card';
                        const corFinal = item.categoria_cor || '#10b981';
                        const safeTitulo = (item.titulo || 'Despesa').replace(/'/g, "\\'");
                        const txId = item.id_transacao || '';
                        const catId = item.categoria_id || '';

                        return `
                        <div class="flex items-center justify-between p-3 sm:p-4 hover:bg-muted/30 transition rounded-2xl group">
                            <div class="flex items-center gap-3 min-w-0">
                                <span class="size-10 rounded-2xl flex items-center justify-center shrink-0 border border-border/40 shadow-2xs" style="background-color: ${corFinal}18; color: ${corFinal}">
                                    <i data-lucide="${iconeFinal}" class="size-4"></i>
                                </span>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-xs font-bold text-foreground truncate max-w-[140px] sm:max-w-xs">${item.titulo}</h4>
                                        ${txId ? `
                                        <button type="button" onclick="abrirModalPersonalizarIcone('${txId}', '${safeTitulo}', '${catId}', '${iconeFinal}')" 
                                                class="opacity-0 group-hover:opacity-100 transition size-5 rounded-md text-muted-foreground hover:text-foreground hover:bg-muted flex items-center justify-center shrink-0" 
                                                title="Alterar ícone ou categoria">
                                            <i data-lucide="edit-3" class="size-3"></i>
                                        </button>
                                        ` : ''}
                                    </div>
                                    <div class="flex items-center gap-1.5 flex-wrap pt-0.5">
                                        <p class="text-[11px] text-muted-foreground truncate max-w-[160px]">${item.sub}</p>
                                        ${item.categoria ? `<span class="text-[9px] px-1.5 py-0.5 rounded-full font-bold border border-border/60" style="background-color: ${corFinal}12; color: ${corFinal}">${item.categoria}</span>` : ''}
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 pl-2 shrink-0">
                                <span class="text-xs sm:text-sm font-black ${item.valor > 0 ? 'text-emerald-600' : 'text-foreground'}">
                                    ${item.valor > 0 ? '+ ' : ''}${saldosVisiveis ? BRL(Math.abs(item.valor)) : '••••'}
                                </span>
                                ${txId ? `
                                <div class="flex items-center gap-1">
                                    <button type="button" onclick="abrirModalEditarTransacao(${JSON.stringify(item).replace(/"/g, '&quot;')})" 
                                            class="size-6 rounded-md border border-border bg-card hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition shadow-2xs" title="Editar transação">
                                        <i data-lucide="edit-3" class="size-2.5"></i>
                                    </button>
                                    <button type="button" onclick="excluirTransacaoDireto('${txId}', '${safeTitulo}')" 
                                            class="size-6 rounded-md border border-rose-300 dark:border-rose-900 bg-rose-50/40 dark:bg-rose-950/20 hover:bg-rose-100 text-rose-600 flex items-center justify-center transition shadow-2xs" title="Excluir transação">
                                        <i data-lucide="trash-2" class="size-2.5"></i>
                                    </button>
                                </div>
                                ` : ''}
                            </div>
                        </div>`;
                    }).join('');
                }

                lucide.createIcons();

                // Renderiza seções dinâmicas (metas, despesas, fluxo, saúde, casal vs individual)
                renderizarSecoesDinamicasDashboard(data);

            } catch (e) {
                console.error('Erro ao carregar dashboard:', e);
            }
        }

        // ALTERNÂNCIA RÁPIDA DE USUÁRIO PARA TESTES (DUDA, IAN, VICTOR HUGO)
        async function trocarUsuarioRapido(email) {
            try {
                seivaNotificar(`Acessando perfil de ${email}...`, 'info', 'Alternando Ambiente');
                let res = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ email: email, senha: '123456' })
                });

                if (!res.ok) {
                    res = await fetch('/api/login', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ email: email, senha: 'password' })
                    });
                }

                const data = await res.json();
                if (res.ok && data.usuario) {
                    usuarioSessao = data.usuario;
                    larSessao = (data.usuario.lares && data.usuario.lares.length) ? data.usuario.lares[0] : null;
                    trocarTelaPrincipal('screen-app');
                    montarAmbienteLogado();
                    trocarAbaApp('dashboard');
                    seivaNotificar(`Ambiente atualizado para ${data.usuario.nome}!`, 'sucesso', 'Conectado');
                } else {
                    seivaNotificar(data.error || 'Não foi possível alternar de usuário.', 'erro');
                }
            } catch (err) {
                console.error('Erro ao alternar perfil:', err);
                seivaNotificar('Erro de conexão ao alternar perfil de teste.', 'erro');
            }
        }

        function alternarVisibilidadeSaldos() {
            saldosVisiveis = !saldosVisiveis;
            const btn = document.getElementById('btnVisSaldos');
            btn.innerHTML = saldosVisiveis ? '<i data-lucide="eye" class="size-4"></i>' : '<i data-lucide="eye-off" class="size-4"></i>';
            carregarDashboardDados();
            lucide.createIcons();
        }

        // --- TRANSAÇÕES ---
        // Estado dos filtros ativos
        let txPeriodoAtivo = 'mes';
        let txCategoriaAtiva = '';
        let txContaAtiva = '';
        let txBuscaAtiva = '';
        let txLarQuemAtivo = 'todos';
        let txDadosCache = [];
        let txsLarCache = [];

        async function carregarExtratoDados() {
            try {
                const params = new URLSearchParams();
                if (txPeriodoAtivo) params.set('periodo', txPeriodoAtivo);
                if (txCategoriaAtiva) params.set('categoria', txCategoriaAtiva);
                if (txContaAtiva) params.set('conta_id', txContaAtiva);

                const res = await fetch(`/api/transacoes?${params.toString()}`);
                if (!res.ok) return;
                const txs = await res.json();
                txDadosCache = txs;

                // Popular chips de conta e categorias dinamicamente
                _popularChipsContaTransacoes();
                _popularChipsCategoriaTransacoes();

                // Resumos
                const entradas = txs.filter(t => t.tipo === 'entrada').reduce((s, t) => s + parseFloat(t.valor), 0);
                const saidas   = txs.filter(t => t.tipo === 'saida').reduce((s, t) => s + parseFloat(t.valor), 0);
                const saldo    = entradas - saidas;

                const elEntradas = document.getElementById('txResumoEntradas');
                const elSaidas   = document.getElementById('txResumoSaidas');
                const elSaldo    = document.getElementById('txResumoSaldo');
                if (elEntradas) elEntradas.textContent = BRL(entradas);
                if (elSaidas)   elSaidas.textContent   = BRL(saidas);
                if (elSaldo) {
                    elSaldo.textContent = (saldo < 0 ? '-' : '') + BRL(Math.abs(saldo));
                    elSaldo.className = `text-sm font-extrabold ${saldo < 0 ? 'text-rose-600' : 'text-emerald-600'}`;
                }

                _renderizarListaAgrupada(txs);
            } catch (e) { console.error('Erro ao carregar transações:', e); }
        }

        function _popularChipsContaTransacoes() {
            const contas = dashboardDadosCache?.contas || listaContas || [];
            const container = document.getElementById('txChipsConta') || document.getElementById('txChipContasDinamicas');
            if (!container || !contas.length) return;
            container.innerHTML = `
                <button onclick="filtrarTransacoesConta('', this)"
                        class="tx-conta-chip flex-shrink-0 flex items-center gap-1.5 px-3.5 py-1.5 rounded-full border ${!txContaAtiva ? 'border-primary bg-primary text-primary-foreground' : 'border-border bg-card text-muted-foreground hover:text-foreground'} text-xs font-bold transition">
                    Todas
                </button>
            ` + contas.map(c => `
                <button onclick="filtrarTransacoesConta('${c.id_conta}', this)"
                        data-conta="${c.id_conta}"
                        class="tx-conta-chip flex-shrink-0 flex items-center gap-1.5 px-3.5 py-1.5 rounded-full border ${String(txContaAtiva) === String(c.id_conta) ? 'border-primary bg-primary text-primary-foreground' : 'border-border bg-card text-muted-foreground hover:text-foreground'} text-xs font-bold transition">
                    <span class="size-2 rounded-full" style="background-color:${c.cor || '#10b981'}"></span>
                    ${c.nome}
                </button>
            `).join('');
        }

        function _popularChipsCategoriaTransacoes() {
            const container = document.getElementById('txChipsCategoria');
            if (!container) return;
            const categorias = [
                { nome: 'Moradia', icone: 'home' },
                { nome: 'Alimentação', icone: 'utensils' },
                { nome: 'Transporte', icone: 'car' },
                { nome: 'Saúde', icone: 'pill' },
                { nome: 'Lazer', icone: 'film' },
                { nome: 'Mercado', icone: 'shopping-cart' },
                { nome: 'Beleza', icone: 'sparkles' },
                { nome: 'Presente', icone: 'gift' },
                { nome: 'Salário', icone: 'briefcase' },
            ];

            container.innerHTML = `
                <button onclick="filtrarTransacoesCategoria('', this)"
                        class="tx-cat-chip inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold transition ${!txCategoriaAtiva ? 'bg-primary text-primary-foreground shadow-soft' : 'border border-border bg-card text-muted-foreground hover:text-foreground'}"
                        data-cat="">
                    Todos
                </button>
            ` + categorias.map(c => `
                <button onclick="filtrarTransacoesCategoria('${c.nome}', this)"
                        data-cat="${c.nome}"
                        class="tx-cat-chip inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold transition ${txCategoriaAtiva === c.nome ? 'bg-primary text-primary-foreground shadow-soft' : 'border border-border bg-card text-muted-foreground hover:text-foreground'}">
                    <i data-lucide="${c.icone}" class="size-3.5"></i>
                    <span>${c.nome}</span>
                </button>
            `).join('');
            lucide.createIcons();
        }

        // Funções de Filtro de Transações (Extrato / Relatório)
        function filtrarTransacoesPeriodo(periodo, btn) {
            txPeriodoAtivo = periodo;
            document.querySelectorAll('.tx-periodo-btn').forEach(b => {
                b.className = 'tx-periodo-btn py-2.5 rounded-2xl border border-border bg-card text-xs font-semibold text-muted-foreground hover:text-foreground hover:border-primary/40 transition shadow-2xs cursor-pointer';
            });
            if (btn) {
                btn.className = 'tx-periodo-btn py-2.5 rounded-2xl bg-primary text-primary-foreground text-xs font-extrabold shadow-soft cursor-pointer';
            }
            carregarExtratoDados();
        }

        function filtrarTransacoesConta(contaId, btn) {
            txContaAtiva = contaId;
            document.querySelectorAll('.tx-conta-chip').forEach(b => {
                b.className = 'tx-conta-chip flex-shrink-0 flex items-center gap-1.5 px-3.5 py-1.5 rounded-full border border-border bg-card text-muted-foreground hover:text-foreground text-xs font-bold transition cursor-pointer';
            });
            if (btn) {
                btn.className = 'tx-conta-chip flex-shrink-0 flex items-center gap-1.5 px-3.5 py-1.5 rounded-full border border-primary bg-primary text-primary-foreground text-xs font-bold transition cursor-pointer';
            }
            carregarExtratoDados();
        }

        function filtrarTransacoesCategoria(catNome, btn) {
            txCategoriaAtiva = catNome;
            document.querySelectorAll('.tx-cat-chip').forEach(b => {
                b.className = 'tx-cat-chip inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold transition border border-border bg-card text-muted-foreground hover:text-foreground cursor-pointer';
            });
            if (btn) {
                btn.className = 'tx-cat-chip inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold transition bg-primary text-primary-foreground shadow-soft cursor-pointer';
            }
            carregarExtratoDados();
        }

        function buscarTransacoes(termo) {
            txBuscaAtiva = termo;
            _renderizarListaAgrupada(txDadosCache);
        }

        // Formatador Universal de Datas do SEIVA (Impedir "Invalid Date")
        function formatarDataTransacaoBR(dataRaw, formato = 'curto') {
            if (!dataRaw) return 'Hoje';
            let ano, mes, dia;
            if (typeof dataRaw === 'string') {
                const m = dataRaw.match(/^(\d{4})-(\d{2})-(\d{2})/);
                if (m) {
                    ano = parseInt(m[1], 10);
                    mes = parseInt(m[2], 10) - 1;
                    dia = parseInt(m[3], 10);
                } else if (dataRaw.includes('/')) {
                    const partes = dataRaw.split('/');
                    if (partes.length === 3) {
                        dia = parseInt(partes[0], 10);
                        mes = parseInt(partes[1], 10) - 1;
                        ano = parseInt(partes[2], 10);
                    }
                }
            } else if (dataRaw instanceof Date && !isNaN(dataRaw.getTime())) {
                ano = dataRaw.getFullYear();
                mes = dataRaw.getMonth();
                dia = dataRaw.getDate();
            }

            const d = (ano !== undefined) ? new Date(ano, mes, dia, 12, 0, 0) : new Date(dataRaw);
            if (isNaN(d.getTime())) return 'Hoje';

            const hoje = new Date(); hoje.setHours(0,0,0,0);
            const ontem = new Date(hoje); ontem.setDate(ontem.getDate() - 1);
            const dZ = new Date(d); dZ.setHours(0,0,0,0);

            if (formato === 'label') {
                if (dZ.getTime() === hoje.getTime()) return 'HOJE';
                if (dZ.getTime() === ontem.getTime()) return 'ONTEM';
                return d.toLocaleDateString('pt-BR', { weekday: 'long', day: '2-digit', month: 'long' }).toUpperCase();
            }
            return d.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit' });
        }

        function _renderizarListaAgrupada(txs) {
            const cont = document.getElementById('txListaAgrupada');
            if (!cont) return;

            // Aplica filtro de busca local
            let lista = txs || [];
            if (txBuscaAtiva) {
                const q = txBuscaAtiva.toLowerCase();
                lista = lista.filter(t =>
                    (t.titulo || '').toLowerCase().includes(q) ||
                    (t.categoria?.nome || '').toLowerCase().includes(q) ||
                    (t.conta?.nome || '').toLowerCase().includes(q)
                );
            }

            if (!lista.length) {
                cont.innerHTML = `
                    <div class="rounded-3xl border border-border bg-card p-8 shadow-card text-center">
                        <i data-lucide="inbox" class="size-8 text-muted-foreground mx-auto mb-2"></i>
                        <p class="text-xs text-muted-foreground">Nenhuma transação encontrada.</p>
                    </div>`;
                lucide.createIcons();
                return;
            }

            // Agrupar por data (HOJE, ONTEM, ou formatada sem Invalid Date)
            const grupos = {};
            lista.forEach(t => {
                const label = formatarDataTransacaoBR(t.data, 'label') || 'RECENTES';
                if (!grupos[label]) grupos[label] = [];
                grupos[label].push(t);
            });

            cont.innerHTML = Object.entries(grupos).map(([label, itens]) => `
                <div class="rounded-3xl border border-border bg-card shadow-card overflow-hidden">
                    <div class="px-4 py-2.5 border-b border-border bg-muted/40">
                        <span class="text-[10px] font-black text-muted-foreground tracking-widest">${label}</span>
                    </div>
                    <div class="divide-y divide-border/60">
                        ${itens.map(t => _renderItemTransacao(t)).join('')}
                    </div>
                </div>
            `).join('');

            lucide.createIcons();
        }

        function obterIconeTransacao(t) {
            if (t.icone && t.icone.length > 1 && !/[\uD83C-\uDBFF\uDC00-\uDFFF]/.test(t.icone)) return t.icone;
            if (t.tipo === 'entrada') return 'trending-up';
            const tit = (t.titulo || '').toLowerCase();
            const cat = (t.categoria?.nome || '').toLowerCase();
            if (tit.includes('sephora') || tit.includes('beleza') || cat.includes('beleza')) return 'sparkles';
            if (tit.includes('ifood') || tit.includes('restaurante') || tit.includes('lanche') || cat.includes('aliment')) return 'utensils';
            if (tit.includes('luz') || tit.includes('energia') || tit.includes('enel') || tit.includes('coelba')) return 'zap';
            if (tit.includes('água') || tit.includes('agua') || tit.includes('embasa') || tit.includes('sabesp')) return 'droplet';
            if (tit.includes('mercado') || tit.includes('supermercado') || cat.includes('mercado')) return 'shopping-cart';
            if (tit.includes('aluguel') || tit.includes('condom') || tit.includes('casa') || cat.includes('morad')) return 'home';
            if (tit.includes('uber') || tit.includes('gasolina') || tit.includes('combustivel') || cat.includes('transp')) return 'car';
            if (tit.includes('farmacia') || tit.includes('remedio') || cat.includes('saude') || cat.includes('saúde')) return 'pill';
            if (tit.includes('cinema') || tit.includes('show') || cat.includes('lazer')) return 'film';
            if (tit.includes('presente') || cat.includes('presente')) return 'gift';
            if (tit.includes('internet') || tit.includes('vivo') || tit.includes('claro')) return 'wifi';
            return 'receipt';
        }

        function _renderItemTransacao(t) {
            const isEntrada = t.tipo === 'entrada';
            const iconeNome = obterIconeTransacao(t);
            const contaNome = t.conta?.nome || '';
            const catNome   = t.categoria?.nome || '';
            const dataFmt   = formatarDataTransacaoBR(t.data, 'curto');
            const tJsonStr  = JSON.stringify(t).replace(/"/g, '&quot;');

            let badge = '';
            if (t.visibilidade === 'pessoal') {
                badge = `<span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-muted text-muted-foreground text-[9px] font-bold">
                            <i data-lucide="lock" class="size-2.5"></i> Privado
                         </span>`;
            } else if (t.visibilidade === 'compartilhado' || t.visibilidade === 'lar') {
                badge = `<span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 text-[9px] font-bold">
                            <i data-lucide="users" class="size-2.5"></i> Compartilhado
                         </span>`;
            }

            if (t.is_imprevisto) {
                badge += ` <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-amber-500/10 text-amber-600 dark:text-amber-400 text-[9px] font-bold border border-amber-500/20">
                            <i data-lucide="alert-triangle" class="size-2.5"></i> Imprevisto
                         </span>`;
            }

            const sub = [dataFmt, contaNome].filter(Boolean).join(' · ');

            return `
                <div class="flex items-center justify-between px-4 py-3 hover:bg-muted/30 transition">
                    <div class="flex items-center gap-3 min-w-0">
                        <span class="size-10 rounded-2xl ${isEntrada ? 'bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-300' : 'bg-muted/70 text-foreground'} flex items-center justify-center shrink-0 border border-border/50">
                            <i data-lucide="${iconeNome}" class="size-5"></i>
                        </span>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold text-foreground truncate">${t.titulo}</p>
                            <div class="flex items-center flex-wrap gap-1.5 mt-0.5">
                                <span class="text-[10px] text-muted-foreground">${sub}</span>
                                ${catNome ? `<span class="text-[9px] px-1.5 py-0.5 rounded-full bg-muted text-muted-foreground font-medium">${catNome}</span>` : ''}
                                ${badge}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2.5 shrink-0 ml-3">
                        <span class="text-xs font-black ${isEntrada ? 'text-emerald-600' : 'text-foreground'}">
                            ${isEntrada ? '+' : '-'} ${BRL(t.valor)}
                        </span>
                        <div class="flex items-center gap-1">
                            <button type="button" onclick="abrirModalEditarTransacao(${tJsonStr})" 
                                    title="Editar transação"
                                    class="size-7 rounded-lg border border-border bg-card hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition shadow-2xs">
                                <i data-lucide="edit-3" class="size-3"></i>
                            </button>
                            <button type="button" onclick="excluirTransacaoDireto(${t.id_transacao}, '${(t.titulo || '').replace(/'/g, "\\'")}')" 
                                    title="Excluir transação"
                                    class="size-7 rounded-lg border border-rose-300 dark:border-rose-900 bg-rose-50/40 dark:bg-rose-950/20 hover:bg-rose-100 text-rose-600 flex items-center justify-center transition shadow-2xs">
                                <i data-lucide="trash-2" class="size-3"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
        }

        // ── CRUD DE TRANSAÇÕES: EDIÇÃO E EXCLUSÃO COMPLETA (RF003) ──
        function abrirModalEditarTransacao(t) {
            if (!t) return;
            const id = t.id_transacao || t.id;
            const titulo = t.titulo || '';
            const valor = t.valor || 0;
            const tipo = t.tipo || 'saida';
            const catNome = t.categoria?.nome || '';
            const catId = t.categoria_id || '';
            const contaId = t.conta_id || '';
            const dataVal = t.data ? t.data.split('T')[0] : new Date().toISOString().split('T')[0];
            const vis = t.visibilidade || 'pessoal';

            document.getElementById('editTxId').value = id;
            document.getElementById('editTxTitulo').value = titulo;
            document.getElementById('editTxValor').value = valor;
            document.getElementById('editTxData').value = dataVal;
            document.getElementById('editTxTipo').value = tipo;
            document.getElementById('editTxCategoriaNome').value = catNome;
            document.getElementById('editTxCategoriaId').value = catId;
            document.getElementById('editTxVisibilidade').value = vis;

            // Popular select de contas bancárias
            const selConta = document.getElementById('editTxContaId');
            if (selConta && listaContas) {
                selConta.innerHTML = listaContas.map(c => `
                    <option value="${c.id_conta}" ${c.id_conta == contaId ? 'selected' : ''}>${c.nome} (${c.tipo})</option>
                `).join('');
            }

            // Sincronizar botões de tipo
            selecionarEditTipoTransacao(tipo);

            // Sincronizar chips de categoria
            document.querySelectorAll('.chip-edit-cat-tx').forEach(b => {
                b.className = 'chip-edit-cat-tx flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition';
            });
            if (catNome) {
                const btnCat = Array.from(document.querySelectorAll('.chip-edit-cat-tx')).find(b => b.innerText.includes(catNome));
                if (btnCat) {
                    btnCat.className = 'chip-edit-cat-tx active flex items-center gap-1.5 px-3 py-1.5 rounded-xl border-2 border-emerald-600 bg-emerald-800 text-white font-bold text-xs transition';
                }
            }

            // Sincronizar visibilidade
            selecionarEditVisibilidadeTx(vis);

            abrirModalId('modalEditarTransacao');
            lucide.createIcons();
        }

        function selecionarEditTipoTransacao(tipo) {
            document.getElementById('editTxTipo').value = tipo;
            const btnSaida = document.getElementById('editTxBtnTipoSaida');
            const btnEntrada = document.getElementById('editTxBtnTipoEntrada');
            if (tipo === 'entrada') {
                if (btnEntrada) btnEntrada.className = 'w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all bg-card text-foreground shadow-2xs border border-border/50';
                if (btnSaida) btnSaida.className = 'w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all text-muted-foreground hover:text-foreground';
            } else {
                if (btnSaida) btnSaida.className = 'w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all bg-card text-foreground shadow-2xs border border-border/50';
                if (btnEntrada) btnEntrada.className = 'w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all text-muted-foreground hover:text-foreground';
            }
        }

        function selecionarEditCategoriaTx(btn, nome, icone) {
            document.querySelectorAll('.chip-edit-cat-tx').forEach(b => {
                b.className = 'chip-edit-cat-tx flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition';
            });
            if (btn) {
                btn.className = 'chip-edit-cat-tx active flex items-center gap-1.5 px-3 py-1.5 rounded-xl border-2 border-emerald-600 bg-emerald-800 text-white font-bold text-xs transition';
            }
            document.getElementById('editTxCategoriaNome').value = nome;
        }

        function selecionarEditVisibilidadeTx(vis) {
            document.getElementById('editTxVisibilidade').value = vis;
            const btnPriv = document.getElementById('editTxBtnPrivado');
            const btnComp = document.getElementById('editTxBtnCompartilhado');
            if (vis === 'compartilhado' || vis === 'lar') {
                if (btnComp) btnComp.className = 'w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all bg-card text-foreground shadow-2xs border border-border/50';
                if (btnPriv) btnPriv.className = 'w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all text-muted-foreground hover:text-foreground';
            } else {
                if (btnPriv) btnPriv.className = 'w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all bg-card text-foreground shadow-2xs border border-border/50';
                if (btnComp) btnComp.className = 'w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl font-bold text-xs transition-all text-muted-foreground hover:text-foreground';
            }
        }

        async function executarSalvarEdicaoTransacao(event) {
            if (event) event.preventDefault();
            const id = document.getElementById('editTxId').value;
            const titulo = document.getElementById('editTxTitulo').value.trim();
            const valor = parseFloat(document.getElementById('editTxValor').value || 0);
            const tipo = document.getElementById('editTxTipo').value;
            const conta_id = document.getElementById('editTxContaId').value;
            const categoria_nome = document.getElementById('editTxCategoriaNome').value;
            const categoria_id = document.getElementById('editTxCategoriaId').value || null;
            const dataVal = document.getElementById('editTxData').value;
            const visibilidade = document.getElementById('editTxVisibilidade').value;

            if (!titulo || !valor || valor <= 0) {
                return seivaNotificar('Informe uma descrição e valor válido para a transação.', 'aviso');
            }

            try {
                const res = await fetch(`/api/transacoes/${id}/atualizar`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        titulo,
                        valor,
                        tipo,
                        conta_id,
                        categoria_nome,
                        categoria_id,
                        data: dataVal,
                        visibilidade
                    })
                });

                if (res.ok) {
                    fecharModalId('modalEditarTransacao');
                    seivaNotificar(`Transação "${titulo}" atualizada com sucesso!`, 'sucesso', 'Transação Atualizada');
                    carregarTransacoesDados();
                    carregarDashboardDados();
                    carregarTransacoesLar();
                } else {
                    const err = await res.json();
                    seivaNotificar(err.message || 'Erro ao atualizar transação.', 'aviso');
                }
            } catch (e) {
                console.error(e);
                seivaNotificar('Erro de conexão ao salvar transação.', 'erro');
            }
        }

        async function executarExcluirTransacaoModal() {
            const id = document.getElementById('editTxId')?.value;
            const titulo = document.getElementById('editTxTitulo')?.value || 'este lançamento';
            const visibilidade = document.getElementById('editTxVisibilidade')?.value || 'privado';
            if (!id) return fecharModalId('modalEditarTransacao');

            const titLower = (titulo || '').toLowerCase();
            const isCasal = visibilidade === 'compartilhado' || visibilidade === 'lar' || titLower.includes('ajuda') || titLower.includes('ian') || titLower.includes('duda') || titLower.includes('lar');

            const confirmou = await seivaConfirm({
                titulo: isCasal ? 'Estornar lançamento do casal?' : 'Remover lançamento?',
                mensagem: `Deseja realmente remover o lançamento "${titulo}"?`,
                badge: isCasal 
                    ? { texto: 'Transação do Casal (Mútua)', tipo: 'casal' } 
                    : { texto: 'Lançamento Pessoal', tipo: 'pessoal' },
                impacto: isCasal ? {
                    titulo: 'Transparência Bilateral Protegida',
                    texto: 'Este lançamento envolve ajuda mútua ou rateio com o parceiro. Para proteger a relação e evitar conflitos, ele não sumirá no vácuo: o saldo será estornado e a auditoria ficará registrada no Histórico do Lar com data, valor e motivo.'
                } : {
                    titulo: 'Impacto no Saldo da Conta',
                    texto: 'O saldo da conta bancária será revertido e a exclusão ficará gravada no seu Histórico de Auditoria.'
                },
                tipo: 'perigo',
                icone: isCasal ? 'shield-alert' : 'trash-2',
                confirmText: isCasal ? 'Estornar & Registrar Auditoria' : 'Remover & Reverter Saldo',
                cancelText: 'Cancelar (Manter Seguro)'
            });
            if (!confirmou) return;

            try {
                const res = await fetch(`/api/transacoes/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                if (res.ok) {
                    fecharModalId('modalEditarTransacao');
                    seivaNotificar(isCasal ? 'Lançamento estornado e registrado na auditoria do casal!' : 'Transação excluída e saldo bancário restaurado!', 'sucesso', isCasal ? 'Estorno Mútuo Concluído' : 'Transação Removida');
                    carregarTransacoesDados();
                    carregarDashboardDados();
                    carregarTransacoesLar();
                } else {
                    const err = await res.json().catch(() => ({}));
                    seivaNotificar(err.mensagem || err.error || 'Não foi possível excluir a transação.', 'aviso');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão ao excluir.', 'erro');
            }
        }

        async function excluirTransacaoDireto(id, titulo, visibilidade) {
            const titLower = (titulo || '').toLowerCase();
            const isCasal = visibilidade === 'compartilhado' || visibilidade === 'lar' || titLower.includes('ajuda') || titLower.includes('ian') || titLower.includes('duda') || titLower.includes('lar');

            const confirmou = await seivaConfirm({
                titulo: isCasal ? 'Estornar lançamento do casal?' : 'Remover lançamento?',
                mensagem: `Deseja realmente remover o lançamento "${titulo}"?`,
                badge: isCasal 
                    ? { texto: 'Transação do Casal (Mútua)', tipo: 'casal' } 
                    : { texto: 'Lançamento Pessoal', tipo: 'pessoal' },
                impacto: isCasal ? {
                    titulo: 'Transparência Bilateral Protegida',
                    texto: 'Este lançamento envolve ajuda mútua ou rateio com o parceiro. Para proteger a relação e evitar conflitos, ele não sumirá no vácuo: o saldo será estornado e a auditoria ficará registrada no Histórico do Lar com data, valor e motivo.'
                } : {
                    titulo: 'Impacto no Saldo da Conta',
                    texto: 'O saldo da conta bancária será revertido e a exclusão ficará gravada no seu Histórico de Auditoria.'
                },
                tipo: 'perigo',
                icone: isCasal ? 'shield-alert' : 'trash-2',
                confirmText: isCasal ? 'Estornar & Registrar Auditoria' : 'Remover & Reverter Saldo',
                cancelText: 'Cancelar (Manter Seguro)'
            });
            if (!confirmou) return;

            try {
                const res = await fetch(`/api/transacoes/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                if (res.ok) {
                    seivaNotificar(isCasal ? `Lançamento "${titulo}" estornado e registrado na auditoria!` : `Lançamento "${titulo}" removido!`, 'sucesso', isCasal ? 'Estorno Auditado' : 'Transação Excluída');
                    carregarTransacoesDados();
                    carregarDashboardDados();
                    carregarTransacoesLar();
                } else {
                    const err = await res.json().catch(() => ({}));
                    seivaNotificar(err.mensagem || err.error || 'Erro ao remover transação.', 'aviso');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão.', 'erro');
            }
        }

        function alternarAbaTransacoes(aba) {
            const paneMin = document.getElementById('paneMinhasTransacoes');
            const paneLar = document.getElementById('paneLarTransacoes');
            const btnMin  = document.getElementById('tabMinhasTransacoes');
            const btnLar  = document.getElementById('tabLarTransacoes');

            const ativoClass   = 'flex-1 py-2.5 px-3 rounded-xl text-sm font-semibold transition-all bg-card text-foreground shadow-2xs flex items-center justify-center gap-2';
            const inativoClass = 'flex-1 py-2.5 px-3 rounded-xl text-sm font-semibold transition-all text-muted-foreground hover:text-foreground flex items-center justify-center gap-2';

            if (aba === 'minhas') {
                if (paneMin) paneMin.classList.remove('hidden');
                if (paneLar) paneLar.classList.add('hidden');
                if (btnMin)  btnMin.className = ativoClass;
                if (btnLar)  btnLar.className = inativoClass;
            } else {
                if (paneMin) paneMin.classList.add('hidden');
                if (paneLar) paneLar.classList.remove('hidden');
                if (btnMin)  btnMin.className = inativoClass;
                if (btnLar)  btnLar.className = ativoClass;
                carregarTransacoesLar();
            }
            lucide.createIcons();
        }

        async function carregarTransacoesLar() {
            try {
                const res = await fetch('/api/transacoes?visibilidade=lar');
                if (!res.ok) return;
                const todasTxs = await res.json();

                // Filtrar apenas DESPESAS (saídas) compartilhadas do Lar para o cálculo matemático
                const despesasLar = todasTxs.filter(t => t.tipo === 'saida');
                txsLarCache = despesasLar;

                const userId = usuarioSessao?.id_usuario;
                const minhasDespesas = despesasLar.filter(t => t.usuario_id === userId);
                const parceiroDespesas = despesasLar.filter(t => t.usuario_id !== userId);

                const totalEu = minhasDespesas.reduce((s, t) => s + parseFloat(t.valor || 0), 0);
                const totalParceiro = parceiroDespesas.reduce((s, t) => s + parseFloat(t.valor || 0), 0);
                const totalCustoLar = totalEu + totalParceiro;

                // Percentual de rateio (Ex: Duda 40% / Ian 60%)
                const isDuda = (usuarioSessao?.email || '').toLowerCase().includes('duda') || (usuarioSessao?.nome || '').toLowerCase().includes('maria');
                const pctEu = isDuda ? 40 : 60;
                const pctParceiro = isDuda ? 60 : 40;
                const parceiroNome = isDuda ? 'Ian' : 'Maria Eduarda';

                // Cota ideal de cada um de acordo com o acordo
                const cotaIdealEu = totalCustoLar * (pctEu / 100);
                const cotaIdealParceiro = totalCustoLar * (pctParceiro / 100);

                // Diferença / Saldo de Acerto: Quanto Eu paguei menos o que Eu deveria pagar
                // Se dif > 0: Eu paguei a mais, parceiro me deve
                // Se dif < 0: Parceiro pagou a mais, eu devo a ele
                const saldoAcerto = totalEu - cotaIdealEu;

                // Alimentar elementos da tela
                const elTotal = document.getElementById('txLarBannerTotal');
                const elEu = document.getElementById('txLarEuEnviei');
                const elParc = document.getElementById('txLarParceiroEnviou');
                const elEuCota = document.getElementById('txLarEuCotaIdeal');
                const elParcCota = document.getElementById('txLarParceiroCotaIdeal');
                const elEuPct = document.getElementById('txLarEuCotaPercentual');
                const elParcPct = document.getElementById('txLarParceiroCotaPercentual');
                const elAcordoTxt = document.getElementById('txLarAcordoTexto');
                const elParcLabel = document.getElementById('txLarParceiroLabel');
                const elParcIni = document.getElementById('txLarParceiroIniciais');
                const elEuIni = document.getElementById('txLarEuIniciais');
                const elQtdDesp = document.getElementById('txLarQtdTotalDespesas');

                if (elTotal) elTotal.textContent = BRL(totalCustoLar);
                if (elEu) elEu.textContent = BRL(totalEu);
                if (elParc) elParc.textContent = BRL(totalParceiro);
                if (elEuCota) elEuCota.textContent = `Sua cota ideal: ${BRL(cotaIdealEu)}`;
                if (elParcCota) elParcCota.textContent = `Cota ideal dele: ${BRL(cotaIdealParceiro)}`;
                if (elEuPct) elEuPct.textContent = `Cota ${pctEu}%`;
                if (elParcPct) elParcPct.textContent = `Cota ${pctParceiro}%`;
                if (elAcordoTxt) elAcordoTxt.textContent = `Rateio: Duda (40%) · Ian (60%)`;
                if (elParcLabel) elParcLabel.textContent = `${parceiroNome} pagou`;
                if (elParcIni) elParcIni.textContent = isDuda ? 'IM' : 'ME';
                if (elEuIni) elEuIni.textContent = isDuda ? 'ME' : 'IM';
                if (elQtdDesp) elQtdDesp.textContent = `${despesasLar.length} ${despesasLar.length === 1 ? 'despesa' : 'despesas'} no mês`;

                // Card de Balanço do Casal
                const acertoMsg = document.getElementById('txLarAcertoMensagem');
                const acertoIcone = document.getElementById('txLarAcertoIcone');
                const acertoBtn = document.getElementById('txLarBtnLembreteAcerto');

                if (acertoMsg && acertoIcone) {
                    if (Math.abs(saldoAcerto) < 0.5) {
                        acertoMsg.innerHTML = '<strong>Contas perfeitamente equilibradas!</strong> Nenhum acerto pendente.';
                        acertoIcone.className = 'size-9 rounded-xl bg-emerald-500/20 text-emerald-300 flex items-center justify-center shrink-0';
                        acertoIcone.innerHTML = '<i data-lucide="check-circle-2" class="size-5"></i>';
                        if (acertoBtn) acertoBtn.classList.add('hidden');
                    } else if (saldoAcerto > 0) {
                        acertoMsg.innerHTML = `Você adiantou <strong>${BRL(saldoAcerto)}</strong> a mais que sua cota. <strong>${parceiroNome}</strong> deve acertar com você.`;
                        acertoIcone.className = 'size-9 rounded-xl bg-amber-500/20 text-amber-300 flex items-center justify-center shrink-0';
                        acertoIcone.innerHTML = '<i data-lucide="arrow-down-left" class="size-5"></i>';
                        if (acertoBtn) {
                            acertoBtn.classList.remove('hidden');
                            acertoBtn.innerHTML = '<i data-lucide="send" class="size-3.5"></i> <span>Pedir PIX amigável</span>';
                        }
                    } else {
                        const valorDevido = Math.abs(saldoAcerto);
                        acertoMsg.innerHTML = `${parceiroNome} adiantou despesas. Você tem <strong>${BRL(valorDevido)}</strong> a acertar para equilibrar o rateio.`;
                        acertoIcone.className = 'size-9 rounded-xl bg-rose-500/20 text-rose-300 flex items-center justify-center shrink-0';
                        acertoIcone.innerHTML = '<i data-lucide="arrow-up-right" class="size-5"></i>';
                        if (acertoBtn) {
                            acertoBtn.classList.remove('hidden');
                            acertoBtn.innerHTML = '<i data-lucide="credit-card" class="size-3.5"></i> <span>Acertar via PIX</span>';
                        }
                    }
                }

                // Mini Relatório por Categorias do Lar
                const gridCat = document.getElementById('txLarCategoriasGrid');
                if (gridCat) {
                    const categoriasMap = {};
                    despesasLar.forEach(t => {
                        const catNome = t.categoria?.nome || 'Geral';
                        categoriasMap[catNome] = (categoriasMap[catNome] || 0) + parseFloat(t.valor || 0);
                    });

                    const catsArray = Object.entries(categoriasMap).sort((a,b) => b[1] - a[1]);
                    if (catsArray.length) {
                        gridCat.innerHTML = catsArray.slice(0, 4).map(([cat, val]) => {
                            const pct = totalCustoLar > 0 ? Math.round((val / totalCustoLar) * 100) : 0;
                            return `
                            <div class="rounded-xl border border-border/70 bg-muted/30 p-2.5 space-y-1">
                                <div class="flex items-center justify-between text-[11px] font-bold text-foreground">
                                    <span class="truncate">${cat}</span>
                                    <span class="text-muted-foreground text-[10px]">${pct}%</span>
                                </div>
                                <strong class="text-xs font-black text-foreground block">${BRL(val)}</strong>
                            </div>`;
                        }).join('');
                    } else {
                        gridCat.innerHTML = `<p class="col-span-full text-[11px] text-muted-foreground py-1 text-center">Nenhuma categoria registrada.</p>`;
                    }
                }

                filtrarTransacoesLar(txLarQuemAtivo, null);
                lucide.createIcons();
            } catch (e) {
                console.error('Erro ao carregar transações do lar:', e);
            }
        }

        function filtrarTransacoesLar(filtro, btn) {
            txLarQuemAtivo = filtro || 'todos';

            if (btn) {
                document.querySelectorAll('#txLarFiltros .tx-lar-btn').forEach(b => {
                    b.className = 'tx-lar-btn px-3 py-1.5 rounded-lg text-muted-foreground hover:text-foreground text-xs font-semibold transition';
                });
                btn.className = 'tx-lar-btn px-3 py-1.5 rounded-lg bg-card text-foreground text-xs font-bold shadow-2xs transition';
            }

            const cont = document.getElementById('txLarLista');
            if (!cont) return;

            const userId = usuarioSessao?.id_usuario;
            let lista = txsLarCache || [];

            if (txLarQuemAtivo === 'eu') {
                lista = lista.filter(t => t.usuario_id === userId);
            } else if (txLarQuemAtivo === 'parceiro') {
                lista = lista.filter(t => t.usuario_id !== userId);
            } else if (txLarQuemAtivo === 'imprevistos') {
                lista = lista.filter(t => Boolean(t.is_imprevisto));
            }

            if (!lista.length) {
                cont.innerHTML = `
                <div class="rounded-3xl border border-border bg-card p-8 shadow-card text-center space-y-2">
                    <i data-lucide="inbox" class="size-8 text-muted-foreground/50 mx-auto"></i>
                    <p class="text-xs text-muted-foreground">Nenhuma despesa compartilhada encontrada para este filtro.</p>
                </div>`;
                lucide.createIcons();
                return;
            }

            cont.innerHTML = `
            <div class="rounded-3xl border border-border bg-card shadow-card overflow-hidden">
                <div class="divide-y divide-border/60">
                    ${lista.map(t => {
                        const iconeNome = obterIconeTransacao(t);
                        const dataFmt = formatarDataTransacaoBR(t.data, 'curto');
                        const isEu = t.usuario_id === userId;
                        const quemNome = isEu ? 'Pago por Você' : (larSessao?.membros?.find(m => m.id_usuario !== userId)?.nome?.split(' ')[0] || 'Parceiro');
                        const metade = (parseFloat(t.valor) / 2).toLocaleString('pt-BR', { minimumFractionDigits: 2 });
                        const tJsonStr = JSON.stringify(t).replace(/"/g, '&quot;');

                        let badgeExtra = '';
                        if (t.is_imprevisto) {
                            badgeExtra = `<span class="inline-flex items-center gap-1 px-1.5 py-0.2 rounded-full bg-amber-500/10 text-amber-600 dark:text-amber-400 text-[9px] font-bold border border-amber-500/20">
                                            <i data-lucide="alert-triangle" class="size-2.5"></i> Imprevisto
                                          </span>`;
                        }

                        return `
                        <div class="flex items-center justify-between px-4 py-3 hover:bg-muted/30 transition">
                            <div class="flex items-center gap-3 min-w-0">
                                <span class="size-10 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-300 flex items-center justify-center shrink-0 border border-emerald-500/20">
                                    <i data-lucide="${iconeNome}" class="size-5"></i>
                                </span>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-1.5 flex-wrap">
                                        <p class="text-xs font-bold text-foreground truncate">${t.titulo}</p>
                                        ${badgeExtra}
                                    </div>
                                    <span class="text-[10px] text-muted-foreground truncate block mt-0.5">
                                        ${quemNome} · ${dataFmt} · 50/50 (R$ ${metade} cada)
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2.5 shrink-0 ml-3">
                                <span class="text-xs font-black text-foreground">${BRL(t.valor)}</span>
                                <div class="flex items-center gap-1">
                                    <button type="button" onclick="abrirModalEditarTransacao(${tJsonStr})" 
                                            title="Editar transação do Lar"
                                            class="size-7 rounded-lg border border-border bg-card hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition shadow-2xs">
                                        <i data-lucide="edit-3" class="size-3"></i>
                                    </button>
                                    <button type="button" onclick="excluirTransacaoDireto(${t.id_transacao}, '${(t.titulo || '').replace(/'/g, "\\'")}')" 
                                            title="Excluir transação"
                                            class="size-7 rounded-lg border border-rose-300 dark:border-rose-900 bg-rose-50/40 dark:bg-rose-950/20 hover:bg-rose-100 text-rose-600 flex items-center justify-center transition shadow-2xs">
                                        <i data-lucide="trash-2" class="size-3"></i>
                                    </button>
                                </div>
                            </div>
                        </div>`;
                    }).join('')}
                </div>
            </div>`;

            lucide.createIcons();
        }

        async function pedirAjudaCustoLar() {
            try {
                const res = await fetch('/api/caixa-preta/pedir-ajuda', { method: 'POST', headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' } });
                if (res.ok) seivaNotificar('Pedido de ajuda de custo enviado ao parceiro(a)!', 'sucesso', 'Pedido Enviado');
                else seivaNotificar('Não foi possível enviar o pedido.', 'aviso');
            } catch (e) { seivaNotificar('Erro de conexão.', 'erro'); }
        }

        // ==========================================
        // GESTÃO DO LAR & RATEIO DO CASAL (RF004 / RF006 / RF008 / RF010)
        // Responsáveis Acadêmicos: Jhon Abner / Ian Marcos
        // Bordão Oficial: "Onde seu dinheiro cria raízes"
        // ==========================================
        let subAbaLarAtiva = 'inicio';
        let larDadosCache = null;
        let metaPixAtual = null;
        let destinoDesfazerEscolhido = 'devolver';

        function alternarSubAbaLar(aba, btn) {
            subAbaLarAtiva = aba;
            
            // Oculta todos os conteúdos das subabas
            const contInicio = document.getElementById('larConteudoInicio');
            const contDespesas = document.getElementById('larConteudoDespesas');
            const contMetas = document.getElementById('larConteudoMetas');
            const contAcordos = document.getElementById('larConteudoAcordos');

            if (contInicio) contInicio.classList.add('hidden');
            if (contDespesas) contDespesas.classList.add('hidden');
            if (contMetas) contMetas.classList.add('hidden');
            if (contAcordos) contAcordos.classList.add('hidden');

            // Exibe o conteúdo da subaba selecionada
            if (aba === 'inicio' && contInicio) contInicio.classList.remove('hidden');
            if (aba === 'despesas' && contDespesas) contDespesas.classList.remove('hidden');
            if (aba === 'metas' && contMetas) contMetas.classList.remove('hidden');
            if (aba === 'acordos' && contAcordos) contAcordos.classList.remove('hidden');

            // Atualiza botões de navegação
            const nav = document.getElementById('larAbasNavegacao');
            if (nav) {
                const botoes = nav.querySelectorAll('.btn-subaba-lar');
                botoes.forEach(b => {
                    b.className = 'btn-subaba-lar px-4 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition flex items-center gap-2 shadow-2xs';
                });
            }
            if (btn) {
                btn.className = 'btn-subaba-lar active px-4 py-2 rounded-2xl bg-emerald-800 text-white font-extrabold text-xs shadow-soft transition flex items-center gap-2';
            }

            lucide.createIcons();
        }

        async function carregarLarDados() {
            try {
                const res = await fetch('/api/lar');
                if (!res.ok) return;
                const data = await res.json();
                if (!data.lar) return;
                larSessao = data.lar;
                larDadosCache = data;

                // 1. Cabeçalho
                const topoBadge = document.getElementById('larTopoNomeBadge');
                if (topoBadge) topoBadge.innerText = data.lar.nome || 'Nosso Cantinho';

                const casalSub = document.getElementById('larCasalSubtitulo');
                if (casalSub) casalSub.innerText = `${data.lar.nomes_membros || data.lar.nome || 'Membros do Lar'} · desde ${data.lar.desde || 'recente'}`;

                const boxAvatares = document.getElementById('larAvataresMembrosBox');
                if (boxAvatares && data.membros && data.membros.length) {
                    boxAvatares.innerHTML = data.membros.map((m, idx) => {
                        const bgCor = idx === 0 ? 'bg-emerald-700' : 'bg-emerald-800';
                        if (m.avatar) {
                            return `<img src="${m.avatar}" alt="${m.nome}" class="size-6 rounded-full object-cover ring-2 ring-white/40">`;
                        }
                        return `<span class="size-6 rounded-full ${bgCor} text-white font-extrabold text-[10px] flex items-center justify-center ring-2 ring-white/40">${m.iniciais || '--'}</span>`;
                    }).join('');
                }

                // 2. Saúde Financeira do Lar
                if (data.saude_financeira) {
                    const sf = data.saude_financeira;
                    const scoreEl = document.getElementById('larSaudeScore');
                    if (scoreEl) scoreEl.innerText = `${sf.percentual}%`;
                    const statusEl = document.getElementById('larSaudeStatus');
                    if (statusEl) statusEl.innerText = sf.status;
                    const rendaEl = document.getElementById('larTxtRendaCasal');
                    if (rendaEl) rendaEl.innerText = `${BRL(sf.renda_casal)}/mês`;
                    const custoEl = document.getElementById('larTxtCustoFixo');
                    if (custoEl) custoEl.innerText = `${BRL(sf.custo_fixo)} (${sf.custo_fixo_pct}% da renda)`;
                    const faltaEl = document.getElementById('larTxtFaltaMembro');
                    if (faltaEl) {
                        faltaEl.innerHTML = sf.falta_contribuir > 0
                            ? `Falta ${sf.falta_nome ? 'a ' + sf.falta_nome : 'ao parceiro(a)'} contribuir: <strong>${BRL(sf.falta_contribuir)} neste mês</strong>`
                            : `Contribuições do Lar 100% quitadas neste mês!`;
                    }
                }

                // Barras de Contribuição dos Membros
                if (data.membros && data.membros.length >= 2) {
                    const m1 = data.membros[0];
                    const m2 = data.membros[1];

                    const m1Nome = document.getElementById('larMembro1Nome');
                    if (m1Nome) m1Nome.innerText = m1.primeiro_nome;
                    const m1Val = document.getElementById('larMembro1Valores');
                    if (m1Val) m1Val.innerText = `${BRL(m1.ja_pago_mes)} / ${BRL(m1.meta_mes)}`;
                    const m1Pct = document.getElementById('larMembro1Pct');
                    if (m1Pct) m1Pct.innerText = `${m1.pct_pago_mes}%`;
                    const m1Barra = document.getElementById('larMembro1Barra');
                    if (m1Barra) m1Barra.style.width = `${m1.pct_pago_mes}%`;

                    const m2Nome = document.getElementById('larMembro2Nome');
                    if (m2Nome) m2Nome.innerText = m2.primeiro_nome;
                    const m2Val = document.getElementById('larMembro2Valores');
                    if (m2Val) m2Val.innerText = `${BRL(m2.ja_pago_mes)} / ${BRL(m2.meta_mes)}`;
                    const m2Pct = document.getElementById('larMembro2Pct');
                    if (m2Pct) m2Pct.innerText = `${m2.pct_pago_mes}%`;
                    const m2Barra = document.getElementById('larMembro2Barra');
                    if (m2Barra) m2Barra.style.width = `${m2.pct_pago_mes}%`;
                }

                // 3. 4 Cards de Resumo
                if (data.resumo) {
                    const r = data.resumo;
                    const cTotal = document.getElementById('larCardCustoTotal');
                    if (cTotal) cTotal.innerText = BRL(r.custo_lar);
                    const cJa = document.getElementById('larCardJaContribuido');
                    if (cJa) cJa.innerText = BRL(r.ja_contribuido);
                    const cFalta = document.getElementById('larCardFaltaContribuir');
                    if (cFalta) cFalta.innerText = BRL(r.falta_contribuir);
                    const cSobra = document.getElementById('larCardSobraCasal');
                    if (cSobra) cSobra.innerText = BRL(r.sobra_casal);
                }

                // 4. Próximos Vencimentos
                const gridVenc = document.getElementById('larListaProximosVencimentos');
                if (gridVenc && data.proximos_vencimentos) {
                    gridVenc.innerHTML = data.proximos_vencimentos.map(v => {
                        const ehPagar = v.acao === 'pagar';
                        const corBolinha = v.cor || (ehPagar ? '#ef4444' : '#10b981');
                        const vJsonStr = JSON.stringify(v).replace(/"/g, '&quot;');
                        return `
                            <div class="p-3.5 sm:p-4 rounded-2xl border border-border bg-card flex items-center justify-between gap-3 shadow-2xs">
                                <div class="flex items-center gap-3 min-w-0">
                                    <span class="size-2.5 rounded-full shrink-0" style="background-color: ${corBolinha}"></span>
                                    <div class="min-w-0">
                                        <h5 class="text-xs font-extrabold text-foreground truncate">${v.titulo}</h5>
                                        <span class="text-[11px] text-muted-foreground">${v.data_fmt} · ${BRL(v.valor)}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    <button type="button" onclick="abrirModalEditarDespesaLar(${vJsonStr})" 
                                            title="Editar valor ou vencimento da conta"
                                            class="size-8 rounded-xl border border-border bg-card hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition shadow-2xs">
                                        <i data-lucide="edit-3" class="size-3.5"></i>
                                    </button>
                                    ${ehPagar ? `
                                        <button type="button" onclick="abrirModalPagamentoDespesaFixaLar('${v.titulo}', ${v.valor}, ${v.id})" 
                                                class="px-3.5 py-1.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-black text-xs shadow-soft transition">
                                            Pagar agora
                                        </button>
                                    ` : `
                                        <button type="button" onclick="abrirModalPagamentoDespesaFixaLar('${v.titulo}', ${v.valor}, ${v.id})" 
                                                class="px-3 py-1.5 rounded-xl border border-border bg-muted/40 hover:bg-muted text-foreground font-bold text-xs transition shadow-2xs">
                                            Registrar
                                        </button>
                                    `}
                                </div>
                            </div>
                        `;
                    }).join('');
                }

                // 5. Dívidas Fixas (Aba Despesas)
                const gridFixas = document.getElementById('larListaDividasFixas');
                if (gridFixas && data.despesas_fixas) {
                    gridFixas.innerHTML = data.despesas_fixas.map(d => {
                        const dJsonStr = JSON.stringify(d).replace(/"/g, '&quot;');
                        return `
                        <div class="p-4 rounded-2xl border border-border bg-card flex items-center justify-between gap-3 shadow-2xs">
                            <div class="flex items-center gap-3 min-w-0">
                                <span class="size-9 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300 flex items-center justify-center shrink-0 border border-emerald-500/20">
                                    <i data-lucide="${d.icone || 'receipt'}" class="size-4"></i>
                                </span>
                                <div class="min-w-0">
                                    <h5 class="text-xs font-extrabold text-foreground truncate">${d.titulo}</h5>
                                    <span class="text-[11px] text-muted-foreground">${d.divisao} · ${d.vencimento}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <strong class="text-xs font-black text-foreground mr-1">${BRL(d.valor_total)}</strong>
                                <button type="button" onclick="abrirModalEditarDespesaLar(${dJsonStr})" 
                                        title="Reajustar valor ou regra de divisão"
                                        class="size-8 rounded-xl border border-border bg-card hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition shadow-2xs">
                                    <i data-lucide="edit-3" class="size-3.5"></i>
                                </button>
                                <button type="button" onclick="excluirDespesaLarDireto(${d.id}, '${(d.titulo||'').replace(/'/g, "\\'")}')" 
                                        title="Excluir despesa do Lar"
                                        class="size-8 rounded-xl border border-rose-300 dark:border-rose-900 bg-rose-50/50 dark:bg-rose-950/20 hover:bg-rose-100 text-rose-600 flex items-center justify-center transition shadow-2xs">
                                    <i data-lucide="trash-2" class="size-3.5"></i>
                                </button>
                                ${d.pago ? `
                                    <span class="px-2.5 py-1 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 font-extrabold text-[11px] flex items-center gap-1 border border-emerald-500/20">
                                        <i data-lucide="check" class="size-3"></i>
                                        <span>pago</span>
                                    </span>
                                ` : `
                                    <button type="button" onclick="abrirModalPagamentoDespesaFixaLar('${d.titulo}', ${d.valor_total}, ${d.id})" 
                                            class="px-3.5 py-1.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs shadow-soft transition flex items-center gap-1.5">
                                        <i data-lucide="credit-card" class="size-3.5"></i>
                                        <span>Pagar</span>
                                    </button>
                                `}
                            </div>
                        </div>
                    `;
                    }).join('');
                }

                // 6. Dívidas Variáveis (Aba Despesas)
                const gridVar = document.getElementById('larListaDividasVariaveis');
                if (gridVar && data.despesas_variaveis) {
                    gridVar.innerHTML = data.despesas_variaveis.map(dv => {
                        const dvJsonStr = JSON.stringify(dv).replace(/"/g, '&quot;');
                        return `
                        <div class="p-4 rounded-2xl border border-border bg-card flex items-center justify-between gap-3 shadow-2xs">
                            <div class="flex items-center gap-3 min-w-0">
                                <span class="size-9 rounded-xl bg-muted/60 text-muted-foreground flex items-center justify-center shrink-0">
                                    <i data-lucide="${dv.icone || 'shopping-cart'}" class="size-4"></i>
                                </span>
                                <div class="min-w-0">
                                    <h5 class="text-xs font-extrabold text-foreground truncate">${dv.titulo}</h5>
                                    <span class="text-[11px] text-muted-foreground">${dv.detalhe}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <strong class="text-xs font-black text-foreground mr-1">${BRL(dv.valor_total)}</strong>
                                <button type="button" onclick="abrirModalEditarDespesaLar(${dvJsonStr})" 
                                        title="Editar gasto variável"
                                        class="size-8 rounded-xl border border-border bg-card hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition shadow-2xs">
                                    <i data-lucide="edit-3" class="size-3.5"></i>
                                </button>
                                <button type="button" onclick="excluirDespesaLarDireto(${dv.id}, '${(dv.titulo||'').replace(/'/g, "\\'")}')" 
                                        title="Excluir gasto variável"
                                        class="size-8 rounded-xl border border-rose-300 dark:border-rose-900 bg-rose-50/50 dark:bg-rose-950/20 hover:bg-rose-100 text-rose-600 flex items-center justify-center transition shadow-2xs">
                                    <i data-lucide="trash-2" class="size-3.5"></i>
                                </button>
                            </div>
                        </div>
                    `;
                    }).join('');
                }

                // 7. Metas do Lar (Aba Metas com fotos reais de alta resolução e previsão em dias)
                const gridMetas = document.getElementById('larListaMetasCards');
                if (gridMetas && data.metas) {
                    gridMetas.innerHTML = data.metas.map(m => {
                        const ehNegociacao = m.em_negociacao;
                        const metaJsonStr = JSON.stringify(m).replace(/"/g, '&quot;');
                        const dias = m.previsao_dias || 90;
                        const fotoUrl = m.imagem || '/produtos/geladeira-samsung.png';
                        const divisaoTxt = m.divisao_casal 
                            ? `Você: ${BRL(m.divisao_casal.voce)}/mês · ${m.divisao_casal.parceiro_nome}: ${BRL(m.divisao_casal.parceiro)}/mês`
                            : 'Divisão 50% / 50%';

                        return `
                            <div class="rounded-3xl border ${ehNegociacao ? 'border-amber-300 dark:border-amber-800 bg-amber-50/20 dark:bg-amber-950/10' : 'border-border bg-card'} p-5 sm:p-6 space-y-4 shadow-card">
                                <!-- Cabeçalho do Card com Foto Real do Produto / Cômodo -->
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex items-center gap-3.5 min-w-0">
                                        <div class="size-16 rounded-2xl overflow-hidden border border-border bg-muted/30 shrink-0 shadow-2xs">
                                            <img src="${fotoUrl}" alt="${m.titulo}" class="size-full object-cover object-center">
                                        </div>
                                        <div class="min-w-0 space-y-0.5">
                                            <h4 class="text-base font-black text-foreground truncate">${m.titulo}</h4>
                                            <p class="text-xs text-muted-foreground">${m.subtitulo || m.acordo_texto || 'Meta conjunta do Lar'}</p>
                                            <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300 border border-emerald-500/20 text-[10px] font-black">
                                                <i data-lucide="calendar" class="size-3 text-emerald-600"></i>
                                                <span>Previsão de entrega em ~${dias} dias</span>
                                            </div>
                                        </div>
                                    </div>
                                    ${ehNegociacao ? `
                                        <span class="px-2.5 py-1 rounded-full bg-amber-100 text-amber-900 dark:bg-amber-900/60 dark:text-amber-200 font-black text-[10px] flex items-center gap-1 border border-amber-500/30 shrink-0">
                                            <i data-lucide="scale" class="size-3"></i>
                                            <span>Em negociação</span>
                                        </span>
                                    ` : `
                                        <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-900 dark:bg-emerald-900/60 dark:text-emerald-200 font-black text-[11px] shrink-0">
                                            ${m.progresso}% acumulado
                                        </span>
                                    `}
                                </div>

                                <!-- Barra de Progresso com Alto Contraste -->
                                <div class="space-y-1.5">
                                    <div class="h-2.5 w-full rounded-full bg-muted overflow-hidden">
                                        <div class="h-full ${ehNegociacao ? 'bg-amber-500' : 'bg-emerald-600'} rounded-full transition-all duration-700" style="width: ${m.progresso}%"></div>
                                    </div>
                                    <div class="flex items-center justify-between text-xs text-muted-foreground pt-0.5">
                                        <span class="font-extrabold text-foreground">${BRL(m.valor_atual)} acumulados (${m.progresso}%)</span>
                                        <span class="font-bold text-foreground">de ${BRL(m.valor_alvo)}</span>
                                    </div>
                                </div>

                                <!-- Detalhes de Divisão do Casal & Destino da Reserva -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs pt-1">
                                    <div class="p-2.5 rounded-2xl bg-muted/30 border border-border/60 flex items-center gap-2">
                                        <i data-lucide="wallet" class="size-4 text-emerald-600 shrink-0"></i>
                                        <div class="min-w-0">
                                            <span class="text-[10px] font-bold text-muted-foreground block">Guardado em</span>
                                            <strong class="text-foreground text-xs truncate block">${m.conta_destino || 'Conta conjunta do Lar'}</strong>
                                        </div>
                                    </div>
                                    <div class="p-2.5 rounded-2xl bg-muted/30 border border-border/60 flex items-center gap-2">
                                        <i data-lucide="scale" class="size-4 text-emerald-600 shrink-0"></i>
                                        <div class="min-w-0">
                                            <span class="text-[10px] font-bold text-muted-foreground block">Divisão do Casal</span>
                                            <strong class="text-foreground text-xs truncate block">${divisaoTxt}</strong>
                                        </div>
                                    </div>
                                </div>

                                <!-- Aceleradores de Conquista (Adiantar Dias) -->
                                ${!ehNegociacao ? `
                                    <div class="p-3 rounded-2xl bg-emerald-50/50 dark:bg-emerald-950/20 border border-emerald-500/20 space-y-2">
                                        <div class="flex items-center justify-between text-xs">
                                            <span class="font-bold text-emerald-900 dark:text-emerald-200 flex items-center gap-1">
                                                <i data-lucide="zap" class="size-3.5 text-amber-500"></i>
                                                <span>Agilizar Conquista</span>
                                            </span>
                                            <span class="text-[10px] text-muted-foreground">Toque para depositar e adiantar dias</span>
                                        </div>
                                        <div class="grid grid-cols-3 gap-2">
                                            <button type="button" onclick="adiantarDiasMetaLar(${m.id_meta}, 50, 3)" 
                                                    class="py-1.5 px-2 rounded-xl bg-card border border-border hover:border-emerald-500 text-center transition shadow-2xs">
                                                <strong class="text-xs font-black text-foreground block">+ R$ 50</strong>
                                                <span class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400">-3 dias</span>
                                            </button>
                                            <button type="button" onclick="adiantarDiasMetaLar(${m.id_meta}, 100, 6)" 
                                                    class="py-1.5 px-2 rounded-xl bg-card border border-border hover:border-emerald-500 text-center transition shadow-2xs">
                                                <strong class="text-xs font-black text-foreground block">+ R$ 100</strong>
                                                <span class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400">-6 dias</span>
                                            </button>
                                            <button type="button" onclick="adiantarDiasMetaLar(${m.id_meta}, 200, 12)" 
                                                    class="py-1.5 px-2 rounded-xl bg-card border border-border hover:border-emerald-500 text-center transition shadow-2xs">
                                                <strong class="text-xs font-black text-foreground block">+ R$ 200</strong>
                                                <span class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400">-12 dias</span>
                                            </button>
                                        </div>
                                    </div>
                                ` : ''}

                                <!-- Ações da Meta -->
                                <div class="flex flex-wrap items-center gap-2 pt-1">
                                    ${ehNegociacao ? `
                                        <button type="button" onclick="alternarSubAbaLar('acordos'); trocarAbaApp('lar');" 
                                                class="flex-1 py-3 px-4 rounded-2xl bg-amber-600 hover:bg-amber-700 text-white font-black text-xs flex items-center justify-center gap-2 shadow-soft transition">
                                            <span>Avaliar Proposta na Mesa de Acordos</span>
                                            <i data-lucide="arrow-right" class="size-4"></i>
                                        </button>
                                    ` : `
                                        <button type="button" onclick="abrirModalGuardarMetaLarPix(${metaJsonStr})" 
                                                class="flex-1 py-3 px-4 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs flex items-center justify-center gap-2 shadow-soft transition">
                                            <i data-lucide="plus" class="size-4"></i>
                                            <span>+ Guardar dinheiro nesta meta</span>
                                        </button>
                                        <button type="button" onclick="abrirModalAtualizarMetaLar(${m.id_meta}, '${m.titulo}', ${m.valor_alvo}, 'nov/2026')" 
                                                class="py-3 px-3.5 rounded-2xl border border-border bg-card hover:bg-muted text-foreground font-bold text-xs transition shadow-2xs flex items-center gap-1.5">
                                            <i data-lucide="edit-3" class="size-3.5"></i>
                                            <span>Atualizar</span>
                                        </button>
                                        <button type="button" onclick="abrirModalDesfazerMetaLar(${m.id_meta}, '${m.titulo}', ${m.valor_atual})" 
                                                class="py-3 px-3.5 rounded-2xl border border-border bg-card hover:bg-rose-50 dark:hover:bg-rose-950/30 text-rose-600 font-bold text-xs transition shadow-2xs flex items-center gap-1.5">
                                            <i data-lucide="undo-2" class="size-3.5"></i>
                                            <span>Desfazer</span>
                                        </button>
                                        <button type="button" onclick="excluirMetaDireto(${m.id_meta}, '${(m.titulo||'').replace(/'/g, "\\'")}')" 
                                                class="py-3 px-3 rounded-2xl border border-rose-300 dark:border-rose-900 bg-rose-50/50 dark:bg-rose-950/20 hover:bg-rose-100 text-rose-600 font-bold text-xs transition shadow-2xs flex items-center gap-1"
                                                title="Excluir meta permanentemente">
                                            <i data-lucide="trash-2" class="size-3.5"></i>
                                        </button>
                                    `}
                                </div>
                            </div>
                        `;
                    }).join('');
                }

                // 8. Mesa de Acordos (Aba Acordos - Design Fintech Premium com Fotos Reais e Votação Bilateral)
                const gridAcordos = document.getElementById('larListaAcordosItens');
                if (gridAcordos) {
                    gridAcordos.innerHTML = `
                        <!-- Card 1: Geladeira Samsung (Acordo Ativo Quitando) -->
                        <div class="rounded-3xl border border-border bg-card p-4 sm:p-5 space-y-3.5 shadow-card">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex items-center gap-3.5 min-w-0">
                                    <div class="size-14 rounded-2xl overflow-hidden border border-border bg-muted/30 shrink-0 shadow-2xs">
                                        <img src="/produtos/geladeira-samsung.png" alt="Geladeira Samsung" class="size-full object-cover object-center">
                                    </div>
                                    <div class="min-w-0 space-y-0.5">
                                        <div class="flex items-center gap-2">
                                            <h5 class="text-sm font-black text-foreground truncate">Geladeira Samsung Frost Free 460L</h5>
                                            <span class="px-2 py-0.5 rounded-md bg-muted text-[10px] font-black text-muted-foreground">Dívida do Lar</span>
                                        </div>
                                        <p class="text-xs text-muted-foreground">Divisão 50% / 50% · Parcela 5 de 10 · R$ 250,00/mês cada</p>
                                    </div>
                                </div>
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-black shrink-0 shadow-2xs"
                                      style="background-color: #ecfdf5 !important; border: 1.5px solid #10b981 !important; color: #064e3b !important;">
                                    <i data-lucide="check-circle-2" class="size-3 text-emerald-600"></i>
                                    <span>Acordo Ativo (100% Consenso)</span>
                                </span>
                            </div>

                            <!-- Barra de Quitação da Parcela -->
                            <div class="space-y-1">
                                <div class="h-2 w-full rounded-full bg-muted overflow-hidden">
                                    <div class="h-full bg-emerald-600 rounded-full" style="width: 50%"></div>
                                </div>
                                <div class="flex items-center justify-between text-[11px] text-muted-foreground pt-0.5">
                                    <span class="font-bold text-foreground">R$ 1.000,00 quitados (50%)</span>
                                    <span>Faltam 5 parcelas de R$ 500,00</span>
                                </div>
                            </div>

                            <!-- Participação do Casal e Ações -->
                            <div class="flex flex-wrap items-center justify-between gap-2 pt-1 border-t border-border/60">
                                <div class="flex items-center gap-3 text-xs">
                                    <div class="flex items-center gap-1.5 font-bold text-foreground">
                                        <span class="size-5 rounded-full bg-pink-100 text-pink-700 text-[10px] font-black flex items-center justify-center">ME</span>
                                        <span>Você: R$ 250 em dia</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 font-bold text-foreground">
                                        <span class="size-5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-black flex items-center justify-center">IM</span>
                                        <span>Ian: R$ 250 em dia</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <button type="button" onclick="renegociarAcordoCasal(1, 'Geladeira Samsung Frost Free')" 
                                            class="px-3 py-1.5 rounded-xl border border-border bg-card hover:bg-muted text-foreground text-xs font-bold transition shadow-2xs">
                                        Renegociar Parcelas
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Viagem Praia do Forte (Em Negociação - Aguardando Consenso) -->
                        <div class="rounded-3xl p-4 sm:p-5 space-y-3.5 shadow-card"
                             style="background-color: #fffbeb !important; border: 1.5px solid #f59e0b !important;">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex items-center gap-3.5 min-w-0">
                                    <div class="size-14 rounded-2xl overflow-hidden border border-amber-300 bg-amber-100/40 shrink-0 shadow-2xs">
                                        <img src="/produtos/praia-forte.png" alt="Praia do Forte" class="size-full object-cover object-center">
                                    </div>
                                    <div class="min-w-0 space-y-0.5">
                                        <div class="flex items-center gap-2">
                                            <h5 class="text-sm font-black text-foreground truncate" style="color: #451a03 !important;">Viagem Praia do Forte no Verão</h5>
                                            <span class="px-2 py-0.5 rounded-md bg-amber-200 text-[10px] font-black" style="color: #78350f !important;">Meta Conjunta</span>
                                        </div>
                                        <p class="text-xs" style="color: #78350f !important; font-weight: 700 !important;">Proposta de Ian: guardar R$ 100,00/mês cada até janeiro (Meta: R$ 3.000,00)</p>
                                    </div>
                                </div>
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-black shrink-0 shadow-2xs"
                                      style="background-color: #fef3c7 !important; border: 1.5px solid #f59e0b !important; color: #78350f !important;">
                                    <i data-lucide="scale" class="size-3 text-amber-600"></i>
                                    <span>Em Negociação (Aguardando Você)</span>
                                </span>
                            </div>

                            <!-- Bilhete carinhoso da proposta -->
                            <div class="p-3 rounded-2xl shadow-2xs text-xs font-semibold leading-relaxed"
                                 style="background-color: #ffffff !important; border: 1px solid #fde68a !important; color: #451a03 !important;">
                                <strong style="color: #78350f !important;">Recado do Ian:</strong> "Amor, se guardarmos R$ 100 cada todo mês, conseguimos alugar uma casa na praia no réveillon sem apertar o nosso orçamento!"
                            </div>

                            <!-- Botões de Ação Imediata com Alto Contraste -->
                            <div class="flex flex-wrap items-center gap-2 pt-1">
                                <button type="button" onclick="aprovarPropostaAcordoLar(2, 'Viagem Praia do Forte')" 
                                        class="flex-1 py-2.5 px-4 rounded-xl text-xs font-black shadow-soft transition flex items-center justify-center gap-2 hover:opacity-95"
                                        style="background-color: #047857 !important; color: #ffffff !important;">
                                    <i data-lucide="check" class="size-4 text-emerald-200"></i>
                                    <span>Aprovar Proposta de Acordo</span>
                                </button>
                                <button type="button" onclick="contraproporAcordoLar(2, 'Viagem Praia do Forte')" 
                                        class="py-2.5 px-4 rounded-xl text-xs font-black shadow-2xs transition flex items-center justify-center gap-1.5 hover:opacity-95"
                                        style="background-color: #d97706 !important; color: #ffffff !important;">
                                    <i data-lucide="shield" class="size-4 text-amber-100"></i>
                                    <span>Contrapropor Valor</span>
                                </button>
                            </div>
                        </div>

                        <!-- Card 3: Regra de Consenso do Fundo de Emergência -->
                        <div class="rounded-3xl border border-border bg-card p-4 sm:p-5 space-y-2.5 shadow-2xs">
                            <div class="flex items-center justify-between gap-3">
                                <div class="flex items-center gap-3">
                                    <span class="size-10 rounded-2xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center shrink-0 border border-emerald-500/20">
                                        <i data-lucide="shield-check" class="size-5"></i>
                                    </span>
                                    <div>
                                        <h5 class="text-xs font-black text-foreground">Regra Bilateral: Fundo de Emergência do Lar</h5>
                                        <p class="text-[11px] text-muted-foreground">Consenso mútuo obrigatório para qualquer saque</p>
                                    </div>
                                </div>
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black"
                                      style="background-color: #ecfdf5 !important; border: 1.5px solid #10b981 !important; color: #064e3b !important;">
                                    Regra Ativa
                                </span>
                            </div>
                            <p class="text-[11px] text-muted-foreground leading-relaxed">
                                Nenhum dos dois consegue retirar dinheiro da conta conjunta Poupança Caixa sem que o parceiro valide a solicitação no app.
                            </p>
                        </div>
                    `;
                }

                lucide.createIcons();
            } catch (e) {
                console.error('Erro ao carregar dados do Lar:', e);
            }
        }

        // --- 1. MODAL: REFORÇAR FUNDO DE EMERGÊNCIA DO LAR ---
        function abrirModalReforcarFundoEmergencia() {
            const inputVal = document.getElementById('fundoEmergenciaInputValor');
            if (inputVal) inputVal.value = '250,00';
            atualizarCalculoFundoEmergencia('250,00');
            removerComprovanteFundo();

            const modal = document.getElementById('modalGuardarFundoEmergenciaLar');
            if (modal) modal.classList.remove('hidden');
            lucide.createIcons();
        }

        function preencherValorFundoEmergencia(valor) {
            const inputVal = document.getElementById('fundoEmergenciaInputValor');
            if (inputVal) {
                inputVal.value = valor.toFixed(2).replace('.', ',');
                atualizarCalculoFundoEmergencia(inputVal.value);
            }
        }

        function atualizarCalculoFundoEmergencia(valorStr) {
            const txt = document.getElementById('fundoEmergenciaSeraTxt');
            if (!txt) return;
            const limpo = parseFloat((valorStr || '0').replace('.', '').replace(',', '.')) || 0;
            const novoTotal = 5000 + limpo;
            const pct = Math.min(100, Math.round((novoTotal / 10000) * 100));
            txt.innerText = `Será ${pct}% após guardar (${BRL(novoTotal)} de R$ 10.000,00)`;
        }

        function selecionarContaFundoEmergencia(btn, contaId) {
            const grid = document.getElementById('fundoEmergenciaContasGrid');
            if (grid) {
                grid.querySelectorAll('.chip-conta-fundo').forEach(b => {
                    b.className = 'chip-conta-fundo p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30 flex items-center gap-2.5';
                });
            }
            if (btn) {
                btn.className = 'chip-conta-fundo active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition flex items-center gap-2.5';
            }
            const inputHidden = document.getElementById('fundoEmergenciaContaId');
            if (inputHidden) inputHidden.value = contaId;
        }

        function aoSelecionarComprovanteFundo(input) {
            if (input.files && input.files[0]) {
                const box = document.getElementById('boxComprovanteFundo');
                const preview = document.getElementById('previewComprovanteFundo');
                if (box) box.classList.add('hidden');
                if (preview) preview.classList.remove('hidden');
            }
        }

        function removerComprovanteFundo(e) {
            if (e) e.stopPropagation();
            const input = document.getElementById('fundoEmergenciaComprovanteInput');
            if (input) input.value = '';
            const box = document.getElementById('boxComprovanteFundo');
            const preview = document.getElementById('previewComprovanteFundo');
            if (box) box.classList.remove('hidden');
            if (preview) preview.classList.add('hidden');
        }

        async function executarAporteFundoEmergenciaLar(e) {
            e.preventDefault();
            const inputVal = document.getElementById('fundoEmergenciaInputValor');
            const valNum = parseFloat((inputVal?.value || '0').replace('.', '').replace(',', '.')) || 0;
            const contaId = document.getElementById('fundoEmergenciaContaId')?.value || 1;

            if (valNum <= 0) {
                return seivaNotificar('Informe um valor válido para guardar no fundo.', 'aviso', 'Valor Obrigatório');
            }

            try {
                const res = await fetch('/api/lar/fundo-emergencia/reforcar', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ valor: valNum, conta_id: contaId })
                });

                if (res.ok) {
                    fecharModalId('modalGuardarFundoEmergenciaLar');
                    seivaNotificar(`Aporte de ${BRL(valNum)} no Fundo de Emergência registrado!`, 'sucesso', 'Reserva Fortalecida');
                    carregarLarDados();
                } else {
                    seivaNotificar('Não foi possível registrar o aporte.', 'erro', 'Erro ao Guardar');
                }
            } catch (err) {
                seivaNotificar('Erro de conexão com o servidor.', 'erro');
            }
        }

        function abrirModalSaudeFinanceiraLar() {
            const modal = document.getElementById('modalSaudeFinanceiraLar');
            if (modal) modal.classList.remove('hidden');
            lucide.createIcons();
        }

        // --- 1. MODAL: SOLICITAR RESGATE DO FUNDO DE EMERGÊNCIA (CONSENSO BILATERAL) ---
        function abrirModalSolicitarResgateEmergenciaLar() {
            const inputVal = document.getElementById('resgateEmergenciaValorInput');
            if (inputVal) inputVal.value = '500,00';
            aoDigitarValorResgateEmergencia('500,00');

            const modal = document.getElementById('modalSolicitarResgateEmergenciaLar');
            if (modal) modal.classList.remove('hidden');
            lucide.createIcons();
        }

        function solicitarUsoEmergenciaLar() {
            abrirModalSolicitarResgateEmergenciaLar();
        }

        function preencherValorResgateEmergencia(valor) {
            const inputVal = document.getElementById('resgateEmergenciaValorInput');
            if (inputVal) {
                inputVal.value = valor.toFixed(2).replace('.', ',');
                aoDigitarValorResgateEmergencia(inputVal.value);
            }
        }

        function aoDigitarValorResgateEmergencia(valorStr) {
            const limpo = parseFloat((valorStr || '0').replace('.', '').replace(',', '.')) || 0;
            const novoSaldo = Math.max(0, 5000 - limpo);
            const novoPct = Math.min(100, Math.round((novoSaldo / 10000) * 100));

            const saldoTxt = document.getElementById('resgateEmergenciaNovoSaldoTxt');
            if (saldoTxt) saldoTxt.innerText = `Restará no Fundo: ${BRL(novoSaldo)}`;

            const pctTxt = document.getElementById('resgateEmergenciaNovoPctTxt');
            if (pctTxt) pctTxt.innerText = `${novoPct}% da meta (${novoPct < 30 ? 'atenção' : '~' + Math.round(novoSaldo / 1667) + ' meses'})`;
        }

        function selecionarContaCreditoResgate(btn, conta) {
            document.querySelectorAll('.chip-conta-resgate').forEach(b => {
                b.className = 'chip-conta-resgate p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30';
            });
            if (btn) {
                btn.className = 'chip-conta-resgate active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition';
            }
            const inputHidden = document.getElementById('resgateEmergenciaContaDestino');
            if (inputHidden) inputHidden.value = conta;
        }

        async function executarSolicitarResgateEmergenciaLar(e) {
            e.preventDefault();
            const inputVal = document.getElementById('resgateEmergenciaValorInput');
            const valor = parseFloat((inputVal?.value || '0').replace('.', '').replace(',', '.')) || 0;
            const motivo = document.getElementById('resgateEmergenciaMotivoSelect')?.value || 'imprevisto';
            const descricao = document.getElementById('resgateEmergenciaDescricaoInput')?.value || '';
            const contaDestino = document.getElementById('resgateEmergenciaContaDestino')?.value || 'nubank_duda';

            if (valor <= 0) {
                return seivaNotificar('Informe o valor que precisa resgatar.', 'aviso');
            }

            try {
                const res = await fetch('/api/lar/fundo-emergencia/resgatar', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ valor, motivo, descricao, conta_destino: contaDestino })
                });

                if (res.ok) {
                    fecharModalId('modalSolicitarResgateEmergenciaLar');
                    seivaNotificar(`Proposta de resgate de ${BRL(valor)} enviada com urgência para a Mesa de Acordos!`, 'sucesso', 'Proposta Criada');
                    carregarLarDados();
                } else {
                    seivaNotificar('Não foi possível submeter a solicitação de emergência.', 'erro');
                }
            } catch (err) {
                seivaNotificar('Erro de conexão ao solicitar resgate emergencial.', 'erro');
            }
        }

        // --- 1.1. MODAL: GESTÃO DE PENDÊNCIA / COBRADOR DIPLOMATA / CONTESTAÇÃO ---
        function abrirModalContestarEnvioLar() {
            const modal = document.getElementById('modalContestarEnvioLar');
            if (modal) modal.classList.remove('hidden');
            lucide.createIcons();
        }

        async function enviarLembreteDiplomataWhatsapp() {
            try {
                await fetch('/api/lar/notificar-pendencia', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ tipo_acao: 'diplomata' })
                });
                fecharModalId('modalContestarEnvioLar');
                seivaNotificar('Mensagem carinhosa preparada! Copiada para a área de transferência.', 'sucesso', 'Cobrador Diplomata');
            } catch (err) {
                fecharModalId('modalContestarEnvioLar');
                seivaNotificar('Mensagem carinhosa enviada ao parceiro!', 'sucesso');
            }
        }

        async function solicitarComprovantePixParceiro() {
            try {
                await fetch('/api/lar/notificar-pendencia', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ tipo_acao: 'comprovante' })
                });
                fecharModalId('modalContestarEnvioLar');
                seivaNotificar('Solicitação delicada de comprovante enviada para o parceiro!', 'sucesso', 'Conciliação Solicitada');
            } catch (err) {
                fecharModalId('modalContestarEnvioLar');
                seivaNotificar('Pedido de comprovante registrado!', 'sucesso');
            }
        }

        // --- 1.2. PERSONALIZAÇÃO DO NOSSO CANTINHO (FOTO E NOME) ---
        function abrirModalEditarLar() {
            const modal = document.getElementById('modalEditarLar');
            if (modal) modal.classList.remove('hidden');
            lucide.createIcons();
        }

        function selecionarFotoCapaLar(btn, url) {
            document.querySelectorAll('.chip-foto-lar').forEach(b => {
                b.className = 'chip-foto-lar relative rounded-2xl overflow-hidden border border-border aspect-video group text-left';
            });
            if (btn) {
                btn.className = 'chip-foto-lar active relative rounded-2xl overflow-hidden border-2 border-emerald-600 aspect-video group text-left';
            }
            const inputHidden = document.getElementById('editLarFotoEscolhida');
            if (inputHidden) inputHidden.value = url;
        }

        async function salvarPersonalizacaoLar(e) {
            e.preventDefault();
            const nome = document.getElementById('editLarNomeInput')?.value || 'Nosso Cantinho';
            const foto = document.getElementById('editLarFotoEscolhida')?.value || '/lar-inicio.png';
            const desde = document.getElementById('editLarDesdeInput')?.value || 'abril de 2026';

            try {
                const res = await fetch('/api/lar/foto-capa', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ nome, foto, desde })
                });

                if (res.ok) {
                    const imgEl = document.getElementById('larFotoCapaImg');
                    if (imgEl) imgEl.src = foto;
                    const nomeBadge = document.getElementById('larTopoNomeBadge');
                    if (nomeBadge) nomeBadge.innerText = nome;
                    const casalSub = document.getElementById('larCasalSubtitulo');
                    if (casalSub) casalSub.innerText = `${larDadosCache?.lar?.nomes_membros || nome} · desde ${desde}`;

                    fecharModalId('modalEditarLar');
                    seivaNotificar('Nosso Cantinho atualizado com carinho!', 'sucesso', 'Lar Personalizado');
                }
            } catch (err) {
                fecharModalId('modalEditarLar');
                seivaNotificar('Alterações salvas com sucesso!', 'sucesso');
            }
        }

        // --- 1.3. ACELERADOR DE CONQUISTA DAS METAS DO LAR ---
        function adiantarDiasMetaLar(idMeta, valor, dias) {
            seivaNotificar(`Aporte extra de ${BRL(valor)} registrado! Você adiantou ${dias} dias na conquista do casal! 🚀`, 'sucesso', 'Meta Agilizada');
        }

        // --- 1.4. SIMULAÇÃO DE RATEIO EM TEMPO REAL NO MODAL DE LANÇAR DESPESA DO LAR ---
        function atualizarSimulacaoRateioLar() {
            const inputVal = document.getElementById('formLarDespValor');
            const total = parseFloat(inputVal?.value || 0);
            const regra = document.getElementById('formLarDespDivisao')?.value || 'proporcional';

            let parteDuda = 0;
            let parteIan = 0;
            let pctDudaTxt = '(40% do total)';
            let pctIanTxt = '(60% do total)';

            if (regra === '50/50') {
                parteDuda = total / 2;
                parteIan = total / 2;
                pctDudaTxt = '(50% do total)';
                pctIanTxt = '(50% do total)';
            } else {
                // Proporcional 40% Duda / 60% Ian
                parteDuda = total * 0.4;
                parteIan = total * 0.6;
            }

            const elDuda = document.getElementById('simulacaoParteDuda');
            if (elDuda) elDuda.innerText = BRL(parteDuda);
            const elPctDuda = document.getElementById('simulacaoPctDuda');
            if (elPctDuda) elPctDuda.innerText = pctDudaTxt;

            const elIan = document.getElementById('simulacaoParteIan');
            if (elIan) elIan.innerText = BRL(parteIan);
            const elPctIan = document.getElementById('simulacaoPctIan');
            if (elPctIan) elPctIan.innerText = pctIanTxt;
        }

        function selecionarTipoDespesaLar(btn, tipo) {
            document.querySelectorAll('.chip-tipo-desp-lar').forEach(b => {
                b.className = 'chip-tipo-desp-lar p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30 flex items-center gap-2.5';
            });
            if (btn) {
                btn.className = 'chip-tipo-desp-lar active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition flex items-center gap-2.5';
            }
            const input = document.getElementById('formLarDespTipo');
            if (input) input.value = tipo;
        }

        function alternarAvisoExtraordinaria(marcado) {
            const aviso = document.getElementById('avisoExtraordinariaTxt');
            if (aviso) {
                if (marcado) aviso.classList.remove('hidden');
                else aviso.classList.add('hidden');
            }
        }

        function selecionarRegraDivisaoLar(btn, regra) {
            document.querySelectorAll('.chip-regra-divisao').forEach(b => {
                b.className = 'chip-regra-divisao p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30';
            });
            if (btn) {
                btn.className = 'chip-regra-divisao active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition';
            }
            const input = document.getElementById('formLarDespDivisao');
            if (input) input.value = regra;
            atualizarSimulacaoRateioLar();
        }

        // --- 1.1 MODAL: EDITAR DESPESA DO LAR & REAJUSTE (RF004/RF010 - Jhon Abner) ---
        function abrirModalEditarDespesaLar(d) {
            if (!d) return;
            const id = typeof d === 'object' ? (d.id || d.id_despesa_lar) : d;
            const titulo = typeof d === 'object' ? (d.titulo || '') : '';
            const valor = typeof d === 'object' ? (d.valor_total || d.valor || 0) : 0;
            const tipo = typeof d === 'object' ? (d.tipo || 'fixa') : 'fixa';
            const divisao = (typeof d === 'object' && d.divisao && (d.divisao.includes('50') || d.divisao === '50/50')) ? '50/50' : 'proporcional';
            const dataVenc = typeof d === 'object' ? (d.data_vencimento || '2026-07-05') : '2026-07-05';

            const inId = document.getElementById('editLarDespId');
            if (inId) inId.value = id;
            const inTit = document.getElementById('editLarDespTitulo');
            if (inTit) inTit.value = titulo;
            const inVal = document.getElementById('editLarDespValor');
            if (inVal) inVal.value = valor;
            const inData = document.getElementById('editLarDespData');
            if (inData) inData.value = dataVenc;
            const inTipo = document.getElementById('editLarDespTipo');
            if (inTipo) inTipo.value = tipo;
            const inDiv = document.getElementById('editLarDespDivisao');
            if (inDiv) inDiv.value = divisao;

            // Sincroniza chips de tipo
            document.querySelectorAll('.chip-edit-tipo-lar').forEach(b => {
                b.className = 'chip-edit-tipo-lar p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30 flex items-center gap-2.5';
            });
            const btnTipoAlvo = document.querySelector(`.chip-edit-tipo-lar[onclick*="${tipo}"]`);
            if (btnTipoAlvo) {
                btnTipoAlvo.className = 'chip-edit-tipo-lar active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition flex items-center gap-2.5';
            }

            // Sincroniza chips de divisão
            document.querySelectorAll('.chip-edit-regra-divisao').forEach(b => {
                b.className = 'chip-edit-regra-divisao p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30';
            });
            const btnDivAlvo = document.querySelector(`.chip-edit-regra-divisao[onclick*="${divisao}"]`);
            if (btnDivAlvo) {
                btnDivAlvo.className = 'chip-edit-regra-divisao active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition';
            }

            atualizarSimulacaoEdicaoRateioLar();
            abrirModalId('modalEditarDespesaLar');
            lucide.createIcons();
        }

        function selecionarEditTipoDespesaLar(btn, tipo) {
            document.querySelectorAll('.chip-edit-tipo-lar').forEach(b => {
                b.className = 'chip-edit-tipo-lar p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30 flex items-center gap-2.5';
            });
            if (btn) {
                btn.className = 'chip-edit-tipo-lar active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition flex items-center gap-2.5';
            }
            const inTipo = document.getElementById('editLarDespTipo');
            if (inTipo) inTipo.value = tipo;
        }

        function selecionarEditRegraDivisaoLar(btn, regra) {
            document.querySelectorAll('.chip-edit-regra-divisao').forEach(b => {
                b.className = 'chip-edit-regra-divisao p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30';
            });
            if (btn) {
                btn.className = 'chip-edit-regra-divisao active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition';
            }
            const inDiv = document.getElementById('editLarDespDivisao');
            if (inDiv) inDiv.value = regra;
            atualizarSimulacaoEdicaoRateioLar();
        }

        function atualizarSimulacaoEdicaoRateioLar() {
            const inputValor = document.getElementById('editLarDespValor');
            const total = parseFloat(inputValor?.value || 0) || 0;
            const regra = document.getElementById('editLarDespDivisao')?.value || 'proporcional';

            let parteDuda = 0;
            let parteIan = 0;
            let pctDudaTxt = '(40% do total)';
            let pctIanTxt = '(60% do total)';

            if (regra === '50/50') {
                parteDuda = total * 0.5;
                parteIan = total * 0.5;
                pctDudaTxt = '(50% do total)';
                pctIanTxt = '(50% do total)';
            } else {
                parteDuda = total * 0.4;
                parteIan = total * 0.6;
            }

            const elDuda = document.getElementById('editSimulacaoParteDuda');
            if (elDuda) elDuda.innerText = BRL(parteDuda);
            const elPctDuda = document.getElementById('editSimulacaoPctDuda');
            if (elPctDuda) elPctDuda.innerText = pctDudaTxt;

            const elIan = document.getElementById('editSimulacaoParteIan');
            if (elIan) elIan.innerText = BRL(parteIan);
            const elPctIan = document.getElementById('editSimulacaoPctIan');
            if (elPctIan) elPctIan.innerText = pctIanTxt;
        }

        async function executarSalvarEdicaoDespesaLar(event) {
            if (event) event.preventDefault();
            const id = document.getElementById('editLarDespId')?.value;
            const titulo = document.getElementById('editLarDespTitulo')?.value?.trim();
            const valor_total = parseFloat(document.getElementById('editLarDespValor')?.value || 0);
            const data_vencimento = document.getElementById('editLarDespData')?.value;
            const tipo = document.getElementById('editLarDespTipo')?.value || 'fixa';
            const divisao = document.getElementById('editLarDespDivisao')?.value || 'proporcional';

            if (!titulo || !valor_total || valor_total <= 0) {
                return seivaNotificar('Informe um título e um valor válido para a despesa.', 'aviso');
            }

            try {
                const res = await fetch(`/lar/despesas/${id}/atualizar`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        titulo,
                        valor_total,
                        tipo,
                        divisao,
                        data_vencimento
                    })
                });

                if (res.ok) {
                    fecharModalId('modalEditarDespesaLar');
                    seivaNotificar(`Despesa "${titulo}" atualizada para ${BRL(valor_total)}! O rateio do casal foi recalculado.`, 'sucesso', 'Despesa Reajustada');
                    carregarLarDados();
                } else {
                    const err = await res.json();
                    seivaNotificar(err.message || 'Erro ao salvar reajuste da despesa.', 'aviso');
                }
            } catch (e) {
                console.error(e);
                seivaNotificar('Erro ao conectar com o servidor.', 'erro');
            }
        }

        async function executarExcluirDespesaLar() {
            const id = document.getElementById('editLarDespId')?.value;
            const titulo = document.getElementById('editLarDespTitulo')?.value || 'esta despesa';
            if (!id) return fecharModalId('modalEditarDespesaLar');

            const confirmou = await seivaConfirm({
                titulo: 'Remover despesa do Lar?',
                mensagem: `Deseja realmente remover a despesa "${titulo}" do Lar?`,
                badge: { texto: 'Despesa Compartilhada do Lar', tipo: 'casal' },
                impacto: {
                    titulo: 'Recálculo Imediato do Rateio',
                    texto: 'As cotas mensais de Ian e Duda serão recalculadas imediatamente. Para proteger a confiança, a alteração ficará registrada no Histórico de Auditoria do Lar.'
                },
                tipo: 'perigo',
                icone: 'shield-alert',
                confirmText: 'Remover & Recalcular Rateio',
                cancelText: 'Cancelar (Manter Despesa)'
            });
            if (!confirmou) return;

            try {
                const res = await fetch(`/lar/despesas/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                if (res.ok) {
                    fecharModalId('modalEditarDespesaLar');
                    seivaNotificar(`Despesa "${titulo}" removida do Lar e rateio recalculado!`, 'info', 'Despesa Excluída');
                    carregarLarDados();
                } else {
                    const err = await res.json().catch(() => ({}));
                    seivaNotificar(err.mensagem || err.error || 'Não foi possível remover a despesa.', 'aviso');
                }
            } catch (e) {
                console.error(e);
                seivaNotificar('Erro de conexão ao excluir.', 'erro');
            }
        }

        // --- AÇÕES DA MESA DE ACORDOS DO LAR (RF006 - Ian Marcos) ---
        function aprovarPropostaAcordoLar(id, titulo) {
            seivaNotificar(`Proposta de acordo "${titulo}" aprovada com sucesso! O combinado agora está ativo.`, 'sucesso', 'Acordo Bilateral Selado');
            const contadorAtivos = document.getElementById('larAcordosAtivosContador');
            if (contadorAtivos) contadorAtivos.textContent = '3';
            const contadorNegoc = document.getElementById('larAcordosNegociacaoContador');
            if (contadorNegoc) contadorNegoc.textContent = '1';
            carregarLarDados();
        }

        async function contraproporAcordoLar(id, titulo) {
            const novoValor = await seivaPrompt({
                titulo: 'Propor novo valor',
                mensagem: `Quanto você sugere guardar ou pagar por mês para "${titulo}"?`,
                label: 'Sua sugestão mensal (R$)',
                defaultValue: '80,00',
                placeholder: 'Ex: 80,00',
                confirmText: 'Enviar Proposta Delicada'
            });
            if (novoValor) {
                seivaNotificar(`Contraproposta de R$ ${novoValor}/mês para "${titulo}" enviada delicadamente para Ian!`, 'sucesso', 'Contraproposta Enviada');
            }
        }

        async function renegociarAcordoCasal(id, titulo) {
            const confirmou = await seivaConfirm({
                titulo: 'Renegociação Delicada',
                mensagem: `Deseja propor uma pausa amigável de 1 mês ou reajustar a parcela de "${titulo}"?`,
                badge: { texto: 'Mesa de Acordos Diplomática', tipo: 'casal' },
                impacto: {
                    titulo: 'Sem Multas ou Atrito',
                    texto: 'A proposta será levada à Mesa de Acordos para que o casal decida em harmonia, sem juros ou cobranças constrangedoras.'
                },
                tipo: 'info',
                icone: 'handshake',
                confirmText: 'Abrir Renegociação',
                cancelText: 'Manter como Está'
            });
            if (confirmou) {
                seivaNotificar(`Solicitação de renegociação para "${titulo}" aberta na Mesa de Acordos sem multas ou atrito!`, 'info', 'Renegociação Solicitada');
            }
        }

        // --- 2. MODAL: REGISTRAR PAGAMENTO DE DESPESA FIXA DO LAR ---
        function abrirModalPagamentoDespesaFixaLar(titulo, valor, id) {
            const titEl = document.getElementById('regPagamentoLarTitulo');
            if (titEl) titEl.innerText = titulo;
            const subEl = document.getElementById('regPagamentoLarSubtitulo');
            if (subEl) subEl.innerText = `${titulo} · Divisão 50 / 50`;
            const valEl = document.getElementById('regPagamentoLarValor');
            if (valEl) valEl.innerText = BRL(valor);

            const cotaEu = document.getElementById('regPagamentoLarCotaEu');
            if (cotaEu) cotaEu.innerText = BRL(valor / 2);
            const cotaParceiro = document.getElementById('regPagamentoLarCotaParceiro');
            if (cotaParceiro) cotaParceiro.innerText = BRL(valor / 2);

            const progEl = document.getElementById('regPagamentoLarProgressoTxt');
            if (progEl) progEl.innerHTML = `<i data-lucide="info" class="size-3.5 text-emerald-600 shrink-0"></i> <span>Sua parte (50%): ${BRL(valor / 2)} · Parte de Ian (50%): ${BRL(valor / 2)}. Ao pagar, o valor adiantado é creditado na Mesa de Acordos.</span>`;

            const inputId = document.getElementById('regPagamentoLarDespesaId');
            if (inputId) inputId.value = id;
            const inputVal = document.getElementById('regPagamentoLarValorInput');
            if (inputVal) inputVal.value = valor;
            const inputTit = document.getElementById('regPagamentoLarTituloInput');
            if (inputTit) inputTit.value = titulo;

            const btnSub = document.getElementById('regPagamentoLarBtnSubmit');
            if (btnSub) btnSub.innerHTML = `<i data-lucide="check" class="size-4"></i> <span>Confirmar que paguei ${BRL(valor)}</span>`;

            removerComprovantePagLar();
            const modal = document.getElementById('modalRegistrarPagamentoLar');
            if (modal) modal.classList.remove('hidden');
            lucide.createIcons();
        }

        function selecionarContaPagamentoLar(btn, contaId) {
            const container = document.getElementById('regPagamentoLarContasChips');
            if (container) {
                container.querySelectorAll('.chip-conta-pag-lar').forEach(b => {
                    b.className = 'chip-conta-pag-lar flex items-center gap-1.5 px-3.5 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition';
                });
            }
            if (btn) {
                btn.className = 'chip-conta-pag-lar active flex items-center gap-1.5 px-3.5 py-2 rounded-2xl border-2 border-emerald-600 bg-emerald-800 text-white font-bold text-xs transition';
            }
            const inputHidden = document.getElementById('regPagamentoLarContaId');
            if (inputHidden) inputHidden.value = contaId;
        }

        function aoSelecionarComprovantePagLar(input) {
            if (input.files && input.files[0]) {
                const box = document.getElementById('boxComprovantePagLar');
                const preview = document.getElementById('previewComprovantePagLar');
                if (box) box.classList.add('hidden');
                if (preview) preview.classList.remove('hidden');
            }
        }

        function removerComprovantePagLar(e) {
            if (e) e.stopPropagation();
            const input = document.getElementById('regPagamentoLarComprovanteInput');
            if (input) input.value = '';
            const box = document.getElementById('boxComprovantePagLar');
            const preview = document.getElementById('previewComprovantePagLar');
            if (box) box.classList.remove('hidden');
            if (preview) preview.classList.add('hidden');
        }

        async function executarConfirmarPagamentoDespesaLar(e) {
            e.preventDefault();
            const despesaId = document.getElementById('regPagamentoLarDespesaId')?.value;
            const valor = parseFloat(document.getElementById('regPagamentoLarValorInput')?.value || 0);
            const titulo = document.getElementById('regPagamentoLarTituloInput')?.value || 'Despesa';
            const contaId = document.getElementById('regPagamentoLarContaId')?.value || 1;

            try {
                const res = await fetch('/api/lar/despesas/pagar', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ despesa_id: despesaId, valor, conta_id: contaId })
                });

                if (res.ok) {
                    fecharModalId('modalRegistrarPagamentoLar');
                    seivaNotificar(`Pagamento de ${titulo} (${BRL(valor)}) registrado com sucesso!`, 'sucesso', 'Conta Quitada');
                    carregarLarDados();
                    carregarDashboardDados();
                    carregarExtratoDados();
                } else {
                    seivaNotificar('Não foi possível registrar o pagamento.', 'erro');
                }
            } catch (err) {
                seivaNotificar('Erro de conexão ao quitar despesa.', 'erro');
            }
        }

        // --- 3. MODAL: GUARDAR EM META DO LAR COM PIX ---
        function abrirModalGuardarMetaLarPix(meta) {
            metaPixAtual = meta;
            const headerTit = document.getElementById('guardarMetaLarPixTituloHeader');
            if (headerTit) headerTit.innerText = `Guardar em ${meta.titulo}`;

            const progVal = document.getElementById('guardarMetaLarPixProgressoValores');
            if (progVal) progVal.innerText = `${BRL(meta.valor_atual)} de ${BRL(meta.valor_alvo)}`;

            const barra = document.getElementById('guardarMetaLarPixBarra');
            if (barra) barra.style.width = `${meta.progresso}%`;

            const nomeResp = document.getElementById('guardarMetaLarPixNomeResp');
            if (nomeResp) nomeResp.innerText = meta.responsavel || (larDadosCache?.lar?.nomes_membros || 'Parceiro(a)');

            const bancoResp = document.getElementById('guardarMetaLarPixBancoResp');
            if (bancoResp) bancoResp.innerText = meta.conta_destino || 'Conta do Lar';

            const chavePix = document.getElementById('guardarMetaLarPixChaveValor');
            if (chavePix) chavePix.innerText = meta.pix || '(71) 99812-3456';

            const inputMetaId = document.getElementById('guardarMetaLarPixMetaId');
            if (inputMetaId) inputMetaId.value = meta.id_meta;

            const inputValor = document.getElementById('guardarMetaLarPixInputValor');
            if (inputValor) inputValor.value = '250,00';
            atualizarCalculoMetaLarPix('250,00');

            removerComprovanteMetaLarPix();
            const modal = document.getElementById('modalGuardarMetaLarPix');
            if (modal) modal.classList.remove('hidden');
            lucide.createIcons();
        }

        function preencherValorMetaLarPix(valor) {
            const inputVal = document.getElementById('guardarMetaLarPixInputValor');
            if (inputVal) {
                inputVal.value = valor.toFixed(2).replace('.', ',');
                atualizarCalculoMetaLarPix(inputVal.value);
            }
        }

        function atualizarCalculoMetaLarPix(valorStr) {
            const txt = document.getElementById('guardarMetaLarPixSeraTxt');
            if (!txt || !metaPixAtual) return;
            const limpo = parseFloat((valorStr || '0').replace('.', '').replace(',', '.')) || 0;
            const novoAtual = (metaPixAtual.valor_atual || 0) + limpo;
            const alvo = metaPixAtual.valor_alvo || 3200;
            const pct = Math.min(100, Math.round((novoAtual / alvo) * 100));
            txt.innerText = `Será ${pct}% após guardar (${BRL(novoAtual)} de ${BRL(alvo)})`;
        }

        function selecionarContaMetaLarPix(btn, contaId) {
            const grid = document.getElementById('guardarMetaLarPixContasGrid');
            if (grid) {
                grid.querySelectorAll('.chip-conta-pix').forEach(b => {
                    b.className = 'chip-conta-pix p-3 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30 flex items-center gap-2.5';
                });
            }
            if (btn) {
                btn.className = 'chip-conta-pix active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition flex items-center gap-2.5';
            }
            const inputHidden = document.getElementById('guardarMetaLarPixContaId');
            if (inputHidden) inputHidden.value = contaId;
        }

        function copiarChavePixMetaLar() {
            const chave = document.getElementById('guardarMetaLarPixChaveValor')?.innerText || '(71) 99812-3456';
            if (navigator.clipboard) {
                navigator.clipboard.writeText(chave).then(() => {
                    seivaNotificar(`Chave Pix "${chave}" copiada!`, 'sucesso', 'Chave Copiada');
                });
            } else {
                seivaNotificar(`Chave Pix: ${chave}`, 'info');
            }
        }

        function aoSelecionarComprovanteMetaLarPix(input) {
            if (input.files && input.files[0]) {
                const box = document.getElementById('boxComprovanteMetaPix');
                const preview = document.getElementById('previewComprovanteMetaPix');
                if (box) box.classList.add('hidden');
                if (preview) preview.classList.remove('hidden');
            }
        }

        function removerComprovanteMetaLarPix(e) {
            if (e) e.stopPropagation();
            const input = document.getElementById('guardarMetaLarPixComprovanteInput');
            if (input) input.value = '';
            const box = document.getElementById('boxComprovanteMetaPix');
            const preview = document.getElementById('previewComprovanteMetaPix');
            if (box) box.classList.remove('hidden');
            if (preview) preview.classList.add('hidden');
        }

        async function executarSalvarAporteMetaLarPix(e) {
            e.preventDefault();
            const metaId = document.getElementById('guardarMetaLarPixMetaId')?.value;
            const inputVal = document.getElementById('guardarMetaLarPixInputValor');
            const valNum = parseFloat((inputVal?.value || '0').replace('.', '').replace(',', '.')) || 0;
            const contaId = document.getElementById('guardarMetaLarPixContaId')?.value || 1;

            if (valNum <= 0) {
                return seivaNotificar('Informe um valor válido para guardar.', 'aviso');
            }

            try {
                const res = await fetch(`/api/metas/${metaId}/guardar`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ valor: valNum, conta_id: contaId })
                });

                if (res.ok) {
                    fecharModalId('modalGuardarMetaLarPix');
                    seivaNotificar(`Aporte de ${BRL(valNum)} guardado na meta!`, 'sucesso', 'Meta Atualizada');
                    carregarLarDados();
                } else {
                    seivaNotificar('Não foi possível registrar o aporte na meta.', 'erro');
                }
            } catch (err) {
                seivaNotificar('Erro de conexão ao salvar aporte.', 'erro');
            }
        }

        // --- 4. MODAL: ATUALIZAR META DO LAR ---
        function abrirModalAtualizarMetaLar(id, titulo, alvo, prazo) {
            const header = document.getElementById('atualizarMetaLarTituloHeader');
            if (header) header.innerText = `Atualizar "${titulo}"`;

            const idInput = document.getElementById('atualizarMetaLarId');
            if (idInput) idInput.value = id;

            const valorInput = document.getElementById('atualizarMetaLarNovoValor');
            if (valorInput) valorInput.value = alvo;

            const prazoInput = document.getElementById('atualizarMetaLarNovoPrazo');
            if (prazoInput) prazoInput.value = prazo || 'nov/2026';

            const modal = document.getElementById('modalAtualizarMetaLar');
            if (modal) modal.classList.remove('hidden');
            lucide.createIcons();
        }

        async function executarSalvarEdicaoMetaLar(e) {
            e.preventDefault();
            const metaId = document.getElementById('atualizarMetaLarId')?.value;
            const novoValor = parseFloat(document.getElementById('atualizarMetaLarNovoValor')?.value || 0);
            const novoPrazo = document.getElementById('atualizarMetaLarNovoPrazo')?.value;

            try {
                const res = await fetch(`/api/metas/${metaId}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ valor_alvo: novoValor, data_limite: novoPrazo })
                });

                if (res.ok) {
                    fecharModalId('modalAtualizarMetaLar');
                    seivaNotificar('Meta do Lar atualizada com sucesso!', 'sucesso', 'Meta Atualizada');
                    carregarLarDados();
                } else {
                    seivaNotificar('Não foi possível atualizar a meta.', 'erro');
                }
            } catch (err) {
                seivaNotificar('Erro de conexão ao atualizar meta.', 'erro');
            }
        }

        // --- 5. MODAL: DESFAZER META DO LAR ---
        function abrirModalDesfazerMetaLar(id, titulo, guardado) {
            const header = document.getElementById('desfazerMetaLarTituloHeader');
            if (header) header.innerText = `Desfazer "${titulo}"`;

            const jaGuardadoTxt = document.getElementById('desfazerMetaLarJaGuardadoTxt');
            if (jaGuardadoTxt) jaGuardadoTxt.innerText = BRL(guardado);

            const metade = (guardado / 2);
            const devTxt = document.getElementById('desfazerMetaDevolucaoTxt');
            if (devTxt) devTxt.innerText = `Duda recebe ${BRL(metade)} · Ian recebe ${BRL(metade)}`;

            const fundoTxt = document.getElementById('desfazerMetaFundoTxt');
            if (fundoTxt) fundoTxt.innerText = `${BRL(guardado)} reforçam a reserva do Lar`;

            const modal = document.getElementById('modalDesfazerMetaLar');
            if (modal) modal.classList.remove('hidden');
            lucide.createIcons();
        }

        function selecionarDestinoDesfazerMeta(btn, destino) {
            destinoDesfazerEscolhido = destino;
            const modal = document.getElementById('modalDesfazerMetaLar');
            if (modal) {
                modal.querySelectorAll('.chip-destino-desfazer').forEach(b => {
                    b.className = 'chip-destino-desfazer w-full p-4 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/30 flex items-center justify-between';
                });
            }
            if (btn) {
                btn.className = 'chip-destino-desfazer active w-full p-4 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition flex items-center justify-between';
            }
        }

        async function executarConfirmarDesfazerMetaLar(e) {
            e.preventDefault();
            try {
                fecharModalId('modalDesfazerMetaLar');
                seivaNotificar('Meta desfeita e saldo redistribuído com sucesso!', 'sucesso', 'Meta Desfeita');
                carregarLarDados();
            } catch (err) {
                seivaNotificar('Erro ao desfazer meta.', 'erro');
            }
        }

        function abrirModalDespesaLar() {
            const modal = document.getElementById('modalDespesaLar');
            if (modal) modal.classList.remove('hidden');
            lucide.createIcons();
        }

        function abrirModalEmergenciaLar() {
            seivaNotificar('Abertura de despesa de emergência do casal.', 'aviso', 'Emergência');
        }

        function solicitarAcordoParceiro() {
            seivaNotificar('Lembrete diplomático enviado para Ian abrir nova proposta de acordo!', 'sucesso', 'Proposta Enviada');
        }

        // ==========================================
        // CAIXA PRETA — Área Privada Individual (RF002 / RF003)
        // Responsável Acadêmico: Victor Hugo
        // ==========================================
        let caixaPretaDadosCache = null;
        let caixaValoresOcultados = false;
        let despesaAjudaAtual = { id: null, titulo: 'Mercado Dia a Dia', valor: 312.80 };
        let metaAporteAtual = { id: null, titulo: '', atual: 0, alvo: 0, tipo: 'individual' };

        function inicializarOuCarregarCaixaPreta() {
            carregarCaixaPretaDados();
        }

        async function validarPinCaixa() {
            const pin = document.getElementById('caixaPinField')?.value;
            if (!pin || pin.length < 4) {
                return seivaNotificar('Digite o PIN de 4 dígitos da Caixa Preta.', 'aviso', 'PIN obrigatório');
            }

            try {
                const res = await fetch('/api/caixa-preta/verificar-pin', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({ pin })
                });

                const data = await res.json();
                if (data.unlocked) {
                    document.getElementById('caixaPinLockBox')?.classList.add('hidden');
                    document.getElementById('caixaUnsealedBox')?.classList.remove('hidden');
                    carregarCaixaPretaDados();
                    seivaNotificar('Caixa Preta desbloqueada com sucesso!', 'sucesso', 'Acesso Concedido');
                } else {
                    seivaNotificar(data.error || 'PIN incorreto. Tente novamente.', 'erro', 'Acesso negado');
                }
            } catch (e) {
                seivaNotificar('Erro ao validar PIN. Tente novamente.', 'erro');
            }
        }

        async function trancarCaixa() {
            const pinField = document.getElementById('caixaPinField');
            if (pinField) pinField.value = '';
            document.getElementById('caixaPinLockBox')?.classList.remove('hidden');
            document.getElementById('caixaUnsealedBox')?.classList.add('hidden');
            
            try {
                await fetch('/api/caixa-preta/trancar', {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' }
                });
            } catch(e) {}

            seivaNotificar('Caixa Preta trancada com segurança.', 'info', 'Área Bloqueada');
        }

        function toggleOcultarValoresCaixa() {
            caixaValoresOcultados = !caixaValoresOcultados;
            const btnTxt = document.getElementById('btnOcultarValoresCaixaTxt');
            const btn = document.getElementById('btnOcultarValoresCaixa');

            if (btnTxt) {
                btnTxt.innerText = caixaValoresOcultados ? 'Mostrar valores' : 'Ocultar valores';
            }
            if (btn) {
                btn.innerHTML = caixaValoresOcultados 
                    ? `<i data-lucide="eye" class="size-3.5 text-emerald-400"></i><span id="btnOcultarValoresCaixaTxt">Mostrar valores</span>`
                    : `<i data-lucide="eye-off" class="size-3.5 text-emerald-400"></i><span id="btnOcultarValoresCaixaTxt">Ocultar valores</span>`;
            }

            document.querySelectorAll('#caixaUnsealedBox .valor-sensivel').forEach(el => {
                if (caixaValoresOcultados) {
                    if (!el.dataset.valorReal) el.dataset.valorReal = el.innerText;
                    el.innerText = '••••••';
                } else {
                    if (el.dataset.valorReal) el.innerText = el.dataset.valorReal;
                }
            });

            lucide.createIcons();
            seivaNotificar(caixaValoresOcultados ? 'Valores ocultados na tela.' : 'Valores visíveis.', 'info', 'Privacidade');
        }

        function mostrarInstrucaoEsqueciPin() {
            seivaNotificar('Por segurança da sua Caixa Preta, seu PIN de 4 dígitos pode ser redefinido na aba "Perfil & LGPD" > "Segurança Privada".', 'info', 'Redefinição de PIN');
        }

        function explicarPatrimonio() {
            seivaNotificar('Patrimônio Líquido: Soma de todas as contas, dinheiro em espécie, poupanças e investimentos sob sua titularidade individual. Não inclui valores do parceiro nem faturas devidas.', 'info', 'O que é seu Patrimônio');
        }

        async function carregarCaixaPretaDados() {
            try {
                const res = await fetch('/api/caixa-preta/dados');
                if (res.status === 403) {
                    // Trancada: exibe tela de PIN
                    document.getElementById('caixaPinLockBox')?.classList.remove('hidden');
                    document.getElementById('caixaUnsealedBox')?.classList.add('hidden');
                    return;
                }
                if (!res.ok) return;

                const data = await res.json();
                caixaPretaDadosCache = data;

                // Destrancar caixa
                document.getElementById('caixaPinLockBox')?.classList.add('hidden');
                document.getElementById('caixaUnsealedBox')?.classList.remove('hidden');

                // 1. Hero Card Patrimônio Individual
                const pat = data.patrimonio || {};
                const patTotalEl = document.getElementById('caixaPatrimonioTotal');
                const patLivreEl = document.getElementById('caixaPatrimonioLivre');
                const patCompEl  = document.getElementById('caixaPatrimonioComprometido');
                const patGuardEl = document.getElementById('caixaPatrimonioGuardado');
                if (patTotalEl) patTotalEl.innerText = BRL(pat.total_individual || 0);
                if (patLivreEl) patLivreEl.innerText = BRL(pat.livre_pra_usar || 0);
                if (patCompEl)  patCompEl.innerText  = BRL(pat.comprometido || 0);
                if (patGuardEl) patGuardEl.innerText = BRL(pat.guardado || 0);

                // 2. Banner de Pedido de Ajuda do Parceiro
                const bannerAjuda = document.getElementById('caixaBannerPedidoAjuda');
                if (bannerAjuda) {
                    if (data.is_casal && data.pedido_ajuda) {
                        bannerAjuda.classList.remove('hidden');
                        const pAj = data.pedido_ajuda;
                        const remEl = document.getElementById('caixaAjudaRemetenteTitulo');
                        const itmEl = document.getElementById('caixaAjudaItemTexto');
                        const dscEl = document.getElementById('caixaAjudaItemDesc');
                        const tagEl = document.getElementById('caixaAjudaItemTag');
                        if (remEl) remEl.innerText = `${pAj.solicitante} pediu sua ajuda`;
                        if (itmEl) itmEl.innerHTML = `${pAj.solicitante} pediu uma ajuda de <span class="text-emerald-400 font-extrabold">${BRL(pAj.valor)}</span>`;
                        if (dscEl) dscEl.innerText = pAj.motivo || '';
                        if (tagEl) tagEl.innerText = pAj.tag || '';
                    } else {
                        bannerAjuda.classList.add('hidden');
                    }
                }

                // 3. Minhas Contas e Cartões
                const cec = data.contas_e_cartoes || {};
                const badgeCount = document.getElementById('caixaContasCountBadge');
                if (badgeCount) badgeCount.innerText = `${cec.total_contas || 0} contas · ${cec.total_cartoes || 0} cartões`;

                const gridContas = document.getElementById('caixaGridContas');
                if (gridContas) {
                    gridContas.innerHTML = (cec.contas || []).map(c => `
                        <div class="rounded-2xl border border-emerald-900/40 bg-[#0d2016] p-4 text-white space-y-3 shadow-2xs hover:border-emerald-700/50 transition">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="size-8 rounded-xl bg-white/10 flex items-center justify-center text-sm" style="color: ${c.cor || '#10b981'}">
                                        <i data-lucide="${c.icone || 'wallet'}" class="size-4"></i>
                                    </span>
                                    <div>
                                        <h4 class="text-xs font-bold text-white truncate">${c.nome}</h4>
                                        <span class="text-[10px] text-gray-400">${c.tipo}</span>
                                    </div>
                                </div>
                                ${c.badge ? `<span class="px-2 py-0.5 rounded-full bg-emerald-950 text-emerald-300 border border-emerald-700/50 text-[9px] font-bold">${c.badge}</span>` : ''}
                            </div>
                            <div>
                                <strong class="text-base font-black text-white block valor-sensivel">${BRL(c.saldo)}</strong>
                                <div class="flex items-center justify-between text-[10px] text-gray-400 mt-0.5">
                                    <span>Livre: <strong class="text-emerald-400 valor-sensivel">${BRL(c.livre)}</strong></span>
                                    ${c.comprometido > 0 ? `<span>Comprometido: <strong class="text-rose-400 valor-sensivel">${BRL(c.comprometido)}</strong></span>` : ''}
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-1 border-t border-emerald-900/30 text-[10px] text-gray-400">
                                <span>${c.atualizado || 'Atualizado'}</span>
                                <div class="flex items-center gap-2">
                                    <button type="button" onclick="abrirModalEditarConta(${JSON.stringify(c).replace(/"/g, '&quot;')})" class="text-white hover:text-emerald-300 font-bold flex items-center gap-1 transition" title="Editar conta">
                                        <i data-lucide="edit-3" class="size-3"></i> Editar
                                    </button>
                                    <button type="button" onclick="abrirModalAtualizarSaldo('${c.id_conta}')" class="text-emerald-400 font-bold hover:underline flex items-center gap-1">
                                        <i data-lucide="refresh-cw" class="size-3"></i> Saldo
                                    </button>
                                </div>
                            </div>
                        </div>
                    `).join('');
                }

                // Cartões de Crédito
                const contCartoes = document.getElementById('caixaContainerCartoes');
                if (contCartoes) {
                    contCartoes.innerHTML = (cec.cartoes || []).map(cart => `
                        <div class="rounded-2xl border border-rose-500/30 bg-[#160d11] p-4 text-white space-y-3 shadow-2xs">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <span class="size-8 rounded-xl bg-purple-950/80 text-purple-300 border border-purple-500/30 flex items-center justify-center">
                                        <i data-lucide="credit-card" class="size-4"></i>
                                    </span>
                                    <div>
                                        <h4 class="text-xs font-bold text-white">${cart.nome}</h4>
                                        <span class="text-[10px] text-gray-400">${cart.tipo}</span>
                                    </div>
                                </div>
                                ${cart.vence_hoje ? `<span class="px-2 py-0.5 rounded-full bg-rose-600 text-white text-[9px] font-black uppercase tracking-wider animate-pulse">Vence hoje</span>` : ''}
                            </div>
                            <div class="grid grid-cols-2 gap-3 pt-1">
                                <div>
                                    <span class="text-[10px] text-gray-400 block font-medium">Fatura atual</span>
                                    <strong class="text-sm font-black text-rose-400 valor-sensivel">${BRL(cart.fatura_atual)}</strong>
                                </div>
                                <div>
                                    <span class="text-[10px] text-gray-400 block font-medium">Limite disponível</span>
                                    <strong class="text-sm font-black text-white valor-sensivel">${BRL(cart.limite_disponivel)}</strong>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <div class="h-1.5 w-full rounded-full bg-white/10 overflow-hidden">
                                    <div class="h-full bg-rose-500 rounded-full" style="width: ${cart.percentual_usado}%"></div>
                                </div>
                                <span class="text-[10px] text-gray-400 block text-right">${cart.percentual_usado}% do limite de ${BRL(cart.limite_total)} usado</span>
                            </div>
                        </div>
                    `).join('');
                }

                // 4. O que você deve
                const dev = data.o_que_voce_deve || {};
                const listaDeve = document.getElementById('caixaListaOQueVoceDeve');
                if (listaDeve) {
                    listaDeve.innerHTML = (dev.itens || []).map(it => `
                        <div class="rounded-2xl border border-emerald-900/40 bg-[#0d2016] p-4 text-white space-y-3 shadow-2xs">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <span class="size-8 rounded-xl bg-white/10 text-emerald-300 flex items-center justify-center">
                                        <i data-lucide="${it.icone || 'receipt'}" class="size-4"></i>
                                    </span>
                                    <div>
                                        <h4 class="text-xs font-bold text-white">${it.titulo}</h4>
                                        <span class="text-[10px] text-gray-400">${it.subtitulo}</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <strong class="text-sm font-black text-white valor-sensivel">${BRL(it.valor)}</strong>
                                    ${it.status_label ? `<span class="text-[9px] block ${it.vence_hoje ? 'text-rose-400 font-bold' : 'text-gray-400'}">${it.status_label}</span>` : ''}
                                </div>
                            </div>
                            ${it.progresso_pct > 0 ? `
                                <div class="h-1.5 w-full rounded-full bg-white/10 overflow-hidden">
                                    <div class="h-full ${it.progresso_pct >= 100 ? 'bg-emerald-500' : 'bg-amber-500'} rounded-full" style="width: ${it.progresso_pct}%"></div>
                                </div>
                            ` : ''}
                            <button type="button" onclick="abrirModalRegistrarPagamento('${it.id}', '${it.titulo}', ${it.valor})" 
                                    class="w-full py-2 rounded-xl bg-white/5 hover:bg-white/10 text-xs font-bold text-gray-200 hover:text-white border border-white/10 transition flex items-center justify-center gap-1.5">
                                <i data-lucide="check" class="size-3.5"></i>
                                <span>Registrar pagamento</span>
                            </button>
                        </div>
                    `).join('');
                }

                // Total comprometido / mês
                const totCompEl = document.getElementById('caixaTotalComprometidoTxt');
                const barCompEl = document.getElementById('caixaBarraComprometidoRenda');
                const pctCompEl = document.getElementById('caixaPctComprometidoRendaTxt');
                if (totCompEl) totCompEl.innerText = BRL(dev.total_comprometido_mes || 0);
                if (barCompEl) barCompEl.style.width = `${dev.percentual_renda || 0}%`;
                if (pctCompEl) {
                    pctCompEl.innerHTML = `Você compromete <strong class="text-rose-400 font-extrabold">${dev.percentual_renda || 0}%</strong> da sua renda com despesas fixas e acordos.`;
                }

                // 5. Despesas só suas (CRUD Completo e Quitação Individual)
                const listaSoSuas = document.getElementById('caixaListaDespesasSoSuas');
                if (listaSoSuas) {
                    const despesas = data.despesas_so_suas || [];
                    if (!despesas.length) {
                        listaSoSuas.innerHTML = `
                            <div class="rounded-2xl border border-dashed border-white/20 p-6 text-center text-gray-400">
                                <i data-lucide="receipt" class="size-6 mx-auto mb-2 text-gray-500"></i>
                                <p class="text-xs">Nenhuma despesa fixa pessoal cadastrada.</p>
                                <button type="button" onclick="abrirModalNovaDespesaIndividual()" class="mt-2 text-xs font-bold text-emerald-400 hover:underline">
                                    + Cadastrar primeira despesa pessoal
                                </button>
                            </div>`;
                    } else {
                        listaSoSuas.innerHTML = despesas.map(ds => {
                            const isQuitado = ds.status === 'quitado';
                            const dsJsonStr = JSON.stringify(ds).replace(/"/g, '&quot;');
                            return `
                            <div class="rounded-2xl border border-emerald-900/40 bg-[#0d2016] p-3.5 text-white flex items-center justify-between gap-3 shadow-2xs hover:border-emerald-700/50 transition">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <span class="size-8 rounded-xl bg-white/10 text-emerald-300 flex items-center justify-center shrink-0">
                                        <i data-lucide="${ds.icone || 'receipt'}" class="size-4"></i>
                                    </span>
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            <h4 class="text-xs font-bold text-white truncate">${ds.titulo}</h4>
                                            ${isQuitado ? `
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 text-[9px] font-bold border border-emerald-500/30">
                                                    <i data-lucide="check" class="size-2.5"></i> Quitado
                                                </span>
                                            ` : `
                                                <span class="inline-flex items-center px-1.5 py-0.5 rounded-full bg-amber-500/20 text-amber-300 text-[9px] font-bold border border-amber-500/30">
                                                    Dia ${ds.dia_vencimento || 10}
                                                </span>
                                            `}
                                        </div>
                                        <span class="text-[10px] text-gray-400 block truncate">${ds.detalhe || ('Vence dia ' + (ds.dia_vencimento || 10) + ' · Pessoal')}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1.5 shrink-0">
                                    <span class="text-xs font-black text-white valor-sensivel mr-1">${BRL(ds.valor)}</span>
                                    
                                    ${!isQuitado ? `
                                        <button type="button" onclick="abrirModalQuitarDespesaIndividual(${dsJsonStr})" 
                                                title="Quitar despesa"
                                                class="px-2.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center gap-1 shadow-2xs transition cursor-pointer">
                                            <i data-lucide="check" class="size-3.5"></i>
                                            <span class="hidden sm:inline">Quitar</span>
                                        </button>
                                    ` : ''}

                                    ${data.is_casal ? `
                                        <button type="button" onclick="dividirDespesaComParceiro('${ds.id}', '${(ds.titulo || '').replace(/'/g, "\\'")}', ${ds.valor})" 
                                                title="Propor divisão na Mesa de Acordos"
                                                class="px-2 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/15 text-[10px] font-bold text-emerald-300 hover:text-white transition flex items-center gap-1">
                                            <i data-lucide="share-2" class="size-3"></i>
                                            <span class="hidden sm:inline">Dividir</span>
                                        </button>
                                    ` : ''}

                                    <button type="button" onclick="abrirModalEditarDespesaIndividual(${dsJsonStr})" 
                                            title="Editar despesa"
                                            class="size-7 rounded-xl bg-white/5 hover:bg-white/10 border border-white/15 text-gray-300 hover:text-white flex items-center justify-center transition cursor-pointer">
                                        <i data-lucide="edit-3" class="size-3.5"></i>
                                    </button>

                                    <button type="button" onclick="excluirDespesaIndividual(${ds.id}, '${(ds.titulo || '').replace(/'/g, "\\'")}')" 
                                            title="Remover despesa"
                                            class="size-7 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 border border-rose-500/30 text-rose-300 hover:text-rose-200 flex items-center justify-center transition cursor-pointer">
                                        <i data-lucide="trash-2" class="size-3.5"></i>
                                    </button>
                                </div>
                            </div>`;
                        }).join('');
                    }
                }

                // 6. Suas Metas & Wishlist
                const gridMetas = document.getElementById('caixaGridMetas');
                if (gridMetas) {
                    gridMetas.innerHTML = (data.metas || []).map(m => {
                        const p = m.percentual || Math.min(100, Math.round(((m.atual||0) / (m.alvo||1)) * 100));
                        return `
                        <div class="rounded-2xl border border-emerald-900/40 bg-[#0d2016] p-3.5 text-white space-y-2 shadow-2xs">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="size-7 rounded-lg bg-white/10 text-emerald-300 flex items-center justify-center text-xs">
                                        <i data-lucide="${m.icone || 'target'}" class="size-3.5"></i>
                                    </span>
                                    <h4 class="text-xs font-bold text-white truncate">${m.titulo}</h4>
                                </div>
                                <span class="text-xs font-black text-emerald-400">${p}%</span>
                            </div>
                            <div class="h-1.5 w-full rounded-full bg-white/10 overflow-hidden">
                                <div class="h-full bg-emerald-500 rounded-full" style="width: ${p}%"></div>
                            </div>
                            <div class="flex items-center justify-between text-[10px] text-gray-400">
                                <span><strong class="valor-sensivel">${BRL(m.atual)}</strong> de ${BRL(m.alvo)}</span>
                                <button type="button" onclick="abrirModalGuardarMeta(${m.id_meta || 1}, '${m.titulo}', ${m.atual}, ${m.alvo}, 'individual')" class="text-emerald-400 font-bold hover:underline">
                                    + Guardar
                                </button>
                            </div>
                        </div>`;
                    }).join('');
                }

                // Produtos de olho (Wishlist)
                const listaOlho = document.getElementById('caixaListaProdutosOlho');
                if (listaOlho) {
                    listaOlho.innerHTML = (data.produtos_de_olho || []).map(prod => `
                        <div class="rounded-2xl border border-emerald-900/40 bg-[#0d2016] p-3 text-white flex items-center justify-between gap-3 shadow-2xs hover:border-emerald-700/50 transition">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <img src="${prod.imagem}" alt="${prod.nome}" class="size-10 rounded-xl object-cover border border-emerald-900/50 shrink-0 bg-black/40" onerror="this.src='/icon.svg'">
                                <div class="min-w-0">
                                    <h5 class="text-xs font-bold text-white truncate">${prod.nome}</h5>
                                    <span class="text-[10px] text-gray-400 block truncate">${prod.loja || 'Loja online'}${prod.link ? ` · <a href="${prod.link}" target="_blank" class="text-emerald-400 hover:underline">Ver link ↗</a>` : ''}</span>
                                </div>
                            </div>
                            <div class="text-right shrink-0 space-y-1">
                                <strong class="text-xs font-black text-white block valor-sensivel">${BRL(prod.preco)}</strong>
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" onclick="abrirModalCriarMetaComDados('${prod.nome}', ${prod.preco})" class="text-[10px] text-emerald-400 font-bold hover:underline inline-flex items-center gap-1">
                                        <i data-lucide="target" class="size-3"></i> Criar meta
                                    </button>
                                    ${prod.id_produto ? `
                                        <button type="button" onclick="removerProdutoOlho(${prod.id_produto})" title="Remover" class="text-gray-400 hover:text-rose-400 transition">
                                            <i data-lucide="trash-2" class="size-3"></i>
                                        </button>
                                    ` : ''}
                                </div>
                            </div>
                        </div>
                    `).join('');
                }

                // 7. A Receber com confirmação e disputa
                const secAReceber = document.getElementById('caixaSecaoAReceber');
                if (secAReceber) {
                    if (data.is_casal && data.a_receber?.tem_a_receber) {
                        secAReceber.classList.remove('hidden');
                        const listaAReceber = document.getElementById('caixaListaAReceber');
                        if (listaAReceber) {
                            listaAReceber.innerHTML = (data.a_receber.itens || []).map(r => `
                                <div class="rounded-2xl border border-emerald-800/40 bg-[#0d2217] p-3.5 text-white flex flex-wrap items-center justify-between gap-3 shadow-2xs">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <span class="size-9 rounded-xl bg-emerald-950 text-emerald-300 border border-emerald-600/40 flex items-center justify-center shrink-0">
                                            <i data-lucide="${r.icone || 'hand-coins'}" class="size-4"></i>
                                        </span>
                                        <div class="min-w-0">
                                            <h4 class="text-xs font-bold text-white truncate">${r.titulo}</h4>
                                            <span class="text-[10px] text-gray-300 block truncate">${r.descricao}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 shrink-0">
                                        <strong class="text-xs font-black text-emerald-400 valor-sensivel pr-1">${BRL(r.valor)}</strong>
                                        <button type="button" onclick="confirmarRecebimentoAjuda('${r.id}', ${r.valor})" 
                                                class="px-2.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-[10px] font-bold text-white transition flex items-center gap-1 shadow-2xs">
                                            <i data-lucide="check" class="size-3"></i>
                                            <span>Confirmar que recebi</span>
                                        </button>
                                        <button type="button" onclick="disputarRecebimentoAjuda('${r.id}', ${r.valor}, '${r.titulo}')" 
                                                class="px-2 py-1.5 rounded-xl border border-rose-800/40 bg-rose-950/40 hover:bg-rose-900/60 text-rose-300 hover:text-white text-[10px] font-bold transition flex items-center gap-1"
                                                title="Solicitar comprovante ou informar que não caiu">
                                            <i data-lucide="alert-circle" class="size-3"></i>
                                            <span>Não recebi</span>
                                        </button>
                                    </div>
                                </div>
                            `).join('');
                        }
                    } else {
                        secAReceber.classList.add('hidden');
                    }
                }

                // 8. Gastos Recentes
                const listaGastos = document.getElementById('caixaListaGastosRecentes');
                if (listaGastos) {
                    listaGastos.innerHTML = (data.gastos_recentes || []).map(g => `
                        <div class="rounded-2xl border border-emerald-900/40 bg-[#0d2016] p-3 text-white flex items-center justify-between gap-3 shadow-2xs">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <span class="size-8 rounded-xl bg-white/10 text-emerald-300 flex items-center justify-center shrink-0">
                                    <i data-lucide="${g.icone || 'sparkles'}" class="size-4"></i>
                                </span>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-white truncate">${g.titulo}</h4>
                                    <span class="text-[10px] text-gray-400">${g.subtitulo}</span>
                                </div>
                            </div>
                            <strong class="text-xs font-black text-rose-400 shrink-0 valor-sensivel">-${BRL(g.valor)}</strong>
                        </div>
                    `).join('');
                }

                // 9. O que entrou este mês
                const listaEntrou = document.getElementById('caixaListaOQueEntrou');
                const totRecebido = document.getElementById('caixaTotalRecebidoTxt');
                if (listaEntrou) {
                    listaEntrou.innerHTML = (data.o_que_entrou || []).map(ent => `
                        <div class="rounded-2xl border border-emerald-900/40 bg-[#0d2016] p-3 text-white flex items-center justify-between gap-3 shadow-2xs">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <span class="size-8 rounded-xl bg-emerald-950 text-emerald-300 border border-emerald-500/20 flex items-center justify-center shrink-0">
                                    <i data-lucide="trending-up" class="size-4"></i>
                                </span>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-white truncate">${ent.titulo}</h4>
                                    <span class="text-[10px] text-gray-400">${ent.data}</span>
                                </div>
                            </div>
                            <strong class="text-xs font-black text-emerald-400 shrink-0 valor-sensivel">+${BRL(ent.valor)}</strong>
                        </div>
                    `).join('');
                }
                if (totRecebido) totRecebido.innerText = BRL(data.total_recebido || 0);

                // Botão pedir ajuda ao parceiro no rodapé
                const btnPedirAjuda = document.getElementById('caixaBtnPedirAjudaParceiro');
                if (btnPedirAjuda) {
                    if (data.is_casal) {
                        btnPedirAjuda.classList.remove('hidden');
                        const txtEl = document.getElementById('caixaBtnPedirAjudaTexto');
                        if (txtEl) txtEl.innerText = `Pedir ajuda de custo a ${data.parceiro_nome || 'parceiro'} →`;
                    } else {
                        btnPedirAjuda.classList.add('hidden');
                    }
                }

                // Se valores estavam ocultos, reaplica máscara
                if (caixaValoresOcultados) {
                    document.querySelectorAll('#caixaUnsealedBox .valor-sensivel').forEach(el => {
                        el.dataset.valorReal = el.innerText;
                        el.innerText = '••••••';
                    });
                }

                lucide.createIcons();

            } catch (e) {
                console.error('Erro ao carregar dados da Caixa Preta:', e);
            }
        }

        // ==========================================
        // DESPESAS FIXAS INDIVIDUAIS (CAIXA PRETA / SOLTEIRO)
        // ==========================================
        function abrirModalNovaDespesaIndividual() {
            const mId = document.getElementById('formDespIndivId');
            const titHeader = document.getElementById('tituloHeaderModalDespIndiv');
            const fTit = document.getElementById('formDespIndivTitulo');
            const fVal = document.getElementById('formDespIndivValor');
            const fDia = document.getElementById('formDespIndivDia');
            const fDet = document.getElementById('formDespIndivDetalhe');
            const fIco = document.getElementById('formDespIndivIcone');

            if (mId) mId.value = '';
            if (titHeader) titHeader.innerText = 'Nova Despesa Fixa Pessoal';
            if (fTit) fTit.value = '';
            if (fVal) fVal.value = '';
            if (fDia) fDia.value = '10';
            if (fDet) fDet.value = '';
            if (fIco) fIco.value = 'graduation-cap';

            document.querySelectorAll('.chip-icone-desp-indiv').forEach(b => {
                b.className = 'chip-icone-desp-indiv p-2.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground transition cursor-pointer';
            });
            const primeiroIcone = document.querySelector('.chip-icone-desp-indiv');
            if (primeiroIcone) {
                primeiroIcone.className = 'chip-icone-desp-indiv active p-2.5 rounded-xl border-2 border-emerald-600 bg-emerald-50/50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300 transition cursor-pointer';
            }

            abrirModalId('modalDespesaIndividual');
            if (window.lucide) lucide.createIcons();
        }

        function abrirModalEditarDespesaIndividual(ds) {
            if (!ds) return;
            const mId = document.getElementById('formDespIndivId');
            const titHeader = document.getElementById('tituloHeaderModalDespIndiv');
            const fTit = document.getElementById('formDespIndivTitulo');
            const fVal = document.getElementById('formDespIndivValor');
            const fDia = document.getElementById('formDespIndivDia');
            const fDet = document.getElementById('formDespIndivDetalhe');
            const fIco = document.getElementById('formDespIndivIcone');

            if (mId) mId.value = ds.id;
            if (titHeader) titHeader.innerText = 'Editar Despesa Pessoal';
            if (fTit) fTit.value = ds.titulo || '';
            if (fVal) fVal.value = parseFloat(ds.valor || 0).toLocaleString('pt-BR', { minimumFractionDigits: 2 });
            if (fDia) fDia.value = ds.dia_vencimento || 10;
            if (fDet) fDet.value = ds.detalhe || '';
            if (fIco) fIco.value = ds.icone || 'receipt';

            document.querySelectorAll('.chip-icone-desp-indiv').forEach(b => {
                b.className = 'chip-icone-desp-indiv p-2.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground transition cursor-pointer';
            });

            abrirModalId('modalDespesaIndividual');
            if (window.lucide) lucide.createIcons();
        }

        function selecionarIconeDespIndiv(btn, icone) {
            const fIco = document.getElementById('formDespIndivIcone');
            if (fIco) fIco.value = icone;
            document.querySelectorAll('.chip-icone-desp-indiv').forEach(b => {
                b.className = 'chip-icone-desp-indiv p-2.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground transition cursor-pointer';
            });
            if (btn) {
                btn.className = 'chip-icone-desp-indiv active p-2.5 rounded-xl border-2 border-emerald-600 bg-emerald-50/50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300 transition cursor-pointer';
            }
        }

        async function executarSalvarDespesaIndividual(event) {
            if (event) event.preventDefault();
            const id = document.getElementById('formDespIndivId')?.value;
            const titulo = document.getElementById('formDespIndivTitulo')?.value?.trim();
            const valorRaw = document.getElementById('formDespIndivValor')?.value || '0';
            const dia = parseInt(document.getElementById('formDespIndivDia')?.value || '10', 10);
            const icone = document.getElementById('formDespIndivIcone')?.value || 'receipt';
            const detalhe = document.getElementById('formDespIndivDetalhe')?.value?.trim();

            const valorLimpo = parseFloat(valorRaw.replace(/\./g, '').replace(',', '.')) || 0;
            if (!titulo || valorLimpo <= 0) {
                return seivaNotificar('Informe um nome e valor válido para a despesa pessoal.', 'aviso');
            }

            const url = id ? `/caixa-preta/despesas/${id}/atualizar` : '/caixa-preta/despesas';
            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        titulo,
                        valor: valorLimpo,
                        dia_vencimento: dia,
                        icone,
                        detalhe
                    })
                });

                const data = await res.json();
                if (res.ok) {
                    fecharModalId('modalDespesaIndividual');
                    seivaNotificar(data.mensagem || 'Despesa pessoal salva com sucesso!', 'sucesso', 'Despesa Gravada');
                    carregarCaixaPretaDados();
                    carregarDashboardDados();
                } else {
                    seivaNotificar(data.mensagem || 'Erro ao salvar despesa pessoal.', 'erro');
                }
            } catch (err) {
                console.error('Erro salvar despesa individual:', err);
                seivaNotificar('Erro de conexão ao salvar despesa pessoal.', 'erro');
            }
        }

        async function excluirDespesaIndividual(id, titulo) {
            if (!id) return;
            const confirmou = await seivaConfirm({
                titulo: 'Remover despesa fixa pessoal?',
                mensagem: `Deseja realmente remover a despesa "${titulo}"?`,
                badge: { texto: 'Despesa Pessoal Privada', tipo: 'pessoal' },
                impacto: {
                    titulo: 'Atualização do Orçamento Pessoal',
                    texto: 'O valor desta despesa deixará de comprometer a sua renda mensal e o histórico da remoção ficará gravado no seu registro de auditoria.'
                },
                tipo: 'perigo',
                icone: 'trash-2',
                confirmText: 'Remover Despesa',
                cancelText: 'Cancelar (Manter)'
            });
            if (!confirmou) return;

            try {
                const res = await fetch(`/caixa-preta/despesas/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                const data = await res.json();
                if (res.ok) {
                    seivaNotificar(data.mensagem || `Despesa "${titulo}" removida!`, 'sucesso', 'Despesa Excluída');
                    carregarCaixaPretaDados();
                    carregarDashboardDados();
                } else {
                    seivaNotificar(data.mensagem || 'Erro ao remover despesa.', 'erro');
                }
            } catch (err) {
                console.error('Erro ao excluir despesa individual:', err);
                seivaNotificar('Erro de conexão ao remover despesa.', 'erro');
            }
        }

        // Quitar Despesa Fixa Individual
        let despesaIndividualParaQuitar = null;

        function abrirModalQuitarDespesaIndividual(ds) {
            if (!ds) return;
            despesaIndividualParaQuitar = ds;

            const fId = document.getElementById('quitarDespIndivId');
            const fTit = document.getElementById('quitarDespIndivTitulo');
            const fVal = document.getElementById('quitarDespIndivValor');
            const fVenc = document.getElementById('quitarDespIndivVenc');
            const chipsContas = document.getElementById('quitarDespChipsContas');
            const fContaId = document.getElementById('quitarDespContaId');

            if (fId) fId.value = ds.id;
            if (fTit) fTit.innerText = ds.titulo || 'Despesa';
            if (fVal) fVal.innerText = BRL(ds.valor || 0);
            if (fVenc) fVenc.innerText = `Vencimento dia ${ds.dia_vencimento || 10} · Privada`;

            const contas = dashboardDadosCache?.contas || listaContas || [];
            if (chipsContas && contas.length) {
                const primeiraConta = contas[0]?.id_conta || '';
                if (fContaId) fContaId.value = primeiraConta;

                chipsContas.innerHTML = contas.map((c, i) => `
                    <button type="button" onclick="selecionarContaQuitacaoDespIndiv(this, '${c.id_conta}')"
                            class="chip-conta-quitacao px-3.5 py-2 rounded-xl border text-xs font-bold transition flex items-center gap-1.5 cursor-pointer ${i === 0 ? 'border-primary bg-primary text-primary-foreground shadow-2xs' : 'border-border bg-card text-muted-foreground hover:text-foreground'}">
                        <span class="size-2 rounded-full" style="background-color: ${c.cor || '#10b981'}"></span>
                        <span>${c.nome}</span>
                        <span class="text-[10px] opacity-80">(${BRL(c.saldo)})</span>
                    </button>
                `).join('');
            }

            abrirModalId('modalQuitarDespesaIndividual');
            if (window.lucide) lucide.createIcons();
        }

        function selecionarContaQuitacaoDespIndiv(btn, contaId) {
            const fContaId = document.getElementById('quitarDespContaId');
            if (fContaId) fContaId.value = contaId;
            document.querySelectorAll('.chip-conta-quitacao').forEach(b => {
                b.className = 'chip-conta-quitacao px-3.5 py-2 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground text-xs font-bold transition flex items-center gap-1.5 cursor-pointer';
            });
            if (btn) {
                btn.className = 'chip-conta-quitacao px-3.5 py-2 rounded-xl border border-primary bg-primary text-primary-foreground shadow-2xs text-xs font-bold transition flex items-center gap-1.5 cursor-pointer';
            }
        }

        async function executarConfirmarQuitacaoDespesaIndiv(event) {
            if (event) event.preventDefault();
            const id = document.getElementById('quitarDespIndivId')?.value;
            const contaId = document.getElementById('quitarDespContaId')?.value;
            if (!id || !contaId) {
                return seivaNotificar('Selecione de qual conta bancária saiu o pagamento.', 'aviso');
            }

            try {
                const res = await fetch(`/caixa-preta/despesas/${id}/quitar`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ conta_id: contaId })
                });

                const data = await res.json();
                if (res.ok) {
                    fecharModalId('modalQuitarDespesaIndividual');
                    seivaNotificar(data.mensagem || 'Despesa quitada com sucesso!', 'sucesso', 'Pagamento Registrado');
                    carregarCaixaPretaDados();
                    carregarDashboardDados();
                    carregarExtratoDados();
                } else {
                    seivaNotificar(data.mensagem || 'Erro ao quitar despesa.', 'erro');
                }
            } catch (err) {
                console.error('Erro quitar despesa individual:', err);
                seivaNotificar('Erro de conexão ao quitar despesa.', 'erro');
            }
        }

        // --- AÇÕES DA CAIXA PRETA & MODAIS ---
        async function responderPedidoAjudaCaixa(acao) {
            const pedido = caixaPretaDadosCache?.pedido_ajuda;
            if (!pedido) return;

            try {
                const res = await fetch('/api/caixa-preta/responder-ajuda', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({
                        id_cobranca: pedido.id_cobranca,
                        acao: acao,
                    })
                });

                const data = await res.json();
                if (res.ok) {
                    seivaNotificar(data.mensagem || 'Ação registrada com sucesso!', 'sucesso', 'Ajuda Mútua');
                    carregarCaixaPretaDados();
                    carregarDashboardDados();
                } else {
                    seivaNotificar(data.error || 'Não foi possível processar a ação.', 'erro');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão.', 'erro');
            }
        }

        function abrirContrapropostaCaixa() {
            const box = document.getElementById('caixaContrapropostaBox');
            if (box) {
                box.classList.remove('hidden');
                const pAj = caixaPretaDadosCache?.pedido_ajuda;
                const valInput = document.getElementById('caixaContrapropostaValor');
                if (valInput && pAj && !valInput.value) {
                    valInput.value = (pAj.valor / 2).toLocaleString('pt-BR', { minimumFractionDigits: 2 });
                }
                valInput?.focus();
                lucide.createIcons();
            }
        }

        function fecharContrapropostaCaixa() {
            document.getElementById('caixaContrapropostaBox')?.classList.add('hidden');
        }

        async function enviarContrapropostaCaixa() {
            const pedido = caixaPretaDadosCache?.pedido_ajuda;
            if (!pedido) return;

            const valStr = document.getElementById('caixaContrapropostaValor')?.value || '';
            const msgStr = document.getElementById('caixaContrapropostaMensagem')?.value?.trim() || '';
            const valor = parseFloat(valStr.replace(/\./g, '').replace(',', '.')) || 0;

            if (valor <= 0) {
                return seivaNotificar('Digite um valor válido para contraproposta.', 'aviso', 'Valor inválido');
            }

            try {
                const res = await fetch('/api/caixa-preta/responder-ajuda', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({
                        id_cobranca: pedido.id_cobranca,
                        acao: 'contrapor',
                        valor_contraproposta: valor,
                        mensagem_contraproposta: msgStr,
                    })
                });

                const data = await res.json();
                if (res.ok) {
                    seivaNotificar(data.mensagem || 'Contraproposta enviada ao parceiro!', 'sucesso', 'Contraproposta');
                    fecharContrapropostaCaixa();
                    carregarCaixaPretaDados();
                } else {
                    seivaNotificar(data.error || 'Erro ao enviar contraproposta.', 'erro');
                }
            } catch(e) {
                seivaNotificar('Erro de conexão.', 'erro');
            }
        }

        function dividirDespesaComParceiro(id, titulo, valor) {
            abrirModalPedirAjudaCusto({ id, titulo, valor });
        }

        async function confirmarRecebimentoAjuda(id, valor) {
            try {
                const res = await fetch('/api/caixa-preta/confirmar-recebimento', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({ id, valor })
                });

                const data = await res.json();
                if (res.ok) {
                    seivaNotificar(data.mensagem || 'Recebimento confirmado! Valor creditado no seu saldo.', 'sucesso', 'Recebimento Confirmado');
                    carregarCaixaPretaDados();
                    carregarDashboardDados();
                } else {
                    seivaNotificar(data.error || 'Erro ao confirmar recebimento.', 'erro');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão.', 'erro');
            }
        }

        function disputarRecebimentoAjuda(id, valor, titulo) {
            const modal = document.getElementById('modalDisputarRecebimento');
            if (!modal) return;

            const idInput = document.getElementById('disputaItemRecebimentoId');
            const valInput = document.getElementById('disputaItemRecebimentoValor');
            const valTxt = document.getElementById('disputaItemRecebimentoValorTxt');
            const titEl = document.getElementById('disputaItemRecebimentoTitulo');
            const msgEl = document.getElementById('disputaMensagemAdicional');

            if (idInput) idInput.value = id;
            if (valInput) valInput.value = valor;
            if (valTxt) valTxt.innerText = BRL(valor);
            if (titEl) titEl.innerText = titulo || 'Valor contestado';
            if (msgEl) msgEl.value = '';

            modal.classList.remove('hidden');
            lucide.createIcons();
        }

        function selecionarMotivoDisputa(btn, motivo) {
            document.querySelectorAll('.chip-motivo-disputa').forEach(b => {
                b.className = 'chip-motivo-disputa w-full p-2.5 text-left rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground text-xs font-bold transition flex items-center justify-between';
                const ic = b.querySelector('i');
                if (ic) ic.classList.add('opacity-0');
            });
            btn.className = 'chip-motivo-disputa active w-full p-2.5 text-left rounded-xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/30 text-foreground text-xs font-bold transition flex items-center justify-between';
            const ic = btn.querySelector('i');
            if (ic) ic.classList.remove('opacity-0');
            document.getElementById('disputaMotivoSelecionado').value = motivo;
        }

        async function executarEnvioDisputaRecebimento(event) {
            event.preventDefault();
            const id = document.getElementById('disputaItemRecebimentoId')?.value;
            const valor = parseFloat(document.getElementById('disputaItemRecebimentoValor')?.value) || 0;
            const motivoSelect = document.getElementById('disputaMotivoSelecionado')?.value || 'Não localizado no extrato';
            const detalhe = document.getElementById('disputaMensagemAdicional')?.value?.trim();
            const motivo = detalhe ? `${motivoSelect} — ${detalhe}` : motivoSelect;

            try {
                const res = await fetch('/api/caixa-preta/disputar-recebimento', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({ id, valor, motivo })
                });

                const data = await res.json();
                if (res.ok) {
                    fecharModalId('modalDisputarRecebimento');
                    seivaNotificar(data.mensagem || 'Alerta enviado ao parceiro para verificação do comprovante.', 'aviso', 'Aviso Enviado');
                    carregarCaixaPretaDados();
                } else {
                    seivaNotificar(data.error || 'Erro ao enviar aviso.', 'erro');
                }
            } catch(e) {
                seivaNotificar('Erro de conexão.', 'erro');
            }
        }

        function toggleFormProdutoOlho() {
            const f = document.getElementById('formAdicionarProdutoOlho');
            if (f) {
                f.classList.toggle('hidden');
                lucide.createIcons();
            }
        }

        async function salvarNovoProdutoOlho() {
            const nome = document.getElementById('prodOlhoNome')?.value?.trim();
            const precoStr = document.getElementById('prodOlhoPreco')?.value || '';
            const loja = document.getElementById('prodOlhoLoja')?.value?.trim() || 'Loja online';
            const link = document.getElementById('prodOlhoLink')?.value?.trim() || '';
            const preco = parseFloat(precoStr.replace(/\./g, '').replace(',', '.')) || 0;

            if (!nome || preco <= 0) {
                return seivaNotificar('Preencha o nome e um preço válido para o produto.', 'aviso', 'Dados incompletos');
            }

            try {
                const res = await fetch('/api/caixa-preta/produtos-watchlist', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({ nome, preco, loja, link })
                });

                const data = await res.json();
                if (res.ok) {
                    seivaNotificar(data.mensagem || 'Produto adicionado aos seus Produtos de Olho!', 'sucesso', 'Wishlist');
                    // Limpar campos
                    ['prodOlhoNome', 'prodOlhoPreco', 'prodOlhoLoja', 'prodOlhoLink'].forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.value = '';
                    });
                    toggleFormProdutoOlho();
                    carregarCaixaPretaDados();
                } else {
                    seivaNotificar(data.error || 'Erro ao salvar produto.', 'erro');
                }
            } catch(e) {
                seivaNotificar('Erro de conexão ao salvar produto.', 'erro');
            }
        }

        async function removerProdutoOlho(id) {
            const aceitou = await seivaConfirm({
                titulo: 'Remover produto monitorado',
                mensagem: 'Deseja remover este produto dos seus produtos de olho?',
                confirmText: 'Remover',
                tipo: 'perigo',
                icone: 'trash-2'
            });
            if (!aceitou) return;

            try {
                const res = await fetch(`/api/caixa-preta/produtos-watchlist/${id}`, {
                    method: 'DELETE',
                    headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' }
                });

                const data = await res.json();
                if (res.ok) {
                    seivaNotificar(data.mensagem || 'Produto removido com sucesso.', 'sucesso');
                    carregarCaixaPretaDados();
                }
            } catch(e) {
                seivaNotificar('Erro ao remover produto.', 'erro');
            }
        }

        // --- MODAL: ADICIONAR CONTA OU CARTÃO ---
        function abrirModalAdicionarContaCartao() {
            const modal = document.getElementById('modalAdicionarContaCartao');
            if (modal) {
                modal.classList.remove('hidden');
                lucide.createIcons();
            }
        }

        function selecionarTipoContaCartao(btn, tipo) {
            document.querySelectorAll('.chip-tipo-conta').forEach(b => {
                b.className = 'chip-tipo-conta py-2.5 px-3 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition text-center';
            });
            btn.className = 'chip-tipo-conta active py-2.5 px-3 rounded-2xl border border-emerald-600 bg-emerald-800 text-white font-bold text-xs transition text-center';
            document.getElementById('novaContaTipo').value = tipo;

            const campoVenc = document.getElementById('campoNovaContaVencimento');
            const labelValor = document.getElementById('labelNovaContaValor');
            if (tipo === 'cartao') {
                if (campoVenc) campoVenc.classList.remove('hidden');
                if (labelValor) labelValor.innerText = 'Limite total do cartão';
            } else {
                if (campoVenc) campoVenc.classList.add('hidden');
                if (labelValor) labelValor.innerText = 'Saldo atual';
            }
        }

        function aoMudarBancoSelecionado(banco) {
            const inputNome = document.getElementById('novaContaNome');
            if (inputNome && !inputNome.value.trim()) {
                inputNome.value = banco;
            }
        }

        async function executarSalvarNovaContaCartao(event) {
            event.preventDefault();
            const tipo = document.getElementById('novaContaTipo').value;
            const banco = document.getElementById('novaContaBanco').value;
            const nome = document.getElementById('novaContaNome').value.trim();
            const valorRaw = document.getElementById('novaContaValor').value.replace(/\./g, '').replace(',', '.');
            const valor = parseFloat(valorRaw) || 0;
            const vencimento = document.getElementById('novaContaVencimento')?.value || 12;

            try {
                const payload = {
                    nome: nome || banco,
                    tipo: tipo,
                    saldo: tipo === 'cartao' ? 0 : valor,
                    limite: tipo === 'cartao' ? valor : 0,
                    vencimento_fatura: tipo === 'cartao' ? vencimento : null,
                };

                const res = await fetch('/api/contas', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify(payload)
                });

                if (res.ok) {
                    seivaNotificar('Conta/cartão cadastrado com sucesso!', 'sucesso', 'Conta Salva');
                    fecharModalId('modalAdicionarContaCartao');
                    carregarCaixaPretaDados();
                    carregarDashboardDados();
                } else {
                    const err = await res.json();
                    seivaNotificar(err.error || 'Erro ao cadastrar.', 'erro');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão ao salvar conta.', 'erro');
            }
        }

        // --- MODAL: PEDIR AJUDA DE CUSTO ---
        function abrirModalPedirAjudaCusto(desp) {
            const d = desp || { id: null, titulo: 'Mercado da casa', valor: 312.80 };
            despesaAjudaAtual = d;

            const modal = document.getElementById('modalPedirAjudaCusto');
            if (!modal) return;

            const titEl = document.getElementById('modalAjudaItemTitulo');
            const subEl = document.getElementById('modalAjudaItemSub');
            const metEl = document.getElementById('labelAjudaMetadeTexto');
            const totEl = document.getElementById('labelAjudaTotalTexto');
            const valFin = document.getElementById('ajudaValorFinal');

            if (titEl) titEl.innerText = d.titulo;
            if (subEl) subEl.innerText = `${BRL(d.valor)} · pago por você`;
            if (metEl) metEl.innerText = `Metade — ${BRL(d.valor / 2)}`;
            if (totEl) totEl.innerText = `Valor total — ${BRL(d.valor)}`;
            if (valFin) valFin.value = (d.valor / 2).toFixed(2);

            selecionarOpcaoAjuda('metade');
            modal.classList.remove('hidden');
            lucide.createIcons();
        }

        function selecionarOpcaoAjuda(opcao) {
            document.querySelectorAll('.opcao-ajuda-chip').forEach(b => {
                b.className = 'opcao-ajuda-chip w-full flex items-center justify-between p-3.5 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/30 transition text-left';
            });

            const outroContainer = document.getElementById('containerAjudaOutroValor');
            const valFin = document.getElementById('ajudaValorFinal');

            if (opcao === 'metade') {
                const btn = document.getElementById('btnAjudaOpcaoMetade');
                if (btn) btn.className = 'opcao-ajuda-chip active w-full flex items-center justify-between p-3.5 rounded-2xl border-2 border-emerald-600 bg-emerald-50/50 dark:bg-emerald-950/30 text-foreground transition text-left';
                if (outroContainer) outroContainer.classList.add('hidden');
                if (valFin) valFin.value = (despesaAjudaAtual.valor / 2).toFixed(2);
            } else if (opcao === 'total') {
                const btn = document.getElementById('btnAjudaOpcaoTotal');
                if (btn) btn.className = 'opcao-ajuda-chip active w-full flex items-center justify-between p-3.5 rounded-2xl border-2 border-emerald-600 bg-emerald-50/50 dark:bg-emerald-950/30 text-foreground transition text-left';
                if (outroContainer) outroContainer.classList.add('hidden');
                if (valFin) valFin.value = despesaAjudaAtual.valor.toFixed(2);
            } else {
                const btn = document.getElementById('btnAjudaOpcaoOutro');
                if (btn) btn.className = 'opcao-ajuda-chip active w-full flex items-center justify-between p-3.5 rounded-2xl border-2 border-emerald-600 bg-emerald-50/50 dark:bg-emerald-950/30 text-foreground transition text-left';
                if (outroContainer) outroContainer.classList.remove('hidden');
            }
        }

        function aoDigitarOutroValorAjuda(valStr) {
            const num = parseFloat(valStr.replace(/\./g, '').replace(',', '.')) || 0;
            const valFin = document.getElementById('ajudaValorFinal');
            if (valFin) valFin.value = num.toFixed(2);
        }

        async function executarEnvioPedidoAjuda(event) {
            event.preventDefault();
            const valor = parseFloat(document.getElementById('ajudaValorFinal')?.value) || (despesaAjudaAtual.valor / 2);
            const titulo = despesaAjudaAtual.titulo || 'Ajuda de custo';

            try {
                const res = await fetch('/api/caixa-preta/pedir-ajuda', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ titulo, valor, mensagem: `Solicitou ajuda de custo de ${BRL(valor)} para ${titulo}` })
                });

                const data = await res.json();
                if (res.ok) {
                    seivaNotificar(data.mensagem || 'Pedido de ajuda enviado ao parceiro!', 'sucesso', 'Pedido Enviado');
                    fecharModalId('modalPedirAjudaCusto');
                    carregarCaixaPretaDados();
                } else {
                    seivaNotificar(data.erro || 'Não foi possível enviar o pedido.', 'aviso');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão ao enviar pedido de ajuda.', 'erro');
            }
        }

        // --- MODAL: CRIAR META ---
        function abrirModalCriarMeta(tipoInicial = 'individual') {
            const modal = document.getElementById('modalCriarMeta');
            if (!modal) return;

            const isCasal = Boolean(window._isCasalGlobal);
            const opcLar = document.getElementById('opcaoPosseLar');
            const opcComp = document.getElementById('opcaoPosseCompartilhada');
            const avisoSemLar = document.getElementById('avisoSemLarOpcoesMeta');
            const btnSoMinha = document.getElementById('opcaoPosseSoMinha');

            if (!isCasal) {
                if (opcLar) opcLar.classList.add('hidden');
                if (opcComp) opcComp.classList.add('hidden');
                if (avisoSemLar) avisoSemLar.classList.remove('hidden');
                if (btnSoMinha) selecionarPosseMeta(btnSoMinha, 'so_minha');
            } else {
                if (opcLar) opcLar.classList.remove('hidden');
                if (opcComp) opcComp.classList.remove('hidden');
                if (avisoSemLar) avisoSemLar.classList.add('hidden');

                if (tipoInicial === 'compartilhada' && opcComp) {
                    selecionarPosseMeta(opcComp, 'compartilhada');
                } else if (tipoInicial === 'lar' && opcLar) {
                    selecionarPosseMeta(opcLar, 'lar');
                } else if (btnSoMinha) {
                    selecionarPosseMeta(btnSoMinha, 'so_minha');
                }
            }

            modal.classList.remove('hidden');
            lucide.createIcons();
        }

        function abrirModalCriarMetaComDados(nome, preco, loja = '', link = '', imagem = '', posse = 'so_minha') {
            abrirModalCriarMeta();
            const nomeEl = document.getElementById('novaMetaNome');
            const valEl = document.getElementById('novaMetaValor');
            const lojaEl = document.getElementById('novaMetaLoja');
            const linkEl = document.getElementById('novaMetaLinkProduto');
            const imgEl = document.getElementById('novaMetaFotoUrl');
            if (nomeEl) nomeEl.value = nome;
            if (valEl) valEl.value = typeof preco === 'number' ? preco.toLocaleString('pt-BR', { minimumFractionDigits: 2 }) : preco;
            if (lojaEl && loja) lojaEl.value = loja;
            if (linkEl && link) linkEl.value = link;
            if (imgEl && imagem) {
                imgEl.value = imagem;
                const previewCont = document.getElementById('previewFotoMetaContainer');
                const previewImg = document.getElementById('previewFotoMetaImg');
                const boxUpload = document.getElementById('boxUploadFotoMeta');
                const previewTit = document.getElementById('previewFotoMetaTitulo');
                if (previewImg) previewImg.src = imagem;
                if (previewTit) previewTit.innerText = nome || 'Foto do produto';
                if (previewCont) previewCont.classList.remove('hidden');
                if (boxUpload) boxUpload.classList.add('hidden');
            }
            if (posse) {
                const botoesPosse = document.querySelectorAll('.chip-posse-meta');
                if (posse === 'compartilhada' || posse === 'lar') {
                    if (botoesPosse.length >= 3) selecionarPosseMeta(botoesPosse[2], 'compartilhada');
                    else if (botoesPosse.length >= 2) selecionarPosseMeta(botoesPosse[1], 'lar');
                } else {
                    if (botoesPosse.length >= 1) selecionarPosseMeta(botoesPosse[0], 'so_minha');
                }
            }
        }

        function selecionarTipoMeta(btn, tipo, icone) {
            document.querySelectorAll('.chip-cat-meta').forEach(b => {
                b.className = 'chip-cat-meta flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition';
            });
            btn.className = 'chip-cat-meta active flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-emerald-600 bg-emerald-800 text-white font-bold text-xs transition';
            document.getElementById('novaMetaCategoria').value = tipo;

            const boxOutros = document.getElementById('boxMetaOutrosEspecificacao');
            if (boxOutros) {
                if (tipo === 'outros') {
                    boxOutros.classList.remove('hidden');
                    const inpDesc = document.getElementById('novaMetaOutrosDesc');
                    if (inpDesc) inpDesc.focus();
                } else {
                    boxOutros.classList.add('hidden');
                }
            }
        }

        function aoDigitarConquistaOutros(valor) {
            const inpNome = document.getElementById('novaMetaNome');
            if (inpNome && valor) {
                inpNome.value = valor;
            }
        }

        async function buscarDadosLinkProduto() {
            const url = document.getElementById('novaMetaLinkProduto')?.value?.trim();
            if (!url) return seivaNotificar('Cole a URL de um produto antes de buscar.', 'aviso');
            
            const btn = document.getElementById('btnBuscarLinkMeta');
            const textoOriginal = btn ? btn.innerHTML : 'Buscar';
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = `<i data-lucide="loader-2" class="size-3.5 animate-spin"></i><span>Buscando...</span>`;
                lucide.createIcons();
            }

            try {
                const res = await fetch('/api/metas/consultar-link', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ url })
                });

                if (res.ok) {
                    const data = await res.json();
                    if (data.titulo) document.getElementById('novaMetaNome').value = data.titulo;
                    if (data.preco) {
                        const valFmt = typeof data.preco === 'number' 
                            ? data.preco.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
                            : data.preco;
                        document.getElementById('novaMetaValor').value = valFmt;
                    }
                    if (data.loja) document.getElementById('novaMetaLoja').value = data.loja;
                    
                    if (data.imagem) {
                        document.getElementById('novaMetaFotoUrl').value = data.imagem;
                        const previewCont = document.getElementById('previewFotoMetaContainer');
                        const previewImg = document.getElementById('previewFotoMetaImg');
                        const boxUpload = document.getElementById('boxUploadFotoMeta');
                        const previewTit = document.getElementById('previewFotoMetaTitulo');
                        if (previewImg) previewImg.src = data.imagem;
                        if (previewTit) previewTit.innerText = data.titulo || 'Foto do produto';
                        if (previewCont) previewCont.classList.remove('hidden');
                        if (boxUpload) boxUpload.classList.add('hidden');
                    }
                    seivaNotificar(`Dados importados de ${data.loja || 'loja'}! Revise e confirme.`, 'sucesso', 'Wishlist');
                } else {
                    seivaNotificar('Não foi possível obter dados automáticos deste link. Você pode preencher manualmente.', 'aviso');
                }
            } catch (e) {
                console.error(e);
                seivaNotificar('Erro de conexão ao consultar o link do produto.', 'erro');
            } finally {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = textoOriginal;
                    lucide.createIcons();
                }
            }
        }

        function aoSelecionarFotoMetaArquivo(input) {
            if (!input.files || !input.files[0]) return;
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const dataUrl = e.target.result;
                document.getElementById('novaMetaFotoUrl').value = dataUrl;
                const previewCont = document.getElementById('previewFotoMetaContainer');
                const previewImg = document.getElementById('previewFotoMetaImg');
                const boxUpload = document.getElementById('boxUploadFotoMeta');
                const previewTit = document.getElementById('previewFotoMetaTitulo');
                if (previewImg) previewImg.src = dataUrl;
                if (previewTit) previewTit.innerText = file.name;
                if (previewCont) previewCont.classList.remove('hidden');
                if (boxUpload) boxUpload.classList.add('hidden');
                lucide.createIcons();
            };
            reader.readAsDataURL(file);
        }

        function removerFotoMeta(e) {
            if (e) e.stopPropagation();
            document.getElementById('novaMetaFotoUrl').value = '';
            const inpFile = document.getElementById('novaMetaFotoArquivo');
            if (inpFile) inpFile.value = '';
            const previewCont = document.getElementById('previewFotoMetaContainer');
            const boxUpload = document.getElementById('boxUploadFotoMeta');
            if (previewCont) previewCont.classList.add('hidden');
            if (boxUpload) boxUpload.classList.remove('hidden');
            lucide.createIcons();
        }

        function selecionarPosseMeta(btn, posse) {
            document.querySelectorAll('.chip-posse-meta').forEach(b => {
                b.className = 'chip-posse-meta w-full flex items-center justify-between p-3.5 rounded-2xl border border-border bg-card text-left transition hover:bg-muted/20';
                const check = b.querySelector('[data-lucide="check"]');
                if (check) check.remove();
            });
            btn.className = 'chip-posse-meta active w-full flex items-center justify-between p-3.5 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition';
            if (!btn.querySelector('[data-lucide="check"]')) {
                btn.insertAdjacentHTML('beforeend', `<i data-lucide="check" class="size-4 text-emerald-600"></i>`);
            }
            document.getElementById('novaMetaPosse').value = posse;

            const avisoComp = document.getElementById('avisoMetaCompartilhada');
            if (avisoComp) {
                if (posse === 'compartilhada') avisoComp.classList.remove('hidden');
                else avisoComp.classList.add('hidden');
            }
            lucide.createIcons();
        }

        function levarMetaParaAcordos() {
            const titulo = document.getElementById('novaMetaNome')?.value || 'Meta Compartilhada';
            fecharModalId('modalCriarMeta');
            trocarAbaApp('acordos');
            seivaNotificar(`Proposta para "${titulo}" iniciada na Mesa de Acordos.`, 'info', 'Mesa de Acordos');
        }

        async function executarSalvarNovaMeta(event) {
            event.preventDefault();
            const titulo = document.getElementById('novaMetaNome').value.trim();
            const categoria = document.getElementById('novaMetaCategoria').value;
            const posse = document.getElementById('novaMetaPosse').value;
            const valorRaw = document.getElementById('novaMetaValor').value.replace(/\./g, '').replace(',', '.');
            const valor_alvo = parseFloat(valorRaw) || 0;
            const imagem = document.getElementById('novaMetaFotoUrl')?.value || null;
            const link_referencia = document.getElementById('novaMetaLinkProduto')?.value?.trim() || null;
            const loja = document.getElementById('novaMetaLoja')?.value?.trim() || null;

            if (!valor_alvo) return seivaNotificar('Informe um valor alvo válido.', 'aviso');

            try {
                const res = await fetch('/api/metas', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({
                        titulo,
                        categoria,
                        valor_alvo,
                        posse,
                        tipo_escopo: posse === 'compartilhada' || posse === 'lar' ? 'lar' : 'individual',
                        onde_guardado: 'Reserva Pessoal',
                        imagem,
                        link_referencia,
                        loja,
                        monitorar_promocao: true
                    })
                });

                if (res.ok) {
                    seivaNotificar('Meta criada com sucesso!', 'sucesso', 'Meta Criada');
                    fecharModalId('modalCriarMeta');
                    carregarMetasDados();
                    carregarCaixaPretaDados();
                } else {
                    const err = await res.json();
                    seivaNotificar(err.error || 'Erro ao criar meta.', 'erro');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão ao criar meta.', 'erro');
            }
        }

        // --- MODAL: GUARDAR EM META ---
        function abrirModalGuardarMeta(id, titulo, atual, alvo, tipo) {
            metaAporteAtual = { id, titulo, atual: parseFloat(atual)||0, alvo: parseFloat(alvo)||1, tipo };

            const modal = document.getElementById('modalGuardarMeta');
            if (!modal) return;

            const titEl = document.getElementById('modalGuardarMetaTituloHeader');
            const subEl = document.getElementById('modalGuardarMetaSubHeader');
            const progTxt = document.getElementById('modalGuardarMetaValoresTxt');
            const barraEl = document.getElementById('modalGuardarMetaBarra');
            const seraEl = document.getElementById('modalGuardarMetaSeraPct');
            const secLar = document.getElementById('guardarMetaSecaoLar');
            const inpVal = document.getElementById('guardarMetaInputValor');
            const metaIdEl = document.getElementById('guardarMetaId');

            if (titEl) titEl.innerText = `Guardar em ${titulo}`;
            if (subEl) subEl.innerText = tipo === 'lar' ? 'Meta do Lar' : 'Meta pessoal';
            if (progTxt) progTxt.innerText = `${BRL(atual)} de ${BRL(alvo)}`;
            if (metaIdEl) metaIdEl.value = id;
            if (inpVal) inpVal.value = '';

            const p = Math.min(100, Math.round((atual / alvo) * 100));
            if (barraEl) barraEl.style.width = `${p}%`;
            if (seraEl) seraEl.innerText = `Será ${p}% após guardar`;

            // Popular chips de contas com saldos
            _popularContasAporteMeta();

            // Metas do Lar exibem destino Pix
            if (tipo === 'lar' && larSessao) {
                if (secLar) secLar.classList.remove('hidden');
                const destNome = document.getElementById('guardarMetaDestinoNome');
                const destPix = document.getElementById('guardarMetaDestinoPix');
                if (destNome) destNome.innerText = `Conta de ${usuarioSessao?.nome || 'Você'}`;
                if (destPix) destPix.innerText = `Pix: ${usuarioSessao?.chave_pix || '(71) 99812-3456'}`;
            } else {
                if (secLar) secLar.classList.add('hidden');
            }

            modal.classList.remove('hidden');
            lucide.createIcons();
        }

        function _popularContasAporteMeta() {
            const cont = document.getElementById('guardarMetaChipsContas');
            if (!cont) return;

            const contas = dashboardDadosCache?.contas || [
                { id_conta: 1, nome: 'Nubank', saldo: 1180.00, cor: '#8b5cf6' },
                { id_conta: 2, nome: 'Poupança Caixa', saldo: 2100.00, cor: '#0284c7' },
                { id_conta: 3, nome: 'PicPay', saldo: 240.00, cor: '#10b981' },
                { id_conta: 4, nome: 'Dinheiro', saldo: 130.00, cor: '#059669' },
            ];

            cont.innerHTML = contas.map((c, i) => `
                <button type="button" onclick="selecionarContaAporteMeta('${c.id_conta}', this)"
                        class="chip-conta-aporte ${i === 0 ? 'active border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20' : 'border border-border bg-card'} p-3 rounded-2xl flex items-center gap-2.5 text-left transition hover:bg-muted/20">
                    <span class="size-7 rounded-xl flex items-center justify-center text-xs shrink-0" style="background-color:${c.cor||'#10b981'}20; color:${c.cor||'#10b981'}">
                        <i data-lucide="wallet" class="size-3.5"></i>
                    </span>
                    <div class="min-w-0">
                        <strong class="text-xs font-bold text-foreground block truncate">${c.nome}</strong>
                        <span class="text-[10px] text-muted-foreground">${BRL(c.saldo)}</span>
                    </div>
                </button>
            `).join('');

            const contaIdEl = document.getElementById('guardarMetaContaId');
            if (contaIdEl && contas.length) contaIdEl.value = contas[0].id_conta;
            lucide.createIcons();
        }

        function selecionarContaAporteMeta(contaId, btn) {
            document.querySelectorAll('.chip-conta-aporte').forEach(b => {
                b.className = 'chip-conta-aporte border border-border bg-card p-3 rounded-2xl flex items-center gap-2.5 text-left transition hover:bg-muted/20';
            });
            btn.className = 'chip-conta-aporte active border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 p-3 rounded-2xl flex items-center gap-2.5 text-left transition';
            const contaIdEl = document.getElementById('guardarMetaContaId');
            if (contaIdEl) contaIdEl.value = contaId;
        }

        function definirValorAporteMeta(val) {
            const inp = document.getElementById('guardarMetaInputValor');
            if (inp) {
                inp.value = val.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
                aoMudarValorAporteMeta(inp.value);
            }
        }

        function aoMudarValorAporteMeta(valStr) {
            const num = parseFloat(valStr.replace(/\./g, '').replace(',', '.')) || 0;
            const novoAtual = metaAporteAtual.atual + num;
            const p = Math.min(100, Math.round((novoAtual / metaAporteAtual.alvo) * 100));

            const seraEl = document.getElementById('modalGuardarMetaSeraPct');
            const barraEl = document.getElementById('modalGuardarMetaBarra');
            if (seraEl) seraEl.innerText = `Será ${p}% após guardar`;
            if (barraEl) barraEl.style.width = `${p}%`;

            const dicaEl = document.getElementById('guardarMetaDicaMotivacional');
            if (dicaEl) {
                if (p >= 100) dicaEl.innerText = 'Incrível! Você atingiu o objetivo com esse aporte!';
                else if (p >= 75) dicaEl.innerText = 'A reta final! Falta muito pouco!';
                else if (p >= 50) dicaEl.innerText = 'Metade do caminho já percorrido. Parabéns!';
                else dicaEl.innerText = 'Quase lá. Cada aporte faz a diferença.';
            }
        }

        function copiarPixMeta() {
            const pix = usuarioSessao?.chave_pix || '(71) 99812-3456';
            navigator.clipboard.writeText(pix);
            seivaNotificar(`Chave Pix ${pix} copiada!`, 'sucesso', 'Chave Copiada');
        }

        async function executarGuardarNaMeta(event) {
            event.preventDefault();
            const id = document.getElementById('guardarMetaId').value || metaAporteAtual.id;
            const valorRaw = document.getElementById('guardarMetaInputValor').value.replace(/\./g, '').replace(',', '.');
            const valor = parseFloat(valorRaw) || 0;
            const conta_id = document.getElementById('guardarMetaContaId').value || null;

            if (!valor || valor <= 0) return seivaNotificar('Informe um valor de aporte maior que zero.', 'aviso');

            try {
                const res = await fetch(`/api/metas/${id}/contribuir`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ valor, conta_id })
                });

                if (res.ok) {
                    seivaNotificar(`Aporte de ${BRL(valor)} registrado com sucesso!`, 'sucesso', 'Meta Atualizada');
                    fecharModalId('modalGuardarMeta');
                    carregarMetasDados();
                    carregarCaixaPretaDados();
                    carregarDashboardDados();
                } else {
                    const err = await res.json();
                    seivaNotificar(err.error || 'Erro ao realizar aporte.', 'erro');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão ao guardar na meta.', 'erro');
            }
        }

        // --- ACORDOS ---
        // ==========================================
        // MESA DE ACORDOS – Renderização completa (RF006 — Ian Marcos)
        // ==========================================
        let novoAcordoPassoAtual = 1;
        let novoAcordoTipoSelecionado = 'poupar_juntos';
        let novoAcordoDivisaoSelecionada = '50/50';

        async function carregarAcordosDados() {
            try {
                const res = await fetch('/api/acordos');
                if (!res.ok) return;
                const data = await res.json();

                // Badge contador
                const badge = document.getElementById('acordosBadgeContadorNegociacoes');
                if (badge) badge.textContent = (data.negociacoes_em_aberto || []).length;

                // ---- Negociações em aberto ----
                const listaNeg = document.getElementById('acordosListaNegociacoesAbertas');
                if (listaNeg) {
                    const neg = data.negociacoes_em_aberto || [];
                    if (!neg.length) {
                        listaNeg.innerHTML = '<p class="text-xs text-muted-foreground py-6 text-center">Nenhuma proposta pendente no momento.</p>';
                    } else {
                        listaNeg.innerHTML = neg.map(p => {
                            const isPoupar = p.tipo === 'poupar_juntos';
                            const badgeStyle = isPoupar ? 'bg-emerald-100 text-emerald-900 border border-emerald-300 font-black' : 'bg-slate-100 text-slate-800 border border-slate-300 font-black';
                            return `
                            <div class="rounded-3xl border border-border bg-card shadow-card overflow-hidden" id="negCard${p.id_proposta}">
                                <div class="flex gap-3 p-4">
                                    ${p.imagem ? `<img src="${p.imagem}" alt="${p.titulo}" class="size-16 rounded-2xl object-cover shrink-0 bg-muted">` : ''}
                                    <div class="flex-1 min-w-0 space-y-1">
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] ${badgeStyle}">${p.tipo_label}</span>
                                        <p class="text-sm font-black text-foreground leading-tight">${p.titulo}</p>
                                        <p class="text-[11px] text-muted-foreground">De ${p.autor_nome} · ${p.tempo_atras}</p>
                                        ${p.link ? `<a href="https://${p.link}" target="_blank" class="inline-flex items-center gap-1 text-[10px] text-primary hover:underline"><i data-lucide="external-link" class="size-3"></i> ${p.link}</a>` : ''}
                                    </div>
                                </div>
                                <div class="mx-4 mb-3 px-3 py-2 rounded-2xl bg-muted/50 text-[11px] text-muted-foreground leading-relaxed">
                                    ${isPoupar
                                        ? `Objetivo de <strong class="text-foreground">${BRL(p.valor_total)}</strong> · cada um guarda <strong class="text-foreground">${BRL(p.valor_mensal_cada)}/mês</strong> · <span class="text-emerald-700 dark:text-emerald-400 font-bold">${p.prazo_texto || ''}</span>`
                                        : `Compra de <strong class="text-foreground">${BRL(p.valor_total)}</strong> já feita · sua parte <strong class="text-foreground">${BRL(p.valor_mensal_cada)} em 2x</strong> · obrigatório`
                                    }
                                </div>
                                <div class="mx-4 mb-3 flex items-start gap-2">
                                    <i data-lucide="message-circle" class="size-4 text-muted-foreground shrink-0 mt-0.5"></i>
                                    <p class="text-[11px] text-muted-foreground italic">"${p.mensagem}"</p>
                                </div>
                                <div class="mx-4 mb-1 flex items-center gap-1.5 text-[10px] text-muted-foreground font-semibold">
                                    <i data-lucide="wallet" class="size-3"></i>
                                    <span>${p.autor_nome}: ${p.ian_proposta}</span>
                                </div>
                                <div class="grid grid-cols-3 border-t border-border mt-3">
                                    <button onclick="votarPropostaAcordo(${p.id_proposta}, 'recusar')" title="Recusa a proposta de forma gentil e arquiva a pendência" class="py-3.5 text-xs font-bold text-muted-foreground hover:bg-muted/60 flex items-center justify-center gap-1.5 transition-colors cursor-pointer">
                                        <i data-lucide="x" class="size-4"></i> Recusar
                                    </button>
                                    <button onclick="mostrarContrapropostaInline(${p.id_proposta})" title="Propõe um valor de parcela diferente" class="py-3.5 text-xs font-bold text-foreground hover:bg-muted/60 flex items-center justify-center gap-1.5 border-x border-border transition-colors cursor-pointer">
                                        <i data-lucide="shield" class="size-4"></i> Contrapor
                                    </button>
                                    <button onclick="votarPropostaAcordo(${p.id_proposta}, 'aceitar')" title="Aceita e ativa o acordo no Lar (notifica ${p.autor_nome})" class="py-3.5 text-xs font-black text-emerald-800 dark:text-emerald-300 hover:bg-emerald-50 dark:hover:bg-emerald-950/20 flex items-center justify-center gap-1.5 transition-colors cursor-pointer">
                                        <i data-lucide="check" class="size-4"></i> Aceitar
                                    </button>
                                </div>
                                <div id="contrapropostaPanel${p.id_proposta}" class="hidden px-4 pb-4 pt-3 border-t border-border bg-muted/30 space-y-3">
                                    <p class="text-xs font-black text-foreground">Quanto você consegue pagar por parcela?</p>
                                    <p class="text-[11px] text-muted-foreground">Sugira um novo valor de parcela confortável para combinar com ${p.autor_nome}.</p>
                                    <div class="flex items-center gap-2">
                                        <div class="flex-1 flex items-center gap-2 rounded-xl border border-border bg-background px-3 py-2.5">
                                            <span class="text-xs text-muted-foreground font-bold">R$</span>
                                            <input type="number" id="contrapropostaValor${p.id_proposta}" value="${p.valor_mensal_cada}" step="0.01" class="flex-1 bg-transparent text-sm font-bold text-foreground outline-none">
                                            <span class="text-[10px] text-muted-foreground">/mês</span>
                                        </div>
                                        <button onclick="enviarContraproposta(${p.id_proposta})" class="px-4 py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white text-xs font-bold flex items-center gap-1.5 shrink-0 shadow-xs cursor-pointer">
                                            <i data-lucide="send" class="size-3.5"></i> Enviar
                                        </button>
                                    </div>
                                    <button onclick="document.getElementById('contrapropostaPanel${p.id_proposta}').classList.add('hidden')" class="text-[11px] text-muted-foreground underline w-full text-center cursor-pointer">Cancelar</button>
                                </div>
                            </div>`;
                        }).join('');
                    }
                }

                // ---- Poupando juntos ----
                const listaPoupando = document.getElementById('acordosListaPoupandoJuntos');
                if (listaPoupando) {
                    const poupando = data.poupando_juntos || [];
                    if (!poupando.length) {
                        listaPoupando.innerHTML = '<p class="text-xs text-muted-foreground py-4 text-center">Nenhum acordo de poupar juntos ainda.</p>';
                    } else {
                        listaPoupando.innerHTML = poupando.map(a => {
                            const pct = a.progresso_pct || 0;
                            const guardado = a.valor_guardado || 0;
                            return `
                            <div class="rounded-3xl border border-border bg-card shadow-card overflow-hidden">
                                <button onclick="alternarExpansaoAcordoPoupando(${a.id_acordo})" class="w-full flex items-center gap-3 p-4 text-left cursor-pointer">
                                    ${a.imagem ? `<img src="${a.imagem}" alt="${a.titulo}" class="size-14 rounded-2xl object-cover shrink-0 bg-muted">` : '<div class="size-14 rounded-2xl bg-muted shrink-0 flex items-center justify-center"><i data-lucide="piggy-bank" class="size-6 text-muted-foreground"></i></div>'}
                                    <div class="flex-1 min-w-0">
                                        ${a.badge ? `<span class="text-[10px] font-black text-emerald-800 dark:text-emerald-300">${a.badge}</span>` : ''}
                                        <p class="text-sm font-black text-foreground leading-tight">${a.titulo}</p>
                                        <div class="mt-1.5 w-full bg-muted rounded-full h-1.5 overflow-hidden">
                                            <div class="h-full rounded-full ${pct >= 80 ? 'bg-emerald-600' : pct >= 40 ? 'bg-emerald-700' : 'bg-primary'}" style="width:${pct}%"></div>
                                        </div>
                                        <p class="text-[10px] text-muted-foreground mt-1">${BRL(guardado)} de ${BRL(a.valor_total)} · ${pct}%</p>
                                    </div>
                                    <i data-lucide="chevron-down" class="size-4 text-muted-foreground shrink-0 transition-transform" id="chevronAcordo${a.id_acordo}"></i>
                                </button>
                                <div id="expansaoAcordo${a.id_acordo}" class="${a.expandido ? '' : 'hidden'} border-t border-border">
                                    <div class="mx-4 mt-3 mb-2 px-3.5 py-2.5 rounded-2xl bg-emerald-100/80 border border-emerald-300 text-emerald-950">
                                        <p class="text-xs font-semibold text-emerald-950 leading-relaxed">${a.banner_info}</p>
                                    </div>
                                    <div class="mx-4 mb-3 space-y-2">
                                        <div class="flex items-center justify-between py-2 border-b border-border/60">
                                            <div class="flex items-center gap-2">
                                                <span class="size-6 rounded-full bg-emerald-700 text-white text-[10px] font-black flex items-center justify-center">${(larDadosCache?.membros?.[0]?.iniciais) || 'VC'}</span>
                                                <span class="text-xs font-semibold text-foreground">${(larDadosCache?.membros?.[0]?.nome) || 'Você'}</span>
                                            </div>
                                            <span class="text-xs font-black text-foreground">${BRL(a.maria_mes || (a.valor_mensal_juntos / 2))}/mês</span>
                                        </div>
                                        <div class="flex items-center justify-between py-2">
                                            <div class="flex items-center gap-2">
                                                <span class="size-6 rounded-full bg-emerald-800 text-white text-[10px] font-black flex items-center justify-center">${(larDadosCache?.membros?.[1]?.iniciais) || 'PR'}</span>
                                                <span class="text-xs font-semibold text-foreground">${(larDadosCache?.membros?.[1]?.nome) || 'Parceiro(a)'}</span>
                                            </div>
                                            <span class="text-xs font-black text-foreground">${BRL(a.ian_mes || (a.valor_mensal_juntos / 2))}/mês</span>
                                        </div>
                                    </div>
                                    <div class="mx-4 mb-3 grid grid-cols-2 gap-2">
                                        <div class="flex items-center gap-1.5 px-3 py-2 rounded-xl bg-muted/50 text-[10px] text-muted-foreground">
                                            <i data-lucide="landmark" class="size-3.5"></i>
                                            <span>${a.destino_rotulo}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5 px-3 py-2 rounded-xl bg-muted/50 text-[10px] text-muted-foreground">
                                            <i data-lucide="users" class="size-3.5"></i>
                                            <span>${a.divisao_rotulo}</span>
                                        </div>
                                    </div>
                                    <div class="mx-4 mb-3 flex items-center gap-2 px-3 py-2.5 rounded-xl bg-muted/40 text-[11px] text-muted-foreground">
                                        <i data-lucide="bell" class="size-3.5 text-primary shrink-0"></i>
                                        <span>${a.cobrador_rotulo}</span>
                                    </div>
                                    <div class="grid grid-cols-2 border-t border-border">
                                        <button type="button" onclick="abrirModalAtualizarMetaLar(${a.id_acordo}, '${a.titulo}', ${a.valor_total}, 'nov/2026')" class="py-3.5 text-xs font-bold text-muted-foreground hover:bg-muted/60 flex items-center justify-center gap-1.5 transition-colors border-r border-border cursor-pointer">
                                            <i data-lucide="edit-3" class="size-4"></i> Editar
                                        </button>
                                        <button type="button" onclick="abrirModalGuardarMetaLarPix({ id_meta: ${a.id_acordo}, titulo: '${a.titulo}', valor_alvo: ${a.valor_total}, valor_atual: ${guardado} })" class="py-3.5 text-xs font-bold text-emerald-700 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-950/20 flex items-center justify-center gap-1.5 transition-colors cursor-pointer">
                                            <i data-lucide="wallet" class="size-4"></i> Guardar este mês
                                        </button>
                                    </div>
                                </div>
                            </div>`;
                        }).join('');
                    }
                }

                // ---- Dívidas divididas ----
                const listaDividas = document.getElementById('acordosListaDividasDivididas');
                if (listaDividas) {
                    const dividas = data.dividas_divididas || [];
                    if (!dividas.length) {
                        listaDividas.innerHTML = '<p class="text-xs text-muted-foreground py-4 text-center">Nenhuma dívida dividida ativa.</p>';
                    } else {
                        listaDividas.innerHTML = dividas.map(d => {
                            const pctDivida = d.parcelas_total > 0 ? Math.round((d.parcelas_pagas / d.parcelas_total) * 100) : 0;
                            return `
                            <div class="rounded-3xl border border-border bg-card shadow-card p-4 space-y-3">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-black text-foreground">${d.titulo}</p>
                                    <span class="text-[10px] font-black px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-300">${d.parcelas_rotulo}</span>
                                </div>
                                <div>
                                    <div class="flex justify-between text-[10px] text-muted-foreground mb-1">
                                        <span>${d.parcelas_pagas} de ${d.parcelas_total} parcelas pagas</span>
                                        <span class="font-bold text-emerald-700">${pctDivida}%</span>
                                    </div>
                                    <div class="w-full bg-muted rounded-full h-1.5 overflow-hidden">
                                        <div class="h-full rounded-full bg-emerald-700" style="width:${pctDivida}%"></div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-foreground">${BRL((d.valor_mensal_juntos || 500) / 2)}/mês cada</span>
                                    <button onclick="pagarParcelaDivida(${d.id_divida || 1}, '${d.titulo.replace(/'/g, "\\'")}', ${(d.valor_mensal_juntos || 500) / 2})" class="px-3.5 py-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white text-xs font-bold flex items-center gap-1.5 shadow-xs transition cursor-pointer">
                                        <i data-lucide="check-circle" class="size-3.5"></i> Pagar parcela
                                    </button>
                                </div>
                            </div>`;
                        }).join('');
                    }
                }

                lucide.createIcons();
            } catch (e) { console.error('Erro ao carregar acordos:', e); }
        }

        async function votarPropostaAcordo(id, acao) {
            try {
                const res = await fetch(`/api/acordos/propostas/votar/${id}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({ acao })
                });
                const data = await res.json();
                const msgs = { 
                    aceitar: 'Acordo aceito com sucesso! Movido para a lista de acordos ativos do Lar e seu parceiro foi notificado.', 
                    recusar: 'Proposta recusada com diplomacia e arquivada.', 
                    contrapor: 'Contraproposta enviada para análise do parceiro.' 
                };
                seivaNotificar(data.mensagem || msgs[acao], acao === 'recusar' ? 'aviso' : 'sucesso', acao === 'aceitar' ? 'Acordo Ativo' : 'Mesa de Acordos');
                carregarAcordosDados();
                if (typeof carregarNotificacoesDados === 'function') carregarNotificacoesDados();
            } catch (e) { seivaNotificar('Erro ao processar voto.', 'erro', 'Erro'); }
        }

        function pagarParcelaDivida(id, titulo, valor) {
            seivaNotificar(`Pagamento da parcela de ${BRL(valor)} de "${titulo}" registrado! O parceiro foi notificado sobre a quitação da parcela.`, 'sucesso', 'Parcela Paga');
            fetch('/api/cobrancas/lembrete', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                body: JSON.stringify({
                    titulo: `Parcela paga: ${titulo}`,
                    valor: valor,
                    mensagem: `Paguei a minha parcela deste mês de "${titulo}" (${BRL(valor)}). Mais um passo pra quitar!`
                })
            }).catch(e => console.log('Silencioso:', e));
            setTimeout(() => { carregarAcordosDados(); }, 700);
        }

        // Mantido para compatibilidade retroativa
        async function votarAcordo(id, acao) { return votarPropostaAcordo(id, acao); }

        function mostrarContrapropostaInline(id) {
            const painel = document.getElementById(`contrapropostaPanel${id}`);
            if (painel) painel.classList.toggle('hidden');
            lucide.createIcons();
        }

        async function enviarContraproposta(id) {
            const input = document.getElementById(`contrapropostaValor${id}`);
            const novoValor = parseFloat(input?.value || 0);
            if (!novoValor || novoValor <= 0) { seivaNotificar('Informe um valor válido.', 'aviso', 'Campo obrigatório'); return; }
            try {
                const res = await fetch(`/api/acordos/propostas/votar/${id}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({ acao: 'contrapor', novo_valor: novoValor })
                });
                const data = await res.json();
                seivaNotificar(data.mensagem || 'Contraproposta enviada!', 'sucesso', 'Contraproposta');
                carregarAcordosDados();
            } catch (e) { seivaNotificar('Erro ao enviar contraproposta.', 'erro', 'Erro'); }
        }

        function alternarExpansaoAcordoPoupando(id) {
            const painel = document.getElementById(`expansaoAcordo${id}`);
            const chevron = document.getElementById(`chevronAcordo${id}`);
            if (painel) {
                painel.classList.toggle('hidden');
                if (chevron) chevron.style.transform = painel.classList.contains('hidden') ? '' : 'rotate(180deg)';
            }
        }

        function abrirModalNovoAcordo() {
            novoAcordoPassoAtual = 1;
            novoAcordoTipoSelecionado = 'poupar_juntos';
            novoAcordoDivisaoSelecionada = '50/50';
            const modal = document.getElementById('modalNovoAcordoPassos');
            if (modal) {
                modal.classList.remove('hidden');
                irParaPassoNovoAcordo(1);
                const btnPadraoTipo = modal.querySelector('[data-tipo="poupar_juntos"]');
                if (btnPadraoTipo) selecionarTipoNovoAcordo('poupar_juntos', btnPadraoTipo);
                lucide.createIcons();
            }
        }

        function selecionarTipoNovoAcordo(tipo, btn) {
            novoAcordoTipoSelecionado = tipo;
            const modal = document.getElementById('modalNovoAcordoPassos');
            if (!modal) return;
            modal.querySelectorAll('[data-tipo]').forEach(b => {
                b.classList.remove('ring-2', 'ring-primary', 'bg-primary/10', 'text-primary', 'font-black');
                b.classList.add('text-muted-foreground');
            });
            btn.classList.add('ring-2', 'ring-primary', 'bg-primary/10', 'text-primary', 'font-black');
            btn.classList.remove('text-muted-foreground');
            const campoLink = document.getElementById('novoAcordoCampoLink');
            if (campoLink) campoLink.style.display = ['poupar_juntos', 'divida_dividida', 'viagem'].includes(tipo) ? 'block' : 'none';
        }

        function irParaPassoNovoAcordo(passo) {
            novoAcordoPassoAtual = passo;
            const modal = document.getElementById('modalNovoAcordoPassos');
            if (!modal) return;
            modal.querySelectorAll('[data-passo]').forEach(el => el.classList.toggle('hidden', el.dataset.passo != passo));
            modal.querySelectorAll('[data-dot]').forEach(dot => {
                const p = parseInt(dot.dataset.dot);
                dot.classList.toggle('bg-primary', p <= passo);
                dot.classList.toggle('bg-muted', p > passo);
            });
        }

        function avancarPassoNovoAcordo() {
            if (novoAcordoPassoAtual === 1) {
                const nome = document.getElementById('novoAcordoNome')?.value.trim();
                const valor = parseFloat(document.getElementById('novoAcordoValor')?.value || 0);
                if (!nome) { seivaNotificar('Informe o nome do acordo.', 'aviso', 'Campo obrigatório'); return; }
                if (!valor || valor <= 0) { seivaNotificar('Informe um valor válido.', 'aviso', 'Campo obrigatório'); return; }
            }
            if (novoAcordoPassoAtual === 2) atualizarCalculosPasso2Acordo();
            if (novoAcordoPassoAtual < 3) {
                if (novoAcordoPassoAtual === 2) preencherRevisaoNovoAcordo();
                irParaPassoNovoAcordo(novoAcordoPassoAtual + 1);
            }
        }

        function voltarPassoNovoAcordo() {
            if (novoAcordoPassoAtual > 1) irParaPassoNovoAcordo(novoAcordoPassoAtual - 1);
        }

        function selecionarDivisaoNovoAcordo(divisao, btn) {
            novoAcordoDivisaoSelecionada = divisao;
            const modal = document.getElementById('modalNovoAcordoPassos');
            if (!modal) return;
            modal.querySelectorAll('.btn-div-acordo').forEach(b => {
                b.classList.remove('ring-2', 'ring-primary', 'bg-primary/10', 'text-primary', 'font-black');
                b.classList.add('text-muted-foreground', 'font-semibold');
            });
            btn.classList.add('ring-2', 'ring-primary', 'bg-primary/10', 'text-primary', 'font-black');
            btn.classList.remove('text-muted-foreground', 'font-semibold');

            const boxLivre = document.getElementById('novoAcordoBoxDivisaoLivre');
            if (boxLivre) {
                if (divisao === 'personalizada' || divisao === 'livre') {
                    boxLivre.classList.remove('hidden');
                    const slider = document.getElementById('sliderAcordoLivre');
                    if (slider) atualizarSliderAcordoLivre(slider.value);
                } else {
                    boxLivre.classList.add('hidden');
                }
            }
            atualizarCalculosPasso2Acordo();
        }

        function atualizarSliderAcordoLivre(val) {
            const meuPct = parseInt(val);
            const parcPct = 100 - meuPct;
            const lblMeu = document.getElementById('lblAcordoMeuPct');
            const lblParc = document.getElementById('lblAcordoParceiroPct');
            if (lblMeu) lblMeu.textContent = `${meuPct}%`;
            if (lblParc) lblParc.textContent = `${parcPct}%`;
            novoAcordoDivisaoSelecionada = `${meuPct}/${parcPct}`;
            atualizarCalculosPasso2Acordo();
        }

        function atualizarCalculosPasso2Acordo() {
            const valor = parseFloat(document.getElementById('novoAcordoValor')?.value || 0);
            let mensal = parseFloat(document.getElementById('novoAcordoMensalCada')?.value || 0);
            const divEl = document.getElementById('novoAcordoDivisaoInfo');
            if (!valor || !divEl) return;

            let pctMeu = 0.5;
            if (novoAcordoDivisaoSelecionada === '60/40') pctMeu = 0.6;
            else if (novoAcordoDivisaoSelecionada === '70/30') pctMeu = 0.7;
            else if (novoAcordoDivisaoSelecionada === '90/10') pctMeu = 0.9;
            else if (novoAcordoDivisaoSelecionada.includes('/')) {
                const parts = novoAcordoDivisaoSelecionada.split('/');
                if (parts.length === 2 && !isNaN(parseInt(parts[0]))) pctMeu = parseInt(parts[0]) / 100;
            }

            const parteMinhaTotal = valor * pctMeu;
            const parteParceiroTotal = valor * (1 - pctMeu);

            if (!mensal || mensal <= 0) {
                mensal = Math.round((parteMinhaTotal / 4) * 100) / 100;
                const inputM = document.getElementById('novoAcordoMensalCada');
                if (inputM && !inputM.value) inputM.value = mensal.toFixed(2);
            }

            const meses = mensal > 0 ? Math.ceil(parteMinhaTotal / mensal) : 4;
            divEl.innerHTML = `<span class="block">Divisão ${novoAcordoDivisaoSelecionada}: Sua parte total ${BRL(parteMinhaTotal)} · Parceiro: ${BRL(parteParceiroTotal)}</span>
            <span class="text-[10px] text-muted-foreground block mt-0.5">Estimativa: ~${meses} meses a ${BRL(mensal)}/mês cada</span>`;
        }

        function preencherRevisaoNovoAcordo() {
            const nome = document.getElementById('novoAcordoNome')?.value.trim() || '';
            const valor = parseFloat(document.getElementById('novoAcordoValor')?.value || 0);
            const mensal = parseFloat(document.getElementById('novoAcordoMensalCada')?.value || 0);
            const isMensal = document.getElementById('novoAcordoMensalToggle')?.checked;
            const tiposLabel = { poupar_juntos: 'Poupar juntos', divida_dividida: 'Dívida dividida', viagem: 'Viajar', poupanca_livre: 'Poupança livre', reserva: 'Reserva', curso: 'Curso', outros: 'Outros' };
            const set = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val; };
            set('novoAcordoReviTipo', tiposLabel[novoAcordoTipoSelecionado] || novoAcordoTipoSelecionado);
            set('novoAcordoReviNome', nome);
            set('novoAcordoReviValor', BRL(valor));
            set('novoAcordoReviMensal', isMensal ? `${BRL(mensal)}/mês` : 'Contribuição única');
            set('novoAcordoReviDivisao', novoAcordoDivisaoSelecionada);
        }

        async function executarEnviarPropostaNovoAcordo() {
            const nome = document.getElementById('novoAcordoNome')?.value.trim();
            const valor = parseFloat(document.getElementById('novoAcordoValor')?.value || 0);
            const mensal = parseFloat(document.getElementById('novoAcordoMensalCada')?.value || 0);
            const link = document.getElementById('novoAcordoLink')?.value.trim() || '';
            if (!nome || !valor) { seivaNotificar('Dados incompletos.', 'aviso', 'Revise'); return; }
            const btn = document.getElementById('btnEnviarPropostaNovoAcordo');
            if (btn) { btn.disabled = true; btn.textContent = 'Enviando...'; }
            try {
                const res = await fetch('/api/acordos/propostas', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({
                        titulo: nome,
                        tipo: novoAcordoTipoSelecionado,
                        valor_total: valor,
                        valor,
                        valor_mensal: mensal,
                        divisao: novoAcordoDivisaoSelecionada,
                        divisao_sugerida: novoAcordoDivisaoSelecionada,
                        proposta_texto: `Proposta: ${nome} (${BRL(valor)})`,
                        link_produto: link
                    })
                });
                const data = await res.json();
                document.getElementById('modalNovoAcordoPassos')?.classList.add('hidden');
                seivaNotificar(data.mensagem || 'Proposta enviada ao parceiro!', 'sucesso', 'Proposta enviada');
                carregarAcordosDados();
            } catch (e) { seivaNotificar('Erro ao enviar proposta.', 'erro', 'Erro'); }
            finally { if (btn) { btn.disabled = false; btn.innerHTML = '<i data-lucide="send" class="size-4"></i> Enviar proposta'; lucide.createIcons(); } }
        }

        async function adicionarPropostaPrompt() { abrirModalNovoAcordo(); }

        // ==========================================
        // METAS — Objetivos Individuais e do Lar
        // ==========================================
        let metasAbaAtiva = 'individual';
        let produtosOlhoCache = { individual: [], lar: [] };
        let filtroProdOlhoAtivo = 'individual';

        function alternarAbaMetas(aba) {
            metasAbaAtiva = aba;
            const painelInd = document.getElementById('painelMeusObjetivos');
            const painelLar = document.getElementById('painelPlanoLar');
            const tabInd    = document.getElementById('tabMeusObjetivos');
            const tabLar    = document.getElementById('tabPlanoLar');

            const ativoClass = 'flex-1 py-3 px-4 rounded-xl text-xs sm:text-sm font-bold transition-all bg-card text-foreground shadow-2xs border border-border/50 flex items-center justify-center gap-2';
            const inativoClass = 'flex-1 py-3 px-4 rounded-xl text-xs sm:text-sm font-bold transition-all text-muted-foreground hover:text-foreground flex items-center justify-center gap-2 border border-transparent';

            if (aba === 'individual') {
                if (painelInd) painelInd.classList.remove('hidden');
                if (painelLar) painelLar.classList.add('hidden');
                if (tabInd)    tabInd.className = ativoClass;
                if (tabLar)    tabLar.className = inativoClass;
            } else {
                if (painelInd) painelInd.classList.add('hidden');
                if (painelLar) painelLar.classList.remove('hidden');
                if (tabInd)    tabInd.className = inativoClass;
                if (tabLar)    tabLar.className = ativoClass;
            }

            // Sincroniza a vitrine de produtos de olho com o contexto da aba
            filtrarProdutosOlho(aba === 'lar' ? 'lar' : 'individual');
            lucide.createIcons();
        }

        async function carregarMetasDados() {
            try {
                const res = await fetch('/api/metas');
                if (!res.ok) return;
                const data = await res.json();

                const individuais = data.individuais || [];
                const metasLar    = data.lar || [];
                const todas       = [...individuais, ...metasLar];

                // Hero Card com métricas nobres
                const totalAtual  = todas.reduce((s, m) => s + parseFloat(m.valor_atual || 0), 0);
                const totalAlvo   = todas.reduce((s, m) => s + parseFloat(m.valor_alvo  || 1), 0);
                const pct         = totalAlvo > 0 ? Math.round((totalAtual / totalAlvo) * 100) : 0;
                const mensal      = todas.reduce((s, m) => s + parseFloat(m.contribuicao_mensal || 0), 0);

                const heroTotalEl = document.getElementById('metasHeroTotal');
                const heroAlvoEl  = document.getElementById('metasHeroAlvo');
                const heroPctEl   = document.getElementById('metasHeroProgresso');
                const heroMensEl  = document.getElementById('metasHeroMensal');
                if (heroTotalEl) heroTotalEl.innerText = BRL(totalAtual);
                if (heroAlvoEl)  heroAlvoEl.innerText  = `de ${BRL(totalAlvo)} planejados`;
                if (heroPctEl)   heroPctEl.innerText   = `${pct}%`;
                if (heroMensEl)  heroMensEl.innerText  = BRL(mensal);

                // Contadores nas Abas de Metas
                const badgeInd = document.getElementById('badgeCountMetasIndiv');
                const badgeLar = document.getElementById('badgeCountMetasLar');
                if (badgeInd) badgeInd.innerText = String(individuais.length);
                if (badgeLar) badgeLar.innerText = String(metasLar.length);

                // Renderizar metas individuais
                _renderizarCardsMetasNovo(individuais, '#metasListaMeusObjetivos', false);

                // Renderizar metas do lar
                _renderizarCardsMetasNovo(metasLar, '#metasListaPlanoLar', true);

                // Cache de produtos de olho (Individual vs Casal/Lar)
                produtosOlhoCache.individual = data.produtos_de_olho_individuais || data.produtos_de_olho || [];
                produtosOlhoCache.lar = data.produtos_de_olho_lar || [];

                // Atualizar contadores numéricos dos filtros de produtos
                const badgeProdInd = document.getElementById('badgeCountProdIndiv');
                const badgeProdLar = document.getElementById('badgeCountProdLar');
                if (badgeProdInd) badgeProdInd.innerText = String(produtosOlhoCache.individual.length);
                if (badgeProdLar) badgeProdLar.innerText = String(produtosOlhoCache.lar.length);

                // Renderizar radar de produtos conforme a aba ativa
                filtrarProdutosOlho(metasAbaAtiva === 'lar' ? 'lar' : 'individual');

            } catch(e) { console.error('Erro metas:', e); }
        }

        async function fazerAporteRapidoMeta(metaId, valor) {
            try {
                const res = await fetch(`/api/metas/${metaId}/contribuir`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({ valor: parseFloat(valor) })
                });

                if (res.ok) {
                    seivaNotificar(`+ ${BRL(valor)} guardados com sucesso! Você antecipou sua conquista.`, 'sucesso', 'Meta Acelerada');
                    carregarMetasDados();
                    carregarDashboardDados();
                } else {
                    seivaNotificar('Não foi possível registrar o aporte.', 'erro');
                }
            } catch(e) {
                seivaNotificar('Erro de conexão ao guardar na meta.', 'erro');
            }
        }

        function _renderizarCardsMetasNovo(metas, seletor, isLar) {
            const cont = document.querySelector(seletor);
            if (!cont) return;

            if (!metas.length) {
                cont.innerHTML = `<div class="rounded-3xl border border-border bg-card p-10 text-center space-y-2 shadow-2xs">
                    <i data-lucide="${isLar ? 'home' : 'target'}" class="size-10 text-muted-foreground/40 mx-auto"></i>
                    <p class="text-sm font-bold text-foreground">${isLar ? 'Nenhum plano do lar cadastrado ainda.' : 'Nenhum objetivo individual cadastrado.'}</p>
                    <p class="text-xs text-muted-foreground">${isLar ? 'Crie um plano conjunto para mobília, viagens ou reserva do casal.' : 'Defina um objetivo para comprar sem culpa e com prazo definido.'}</p>
                </div>`;
                lucide.createIcons();
                return;
            }

            cont.innerHTML = metas.map(m => {
                const atual = parseFloat(m.valor_atual || 0);
                const alvo  = parseFloat(m.valor_alvo  || 1);
                const faltam = Math.max(0, alvo - atual);
                const p     = Math.min(100, Math.round((atual / alvo) * 100));

                // Estimativa de tempo / dias restantes para conquista
                const aporteMensal = parseFloat(m.contribuicao_mensal || 300);
                const aporteDiario = Math.max(1, aporteMensal / 30);
                const diasRestantes = faltam > 0 ? Math.max(1, Math.round(faltam / aporteDiario)) : 0;

                // Dias economizados com aportes extras
                const diasEconomia50 = Math.min(diasRestantes, Math.round(50 / aporteDiario));
                const diasEconomia100 = Math.min(diasRestantes, Math.round(100 / aporteDiario));
                const diasEconomia200 = Math.min(diasRestantes, Math.round(200 / aporteDiario));

                // Status de conquista / Projeção emocional com alto contraste e ZERO emojis
                let statusBadge = '';
                if (faltam <= 0) {
                    statusBadge = `
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-emerald-100 dark:bg-emerald-950/80 border border-emerald-400 dark:border-emerald-700/60 text-emerald-950 dark:text-emerald-200 text-xs font-black shadow-2xs">
                            <i data-lucide="check-circle-2" class="size-3.5 text-emerald-700 dark:text-emerald-400"></i>
                            <span>Objetivo Conquistado!</span>
                        </div>`;
                } else if (p >= 80) {
                    statusBadge = `
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-amber-100 dark:bg-amber-950/80 border border-amber-300 dark:border-amber-700/60 text-amber-950 dark:text-amber-200 text-xs font-black shadow-2xs">
                            <i data-lucide="zap" class="size-3.5 text-amber-600 dark:text-amber-400"></i>
                            <span>Na reta final! Faltam apenas ~${diasRestantes} dias</span>
                        </div>`;
                } else if (p >= 40) {
                    statusBadge = `
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-300 dark:border-emerald-700/50 text-emerald-950 dark:text-emerald-200 text-xs font-bold shadow-2xs">
                            <i data-lucide="clock" class="size-3.5 text-emerald-700 dark:text-emerald-400"></i>
                            <span>Faltam ~${diasRestantes} dias no seu ritmo</span>
                        </div>`;
                } else {
                    statusBadge = `
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-muted border border-border text-foreground text-xs font-bold shadow-2xs">
                            <i data-lucide="calendar" class="size-3.5 text-muted-foreground"></i>
                            <span>Previsão de entrega em ~${diasRestantes} dias</span>
                        </div>`;
                }

                // Cor da barra de progresso verde institucional
                const corBarra = p >= 100 ? 'bg-emerald-600' : 'bg-gradient-to-r from-emerald-700 to-emerald-500';

                // Imagem real ou ícone Lucide com visual nobre e harmonioso
                const visualProduto = m.imagem
                    ? `<img src="${m.imagem}" alt="${m.titulo}" class="size-16 rounded-2xl object-cover shrink-0 border border-emerald-500/20 shadow-soft">`
                    : `<span class="size-16 rounded-2xl bg-emerald-800/10 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 border border-emerald-600/30 flex items-center justify-center shrink-0 shadow-soft"><i data-lucide="${m.icone || (isLar ? 'home' : 'laptop')}" class="size-7"></i></span>`;

                return `
                <div class="rounded-3xl border border-border/80 bg-card shadow-card overflow-hidden transition hover:border-emerald-500/30">
                    <!-- Cabeçalho do card com produto e badge -->
                    <div class="p-5 pb-3 space-y-3">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-center gap-3.5 min-w-0 flex-1">
                                ${visualProduto}
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-base font-extrabold text-foreground truncate">${m.titulo}</h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="text-xs text-muted-foreground font-medium">Guardo ${BRL(aporteMensal)}/mês</span>
                                        ${m.loja ? `<span class="text-[10px] font-bold px-2 py-0.2 rounded-full bg-muted text-muted-foreground">${m.loja}</span>` : ''}
                                    </div>
                                    ${m.link_referencia ? `
                                        <div class="flex items-center gap-2 mt-1">
                                            <a href="${m.link_referencia}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 dark:text-emerald-400 hover:underline">
                                                <i data-lucide="external-link" class="size-3"></i>
                                                <span>Ver na loja</span>
                                            </a>
                                            <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-900 dark:text-emerald-200 bg-emerald-100 dark:bg-emerald-950/80 px-2 py-0.5 rounded-full border border-emerald-300 dark:border-emerald-700/50">
                                                <i data-lucide="bell" class="size-3 text-emerald-700 dark:text-emerald-400"></i>
                                                <span>Monitorando</span>
                                            </span>
                                        </div>
                                    ` : `
                                        <button type="button" onclick="abrirModalEditarMeta(${m.id_meta}, '${(m.titulo||'').replace(/'/g, "\\'")}', ${alvo}, '${m.categoria||'produto'}', '', '', '', true)"
                                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg border border-border bg-muted/40 hover:bg-muted text-[10px] font-bold text-foreground transition mt-1 shadow-2xs">
                                            <i data-lucide="link" class="size-3 text-emerald-700"></i>
                                            <span>Adicionar link de compra</span>
                                        </button>
                                    `}
                                </div>
                            </div>

                            <div class="flex items-center gap-1.5 shrink-0">
                                <button type="button" onclick="abrirModalEditarMeta(${m.id_meta}, '${(m.titulo||'').replace(/'/g, "\\'")}', ${alvo}, '${m.categoria||'produto'}', '${(m.link_referencia||'').replace(/'/g, "\\'")}', '${(m.imagem||'').replace(/'/g, "\\'")}', '${(m.loja||'').replace(/'/g, "\\'")}', ${m.monitorar_promocao !== false})"
                                        class="size-8 rounded-xl border border-border bg-card hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition shadow-2xs"
                                        title="Editar objetivo">
                                    <i data-lucide="edit-3" class="size-3.5"></i>
                                </button>
                                <button type="button" onclick="excluirMetaDireto(${m.id_meta}, '${(m.titulo||'').replace(/'/g, "\\'")}')"
                                        class="size-8 rounded-xl border border-rose-300 dark:border-rose-900 bg-rose-50/50 dark:bg-rose-950/20 hover:bg-rose-100 text-rose-600 flex items-center justify-center transition shadow-2xs"
                                        title="Excluir objetivo">
                                    <i data-lucide="trash-2" class="size-3.5"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Badge de Status e Estimativa em Dias -->
                        <div>
                            ${statusBadge}
                        </div>
                    </div>

                    <!-- Barra de progresso robusta -->
                    <div class="px-5 space-y-1.5">
                        <div class="h-3 w-full rounded-full bg-muted overflow-hidden border border-border/40">
                            <div class="h-full ${corBarra} rounded-full transition-all duration-700 shadow-2xs" style="width:${p}%"></div>
                        </div>
                        <div class="flex items-center justify-between text-xs font-bold">
                            <span class="text-foreground">${BRL(atual)} acumulados <span class="text-emerald-700 dark:text-emerald-400 font-extrabold">(${p}%)</span></span>
                            <span class="text-muted-foreground">de ${BRL(alvo)}</span>
                        </div>
                    </div>

                    <!-- Valores e Detalhes de Conta -->
                    <div class="p-5 pt-3 space-y-3">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="rounded-2xl border border-border/70 bg-muted/30 p-3 space-y-0.5">
                                <span class="text-[10px] font-bold text-muted-foreground flex items-center gap-1">
                                    <i data-lucide="wallet" class="size-3 text-emerald-700"></i>
                                    Guardado em
                                </span>
                                <strong class="text-xs font-black text-foreground truncate block">${m.onde_guardado || 'Poupança Caixa'}</strong>
                            </div>
                            <div class="rounded-2xl border border-border/70 bg-muted/30 p-3 space-y-0.5">
                                <span class="text-[10px] font-bold text-muted-foreground flex items-center gap-1">
                                    <i data-lucide="hourglass" class="size-3 text-amber-500"></i>
                                    Falta guardar
                                </span>
                                <strong class="text-xs font-black ${faltam <= 0 ? 'text-emerald-700 dark:text-emerald-400' : 'text-foreground'} block">
                                    ${faltam <= 0 ? 'Concluída!' : BRL(faltam)}
                                </strong>
                            </div>
                        </div>

                        ${isLar ? `
                            <!-- Divisão do Lar (Casal) com Alto Contraste e Legibilidade -->
                            <div class="rounded-2xl border border-border bg-muted/40 p-3.5 space-y-2.5">
                                <div class="flex items-center justify-between">
                                    <span class="text-[11px] font-black uppercase tracking-wider text-foreground flex items-center gap-1.5">
                                        <i data-lucide="users" class="size-3.5 text-emerald-700"></i>
                                        <span>Divisão do Casal</span>
                                    </span>
                                    <span class="text-[10px] font-bold text-muted-foreground">50% / 50%</span>
                                </div>
                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <div class="flex items-center gap-2.5 p-2 rounded-xl bg-card border border-border shadow-2xs">
                                        <span class="size-6 rounded-full bg-emerald-800 text-white text-[10px] font-black flex items-center justify-center shrink-0 shadow-2xs">ME</span>
                                        <div class="min-w-0">
                                            <span class="text-[10px] text-muted-foreground block font-medium">Você</span>
                                            <strong class="text-xs text-foreground font-black truncate block">R$ ${(m.divisao_voce || 250).toLocaleString('pt-BR', {minimumFractionDigits:2})}/mês</strong>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2.5 p-2 rounded-xl bg-card border border-border shadow-2xs">
                                        <span class="size-6 rounded-full bg-emerald-600 text-white text-[10px] font-black flex items-center justify-center shrink-0 shadow-2xs">IM</span>
                                        <div class="min-w-0">
                                            <span class="text-[10px] text-muted-foreground block font-medium">Ian</span>
                                            <strong class="text-xs text-foreground font-black truncate block">R$ ${(m.divisao_parceiro || 250).toLocaleString('pt-BR', {minimumFractionDigits:2})}/mês</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ` : ''}

                        <!-- Simulador / Acelerador de Meta (Agilizar Conquista) -->
                        ${faltam > 0 ? `
                        <div class="rounded-2xl border border-border bg-card p-3.5 space-y-2.5 shadow-2xs">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-black text-foreground flex items-center gap-1.5">
                                    <i data-lucide="zap" class="size-3.5 text-amber-500"></i>
                                    <span>Agilizar Conquista</span>
                                </span>
                                <span class="text-[10px] font-semibold text-muted-foreground">Toque para depositar e adiantar dias</span>
                            </div>
                            <div class="grid grid-cols-3 gap-2">
                                <button type="button" onclick="fazerAporteRapidoMeta(${m.id_meta}, 50)"
                                        class="py-2.5 px-1.5 rounded-xl border border-border bg-muted/40 hover:bg-emerald-800 hover:text-white hover:border-emerald-800 text-foreground text-xs font-black transition flex flex-col items-center justify-center shadow-2xs group">
                                    <span class="font-extrabold">+ R$ 50</span>
                                    <span class="text-[10px] font-semibold text-emerald-700 dark:text-emerald-400 group-hover:text-emerald-100">-${diasEconomia50} dias</span>
                                </button>
                                <button type="button" onclick="fazerAporteRapidoMeta(${m.id_meta}, 100)"
                                        class="py-2.5 px-1.5 rounded-xl border border-border bg-muted/40 hover:bg-emerald-800 hover:text-white hover:border-emerald-800 text-foreground text-xs font-black transition flex flex-col items-center justify-center shadow-2xs group">
                                    <span class="font-extrabold">+ R$ 100</span>
                                    <span class="text-[10px] font-semibold text-emerald-700 dark:text-emerald-400 group-hover:text-emerald-100">-${diasEconomia100} dias</span>
                                </button>
                                <button type="button" onclick="fazerAporteRapidoMeta(${m.id_meta}, 200)"
                                        class="py-2.5 px-1.5 rounded-xl border border-border bg-muted/40 hover:bg-emerald-800 hover:text-white hover:border-emerald-800 text-foreground text-xs font-black transition flex flex-col items-center justify-center shadow-2xs group">
                                    <span class="font-extrabold">+ R$ 200</span>
                                    <span class="text-[10px] font-semibold text-emerald-700 dark:text-emerald-400 group-hover:text-emerald-100">-${diasEconomia200} dias</span>
                                </button>
                            </div>
                        </div>
                        ` : ''}

                        <!-- Botão Principal de Guardar -->
                        <div class="pt-1">
                            <button onclick="abrirGuardarNaMeta(${m.id_meta}, '${(m.titulo||'').replace(/'/g, "\\'")}', ${atual}, ${alvo}, '${isLar ? 'lar' : 'individual'}')"
                                    class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs flex items-center justify-center gap-2 shadow-soft transition">
                                <i data-lucide="plus" class="size-4"></i>
                                <span>Guardar dinheiro nesta meta</span>
                            </button>
                        </div>
                    </div>
                </div>`;
            }).join('');
            lucide.createIcons();
        }

        // --- RADAR DE PRODUTOS DE OLHO (WISHLIST INDIVIDUAL E DO CASAL) ---
        function filtrarProdutosOlho(tipo) {
            filtroProdOlhoAtivo = tipo;
            const btnInd = document.getElementById('btnFiltroProdOlhoIndiv');
            const btnLar = document.getElementById('btnFiltroProdOlhoLar');

            const ativoClass = 'chip-filtro-prod-olho active px-3.5 py-1.5 rounded-xl text-xs font-black transition bg-emerald-700 text-white flex items-center gap-1.5 shadow-2xs border border-emerald-500/40';
            const inativoClass = 'chip-filtro-prod-olho px-3.5 py-1.5 rounded-xl text-xs font-bold transition bg-white/10 hover:bg-white/15 text-emerald-200 hover:text-white flex items-center gap-1.5 border border-white/10';

            if (tipo === 'lar') {
                if (btnInd) btnInd.className = inativoClass;
                if (btnLar) btnLar.className = ativoClass;
                _renderizarGridProdutosOlho(produtosOlhoCache.lar, true);
            } else {
                if (btnInd) btnInd.className = ativoClass;
                if (btnLar) btnLar.className = inativoClass;
                _renderizarGridProdutosOlho(produtosOlhoCache.individual, false);
            }
            lucide.createIcons();
        }

        function _renderizarGridProdutosOlho(produtos, isLar = false) {
            const cont = document.getElementById('metasGridProdutosOlho');
            if (!cont) return;

            if (!produtos || !produtos.length) {
                const tituloVazio = isLar 
                    ? 'Nenhum produto monitorado para nossa casa ainda.' 
                    : 'Nenhum produto pessoal na mira ainda.';
                const subtituloVazio = isLar
                    ? 'Cole o link de uma geladeira, air fryer ou móvel para o casal orçar e planejar juntos!'
                    : 'Cole o link de um notebook, tênis ou item pessoal para comprar sem culpa no seu ritmo!';
                const botaoTexto = isLar ? 'Colocar produto para nossa casa' : 'Colocar produto para mim';

                cont.innerHTML = `
                    <div class="col-span-full rounded-2xl border border-white/10 bg-white/[0.03] p-8 text-center space-y-2.5">
                        <i data-lucide="${isLar ? 'home' : 'shopping-bag'}" class="size-8 text-emerald-400/60 mx-auto"></i>
                        <p class="text-xs font-extrabold text-white">${tituloVazio}</p>
                        <p class="text-[11px] text-emerald-200/70 max-w-md mx-auto leading-relaxed">${subtituloVazio}</p>
                        <button type="button" onclick="abrirModalAdicionarProdutoOlho('${isLar ? 'lar' : 'individual'}')" 
                                class="mt-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition inline-flex items-center gap-1.5 shadow-2xs">
                            <i data-lucide="plus" class="size-3.5"></i>
                            <span>${botaoTexto}</span>
                        </button>
                    </div>
                `;
                lucide.createIcons();
                return;
            }

            cont.innerHTML = produtos.map(p => {
                const precoVal = parseFloat(p.preco_alvo || p.preco || 0);
                const precoFmt = BRL(precoVal);
                const loja = p.loja || 'Loja online';
                const link = p.link_referencia || p.link || '';
                const img = p.imagem || 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=160&auto=format&fit=crop&q=80';
                const nomeEscaped = (p.nome || '').replace(/'/g, "\\'");
                const lojaEscaped = loja.replace(/'/g, "\\'");
                const linkEscaped = link.replace(/'/g, "\\'");
                const imgEscaped = img.replace(/'/g, "\\'");
                const idProd = p.id_produto || '';
                const ehLarItem = isLar || p.tipo === 'lar' || p.lar_id !== null;

                const badgeDestino = ehLarItem
                    ? `<span class="inline-flex items-center gap-1 text-[9px] font-black text-emerald-950 dark:text-emerald-200 bg-emerald-100 dark:bg-emerald-950/80 px-2 py-0.5 rounded-full border border-emerald-400 dark:border-emerald-700/60">
                         <i data-lucide="home" class="size-2.5 text-emerald-700 dark:text-emerald-400"></i>
                         Para nossa casa
                       </span>`
                    : `<span class="inline-flex items-center gap-1 text-[9px] font-black text-emerald-950 dark:text-emerald-200 bg-emerald-100 dark:bg-emerald-950/80 px-2 py-0.5 rounded-full border border-emerald-400 dark:border-emerald-700/60">
                         <i data-lucide="user" class="size-2.5 text-emerald-700 dark:text-emerald-400"></i>
                         Para mim
                       </span>`;

                return `
                <div class="rounded-2xl border border-emerald-500/20 bg-[#0d2015] hover:border-emerald-500/40 p-3.5 transition flex flex-col justify-between space-y-3 shadow-2xs group">
                    <div class="flex items-start gap-3">
                        <img src="${img}" alt="${p.nome}" class="size-16 rounded-xl object-cover shrink-0 border border-emerald-500/30 bg-black/40 shadow-2xs" onerror="this.src='/icon.svg'">
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-1.5 flex-wrap">
                                ${badgeDestino}
                                <span class="inline-flex items-center gap-1 text-[9px] font-semibold text-emerald-300">
                                    <i data-lucide="bell" class="size-2 text-emerald-400"></i>
                                    Radar
                                </span>
                            </div>
                            <h4 class="text-xs font-bold text-white truncate mt-1 group-hover:text-emerald-300 transition" title="${p.nome}">${p.nome}</h4>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="text-[10px] text-gray-400 truncate">${loja}</span>
                                ${link ? `<a href="${link}" target="_blank" rel="noopener noreferrer" class="text-[10px] font-bold text-emerald-400 hover:underline inline-flex items-center gap-0.5 shrink-0">Ver link ↗</a>` : ''}
                            </div>
                            <strong class="text-sm font-black text-white block mt-1">${precoFmt}</strong>
                        </div>
                    </div>

                    <div class="pt-2 border-t border-emerald-900/40 flex items-center justify-between gap-2">
                        <button type="button" onclick="abrirModalCriarMetaComDados('${nomeEscaped}', ${precoVal}, '${lojaEscaped}', '${linkEscaped}', '${imgEscaped}', '${ehLarItem ? 'compartilhada' : 'so_minha'}')"
                                class="flex-1 py-2 px-3 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white text-xs font-extrabold transition flex items-center justify-center gap-1.5 shadow-2xs">
                            <i data-lucide="target" class="size-3.5"></i>
                            <span>${ehLarItem ? 'Meta do Lar' : 'Minha Meta'}</span>
                        </button>
                        ${idProd ? `
                            <button type="button" onclick="removerProdutoOlho(${idProd})" title="Remover dos produtos de olho"
                                    class="size-8 rounded-xl border border-white/10 bg-white/5 hover:bg-rose-500/20 hover:border-rose-500/40 text-gray-400 hover:text-rose-400 flex items-center justify-center transition shrink-0">
                                <i data-lucide="trash-2" class="size-3.5"></i>
                            </button>
                        ` : ''}
                    </div>
                </div>`;
            }).join('');
            lucide.createIcons();
        }

        function selecionarDestinoProdOlho(btn, tipo) {
            document.querySelectorAll('.chip-destino-prod').forEach(b => {
                b.className = 'chip-destino-prod p-3 rounded-2xl border border-border bg-card text-left transition flex items-center gap-2.5 hover:bg-muted/20';
                const iconSpan = b.querySelector('span');
                if (iconSpan) iconSpan.className = 'size-7 rounded-xl bg-muted text-muted-foreground flex items-center justify-center shrink-0';
            });
            btn.className = 'chip-destino-prod active p-3 rounded-2xl border-2 border-emerald-600 bg-emerald-50/50 dark:bg-emerald-950/40 text-left transition flex items-center gap-2.5';
            const activeSpan = btn.querySelector('span');
            if (activeSpan) activeSpan.className = 'size-7 rounded-xl bg-emerald-800 text-white flex items-center justify-center shrink-0 shadow-2xs';
            const tipoInput = document.getElementById('modalProdOlhoTipo');
            if (tipoInput) tipoInput.value = tipo;
        }

        function abrirModalAdicionarProdutoOlho(tipoPadrao = null) {
            const modal = document.getElementById('modalAdicionarProdutoOlho');
            if (!modal) return;
            ['modalProdOlhoLink', 'modalProdOlhoNome', 'modalProdOlhoPreco', 'modalProdOlhoLoja', 'modalProdOlhoFotoUrl'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.value = '';
            });
            const prev = document.getElementById('modalProdOlhoPreviewFoto');
            if (prev) prev.classList.add('hidden');

            // Pré-selecionar o destino ('individual' ou 'lar')
            const destinoDesejado = tipoPadrao || (metasAbaAtiva === 'lar' ? 'lar' : 'individual');
            const btnInd = document.getElementById('btnDestinoProdIndividual');
            const btnLar = document.getElementById('btnDestinoProdLar');
            if (destinoDesejado === 'lar' && btnLar) {
                selecionarDestinoProdOlho(btnLar, 'lar');
            } else if (btnInd) {
                selecionarDestinoProdOlho(btnInd, 'individual');
            }

            modal.classList.remove('hidden');
            lucide.createIcons();
        }

        async function buscarDadosLinkProdOlhoModal() {
            const url = document.getElementById('modalProdOlhoLink')?.value?.trim();
            if (!url) return seivaNotificar('Cole um link válido antes de buscar.', 'aviso');

            const btn = document.getElementById('btnBuscarLinkProdOlho');
            const textoOriginal = btn ? btn.innerHTML : 'Buscar';
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = `<i data-lucide="loader-2" class="size-3.5 animate-spin"></i><span>...</span>`;
                lucide.createIcons();
            }

            try {
                const res = await fetch('/api/metas/consultar-link', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ url })
                });

                if (res.ok) {
                    const data = await res.json();
                    if (data.titulo) document.getElementById('modalProdOlhoNome').value = data.titulo;
                    if (data.preco) {
                        const valFmt = typeof data.preco === 'number' 
                            ? data.preco.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
                            : data.preco;
                        document.getElementById('modalProdOlhoPreco').value = valFmt;
                    }
                    if (data.loja) document.getElementById('modalProdOlhoLoja').value = data.loja;
                    if (data.imagem) {
                        document.getElementById('modalProdOlhoFotoUrl').value = data.imagem;
                        const prev = document.getElementById('modalProdOlhoPreviewFoto');
                        const img = document.getElementById('modalProdOlhoImg');
                        const tit = document.getElementById('modalProdOlhoImgTit');
                        if (img) img.src = data.imagem;
                        if (tit) tit.innerText = data.titulo || 'Produto';
                        if (prev) prev.classList.remove('hidden');
                    }
                    seivaNotificar(`Dados carregados da ${data.loja || 'loja'}!`, 'sucesso', 'Radar de Produtos');
                } else {
                    seivaNotificar('Link não identificado. Você pode preencher os campos manualmente.', 'aviso');
                }
            } catch(e) {
                seivaNotificar('Erro de conexão ao consultar link.', 'erro');
            } finally {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = textoOriginal;
                    lucide.createIcons();
                }
            }
        }

        async function executarSalvarProdutoOlhoModal(event) {
            event.preventDefault();
            const nome = document.getElementById('modalProdOlhoNome')?.value?.trim();
            const precoRaw = document.getElementById('modalProdOlhoPreco')?.value?.replace(/\./g, '')?.replace(',', '.');
            const preco = parseFloat(precoRaw) || 0;
            const loja = document.getElementById('modalProdOlhoLoja')?.value?.trim();
            const link = document.getElementById('modalProdOlhoLink')?.value?.trim();
            const imagem = document.getElementById('modalProdOlhoFotoUrl')?.value?.trim();
            const tipo = document.getElementById('modalProdOlhoTipo')?.value || 'individual';

            if (!nome || preco <= 0) {
                return seivaNotificar('Informe o nome e um preço válido para o produto.', 'aviso');
            }

            try {
                const res = await fetch('/api/caixa-preta/produtos-watchlist', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({ nome, preco, loja, link, imagem, tipo })
                });

                const data = await res.json();
                if (res.ok) {
                    const destinoMsg = tipo === 'lar' ? 'para nossa casa' : 'para você';
                    seivaNotificar(`"${nome}" colocado na mira ${destinoMsg}!`, 'sucesso', 'Radar de Desejos');
                    fecharModalId('modalAdicionarProdutoOlho');
                    carregarMetasDados();
                    carregarCaixaPretaDados();
                } else {
                    seivaNotificar(data.error || 'Erro ao salvar produto.', 'erro');
                }
            } catch(e) {
                seivaNotificar('Erro ao salvar produto monitorado.', 'erro');
            }
        }

        function abrirGuardarNaMeta(id, titulo, atual, alvo, tipo) {
            // Reutilizar o modal de guardar meta existente
            const modal = document.getElementById('modalGuardarMeta');
            if (!modal) { seivaNotificar('Modal indisponível.', 'aviso'); return; }

            // Preencher dados do modal
            const tituloEl = document.getElementById('guardarMetaTitulo');
            if (tituloEl) tituloEl.innerText = titulo;
            const tipoEl = document.getElementById('guardarMetaTipo');
            if (tipoEl) tipoEl.innerText = tipo === 'lar' ? 'Meta do Lar' : 'Meta pessoal';

            // Progresso
            const pct = alvo > 0 ? Math.round((atual / alvo) * 100) : 0;
            const progAtualEl = document.getElementById('guardarMetaProgAtual');
            if (progAtualEl) progAtualEl.innerText = `${BRL(atual)} de ${BRL(alvo)}`;

            // Guardar referência da meta atual
            const idInput = document.getElementById('guardarMetaIdInput');
            if (idInput) idInput.value = id;

            modal.classList.remove('hidden');
            lucide.createIcons();
        }

        async function depositarMeta(id) {
            const v = await seivaPrompt({
                titulo: 'Guardar dinheiro na meta',
                mensagem: 'Informe o valor que deseja depositar nesta meta:',
                placeholder: '0,00',
                label: 'Valor do depósito (R$)',
                confirmText: 'Depositar'
            });
            if (!v) return;
            const valorNum = parseFloat(String(v).replace(/\./g, '').replace(',', '.')) || 0;
            if (valorNum <= 0) return seivaNotificar('Digite um valor válido.', 'aviso');

            try {
                await fetch(`/api/metas/${id}/contribuir`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({ valor: valorNum })
                });
                seivaNotificar(`R$ ${valorNum.toFixed(2)} depositado com sucesso!`, 'sucesso', 'Meta');
                carregarMetasDados();
                carregarDashboardDados();
            } catch(e) {
                seivaNotificar('Erro ao realizar depósito na meta.', 'erro');
            }
        }

        async function adicionarMetaPrompt() {
            abrirModalCriarMeta();
        }

        // ==========================================
        // RECEBIMENTOS — Relatórios por Período
        // ==========================================
        // RELATÓRIOS E RECEBIMENTOS (NAVEGAÇÃO MENSAL E HISTÓRICO)
        // ==========================================
        let recebMesAtivo = new Date().toISOString().slice(0,7);
        let cacheRecebMesAnterior = null;
        let cacheRecebMesProximo = null;

        function navegarRecebMes(direcao) {
            if (direcao === 'anterior' && cacheRecebMesAnterior) {
                carregarRecebimentosDados(cacheRecebMesAnterior);
            } else if (direcao === 'proximo' && cacheRecebMesProximo) {
                carregarRecebimentosDados(cacheRecebMesProximo);
            }
        }

        async function carregarRecebimentosDados(mes) {
            if (mes) recebMesAtivo = mes;
            try {
                const res = await fetch(`/api/recebimentos?mes=${recebMesAtivo}`);
                if (!res.ok) return;
                const d = await res.json();

                cacheRecebMesAnterior = d.mes_anterior;
                cacheRecebMesProximo = d.proximo_mes;

                // Atualizar label em destaque do mês ativo
                const lblAtivo = document.getElementById('recebMesAtivoLabel');
                if (lblAtivo) {
                    lblAtivo.innerText = d.mes_label || d.mes;
                }

                // Cards de resumo
                const eEl  = document.getElementById('recebCardReceitas');
                const sEl  = document.getElementById('recebCardDespesas');
                const soEl = document.getElementById('recebCardSobra');
                if (eEl)  eEl.innerText  = BRL(d.total_entradas || 0);
                if (sEl)  sEl.innerText  = BRL(d.total_saidas   || 0);
                if (soEl) {
                    soEl.innerText = BRL(Math.abs(d.sobra || 0));
                    soEl.className = `text-sm font-extrabold block ${(d.sobra || 0) >= 0 ? 'text-emerald-600' : 'text-rose-500'}`;
                }

                // Receitas vs Despesas labels e barras
                const rdR = document.getElementById('recebRDReceitas');
                const rdD = document.getElementById('recebRDDespesas');
                if (rdR) rdR.innerText = BRL(d.total_entradas || 0);
                if (rdD) rdD.innerText = BRL(d.total_saidas   || 0);

                const max = Math.max(d.total_entradas || 0, d.total_saidas || 0, 1);
                const barraR = document.getElementById('recebGraficoReceitas');
                const barraD = document.getElementById('recebGraficoDespesas');
                if (barraR) barraR.style.width = Math.round(((d.total_entradas||0)/max)*100)+'%';
                if (barraD) barraD.style.width = Math.round(((d.total_saidas  ||0)/max)*100)+'%';

                // Taxa de economia
                const taxaEl = document.getElementById('recebTaxaEconomia');
                if (taxaEl) taxaEl.innerText = `${d.taxa_economia || 0}%`;

                // Label de período
                const rdLabel = document.getElementById('recebRDPeriodoLabel');
                if (rdLabel) {
                    rdLabel.innerText = d.mes_label || (new Date(d.mes + '-01')).toLocaleDateString('pt-BR', {month:'long', year:'numeric'});
                }

                // Gráfico de evolução
                _renderizarGraficoEvolucao(d.historico || []);

                // Lista de entradas
                const entCont = document.getElementById('recebListaEntradas');
                if (entCont) {
                    if (!d.entradas?.length) {
                        entCont.innerHTML = `<div class="py-8 text-center">
                            <i data-lucide="trending-up" class="size-8 text-muted-foreground/30 mx-auto mb-2"></i>
                            <p class="text-xs text-muted-foreground">Nenhuma entrada registrada.</p>
                            <button onclick="abrirModalRegistrarRecebimento()" class="text-xs text-primary font-semibold hover:underline mt-1">+ Registrar agora</button>
                        </div>`;
                    } else {
                        entCont.innerHTML = d.entradas.map(e => `
                            <div class="flex items-center gap-3 py-3.5 border-b border-border/60 last:border-0">
                                <span class="size-9 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 flex items-center justify-center shrink-0"><i data-lucide="${e.icone || 'trending-up'}" class="size-4"></i></span>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-bold text-foreground truncate">${e.titulo}</p>
                                    <span class="text-[11px] text-muted-foreground">${e.subtitulo || ''}</span>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    <span class="text-sm font-extrabold text-emerald-600">+${BRL(e.valor)}</span>
                                    ${e.id_transacao ? `
                                    <div class="flex items-center gap-1">
                                        <button type="button" onclick="abrirModalEditarTransacao(${JSON.stringify(e).replace(/"/g, '&quot;')})" 
                                                class="size-7 rounded-lg border border-border bg-card hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition shadow-2xs" title="Editar recebimento">
                                            <i data-lucide="edit-3" class="size-3"></i>
                                        </button>
                                        <button type="button" onclick="excluirTransacaoDireto(${e.id_transacao}, '${(e.titulo||'').replace(/'/g, "\\'")}')" 
                                                class="size-7 rounded-lg border border-rose-300 dark:border-rose-900 bg-rose-50/40 dark:bg-rose-950/20 hover:bg-rose-100 text-rose-600 flex items-center justify-center transition shadow-2xs" title="Excluir recebimento">
                                            <i data-lucide="trash-2" class="size-3"></i>
                                        </button>
                                    </div>
                                    ` : ''}
                                </div>
                            </div>
                        `).join('');
                    }
                }

                // Total de entradas
                const totalEl = document.getElementById('recebTotalEntradas');
                if (totalEl) totalEl.innerText = BRL(d.total_entradas || 0);

                // Gastos por categoria
                const catCont = document.getElementById('recebCategoriasLista');
                if (catCont) {
                    if (!d.gastos_por_categoria?.length) {
                        catCont.innerHTML = '<p class="text-xs text-muted-foreground py-6 text-center">Nenhuma despesa neste período.</p>';
                    } else {
                        const cores = ['#1a4731','#15803d','#16a34a','#ca8a04','#ea580c','#86efac','#bbf7d0'];
                        catCont.innerHTML = d.gastos_por_categoria.map((cat, i) => `
                            <div class="space-y-1.5">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-semibold text-foreground">${cat.nome}</span>
                                    <span class="text-muted-foreground font-medium">${cat.percentual}% · ${BRL(cat.valor)}</span>
                                </div>
                                <div class="h-2 w-full rounded-full bg-muted overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-700" style="width:${cat.percentual}%;background:${cores[i%cores.length]}"></div>
                                </div>
                            </div>
                        `).join('');
                    }
                }

                // Chips de meses
                const chipsCont = document.getElementById('recebMesesChips');
                if (chipsCont && d.meses_disponiveis) {
                    chipsCont.innerHTML = d.meses_disponiveis.map(m => `
                        <button onclick="carregarRecebimentosDados('${m.valor}')"
                                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full border text-xs font-semibold transition ${m.ativo ? 'bg-primary text-primary-foreground border-primary shadow-soft' : 'border-border bg-card text-muted-foreground hover:text-foreground'}">
                            ${m.ativo ? '<svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>' : ''}
                            ${m.label}
                        </button>
                    `).join('');
                }

                lucide.createIcons();
            } catch(e) { console.error('Erro recebimentos:', e); }
        }

        function _renderizarGraficoEvolucao(historico) {
            const cont = document.getElementById('recebGraficoEvolucao');
            if (!cont || !historico.length) return;

            const maxVal = Math.max(...historico.map(h => Math.max(h.entradas, h.saidas)), 1);
            const pct    = (v) => Math.max(8, Math.round((v / maxVal) * 100));

            cont.innerHTML = historico.map((h, i) => `
                <div class="flex-1 flex flex-col items-center gap-1 ${i < historico.length - 1 ? 'opacity-60' : ''}">
                    <div class="w-full flex items-end gap-1 justify-center" style="height:80px">
                        <div class="w-5 bg-emerald-600 rounded-t-md transition-all" style="height:${pct(h.entradas)}%"></div>
                        <div class="w-5 bg-rose-500 rounded-t-md transition-all"   style="height:${pct(h.saidas)}%"></div>
                    </div>
                    <span class="text-[10px] text-muted-foreground ${i === historico.length - 1 ? 'font-semibold' : ''}">${h.mes}</span>
                </div>
            `).join('');
        }

        function filtrarRecebPeriodo(periodo) {
            document.querySelectorAll('.receb-periodo-btn').forEach(btn => {
                if (btn.dataset.recebPeriodo === periodo) {
                    btn.className = 'receb-periodo-btn flex-1 py-2.5 px-3 rounded-xl text-xs font-semibold transition-all bg-primary text-primary-foreground shadow-soft';
                } else {
                    btn.className = 'receb-periodo-btn flex-1 py-2.5 px-3 rounded-xl text-xs font-semibold transition-all text-muted-foreground hover:text-foreground';
                }
            });
            // Para simplificação: sempre carrega o mês ativo
            carregarRecebimentosDados();
        }

        // --- COBRADOR DIPLOMATA ---
        // ==========================================
        // COBRADOR DIPLOMATA – Renderização completa (RF005 — Victor Hugo)
        // ==========================================
        async function carregarCobradorDados() {
            try {
                const res = await fetch('/api/cobrancas');
                if (!res.ok) return;
                const data = await res.json();

                // Hero stats
                const stats = data.stats || {};
                const setEl = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val; };
                setEl('cobradorStatReceber', BRL(stats.total_a_receber || 0));
                setEl('cobradorStatNotificadas', stats.notificadas ?? 0);
                setEl('cobradorStatAgendadas', stats.agendadas ?? 0);

                const parceiroNome = data.parceiro_nome || 'Parceiro';

                // Configurações salvas (canal e antecedência)
                if (data.configuracoes) {
                    const dias = data.configuracoes.dias_antecedencia || 2;
                    const canal = data.configuracoes.canal || 'push';
                    const btnDias = document.querySelector(`[data-antecedencia="${dias}"]`);
                    if (btnDias) selecionarAntecedencia(btnDias, dias);
                    const btnCanal = document.querySelector(`[data-canal="${canal}"]`);
                    if (btnCanal) selecionarCanalCobrador(btnCanal, canal);
                }

                const lista = document.getElementById('cobradorListaNotificacoes');
                if (lista) {
                    if (!data.is_casal) {
                        lista.innerHTML = `
                        <div class="p-8 text-center bg-card rounded-3xl border border-border space-y-2">
                            <div class="size-12 rounded-2xl bg-emerald-100 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 flex items-center justify-center mx-auto">
                                <i data-lucide="shield-check" class="size-6"></i>
                            </div>
                            <h4 class="text-sm font-black text-foreground">Conta Individual / Solteiro</h4>
                            <p class="text-xs text-muted-foreground max-w-sm mx-auto">
                                O Cobrador Diplomata é voltado para casais que compartilham custos do lar. Como seu perfil é individual, você não possui pendências compartilhadas.
                            </p>
                        </div>`;
                        lucide.createIcons();
                        return;
                    }

                    const notificacoes = data.notificacoes || [];
                    if (!notificacoes.length) {
                        lista.innerHTML = '<p class="text-xs text-muted-foreground py-6 text-center">Nenhuma pendência compartilhada no momento.</p>';
                        lucide.createIcons();
                        return;
                    }

                    const statusCfg = {
                        pendente:   { label: 'Pendente',   cls: 'bg-rose-700 text-white font-black shadow-2xs' },
                        enviada:    { label: 'Enviada',    cls: 'bg-blue-700 text-white font-black shadow-2xs' },
                        agendada:   { label: 'Agendada',   cls: 'bg-slate-700 text-white font-black shadow-2xs' },
                        confirmada: { label: 'Recebida',   cls: 'bg-emerald-800 text-white font-black shadow-2xs' },
                        recebida:   { label: 'Recebida',   cls: 'bg-emerald-800 text-white font-black shadow-2xs' },
                    };
                    lista.innerHTML = notificacoes.map(n => {
                        const cfg = statusCfg[n.status] || statusCfg.agendada;
                        const nomeDest = n.parceiro_nome || parceiroNome;
                        return `
                        <div class="p-4 rounded-3xl border border-border bg-card shadow-card space-y-3">
                            <div class="flex items-start justify-between gap-2">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-black text-foreground leading-tight">${n.titulo}</p>
                                    <p class="text-[11px] text-muted-foreground mt-0.5">Vencimento: ${n.vencimento}</p>
                                </div>
                                <div class="flex flex-col items-end gap-1.5 shrink-0">
                                    <span class="text-sm font-black text-foreground">${BRL(n.valor)}</span>
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] ${cfg.cls}">${cfg.label}</span>
                                </div>
                            </div>
                            ${n.mensagem_diplomatica ? `<div class="flex items-start gap-2.5 px-3.5 py-2.5 rounded-2xl bg-muted/90 border border-border text-xs font-semibold text-foreground"><i data-lucide="message-circle" class="size-4 shrink-0 mt-0.5 text-emerald-700"></i><span class="text-foreground leading-relaxed">${n.mensagem_diplomatica}</span></div>` : ''}
                            
                            ${['confirmada', 'recebida'].includes(n.status) ? `
                            <div class="flex items-center gap-2.5 p-3 rounded-2xl bg-emerald-800 text-white text-xs font-extrabold shadow-xs">
                                <i data-lucide="check-circle-2" class="size-4 shrink-0 text-emerald-200"></i>
                                <span class="text-white font-extrabold text-xs">Recebimento confirmado e liquidado no Lar</span>
                            </div>` : `
                            <div class="flex gap-2">
                                <button onclick="notificarParceiroCobrador('${n.titulo.replace(/'/g, "\\'")}', ${n.valor})" class="flex-1 py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white text-xs font-bold flex items-center justify-center gap-1.5 cursor-pointer shadow-xs transition">
                                    <i data-lucide="send" class="size-3.5"></i> ${n.status === 'enviada' ? 'Reenviar Lembrete' : n.status === 'agendada' ? 'Antecipar Lembrete' : `Notificar ${nomeDest}`}
                                </button>
                                <button onclick="confirmarRecebimentoCobrador(${n.id})" class="flex-1 py-2.5 rounded-xl border border-border text-xs font-bold text-foreground flex items-center justify-center gap-1.5 cursor-pointer hover:bg-muted transition">
                                    <i data-lucide="check-circle" class="size-3.5"></i> Confirmar recebimento
                                </button>
                            </div>`}
                        </div>`;
                    }).join('');
                    lucide.createIcons();
                }
            } catch (e) { console.error('Erro ao carregar cobrador:', e); }
        }

        async function notificarParceiroCobrador(titulo, valor) {
            const mensagem = `Oi! Passando só pra lembrar com carinho sobre "${titulo}" (${BRL(valor)}). Abraços!`;
            try {
                const res = await fetch('/api/cobrancas/lembrete', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({ titulo, valor, mensagem })
                });
                const data = await res.json();
                seivaNotificar(data.mensagem || 'Lembrete diplomático enviado com sucesso!', 'sucesso', 'Lembrete Enviado');
                carregarCobradorDados();
            } catch (e) { seivaNotificar('Erro ao enviar lembrete.', 'erro', 'Erro'); }
        }

        async function confirmarRecebimentoCobrador(id) {
            try {
                const res = await fetch(`/api/cobrancas/${id}/confirmar`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                });
                const data = await res.json();
                seivaNotificar(data.mensagem || 'Recebimento confirmado com sucesso!', 'sucesso', 'Confirmado');
                carregarCobradorDados();
                if (typeof carregarExtratoDados === 'function') carregarExtratoDados();
                if (typeof carregarDashboardDados === 'function') carregarDashboardDados();
            } catch (e) {
                seivaNotificar('Erro ao confirmar recebimento.', 'erro', 'Erro');
            }
        }

        async function salvarConfiguracaoCobrador() {
            const canal = document.querySelector('[data-canal].ring-2')?.dataset?.canal || 'push';
            const antecedencia = document.querySelector('[data-antecedencia].ring-2')?.dataset?.antecedencia || '2';
            try {
                await fetch('/api/cobrancas/configurar', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({ canal, dias_antecedencia: parseInt(antecedencia) })
                });
                seivaNotificar('Configurações do Cobrador salvas com sucesso!', 'sucesso', 'Salvo');
            } catch (e) { seivaNotificar('Erro ao salvar configurações.', 'erro', 'Erro'); }
        }

        function selecionarAntecedencia(btn, dias) {
            btn.closest('.flex')?.querySelectorAll('[data-antecedencia]').forEach(b => {
                b.classList.remove('ring-2', 'ring-primary', 'bg-primary/10', 'text-primary', 'font-black');
                b.classList.add('text-muted-foreground', 'font-semibold');
            });
            btn.classList.add('ring-2', 'ring-primary', 'bg-primary/10', 'text-primary', 'font-black');
            btn.classList.remove('text-muted-foreground', 'font-semibold');
        }

        function selecionarCanalCobrador(btn, canal) {
            btn.closest('.flex')?.querySelectorAll('[data-canal]').forEach(b => {
                b.classList.remove('ring-2', 'ring-primary', 'bg-primary/10', 'text-primary', 'font-black');
                b.classList.add('text-muted-foreground', 'font-semibold');
            });
            btn.classList.add('ring-2', 'ring-primary', 'bg-primary/10', 'text-primary', 'font-black');
            btn.classList.remove('text-muted-foreground', 'font-semibold');
        }

        // Alias de compatibilidade retroativa
        async function dispararLembreteDiplomata(destId, titulo, valor) { return notificarParceiroCobrador(titulo, valor); }

        // ==========================================
        // PERFIL – Carregamento e Gerenciamento de Dados (RF011 — Maria Eduarda)
        // ==========================================
        let perfilDadosCache = null;

        async function carregarPerfilDados() {
            try {
                const res = await fetch('/api/perfil');
                if (!res.ok) return;
                const data = await res.json();
                perfilDadosCache = data;

                const user = data.usuario || {};
                const nomeCompleto = user.nome || 'Usuário';
                const partes = nomeCompleto.trim().split(' ').filter(Boolean);
                let iniciais = '--';
                if (partes.length >= 2) {
                    iniciais = (partes[0][0] + partes[partes.length - 1][0]).toUpperCase();
                } else if (partes.length === 1) {
                    iniciais = partes[0].slice(0, 2).toUpperCase();
                }

                const set = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val; };

                // Avatar do usuário (Foto ou Iniciais)
                aplicarAvatarGlobal(user.avatar, iniciais);

                set('perfilNomeTxt', nomeCompleto);
                set('perfilEmailTxt', user.email || '');
                if (user.apelido || partes[0]) {
                    const elApelido = document.getElementById('perfilApelido');
                    if (elApelido) {
                        elApelido.textContent = `Apelido: ${user.apelido || partes[0]}`;
                        elApelido.classList.remove('hidden');
                    }
                }
                set('perfilChavePix', user.chave_pix || user.email || '');
                if (user.created_at) {
                    const dt = new Date(user.created_at);
                    set('perfilMembroDesde', `Membro desde ${dt.toLocaleDateString('pt-BR', { month: 'long', year: 'numeric' })}`);
                }

                // Divergência Casal vs. Individual
                const cardLar = document.getElementById('perfilCardNossoCantinho');
                const cardSolo = document.getElementById('perfilCardIndividualSolo');
                const linhaParceiro = document.getElementById('perfilLinhaParceiro');
                const badgeCobrador = document.getElementById('badgeSoloCobrador');
                const badgeLar = document.getElementById('badgeSoloLar');

                if (data.is_casal && data.lar) {
                    if (cardLar) cardLar.classList.remove('hidden');
                    if (cardSolo) cardSolo.classList.add('hidden');
                    if (linhaParceiro) linhaParceiro.classList.remove('hidden');
                    if (badgeCobrador) badgeCobrador.classList.add('hidden');
                    if (badgeLar) badgeLar.classList.add('hidden');

                    const lar = data.lar;
                    set('perfilLarNome', lar.nome || 'Lar Compartilhado');
                    set('perfilLarDesde', `Desde ${lar.criado_em || 'recente'}`);
                    set('perfilLarMeuNome', nomeCompleto);
                    set('perfilLarMeuEmail', user.email || '');
                    set('perfilLarMeuIniciaisCircle', iniciais);

                    if (lar.parceiro) {
                        set('perfilLarParceiroNome', lar.parceiro.nome);
                        set('perfilLarParceiroEmail', lar.parceiro.email);
                        const elCircle = document.getElementById('perfilLarParceiroIniciaisCircle');
                        if (elCircle) {
                            if (lar.parceiro.avatar && lar.parceiro.avatar.length > 5) {
                                elCircle.innerHTML = `<img src="${lar.parceiro.avatar}" alt="${lar.parceiro.nome}" class="size-full rounded-full object-cover">`;
                            } else {
                                elCircle.innerText = lar.parceiro.iniciais || 'P';
                            }
                        }
                        set('perfilParceiroInfo', `${lar.parceiro.nome} · ${lar.parceiro.email}`);
                    } else {
                        set('perfilLarParceiroNome', 'Aguardando Parceiro(a)');
                        set('perfilLarParceiroEmail', 'Convite gerado');
                        set('perfilParceiroInfo', 'Convite enviado · aguardando parceiro(a) aceitar');
                    }

                    set('perfilDivisaoValorTxt', lar.divisao_txt || '50% / 50%');
                } else {
                    // Usuário Individual / Solteiro
                    if (cardLar) cardLar.classList.add('hidden');
                    if (cardSolo) cardSolo.classList.remove('hidden');
                    if (linhaParceiro) linhaParceiro.classList.add('hidden');
                    if (badgeCobrador) badgeCobrador.classList.remove('hidden');
                    if (badgeLar) badgeLar.classList.remove('hidden');
                }

                // Atualiza estado do tema nas preferências
                atualizarBotoesTemaUI();

                lucide.createIcons();
            } catch (e) { console.error('Erro ao carregar perfil:', e); }
        }

        async function executarExportarDados() {
            try {
                seivaNotificar('Preparando exportação dos seus dados LGPD...', 'info', 'Exportando');
                const res = await fetch('/api/perfil/exportar');
                if (res.ok) {
                    const blob = await res.blob();
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url; a.download = 'meus-dados-seiva.json'; a.click();
                    window.URL.revokeObjectURL(url);
                    seivaNotificar('Dados exportados com sucesso em conformidade com o Art. 18 da LGPD!', 'sucesso', 'Exportado');
                } else {
                    seivaNotificar('Exportação concluída. Verifique seus downloads.', 'sucesso', 'LGPD');
                }
            } catch (e) { seivaNotificar('Erro ao exportar dados.', 'erro', 'Erro'); }
        }

        function abrirModalEditarPerfil() {
            const user = perfilDadosCache?.usuario || {};
            const inputNome = document.getElementById('formPerfilNome');
            const inputEmail = document.getElementById('formPerfilEmail');
            const inputTel = document.getElementById('formPerfilTelefone');
            const inputPix = document.getElementById('formPerfilChavePix');
            const selectBanco = document.getElementById('formPerfilBancoPrincipal');
            const inputAvatar = document.getElementById('formPerfilAvatar');
            const previewIniciais = document.getElementById('previewAvatarIniciais');

            if (inputNome) inputNome.value = user.nome || '';
            if (inputEmail) inputEmail.value = user.email || '';
            if (inputTel) inputTel.value = user.telefone || '';
            if (inputPix) inputPix.value = user.chave_pix || user.email || '';
            if (selectBanco && user.banco_principal) {
                const bNorm = user.banco_principal.trim().toLowerCase();
                let match = Array.from(selectBanco.options).find(opt => 
                    opt.value.trim().toLowerCase() === bNorm || 
                    opt.text.trim().toLowerCase() === bNorm ||
                    (bNorm === 'c6' && opt.value.toLowerCase().includes('c6'))
                );
                if (match) {
                    selectBanco.value = match.value;
                } else {
                    const optCustom = new Option(user.banco_principal, user.banco_principal, true, true);
                    selectBanco.add(optCustom, selectBanco.options.length - 1);
                    selectBanco.value = user.banco_principal;
                }
            }
            if (inputAvatar) inputAvatar.value = user.avatar || '';
            if (previewIniciais) previewIniciais.textContent = user.iniciais || (user.nome ? user.nome.substring(0, 2).toUpperCase() : '--');

            selecionarAvatarPerfil(user.avatar || '');

            const modal = document.getElementById('modalEditarPerfil');
            if (modal) {
                modal.classList.remove('hidden');
                lucide.createIcons();
            }
        }

        function selecionarAvatarPerfil(url) {
            const inputHidden = document.getElementById('formPerfilAvatar');
            const boxPreview = document.getElementById('previewAvatarPerfil');
            if (inputHidden) inputHidden.value = url;
            if (boxPreview) {
                if (url) {
                    boxPreview.innerHTML = `<img src="${url}" class="size-full object-cover">`;
                } else {
                    const user = perfilDadosCache?.usuario || {};
                    const ini = user.iniciais || (user.nome ? user.nome.substring(0, 2).toUpperCase() : '--');
                    boxPreview.innerHTML = `<span id="previewAvatarIniciais">${ini}</span>`;
                }
            }
        }

        function lidarArquivoFotoPerfil(input) {
            if (!input.files || !input.files[0]) return;
            const file = input.files[0];
            if (!file.type.startsWith('image/')) {
                seivaNotificar('Selecione um arquivo de imagem válido (PNG, JPG ou WEBP).', 'aviso', 'Arquivo Inválido');
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                const base64 = e.target.result;
                selecionarAvatarPerfil(base64);
                const urlInput = document.getElementById('formPerfilAvatarUrl');
                if (urlInput) urlInput.value = '';
                seivaNotificar('Foto carregada! Clique em "Salvar Alterações" para confirmar.', 'sucesso', 'Foto Selecionada');
            };
            reader.readAsDataURL(file);
        }

        function lidarDropFotoPerfil(event) {
            event.preventDefault();
            const dropzone = document.getElementById('dropzoneFotoPerfil');
            if (dropzone) dropzone.classList.remove('border-emerald-600', 'bg-emerald-50/20');
            if (event.dataTransfer && event.dataTransfer.files && event.dataTransfer.files[0]) {
                const file = event.dataTransfer.files[0];
                if (!file.type.startsWith('image/')) {
                    seivaNotificar('Arraste apenas arquivos de imagem (PNG ou JPG).', 'aviso', 'Arquivo Inválido');
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    const base64 = e.target.result;
                    selecionarAvatarPerfil(base64);
                    const urlInput = document.getElementById('formPerfilAvatarUrl');
                    if (urlInput) urlInput.value = '';
                    seivaNotificar('Foto recebida via arrastar e soltar!', 'sucesso', 'Foto Selecionada');
                };
                reader.readAsDataURL(file);
            }
        }

        function removerFotoPerfil() {
            selecionarAvatarPerfil('');
            const fileInput = document.getElementById('inputFotoPerfilUpload');
            if (fileInput) fileInput.value = '';
            const urlInput = document.getElementById('formPerfilAvatarUrl');
            if (urlInput) urlInput.value = '';
            seivaNotificar('Foto removida. O perfil exibirá suas iniciais.', 'info', 'Avatar Padrão');
        }

        function alternarBloqueioCaixaPreta(checkbox) {
            if (checkbox.checked) {
                seivaNotificar('Bloqueio da Caixa Preta com PIN numérico está ativo.', 'sucesso', 'Segurança');
            } else {
                seivaNotificar('Atenção: Mantenha o PIN ativado para preservar a privacidade individual dos seus gastos.', 'aviso', 'Caixa Preta');
            }
        }

        function alternarBiometriaPerfil(checkbox) {
            checkbox.checked = false;
            seivaNotificar('O desbloqueio biométrico (Face ID / Touch ID) está planejado para o aplicativo mobile nativo na versão v2.0. Na versão web, sua Caixa Preta é protegida com segurança total pelo seu PIN numérico.', 'info', 'Em Desenvolvimento Mobile');
        }

        function alternarNotificacaoPerfil(tipo, ativado) {
            seivaNotificar(`Preferência de notificação "${tipo}" ${ativado ? 'ativada' : 'desativada'} com sucesso!`, 'sucesso', 'Preferência Salva');
        }

        function abrirModalCentralAjuda() {
            const modal = document.getElementById('modalCentralAjuda');
            if (modal) {
                modal.classList.remove('hidden');
                lucide.createIcons();
            }
        }

        function abrirModalTermosUso() {
            const modal = document.getElementById('modalTermosUso');
            if (modal) {
                modal.classList.remove('hidden');
                lucide.createIcons();
            }
        }

        async function executarSalvarPerfil(event) {
            event.preventDefault();
            const nome = document.getElementById('formPerfilNome')?.value.trim();
            const email = document.getElementById('formPerfilEmail')?.value.trim();
            const telefone = document.getElementById('formPerfilTelefone')?.value.trim();
            const chave_pix = document.getElementById('formPerfilChavePix')?.value.trim();
            const banco_principal = document.getElementById('formPerfilBancoPrincipal')?.value;
            const avatar = document.getElementById('formPerfilAvatar')?.value.trim();

            if (!nome) { seivaNotificar('O nome é obrigatório.', 'aviso', 'Validação'); return; }

            try {
                const res = await fetch('/api/perfil/atualizar', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({ nome, email, telefone, chave_pix, banco_principal, avatar })
                });
                const data = await res.json();
                if (res.ok) {
                    fecharModalId('modalEditarPerfil');
                    seivaNotificar(data.message || 'Perfil atualizado com sucesso!', 'sucesso', 'Perfil Atualizado');
                    if (data.usuario) {
                        usuarioSessao = data.usuario;
                        const partes = (data.usuario.nome || nome).split(' ');
                        const inc = partes.length >= 2 ? (partes[0][0] + partes[partes.length - 1][0]).toUpperCase() : (partes[0].slice(0, 2)).toUpperCase();
                        aplicarAvatarGlobal(data.usuario.avatar || avatar, inc);
                    }
                    carregarPerfilDados();
                    carregarDashboardDados();
                    // Atualiza nome na barra de navegação se existir
                    const navNome = document.getElementById('navUserNome');
                    if (navNome) navNome.textContent = nome;
                } else {
                    seivaNotificar(data.message || 'Erro ao atualizar perfil.', 'erro', 'Erro');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão ao salvar perfil.', 'erro', 'Erro');
            }
        }

        // ==========================================
        // SISTEMA DE CONVITES PARA O LAR (RF004, RF010)
        // ==========================================
        function abrirModalConvidarParceiro() {
            const inputNome = document.getElementById('conviteNomeParceiro');
            const inputEmail = document.getElementById('conviteEmailParceiro');
            const inputLar = document.getElementById('conviteNomeLar');
            const linkArea = document.getElementById('conviteLinkArea');
            if (inputNome) inputNome.value = '';
            if (inputEmail) inputEmail.value = '';
            if (inputLar) inputLar.value = '';
            if (linkArea) linkArea.classList.add('hidden');

            abrirModalId('modalConvidarParceiro');
        }

        async function executarEnviarConviteLar(event) {
            event.preventDefault();
            const email = document.getElementById('conviteEmailParceiro')?.value.trim();
            const nome = document.getElementById('conviteNomeParceiro')?.value.trim();
            const nomeLar = document.getElementById('conviteNomeLar')?.value.trim();

            if (!email) {
                return seivaNotificar('Informe o e-mail do parceiro(a).', 'aviso', 'Campo Obrigatório');
            }

            const btn = document.getElementById('btnEnviarConviteLar');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<i data-lucide="loader-2" class="size-3.5 animate-spin"></i><span>Gerando convite...</span>';
                lucide.createIcons();
            }

            try {
                const res = await fetch('/api/lar/convidar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({ email_convidado: email, nome_lar: nomeLar, nome_parceiro: nome })
                });

                const data = await res.json();
                if (res.ok) {
                    seivaNotificar(data.mensagem || 'Convite gerado com sucesso!', 'sucesso', 'Convite Enviado');
                    const linkInput = document.getElementById('conviteLinkGerado');
                    const linkArea = document.getElementById('conviteLinkArea');
                    if (linkInput) linkInput.value = data.link_convite || `${window.location.origin}/convite/${data.token}`;
                    if (linkArea) linkArea.classList.remove('hidden');
                    carregarDashboardDados();
                    if (typeof carregarPerfilDados === 'function') carregarPerfilDados();
                } else {
                    seivaNotificar(data.error || 'Não foi possível gerar o convite.', 'erro', 'Erro');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão ao convidar parceiro.', 'erro');
            } finally {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = '<i data-lucide="send" class="size-3.5"></i><span>Gerar Convite</span>';
                    lucide.createIcons();
                }
            }
        }

        function copiarLinkConviteLar() {
            const input = document.getElementById('conviteLinkGerado');
            if (!input || !input.value) return;

            navigator.clipboard.writeText(input.value).then(() => {
                const txt = document.getElementById('txtBtnCopiarLink');
                if (txt) txt.innerText = 'Copiado!';
                seivaNotificar('Link copiado para a área de transferência! Envie para sua parceira pelo WhatsApp.', 'sucesso', 'Link Copiado');
                setTimeout(() => { if (txt) txt.innerText = 'Copiar'; }, 3000);
            }).catch(() => {
                input.select();
                document.execCommand('copy');
                seivaNotificar('Link copiado!', 'sucesso');
            });
        }

        async function verificarConvitesPendentes() {
            try {
                const res = await fetch('/api/lar/convites');
                if (!res.ok) return;
                const data = await res.json();
                if (data.recebidos && data.recebidos.length > 0) {
                    const convite = data.recebidos[0];
                    abrirModalAceitarConvite(convite);
                }
            } catch (e) {}
        }

        let conviteAtualAceite = null;

        function abrirModalAceitarConvite(convite) {
            conviteAtualAceite = convite;
            const nomeRemetente = convite.remetente ? convite.remetente.nome : 'Seu parceiro(a)';
            const nomeLar = convite.lar ? convite.lar.nome : 'Nosso Cantinho';

            const elTitulo = document.getElementById('aceitarConviteTitulo');
            const elDesc = document.getElementById('aceitarConviteDesc');
            const elRem = document.getElementById('aceitarConviteRemetenteNome');
            const elLar = document.getElementById('aceitarConviteNomeLar');
            const elTok = document.getElementById('aceitarConviteToken');

            if (elTitulo) elTitulo.innerText = `Convite de ${nomeRemetente}`;
            if (elDesc) elDesc.innerHTML = `${nomeRemetente} convidou você para formar o Lar <strong>${nomeLar}</strong> no SEIVA!`;
            if (elRem) elRem.innerText = nomeRemetente;
            if (elLar) elLar.innerText = nomeLar;
            if (elTok) elTok.value = convite.token_convite;

            abrirModalId('modalAceitarConviteLar');
        }

        async function confirmarAceiteConviteLar() {
            const token = document.getElementById('aceitarConviteToken')?.value || conviteAtualAceite?.token_convite;
            if (!token) return;

            const btn = document.getElementById('btnConfirmarAceiteConvite');
            if (btn) btn.disabled = true;

            try {
                const res = await fetch('/api/lar/aceitar-convite', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({ token })
                });

                const data = await res.json();
                if (res.ok) {
                    fecharModalId('modalAceitarConviteLar');
                    seivaNotificar(data.mensagem || 'Convite aceito! Bem-vindo(a) ao Lar!', 'sucesso', 'Lar Formado!');
                    window._isCasalGlobal = true;
                    await carregarDashboardDados();
                    if (typeof carregarLarDados === 'function') carregarLarDados();
                    if (typeof carregarPerfilDados === 'function') carregarPerfilDados();
                    trocarAbaApp('lar');
                } else {
                    seivaNotificar(data.error || 'Erro ao aceitar convite.', 'erro');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão ao aceitar convite.', 'erro');
            } finally {
                if (btn) btn.disabled = false;
            }
        }

        async function recusarConviteLarAtual() {
            const token = document.getElementById('aceitarConviteToken')?.value || conviteAtualAceite?.token_convite;
            if (token) {
                try {
                    await fetch('/api/lar/recusar-convite', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        body: JSON.stringify({ token })
                    });
                } catch (e) {}
            }
            fecharModalId('modalAceitarConviteLar');
        }

        function abrirModalDivisaoPersonalizada() {
            const lar = perfilDadosCache?.lar;
            if (!lar) {
                seivaNotificar('Divisão do lar disponível apenas para casais.', 'info', 'Conta Solo');
                return;
            }

            const parceiro = lar.parceiro;
            const nomeParc = parceiro ? parceiro.nome.split(' ')[0] : 'Parceiro';
            const labelParc = document.getElementById('labelNomeParceiroPct');
            if (labelParc) labelParc.textContent = `${nomeParc}: ${lar.pct_parceiro || 50}%`;

            const slider = document.getElementById('sliderDivisaoPct');
            if (slider && lar.pct_usuario) {
                slider.value = lar.pct_usuario;
                atualizarSliderDivisao(lar.pct_usuario);
            }

            const tipoRegra = lar.divisao_txt?.toLowerCase().includes('proporcional') ? 'proporcional' :
                             (lar.divisao_txt?.toLowerCase().includes('personalizada') ? 'customizada' : 'igualitaria');
            selecionarTipoDivisaoLar(tipoRegra);

            const modal = document.getElementById('modalDivisaoPersonalizada');
            if (modal) {
                modal.classList.remove('hidden');
                lucide.createIcons();
            }
        }

        function selecionarTipoDivisaoLar(tipo) {
            const inputTipo = document.getElementById('formDivisaoTipo');
            if (inputTipo) inputTipo.value = tipo;

            const boxCustom = document.getElementById('boxDivisaoCustomizada');
            if (boxCustom) {
                boxCustom.classList.toggle('hidden', tipo !== 'customizada');
            }

            const b5050 = document.getElementById('btnDivisao5050');
            const bProp = document.getElementById('btnDivisaoProporcional');
            const bCust = document.getElementById('btnDivisaoCustomizada');

            const resetBtn = (btn) => {
                if (!btn) return;
                btn.className = 'opcao-divisao p-3.5 rounded-2xl border border-border bg-card text-left transition flex items-center justify-between hover:border-emerald-500/50 cursor-pointer';
                const check = btn.querySelector('[data-lucide="check"]');
                if (check) check.classList.add('hidden');
            };

            const selectBtn = (btn) => {
                if (!btn) return;
                btn.className = 'opcao-divisao p-3.5 rounded-2xl border-2 border-emerald-600 bg-emerald-50/40 dark:bg-emerald-950/20 text-left transition flex items-center justify-between cursor-pointer';
                const check = btn.querySelector('[data-lucide="check"]');
                if (check) check.classList.remove('hidden');
            };

            resetBtn(b5050);
            resetBtn(bProp);
            resetBtn(bCust);

            if (tipo === 'igualitaria') selectBtn(b5050);
            else if (tipo === 'proporcional') selectBtn(bProp);
            else if (tipo === 'customizada') selectBtn(bCust);

            lucide.createIcons();
        }

        function atualizarSliderDivisao(val) {
            const meuPct = parseFloat(val);
            const parceiroPct = Math.round((100 - meuPct) * 10) / 10;

            const txtMeu = document.getElementById('txtMeuPctDisplay');
            const txtParc = document.getElementById('txtParceiroPctDisplay');
            const lblMeu = document.getElementById('labelNomeMeuPct');
            const lblParc = document.getElementById('labelNomeParceiroPct');
            const inMeu = document.getElementById('formDivisaoMeuPct');
            const inParc = document.getElementById('formDivisaoParceiroPct');

            if (txtMeu) txtMeu.textContent = `${meuPct}%`;
            if (txtParc) txtParc.textContent = `${parceiroPct}%`;
            if (lblMeu) lblMeu.textContent = `Você: ${meuPct}%`;
            if (lblParc) {
                const parcNome = perfilDadosCache?.lar?.parceiro?.nome?.split(' ')[0] || 'Parceiro';
                lblParc.textContent = `${parcNome}: ${parceiroPct}%`;
            }
            if (inMeu) inMeu.value = meuPct;
            if (inParc) inParc.value = parceiroPct;
        }

        async function executarSalvarDivisaoLar(event) {
            event.preventDefault();
            const tipo = document.getElementById('formDivisaoTipo')?.value || 'igualitaria';
            const pct_usuario = parseFloat(document.getElementById('formDivisaoMeuPct')?.value || 50);
            const pct_parceiro = parseFloat(document.getElementById('formDivisaoParceiroPct')?.value || 50);

            try {
                const res = await fetch('/api/perfil/divisao-lar', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({ tipo, pct_usuario, pct_parceiro })
                });
                const data = await res.json();
                if (res.ok) {
                    fecharModalId('modalDivisaoPersonalizada');
                    seivaNotificar(data.mensagem || 'Regra de divisão do lar atualizada!', 'sucesso', 'Divisão Atualizada');
                    carregarPerfilDados();
                    if (typeof carregarLarDados === 'function') carregarLarDados();
                } else {
                    seivaNotificar(data.error || 'Erro ao atualizar divisão.', 'erro', 'Erro');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão ao salvar regra de divisão.', 'erro', 'Erro');
            }
        }

        function abrirModalCentralAjuda() {
            const modal = document.getElementById('modalCentralAjuda');
            if (modal) {
                modal.classList.remove('hidden');
                lucide.createIcons();
            }
        }

        function abrirModalTermosUso() {
            const modal = document.getElementById('modalTermosUso');
            if (modal) {
                modal.classList.remove('hidden');
                lucide.createIcons();
            }
        }

        function abrirModalApagarConta() {
            const input = document.getElementById('confirmarExclusaoContaInput');
            const btn = document.getElementById('btnConfirmarExcluirConta');
            if (input) input.value = '';
            if (btn) btn.disabled = true;

            const modal = document.getElementById('modalApagarConta');
            if (modal) {
                modal.classList.remove('hidden');
                lucide.createIcons();
            }
        }

        function validarTextoExclusaoConta(val) {
            const btn = document.getElementById('btnConfirmarExcluirConta');
            if (btn) {
                btn.disabled = (val.trim().toUpperCase() !== 'EXCLUIR');
            }
        }

        async function executarExcluirContaDefinitiva() {
            const btn = document.getElementById('btnConfirmarExcluirConta');
            if (btn) { btn.disabled = true; btn.textContent = 'Excluindo...'; }

            try {
                const res = await fetch('/api/perfil/excluir', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' }
                });
                const data = await res.json();
                fecharModalId('modalApagarConta');
                seivaNotificar(data.message || 'Conta e dados definitivamente excluídos.', 'sucesso', 'Conta Encerrada');
                localStorage.clear();
                setTimeout(() => { window.location.href = '/'; }, 1500);
            } catch (e) {
                seivaNotificar('Erro ao excluir conta.', 'erro', 'Erro');
                if (btn) { btn.disabled = false; btn.innerHTML = '<i data-lucide="trash-2" class="size-4"></i><span>Excluir Definitivamente</span>'; lucide.createIcons(); }
            }
        }

        function alternarTemaSeiva(tema) {
            localStorage.setItem('seiva_theme', tema);
            if (tema === 'escuro') {
                document.documentElement.classList.add('dark');
            } else if (tema === 'claro') {
                document.documentElement.classList.remove('dark');
            } else {
                const darkSys = window.matchMedia('(prefers-color-scheme: dark)').matches;
                document.documentElement.classList.toggle('dark', darkSys);
            }
            atualizarBotoesTemaUI();
            seivaNotificar(`Tema do aplicativo ajustado para "${tema.toUpperCase()}"`, 'sucesso', 'Preferências');
        }

        function atualizarBotoesTemaUI() {
            const temaAtual = localStorage.getItem('seiva_theme') || 'sistema';
            const bClaro = document.getElementById('btnTemaClaro');
            const bEscuro = document.getElementById('btnTemaEscuro');
            const bSistema = document.getElementById('btnTemaSistema');

            const reset = (b) => {
                if (!b) return;
                b.className = 'flex-1 py-1.5 rounded-lg text-xs font-semibold text-muted-foreground text-center hover:text-foreground transition-all flex items-center justify-center gap-1 cursor-pointer';
            };
            const active = (b) => {
                if (!b) return;
                b.className = 'flex-1 py-1.5 rounded-lg bg-card text-xs font-bold text-foreground shadow-sm text-center transition-all flex items-center justify-center gap-1 cursor-pointer';
            };

            reset(bClaro);
            reset(bEscuro);
            reset(bSistema);

            if (temaAtual === 'claro') active(bClaro);
            else if (temaAtual === 'escuro') active(bEscuro);
            else active(bSistema);
        }

        function alternarBiometriaPerfil(input) {
            input.checked = false;
            seivaNotificar('O desbloqueio biométrico (Face ID / Impressão Digital) está em desenvolvimento para o app mobile na versão v2.0.', 'info', 'Em Desenvolvimento');
        }

        function alternarVisibilidadePadrao(tipo) {
            localStorage.setItem('seiva_visibilidade_padrao', tipo);
            const btnP = document.getElementById('btnVisibPessoal');
            const btnC = document.getElementById('btnVisibCompartilhado');
            if (btnP && btnC) {
                if (tipo === 'pessoal') {
                    btnP.className = 'flex-1 py-1.5 rounded-lg bg-card text-xs font-bold text-foreground shadow-sm text-center transition-all cursor-pointer';
                    btnC.className = 'flex-1 py-1.5 rounded-lg text-xs font-semibold text-muted-foreground text-center hover:text-foreground transition-all cursor-pointer';
                    seivaNotificar('Novos lançamentos serão salvos como Pessoais (Privados) por padrão.', 'sucesso', 'Visibilidade Alterada');
                } else {
                    btnC.className = 'flex-1 py-1.5 rounded-lg bg-card text-xs font-bold text-foreground shadow-sm text-center transition-all cursor-pointer';
                    btnP.className = 'flex-1 py-1.5 rounded-lg text-xs font-semibold text-muted-foreground text-center hover:text-foreground transition-all cursor-pointer';
                    seivaNotificar('Novos lançamentos serão compartilhados no Lar por padrão.', 'sucesso', 'Visibilidade Alterada');
                }
            }
        }

        function alternarNotificacaoPerfil(tipo, checked) {
            localStorage.setItem(`seiva_notif_${tipo}`, checked);
            seivaNotificar(checked ? `Notificação "${tipo}" ativada.` : `Notificação "${tipo}" silenciada.`, 'sucesso', 'Notificações');
        }

        function alternarBloqueioCaixaPreta(input) {
            seivaNotificar(input.checked ? 'Bloqueio por PIN da Caixa Preta ativado com sucesso.' : 'Bloqueio temporariamente pausado.', 'sucesso', 'Segurança');
        }

        // --- MODAIS DE LANÇAMENTO ---
        function alternarFab() {
            const dropdown = document.getElementById('fabDropdown');
            const icone = document.getElementById('iconeFab');
            if (!dropdown) return;
            const isHidden = dropdown.classList.toggle('hidden');
            if (icone) {
                if (!isHidden) {
                    icone.setAttribute('data-lucide', 'x');
                } else {
                    icone.setAttribute('data-lucide', 'plus');
                }
                lucide.createIcons();
            }
        }

        function abrirModalGasto() {
            abrirModalLancarGasto();
        }

        function abrirModalEntrada() {
            abrirModalRegistrarRecebimento();
        }

        function abrirModalDespesaLar() {
            document.getElementById('modalDespesaLar').classList.remove('hidden');
        }

        function fecharModalId(id) {
            document.getElementById(id).classList.add('hidden');
        }

        async function salvarTransacaoForm(e) {
            e.preventDefault();
            const tipo = document.getElementById('formTransTipo').value;
            const titulo = document.getElementById('formTransTitulo').value.trim();
            const valor = parseFloat(document.getElementById('formTransValor').value);
            const conta_id = document.getElementById('formTransContaId').value;
            const categoria_id = document.getElementById('formTransCategoriaId').value;

            if (!titulo) {
                const el = document.getElementById('formTransTitulo');
                el.classList.add('border-red-400', 'ring-1', 'ring-red-300');
                el.focus();
                seivaNotificar('Informe a descrição da transação.', 'aviso', 'Campo obrigatório');
                el.addEventListener('input', () => el.classList.remove('border-red-400', 'ring-1', 'ring-red-300'), { once: true });
                return;
            }
            if (!valor || valor <= 0) {
                const el = document.getElementById('formTransValor');
                el.classList.add('border-red-400', 'ring-1', 'ring-red-300');
                el.focus();
                seivaNotificar('Informe um valor válido maior que zero.', 'aviso', 'Campo obrigatório');
                el.addEventListener('input', () => el.classList.remove('border-red-400', 'ring-1', 'ring-red-300'), { once: true });
                return;
            }

            const res = await fetch('/api/transacoes', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ tipo, titulo, valor, conta_id, categoria_id })
            });

            if (res.ok) {
                fecharModalId('modalTransacao');
                carregarDashboardDados();
                carregarExtratoDados();
                seivaNotificar('Transação registrada com sucesso!', 'sucesso', 'Transação Salva');
            } else {
                seivaNotificar('Não foi possível registrar a transação. Verifique os dados.', 'erro', 'Erro ao Registrar');
            }
        }

        async function salvarDespesaLarForm(e) {
            e.preventDefault();
            const titulo = document.getElementById('formLarDespTitulo').value.trim();
            const valor_total = parseFloat(document.getElementById('formLarDespValor').value);
            const divisao = document.getElementById('formLarDespDivisao').value;
            const data_vencimento = document.getElementById('formLarDespData').value;
            const tipo = document.getElementById('formLarDespTipo')?.value || 'fixa';
            const extraordinaria = document.getElementById('formLarDespExtraordinaria')?.checked || false;

            if (!titulo) {
                const el = document.getElementById('formLarDespTitulo');
                el.classList.add('border-red-400', 'ring-1', 'ring-red-300');
                el.focus();
                seivaNotificar('Informe o nome da despesa do Lar.', 'aviso', 'Campo obrigatório');
                el.addEventListener('input', () => el.classList.remove('border-red-400', 'ring-1', 'ring-red-300'), { once: true });
                return;
            }
            if (!valor_total || valor_total <= 0) {
                const el = document.getElementById('formLarDespValor');
                el.classList.add('border-red-400', 'ring-1', 'ring-red-300');
                el.focus();
                seivaNotificar('Informe um valor válido maior que zero.', 'aviso', 'Campo obrigatório');
                el.addEventListener('input', () => el.classList.remove('border-red-400', 'ring-1', 'ring-red-300'), { once: true });
                return;
            }

            const res = await fetch('/api/lar/despesas', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ 
                    titulo, 
                    valor_total, 
                    divisao, 
                    tipo: extraordinaria ? 'emergencia' : tipo, 
                    data_vencimento 
                })
            });

            if (res.ok) {
                fecharModalId('modalDespesaLar');
                carregarLarDados();
                seivaNotificar('Despesa do Lar cadastrada e rateio atualizado com sucesso!', 'sucesso', 'Despesa Salva');
            } else {
                seivaNotificar('Não foi possível registrar a despesa do Lar.', 'erro', 'Erro ao Registrar');
            }
        }

        async function carregarCategoriasSistema() {
            try {
                const res = await fetch('/api/categorias');
                if (res.ok) {
                    listaCategorias = await res.json();
                    const sel = document.getElementById('formTransCategoriaId');
                    if (sel) {
                        sel.innerHTML = listaCategorias.map(c => `<option value="${c.id_categoria}">${c.nome}</option>`).join('');
                    }
                }
            } catch (e) {}
        }

        function popularSelectsContas(contas) {
            const sel = document.getElementById('formTransContaId');
            if (sel) {
                sel.innerHTML = contas.map(c => `<option value="${c.id_conta}">${c.nome} (${BRL(c.saldo)})</option>`).join('');
            }
        }

        async function adicionarContaPrompt() {
            abrirModalAdicionarContaCartao();
        }

        async function excluirMinhaConta() {
            const confirmou = await seivaConfirm({
                titulo: 'Excluir definitivamente sua conta?',
                mensagem: 'De acordo com a LGPD, todos os seus dados confidenciais, contas e registros serão permanentemente eliminados. Esta ação não pode ser desfeita.',
                confirmText: 'Sim, excluir minha conta',
                tipo: 'perigo',
                icone: 'alert-triangle'
            });
            if (!confirmou) return;

            try {
                const res = await fetch('/api/perfil/excluir', { 
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' }
                });
                if (res.ok) {
                    seivaNotificar('Conta excluída com sucesso. Até logo!', 'info');
                    setTimeout(() => location.reload(), 1200);
                } else {
                    seivaNotificar('Erro ao processar exclusão da conta.', 'erro');
                }
            } catch(e) {
                seivaNotificar('Erro de conexão ao excluir conta.', 'erro');
            }
        }

        // ==========================================
        // PAINEL DE BOAS-VINDAS INTELIGENTE
        // Aparece ao entrar/recarregar o sistema
        // Notificações reais + ações rápidas personalizáveis
        // ==========================================

        // Catálogo completo de ações disponíveis
        const ACOES_CATALOGO = [
            { id: 'gasto',      icone: 'trending-down',  label: 'Lançar gasto',       cor: '#c84b31', bg: '#fff5f5', fn: 'abrirModalLancarGasto()',         padrao: true  },
            { id: 'entrada',    icone: 'trending-up',    label: 'Registrar entrada',   cor: '#2e6b4f', bg: '#f0fdf4', fn: 'abrirModalRegistrarRecebimento()', padrao: true  },
            { id: 'extrato',    icone: 'receipt',        label: 'Ver extrato',         cor: '#6366f1', bg: '#eef2ff', fn: "trocarAbaApp('transacoes')", padrao: true  },
            { id: 'metas',      icone: 'target',         label: 'Minhas metas',        cor: '#0891b2', bg: '#ecfeff', fn: "trocarAbaApp('metas')",      padrao: false },
            { id: 'lar',        icone: 'home',           label: 'Área do Lar',         cor: '#059669', bg: '#ecfdf5', fn: "trocarAbaApp('lar')",        padrao: false, casalOnly: true },
            { id: 'acordos',    icone: 'handshake',      label: 'Mesa de Acordos',     cor: '#d97706', bg: '#fffbeb', fn: "trocarAbaApp('acordos')",    padrao: false, casalOnly: true },
            { id: 'cobrador',   icone: 'bell-ring',      label: 'Cobrador Diplomata',  cor: '#7c3aed', bg: '#f5f3ff', fn: "trocarAbaApp('cobrador')",   padrao: false, casalOnly: true },
            { id: 'relatorio',  icone: 'bar-chart-2',   label: 'Relatórios',          cor: '#1d4ed8', bg: '#eff6ff', fn: "trocarAbaApp('recebimentos')", padrao: false },
        ];

        function getAcoesCatalogoFiltrado() {
            const isCasal = Boolean(larSessao || (usuarioSessao?.lares && usuarioSessao.lares.length));
            return ACOES_CATALOGO.filter(a => !a.casalOnly || isCasal);
        }

        function getAcoesStorageKey() {
            const uid = usuarioSessao?.id_usuario || usuarioSessao?.id || 'default';
            return `seiva_bv_acoes_${uid}`;
        }

        function getAcoesSalvas() {
            const catalogo = getAcoesCatalogoFiltrado();
            try {
                const salvo = localStorage.getItem(getAcoesStorageKey());
                if (salvo) {
                    const ids = JSON.parse(salvo);
                    const filtradas = catalogo.filter(a => ids.includes(a.id));
                    if (filtradas.length) return filtradas;
                }
            } catch(e) {}
            return catalogo.filter(a => a.padrao);
        }

        function salvarAcoesBV(ids) {
            localStorage.setItem(getAcoesStorageKey(), JSON.stringify(ids));
        }

        function deveExibirBoasVindas() {
            try {
                const chave = 'seiva_bv_ocultar_ate';
                const ocultar = localStorage.getItem(chave);
                if (!ocultar) return true;
                // "Não mostrar hoje" = ocultar até meia-noite do dia seguinte
                const limite = new Date(ocultar);
                return new Date() > limite;
            } catch(e) { return true; }
        }

        function atualizarNaoMostrarBV(checked) {
            const chave = 'seiva_bv_ocultar_ate';
            if (checked) {
                // Ocultar até meia-noite de hoje
                const amanha = new Date();
                amanha.setHours(23, 59, 59, 999);
                localStorage.setItem(chave, amanha.toISOString());
            } else {
                localStorage.removeItem(chave);
            }
        }

        function getSaudacao() {
            const h = new Date().getHours();
            if (h < 12) return 'Bom dia';
            if (h < 18) return 'Boa tarde';
            return 'Boa noite';
        }

        async function abrirBoasVindas() {
            if (!deveExibirBoasVindas()) return;

            const modal = document.getElementById('modalBoasVindas');
            if (!modal) return;
            modal.classList.remove('hidden');

            // Preenche saudação com dados do usuário em sessão
            const nome = usuarioSessao?.nome?.split(' ')[0] || 'usuário';
            const saudEl = document.getElementById('bvSaudacao');
            const nomeEl = document.getElementById('bvNome');
            if (saudEl) saudEl.innerText = getSaudacao();
            if (nomeEl) nomeEl.innerText = nome;

            // Renderiza ações rápidas salvas
            renderizarAcoesBV();

            // Carrega dados assíncronos em paralelo
            Promise.all([
                carregarNotificacoesBV(),
                carregarResumoBV(),
            ]).catch(console.error);

            lucide.createIcons();
        }

        function fecharBoasVindas() {
            const modal = document.getElementById('modalBoasVindas');
            if (modal) modal.classList.add('hidden');
            // Fecha também o painel de personalização
            const painel = document.getElementById('painelPersonalizacaoBV');
            if (painel) painel.classList.add('hidden');
        }

        async function carregarNotificacoesBV() {
            try {
                const res = await fetch('/api/notificacoes', {
                    headers: { 'Accept': 'application/json' }
                });
                if (!res.ok) return;
                const data = await res.json();

                const lista = document.getElementById('bvListaNotificacoes');
                if (!lista) return;

                const badge = document.getElementById('bvBadgeNotif');

                const notifs = data.notificacoes || [];
                const totalNaoLidas = data.total_nao_lidas || 0;

                // Atualiza badge no modal e na topbar
                if (badge) {
                    if (totalNaoLidas > 0) {
                        badge.innerText = totalNaoLidas > 9 ? '9+' : totalNaoLidas;
                        badge.classList.remove('hidden');
                        badge.classList.add('flex');
                    } else {
                        badge.classList.add('hidden');
                        badge.classList.remove('flex');
                    }
                }

                const topbarBadge = document.getElementById('topbarBadgeNotif');
                if (topbarBadge) {
                    if (totalNaoLidas > 0) {
                        topbarBadge.innerText = totalNaoLidas > 9 ? '9+' : totalNaoLidas;
                        topbarBadge.classList.remove('hidden');
                        topbarBadge.classList.add('flex');
                    } else {
                        topbarBadge.classList.add('hidden');
                        topbarBadge.classList.remove('flex');
                    }
                }

                // Atualiza subtítulo
                const sub = document.getElementById('bvSubtitulo');
                if (sub) {
                    if (totalNaoLidas > 0) {
                        sub.innerText = `${totalNaoLidas} ${totalNaoLidas > 1 ? 'notificações' : 'notificação'} pendente${totalNaoLidas > 1 ? 's' : ''} para você`;
                    } else {
                        sub.innerText = 'Tudo em dia! Nenhuma pendência.';
                    }
                }

                const iconesPorTipo = {
                    sucesso:  { icon: 'check-circle',   cor: 'text-emerald-600', borda: 'border-l-emerald-500' },
                    alerta:   { icon: 'alert-triangle', cor: 'text-amber-500',   borda: 'border-l-amber-400' },
                    cobranca: { icon: 'hand-coins',     cor: 'text-violet-600',  borda: 'border-l-violet-500' },
                    info:     { icon: 'info',           cor: 'text-sky-600',     borda: 'border-l-sky-400' },
                    erro:     { icon: 'x-circle',       cor: 'text-rose-500',    borda: 'border-l-rose-400' },
                    lar:      { icon: 'home',           cor: 'text-emerald-600', borda: 'border-l-emerald-500' },
                };

                lista.innerHTML = notifs.map(n => {
                    const cfg = iconesPorTipo[n.tipo] || iconesPorTipo.info;
                    const opacidade = n.lida ? 'opacity-50' : '';
                    const acaoBotao = n.acao
                        ? `<button type="button" onclick="${n.acao.fn}; fecharBoasVindas();"
                               class="mt-1.5 text-[10px] font-bold text-primary hover:underline">
                               ${n.acao.label} →
                           </button>`
                        : '';
                    return `
                        <div class="flex items-start gap-3 p-3 rounded-xl border border-border border-l-4 ${cfg.borda} bg-card ${opacidade} transition hover:bg-muted/30">
                            <span class="size-8 rounded-lg bg-muted/60 ${cfg.cor} flex items-center justify-center shrink-0">
                                <i data-lucide="${cfg.icon}" class="size-4"></i>
                            </span>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-bold text-foreground leading-snug">${n.titulo}</p>
                                <p class="text-[11px] text-muted-foreground leading-snug mt-0.5">${n.texto}</p>
                                ${acaoBotao}
                            </div>
                            <span class="text-[10px] text-muted-foreground shrink-0 mt-0.5">${n.tempo}</span>
                        </div>
                    `;
                }).join('');

                lucide.createIcons();
            } catch(e) {
                console.error('Erro ao carregar notificações:', e);
            }
        }

        async function carregarResumoBV() {
            try {
                const res = await fetch('/api/dashboard', {
                    headers: { 'Accept': 'application/json' }
                });
                if (!res.ok) return;
                const data = await res.json();

                const entEl = document.getElementById('bvValorEntradas');
                const saiEl = document.getElementById('bvValorSaidas');
                const livEl = document.getElementById('bvValorLivre');

                if (entEl) entEl.innerText = BRL(data.resumo?.total_entradas || 0);
                if (saiEl) saiEl.innerText = BRL(data.resumo?.total_saidas   || 0);
                if (livEl) livEl.innerText = BRL(data.resumo?.saldo_livre     || 0);
            } catch(e) {
                console.error('Erro ao carregar resumo BV:', e);
            }
        }

        function renderizarAcoesBV() {
            const container = document.getElementById('bvAcoesRapidas');
            if (!container) return;
            const acoes = getAcoesSalvas();

            if (!acoes.length) {
                container.innerHTML = '<p class="text-xs text-muted-foreground col-span-2 text-center py-2">Nenhuma ação selecionada. Clique no botão de configurações acima para personalizar.</p>';
                return;
            }

            container.innerHTML = acoes.map(a => `
                <button type="button"
                        onclick="${a.fn}; fecharBoasVindas();"
                        class="flex items-center gap-2.5 p-3.5 rounded-2xl border border-border bg-card hover:bg-muted/40 transition group text-left">
                    <span class="size-8 rounded-xl flex items-center justify-center shrink-0"
                          style="background-color: ${a.bg}; color: ${a.cor}">
                        <i data-lucide="${a.icone}" class="size-4"></i>
                    </span>
                    <span class="text-xs font-bold text-foreground leading-tight">${a.label}</span>
                </button>
            `).join('');

            lucide.createIcons();
        }

        function abrirPersonalizacaoBoasVindas() {
            const painel = document.getElementById('painelPersonalizacaoBV');
            if (!painel) return;

            const idsSalvos = getAcoesSalvas().map(a => a.id);

            const lista = document.getElementById('listaPersonalizacaoBV');
            if (lista) {
                lista.innerHTML = getAcoesCatalogoFiltrado().map(a => `
                    <label class="flex items-center justify-between gap-3 p-2.5 rounded-xl hover:bg-muted/40 cursor-pointer transition">
                        <div class="flex items-center gap-2.5">
                            <span class="size-8 rounded-xl flex items-center justify-center shrink-0"
                                  style="background-color: ${a.bg}; color: ${a.cor}">
                                <i data-lucide="${a.icone}" class="size-4"></i>
                            </span>
                            <span class="text-xs font-semibold text-foreground">${a.label}</span>
                        </div>
                        <input type="checkbox"
                               class="rounded border-border size-4 accent-primary"
                               value="${a.id}"
                               ${idsSalvos.includes(a.id) ? 'checked' : ''}
                               onchange="toggleAcaoBV('${a.id}', this.checked)">
                    </label>
                `).join('');
            }

            painel.classList.remove('hidden');
            lucide.createIcons();
        }

        function fecharPersonalizacaoBoasVindas() {
            const painel = document.getElementById('painelPersonalizacaoBV');
            if (painel) painel.classList.add('hidden');
            renderizarAcoesBV(); // Re-renderiza com as novas seleções
        }

        function toggleAcaoBV(id, ativo) {
            try {
                let ids = getAcoesSalvas().map(a => a.id);
                if (ativo && !ids.includes(id)) ids.push(id);
                if (!ativo) ids = ids.filter(x => x !== id);
                // Mantém a ordem do catálogo filtrado
                ids = getAcoesCatalogoFiltrado().map(a => a.id).filter(i => ids.includes(i));
                salvarAcoesBV(ids);
            } catch(e) {}
        }

        async function marcarTodasLidasBV() {
            try {
                await fetch('/api/notificacoes/ler', {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' }
                });
                // Re-carrega a lista com todas marcadas como lidas
                await carregarNotificacoesBV();
                seivaNotificar('Todas as notificações foram marcadas como lidas.', 'sucesso', 'Notificações');
            } catch(e) {}
        }

        // ── Pop-up Dedicado de Notificações SEIVA ──────────────────────────
        function abrirModalNotificacoes() {
            abrirModalNotificacoesPopup();
        }

        function abrirModalNotificacoesPopup() {
            const modal = document.getElementById('modalNotificacoesPopup');
            if (!modal) return;
            modal.classList.remove('hidden');
            carregarNotificacoesPopup();
            lucide.createIcons();
        }

        function fecharModalNotificacoesPopup() {
            const modal = document.getElementById('modalNotificacoesPopup');
            if (modal) modal.classList.add('hidden');
        }

        function abrirModalBoasVindasCompleto() {
            fecharModalNotificacoesPopup();
            const modal = document.getElementById('modalBoasVindas');
            if (!modal) return;
            modal.classList.remove('hidden');
            const nome = usuarioSessao?.nome?.split(' ')[0] || 'usuário';
            const saudEl = document.getElementById('bvSaudacao');
            const nomeEl = document.getElementById('bvNome');
            if (saudEl) saudEl.innerText = getSaudacao();
            if (nomeEl) nomeEl.innerText = nome;
            renderizarAcoesBV();
            Promise.all([carregarNotificacoesBV(), carregarResumoBV()]).catch(console.error);
            lucide.createIcons();
        }

        let notificacoesCache = [];
        let abaNotificacoesAtual = 'nao_lidas';

        function alternarAbaNotificacoes(aba) {
            abaNotificacoesAtual = aba;
            const btnNaoLidas = document.getElementById('tabNotifNaoLidas');
            const btnHistorico = document.getElementById('tabNotifHistorico');

            if (aba === 'nao_lidas') {
                if (btnNaoLidas) btnNaoLidas.className = 'flex items-center gap-1.5 py-1.5 px-3 rounded-xl text-xs font-bold transition bg-card text-foreground shadow-2xs border border-border/60';
                if (btnHistorico) btnHistorico.className = 'flex items-center gap-1.5 py-1.5 px-3 rounded-xl text-xs font-bold transition text-muted-foreground hover:text-foreground';
            } else {
                if (btnHistorico) btnHistorico.className = 'flex items-center gap-1.5 py-1.5 px-3 rounded-xl text-xs font-bold transition bg-card text-foreground shadow-2xs border border-border/60';
                if (btnNaoLidas) btnNaoLidas.className = 'flex items-center gap-1.5 py-1.5 px-3 rounded-xl text-xs font-bold transition text-muted-foreground hover:text-foreground';
            }
            renderizarListaNotificacoes();
        }

        async function carregarNotificacoesPopup() {
            try {
                const res = await fetch('/api/notificacoes', {
                    headers: { 'Accept': 'application/json' }
                });
                if (!res.ok) return;
                const data = await res.json();
                notificacoesCache = data.notificacoes || [];
                const totalNaoLidas = notificacoesCache.filter(n => !n.lida).length;
                const totalHistorico = notificacoesCache.filter(n => n.lida).length;

                // Atualizar badges
                const badgePopup = document.getElementById('popupNotifBadgeContador');
                const badgeTop = document.getElementById('topbarBadgeNotif');
                const countNaoLidasEl = document.getElementById('notifNaoLidasCount');
                const countHistoricoEl = document.getElementById('notifHistoricoCount');

                if (countNaoLidasEl) countNaoLidasEl.innerText = totalNaoLidas;
                if (countHistoricoEl) countHistoricoEl.innerText = totalHistorico;

                [badgePopup, badgeTop].forEach(b => {
                    if (b) {
                        if (totalNaoLidas > 0) {
                            b.innerText = totalNaoLidas > 9 ? '9+' : totalNaoLidas;
                            b.classList.remove('hidden');
                            b.classList.add('flex');
                        } else {
                            b.classList.add('hidden');
                            b.classList.remove('flex');
                        }
                    }
                });

                renderizarListaNotificacoes();
            } catch (e) {
                console.error('Erro ao carregar pop-up de notificações:', e);
            }
        }

        function renderizarListaNotificacoes() {
            const lista = document.getElementById('popupNotificacoesLista');
            if (!lista) return;

            const itensExibir = abaNotificacoesAtual === 'nao_lidas' 
                ? notificacoesCache.filter(n => !n.lida)
                : notificacoesCache.filter(n => n.lida);

            if (!itensExibir.length) {
                if (abaNotificacoesAtual === 'nao_lidas') {
                    lista.innerHTML = `
                        <div class="flex flex-col items-center justify-center py-8 text-center gap-2">
                            <span class="size-10 rounded-2xl bg-emerald-50 dark:bg-emerald-950 text-emerald-600 flex items-center justify-center">
                                <i data-lucide="check-circle-2" class="size-5"></i>
                            </span>
                            <p class="text-xs font-bold text-foreground">Tudo em dia!</p>
                            <p class="text-[11px] text-muted-foreground">Nenhuma notificação pendente no momento.</p>
                        </div>
                    `;
                } else {
                    lista.innerHTML = `
                        <div class="flex flex-col items-center justify-center py-8 text-center gap-2">
                            <span class="size-10 rounded-2xl bg-muted text-muted-foreground flex items-center justify-center">
                                <i data-lucide="archive" class="size-5"></i>
                            </span>
                            <p class="text-xs font-bold text-foreground">Histórico vazio</p>
                            <p class="text-[11px] text-muted-foreground">Nenhuma notificação arquivada no histórico.</p>
                        </div>
                    `;
                }
                lucide.createIcons();
                return;
            }

            const iconesPorTipo = {
                sucesso:  { icon: 'check-circle',   cor: 'text-emerald-600 dark:text-emerald-400', borda: 'border-l-emerald-500 dark:border-l-emerald-400' },
                alerta:   { icon: 'alert-triangle', cor: 'text-amber-500 dark:text-amber-400',     borda: 'border-l-amber-400 dark:border-l-amber-400' },
                cobranca: { icon: 'hand-coins',     cor: 'text-violet-600 dark:text-violet-400',   borda: 'border-l-violet-500 dark:border-l-violet-400' },
                info:     { icon: 'info',           cor: 'text-sky-600 dark:text-sky-400',         borda: 'border-l-sky-400 dark:border-l-sky-400' },
                erro:     { icon: 'x-circle',       cor: 'text-rose-500 dark:text-rose-400',       borda: 'border-l-rose-400 dark:border-l-rose-400' },
                lar:      { icon: 'home',           cor: 'text-emerald-600 dark:text-emerald-400', borda: 'border-l-emerald-500 dark:border-l-emerald-400' },
            };

            lista.innerHTML = itensExibir.map(n => {
                const cfg = iconesPorTipo[n.tipo] || iconesPorTipo.info;
                const acaoBotao = n.acao
                    ? `<button type="button" onclick="${n.acao.fn}; fecharModalNotificacoesPopup();"
                           class="mt-2 px-3 py-1.5 rounded-xl bg-primary/10 border border-primary/20 hover:bg-primary/20 text-[11px] font-bold text-primary transition flex items-center gap-1.5">
                           <span>${n.acao.label}</span>
                           <i data-lucide="arrow-right" class="size-3"></i>
                       </button>`
                    : '';

                const botaoMarcarLida = !n.lida ? `
                    <button type="button" onclick="marcarNotificacaoIndividualLida('${n.id}')" title="Marcar como lida" 
                            class="size-6 rounded-lg text-muted-foreground hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-950/40 flex items-center justify-center transition shrink-0" aria-label="Marcar como lida">
                        <i data-lucide="check" class="size-3.5"></i>
                    </button>
                ` : '';

                return `
                    <div class="flex items-start gap-3 p-3.5 rounded-xl border border-border border-l-4 ${cfg.borda} bg-card dark:bg-card transition hover:bg-muted/30 dark:hover:bg-muted/20">
                        <span class="size-9 rounded-lg bg-muted/60 dark:bg-muted/30 ${cfg.cor} flex items-center justify-center shrink-0">
                            <i data-lucide="${cfg.icon}" class="size-4"></i>
                        </span>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-1">
                                <p class="text-xs font-black text-foreground leading-snug">${n.titulo}</p>
                                <div class="flex items-center gap-1">
                                    <span class="text-[10px] text-muted-foreground shrink-0">${n.tempo || ''}</span>
                                    ${botaoMarcarLida}
                                </div>
                            </div>
                            <p class="text-[11px] text-muted-foreground leading-relaxed mt-0.5">${n.texto}</p>
                            ${acaoBotao}
                        </div>
                    </div>
                `;
            }).join('');

            lucide.createIcons();
        }

        async function marcarNotificacaoIndividualLida(id) {
            const notif = notificacoesCache.find(n => n.id === id);
            if (notif) notif.lida = true;

            const totalNaoLidas = notificacoesCache.filter(n => !n.lida).length;
            const totalHistorico = notificacoesCache.filter(n => n.lida).length;

            const badgePopup = document.getElementById('popupNotifBadgeContador');
            const badgeTop = document.getElementById('topbarBadgeNotif');
            const countNaoLidasEl = document.getElementById('notifNaoLidasCount');
            const countHistoricoEl = document.getElementById('notifHistoricoCount');

            if (countNaoLidasEl) countNaoLidasEl.innerText = totalNaoLidas;
            if (countHistoricoEl) countHistoricoEl.innerText = totalHistorico;

            [badgePopup, badgeTop].forEach(b => {
                if (b) {
                    if (totalNaoLidas > 0) {
                        b.innerText = totalNaoLidas > 9 ? '9+' : totalNaoLidas;
                        b.classList.remove('hidden');
                        b.classList.add('flex');
                    } else {
                        b.classList.add('hidden');
                        b.classList.remove('flex');
                    }
                }
            });

            // Re-renderiza: a notificação lida desaparece imediatamente da aba "Não lidas"
            renderizarListaNotificacoes();

            try {
                await fetch('/api/notificacoes/ler', {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                    body: JSON.stringify({ id: id })
                });
            } catch(e) {}
        }

        async function marcarTodasLidasPopup() {
            try {
                await fetch('/api/notificacoes/ler', {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' }
                });

                // Marca todas como lidas no cache local
                notificacoesCache.forEach(n => n.lida = true);

                // Zera badges e contadores
                const badgePopup = document.getElementById('popupNotifBadgeContador');
                const badgeTop = document.getElementById('topbarBadgeNotif');
                const countNaoLidasEl = document.getElementById('notifNaoLidasCount');
                const countHistoricoEl = document.getElementById('notifHistoricoCount');

                if (countNaoLidasEl) countNaoLidasEl.innerText = '0';
                if (countHistoricoEl) countHistoricoEl.innerText = notificacoesCache.length;

                [badgePopup, badgeTop].forEach(b => {
                    if (b) {
                        b.classList.add('hidden');
                        b.classList.remove('flex');
                    }
                });

                // Re-renderiza imediatamente: as notificações somem da aba Não lidas
                renderizarListaNotificacoes();
                await carregarNotificacoesBV();
                seivaNotificar('Todas as notificações foram marcadas como lidas.', 'sucesso', 'Notificações');
            } catch(e) {}
        }

        // ── Funções de Edição de Metas (RF007, RF008) ────────────────────────
        function abrirModalEditarMeta(id, titulo, valorAlvo, categoria, link, imagem, loja, monitorar) {
            document.getElementById('editMetaId').value = id;
            document.getElementById('editMetaNome').value = titulo || '';
            const numAlvo = typeof valorAlvo === 'number' ? valorAlvo : parseFloat(valorAlvo) || 0;
            document.getElementById('editMetaValor').value = numAlvo.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            document.getElementById('editMetaCategoria').value = categoria || 'produto';
            document.getElementById('editMetaLinkProduto').value = link || '';
            document.getElementById('editMetaLoja').value = loja || '';
            document.getElementById('editMetaFotoUrl').value = imagem || '';
            const chkMon = document.getElementById('editMetaMonitorarPromocao');
            if (chkMon) chkMon.checked = monitorar !== false;

            // Atualiza chips de categoria
            document.querySelectorAll('.chip-cat-meta-edit').forEach(btn => {
                btn.className = 'chip-cat-meta-edit flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition';
            });
            const chipAtivo = document.querySelector(`.chip-cat-meta-edit[onclick*="'${categoria}'"]`);
            if (chipAtivo) {
                chipAtivo.className = 'chip-cat-meta-edit flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-emerald-600 bg-emerald-800 text-white font-bold text-xs transition';
            }

            // Preview de foto
            const previewCont = document.getElementById('previewFotoMetaEditContainer');
            const previewImg  = document.getElementById('previewFotoMetaEditImg');
            const boxUpload   = document.getElementById('boxUploadFotoMetaEdit');
            const previewTit  = document.getElementById('previewFotoMetaEditTitulo');

            if (imagem) {
                if (previewImg) previewImg.src = imagem;
                if (previewTit) previewTit.innerText = titulo || 'Foto do produto';
                if (previewCont) previewCont.classList.remove('hidden');
                if (boxUpload) boxUpload.classList.add('hidden');
            } else {
                if (previewCont) previewCont.classList.add('hidden');
                if (boxUpload) boxUpload.classList.remove('hidden');
            }

            abrirModalId('modalEditarMeta');
            lucide.createIcons();
        }

        function selecionarTipoMetaEdicao(btn, cat, icone) {
            document.querySelectorAll('.chip-cat-meta-edit').forEach(b => {
                b.className = 'chip-cat-meta-edit flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition';
            });
            btn.className = 'chip-cat-meta-edit flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-emerald-600 bg-emerald-800 text-white font-bold text-xs transition';
            document.getElementById('editMetaCategoria').value = cat;
        }

        async function buscarDadosLinkProdutoEdit() {
            const url = document.getElementById('editMetaLinkProduto')?.value?.trim();
            if (!url) return seivaNotificar('Cole a URL de um produto antes de buscar.', 'aviso');

            const btn = document.getElementById('btnBuscarLinkMetaEdit');
            const textoOriginal = btn ? btn.innerHTML : 'Buscar';
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = `<i data-lucide="loader-2" class="size-3.5 animate-spin"></i><span>Buscando...</span>`;
                lucide.createIcons();
            }

            try {
                const res = await fetch('/api/metas/consultar-link', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ url })
                });

                if (res.ok) {
                    const data = await res.json();
                    if (data.titulo) document.getElementById('editMetaNome').value = data.titulo;
                    if (data.preco) {
                        const valFmt = typeof data.preco === 'number'
                            ? data.preco.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
                            : data.preco;
                        document.getElementById('editMetaValor').value = valFmt;
                    }
                    if (data.loja) document.getElementById('editMetaLoja').value = data.loja;
                    if (data.imagem) {
                        document.getElementById('editMetaFotoUrl').value = data.imagem;
                        const previewCont = document.getElementById('previewFotoMetaEditContainer');
                        const previewImg = document.getElementById('previewFotoMetaEditImg');
                        const boxUpload = document.getElementById('boxUploadFotoMetaEdit');
                        const previewTit = document.getElementById('previewFotoMetaEditTitulo');
                        if (previewImg) previewImg.src = data.imagem;
                        if (previewTit) previewTit.innerText = data.titulo || 'Foto do produto';
                        if (previewCont) previewCont.classList.remove('hidden');
                        if (boxUpload) boxUpload.classList.add('hidden');
                    }
                    seivaNotificar(`Dados atualizados via ${data.loja || 'loja'}!`, 'sucesso', 'Wishlist');
                } else {
                    seivaNotificar('Não foi possível buscar os dados automaticamente deste link.', 'aviso');
                }
            } catch (e) {
                seivaNotificar('Erro ao consultar link do produto.', 'erro');
            } finally {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = textoOriginal;
                    lucide.createIcons();
                }
            }
        }

        function aoSelecionarFotoMetaEdit(input) {
            if (!input.files || !input.files[0]) return;
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const dataUrl = e.target.result;
                document.getElementById('editMetaFotoUrl').value = dataUrl;
                const previewCont = document.getElementById('previewFotoMetaEditContainer');
                const previewImg = document.getElementById('previewFotoMetaEditImg');
                const boxUpload = document.getElementById('boxUploadFotoMetaEdit');
                const previewTit = document.getElementById('previewFotoMetaEditTitulo');
                if (previewImg) previewImg.src = dataUrl;
                if (previewTit) previewTit.innerText = file.name;
                if (previewCont) previewCont.classList.remove('hidden');
                if (boxUpload) boxUpload.classList.add('hidden');
                lucide.createIcons();
            };
            reader.readAsDataURL(file);
        }

        function removerFotoMetaEdit(e) {
            if (e) e.stopPropagation();
            document.getElementById('editMetaFotoUrl').value = '';
            const inpFile = document.getElementById('editMetaFotoArquivo');
            if (inpFile) inpFile.value = '';
            const previewCont = document.getElementById('previewFotoMetaEditContainer');
            const boxUpload = document.getElementById('boxUploadFotoMetaEdit');
            if (previewCont) previewCont.classList.add('hidden');
            if (boxUpload) boxUpload.classList.remove('hidden');
            lucide.createIcons();
        }

        async function executarSalvarEdicaoMeta(event) {
            event.preventDefault();
            const id = document.getElementById('editMetaId').value;
            const titulo = document.getElementById('editMetaNome').value.trim();
            const categoria = document.getElementById('editMetaCategoria').value;
            const valorRaw = document.getElementById('editMetaValor').value.replace(/\./g, '').replace(',', '.');
            const valor_alvo = parseFloat(valorRaw) || 0;
            const link_referencia = document.getElementById('editMetaLinkProduto')?.value?.trim() || null;
            const loja = document.getElementById('editMetaLoja')?.value?.trim() || null;
            const imagem = document.getElementById('editMetaFotoUrl')?.value || null;
            const monitorar_promocao = document.getElementById('editMetaMonitorarPromocao')?.checked ?? true;

            if (!valor_alvo) return seivaNotificar('Informe um valor planejado válido.', 'aviso');

            try {
                const res = await fetch(`/api/metas/${id}/atualizar`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({
                        titulo,
                        categoria,
                        valor_alvo,
                        link_referencia,
                        loja,
                        imagem,
                        monitorar_promocao
                    })
                });

                if (res.ok) {
                    seivaNotificar('Objetivo atualizado com sucesso!', 'sucesso', 'Meta Atualizada');
                    fecharModalId('modalEditarMeta');
                    carregarMetasDados();
                    carregarDashboardDados();
                } else {
                    const err = await res.json();
                    seivaNotificar(err.mensagem || 'Não foi possível salvar alterações.', 'erro');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão ao salvar objetivo.', 'erro');
            }
        }

        // ── CRUD DE METAS: EXCLUSÃO COMPLETA (RF007 / RF008) ──
        async function executarExcluirMeta() {
            const id = document.getElementById('editMetaId')?.value;
            const titulo = document.getElementById('editMetaNome')?.value || 'este objetivo';
            if (!id) return fecharModalId('modalEditarMeta');

            const confirmou = await seivaConfirm({
                titulo: 'Excluir objetivo?',
                mensagem: `Deseja realmente excluir o objetivo "${titulo}"?`,
                badge: { texto: 'Objetivo & Poupança', tipo: 'seguranca' },
                impacto: {
                    titulo: 'Estorno do Saldo Guardado',
                    texto: 'Se esta meta tiver valor já acumulado, o montante total será devolvido automaticamente para a sua conta bancária de origem com registro formal de estorno.'
                },
                tipo: 'perigo',
                icone: 'trash-2',
                confirmText: 'Excluir Objetivo & Estornar',
                cancelText: 'Cancelar (Manter Objetivo)'
            });
            if (!confirmou) return;

            try {
                const res = await fetch(`/api/metas/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                if (res.ok) {
                    const data = await res.json().catch(() => ({}));
                    fecharModalId('modalEditarMeta');
                    seivaNotificar(data.mensagem || `Objetivo "${titulo}" excluído com sucesso!`, 'sucesso', 'Meta Removida');
                    carregarMetasDados();
                    carregarDashboardDados();
                } else {
                    const err = await res.json().catch(() => ({}));
                    seivaNotificar(err.mensagem || err.error || 'Não foi possível excluir o objetivo.', 'aviso');
                }
            } catch (e) {
                console.error(e);
                seivaNotificar('Erro de conexão ao excluir objetivo.', 'erro');
            }
        }

        async function excluirMetaDireto(id, titulo) {
            const confirmou = await seivaConfirm({
                titulo: 'Excluir objetivo?',
                mensagem: `Deseja realmente excluir o objetivo "${titulo}"?`,
                badge: { texto: 'Objetivo & Poupança', tipo: 'seguranca' },
                impacto: {
                    titulo: 'Estorno do Saldo Guardado',
                    texto: 'Se esta meta tiver valor já acumulado, o montante total será devolvido automaticamente para sua conta bancária com rastro de estorno.'
                },
                tipo: 'perigo',
                icone: 'trash-2',
                confirmText: 'Excluir & Estornar',
                cancelText: 'Cancelar (Manter)'
            });
            if (!confirmou) return;

            try {
                const res = await fetch(`/api/metas/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                if (res.ok) {
                    const data = await res.json().catch(() => ({}));
                    seivaNotificar(data.mensagem || `Objetivo "${titulo}" excluído!`, 'sucesso', 'Meta Removida');
                    carregarMetasDados();
                    carregarDashboardDados();
                } else {
                    const err = await res.json().catch(() => ({}));
                    seivaNotificar(err.mensagem || err.error || 'Erro ao excluir objetivo.', 'aviso');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão ao excluir.', 'erro');
            }
        }

        // ── CRUD DE CONTAS BANCÁRIAS: EDIÇÃO E EXCLUSÃO (RF003) ──
        function abrirModalEditarConta(c) {
            if (!c) return;
            const id = c.id_conta || c.id;
            const nome = c.nome || '';
            const tipo = c.tipo || 'corrente';
            const saldo = c.saldo || 0;
            const cor = c.cor || '#10b981';

            document.getElementById('editContaId').value = id;
            document.getElementById('editContaNome').value = nome;
            document.getElementById('editContaTipo').value = tipo;
            document.getElementById('editContaSaldo').value = parseFloat(saldo).toFixed(2);
            document.getElementById('editContaCor').value = cor;

            // Destaque visual da cor selecionada
            const gridCores = document.getElementById('editContaCoresGrid');
            if (gridCores) {
                gridCores.querySelectorAll('button').forEach(btn => {
                    const btnCor = btn.style.backgroundColor;
                    btn.classList.toggle('ring-2', btnCor === cor || btnCor.toLowerCase() === cor.toLowerCase());
                    btn.classList.toggle('ring-emerald-600', btnCor === cor || btnCor.toLowerCase() === cor.toLowerCase());
                });
            }

            const modal = document.getElementById('modalEditarConta');
            if (modal) modal.classList.remove('hidden');
            lucide.createIcons();
        }

        function selecionarCorContaEdit(btn, cor) {
            document.getElementById('editContaCor').value = cor;
            const gridCores = document.getElementById('editContaCoresGrid');
            if (gridCores) {
                gridCores.querySelectorAll('button').forEach(b => {
                    b.classList.remove('ring-2', 'ring-emerald-600', 'scale-110');
                });
                btn.classList.add('ring-2', 'ring-emerald-600', 'scale-110');
            }
        }

        async function executarSalvarEdicaoConta(event) {
            event.preventDefault();
            const id = document.getElementById('editContaId').value;
            const nome = document.getElementById('editContaNome').value.trim();
            const tipo = document.getElementById('editContaTipo').value;
            const saldo = parseFloat(document.getElementById('editContaSaldo').value || 0);
            const cor = document.getElementById('editContaCor').value;

            if (!nome) return seivaNotificar('Informe o nome da instituição ou conta.', 'aviso');

            try {
                const res = await fetch(`/api/contas/${id}/atualizar`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ nome, tipo, saldo, cor })
                });

                if (res.ok) {
                    fecharModalId('modalEditarConta');
                    seivaNotificar(`Conta "${nome}" atualizada com sucesso!`, 'sucesso', 'Conta Atualizada');
                    carregarDashboardDados();
                    carregarCaixaPretaDados();
                } else {
                    const err = await res.json().catch(() => ({}));
                    seivaNotificar(err.mensagem || err.error || 'Erro ao atualizar conta.', 'aviso');
                }
            } catch (e) {
                console.error(e);
                seivaNotificar('Erro de conexão ao salvar conta.', 'erro');
            }
        }

        async function executarExcluirContaModal() {
            const id = document.getElementById('editContaId')?.value;
            const nome = document.getElementById('editContaNome')?.value || 'esta instituição';
            if (!id) return fecharModalId('modalEditarConta');

            const confirmou = await seivaConfirm({
                titulo: 'Remover ou arquivar conta?',
                mensagem: `Deseja remover a conta "${nome}"?`,
                badge: { texto: 'Conta Bancária & Integridade', tipo: 'seguranca' },
                impacto: {
                    titulo: 'Proteção de Extratos Passados',
                    texto: 'Se esta conta tiver lançamentos vinculados, ela não será apagada fisicamente para não quebrar seus relatórios: será arquivada com segurança e ocultada para novos gastos.'
                },
                tipo: 'perigo',
                icone: 'shield-alert',
                confirmText: 'Prosseguir com Remoção',
                cancelText: 'Cancelar (Manter Conta)'
            });
            if (!confirmou) return;

            try {
                const res = await fetch(`/api/contas/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                if (res.ok) {
                    const data = await res.json().catch(() => ({}));
                    fecharModalId('modalEditarConta');
                    seivaNotificar(data.mensagem || `Conta "${nome}" processada com sucesso!`, 'sucesso', 'Conta Processada');
                    carregarDashboardDados();
                    carregarCaixaPretaDados();
                } else {
                    const err = await res.json().catch(() => ({}));
                    seivaNotificar(err.mensagem || err.error || 'Não foi possível remover a conta.', 'aviso');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão ao remover conta.', 'erro');
            }
        }

        async function excluirContaDireto(id, nome) {
            const confirmou = await seivaConfirm({
                titulo: 'Remover ou arquivar conta?',
                mensagem: `Deseja realmente remover a conta "${nome}"?`,
                badge: { texto: 'Conta Bancária & Integridade', tipo: 'seguranca' },
                impacto: {
                    titulo: 'Proteção de Extratos Passados',
                    texto: 'Se a conta já tiver transações registradas, ela será arquivada com segurança para preservar todo o histórico financeiro.'
                },
                tipo: 'perigo',
                icone: 'shield-alert',
                confirmText: 'Prosseguir',
                cancelText: 'Cancelar'
            });
            if (!confirmou) return;

            try {
                const res = await fetch(`/api/contas/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                if (res.ok) {
                    const data = await res.json().catch(() => ({}));
                    seivaNotificar(data.mensagem || `Conta "${nome}" processada com sucesso!`, 'sucesso', 'Conta Atualizada');
                    carregarDashboardDados();
                    carregarCaixaPretaDados();
                } else {
                    const err = await res.json().catch(() => ({}));
                    seivaNotificar(err.mensagem || err.error || 'Erro ao remover conta.', 'aviso');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão.', 'erro');
            }
        }

        async function excluirDespesaLarDireto(id, titulo) {
            const confirmou = await seivaConfirm({
                titulo: 'Remover despesa do Lar?',
                mensagem: `Deseja realmente excluir a despesa "${titulo}" e recalcular as cotas do Lar?`,
                badge: { texto: 'Despesa Compartilhada do Lar', tipo: 'casal' },
                impacto: {
                    titulo: 'Recálculo Imediato do Rateio',
                    texto: 'As cotas mensais do casal serão recalculadas e esta exclusão será gravada no Histórico de Auditoria para comprovação mútua.'
                },
                tipo: 'perigo',
                icone: 'shield-alert',
                confirmText: 'Remover & Recalcular',
                cancelText: 'Cancelar (Manter)'
            });
            if (!confirmou) return;

            try {
                const res = await fetch(`/lar/despesas/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                if (res.ok) {
                    seivaNotificar(`Despesa "${titulo}" excluída com sucesso!`, 'sucesso', 'Despesa Removida');
                    carregarLarDados();
                } else {
                    seivaNotificar('Erro ao excluir despesa do Lar.', 'aviso');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão.', 'erro');
            }
        }

        // ── HISTÓRICO DE AUDITORIA & RASTREABILIDADE FINANCEIRA (FINTECH) ──
        async function abrirModalHistoricoAuditoria() {
            abrirModalId('modalHistoricoAuditoria');
            const container = document.getElementById('listaHistoricoAuditoriaContainer');
            if (container) {
                container.innerHTML = `
                    <div class="py-8 text-center text-muted-foreground text-xs space-y-2">
                        <i data-lucide="loader-2" class="size-6 animate-spin mx-auto text-emerald-600"></i>
                        <p>Consultando histórico contábil...</p>
                    </div>`;
                if (window.lucide) lucide.createIcons();
            }

            try {
                const res = await fetch('/api/auditoria/historico', {
                    headers: { 'Accept': 'application/json' }
                });
                const data = await res.json();
                const itens = data.historico || [];

                if (!itens.length) {
                    container.innerHTML = `
                        <div class="py-8 text-center text-muted-foreground text-xs space-y-2">
                            <i data-lucide="shield-check" class="size-8 mx-auto text-muted-foreground/40"></i>
                            <p>Nenhuma alteração registrada ainda. Todas as operações respeitam integridade referencial.</p>
                        </div>`;
                } else {
                    container.innerHTML = itens.map(h => {
                        let corBadge = 'bg-emerald-50 text-emerald-800 border-emerald-300 dark:bg-emerald-950/40 dark:text-emerald-300';
                        let iconeBadge = 'check-circle';
                        if (h.acao === 'estornado') {
                            corBadge = 'bg-rose-50 text-rose-800 border-rose-300 dark:bg-rose-950/40 dark:text-rose-300';
                            iconeBadge = 'undo-2';
                        } else if (h.acao === 'arquivado' || h.acao === 'reajustado') {
                            corBadge = 'bg-amber-50 text-amber-800 border-amber-300 dark:bg-amber-950/40 dark:text-amber-300';
                            iconeBadge = 'history';
                        } else if (h.acao === 'editado') {
                            corBadge = 'bg-blue-50 text-blue-800 border-blue-300 dark:bg-blue-950/40 dark:text-blue-300';
                            iconeBadge = 'edit-3';
                        }

                        return `
                        <div class="p-4 rounded-2xl border border-border bg-card space-y-2 shadow-2xs hover:border-emerald-500/30 transition">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-black border ${corBadge}">
                                        <i data-lucide="${iconeBadge}" class="size-3"></i>
                                        <span class="capitalize">${h.acao}</span>
                                    </span>
                                    <span class="text-[11px] font-extrabold text-foreground">${h.autor}</span>
                                </div>
                                <span class="text-[10px] text-muted-foreground font-medium">${h.data_formatada || h.tempo_atras}</span>
                            </div>
                            <p class="text-xs text-foreground font-semibold leading-relaxed">${h.descricao}</p>
                            <span class="text-[10px] text-muted-foreground block uppercase font-bold tracking-wider">Entidade: ${h.entidade_tipo}</span>
                        </div>`;
                    }).join('');
                }
                if (window.lucide) lucide.createIcons();
            } catch (e) {
                console.error(e);
                container.innerHTML = `<p class="py-4 text-center text-xs text-rose-500">Erro ao carregar registros de auditoria.</p>`;
            }
        }

        // ── Renderização dinâmica das seções do Dashboard ─────────────────────
        // Executado ao final de carregarDashboardDados()

        function renderizarSecoesDinamicasDashboard(data) {
            const isCasal = Boolean(data.is_casal && data.lar);
            window._isCasalGlobal = isCasal;

            // — Ocultar/Exibir aba "Custo do Lar" conforme tipo de usuário —
            const tabLar         = document.getElementById('tabHeroCustoLar');
            const tabsContainer  = document.getElementById('heroToggleTabsContainer');
            const sliderNav      = document.getElementById('sliderNavContainer');
            const sliderDotLar   = document.getElementById('sliderDotLar');
            const sliderDica     = document.getElementById('sliderTextoDica');
            const cardLar        = document.getElementById('cardHeroCustoLar');
            const heroTituloSec  = document.getElementById('heroTituloSecao');
            const bannerAjuda    = document.getElementById('bannerPedidoAjuda');
            const secaoLarSide   = document.getElementById('secaoLarSidebar');

            // Elementos de navegação e módulos do Lar
            const bottomNavAcordos = document.getElementById('bottomNavAcordos');
            const bottomNavLar     = document.getElementById('bottomNavLar');
            const txAbasContainer  = document.getElementById('txAbasPrincipalContainer');
            const txSubtitulo      = document.getElementById('txSubtitulo');
            const tabPlanoLar      = document.getElementById('tabPlanoLar');
            const painelPlanoLar   = document.getElementById('painelPlanoLar');
            const btnFiltroProdLar = document.getElementById('btnFiltroProdOlhoLar');

            const larCardBloqueio      = document.getElementById('larCardBloqueioSemLar');
            const larConteudo          = document.getElementById('larConteudoCasal');
            const acordosCardBloqueio  = document.getElementById('acordosCardBloqueioSemLar');
            const acordosConteudo      = document.getElementById('acordosConteudoCasal');
            const cobradorCardBloqueio = document.getElementById('cobradorCardBloqueioSemLar');
            const cobradorConteudo     = document.getElementById('cobradorConteudoCasal');

            if (!isCasal) {
                // Individual: ocultar tudo do Lar
                if (tabLar)        tabLar.classList.add('hidden');
                if (tabsContainer) tabsContainer.classList.add('hidden');
                if (sliderNav)     sliderNav.classList.add('hidden');
                if (sliderDotLar)  sliderDotLar.classList.add('hidden');
                if (sliderDica)    sliderDica.innerText = '';
                if (cardLar)       cardLar.classList.add('hidden');
                if (bannerAjuda)   bannerAjuda.classList.add('hidden');
                if (heroTituloSec) heroTituloSec.innerText = 'Meu mês financeiro';
                if (secaoLarSide)  secaoLarSide.classList.add('hidden');

                if (bottomNavAcordos) bottomNavAcordos.classList.add('hidden');
                if (bottomNavLar)     bottomNavLar.classList.add('hidden');

                if (txAbasContainer) txAbasContainer.classList.add('hidden');
                if (txSubtitulo)     txSubtitulo.innerText = 'Acompanhe suas entradas e saídas pessoais';

                if (tabPlanoLar)      tabPlanoLar.classList.add('hidden');
                if (painelPlanoLar)   painelPlanoLar.classList.add('hidden');
                if (btnFiltroProdLar) btnFiltroProdLar.classList.add('hidden');

                if (larCardBloqueio)      larCardBloqueio.classList.remove('hidden');
                if (larConteudo)          larConteudo.classList.add('hidden');
                if (acordosCardBloqueio)  acordosCardBloqueio.classList.remove('hidden');
                if (acordosConteudo)      acordosConteudo.classList.add('hidden');
                if (cobradorCardBloqueio) cobradorCardBloqueio.classList.remove('hidden');
                if (cobradorConteudo)     cobradorConteudo.classList.add('hidden');

                // Garante aba de renda ativa
                alternarAbaHero('renda');
            } else {
                // Casal: garantir visibilidade
                if (tabLar)        tabLar.classList.remove('hidden');
                if (tabsContainer) tabsContainer.classList.remove('hidden');
                if (sliderNav)     sliderNav.classList.remove('hidden');
                if (sliderDotLar)  sliderDotLar.classList.remove('hidden');
                if (sliderDica)    sliderDica.innerText = 'Arraste para o lado para ver o Custo do Lar';
                if (heroTituloSec) heroTituloSec.innerText = `Seu mês de ${data.hero_mes?.mes_nome || 'novembro'}`;
                if (secaoLarSide)  secaoLarSide.classList.remove('hidden');

                if (bottomNavAcordos) bottomNavAcordos.classList.remove('hidden');
                if (bottomNavLar)     bottomNavLar.classList.remove('hidden');

                if (txAbasContainer) txAbasContainer.classList.remove('hidden');
                if (txSubtitulo)     txSubtitulo.innerText = 'Acompanhe suas entradas, saídas e divisão do lar';

                if (tabPlanoLar)      tabPlanoLar.classList.remove('hidden');
                if (btnFiltroProdLar) btnFiltroProdLar.classList.remove('hidden');

                if (larCardBloqueio)      larCardBloqueio.classList.add('hidden');
                if (larConteudo)          larConteudo.classList.remove('hidden');
                if (acordosCardBloqueio)  acordosCardBloqueio.classList.add('hidden');
                if (acordosConteudo)      acordosConteudo.classList.remove('hidden');
                if (cobradorCardBloqueio) cobradorCardBloqueio.classList.add('hidden');
                if (cobradorConteudo)     cobradorConteudo.classList.remove('hidden');
            }

            // — Atualizar fontes de renda no hero card —
            const pillsFontes = document.getElementById('heroRendaPillsFontes');
            if (pillsFontes && data.hero_mes?.minha_renda?.fontes?.length) {
                const fontes = data.hero_mes.minha_renda.fontes;
                pillsFontes.innerHTML = `
                    <span class="inline-flex items-center gap-1 rounded-lg bg-white/10 px-2.5 py-1 text-gray-200 font-medium">
                        <i data-lucide="calendar" class="size-3"></i> ${data.hero_mes.mes_nome} ${data.hero_mes.ano}
                    </span>
                    ${fontes.map(f => `<span class="rounded-lg bg-white/10 px-2.5 py-1 text-gray-200 font-medium">${f.nome} ${BRL(f.valor)}</span>`).join('')}
                `;
            }

            // — Saúde Financeira Dupla: Individual vs Casal / Lar —
            cacheSaudeIndiv = data.saude_financeira_individual || data.saude_financeira || null;
            cacheSaudeLar = data.saude_financeira_lar || null;

            const toggleContainer = document.getElementById('dashSaudeToggleContainer');
            if (toggleContainer) {
                if (data.is_casal && cacheSaudeLar) {
                    toggleContainer.classList.remove('hidden');
                } else {
                    toggleContainer.classList.add('hidden');
                    visaoSaudeDashAtiva = 'individual';
                }
            }

            atualizarCardSaudeDashboard();

            // — Pra registrar hoje (Alerta harmonioso e botões integrados) —
            const secaoPraReg = document.getElementById('dashPraRegistrarHojeList');
            if (secaoPraReg) {
                const itens = data.pra_registrar_hoje || [];
                if (!itens.length) {
                    secaoPraReg.innerHTML = `
                        <div class="flex items-center gap-3 p-3.5 rounded-2xl bg-amber-50/80 dark:bg-amber-950/30 border border-amber-200/80 text-xs text-amber-900 dark:text-amber-200 font-medium">
                            <i data-lucide="check-circle-2" class="size-4 text-emerald-600 shrink-0"></i>
                            <span>Tudo em dia! Nenhuma conta pendente por aqui.</span>
                        </div>`;
                } else {
                    secaoPraReg.innerHTML = itens.map(item => {
                        const isFatura = item.tipo === 'fatura';
                        const iconeCor = isFatura ? 'bg-purple-100 dark:bg-purple-950/60 text-purple-700 dark:text-purple-300' : 'bg-blue-100 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300';
                        return `
                        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-card border border-amber-200/90 dark:border-amber-800/50 shadow-2xs hover:border-amber-300 transition">
                            <div class="flex items-center gap-3 min-w-0">
                                <span class="size-9 rounded-xl ${iconeCor} flex items-center justify-center shrink-0">
                                    <i data-lucide="${item.icone || 'credit-card'}" class="size-4"></i>
                                </span>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-extrabold text-foreground truncate max-w-[150px] sm:max-w-xs">${item.titulo} · ${BRL(item.valor)}</h4>
                                    <p class="text-[11px] text-muted-foreground truncate max-w-[170px] sm:max-w-sm">${item.descricao}</p>
                                </div>
                            </div>
                            <button type="button" onclick="abrirModalRegistrarPagamento('${item.id}')"
                                    class="px-4 py-2 rounded-xl bg-[#1b4d37] hover:bg-[#153f2c] text-white font-bold text-xs transition shadow-soft flex items-center gap-1.5 shrink-0">
                                <i data-lucide="check" class="size-3.5"></i>
                                <span>Registrar</span>
                            </button>
                        </div>`;
                    }).join('');
                }
            }

            // — Metas —
            const metasGrid = document.getElementById('dashMetasGrid');
            if (metasGrid) {
                const metas = data.metas || [];
                if (!metas.length) {
                    metasGrid.innerHTML = `<p class="text-xs text-muted-foreground col-span-2 py-4 text-center">Nenhuma meta ativa. Crie sua primeira meta!</p>`;
                } else {
                    metasGrid.innerHTML = metas.map(m => {
                        const pct = m.percentual || 0;
                        const isLar = m.tipo === 'Do Lar';
                        const badgeCls = isLar ? 'bg-emerald-100 text-emerald-800' : 'bg-muted text-muted-foreground';
                        const ico = m.icone || 'target';
                        return `
                        <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="size-8 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                                        <i data-lucide="${ico}" class="size-4"></i>
                                    </span>
                                    <h4 class="text-xs font-bold text-foreground">${m.nome}</h4>
                                </div>
                                <span class="rounded-full px-2 py-0.5 text-[10px] font-bold ${badgeCls}">${m.tipo}</span>
                            </div>
                            <div class="space-y-1">
                                <div class="h-2.5 w-full rounded-full bg-muted overflow-hidden">
                                    <div class="h-full bg-emerald-600 rounded-full transition-all" style="width: ${Math.min(100, pct)}%"></div>
                                </div>
                                <div class="flex items-center justify-between text-xs font-extrabold text-foreground pt-0.5">
                                    <span>${BRL(m.atual)} de ${BRL(m.total)}</span>
                                    <span class="text-emerald-700">${pct}%</span>
                                </div>
                            </div>
                            <p class="text-[11px] text-muted-foreground flex items-center gap-1">
                                <i data-lucide="piggy-bank" class="size-3 text-primary"></i> ${m.onde}
                            </p>
                        </div>`;
                    }).join('');
                }
            }

            // — Despesas Fixas (Carrossel Horizontal com Drag & Sem Emojis) —
            const despFixasGrid = document.getElementById('dashDespesasFixasGrid');
            if (despFixasGrid) {
                const fixas = data.despesas_fixas || [];
                if (!fixas.length) {
                    despFixasGrid.innerHTML = `<p class="text-xs text-muted-foreground py-4 text-center w-full">Nenhuma despesa fixa registrada.</p>`;
                } else {
                    despFixasGrid.innerHTML = fixas.map(df => {
                        const isAviso = df.tipo === 'aviso';
                        const isPago = df.tipo === 'pago';
                        const badgeCls = isAviso 
                            ? 'bg-amber-500/10 text-amber-700 border-amber-300/40' 
                            : (isPago ? 'bg-emerald-500/10 text-emerald-700 border-emerald-300/40' : 'bg-muted text-muted-foreground border-border');
                        const badgeIcone = isAviso ? 'alert-triangle' : (isPago ? 'check' : 'clock');

                        return `
                        <div class="w-[240px] sm:w-[260px] shrink-0 snap-start rounded-2xl border border-border bg-card p-4 shadow-soft space-y-2 hover:border-emerald-500/30 transition">
                            <div class="flex items-center justify-between">
                                <span class="size-7 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center">
                                    <i data-lucide="${df.icone || 'receipt'}" class="size-3.5"></i>
                                </span>
                                <span class="inline-flex items-center gap-1 rounded-md px-1.5 py-0.5 text-[10px] font-bold border ${badgeCls}">
                                    <i data-lucide="${badgeIcone}" class="size-3"></i>
                                    <span>${df.status}</span>
                                </span>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-foreground truncate">${df.titulo}</h4>
                                <strong class="text-base font-extrabold text-foreground">${BRL(df.valor)}</strong>
                                <span class="text-[10px] text-muted-foreground block mt-0.5">${df.vencimento}</span>
                            </div>
                        </div>`;
                    }).join('');
                    habilitarArrastarScroll('dashDespesasFixasGrid');
                }
            }

            // — Fluxo dos 2 meses (atualizar alturas das barras) —
            const fluxo = data.fluxo_meses;
            if (fluxo && fluxo.length >= 2) {
                const maxVal = Math.max(fluxo[0].entradas, fluxo[0].saidas, fluxo[1].entradas, fluxo[1].saidas, 1);
                const pct = (v) => Math.max(8, Math.round((v / maxVal) * 100));

                // Mês 1 (passado)
                const bars = document.querySelectorAll('#pane-dashboard .flex.items-end.justify-center.gap-12 .flex.flex-col.items-center.gap-2');
                if (bars.length >= 2) {
                    const b0 = bars[0].querySelector('.flex.items-end');
                    const b1 = bars[1].querySelector('.flex.items-end');
                    if (b0) {
                        const divs0 = b0.querySelectorAll('div');
                        if (divs0[0]) divs0[0].style.height = pct(fluxo[0].entradas) + '%';
                        if (divs0[1]) divs0[1].style.height = pct(fluxo[0].saidas) + '%';
                    }
                    if (b1) {
                        const divs1 = b1.querySelectorAll('div');
                        if (divs1[0]) divs1[0].style.height = pct(fluxo[1].entradas) + '%';
                        if (divs1[1]) divs1[1].style.height = pct(fluxo[1].saidas) + '%';
                    }
                    // Labels dos meses
                    const labels = document.querySelectorAll('#pane-dashboard .flex.items-end.justify-center.gap-12 span.text-xs');
                    if (labels[0]) labels[0].innerText = fluxo[0].mes;
                    if (labels[1]) labels[1].innerText = fluxo[1].mes;

                    // Sub-título do card
                    const subFluxo = document.querySelector('#pane-dashboard .flex.items-center.justify-between p.text-xs.text-muted-foreground');
                    if (subFluxo) subFluxo.innerText = `${fluxo[0].mes} e ${fluxo[1].mes} · entradas vs. saídas`;
                }
            }

            // — Seção Hero: título mês —
            if (heroTituloSec && isCasal) {
                heroTituloSec.innerText = `Seu mês de ${data.hero_mes?.mes_nome || 'novembro'}`;
            }

            // — Badge de notificações no sino da topbar —
            const topbarBadge = document.getElementById('topbarBadgeNotif');
            if (topbarBadge) {
                fetch('/api/notificacoes', { headers: { 'Accept': 'application/json' } })
                    .then(r => r.ok ? r.json() : null)
                    .then(nd => {
                        const count = nd?.total_nao_lidas || 0;
                        if (count > 0) {
                            topbarBadge.innerText = count > 9 ? '9+' : count;
                            topbarBadge.classList.remove('hidden');
                            topbarBadge.classList.add('flex');
                        } else {
                            topbarBadge.classList.add('hidden');
                            topbarBadge.classList.remove('flex');
                        }
                    }).catch(() => {});
            }

            lucide.createIcons();
        }

        // ── ESTADO E FUNÇÕES DO NOVO DASHBOARD SEIVA (PROTÓTIPO DE 10 TELAS) ──
        let dashboardDadosCache = null;
        let modoGraficoAtual = 'barras';
        let donutMesSelecionado = 'atual';
        let contaAjusteSaldoId = null;
        let itemPagamentoAtual = null;
        let contaSaidaPagamentoId = null;
        let comprovantePagamentoBase64 = null;
        let categoriaGastoAtual = 'Moradia';
        let contaGastoAtual = null;
        let visibilidadeGastoAtual = 'privado';
        let tipoRecebimentoAtual = 'Salário';
        let contaRecebimentoAtual = null;

        // 1. Expansão "Minha Renda" (Imagem 1)
        function alternarExpansaoHeroRenda() {
            const exp = document.getElementById('heroRendaExpansivel');
            const ico = document.getElementById('iconeChevronHeroRenda');
            if (!exp) return;
            const abrindo = exp.classList.contains('hidden');
            exp.classList.toggle('hidden');
            if (ico) {
                ico.classList.toggle('rotate-180', abrindo);
            }
            if (abrindo) {
                renderizarDetalhesMinhaRenda();
            }
        }

        function renderizarDetalhesMinhaRenda() {
            if (!dashboardDadosCache) return;
            const d = dashboardDadosCache.detalhes_minha_renda;
            if (!d) return;

            // Barra multicolorida
            const barraContainer = document.getElementById('heroRendaBarraContainer');
            if (barraContainer && d.barra?.length) {
                barraContainer.innerHTML = d.barra.map(item => `
                    <div style="width: ${Math.max(4, item.percentual)}%; background-color: ${item.cor}; height: 100%;" 
                         class="transition-all duration-500 hover:opacity-90"
                         title="${item.nome}: ${BRL(item.valor)} (${item.percentual}%)"></div>
                `).join('');
            }

            // Legenda
            const legendaContainer = document.getElementById('heroRendaLegenda');
            if (legendaContainer && d.barra?.length) {
                legendaContainer.innerHTML = d.barra.map(item => `
                    <div class="flex items-center gap-2">
                        <span class="size-2 rounded-full shrink-0" style="background-color: ${item.cor}"></span>
                        <div class="min-w-0">
                            <p class="font-medium text-gray-300 leading-tight truncate text-[11px]">${item.nome}</p>
                            <strong class="font-extrabold text-white text-xs">${saldosVisiveis ? BRL(item.valor) : '••••'}</strong>
                        </div>
                    </div>
                `).join('');
            }

            // Como ler isso
            const comoLerLista = document.getElementById('heroRendaComoLerLista');
            if (comoLerLista && d.como_ler?.length) {
                comoLerLista.innerHTML = d.como_ler.map(txt => `
                    <li class="flex items-start gap-1.5 leading-relaxed">
                        <span class="text-emerald-400 font-bold select-none">•</span>
                        <span>${txt}</span>
                    </li>
                `).join('');
            }
        }

        // 2. Expansão "Custo do Lar" (Imagem 2)
        function alternarExpansaoHeroLar() {
            const exp = document.getElementById('heroLarExpansivel');
            const ico = document.getElementById('iconeChevronHeroLar');
            if (!exp) return;
            const abrindo = exp.classList.contains('hidden');
            exp.classList.toggle('hidden');
            if (ico) {
                ico.classList.toggle('rotate-180', abrindo);
            }
            if (abrindo) {
                renderizarDetalhesCustoLar();
            }
        }

        function renderizarDetalhesCustoLar() {
            if (!dashboardDadosCache) return;
            const d = dashboardDadosCache.detalhes_custo_lar;
            if (!d) return;

            // Lista de despesas do Lar com status e cotas
            const listaDesp = document.getElementById('heroLarListaDespesas');
            if (listaDesp && d.itens?.length) {
                listaDesp.innerHTML = d.itens.map(item => `
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-white/10 border border-white/10 text-xs">
                        <div class="flex items-center gap-2.5">
                            <span class="size-7 rounded-xl bg-white/15 flex items-center justify-center shrink-0 text-emerald-200">
                                <i data-lucide="${item.icone || 'home'}" class="size-3.5"></i>
                            </span>
                            <span class="font-medium text-white">${item.titulo}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full ${item.pago ? 'bg-emerald-400/20 text-emerald-300' : 'bg-white/10 text-emerald-200'}">
                                ${item.pago ? '✓ pago' : 'a pagar'}
                            </span>
                            <strong class="font-bold text-white">${saldosVisiveis ? BRL(item.valor) : '••••'}</strong>
                        </div>
                    </div>
                `).join('');
            }

            // Resumo do parceiro
            const resumoParc = document.getElementById('heroLarParceiroResumo');
            if (resumoParc && d.parceiro) {
                resumoParc.innerHTML = `
                    <div class="flex items-center gap-2">
                        <span class="size-6 rounded-full bg-white/20 flex items-center justify-center text-[10px] font-black text-white">
                            ${d.parceiro.nome.substring(0, 2).toUpperCase()}
                        </span>
                        <span class="text-emerald-100 font-medium">
                            ${d.parceiro.nome} contribui com ${d.parceiro.percentual}%
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        <strong class="font-extrabold text-white">${saldosVisiveis ? BRL(d.parceiro.valor) : '••••'}</strong>
                        <span class="text-[10px] font-bold text-emerald-300 bg-white/15 px-2 py-0.5 rounded-full">✓ ${d.parceiro.status}</span>
                    </div>
                `;
            }

            lucide.createIcons();
        }

        // 3. Toggle de Gráfico: Barras vs Donut / Pizza (Imagens 7 e 8)
        function alternarModoGrafico(modo) {
            modoGraficoAtual = modo;
            const containerBarras = document.getElementById('graficoBarrasContainer');
            const containerDonut = document.getElementById('graficoDonutContainer');
            const btnBarras = document.getElementById('btnToggleGraficoBarras');
            const btnDonut = document.getElementById('btnToggleGraficoDonut');
            const titulo = document.getElementById('tituloGraficoDashboard');
            const subtitulo = document.getElementById('subtituloGraficoDashboard');

            if (modo === 'barras') {
                if (containerBarras) containerBarras.classList.remove('hidden');
                if (containerDonut) containerDonut.classList.add('hidden');
                if (btnBarras) {
                    btnBarras.className = 'p-1.5 rounded-lg font-bold text-xs transition-all bg-card text-foreground shadow-2xs';
                }
                if (btnDonut) {
                    btnDonut.className = 'p-1.5 rounded-lg font-bold text-xs transition-all text-muted-foreground hover:text-foreground';
                }
                if (titulo) titulo.innerText = 'Fluxo dos 2 meses no SEIVA';
                if (subtitulo) {
                    const m0 = dashboardDadosCache?.fluxo_meses?.[0]?.mes || 'Maio';
                    const m1 = dashboardDadosCache?.fluxo_meses?.[1]?.mes || 'Junho';
                    subtitulo.innerText = `${m0} e ${m1} · entradas vs. saídas`;
                }
            } else {
                if (containerBarras) containerBarras.classList.add('hidden');
                if (containerDonut) containerDonut.classList.remove('hidden');
                if (btnDonut) {
                    btnDonut.className = 'p-1.5 rounded-lg font-bold text-xs transition-all bg-card text-foreground shadow-2xs';
                }
                if (btnBarras) {
                    btnBarras.className = 'p-1.5 rounded-lg font-bold text-xs transition-all text-muted-foreground hover:text-foreground';
                }
                if (titulo) titulo.innerText = 'Gastos por categoria';
                if (subtitulo) {
                    const mesNome = donutMesSelecionado === 'atual' 
                        ? (dashboardDadosCache?.gastos_por_categoria?.mes_atual?.nome_mes || 'Junho') 
                        : (dashboardDadosCache?.gastos_por_categoria?.mes_passado?.nome_mes || 'Maio');
                    subtitulo.innerText = `${mesNome} · onde foi seu dinheiro`;
                }
                renderizarDonutCategorias();
            }
        }

        function selecionarMesDonut(tipo) {
            donutMesSelecionado = tipo;
            const btnAtual = document.getElementById('btnDonutMesAtual');
            const btnPassado = document.getElementById('btnDonutMesPassado');
            if (tipo === 'atual') {
                if (btnAtual) btnAtual.className = 'py-1.5 px-4 rounded-xl font-bold text-xs transition-all bg-card text-foreground shadow-2xs';
                if (btnPassado) btnPassado.className = 'py-1.5 px-4 rounded-xl font-bold text-xs transition-all text-muted-foreground hover:text-foreground';
            } else {
                if (btnPassado) btnPassado.className = 'py-1.5 px-4 rounded-xl font-bold text-xs transition-all bg-card text-foreground shadow-2xs';
                if (btnAtual) btnAtual.className = 'py-1.5 px-4 rounded-xl font-bold text-xs transition-all text-muted-foreground hover:text-foreground';
            }
            const subtitulo = document.getElementById('subtituloGraficoDashboard');
            if (subtitulo) {
                const mesNome = tipo === 'atual' 
                    ? (dashboardDadosCache?.gastos_por_categoria?.mes_atual?.nome_mes || 'Junho') 
                    : (dashboardDadosCache?.gastos_por_categoria?.mes_passado?.nome_mes || 'Maio');
                subtitulo.innerText = `${mesNome} · onde foi seu dinheiro`;
            }
            renderizarDonutCategorias();
        }

        function renderizarDonutCategorias() {
            if (!dashboardDadosCache?.gastos_por_categoria) return;
            const dadosMes = dashboardDadosCache.gastos_por_categoria[donutMesSelecionado === 'atual' ? 'mes_atual' : 'mes_passado'];
            if (!dadosMes) return;

            // Labels dos botões com o nome do mês real
            const btnAtual = document.getElementById('btnDonutMesAtual');
            const btnPassado = document.getElementById('btnDonutMesPassado');
            if (btnAtual && dashboardDadosCache.gastos_por_categoria.mes_atual?.nome_mes) {
                btnAtual.innerText = dashboardDadosCache.gastos_por_categoria.mes_atual.nome_mes;
            }
            if (btnPassado && dashboardDadosCache.gastos_por_categoria.mes_passado?.nome_mes) {
                btnPassado.innerText = dashboardDadosCache.gastos_por_categoria.mes_passado.nome_mes;
            }

            // Centro do Donut
            const rotuloMes = document.getElementById('donutRotuloMes');
            const totalMes = document.getElementById('donutTotalMesValor');
            if (rotuloMes) rotuloMes.innerText = `Total ${dadosMes.nome_mes}`;
            if (totalMes) totalMes.innerText = saldosVisiveis ? BRL(dadosMes.total) : '••••';

            // SVG Donut (Circunferência 251.327)
            const svgEl = document.getElementById('svgDonutCategorias');
            if (svgEl && dadosMes.categorias?.length) {
                const C = 251.327;
                let offsetAcumulado = 0;
                let svgContent = '';

                dadosMes.categorias.forEach(cat => {
                    const strokeLen = (cat.percentual / 100) * C;
                    const strokeGap = C - strokeLen;
                    svgContent += `
                        <circle cx="50" cy="50" r="40" fill="none" stroke="${cat.cor}" stroke-width="12"
                                stroke-dasharray="${strokeLen.toFixed(2)} ${strokeGap.toFixed(2)}"
                                stroke-dashoffset="${(-offsetAcumulado).toFixed(2)}"
                                class="transition-all duration-500 hover:opacity-80">
                            <title>${cat.nome}: ${BRL(cat.valor)} (${cat.percentual}%)</title>
                        </circle>
                    `;
                    offsetAcumulado += strokeLen;
                });
                svgEl.innerHTML = svgContent;
            }

            // Lista lateral de categorias com percentuais
            const listaCats = document.getElementById('donutListaCategorias');
            if (listaCats && dadosMes.categorias?.length) {
                listaCats.innerHTML = dadosMes.categorias.map(cat => `
                    <div class="flex items-center justify-between p-2 rounded-xl hover:bg-muted/40 transition text-xs">
                        <div class="flex items-center gap-2.5">
                            <span class="size-2.5 rounded-full shrink-0" style="background-color: ${cat.cor}"></span>
                            <span class="font-medium text-foreground">${cat.nome}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-[11px] font-bold text-muted-foreground">${cat.percentual}%</span>
                            <strong class="font-extrabold text-foreground">${saldosVisiveis ? BRL(cat.valor) : '••••'}</strong>
                        </div>
                    </div>
                `).join('');
            }
        }

        // 3.1 Ação Rápida: Abrir Relatórios com Scroll Suave e Foco
        function abrirRelatoriosRapido() {
            alternarModoGrafico('donut');
            const el = document.getElementById('secaoRelatoriosFluxo');
            if (el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                el.classList.add('ring-2', 'ring-emerald-500', 'ring-offset-4');
                setTimeout(() => {
                    el.classList.remove('ring-2', 'ring-emerald-500', 'ring-offset-4');
                }, 2000);
            }
        }

        // 3.2 Navegação e Scroll Arrastável (Drag & Swipe) para Carrosséis
        function scrollCarrossel(id, offset) {
            const el = document.getElementById(id);
            if (el) {
                el.scrollBy({ left: offset, behavior: 'smooth' });
            }
        }

        function habilitarArrastarScroll(elementId) {
            const slider = document.getElementById(elementId);
            if (!slider || slider.dataset.dragAtivo === "true") return;
            slider.dataset.dragAtivo = "true";

            let isDown = false;
            let startX = 0;
            let scrollLeft = 0;

            slider.addEventListener('mousedown', (e) => {
                isDown = true;
                slider.classList.add('cursor-grabbing');
                slider.classList.remove('cursor-grab');
                startX = e.pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
            });

            slider.addEventListener('mouseleave', () => {
                isDown = false;
                slider.classList.remove('cursor-grabbing');
                slider.classList.add('cursor-grab');
            });

            slider.addEventListener('mouseup', () => {
                isDown = false;
                slider.classList.remove('cursor-grabbing');
                slider.classList.add('cursor-grab');
            });

            slider.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - slider.offsetLeft;
                const walk = (x - startX) * 1.5;
                slider.scrollLeft = scrollLeft - walk;
            });
        }

        // 3.3 Personalização de Ícone e Categoria de Transação (Modal Dinâmico)
        let modalIconeTxId = null;
        let modalIconeCategoriaId = null;
        let modalIconeSelecionado = 'credit-card';

        function abrirModalPersonalizarIcone(txId, titulo, categoriaId, iconeAtual) {
            modalIconeTxId = txId;
            modalIconeCategoriaId = categoriaId;
            modalIconeSelecionado = iconeAtual || 'credit-card';

            const txNomeEl = document.getElementById('modalIconeTxNome');
            if (txNomeEl) txNomeEl.innerText = titulo || 'Transação';

            const previewIcone = document.getElementById('modalIconePreviewIcon');
            if (previewIcone) {
                previewIcone.innerHTML = `<i data-lucide="${modalIconeSelecionado}" class="size-6 text-emerald-700"></i>`;
            }

            selecionarCategoriaModalTx(categoriaId, false);
            selecionarIconeModalTx(modalIconeSelecionado, false);

            document.getElementById('modalPersonalizarIconeTransacao')?.classList.remove('hidden');
            lucide.createIcons();
        }

        function fecharModalPersonalizarIcone() {
            document.getElementById('modalPersonalizarIconeTransacao')?.classList.add('hidden');
        }

        function selecionarCategoriaModalTx(catId, atualizarIconeAuto = true) {
            modalIconeCategoriaId = catId;
            document.querySelectorAll('.btn-cat-opcao-tx').forEach(btn => {
                if (btn.dataset.catId == catId) {
                    btn.className = 'btn-cat-opcao-tx flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-emerald-600 bg-emerald-50 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 text-xs font-black shadow-2xs transition';
                    if (atualizarIconeAuto && btn.dataset.catIcone) {
                        selecionarIconeModalTx(btn.dataset.catIcone, false);
                    }
                } else {
                    btn.className = 'btn-cat-opcao-tx flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground text-xs font-medium transition';
                }
            });
        }

        function selecionarIconeModalTx(iconeNome, feedback = true) {
            modalIconeSelecionado = iconeNome;
            document.querySelectorAll('.btn-icone-opcao-tx').forEach(btn => {
                if (btn.dataset.icone === iconeNome) {
                    btn.className = 'btn-icone-opcao-tx size-11 rounded-2xl border-2 border-emerald-600 bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 flex items-center justify-center transition shadow-2xs scale-105';
                } else {
                    btn.className = 'btn-icone-opcao-tx size-11 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground hover:border-emerald-500/30 flex items-center justify-center transition';
                }
            });

            const previewIcone = document.getElementById('modalIconePreviewIcon');
            if (previewIcone) {
                previewIcone.innerHTML = `<i data-lucide="${iconeNome}" class="size-6 text-emerald-700"></i>`;
                lucide.createIcons();
            }
        }

        async function executarSalvarIconeTransacao(e) {
            if (e && e.preventDefault) e.preventDefault();
            if (!modalIconeTxId) return;

            try {
                const res = await fetch(`/api/transacoes/${modalIconeTxId}/icone`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({
                        icone: modalIconeSelecionado,
                        categoria_id: modalIconeCategoriaId
                    })
                });

                const data = await res.json();
                if (res.ok) {
                    seivaNotificar('Ícone e categoria salvos com sucesso!', 'sucesso', 'Personalização');
                    fecharModalPersonalizarIcone();
                    carregarDashboardDados();
                    if (typeof carregarExtratoDados === 'function') carregarExtratoDados();
                } else {
                    seivaNotificar(data.error || 'Não foi possível salvar.', 'erro');
                }
            } catch (err) {
                console.error('Erro ao salvar ícone da transação:', err);
                seivaNotificar('Erro de conexão ao salvar personalização.', 'erro');
            }
        }

        // 4. Modal Atualizar Saldo (Imagem 3)
        function abrirModalAtualizarSaldo(contaId = null) {
            const contas = dashboardDadosCache?.contas || listaContas || [];
            const containerChips = document.getElementById('modalSaldoChipsContas');
            if (containerChips && contas.length) {
                let contaAlvo = contaId ? contas.find(c => String(c.id_conta) === String(contaId)) : null;
                if (!contaAlvo) contaAlvo = contas[0];
                contaAjusteSaldoId = contaAlvo.id_conta;

                containerChips.innerHTML = contas.map(c => `
                    <button type="button" onclick="selecionarContaAjusteSaldo(${c.id_conta}, '${c.nome.replace(/'/g, "\\'")}', ${c.saldo})" 
                            id="chipSaldoConta_${c.id_conta}"
                            class="chip-conta-saldo flex items-center gap-1.5 px-3 py-1.5 rounded-xl border text-xs font-bold transition ${String(c.id_conta) === String(contaAlvo.id_conta) ? 'border-emerald-600 bg-emerald-50 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300' : 'border-border bg-card text-muted-foreground hover:text-foreground'}">
                        <span class="size-2 rounded-full" style="background-color: ${c.cor || '#10b981'}"></span>
                        <span>${c.nome}</span>
                    </button>
                `).join('');
                selecionarContaAjusteSaldo(contaAlvo.id_conta, contaAlvo.nome, contaAlvo.saldo);
            }
            document.getElementById('modalAtualizarSaldo')?.classList.remove('hidden');
            lucide.createIcons();
        }

        function selecionarContaAjusteSaldo(id, nome, saldo) {
            contaAjusteSaldoId = id;
            document.querySelectorAll('.chip-conta-saldo').forEach(btn => {
                if (btn.innerText.includes(nome)) {
                    btn.className = 'chip-conta-saldo flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-emerald-600 bg-emerald-50 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 text-xs font-bold transition';
                } else {
                    btn.className = 'chip-conta-saldo flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground text-xs font-bold transition';
                }
            });
            const inputVal = document.getElementById('modalSaldoInputValor');
            if (inputVal) inputVal.value = (parseFloat(saldo) || 0).toFixed(2).replace('.', ',');
            const textoReg = document.getElementById('modalSaldoRegistradoTexto');
            if (textoReg) textoReg.innerText = `Saldo registrado: ${BRL(saldo)}`;
            const btnSalvar = document.getElementById('modalSaldoBtnSalvarTexto');
            if (btnSalvar) btnSalvar.innerText = `Salvar saldo de ${nome}`;
        }

        function aplicarAjusteRapidoSaldo(delta, motivo) {
            const inputVal = document.getElementById('modalSaldoInputValor');
            if (!inputVal) return;
            let val = parseFloat(inputVal.value.replace(/\./g, '').replace(',', '.')) || 0;
            val = Math.max(0, val + delta);
            inputVal.value = val.toFixed(2).replace('.', ',');
            seivaNotificar(`${delta > 0 ? '+' : ''}${BRL(delta)} (${motivo}) aplicado!`, 'info', 'Ajuste Rápido');
        }

        async function salvarNovoSaldoConta() {
            if (!contaAjusteSaldoId) return;
            const inputVal = document.getElementById('modalSaldoInputValor');
            const novoSaldo = parseFloat(inputVal.value.replace(/\./g, '').replace(',', '.'));
            if (isNaN(novoSaldo) || novoSaldo < 0) {
                return seivaNotificar('Informe um saldo válido.', 'aviso', 'Valor inválido');
            }

            try {
                const res = await fetch(`/api/contas/${contaAjusteSaldoId}/saldo`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ saldo: novoSaldo, motivo: 'Atualização rápida de saldo' })
                });
                if (res.ok) {
                    fecharModalId('modalAtualizarSaldo');
                    seivaNotificar('Saldo atualizado com sucesso!', 'sucesso', 'Saldo Atualizado');
                    carregarDashboardDados();
                } else {
                    const err = await res.json();
                    seivaNotificar(err.erro || 'Não foi possível atualizar o saldo.', 'erro');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão ao atualizar saldo.', 'erro');
            }
        }

        // 5. Modal Saúde Financeira (Dupla: Individual vs Casal / Lar)
        let modalSaudeAbaAtiva = 'individual';

        function alternarAbaModalSaude(tipo) {
            modalSaudeAbaAtiva = tipo;
            const btnIndiv = document.getElementById('modalSaudeBtnIndiv');
            const btnLar = document.getElementById('modalSaudeBtnLar');
            const linkMetodologia = document.getElementById('modalSaudeLinkMetodologiaLar');
            const titHeader = document.getElementById('modalSaudeHeaderTitulo');

            const isLar = (tipo === 'lar');
            const dados = isLar 
                ? (dashboardDadosCache?.saude_financeira_lar || cacheSaudeLar) 
                : (dashboardDadosCache?.saude_financeira_individual || dashboardDadosCache?.saude_financeira || cacheSaudeIndiv);

            if (btnIndiv && btnLar) {
                if (isLar) {
                    btnLar.className = 'py-2 px-3 rounded-xl text-xs font-bold transition shadow-2xs bg-card text-foreground flex items-center justify-center gap-1.5 cursor-pointer';
                    btnLar.querySelector('i')?.setAttribute('class', 'size-3.5 text-emerald-600');
                    btnIndiv.className = 'py-2 px-3 rounded-xl text-xs font-bold transition text-muted-foreground hover:text-foreground flex items-center justify-center gap-1.5 cursor-pointer';
                    btnIndiv.querySelector('i')?.setAttribute('class', 'size-3.5 text-muted-foreground');
                } else {
                    btnIndiv.className = 'py-2 px-3 rounded-xl text-xs font-bold transition shadow-2xs bg-card text-foreground flex items-center justify-center gap-1.5 cursor-pointer';
                    btnIndiv.querySelector('i')?.setAttribute('class', 'size-3.5 text-emerald-600');
                    btnLar.className = 'py-2 px-3 rounded-xl text-xs font-bold transition text-muted-foreground hover:text-foreground flex items-center justify-center gap-1.5 cursor-pointer';
                    btnLar.querySelector('i')?.setAttribute('class', 'size-3.5 text-muted-foreground');
                }
            }

            if (linkMetodologia) {
                if (isLar) linkMetodologia.classList.remove('hidden');
                else linkMetodologia.classList.add('hidden');
            }

            if (titHeader) {
                titHeader.innerText = isLar ? 'Saúde financeira do Nosso Lar' : 'Sua saúde financeira individual';
            }

            if (dados) {
                const score = dados.score || 0;
                const status = dados.status || 'Saudável';
                const scoreTxt = document.getElementById('modalSaudeScoreTxt');
                const statusTxt = document.getElementById('modalSaudeStatusTxt');
                const notaTxt = document.getElementById('modalSaudeNotaTxt');
                const circle = document.getElementById('modalSaudeCircleProgress');
                const bannerBox = document.getElementById('modalSaudeBannerBox');

                if (scoreTxt) scoreTxt.innerText = `${score}%`;
                if (statusTxt) {
                    statusTxt.innerText = status;
                    statusTxt.className = `text-xs font-bold ${score >= 80 ? 'text-emerald-600' : (score >= 60 ? 'text-amber-600' : 'text-rose-600')}`;
                }
                if (notaTxt) {
                    notaTxt.innerText = isLar
                        ? `O score do Lar é ${score}% — ${status.toLowerCase()} ao equilíbrio. Veja o que compõe essa nota:`
                        : `Seu score é ${score}% — ${status.toLowerCase()} ao equilíbrio. Veja o que compõe essa nota:`;
                }
                if (bannerBox) {
                    bannerBox.className = `p-3.5 rounded-2xl border text-xs font-extrabold text-center shadow-2xs transition-colors ${
                        score >= 80 
                            ? 'border-emerald-300/80 bg-emerald-50 dark:bg-emerald-950/50 text-emerald-950 dark:text-emerald-100' 
                            : (score >= 60 
                                ? 'border-amber-300/80 bg-amber-50 dark:bg-amber-950/50 text-amber-950 dark:text-amber-100' 
                                : 'border-rose-300/80 bg-rose-50 dark:bg-rose-950/50 text-rose-950 dark:text-rose-100')
                    }`;
                }
                if (circle) {
                    const C = 251.2;
                    const offset = C - (score / 100) * C;
                    circle.setAttribute('stroke-dashoffset', Math.round(offset));
                    circle.setAttribute('stroke', score >= 80 ? '#10b981' : (score >= 60 ? '#f59e0b' : '#ef4444'));
                }

                // Nomes dos Pilares e Insights (Sem Emojis)
                const p1Nome = document.getElementById('modalSaudePilar1Nome');
                const p2Nome = document.getElementById('modalSaudePilar2Nome');
                const p3Nome = document.getElementById('modalSaudePilar3Nome');
                const p1Txt = document.getElementById('modalSaudePilar1Titulo');
                const p2Txt = document.getElementById('modalSaudePilar2Titulo');
                const p3Txt = document.getElementById('modalSaudePilar3Titulo');
                const p1Desc = document.getElementById('modalSaudePilar1DescTxt');
                const p2Desc = document.getElementById('modalSaudePilar2DescTxt');
                const p3Desc = document.getElementById('modalSaudePilar3DescTxt');

                if (isLar) {
                    if (p1Nome) p1Nome.innerText = 'Custo Fixo do Lar vs. Renda Conjunta';
                    if (p2Nome) p2Nome.innerText = 'Fundo de Emergência da Casa';
                    if (p3Nome) p3Nome.innerText = 'Equilíbrio e Quitação do Rateio do Mês';

                    if (dados.insights && dados.insights.length >= 3) {
                        if (p1Txt) p1Txt.innerText = dados.insights[0].texto;
                        if (p2Txt) p2Txt.innerText = dados.insights[1].texto;
                        if (p3Txt) p3Txt.innerText = dados.insights[2].texto;
                    }
                    if (p1Desc) p1Desc.innerText = 'Mede o comprometimento da soma das rendas com as contas essenciais da residência.';
                    if (p2Desc) p2Desc.innerText = 'Segurança financeira conjunta para cobrir imprevistos residenciais sem desequilibrar o casal.';
                    if (p3Desc) p3Desc.innerText = 'Mede a pontualidade e transparência da participação de cada parceiro nos pagamentos do mês.';
                } else {
                    if (p1Nome) p1Nome.innerText = 'Compromissos fixos vs. renda';
                    if (p2Nome) p2Nome.innerText = 'Reserva de emergência';
                    if (p3Nome) p3Nome.innerText = 'Gastos do dia a dia';

                    if (dados.insights && dados.insights.length >= 3) {
                        if (p1Txt) p1Txt.innerText = dados.insights[0].texto;
                        if (p2Txt) p2Txt.innerText = dados.insights[1].texto;
                        if (p3Txt) p3Txt.innerText = dados.insights[2].texto;
                    }
                    if (p1Desc) p1Desc.innerText = 'Fatura do cartão + despesas somam parte importante da renda. Acima de 70% sobra pouca folga.';
                    if (p2Desc) p2Desc.innerText = 'O ideal é ter pelo menos 3x a sua renda guardada. Continue contribuindo aos poucos.';
                    if (p3Desc) p3Desc.innerText = 'Você gastou menos do que entrou no mês, mantendo sobra livre.';
                }
            }
            if (window.lucide) lucide.createIcons();
        }

        function abrirModalSaudeFinanceira() {
            // Se o usuário estiver olhando a visão do Lar no Dashboard, abre já na aba do Lar
            const iniciarComLar = (visaoSaudeDashAtiva === 'lar' && (dashboardDadosCache?.is_casal || cacheSaudeLar));
            
            // Oculta abas do topo se for usuário individual/solteiro sem Lar
            const toggleAbas = document.getElementById('modalSaudeToggleAbas');
            if (toggleAbas) {
                if (dashboardDadosCache?.is_casal) {
                    toggleAbas.classList.remove('hidden');
                } else {
                    toggleAbas.classList.add('hidden');
                }
            }

            alternarAbaModalSaude(iniciarComLar ? 'lar' : 'individual');
            abrirModalId('modalSaudeFinanceira');
        }

        // 6. Modal Registrar Pagamento (Imagem 6)
        function abrirModalRegistrarPagamento(itemId) {
            const itens = dashboardDadosCache?.pra_registrar_hoje || [];
            itemPagamentoAtual = itens.find(it => it.id === itemId) || itens[0] || { id: itemId, titulo: 'Fatura', valor: 890, tipo: 'fatura' };

            const tit = document.getElementById('modalPagItemTitulo');
            const val = document.getElementById('modalPagItemValor');
            const prog = document.getElementById('modalPagItemProgresso');
            const btnConfirmar = document.getElementById('modalPagBtnConfirmarTexto');

            if (tit) tit.innerText = itemPagamentoAtual.titulo;
            if (val) val.innerText = BRL(itemPagamentoAtual.valor);
            if (prog) prog.innerText = `Valor a quitar: ${BRL(itemPagamentoAtual.valor)} · pendente`;
            if (btnConfirmar) btnConfirmar.innerText = `Confirmar que paguei ${BRL(itemPagamentoAtual.valor)}`;

            // Renderiza contas para selecionar saída
            const contas = dashboardDadosCache?.contas || listaContas || [];
            const containerContas = document.getElementById('modalPagChipsContas');
            if (containerContas && contas.length) {
                contaSaidaPagamentoId = contas[0].id_conta;
                containerContas.innerHTML = contas.map((c, i) => `
                    <button type="button" onclick="selecionarContaSaidaPagamento(${c.id_conta})"
                            id="chipPagConta_${c.id_conta}"
                            class="chip-pag-conta flex items-center gap-1.5 px-3 py-1.5 rounded-xl border text-xs font-bold transition ${i === 0 ? 'border-emerald-600 bg-emerald-50 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300' : 'border-border bg-card text-muted-foreground hover:text-foreground'}">
                        <span class="size-2 rounded-full" style="background-color: ${c.cor || '#10b981'}"></span>
                        <span>${c.nome}</span>
                        <span class="text-[10px] text-muted-foreground">(${BRL(c.saldo)})</span>
                    </button>
                `).join('');
            }

            document.getElementById('modalRegistrarPagamento')?.classList.remove('hidden');
            lucide.createIcons();
        }

        function selecionarContaSaidaPagamento(id) {
            contaSaidaPagamentoId = id;
            document.querySelectorAll('.chip-pag-conta').forEach(btn => {
                btn.className = 'chip-pag-conta flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground text-xs font-bold transition';
            });
            const ativo = document.getElementById(`chipPagConta_${id}`);
            if (ativo) {
                ativo.className = 'chip-pag-conta flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-emerald-600 bg-emerald-50 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 text-xs font-bold transition';
            }
        }

        function previewComprovantePagamento(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    comprovantePagamentoBase64 = e.target.result;
                    const txt = document.getElementById('modalPagFotoTexto');
                    if (txt) txt.innerText = `Anexado: ${input.files[0].name.substring(0, 20)}`;
                    seivaNotificar('Comprovante anexado com sucesso!', 'sucesso', 'Anexo');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        async function executarConfirmacaoPagamento() {
            if (!itemPagamentoAtual) return;
            try {
                const res = await fetch('/api/pagamentos/registrar', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({
                        id: itemPagamentoAtual.id,
                        tipo: itemPagamentoAtual.tipo,
                        valor: itemPagamentoAtual.valor,
                        conta_id: contaSaidaPagamentoId,
                        comprovante: comprovantePagamentoBase64
                    })
                });

                if (res.ok) {
                    fecharModalId('modalRegistrarPagamento');
                    seivaNotificar(`Pagamento de ${itemPagamentoAtual.titulo} (${BRL(itemPagamentoAtual.valor)}) registrado e liquidado!`, 'sucesso', 'Pagamento Confirmado');
                    carregarDashboardDados();
                } else {
                    const err = await res.json();
                    seivaNotificar(err.erro || 'Não foi possível registrar o pagamento.', 'erro');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão ao registrar pagamento.', 'erro');
            }
        }

        // 7. Modal Lançar Gasto Rápido (Imagem 9)
        function abrirModalLancarGasto() {
            const contas = dashboardDadosCache?.contas || listaContas || [];
            const containerContas = document.getElementById('gastoChipsContas');
            if (containerContas && contas.length) {
                contaGastoAtual = contas[0].id_conta;
                document.getElementById('gastoContaIdSelecionada').value = contas[0].id_conta;
                containerContas.innerHTML = contas.map((c, i) => `
                    <button type="button" onclick="selecionarContaGasto(${c.id_conta})"
                            id="chipGastoConta_${c.id_conta}"
                            class="chip-gasto-conta flex items-center gap-1.5 px-3 py-1.5 rounded-xl border text-xs font-bold transition ${i === 0 ? 'border-emerald-600 bg-emerald-50 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300' : 'border-border bg-card text-muted-foreground hover:text-foreground'}">
                        <span class="size-2 rounded-full" style="background-color: ${c.cor || '#10b981'}"></span>
                        <span>${c.nome}</span>
                    </button>
                `).join('');
            }

            // Ocultar seletor de compartilhar se usuário for Individual
            const compContainer = document.getElementById('gastoContainerCompartilhar');
            if (compContainer) {
                const isCasal = Boolean(dashboardDadosCache?.is_casal && dashboardDadosCache?.lar);
                compContainer.style.display = isCasal ? 'block' : 'none';
            }

            document.getElementById('modalLancarGasto')?.classList.remove('hidden');
            lucide.createIcons();
        }

        function selecionarCategoriaGasto(btn, nomeCat, icon) {
            categoriaGastoAtual = nomeCat;
            const inputCat = document.getElementById('gastoCategoriaSelecionada');
            if (inputCat) inputCat.value = nomeCat;
            const inputIco = document.getElementById('gastoIconeSelecionado');
            if (inputIco) inputIco.value = icon || 'tag';

            document.querySelectorAll('#gastoGridCategorias .cat-chip, #gastoChipsCategorias .cat-chip').forEach(b => {
                b.className = 'cat-chip flex flex-col items-center justify-center p-3 rounded-2xl border border-border bg-card text-foreground hover:bg-muted/40 font-bold text-xs transition shadow-2xs';
            });
            btn.className = 'cat-chip active flex flex-col items-center justify-center p-3 rounded-2xl border-2 border-emerald-800 bg-emerald-800 text-white font-bold text-xs transition shadow-2xs';
        }

        function selecionarContaGastoChip(btn, nomeConta, id) {
            contaGastoAtual = id;
            const inputConta = document.getElementById('gastoContaIdSelecionada');
            if (inputConta) inputConta.value = id;
            document.querySelectorAll('#gastoChipsContas .chip-conta-btn').forEach(b => {
                b.className = 'chip-conta-btn px-4 py-2 rounded-full border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition shadow-2xs';
            });
            btn.className = 'chip-conta-btn active px-4 py-2 rounded-full border-2 border-emerald-800 bg-emerald-800 text-white font-bold text-xs transition shadow-2xs';
        }

        function aoAlternarImprevistoGasto(ativo) {
            const aviso = document.getElementById('textoAvisoImprevistoGasto');
            if (aviso) aviso.classList.toggle('hidden', !ativo);
        }

        function selecionarContaGasto(id) {
            contaGastoAtual = id;
            document.getElementById('gastoContaIdSelecionada').value = id;
            document.querySelectorAll('.chip-gasto-conta').forEach(b => {
                b.className = 'chip-gasto-conta flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground text-xs font-bold transition';
            });
            const ativo = document.getElementById(`chipGastoConta_${id}`);
            if (ativo) {
                ativo.className = 'chip-gasto-conta flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-emerald-600 bg-emerald-50 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 text-xs font-bold transition';
            }
        }

        function selecionarVisibilidadeGasto(tipo) {
            visibilidadeGastoAtual = tipo;
            const inputVis = document.getElementById('gastoVisibilidade');
            if (inputVis) inputVis.value = tipo;

            const btnPriv = document.getElementById('btnGastoPrivado');
            const btnComp = document.getElementById('btnGastoCompartilhado') || document.getElementById('btnGastoCompartilhar');
            const expTexto = document.getElementById('gastoExplicacaoTexto');
            const expIcone = document.getElementById('gastoExplicacaoIcone');

            if (tipo === 'privado') {
                if (btnPriv) btnPriv.className = 'w-full inline-flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl font-bold text-xs transition-all bg-card text-foreground shadow-2xs border border-border/60';
                if (btnComp) btnComp.className = 'w-full inline-flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl font-bold text-xs transition-all text-muted-foreground hover:text-foreground border border-transparent';
                if (expTexto) {
                    expTexto.innerHTML = '<strong>Privado:</strong> Apenas você visualiza este gasto na sua Caixa Preta e extrato individual. O parceiro não tem acesso e o valor não entra na divisão de contas do Lar.';
                }
                if (expIcone) {
                    expIcone.setAttribute('data-lucide', 'shield');
                }
            } else {
                if (btnComp) btnComp.className = 'w-full inline-flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl font-bold text-xs transition-all bg-card text-emerald-800 dark:text-emerald-300 shadow-2xs border border-emerald-600/40';
                if (btnPriv) btnPriv.className = 'w-full inline-flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl font-bold text-xs transition-all text-muted-foreground hover:text-foreground border border-transparent';
                if (expTexto) {
                    expTexto.innerHTML = '<strong>Compartilhado:</strong> Visível para o casal em Transações do Lar e calculado no rateio proporcional. Entra na Mesa de Acordos para divisão justa.';
                }
                if (expIcone) {
                    expIcone.setAttribute('data-lucide', 'users');
                }
            }
            lucide.createIcons();
        }

        async function executarSalvarGastoRapido(e) {
            e.preventDefault();
            const inputVal = document.getElementById('gastoInputValor');
            const inputTit = document.getElementById('gastoInputTitulo');
            const valor = parseFloat(inputVal.value.replace(/\./g, '').replace(',', '.'));
            const titulo = inputTit.value.trim();

            if (!valor || valor <= 0) {
                return seivaNotificar('Informe um valor válido maior que zero.', 'aviso', 'Valor obrigatório');
            }
            if (!titulo) {
                return seivaNotificar('Informe a descrição do gasto.', 'aviso', 'Descrição obrigatória');
            }

            const isImprevisto = document.getElementById('gastoIsImprevisto')?.checked || false;
            const compartilhado = visibilidadeGastoAtual === 'compartilhado';

            try {
                const contaIdEfetivo = contaGastoAtual || document.getElementById('gastoContaIdSelecionada')?.value || (dashboardDadosCache?.contas?.[0]?.id_conta ?? null);
                const categoriaEfetiva = categoriaGastoAtual || 'Moradia';

                const res = await fetch('/api/transacoes', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({
                        tipo: 'saida',
                        titulo,
                        valor,
                        conta_id: contaIdEfetivo,
                        categoria_nome: categoriaEfetiva,
                        is_imprevisto: isImprevisto,
                        compartilhado: compartilhado
                    })
                });

                if (res.ok) {
                    fecharModalId('modalLancarGasto');
                    inputVal.value = '';
                    inputTit.value = '';
                    seivaNotificar(`Gasto de ${BRL(valor)} registrado com sucesso!`, 'sucesso', 'Gasto Lançado');
                    carregarDashboardDados();
                    if (typeof carregarExtratoDados === 'function') carregarExtratoDados();
                    if (typeof carregarPainelLarDados === 'function') carregarPainelLarDados();
                } else {
                    const err = await res.json();
                    seivaNotificar(err.erro || 'Não foi possível registrar o gasto.', 'erro');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão ao salvar gasto.', 'erro');
            }
        }

        // 8. Modal Registrar Recebimento (Imagem 10)
        function abrirModalRegistrarRecebimento() {
            const contas = dashboardDadosCache?.contas || listaContas || [];
            const containerContas = document.getElementById('recebimentoChipsContas');
            if (containerContas && contas.length) {
                contaRecebimentoAtual = contas[0].id_conta;
                document.getElementById('recebimentoContaIdSelecionada').value = contas[0].id_conta;
                containerContas.innerHTML = contas.map((c, i) => `
                    <button type="button" onclick="selecionarContaRecebimento(${c.id_conta})"
                            id="chipRecConta_${c.id_conta}"
                            class="chip-rec-conta flex items-center gap-1.5 px-3 py-1.5 rounded-xl border text-xs font-bold transition ${i === 0 ? 'border-emerald-600 bg-emerald-50 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300' : 'border-border bg-card text-muted-foreground hover:text-foreground'}">
                        <span class="size-2 rounded-full" style="background-color: ${c.cor || '#10b981'}"></span>
                        <span>${c.nome}</span>
                    </button>
                `).join('');
            }
            document.getElementById('modalRegistrarRecebimento')?.classList.remove('hidden');
            lucide.createIcons();
        }

        function selecionarTipoRecebimento(btn, tipo) {
            tipoRecebimentoAtual = tipo;
            document.getElementById('recebimentoTipoSelecionado').value = tipo;
            document.querySelectorAll('#modalRegistrarRecebimento .chip-tipo-recebimento').forEach(b => {
                b.className = 'chip-tipo-recebimento px-3 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition';
            });
            btn.className = 'chip-tipo-recebimento active px-3 py-1.5 rounded-xl border border-emerald-600 bg-emerald-800 text-white font-bold text-xs transition';
        }

        function selecionarContaRecebimento(id) {
            contaRecebimentoAtual = id;
            document.getElementById('recebimentoContaIdSelecionada').value = id;
            document.querySelectorAll('.chip-rec-conta').forEach(b => {
                b.className = 'chip-rec-conta flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border bg-card text-muted-foreground hover:text-foreground text-xs font-bold transition';
            });
            const ativo = document.getElementById(`chipRecConta_${id}`);
            if (ativo) {
                ativo.className = 'chip-rec-conta flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-emerald-600 bg-emerald-50 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 text-xs font-bold transition';
            }
        }

        async function executarSalvarRecebimentoRapido(e) {
            e.preventDefault();
            const inputVal = document.getElementById('recebimentoInputValor');
            const inputTit = document.getElementById('recebimentoInputTitulo');
            const valor = parseFloat(inputVal.value.replace(/\./g, '').replace(',', '.'));
            const origem = inputTit.value.trim() || tipoRecebimentoAtual;

            if (!valor || valor <= 0) {
                return seivaNotificar('Informe um valor válido maior que zero.', 'aviso', 'Valor obrigatório');
            }

            const recorrente = document.getElementById('recebimentoIsRecorrente')?.checked || false;

            try {
                const res = await fetch('/api/transacoes', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({
                        tipo: 'entrada',
                        titulo: `${tipoRecebimentoAtual} (${origem})`,
                        valor,
                        conta_id: contaRecebimentoAtual,
                        categoria_nome: 'Receitas',
                        recorrente: recorrente
                    })
                });

                if (res.ok) {
                    fecharModalId('modalRegistrarRecebimento');
                    inputVal.value = '';
                    inputTit.value = '';
                    seivaNotificar(`Recebimento de ${BRL(valor)} registrado com sucesso!`, 'sucesso', 'Entrada Registrada');
                    carregarDashboardDados();
                } else {
                    const err = await res.json();
                    seivaNotificar(err.erro || 'Não foi possível registrar o recebimento.', 'erro');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão ao salvar recebimento.', 'erro');
            }
        }
    </script>
</body>
</html>

