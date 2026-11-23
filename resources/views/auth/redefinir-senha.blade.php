<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SEIVA — Redefinir Senha</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#2e6b4f">

    <!-- Tailwind CSS & Lucide Icons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tipografia Inter Oficial -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#faf9f5',
                        foreground: '#1c2826',
                        card: '#ffffff',
                        primary: '#2e6b4f',
                        'primary-foreground': '#ffffff',
                        muted: '#f0ede6',
                        'muted-foreground': '#757c76',
                        border: '#e6e3da',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-[#0f291b] via-[#163826] to-[#204e35] min-h-screen flex items-center justify-center p-4 font-sans text-foreground">

    <div class="w-full max-w-md bg-card rounded-3xl p-8 shadow-2xl border border-white/10 relative overflow-hidden">
        <!-- Topo / Marca -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center size-14 rounded-2xl bg-primary/10 text-primary mb-3 shadow-inner">
                <i data-lucide="lock" class="size-7"></i>
            </div>
            <h1 class="text-2xl font-black text-foreground tracking-tight">Criar Nova Senha</h1>
            <p class="text-xs text-muted-foreground mt-1">
                SEIVA • Segurança e Privacidade Financeira
            </p>
        </div>

        <!-- Instrução -->
        <p class="text-sm text-muted-foreground text-center mb-6 leading-relaxed">
            Escolha uma nova senha para acessar sua conta individual e o ambiente do seu Lar.
        </p>

        <!-- Container de Alertas -->
        <div id="alertBox" class="hidden mb-5 p-4 rounded-2xl text-xs font-medium transition-all"></div>

        <!-- Formulário -->
        <form id="formRedefinirSenha" onsubmit="salvarNovaSenha(event)" class="space-y-4">
            <input type="hidden" id="token" name="token" value="{{ $token }}">

            <div>
                <label for="nova_senha" class="block text-xs font-semibold text-foreground mb-1.5">
                    Nova Senha
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-muted-foreground">
                        <i data-lucide="lock" class="size-4"></i>
                    </div>
                    <input type="password" id="nova_senha" name="nova_senha" required minlength="4"
                           placeholder="Mínimo de 4 caracteres"
                           class="w-full h-12 pl-10 pr-10 rounded-xl border border-border bg-background text-sm text-foreground placeholder:text-muted-foreground/60 outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20">
                    <button type="button" onclick="alternarVisibilidade('nova_senha', 'olho1')" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-muted-foreground hover:text-foreground">
                        <i id="olho1" data-lucide="eye" class="size-4"></i>
                    </button>
                </div>
            </div>

            <div>
                <label for="confirmar_senha" class="block text-xs font-semibold text-foreground mb-1.5">
                    Confirmar Nova Senha
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-muted-foreground">
                        <i data-lucide="shield-check" class="size-4"></i>
                    </div>
                    <input type="password" id="confirmar_senha" name="confirmar_senha" required minlength="4"
                           placeholder="Repita a nova senha"
                           class="w-full h-12 pl-10 pr-10 rounded-xl border border-border bg-background text-sm text-foreground placeholder:text-muted-foreground/60 outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20">
                    <button type="button" onclick="alternarVisibilidade('confirmar_senha', 'olho2')" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-muted-foreground hover:text-foreground">
                        <i id="olho2" data-lucide="eye" class="size-4"></i>
                    </button>
                </div>
            </div>

            <button type="submit" id="btnSubmit"
                    class="w-full h-12 rounded-xl bg-primary hover:bg-primary/90 text-primary-foreground font-semibold text-sm shadow-md transition flex items-center justify-center gap-2 active:scale-[0.99] mt-2">
                <span>Atualizar Senha</span>
                <i data-lucide="check" class="size-4"></i>
            </button>
        </form>

        <!-- Rodapé / Voltar -->
        <div class="mt-8 pt-5 border-t border-border/60 text-center">
            <a href="/" class="inline-flex items-center gap-2 text-xs font-semibold text-primary hover:underline">
                <i data-lucide="arrow-left" class="size-3.5"></i>
                <span>Voltar para o Login</span>
            </a>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function alternarVisibilidade(inputId, eyeId) {
            const input = document.getElementById(inputId);
            const eye = document.getElementById(eyeId);
            if (input.type === 'password') {
                input.type = 'text';
                eye.setAttribute('data-lucide', 'eye-off');
            } else {
                input.type = 'password';
                eye.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }

        async function salvarNovaSenha(event) {
            event.preventDefault();
            const token = document.getElementById('token').value;
            const novaSenha = document.getElementById('nova_senha').value;
            const confirmarSenha = document.getElementById('confirmar_senha').value;
            const btnSubmit = document.getElementById('btnSubmit');
            const alertBox = document.getElementById('alertBox');

            if (novaSenha !== confirmarSenha) {
                alertBox.className = 'mb-5 p-4 rounded-2xl text-xs font-medium bg-rose-50 border border-rose-200 text-rose-800 flex items-start gap-2.5';
                alertBox.innerHTML = `
                    <i data-lucide="alert-circle" class="size-4 text-rose-600 mt-0.5 shrink-0"></i>
                    <div>As senhas digitadas não coincidem. Verifique e tente novamente.</div>
                `;
                alertBox.classList.remove('hidden');
                lucide.createIcons();
                return;
            }

            if (novaSenha.length < 4) {
                alertBox.className = 'mb-5 p-4 rounded-2xl text-xs font-medium bg-rose-50 border border-rose-200 text-rose-800 flex items-start gap-2.5';
                alertBox.innerHTML = `
                    <i data-lucide="alert-circle" class="size-4 text-rose-600 mt-0.5 shrink-0"></i>
                    <div>A senha deve conter no mínimo 4 caracteres.</div>
                `;
                alertBox.classList.remove('hidden');
                lucide.createIcons();
                return;
            }

            btnSubmit.disabled = true;
            btnSubmit.innerHTML = `<i data-lucide="loader-2" class="size-4 animate-spin"></i><span>Salvando nova senha...</span>`;
            lucide.createIcons();
            alertBox.classList.add('hidden');

            try {
                const response = await fetch('/redefinir-senha', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ token, nova_senha: novaSenha })
                });

                const data = await response.json();

                if (response.ok) {
                    alertBox.className = 'mb-5 p-4 rounded-2xl text-xs font-medium bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start gap-2.5';
                    alertBox.innerHTML = `
                        <i data-lucide="check-circle-2" class="size-4 text-emerald-600 mt-0.5 shrink-0"></i>
                        <div>
                            <strong>Sucesso!</strong><br>
                            Sua senha foi atualizada com sucesso. Redirecionando para a tela de login...
                        </div>
                    `;
                    alertBox.classList.remove('hidden');
                    btnSubmit.innerHTML = `<span>Senha Redefinida!</span><i data-lucide="check" class="size-4"></i>`;
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 2000);
                } else {
                    alertBox.className = 'mb-5 p-4 rounded-2xl text-xs font-medium bg-rose-50 border border-rose-200 text-rose-800 flex items-start gap-2.5';
                    alertBox.innerHTML = `
                        <i data-lucide="alert-circle" class="size-4 text-rose-600 mt-0.5 shrink-0"></i>
                        <div>
                            <strong>Não foi possível redefinir:</strong><br>
                            ${data.message || 'O link pode estar expirado ou ser inválido.'}
                        </div>
                    `;
                    alertBox.classList.remove('hidden');
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = `<span>Tentar Novamente</span><i data-lucide="check" class="size-4"></i>`;
                }
            } catch (error) {
                alertBox.className = 'mb-5 p-4 rounded-2xl text-xs font-medium bg-rose-50 border border-rose-200 text-rose-800 flex items-start gap-2.5';
                alertBox.innerHTML = `
                    <i data-lucide="alert-triangle" class="size-4 text-rose-600 mt-0.5 shrink-0"></i>
                    <div>Erro de conexão ao servidor. Tente novamente em instantes.</div>
                `;
                alertBox.classList.remove('hidden');
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = `<span>Atualizar Senha</span><i data-lucide="check" class="size-4"></i>`;
            } finally {
                lucide.createIcons();
            }
        }
    </script>
</body>
</html>
