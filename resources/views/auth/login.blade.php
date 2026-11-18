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

        <!-- ───── CENTRO: HERO FLAT ART — PERSONAGEM + CELULAR FLUTUANTE ───── -->
        <div class="relative z-10 my-auto flex flex-col items-center justify-center w-full">

            <!-- Título acima da composição -->
            <div class="max-w-xs mx-auto mb-4 text-center px-2">
                <h1 class="text-2xl xl:text-3xl font-extrabold text-white leading-tight tracking-tight drop-shadow-sm">
                    Organize as finanças<br>do casal sem brigas.
                </h1>
                <p class="mt-2 text-xs text-emerald-200/80 leading-relaxed font-medium">
                    Rateio justo · Privacidade individual · Acordos negociáveis
                </p>
            </div>

            <!-- ══════════════════════════════════════════════════════════
                 COMPOSIÇÃO HEROICA: PERSONAGEM FLAT + CELULAR FLUTUANTE
                 Inspirada em Organizze/Contas Online (referência enviada)
                 ══════════════════════════════════════════════════════════ -->
            <div class="relative w-full max-w-[420px] mx-auto" style="height: 420px;">

                <!-- Círculos concêntricos de fundo (decoração sutil) -->
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <div class="absolute rounded-full border border-white/[0.05]" style="width:380px;height:380px;"></div>
                    <div class="absolute rounded-full border border-white/[0.04]" style="width:290px;height:290px;"></div>
                    <div class="absolute rounded-full border border-white/[0.03]" style="width:200px;height:200px;"></div>
                </div>

                <!-- ── PERSONAGEM FLAT ART (SVG inline) ── -->
                <!-- Posicionado à esquerda, ligeiramente atrás do celular -->
                <svg class="absolute bottom-0 left-0 z-10 select-none pointer-events-none drop-shadow-xl"
                     width="200" height="360" viewBox="0 0 200 360" fill="none"
                     xmlns="http://www.w3.org/2000/svg">

                    <!-- SOMBRA NO CHÃO -->
                    <ellipse cx="85" cy="348" rx="52" ry="10" fill="#000" opacity="0.18"/>

                    <!-- PERNA ESQUERDA (atrás) -->
                    <path d="M62 240 L52 340 Q51 348 60 348 L72 348 Q78 348 78 342 L82 240 Z"
                          fill="#00654E"/>
                    <!-- PERNA DIREITA (frente) -->
                    <path d="M82 240 L78 340 Q77 348 86 348 L98 348 Q104 348 104 342 L102 240 Z"
                          fill="#00654E"/>

                    <!-- SAPATO ESQUERDO -->
                    <path d="M50 341 Q48 352 60 352 L74 352 Q80 352 80 346 L72 345 Z"
                          fill="#0a1f14"/>
                    <!-- SAPATO DIREITO -->
                    <path d="M76 341 Q74 352 88 352 L102 352 Q108 350 106 345 L96 344 Z"
                          fill="#0a1f14"/>

                    <!-- CORPO (tronco + camisa amarela) -->
                    <path d="M48 170 Q46 240 56 242 L108 242 Q118 240 116 170 Q116 148 82 148 Q48 148 48 170 Z"
                          fill="#F2BC00"/>

                    <!-- DETALHE CAMISA (gola/decote em V) -->
                    <path d="M74 148 L82 170 L90 148" stroke="#d4a000" stroke-width="2" fill="none" stroke-linecap="round"/>

                    <!-- BOLSO CAMISA -->
                    <rect x="58" y="175" width="18" height="13" rx="3" fill="#d4a000" opacity="0.6"/>

                    <!-- BRAÇO ESQUERDO (ao corpo, estático) -->
                    <path d="M48 170 Q38 190 36 220 Q35 230 42 230 L50 228 Q58 226 58 218 L52 190 Z"
                          fill="#FFCDA9"/>
                    <!-- MÃO ESQUERDA -->
                    <ellipse cx="43" cy="232" rx="8" ry="7" fill="#FFCDA9"/>

                    <!-- BRAÇO DIREITO (esticado apontando para o celular) -->
                    <path d="M116 170 Q128 185 148 198 Q158 204 162 198 L158 190 Q154 184 148 182 L132 172 Z"
                          fill="#FFCDA9"/>
                    <!-- MANGA AMARELA do braço direito -->
                    <path d="M116 170 Q122 175 130 178 L128 165 Q122 160 116 165 Z"
                          fill="#F2BC00"/>
                    <!-- MÃO DIREITA (apontando) -->
                    <ellipse cx="162" cy="196" rx="10" ry="8" fill="#FFCDA9"/>
                    <!-- Dedo indicador apontando -->
                    <path d="M166 192 Q175 188 178 183" stroke="#FFCDA9" stroke-width="8"
                          stroke-linecap="round"/>
                    <path d="M166 192 Q175 188 178 183" stroke="#f0bc9e" stroke-width="4"
                          stroke-linecap="round"/>

                    <!-- PESCOÇO -->
                    <rect x="74" y="128" width="18" height="24" rx="6" fill="#FFCDA9"/>

                    <!-- CABEÇA -->
                    <ellipse cx="83" cy="108" rx="30" ry="32" fill="#FFCDA9"/>

                    <!-- CABELO (touca/estilo flat) -->
                    <path d="M54 100 Q56 68 83 66 Q110 68 112 100 Q105 88 83 86 Q61 88 54 100 Z"
                          fill="#2d1a0e"/>
                    <!-- Mechas do cabelo -->
                    <path d="M56 95 Q58 80 70 76" stroke="#1a0f08" stroke-width="4" stroke-linecap="round" fill="none"/>
                    <path d="M110 95 Q108 80 96 76" stroke="#1a0f08" stroke-width="4" stroke-linecap="round" fill="none"/>

                    <!-- ORELHA ESQUERDA -->
                    <ellipse cx="54" cy="110" rx="6" ry="8" fill="#FFCDA9"/>
                    <!-- ORELHA DIREITA -->
                    <ellipse cx="112" cy="110" rx="6" ry="8" fill="#FFCDA9"/>

                    <!-- OLHO ESQUERDO -->
                    <ellipse cx="73" cy="108" rx="5" ry="6" fill="#fff"/>
                    <ellipse cx="74" cy="109" rx="3" ry="3.5" fill="#2d1a0e"/>
                    <ellipse cx="75" cy="108" rx="1" ry="1" fill="#fff"/>
                    <!-- OLHO DIREITO -->
                    <ellipse cx="93" cy="108" rx="5" ry="6" fill="#fff"/>
                    <ellipse cx="94" cy="109" rx="3" ry="3.5" fill="#2d1a0e"/>
                    <ellipse cx="95" cy="108" rx="1" ry="1" fill="#fff"/>

                    <!-- SOBRANCELHA ESQUERDA -->
                    <path d="M68 101 Q73 98 78 100" stroke="#2d1a0e" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                    <!-- SOBRANCELHA DIREITA -->
                    <path d="M88 100 Q93 98 98 101" stroke="#2d1a0e" stroke-width="2.5" stroke-linecap="round" fill="none"/>

                    <!-- NARIZ -->
                    <path d="M81 112 Q83 116 85 112" stroke="#e8a880" stroke-width="2" stroke-linecap="round" fill="none"/>

                    <!-- BOCA (sorriso) -->
                    <path d="M74 122 Q83 128 92 122" stroke="#c97a5a" stroke-width="2.5" stroke-linecap="round" fill="none"/>

                    <!-- BRINCO (charme feminino — Duda aponta!) -->
                    <circle cx="54" cy="114" r="3" fill="#F2BC00"/>
                    <circle cx="54" cy="119" r="2" fill="#F2BC00"/>

                    <!-- TAG LAR flutuante sobre o personagem -->
                    <g transform="translate(10, 20)" opacity="0.95">
                        <rect x="0" y="0" width="80" height="22" rx="11" fill="#fff" opacity="0.95"/>
                        <text x="8" y="15" font-family="system-ui,sans-serif" font-size="10" font-weight="700" fill="#0f291b">🏠 Duda &amp; Ian</text>
                    </g>
                </svg>

                <!-- ── CELULAR FLUTUANTE (mockup realista) ── -->
                <div class="animate-float-slow absolute right-0 top-4 z-20"
                     style="width: 220px; bottom: 10px;">
                    
                    <!-- Corpo do celular -->
                    <div class="relative mx-auto rounded-[32px] border-[6px] border-[#0a1f14] bg-[#0a1f14] shadow-[0_30px_80px_-10px_rgba(0,0,0,0.6),0_0_0_1px_rgba(255,255,255,0.05)]"
                         style="box-shadow: 0 30px 80px -10px rgba(0,0,0,0.65), 0 2px 8px rgba(0,0,0,0.3), inset 0 1px 0 rgba(255,255,255,0.08);">
                        
                        <!-- Dynamic Island / notch pill -->
                        <div class="mx-auto mt-2 mb-2 h-5 w-16 rounded-full bg-black flex items-center justify-center gap-1.5">
                            <div class="size-2 rounded-full bg-[#111]"></div>
                            <div class="size-1 rounded-full bg-[#1a1a1a]"></div>
                        </div>

                        <!-- Tela do celular: Header verde escuro (igual ref.) -->
                        <div class="rounded-[22px] overflow-hidden bg-white shadow-inner">
                            
                            <!-- Status bar verde escuro -->
                            <div class="bg-[#0f291b] px-4 pt-2 pb-3">
                                <div class="flex items-center justify-between mb-2">
                                    <!-- Logo SEIVA no app -->
                                    <div class="flex items-center gap-1.5">
                                        <div class="size-5 rounded-full bg-amber-400 flex items-center justify-center">
                                            <svg viewBox="0 0 20 20" class="size-3 text-emerald-900" fill="currentColor">
                                                <path d="M10 2 C6 5 4 9 5 13 C6 17 10 18 10 18 C10 18 14 17 15 13 C16 9 14 5 10 2Z"/>
                                            </svg>
                                        </div>
                                        <span class="text-[9px] font-black text-white tracking-wide">SEIVA</span>
                                    </div>
                                    <!-- Ícones topo -->
                                    <div class="flex items-center gap-2">
                                        <svg class="size-3 text-white/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                        <div class="relative">
                                            <svg class="size-3 text-white/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                                            <div class="absolute -top-1 -right-1 size-2 rounded-full bg-amber-400"></div>
                                        </div>
                                        <div class="size-5 rounded-full bg-emerald-700 flex items-center justify-center">
                                            <span class="text-[7px] font-black text-white">DI</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Saudação -->
                                <div>
                                    <p class="text-[8px] text-emerald-200/70 font-medium">Nosso Cantinho 🌿</p>
                                    <p class="text-[11px] font-black text-white leading-tight">Duda &amp; Ian</p>
                                </div>
                            </div>

                            <!-- Conteúdo do app (fundo claro) -->
                            <div class="bg-[#f5f7f5] p-3 space-y-2.5">
                                
                                <!-- Card Saldo Principal -->
                                <div class="bg-white rounded-2xl p-3 shadow-sm border border-stone-100">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <p class="text-[8px] text-stone-400 font-semibold uppercase tracking-wide">Saldo do Lar</p>
                                            <p class="text-[16px] font-black text-stone-900 leading-tight mt-0.5">R$ 12.450</p>
                                            <p class="text-[8px] text-emerald-600 font-bold mt-0.5">↗ +R$ 2.100 este mês</p>
                                        </div>
                                        <!-- Sparkline -->
                                        <svg class="w-12 h-8" viewBox="0 0 80 40" fill="none">
                                            <path d="M0 32 C15 28, 28 14, 45 20 C60 26, 65 6, 80 4"
                                                  stroke="#2e6b4f" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                                            <circle cx="80" cy="4" r="3" fill="#2e6b4f"/>
                                        </svg>
                                    </div>
                                    <p class="text-[8px] text-emerald-700 font-semibold mt-1 cursor-pointer hover:underline">
                                        Ver lançamentos →
                                    </p>
                                </div>

                                <!-- 3 ações rápidas -->
                                <div class="grid grid-cols-3 gap-1.5">
                                    <div class="bg-white rounded-xl p-2 text-center shadow-sm border border-stone-100">
                                        <div class="size-6 rounded-full bg-rose-50 mx-auto flex items-center justify-center mb-1">
                                            <svg class="size-3 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 19V5m-7 7l7-7 7 7"/></svg>
                                        </div>
                                        <p class="text-[7px] font-bold text-stone-700">Rateio</p>
                                    </div>
                                    <div class="bg-white rounded-xl p-2 text-center shadow-sm border border-stone-100">
                                        <div class="size-6 rounded-full bg-blue-50 mx-auto flex items-center justify-center mb-1">
                                            <svg class="size-3 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14m7-7l-7 7-7-7"/></svg>
                                        </div>
                                        <p class="text-[7px] font-bold text-stone-700">Receita</p>
                                    </div>
                                    <div class="bg-white rounded-xl p-2 text-center shadow-sm border border-stone-100">
                                        <div class="size-6 rounded-full bg-emerald-50 mx-auto flex items-center justify-center mb-1">
                                            <svg class="size-3 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 16l-4-4m0 0l4-4m-4 4h18m0 0l-4 4m4-4l-4-4"/></svg>
                                        </div>
                                        <p class="text-[7px] font-bold text-stone-700">Acordo</p>
                                    </div>
                                </div>

                                <!-- Card "este mês" -->
                                <div class="bg-white rounded-2xl p-3 shadow-sm border border-stone-100">
                                    <div class="flex items-center justify-between mb-2">
                                        <p class="text-[8px] font-bold text-stone-800">Este mês</p>
                                        <p class="text-[7px] text-emerald-600 font-semibold">Ver detalhes →</p>
                                    </div>
                                    <div class="grid grid-cols-2 gap-1.5">
                                        <div class="rounded-xl bg-emerald-50 p-2">
                                            <p class="text-[7px] text-stone-500 font-medium">Receitas</p>
                                            <p class="text-[11px] font-black text-emerald-700">8.500</p>
                                            <p class="text-[7px] text-emerald-600 font-bold">▲ +12%</p>
                                        </div>
                                        <div class="rounded-xl bg-rose-50 p-2">
                                            <p class="text-[7px] text-stone-500 font-medium">Despesas</p>
                                            <p class="text-[11px] font-black text-rose-600">-4.900</p>
                                            <p class="text-[7px] text-rose-500 font-bold">▲ +27%</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Barra de rateio proporcional -->
                                <div class="bg-white rounded-xl px-3 py-2 shadow-sm border border-stone-100">
                                    <div class="flex justify-between text-[7px] font-semibold text-stone-600 mb-1">
                                        <span>Ian · 55%</span>
                                        <span class="text-[7px] font-black text-emerald-700">Rateio Justo</span>
                                        <span>Duda · 45%</span>
                                    </div>
                                    <div class="h-2 w-full rounded-full overflow-hidden flex">
                                        <div class="h-full bg-emerald-600 rounded-l-full" style="width:55%"></div>
                                        <div class="h-full bg-amber-400 rounded-r-full" style="width:45%"></div>
                                    </div>
                                </div>

                            </div><!-- /conteúdo app -->

                            <!-- Home indicator bar -->
                            <div class="bg-[#f5f7f5] flex justify-center pb-2">
                                <div class="h-1 w-16 rounded-full bg-stone-300"></div>
                            </div>
                        </div><!-- /tela -->

                        <!-- Botão lateral (power) -->
                        <div class="absolute -right-[8px] top-24 h-14 w-[5px] rounded-r-full bg-[#15362a]"></div>
                        <!-- Botões volume -->
                        <div class="absolute -left-[8px] top-16 h-8 w-[5px] rounded-l-full bg-[#15362a]"></div>
                        <div class="absolute -left-[8px] top-28 h-8 w-[5px] rounded-l-full bg-[#15362a]"></div>

                    </div><!-- /corpo celular -->

                    <!-- Sombra projetada do celular -->
                    <div class="mx-auto mt-2 rounded-full bg-black/25 blur-xl" style="height:12px; width:160px;"></div>
                </div>

            </div><!-- /composição -->
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
