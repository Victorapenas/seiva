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
            <!-- Banner Acadêmico de Alto Contraste -->
            <div class="p-4 rounded-2xl bg-emerald-900 text-white shadow-xs space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 rounded-full bg-emerald-800 text-[10px] font-black text-emerald-200 uppercase tracking-wider">Projeto Acadêmico</span>
                    <span class="text-xs font-black text-emerald-100">SEIVA v2.0 · 2º Semestre de 2026</span>
                </div>
                <strong class="block text-sm font-black text-white">
                    "Onde seu dinheiro cria raízes"
                </strong>
                <p class="text-xs text-emerald-100/90 leading-relaxed">
                    Este software é um <strong>Trabalho Prático e Interdisciplinar de Faculdade / Escola</strong>, desenvolvido exclusivamente para fins de estudo acadêmico, experimentação pedagógica e avaliação semestral. Não constitui instituição bancária nem presta serviços financeiros reais.
                </p>
            </div>

            <!-- Ficha Técnica dos Alunos e Orientadores -->
            <div class="p-3.5 rounded-2xl border border-border bg-muted/40 space-y-2">
                <h4 class="font-black text-foreground text-xs uppercase tracking-wide flex items-center gap-1.5">
                    <i data-lucide="graduation-cap" class="size-4 text-emerald-700 dark:text-emerald-400"></i>
                    Corpo Discente e Docente Envolvido
                </h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[11px]">
                    <div class="p-2 rounded-xl bg-card border border-border/60">
                        <span class="text-[10px] text-muted-foreground font-bold block uppercase">Alunos Desenvolvedores</span>
                        <ul class="font-bold text-foreground list-disc list-inside space-y-0.5 mt-1">
                            <li>Ian Marcos</li>
                            <li>Maria Eduarda (Duda)</li>
                            <li>Jhon Abner</li>
                            <li>Victor Hugo</li>
                        </ul>
                    </div>
                    <div class="p-2 rounded-xl bg-card border border-border/60 flex flex-col justify-between">
                        <div>
                            <span class="text-[10px] text-muted-foreground font-bold block uppercase">Orientação Pedagógica</span>
                            <p class="font-bold text-foreground mt-1">Professores e Coordenadores do Curso</p>
                            <p class="text-muted-foreground text-[10px] mt-0.5">Projeto Integrador de Software</p>
                        </div>
                        <span class="text-[10px] font-black text-emerald-700 dark:text-emerald-400">Versão 2.0 (2º Semestre 2026)</span>
                    </div>
                </div>
            </div>

            <!-- Termos e Diretrizes Pedagógicas -->
            <div class="space-y-1.5">
                <h4 class="font-extrabold text-foreground text-xs uppercase tracking-wide">1. Natureza do Projeto e Simulação Educacional</h4>
                <p>
                    A plataforma SEIVA foi concebida por estudantes para demonstrar a aplicação de Engenharia de Software e Design de Interação na conciliação entre finanças compartilhadas do casal e autonomia individual. Todos os dados financeiros e transações são fictícios ou simulados para o escopo escolar.
                </p>
            </div>

            <div class="space-y-1.5">
                <h4 class="font-extrabold text-foreground text-xs uppercase tracking-wide">2. Privacidade e Blindagem da Caixa Preta</h4>
                <p>
                    A <strong>Caixa Preta</strong> é um ambiente criptografado e protegido por senha/PIN exclusivo do titular. Lançamentos, metas e saldos marcados como privados <strong>nunca são compartilhados</strong> com o parceiro, demonstrando arquiteturalmente a separação de escopos e a preservação da dignidade financeira.
                </p>
            </div>

            <div class="space-y-1.5">
                <h4 class="font-extrabold text-foreground text-xs uppercase tracking-wide">3. Área do Lar e Mesa de Acordos</h4>
                <p>
                    Gastos e metas compartilhadas na <strong>Área do Lar</strong> e na <strong>Mesa de Acordos</strong> são visíveis por ambos os membros do Lar. Qualquer cancelamento, estorno ou alteração gera registro em trilha de auditoria permanente para fins didáticos de prevenção de atritos.
                </p>
            </div>

            <div class="space-y-1.5">
                <h4 class="font-extrabold text-foreground text-xs uppercase tracking-wide">4. Conformidade Simula da LGPD (Lei nº 13.709/2018)</h4>
                <p>
                    Em consonância com o Artigo 18 da LGPD, o projeto implementa os direitos de <strong>consulta de dados</strong>, <strong>exportação em formato aberto (CSV)</strong> e <strong>direito ao esquecimento</strong> (exclusão e anonimização de cadastro a pedido do titular).
                </p>
            </div>

            <div class="space-y-1.5">
                <h4 class="font-extrabold text-foreground text-xs uppercase tracking-wide">5. Cobrador Diplomata</h4>
                <p>
                    O módulo Cobrador Diplomata é um recurso didático de comunicação não violenta para lembrar datas de rateio com mensagens gentis e bem-humoradas.
                </p>
            </div>
        </div>

        <div class="p-4 border-t border-border/60">
            <button type="button" onclick="fecharModalId('modalTermosUso')" class="w-full py-3 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs shadow-soft transition">
                Entendido e Aceito
            </button>
        </div>
    </div>
</div>
