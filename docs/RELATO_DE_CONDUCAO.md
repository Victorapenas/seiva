# Relato de Condução do Trabalho — Projeto SEIVA
**Projeto Interdisciplinar (PI) — 4º Período | IFBA**  
**Data da Entrega 2:** 21 de Novembro de 2026  
**Orientador:** Prof. Júlio  
**Equipe:**
- Victor Hugo Santana Sousa (Líder Técnico & Arquitetura)
- Maria Eduarda Lima (Documentação & Relato de Condução)
- Quételi (Autenticação, Cadastro & Segurança)
- Ian Marcos Rocha Santos (Mesa de Acordos, Metas & Projetos)
- Jhon Abner Santos Almeida (Gestão de Lares & Rateio de Despesas)

---

## 1. Introdução e Contexto da Entrega 2
O projeto **SEIVA (Dinheiro Sem Tabu)** visa resolver os conflitos financeiros cotidianos em lares e casais, equilibrando a transparência necessária para contas conjuntas com a privacidade essencial da vida individual (através da inovadora *Caixa Preta*).

Nesta **Entrega 2**, a equipe realizou a migração completa do protótipo estático para uma **aplicação real desenvolvida em PHP (Laravel 12) com banco de dados físico SQLite**, cobrindo os 11 Requisitos Funcionais essenciais aprovados pela orientação.

---

## 2. Tabela Comparativa: Itens Previstos vs. Realizados (Barema Obrigatório)

| Requisito / Item Previsto | Responsável | Status | Justificativa / Consideração Técnica |
|---|---|---|---|
| **RF001 — Cadastro e Autenticação (UC01, UC02, UC03)** | Quételi / Victor | ✅ **Realizado** | Implementado cadastro completo com renda declarada, banco principal e senha com hash seguro (`bcrypt`). |
| **RF002 — Caixa Preta Privada (UC04)** | Victor Hugo | ✅ **Realizado** | Área confidencial protegida por PIN secundário (4 dígitos). Gastos e reservas ficam invisíveis no extrato comum do lar. |
| **RF003 — Inserção e Importação (UC05, UC06)** | Victor / Jhon | ✅ **Realizado** | CRUD de contas bancárias e carteiras, categorias padronizadas e lançamento de transações financeiras (entradas/saídas). |
| **RF004 — Criar Lar e Convites (UC07, UC08, UC09)** | Jhon Abner | ✅ **Realizado** | Criação de ambientes familiares compartilhados, geração de tokens de convite e gestão de membros com papéis de Administrador/Membro. |
| **RF005 — Cobrador Diplomata (UC14)** | Victor Hugo | ✅ **Realizado** | Notificações e lembretes amigáveis para pendências de rateio com templates gentis ("Diplomático", "Descontraído") e envio da chave PIX. |
| **RF006 — Mesa de Acordos (UC10)** | Ian Marcos | ✅ **Realizado** | Sistema de propostas colaborativas entre parceiros com votação consensual ("Apoiar" / "Recusar") antes da efetivação de compras. |
| **RF007 — Criar Metas do Lar (UC11)** | Ian Marcos | ✅ **Realizado** | Cofres virtuais com valor alvo, valor atual, percentual de progresso e possibilidade de depósitos parciais. |
| **RF008 — Gerenciar Projetos (UC11)** | Ian Marcos | ✅ **Realizado** | Estruturação de projetos do casal (ex: reformas, viagens) com itens estimados e controle de itens comprados. |
| **RF009 — Painéis Consolidados (UC12, UC13)** | Victor Hugo | ✅ **Realizado** | Dashboard completo com cálculo automático de Saldo Livre vs. Comprometido, fluxo de caixa e gráfico interativo de despesas por categoria. |
| **RF010 — Lançar Despesa do Lar (UC10)** | Jhon Abner | ✅ **Realizado** | Rateio inteligente com suporte tanto à divisão **50%/50%** quanto à divisão **Proporcional à renda** dos moradores, com quitação individual. |
| **RF011 — Gestão de Conta e LGPD** | Victor Hugo | ✅ **Realizado** | Atendimento pleno aos direitos do titular (LGPD - Lei 13.709/2018): edição de perfil, **exportação de dados em arquivo JSON** e opção de anonimização/exclusão da conta. |

---

## 3. Diferenciais do Projeto em Relação ao Mercado
Diferente dos aplicativos tradicionais de finanças (como Mobills, Organizze ou Guiabolso), o SEIVA traz três diferenciais exclusivos:
1. **Cobrador Diplomata:** Transforma a cobrança de contas entre casais em uma comunicação afetuosa e sem atritos, reduzindo discussões domésticas.
2. **Caixa Preta (Privacidade Garantida):** Permite que cada morador mantenha gastos pessoais e surpresas (ex: presentes de aniversário) sem comprometer o orçamento do lar.
3. **Rateio Proporcional Real:** Calcula o esforço financeiro justo de acordo com a renda líquida declarada de cada membro do lar, evitando sobrecargas unilaterais.

---

## 4. Considerações Finais e Melhorias Futuras
Para as próximas etapas do projeto e evolução acadêmica/profissional:
- **Integração Open Finance:** Conexão direta via APIs bancárias regulamentadas pelo Banco Central para conciliação automática de extratos.
- **Notificações via WhatsApp/Push:** Envio dos lembretes do Cobrador Diplomata diretamente no aplicativo de mensagens instantâneas.
- **Inteligência Artificial Preditiva:** Sugestões automáticas de economia nas despesas variáveis do lar antes do fechamento do mês.
