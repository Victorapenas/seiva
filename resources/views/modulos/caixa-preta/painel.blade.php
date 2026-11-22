{{-- 
    Módulo: Caixa Preta Privada (RF002 / RF003)
    Responsável Acadêmico: Victor Hugo
    Funcionalidade: Área confidencial protegida por PIN de 4 dígitos, isolamento de despesas estritamente pessoais, 
    patrimônio consolidado, limites de cartões e divisão seletiva com o parceiro.
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="pane-caixa-preta" class="sub-screen space-y-6 hidden">

    <!-- ═══ 1. TELA DE BLOQUEIO POR PIN (TELA INICIAL) ═══ -->
    <div id="caixaPinLockBox" class="rounded-3xl border border-emerald-900/40 bg-[#07130c] text-white p-8 sm:p-10 text-center max-w-md mx-auto space-y-6 shadow-2xl relative overflow-hidden transition-all">
        <!-- Marca d'água sutil de folha Seiva -->
        <div class="absolute -right-12 -bottom-12 opacity-5 pointer-events-none text-emerald-400">
            <svg class="size-64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M12 2L12 22M12 22C12 22 7 18 4 12C1 6 7 2 12 2M12 22C12 22 17 18 20 12C23 6 17 2 12 2" stroke-linecap="round"/>
            </svg>
        </div>

        <div class="size-16 mx-auto rounded-3xl bg-emerald-950/80 text-emerald-400 flex items-center justify-center border border-emerald-500/30 shadow-soft">
            <i data-lucide="lock" class="size-8"></i>
        </div>
        <div class="space-y-2">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-950/90 text-emerald-300 border border-emerald-700/50 text-[10px] font-extrabold uppercase tracking-widest">
                <i data-lucide="shield-check" class="size-3 text-emerald-400"></i> Área Privada e Segura
            </div>
            <h3 class="text-xl sm:text-2xl font-black text-white tracking-tight">Caixa Preta</h3>
            <p class="text-xs text-emerald-200/70 leading-relaxed max-w-xs mx-auto">
                Digite seu PIN de 4 dígitos para acessar seus dados confidenciais, contas pessoais e acordos.
            </p>
        </div>

        <form onsubmit="event.preventDefault(); validarPinCaixa();" class="space-y-5">
            <div class="relative w-48 mx-auto">
                <input type="password" maxlength="4" id="caixaPinField" inputmode="numeric" placeholder="••••" autofocus
                       class="h-16 w-full text-center text-3xl tracking-[0.45em] font-black rounded-2xl border-2 border-emerald-900/60 bg-[#0c1f14] text-emerald-300 placeholder:text-emerald-800/60 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 shadow-inner transition">
            </div>

            <button type="submit" class="w-full py-4 rounded-2xl bg-emerald-600 hover:bg-emerald-500 active:scale-[0.99] text-white font-extrabold text-xs uppercase tracking-wider transition shadow-lg shadow-emerald-950 flex items-center justify-center gap-2">
                <i data-lucide="key-round" class="size-4"></i>
                <span>Desbloquear Caixa Preta</span>
            </button>
        </form>

        <div class="pt-2 border-t border-emerald-900/30 flex items-center justify-between text-[11px] text-emerald-200/60">
            <span class="flex items-center gap-1">
                <i data-lucide="shield" class="size-3 text-emerald-500"></i> Criptografia Individual
            </span>
            <button type="button" onclick="mostrarInstrucaoEsqueciPin()" class="text-emerald-400 hover:text-emerald-300 font-bold hover:underline">
                Esqueci meu PIN
            </button>
        </div>
    </div>

    <!-- ═══ 2. TELA DESBLOQUEADA DA CAIXA PRETA (DARK SEIVA THEME) ═══ -->
    <div id="caixaUnsealedBox" class="hidden bg-[#06140c] text-white border border-emerald-900/50 rounded-3xl p-4 sm:p-8 space-y-7 shadow-2xl relative">

        <!-- HEADER DA CAIXA PRETA -->
        <header class="flex flex-wrap items-center justify-between gap-3 border-b border-emerald-900/40 pb-5">
            <div class="flex items-center gap-3">
                <span class="size-11 rounded-2xl bg-[#0e2417] text-emerald-400 border border-emerald-500/30 flex items-center justify-center shrink-0 shadow-soft">
                    <i data-lucide="lock" class="size-5"></i>
                </span>
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-xl sm:text-2xl font-black text-white tracking-tight">Caixa Preta</h1>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-950/80 text-emerald-300 border border-emerald-700/50 text-[10px] font-bold">
                            <i data-lucide="shield" class="size-3"></i> Área privada · só você vê
                        </span>
                    </div>
                    <p class="text-[11px] text-emerald-200/60 mt-0.5">Seus registros pessoais, patrimônio individual e wishlist</p>
                </div>
            </div>

            <!-- Botões Header: Ocultar valores (olho) e Bloquear (tranca) -->
            <div class="flex items-center gap-2">
                <button type="button" id="btnOcultarValoresCaixa" onclick="toggleOcultarValoresCaixa()" 
                        class="flex items-center gap-1.5 px-3 py-2 rounded-xl border border-emerald-900/60 bg-[#0d2015] hover:bg-[#122b1d] text-emerald-200 hover:text-white text-xs font-bold transition shadow-2xs">
                    <i data-lucide="eye-off" class="size-3.5 text-emerald-400"></i>
                    <span id="btnOcultarValoresCaixaTxt">Ocultar valores</span>
                </button>
                <button type="button" id="btnTrancarCaixa" onclick="trancarCaixa()" 
                        class="flex items-center gap-1.5 px-3 py-2 rounded-xl border border-emerald-800/40 bg-emerald-950/70 hover:bg-emerald-900/80 text-emerald-300 hover:text-white text-xs font-bold transition shadow-2xs">
                    <i data-lucide="lock" class="size-3.5"></i>
                    <span>Bloquear</span>
                </button>
            </div>
        </header>

        <!-- HERO CARD: SEU PATRIMÔNIO INDIVIDUAL LÍQUIDO -->
        <div class="rounded-3xl bg-[#0a1a11] border border-emerald-800/40 text-white p-6 sm:p-7 shadow-card space-y-5 relative overflow-hidden">
            <!-- Folha decorativa marca d'água -->
            <div class="absolute -right-8 -bottom-8 opacity-5 pointer-events-none text-emerald-400">
                <svg class="size-56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M12 2L12 22M12 22C12 22 7 18 4 12C1 6 7 2 12 2M12 22C12 22 17 18 20 12C23 6 17 2 12 2" stroke-linecap="round"/>
                </svg>
            </div>

            <div class="space-y-1.5">
                <div class="flex items-center gap-2">
                    <span class="text-xs text-emerald-300/80 font-bold uppercase tracking-wider">Seu patrimônio individual</span>
                    <button type="button" onclick="explicarPatrimonio()" title="Entenda o cálculo do seu patrimônio" 
                            class="size-5 rounded-full bg-emerald-950/80 text-emerald-400 hover:text-white flex items-center justify-center transition border border-emerald-700/40 text-xs">
                        <i data-lucide="help-circle" class="size-3.5"></i>
                    </button>
                </div>
                <h2 id="caixaPatrimonioTotal" class="text-3xl sm:text-4xl font-black text-white tracking-tight valor-sensivel">
                    R$ 3.745,00
                </h2>
                <span class="text-xs text-gray-400 block">Soma de todas as suas contas, dinheiro e reservas individuais</span>
            </div>

            <!-- 3 Caixas: Livre pra usar | Comprometido | Guardado -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                <div class="rounded-2xl bg-white/5 border border-white/10 p-3.5 space-y-1">
                    <span class="text-xs text-gray-400 block font-medium">Livre pra usar</span>
                    <strong id="caixaPatrimonioLivre" class="text-lg font-black text-[#4ade80] block valor-sensivel">
                        R$ 755,00
                    </strong>
                    <span class="text-[10px] text-emerald-300/70 block">Disponível no dia a dia</span>
                </div>

                <div class="rounded-2xl bg-white/5 border border-white/10 p-3.5 space-y-1">
                    <span class="text-xs text-gray-400 block font-medium">Comprometido</span>
                    <strong id="caixaPatrimonioComprometido" class="text-lg font-black text-[#f87171] block valor-sensivel">
                        R$ 2.990,00
                    </strong>
                    <span class="text-[10px] text-rose-300/70 block">Faturas e contas a pagar</span>
                </div>

                <div class="rounded-2xl bg-white/5 border border-white/10 p-3.5 space-y-1">
                    <span class="text-xs text-gray-400 block font-medium">Guardado</span>
                    <strong id="caixaPatrimonioGuardado" class="text-lg font-black text-white block valor-sensivel">
                        R$ 2.100,00
                    </strong>
                    <span class="text-[10px] text-gray-400 block">Poupança e reservas</span>
                </div>
            </div>
        </div>

        <!-- BANNER DE PEDIDO DE AJUDA DO PARCEIRO -->
        <div id="caixaBannerPedidoAjuda" class="rounded-3xl border border-emerald-800/50 bg-[#0d2217] text-white p-5 sm:p-6 space-y-4 shadow-card">
            <div class="flex items-center gap-2">
                <span class="size-7 rounded-lg bg-emerald-950 flex items-center justify-center text-emerald-400 border border-emerald-600/30">
                    <i data-lucide="handshake" class="size-4"></i>
                </span>
                <div>
                    <h3 id="caixaAjudaRemetenteTitulo" class="text-xs font-bold uppercase tracking-wider text-emerald-200">Parceiro pediu sua ajuda</h3>
                    <p class="text-[11px] text-gray-300">Você pode ajudar integralmente, propor outro valor ou recusar</p>
                </div>
            </div>

            <div class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-black/20 border border-white/10">
                <span class="size-10 rounded-xl bg-emerald-950/90 text-emerald-300 flex items-center justify-center shrink-0 border border-emerald-500/20">
                    <i data-lucide="printer" class="size-5"></i>
                </span>
                <div class="min-w-0 flex-1">
                    <h4 id="caixaAjudaItemTexto" class="text-xs sm:text-sm font-extrabold text-white truncate">
                        Pediu ajuda de <span class="text-emerald-400">R$ 50,00</span>
                    </h4>
                    <p id="caixaAjudaItemDesc" class="text-xs text-gray-300 truncate mt-0.5">
                        Comprar filamento pra fechar o freela da impressora 3D
                    </p>
                    <span id="caixaAjudaItemTag" class="inline-block text-[10px] text-gray-400 mt-1 font-medium">
                        IM Filamento da impressora 3D · há 20 min
                    </span>
                </div>
            </div>

            <!-- Botões Principais de Ação do Pedido de Ajuda -->
            <div class="grid grid-cols-3 gap-2.5 pt-1">
                <button type="button" onclick="responderPedidoAjudaCaixa('recusar')" 
                        class="py-2.5 px-3 rounded-2xl border border-white/15 bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white font-bold text-xs transition text-center">
                    ✕ Recusar
                </button>
                <button type="button" onclick="abrirContrapropostaCaixa()" 
                        class="py-2.5 px-3 rounded-2xl border border-emerald-600/40 bg-emerald-950/60 hover:bg-emerald-900/60 text-emerald-300 hover:text-white font-bold text-xs transition text-center flex items-center justify-center gap-1.5">
                    <i data-lucide="edit-3" class="size-3.5"></i>
                    <span>Contrapor</span>
                </button>
                <button type="button" onclick="responderPedidoAjudaCaixa('aceitar')" 
                        class="py-2.5 px-3 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-xs transition text-center shadow-soft flex items-center justify-center gap-1.5">
                    <i data-lucide="check" class="size-3.5"></i>
                    <span>Ajudar</span>
                </button>
            </div>

            <!-- BOX EXPANSÍVEL DE CONTRAPROPOSTA COM VALOR LIVRE -->
            <div id="caixaContrapropostaBox" class="hidden mt-3 p-4 rounded-2xl bg-black/40 border border-emerald-600/40 space-y-3">
                <div class="flex items-center justify-between">
                    <h4 class="text-xs font-bold text-emerald-300 flex items-center gap-1.5">
                        <i data-lucide="handshake" class="size-3.5"></i>
                        <span>Propor outro valor de ajuda</span>
                    </h4>
                    <span class="text-[10px] text-gray-400">Digite quanto você pode contribuir</span>
                </div>

                <div class="space-y-1">
                    <label class="text-[11px] text-gray-300 font-medium">Valor que você propõe ajudar (R$)</label>
                    <div class="relative flex items-center rounded-xl border border-emerald-700/50 bg-[#07130c] px-3 py-2 shadow-inner">
                        <span class="text-xs font-bold text-emerald-400 select-none pr-2">R$</span>
                        <input type="text" id="caixaContrapropostaValor" inputmode="decimal" placeholder="20,00"
                               class="w-full bg-transparent text-sm font-black text-white focus:outline-none placeholder:text-gray-600">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[11px] text-gray-300 font-medium">Mensagem explicativa (opcional)</label>
                    <input type="text" id="caixaContrapropostaMensagem" placeholder="Ex: Consigo ajudar com R$ 20 agora sem apertar"
                           class="w-full px-3 py-2 rounded-xl bg-[#07130c] border border-emerald-900/50 text-xs text-white placeholder:text-gray-500 focus:border-emerald-500 focus:outline-none">
                </div>

                <div class="flex gap-2 pt-1">
                    <button type="button" onclick="enviarContrapropostaCaixa()" 
                            class="flex-1 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-xs transition flex items-center justify-center gap-1.5">
                        <i data-lucide="send" class="size-3.5"></i>
                        <span>Enviar contraproposta</span>
                    </button>
                    <button type="button" onclick="fecharContrapropostaCaixa()" 
                            class="px-4 py-2.5 rounded-xl border border-white/15 bg-white/5 hover:bg-white/10 text-gray-300 text-xs font-bold">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>

        <!-- SEÇÃO: MINHAS CONTAS E CARTÕES -->
        <section class="space-y-3.5">
            <div class="flex items-center justify-between">
                <h3 class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-emerald-300/80">
                    <i data-lucide="wallet" class="size-4 text-emerald-400"></i>
                    <span>Minhas contas e cartões</span>
                </h3>
                <span id="caixaContasCountBadge" class="text-xs text-emerald-200/60 font-semibold">5 contas · 1 cartão</span>
            </div>

            <!-- Grid de Contas Bancárias da Caixa Preta -->
            <div id="caixaGridContas" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                <!-- Cards de contas injetados via JS -->
            </div>

            <!-- Card Especial do Cartão de Crédito -->
            <div id="caixaContainerCartoes" class="space-y-3">
                <!-- Cartões injetados via JS -->
            </div>

            <!-- Botão Adicionar Conta ou Cartão -->
            <button type="button" onclick="abrirModalAdicionarContaCartao()" 
                    class="w-full py-3.5 rounded-2xl border-2 border-dashed border-emerald-800/40 hover:border-emerald-500 bg-[#0d2015] hover:bg-[#122b1d] text-xs font-bold text-emerald-300 hover:text-white transition flex items-center justify-center gap-2 shadow-2xs">
                <i data-lucide="plus" class="size-4 text-emerald-400"></i>
                <span>Adicionar conta, poupança, investimento ou cartão</span>
            </button>
        </section>

        <!-- SEÇÃO: O QUE VOCÊ DEVE -->
        <section class="space-y-3.5">
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-300/80 flex items-center gap-2">
                    <i data-lucide="receipt" class="size-4 text-emerald-400"></i>
                    <span>O que você deve</span>
                </h3>
                <p class="text-xs text-gray-400 mt-0.5">Tudo que sai todo mês ou que ainda falta pagar</p>
            </div>

            <div id="caixaListaOQueVoceDeve" class="space-y-3">
                <!-- Itens injetados via JS -->
            </div>

            <!-- Barra Consolidada de Total Comprometido -->
            <div class="rounded-2xl border border-emerald-900/40 bg-[#0a1a11] p-4 space-y-2 shadow-2xs">
                <div class="flex items-center justify-between text-xs">
                    <span class="text-gray-300 font-medium">Total comprometido / mês</span>
                    <strong id="caixaTotalComprometidoTxt" class="text-sm font-black text-white valor-sensivel">R$ 1.370,00</strong>
                </div>
                <div class="h-2 w-full rounded-full bg-white/10 overflow-hidden">
                    <div id="caixaBarraComprometidoRenda" class="h-full bg-rose-500 rounded-full transition-all" style="width: 81%"></div>
                </div>
                <p id="caixaPctComprometidoRendaTxt" class="text-[11px] text-gray-400">
                    Você compromete <strong class="text-rose-400 font-extrabold">81%</strong> da sua renda com despesas fixas e acordos.
                </p>
            </div>
        </section>

        <!-- SEÇÃO: DESPESAS SÓ SUAS -->
        <section class="space-y-3.5">
            <div>
                <div class="flex items-center gap-2">
                    <i data-lucide="lock" class="size-3.5 text-emerald-400"></i>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-300/80">Despesas só suas</h3>
                </div>
                <p class="text-xs text-gray-400 mt-0.5">Privadas por padrão — mas você pode dividir com o parceiro se quiser</p>
            </div>

            <div id="caixaListaDespesasSoSuas" class="space-y-2.5">
                <!-- Injetado dinamicamente via JS -->
            </div>
        </section>

        <!-- SEÇÃO: SUAS METAS & PRODUTOS DE OLHO -->
        <section class="space-y-4">
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-300/80 flex items-center gap-2">
                    <i data-lucide="target" class="size-4 text-emerald-400"></i>
                    <span>Suas metas</span>
                </h3>
                <p class="text-xs text-gray-400 mt-0.5">Para onde vai seu dinheiro extra</p>
            </div>

            <!-- Grid de Metas da Caixa Preta -->
            <div id="caixaGridMetas" class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                <!-- Injetado via JS -->
            </div>

            <!-- Botão Criar Nova Meta -->
            <button type="button" onclick="abrirModalCriarMeta()" 
                    class="w-full py-3 rounded-2xl border border-emerald-900/50 bg-[#0d2015] hover:bg-[#122b1d] text-xs font-bold text-emerald-200 hover:text-white transition flex items-center justify-center gap-2 shadow-2xs">
                <i data-lucide="plus" class="size-4 text-emerald-400"></i>
                <span>Criar nova meta</span>
            </button>

            <!-- Subseção: Produtos de olho (Wishlist) -->
            <div class="space-y-3 pt-3 border-t border-emerald-900/30">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-xs font-bold text-white flex items-center gap-1.5">
                            <i data-lucide="link" class="size-3.5 text-emerald-400"></i>
                            <span>Produtos de olho (Wishlist)</span>
                        </h4>
                        <p class="text-[11px] text-gray-400">Cole links, acompanhe preços e crie metas para comprar sem culpa</p>
                    </div>
                    <button type="button" onclick="toggleFormProdutoOlho()" 
                            class="px-3 py-1.5 rounded-xl bg-emerald-950/80 hover:bg-emerald-900 border border-emerald-700/50 text-emerald-300 text-xs font-bold flex items-center gap-1 transition">
                        <i data-lucide="plus" class="size-3.5"></i>
                        <span>Adicionar produto</span>
                    </button>
                </div>

                <!-- Formulário Inline: Adicionar Produto de Olho -->
                <div id="formAdicionarProdutoOlho" class="hidden p-4 rounded-2xl bg-[#0a1b12] border border-emerald-700/50 space-y-3">
                    <div class="flex items-center justify-between">
                        <h5 class="text-xs font-bold text-emerald-300">Novo produto monitorado</h5>
                        <button type="button" onclick="toggleFormProdutoOlho()" class="text-gray-400 hover:text-white">
                            <i data-lucide="x" class="size-4"></i>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="space-y-1">
                            <label class="text-[11px] text-gray-300 font-medium">Nome do produto *</label>
                            <input type="text" id="prodOlhoNome" placeholder="Ex: Câmera Sony ZV-E10" 
                                   class="w-full px-3 py-2 rounded-xl bg-[#06140c] border border-emerald-900/60 text-xs text-white placeholder:text-gray-500 focus:border-emerald-500 focus:outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[11px] text-gray-300 font-medium">Preço aproximado (R$) *</label>
                            <input type="text" id="prodOlhoPreco" inputmode="decimal" placeholder="2.890,00" 
                                   class="w-full px-3 py-2 rounded-xl bg-[#06140c] border border-emerald-900/60 text-xs text-white placeholder:text-gray-500 focus:border-emerald-500 focus:outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="space-y-1">
                            <label class="text-[11px] text-gray-300 font-medium">Loja / Onde comprar</label>
                            <input type="text" id="prodOlhoLoja" placeholder="Ex: Mercado Livre, Amazon" 
                                   class="w-full px-3 py-2 rounded-xl bg-[#06140c] border border-emerald-900/60 text-xs text-white placeholder:text-gray-500 focus:border-emerald-500 focus:outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[11px] text-gray-300 font-medium">Link da web (URL)</label>
                            <input type="url" id="prodOlhoLink" placeholder="https://..." 
                                   class="w-full px-3 py-2 rounded-xl bg-[#06140c] border border-emerald-900/60 text-xs text-white placeholder:text-gray-500 focus:border-emerald-500 focus:outline-none">
                        </div>
                    </div>

                    <div class="flex gap-2 pt-1">
                        <button type="button" onclick="salvarNovoProdutoOlho()" 
                                class="flex-1 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-xs transition flex items-center justify-center gap-1.5">
                            <i data-lucide="check" class="size-3.5"></i>
                            <span>Salvar nos produtos de olho</span>
                        </button>
                        <button type="button" onclick="toggleFormProdutoOlho()" 
                                class="px-4 py-2.5 rounded-xl border border-white/15 bg-white/5 hover:bg-white/10 text-gray-300 text-xs font-bold">
                            Cancelar
                        </button>
                    </div>
                </div>

                <div id="caixaListaProdutosOlho" class="space-y-2.5">
                    <!-- Cards de wishlist injetados via JS -->
                </div>
            </div>
        </section>

        <!-- SEÇÃO: A RECEBER -->
        <section id="caixaSecaoAReceber" class="space-y-3">
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-300/80 flex items-center gap-2">
                    <i data-lucide="hand-coins" class="size-4 text-emerald-400"></i>
                    <span>A receber</span>
                </h3>
                <p id="caixaSubAReceber" class="text-xs text-gray-400 mt-0.5">Valores que o parceiro aceitou te pagar</p>
            </div>

            <div id="caixaListaAReceber" class="space-y-2">
                <!-- Injetado via JS -->
            </div>

            <!-- Link para histórico de ajudas -->
            <button type="button" onclick="seivaNotificar('Histórico de ajudas mútuas registradas em dia.', 'info', 'Ajudas Mútuas')" 
                    class="w-full p-3 rounded-2xl border border-emerald-900/40 bg-[#0d2015] hover:bg-[#122b1d] text-xs font-semibold text-emerald-200 hover:text-white transition flex items-center justify-between shadow-2xs">
                <span class="flex items-center gap-2">
                    <i data-lucide="clock" class="size-3.5 text-emerald-400"></i>
                    <span>Ajudas que eu recebi</span>
                </span>
                <span class="text-[11px] font-bold text-emerald-400">3 do parceiro →</span>
            </button>
        </section>

        <!-- SEÇÃO: SEUS GASTOS RECENTES -->
        <section class="space-y-3">
            <div class="flex items-center justify-between">
                <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-300/80 flex items-center gap-2">
                    <i data-lucide="lock" class="size-3.5 text-emerald-400"></i>
                    <span>Seus gastos recentes</span>
                </h3>
                <span class="text-[11px] text-gray-400">privados</span>
            </div>

            <div id="caixaListaGastosRecentes" class="space-y-2">
                <!-- Injetado via JS -->
            </div>

            <button type="button" onclick="abrirModalLancarGasto()" 
                    class="w-full py-3 rounded-2xl border border-emerald-900/50 bg-[#0d2015] hover:bg-[#122b1d] text-xs font-bold text-emerald-200 hover:text-white transition flex items-center justify-center gap-2 shadow-2xs">
                <i data-lucide="plus" class="size-4 text-emerald-400"></i>
                <span>Registrar novo gasto privado</span>
            </button>
        </section>

        <!-- SEÇÃO: O QUE ENTROU ESTE MÊS -->
        <section class="space-y-3.5">
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-300/80 flex items-center gap-2">
                <i data-lucide="trending-up" class="size-4 text-emerald-400"></i>
                <span>O que entrou este mês</span>
            </h3>

            <div id="caixaListaOQueEntrou" class="space-y-2">
                <!-- Injetado via JS -->
            </div>

            <!-- Total Recebido -->
            <div class="flex items-center justify-between p-3.5 rounded-2xl bg-[#0a1a11] border border-emerald-900/40 shadow-2xs">
                <div>
                    <span class="text-[11px] text-gray-400 font-medium block">Total recebido</span>
                    <strong id="caixaTotalRecebidoTxt" class="text-base font-black text-white valor-sensivel">R$ 1.700,00</strong>
                </div>
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-950 text-emerald-300 border border-emerald-700/50 text-xs font-bold">
                    <i data-lucide="check" class="size-3.5"></i> Em dia
                </span>
            </div>

            <button type="button" onclick="abrirModalRegistrarRecebimento()" 
                    class="w-full py-3 rounded-2xl border border-emerald-900/50 bg-[#0d2015] hover:bg-[#122b1d] text-xs font-bold text-emerald-200 hover:text-white transition flex items-center justify-center gap-2 shadow-2xs">
                <i data-lucide="plus" class="size-4 text-emerald-400"></i>
                <span>Registrar recebimento extra</span>
            </button>

            <!-- Botão Pedir Ajuda de Custo -->
            <button type="button" id="caixaBtnPedirAjudaParceiro" onclick="abrirModalPedirAjudaCusto()" 
                    class="w-full py-3.5 rounded-2xl bg-emerald-700 hover:bg-emerald-600 text-white font-extrabold text-xs transition shadow-soft flex items-center justify-center gap-2">
                <i data-lucide="handshake" class="size-4"></i>
                <span id="caixaBtnPedirAjudaTexto">Pedir ajuda de custo ao parceiro →</span>
            </button>
        </section>

        <!-- RODAPÉ DA CAIXA PRETA -->
        <footer class="flex flex-wrap items-center justify-between gap-3 border-t border-emerald-900/40 pt-4 text-[11px] text-gray-400">
            <span class="flex items-center gap-1.5">
                <i data-lucide="shield-check" class="size-3.5 text-emerald-400"></i>
                Isolamento Criptográfico e Confidencialidade Individual (LGPD)
            </span>
            <span class="font-bold text-emerald-400">
                Onde seu dinheiro cria raízes
            </span>
        </footer>
    </div>
</div>
