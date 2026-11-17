{{-- 
    Módulo: Caixa Preta Privada (RF002)
    Responsável Acadêmico: Victor Hugo
    Funcionalidade: Área confidencial protegida por PIN de 4 dígitos, isolamento criptográfico de despesas pessoais e surpresas
--}}
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
