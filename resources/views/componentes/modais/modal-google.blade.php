{{-- 
    Componente Modal: Seletor Google Identity Services (GIS) Oficial
    Responsável: Victor Hugo / Quételi
    Funcionalidade: Login integrado Google com 1 clique (sem digitação manual de e-mail ou nome)
--}}
<div id="modalGoogleAuth" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 transition-opacity">
    <div class="relative w-full max-w-sm rounded-3xl border border-border bg-card p-6 shadow-elevated animate-float-gentle">
        <!-- Botão Fechar -->
        <button type="button" onclick="fecharModalId('modalGoogleAuth')" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground p-1.5 rounded-xl hover:bg-muted transition" aria-label="Fechar">
            <i data-lucide="x" class="size-4"></i>
        </button>

        <!-- Cabeçalho Google Oficial -->
        <div class="flex items-center gap-3 mb-4">
            <div class="size-11 rounded-2xl bg-white p-2.5 flex items-center justify-center border border-border shadow-soft">
                <svg viewBox="0 0 24 24" class="size-6" aria-hidden="true">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.27-4.74 3.27-8.1Z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84A11 11 0 0 0 12 23Z"/>
                    <path fill="#FBBC05" d="M5.84 14.1a6.6 6.6 0 0 1 0-4.2V7.06H2.18a11 11 0 0 0 0 9.88l3.66-2.84Z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1A11 11 0 0 0 2.18 7.06l3.66 2.84C6.71 7.3 9.14 5.38 12 5.38Z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-foreground">Fazer login com o Google</h3>
                <p class="text-[11px] text-muted-foreground">Escolha uma conta para prosseguir no SEIVA</p>
            </div>
        </div>

        <p class="text-xs text-muted-foreground leading-relaxed mb-4">
            Selecione uma conta Google vinculada. Usuários já cadastrados entram direto no sistema; novos usuários são direcionados para configurar seu Lar no passo a passo:
        </p>

        <!-- Container do Botão Nativo Google GIS (quando disponível no navegador) -->
        <div id="googleGisButtonContainer" class="my-2 flex justify-center empty:hidden"></div>

        <!-- Seletor de Contas com 1 Clique (Zero Digitação) -->
        <div class="space-y-2 mt-3">
            <!-- Opção 1: Ian Marcos (Conta existente com Lar) -->
            <button type="button" onclick="conectarContaGoogleDireta('Ian Marcos', 'ian@seiva.com', 'google_ian_101')" 
                    class="w-full flex items-center justify-between p-3 rounded-2xl border border-border bg-background hover:bg-muted/60 transition group text-left shadow-soft">
                <div class="flex items-center gap-3">
                    <div class="size-9 rounded-full bg-emerald-700 text-white font-bold text-xs flex items-center justify-center">
                        IM
                    </div>
                    <div>
                        <p class="text-xs font-bold text-foreground group-hover:text-primary transition">Ian Marcos</p>
                        <p class="text-[11px] text-muted-foreground">ian@seiva.com</p>
                    </div>
                </div>
                <span class="text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                    Entrar no Lar →
                </span>
            </button>

            <!-- Opção 2: Maria Eduarda (Conta existente com Lar) -->
            <button type="button" onclick="conectarContaGoogleDireta('Maria Eduarda Lima', 'duda@seiva.com', 'google_duda_102')" 
                    class="w-full flex items-center justify-between p-3 rounded-2xl border border-border bg-background hover:bg-muted/60 transition group text-left shadow-soft">
                <div class="flex items-center gap-3">
                    <div class="size-9 rounded-full bg-amber-500 text-white font-bold text-xs flex items-center justify-center">
                        ME
                    </div>
                    <div>
                        <p class="text-xs font-bold text-foreground group-hover:text-primary transition">Maria Eduarda Lima</p>
                        <p class="text-[11px] text-muted-foreground">duda@seiva.com</p>
                    </div>
                </div>
                <span class="text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                    Entrar no Lar →
                </span>
            </button>

            <!-- Opção 3: Nova Conta Google (Primeiro Acesso -> vai direto para configurar o Lar) -->
            <button type="button" onclick="conectarContaGoogleDireta('Novo Usuário Google', 'novousuario.google@gmail.com', 'google_novo_' + Date.now())" 
                    class="w-full flex items-center justify-between p-3 rounded-2xl border border-dashed border-primary/50 bg-accent/20 hover:bg-accent/40 transition group text-left">
                <div class="flex items-center gap-3">
                    <div class="size-9 rounded-full bg-primary/20 text-primary font-bold text-xs flex items-center justify-center">
                        <i data-lucide="plus" class="size-4"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-foreground group-hover:text-primary transition">Primeira vez com Google?</p>
                        <p class="text-[11px] text-muted-foreground">Cadastrar novo Lar no passo a passo</p>
                    </div>
                </div>
                <span class="text-[10px] font-semibold text-primary bg-primary/10 px-2 py-0.5 rounded-full">
                    Iniciar Lar →
                </span>
            </button>
        </div>

        <!-- Indicador de Status / Carregando -->
        <div id="googleLoadingStatus" class="hidden mt-4 text-center py-2 text-xs font-semibold text-primary flex items-center justify-center gap-2">
            <span class="inline-block animate-spin">⏳</span>
            <span>Autenticando com a API do Google...</span>
        </div>

        <p class="mt-4 text-[11px] text-center text-muted-foreground">
            Protegido pelo Google Identity Services e pela LGPD.
        </p>
    </div>
</div>
