{{-- 
    Módulo: Autenticação / Login & Cadastro (RF001)
    Responsável Acadêmica: Quételi
    Funcionalidade: Apresentação da marca SEIVA com composição visual limpa do Casal (Duda & Ian), 
    marca d'água da logo no fundo, logo oficial em destaque e alternância de abas 100% funcional.
--}}
<div id="screen-login" class="app-screen is-active relative min-h-screen overflow-hidden bg-background">
    
    <!-- ============================================================== -->
    <!-- LATERAL ESQUERDA: APRESENTAÇÃO MINIMALISTA DO CASAL & LAR      -->
    <!-- (Desktop: 50% da tela, Marca d'água PNG, Duda & Ian e Mockup)   -->
    <!-- ============================================================== -->
    <div class="relative hidden w-1/2 min-h-screen bg-gradient-to-br from-[#0f291b] via-[#163826] to-[#204e35] p-8 xl:p-12 lg:flex flex-col justify-between text-white overflow-hidden shadow-2xl float-left">
        
        <!-- Marca d'água de fundo: Logo SEIVA em PNG grande e sutil (Conforme solicitado) -->
        <div class="pointer-events-none absolute inset-0 flex items-center justify-center overflow-hidden">
            <img src="/seiva-logo-white.png" alt="" class="w-[500px] h-[500px] object-contain opacity-[0.06] select-none pointer-events-none transform -rotate-12 translate-y-6">
        </div>

        <!-- ───── TOPO: LOGO DA SEIVA EM DESTAQUE NOBRE (SEM FUNDO BRANCO DURO) ───── -->
        <div class="relative z-10 flex items-center justify-between">
            <div class="flex items-center gap-3.5">
                <!-- Logo Oficial Branca com Transparência Nativa -->
                <div class="relative size-14 overflow-hidden rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 p-2 shadow-soft flex items-center justify-center transition-transform hover:scale-105">
                    <img src="/seiva-logo-white.png" alt="SEIVA" class="object-contain w-full h-full drop-shadow-sm">
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-3xl font-black tracking-tight text-white block leading-none">SEIVA</span>
                        <span class="px-2 py-0.5 rounded-full bg-emerald-400/20 text-emerald-200 text-[10px] font-bold uppercase tracking-wider border border-emerald-300/25">
                            Casal & Lar
                        </span>
                    </div>
                    <span class="text-[11px] font-semibold text-emerald-200/90 tracking-widest uppercase block mt-1">
                        Dinheiro Sem Tabu
                    </span>
                </div>
            </div>
            
            <span class="hidden xl:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 border border-white/15 text-xs font-medium text-emerald-100 backdrop-blur-sm">
                <i data-lucide="leaf" class="size-3.5 text-emerald-300"></i>
                Gestão Compartilhada
            </span>
        </div>

        <!-- ───── CENTRO: HERO MINIMALISTA — CASAL + CELULAR ───── -->
        {{-- max-w-sm = ~384px. Casal 240px + celular 175px = 415px → overlap ~31px = dedo toca o celular --}}
        <div class="relative z-10 my-auto flex items-end justify-center w-full max-w-sm mx-auto" style="height: 420px;">

            <!-- Círculos concêntricos sutis de fundo -->
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none">
                <div class="absolute rounded-full border border-white/[0.06]" style="width:360px;height:360px;"></div>
                <div class="absolute rounded-full border border-white/[0.05]" style="width:260px;height:260px;"></div>
                <div class="absolute rounded-full border border-white/[0.04]" style="width:150px;height:150px;"></div>
            </div>

            <!-- CASAL: posicionado à esquerda, o braço estendido da Duda aponta para o celular -->
            <div class="absolute bottom-0 left-0 z-10 select-none pointer-events-none"
                 style="width: 240px;">
                <img src="/casal-hero.png" alt="Duda e Ian"
                     class="w-full h-auto object-contain"
                     style="filter: drop-shadow(0 16px 32px rgba(0,0,0,0.4));">
            </div>

            <!-- CELULAR: posicionado à direita, encostado na ponta do dedo do casal -->
            <div class="animate-float-slow absolute z-20"
                 style="right: 0; top: 10px; width: 175px;">

                <!-- Corpo do celular — visual iPhone/Android moderno -->
                <div class="relative rounded-[36px] bg-[#0c1f17] overflow-hidden"
                     style="
                        border: 7px solid #0c1f17;
                        box-shadow:
                            0 0 0 1px rgba(255,255,255,0.08),
                            0 40px 80px -10px rgba(0,0,0,0.7),
                            0 10px 30px rgba(0,0,0,0.4),
                            inset 0 1px 0 rgba(255,255,255,0.1);
                     ">

                    <!-- Dynamic Island -->
                    <div class="flex justify-center pt-3 pb-1">
                        <div class="h-[18px] w-[60px] rounded-full bg-black"></div>
                    </div>

                    <!-- TELA DO APP -->
                    <div class="rounded-[26px] overflow-hidden mx-[2px] mb-[2px]">

                        <!-- Header verde do app SEIVA -->
                        <div class="bg-[#0f291b] px-3 pt-2 pb-3">
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-1">
                                    <div class="size-4 rounded-full bg-amber-400 flex items-center justify-center">
                                        <span class="text-[6px] font-black text-emerald-900">S</span>
                                    </div>
                                    <span class="text-[8px] font-black text-white">SEIVA</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <div class="relative">
                                        <svg class="size-3 text-white/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                                            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                                        </svg>
                                        <div class="absolute -top-0.5 -right-0.5 size-1.5 rounded-full bg-amber-400"></div>
                                    </div>
                                    <div class="size-5 rounded-full bg-emerald-700 border border-emerald-500/40 flex items-center justify-center">
                                        <span class="text-[6px] font-black text-white">DI</span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-[7px] text-emerald-300/70">Nosso Cantinho 🌿</p>
                            <p class="text-[10px] font-black text-white">Duda &amp; Ian</p>
                        </div>

                        <!-- Corpo do app: fundo cinza claríssimo -->
                        <div class="bg-[#f4f6f4] px-2.5 py-2.5 space-y-2">

                            <!-- Card saldo -->
                            <div class="bg-white rounded-2xl p-2.5 shadow-sm">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-[6.5px] text-stone-400 uppercase tracking-wider font-semibold">Saldo do Lar</p>
                                        <p class="text-[15px] font-black text-stone-900 leading-none mt-0.5">R$&nbsp;12.450</p>
                                        <p class="text-[6.5px] text-emerald-600 font-bold mt-1">↗ +R$ 2.100 este mês</p>
                                    </div>
                                    <svg class="w-10 h-7 mt-0.5" viewBox="0 0 60 36" fill="none">
                                        <path d="M0 28 C10 22,20 12,32 18 C44 24,50 6,60 3"
                                              stroke="#2e7d5c" stroke-width="2" stroke-linecap="round"/>
                                        <circle cx="60" cy="3" r="2.5" fill="#2e7d5c"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- 3 atalhos -->
                            <div class="grid grid-cols-3 gap-1.5">
                                <div class="bg-white rounded-xl py-2 text-center shadow-sm flex flex-col items-center gap-0.5">
                                    <div class="size-5 rounded-full bg-rose-50 flex items-center justify-center">
                                        <svg class="size-2.5 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 19V5m-7 7l7-7 7 7"/></svg>
                                    </div>
                                    <span class="text-[6px] font-bold text-stone-600">Rateio</span>
                                </div>
                                <div class="bg-white rounded-xl py-2 text-center shadow-sm flex flex-col items-center gap-0.5">
                                    <div class="size-5 rounded-full bg-sky-50 flex items-center justify-center">
                                        <svg class="size-2.5 text-sky-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14m7-7l-7 7-7-7"/></svg>
                                    </div>
                                    <span class="text-[6px] font-bold text-stone-600">Receita</span>
                                </div>
                                <div class="bg-white rounded-xl py-2 text-center shadow-sm flex flex-col items-center gap-0.5">
                                    <div class="size-5 rounded-full bg-emerald-50 flex items-center justify-center">
                                        <svg class="size-2.5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M8 7h8M8 12h8M8 17h4"/></svg>
                                    </div>
                                    <span class="text-[6px] font-bold text-stone-600">Acordo</span>
                                </div>
                            </div>

                            <!-- Este mês -->
                            <div class="bg-white rounded-2xl p-2.5 shadow-sm">
                                <p class="text-[6.5px] font-bold text-stone-700 mb-1.5">Este mês</p>
                                <div class="grid grid-cols-2 gap-1">
                                    <div class="rounded-xl bg-emerald-50 px-2 py-1.5">
                                        <p class="text-[5.5px] text-stone-400 font-medium">Receitas</p>
                                        <p class="text-[10px] font-black text-emerald-700">8.500</p>
                                        <p class="text-[5.5px] text-emerald-600 font-bold">▲ 12%</p>
                                    </div>
                                    <div class="rounded-xl bg-rose-50 px-2 py-1.5">
                                        <p class="text-[5.5px] text-stone-400 font-medium">Despesas</p>
                                        <p class="text-[10px] font-black text-rose-600">4.900</p>
                                        <p class="text-[5.5px] text-rose-500 font-bold">▲ 27%</p>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /corpo app -->

                        <!-- Home bar -->
                        <div class="bg-[#f4f6f4] flex justify-center py-2">
                            <div class="h-[3px] w-12 rounded-full bg-stone-300"></div>
                        </div>

                    </div><!-- /tela -->

                    <!-- Botão power -->
                    <div class="absolute -right-[6px] top-20 h-12 w-[4px] rounded-r-full bg-[#1a3828]"></div>
                    <!-- Botões volume -->
                    <div class="absolute -left-[6px] top-14 h-7 w-[4px] rounded-l-full bg-[#1a3828]"></div>
                    <div class="absolute -left-[6px] top-24 h-7 w-[4px] rounded-l-full bg-[#1a3828]"></div>

                </div>

                <!-- Reflexo/sombra no chão -->
                <div class="mx-auto mt-3 rounded-full bg-black/20 blur-lg" style="height:10px;width:120px;"></div>
            </div>

        </div>

        <!-- ───── RODAPÉ: LGPD & SLOGAN OFICIAL ───── -->
        <div class="relative z-10 flex items-center justify-between text-[11px] text-white/70 border-t border-white/10 pt-4">
            <span class="flex items-center gap-1.5">
                <i data-lucide="shield-check" class="size-4 text-emerald-300"></i>
                Privacidade & Conformidade com a LGPD
            </span>
            <span class="flex items-center gap-1.5 text-emerald-200 font-medium">
                <i data-lucide="leaf" class="size-3.5"></i> Onde seu dinheiro cria raízes
            </span>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- LATERAL DIREITA: CARD DE LOGIN & CADASTRO (100% OPERACIONAL)   -->
    <!-- ============================================================== -->
    <div class="relative z-10 mx-auto w-full min-h-screen flex flex-col justify-center px-4 py-8 sm:px-6 lg:w-1/2 lg:px-12 xl:px-16">
        
        <!-- Mobile Header Hero (Experiência Exclusiva e Imersiva para Celular) -->
        <div class="mb-6 lg:hidden rounded-3xl bg-gradient-to-br from-[#0f291b] via-[#163826] to-[#204e35] p-6 text-white text-center shadow-card">
            <div class="relative size-16 mx-auto overflow-hidden rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 p-2 shadow-soft flex items-center justify-center">
                <img src="/seiva-logo-white.png" alt="SEIVA" class="object-contain w-full h-full drop-shadow-sm">
            </div>
            <h1 class="mt-3 text-2xl font-black tracking-tight text-white">SEIVA</h1>
            <p class="mt-1 text-xs text-emerald-200 flex items-center justify-center gap-1.5 font-medium">
                <i data-lucide="leaf" class="size-3.5 text-emerald-300"></i>
                Finanças do Casal · Dinheiro Sem Tabu
            </p>
            <div class="mt-4 flex gap-2 overflow-x-auto no-scrollbar pb-1 text-[11px]">
                <span class="shrink-0 px-2.5 py-1 rounded-full bg-white/15 border border-white/10 text-white flex items-center gap-1">
                    <i data-lucide="lock" class="size-3 text-amber-300"></i> Caixa Preta com PIN
                </span>
                <span class="shrink-0 px-2.5 py-1 rounded-full bg-white/15 border border-white/10 text-white flex items-center gap-1">
                    <i data-lucide="scale" class="size-3 text-emerald-300"></i> Rateio Proporcional
                </span>
                <span class="shrink-0 px-2.5 py-1 rounded-full bg-white/15 border border-white/10 text-white flex items-center gap-1">
                    <i data-lucide="bell-ring" class="size-3 text-sky-300"></i> Cobrador Diplomata
                </span>
            </div>
        </div>

        <!-- CARD PRINCIPAL DE AUTENTICAÇÃO COM SISTEMA DE ABAS REAIS -->
        <div class="w-full max-w-md mx-auto">
            <div class="rounded-3xl border border-border bg-card p-6 sm:p-8 shadow-card lg:shadow-elevated">
                
                <!-- Abas Superiores Alternáveis: [ Entrar | Criar conta ] (100% Funcional) -->
                <div class="relative mb-6 flex rounded-2xl bg-muted p-1">
                    <button type="button" id="tabAuthEntrar" onclick="alternarAbaAuth('entrar')" class="relative z-10 flex-1 rounded-xl py-2.5 text-sm font-semibold bg-primary text-primary-foreground shadow-soft transition-all">
                        Entrar
                    </button>
                    <button type="button" id="tabAuthCadastro" onclick="alternarAbaAuth('cadastro')" class="relative z-10 flex-1 rounded-xl py-2.5 text-sm font-semibold text-muted-foreground hover:text-foreground transition-all">
                        Criar conta
                    </button>
                </div>

                <!-- Título Dinâmico do Card -->
                <div class="mb-5 text-left">
                    <h2 id="authCardTitle" class="text-xl font-bold tracking-tight text-foreground">Bem-vindo(a) de volta</h2>
                    <p id="authCardSubtitle" class="text-xs text-muted-foreground mt-0.5">Acesse seu painel pessoal e o ambiente do seu Lar</p>
                </div>

                <!-- ============================================== -->
                <!-- 1. FORMULÁRIO DE LOGIN (ABA: ENTRAR)           -->
                <!-- ============================================== -->
                <form id="formLoginCard" onsubmit="executarLogin(event)" class="space-y-4">
                    <!-- Input E-mail -->
                    <div class="relative">
                        <input type="email" id="loginEmail" required placeholder=" " class="floating-input peer h-14 w-full rounded-2xl border border-border bg-background px-4 pt-4 text-sm text-foreground outline-none transition-colors focus:border-primary focus:ring-2 focus:ring-primary/20">
                        <label class="floating-label pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-muted-foreground transition-all duration-200">
                            E-mail cadastrado
                        </label>
                    </div>

                    <!-- Input Senha -->
                    <div class="relative">
                        <input type="password" id="loginSenha" required placeholder=" " class="floating-input peer h-14 w-full rounded-2xl border border-border bg-background px-4 pt-4 text-sm text-foreground outline-none transition-colors focus:border-primary focus:ring-2 focus:ring-primary/20">
                        <label class="floating-label pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-muted-foreground transition-all duration-200">
                            Senha de acesso
                        </label>
                    </div>

                    <div class="flex items-center justify-between text-xs pt-1">
                        <label class="flex items-center gap-2 cursor-pointer text-muted-foreground">
                            <input type="checkbox" id="loginLembrar" checked class="rounded border-border text-primary focus:ring-primary">
                            Lembrar de mim
                        </label>
                        <a href="#" onclick="alert('Recuperação de conta: para redefinir sua senha, solicite ao administrador ou confirme o e-mail cadastrado.'); return false;" class="font-medium text-primary hover:underline">
                            Esqueceu a senha?
                        </a>
                    </div>

                    <button type="submit" id="loginSubmitBtn" class="w-full mt-2 h-14 py-3.5 rounded-2xl bg-primary text-primary-foreground font-semibold text-sm shadow-card hover:bg-primary/90 active:scale-[0.99] transition flex items-center justify-center gap-2">
                        <span>Entrar no SEIVA</span>
                        <i data-lucide="arrow-right" class="size-4"></i>
                    </button>
                </form>

                <!-- ============================================== -->
                <!-- 2. FORMULÁRIO DE CADASTRO (ABA: CRIAR CONTA)   -->
                <!-- ============================================== -->
                <form id="formCadastroCard" onsubmit="executarCadastroCard(event)" class="space-y-3.5 hidden">
                    <!-- Nome Completo -->
                    <div class="relative">
                        <input type="text" id="cardRegNome" required placeholder=" " class="floating-input peer h-13 w-full rounded-2xl border border-border bg-background px-4 pt-4 text-sm text-foreground outline-none transition-colors focus:border-primary focus:ring-2 focus:ring-primary/20">
                        <label class="floating-label pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-muted-foreground transition-all duration-200">
                            Nome completo
                        </label>
                    </div>

                    <!-- E-mail -->
                    <div class="relative">
                        <input type="email" id="cardRegEmail" required placeholder=" " class="floating-input peer h-13 w-full rounded-2xl border border-border bg-background px-4 pt-4 text-sm text-foreground outline-none transition-colors focus:border-primary focus:ring-2 focus:ring-primary/20">
                        <label class="floating-label pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-muted-foreground transition-all duration-200">
                            E-mail principal
                        </label>
                    </div>

                    <!-- Senha -->
                    <div class="grid grid-cols-2 gap-2.5">
                        <div class="relative">
                            <input type="password" id="cardRegSenha" required placeholder=" " class="floating-input peer h-13 w-full rounded-2xl border border-border bg-background px-4 pt-4 text-sm text-foreground outline-none transition-colors focus:border-primary focus:ring-2 focus:ring-primary/20">
                            <label class="floating-label pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-xs text-muted-foreground transition-all duration-200">
                                Senha (mín. 6)
                            </label>
                        </div>
                        <div class="relative">
                            <input type="password" id="cardRegSenhaConfirma" required placeholder=" " class="floating-input peer h-13 w-full rounded-2xl border border-border bg-background px-4 pt-4 text-sm text-foreground outline-none transition-colors focus:border-primary focus:ring-2 focus:ring-primary/20">
                            <label class="floating-label pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-xs text-muted-foreground transition-all duration-200">
                                Confirmar senha
                            </label>
                        </div>
                    </div>

                    <!-- Renda Mensal (Para cálculo do rateio proporcional) -->
                    <div class="relative">
                        <input type="number" step="0.01" id="cardRegRenda" placeholder=" " class="floating-input peer h-13 w-full rounded-2xl border border-border bg-background px-4 pt-4 text-sm font-semibold text-foreground outline-none transition-colors focus:border-primary focus:ring-2 focus:ring-primary/20">
                        <label class="floating-label pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-xs text-muted-foreground transition-all duration-200">
                            Sua renda mensal (R$) · Opcional para o rateio justo
                        </label>
                    </div>

                    <p class="text-[11px] text-muted-foreground leading-relaxed">
                        Ao criar sua conta, seus dados são protegidos por criptografia e pela LGPD.
                    </p>

                    <button type="submit" id="cardRegSubmitBtn" class="w-full h-14 rounded-2xl bg-primary text-primary-foreground font-semibold text-sm shadow-card hover:bg-primary/90 active:scale-[0.99] transition flex items-center justify-center gap-2">
                        <span>Criar minha conta no SEIVA</span>
                        <i data-lucide="arrow-right" class="size-4"></i>
                    </button>

                    <!-- Link para o Onboarding Passo a Passo Completo -->
                    <div class="pt-1 text-center">
                        <button type="button" onclick="irParaOnboarding()" class="text-xs font-semibold text-primary hover:underline flex items-center justify-center gap-1 mx-auto">
                            <span>Prefere configurar o Lar passo a passo?</span>
                            <span class="font-bold underline">Abrir Onboarding guiado →</span>
                        </button>
                    </div>
                </form>

                <!-- Divisor -->
                <div class="relative my-6 flex items-center justify-center">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-border"></div></div>
                    <span class="relative bg-card px-3 text-xs text-muted-foreground">ou continue com</span>
                </div>

                <!-- Botão Google Oficial Funcional -->
                <button type="button" onclick="iniciarGoogleAuth()" class="w-full h-12 rounded-2xl border border-border bg-card hover:bg-muted/50 text-foreground font-medium text-sm transition flex items-center justify-center gap-3 shadow-soft active:scale-[0.99]">
                    <svg viewBox="0 0 24 24" class="size-5" aria-hidden="true">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.27-4.74 3.27-8.1Z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84A11 11 0 0 0 12 23Z"/>
                        <path fill="#FBBC05" d="M5.84 14.1a6.6 6.6 0 0 1 0-4.2V7.06H2.18a11 11 0 0 0 0 9.88l3.66-2.84Z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1A11 11 0 0 0 2.18 7.06l3.66 2.84C6.71 7.3 9.14 5.38 12 5.38Z"/>
                    </svg>
                    <span>Continuar com Google</span>
                </button>

                <!-- Rodapé de Alternância Rápida -->
                <div class="mt-6 border-t border-border/80 pt-4 text-center">
                    <p id="authCardFooterText" class="text-xs text-muted-foreground">
                        Não tem uma conta? 
                        <button type="button" onclick="alternarAbaAuth('cadastro')" class="font-bold text-primary hover:underline ml-1">
                            Criar conta no SEIVA
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
