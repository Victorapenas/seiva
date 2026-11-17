{{-- 
    Componente Modal: Autenticação Google Identity Services (GIS)
    Responsável: Victor Hugo / Quételi
    Funcionalidade: Login integrado oficial com Google OAuth2 / Credential API
--}}
<div id="modalGoogleAuth" class="hidden fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
    <div class="relative w-full max-w-sm rounded-3xl border border-border bg-card p-6 shadow-elevated">
        <button type="button" onclick="fecharModalId('modalGoogleAuth')" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground p-1 rounded-xl hover:bg-muted transition">
            <i data-lucide="x" class="size-5"></i>
        </button>
        <div class="flex items-center gap-3 mb-4">
            <div class="size-11 rounded-2xl bg-muted/70 p-2 flex items-center justify-center border border-border">
                <svg viewBox="0 0 24 24" class="size-6" aria-hidden="true">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.27-4.74 3.27-8.1Z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84A11 11 0 0 0 12 23Z"/>
                    <path fill="#FBBC05" d="M5.84 14.1a6.6 6.6 0 0 1 0-4.2V7.06H2.18a11 11 0 0 0 0 9.88l3.66-2.84Z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1A11 11 0 0 0 2.18 7.06l3.66 2.84C6.71 7.3 9.14 5.38 12 5.38Z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-foreground">Conectar com Google</h3>
                <p class="text-[11px] text-muted-foreground">Autenticação oficial segura</p>
            </div>
        </div>

        <p class="text-xs text-muted-foreground leading-relaxed mb-4">
            Entre com sua conta Google para sincronizar seu perfil automaticamente no SEIVA com segurança criptográfica:
        </p>

        <!-- Container GIS (caso o navegador já tenha sessão ativa) -->
        <div id="googleGisButtonContainer" class="my-2 flex justify-center"></div>

        <form onsubmit="executarGoogleLoginDireto(event)" class="space-y-3.5 mt-2">
            <div>
                <label class="text-xs font-semibold text-foreground">Nome completo</label>
                <input type="text" id="googleNomeInput" value="Usuário Google" required placeholder="Seu nome" class="mt-1 h-11 w-full rounded-xl border border-border bg-background px-3 text-xs font-medium text-foreground outline-none focus:border-primary">
            </div>
            <div>
                <label class="text-xs font-semibold text-foreground">E-mail da Conta Google</label>
                <input type="email" id="googleEmailInput" placeholder="exemplo@gmail.com" required class="mt-1 h-11 w-full rounded-xl border border-border bg-background px-3 text-xs font-medium text-foreground outline-none focus:border-primary">
            </div>
            <button type="submit" id="btnConfirmarGoogleAuth" class="w-full mt-2 h-12 rounded-2xl bg-primary text-primary-foreground font-semibold text-xs transition shadow-card flex items-center justify-center gap-2 hover:bg-primary/90 active:scale-[0.99]">
                <svg viewBox="0 0 24 24" class="size-4" aria-hidden="true">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.27-4.74 3.27-8.1Z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84A11 11 0 0 0 12 23Z"/>
                    <path fill="#FBBC05" d="M5.84 14.1a6.6 6.6 0 0 1 0-4.2V7.06H2.18a11 11 0 0 0 0 9.88l3.66-2.84Z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1A11 11 0 0 0 2.18 7.06l3.66 2.84C6.71 7.3 9.14 5.38 12 5.38Z"/>
                </svg>
                <span>Entrar com o Google</span>
            </button>
        </form>
    </div>
</div>
