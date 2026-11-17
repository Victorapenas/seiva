# Nota Técnica: Decisões de Modelagem e Escopo - MVP SEIVA

Este documento detalha as decisões técnicas tomadas na modelagem do banco de dados (Diagrama de Classes, Modelo Físico ER e DDL) do sistema SEIVA para a "Entrega I", considerando o alinhamento com o **Documento de Requisitos** e o **Protótipo (Frontend)**.

## 1. Escopo e Exclusões (Aderência ao MVP)

Conforme estabelecido na seção 4.3 do documento de requisitos e para atender de forma estrita aos RF001–RF008 e RF012 do MVP, os seguintes itens presentes em telas e protótipos de alta fidelidade foram **excluídos** da modelagem oficial do banco de dados:

*   **Score Financeiro / IA (Mentor SEIVA):** Retirado do diagrama de classes e ER. Componentes do front como `ScoreGauge` e `ScoreCard` são alimentados por regras do front e não terão suporte no BD desta entrega.
*   **Cofre de Documentos:** Não foram criadas tabelas de upload ou gerenciamento de arquivos de longo prazo. O único elemento de anexo no BD é a flag simples `comprovante` na tabela de despesas.
*   **Open Finance / Pix Automático:** Sem integrações na modelagem (as tabelas refletem apenas inserção e atualização manuais ou confirmações do próprio app).
*   **Relatórios em PDF:** Como apontado no documento, todos os dados devem ser extraídos das tabelas base (via agregações de Transações) para os dashboards; nenhuma tabela extra para "geração de PDF" foi criada.

## 2. Decisões de Modelagem (Banco de Dados e Laravel)

### Convenções do Framework (Laravel 11)
Para garantir aderência com o Eloquent ORM, toda a modelagem seguiu os padrões estritos do Laravel:
*   As chaves primárias (`PK`) usam o tipo `BIGINT UNSIGNED AUTO_INCREMENT` (o famoso `id`).
*   As chaves estrangeiras (`FK`) estão nomeadas em `snake_case` (ex: `usuario_id`, `lar_id`).
*   O nome das tabelas (no script SQL e modelo físico) utiliza `snake_case` e plural.
*   Os campos mágicos de auditoria `created_at` e `updated_at` (`TIMESTAMP`) foram incluídos em praticamente todas as entidades.

### RF002 - Caixa Preta (Segurança dos Dados)
*   Na tabela `registros_caixa_preta`, os dados sensíveis como título, valor e conta destino estão declarados como `VARBINARY` (e não como `VARCHAR` ou `DECIMAL`).
*   Isso garante que o backend possa salvar o resultado da criptografia *AES-256-GCM* bruto sem problemas de encoding. Adicionalmente, foram incluídos campos obrigatórios para o funcionamento deste algoritmo de criptografia autenticada: `nonce` (o vetor de inicialização - IV) e `tag_autenticacao` (tag MAC).

### RF006 - Mesa de Acordos e Divisões
*   A "Mesa de Acordos" é uma abstração forte no front que resolve a distribuição de custos.
*   Na modelagem, foi dividida nas tabelas `regras_divisao` (contendo o tipo: igualitária, customizada) e `regras_divisao_detalhes` (quem paga qual % de fato).
*   Existe um `UNIQUE INDEX` na regra ativa, pois apenas uma regra geral de divisão pode prevalecer como a ativa num determinado momento por Lar.
*   Despesas comuns inseridas num lar geram o vínculo através da entidade abstrata "Participação na Despesa" (`participacoes_despesas`). Se uma conta foi lançada, é ali que se diz se o membro A ou B já pagou sua respectiva parte.

### RF005 - Cobrador Diplomata (Notificações Neutras)
*   A tabela `cobrancas` cuida exclusivamente dos envios de lembretes aos parceiros, conforme definido no RF. Ela rastreia qual o canal (`app`, `whatsapp`), o estado do alerta e quem é o remetente/destinatário, permitindo que a cron do Laravel gerencie esses envios automaticamente, agindo como o mediador neutro exigido no projeto.

### Polimorfismo e Pertencimento Opcional
*   **Projetos e Metas:** O documento permite a existência de metas pessoais ou projetos pessoais. Logo, nas tabelas `metas` e `projetos`, os relacionamentos para `lar_id` ou `usuario_id` são **mutuamente opcionais**, regidos por uma constraint SQL (`CHECK`) garantindo que a meta tenha sempre pelo menos um dono (o lar ou o indivíduo).
*   **Transações:** A tabela de transações pode existir em contexto pessoal (`lar_id` é nulo) ou contexto do Lar.

### Meta do Lar - Conta de Destino e Responsável
*   A partir do levantamento do protótipo (`seiva-data.ts`), foram incluídos na tabela `metas` os campos `pix_destino` e `responsavel_usuario_id` (FK opcional para `usuarios`), usados apenas quando a meta é compartilhada pelo Lar. Isso estava presente nas telas do protótipo (`pixDestino`, `responsavelConta`) e havia ficado de fora da primeira versão do modelo.

## 3. Revisão de Consistência (Diagrama de Classes x Modelo ER x Script SQL)
Nesta rodada de revisão, os três artefatos foram conferidos entre si e contra este documento. Resultado: as 24 tabelas/classes batem 1:1 nos três arquivos, sem entidade órfã ou divergente. Foram encontradas e corrigidas as seguintes inconsistências pontuais:

*   **Padronização de enum:** `acordos.status` estava como `'Ativo' / 'Em negociacao'` (com maiúscula e espaço), destoando da convenção `snake_case` minúsculo usada em todos os outros enums do banco (`pendente`, `aceito` etc.). Corrigido para `'ativo' / 'em_negociacao'`.
*   **Relacionamentos implícitos não desenhados:** o Modelo ER e o Diagrama de Classes tinham várias FKs que apontam para `usuarios` (ex.: `lares.criado_por`, `convites_lar.convidado_por`, `despesas_lares.registrada_por`, `propostas.autor_id`, `acordo_participantes.usuario_id`, entre outras) sem a linha de relacionamento correspondente desenhada — a FK existia no script SQL, mas não aparecia visualmente nos diagramas. Isso não é um erro de banco, mas prejudicava a leitura do diagrama por terceiros (orientador, banca). Todas essas linhas foram adicionadas.
*   **Relação dupla mal representada:** `cobrancas` tem duas FKs distintas para `usuarios` (`criada_por` e `destinatario_id`), mas só havia uma linha de relacionamento combinada no ER/Classes. Separado em duas linhas (`cria` e `é destinatário de`) para não sugerir que é uma única relação.
*   **Nota de compatibilidade:** adicionado comentário no cabeçalho do script SQL avisando que os `CHECK CONSTRAINT` (usados em `metas` e `projetos` para garantir dono obrigatório) só são de fato aplicados a partir do MySQL 8.0.16 — em versões anteriores do MySQL 8 a sintaxe é aceita mas a regra é ignorada silenciosamente.

## 4. Considerações do Protótipo
O protótipo no `seiva-data.ts` foi muito útil para entender a estrutura de Categorias, Acordos e Propostas. Em especial o fluxo de aprovação de propostas onde membros discutem uma meta ou dívida (Negociações). O banco modelado absorveu as fases (Proposta → Negociação Rodada → Acordo Efetivado) a partir do frontend existente.
