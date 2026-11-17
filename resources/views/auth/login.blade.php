{{-- 
    Módulo: Autenticação / Login (RF001)
    Responsável Acadêmica: Quételi
    Funcionalidade: Apresentação da marca SEIVA, Split screen desktop, Hero mobile, Login por sessão e Google Auth
--}}
<div id="screen-login" class="app-screen is-active relative min-h-screen overflow-hidden bg-background">
    
    <!-- ========================================== -->
    <!-- LATERAL ESQUERDA: APRESENTAÇÃO DA MARCA    -->
    <!-- (Desktop: 50% da tela, Imersiva e Visual)  -->
    <!-- ========================================== -->
    <div class="relative hidden w-1/2 min-h-screen bg-gradient-to-br from-[#1b3d2b] via-[#24523b] to-[#2e6b4f] p-8 xl:p-12 lg:flex flex-col justify-between text-white overflow-hidden shadow-2xl float-left">
        <!-- Padrão gráfico de fundo (Raízes e Folhas sutis em SVG) -->
        <svg class="pointer-events-none absolute -right-20 -bottom-20 w-[550px] h-[550px] opacity-10 text-white" viewBox="0 0 400 400" fill="currentColor">
            <path d="M200 0C89.5 0 0 89.5 0 200s89.5 200 200 200 200-89.5 200-200S310.5 0 200 0zm0 360c-88.4 0-160-71.6-160-160S111.6 40 200 40s160 71.6 160 160-71.6 160-160 160z"/>
            <path d="M200 60c-77.3 0-140 62.7-140 140s62.7 140 140 140 140-62.7 140-140S277.3 60 200 60zm0 240c-55.2 0-100-44.8-100-100s44.8-100 100-100 100 44.8 100 100-44.8 100-100 100z"/>
        </svg>

        <!-- Topo: Logo & Badge Oficial -->
        <div class="relative z-10 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="relative size-12 overflow-hidden rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 p-2 shadow-card flex items-center justify-center">
                    <img src="/seiva-logo.png" alt="SEIVA" class="object-contain w-full h-full" onerror="this.src='/icon.svg'">
                </div>
                <div>
                    <span class="text-2xl font-extrabold tracking-tight text-white block leading-none">SEIVA</span>
                    <span class="text-[11px] font-medium text-emerald-200/90 tracking-wide">Dinheiro Sem Tabu</span>
                </div>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 border border-white/15 text-[11px] font-semibold text-emerald-200 backdrop-blur-sm">
                <i data-lucide="sparkles" class="size-3.5"></i>
                Lares Compartilhados & Finanças
            </span>
        </div>

        <!-- Centro: Proposta de Valor & Diferenciais do Produto -->
        <div class="relative z-10 my-auto py-8 space-y-6">
            <div>
                <h1 class="text-3xl xl:text-4xl font-extrabold text-white leading-[1.18] tracking-tight text-balance">
                    Organize as finanças do casal sem brigas.
                </h1>
                <p class="mt-3 text-sm xl:text-base leading-relaxed text-emerald-50/90 max-w-lg">
                    A primeira plataforma que une a transparência necessária para contas conjuntas com o respeito absoluto à privacidade de cada parceiro.
                </p>
            </div>

            <!-- Showcase dos 3 Diferenciais Exclusivos do SEIVA -->
            <div class="space-y-3 pt-2">
                <!-- 1. Caixa Preta -->
                <div class="rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 p-4 text-left transition-all duration-200 hover:bg-white/15">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <span class="flex size-8 items-center justify-center rounded-xl bg-amber-400/20 text-amber-300">
                                <i data-lucide="lock" class="size-4"></i>
                            </span>
                            <span class="text-xs font-bold text-white uppercase tracking-wider">Caixa Preta</span>
                        </div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-amber-400/20 text-amber-200 text-[10px] font-bold">
                            PIN 4 DÍGITOS
                        </span>
                    </div>
                    <p class="mt-2 text-xs text-white/80 leading-relaxed">
                        Gastos particulares e surpresas que ficam invisíveis no extrato comum do lar. Criptografia e privacidade garantida.
                    </p>
                </div>

                <!-- 2. Rateio Proporcional -->
                <div class="rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 p-4 text-left transition-all duration-200 hover:bg-white/15">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <span class="flex size-8 items-center justify-center rounded-xl bg-emerald-400/20 text-emerald-300">
                                <i data-lucide="scale" class="size-4"></i>
                            </span>
                            <span class="text-xs font-bold text-white uppercase tracking-wider">Rateio Proporcional Justo</span>
                        </div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-400/20 text-emerald-200 text-[10px] font-bold">
                            MAIS JUSTO QUE 50/50
                        </span>
                    </div>
                    <div class="mt-2 space-y-1">
                        <div class="flex justify-between text-[11px] text-white/90 font-medium">
                            <span>Quem ganha mais apoia mais</span>
                            <span class="text-emerald-200 font-bold">Cálculo Automático</span>
                        </div>
                        <div class="h-1.5 w-full rounded-full bg-black/25 overflow-hidden flex">
                            <div class="h-full bg-emerald-400" style="width: 65%"></div>
                            <div class="h-full bg-white/40" style="width: 35%"></div>
                        </div>
                    </div>
                </div>

                <!-- 3. Cobrador Diplomata -->
                <div class="rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 p-4 text-left transition-all duration-200 hover:bg-white/15">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <span class="flex size-8 items-center justify-center rounded-xl bg-sky-400/20 text-sky-200">
                                <i data-lucide="bell-ring" class="size-4"></i>
                            </span>
                            <span class="text-xs font-bold text-white uppercase tracking-wider">Cobrador Diplomata</span>
                        </div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-sky-400/20 text-sky-200 text-[10px] font-bold">
                            ZERO ATRITO
                        </span>
                    </div>
                    <p class="mt-2 text-xs text-white/80 leading-relaxed">
                        Lembretes afetuosos e neutros disparados pelo sistema com envio automático da chave PIX.
                    </p>
                </div>
            </div>
        </div>

        <!-- Rodapé: LGPD & Slogan Oficial -->
        <div class="relative z-10 flex items-center justify-between text-[11px] text-white/70 border-t border-white/10 pt-4">
            <span class="flex items-center gap-1.5">
                <i data-lucide="shield-check" class="size-4 text-emerald-300"></i>
                Conformidade com a LGPD (Lei nº 13.709/2018)
            </span>
            <span class="flex items-center gap-1 text-emerald-200">
                <i data-lucide="leaf" class="size-3.5"></i> Onde seu dinheiro cria raízes
            </span>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- LATERAL DIREITA: FORMULÁRIO DE ENTRADA     -->
    <!-- (Responsivo: Desktop 50% & Mobile Hero)    -->
    <!-- ========================================== -->
    <div class="relative z-10 mx-auto w-full min-h-screen flex flex-col justify-center px-4 py-8 sm:px-6 lg:w-1/2 lg:px-12 xl:px-16">
        
        <!-- Mobile Header Hero (Experiência Exclusiva e Imersiva Mobile) -->
        <div class="mb-6 lg:hidden rounded-3xl bg-gradient-to-br from-[#1b3d2b] to-[#2e6b4f] p-6 text-white text-center shadow-card">
            <div class="relative size-16 mx-auto overflow-hidden rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 p-2 shadow-soft flex items-center justify-center">
                <img src="/seiva-logo.png" alt="SEIVA" class="object-contain w-full h-full" onerror="this.src='/icon.svg'">
            </div>
            <h1 class="mt-3 text-2xl font-black tracking-tight text-white">SEIVA</h1>
            <p class="mt-1 text-xs text-emerald-100 flex items-center justify-center gap-1.5">
                <i data-lucide="leaf" class="size-3.5 text-emerald-300"></i>
                Onde seu dinheiro cria raízes
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

        <!-- Card Principal de Login & Navegação -->
        <div class="w-full max-w-md mx-auto">
            <div class="rounded-3xl border border-border bg-card p-6 sm:p-8 shadow-card lg:shadow-elevated">
                
                <!-- Abas Superiores Alternáveis: Entrar vs Criar Conta -->
                <div class="relative mb-6 flex rounded-2xl bg-muted p-1">
                    <button type="button" class="relative z-10 flex-1 rounded-xl py-2.5 text-sm font-semibold bg-primary text-primary-foreground shadow-soft transition-all">
                        Entrar
                    </button>
                    <button type="button" onclick="irParaOnboarding()" class="relative z-10 flex-1 rounded-xl py-2.5 text-sm font-semibold text-muted-foreground hover:text-foreground transition-all">
                        Criar conta
                    </button>
                </div>

                <div class="mb-5 text-left">
                    <h2 class="text-xl font-bold tracking-tight text-foreground">Bem-vindo(a) de volta</h2>
                    <p class="text-xs text-muted-foreground mt-0.5">Acesse seu painel pessoal e o ambiente do seu Lar</p>
                </div>

                <!-- Formulário de Login -->
                <form onsubmit="executarLogin(event)" class="space-y-4">
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

                <!-- Navegação Explícita: Link para Cadastro -->
                <div class="mt-6 border-t border-border/80 pt-4 text-center">
                    <p class="text-xs text-muted-foreground">
                        Não tem uma conta? 
                        <button type="button" onclick="irParaOnboarding()" class="font-bold text-primary hover:underline ml-1">
                            Criar conta no SEIVA
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
