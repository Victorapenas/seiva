{{-- 
    Modal: Termos de Uso e Política de Privacidade (RF011 / LGPD)
    Responsável Acadêmica: Maria Eduarda (Duda)
    Versão Oficial: SEIVA v2.0 (Segundo Semestre de 2026)
--}}
<div id="modalTermosUso" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalTermosUso')"></div>

    <div class="relative w-full sm:max-w-xl bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center border border-emerald-500/20">
                    <i data-lucide="file-text" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Termos de Uso e Privacidade</h3>
                    <p class="text-xs text-muted-foreground">SEIVA Versão 2.0 · Segundo Semestre 2026</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalTermosUso')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <div class="p-6 space-y-4 overflow-y-auto no-scrollbar text-xs leading-relaxed text-muted-foreground">
            <div class="p-3.5 rounded-2xl bg-emerald-50/50 dark:bg-emerald-950/20 border border-emerald-200/60 dark:border-emerald-800/40 text-foreground">
                <strong class="block text-xs font-black text-emerald-800 dark:text-emerald-300 mb-1">
                    Bordão Oficial: "Onde seu dinheiro cria raízes"
                </strong>
                <p class="text-[11px] text-muted-foreground leading-relaxed">
                    O SEIVA é uma plataforma financeira bilateral e individual desenvolvida para conciliar transparência mútua no lar e autonomia financeira pessoal.
                </p>
            </div>

            <div class="space-y-1.5">
                <h4 class="font-extrabold text-foreground text-xs uppercase tracking-wide">1. Privacidade e Blindagem da Caixa Preta</h4>
                <p>
                    A <strong>Caixa Preta</strong> é um ambiente criptografado e protegido por senha/PIN exclusivo do titular. Lançamentos, metas e saldos marcados como privados <strong>nunca são compartilhados</strong> com o parceiro, garantindo a sua autonomia e dignidade financeira.
                </p>
            </div>

            <div class="space-y-1.5">
                <h4 class="font-extrabold text-foreground text-xs uppercase tracking-wide">2. Área do Lar e Mesa de Acordos</h4>
                <p>
                    Gastos e metas compartilhadas na <strong>Área do Lar</strong> e na <strong>Mesa de Acordos</strong> são visíveis por ambos os membros do Lar. Qualquer cancelamento, estorno ou alteração gera registro em auditoria permanente para prevenir discórdias e desconfianças.
                </p>
            </div>

            <div class="space-y-1.5">
                <h4 class="font-extrabold text-foreground text-xs uppercase tracking-wide">3. Conformidade com a LGPD (Lei nº 13.709/2018)</h4>
                <p>
                    Em estrito respeito ao Artigo 18 da LGPD, você possui o direito inalienável de <strong>consultar</strong>, <strong>exportar</strong> em formato aberto e <strong>solicitar a exclusão definitiva</strong> de todos os seus dados cadastrais, financeiros e históricos a qualquer momento.
                </p>
            </div>

            <div class="space-y-1.5">
                <h4 class="font-extrabold text-foreground text-xs uppercase tracking-wide">4. Cobrador Diplomata</h4>
                <p>
                    O módulo Cobrador Diplomata tem finalidade exclusivamente pacífica e de auxílio de comunicação gentil entre casais, emitindo lembretes educados e descontraídos para apoiar o fluxo financeiro conjunto.
                </p>
            </div>

            <div class="p-3 rounded-2xl bg-muted/40 border border-border text-center text-[11px] text-muted-foreground font-semibold">
                Desenvolvimento Acadêmico Integrado · SEIVA v2.0 (2026)
            </div>
        </div>

        <div class="p-4 border-t border-border/60">
            <button type="button" onclick="fecharModalId('modalTermosUso')" class="w-full py-3 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs shadow-soft transition">
                Entendido e Aceito
            </button>
        </div>
    </div>
</div>
