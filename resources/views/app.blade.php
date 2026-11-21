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

                        // Se escolheu criar o Lar
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
            if (elDashGreet) elDashGreet.innerText = `${getSaudacao()}, ${primeiroNome}`;

            const elPerfNome = document.getElementById('perfilNomeTxt');
            if (elPerfNome) elPerfNome.innerText = usuarioSessao.nome;

            const elPerfEmail = document.getElementById('perfilEmailTxt');
            if (elPerfEmail) elPerfEmail.innerText = usuarioSessao.email;

            const elPerfAv = document.getElementById('perfilAvatarCircle');
            if (elPerfAv) elPerfAv.innerText = iniciais;

            const secaoLarSide = document.getElementById('secaoLarSidebar');
            const elLarPill = document.getElementById('userLarPillSidebar');
            if (larSessao) {
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
                if (secaoLarSide) secaoLarSide.classList.add('hidden');
                if (elLarPill) {
                    elLarPill.innerText = 'Individual';
                    elLarPill.className = 'mt-0.5 inline-flex items-center gap-1 rounded-full bg-muted px-2 py-0.5 text-[10px] font-semibold text-muted-foreground';
                }
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
            if (tabId === 'caixa-preta') inicializarOuCarregarCaixaPreta();
            if (tabId === 'transacoes') carregarExtratoDados();
            if (tabId === 'lar') carregarLarDados();
            if (tabId === 'acordos') carregarAcordosDados();
            if (tabId === 'metas') carregarMetasDados();
            if (tabId === 'cobrador') carregarCobradorDados();
            if (tabId === 'recebimentos') carregarRecebimentosDados();

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
            seivaNotificar('Você ajudou Ian com R$ 50,00!', 'sucesso', 'Ajuda Confirmada');
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
        // Estado dos filtros ativos
        let txPeriodoAtivo = 'mes';
        let txCategoriaAtiva = '';
        let txContaAtiva = '';
        let txBuscaAtiva = '';
        let txLarQuemAtivo = 'eu';
        let txDadosCache = [];

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

                // Popular chips de conta dinamicamente
                _popularChipsContaTransacoes();

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
            const container = document.getElementById('txChipContasDinamicas');
            if (!container || !contas.length) return;
            container.innerHTML = contas.map(c => `
                <button onclick="filtrarTransacoesConta('${c.id_conta}', this)"
                        data-conta="${c.id_conta}"
                        class="tx-conta-chip flex-shrink-0 flex items-center gap-1.5 px-3.5 py-1.5 rounded-full border border-border bg-card text-muted-foreground text-xs font-bold transition hover:text-foreground">
                    <span class="size-2 rounded-full" style="background-color:${c.cor || '#10b981'}"></span>
                    ${c.nome}
                </button>
            `).join('');
        }

        function _renderizarListaAgrupada(txs) {
            const cont = document.getElementById('txListaAgrupada');
            if (!cont) return;

            // Aplica filtro de busca local
            let lista = txs;
            if (txBuscaAtiva) {
                const q = txBuscaAtiva.toLowerCase();
                lista = txs.filter(t =>
                    t.titulo.toLowerCase().includes(q) ||
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

            // Agrupar por data (HOJE, ONTEM, ou formatada)
            const hoje    = new Date(); hoje.setHours(0,0,0,0);
            const ontem   = new Date(hoje); ontem.setDate(ontem.getDate() - 1);
            const grupos  = {};

            lista.forEach(t => {
                const d = new Date(t.data + 'T12:00:00');
                d.setHours(0,0,0,0);
                let label;
                if (d.getTime() === hoje.getTime())  label = 'HOJE';
                else if (d.getTime() === ontem.getTime()) label = 'ONTEM';
                else label = d.toLocaleDateString('pt-BR', { weekday: 'long', day: '2-digit', month: 'long' }).toUpperCase();
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
            const dataFmt   = t.data ? new Date(t.data + 'T12:00:00').toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit' }) : '';

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
                    <div class="flex flex-col items-end shrink-0 ml-3 gap-1">
                        <span class="text-xs font-black ${isEntrada ? 'text-emerald-600' : 'text-foreground'}">
                            ${isEntrada ? '+' : '-'} ${BRL(t.valor)}
                        </span>
                    </div>
                </div>`;
        }

        function alternarAbaTransacoes(aba) {
            const paneMin = document.getElementById('paneMinhasTransacoes');
            const paneLar = document.getElementById('paneLarTransacoes');
            const btnMin  = document.getElementById('abaMinhasTransacoes');
            const btnLar  = document.getElementById('abaLarTransacoes');

            const ativoClass   = 'flex-1 py-2 px-3 rounded-xl text-xs font-bold transition-all bg-card text-foreground shadow-2xs';
            const inativoClass = 'flex-1 py-2 px-3 rounded-xl text-xs font-bold transition-all text-muted-foreground hover:text-foreground';

            if (aba === 'minhas') {
                if (paneMin) paneMin.classList.remove('hidden');
                if (paneLar) paneLar.classList.add('hidden');
                if (btnMin)  btnMin.className  = ativoClass;
                if (btnLar)  btnLar.className  = inativoClass;
            } else {
                if (paneMin) paneMin.classList.add('hidden');
                if (paneLar) paneLar.classList.remove('hidden');
                if (btnMin)  btnMin.className  = inativoClass;
                if (btnLar)  btnLar.className  = ativoClass;
                carregarTransacoesLar();
            }
        }

        function filtrarTransacoesPeriodo(periodo, btn) {
            txPeriodoAtivo = periodo;
            document.querySelectorAll('.tx-periodo-btn').forEach(b => {
                b.className = 'tx-periodo-btn px-4 py-2 rounded-xl border border-border bg-card text-muted-foreground text-xs font-bold transition hover:text-foreground';
            });
            if (btn) btn.className = 'tx-periodo-btn px-4 py-2 rounded-xl border border-primary bg-primary text-primary-foreground text-xs font-bold transition';
            carregarExtratoDados();
        }

        function filtrarTransacoesCategoria(cat, btn) {
            txCategoriaAtiva = cat;
            document.querySelectorAll('.tx-cat-chip').forEach(b => {
                b.className = 'tx-cat-chip flex-shrink-0 px-3.5 py-1.5 rounded-full border border-border bg-card text-muted-foreground text-xs font-bold transition hover:text-foreground';
            });
            if (btn) btn.className = 'tx-cat-chip flex-shrink-0 px-3.5 py-1.5 rounded-full border border-primary bg-primary text-primary-foreground text-xs font-bold transition';
            carregarExtratoDados();
        }

        function filtrarTransacoesConta(contaId, btn) {
            txContaAtiva = contaId;
            // Reset todos os chips de conta
            document.querySelectorAll('.tx-conta-chip').forEach(b => {
                b.className = 'tx-conta-chip flex-shrink-0 flex items-center gap-1.5 px-3.5 py-1.5 rounded-full border border-border bg-card text-muted-foreground text-xs font-bold transition hover:text-foreground';
            });
            if (btn) btn.className = 'tx-conta-chip flex-shrink-0 flex items-center gap-1.5 px-3.5 py-1.5 rounded-full border border-primary bg-primary text-primary-foreground text-xs font-bold transition';
            carregarExtratoDados();
        }

        function buscarTransacoes(q) {
            txBuscaAtiva = q;
            _renderizarListaAgrupada(txDadosCache);
        }

        async function carregarTransacoesLar() {
            try {
                const res = await fetch('/api/transacoes?visibilidade=lar');
                if (!res.ok) return;
                const txs = await res.json();

                const userId = usuarioSessao?.id_usuario;
                const minhas  = txs.filter(t => t.usuario_id === userId);
                const demais  = txs.filter(t => t.usuario_id !== userId);

                const totalMeu      = minhas.reduce((s, t) => s + parseFloat(t.valor), 0);
                const totalParceiro = demais.reduce((s, t) => s + parseFloat(t.valor), 0);
                const totalGeral    = totalMeu + totalParceiro;

                const elBannerTotal = document.getElementById('txLarBannerTotal');
                const elEuEnviei    = document.getElementById('txLarEuEnviei');
                const elParc        = document.getElementById('txLarParceiroEnviou');
                if (elBannerTotal) elBannerTotal.textContent = BRL(totalGeral);
                if (elEuEnviei)    elEuEnviei.textContent    = BRL(totalMeu);
                if (elParc)        elParc.textContent        = BRL(totalParceiro);

                // Iniciais do parceiro via lar
                if (larSessao?.membros) {
                    const parceiro = larSessao.membros.find(m => m.id_usuario !== userId);
                    if (parceiro) {
                        const elParceiroIni = document.getElementById('txLarParceiroIniciais');
                        const elParceiroLbl = document.getElementById('txLarParceiroLabel');
                        if (elParceiroIni) elParceiroIni.textContent = (parceiro.iniciais || parceiro.nome?.substring(0,2) || 'PA').toUpperCase();
                        if (elParceiroLbl) elParceiroLbl.textContent = `${parceiro.nome?.split(' ')[0] || 'Parceiro(a)'} enviou`;
                        const btnParceiro = document.querySelector('.tx-lar-quem-btn:last-child');
                        if (btnParceiro) btnParceiro.textContent = parceiro.nome?.split(' ')[0] || 'Parceiro(a)';
                    }
                }

                filtrarTransacoesLar(txLarQuemAtivo, null, txs);
            } catch (e) { console.error('Erro ao carregar transações do lar:', e); }
        }

        function filtrarTransacoesLar(quem, btn, txsParam) {
            txLarQuemAtivo = quem;
            document.querySelectorAll('.tx-lar-quem-btn').forEach(b => {
                b.className = 'tx-lar-quem-btn flex-1 py-2 px-3 rounded-xl text-xs font-bold transition-all text-muted-foreground hover:text-foreground';
            });
            if (btn) btn.className = 'tx-lar-quem-btn flex-1 py-2 px-3 rounded-xl text-xs font-bold transition-all bg-card text-foreground shadow-2xs';

            const userId = usuarioSessao?.id_usuario;
            const txs    = txsParam || [];
            let lista    = txs;
            if (quem === 'eu')       lista = txs.filter(t => t.usuario_id === userId);
            if (quem === 'parceiro') lista = txs.filter(t => t.usuario_id !== userId);

            const cont = document.getElementById('txLarLista');
            if (!cont) return;

            if (!lista.length) {
                cont.innerHTML = `<div class="rounded-3xl border border-border bg-card p-8 shadow-card text-center">
                    <i data-lucide="inbox" class="size-8 text-muted-foreground mx-auto mb-2"></i>
                    <p class="text-xs text-muted-foreground">Nenhuma transação do lar encontrada.</p>
                </div>`;
                lucide.createIcons();
                return;
            }

            cont.innerHTML = `<div class="rounded-3xl border border-border bg-card shadow-card overflow-hidden">
                <div class="divide-y divide-border/60">
                    ${lista.map(t => {
                        const iconeNome = obterIconeTransacao(t);
                        const dataFmt = t.data ? new Date(t.data + 'T12:00:00').toLocaleDateString('pt-BR', { day:'2-digit', month:'2-digit' }) : '';
                        const quemNome = t.usuario_id === userId
                            ? (usuarioSessao?.nome?.split(' ')[0] || 'Eu')
                            : (larSessao?.membros?.find(m => m.id_usuario !== userId)?.nome?.split(' ')[0] || 'Parceiro(a)');
                        
                        // Detalhe de rateio estilo Imagem 5
                        const metade = (parseFloat(t.valor) / 2).toLocaleString('pt-BR', { minimumFractionDigits: 2 });
                        const parceiroPrimeiroNome = larSessao?.membros?.find(m => m.id_usuario !== userId)?.nome?.split(' ')[0] || 'Ian';
                        let detalheTexto = `${quemNome} · ${dataFmt}`;
                        if (t.detalhe_rateio) {
                            detalheTexto += ` · ${t.detalhe_rateio}`;
                        } else if ((t.titulo || '').toLowerCase().includes('luz') || (t.titulo || '').toLowerCase().includes('aluguel') || (t.titulo || '').toLowerCase().includes('água')) {
                            detalheTexto += ` · Transferido p/ conta do Lar`;
                        } else {
                            detalheTexto += ` · 50/50 · ${parceiroPrimeiroNome} deve R$ ${metade}`;
                        }

                        return `
                        <div class="flex items-center justify-between px-4 py-3 hover:bg-muted/30 transition">
                            <div class="flex items-center gap-3 min-w-0">
                                <span class="size-10 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-300 flex items-center justify-center shrink-0 border border-emerald-500/20">
                                    <i data-lucide="${iconeNome}" class="size-5"></i>
                                </span>
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-foreground truncate">${t.titulo}</p>
                                    <span class="text-[10px] text-muted-foreground truncate block mt-0.5">${detalheTexto}</span>
                                </div>
                            </div>
                            <span class="text-xs font-black text-foreground shrink-0 ml-3">${BRL(t.valor)}</span>
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

        // ==========================================
        // CAIXA PRETA — Área Privada Individual (RF002 / RF003)
        // Responsável Acadêmico: Victor Hugo
        // ==========================================
        let caixaPretaDadosCache = null;
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
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
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

        function trancarCaixa() {
            const pinField = document.getElementById('caixaPinField');
            if (pinField) pinField.value = '';
            document.getElementById('caixaPinLockBox')?.classList.remove('hidden');
            document.getElementById('caixaUnsealedBox')?.classList.add('hidden');
            seivaNotificar('Caixa Preta trancada com segurança.', 'info', 'Área Bloqueada');
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
                        <div class="rounded-2xl border border-white/10 bg-[#12241b] p-4 text-white space-y-3 shadow-2xs">
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
                                ${c.badge ? `<span class="px-2 py-0.5 rounded-full bg-emerald-950/80 text-emerald-300 border border-emerald-700/40 text-[9px] font-bold">${c.badge}</span>` : ''}
                            </div>
                            <div>
                                <strong class="text-base font-black text-white block">${BRL(c.saldo)}</strong>
                                <div class="flex items-center justify-between text-[10px] text-gray-400 mt-0.5">
                                    <span>Livre: <strong class="text-emerald-400">${BRL(c.livre)}</strong></span>
                                    ${c.comprometido > 0 ? `<span>Comprometido: <strong class="text-rose-400">${BRL(c.comprometido)}</strong></span>` : ''}
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-1 border-t border-white/5 text-[10px] text-gray-400">
                                <span>${c.atualizado || 'Atualizado'}</span>
                                <button type="button" onclick="abrirModalAtualizarSaldo('${c.id_conta}')" class="text-emerald-400 font-bold hover:underline flex items-center gap-1">
                                    <i data-lucide="refresh-cw" class="size-3"></i> Atualizar
                                </button>
                            </div>
                        </div>
                    `).join('');
                }

                // Cartões de Crédito
                const contCartoes = document.getElementById('caixaContainerCartoes');
                if (contCartoes) {
                    contCartoes.innerHTML = (cec.cartoes || []).map(cart => `
                        <div class="rounded-2xl border border-rose-500/30 bg-[#1a1215] p-4 text-white space-y-3 shadow-2xs">
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
                                    <strong class="text-sm font-black text-rose-400">${BRL(cart.fatura_atual)}</strong>
                                </div>
                                <div>
                                    <span class="text-[10px] text-gray-400 block font-medium">Limite disponível</span>
                                    <strong class="text-sm font-black text-white">${BRL(cart.limite_disponivel)}</strong>
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
                        <div class="rounded-2xl border border-white/10 bg-[#12241b] p-4 text-white space-y-3 shadow-2xs">
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
                                    <strong class="text-sm font-black text-white">${BRL(it.valor)}</strong>
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
                    pctCompEl.innerHTML = `Você compromete <strong class="text-rose-500 font-extrabold">${dev.percentual_renda || 0}%</strong> da sua renda com despesas fixas e acordos.`;
                }

                // 5. Despesas só suas
                const listaSoSuas = document.getElementById('caixaListaDespesasSoSuas');
                if (listaSoSuas) {
                    listaSoSuas.innerHTML = (data.despesas_so_suas || []).map(ds => `
                        <div class="rounded-2xl border border-white/10 bg-[#12241b] p-3.5 text-white flex items-center justify-between gap-3 shadow-2xs">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <span class="size-8 rounded-xl bg-white/10 text-emerald-300 flex items-center justify-center shrink-0">
                                    <i data-lucide="${ds.icone || 'lock'}" class="size-4"></i>
                                </span>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-white truncate">${ds.titulo}</h4>
                                    <span class="text-[10px] text-gray-400 block truncate">${ds.detalhe}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <span class="text-xs font-black text-white">${BRL(ds.valor)}</span>
                                ${data.is_casal ? `
                                    <button type="button" onclick="dividirDespesaComParceiro('${ds.id}', '${ds.titulo}', ${ds.valor})" 
                                            class="px-2.5 py-1 rounded-xl bg-white/5 hover:bg-white/10 border border-white/15 text-[10px] font-bold text-emerald-300 hover:text-white transition flex items-center gap-1">
                                        <i data-lucide="share-2" class="size-3"></i> Dividir
                                    </button>
                                ` : ''}
                                <button type="button" onclick="abrirModalRegistrarPagamento('${ds.id}', '${ds.titulo}', ${ds.valor})" 
                                        class="size-7 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white flex items-center justify-center transition">
                                    <i data-lucide="check" class="size-3.5"></i>
                                </button>
                            </div>
                        </div>
                    `).join('');
                }

                // 6. Suas Metas & Wishlist
                const gridMetas = document.getElementById('caixaGridMetas');
                if (gridMetas) {
                    gridMetas.innerHTML = (data.metas || []).map(m => {
                        const p = m.percentual || Math.min(100, Math.round(((m.atual||0) / (m.alvo||1)) * 100));
                        return `
                        <div class="rounded-2xl border border-white/10 bg-[#12241b] p-3.5 text-white space-y-2 shadow-2xs">
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
                                <span>${BRL(m.atual)} de ${BRL(m.alvo)}</span>
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
                        <div class="rounded-2xl border border-white/10 bg-[#12241b] p-3 text-white flex items-center justify-between gap-3 shadow-2xs">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <img src="${prod.imagem}" alt="${prod.nome}" class="size-10 rounded-xl object-cover border border-white/10 shrink-0" onerror="this.src='/icon.svg'">
                                <div class="min-w-0">
                                    <h5 class="text-xs font-bold text-white truncate">${prod.nome}</h5>
                                    <span class="text-[10px] text-gray-400">${prod.loja}</span>
                                </div>
                            </div>
                            <div class="text-right shrink-0">
                                <strong class="text-xs font-black text-white block">${BRL(prod.preco)}</strong>
                                <button type="button" onclick="abrirModalCriarMetaComDados('${prod.nome}', ${prod.preco})" class="text-[10px] text-emerald-400 font-bold hover:underline inline-flex items-center gap-1">
                                    <i data-lucide="target" class="size-3"></i> Criar meta
                                </button>
                            </div>
                        </div>
                    `).join('');
                }

                // 7. A Receber
                const secAReceber = document.getElementById('caixaSecaoAReceber');
                if (secAReceber) {
                    if (data.is_casal && data.a_receber?.tem_a_receber) {
                        secAReceber.classList.remove('hidden');
                        const listaAReceber = document.getElementById('caixaListaAReceber');
                        if (listaAReceber) {
                            listaAReceber.innerHTML = (data.a_receber.itens || []).map(r => `
                                <div class="rounded-2xl border border-white/10 bg-[#12241b] p-3.5 text-white flex items-center justify-between gap-3 shadow-2xs">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <span class="size-8 rounded-xl bg-emerald-950/80 text-emerald-300 border border-emerald-500/30 flex items-center justify-center shrink-0">
                                            <i data-lucide="${r.icone || 'hand-coins'}" class="size-4"></i>
                                        </span>
                                        <div class="min-w-0">
                                            <h4 class="text-xs font-bold text-white truncate">${r.titulo}</h4>
                                            <span class="text-[10px] text-gray-400 block truncate">${r.descricao}</span>
                                        </div>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <strong class="text-xs font-black text-emerald-400 block">${BRL(r.valor)}</strong>
                                        <button type="button" onclick="confirmarRecebimentoAjuda('${r.id}')" class="px-2.5 py-1 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-[10px] font-bold text-white transition mt-0.5">
                                            Confirmar que recebi
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
                        <div class="rounded-2xl border border-white/10 bg-[#12241b] p-3 text-white flex items-center justify-between gap-3 shadow-2xs">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <span class="size-8 rounded-xl bg-white/10 text-emerald-300 flex items-center justify-center shrink-0">
                                    <i data-lucide="${g.icone || 'sparkles'}" class="size-4"></i>
                                </span>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-white truncate">${g.titulo}</h4>
                                    <span class="text-[10px] text-gray-400">${g.subtitulo}</span>
                                </div>
                            </div>
                            <strong class="text-xs font-black text-rose-400 shrink-0">-${BRL(g.valor)}</strong>
                        </div>
                    `).join('');
                }

                // 9. O que entrou este mês
                const listaEntrou = document.getElementById('caixaListaOQueEntrou');
                const totRecebido = document.getElementById('caixaTotalRecebidoTxt');
                if (listaEntrou) {
                    listaEntrou.innerHTML = (data.o_que_entrou || []).map(ent => `
                        <div class="rounded-2xl border border-white/10 bg-[#12241b] p-3 text-white flex items-center justify-between gap-3 shadow-2xs">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <span class="size-8 rounded-xl bg-emerald-950/80 text-emerald-300 border border-emerald-500/20 flex items-center justify-center shrink-0">
                                    <i data-lucide="trending-up" class="size-4"></i>
                                </span>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-white truncate">${ent.titulo}</h4>
                                    <span class="text-[10px] text-gray-400">${ent.data}</span>
                                </div>
                            </div>
                            <strong class="text-xs font-black text-emerald-400 shrink-0">+${BRL(ent.valor)}</strong>
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

                lucide.createIcons();

            } catch (e) {
                console.error('Erro ao carregar dados da Caixa Preta:', e);
            }
        }

        // --- AÇÕES DA CAIXA PRETA & MODAIS ---
        async function responderPedidoAjudaCaixa(acao) {
            const pedido = caixaPretaDadosCache?.pedido_ajuda;
            if (!pedido) return;

            try {
                const res = await fetch('/api/caixa-preta/responder-ajuda', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({
                        id_cobranca: pedido.id_cobranca,
                        acao: acao,
                    })
                });

                const data = await res.json();
                if (res.ok) {
                    seivaNotificar(data.mensagem || 'Ação registrada com sucesso!', 'sucesso', 'Ajuda Mútua');
                    carregarCaixaPretaDados();
                } else {
                    seivaNotificar(data.error || 'Não foi possível processar a ação.', 'erro');
                }
            } catch (e) {
                seivaNotificar('Erro de conexão.', 'erro');
            }
        }

        function dividirDespesaComParceiro(id, titulo, valor) {
            abrirModalPedirAjudaCusto({ id, titulo, valor });
        }

        function confirmarRecebimentoAjuda(id) {
            seivaNotificar('Recebimento confirmado! O valor foi adicionado ao seu saldo livre.', 'sucesso', 'Confirmado');
            carregarCaixaPretaDados();
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
        function abrirModalCriarMeta() {
            const modal = document.getElementById('modalCriarMeta');
            if (modal) {
                modal.classList.remove('hidden');
                lucide.createIcons();
            }
        }

        function abrirModalCriarMetaComDados(nome, preco) {
            abrirModalCriarMeta();
            const nomeEl = document.getElementById('novaMetaNome');
            const valEl = document.getElementById('novaMetaValor');
            if (nomeEl) nomeEl.value = nome;
            if (valEl) valEl.value = preco.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
        }

        function selecionarTipoMeta(btn, tipo, icone) {
            document.querySelectorAll('.chip-cat-meta').forEach(b => {
                b.className = 'chip-cat-meta flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition';
            });
            btn.className = 'chip-cat-meta active flex items-center gap-1.5 px-3 py-2 rounded-2xl border border-emerald-600 bg-emerald-800 text-white font-bold text-xs transition';
            document.getElementById('novaMetaCategoria').value = tipo;
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

        // ==========================================
        // METAS — Objetivos Individuais e do Lar
        // ==========================================
        let metasAbaAtiva = 'individual';

        function alternarAbaMetas(aba) {
            metasAbaAtiva = aba;
            const painelInd = document.getElementById('painelMeusObjetivos');
            const painelLar = document.getElementById('painelPlanoLar');
            const tabInd    = document.getElementById('tabMeusObjetivos');
            const tabLar    = document.getElementById('tabPlanoLar');

            const ativoClass = 'flex-1 py-2.5 px-3 rounded-xl text-sm font-semibold transition-all bg-card text-foreground shadow-2xs flex items-center justify-center gap-2';
            const inativoClass = 'flex-1 py-2.5 px-3 rounded-xl text-sm font-semibold transition-all text-muted-foreground hover:text-foreground flex items-center justify-center gap-2';

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

                // Hero Card
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

                // Ocultar aba do Lar se usuário for individual
                const semLar = !larSessao;
                const tabLarEl = document.getElementById('tabPlanoLar');
                if (semLar && tabLarEl) tabLarEl.classList.add('hidden');

                // Renderizar metas individuais
                _renderizarCardsMetasNovo(individuais, '#metasListaMeusObjetivos', false);

                // Renderizar metas do lar
                _renderizarCardsMetasNovo(metasLar, '#metasListaPlanoLar', true);

            } catch(e) { console.error('Erro metas:', e); }
        }

        function _renderizarCardsMetasNovo(metas, seletor, isLar) {
            const cont = document.querySelector(seletor);
            if (!cont) return;

            if (!metas.length) {
                cont.innerHTML = `<div class="flex flex-col items-center justify-center py-12 gap-2 text-center">
                    <i data-lucide="${isLar ? 'home' : 'target'}" class="size-10 text-muted-foreground/30 mx-auto"></i>
                    <p class="text-sm text-muted-foreground">${isLar ? 'Nenhuma meta compartilhada.' : 'Nenhuma meta individual cadastrada.'}</p>
                </div>`;
                lucide.createIcons();
                return;
            }

            cont.innerHTML = metas.map(m => {
                const atual = parseFloat(m.valor_atual || 0);
                const alvo  = parseFloat(m.valor_alvo  || 1);
                const faltam = Math.max(0, alvo - atual);
                const p     = Math.min(100, Math.round((atual / alvo) * 100));

                // Cor da barra de progresso
                const corBarra = p >= 70 ? 'bg-emerald-600' : p >= 30 ? 'bg-amber-500' : 'bg-rose-500';

                // Data limite formatada
                let dataLabel = '';
                if (m.data_limite) {
                    const d = new Date(m.data_limite + 'T12:00:00');
                    dataLabel = `Meta para ${d.toLocaleDateString('pt-BR', {month:'short', year:'numeric'})}`;
                }

                // Imagem real ou ícone Lucide
                const visualProduto = m.imagem
                    ? `<img src="${m.imagem}" alt="${m.titulo}" class="size-12 rounded-2xl object-cover shrink-0 border border-border shadow-2xs">`
                    : `<span class="size-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-300 flex items-center justify-center shrink-0 border border-emerald-500/20 shadow-2xs"><i data-lucide="${m.icone || 'target'}" class="size-6"></i></span>`;

                return `
                <div class="rounded-3xl border border-border bg-card shadow-2xs overflow-hidden">
                    <!-- Cabeçalho do card -->
                    <div class="p-4 pb-3 flex items-start justify-between gap-3">
                        <div class="flex items-start gap-3 min-w-0">
                            ${visualProduto}
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-extrabold text-foreground truncate">${m.titulo}</h4>
                                ${dataLabel ? `<span class="text-[11px] text-muted-foreground flex items-center gap-1 mt-0.5"><i data-lucide="calendar" class="size-3"></i> ${dataLabel}</span>` : ''}
                                ${m.link_referencia ? `
                                    <a href="${m.link_referencia}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-700 dark:text-emerald-400 hover:underline mt-0.5">
                                        <i data-lucide="external-link" class="size-3"></i>
                                        <span>${m.loja || 'Link do produto'} · Acompanhar preço</span>
                                    </a>
                                ` : ''}
                            </div>
                        </div>

                        ${m.em_negociacao ? `
                            <span class="px-2.5 py-0.5 rounded-full bg-amber-50 dark:bg-amber-950/40 border border-amber-300 text-amber-800 dark:text-amber-300 text-[10px] font-bold inline-flex items-center gap-1 shrink-0">
                                <i data-lucide="alert-triangle" class="size-3 text-amber-600"></i>
                                <span>Em negociação</span>
                            </span>
                        ` : ''}
                    </div>

                    <!-- Barra de progresso -->
                    <div class="px-4">
                        <div class="h-2 w-full rounded-full bg-muted overflow-hidden">
                            <div class="h-full ${corBarra} rounded-full transition-all duration-700" style="width:${p}%"></div>
                        </div>
                    </div>

                    <!-- Valores -->
                    <div class="px-4 py-2 flex items-center justify-between text-xs text-muted-foreground">
                        <strong class="font-bold text-foreground">${BRL(atual)}</strong>
                        <span>de ${BRL(alvo)} · <strong class="${corBarra === 'bg-emerald-600' ? 'text-emerald-600' : 'text-amber-600'}">${p}%</strong></span>
                    </div>

                    ${isLar ? `
                        <!-- Seção de Participantes (Divisão do Lar) -->
                        <div class="px-4 space-y-1.5 pt-2 border-t border-border/40">
                            <div class="flex items-center justify-between text-xs py-0.5">
                                <div class="flex items-center gap-2">
                                    <span class="size-5 rounded-full bg-muted text-muted-foreground font-extrabold text-[9px] flex items-center justify-center">ME</span>
                                    <span class="font-medium text-foreground">Você</span>
                                </div>
                                <strong class="font-bold text-foreground">R$ ${(m.divisao_voce || 250).toLocaleString('pt-BR', {minimumFractionDigits:2})}/mês</strong>
                            </div>
                            <div class="flex items-center justify-between text-xs py-0.5">
                                <div class="flex items-center gap-2">
                                    <span class="size-5 rounded-full bg-muted text-muted-foreground font-extrabold text-[9px] flex items-center justify-center">${m.parceiro_iniciais || 'IM'}</span>
                                    <span class="font-medium text-foreground">${m.parceiro_nome || 'Ian'}</span>
                                </div>
                                <strong class="font-bold text-foreground">R$ ${(m.divisao_parceiro || 250).toLocaleString('pt-BR', {minimumFractionDigits:2})}/mês</strong>
                            </div>
                        </div>

                        <!-- Card de Destino e Responsável -->
                        <div class="px-4 pt-2">
                            <div class="rounded-2xl border border-border bg-muted/30 p-3 grid grid-cols-2 gap-3 text-xs">
                                <div>
                                    <span class="text-[10px] text-muted-foreground flex items-center gap-1 mb-0.5">
                                        <i data-lucide="wallet" class="size-3"></i>
                                        Vai para
                                    </span>
                                    <strong class="font-bold text-foreground text-xs truncate block">${m.conta_destino || m.onde_guardado || 'Nubank Maria Eduarda'}</strong>
                                </div>
                                <div>
                                    <span class="text-[10px] text-muted-foreground flex items-center gap-1 mb-0.5">
                                        <i data-lucide="user" class="size-3"></i>
                                        Responsável
                                    </span>
                                    <strong class="font-bold text-foreground text-xs truncate block">${m.responsavel_nome || 'Maria Eduarda'}</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Botão de Ação do Lar -->
                        <div class="p-4 pt-3">
                            ${m.em_negociacao ? `
                                <button onclick="trocarAbaApp('acordos')" class="w-full py-3 rounded-2xl border border-amber-300 bg-amber-50 dark:bg-amber-950/20 hover:bg-amber-100 text-amber-900 dark:text-amber-200 font-bold text-xs flex items-center justify-center gap-1.5 transition">
                                    <span>Abrir Mesa de Acordos →</span>
                                </button>
                            ` : `
                                <button onclick="abrirGuardarNaMeta(${m.id_meta}, '${(m.titulo||'').replace(/'/g, "\\'")}', ${atual}, ${alvo}, 'lar')"
                                        class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs flex items-center justify-center gap-2 shadow-soft transition">
                                    <i data-lucide="plus" class="size-4"></i>
                                    <span>+ Guardar minha parte</span>
                                </button>
                            `}
                        </div>
                    ` : `
                        <!-- Mini-cards informativos Individuais -->
                        <div class="px-4 pb-2 grid grid-cols-2 gap-2">
                            <div class="rounded-xl border border-border bg-muted/30 p-2.5 space-y-0.5">
                                <span class="text-[10px] text-muted-foreground flex items-center gap-1">
                                    <i data-lucide="credit-card" class="size-2.5"></i>
                                    Guardado em
                                </span>
                                <p class="text-xs font-bold text-foreground truncate">${m.onde_guardado || 'Reserva Pessoal'}</p>
                            </div>
                            <div class="rounded-xl border border-border bg-muted/30 p-2.5 space-y-0.5">
                                <span class="text-[10px] text-muted-foreground flex items-center gap-1">
                                    <i data-lucide="trending-up" class="size-2.5"></i>
                                    Faltam
                                </span>
                                <p class="text-xs font-extrabold ${faltam <= 0 ? 'text-emerald-600' : 'text-foreground'}">${faltam <= 0 ? 'Concluída!' : BRL(faltam)}</p>
                            </div>
                        </div>

                        <!-- Botão de Aporte Individual -->
                        <div class="p-4 pt-1">
                            <button onclick="abrirGuardarNaMeta(${m.id_meta}, '${(m.titulo||'').replace(/'/g, "\\'")}', ${atual}, ${alvo}, 'individual')"
                                    class="w-full py-3 rounded-2xl bg-primary text-primary-foreground font-extrabold text-xs flex items-center justify-center gap-2 shadow-soft hover:bg-primary/90 transition">
                                <i data-lucide="plus" class="size-4"></i>
                                <span>+ Guardar para esta meta</span>
                            </button>
                        </div>
                    `}
                </div>`;
            }).join('');
            lucide.createIcons();
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
            abrirModalCriarMeta();
        }

        // ==========================================
        // RECEBIMENTOS — Relatórios por Período
        // ==========================================
        let recebMesAtivo = new Date().toISOString().slice(0,7);

        async function carregarRecebimentosDados(mes) {
            if (mes) recebMesAtivo = mes;
            try {
                const res = await fetch(`/api/recebimentos?mes=${recebMesAtivo}`);
                if (!res.ok) return;
                const d = await res.json();

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
                if (rdLabel && d.mes) {
                    const dataRef = new Date(d.mes + '-01');
                    rdLabel.innerText = dataRef.toLocaleDateString('pt-BR', {month:'long', year:'numeric'});
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
                                <span class="text-sm font-extrabold text-emerald-600 shrink-0">+${BRL(e.valor)}</span>
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
            const mensagem = `Oi! Passando só pra lembrar com carinho da divisão de ${titulo} (${BRL(valor)})`;
            await fetch('/api/cobrancas/lembrete', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ destinatario_id: destId, titulo, valor, mensagem })
            });
            seivaNotificar('Lembrete diplomático enviado com sucesso pelo SEIVA!', 'sucesso', 'Lembrete Enviado');
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
            { id: 'lar',        icone: 'home',           label: 'Área do Lar',         cor: '#059669', bg: '#ecfdf5', fn: "trocarAbaApp('lar')",        padrao: false, casalOnly: true },
            { id: 'acordos',    icone: 'handshake',      label: 'Mesa de Acordos',     cor: '#d97706', bg: '#fffbeb', fn: "trocarAbaApp('acordos')",    padrao: false, casalOnly: true },
            { id: 'cobrador',   icone: 'bell-ring',      label: 'Cobrador Diplomata',  cor: '#7c3aed', bg: '#f5f3ff', fn: "trocarAbaApp('cobrador')",   padrao: false, casalOnly: true },
            { id: 'relatorio',  icone: 'bar-chart-2',   label: 'Relatórios',          cor: '#1d4ed8', bg: '#eff6ff', fn: "seivaNotificar('Relatórios em breve!','info')", padrao: false },
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
                        sub.innerText = `${totalNaoLidas} notificação${totalNaoLidas > 1 ? 'ões' : ''} pendente${totalNaoLidas > 1 ? 's' : ''} para você`;
                    } else {
                        sub.innerText = 'Tudo em dia! Nenhuma pendência.';
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
            const tabLar         = document.getElementById('tabHeroCustoLar');
            const tabsContainer  = document.getElementById('heroToggleTabsContainer');
            const sliderNav      = document.getElementById('sliderNavContainer');
            const sliderDotLar   = document.getElementById('sliderDotLar');
            const sliderDica     = document.getElementById('sliderTextoDica');
            const cardLar        = document.getElementById('cardHeroCustoLar');
            const heroTituloSec  = document.getElementById('heroTituloSecao');
            const bannerAjuda    = document.getElementById('bannerPedidoAjuda');
            const secaoLarSide   = document.getElementById('secaoLarSidebar');

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
            const secaoPraReg = document.getElementById('dashPraRegistrarHojeList');
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
                            <button type="button" onclick="abrirModalRegistrarPagamento('${item.id}')"
                                    class="px-4 py-1.5 rounded-xl bg-[#c84b31] hover:bg-[#b03d25] text-white font-bold text-xs transition shadow-2xs">
                                Registrar
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

            // — Despesas Fixas —
            const despFixasGrid = document.getElementById('dashDespesasFixasGrid');
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

        // 4. Modal Atualizar Saldo (Imagem 3)
        function abrirModalAtualizarSaldo() {
            const contas = dashboardDadosCache?.contas || listaContas || [];
            const containerChips = document.getElementById('modalSaldoChipsContas');
            if (containerChips && contas.length) {
                contaAjusteSaldoId = contas[0].id_conta;
                containerChips.innerHTML = contas.map((c, i) => `
                    <button type="button" onclick="selecionarContaAjusteSaldo(${c.id_conta}, '${c.nome.replace(/'/g, "\\'")}', ${c.saldo})" 
                            class="chip-conta-saldo flex items-center gap-1.5 px-3 py-1.5 rounded-xl border text-xs font-bold transition ${i === 0 ? 'border-emerald-600 bg-emerald-50 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300' : 'border-border bg-card text-muted-foreground hover:text-foreground'}">
                        <span class="size-2 rounded-full" style="background-color: ${c.cor || '#10b981'}"></span>
                        <span>${c.nome}</span>
                    </button>
                `).join('');
                selecionarContaAjusteSaldo(contas[0].id_conta, contas[0].nome, contas[0].saldo);
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

        // 5. Modal Saúde Financeira (Imagem 4)
        function abrirModalSaudeFinanceira() {
            const sf = dashboardDadosCache?.saude_financeira;
            if (sf) {
                const scoreTxt = document.getElementById('modalSaudeScoreTxt');
                const statusTxt = document.getElementById('modalSaudeStatusTxt');
                const notaTxt = document.getElementById('modalSaudeNotaTxt');
                const circle = document.getElementById('modalSaudeCircleProgress');

                if (scoreTxt) scoreTxt.innerText = `${sf.score}%`;
                if (statusTxt) {
                    statusTxt.innerText = sf.status;
                    statusTxt.className = `text-xs font-bold ${sf.score >= 80 ? 'text-emerald-600' : (sf.score >= 60 ? 'text-amber-600' : 'text-red-500')}`;
                }
                if (notaTxt) {
                    notaTxt.innerText = `Seu score é ${sf.score}% — ${sf.status.toLowerCase()} ao equilíbrio. Veja o que compõe essa nota:`;
                }
                if (circle) {
                    const C = 251.2;
                    const offset = C - (sf.score / 100) * C;
                    circle.setAttribute('stroke-dashoffset', Math.round(offset));
                    circle.setAttribute('stroke', sf.score >= 80 ? '#10b981' : (sf.score >= 60 ? '#f59e0b' : '#ef4444'));
                }

                // Preencher insights específicos
                if (sf.insights && sf.insights.length >= 3) {
                    const p1 = document.getElementById('modalSaudePilar1Titulo');
                    if (p1) p1.innerText = sf.insights[0].texto;
                    const p2 = document.getElementById('modalSaudePilar2Titulo');
                    if (p2) p2.innerText = sf.insights[1].texto;
                    const p3 = document.getElementById('modalSaudePilar3Titulo');
                    if (p3) p3.innerText = sf.insights[2].texto;
                }
            }
            document.getElementById('modalSaudeFinanceira')?.classList.remove('hidden');
            lucide.createIcons();
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
            document.getElementById('gastoCategoriaSelecionada').value = nomeCat;
            document.querySelectorAll('#gastoChipsCategorias .cat-chip').forEach(b => {
                b.className = 'cat-chip flex flex-col items-center justify-center p-2.5 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-[11px] transition';
            });
            btn.className = 'cat-chip active flex flex-col items-center justify-center p-2.5 rounded-2xl border border-emerald-600 bg-emerald-800 text-white font-bold text-[11px] transition';
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
            const btnPriv = document.getElementById('btnGastoPrivado');
            const btnComp = document.getElementById('btnGastoCompartilhar');
            if (tipo === 'privado') {
                if (btnPriv) btnPriv.className = 'flex-1 py-2 px-3 rounded-xl font-bold text-xs transition-all bg-card text-foreground shadow-2xs';
                if (btnComp) btnComp.className = 'flex-1 py-2 px-3 rounded-xl font-bold text-xs transition-all text-muted-foreground hover:text-foreground';
            } else {
                if (btnComp) btnComp.className = 'flex-1 py-2 px-3 rounded-xl font-bold text-xs transition-all bg-card text-foreground shadow-2xs';
                if (btnPriv) btnPriv.className = 'flex-1 py-2 px-3 rounded-xl font-bold text-xs transition-all text-muted-foreground hover:text-foreground';
            }
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
                const res = await fetch('/api/transacoes', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({
                        tipo: 'saida',
                        titulo,
                        valor,
                        conta_id: contaGastoAtual,
                        categoria_nome: categoriaGastoAtual,
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

