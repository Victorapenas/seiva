<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SEIVA — Dinheiro Sem Tabu | Finanças do Casal & Lares Compartilhados</title>
    
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

    <!-- ============================================================== -->
    <!-- SCRIPT MASTER DE ORQUESTRAÇÃO & COMUNICAÇÃO COM O BACKEND       -->
    <!-- ============================================================== -->
    <script>
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

            if (!nome || !email || !senha) return alert('Por favor, preencha todos os campos obrigatórios.');
            if (senha !== senhaConf) return alert('As senhas não coincidem.');
            if (senha.length < 6) return alert('A senha deve ter no mínimo 6 caracteres.');

            btn.disabled = true;
            btn.innerHTML = '<span class="inline-block animate-spin mr-2">⏳</span> Criando sua conta...';

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
                    alert(data.error || 'Erro ao realizar cadastro.');
                }
            } catch (err) {
                alert('Erro de conexão ao comunicar com o servidor.');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<span>Criar minha conta no SEIVA</span><i data-lucide="arrow-right" class="size-4"></i>';
                lucide.createIcons();
            }
        }

        function irParaOnboarding() {
            stepOnboarding = 0;
            const faseWelcome = document.getElementById('onboardingFaseWelcome');
            const faseForm = document.getElementById('onboardingFaseForm');
            if (faseWelcome) faseWelcome.classList.remove('hidden');
            if (faseForm) faseForm.classList.add('hidden');
            trocarTelaPrincipal('screen-onboarding');
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
            if (stepOnboarding === 0) {
                irParaLogin();
            } else {
                stepOnboarding--;
                renderizarPassoOnboarding();
            }
        }

        function renderizarPassoOnboarding() {
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

        async function avancarEtapaOnboarding() {
            if (stepOnboarding === 0) {
                const nome = document.getElementById('regNome').value.trim();
                const email = document.getElementById('regEmail').value.trim();
                const senha = document.getElementById('regSenha').value;
                const senhaConf = document.getElementById('regSenhaConfirma').value;

                if (!nome || !email || !senha) return alert('Por favor, preencha todos os campos obrigatórios.');
                if (senha !== senhaConf) return alert('As senhas não coincidem.');
                if (senha.length < 6) return alert('A senha deve ter no mínimo 6 caracteres.');

                stepOnboarding = 1;
                renderizarPassoOnboarding();
                return;
            }

            if (stepOnboarding === 1) {
                stepOnboarding = 2;
                renderizarPassoOnboarding();
                return;
            }

            if (stepOnboarding === 2) {
                stepOnboarding = 3;
                renderizarPassoOnboarding();
                return;
            }

            if (stepOnboarding === 3) {
                const btnAvancar = document.getElementById('btnAvancarOnboarding');
                btnAvancar.disabled = true;
                btnAvancar.innerHTML = '<span class="inline-block animate-spin mr-2">⏳</span> Criando sua conta...';

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
                    saldo_inicial: parseFloat(document.getElementById('regSaldoInicial').value) || null,
                    banco_principal: bancoOnboarding,
                    chave_pix: document.getElementById('regPix').value.trim(),
                    pin_caixa_preta: document.getElementById('regPinCaixa').value || '1234',
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
                            const nomeLar = document.getElementById('regNomeLar').value || 'Nosso Cantinho';
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
                        alert(data.error || 'Erro ao realizar cadastro.');
                    }
                } catch (err) {
                    alert('Erro de conexão ao realizar cadastro.');
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
            const btn = document.getElementById('loginSubmitBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="inline-block animate-spin mr-2">⏳</span> Validando acesso...';

            const email = document.getElementById('loginEmail').value.trim();
            const senha = document.getElementById('loginSenha').value;
            const lembrar = document.getElementById('loginLembrar') ? document.getElementById('loginLembrar').checked : true;

            try {
                const res = await fetch('/api/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, senha, lembrar })
                });

                const data = await res.json();
                if (res.ok) {
                    usuarioSessao = data.usuario;
                    larSessao = (data.usuario.lares && data.usuario.lares.length) ? data.usuario.lares[0] : null;
                    montarAmbienteLogado();
                    trocarTelaPrincipal('screen-app');
                } else {
                    alert(data.error || 'E-mail ou senha incorretos.');
                }
            } catch (err) {
                alert('Erro de conexão ao comunicar com o servidor.');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<span>Entrar no SEIVA</span><i data-lucide="arrow-right" class="size-4"></i>';
                lucide.createIcons();
            }
        }

        // --- INTEGRAÇÃO GOOGLE IDENTITY SERVICES ---
        // Sem modal, sem formulário manual. GIS real → se já tem conta entra no app,
        // se é primeira vez vai para o onboarding com nome/e-mail pré-preenchidos.
        function iniciarGoogleAuth() {
            if (window.google && google.accounts && google.accounts.id) {
                try {
                    google.accounts.id.initialize({
                        client_id: "{{ config('services.google.client_id', '467352153539-seiva-placeholder.apps.googleusercontent.com') }}",
                        callback: handleGoogleCredentialResponse,
                        auto_select: false,
                        cancel_on_tap_outside: true,
                    });
                    // Tenta One Tap; se falhar (pop-up bloqueado etc.) não exibe nada extra
                    google.accounts.id.prompt((notification) => {
                        if (notification.isNotDisplayed() || notification.isSkippedMoment()) {
                            // One Tap bloqueado → abre o fluxo de popup OAuth
                            google.accounts.id.renderButton(
                                document.getElementById('googleGisButtonContainer'),
                                { theme: 'outline', size: 'large', width: 280, text: 'continue_with' }
                            );
                        }
                    });
                } catch (err) {
                    console.warn('GIS inicialização falhou:', err);
                    _googleAuthFallback();
                }
            } else {
                // GIS não carregou (offline / bloqueado) — usa fluxo simplificado
                _googleAuthFallback();
            }
        }

        // Fallback: simula resposta Google com e-mail de desenvolvimento
        // (apenas para demo/apresentação quando o GIS real não está disponível)
        function _googleAuthFallback() {
            const email = prompt('⚠️ GIS indisponível (demo).\nDigite o e-mail Google para simular o acesso:');
            if (!email) return;
            const nome = email.split('@')[0].replace(/[._]/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
            _processarDadosGoogle({ google_id: 'google_demo_' + btoa(email), name: nome, email, picture: null });
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
                    usuarioSessao = data.usuario;
                    larSessao = (data.usuario.lares && data.usuario.lares.length) ? data.usuario.lares[0] : null;
                    if (!larSessao) {
                        // Primeira vez: vai para o onboarding configurar o Lar
                        _preencherOnboardingComDadosGoogle(data.usuario);
                        irParaOnboarding();
                    } else {
                        montarAmbienteLogado();
                        trocarTelaPrincipal('screen-app');
                    }
                } else {
                    alert(data.error || 'Não foi possível validar o token do Google.');
                }
            } catch (err) {
                alert('Erro de conexão com o servidor de autenticação.');
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
                    usuarioSessao = data.usuario;
                    larSessao = (data.usuario.lares && data.usuario.lares.length) ? data.usuario.lares[0] : null;
                    if (!larSessao) {
                        _preencherOnboardingComDadosGoogle(data.usuario);
                        irParaOnboarding();
                    } else {
                        montarAmbienteLogado();
                        trocarTelaPrincipal('screen-app');
                    }
                } else {
                    alert(data.error || 'Erro na autenticação com o Google.');
                }
            } catch (err) {
                alert('Erro de conexão ao comunicar com a API.');
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
            const iniciais = usuarioSessao.iniciais || usuarioSessao.nome.substring(0, 2).toUpperCase();
            const primeiroNome = usuarioSessao.nome.split(' ')[0];

            document.getElementById('userNameSidebar').innerText = usuarioSessao.nome;
            document.getElementById('userAvatarSidebar').innerText = iniciais;
            document.getElementById('dashAvatar').innerText = iniciais;
            document.getElementById('dashGreeting').innerText = `Olá, ${primeiroNome}`;
            document.getElementById('perfilNomeTxt').innerText = usuarioSessao.nome;
            document.getElementById('perfilEmailTxt').innerText = usuarioSessao.email;
            document.getElementById('perfilAvatarCircle').innerText = iniciais;

            if (larSessao) {
                document.getElementById('userLarPillSidebar').innerText = `${larSessao.nome} 🌿`;
                document.getElementById('labelGrupoLarSidebar').innerText = `🌿 ${larSessao.nome}`;
                document.getElementById('larHeaderTitle').innerText = larSessao.nome;
            }

            carregarDashboardDados();
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

        // --- DASHBOARD ---
        async function carregarDashboardDados() {
            try {
                const res = await fetch('/api/dashboard');
                if (!res.ok) return;
                const data = await res.json();

                listaContas = data.contas || [];
                popularSelectsContas(listaContas);

                const livre = data.resumo.saldo_livre || 0;
                const comp = data.resumo.saldo_comprometido || 0;
                document.getElementById('dashValSaldoLivre').innerText = saldosVisiveis ? BRL(livre) : 'R$ ••••••';
                document.getElementById('dashValComprometido').innerText = saldosVisiveis ? BRL(comp) : '••••';
                document.getElementById('dashValLivre').innerText = saldosVisiveis ? BRL(livre) : '••••';

                const cont = document.getElementById('dashContasList');
                if (!listaContas.length) {
                    cont.innerHTML = '<p class="text-xs text-muted-foreground py-4 text-center">Nenhuma conta cadastrada.</p>';
                } else {
                    cont.innerHTML = listaContas.map(c => `
                        <div class="flex items-center justify-between p-3.5 rounded-2xl border border-border bg-card shadow-soft">
                            <div class="flex items-center gap-3">
                                <span class="size-9 rounded-xl bg-muted text-foreground flex items-center justify-center font-bold text-xs">
                                    ${c.nome.substring(0, 2).toUpperCase()}
                                </span>
                                <div>
                                    <p class="text-xs font-semibold text-foreground">${c.nome}</p>
                                    <span class="text-[10px] text-muted-foreground capitalize">${c.tipo}</span>
                                </div>
                            </div>
                            <span class="text-sm font-bold text-foreground">${saldosVisiveis ? BRL(c.saldo) : '••••'}</span>
                        </div>
                    `).join('');
                }
            } catch (e) {}
        }

        function alternarVisibilidadeSaldos() {
            saldosVisiveis = !saldosVisiveis;
            const btn = document.getElementById('btnVisSaldos');
            btn.innerHTML = saldosVisiveis ? '<i data-lucide="eye" class="size-3.5"></i><span>Ocultar</span>' : '<i data-lucide="eye-off" class="size-3.5"></i><span>Mostrar</span>';
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
            if (!pin) return alert('Digite o PIN de 4 dígitos.');

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
                alert(data.error || 'PIN incorreto.');
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
            alert('Lembrete diplomático enviado!');
        }

        // --- MODAIS DE LANÇAMENTO ---
        function alternarFab() {
            document.getElementById('fabDropdown').classList.toggle('hidden');
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
            const titulo = document.getElementById('formTransTitulo').value;
            const valor = parseFloat(document.getElementById('formTransValor').value);
            const conta_id = document.getElementById('formTransContaId').value;
            const categoria_id = document.getElementById('formTransCategoriaId').value;

            const res = await fetch('/api/transacoes', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ tipo, titulo, valor, conta_id, categoria_id })
            });

            if (res.ok) {
                fecharModalId('modalTransacao');
                carregarDashboardDados();
                carregarExtratoDados();
            } else {
                alert('Erro ao registrar.');
            }
        }

        async function salvarDespesaLarForm(e) {
            e.preventDefault();
            const titulo = document.getElementById('formLarDespTitulo').value;
            const valor_total = parseFloat(document.getElementById('formLarDespValor').value);
            const divisao = document.getElementById('formLarDespDivisao').value;
            const data_vencimento = document.getElementById('formLarDespData').value;

            const res = await fetch('/api/lar/despesas', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ titulo, valor_total, divisao, tipo: 'fixa', data_vencimento })
            });

            if (res.ok) {
                fecharModalId('modalDespesaLar');
                carregarLarDados();
            } else {
                alert('Erro ao registrar despesa do lar.');
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
    </script>
</body>
</html>
