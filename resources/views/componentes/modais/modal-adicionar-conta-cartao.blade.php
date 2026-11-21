{{-- 
    Modal: Adicionar conta ou cartão (Protótipo Imagem 15)
    Permite cadastrar novas contas correntes, poupanças, investimentos e cartões de crédito com limites
--}}
<div id="modalAdicionarContaCartao" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="fecharModalId('modalAdicionarContaCartao')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-3 pb-4 border-b border-border/60 flex items-center justify-between">
            <h3 class="text-base font-extrabold text-foreground">Adicionar conta ou cartão</h3>
            <button type="button" onclick="fecharModalId('modalAdicionarContaCartao')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarNovaContaCartao(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Tipo em Chips (4 Opções) -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-foreground">Tipo</label>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" onclick="selecionarTipoContaCartao(this, 'corrente')" class="chip-tipo-conta active py-2.5 px-3 rounded-2xl border border-emerald-600 bg-emerald-800 text-white font-bold text-xs transition text-center">
                        Conta corrente
                    </button>
                    <button type="button" onclick="selecionarTipoContaCartao(this, 'poupanca')" class="chip-tipo-conta py-2.5 px-3 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition text-center">
                        Poupança
                    </button>
                    <button type="button" onclick="selecionarTipoContaCartao(this, 'cartao')" class="chip-tipo-conta py-2.5 px-3 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition text-center">
                        Cartão de crédito
                    </button>
                    <button type="button" onclick="selecionarTipoContaCartao(this, 'investimento')" class="chip-tipo-conta py-2.5 px-3 rounded-2xl border border-border bg-card text-muted-foreground hover:text-foreground font-bold text-xs transition text-center">
                        Investimento
                    </button>
                </div>
                <input type="hidden" id="novaContaTipo" value="corrente">
            </div>

            <!-- Banco / Instituição -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Banco</label>
                <div class="relative">
                    <select id="novaContaBanco" onchange="aoMudarBancoSelecionado(this.value)" class="w-full appearance-none rounded-2xl border border-border bg-background px-4 py-2.5 text-xs text-foreground focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary shadow-2xs">
                        <option value="Nubank">Nubank</option>
                        <option value="Banco Inter">Banco Inter</option>
                        <option value="Itaú">Itaú Unibanco</option>
                        <option value="Bradesco">Bradesco</option>
                        <option value="Santander">Santander</option>
                        <option value="Caixa Econômica">Caixa Econômica Federal</option>
                        <option value="PicPay">PicPay</option>
                        <option value="Mercado Pago">Mercado Pago</option>
                        <option value="C6 Bank">C6 Bank</option>
                        <option value="Dinheiro">Dinheiro em espécie</option>
                        <option value="Outro">Outro banco</option>
                    </select>
                    <div class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-muted-foreground">
                        <i data-lucide="chevron-down" class="size-4"></i>
                    </div>
                </div>
            </div>

            <!-- Nome da Conta -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Nome da conta ou cartão</label>
                <input type="text" id="novaContaNome" required class="w-full rounded-2xl border border-border bg-background px-4 py-2.5 text-xs text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary shadow-2xs" placeholder="Ex: Nubank principal">
            </div>

            <!-- Saldo ou Limite -->
            <div class="space-y-1.5">
                <label id="labelNovaContaValor" class="text-xs font-bold text-foreground">Saldo atual</label>
                <div class="relative flex items-center rounded-2xl border border-border bg-background px-4 py-2.5 shadow-2xs focus-within:border-primary focus-within:ring-1 focus-within:ring-primary transition">
                    <span class="text-xs font-bold text-muted-foreground select-none pr-2">R$</span>
                    <input type="text" id="novaContaValor" inputmode="decimal" class="w-full bg-transparent text-sm font-extrabold text-foreground focus:outline-none" placeholder="0,00">
                </div>
            </div>

            <!-- Campo Dia de Vencimento (visível se Cartão de Crédito) -->
            <div id="campoNovaContaVencimento" class="space-y-1.5 hidden">
                <label class="text-xs font-bold text-foreground">Dia do vencimento da fatura</label>
                <input type="number" id="novaContaVencimento" min="1" max="31" class="w-full rounded-2xl border border-border bg-background px-4 py-2.5 text-xs text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none shadow-2xs" placeholder="Ex: 12">
            </div>

            <!-- Botão Adicionar -->
            <div class="pt-3">
                <button type="submit" class="w-full py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm transition shadow-soft flex items-center justify-center gap-2">
                    <i data-lucide="plus" class="size-4"></i>
                    <span>Adicionar</span>
                </button>
            </div>
        </form>
    </div>
</div>
