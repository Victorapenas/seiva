<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer login nas Contas do Google</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #1f1f1f;
            color: #e3e3e3;
            user-select: none;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between p-6 antialiased">
    <div>
        <!-- Cabeçalho Oficial Google Dark -->
        <div class="flex items-center gap-2 mb-6 text-xs text-[#c4c7c5]">
            <svg viewBox="0 0 24 24" class="size-5 shrink-0" aria-hidden="true">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.27-4.74 3.27-8.1Z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84A11 11 0 0 0 12 23Z"/>
                <path fill="#FBBC05" d="M5.84 14.1a6.6 6.6 0 0 1 0-4.2V7.06H2.18a11 11 0 0 0 0 9.88l3.66-2.84Z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1A11 11 0 0 0 2.18 7.06l3.66 2.84C6.71 7.3 9.14 5.38 12 5.38Z"/>
            </svg>
            <span class="font-medium text-[13px] text-white">Fazer login com o Google</span>
        </div>

        <!-- Identificação do App -->
        <div class="flex items-center gap-3 mb-5">
            <div class="size-10 rounded-xl bg-[#2e6b4f] p-2 flex items-center justify-center shadow-md">
                <img src="/seiva-logo-white.png" alt="SEIVA" class="w-full h-full object-contain">
            </div>
            <div>
                <p class="text-xs text-[#c4c7c5]">Prosseguir para</p>
                <p class="text-sm font-bold text-white">SEIVA — Finanças do Casal &amp; Lar</p>
            </div>
        </div>

        <h1 class="text-2xl font-normal text-[#e3e3e3] mb-1">Escolha uma conta</h1>
        <p class="text-xs text-[#c4c7c5] mb-5">para continuar no aplicativo SEIVA</p>

        <!-- Lista de Contas Google (Popup Oficial) -->
        <div class="space-y-1 border-t border-[#444746] pt-2">
            
            <!-- Conta 1: Victor Hugo (zeniniti@gmail.com) -->
            <button type="button" onclick="selecionarConta('Victor Hugo Santana Sousa', 'zeniniti@gmail.com', 'google_zeniniti_01')"
                    class="w-full flex items-center gap-3.5 p-3 rounded-lg hover:bg-[#2d2e30] transition text-left group">
                <div class="size-9 rounded-full bg-[#e37400] text-white font-medium text-sm flex items-center justify-center shrink-0">
                    V
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-medium text-[#e3e3e3] group-hover:text-white truncate">Victor Hugo Santana Sousa</p>
                    <p class="text-xs text-[#c4c7c5] truncate">zeniniti@gmail.com</p>
                </div>
            </button>

            <!-- Conta 2: Victor Santana corporativo -->
            <button type="button" onclick="selecionarConta('Victor Hugo Santana Sousa', 'victor.santana@mbvcompany.com', 'google_victor_mbv_02')"
                    class="w-full flex items-center gap-3.5 p-3 rounded-lg hover:bg-[#2d2e30] transition text-left group">
                <div class="size-9 rounded-full bg-[#1a73e8] text-white font-medium text-sm flex items-center justify-center shrink-0">
                    V
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-medium text-[#e3e3e3] group-hover:text-white truncate">Victor Hugo Santana Sousa</p>
                    <p class="text-xs text-[#c4c7c5] truncate">victor.santana@mbvcompany.com</p>
                </div>
            </button>

            <!-- Conta 3: Ian Marcos (Casal SEIVA - Conta existente com Lar) -->
            <button type="button" onclick="selecionarConta('Ian Marcos', 'ian@seiva.com', 'google_ian_101')"
                    class="w-full flex items-center gap-3.5 p-3 rounded-lg hover:bg-[#2d2e30] transition text-left group">
                <div class="size-9 rounded-full bg-[#188038] text-white font-medium text-sm flex items-center justify-center shrink-0">
                    I
                </div>
                <div class="overflow-hidden">
                    <div class="flex items-center gap-2">
                        <p class="text-sm font-medium text-[#e3e3e3] group-hover:text-white truncate">Ian Marcos</p>
                        <span class="text-[10px] text-emerald-400 bg-emerald-950/80 px-1.5 py-0.2 rounded border border-emerald-800">Casal &amp; Lar</span>
                    </div>
                    <p class="text-xs text-[#c4c7c5] truncate">ian@seiva.com</p>
                </div>
            </button>

            <!-- Conta 4: Maria Eduarda (Duda & Ian - Casal SEIVA) -->
            <button type="button" onclick="selecionarConta('Maria Eduarda Lima', 'duda@seiva.com', 'google_duda_102')"
                    class="w-full flex items-center gap-3.5 p-3 rounded-lg hover:bg-[#2d2e30] transition text-left group">
                <div class="size-9 rounded-full bg-[#f29900] text-white font-medium text-sm flex items-center justify-center shrink-0">
                    M
                </div>
                <div class="overflow-hidden">
                    <div class="flex items-center gap-2">
                        <p class="text-sm font-medium text-[#e3e3e3] group-hover:text-white truncate">Maria Eduarda Lima</p>
                        <span class="text-[10px] text-amber-400 bg-amber-950/80 px-1.5 py-0.2 rounded border border-amber-800">Casal &amp; Lar</span>
                    </div>
                    <p class="text-xs text-[#c4c7c5] truncate">duda@seiva.com</p>
                </div>
            </button>

            <!-- Opção: Usar outra conta Google (Primeira vez -> Passo a Passo do Lar) -->
            <button type="button" onclick="mostrarFormOutraConta()" id="btnMostrarOutraConta"
                    class="w-full flex items-center gap-3.5 p-3 rounded-lg hover:bg-[#2d2e30] transition text-left group border-t border-[#444746]/50">
                <div class="size-9 rounded-full bg-[#303134] text-[#c4c7c5] flex items-center justify-center shrink-0">
                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-[#e3e3e3] group-hover:text-white">Usar outra conta</p>
                    <p class="text-xs text-[#c4c7c5]">Configurar novo Lar no passo a passo</p>
                </div>
            </button>

            <!-- Form inline sem prompt nativo -->
            <div id="formOutraContaGoogle" class="hidden p-3 rounded-lg bg-[#282a2c] border border-[#444746] space-y-2 mt-2">
                <label class="text-xs text-[#c4c7c5] block">Digite seu e-mail do Google</label>
                <input type="email" id="inputOutroEmailGoogle" placeholder="exemplo@gmail.com" 
                       class="w-full px-3 py-2 rounded-lg bg-[#1f1f1f] border border-[#444746] text-white text-xs placeholder:text-gray-500 focus:border-[#a8c7fa] focus:outline-none">
                <div class="flex gap-2 pt-1">
                    <button type="button" onclick="confirmarOutraConta()" class="flex-1 py-1.5 rounded-lg bg-[#a8c7fa] hover:bg-[#8ab4f8] text-[#041e49] font-medium text-xs">Continuar</button>
                    <button type="button" onclick="mostrarFormOutraConta()" class="px-3 py-1.5 rounded-lg border border-[#444746] text-[#c4c7c5] text-xs">Cancelar</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Rodapé Google Privacy -->
    <div class="pt-4 border-t border-[#444746] text-[11px] text-[#c4c7c5] flex items-center justify-between">
        <span>Português (Brasil)</span>
        <div class="flex gap-3">
            <a href="https://support.google.com/accounts" target="_blank" class="hover:underline">Ajuda</a>
            <a href="https://policies.google.com/privacy" target="_blank" class="hover:underline">Privacidade</a>
            <a href="https://policies.google.com/terms" target="_blank" class="hover:underline">Termos</a>
        </div>
    </div>

    <script>
        function selecionarConta(nome, email, google_id) {
            const payload = {
                google_id: google_id || ('google_' + Math.abs(email.split('').reduce((a, b) => ((a << 5) - a) + b.charCodeAt(0), 0))),
                name: nome,
                email: email,
                picture: null
            };

            if (window.opener && !window.opener.closed) {
                window.opener.postMessage({
                    tipo: 'SEIVA_GOOGLE_AUTH_SUCCESS',
                    payload: payload
                }, window.location.origin);
            }
            window.close();
        }

        function mostrarFormOutraConta() {
            const form = document.getElementById('formOutraContaGoogle');
            const btn = document.getElementById('btnMostrarOutraConta');
            if (form) {
                const hidden = form.classList.toggle('hidden');
                if (!hidden) {
                    const input = document.getElementById('inputOutroEmailGoogle');
                    if (input) input.focus();
                }
            }
        }

        function confirmarOutraConta() {
            const input = document.getElementById('inputOutroEmailGoogle');
            const email = (input && input.value) ? input.value.trim() : '';
            if (!email || !email.includes('@')) {
                if (input) {
                    input.focus();
                    input.classList.add('border-red-500');
                }
                return;
            }
            const nome = email.split('@')[0].replace(/[._]/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
            selecionarConta(nome, email, 'google_novo_' + Date.now());
        }
    </script>
</body>
</html>
