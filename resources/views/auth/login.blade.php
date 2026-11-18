{{-- 
    Módulo: Autenticação / Login & Cadastro (RF001)
    Responsável Acadêmica: Quételi
    Funcionalidade: Apresentação da marca SEIVA com composição visual do Casal, Lar e Dashboard,
    Mockup interativo com animação fluida, logo em destaque, e toggle instantâneo entre Login e Cadastro
--}}
<div id="screen-login" class="app-screen is-active relative min-h-screen overflow-hidden bg-background">
    
    <!-- ============================================================== -->
    <!-- LATERAL ESQUERDA: APRESENTAÇÃO IMERSIVA DO CASAL & LAR         -->
    <!-- (Desktop: 50% da tela, Mockup do App, Casal Minimalista & Animação) -->
    <!-- ============================================================== -->
    <div class="relative hidden w-1/2 min-h-screen bg-gradient-to-br from-[#122e20] via-[#1b3f2d] to-[#26573e] p-8 xl:p-12 lg:flex flex-col justify-between text-white overflow-hidden shadow-2xl float-left">
        
        <!-- Círculos e Anéis Orgânicos de Raízes no Fundo (Inspirado nas Referências Visuais) -->
        <div class="pointer-events-none absolute inset-0 flex items-center justify-center overflow-hidden">
            <div class="size-[720px] rounded-full border border-emerald-400/10 animate-pulse-rings absolute"></div>
            <div class="size-[540px] rounded-full border border-emerald-400/15 animate-pulse-rings absolute" style="animation-delay: 2s;"></div>
            <div class="size-[380px] rounded-full border border-emerald-400/20 absolute"></div>
            <!-- Linhas de seiva e raízes sutis -->
            <svg class="absolute -right-20 -bottom-24 w-[600px] h-[600px] opacity-10 text-emerald-200" viewBox="0 0 400 400" fill="currentColor">
                <path d="M200 0C89.5 0 0 89.5 0 200s89.5 200 200 200 200-89.5 200-200S310.5 0 200 0zm0 360c-88.4 0-160-71.6-160-160S111.6 40 200 40s160 71.6 160 160-71.6 160-160 160z"/>
                <path d="M200 60c-77.3 0-140 62.7-140 140s62.7 140 140 140 140-62.7 140-140S277.3 60 200 60zm0 240c-55.2 0-100-44.8-100-100s44.8-100 100-100 100 44.8 100 100-44.8 100-100 100z"/>
            </svg>
        </div>

        <!-- ───── TOPO: LOGO DA SEIVA EM GRANDE DESTAQUE NOBRE ───── -->
        <div class="relative z-10 flex items-center justify-between border-b border-white/10 pb-6">
            <div class="flex items-center gap-4">
                <!-- Logomarca Oficial em Alta Definição -->
                <div class="relative size-16 overflow-hidden rounded-3xl bg-white/10 backdrop-blur-md border border-white/25 p-2.5 shadow-elevated flex items-center justify-center transition-transform hover:scale-105">
                    <img src="/logo_seiva_oficial.png" alt="Logotipo SEIVA" class="object-contain w-full h-full drop-shadow-md" onerror="this.src='/seiva-logo.png'">
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-3xl xl:text-4xl font-black tracking-tight text-white block leading-none">SEIVA</span>
                        <span class="px-2 py-0.5 rounded-full bg-amber-400/20 text-amber-300 text-[10px] font-extrabold uppercase tracking-wider border border-amber-300/30">
                            Lar & Casal
                        </span>
                    </div>
                    <span class="text-xs font-semibold text-emerald-200/90 tracking-widest uppercase block mt-1">
                        Dinheiro Sem Tabu
                    </span>
                </div>
            </div>
            
            <div class="hidden xl:flex items-center gap-2 px-3.5 py-1.5 rounded-2xl bg-white/10 border border-white/15 text-xs font-medium text-emerald-100 backdrop-blur-md">
                <i data-lucide="sparkles" class="size-4 text-amber-300"></i>
                <span>Gestão Financeira Compartilhada</span>
            </div>
        </div>

        <!-- ───── CENTRO: COMPOSIÇÃO VISUAL DO CASAL, LAR E DASHBOARD FLUTUANTE ───── -->
        <div class="relative z-10 my-auto py-4 flex flex-col items-center justify-center">
            
            <div class="text-center mb-6 max-w-lg">
                <h1 class="text-2xl xl:text-3xl font-extrabold text-white leading-tight tracking-tight">
                    Organize as finanças do casal sem brigas.
                </h1>
                <p class="mt-2 text-xs xl:text-sm text-emerald-100/90 leading-relaxed">
                    O ambiente do Lar que une contas conjuntas, divisão proporcional justa e total respeito à privacidade individual.
                </p>
            </div>

            <!-- CONTAINER DO SMARTPHONE COM DASHBOARD E CASAL MINIMALISTA -->
            <div class="relative w-full max-w-md xl:max-w-lg mx-auto flex items-center justify-center pt-2">
                
                <!-- Notificação Flutuante do Cobrador Diplomata (Topo Esquerdo) -->
                <div class="absolute -top-3 -left-4 xl:-left-8 z-30 animate-float-gentle max-w-[210px] rounded-2xl bg-white/95 text-stone-800 p-2.5 shadow-elevated border border-emerald-100 backdrop-blur-md">
                    <div class="flex items-center gap-2">
                        <span class="size-6 rounded-lg bg-sky-100 text-sky-700 flex items-center justify-center shrink-0">
                            <i data-lucide="bell-ring" class="size-3.5"></i>
                        </span>
                        <div>
                            <p class="text-[10px] font-bold text-foreground leading-tight">Cobrador Diplomata</p>
                            <p class="text-[9px] text-muted-foreground leading-tight">Lembrete neutro de internet com PIX!</p>
                        </div>
                    </div>
                </div>

                <!-- Selo Caixa Preta com PIN (Topo Direito) -->
                <div class="absolute top-2 -right-3 xl:-right-6 z-30 animate-float-gentle max-w-[190px] rounded-2xl bg-[#132c1e]/90 text-white p-2.5 shadow-elevated border border-white/20 backdrop-blur-md" style="animation-delay: 1.5s;">
                    <div class="flex items-center gap-2">
                        <span class="size-6 rounded-lg bg-amber-400/20 text-amber-300 flex items-center justify-center shrink-0">
                            <i data-lucide="lock" class="size-3.5"></i>
                        </span>
                        <div>
                            <p class="text-[10px] font-bold leading-tight">Caixa Preta Criptografada</p>
                            <p class="text-[9px] text-emerald-200 leading-tight">PIN 4 dígitos · 100% privado</p>
                        </div>
                    </div>
                </div>

                <!-- ============================================== -->
                <!-- MOCKUP DO SMARTPHONE COM TELA DO APP (CENTRO)  -->
                <!-- ============================================== -->
                <div class="animate-float-slow relative w-[280px] xl:w-[310px] rounded-[42px] border-[6px] border-[#0e261a] bg-[#0c2217] p-3 shadow-[0_30px_70px_-15px_rgba(0,0,0,0.6)] overflow-hidden">
                    
                    <!-- Entalhe Superior (Dynamic Island / Speaker) -->
                    <div class="mx-auto h-4 w-28 rounded-full bg-black/60 mb-2 flex items-center justify-center">
                        <span class="size-2 rounded-full bg-emerald-950/80 mr-3"></span>
                        <span class="size-1.5 rounded-full bg-emerald-800/40"></span>
                    </div>

                    <!-- Tela Interna do App SEIVA -->
                    <div class="rounded-[30px] bg-[#f8f9fa] text-stone-800 p-3.5 space-y-3 overflow-hidden shadow-inner">
                        
                        <!-- Header do App dentro do celular -->
                        <div class="flex items-center justify-between pb-1">
                            <div class="flex items-center gap-1.5">
                                <span class="size-6 rounded-full bg-amber-400 text-stone-900 font-black text-[10px] flex items-center justify-center shadow-soft">
                                    🌿
                                </span>
                                <div>
                                    <p class="text-[11px] font-bold text-stone-900 leading-none">Nosso Cantinho</p>
                                    <p class="text-[9px] text-stone-500 leading-none mt-0.5">Duda & Victor</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-1.5 text-stone-500">
                                <i data-lucide="eye" class="size-3 text-stone-600"></i>
                                <span class="size-5 rounded-full bg-emerald-100 text-emerald-800 text-[9px] font-bold flex items-center justify-center">
                                    DV
                                </span>
                            </div>
                        </div>

                        <!-- CARD FLUTUANTE 3D DE SALDO DO LAR (POPOUT ESTILO FINTECH) -->
                        <div class="rounded-2xl bg-white p-3.5 shadow-card border border-stone-100 space-y-2.5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-[9px] font-medium text-stone-500 uppercase tracking-wider">Saldo do Lar</p>
                                    <h3 class="text-xl font-black text-stone-900 mt-0.5">R$ 14.850,00</h3>
                                    <span class="text-[9px] font-semibold text-emerald-600 flex items-center gap-0.5 mt-0.5">
                                        <i data-lucide="trending-up" class="size-3"></i> +R$ 2.450 este mês
                                    </span>
                                </div>
                                <!-- Sparkline SVG Gracioso -->
                                <svg class="w-16 h-8 text-emerald-500 overflow-visible" viewBox="0 0 100 50" fill="none">
                                    <path d="M0 45 C 20 40, 35 20, 50 28 C 65 36, 80 10, 100 5" stroke="#2e6b4f" stroke-width="3" stroke-linecap="round"/>
                                    <circle cx="100" cy="5" r="3.5" fill="#2e6b4f"/>
                                </svg>
                            </div>

                            <!-- 3 Botões de Ação Rápida (Idêntico ao mock-up da imagem enviada) -->
                            <div class="grid grid-cols-3 gap-1 pt-1 border-t border-stone-100 text-center">
                                <div class="py-1 rounded-xl bg-stone-50 hover:bg-stone-100 transition flex flex-col items-center gap-0.5">
                                    <span class="size-5 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center text-[10px]">
                                        ↑
                                    </span>
                                    <span class="text-[8px] font-bold text-stone-700">Rateio</span>
                                </div>
                                <div class="py-1 rounded-xl bg-stone-50 hover:bg-stone-100 transition flex flex-col items-center gap-0.5">
                                    <span class="size-5 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-[10px]">
                                        ↓
                                    </span>
                                    <span class="text-[8px] font-bold text-stone-700">Receita</span>
                                </div>
                                <div class="py-1 rounded-xl bg-stone-50 hover:bg-stone-100 transition flex flex-col items-center gap-0.5">
                                    <span class="size-5 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center text-[10px]">
                                        ⇄
                                    </span>
                                    <span class="text-[8px] font-bold text-stone-700">Acordo</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card de Rateio Proporcional Justo -->
                        <div class="rounded-2xl bg-white p-3 shadow-soft border border-stone-100 space-y-1.5">
                            <div class="flex items-center justify-between text-[10px]">
                                <span class="font-bold text-stone-800">Rateio Proporcional</span>
                                <span class="text-emerald-700 font-extrabold text-[9px] bg-emerald-50 px-1.5 py-0.5 rounded-full">
                                    Mais justo que 50/50
                                </span>
                            </div>
                            <!-- Barra Bicolor do Casal -->
                            <div class="h-2 w-full rounded-full bg-stone-100 overflow-hidden flex">
                                <div class="h-full bg-emerald-600" style="width: 60%"></div>
                                <div class="h-full bg-amber-400" style="width: 40%"></div>
                            </div>
                            <div class="flex justify-between text-[8px] text-stone-500 font-medium">
                                <span>Victor: 60% (R$ 6k)</span>
                                <span>Duda: 40% (R$ 4k)</span>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ============================================== -->
                <!-- ILUSTRAÇÃO MINIMALISTA DO CASAL VETORIAL SVG   -->
                <!-- (Inspirada no estilo flat art da imagem enviada) -->
                <!-- ============================================== -->
                <div class="pointer-events-none absolute -bottom-4 -left-10 xl:-left-16 z-20 w-44 xl:w-52">
                    <svg viewBox="0 0 200 240" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto drop-shadow-xl">
                        <!-- Sombra da base -->
                        <ellipse cx="100" cy="230" rx="70" ry="8" fill="rgba(0,0,0,0.15)"/>
                        
                        <!-- Parceiro (Camisa Mostarda Dourada e Calça Verde Floresta - referência visual) -->
                        <g>
                            <!-- Calça verde escuro -->
                            <path d="M70 145 C65 170, 60 205, 58 225 C68 227, 78 226, 80 215 C82 195, 85 175, 87 155 Z" fill="#1b4530"/>
                            <path d="M87 155 C90 180, 93 205, 96 225 C106 226, 114 225, 115 215 C112 190, 105 165, 100 145 Z" fill="#245a40"/>
                            <!-- Tronco camisa amarela mostarda -->
                            <path d="M60 95 C60 80, 95 80, 105 95 C110 115, 105 145, 98 150 C80 152, 65 150, 60 95 Z" fill="#f59e0b"/>
                            <!-- Braço estendido apontando com o dedo para o smartphone (referência) -->
                            <path d="M98 100 C125 105, 150 90, 175 80 C182 78, 185 82, 178 86 C155 98, 130 115, 105 116 Z" fill="#fcd34d"/>
                            <circle cx="178" cy="80" r="4.5" fill="#fcd34d"/>
                            <!-- Cabeça e cabelo minimalista -->
                            <circle cx="80" cy="65" r="14" fill="#fcd34d"/>
                            <path d="M66 65 C66 50, 85 45, 94 55 C88 53, 75 58, 72 68 Z" fill="#1b4530"/>
                            <!-- Óculos minimalista -->
                            <circle cx="85" cy="64" r="3.5" stroke="#1b4530" stroke-width="1.5" fill="none"/>
                        </g>

                        <!-- Parceira ao lado (Tons suaves, apoiando o lar com harmonia) -->
                        <g transform="translate(-25, 10)">
                            <!-- Vestido / blusa creme/terracota suave -->
                            <path d="M35 110 C35 98, 55 98, 62 110 C65 130, 60 160, 55 180 C45 180, 38 160, 35 110 Z" fill="#e2d4c0"/>
                            <!-- Braço segurando pequeno broto da SEIVA -->
                            <path d="M55 120 C65 130, 75 125, 78 118" stroke="#fcd34d" stroke-width="5" stroke-linecap="round"/>
                            <!-- Pequena folhinha verde na mão -->
                            <path d="M80 115 C82 108, 88 110, 86 116 C84 118, 81 118, 80 115 Z" fill="#10b981"/>
                            <!-- Cabeça e cabelo longo minimalista -->
                            <circle cx="48" cy="82" r="12" fill="#fcd34d"/>
                            <path d="M36 82 C34 68, 60 66, 62 82 C64 98, 55 105, 38 98 Z" fill="#5c3a21"/>
                        </g>
                    </svg>
                </div>

            </div>
        </div>

        <!-- ───── RODAPÉ: LGPD & SLOGAN OFICIAL ───── -->
        <div class="relative z-10 flex items-center justify-between text-[11px] text-white/75 border-t border-white/10 pt-4">
            <span class="flex items-center gap-1.5">
                <i data-lucide="shield-check" class="size-4 text-emerald-300"></i>
                Privacidade & Conformidade com a LGPD (Lei nº 13.709/2018)
            </span>
            <span class="flex items-center gap-1.5 text-emerald-200 font-semibold">
                <i data-lucide="leaf" class="size-3.5"></i> Onde seu dinheiro cria raízes
            </span>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- LATERAL DIREITA: CARD DE LOGIN & CADASTRO (100% OPERACIONAL)   -->
    <!-- (Alternância instantânea de abas e criação de conta direta)     -->
    <!-- ============================================================== -->
    <div class="relative z-10 mx-auto w-full min-h-screen flex flex-col justify-center px-4 py-8 sm:px-6 lg:w-1/2 lg:px-12 xl:px-16">
        
        <!-- Mobile Header Hero (Experiência Exclusiva e Imersiva para Celular) -->
        <div class="mb-6 lg:hidden rounded-3xl bg-gradient-to-br from-[#122e20] via-[#1b3f2d] to-[#26573e] p-6 text-white text-center shadow-card">
            <div class="relative size-16 mx-auto overflow-hidden rounded-3xl bg-white/10 backdrop-blur-md border border-white/20 p-2 shadow-soft flex items-center justify-center">
                <img src="/logo_seiva_oficial.png" alt="SEIVA" class="object-contain w-full h-full" onerror="this.src='/seiva-logo.png'">
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
                        Ao criar sua conta, seus dados são criptografados e protegidos pela LGPD.
                    </p>

                    <button type="submit" id="cardRegSubmitBtn" class="w-full h-14 rounded-2xl bg-primary text-primary-foreground font-semibold text-sm shadow-card hover:bg-primary/90 active:scale-[0.99] transition flex items-center justify-center gap-2">
                        <span>Criar minha conta no SEIVA</span>
                        <i data-lucide="arrow-right" class="size-4"></i>
                    </button>

                    <!-- Link para o Onboarding Passo a Passo Completo -->
                    <div class="pt-1 text-center">
                        <button type="button" onclick="irParaOnboarding()" class="text-xs font-semibold text-primary hover:underline flex items-center justify-center gap-1 mx-auto">
                            <span>Prefere configurar tudo passo a passo?</span>
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
