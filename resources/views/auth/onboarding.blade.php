{{-- 
    Módulo: Cadastro e Onboarding (RF001)
    Responsável Acadêmica: Quételi
    Funcionalidade: Cadastro em 4 etapas, declaração de renda, carteiras financeiras, configuração de PIN da Caixa Preta e inicialização de Lar
--}}
<div id="screen-onboarding" class="app-screen relative min-h-screen flex-col overflow-hidden bg-background">
    
    <!-- Barra de Navegação Superior Global no Cadastro -->
    <header class="w-full border-b border-border bg-card/95 backdrop-blur-md sticky top-0 z-30 px-4 py-3">
        <div class="max-w-2xl mx-auto flex items-center justify-between">
            <button type="button" onclick="irParaLogin()" class="flex items-center gap-1.5 text-xs font-semibold text-muted-foreground hover:text-foreground transition py-1.5 px-3 rounded-xl border border-border bg-card shadow-soft hover:bg-muted">
                <i data-lucide="arrow-left" class="size-4 text-primary"></i>
                <span>Voltar ao Login</span>
            </button>
            <div class="flex items-center gap-2">
                <div class="size-7 rounded-lg border border-border bg-card p-1 flex items-center justify-center">
                    <img src="/seiva-logo.png" alt="SEIVA" class="object-contain w-full h-full" onerror="this.src='/icon.svg'">
                </div>
                <span class="text-xs font-bold text-foreground tracking-tight">SEIVA · Cadastro</span>
            </div>
            <button type="button" onclick="irParaLogin()" class="text-xs font-bold text-primary hover:underline py-1.5 px-3 rounded-xl hover:bg-accent/40 transition">
                Já tenho conta · Entrar
            </button>
        </div>
    </header>

    <!-- FASE: BOAS-VINDAS (WELCOME) -->
    <div id="onboardingFaseWelcome" class="relative z-10 mx-auto flex min-h-[calc(100vh-60px)] w-full max-w-md flex-col items-center justify-center px-6 py-10 text-center">
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
            Já tenho conta · <span class="font-semibold text-primary">Entrar no SEIVA</span>
        </button>
    </div>

    <!-- FASE: FORMULÁRIO EM ETAPAS (PASSOS 1 A 4) -->
    <div id="onboardingFaseForm" class="hidden relative z-10 mx-auto flex min-h-[calc(100vh-60px)] w-full max-w-md flex-col px-6 py-6 justify-between">
        <div>
            <!-- Header com Botão Voltar e Barra de Progresso -->
            <div class="mb-4 flex items-center justify-between gap-3">
                <button type="button" onclick="recuarPassoOnboarding()" aria-label="Voltar" class="flex items-center gap-1.5 text-xs font-semibold text-muted-foreground hover:text-foreground px-3 py-1.5 rounded-xl border border-border bg-card shadow-soft hover:bg-muted transition">
                    <i data-lucide="arrow-left" class="size-4 text-primary"></i>
                    <span id="btnVoltarOnboardingTxt">Voltar ao Login</span>
                </button>
                <div class="flex flex-1 max-w-[120px] gap-1.5">
                    <span id="onbBar0" class="h-1.5 flex-1 rounded-full bg-primary transition-colors"></span>
                    <span id="onbBar1" class="h-1.5 flex-1 rounded-full bg-muted transition-colors"></span>
                    <span id="onbBar2" class="h-1.5 flex-1 rounded-full bg-muted transition-colors"></span>
                    <span id="onbBar3" class="h-1.5 flex-1 rounded-full bg-muted transition-colors"></span>
                </div>
                <span id="onbStepCounter" class="text-xs font-semibold text-muted-foreground">1 de 4</span>
            </div>

            <!-- Banner de Alerta para Validação de Campos Obrigatórios -->
            <div id="onbAlertError" class="hidden mb-4 rounded-2xl border border-rose-500/30 bg-rose-50 dark:bg-rose-950/40 p-3.5 text-xs text-rose-700 dark:text-rose-300 font-medium transition-all shadow-soft flex items-start gap-2.5">
                <i data-lucide="alert-circle" class="size-4 shrink-0 text-rose-500 mt-0.5"></i>
                <div class="flex-1">
                    <p class="font-bold text-rose-800 dark:text-rose-200">Informação obrigatória pendente</p>
                    <p id="onbAlertErrorMsg" class="mt-0.5 text-rose-700 dark:text-rose-300 leading-relaxed">Por favor, preencha todos os campos obrigatórios para avançar.</p>
                </div>
                <button type="button" onclick="fecharAlertaOnboarding()" class="text-rose-500 hover:text-rose-700 p-0.5" title="Fechar aviso">
                    <i data-lucide="x" class="size-3.5"></i>
                </button>
            </div>

            <!-- ───── PASSO 1 · QUEM É VOCÊ? ───── -->
            <div id="onbStepView0" class="onb-step-view space-y-4">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-foreground">Quem é você?</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">Vamos começar pelo básico dos seus dados</p>
                    </div>
                    <span class="text-[11px] font-semibold text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/50 px-2 py-0.5 rounded-md border border-rose-200 dark:border-rose-900">
                        * Obrigatório
                    </span>
                </div>

                <div class="space-y-3">
                    <div>
                        <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                            <span>Nome completo</span>
                            <span class="text-rose-500 font-bold text-[10px]">* obrigatório</span>
                        </label>
                        <input type="text" id="regNome" placeholder="Ex: Maria Eduarda Lima" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none transition focus:border-primary">
                        <p class="mt-1 text-[10px] text-muted-foreground">Informe nome e sobrenome para identificação no casal.</p>
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                            <span>E-mail</span>
                            <span class="text-rose-500 font-bold text-[10px]">* obrigatório</span>
                        </label>
                        <div class="relative mt-1">
                            <i data-lucide="mail" class="pointer-events-none absolute left-3.5 top-1/2 size-4 -translate-y-1/2 text-muted-foreground"></i>
                            <input type="email" id="regEmail" placeholder="voce@email.com" class="h-12 w-full rounded-2xl border border-border bg-background pl-10 pr-4 text-sm text-foreground outline-none transition focus:border-primary">
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                            <span>Telefone / WhatsApp</span>
                            <span class="text-rose-500 font-bold text-[10px]">* obrigatório</span>
                        </label>
                        <div class="relative mt-1">
                            <i data-lucide="phone" class="pointer-events-none absolute left-3.5 top-1/2 size-4 -translate-y-1/2 text-muted-foreground"></i>
                            <input type="tel" id="regTelefone" placeholder="(71) 99999-9999" class="h-12 w-full rounded-2xl border border-border bg-background pl-10 pr-4 text-sm text-foreground outline-none transition focus:border-primary">
                        </div>
                        <p class="mt-1 text-[11px] text-muted-foreground">Usado para recuperar a conta e convites do Lar.</p>
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                            <span>Senha de acesso</span>
                            <span class="text-rose-500 font-bold text-[10px]">* obrigatório (mín. 6)</span>
                        </label>
                        <div class="relative mt-1">
                            <input type="password" id="regSenha" oninput="testarForcaSenha(this.value)" placeholder="Mínimo 6 caracteres" class="h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none transition focus:border-primary">
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
                        <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                            <span>Confirmar senha</span>
                            <span class="text-rose-500 font-bold text-[10px]">* obrigatório</span>
                        </label>
                        <input type="password" id="regSenhaConfirma" placeholder="Repita exatamente a mesma senha" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none transition focus:border-primary">
                    </div>
                </div>
            </div>

            <!-- ───── PASSO 2 · RENDA ───── -->
            <div id="onbStepView1" class="onb-step-view space-y-4 hidden">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-foreground">Agora me conta sobre sua renda</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">Essencial para calcular a proporção salarial do casal</p>
                    </div>
                    <span class="text-[11px] font-semibold text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/50 px-2 py-0.5 rounded-md border border-rose-200 dark:border-rose-900">
                        * Obrigatório
                    </span>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="mb-2 text-xs font-semibold text-foreground flex items-center justify-between">
                            <span>Tipo de renda principal</span>
                            <span class="text-rose-500 font-bold text-[10px]">* obrigatório</span>
                        </label>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" onclick="setRendaTipo('CLT')" id="btnRenda_CLT" class="min-h-11 rounded-xl border border-primary bg-primary text-primary-foreground px-4 text-sm font-medium transition">CLT</button>
                            <button type="button" onclick="setRendaTipo('Autônomo')" id="btnRenda_Autônomo" class="min-h-11 rounded-xl border border-border bg-background text-muted-foreground px-4 text-sm font-medium transition">Autônomo</button>
                            <button type="button" onclick="setRendaTipo('Empresário')" id="btnRenda_Empresário" class="min-h-11 rounded-xl border border-border bg-background text-muted-foreground px-4 text-sm font-medium transition">Empresário</button>
                            <button type="button" onclick="setRendaTipo('Outros')" id="btnRenda_Outros" class="min-h-11 rounded-xl border border-border bg-background text-muted-foreground px-4 text-sm font-medium transition">Outros</button>
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                            <span>Renda mensal principal (líquida)</span>
                            <span class="text-rose-500 font-bold text-[10px]">* obrigatório (> 0)</span>
                        </label>
                        <input type="number" step="0.01" id="regRenda" placeholder="R$ 0,00" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-lg font-bold text-foreground outline-none transition focus:border-primary">
                        <p class="mt-1 text-[11px] text-muted-foreground">Obrigatório para o cálculo proporcional das contas do casal (ex: 55% / 45%).</p>
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                            <span>Que dia você costuma receber?</span>
                            <span class="text-rose-500 font-bold text-[10px]">* obrigatório</span>
                        </label>
                        <div class="relative mt-1">
                            <i data-lucide="calendar" class="pointer-events-none absolute left-3.5 top-1/2 size-4 -translate-y-1/2 text-muted-foreground"></i>
                            <select id="regDiaRecebe" class="h-12 w-full rounded-2xl border border-border bg-background pl-10 pr-4 text-sm text-foreground outline-none transition focus:border-primary">
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
                            <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                                <span>Média mensal de renda extra (R$)</span>
                                <span class="text-rose-500 font-bold text-[10px]">* obrigatório se marcado</span>
                            </label>
                            <input type="number" step="0.01" id="regRendaExtra" placeholder="R$ 0,00" class="mt-1 h-11 w-full rounded-xl border border-border bg-background px-3 text-sm font-bold text-foreground outline-none transition focus:border-primary">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ───── PASSO 3 · CONTAS & CAIXA PRETA ───── -->
            <div id="onbStepView2" class="onb-step-view space-y-4 hidden">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-foreground">Onde fica seu dinheiro?</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">Adicione sua conta principal e proteja a Caixa Preta</p>
                    </div>
                    <span class="text-[11px] font-semibold text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/50 px-2 py-0.5 rounded-md border border-rose-200 dark:border-rose-900">
                        * Obrigatório
                    </span>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="mb-2 text-xs font-semibold text-foreground flex items-center justify-between">
                            <span>Onde seu dinheiro está guardado?</span>
                            <span class="text-rose-500 font-bold text-[10px]">* obrigatório</span>
                        </label>
                        <div class="grid grid-cols-5 gap-2">
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
                            <button type="button" onclick="setBancoPrincipal('Outro')" class="banco-select-btn flex flex-col items-center gap-1.5 rounded-2xl border border-border bg-background text-muted-foreground py-2.5 text-xs font-medium transition" data-banco="Outro">
                                <span class="size-5 rounded-full bg-stone-400 flex items-center justify-center text-[10px] text-white font-bold">+</span> Outro
                            </button>
                        </div>
                    </div>

                    <!-- Campo condicional para quando a pessoa seleciona 'Outro' banco ou carteira -->
                    <div id="boxBancoOutroInput" class="hidden rounded-2xl border border-primary/40 bg-accent/20 p-3.5 space-y-1.5 transition-all">
                        <label class="text-xs font-bold text-foreground flex items-center justify-between">
                            <span class="flex items-center gap-1.5">
                                <i data-lucide="landmark" class="size-3.5 text-primary"></i>
                                <span>Qual é o seu banco ou onde está guardado o dinheiro?</span>
                            </span>
                            <span class="text-rose-500 font-bold text-[10px]">* obrigatório</span>
                        </label>
                        <input type="text" id="regBancoOutroNome" placeholder="Ex: Bradesco, Santander, Banco do Brasil, C6, Carteira física, PicPay..." class="h-12 w-full rounded-xl border border-border bg-card px-4 text-sm text-foreground outline-none transition focus:border-primary font-medium">
                        <p class="text-[11px] text-muted-foreground">Informe o nome do banco ou carteira para identificação das suas contas.</p>
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                            <span>Saldo atual na conta principal (R$)</span>
                            <span class="text-rose-500 font-bold text-[10px]">* obrigatório (digite 0 se sem saldo)</span>
                        </label>
                        <input type="number" step="0.01" id="regSaldoInicial" placeholder="R$ 0,00" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-base font-bold text-foreground outline-none transition focus:border-primary">
                        <p class="mt-1 text-[11px] text-muted-foreground">Informe o saldo atual (caso a conta esteja zerada, digite 0).</p>
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                            <span>Chave Pix Principal</span>
                            <span class="text-rose-500 font-bold text-[10px]">* obrigatório</span>
                        </label>
                        <input type="text" id="regPix" placeholder="CPF, telefone ou e-mail" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none transition focus:border-primary">
                        <p class="mt-1 text-[11px] text-muted-foreground">Utilizada para transferências de rateio e acerto financeiro do casal.</p>
                    </div>

                    <!-- Configuração do PIN da Caixa Preta -->
                    <div class="rounded-2xl border border-border bg-secondary/50 p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-foreground font-semibold text-xs">
                                <i data-lucide="lock" class="size-4 text-primary"></i>
                                <span>PIN da Caixa Preta (4 dígitos)</span>
                            </div>
                            <span class="text-rose-500 font-bold text-[10px]">* obrigatório</span>
                        </div>
                        <p class="text-[11px] text-muted-foreground mt-1">Crie um código de exatamente 4 números para proteger seus gastos e reservas confidenciais.</p>
                        <input type="password" maxlength="4" id="regPinCaixa" placeholder="1234" class="mt-2 h-11 w-32 rounded-xl border border-border bg-card px-3 text-center text-lg font-bold tracking-widest text-foreground outline-none transition focus:border-primary">
                    </div>
                </div>
            </div>

            <!-- ───── PASSO 4 · COMO QUER USAR O SEIVA? (LAR) ───── -->
            <div id="onbStepView3" class="onb-step-view space-y-4 hidden">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-foreground">Como você quer usar o SEIVA?</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">Cuide das suas finanças ou divida um Lar com quem mora com você.</p>
                    </div>
                    <span class="text-[11px] font-semibold text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/50 px-2 py-0.5 rounded-md border border-rose-200 dark:border-rose-900">
                        * Obrigatório
                    </span>
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
                        <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                            <span>Nome do Lar</span>
                            <span class="text-rose-500 font-bold text-[10px]">* obrigatório</span>
                        </label>
                        <input type="text" id="regNomeLar" value="Nosso Cantinho" placeholder="Ex: Nosso Cantinho, Apê 402" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm font-semibold text-foreground outline-none transition focus:border-primary">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-foreground">E-mail do parceiro(a) (opcional)</label>
                        <input type="email" id="regEmailParceiro" placeholder="parceiro@email.com" class="mt-1 h-12 w-full rounded-2xl border border-border bg-background px-4 text-sm text-foreground outline-none transition focus:border-primary">
                        <p class="mt-1 text-[11px] text-muted-foreground">Enviaremos um convite para a pessoa entrar no seu Lar compartilhado.</p>
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

        <!-- Botão de Avanço do Formulário & Link de Retorno ao Login -->
        <div class="pt-6 space-y-3">
            <button type="button" onclick="avancarEtapaOnboarding()" id="btnAvancarOnboarding" class="flex h-14 w-full items-center justify-center gap-2 rounded-2xl bg-primary text-base font-semibold text-primary-foreground shadow-soft hover:bg-primary/90 transition active:scale-[0.99]">
                <span id="btnAvancarOnboardingLabel">Próximo</span>
                <i data-lucide="arrow-right" class="size-5"></i>
            </button>
            <div class="text-center pt-1">
                <button type="button" onclick="irParaLogin()" class="text-xs text-muted-foreground hover:text-foreground transition">
                    Já tem uma conta no SEIVA? <span class="font-bold text-primary hover:underline ml-0.5">Entrar agora</span>
                </button>
            </div>
        </div>
    </div>
</div>
