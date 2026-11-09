<!DOCTYPE html>
<html lang="pt-BR" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEIVA — Onde seu dinheiro cria raízes</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#faf9f5',
                        foreground: '#1c2826',
                        card: {
                            DEFAULT: '#ffffff',
                            foreground: '#1c2826',
                        },
                        primary: {
                            DEFAULT: '#2e6b4f',
                            foreground: '#ffffff',
                        },
                        secondary: {
                            DEFAULT: '#eef3ef',
                            foreground: '#285f46',
                        },
                        muted: {
                            DEFAULT: '#f0f2ee',
                            foreground: '#6b7770',
                        },
                        accent: {
                            DEFAULT: '#e2ede6',
                            foreground: '#22513c',
                        },
                        destructive: {
                            DEFAULT: '#dc2626',
                            foreground: '#ffffff',
                        },
                        success: '#16a34a',
                        warning: {
                            DEFAULT: '#d97706',
                            foreground: '#78350f',
                        },
                        border: '#e8eae6',
                        input: '#e8eae6',
                        ring: '#2e6b4f',
                        sidebar: '#ffffff',
                    },
                    fontFamily: {
                        sans: ['"Inter"', 'system-ui', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 1px 3px rgba(30, 48, 38, 0.04), 0 4px 12px rgba(30, 48, 38, 0.05)',
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
        /* Floating label helper */
        .floating-input:focus ~ .floating-label,
        .floating-input:not(:placeholder-shown) ~ .floating-label {
            top: 0.5rem;
            font-size: 0.7rem;
            color: #2e6b4f;
        }
    </style>
</head>
<body class="min-h-screen bg-background text-foreground antialiased selection:bg-primary selection:text-white">

    <!-- ========================================== -->
    <!-- 1. TELA DE LOGIN (LOGIN SCREEN DO PROTÓTIPO) -->
    <!-- ========================================== -->
    <div id="screen-login" class="relative flex min-h-screen items-center justify-center overflow-hidden bg-background px-4 py-10 lg:block lg:p-0">
        <!-- Painel decorativo lateral — Desktop (50% da tela em verde primário) -->
        <div class="pointer-events-none absolute inset-y-0 left-0 hidden w-1/2 bg-primary lg:block">
            <div class="flex h-full flex-col justify-between p-12 text-primary-foreground">
                <!-- Seiva Wordmark -->
                <div class="flex items-center gap-2">
                    <div class="relative size-9 overflow-hidden rounded-xl border border-primary-foreground/20 bg-primary-foreground/10 flex items-center justify-center">
                        <img src="/seiva-logo.png" alt="SEIVA" class="object-contain p-1 w-full h-full" onerror="this.src='/icon.svg'">
                    </div>
                    <span class="text-lg font-semibold tracking-tight text-primary-foreground">SEIVA</span>
                </div>

                <div>
                    <h2 class="max-w-sm text-balance text-3xl font-bold leading-tight tracking-tight text-white">
                        Organize as finanças do casal sem brigas.
                    </h2>
                    <p class="mt-4 max-w-sm text-pretty text-sm leading-relaxed text-primary-foreground/80">
                        Contas pessoais e compartilhadas, acordos negociáveis e metas em conjunto — tudo num só lugar, com privacidade.
                    </p>
                    <div class="mt-8 flex items-center gap-2 text-sm text-primary-foreground/80">
                        <i data-lucide="leaf" class="size-4"></i>
                        Onde seu dinheiro cria raízes
                    </div>
                </div>
            </div>
        </div>

        <!-- Painel Central / Formulário de Entrada -->
        <div class="relative z-10 mx-auto w-full max-w-md lg:ml-[50%] lg:flex lg:min-h-screen lg:w-1/2 lg:max-w-none lg:items-center lg:justify-center lg:px-8">
            <div class="w-full lg:max-w-md">
                <!-- Mobile Logo Header -->
                <div class="mb-8 flex flex-col items-center lg:hidden text-center">
                    <div class="relative size-20 overflow-hidden rounded-2xl border border-border bg-card p-2 shadow-soft">
                        <img src="/seiva-logo.png" alt="SEIVA" class="object-contain w-full h-full" onerror="this.src='/icon.svg'">
                    </div>
                    <h1 class="mt-4 text-2xl font-bold tracking-tight text-foreground">SEIVA</h1>
                    <p class="mt-1 flex items-center gap-1.5 text-sm text-muted-foreground">
                        <i data-lucide="leaf" class="size-4 text-primary"></i>
                        Onde seu dinheiro cria raízes
                    </p>
                </div>

                <!-- Card de Login -->
                <div class="rounded-3xl border border-border bg-card p-6 shadow-card lg:shadow-elevated">
                    <!-- Abas: Entrar vs Criar Conta -->
                    <div class="relative mb-6 flex rounded-2xl bg-muted p-1">
                        <button onclick="switchLoginTab('entrar')" id="tabBtnEntrar" class="relative z-10 flex-1 rounded-xl py-2.5 text-sm font-semibold transition-colors bg-primary text-primary-foreground shadow-soft">
                            Entrar
                        </button>
                        <button onclick="abrirOnboarding()" id="tabBtnCriar" class="relative z-10 flex-1 rounded-xl py-2.5 text-sm font-semibold text-muted-foreground hover:text-foreground transition-colors">
                            Criar conta
                        </button>
                    </div>

                    <!-- Formulário de Login -->
                    <form onsubmit="realizarLogin(event)" class="space-y-4">
                        <!-- Floating Input Email -->
                        <div class="relative">
                            <input type="email" id="loginEmail" required placeholder=" " class="floating-input peer h-14 w-full rounded-2xl border border-border bg-background px-4 pt-4 text-sm text-foreground outline-none transition-colors focus:border-primary focus:ring-2 focus:ring-primary/20">
                            <label class="floating-label pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-muted-foreground transition-all duration-200">
                                E-mail
                            </label>
                        </div>

                        <!-- Floating Input Senha -->
                        <div class="relative">
                            <input type="password" id="loginSenha" required placeholder=" " class="floating-input peer h-14 w-full rounded-2xl border border-border bg-background px-4 pt-4 text-sm text-foreground outline-none transition-colors focus:border-primary focus:ring-2 focus:ring-primary/20">
                            <label class="floating-label pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-muted-foreground transition-all duration-200">
                                Senha
                            </label>
                        </div>

                        <div class="flex items-center justify-between text-xs pt-1">
                            <label class="flex items-center gap-2 cursor-pointer text-muted-foreground">
                                <input type="checkbox" checked class="rounded border-border text-primary focus:ring-primary">
                                Lembrar de mim
                            </label>
                            <a href="#" onclick="alert('Recuperação de senha: informe seu e-mail cadastrado.'); return false;" class="font-medium text-primary hover:underline">
                                Esqueceu a senha?
                            </a>
                        </div>

                        <button type="submit" id="loginSubmitBtn" class="w-full mt-2 h-13 py-3.5 rounded-2xl bg-primary text-primary-foreground font-semibold text-sm shadow-card hover:bg-primary/90 active:scale-[0.99] transition flex items-center justify-center gap-2">
                            <span>Entrar no SEIVA</span>
                            <i data-lucide="arrow-right" class="size-4"></i>
                        </button>
                    </form>

                    <!-- Divisor -->
                    <div class="relative my-6 flex items-center justify-center">
                        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-border"></div></div>
                        <span class="relative bg-card px-3 text-xs text-muted-foreground">ou continue com</span>
                    </div>

                    <!-- Botão Google -->
                    <button type="button" onclick="alert('Integração Google Auth.');" class="w-full h-12 rounded-2xl border border-border bg-card hover:bg-muted/50 text-foreground font-medium text-sm transition flex items-center justify-center gap-3">
                        <svg viewBox="0 0 24 24" class="size-5" aria-hidden="true">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.27-4.74 3.27-8.1Z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84A11 11 0 0 0 12 23Z"/>
                            <path fill="#FBBC05" d="M5.84 14.1a6.6 6.6 0 0 1 0-4.2V7.06H2.18a11 11 0 0 0 0 9.88l3.66-2.84Z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1A11 11 0 0 0 2.18 7.06l3.66 2.84C6.71 7.3 9.14 5.38 12 5.38Z"/>
                        </svg>
                        <span>Continuar com Google</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- 2. TELA DE ONBOARDING / CADASTRO COMPLETO  -->
    <!-- ========================================== -->
    <div id="screen-onboarding" class="hidden min-h-screen bg-background flex flex-col justify-between p-4 sm:p-8">
        <div class="max-w-lg mx-auto w-full my-auto">
            <!-- Header do Onboarding -->
            <div class="flex items-center justify-between mb-6">
                <button onclick="fecharOnboarding()" class="p-2 -ml-2 rounded-xl text-muted-foreground hover:bg-muted transition">
                    <i data-lucide="arrow-left" class="size-5"></i>
                </button>
                <div class="flex items-center gap-1.5">
                    <span id="stepDot0" class="size-2.5 rounded-full bg-primary"></span>
                    <span id="stepDot1" class="size-2.5 rounded-full bg-border"></span>
                    <span id="stepDot2" class="size-2.5 rounded-full bg-border"></span>
                    <span id="stepDot3" class="size-2.5 rounded-full bg-border"></span>
                </div>
                <span id="stepCountLabel" class="text-xs font-semibold text-muted-foreground">1 de 4</span>
            </div>

            <!-- PASSO 1: DADOS PESSOAIS -->
            <div id="onboardingStep0" class="onboarding-step space-y-4">
                <div class="mb-4">
                    <h2 class="text-2xl font-bold tracking-tight text-foreground">Como podemos te chamar?</h2>
                    <p class="text-xs text-muted-foreground mt-1">Crie sua conta para começar a organizar as finanças.</p>
                </div>

                <div class="space-y-3">
                    <div>
                        <label class="text-xs font-medium text-foreground">Seu Nome Completo</label>
                        <input type="text" id="obNome" placeholder="Ex: Maria Eduarda Lima" class="mt-1 h-12 w-full rounded-2xl border border-border bg-card px-4 text-sm text-foreground outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-foreground">E-mail</label>
                        <input type="email" id="obEmail" placeholder="seu@email.com" class="mt-1 h-12 w-full rounded-2xl border border-border bg-card px-4 text-sm text-foreground outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-foreground">Telefone / WhatsApp (opcional)</label>
                        <input type="tel" id="obTelefone" placeholder="(71) 99999-9999" class="mt-1 h-12 w-full rounded-2xl border border-border bg-card px-4 text-sm text-foreground outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-foreground">Crie uma Senha</label>
                        <input type="password" id="obSenha" oninput="avaliarForcaSenha(this.value)" placeholder="Pelo menos 6 caracteres" class="mt-1 h-12 w-full rounded-2xl border border-border bg-card px-4 text-sm text-foreground outline-none focus:border-primary">
                        <!-- Medidor de Força da Senha -->
                        <div class="mt-2 flex items-center gap-2">
                            <div class="flex-1 h-1.5 rounded-full bg-muted overflow-hidden flex gap-1">
                                <div id="forcaBar1" class="h-full flex-1 bg-muted"></div>
                                <div id="forcaBar2" class="h-full flex-1 bg-muted"></div>
                                <div id="forcaBar3" class="h-full flex-1 bg-muted"></div>
                            </div>
                            <span id="forcaLabel" class="text-[10px] font-bold text-muted-foreground"></span>
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-foreground">Confirme a Senha</label>
                        <input type="password" id="obSenhaConfirma" placeholder="Digite a mesma senha" class="mt-1 h-12 w-full rounded-2xl border border-border bg-card px-4 text-sm text-foreground outline-none focus:border-primary">
                    </div>
                </div>
            </div>

            <!-- PASSO 2: RENDA -->
            <div id="onboardingStep1" class="onboarding-step space-y-4 hidden">
                <div class="mb-4">
                    <h2 class="text-2xl font-bold tracking-tight text-foreground">Qual é a sua renda?</h2>
                    <p class="text-xs text-muted-foreground mt-1">Isso ajuda a calcular a proporção justa nas despesas da casa.</p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-medium text-foreground">Tipo de Renda</label>
                        <div class="grid grid-cols-3 gap-2 mt-1.5">
                            <button type="button" onclick="selectTipoRenda('clt')" id="btnRendaCLT" class="py-2.5 rounded-xl border border-primary bg-accent text-accent-foreground font-semibold text-xs transition">CLT</button>
                            <button type="button" onclick="selectTipoRenda('pj')" id="btnRendaPJ" class="py-2.5 rounded-xl border border-border bg-card text-muted-foreground font-semibold text-xs transition">PJ</button>
                            <button type="button" onclick="selectTipoRenda('autonomo')" id="btnRendaAutonomo" class="py-2.5 rounded-xl border border-border bg-card text-muted-foreground font-semibold text-xs transition">Autônomo</button>
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-medium text-foreground">Salário Líquido Mensal (R$)</label>
                        <input type="number" step="0.01" id="obRenda" placeholder="Ex: 2500,00" class="mt-1 h-12 w-full rounded-2xl border border-border bg-card px-4 text-base font-bold text-foreground outline-none focus:border-primary">
                    </div>

                    <div>
                        <label class="text-xs font-medium text-foreground">Dia do mês que você costuma receber</label>
                        <input type="number" min="1" max="31" id="obDiaRecebe" placeholder="Ex: 5" class="mt-1 h-12 w-full rounded-2xl border border-border bg-card px-4 text-sm text-foreground outline-none focus:border-primary">
                    </div>

                    <div>
                        <label class="text-xs font-medium text-foreground">Renda extra / Freelas estimados (R$)</label>
                        <input type="number" step="0.01" id="obRendaExtra" placeholder="0,00 (se houver)" class="mt-1 h-12 w-full rounded-2xl border border-border bg-card px-4 text-sm text-foreground outline-none focus:border-primary">
                    </div>
                </div>
            </div>

            <!-- PASSO 3: CONTAS E PIN -->
            <div id="onboardingStep2" class="onboarding-step space-y-4 hidden">
                <div class="mb-4">
                    <h2 class="text-2xl font-bold tracking-tight text-foreground">Onde você guarda dinheiro?</h2>
                    <p class="text-xs text-muted-foreground mt-1">Conecte sua conta principal e defina o PIN da sua Caixa Preta.</p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-medium text-foreground">Seu Banco Principal</label>
                        <div class="grid grid-cols-4 gap-2 mt-1.5">
                            <button type="button" onclick="selectBanco('Nubank')" class="banco-btn py-2.5 rounded-xl border border-primary bg-accent text-accent-foreground font-bold text-xs">Nubank</button>
                            <button type="button" onclick="selectBanco('Inter')" class="banco-btn py-2.5 rounded-xl border border-border bg-card text-muted-foreground font-bold text-xs">Inter</button>
                            <button type="button" onclick="selectBanco('Itaú')" class="banco-btn py-2.5 rounded-xl border border-border bg-card text-muted-foreground font-bold text-xs">Itaú</button>
                            <button type="button" onclick="selectBanco('Caixa')" class="banco-btn py-2.5 rounded-xl border border-border bg-card text-muted-foreground font-bold text-xs">Caixa</button>
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-medium text-foreground">Saldo atual aproximado (R$)</label>
                        <input type="number" step="0.01" id="obSaldoInicial" placeholder="Ex: 1450,00" class="mt-1 h-12 w-full rounded-2xl border border-border bg-card px-4 text-base font-bold text-foreground outline-none focus:border-primary">
                    </div>

                    <div>
                        <label class="text-xs font-medium text-foreground">Sua Chave PIX Principal</label>
                        <input type="text" id="obPix" placeholder="CPF, telefone ou e-mail" class="mt-1 h-12 w-full rounded-2xl border border-border bg-card px-4 text-sm text-foreground outline-none focus:border-primary">
                    </div>

                    <div class="rounded-2xl border border-border bg-muted/60 p-4">
                        <div class="flex items-center gap-2">
                            <i data-lucide="lock" class="size-4 text-primary"></i>
                            <label class="text-xs font-bold text-foreground">PIN da Caixa Preta (4 dígitos)</label>
                        </div>
                        <p class="text-[11px] text-muted-foreground mt-1">Senha exclusiva para abrir seus gastos confidenciais e surpresas.</p>
                        <input type="password" maxlength="4" id="obPin" placeholder="1234" class="mt-2 h-11 w-36 rounded-xl border border-border bg-card px-3 text-center text-lg font-bold tracking-widest text-foreground outline-none focus:border-primary">
                    </div>
                </div>
            </div>

            <!-- PASSO 4: CRIAR O LAR -->
            <div id="onboardingStep3" class="onboarding-step space-y-4 hidden">
                <div class="mb-4">
                    <h2 class="text-2xl font-bold tracking-tight text-foreground">Vamos montar seu Lar? 🌿</h2>
                    <p class="text-xs text-muted-foreground mt-1">O espaço compartilhado onde você divide contas com seu parceiro(a).</p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-medium text-foreground">Nome do Lar</label>
                        <input type="text" id="obNomeLar" value="Nosso Cantinho" class="mt-1 h-12 w-full rounded-2xl border border-border bg-card px-4 text-sm font-semibold text-foreground outline-none focus:border-primary">
                    </div>

                    <div>
                        <label class="text-xs font-medium text-foreground">E-mail do seu Parceiro(a) (opcional)</label>
                        <input type="email" id="obEmailParceiro" placeholder="parceiro@email.com" class="mt-1 h-12 w-full rounded-2xl border border-border bg-card px-4 text-sm text-foreground outline-none focus:border-primary">
                        <p class="text-[11px] text-muted-foreground mt-1">Um convite será enviado para que ele(a) entre no mesmo Lar.</p>
                    </div>

                    <div>
                        <label class="text-xs font-medium text-foreground">Regra padrão de divisão</label>
                        <div class="grid grid-cols-2 gap-2 mt-1.5">
                            <button type="button" onclick="selectRegraDivisao('proporcional')" id="btnDivProporcional" class="p-3 rounded-xl border border-primary bg-accent text-accent-foreground text-left transition">
                                <p class="text-xs font-bold">Proporcional à renda</p>
                                <p class="text-[10px] opacity-80 mt-0.5">Quem ganha mais contribui proporcionalmente mais</p>
                            </button>
                            <button type="button" onclick="selectRegraDivisao('50/50')" id="btnDiv50" class="p-3 rounded-xl border border-border bg-card text-muted-foreground text-left transition">
                                <p class="text-xs font-bold">50% / 50%</p>
                                <p class="text-[10px] opacity-80 mt-0.5">Divisão exata meio a meio de cada despesa</p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botões de Ação do Onboarding -->
            <div class="mt-8 flex items-center justify-between gap-3">
                <button type="button" onclick="voltarPassoOnboarding()" id="btnObVoltar" class="hidden px-5 py-3 rounded-2xl border border-border bg-card text-foreground font-semibold text-sm hover:bg-muted transition">
                    Voltar
                </button>
                <button type="button" onclick="avancarPassoOnboarding()" id="btnObAvancar" class="flex-1 py-3.5 rounded-2xl bg-primary text-primary-foreground font-semibold text-sm shadow-card hover:bg-primary/90 transition flex items-center justify-center gap-2">
                    <span id="btnObAvancarLabel">Continuar</span>
                    <i data-lucide="arrow-right" class="size-4"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- 3. APLICAÇÃO PRINCIPAL (APP SHELL)         -->
    <!-- ========================================== -->
    <div id="screen-app" class="hidden min-h-screen bg-background">
        <!-- Sidebar Fixa — Desktop -->
        <aside class="fixed inset-y-0 left-0 z-30 hidden w-64 flex-col border-r border-border bg-sidebar lg:flex">
            <!-- Logo no Topo -->
            <div class="px-6 py-6">
                <div class="flex items-center gap-2">
                    <div class="relative size-9 overflow-hidden rounded-xl border border-border bg-card flex items-center justify-center">
                        <img src="/seiva-logo.png" alt="SEIVA" class="object-contain p-1 w-full h-full" onerror="this.src='/icon.svg'">
                    </div>
                    <span class="text-lg font-semibold tracking-tight text-foreground">SEIVA</span>
                </div>
            </div>

            <!-- Navegação Lateral Agrupada -->
            <nav class="flex-1 space-y-5 overflow-y-auto px-4 pb-4 no-scrollbar">
                <!-- Grupo 1: Minha Área -->
                <div>
                    <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">
                        🔒 Minha área
                    </p>
                    <div class="space-y-1">
                        <button onclick="navegarPara('dashboard')" class="sidebar-nav-btn relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors bg-primary text-primary-foreground shadow-soft" data-screen="dashboard">
                            <i data-lucide="home" class="size-[18px]"></i>
                            <span>Dashboard</span>
                        </button>
                        <button onclick="navegarPara('caixa-preta')" class="sidebar-nav-btn relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="caixa-preta">
                            <i data-lucide="lock" class="size-[18px]"></i>
                            <span>Caixa Preta</span>
                        </button>
                        <button onclick="navegarPara('transacoes')" class="sidebar-nav-btn relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="transacoes">
                            <i data-lucide="credit-card" class="size-[18px]"></i>
                            <span>Transações</span>
                        </button>
                        <button onclick="navegarPara('metas')" class="sidebar-nav-btn relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="metas">
                            <i data-lucide="target" class="size-[18px]"></i>
                            <span>Metas</span>
                        </button>
                    </div>
                </div>

                <!-- Grupo 2: Nosso Cantinho -->
                <div>
                    <p id="sidebarGrupoLarTitulo" class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">
                        🌿 Nosso Cantinho
                    </p>
                    <div class="space-y-1">
                        <button onclick="navegarPara('lar')" class="sidebar-nav-btn relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="lar">
                            <i data-lucide="leaf" class="size-[18px]"></i>
                            <span>Área do Lar</span>
                        </button>
                        <button onclick="navegarPara('acordos')" class="sidebar-nav-btn relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="acordos">
                            <i data-lucide="handshake" class="size-[18px]"></i>
                            <span>Mesa de Acordos</span>
                        </button>
                        <button onclick="navegarPara('cobrador')" class="sidebar-nav-btn relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="cobrador">
                            <i data-lucide="bell-ring" class="size-[18px]"></i>
                            <span>Cobrador Diplomata</span>
                        </button>
                    </div>
                </div>

                <!-- Grupo 3: Conta -->
                <div>
                    <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">
                        Conta
                    </p>
                    <div class="space-y-1">
                        <button onclick="navegarPara('perfil')" class="sidebar-nav-btn relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="perfil">
                            <i data-lucide="user" class="size-[18px]"></i>
                            <span>Perfil & LGPD</span>
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Rodapé da Sidebar com Usuário Ativo -->
            <div class="p-4 border-t border-border">
                <button onclick="navegarPara('perfil')" class="flex items-center gap-3 w-full rounded-2xl border border-border bg-card p-3 text-left transition hover:bg-accent/40">
                    <div id="sidebarUserAvatar" class="size-10 rounded-full bg-pink-100 text-pink-700 font-bold flex items-center justify-center text-xs shrink-0">
                        DU
                    </div>
                    <div class="min-w-0 flex-1">
                        <p id="sidebarUserName" class="truncate text-sm font-semibold text-foreground">Usuário</p>
                        <span id="sidebarUserLarPill" class="mt-0.5 inline-flex items-center gap-1 rounded-full bg-accent px-2 py-0.5 text-[10px] font-semibold text-accent-foreground">
                            Nosso Cantinho 🌿
                        </span>
                    </div>
                </button>
            </div>
        </aside>

        <!-- Conteúdo Principal -->
        <div class="lg:pl-64 flex flex-col min-h-screen">
            <!-- Top Bar com Sino de Notificações -->
            <header class="sticky top-0 z-20 flex items-center justify-between border-b border-border/60 bg-background/80 px-4 py-3 backdrop-blur-sm lg:px-10 lg:justify-end">
                <div class="flex items-center gap-2 lg:hidden">
                    <div class="size-7 overflow-hidden rounded-lg border border-border bg-card p-0.5">
                        <img src="/seiva-logo.png" alt="SEIVA" class="object-contain w-full h-full">
                    </div>
                    <span class="text-sm font-bold text-foreground">SEIVA</span>
                </div>

                <div class="flex items-center gap-2">
                    <button onclick="navegarPara('perfil')" aria-label="Configurações" class="flex size-10 items-center justify-center rounded-full border border-border bg-card text-muted-foreground transition hover:text-foreground lg:hidden">
                        <i data-lucide="settings" class="size-5"></i>
                    </button>
                    <button onclick="abrirNotificacoes()" aria-label="Notificações" class="relative flex size-10 items-center justify-center rounded-full border border-border bg-card text-foreground shadow-soft transition hover:bg-muted">
                        <i data-lucide="bell" class="size-5"></i>
                        <span class="absolute -right-0.5 -top-0.5 flex size-4 items-center justify-center rounded-full bg-destructive text-[9px] font-bold text-destructive-foreground">
                            2
                        </span>
                    </button>
                </div>
            </header>

            <!-- Container Dinâmico das Telas -->
            <main class="mx-auto w-full max-w-2xl px-4 pb-28 pt-6 lg:max-w-5xl lg:px-10 lg:pb-12 lg:pt-8 flex-1">
                
                <!-- 1. DASHBOARD SCREEN -->
                <div id="view-dashboard" class="app-view space-y-6">
                    <!-- Saudação e Data -->
                    <header class="flex items-center gap-3">
                        <div id="dashAvatar" class="size-11 rounded-full bg-pink-100 text-pink-700 font-bold flex items-center justify-center text-sm ring-2 ring-card shadow-soft shrink-0">
                            DU
                        </div>
                        <div class="min-w-0 flex-1">
                            <p id="dashGreeting" class="text-base font-semibold text-foreground">Bom dia, Usuário</p>
                            <p id="dashDate" class="text-xs text-muted-foreground">Organização financeira sem tabu</p>
                        </div>
                        <span class="hidden items-center gap-1.5 rounded-full bg-secondary px-3 py-1.5 text-[11px] font-medium text-secondary-foreground sm:flex">
                            <i data-lucide="info" class="size-3.5"></i> Você registra, o SEIVA organiza
                        </span>
                    </header>

                    <!-- Carrossel de Renda + Custo do Mês -->
                    <section>
                        <div class="mb-2 flex items-end justify-between">
                            <div>
                                <h2 class="text-sm font-semibold text-foreground">Seu mês</h2>
                                <p class="text-[11px] text-muted-foreground">Visão consolidada de receitas e despesas</p>
                            </div>
                            <button onclick="toggleVisualizarSaldos()" id="btnToggleVisSaldos" class="flex shrink-0 items-center gap-1 text-xs font-medium text-muted-foreground hover:text-foreground">
                                <i data-lucide="eye" class="size-3.5"></i>
                                <span>Ocultar</span>
                            </button>
                        </div>

                        <!-- Card Grande do Mês -->
                        <div class="rounded-3xl border border-border bg-card p-6 shadow-card">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-border pb-5">
                                <div>
                                    <p class="text-xs text-muted-foreground">Saldo Líquido Disponível</p>
                                    <h3 class="text-3xl font-extrabold text-foreground mt-1" id="dashSaldoLivreDisplay">R$ 0,00</h3>
                                </div>
                                <div class="flex gap-2">
                                    <button onclick="abrirModalGasto()" class="px-4 py-2 rounded-xl bg-destructive text-destructive-foreground text-xs font-bold transition hover:bg-destructive/90 flex items-center gap-1.5">
                                        <i data-lucide="trending-down" class="size-4"></i> Lançar Gasto
                                    </button>
                                    <button onclick="abrirModalEntrada()" class="px-4 py-2 rounded-xl bg-primary text-primary-foreground text-xs font-bold transition hover:bg-primary/90 flex items-center gap-1.5">
                                        <i data-lucide="trending-up" class="size-4"></i> Entrada
                                    </button>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 divide-x divide-border pt-4">
                                <div class="pr-4">
                                    <p class="flex items-center gap-1.5 text-[11px] font-medium text-destructive">
                                        <span class="size-2 rounded-full bg-destructive"></span> Já tem dono
                                    </p>
                                    <p class="mt-1 text-lg font-bold text-destructive" id="dashComprometidoDisplay">R$ 0,00</p>
                                    <p class="mt-0.5 text-[11px] text-muted-foreground">Faturas e reservas</p>
                                </div>
                                <div class="pl-4">
                                    <p class="flex items-center gap-1.5 text-[11px] font-medium text-success">
                                        <span class="size-2 rounded-full bg-success"></span> Livre pra gastar
                                    </p>
                                    <p class="mt-1 text-lg font-bold text-success" id="dashLivreDisplay">R$ 0,00</p>
                                    <p class="mt-0.5 text-[11px] text-muted-foreground">Saldo desimpedido</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 4 Atalhos Rápidos -->
                    <div class="grid grid-cols-2 gap-2 sm:grid-cols-4">
                        <button onclick="abrirModalGasto()" class="flex flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-4 shadow-soft hover:bg-accent/30 transition text-center">
                            <span class="size-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                                <i data-lucide="trending-down" class="size-5"></i>
                            </span>
                            <span class="text-xs font-semibold text-foreground">Registrar gasto</span>
                        </button>
                        <button onclick="abrirModalEntrada()" class="flex flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-4 shadow-soft hover:bg-accent/30 transition text-center">
                            <span class="size-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                <i data-lucide="trending-up" class="size-5"></i>
                            </span>
                            <span class="text-xs font-semibold text-foreground">Registrar entrada</span>
                        </button>
                        <button onclick="navegarPara('transacoes')" class="flex flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-4 shadow-soft hover:bg-accent/30 transition text-center">
                            <span class="size-10 rounded-xl bg-secondary text-secondary-foreground flex items-center justify-center">
                                <i data-lucide="receipt" class="size-5"></i>
                            </span>
                            <span class="text-xs font-semibold text-foreground">Ver extrato</span>
                        </button>
                        <button onclick="navegarPara('lar')" class="flex flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-4 shadow-soft hover:bg-accent/30 transition text-center">
                            <span class="size-10 rounded-xl bg-accent text-accent-foreground flex items-center justify-center">
                                <i data-lucide="home" class="size-5"></i>
                            </span>
                            <span class="text-xs font-semibold text-foreground">Contas do Lar</span>
                        </button>
                    </div>

                    <!-- Onde está meu dinheiro (Contas) -->
                    <section>
                        <div class="mb-3 flex items-center justify-between">
                            <h2 class="flex items-center gap-1.5 text-sm font-semibold text-foreground">
                                <i data-lucide="wallet" class="size-4 text-primary"></i> Onde está meu dinheiro
                            </h2>
                            <button onclick="abrirModalNovaConta()" class="flex items-center gap-1 text-xs font-medium text-primary hover:underline">
                                <i data-lucide="plus" class="size-3.5"></i> Nova conta
                            </button>
                        </div>
                        <div id="dashContasContainer" class="space-y-2">
                            <p class="text-xs text-muted-foreground py-4 text-center">Carregando contas...</p>
                        </div>
                    </section>
                </div>

                <!-- 2. CAIXA PRETA SCREEN (ÁREA PRIVADA CRIPTOGRAFADA COM PIN) -->
                <div id="view-caixa-preta" class="app-view space-y-6 hidden">
                    <header class="rounded-3xl bg-[#1f382b] p-6 text-white shadow-card">
                        <div class="flex items-center gap-3">
                            <span class="flex size-11 items-center justify-center rounded-2xl bg-white/10 text-white">
                                <i data-lucide="lock" class="size-5 text-amber-300"></i>
                            </span>
                            <div>
                                <h1 class="text-xl font-bold tracking-tight text-white">Caixa Preta</h1>
                                <p class="text-xs text-white/80">Área Privada Criptografada</p>
                            </div>
                        </div>
                        <p class="mt-4 text-xs leading-relaxed text-white/90">
                            Gastos e reservas que você não quer que apareçam no extrato comum do lar (surpresas, presentes ou compras pessoais protegidas por PIN).
                        </p>
                    </header>

                    <!-- Estado Bloqueado por PIN -->
                    <div id="caixaBloqueadaContainer" class="rounded-3xl border border-border bg-card p-8 text-center max-w-sm mx-auto space-y-4 shadow-card">
                        <div class="size-14 mx-auto rounded-full bg-amber-50 text-amber-600 flex items-center justify-center">
                            <i data-lucide="key-round" class="size-7"></i>
                        </div>
                        <h3 class="text-base font-bold text-foreground">Digite seu PIN de 4 dígitos</h3>
                        <p class="text-xs text-muted-foreground">Informe o PIN configurado no cadastro para acessar seus registros confidenciais.</p>
                        <input type="password" maxlength="4" id="inputPinCaixa" placeholder="••••" class="h-12 w-40 mx-auto text-center text-2xl tracking-widest font-bold rounded-2xl border border-border bg-background outline-none focus:border-primary">
                        <button onclick="autenticarPinCaixa()" class="w-full py-3 rounded-2xl bg-primary text-primary-foreground font-semibold text-xs transition shadow-card">
                            Desbloquear
                        </button>
                    </div>

                    <!-- Estado Desbloqueado -->
                    <div id="caixaDesbloqueadaContainer" class="space-y-4 hidden">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold text-muted-foreground">Seus Registros Secretos</span>
                            <div class="flex gap-2">
                                <button onclick="bloquearCaixa()" class="text-xs font-medium text-muted-foreground hover:text-foreground">
                                    Bloquear
                                </button>
                                <button onclick="abrirModalGastoPrivado()" class="px-3 py-1.5 rounded-xl bg-primary text-primary-foreground text-xs font-bold">
                                    + Novo Registro
                                </button>
                            </div>
                        </div>
                        <div id="caixaRegistrosList" class="space-y-2">
                            <p class="text-xs text-muted-foreground py-6 text-center">Nenhum registro confidencial cadastrado.</p>
                        </div>
                    </div>
                </div>

                <!-- 3. TRANSAÇÕES SCREEN -->
                <div id="view-transacoes" class="app-view space-y-5 hidden">
                    <header>
                        <h1 class="text-2xl font-bold tracking-tight text-foreground">Transações</h1>
                        <p class="mt-1 text-sm text-muted-foreground">Acompanhe suas entradas, saídas e movimentações</p>
                    </header>

                    <!-- Lista de Lançamentos -->
                    <div class="rounded-3xl border border-border bg-card p-5 shadow-card">
                        <div class="flex items-center justify-between border-b border-border pb-3 mb-3">
                            <span class="text-xs font-bold text-foreground">Extrato Completo</span>
                            <button onclick="abrirModalGasto()" class="text-xs font-semibold text-primary hover:underline">+ Lançar</button>
                        </div>
                        <div id="transacoesFullList" class="space-y-2 divide-y divide-border/60">
                            <p class="text-xs text-muted-foreground py-8 text-center">Carregando movimentações...</p>
                        </div>
                    </div>
                </div>

                <!-- 4. ÁREA DO LAR SCREEN -->
                <div id="view-lar" class="app-view space-y-6 hidden">
                    <header>
                        <div class="flex items-center gap-2 text-xs font-medium text-muted-foreground">
                            <span class="flex size-6 items-center justify-center rounded-md bg-accent text-accent-foreground">
                                <i data-lucide="home" class="size-3.5"></i>
                            </span>
                            <span id="larHeaderNome">Nosso Cantinho</span>
                        </div>
                        <h1 class="mt-2 text-2xl font-bold tracking-tight text-foreground">Painel do Lar</h1>
                        <div class="mt-3 flex items-center justify-between">
                            <div id="larAvataresMembros" class="flex -space-x-2">
                                <!-- Avatares dos membros -->
                            </div>
                            <button onclick="abrirModalDespesaLar()" class="px-4 py-2 rounded-xl bg-primary text-primary-foreground text-xs font-bold shadow-soft">
                                + Nova Despesa do Lar
                            </button>
                        </div>
                    </header>

                    <!-- Resumo de Rateio -->
                    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-4">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Divisão Proporcional das Contas</h3>
                        <div id="larMembrosProporcaoList" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <!-- Cards de cada membro com porcentagem calculada -->
                        </div>
                    </div>

                    <!-- Despesas Compartilhadas -->
                    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-3">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Despesas do Lar Cadastradas</h3>
                        <div id="larDespesasCadastradasList" class="space-y-3">
                            <p class="text-xs text-muted-foreground py-6 text-center">Nenhuma despesa compartilhada registrada.</p>
                        </div>
                    </div>
                </div>

                <!-- 5. MESA DE ACORDOS SCREEN -->
                <div id="view-acordos" class="app-view space-y-6 hidden">
                    <header>
                        <h1 class="text-2xl font-bold tracking-tight text-foreground">Mesa de Acordos</h1>
                        <p class="mt-1 text-sm text-muted-foreground">Decisões conjuntas e compras planejadas para o lar</p>
                    </header>

                    <!-- Propostas em Votação -->
                    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-3">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Propostas em Análise</h3>
                            <button onclick="abrirModalNovaProposta()" class="text-xs font-semibold text-primary hover:underline">+ Nova Proposta</button>
                        </div>
                        <div id="acordosPropostasList" class="space-y-3">
                            <p class="text-xs text-muted-foreground py-6 text-center">Nenhuma proposta pendente de votação.</p>
                        </div>
                    </div>

                    <!-- Acordos Selados -->
                    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-3">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Acordos Selados</h3>
                        <div id="acordosSeladosList" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <p class="text-xs text-muted-foreground py-6 text-center col-span-full">Nenhum acordo ativo no momento.</p>
                        </div>
                    </div>
                </div>

                <!-- 6. METAS SCREEN -->
                <div id="view-metas" class="app-view space-y-6 hidden">
                    <!-- Header verde igual ao protótipo -->
                    <header class="rounded-3xl bg-primary p-6 text-primary-foreground shadow-card">
                        <p class="text-sm opacity-80">Meus Objetivos e Metas do Casal</p>
                        <h1 class="mt-1 text-3xl font-bold tracking-tight" id="metasTotalGuardadoDisplay">R$ 0,00</h1>
                        <p class="mt-1 text-sm opacity-80" id="metasTotalAlvoDisplay">de R$ 0,00 planejados</p>
                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <div class="rounded-2xl bg-primary-foreground/15 px-3 py-2.5">
                                <p class="text-[11px] opacity-80">Progresso geral</p>
                                <p class="mt-0.5 text-lg font-bold" id="metasPctDisplay">0%</p>
                            </div>
                            <div class="rounded-2xl bg-primary-foreground/15 px-3 py-2.5">
                                <p class="text-[11px] opacity-80">Guardado por mês</p>
                                <p class="mt-0.5 text-lg font-bold" id="metasMesDisplay">R$ 0,00</p>
                            </div>
                        </div>
                    </header>

                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-foreground">Metas Ativas</span>
                        <button onclick="abrirModalNovaMeta()" class="px-3 py-1.5 rounded-xl bg-primary text-primary-foreground text-xs font-bold">+ Nova Meta</button>
                    </div>

                    <div id="metasListContainer" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <p class="text-xs text-muted-foreground py-8 text-center col-span-full">Nenhuma meta cadastrada.</p>
                    </div>
                </div>

                <!-- 7. COBRADOR DIPLOMATA SCREEN -->
                <div id="view-cobrador" class="app-view space-y-6 hidden">
                    <header class="rounded-3xl bg-primary p-6 text-primary-foreground shadow-card">
                        <div class="flex items-center gap-3">
                            <span class="flex size-11 items-center justify-center rounded-2xl bg-primary-foreground/15">
                                <i data-lucide="bell-ring" class="size-5"></i>
                            </span>
                            <div>
                                <h1 class="text-xl font-bold tracking-tight">Cobrador Diplomata</h1>
                                <p class="text-sm opacity-80">Notificações neutras do Lar</p>
                            </div>
                        </div>
                        <p class="mt-4 text-sm leading-relaxed opacity-90 text-pretty">
                            As cobranças são do sistema. Ninguém fica mal — o SEIVA lembra por você.
                        </p>
                    </header>

                    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-3">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Pendências de Rateio no Lar</h3>
                        <div id="cobradorPendenciasContainer" class="space-y-3">
                            <p class="text-xs text-muted-foreground py-6 text-center">Nenhuma pendência no momento. Tudo em dia!</p>
                        </div>
                    </div>
                </div>

                <!-- 8. PERFIL & LGPD SCREEN -->
                <div id="view-perfil" class="app-view space-y-6 hidden">
                    <header class="rounded-3xl bg-primary p-6 text-primary-foreground shadow-card">
                        <div class="flex items-center gap-4">
                            <div id="perfilAvatarBox" class="size-16 rounded-full bg-pink-100 text-pink-700 font-bold flex items-center justify-center text-lg ring-2 ring-primary-foreground/30 shrink-0">
                                DU
                            </div>
                            <div class="min-w-0 flex-1">
                                <p id="perfilNomeDisplay" class="text-lg font-bold tracking-tight truncate">Nome Usuário</p>
                                <p id="perfilEmailDisplay" class="text-sm opacity-80 truncate">email@email.com</p>
                            </div>
                        </div>
                        <button onclick="logout()" class="mt-4 flex items-center gap-1.5 rounded-xl bg-primary-foreground/15 px-3.5 py-2 text-sm font-medium transition hover:bg-primary-foreground/25">
                            <i data-lucide="log-out" class="size-4"></i> Sair da Conta
                        </button>
                    </header>

                    <!-- LGPD e Direitos do Titular -->
                    <div class="rounded-3xl border border-border bg-card p-6 shadow-card space-y-4">
                        <div class="flex items-center gap-2">
                            <i data-lucide="shield-check" class="size-5 text-primary"></i>
                            <h3 class="text-base font-bold text-foreground">Privacidade & LGPD</h3>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            De acordo com a Lei Geral de Proteção de Dados (Lei nº 13.709/2018), você possui o controle total sobre seus dados.
                        </p>
                        <div class="flex flex-wrap gap-2 pt-2">
                            <button onclick="window.location.href='/api/perfil/exportar'" class="px-4 py-2.5 rounded-xl border border-border bg-card text-foreground font-semibold text-xs hover:bg-muted transition flex items-center gap-2">
                                <i data-lucide="download" class="size-4"></i> Exportar Meus Dados (JSON)
                            </button>
                            <button onclick="excluirMinhaConta()" class="px-4 py-2.5 rounded-xl bg-destructive text-destructive-foreground font-semibold text-xs hover:bg-destructive/90 transition flex items-center gap-2">
                                <i data-lucide="trash-2" class="size-4"></i> Excluir Minha Conta
                            </button>
                        </div>
                    </div>
                </div>

            </main>
        </div>

        <!-- FAB (Floating Action Button + Radial Menu) -->
        <div class="fixed bottom-24 right-5 z-40 flex flex-col items-end gap-3 lg:bottom-8">
            <div id="fabMenu" class="hidden flex flex-col items-end gap-2">
                <button onclick="abrirModalGasto(); toggleFab();" class="flex items-center gap-2 rounded-full bg-card py-2 pl-3 pr-4 text-xs font-semibold text-foreground shadow-elevated border border-border hover:bg-muted transition">
                    <span class="size-7 rounded-full bg-rose-100 text-rose-700 flex items-center justify-center">
                        <i data-lucide="trending-down" class="size-3.5"></i>
                    </span>
                    <span>Lançar gasto</span>
                </button>
                <button onclick="abrirModalEntrada(); toggleFab();" class="flex items-center gap-2 rounded-full bg-card py-2 pl-3 pr-4 text-xs font-semibold text-foreground shadow-elevated border border-border hover:bg-muted transition">
                    <span class="size-7 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                        <i data-lucide="trending-up" class="size-3.5"></i>
                    </span>
                    <span>Registrar entrada</span>
                </button>
                <button onclick="abrirModalDespesaLar(); toggleFab();" class="flex items-center gap-2 rounded-full bg-card py-2 pl-3 pr-4 text-xs font-semibold text-foreground shadow-elevated border border-border hover:bg-muted transition">
                    <span class="size-7 rounded-full bg-accent text-accent-foreground flex items-center justify-center">
                        <i data-lucide="home" class="size-3.5"></i>
                    </span>
                    <span>Despesa do Lar</span>
                </button>
            </div>
            <button onclick="toggleFab()" aria-label="Ações rápidas" class="flex size-14 items-center justify-center rounded-2xl bg-primary text-primary-foreground shadow-elevated active:scale-95 transition">
                <i data-lucide="plus" id="fabIcon" class="size-6 transition-transform"></i>
            </button>
        </div>

        <!-- Bottom Navigation — Mobile Only -->
        <nav class="fixed inset-x-0 bottom-0 z-30 border-t border-border bg-card/95 backdrop-blur-sm lg:hidden">
            <div class="mx-auto flex max-w-lg items-center justify-around px-1 py-2">
                <button onclick="navegarPara('dashboard')" class="flex flex-1 flex-col items-center gap-1 rounded-lg py-1.5 text-primary" data-screen="dashboard">
                    <i data-lucide="home" class="size-5"></i>
                    <span class="text-[10px] font-bold">Início</span>
                </button>
                <button onclick="navegarPara('transacoes')" class="flex flex-1 flex-col items-center gap-1 rounded-lg py-1.5 text-muted-foreground" data-screen="transacoes">
                    <i data-lucide="credit-card" class="size-5"></i>
                    <span class="text-[10px] font-medium">Gastos</span>
                </button>
                <button onclick="navegarPara('acordos')" class="flex flex-1 flex-col items-center gap-1 rounded-lg py-1.5 text-muted-foreground" data-screen="acordos">
                    <i data-lucide="handshake" class="size-5"></i>
                    <span class="text-[10px] font-medium">Acordos</span>
                </button>
                <button onclick="navegarPara('metas')" class="flex flex-1 flex-col items-center gap-1 rounded-lg py-1.5 text-muted-foreground" data-screen="metas">
                    <i data-lucide="target" class="size-5"></i>
                    <span class="text-[10px] font-medium">Metas</span>
                </button>
                <button onclick="navegarPara('lar')" class="flex flex-1 flex-col items-center gap-1 rounded-lg py-1.5 text-muted-foreground" data-screen="lar">
                    <i data-lucide="leaf" class="size-5"></i>
                    <span class="text-[10px] font-medium">Lar</span>
                </button>
            </div>
        </nav>
    </div>

    <!-- MODAL: REGISTRAR GASTO / ENTRADA -->
    <div id="modalTransacao" class="hidden fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
        <div class="rounded-3xl border border-border bg-card p-6 max-w-md w-full shadow-elevated relative">
            <button onclick="fecharModal('modalTransacao')" class="absolute top-5 right-5 text-muted-foreground hover:text-foreground">
                <i data-lucide="x" class="size-5"></i>
            </button>
            <h3 class="text-lg font-bold text-foreground mb-4" id="modalTransacaoTitulo">Registrar Gasto</h3>
            <form onsubmit="salvarTransacaoModal(event)" class="space-y-4">
                <input type="hidden" id="transTipo" value="saida">
                <div>
                    <label class="text-xs font-medium text-foreground">Descrição</label>
                    <input type="text" id="transDescricao" required placeholder="Ex: Mercado, Almoço, Gasolina" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none focus:border-primary">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-medium text-foreground">Valor (R$)</label>
                        <input type="number" step="0.01" id="transValor" required placeholder="0,00" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-base font-bold text-foreground outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-foreground">Conta</label>
                        <select id="transContaSelect" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-3 text-xs text-foreground outline-none focus:border-primary"></select>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-medium text-foreground">Categoria</label>
                    <select id="transCategoriaSelect" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-3 text-xs text-foreground outline-none focus:border-primary"></select>
                </div>
                <button type="submit" class="w-full mt-2 h-12 rounded-2xl bg-primary text-primary-foreground font-semibold text-sm shadow-card hover:bg-primary/90 transition">
                    Salvar Registro
                </button>
            </form>
        </div>
    </div>

    <!-- MODAL: DESPESA DO LAR -->
    <div id="modalDespesaLar" class="hidden fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
        <div class="rounded-3xl border border-border bg-card p-6 max-w-md w-full shadow-elevated relative">
            <button onclick="fecharModal('modalDespesaLar')" class="absolute top-5 right-5 text-muted-foreground hover:text-foreground">
                <i data-lucide="x" class="size-5"></i>
            </button>
            <h3 class="text-lg font-bold text-foreground mb-4">Lançar Despesa do Lar</h3>
            <form onsubmit="salvarDespesaLarModal(event)" class="space-y-4">
                <div>
                    <label class="text-xs font-medium text-foreground">Nome da Despesa</label>
                    <input type="text" id="larDespNome" required placeholder="Ex: Aluguel, Internet, Mercado" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none focus:border-primary">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-medium text-foreground">Valor Total (R$)</label>
                        <input type="number" step="0.01" id="larDespValor" required placeholder="0,00" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-base font-bold text-foreground outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-foreground">Regra de Divisão</label>
                        <select id="larDespDivisao" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-3 text-xs text-foreground outline-none focus:border-primary">
                            <option value="proporcional">Proporcional à renda</option>
                            <option value="50/50">50% / 50%</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-medium text-foreground">Vencimento</label>
                    <input type="date" id="larDespData" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none focus:border-primary">
                </div>
                <button type="submit" class="w-full mt-2 h-12 rounded-2xl bg-primary text-primary-foreground font-semibold text-sm shadow-card hover:bg-primary/90 transition">
                    Calcular Rateio & Salvar
                </button>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT MASTER DA APLICAÇÃO -->
    <script>
        // Estado Global
        let usuarioAtivo = null;
        let larAtivo = null;
        let contasGlobais = [];
        let categoriasGlobais = [];
        let telaAtual = 'dashboard';
        let onboardingPasso = 0;
        let tipoRendaSelecionado = 'clt';
        let bancoSelecionado = 'Nubank';
        let regraDivisaoSelecionada = 'proporcional';
        let saldosVisiveis = true;

        const BRL = (v) => Number(v || 0).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

        document.addEventListener('DOMContentLoaded', async () => {
            lucide.createIcons();
            await carregarCategorias();
            await verificarSessao();
        });

        async function verificarSessao() {
            try {
                const res = await fetch('/api/me');
                if (res.ok) {
                    const data = await res.json();
                    if (data.authenticated && data.usuario) {
                        usuarioAtivo = data.usuario;
                        larAtivo = data.lar;
                        exibirAppShell();
                        return;
                    }
                }
            } catch (e) {}
            exibirLogin();
        }

        function exibirLogin() {
            document.getElementById('screen-login').classList.remove('hidden');
            document.getElementById('screen-onboarding').classList.add('hidden');
            document.getElementById('screen-app').classList.add('hidden');
            lucide.createIcons();
        }

        function exibirAppShell() {
            document.getElementById('screen-login').classList.add('hidden');
            document.getElementById('screen-onboarding').classList.add('hidden');
            document.getElementById('screen-app').classList.remove('hidden');

            atualizarDadosUsuarioNaTela();
            carregarDashboard();
            lucide.createIcons();
        }

        function atualizarDadosUsuarioNaTela() {
            if (!usuarioAtivo) return;

            const iniciais = usuarioAtivo.iniciais || usuarioAtivo.nome.substring(0, 2).toUpperCase();
            const primeiroNome = usuarioAtivo.nome.split(' ')[0];

            document.getElementById('sidebarUserName').innerText = usuarioAtivo.nome;
            document.getElementById('sidebarUserAvatar').innerText = iniciais;
            document.getElementById('dashAvatar').innerText = iniciais;
            document.getElementById('dashGreeting').innerText = `Olá, ${primeiroNome}`;
            document.getElementById('perfilNomeDisplay').innerText = usuarioAtivo.nome;
            document.getElementById('perfilEmailDisplay').innerText = usuarioAtivo.email;
            document.getElementById('perfilAvatarBox').innerText = iniciais;

            if (larAtivo) {
                document.getElementById('sidebarUserLarPill').innerText = `${larAtivo.nome} ${larAtivo.emoji || '🌿'}`;
                document.getElementById('sidebarGrupoLarTitulo').innerText = `🌿 ${larAtivo.nome}`;
                document.getElementById('larHeaderNome').innerText = larAtivo.nome;
            }
        }

        // --- NAVEGAÇÃO ENTRE TELAS DO APP ---
        function navegarPara(screenId) {
            telaAtual = screenId;
            document.querySelectorAll('.app-view').forEach(v => v.classList.add('hidden'));
            const target = document.getElementById(`view-${screenId}`);
            if (target) target.classList.remove('hidden');

            // Atualiza botões da sidebar
            document.querySelectorAll('.sidebar-nav-btn').forEach(btn => {
                if (btn.getAttribute('data-screen') === screenId) {
                    btn.className = "sidebar-nav-btn relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors bg-primary text-primary-foreground shadow-soft";
                } else {
                    btn.className = "sidebar-nav-btn relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground";
                }
            });

            if (screenId === 'transacoes') carregarExtrato();
            if (screenId === 'lar') carregarDadosLar();
            if (screenId === 'acordos') carregarMesaAcordos();
            if (screenId === 'metas') carregarMetas();
            if (screenId === 'cobrador') carregarCobrador();

            lucide.createIcons();
        }

        // --- DASHBOARD ---
        async function carregarDashboard() {
            try {
                const res = await fetch('/api/dashboard');
                if (!res.ok) return;
                const data = await res.json();

                contasGlobais = data.contas || [];
                popularSelectContas(contasGlobais);

                // Saldos
                const livre = data.resumo.saldo_livre || 0;
                const comprometido = data.resumo.saldo_comprometido || 0;
                document.getElementById('dashSaldoLivreDisplay').innerText = saldosVisiveis ? BRL(livre) : 'R$ ••••••';
                document.getElementById('dashComprometidoDisplay').innerText = saldosVisiveis ? BRL(comprometido) : '••••';
                document.getElementById('dashLivreDisplay').innerText = saldosVisiveis ? BRL(livre) : '••••';

                // Lista de Contas
                const container = document.getElementById('dashContasContainer');
                if (!contasGlobais.length) {
                    container.innerHTML = '<p class="text-xs text-muted-foreground py-4 text-center">Nenhuma conta cadastrada.</p>';
                } else {
                    container.innerHTML = contasGlobais.map(c => `
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
            } catch (e) { console.error(e); }
        }

        function toggleVisualizarSaldos() {
            saldosVisiveis = !saldosVisiveis;
            const btn = document.getElementById('btnToggleVisSaldos');
            btn.innerHTML = saldosVisiveis ? '<i data-lucide="eye" class="size-3.5"></i><span>Ocultar</span>' : '<i data-lucide="eye-off" class="size-3.5"></i><span>Mostrar</span>';
            carregarDashboard();
            lucide.createIcons();
        }

        // --- TRANSAÇÕES ---
        async function carregarExtrato() {
            try {
                const res = await fetch('/api/transacoes');
                if (!res.ok) return;
                const txs = await res.json();
                const container = document.getElementById('transacoesFullList');
                if (!txs.length) {
                    container.innerHTML = '<p class="text-xs text-muted-foreground py-8 text-center">Nenhuma transação encontrada.</p>';
                    return;
                }
                container.innerHTML = txs.map(t => `
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
        async function carregarDadosLar() {
            try {
                const res = await fetch('/api/lar');
                if (!res.ok) return;
                const data = await res.json();

                if (!data.lar) return;
                larAtivo = data.lar;

                // Membros e Proporção
                const membrosContainer = document.getElementById('larMembrosProporcaoList');
                membrosContainer.innerHTML = (data.membros || []).map(m => `
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

                // Despesas do Lar
                const despRes = await fetch('/api/lar/despesas');
                if (despRes.ok) {
                    const despesas = await despRes.json();
                    const container = document.getElementById('larDespesasCadastradasList');
                    if (!despesas.length) {
                        container.innerHTML = '<p class="text-xs text-muted-foreground py-6 text-center">Nenhuma despesa compartilhada registrada.</p>';
                        return;
                    }
                    container.innerHTML = despesas.map(d => `
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
        async function autenticarPinCaixa() {
            const pin = document.getElementById('inputPinCaixa').value;
            if (!pin) return alert('Digite o PIN de 4 dígitos.');

            const res = await fetch('/api/caixa-preta/verificar-pin', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ pin })
            });

            const data = await res.json();
            if (data.unlocked) {
                document.getElementById('caixaBloqueadaContainer').classList.add('hidden');
                document.getElementById('caixaDesbloqueadaContainer').classList.remove('hidden');
                carregarRegistrosCaixa();
            } else {
                alert(data.error || 'PIN incorreto.');
            }
        }

        function bloquearCaixa() {
            document.getElementById('inputPinCaixa').value = '';
            document.getElementById('caixaBloqueadaContainer').classList.remove('hidden');
            document.getElementById('caixaDesbloqueadaContainer').classList.add('hidden');
        }

        async function carregarRegistrosCaixa() {
            const res = await fetch('/api/caixa-preta/registros');
            if (!res.ok) return;
            const data = await res.json();
            const container = document.getElementById('caixaRegistrosList');
            if (!data.registros.length) {
                container.innerHTML = '<p class="text-xs text-muted-foreground py-6 text-center">Nenhum registro confidencial salvo.</p>';
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

        async function abrirModalGastoPrivado() {
            const titulo = prompt('Título do gasto secreto:');
            if (!titulo) return;
            const valor = prompt('Valor (R$):');
            if (!valor) return;

            await fetch('/api/caixa-preta/registros', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ titulo, valor: parseFloat(valor) })
            });
            carregarRegistrosCaixa();
        }

        // --- MESA DE ACORDOS ---
        async function carregarMesaAcordos() {
            try {
                const res = await fetch('/api/acordos');
                if (!res.ok) return;
                const data = await res.json();

                // Propostas
                const propContainer = document.getElementById('acordosPropostasList');
                if (!data.propostas.length) {
                    propContainer.innerHTML = '<p class="text-xs text-muted-foreground py-6 text-center">Nenhuma proposta pendente de votação.</p>';
                } else {
                    propContainer.innerHTML = data.propostas.map(p => `
                        <div class="p-4 rounded-2xl border border-border bg-background space-y-2">
                            <div class="flex items-center justify-between">
                                <p class="text-xs font-bold text-foreground">${p.titulo}</p>
                                <span class="text-xs font-bold text-primary">${BRL(p.valor)}</span>
                            </div>
                            <p class="text-xs text-muted-foreground italic">"${p.proposta_texto}"</p>
                            ${p.status === 'em_analise' ? `
                                <div class="flex gap-2 pt-1">
                                    <button onclick="votarProposta(${p.id_proposta}, 'aceitar')" class="px-3 py-1.5 rounded-xl bg-primary text-primary-foreground text-xs font-bold">Apoiar</button>
                                    <button onclick="votarProposta(${p.id_proposta}, 'recusar')" class="px-3 py-1.5 rounded-xl border border-border text-xs font-medium">Recusar</button>
                                </div>
                            ` : `<span class="text-[10px] font-bold text-emerald-600">${p.status.toUpperCase()}</span>`}
                        </div>
                    `).join('');
                }

                // Acordos Selados
                const acordosContainer = document.getElementById('acordosSeladosList');
                if (!data.acordos.length) {
                    acordosContainer.innerHTML = '<p class="text-xs text-muted-foreground py-6 text-center col-span-full">Nenhum acordo ativo no momento.</p>';
                } else {
                    acordosContainer.innerHTML = data.acordos.map(a => `
                        <div class="p-4 rounded-2xl border border-border bg-background space-y-2">
                            <p class="text-xs font-bold text-foreground">${a.titulo}</p>
                            <p class="text-xs font-extrabold text-primary">${BRL(a.valor_total)}</p>
                            <span class="text-[10px] text-muted-foreground">Divisão: ${a.divisao}</span>
                        </div>
                    `).join('');
                }
            } catch (e) {}
        }

        async function votarProposta(id, acao) {
            await fetch(`/api/acordos/propostas/votar/${id}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ acao })
            });
            carregarMesaAcordos();
        }

        async function abrirModalNovaProposta() {
            const titulo = prompt('Título da proposta (ex: Sofá novo, Assinatura TV):');
            if (!titulo) return;
            const valor = prompt('Valor estimado (R$):');
            if (!valor) return;
            const proposta_texto = prompt('Justificativa para o lar:') || '';

            await fetch('/api/acordos/propostas', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ titulo, valor: parseFloat(valor), proposta_texto, divisao_sugerida: '50/50' })
            });
            carregarMesaAcordos();
        }

        // --- METAS ---
        async function carregarMetas() {
            const res = await fetch('/api/metas');
            if (!res.ok) return;
            const data = await res.json();
            const todas = [...(data.individuais || []), ...(data.lar || [])];

            const totalGuardado = todas.reduce((s, m) => s + parseFloat(m.valor_atual || 0), 0);
            const totalAlvo = todas.reduce((s, m) => s + parseFloat(m.valor_alvo || 1), 0);
            const pct = Math.round((totalGuardado / totalAlvo) * 100);

            document.getElementById('metasTotalGuardadoDisplay').innerText = BRL(totalGuardado);
            document.getElementById('metasTotalAlvoDisplay').innerText = `de ${BRL(totalAlvo)} planejados`;
            document.getElementById('metasPctDisplay').innerText = `${pct}%`;

            const container = document.getElementById('metasListContainer');
            if (!todas.length) {
                container.innerHTML = '<p class="text-xs text-muted-foreground py-8 text-center col-span-full">Nenhuma meta cadastrada.</p>';
                return;
            }

            container.innerHTML = todas.map(m => {
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
                            <button onclick="contribuirMeta(${m.id_meta})" class="text-primary font-bold hover:underline">+ Depositar</button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        async function contribuirMeta(id) {
            const v = prompt('Valor do depósito (R$):');
            if (!v) return;
            await fetch(`/api/metas/${id}/contribuir`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ valor: parseFloat(v) })
            });
            carregarMetas();
        }

        async function abrirModalNovaMeta() {
            const titulo = prompt('Título da meta (ex: Viagem, Reforma):');
            if (!titulo) return;
            const valor_alvo = prompt('Valor alvo (R$):');
            if (!valor_alvo) return;

            await fetch('/api/metas', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ titulo, valor_alvo: parseFloat(valor_alvo), tipo_escopo: 'lar' })
            });
            carregarMetas();
        }

        // --- COBRADOR DIPLOMATA ---
        async function carregarCobrador() {
            const res = await fetch('/api/cobrancas');
            if (!res.ok) return;
            const data = await res.json();
            const container = document.getElementById('cobradorPendenciasContainer');
            if (!data.pendencias.length) {
                container.innerHTML = '<p class="text-xs text-muted-foreground py-6 text-center">Nenhuma pendência no momento. Tudo em dia!</p>';
                return;
            }
            container.innerHTML = data.pendencias.map(p => `
                <div class="p-4 rounded-2xl border border-border bg-background flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-foreground">${p.despesa ? p.despesa.titulo : 'Despesa'}</p>
                        <span class="text-[10px] text-muted-foreground">Pendente por ${p.usuario ? p.usuario.nome : 'Membro'}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-bold text-rose-600">${BRL(p.valor_parte)}</span>
                        <button onclick="enviarNotificacaoCobrador(${p.usuario_id}, '${p.despesa ? p.despesa.titulo : ''}', ${p.valor_parte})" class="px-3 py-1.5 rounded-xl bg-primary text-primary-foreground text-xs font-bold">
                            Lembrar
                        </button>
                    </div>
                </div>
            `).join('');
        }

        async function enviarNotificacaoCobrador(destId, titulo, valor) {
            const mensagem = `Oi! Passando só pra lembrar com carinho da divisão de ${titulo} (${BRL(valor)}) 🌿`;
            await fetch('/api/cobrancas/lembrete', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ destinatario_id: destId, titulo, valor, mensagem })
            });
            alert('Lembrete diplomático enviado!');
        }

        // --- AUTH & LOGIN ---
        async function realizarLogin(e) {
            e.preventDefault();
            const email = document.getElementById('loginEmail').value;
            const senha = document.getElementById('loginSenha').value;

            const res = await fetch('/api/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, senha })
            });

            const data = await res.json();
            if (res.ok) {
                usuarioAtivo = data.usuario;
                exibirAppShell();
            } else {
                alert(data.error || 'Credenciais inválidas.');
            }
        }

        async function logout() {
            await fetch('/api/logout', { method: 'POST' });
            location.reload();
        }

        // --- ONBOARDING EM PASSOS ---
        function abrirOnboarding() {
            document.getElementById('screen-login').classList.add('hidden');
            document.getElementById('screen-onboarding').classList.remove('hidden');
            onboardingPasso = 0;
            atualizarPassoOnboarding();
        }

        function fecharOnboarding() {
            document.getElementById('screen-onboarding').classList.add('hidden');
            document.getElementById('screen-login').classList.remove('hidden');
        }

        function atualizarPassoOnboarding() {
            document.querySelectorAll('.onboarding-step').forEach((el, idx) => {
                el.classList.toggle('hidden', idx !== onboardingPasso);
                const dot = document.getElementById(`stepDot${idx}`);
                if (dot) {
                    dot.className = idx <= onboardingPasso ? "size-2.5 rounded-full bg-primary" : "size-2.5 rounded-full bg-border";
                }
            });

            document.getElementById('stepCountLabel').innerText = `${onboardingPasso + 1} de 4`;
            document.getElementById('btnObVoltar').classList.toggle('hidden', onboardingPasso === 0);
            document.getElementById('btnObAvancarLabel').innerText = onboardingPasso === 3 ? "Concluir Cadastro" : "Continuar";
            lucide.createIcons();
        }

        function voltarPassoOnboarding() {
            if (onboardingPasso > 0) {
                onboardingPasso--;
                atualizarPassoOnboarding();
            }
        }

        async function avancarPassoOnboarding() {
            if (onboardingPasso === 0) {
                const nome = document.getElementById('obNome').value.trim();
                const email = document.getElementById('obEmail').value.trim();
                const senha = document.getElementById('obSenha').value;
                const senhaConf = document.getElementById('obSenhaConfirma').value;

                if (!nome || !email || !senha) return alert('Por favor, preencha todos os campos obrigatórios.');
                if (senha !== senhaConf) return alert('As senhas não coincidem.');
                if (senha.length < 6) return alert('A senha deve ter no mínimo 6 caracteres.');

                onboardingPasso++;
                atualizarPassoOnboarding();
                return;
            }

            if (onboardingPasso === 1) {
                onboardingPasso++;
                atualizarPassoOnboarding();
                return;
            }

            if (onboardingPasso === 2) {
                onboardingPasso++;
                atualizarPassoOnboarding();
                return;
            }

            if (onboardingPasso === 3) {
                // Finaliza e envia para a API
                const payload = {
                    nome: document.getElementById('obNome').value,
                    email: document.getElementById('obEmail').value,
                    telefone: document.getElementById('obTelefone').value,
                    senha: document.getElementById('obSenha').value,
                    tipo_renda: tipoRendaSelecionado,
                    renda_mensal: parseFloat(document.getElementById('obRenda').value) || 0,
                    renda_extra: parseFloat(document.getElementById('obRendaExtra').value) || 0,
                    banco_principal: bancoSelecionado,
                    chave_pix: document.getElementById('obPix').value,
                    pin_caixa_preta: document.getElementById('obPin').value || '1234',
                };

                const res = await fetch('/api/register', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                const data = await res.json();
                if (res.ok) {
                    usuarioAtivo = data.usuario;

                    // Cria o Lar se informado
                    const nomeLar = document.getElementById('obNomeLar').value || 'Nosso Cantinho';
                    await fetch('/api/lar', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ nome: nomeLar, emoji: '🌿' })
                    });

                    exibirAppShell();
                } else {
                    alert(data.error || 'Erro no cadastro.');
                }
            }
        }

        function selectTipoRenda(tipo) {
            tipoRendaSelecionado = tipo;
            ['clt', 'pj', 'autonomo'].forEach(t => {
                const btn = document.getElementById(`btnRenda${t.toUpperCase()}`);
                if (btn) {
                    btn.className = t === tipo ? "py-2.5 rounded-xl border border-primary bg-accent text-accent-foreground font-semibold text-xs transition" : "py-2.5 rounded-xl border border-border bg-card text-muted-foreground font-semibold text-xs transition";
                }
            });
        }

        function selectBanco(banco) {
            bancoSelecionado = banco;
            document.querySelectorAll('.banco-btn').forEach(b => {
                b.className = b.innerText === banco ? "banco-btn py-2.5 rounded-xl border border-primary bg-accent text-accent-foreground font-bold text-xs" : "banco-btn py-2.5 rounded-xl border border-border bg-card text-muted-foreground font-bold text-xs";
            });
        }

        function selectRegraDivisao(regra) {
            regraDivisaoSelecionada = regra;
            document.getElementById('btnDivProporcional').className = regra === 'proporcional' ? "p-3 rounded-xl border border-primary bg-accent text-accent-foreground text-left transition" : "p-3 rounded-xl border border-border bg-card text-muted-foreground text-left transition";
            document.getElementById('btnDiv50').className = regra === '50/50' ? "p-3 rounded-xl border border-primary bg-accent text-accent-foreground text-left transition" : "p-3 rounded-xl border border-border bg-card text-muted-foreground text-left transition";
        }

        function avaliarForcaSenha(senha) {
            const b1 = document.getElementById('forcaBar1');
            const b2 = document.getElementById('forcaBar2');
            const b3 = document.getElementById('forcaBar3');
            const lbl = document.getElementById('forcaLabel');

            b1.className = 'h-full flex-1 bg-muted';
            b2.className = 'h-full flex-1 bg-muted';
            b3.className = 'h-full flex-1 bg-muted';

            if (!senha) { lbl.innerText = ''; return; }

            if (senha.length < 6) {
                b1.className = 'h-full flex-1 bg-destructive';
                lbl.innerText = 'Fraca';
            } else if (senha.length < 10) {
                b1.className = 'h-full flex-1 bg-amber-500';
                b2.className = 'h-full flex-1 bg-amber-500';
                lbl.innerText = 'Média';
            } else {
                b1.className = 'h-full flex-1 bg-primary';
                b2.className = 'h-full flex-1 bg-primary';
                b3.className = 'h-full flex-1 bg-primary';
                lbl.innerText = 'Forte';
            }
        }

        // --- HELPERS E MODAIS ---
        function toggleFab() {
            const menu = document.getElementById('fabMenu');
            menu.classList.toggle('hidden');
        }

        function abrirModalGasto() {
            document.getElementById('modalTransacaoTitulo').innerText = 'Registrar Gasto';
            document.getElementById('transTipo').value = 'saida';
            document.getElementById('modalTransacao').classList.remove('hidden');
        }

        function abrirModalEntrada() {
            document.getElementById('modalTransacaoTitulo').innerText = 'Registrar Entrada';
            document.getElementById('transTipo').value = 'entrada';
            document.getElementById('modalTransacao').classList.remove('hidden');
        }

        function abrirModalDespesaLar() {
            document.getElementById('larDespData').value = new Date().toISOString().split('T')[0];
            document.getElementById('modalDespesaLar').classList.remove('hidden');
        }

        function fecharModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        async function salvarTransacaoModal(e) {
            e.preventDefault();
            const tipo = document.getElementById('transTipo').value;
            const titulo = document.getElementById('transDescricao').value;
            const valor = parseFloat(document.getElementById('transValor').value);
            const conta_id = document.getElementById('transContaSelect').value;
            const categoria_id = document.getElementById('transCategoriaSelect').value;

            const res = await fetch('/api/transacoes', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ tipo, titulo, valor, conta_id, categoria_id })
            });

            if (res.ok) {
                fecharModal('modalTransacao');
                carregarDashboard();
                if (telaAtual === 'transacoes') carregarExtrato();
            } else {
                alert('Erro ao salvar.');
            }
        }

        async function salvarDespesaLarModal(e) {
            e.preventDefault();
            const titulo = document.getElementById('larDespNome').value;
            const valor_total = parseFloat(document.getElementById('larDespValor').value);
            const divisao = document.getElementById('larDespDivisao').value;
            const data_vencimento = document.getElementById('larDespData').value;

            const res = await fetch('/api/lar/despesas', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ titulo, valor_total, divisao, tipo: 'fixa', data_vencimento })
            });

            if (res.ok) {
                fecharModal('modalDespesaLar');
                carregarDadosLar();
            } else {
                alert('Erro ao salvar despesa do lar.');
            }
        }

        async function carregarCategorias() {
            try {
                const res = await fetch('/api/categorias');
                if (res.ok) {
                    categoriasGlobais = await res.json();
                    const sel = document.getElementById('transCategoriaSelect');
                    if (sel) {
                        sel.innerHTML = categoriasGlobais.map(c => `<option value="${c.id_categoria}">${c.emoji || '📁'} ${c.nome}</option>`).join('');
                    }
                }
            } catch (e) {}
        }

        function popularSelectContas(contas) {
            const sel = document.getElementById('transContaSelect');
            if (sel) {
                sel.innerHTML = contas.map(c => `<option value="${c.id_conta}">${c.nome} (${BRL(c.saldo)})</option>`).join('');
            }
        }

        async function excluirMinhaConta() {
            if (!confirm('Deseja excluir definitivamente sua conta e dados de acordo com a LGPD?')) return;
            await fetch('/api/perfil/excluir', { method: 'DELETE' });
            location.reload();
        }

        function abrirNotificacoes() {
            alert('🌿 Notificações do Lar:\n- Cobrador diplomata ativo\n- Sincronização em tempo real');
        }
    </script>
</body>
</html>
