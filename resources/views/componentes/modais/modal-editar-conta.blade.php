{{-- 
    Modal: Editar Conta Bancária (RF003)
    Responsáveis Acadêmicos: Victor Hugo / Jhon Abner
    Permite editar o nome da instituição, tipo de conta, saldo atualizado,
    cor e ícone identificador, além de permitir exclusão segura de contas.
    Bordão Oficial: "Onde seu dinheiro cria raízes"
--}}
<div id="modalEditarConta" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalEditarConta')"></div>

    <div class="relative w-full sm:max-w-md bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Drag handle mobile -->
        <div class="flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-10 h-1 rounded-full bg-muted"></div>
        </div>

        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center border border-emerald-500/20">
                    <i data-lucide="wallet" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Editar Conta Bancária</h3>
                    <p class="text-xs text-muted-foreground">Atualize nome, tipo ou remova a conta</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalEditarConta')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarEdicaoConta(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <input type="hidden" id="editContaId" value="">

            <!-- Nome da Conta / Banco -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Nome da Conta / Banco</label>
                <input type="text" id="editContaNome" required
                       placeholder="Ex: Nubank, Itaú Corrente, Poupança Caixa"
                       class="w-full h-11 px-4 rounded-2xl border border-border bg-card text-sm font-semibold text-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
            </div>

            <!-- Tipo da Conta -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Tipo de Conta</label>
                <select id="editContaTipo" required
                        class="w-full h-11 px-3.5 rounded-2xl border border-border bg-card text-xs font-bold text-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
                    <option value="corrente">Conta Corrente</option>
                    <option value="poupanca">Conta Poupança</option>
                    <option value="cartao">Cartão de Crédito</option>
                    <option value="carteira">Dinheiro em Espécie / Carteira</option>
                </select>
            </div>

            <!-- Saldo Atual -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Saldo Atual (R$)</label>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-sm font-bold text-muted-foreground">R$</span>
                    <input type="number" step="0.01" id="editContaSaldo" required
                           placeholder="0,00"
                           class="w-full h-11 pl-10 pr-3 rounded-2xl border border-border bg-card text-base font-black text-foreground focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition shadow-2xs">
                </div>
            </div>

            <!-- Cor Identificadora -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Cor da Identidade Visual</label>
                <div class="flex items-center gap-2 pt-1" id="editContaCoresGrid">
                    <button type="button" onclick="selecionarCorContaEdit(this, '#820ad1')" class="size-8 rounded-full border-2 border-transparent transition shadow-2xs hover:scale-110" style="background-color: #820ad1" title="Roxo Nubank"></button>
                    <button type="button" onclick="selecionarCorContaEdit(this, '#008050')" class="size-8 rounded-full border-2 border-transparent transition shadow-2xs hover:scale-110" style="background-color: #008050" title="Verde SEIVA"></button>
                    <button type="button" onclick="selecionarCorContaEdit(this, '#ec7000')" class="size-8 rounded-full border-2 border-transparent transition shadow-2xs hover:scale-110" style="background-color: #ec7000" title="Laranja Itaú"></button>
                    <button type="button" onclick="selecionarCorContaEdit(this, '#003399')" class="size-8 rounded-full border-2 border-transparent transition shadow-2xs hover:scale-110" style="background-color: #003399" title="Azul Caixa"></button>
                    <button type="button" onclick="selecionarCorContaEdit(this, '#11b76a')" class="size-8 rounded-full border-2 border-transparent transition shadow-2xs hover:scale-110" style="background-color: #11b76a" title="Verde PicPay"></button>
                    <button type="button" onclick="selecionarCorContaEdit(this, '#0ea5e9')" class="size-8 rounded-full border-2 border-transparent transition shadow-2xs hover:scale-110" style="background-color: #0ea5e9" title="Azul Mercado Pago"></button>
                </div>
                <input type="hidden" id="editContaCor" value="#10b981">
            </div>

            <!-- Botões de Ação: Salvar e Excluir -->
            <div class="pt-2 flex flex-col sm:flex-row gap-2">
                <button type="submit" 
                        class="flex-1 py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs shadow-soft transition flex items-center justify-center gap-2">
                    <i data-lucide="check" class="size-4"></i>
                    <span>Salvar Alterações</span>
                </button>
                <button type="button" onclick="executarExcluirContaModal()" 
                        class="py-3.5 px-4 rounded-2xl border border-rose-300 dark:border-rose-800 bg-rose-50/50 dark:bg-rose-950/20 hover:bg-rose-100 text-rose-700 dark:text-rose-300 font-extrabold text-xs transition flex items-center justify-center gap-1.5 shadow-2xs">
                    <i data-lucide="trash-2" class="size-4"></i>
                    <span>Excluir</span>
                </button>
            </div>
        </form>
    </div>
</div>
