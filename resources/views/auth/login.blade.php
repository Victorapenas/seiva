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

        <!-- ───── CENTRO: HERO MINIMALISTA — CASAL + CELULAR FLUTUANTE ───── -->
        <div class="relative z-10 my-auto flex items-end justify-center w-full max-w-[460px] mx-auto" style="height: 460px;">

            <!-- Círculos concêntricos sutis de fundo -->
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none">
                <div class="absolute rounded-full border border-white/[0.05]" style="width:400px;height:400px;"></div>
                <div class="absolute rounded-full border border-white/[0.04]" style="width:280px;height:280px;"></div>
                <div class="absolute rounded-full border border-white/[0.03]" style="width:160px;height:160px;"></div>
            </div>

            <!-- CASAL: Duda & Ian apontando diretamente para o celular -->
            <div class="absolute bottom-0 left-[-15px] z-10 select-none pointer-events-none"
                 style="width: 295px;">
                <img src="/casal-hero.png" alt="Duda e Ian apontando para o app SEIVA"
                     class="w-full h-auto object-contain"
                     style="filter: drop-shadow(0 18px 36px rgba(0,0,0,0.45));">
            </div>

            <!-- CELULAR FLUTUANTE: Mockup moderno e proporcional de Fintech -->
            <div class="animate-float-slow absolute z-20"
                 style="right: -5px; top: 15px; width: 215px;">

                <!-- Frame moderno do smartphone (acabamento titânio escuro) -->
                <div class="relative rounded-[38px] bg-[#091710] p-[5px] shadow-[0_25px_60px_-10px_rgba(0,0,0,0.65),0_0_0_1px_rgba(255,255,255,0.08)]">
                    
                    <!-- Dynamic Island no topo -->
                    <div class="absolute top-2.5 left-1/2 -translate-x-1/2 z-30 h-4 w-16 rounded-full bg-black flex items-center justify-center">
                        <span class="size-1.5 rounded-full bg-[#1c2b22]"></span>
                    </div>

                    <!-- Tela do Smartphone -->
                    <div class="rounded-[32px] overflow-hidden bg-[#f6f8f6] shadow-inner select-none text-left">

                        <!-- Status bar e Header Verde Escuro SEIVA -->
                        <div class="bg-gradient-to-b from-[#0c2417] to-[#123321] px-3.5 pt-2 pb-3 text-white">
                            <!-- Status Bar -->
                            <div class="flex items-center justify-between text-[8px] font-semibold text-white/70 mb-2">
                                <span>09:41</span>
                                <div class="flex items-center gap-1">
                                    <svg class="size-2.5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3c-4.97 0-9 4.03-9 9 0 2.12.74 4.07 1.97 5.61L4.35 19.4c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0l1.9-1.9C9.28 19.64 10.59 20 12 20c4.97 0 9-4.03 9-9s-4.03-9-9-9z"/></svg>
                                    <div class="w-3.5 h-1.5 rounded-xs border border-white/60 p-[0.5px]">
                                        <div class="h-full w-full bg-white rounded-2xs"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Header do Lar -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-1.5">
                                    <div class="size-5 rounded-full bg-amber-400 flex items-center justify-center shadow-xs">
                                        <i data-lucide="leaf" class="size-3 text-emerald-950"></i>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-white leading-tight">Nosso Cantinho 🌿</p>
                                        <p class="text-[7.5px] font-semibold text-emerald-300/80 leading-none">Duda &amp; Ian</p>
                                    </div>
                                </div>
                                <span class="px-1.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-200 text-[7px] font-bold border border-emerald-400/25">
                                    Em dia
                                </span>
                            </div>
                        </div>

                        <!-- Conteúdo Interno da Tela -->
                        <div class="p-2.5 space-y-2">

                            <!-- Card de Saldo do Lar -->
                            <div class="rounded-2xl bg-white p-2.5 shadow-sm border border-stone-100">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-[7px] font-semibold text-stone-400 uppercase tracking-wider">Saldo do Lar</p>
                                        <p class="text-[15px] font-black text-stone-900 leading-tight mt-0.5">R$ 14.850,00</p>
                                        <p class="text-[7px] font-bold text-emerald-600 mt-0.5 flex items-center gap-0.5">
                                            <span>↗ +R$ 2.450 este mês</span>
                                        </p>
                                    </div>
                                    <!-- Sparkline Suave -->
                                    <svg class="w-12 h-7" viewBox="0 0 80 40" fill="none">
                                        <path d="M0 32 C 20 28, 35 15, 50 20 C 65 24, 70 8, 80 5" stroke="#2e6b4f" stroke-width="2.5" stroke-linecap="round"/>
                                        <circle cx="80" cy="5" r="2.5" fill="#2e6b4f"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Atalhos Rápidos do Casal -->
                            <div class="grid grid-cols-3 gap-1.5 text-center">
                                <div class="rounded-xl bg-white p-1.5 shadow-2xs border border-stone-100 flex flex-col items-center">
                                    <span class="size-5 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center text-[8px] font-bold mb-0.5">↑</span>
                                    <span class="text-[7px] font-bold text-stone-700 leading-none">Rateio</span>
                                </div>
                                <div class="rounded-xl bg-white p-1.5 shadow-2xs border border-stone-100 flex flex-col items-center">
                                    <span class="size-5 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center text-[8px] font-bold mb-0.5">↓</span>
                                    <span class="text-[7px] font-bold text-stone-700 leading-none">Receita</span>
                                </div>
                                <div class="rounded-xl bg-white p-1.5 shadow-2xs border border-stone-100 flex flex-col items-center">
                                    <span class="size-5 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center text-[8px] font-bold mb-0.5">⇄</span>
                                    <span class="text-[7px] font-bold text-stone-700 leading-none">Acordo</span>
                                </div>
                            </div>

                            <!-- Barra de Rateio Proporcional Justo -->
                            <div class="rounded-xl bg-white p-2 shadow-sm border border-stone-100 space-y-1">
                                <div class="flex items-center justify-between text-[7px]">
                                    <span class="font-bold text-stone-800">Rateio Proporcional</span>
                                    <span class="text-emerald-700 font-extrabold text-[6.5px] bg-emerald-50 px-1.5 py-0.2 rounded-full">
                                        Mais justo que 50/50
                                    </span>
                                </div>
                                <div class="h-2 w-full rounded-full bg-stone-100 overflow-hidden flex">
                                    <div class="h-full bg-emerald-600 rounded-l-full" style="width: 55%"></div>
                                    <div class="h-full bg-amber-400 rounded-r-full" style="width: 45%"></div>
                                </div>
                                <div class="flex justify-between text-[6.5px] text-stone-500 font-semibold">
                                    <span>Ian: 55%</span>
                                    <span>Duda: 45%</span>
                                </div>
                            </div>

                        </div>

                        <!-- Barra Inferior do Smartphone (Home Indicator) -->
                        <div class="py-1.5 flex justify-center bg-[#f6f8f6]">
                            <div class="h-1 w-14 rounded-full bg-stone-300"></div>
                        </div>

                    </div>
                </div>

                <!-- Sombra Suave sob o Celular Flutuante -->
                <div class="mx-auto mt-2 h-3 w-32 rounded-full bg-black/25 blur-md"></div>
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

        <!-- CARD PRINCIPAL: APENAS LOGIN + GOOGLE (Criar conta vai direto ao onboarding) -->
        <div class="w-full max-w-md mx-auto">
            <div class="rounded-3xl border border-border bg-card p-6 sm:p-8 shadow-card lg:shadow-elevated">

                <!-- Título fixo — só Entrar -->
                <div class="mb-6 text-left">
                    <h2 class="text-2xl font-bold tracking-tight text-foreground">Bem-vindo(a) de volta</h2>
                    <p class="text-xs text-muted-foreground mt-1">Acesse seu painel pessoal e o ambiente do seu Lar</p>
                </div>

                <!-- FORMULÁRIO DE LOGIN -->
                <form id="formLoginCard" onsubmit="executarLogin(event)" class="space-y-4">
                    <div class="relative">
                        <input type="email" id="loginEmail" required placeholder=" "
                               class="floating-input peer h-14 w-full rounded-2xl border border-border bg-background px-4 pt-4 text-sm text-foreground outline-none transition-colors focus:border-primary focus:ring-2 focus:ring-primary/20">
                        <label class="floating-label pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-muted-foreground transition-all duration-200">
                            E-mail cadastrado
                        </label>
                    </div>

                    <div class="relative">
                        <input type="password" id="loginSenha" required placeholder=" "
                               class="floating-input peer h-14 w-full rounded-2xl border border-border bg-background px-4 pt-4 text-sm text-foreground outline-none transition-colors focus:border-primary focus:ring-2 focus:ring-primary/20">
                        <label class="floating-label pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-muted-foreground transition-all duration-200">
                            Senha de acesso
                        </label>
                    </div>

                    <div class="flex items-center justify-between text-xs pt-1">
                        <label class="flex items-center gap-2 cursor-pointer text-muted-foreground">
                            <input type="checkbox" id="loginLembrar" checked class="rounded border-border text-primary focus:ring-primary">
                            Lembrar de mim
                        </label>
                        <a href="#" onclick="alert('Para redefinir sua senha, confirme o e-mail cadastrado.'); return false;"
                           class="font-medium text-primary hover:underline">Esqueceu a senha?</a>
                    </div>

                    <button type="submit" id="loginSubmitBtn"
                            class="w-full mt-2 h-14 rounded-2xl bg-primary text-primary-foreground font-semibold text-sm shadow-card hover:bg-primary/90 active:scale-[0.99] transition flex items-center justify-center gap-2">
                        <span>Entrar no SEIVA</span>
                        <i data-lucide="arrow-right" class="size-4"></i>
                    </button>
                </form>

                <!-- Divisor -->
                <div class="relative my-5 flex items-center justify-center">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-border"></div></div>
                    <span class="relative bg-card px-3 text-xs text-muted-foreground">ou continue com</span>
                </div>

                <!-- Botão Google -->
                <button type="button" onclick="iniciarGoogleAuth()"
                        class="w-full h-12 rounded-2xl border border-border bg-card hover:bg-muted/50 text-foreground font-medium text-sm transition flex items-center justify-center gap-3 shadow-soft active:scale-[0.99]">
                    <svg viewBox="0 0 24 24" class="size-5" aria-hidden="true">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.27-4.74 3.27-8.1Z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84A11 11 0 0 0 12 23Z"/>
                        <path fill="#FBBC05" d="M5.84 14.1a6.6 6.6 0 0 1 0-4.2V7.06H2.18a11 11 0 0 0 0 9.88l3.66-2.84Z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1A11 11 0 0 0 2.18 7.06l3.66 2.84C6.71 7.3 9.14 5.38 12 5.38Z"/>
                    </svg>
                    <span>Continuar com Google</span>
                </button>

                <!-- Rodapé: link para criar conta (vai ao onboarding) -->
                <div class="mt-5 border-t border-border/60 pt-4 text-center">
                    <p class="text-xs text-muted-foreground">
                        Não tem uma conta?
                        <button type="button" onclick="irParaOnboarding()"
                                class="font-bold text-primary hover:underline ml-1">
                            Criar conta no SEIVA →
                        </button>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
