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

        <!-- ───── CENTRO: PAINEL MINIMALISTA DO LAR (DUDA & IAN) ───── -->
        <div class="relative z-10 my-auto py-6 flex flex-col items-center justify-center text-center">
            
            <!-- Título e Proposta Limpos e Diretos -->
            <div class="max-w-md mx-auto mb-6">
                <h1 class="text-2xl xl:text-3xl font-extrabold text-white leading-tight tracking-tight">
                    Organize as finanças do casal sem brigas.
                </h1>
                <p class="mt-2 text-xs xl:text-sm text-emerald-100/85 leading-relaxed">
                    Contas conjuntas, divisão proporcional justa e respeito à privacidade individual.
                </p>
            </div>

            <!-- MOCKUP MINIMALISTA DO APP DO CASAL (DUDA & IAN) -->
            <div class="animate-float-slow relative w-full max-w-[340px] mx-auto rounded-[36px] border-[5px] border-emerald-950/60 bg-[#0d2418] p-4 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.5)]">
                
                <!-- Notch Superior -->
                <div class="mx-auto h-3.5 w-24 rounded-full bg-black/40 mb-3 flex items-center justify-center">
                    <span class="size-1.5 rounded-full bg-emerald-900/60"></span>
                </div>

                <!-- Conteúdo Interno do Mockup -->
                <div class="rounded-[26px] bg-[#f8f9fa] text-stone-800 p-4 space-y-3.5 text-left shadow-inner">
                    
                    <!-- Cabeçalho do Lar: Duda & Ian -->
                    <div class="flex items-center justify-between pb-1 border-b border-stone-200/60">
                        <div class="flex items-center gap-2">
                            <!-- Avatar Duda & Ian -->
                            <div class="size-8 rounded-full bg-emerald-100 text-emerald-800 font-black text-xs flex items-center justify-center border border-emerald-200">
                                DI
                            </div>
                            <div>
                                <p class="text-xs font-bold text-stone-900 leading-none">Nosso Cantinho 🌿</p>
                                <p class="text-[10px] font-semibold text-emerald-700 leading-none mt-1">Duda & Ian</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">
                            <i data-lucide="check" class="size-3"></i> Em dia
                        </span>
                    </div>

                    <!-- Card de Saldo Conjunto do Lar -->
                    <div class="rounded-2xl bg-white p-3.5 shadow-sm border border-stone-200/70 space-y-2">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-medium text-stone-500 uppercase tracking-wider">Saldo do Lar</p>
                                <h3 class="text-2xl font-black text-stone-900 mt-0.5">R$ 12.450,00</h3>
                            </div>
                            <!-- Mini Sparkline Verde -->
                            <svg class="w-14 h-7 text-emerald-600" viewBox="0 0 100 50" fill="none">
                                <path d="M0 40 C 25 35, 45 15, 70 25 C 85 32, 90 8, 100 5" stroke="#2e6b4f" stroke-width="3" stroke-linecap="round"/>
                                <circle cx="100" cy="5" r="3.5" fill="#2e6b4f"/>
                            </svg>
                        </div>

                        <!-- 3 Atalhos Rápidos do Lar -->
                        <div class="grid grid-cols-3 gap-1.5 pt-1.5 border-t border-stone-100 text-center">
                            <div class="py-1 rounded-xl bg-stone-50 flex flex-col items-center gap-0.5">
                                <span class="size-5 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center text-[10px] font-bold">↑</span>
                                <span class="text-[9px] font-semibold text-stone-700">Rateio</span>
                            </div>
                            <div class="py-1 rounded-xl bg-stone-50 flex flex-col items-center gap-0.5">
                                <span class="size-5 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-[10px] font-bold">↓</span>
                                <span class="text-[9px] font-semibold text-stone-700">Entrada</span>
                            </div>
                            <div class="py-1 rounded-xl bg-stone-50 flex flex-col items-center gap-0.5">
                                <span class="size-5 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center text-[10px] font-bold">⇄</span>
                                <span class="text-[9px] font-semibold text-stone-700">Acordo</span>
                            </div>
                        </div>
                    </div>

                    <!-- Divisão Proporcional Justa: Duda & Ian -->
                    <div class="rounded-2xl bg-white p-3 shadow-sm border border-stone-200/70 space-y-2">
                        <div class="flex items-center justify-between text-[10px]">
                            <span class="font-bold text-stone-800">Rateio Proporcional Justo</span>
                            <span class="text-emerald-700 font-extrabold text-[9px] bg-emerald-50 px-2 py-0.5 rounded-full">
                                Mais justo que 50/50
                            </span>
                        </div>
                        <!-- Barra Bicolor de Divisão Proporcional -->
                        <div class="h-2.5 w-full rounded-full bg-stone-100 overflow-hidden flex">
                            <div class="h-full bg-emerald-600 rounded-l-full" style="width: 55%"></div>
                            <div class="h-full bg-amber-400 rounded-r-full" style="width: 45%"></div>
                        </div>
                        <div class="flex justify-between text-[9px] text-stone-600 font-semibold">
                            <span>Ian: 55% (R$ 5.500)</span>
                            <span>Duda: 45% (R$ 4.500)</span>
                        </div>
                    </div>

                    <!-- Diferenciais de Privacidade e Cobrador Neutro -->
                    <div class="flex items-center justify-between text-[10px] text-stone-500 pt-0.5 px-1">
                        <span class="flex items-center gap-1 font-medium">
                            <i data-lucide="lock" class="size-3 text-amber-500"></i> Caixa Preta com PIN
                        </span>
                        <span class="flex items-center gap-1 font-medium">
                            <i data-lucide="bell-ring" class="size-3 text-sky-500"></i> Cobrador Diplomata
                        </span>
                    </div>

                </div>
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
