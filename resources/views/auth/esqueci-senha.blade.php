<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SEIVA — Recuperar Senha</title>
    
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
        <!-- Detalhe decorativo sutil -->
        <div class="absolute -top-12 -right-12 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl pointer-events-none"></div>

        <!-- Topo / Marca -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center size-14 rounded-2xl bg-primary/10 text-primary mb-3 shadow-inner">
                <i data-lucide="key-round" class="size-7"></i>
            </div>
            <h1 class="text-2xl font-black text-foreground tracking-tight">Recuperar Senha</h1>
            <p class="text-xs text-muted-foreground mt-1">
                SEIVA • Onde seu dinheiro cria raízes
            </p>
        </div>

        <!-- Instrução -->
        <p class="text-sm text-muted-foreground text-center mb-6 leading-relaxed">
            Digite o e-mail cadastrado na sua conta. Nós enviaremos um link exclusivo para redefinir sua senha com segurança.
        </p>

        <!-- Container de Alertas -->
        <div id="alertBox" class="hidden mb-5 p-4 rounded-2xl text-xs font-medium transition-all"></div>

        <!-- Formulário -->
        <form id="formEsqueciSenha" onsubmit="enviarSolicitacao(event)" class="space-y-4">
            <div>
                <label for="email" class="block text-xs font-semibold text-foreground mb-1.5">
                    E-mail cadastrado
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-muted-foreground">
                        <i data-lucide="mail" class="size-4"></i>
                    </div>
                    <input type="email" id="email" name="email" required
                           placeholder="seu.email@exemplo.com"
                           class="w-full h-12 pl-10 pr-4 rounded-xl border border-border bg-background text-sm text-foreground placeholder:text-muted-foreground/60 outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>
            </div>

            <button type="submit" id="btnSubmit"
                    class="w-full h-12 rounded-xl bg-primary hover:bg-primary/90 text-primary-foreground font-semibold text-sm shadow-md transition flex items-center justify-center gap-2 active:scale-[0.99]">
                <span>Enviar Link de Recuperação</span>
                <i data-lucide="send" class="size-4"></i>
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

        async function enviarSolicitacao(event) {
            event.preventDefault();
            const emailInput = document.getElementById('email');
            const btnSubmit = document.getElementById('btnSubmit');
            const alertBox = document.getElementById('alertBox');
            const email = emailInput.value.trim();

            if (!email) return;

            btnSubmit.disabled = true;
            btnSubmit.innerHTML = `<i data-lucide="loader-2" class="size-4 animate-spin"></i><span>Enviando instruções...</span>`;
            lucide.createIcons();
            alertBox.classList.add('hidden');

            try {
                const response = await fetch('/esqueci-senha', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email })
                });

                const data = await response.json();

                if (response.ok) {
                    alertBox.className = 'mb-5 p-4 rounded-2xl text-xs font-medium bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start gap-2.5';
                    alertBox.innerHTML = `
                        <i data-lucide="check-circle-2" class="size-4 text-emerald-600 mt-0.5 shrink-0"></i>
                        <div>
                            <strong>Instruções enviadas!</strong><br>
                            ${data.message || 'Se este e-mail estiver cadastrado, você receberá o link em breve. Verifique também a pasta de spam.'}
                        </div>
                    `;
                    alertBox.classList.remove('hidden');
                    emailInput.value = '';
                    btnSubmit.innerHTML = `<span>Instruções Enviadas</span><i data-lucide="check" class="size-4"></i>`;
                } else {
                    alertBox.className = 'mb-5 p-4 rounded-2xl text-xs font-medium bg-rose-50 border border-rose-200 text-rose-800 flex items-start gap-2.5';
                    alertBox.innerHTML = `
                        <i data-lucide="alert-circle" class="size-4 text-rose-600 mt-0.5 shrink-0"></i>
                        <div>
                            <strong>Atenção:</strong><br>
                            ${data.message || 'Não foi possível processar a solicitação. Tente novamente.'}
                        </div>
                    `;
                    alertBox.classList.remove('hidden');
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = `<span>Tentar Novamente</span><i data-lucide="send" class="size-4"></i>`;
                }
            } catch (error) {
                alertBox.className = 'mb-5 p-4 rounded-2xl text-xs font-medium bg-rose-50 border border-rose-200 text-rose-800 flex items-start gap-2.5';
                alertBox.innerHTML = `
                    <i data-lucide="alert-triangle" class="size-4 text-rose-600 mt-0.5 shrink-0"></i>
                    <div>Ocorreu uma instabilidade na conexão. Tente novamente em instantes.</div>
                `;
                alertBox.classList.remove('hidden');
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = `<span>Enviar Link de Recuperação</span><i data-lucide="send" class="size-4"></i>`;
            } finally {
                lucide.createIcons();
            }
        }
    </script>
</body>
</html>
