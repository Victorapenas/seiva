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
    <!-- 1. TELA DE LOGIN (LOGIN SCREEN OFICIAL)    -->
    <!-- ========================================== -->
    <div id="screen-login" class="app-screen is-active relative min-h-screen items-center justify-center overflow-hidden bg-background px-4 py-10 lg:block lg:p-0">
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
                    <div class="relative size-20 overflow-hidden rounded-2xl border border-border bg-card p-2 shadow-soft flex items-center justify-center">
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
                        <button type="button" class="relative z-10 flex-1 rounded-xl py-2.5 text-sm font-semibold bg-primary text-primary-foreground shadow-soft">
                            Entrar
                        </button>
                        <button type="button" onclick="irParaOnboarding()" class="relative z-10 flex-1 rounded-xl py-2.5 text-sm font-semibold text-muted-foreground hover:text-foreground transition-colors">
                            Criar conta
                        </button>
                    </div>

                    <!-- Formulário de Login -->
                    <form onsubmit="executarLogin(event)" class="space-y-4">
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
                            <a href="#" onclick="alert('Recuperação de senha: basta informar seu e-mail de cadastro.'); return false;" class="font-medium text-primary hover:underline">
                                Esqueceu a senha?
                            </a>
                        </div>

                        <button type="submit" id="loginSubmitBtn" class="w-full mt-2 h-14 py-3.5 rounded-2xl bg-primary text-primary-foreground font-semibold text-sm shadow-card hover:bg-primary/90 active:scale-[0.99] transition flex items-center justify-center gap-2">
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
                    <button type="button" onclick="alert('Login Google Auth.');" class="w-full h-12 rounded-2xl border border-border bg-card hover:bg-muted/50 text-foreground font-medium text-sm transition flex items-center justify-center gap-3">
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
    <!-- 2. TELA DE ONBOARDING (PÁGINA EXCLUSIVA)   -->
    <!-- ========================================== -->
    <div id="screen-onboarding" class="app-screen relative min-h-screen flex-col overflow-hidden bg-background">
        
        <!-- FASE: BOAS-VINDAS (WELCOME) -->
        <div id="onboardingFaseWelcome" class="relative z-10 mx-auto flex min-h-screen w-full max-w-md flex-col items-center justify-center px-6 py-10 text-center">
            <div class="relative size-24 overflow-hidden rounded-2xl border border-border bg-card p-3 shadow-card flex items-center justify-center">
                <img src="/seiva-logo.png" alt="SEIVA" class="object-contain w-full h-full" onerror="this.src='/icon.svg'">
            </div>
            <h1 class="mt-5 text-3xl font-bold tracking-tight text-foreground">SEIVA</h1>
            <p class="mt-2 flex items-center gap-1.5 text-sm text-muted-foreground">
                <i data-lucide="leaf" class="size-4 text-primary"></i> Onde seu dinheiro cria raízes
            </p>

            <div class="mt-8 flex w-full flex-col gap-2.5">
                <div class="flex items-center gap-3 rounded-2xl border border-border bg-card p-3.5 text-left shadow-soft">
                    <span class="flex size-9 shrink-0 items-center justify-center rounded-xl bg-accent text-accent-foreground">
                        <i data-lucide="user" class="size-4"></i>
                    </span>
                    <span>
                        <span class="block text-sm font-medium text-foreground">Seus dados</span>
                        <span class="block text-xs text-muted-foreground">Nome, contato e senha segura</span>
                    </span>
                </div>
                <div class="flex items-center gap-3 rounded-2xl border border-border bg-card p-3.5 text-left shadow-soft">
                    <span class="flex size-9 shrink-0 items-center justify-center rounded-xl bg-accent text-accent-foreground">
                        <i data-lucide="wallet" class="size-4"></i>
                    </span>
                    <span>
                        <span class="block text-sm font-medium text-foreground">Sua renda</span>
                        <span class="block text-xs text-muted-foreground">Quanto e quando você recebe</span>
                    </span>
                </div>
                <div class="flex items-center gap-3 rounded-2xl border border-border bg-card p-3.5 text-left shadow-soft">
                    <span class="flex size-9 shrink-0 items-center justify-center rounded-xl bg-accent text-accent-foreground">
                        <i data-lucide="landmark" class="size-4"></i>
                    </span>
                    <span>
                        <span class="block text-sm font-medium text-foreground">Suas contas</span>
                        <span class="block text-xs text-muted-foreground">Bancos, cartões e Pix</span>
                    </span>
                </div>
                <div class="flex items-center gap-3 rounded-2xl border border-border bg-card p-3.5 text-left shadow-soft">
                    <span class="flex size-9 shrink-0 items-center justify-center rounded-xl bg-accent text-accent-foreground">
                        <i data-lucide="home" class="size-4"></i>
                    </span>
                    <span>
                        <span class="block text-sm font-medium text-foreground">Seu Lar</span>
                        <span class="block text-xs text-muted-foreground">Opcional — divida contas com quem mora</span>
                    </span>
                </div>
            </div>

            <p class="mt-5 flex items-start gap-2 rounded-2xl bg-secondary/60 p-3.5 text-left text-xs leading-relaxed text-secondary-foreground">
                <i data-lucide="shield-check" class="mt-0.5 size-4 shrink-0 text-primary"></i>
                Seus dados são criptografados e nunca compartilhados. A Caixa Preta é só sua — nem o SEIVA acessa.
            </p>

            <button type="button" onclick="iniciarFormularioOnboarding()" class="mt-6 flex h-14 w-full items-center justify-center gap-2 rounded-2xl bg-primary text-base font-semibold text-primary-foreground shadow-soft hover:bg-primary/90 transition">
                <span>Começar meu cadastro</span>
                <i data-lucide="arrow-right" class="size-5"></i>
            </button>
            <button type="button" onclick="irParaLogin()" class="mt-4 text-sm text-muted-foreground hover:text-foreground">
                Já tenho conta · <span class="font-semibold text-primary">Entrar</span>
            </button>
        </div>

        <!-- FASE: FORMULÁRIO EM ETAPAS (PASSOS 1 A 4) -->
        <div id="onboardingFaseForm" class="hidden relative z-10 mx-auto flex min-h-screen w-full max-w-md flex-col px-6 py-8 justify-between">
            <div>
                <!-- Header com Botão Voltar e Barra de Progresso -->
                <div class="mb-6 flex items-center gap-3">
                    <button type="button" onclick="recuarPassoOnboarding()" aria-label="Voltar" class="flex size-9 shrink-0 items-center justify-center rounded-full border border-border bg-card text-foreground shadow-soft hover:bg-muted transition">
                        <i data-lucide="arrow-left" class="size-4"></i>
                    </button>
                    <div class="flex flex-1 gap-1.5">
                        <span id="onbBar0" class="h-1.5 flex-1 rounded-full bg-primary transition-colors"></span>
                        <span id="onbBar1" class="h-1.5 flex-1 rounded-full bg-muted transition-colors"></span>
                        <span id="onbBar2" class="h-1.5 flex-1 rounded-full bg-muted transition-colors"></span>
                        <span id="onbBar3" class="h-1.5 flex-1 rounded-full bg-muted transition-colors"></span>
                    </div>
                    <span id="onbStepCounter" class="text-xs font-medium text-muted-foreground">1 de 4</span>
                </div>

                <!-- ───── PASSO 1 · QUEM É VOCÊ? ───── -->
                <div id="onbStepView0" class="onb-step-view space-y-4">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-foreground">Quem é você?</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">Vamos começar pelo básico</p>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <label class="text-xs font-medium text-foreground">Nome completo</label>
                            <input type="text" id="regNome" placeholder="Ex: Maria Eduarda Lima" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="text-xs font-medium text-foreground">E-mail</label>
                            <div class="relative mt-1">
                                <i data-lucide="mail" class="pointer-events-none absolute left-3.5 top-1/2 size-4 -translate-y-1/2 text-muted-foreground"></i>
                                <input type="email" id="regEmail" placeholder="voce@email.com" class="h-12 w-full rounded-2xl border border-border bg-background pl-10 pr-4 text-sm text-foreground outline-none focus:border-primary">
                            </div>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-foreground">Telefone / WhatsApp</label>
                            <div class="relative mt-1">
                                <i data-lucide="phone" class="pointer-events-none absolute left-3.5 top-1/2 size-4 -translate-y-1/2 text-muted-foreground"></i>
                                <input type="tel" id="regTelefone" placeholder="(71) 99999-9999" class="h-12 w-full rounded-2xl border border-border bg-background pl-10 pr-4 text-sm text-foreground outline-none focus:border-primary">
                            </div>
                            <p class="mt-1 text-[11px] text-muted-foreground">Usado para recuperar a conta e convites do Lar.</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-foreground">Senha</label>
                            <div class="relative mt-1">
                                <input type="password" id="regSenha" oninput="testarForcaSenha(this.value)" placeholder="Mínimo 6 caracteres" class="h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none focus:border-primary">
                            </div>
                            <!-- Barra de Força -->
                            <div class="mt-2 flex items-center gap-2">
                                <div class="flex flex-1 gap-1">
                                    <span id="pwdBar1" class="h-1.5 flex-1 rounded-full bg-muted transition-colors"></span>
                                    <span id="pwdBar2" class="h-1.5 flex-1 rounded-full bg-muted transition-colors"></span>
                                    <span id="pwdBar3" class="h-1.5 flex-1 rounded-full bg-muted transition-colors"></span>
                                </div>
                                <span id="pwdLabel" class="text-xs font-medium text-muted-foreground"></span>
                            </div>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-foreground">Confirmar senha</label>
                            <input type="password" id="regSenhaConfirma" placeholder="Repita a senha" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none focus:border-primary">
                        </div>
                    </div>
                </div>

                <!-- ───── PASSO 2 · RENDA ───── -->
                <div id="onbStepView1" class="onb-step-view space-y-4 hidden">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-foreground">Agora me conta sobre sua renda</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">Isso ajuda o SEIVA a calcular sua saúde financeira</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <p class="mb-2 text-xs font-medium text-muted-foreground">Tipo de renda principal</p>
                            <div class="flex flex-wrap gap-2">
                                <button type="button" onclick="setRendaTipo('CLT')" id="btnRenda_CLT" class="min-h-11 rounded-xl border border-primary bg-primary text-primary-foreground px-4 text-sm font-medium transition">CLT</button>
                                <button type="button" onclick="setRendaTipo('Autônomo')" id="btnRenda_Autônomo" class="min-h-11 rounded-xl border border-border bg-background text-muted-foreground px-4 text-sm font-medium transition">Autônomo</button>
                                <button type="button" onclick="setRendaTipo('Empresário')" id="btnRenda_Empresário" class="min-h-11 rounded-xl border border-border bg-background text-muted-foreground px-4 text-sm font-medium transition">Empresário</button>
                                <button type="button" onclick="setRendaTipo('Outros')" id="btnRenda_Outros" class="min-h-11 rounded-xl border border-border bg-background text-muted-foreground px-4 text-sm font-medium transition">Outros</button>
                            </div>
                        </div>

                        <div>
                            <label class="text-xs font-medium text-foreground">Renda mensal principal (líquida)</label>
                            <input type="number" step="0.01" id="regRenda" placeholder="R$ 0,00" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-lg font-bold text-foreground outline-none focus:border-primary">
                        </div>

                        <div>
                            <label class="text-xs font-medium text-foreground">Que dia você costuma receber?</label>
                            <div class="relative mt-1">
                                <i data-lucide="calendar" class="pointer-events-none absolute left-3.5 top-1/2 size-4 -translate-y-1/2 text-muted-foreground"></i>
                                <select id="regDiaRecebe" class="h-12 w-full rounded-2xl border border-border bg-background pl-10 pr-4 text-sm text-foreground outline-none focus:border-primary">
                                    <option value="5">Todo dia 5</option>
                                    <option value="1">Todo dia 1</option>
                                    <option value="10">Todo dia 10</option>
                                    <option value="15">Todo dia 15</option>
                                    <option value="20">Todo dia 20</option>
                                    <option value="30">Último dia do mês</option>
                                    <option value="0">Varia / não tenho dia fixo</option>
                                </select>
                            </div>
                        </div>

                        <div class="rounded-2xl border border-border bg-card p-4 space-y-3 shadow-soft">
                            <label class="flex items-center justify-between cursor-pointer">
                                <div>
                                    <span class="block text-sm font-medium text-foreground">Tenho renda extra ou variável</span>
                                    <span class="block text-xs text-muted-foreground">Freelas, comissões, bicos</span>
                                </div>
                                <input type="checkbox" id="regTemExtra" onchange="document.getElementById('boxExtraInput').classList.toggle('hidden', !this.checked)" class="size-5 rounded border-border text-primary focus:ring-primary">
                            </label>
                            <div id="boxExtraInput" class="hidden pt-2 border-t border-border">
                                <label class="text-xs font-medium text-foreground">Média mensal de renda extra (R$)</label>
                                <input type="number" step="0.01" id="regRendaExtra" placeholder="R$ 0,00" class="mt-1 h-11 w-full rounded-xl border border-border bg-background px-3 text-sm font-bold text-foreground outline-none focus:border-primary">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ───── PASSO 3 · CONTAS & CAIXA PRETA ───── -->
                <div id="onbStepView2" class="onb-step-view space-y-4 hidden">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-foreground">Onde fica seu dinheiro?</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">Adicione ao menos uma conta para começar</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <p class="mb-2 text-xs font-medium text-muted-foreground">Banco principal</p>
                            <div class="grid grid-cols-4 gap-2">
                                <button type="button" onclick="setBancoPrincipal('Nubank')" class="banco-select-btn flex flex-col items-center gap-1.5 rounded-2xl border border-primary bg-accent/40 text-foreground py-2.5 text-xs font-medium transition" data-banco="Nubank">
                                    <span class="size-5 rounded-full bg-[#8A2BE2]"></span> Nubank
                                </button>
                                <button type="button" onclick="setBancoPrincipal('Inter')" class="banco-select-btn flex flex-col items-center gap-1.5 rounded-2xl border border-border bg-background text-muted-foreground py-2.5 text-xs font-medium transition" data-banco="Inter">
                                    <span class="size-5 rounded-full bg-[#FF7A00]"></span> Inter
                                </button>
                                <button type="button" onclick="setBancoPrincipal('Itaú')" class="banco-select-btn flex flex-col items-center gap-1.5 rounded-2xl border border-border bg-background text-muted-foreground py-2.5 text-xs font-medium transition" data-banco="Itaú">
                                    <span class="size-5 rounded-full bg-[#EC7000]"></span> Itaú
                                </button>
                                <button type="button" onclick="setBancoPrincipal('Caixa')" class="banco-select-btn flex flex-col items-center gap-1.5 rounded-2xl border border-border bg-background text-muted-foreground py-2.5 text-xs font-medium transition" data-banco="Caixa">
                                    <span class="size-5 rounded-full bg-[#0070AF]"></span> Caixa
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="text-xs font-medium text-foreground">Saldo atual na conta principal (R$)</label>
                            <input type="number" step="0.01" id="regSaldoInicial" placeholder="R$ 0,00" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-base font-bold text-foreground outline-none focus:border-primary">
                        </div>

                        <div>
                            <label class="text-xs font-medium text-foreground">Chave Pix Principal</label>
                            <input type="text" id="regPix" placeholder="CPF, telefone ou e-mail" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none focus:border-primary">
                        </div>

                        <!-- Configuração do PIN da Caixa Preta -->
                        <div class="rounded-2xl border border-border bg-secondary/50 p-4">
                            <div class="flex items-center gap-2 text-foreground font-semibold text-xs">
                                <i data-lucide="lock" class="size-4 text-primary"></i>
                                <span>PIN da Caixa Preta (4 dígitos)</span>
                            </div>
                            <p class="text-[11px] text-muted-foreground mt-1">Crie um código numérico de 4 dígitos para proteger seus gastos e reservas confidenciais.</p>
                            <input type="password" maxlength="4" id="regPinCaixa" placeholder="1234" class="mt-2 h-11 w-32 rounded-xl border border-border bg-card px-3 text-center text-lg font-bold tracking-widest text-foreground outline-none focus:border-primary">
                        </div>
                    </div>
                </div>

                <!-- ───── PASSO 4 · COMO QUER USAR O SEIVA? (LAR) ───── -->
                <div id="onbStepView3" class="onb-step-view space-y-4 hidden">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-foreground">Como você quer usar o SEIVA?</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">Você pode cuidar só das suas finanças ou dividir um Lar com quem mora com você.</p>
                    </div>

                    <div class="flex flex-col gap-2.5">
                        <button type="button" onclick="setEscolhaLar(false)" id="btnUsoIndividual" class="flex items-start gap-3 rounded-2xl border border-border bg-card p-4 text-left shadow-soft transition">
                            <span class="flex size-9 shrink-0 items-center justify-center rounded-xl bg-accent text-accent-foreground">
                                <i data-lucide="user" class="size-4"></i>
                            </span>
                            <div>
                                <span class="block text-sm font-semibold text-foreground">Controle individual</span>
                                <span class="block text-xs text-muted-foreground mt-0.5">Cuide só do seu dinheiro: renda, contas, metas e gastos pessoais.</span>
                            </div>
                        </button>
                        <button type="button" onclick="setEscolhaLar(true)" id="btnUsoLar" class="flex items-start gap-3 rounded-2xl border border-primary bg-accent/40 p-4 text-left shadow-soft transition">
                            <span class="flex size-9 shrink-0 items-center justify-center rounded-xl bg-primary text-primary-foreground">
                                <i data-lucide="home" class="size-4"></i>
                            </span>
                            <div>
                                <span class="block text-sm font-semibold text-foreground">Criar um Lar compartilhado</span>
                                <span class="block text-xs text-muted-foreground mt-0.5">Divida contas e metas com quem mora com você, de forma justa.</span>
                            </div>
                        </button>
                    </div>

                    <div id="boxConfigLar" class="space-y-4 pt-2">
                        <div>
                            <label class="text-xs font-medium text-foreground">Nome do Lar</label>
                            <input type="text" id="regNomeLar" value="Nosso Cantinho" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm font-semibold text-foreground outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="text-xs font-medium text-foreground">E-mail do parceiro(a) (opcional)</label>
                            <input type="email" id="regEmailParceiro" placeholder="parceiro@email.com" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none focus:border-primary">
                            <p class="mt-1 text-[11px] text-muted-foreground">Enviaremos um convite para a pessoa entrar no seu Lar.</p>
                        </div>
                        <div>
                            <p class="mb-2 text-xs font-medium text-muted-foreground">Como dividir as contas?</p>
                            <div class="grid grid-cols-2 gap-2">
                                <button type="button" onclick="setDivisaoPadrao('proporcional')" id="btnDivProp" class="rounded-2xl border border-primary bg-accent/50 p-3 text-left transition">
                                    <p class="text-xs font-bold text-foreground">Proporcional à renda</p>
                                    <p class="text-[10px] text-muted-foreground mt-0.5">Mais justo: quem ganha mais contribui mais</p>
                                </button>
                                <button type="button" onclick="setDivisaoPadrao('50/50')" id="btnDiv50" class="rounded-2xl border border-border bg-background p-3 text-left transition">
                                    <p class="text-xs font-bold text-foreground">Meio a meio</p>
                                    <p class="text-[10px] text-muted-foreground mt-0.5">Cada um paga exatamente metade das contas</p>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botão de Avanço do Formulário -->
            <div class="pt-6">
                <button type="button" onclick="avancarEtapaOnboarding()" id="btnAvancarOnboarding" class="flex h-14 w-full items-center justify-center gap-2 rounded-2xl bg-primary text-base font-semibold text-primary-foreground shadow-soft hover:bg-primary/90 transition">
                    <span id="btnAvancarOnboardingLabel">Próximo</span>
                    <i data-lucide="arrow-right" class="size-5"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- 3. APLICAÇÃO PRINCIPAL (APP SHELL)         -->
    <!-- ========================================== -->
    <div id="screen-app" class="app-screen min-h-screen bg-background">
        <!-- Sidebar Desktop -->
        <aside class="fixed inset-y-0 left-0 z-30 hidden w-64 flex-col border-r border-border bg-sidebar lg:flex">
            <!-- Header Sidebar -->
            <div class="px-6 py-6">
                <div class="flex items-center gap-2">
                    <div class="relative size-9 overflow-hidden rounded-xl border border-border bg-card flex items-center justify-center">
                        <img src="/seiva-logo.png" alt="SEIVA" class="object-contain p-1 w-full h-full" onerror="this.src='/icon.svg'">
                    </div>
                    <span class="text-lg font-semibold tracking-tight text-foreground">SEIVA</span>
                </div>
            </div>

            <!-- Navegação Sidebar -->
            <nav class="flex-1 space-y-5 overflow-y-auto px-4 pb-4 no-scrollbar">
                <div>
                    <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">
                        🔒 Minha área
                    </p>
                    <div class="space-y-1">
                        <button onclick="trocarAbaApp('dashboard')" class="nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors bg-primary text-primary-foreground shadow-soft" data-screen="dashboard">
                            <i data-lucide="home" class="size-[18px]"></i>
                            <span>Dashboard</span>
                        </button>
                        <button onclick="trocarAbaApp('caixa-preta')" class="nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="caixa-preta">
                            <i data-lucide="lock" class="size-[18px]"></i>
                            <span>Caixa Preta</span>
                        </button>
                        <button onclick="trocarAbaApp('transacoes')" class="nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="transacoes">
                            <i data-lucide="credit-card" class="size-[18px]"></i>
                            <span>Transações</span>
                        </button>
                        <button onclick="trocarAbaApp('metas')" class="nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="metas">
                            <i data-lucide="target" class="size-[18px]"></i>
                            <span>Metas</span>
                        </button>
                    </div>
                </div>

                <div>
                    <p id="labelGrupoLarSidebar" class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">
                        🌿 Nosso Cantinho
                    </p>
                    <div class="space-y-1">
                        <button onclick="trocarAbaApp('lar')" class="nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="lar">
                            <i data-lucide="leaf" class="size-[18px]"></i>
                            <span>Área do Lar</span>
                        </button>
                        <button onclick="trocarAbaApp('acordos')" class="nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="acordos">
                            <i data-lucide="handshake" class="size-[18px]"></i>
                            <span>Mesa de Acordos</span>
                        </button>
                        <button onclick="trocarAbaApp('cobrador')" class="nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="cobrador">
                            <i data-lucide="bell-ring" class="size-[18px]"></i>
                            <span>Cobrador Diplomata</span>
                        </button>
                    </div>
                </div>

                <div>
                    <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">
                        Conta
                    </p>
                    <div class="space-y-1">
                        <button onclick="trocarAbaApp('perfil')" class="nav-sidebar-item relative flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors text-muted-foreground hover:bg-accent/50 hover:text-foreground" data-screen="perfil">
                            <i data-lucide="user" class="size-[18px]"></i>
                            <span>Perfil & LGPD</span>
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Rodapé Sidebar Usuário -->
            <div class="p-4 border-t border-border">
                <button onclick="trocarAbaApp('perfil')" class="flex items-center gap-3 w-full rounded-2xl border border-border bg-card p-3 text-left transition hover:bg-accent/40">
                    <div id="userAvatarSidebar" class="size-10 rounded-full bg-pink-100 text-pink-700 font-bold flex items-center justify-center text-xs shrink-0">
                        DU
                    </div>
                    <div class="min-w-0 flex-1">
                        <p id="userNameSidebar" class="truncate text-sm font-semibold text-foreground">Usuário</p>
                        <span id="userLarPillSidebar" class="mt-0.5 inline-flex items-center gap-1 rounded-full bg-accent px-2 py-0.5 text-[10px] font-semibold text-accent-foreground">
                            Nosso Cantinho 🌿
                        </span>
                    </div>
                </button>
            </div>
        </aside>

        <!-- Área de Conteúdo -->
        <div class="lg:pl-64 flex flex-col min-h-screen">
            <!-- Top Bar com Sino -->
            <header class="sticky top-0 z-20 flex items-center justify-between border-b border-border/60 bg-background/80 px-4 py-3 backdrop-blur-sm lg:px-10 lg:justify-end">
                <div class="flex items-center gap-2 lg:hidden">
                    <div class="size-7 overflow-hidden rounded-lg border border-border bg-card p-0.5">
                        <img src="/seiva-logo.png" alt="SEIVA" class="object-contain w-full h-full">
                    </div>
                    <span class="text-sm font-bold text-foreground">SEIVA</span>
                </div>

                <div class="flex items-center gap-2">
                    <button onclick="trocarAbaApp('perfil')" aria-label="Configurações" class="flex size-10 items-center justify-center rounded-full border border-border bg-card text-muted-foreground transition hover:text-foreground lg:hidden">
                        <i data-lucide="settings" class="size-5"></i>
                    </button>
                    <button onclick="alert('🌿 Notificações do Lar:\n- Cobrador diplomata ativo\n- Sincronização em tempo real');" aria-label="Notificações" class="relative flex size-10 items-center justify-center rounded-full border border-border bg-card text-foreground shadow-soft transition hover:bg-muted">
                        <i data-lucide="bell" class="size-5"></i>
                        <span class="absolute -right-0.5 -top-0.5 flex size-4 items-center justify-center rounded-full bg-destructive text-[9px] font-bold text-destructive-foreground">
                            1
                        </span>
                    </button>
                </div>
            </header>

            <!-- Container Principal das Telas -->
            <main class="mx-auto w-full max-w-2xl px-4 pb-28 pt-6 lg:max-w-5xl lg:px-10 lg:pb-12 lg:pt-8 flex-1">

                <!-- 1. DASHBOARD SCREEN -->
                <div id="pane-dashboard" class="sub-screen space-y-6">
                    <header class="flex items-center gap-3">
                        <div id="dashAvatar" class="size-11 rounded-full bg-pink-100 text-pink-700 font-bold flex items-center justify-center text-sm ring-2 ring-card shadow-soft shrink-0">
                            DU
                        </div>
                        <div class="min-w-0 flex-1">
                            <p id="dashGreeting" class="text-base font-semibold text-foreground">Bom dia, Usuário</p>
                            <p id="dashDate" class="text-xs text-muted-foreground">Organização financeira com total transparência</p>
                        </div>
                        <span class="hidden items-center gap-1.5 rounded-full bg-secondary px-3 py-1.5 text-[11px] font-medium text-secondary-foreground sm:flex">
                            <i data-lucide="info" class="size-3.5"></i> Você registra, o SEIVA organiza
                        </span>
                    </header>

                    <!-- Card Consolidado do Mês -->
                    <section>
                        <div class="mb-2 flex items-end justify-between">
                            <div>
                                <h2 class="text-sm font-semibold text-foreground">Seu mês</h2>
                                <p class="text-[11px] text-muted-foreground">Visão consolidada de receitas e despesas</p>
                            </div>
                            <button onclick="alternarVisibilidadeSaldos()" id="btnVisSaldos" class="flex shrink-0 items-center gap-1 text-xs font-medium text-muted-foreground hover:text-foreground">
                                <i data-lucide="eye" class="size-3.5"></i>
                                <span>Ocultar</span>
                            </button>
                        </div>

                        <div class="rounded-3xl border border-border bg-card p-6 shadow-card">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-border pb-5">
                                <div>
                                    <p class="text-xs text-muted-foreground">Saldo Líquido Disponível</p>
                                    <h3 class="text-3xl font-extrabold text-foreground mt-1" id="dashValSaldoLivre">R$ 0,00</h3>
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
                                    <p class="mt-1 text-lg font-bold text-destructive" id="dashValComprometido">R$ 0,00</p>
                                    <p class="mt-0.5 text-[11px] text-muted-foreground">Faturas e reservas</p>
                                </div>
                                <div class="pl-4">
                                    <p class="flex items-center gap-1.5 text-[11px] font-medium text-success">
                                        <span class="size-2 rounded-full bg-success"></span> Livre pra gastar
                                    </p>
                                    <p class="mt-1 text-lg font-bold text-success" id="dashValLivre">R$ 0,00</p>
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
                        <button onclick="trocarAbaApp('transacoes')" class="flex flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-4 shadow-soft hover:bg-accent/30 transition text-center">
                            <span class="size-10 rounded-xl bg-secondary text-secondary-foreground flex items-center justify-center">
                                <i data-lucide="receipt" class="size-5"></i>
                            </span>
                            <span class="text-xs font-semibold text-foreground">Ver extrato</span>
                        </button>
                        <button onclick="trocarAbaApp('lar')" class="flex flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-4 shadow-soft hover:bg-accent/30 transition text-center">
                            <span class="size-10 rounded-xl bg-accent text-accent-foreground flex items-center justify-center">
                                <i data-lucide="home" class="size-5"></i>
                            </span>
                            <span class="text-xs font-semibold text-foreground">Contas do Lar</span>
                        </button>
                    </div>

                    <!-- Contas Bancárias Cadastradas -->
                    <section>
                        <div class="mb-3 flex items-center justify-between">
                            <h2 class="flex items-center gap-1.5 text-sm font-semibold text-foreground">
                                <i data-lucide="wallet" class="size-4 text-primary"></i> Onde está meu dinheiro
                            </h2>
                            <button onclick="adicionarContaPrompt()" class="flex items-center gap-1 text-xs font-medium text-primary hover:underline">
                                <i data-lucide="plus" class="size-3.5"></i> Nova conta
                            </button>
                        </div>
                        <div id="dashContasList" class="space-y-2">
                            <p class="text-xs text-muted-foreground py-4 text-center">Nenhuma conta cadastrada.</p>
                        </div>
                    </section>
                </div>

                <!-- 2. CAIXA PRETA SCREEN -->
                <div id="pane-caixa-preta" class="sub-screen space-y-6 hidden">
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

                    <div id="caixaPinLockBox" class="rounded-3xl border border-border bg-card p-8 text-center max-w-sm mx-auto space-y-4 shadow-card">
                        <div class="size-14 mx-auto rounded-full bg-amber-50 text-amber-600 flex items-center justify-center">
                            <i data-lucide="key-round" class="size-7"></i>
                        </div>
                        <h3 class="text-base font-bold text-foreground">Digite seu PIN de 4 dígitos</h3>
                        <p class="text-xs text-muted-foreground">Informe o PIN configurado no cadastro para acessar seus registros confidenciais.</p>
                        <input type="password" maxlength="4" id="caixaPinField" placeholder="••••" class="h-12 w-40 mx-auto text-center text-2xl tracking-widest font-bold rounded-2xl border border-border bg-background outline-none focus:border-primary">
                        <button onclick="validarPinCaixa()" class="w-full py-3 rounded-2xl bg-primary text-primary-foreground font-semibold text-xs transition shadow-card">
                            Desbloquear
                        </button>
                    </div>

                    <div id="caixaUnsealedBox" class="space-y-4 hidden">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold text-muted-foreground">Registros Secretos</span>
                            <div class="flex gap-2">
                                <button onclick="trancarCaixa()" class="text-xs font-medium text-muted-foreground hover:text-foreground">
                                    Bloquear
                                </button>
                                <button onclick="adicionarRegistroCaixaPrompt()" class="px-3 py-1.5 rounded-xl bg-primary text-primary-foreground text-xs font-bold">
                                    + Novo Registro
                                </button>
                            </div>
                        </div>
                        <div id="caixaRegistrosContainer" class="space-y-2">
                            <p class="text-xs text-muted-foreground py-6 text-center">Nenhum registro confidencial cadastrado.</p>
                        </div>
                    </div>
                </div>

                <!-- 3. TRANSAÇÕES SCREEN -->
                <div id="pane-transacoes" class="sub-screen space-y-5 hidden">
                    <header>
                        <h1 class="text-2xl font-bold tracking-tight text-foreground">Transações</h1>
                        <p class="mt-1 text-sm text-muted-foreground">Acompanhe suas entradas, saídas e movimentações</p>
                    </header>

                    <div class="rounded-3xl border border-border bg-card p-5 shadow-card">
                        <div class="flex items-center justify-between border-b border-border pb-3 mb-3">
                            <span class="text-xs font-bold text-foreground">Extrato Completo</span>
                            <button onclick="abrirModalGasto()" class="text-xs font-semibold text-primary hover:underline">+ Lançar</button>
                        </div>
                        <div id="extratoList" class="space-y-2 divide-y divide-border/60">
                            <p class="text-xs text-muted-foreground py-8 text-center">Nenhuma transação encontrada.</p>
                        </div>
                    </div>
                </div>

                <!-- 4. ÁREA DO LAR SCREEN -->
                <div id="pane-lar" class="sub-screen space-y-6 hidden">
                    <header>
                        <div class="flex items-center gap-2 text-xs font-medium text-muted-foreground">
                            <span class="flex size-6 items-center justify-center rounded-md bg-accent text-accent-foreground">
                                <i data-lucide="home" class="size-3.5"></i>
                            </span>
                            <span id="larHeaderTitle">Nosso Cantinho</span>
                        </div>
                        <h1 class="mt-2 text-2xl font-bold tracking-tight text-foreground">Painel do Lar</h1>
                        <div class="mt-3 flex items-center justify-between">
                            <p class="text-xs text-muted-foreground">Divisão colaborativa e rateio transparente</p>
                            <button onclick="abrirModalDespesaLar()" class="px-4 py-2 rounded-xl bg-primary text-primary-foreground text-xs font-bold shadow-soft">
                                + Nova Despesa do Lar
                            </button>
                        </div>
                    </header>

                    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-4">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Divisão Proporcional das Contas</h3>
                        <div id="larMembrosProporcaoGrid" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <p class="text-xs text-muted-foreground py-4 text-center col-span-full">Carregando membros do lar...</p>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-3">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Despesas do Lar Cadastradas</h3>
                        <div id="larDespesasGrid" class="space-y-3">
                            <p class="text-xs text-muted-foreground py-6 text-center">Nenhuma despesa compartilhada registrada.</p>
                        </div>
                    </div>
                </div>

                <!-- 5. MESA DE ACORDOS SCREEN -->
                <div id="pane-acordos" class="sub-screen space-y-6 hidden">
                    <header>
                        <h1 class="text-2xl font-bold tracking-tight text-foreground">Mesa de Acordos</h1>
                        <p class="mt-1 text-sm text-muted-foreground">Decisões conjuntas e compras planejadas para o lar</p>
                    </header>

                    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-3">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Propostas em Análise</h3>
                            <button onclick="adicionarPropostaPrompt()" class="text-xs font-semibold text-primary hover:underline">+ Nova Proposta</button>
                        </div>
                        <div id="acordosPropostasGrid" class="space-y-3">
                            <p class="text-xs text-muted-foreground py-6 text-center">Nenhuma proposta pendente de votação.</p>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-border bg-card p-5 shadow-card space-y-3">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Acordos Selados</h3>
                        <div id="acordosSeladosGrid" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <p class="text-xs text-muted-foreground py-6 text-center col-span-full">Nenhum acordo ativo no momento.</p>
                        </div>
                    </div>
                </div>

                <!-- 6. METAS SCREEN -->
                <div id="pane-metas" class="sub-screen space-y-6 hidden">
                    <header class="rounded-3xl bg-primary p-6 text-primary-foreground shadow-card">
                        <p class="text-sm opacity-80">Meus Objetivos e Metas do Casal</p>
                        <h1 class="mt-1 text-3xl font-bold tracking-tight" id="metasValorTotalDisplay">R$ 0,00</h1>
                        <p class="mt-1 text-sm opacity-80" id="metasAlvoTotalDisplay">de R$ 0,00 planejados</p>
                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <div class="rounded-2xl bg-primary-foreground/15 px-3 py-2.5">
                                <p class="text-[11px] opacity-80">Progresso geral</p>
                                <p class="mt-0.5 text-lg font-bold" id="metasProgressoPct">0%</p>
                            </div>
                            <div class="rounded-2xl bg-primary-foreground/15 px-3 py-2.5">
                                <p class="text-[11px] opacity-80">Metas ativas</p>
                                <p class="mt-0.5 text-lg font-bold" id="metasQtdAtivas">0</p>
                            </div>
                        </div>
                    </header>

                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-foreground">Metas Ativas</span>
                        <button onclick="adicionarMetaPrompt()" class="px-3 py-1.5 rounded-xl bg-primary text-primary-foreground text-xs font-bold">+ Nova Meta</button>
                    </div>

                    <div id="metasCardsGrid" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <p class="text-xs text-muted-foreground py-8 text-center col-span-full">Nenhuma meta cadastrada.</p>
                    </div>
                </div>

                <!-- 7. COBRADOR DIPLOMATA SCREEN -->
                <div id="pane-cobrador" class="sub-screen space-y-6 hidden">
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
                        <div id="cobradorPendenciasGrid" class="space-y-3">
                            <p class="text-xs text-muted-foreground py-6 text-center">Nenhuma pendência no momento. Tudo em dia!</p>
                        </div>
                    </div>
                </div>

                <!-- 8. PERFIL & LGPD SCREEN -->
                <div id="pane-perfil" class="sub-screen space-y-6 hidden">
                    <header class="rounded-3xl bg-primary p-6 text-primary-foreground shadow-card">
                        <div class="flex items-center gap-4">
                            <div id="perfilAvatarCircle" class="size-16 rounded-full bg-pink-100 text-pink-700 font-bold flex items-center justify-center text-lg ring-2 ring-primary-foreground/30 shrink-0">
                                DU
                            </div>
                            <div class="min-w-0 flex-1">
                                <p id="perfilNomeTxt" class="text-lg font-bold tracking-tight truncate">Nome Usuário</p>
                                <p id="perfilEmailTxt" class="text-sm opacity-80 truncate">email@email.com</p>
                            </div>
                        </div>
                        <button onclick="executarLogout()" class="mt-4 flex items-center gap-1.5 rounded-xl bg-primary-foreground/15 px-3.5 py-2 text-sm font-medium transition hover:bg-primary-foreground/25">
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

        <!-- FAB (Floating Action Button) -->
        <div class="fixed bottom-24 right-5 z-40 flex flex-col items-end gap-3 lg:bottom-8">
            <div id="fabDropdown" class="hidden flex flex-col items-end gap-2">
                <button onclick="abrirModalGasto(); alternarFab();" class="flex items-center gap-2 rounded-full bg-card py-2 pl-3 pr-4 text-xs font-semibold text-foreground shadow-elevated border border-border hover:bg-muted transition">
                    <span class="size-7 rounded-full bg-rose-100 text-rose-700 flex items-center justify-center">
                        <i data-lucide="trending-down" class="size-3.5"></i>
                    </span>
                    <span>Lançar gasto</span>
                </button>
                <button onclick="abrirModalEntrada(); alternarFab();" class="flex items-center gap-2 rounded-full bg-card py-2 pl-3 pr-4 text-xs font-semibold text-foreground shadow-elevated border border-border hover:bg-muted transition">
                    <span class="size-7 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                        <i data-lucide="trending-up" class="size-3.5"></i>
                    </span>
                    <span>Registrar entrada</span>
                </button>
                <button onclick="abrirModalDespesaLar(); alternarFab();" class="flex items-center gap-2 rounded-full bg-card py-2 pl-3 pr-4 text-xs font-semibold text-foreground shadow-elevated border border-border hover:bg-muted transition">
                    <span class="size-7 rounded-full bg-accent text-accent-foreground flex items-center justify-center">
                        <i data-lucide="home" class="size-3.5"></i>
                    </span>
                    <span>Despesa do Lar</span>
                </button>
            </div>
            <button onclick="alternarFab()" aria-label="Ações rápidas" class="flex size-14 items-center justify-center rounded-2xl bg-primary text-primary-foreground shadow-elevated active:scale-95 transition">
                <i data-lucide="plus" class="size-6"></i>
            </button>
        </div>

        <!-- Bottom Navigation Mobile -->
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
                <button onclick="trocarAbaApp('acordos')" class="flex flex-1 flex-col items-center gap-1 rounded-lg py-1.5 text-muted-foreground" data-screen="acordos">
                    <i data-lucide="handshake" class="size-5"></i>
                    <span class="text-[10px] font-medium">Acordos</span>
                </button>
                <button onclick="trocarAbaApp('metas')" class="flex flex-1 flex-col items-center gap-1 rounded-lg py-1.5 text-muted-foreground" data-screen="metas">
                    <i data-lucide="target" class="size-5"></i>
                    <span class="text-[10px] font-medium">Metas</span>
                </button>
                <button onclick="trocarAbaApp('lar')" class="flex flex-1 flex-col items-center gap-1 rounded-lg py-1.5 text-muted-foreground" data-screen="lar">
                    <i data-lucide="leaf" class="size-5"></i>
                    <span class="text-[10px] font-medium">Lar</span>
                </button>
            </div>
        </nav>
    </div>

    <!-- MODAL: REGISTRAR GASTO / ENTRADA -->
    <div id="modalTransacao" class="hidden fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
        <div class="rounded-3xl border border-border bg-card p-6 max-w-md w-full shadow-elevated relative">
            <button onclick="fecharModalId('modalTransacao')" class="absolute top-5 right-5 text-muted-foreground hover:text-foreground">
                <i data-lucide="x" class="size-5"></i>
            </button>
            <h3 class="text-lg font-bold text-foreground mb-4" id="modalTransacaoHeader">Registrar Gasto</h3>
            <form onsubmit="salvarTransacaoForm(event)" class="space-y-4">
                <input type="hidden" id="formTransTipo" value="saida">
                <div>
                    <label class="text-xs font-medium text-foreground">Descrição</label>
                    <input type="text" id="formTransTitulo" required placeholder="Ex: Mercado, Almoço, Farmácia" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none focus:border-primary">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-medium text-foreground">Valor (R$)</label>
                        <input type="number" step="0.01" id="formTransValor" required placeholder="0,00" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-base font-bold text-foreground outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-foreground">Conta</label>
                        <select id="formTransContaId" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-3 text-xs text-foreground outline-none focus:border-primary"></select>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-medium text-foreground">Categoria</label>
                    <select id="formTransCategoriaId" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-3 text-xs text-foreground outline-none focus:border-primary"></select>
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
            <button onclick="fecharModalId('modalDespesaLar')" class="absolute top-5 right-5 text-muted-foreground hover:text-foreground">
                <i data-lucide="x" class="size-5"></i>
            </button>
            <h3 class="text-lg font-bold text-foreground mb-4">Lançar Despesa do Lar</h3>
            <form onsubmit="salvarDespesaLarForm(event)" class="space-y-4">
                <div>
                    <label class="text-xs font-medium text-foreground">Nome da Despesa</label>
                    <input type="text" id="formLarDespTitulo" required placeholder="Ex: Aluguel, Internet, Mercado" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none focus:border-primary">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-medium text-foreground">Valor Total (R$)</label>
                        <input type="number" step="0.01" id="formLarDespValor" required placeholder="0,00" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-base font-bold text-foreground outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-foreground">Regra de Divisão</label>
                        <select id="formLarDespDivisao" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-3 text-xs text-foreground outline-none focus:border-primary">
                            <option value="proporcional">Proporcional à renda</option>
                            <option value="50/50">50% / 50%</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-medium text-foreground">Vencimento</label>
                    <input type="date" id="formLarDespData" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none focus:border-primary">
                </div>
                <button type="submit" class="w-full mt-2 h-12 rounded-2xl bg-primary text-primary-foreground font-semibold text-sm shadow-card hover:bg-primary/90 transition">
                    Calcular Rateio & Salvar
                </button>
            </form>
        </div>
    </div>

    <!-- SCRIPT DE LÓGICA E FLUXOS REAIS -->
    <script>
        // Estado
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
            document.getElementById('formLarDespData').value = new Date().toISOString().split('T')[0];
            await carregarCategoriasSistema();
            await validarSessaoInicial();
        });

        // ==========================================
        // GERENCIADOR DE TELAS (EXIBIÇÃO PURA SEM SOBREPOSIÇÃO)
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
        }

        function irParaOnboarding() {
            stepOnboarding = 0;
            document.getElementById('onboardingFaseWelcome').classList.remove('hidden');
            document.getElementById('onboardingFaseForm').classList.add('hidden');
            trocarTelaPrincipal('screen-onboarding');
        }

        function iniciarFormularioOnboarding() {
            document.getElementById('onboardingFaseWelcome').classList.add('hidden');
            document.getElementById('onboardingFaseForm').classList.remove('hidden');
            stepOnboarding = 0;
            renderizarPassoOnboarding();
        }

        function recuarPassoOnboarding() {
            if (stepOnboarding === 0) {
                document.getElementById('onboardingFaseForm').classList.add('hidden');
                document.getElementById('onboardingFaseWelcome').classList.remove('hidden');
                window.scrollTo({ top: 0, behavior: 'instant' });
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

            document.getElementById('onbStepCounter').innerText = `${stepOnboarding + 1} de 4`;
            document.getElementById('btnAvancarOnboardingLabel').innerText = stepOnboarding === 3 ? "Concluir cadastro e entrar" : "Próximo";
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
                // Envia os dados completos para a API Laravel
                const payload = {
                    nome: document.getElementById('regNome').value.trim(),
                    email: document.getElementById('regEmail').value.trim(),
                    telefone: document.getElementById('regTelefone').value.trim(),
                    senha: document.getElementById('regSenha').value,
                    tipo_renda: tipoRendaOnboarding.toLowerCase(),
                    renda_mensal: parseFloat(document.getElementById('regRenda').value) || 0,
                    dia_recebimento: parseInt(document.getElementById('regDiaRecebe').value) || 5,
                    renda_extra: parseFloat(document.getElementById('regRendaExtra').value) || 0,
                    banco_principal: bancoOnboarding,
                    chave_pix: document.getElementById('regPix').value.trim(),
                    pin_caixa_preta: document.getElementById('regPinCaixa').value || '1234',
                };

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
            document.getElementById('btnUsoIndividual').className = !criar ? "flex items-start gap-3 rounded-2xl border border-primary bg-accent/40 p-4 text-left shadow-soft transition" : "flex items-start gap-3 rounded-2xl border border-border bg-card p-4 text-left shadow-soft transition";
            document.getElementById('btnUsoLar').className = criar ? "flex items-start gap-3 rounded-2xl border border-primary bg-accent/40 p-4 text-left shadow-soft transition" : "flex items-start gap-3 rounded-2xl border border-border bg-card p-4 text-left shadow-soft transition";
            document.getElementById('boxConfigLar').classList.toggle('hidden', !criar);
        }

        function setDivisaoPadrao(div) {
            divisaoOnboarding = div;
            document.getElementById('btnDivProp').className = div === 'proporcional' ? "rounded-2xl border border-primary bg-accent/50 p-3 text-left transition" : "rounded-2xl border border-border bg-background p-3 text-left transition";
            document.getElementById('btnDiv50').className = div === '50/50' ? "rounded-2xl border border-primary bg-accent/50 p-3 text-left transition" : "rounded-2xl border border-border bg-background p-3 text-left transition";
        }

        function testarForcaSenha(val) {
            const b1 = document.getElementById('pwdBar1');
            const b2 = document.getElementById('pwdBar2');
            const b3 = document.getElementById('pwdBar3');
            const lbl = document.getElementById('pwdLabel');

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
        // LOGIN & SESSÃO
        // ==========================================
        async function executarLogin(e) {
            e.preventDefault();
            const email = document.getElementById('loginEmail').value.trim();
            const senha = document.getElementById('loginSenha').value;

            const res = await fetch('/api/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, senha })
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
