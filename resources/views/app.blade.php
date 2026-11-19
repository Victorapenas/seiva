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

    <!-- ============================================================== -->
    <!-- CONTAINER GLOBAL DE NOTIFICAÇÕES TOAST (FINTECH PREMIUM)       -->
    <!-- ============================================================== -->
    <div id="seivaToastContainer" class="fixed top-5 right-5 z-[99999] flex flex-col gap-2.5 pointer-events-none max-w-sm w-[calc(100%-2.5rem)] sm:w-full"></div>

    <!-- ============================================================== -->
    <!-- SCRIPT MASTER DE ORQUESTRAÇÃO & COMUNICAÇÃO COM O BACKEND       -->
    <!-- ============================================================== -->
    <script>
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

        // Override definitivo de window.alert para impedir popups nativos estilo spam
        window.alert = function(msg) {
            if (!msg) return;
            seivaNotificar(msg, 'aviso');
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

        const BRL = (v) => Number(v || 0).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

        document.addEventListener('DOMContentLoaded', async () => {
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
                            body: JSON.stringify({ nome: 'Nosso Cantinho', emoji: '🌿' })
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
                                body: JSON.stringify({ nome: nomeLar, emoji: '🌿' })
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

                        // Se escolheu criar o Lar
                        if (usoLarOnboarding) {
                            const nomeLar = document.getElementById('regNomeLar').value.trim() || 'Nosso Cantinho';
                            const larRes = await fetch('/api/lar', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ nome: nomeLar, emoji: '🌿' })
                            });
                            if (larRes.ok) {
                                larSessao = await larRes.json();
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
        function montarAmbienteLogado() {
            if (!usuarioSessao) return;
            const iniciais = usuarioSessao.iniciais || (usuarioSessao.nome ? usuarioSessao.nome.substring(0, 2).toUpperCase() : 'SE');
            const primeiroNome = usuarioSessao.nome ? usuarioSessao.nome.split(' ')[0] : 'Usuário';

            const elUserSide = document.getElementById('userNameSidebar');
            if (elUserSide) elUserSide.innerText = usuarioSessao.nome;

            const elAvSide = document.getElementById('userAvatarSidebar');
            if (elAvSide) elAvSide.innerText = iniciais;

            const elDashAv = document.getElementById('dashAvatar');
            if (elDashAv) elDashAv.innerText = iniciais;

            const elDashGreet = document.getElementById('dashGreeting');
            if (elDashGreet) elDashGreet.innerText = `Olá, ${primeiroNome}`;

            const elPerfNome = document.getElementById('perfilNomeTxt');
            if (elPerfNome) elPerfNome.innerText = usuarioSessao.nome;

            const elPerfEmail = document.getElementById('perfilEmailTxt');
            if (elPerfEmail) elPerfEmail.innerText = usuarioSessao.email;

            const elPerfAv = document.getElementById('perfilAvatarCircle');
            if (elPerfAv) elPerfAv.innerText = iniciais;

            if (larSessao) {
                const elLarPill = document.getElementById('userLarPillSidebar');
                if (elLarPill) elLarPill.innerText = `${larSessao.nome} 🌿`;

                const elGrpLar = document.getElementById('labelGrupoLarSidebar');
                if (elGrpLar) elGrpLar.innerText = `🌿 ${larSessao.nome}`;

                const elLarHead = document.getElementById('larHeaderTitle');
                if (elLarHead) elLarHead.innerText = larSessao.nome;
            }

            carregarDashboardDados();
            // Exibe o painel de boas-vindas ao entrar (respeitando "não mostrar hoje")
            setTimeout(() => abrirBoasVindas(), 700);
        }

        function trocarAbaApp(tabId) {
            document.querySelectorAll('.sub-screen').forEach(el => el.classList.add('hidden'));
            const target = document.getElementById(`pane-${tabId}`);
            if (target) target.classList.remove('hidden');

            document.querySelectorAll('.nav-sidebar-item').forEach(btn => {
                if (btn.getAttribute('data-screen') === tabId) {
                    btn.className = "nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors bg-primary text-primary-foreground shadow-soft";
                } else {
                    btn.className = "nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground";
                }
            });

            if (tabId === 'dashboard') carregarDashboardDados();
            if (tabId === 'transacoes') carregarExtratoDados();
            if (tabId === 'lar') carregarLarDados();
            if (tabId === 'acordos') carregarAcordosDados();
            if (tabId === 'metas') carregarMetasDados();
            if (tabId === 'cobrador') carregarCobradorDados();

            window.scrollTo({ top: 0, behavior: 'instant' });
            lucide.createIcons();
        }

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

        function recusarPedidoAjuda() {
            const b = document.getElementById('bannerPedidoAjuda');
            if (b) b.classList.add('hidden');
            seivaNotificar('Pedido de ajuda arquivado.', 'info', 'Pedido de Ajuda');
        }

        function aceitarPedidoAjuda() {
            const b = document.getElementById('bannerPedidoAjuda');
            if (b) b.classList.add('hidden');
            seivaNotificar('Você ajudou Ian com R$ 50,00! 🌿💚', 'sucesso', 'Ajuda Confirmada');
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
                    greetingEl.innerText = `Boa tarde, ${primeiroNome}`;
                }

                const dateEl = document.getElementById('dashDateSub');
                if (dateEl) {
                    dateEl.innerText = data.hero_mes?.data_extenso || 'Quinta, 12 de junho de 2026';
                }

                // 2. Banner de Pedido de Ajuda
                const bannerAjuda = document.getElementById('bannerPedidoAjuda');
                if (bannerAjuda) {
                    if (data.pedido_ajuda && data.pedido_ajuda.tem_pedido) {
                        bannerAjuda.classList.remove('hidden');
                        const tituloAjuda = document.getElementById('pedidoAjudaTitulo');
                        if (tituloAjuda) {
                            tituloAjuda.innerHTML = `${data.pedido_ajuda.solicitante} pediu uma ajuda de <span class="text-emerald-800 dark:text-emerald-400 font-black">${BRL(data.pedido_ajuda.valor)}</span>`;
                        }
                        const descAjuda = document.getElementById('pedidoAjudaDesc');
                        if (descAjuda) descAjuda.innerText = data.pedido_ajuda.motivo;
                        const tagAjuda = document.getElementById('pedidoAjudaTag');
                        if (tagAjuda) tagAjuda.innerHTML = `<span class="font-bold">${data.pedido_ajuda.solicitante_iniciais}</span> ${data.pedido_ajuda.motivo.substring(0, 32)} · há 20 min`;
                    } else {
                        bannerAjuda.classList.add('hidden');
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

                const画像SobraEl = document.getElementById('heroRendaSobraMes');
                if (画像SobraEl) {
                    const s = data.hero_mes?.minha_renda?.sobra_mes ?? data.resumo.saldo_livre;
                    画像SobraEl.innerText = saldosVisiveis ? BRL(s) : '••••';
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
                                <span class="text-[10px] text-muted-foreground block pt-1 border-t border-border/50">
                                    ${c.atualizado || 'Atualizado hoje'}
                                </span>
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

                // 12. Atividade Recente (Image 7)
                const atividadeList = document.getElementById('dashAtividadeRecenteList');
                if (atividadeList) {
                    const itens = data.atividades || [
                        { titulo: 'Salário Florais Design', sub: '05/06 · Nubank', valor: 1500, tipo: 'entrada', icone: 'briefcase' },
                        { titulo: 'Sephora', sub: 'Hoje · Nubank', valor: -187, tipo: 'saida', icone: 'sparkles' },
                        { titulo: 'Rappi', sub: 'Ontem · Nubank', valor: -67.4, tipo: 'saida', icone: 'utensils' },
                        { titulo: 'Academia Bio Ritmo', sub: 'Ontem · Nubank', valor: -119.9, tipo: 'saida', icone: 'dumbbell' }
                    ];

                    atividadeList.innerHTML = itens.map(item => `
                        <div class="flex items-center justify-between p-3 sm:p-4 hover:bg-muted/30 transition rounded-2xl">
                            <div class="flex items-center gap-3">
                                <span class="size-10 rounded-2xl bg-emerald-50 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 flex items-center justify-center shrink-0">
                                    <i data-lucide="${item.icone || 'credit-card'}" class="size-4"></i>
                                </span>
                                <div>
                                    <h4 class="text-xs font-bold text-foreground">${item.titulo}</h4>
                                    <p class="text-[11px] text-muted-foreground">${item.sub}</p>
                                </div>
                            </div>
                            <span class="text-xs sm:text-sm font-black ${item.valor > 0 ? 'text-emerald-600' : 'text-foreground'}">
                                ${item.valor > 0 ? '+ ' : ''}${saldosVisiveis ? BRL(Math.abs(item.valor)) : '••••'}
                            </span>
                        </div>
                    `).join('');
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
        async function carregarExtratoDados() {
            try {
                const res = await fetch('/api/transacoes');
                if (!res.ok) return;
                const txs = await res.json();
                const cont = document.getElementById('extratoList');
                if (!txs.length) {
                    cont.innerHTML = '<p class="text-xs text-muted-foreground py-8 text-center">Nenhuma transação cadastrada ainda.</p>';
                    return;
                }
                cont.innerHTML = txs.map(t => `
                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center gap-3">
                            <span class="size-9 rounded-xl ${t.tipo === 'entrada' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700'} flex items-center justify-center font-bold">
                                ${t.tipo === 'entrada' ? '+' : '-'}
                            </span>
                            <div>
                                <p class="text-xs font-semibold text-foreground">${t.titulo}</p>
                                <span class="text-[10px] text-muted-foreground">${t.data} ${t.categoria ? '· ' + t.categoria.nome : ''}</span>
                            </div>
                        </div>
                        <span class="text-xs font-bold ${t.tipo === 'entrada' ? 'text-emerald-600' : 'text-rose-600'}">
                            ${t.tipo === 'entrada' ? '+' : '-'} ${BRL(t.valor)}
                        </span>
                    </div>
                `).join('');
            } catch (e) {}
        }

        // --- LAR & RATEIO ---
        async function carregarLarDados() {
            try {
                const res = await fetch('/api/lar');
                if (!res.ok) return;
                const data = await res.json();
                if (!data.lar) return;
                larSessao = data.lar;

                const grid = document.getElementById('larMembrosProporcaoGrid');
                grid.innerHTML = (data.membros || []).map(m => `
                    <div class="rounded-2xl border border-border bg-muted/40 p-3.5 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-foreground">${m.nome}</p>
                            <span class="text-[10px] text-muted-foreground">Renda declarada: ${BRL(m.renda_declarada)}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-base font-extrabold text-primary">${m.percentual_calculado}%</span>
                            <p class="text-[10px] text-muted-foreground">do rateio</p>
                        </div>
                    </div>
                `).join('');

                const despRes = await fetch('/api/lar/despesas');
                if (despRes.ok) {
                    const despesas = await despRes.json();
                    const dGrid = document.getElementById('larDespesasGrid');
                    if (!despesas.length) {
                        dGrid.innerHTML = '<p class="text-xs text-muted-foreground py-6 text-center">Nenhuma despesa compartilhada registrada.</p>';
                        return;
                    }
                    dGrid.innerHTML = despesas.map(d => `
                        <div class="p-3.5 rounded-2xl border border-border bg-background space-y-2">
                            <div class="flex items-center justify-between">
                                <p class="text-xs font-bold text-foreground">${d.titulo}</p>
                                <span class="text-xs font-bold text-foreground">${BRL(d.valor_total)}</span>
                            </div>
                            <div class="flex items-center justify-between text-[11px] text-muted-foreground">
                                <span>Divisão: ${d.divisao}</span>
                                <span class="font-bold ${d.status === 'pago' ? 'text-emerald-600' : 'text-amber-600'}">${d.status.toUpperCase()}</span>
                            </div>
                        </div>
                    `).join('');
                }
            } catch (e) {}
        }

        // --- CAIXA PRETA ---
        async function validarPinCaixa() {
            const pin = document.getElementById('caixaPinField').value;
            if (!pin) return seivaNotificar('Digite o PIN de 4 dígitos da Caixa Preta.', 'aviso', 'PIN obrigatório');

            const res = await fetch('/api/caixa-preta/verificar-pin', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ pin })
            });

            const data = await res.json();
            if (data.unlocked) {
                document.getElementById('caixaPinLockBox').classList.add('hidden');
                document.getElementById('caixaUnsealedBox').classList.remove('hidden');
                carregarCaixaRegistros();
            } else {
                seivaNotificar(data.error || 'PIN incorreto. Tente novamente.', 'erro', 'Acesso negado');
            }
        }

        function trancarCaixa() {
            document.getElementById('caixaPinField').value = '';
            document.getElementById('caixaPinLockBox').classList.remove('hidden');
            document.getElementById('caixaUnsealedBox').classList.add('hidden');
        }

        async function carregarCaixaRegistros() {
            const res = await fetch('/api/caixa-preta/registros');
            if (!res.ok) return;
            const data = await res.json();
            const container = document.getElementById('caixaRegistrosContainer');
            if (!data.registros.length) {
                container.innerHTML = '<p class="text-xs text-muted-foreground py-6 text-center">Nenhum registro confidencial cadastrado.</p>';
                return;
            }
            container.innerHTML = data.registros.map(r => `
                <div class="p-3 rounded-2xl border border-border bg-card flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-foreground">${r.titulo_cifrado}</p>
                        <span class="text-[10px] text-muted-foreground">${r.data}</span>
                    </div>
                    <span class="text-xs font-bold text-amber-600">${BRL(r.valor_cifrado)}</span>
                </div>
            `).join('');
        }

        async function adicionarRegistroCaixaPrompt() {
            const titulo = prompt('Título do gasto secreto:');
            if (!titulo) return;
            const valor = prompt('Valor (R$):');
            if (!valor) return;

            await fetch('/api/caixa-preta/registros', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ titulo, valor: parseFloat(valor) })
            });
            carregarCaixaRegistros();
        }

        // --- ACORDOS ---
        async function carregarAcordosDados() {
            try {
                const res = await fetch('/api/acordos');
                if (!res.ok) return;
                const data = await res.json();

                const propCont = document.getElementById('acordosPropostasGrid');
                if (!data.propostas.length) {
                    propCont.innerHTML = '<p class="text-xs text-muted-foreground py-6 text-center">Nenhuma proposta pendente de votação.</p>';
                } else {
                    propCont.innerHTML = data.propostas.map(p => `
                        <div class="p-4 rounded-2xl border border-border bg-background space-y-2">
                            <div class="flex items-center justify-between">
                                <p class="text-xs font-bold text-foreground">${p.titulo}</p>
                                <span class="text-xs font-bold text-primary">${BRL(p.valor)}</span>
                            </div>
                            <p class="text-xs text-muted-foreground italic">"${p.proposta_texto}"</p>
                            ${p.status === 'em_analise' ? `
                                <div class="flex gap-2 pt-1">
                                    <button onclick="votarAcordo(${p.id_proposta}, 'aceitar')" class="px-3 py-1.5 rounded-xl bg-primary text-primary-foreground text-xs font-bold">Apoiar</button>
                                    <button onclick="votarAcordo(${p.id_proposta}, 'recusar')" class="px-3 py-1.5 rounded-xl border border-border text-xs font-medium">Recusar</button>
                                </div>
                            ` : `<span class="text-[10px] font-bold text-emerald-600">${p.status.toUpperCase()}</span>`}
                        </div>
                    `).join('');
                }

                const acCont = document.getElementById('acordosSeladosGrid');
                if (!data.acordos.length) {
                    acCont.innerHTML = '<p class="text-xs text-muted-foreground py-6 text-center col-span-full">Nenhum acordo ativo no momento.</p>';
                } else {
                    acCont.innerHTML = data.acordos.map(a => `
                        <div class="p-4 rounded-2xl border border-border bg-background space-y-2">
                            <p class="text-xs font-bold text-foreground">${a.titulo}</p>
                            <p class="text-xs font-extrabold text-primary">${BRL(a.valor_total)}</p>
                            <span class="text-[10px] text-muted-foreground">Divisão: ${a.divisao}</span>
                        </div>
                    `).join('');
                }
            } catch (e) {}
        }

        async function votarAcordo(id, acao) {
            await fetch(`/api/acordos/propostas/votar/${id}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ acao })
            });
            carregarAcordosDados();
        }

        async function adicionarPropostaPrompt() {
            const titulo = prompt('Título da proposta:');
            if (!titulo) return;
            const valor = prompt('Valor estimado (R$):');
            if (!valor) return;
            const proposta_texto = prompt('Justificativa para o lar:') || '';

            await fetch('/api/acordos/propostas', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ titulo, valor: parseFloat(valor), proposta_texto, divisao_sugerida: '50/50' })
            });
            carregarAcordosDados();
        }

        // --- METAS ---
        async function carregarMetasDados() {
            const res = await fetch('/api/metas');
            if (!res.ok) return;
            const data = await res.json();
            const todas = [...(data.individuais || []), ...(data.lar || [])];

            const total = todas.reduce((s, m) => s + parseFloat(m.valor_atual || 0), 0);
            const alvo = todas.reduce((s, m) => s + parseFloat(m.valor_alvo || 1), 0);
            const pct = Math.round((total / alvo) * 100);

            document.getElementById('metasValorTotalDisplay').innerText = BRL(total);
            document.getElementById('metasAlvoTotalDisplay').innerText = `de ${BRL(alvo)} planejados`;
            document.getElementById('metasProgressoPct').innerText = `${pct}%`;
            document.getElementById('metasQtdAtivas').innerText = todas.length;

            const cont = document.getElementById('metasCardsGrid');
            if (!todas.length) {
                cont.innerHTML = '<p class="text-xs text-muted-foreground py-8 text-center col-span-full">Nenhuma meta cadastrada.</p>';
                return;
            }
            cont.innerHTML = todas.map(m => {
                const p = Math.min(100, Math.round((m.valor_atual / m.valor_alvo) * 100));
                return `
                    <div class="rounded-3xl border border-border bg-card p-4 shadow-soft space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-foreground">${m.titulo}</span>
                            <span class="text-xs font-bold text-primary">${p}%</span>
                        </div>
                        <div class="h-2 rounded-full bg-muted overflow-hidden">
                            <div class="h-full bg-primary rounded-full" style="width: ${p}%"></div>
                        </div>
                        <div class="flex items-center justify-between text-[11px] text-muted-foreground pt-1">
                            <span>${BRL(m.valor_atual)} de ${BRL(m.valor_alvo)}</span>
                            <button onclick="depositarMeta(${m.id_meta})" class="text-primary font-bold hover:underline">+ Depositar</button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        async function depositarMeta(id) {
            const v = prompt('Valor do depósito (R$):');
            if (!v) return;
            await fetch(`/api/metas/${id}/contribuir`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ valor: parseFloat(v) })
            });
            carregarMetasDados();
        }

        async function adicionarMetaPrompt() {
            const titulo = prompt('Título da meta:');
            if (!titulo) return;
            const valor_alvo = prompt('Valor alvo (R$):');
            if (!valor_alvo) return;

            await fetch('/api/metas', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ titulo, valor_alvo: parseFloat(valor_alvo), tipo_escopo: 'lar' })
            });
            carregarMetasDados();
        }

        // --- COBRADOR DIPLOMATA ---
        async function carregarCobradorDados() {
            const res = await fetch('/api/cobrancas');
            if (!res.ok) return;
            const data = await res.json();
            const grid = document.getElementById('cobradorPendenciasGrid');
            if (!data.pendencias.length) {
                grid.innerHTML = '<p class="text-xs text-muted-foreground py-6 text-center">Nenhuma pendência no momento. Tudo em dia!</p>';
                return;
            }
            grid.innerHTML = data.pendencias.map(p => `
                <div class="p-4 rounded-2xl border border-border bg-background flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-foreground">${p.despesa ? p.despesa.titulo : 'Despesa'}</p>
                        <span class="text-[10px] text-muted-foreground">Pendente por ${p.usuario ? p.usuario.nome : 'Membro'}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-bold text-rose-600">${BRL(p.valor_parte)}</span>
                        <button onclick="dispararLembreteDiplomata(${p.usuario_id}, '${p.despesa ? p.despesa.titulo : ''}', ${p.valor_parte})" class="px-3 py-1.5 rounded-xl bg-primary text-primary-foreground text-xs font-bold">
                            Lembrar
                        </button>
                    </div>
                </div>
            `).join('');
        }

        async function dispararLembreteDiplomata(destId, titulo, valor) {
            const mensagem = `Oi! Passando só pra lembrar com carinho da divisão de ${titulo} (${BRL(valor)}) 🌿`;
            await fetch('/api/cobrancas/lembrete', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ destinatario_id: destId, titulo, valor, mensagem })
            });
            seivaNotificar('Lembrete diplomático enviado com sucesso pelo SEIVA! 🌿', 'sucesso', 'Lembrete Enviado');
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
            document.getElementById('modalTransacaoHeader').innerText = 'Registrar Gasto';
            document.getElementById('formTransTipo').value = 'saida';
            document.getElementById('modalTransacao').classList.remove('hidden');
        }

        function abrirModalEntrada() {
            document.getElementById('modalTransacaoHeader').innerText = 'Registrar Entrada';
            document.getElementById('formTransTipo').value = 'entrada';
            document.getElementById('modalTransacao').classList.remove('hidden');
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
                body: JSON.stringify({ titulo, valor_total, divisao, tipo: 'fixa', data_vencimento })
            });

            if (res.ok) {
                fecharModalId('modalDespesaLar');
                carregarLarDados();
                seivaNotificar('Despesa do Lar cadastrada com sucesso!', 'sucesso', 'Despesa Salva');
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
                        sel.innerHTML = listaCategorias.map(c => `<option value="${c.id_categoria}">${c.emoji || '📁'} ${c.nome}</option>`).join('');
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
            const nome = prompt('Nome do Banco ou Carteira (ex: Inter, NuBank, Carteira):');
            if (!nome) return;
            const saldo = prompt('Saldo atual (R$):') || '0';
            await fetch('/api/contas', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ nome, tipo: 'corrente', saldo: parseFloat(saldo) })
            });
            carregarDashboardDados();
        }

        async function excluirMinhaConta() {
            if (!confirm('Deseja excluir definitivamente sua conta e dados de acordo com a LGPD?')) return;
            await fetch('/api/perfil/excluir', { method: 'DELETE' });
            location.reload();
        }

        // ==========================================
        // PAINEL DE BOAS-VINDAS INTELIGENTE
        // Aparece ao entrar/recarregar o sistema
        // Notificações reais + ações rápidas personalizáveis
        // ==========================================

        // Catálogo completo de ações disponíveis
        const ACOES_CATALOGO = [
            { id: 'gasto',      icone: 'trending-down',  label: 'Lançar gasto',       cor: '#c84b31', bg: '#fff5f5', fn: 'abrirModalGasto()',         padrao: true  },
            { id: 'entrada',    icone: 'trending-up',    label: 'Registrar entrada',   cor: '#2e6b4f', bg: '#f0fdf4', fn: 'abrirModalEntrada()',       padrao: true  },
            { id: 'extrato',    icone: 'receipt',        label: 'Ver extrato',         cor: '#6366f1', bg: '#eef2ff', fn: "trocarAbaApp('transacoes')", padrao: true  },
            { id: 'metas',      icone: 'target',         label: 'Minhas metas',        cor: '#0891b2', bg: '#ecfeff', fn: "trocarAbaApp('metas')",      padrao: false },
            { id: 'lar',        icone: 'home',           label: 'Área do Lar',         cor: '#059669', bg: '#ecfdf5', fn: "trocarAbaApp('lar')",        padrao: false },
            { id: 'acordos',    icone: 'handshake',      label: 'Mesa de Acordos',     cor: '#d97706', bg: '#fffbeb', fn: "trocarAbaApp('acordos')",    padrao: false },
            { id: 'cobrador',   icone: 'bell-ring',      label: 'Cobrador Diplomata',  cor: '#7c3aed', bg: '#f5f3ff', fn: "trocarAbaApp('cobrador')",   padrao: false },
            { id: 'relatorio',  icone: 'bar-chart-2',   label: 'Relatórios',          cor: '#1d4ed8', bg: '#eff6ff', fn: "seivaNotificar('Relatórios em breve!','info')", padrao: false },
        ];

        function getAcoesSalvas() {
            try {
                const salvo = localStorage.getItem('seiva_bv_acoes');
                if (salvo) {
                    const ids = JSON.parse(salvo);
                    return ACOES_CATALOGO.filter(a => ids.includes(a.id));
                }
            } catch(e) {}
            return ACOES_CATALOGO.filter(a => a.padrao);
        }

        function salvarAcoesBV(ids) {
            localStorage.setItem('seiva_bv_acoes', JSON.stringify(ids));
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

                // Atualiza badge
                if (badge) {
                    if (totalNaoLidas > 0) {
                        badge.innerText = totalNaoLidas > 9 ? '9+' : totalNaoLidas;
                        badge.classList.remove('hidden');
                        badge.classList.add('flex');
                    } else {
                        badge.classList.add('hidden');
                    }
                }

                // Atualiza subtítulo
                const sub = document.getElementById('bvSubtitulo');
                if (sub) {
                    if (totalNaoLidas > 0) {
                        sub.innerText = `${totalNaoLidas} notificação${totalNaoLidas > 1 ? 'ões' : ''} pendente${totalNaoLidas > 1 ? 's' : ''} para você`;
                    } else {
                        sub.innerText = 'Tudo em dia! 🌱 Nenhuma pendência.';
                    }
                }

                const iconesPorTipo = {
                    sucesso:  { icon: 'check-circle', bg: 'bg-emerald-50', cor: 'text-emerald-600', borda: 'border-emerald-200/60' },
                    alerta:   { icon: 'alert-triangle', bg: 'bg-amber-50', cor: 'text-amber-500',   borda: 'border-amber-200/60' },
                    cobranca: { icon: 'hand-coins',  bg: 'bg-purple-50',  cor: 'text-purple-600',  borda: 'border-purple-200/60' },
                    info:     { icon: 'info',         bg: 'bg-blue-50',    cor: 'text-blue-600',    borda: 'border-blue-200/60'   },
                    erro:     { icon: 'x-circle',     bg: 'bg-rose-50',    cor: 'text-rose-500',    borda: 'border-rose-200/60'   },
                };

                lista.innerHTML = notifs.map(n => {
                    const cfg = iconesPorTipo[n.tipo] || iconesPorTipo.info;
                    const opacidade = n.lida ? 'opacity-60' : '';
                    const acaoBotao = n.acao
                        ? `<button type="button" onclick="${n.acao.fn}; fecharBoasVindas();"
                               class="mt-1.5 text-[10px] font-bold text-primary hover:underline">
                               ${n.acao.label} →
                           </button>`
                        : '';
                    return `
                        <div class="flex items-start gap-3 p-3 rounded-2xl border ${cfg.borda} ${cfg.bg} ${opacidade} transition">
                            <span class="size-9 rounded-xl ${cfg.bg} ${cfg.cor} flex items-center justify-center shrink-0 border ${cfg.borda}">
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
                container.innerHTML = '<p class="text-xs text-muted-foreground col-span-2 text-center py-2">Nenhuma ação selecionada. Clique em ⚙ para personalizar.</p>';
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
                lista.innerHTML = ACOES_CATALOGO.map(a => `
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
                // Mantém a ordem do catálogo
                ids = ACOES_CATALOGO.map(a => a.id).filter(i => ids.includes(i));
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

        // ── Alias: o sino do dashboard abre o painel de boas-vindas ──────────
        function abrirModalNotificacoes() {
            // Reseta o "não mostrar hoje" para que o painel abra mesmo se já foi visto
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

        // ── Renderização dinâmica das seções do Dashboard ─────────────────────
        // Executado ao final de carregarDashboardDados()

        function renderizarSecoesDinamicasDashboard(data) {
            const isCasal = Boolean(data.is_casal && data.lar);

            // — Ocultar/Exibir aba "Custo do Lar" conforme tipo de usuário —
            const tabLar  = document.getElementById('tabHeroCustoLar');
            const sliderDotLar  = document.getElementById('sliderDotLar');
            const sliderDica    = document.getElementById('sliderTextoDica');
            const cardLar       = document.getElementById('cardHeroCustoLar');
            const heroTituloSec = document.getElementById('heroTituloSecao');
            const bannerAjuda   = document.getElementById('bannerPedidoAjuda');

            if (!isCasal) {
                // Individual: ocultar tudo do Lar
                if (tabLar)       tabLar.classList.add('hidden');
                if (sliderDotLar) sliderDotLar.classList.add('hidden');
                if (sliderDica)   sliderDica.innerText = '';
                if (cardLar)      cardLar.classList.add('hidden');
                if (bannerAjuda)  bannerAjuda.classList.add('hidden');
                if (heroTituloSec) heroTituloSec.innerText = 'Meu mês financeiro';
                // Garante aba de renda ativa
                alternarAbaHero('renda');

                // Ocultar grupo do Lar na sidebar
                const grpLar = document.getElementById('labelGrupoLarSidebar');
                if (grpLar) {
                    const secaoLar = grpLar.closest('div');
                    if (secaoLar) secaoLar.classList.add('hidden');
                }
            } else {
                // Casal: garantir visibilidade
                if (tabLar)       tabLar.classList.remove('hidden');
                if (sliderDotLar) sliderDotLar.classList.remove('hidden');
                if (sliderDica)   sliderDica.innerText = 'Arraste para o lado para ver o Custo do Lar';
                if (heroTituloSec) heroTituloSec.innerText = `Seu mês de ${data.hero_mes?.mes_nome || 'junho'}`;

                const grpLar = document.getElementById('labelGrupoLarSidebar');
                if (grpLar) {
                    const secaoLar = grpLar.closest('div');
                    if (secaoLar) secaoLar.classList.remove('hidden');
                }
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

            // — Saúde Financeira dinâmica —
            const sf = data.saude_financeira;
            if (sf) {
                // Atualiza o gauge (círculo SVG)
                const circleProgress = document.querySelector('#pane-dashboard circle:last-child');
                if (circleProgress) {
                    const circumference = 251.2;
                    const offset = circumference - (sf.score / 100) * circumference;
                    circleProgress.setAttribute('stroke-dashoffset', Math.round(offset));
                    const corScore = sf.score >= 80 ? '#10b981' : (sf.score >= 60 ? '#f59e0b' : '#ef4444');
                    circleProgress.setAttribute('stroke', corScore);
                }
                // Atualiza texto central
                const textoScore = document.querySelector('#pane-dashboard .absolute.inset-0 span:first-child');
                const textoStatus = document.querySelector('#pane-dashboard .absolute.inset-0 span:last-child');
                if (textoScore) textoScore.innerText = `${sf.score}%`;
                if (textoStatus) {
                    textoStatus.innerText = sf.status;
                    textoStatus.className = `text-[11px] font-bold ${sf.score >= 80 ? 'text-emerald-600' : (sf.score >= 60 ? 'text-amber-600' : 'text-red-500')}`;
                }

                // Atualiza insights
                const insightsCont = document.querySelector('#pane-dashboard .space-y-2\\.5.flex-1');
                if (insightsCont && sf.insights?.length) {
                    const verAnaliseBtn = insightsCont.querySelector('.pt-2');
                    insightsCont.innerHTML = sf.insights.map(ins => {
                        const icon = ins.tipo === 'sucesso' ? '✅' : '⚠️';
                        return `<div class="flex items-start gap-2.5 text-xs text-foreground">
                            <span class="${ins.tipo === 'sucesso' ? 'text-emerald-600' : 'text-amber-500'} font-bold shrink-0">${icon}</span>
                            <p>${ins.texto}</p>
                        </div>`;
                    }).join('');
                    if (verAnaliseBtn) insightsCont.appendChild(verAnaliseBtn);
                }
            }

            // — Pra registrar hoje —
            const praRegList = document.getElementById('dashPraRegistrarList');
            if (!praRegList) {
                // Seção existe com HTML estático – atualizar diretamente o container pai
                const secaoPraReg = document.querySelector('#pane-dashboard section .space-y-2\\.5.pt-1');
                if (secaoPraReg) {
                    const itens = data.pra_registrar_hoje || [];
                    if (!itens.length) {
                        secaoPraReg.innerHTML = `
                            <div class="flex items-center gap-3 p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200/60 text-xs text-emerald-800 font-medium">
                                <i data-lucide="check-circle" class="size-4 text-emerald-600 shrink-0"></i>
                                Tudo em dia! Nenhuma conta pendente por aqui.
                            </div>`;
                    } else {
                        secaoPraReg.innerHTML = itens.map(item => {
                            const isFatura = item.tipo === 'fatura';
                            const iconeCor = isFatura ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700';
                            return `
                            <div class="flex items-center justify-between p-3.5 rounded-2xl bg-card border border-rose-200/60 shadow-2xs">
                                <div class="flex items-center gap-3">
                                    <span class="size-9 rounded-xl ${iconeCor} flex items-center justify-center shrink-0">
                                        <i data-lucide="${item.icone || 'credit-card'}" class="size-4"></i>
                                    </span>
                                    <div>
                                        <h4 class="text-xs font-extrabold text-foreground">${item.titulo} · ${BRL(item.valor)}</h4>
                                        <p class="text-[11px] text-muted-foreground">${item.descricao}</p>
                                    </div>
                                </div>
                                <button type="button" onclick="confirmarRegistroRapido('${item.titulo.replace(/'/g,"\\'")}', ${item.valor})"
                                        class="px-4 py-1.5 rounded-xl bg-[#c84b31] hover:bg-[#b03d25] text-white font-bold text-xs transition shadow-2xs">
                                    Registrar
                                </button>
                            </div>`;
                        }).join('');
                    }
                }
            }

            // — Metas —
            const metasGrid = document.querySelector('#pane-dashboard section .grid.grid-cols-1.sm\\:grid-cols-2.gap-3\\.5');
            if (metasGrid) {
                const metas = data.metas || [];
                if (!metas.length) {
                    metasGrid.innerHTML = `<p class="text-xs text-muted-foreground col-span-2 py-4 text-center">Nenhuma meta ativa. Crie sua primeira meta!</p>`;
                } else {
                    metasGrid.innerHTML = metas.map(m => {
                        const pct = m.percentual || 0;
                        const isLar = m.tipo === 'Do Lar';
                        const badgeCls = isLar ? 'bg-emerald-100 text-emerald-800' : 'bg-muted text-muted-foreground';
                        const iconMap = { laptop: 'laptop', shield: 'shield', target: 'target', snowflake: 'snowflake' };
                        const ico = iconMap[m.icone] || 'target';
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

            // — Despesas Fixas —
            const despFixasGrid = document.querySelector('#pane-dashboard .grid.grid-cols-1.sm\\:grid-cols-2.lg\\:grid-cols-4.gap-3');
            if (despFixasGrid) {
                const fixas = data.despesas_fixas || [];
                if (!fixas.length) {
                    despFixasGrid.innerHTML = `<p class="text-xs text-muted-foreground col-span-4 py-4 text-center">Nenhuma despesa fixa registrada.</p>`;
                } else {
                    despFixasGrid.innerHTML = fixas.map(df => {
                        const badgeCfg = df.tipo === 'aviso'
                            ? { cls: 'bg-amber-500/10 text-amber-700', label: '⚠️ ' + df.status }
                            : df.tipo === 'pendente'
                                ? { cls: 'bg-muted text-muted-foreground', label: df.status }
                                : { cls: 'bg-emerald-500/10 text-emerald-700', label: '✅ ' + df.status };
                        return `
                        <div class="rounded-2xl border border-border bg-card p-4 shadow-soft space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="size-7 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center">
                                    <i data-lucide="${df.icone || 'receipt'}" class="size-3.5"></i>
                                </span>
                                <span class="inline-flex items-center gap-1 rounded-md px-1.5 py-0.5 text-[10px] font-bold ${badgeCfg.cls}">
                                    ${badgeCfg.label}
                                </span>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-foreground">${df.titulo}</h4>
                                <strong class="text-base font-extrabold text-foreground">${BRL(df.valor)}</strong>
                                <span class="text-[10px] text-muted-foreground block mt-0.5">${df.vencimento}</span>
                            </div>
                        </div>`;
                    }).join('');
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
                heroTituloSec.innerText = `Seu mês de ${data.hero_mes?.mes_nome || 'junho'}`;
            }

            // — Badge de notificações no sino do dashboard —
            const badgeNotifDash = document.getElementById('dashBadgeNotifCount');
            if (badgeNotifDash) {
                // Carrega contagem de não lidas de forma leve
                fetch('/api/notificacoes', { headers: { 'Accept': 'application/json' } })
                    .then(r => r.ok ? r.json() : null)
                    .then(nd => {
                        if (nd && nd.total_nao_lidas > 0) {
                            badgeNotifDash.innerText = nd.total_nao_lidas > 9 ? '9+' : nd.total_nao_lidas;
                            badgeNotifDash.classList.remove('hidden');
                        } else {
                            badgeNotifDash.classList.add('hidden');
                        }
                    }).catch(() => {});
            }

            lucide.createIcons();
        }
    </script>
</body>
</html>

