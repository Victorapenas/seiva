{{-- 
    Módulo: Caixa Preta Privada (RF002 / RF003)
    Responsável Acadêmico: Victor Hugo
    Funcionalidade: Área confidencial protegida por PIN de 4 dígitos, isolamento de despesas estritamente pessoais, 
    patrimônio consolidado, limites de cartões e divisão seletiva com o parceiro.
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="pane-caixa-preta" class="sub-screen space-y-6 hidden">

    <!-- ═══ 1. TELA DE BLOQUEIO POR PIN (TELA INICIAL) ═══ -->
    <div id="caixaPinLockBox" class="rounded-3xl border border-border bg-card p-8 sm:p-10 text-center max-w-sm mx-auto space-y-5 shadow-card transition-all">
        <div class="size-16 mx-auto rounded-3xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 flex items-center justify-center border border-emerald-200/50">
            <i data-lucide="lock" class="size-8"></i>
        </div>
        <div class="space-y-1.5">
            <h3 class="text-lg font-black text-foreground tracking-tight">Caixa Preta</h3>
            <p class="text-xs text-muted-foreground leading-relaxed">
                Digite seu PIN de 4 dígitos para acessar sua área privada individual e dados confidenciais.
            </p>
        </div>

        <form onsubmit="event.preventDefault(); validarPinCaixa();" class="space-y-4">
            <div class="relative w-44 mx-auto">
                <input type="password" maxlength="4" id="caixaPinField" inputmode="numeric" placeholder="••••" 
                       class="h-14 w-full text-center text-3xl tracking-[0.4em] font-black rounded-2xl border-2 border-border bg-background focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 shadow-2xs transition">
            </div>

            <button type="submit" class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs transition shadow-soft flex items-center justify-center gap-2">
                <i data-lucide="key-round" class="size-4"></i>
                <span>Desbloquear Caixa Preta</span>
            </button>
        </form>

        <p class="text-[11px] text-muted-foreground pt-1">
            Seus registros privados e surpresas ficam protegidos por criptografia.
        </p>
    </div>

    <!-- ═══ 2. TELA DESBLOQUEADA DA CAIXA PRETA (DARK GREEN THEME - IMAGENS 1 A 7) ═══ -->
    <div id="caixaUnsealedBox" class="hidden space-y-6">

        <!-- HEADER DA CAIXA PRETA (IMAGEM 1) -->
        <header class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="size-11 rounded-2xl bg-[#14261d] text-emerald-400 border border-emerald-500/20 flex items-center justify-center shrink-0 shadow-soft">
                    <i data-lucide="lock" class="size-5"></i>
                </span>
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-xl sm:text-2xl font-black text-foreground tracking-tight">Caixa Preta</h1>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-950/60 text-emerald-300 border border-emerald-800/40 text-[10px] font-bold">
                            <i data-lucide="shield" class="size-3"></i> Área privada · só você vê
                        </span>
                    </div>
                </div>
            </div>

            <button type="button" onclick="trancarCaixa()" class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border bg-card hover:bg-muted text-muted-foreground hover:text-foreground text-xs font-bold transition shadow-2xs">
                <i data-lucide="eye-off" class="size-3.5"></i>
                <span>Ocultar</span>
            </button>
        </header>

        <!-- HERO CARD: SEU PATRIMÔNIO INDIVIDUAL (IMAGEM 1) -->
        <div class="rounded-3xl bg-[#0f1f17] text-white p-6 shadow-card space-y-5 relative overflow-hidden border border-white/5">
            <!-- Folha de marca d'água sutil -->
            <div class="absolute -right-8 -bottom-8 opacity-5 pointer-events-none text-emerald-400">
                <svg class="size-56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M12 2L12 22M12 22C12 22 7 18 4 12C1 6 7 2 12 2M12 22C12 22 17 18 20 12C23 6 17 2 12 2" stroke-linecap="round"/>
                </svg>
            </div>

            <div class="space-y-1">
                <span class="text-xs text-gray-400 font-medium">Seu patrimônio individual</span>
                <h2 id="caixaPatrimonioTotal" class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                    R$ 3.745,00
                </h2>
                <span class="text-xs text-gray-400 block">Somando todas as suas contas</span>
            </div>

            <!-- 3 Caixas: Livre pra usar | Comprometido | Guardado -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                <div class="rounded-2xl bg-white/5 border border-white/10 p-3.5 space-y-1">
                    <span class="text-xs text-gray-400 block font-medium">Livre pra usar</span>
                    <strong id="caixaPatrimonioLivre" class="text-lg font-black text-[#4ade80] block">
                        R$ 755,00
                    </strong>
                </div>

                <div class="rounded-2xl bg-white/5 border border-white/10 p-3.5 space-y-1">
                    <span class="text-xs text-gray-400 block font-medium">Comprometido</span>
                    <strong id="caixaPatrimonioComprometido" class="text-lg font-black text-[#f87171] block">
                        R$ 2.990,00
                    </strong>
                </div>

                <div class="rounded-2xl bg-white/5 border border-white/10 p-3.5 space-y-1">
                    <span class="text-xs text-gray-400 block font-medium">Guardado</span>
                    <strong id="caixaPatrimonioGuardado" class="text-lg font-black text-white block">
                        R$ 2.100,00
                    </strong>
                </div>
            </div>
        </div>

        <!-- BANNER DE PEDIDO DE AJUDA DO PARCEIRO (IMAGEM 1) -->
        <div id="caixaBannerPedidoAjuda" class="rounded-3xl border border-emerald-800/40 bg-[#12241b] text-white p-5 space-y-3.5 shadow-card">
            <div class="flex items-center gap-2">
                <i data-lucide="handshake" class="size-4 text-emerald-400"></i>
                <div>
                    <h3 id="caixaAjudaRemetenteTitulo" class="text-xs font-bold uppercase tracking-wider text-emerald-200">Ian pediu sua ajuda</h3>
                    <p class="text-[11px] text-gray-300">Você pode ajudar, contrapor um valor menor ou recusar</p>
                </div>
            </div>

            <div class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-white/5 border border-white/10">
                <span class="size-10 rounded-xl bg-emerald-950/80 text-emerald-300 flex items-center justify-center shrink-0 border border-emerald-500/20">
                    <i data-lucide="printer" class="size-5"></i>
                </span>
                <div class="min-w-0 flex-1">
                    <h4 id="caixaAjudaItemTexto" class="text-xs sm:text-sm font-extrabold text-white truncate">
                        Ian pediu uma ajuda de <span class="text-emerald-400">R$ 50,00</span>
                    </h4>
                    <p id="caixaAjudaItemDesc" class="text-xs text-gray-300 truncate mt-0.5">
                        Comprar filamento pra fechar o freela da impressora 3D
                    </p>
                    <span id="caixaAjudaItemTag" class="inline-block text-[10px] text-gray-400 mt-1 font-medium">
                        IM Filamento da impressora 3D · há 20 min
                    </span>
                </div>
            </div>

            <!-- 3 Botões de Ação do Pedido de Ajuda -->
            <div class="grid grid-cols-3 gap-2.5 pt-1">
                <button type="button" onclick="responderPedidoAjudaCaixa('recusar')" 
                        class="py-2.5 px-3 rounded-2xl border border-white/15 bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white font-bold text-xs transition text-center">
                    ✕ Recusar
                </button>
                <button type="button" onclick="responderPedidoAjudaCaixa('contrapor')" 
                        class="py-2.5 px-3 rounded-2xl border border-white/15 bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white font-bold text-xs transition text-center flex items-center justify-center gap-1.5">
                    <i data-lucide="handshake" class="size-3.5"></i>
                    <span>Contrapor</span>
                </button>
                <button type="button" onclick="responderPedidoAjudaCaixa('aceitar')" 
                        class="py-2.5 px-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs transition text-center shadow-soft flex items-center justify-center gap-1.5">
                    <i data-lucide="check" class="size-3.5"></i>
                    <span>Ajudar</span>
                </button>
            </div>
        </div>

        <!-- SEÇÃO: MINHAS CONTAS E CARTÕES (IMAGEM 2) -->
        <section class="space-y-3.5">
            <div class="flex items-center justify-between">
                <h3 class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-muted-foreground">
                    <i data-lucide="wallet" class="size-4 text-emerald-700"></i>
                    <span>Minhas contas e cartões</span>
                </h3>
                <span id="caixaContasCountBadge" class="text-xs text-muted-foreground font-semibold">5 contas · 1 cartão</span>
            </div>

            <!-- Grid de Contas Bancárias da Caixa Preta -->
            <div id="caixaGridContas" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                <!-- Cards de contas injetados via JS -->
            </div>

            <!-- Card Especial do Cartão de Crédito (com borda vermelha e progresso de limite) -->
            <div id="caixaContainerCartoes" class="space-y-3">
                <!-- Cartões injetados via JS -->
            </div>

            <!-- Botão Adicionar Conta ou Cartão -->
            <button type="button" onclick="abrirModalAdicionarContaCartao()" 
                    class="w-full py-3.5 rounded-2xl border-2 border-dashed border-border hover:border-emerald-500/50 bg-card hover:bg-emerald-50/20 dark:hover:bg-emerald-950/20 text-xs font-bold text-foreground transition flex items-center justify-center gap-2 shadow-2xs">
                <i data-lucide="plus" class="size-4 text-emerald-600"></i>
                <span>Adicionar conta ou cartão</span>
            </button>
        </section>

        <!-- SEÇÃO: O QUE VOCÊ DEVE (IMAGEM 3) -->
        <section class="space-y-3.5">
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground flex items-center gap-2">
                    <i data-lucide="receipt" class="size-4 text-emerald-700"></i>
                    <span>O que você deve</span>
                </h3>
                <p class="text-xs text-muted-foreground mt-0.5">Tudo que sai todo mês ou que ainda falta pagar</p>
            </div>

            <div id="caixaListaOQueVoceDeve" class="space-y-3">
                <!-- Itens injetados via JS -->
            </div>

            <!-- Barra Consolidada de Total Comprometido (Imagem 3 Rodapé) -->
            <div class="rounded-2xl border border-border bg-card p-4 space-y-2 shadow-2xs">
                <div class="flex items-center justify-between text-xs">
                    <span class="text-muted-foreground font-medium">Total comprometido / mês</span>
                    <strong id="caixaTotalComprometidoTxt" class="text-sm font-black text-foreground">R$ 1.370,00</strong>
                </div>
                <div class="h-2 w-full rounded-full bg-muted overflow-hidden">
                    <div id="caixaBarraComprometidoRenda" class="h-full bg-rose-500 rounded-full transition-all" style="width: 81%"></div>
                </div>
                <p id="caixaPctComprometidoRendaTxt" class="text-[11px] text-muted-foreground">
                    Você compromete <strong class="text-rose-600 font-extrabold">81%</strong> da sua renda com despesas fixas e acordos.
                </p>
            </div>
        </section>

        <!-- SEÇÃO: DESPESAS SÓ SUAS (IMAGEM 4) -->
        <section class="space-y-3.5">
            <div>
                <div class="flex items-center gap-2">
                    <i data-lucide="lock" class="size-3.5 text-emerald-700"></i>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Despesas só suas</h3>
                </div>
                <p class="text-xs text-muted-foreground mt-0.5">Privadas por padrão — mas você pode dividir com o parceiro se quiser</p>
            </div>

            <div id="caixaListaDespesasSoSuas" class="space-y-2.5">
                <!-- Injetado dinamicamente via JS -->
            </div>
        </section>

        <!-- SEÇÃO: SUAS METAS & PRODUTOS DE OLHO (IMAGEM 5) -->
        <section class="space-y-4">
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground flex items-center gap-2">
                    <i data-lucide="target" class="size-4 text-emerald-700"></i>
                    <span>Suas metas</span>
                </h3>
                <p class="text-xs text-muted-foreground mt-0.5">Para onde vai seu dinheiro extra</p>
            </div>

            <!-- Grid de Metas da Caixa Preta -->
            <div id="caixaGridMetas" class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                <!-- Injetado via JS -->
            </div>

            <!-- Botão Criar Nova Meta -->
            <button type="button" onclick="abrirModalCriarMeta()" 
                    class="w-full py-3 rounded-2xl border border-border bg-card hover:bg-muted/30 text-xs font-bold text-foreground transition flex items-center justify-center gap-2 shadow-2xs">
                <i data-lucide="plus" class="size-4 text-emerald-600"></i>
                <span>Criar nova meta</span>
            </button>

            <!-- Subseção: Produtos de olho (Wishlist) -->
            <div class="space-y-3 pt-2">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-xs font-bold text-foreground flex items-center gap-1.5">
                            <i data-lucide="link" class="size-3.5 text-primary"></i>
                            <span>Produtos de olho</span>
                        </h4>
                        <p class="text-[11px] text-muted-foreground">Cole links, acompanhe preços e adicione uma foto se quiser</p>
                    </div>
                </div>

                <div id="caixaListaProdutosOlho" class="space-y-2.5">
                    <!-- Cards de wishlist injetados via JS -->
                </div>
            </div>
        </section>

        <!-- SEÇÃO: A RECEBER (IMAGEM 6) -->
        <section id="caixaSecaoAReceber" class="space-y-3">
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground flex items-center gap-2">
                    <i data-lucide="hand-coins" class="size-4 text-emerald-700"></i>
                    <span>A receber</span>
                </h3>
                <p id="caixaSubAReceber" class="text-xs text-muted-foreground mt-0.5">Valores que o parceiro aceitou te pagar</p>
            </div>

            <div id="caixaListaAReceber" class="space-y-2">
                <!-- Injetado via JS -->
            </div>

            <!-- Link para histórico de ajudas -->
            <button type="button" onclick="seivaNotificar('Histórico de 3 ajudas mútuas registradas em dia.', 'info', 'Ajudas Mútuas')" 
                    class="w-full p-3 rounded-2xl border border-border bg-card hover:bg-muted/30 text-xs font-semibold text-muted-foreground hover:text-foreground transition flex items-center justify-between shadow-2xs">
                <span class="flex items-center gap-2">
                    <i data-lucide="clock" class="size-3.5 text-emerald-600"></i>
                    <span>Ajudas que eu recebi</span>
                </span>
                <span class="text-[11px] font-bold text-primary">3 do parceiro →</span>
            </button>
        </section>

        <!-- SEÇÃO: SEUS GASTOS RECENTES (IMAGEM 6) -->
        <section class="space-y-3">
            <div class="flex items-center justify-between">
                <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground flex items-center gap-2">
                    <i data-lucide="lock" class="size-3.5 text-emerald-700"></i>
                    <span>Seus gastos recentes</span>
                </h3>
                <span class="text-[11px] text-muted-foreground">privados</span>
            </div>

            <div id="caixaListaGastosRecentes" class="space-y-2">
                <!-- Injetado via JS -->
            </div>

            <button type="button" onclick="abrirModalLancarGasto()" 
                    class="w-full py-3 rounded-2xl border border-border bg-card hover:bg-muted/30 text-xs font-bold text-foreground transition flex items-center justify-center gap-2 shadow-2xs">
                <i data-lucide="plus" class="size-4 text-emerald-600"></i>
                <span>Registrar novo gasto</span>
            </button>
        </section>

        <!-- SEÇÃO: O QUE ENTROU ESTE MÊS (IMAGEM 7) -->
        <section class="space-y-3.5">
            <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground flex items-center gap-2">
                <i data-lucide="trending-up" class="size-4 text-emerald-700"></i>
                <span>O que entrou este mês</span>
            </h3>

            <div id="caixaListaOQueEntrou" class="space-y-2">
                <!-- Injetado via JS -->
            </div>

            <!-- Total Recebido -->
            <div class="flex items-center justify-between p-3.5 rounded-2xl bg-card border border-border shadow-2xs">
                <div>
                    <span class="text-[11px] text-muted-foreground font-medium block">Total recebido</span>
                    <strong id="caixaTotalRecebidoTxt" class="text-base font-black text-foreground">R$ 1.700,00</strong>
                </div>
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300 border border-emerald-200/50 text-xs font-bold">
                    <i data-lucide="check" class="size-3.5"></i> Em dia
                </span>
            </div>

            <button type="button" onclick="abrirModalRegistrarRecebimento()" 
                    class="w-full py-3 rounded-2xl border border-border bg-card hover:bg-muted/30 text-xs font-bold text-foreground transition flex items-center justify-center gap-2 shadow-2xs">
                <i data-lucide="plus" class="size-4 text-emerald-600"></i>
                <span>Registrar recebimento extra</span>
            </button>

            <!-- Botão Pedir Ajuda de Custo (Imagem 7) -->
            <button type="button" id="caixaBtnPedirAjudaParceiro" onclick="abrirModalPedirAjudaCusto()" 
                    class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs transition shadow-soft flex items-center justify-center gap-2">
                <i data-lucide="handshake" class="size-4"></i>
                <span id="caixaBtnPedirAjudaTexto">Pedir ajuda de custo ao parceiro →</span>
            </button>
        </section>

        <!-- RODAPÉ DA CAIXA PRETA -->
        <footer class="flex flex-wrap items-center justify-between gap-3 border-t border-border pt-4 text-[11px] text-muted-foreground">
            <span class="flex items-center gap-1.5">
                <i data-lucide="shield-check" class="size-3.5 text-emerald-600"></i>
                Isolamento Criptográfico e Confidencialidade Individual (LGPD)
            </span>
            <span class="font-bold text-emerald-800 dark:text-emerald-300">
                Onde seu dinheiro cria raízes
            </span>
        </footer>
    </div>
</div>
