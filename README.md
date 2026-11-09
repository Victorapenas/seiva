# 🌿 SEIVA — Dinheiro Sem Tabu
> Sistema de Gestão Financeira Pessoal e Compartilhada para Lares e Casais  
> **Projeto Interdisciplinar (PI) — 4º Período | IFBA**

---

## 👥 Equipe do Projeto
- **Victor Hugo Santana Sousa** — Líder Técnico & Arquitetura
- **Maria Eduarda Lima** — Documentação do PI & Relato de Condução
- **Quételi** — Autenticação, Cadastro & Segurança (RF001)
- **Ian Marcos Rocha Santos** — Mesa de Acordos, Metas & Projetos (RF006, RF007, RF008)
- **Jhon Abner Santos Almeida** — Gestão do Lar & Rateio de Despesas (RF004, RF010)

---

## 🚀 Como Executar o Projeto Localmente

### Pré-requisitos
- PHP 8.2+ (instalado no XAMPP em `C:\xampp\php\php.exe` ou no PATH da sua máquina)
- Navegador moderno (Chrome, Edge, Firefox, Brave)

### 1. Iniciar o Servidor de Desenvolvimento
No terminal do PowerShell, entre na pasta do projeto:
```powershell
cd C:\Users\zenin\dev\pessoal\seiva
& "C:\xampp\php\php.exe" artisan serve
# ou se o PHP estiver configurado no PATH:
php artisan serve
```

### 2. Acessar a Aplicação
Abra seu navegador em:
👉 **[http://localhost:8000](http://localhost:8000)**

---

## ✨ Funcionalidades Principais do Sistema

1. **Autenticação & Segurança (RF001):**
   - Cadastro e login com fluxo fluido em página dedicada.
   - Políticas de senha forte e proteção de sessão com tokens.

2. **Caixa Preta Privada (RF002):**
   - Espaço seguro para gastos e economias pessoais individuais protegido por PIN numérico.
   - Total privacidade de itens individuais em relação aos outros membros do lar.

3. **Gestão do Lar & Rateio Inteligente (RF004, RF010):**
   - Criação de lares e gestão de participantes via convite.
   - Cálculo automático de rateio proporcional com base na renda cadastrada de cada membro.

4. **Mesa de Acordos & Votação (RF006, RF007):**
   - Criação de combinados financeiros do casal/república com status de negociação e histórico.

5. **Metas & Projetos Compartilhados (RF008):**
   - Metas de economia conjuntas e projetos com acompanhamento de progresso.

6. **Cobrador Diplomata (RF009):**
   - Sistema de lembretes amigáveis e avisos de pendências financeiras.

7. **Transparência & LGPD (RF011):**
   - Painel de privacidade, exportação de dados em JSON e revogação de permissões.

---

## 🛠️ Tecnologias Utilizadas
- **Backend:** PHP 8.2+ / Laravel 12
- **Banco de Dados:** SQLite (com suporte a MySQL/PostgreSQL via migrations)
- **Frontend:** Blade Templates com Tailwind CSS e componentes dinâmicos
- **Design System:** Estética SEIVA (paleta orgânica `#2e6b4f` / `#faf9f5`, tipografia limpa, transições fluidas)

---

## 📂 Estrutura de Documentação & Avaliação do PI
- `docs/apresentacao-pi.html` — Slides oficiais da apresentação acadêmica do projeto.
- `docs/RELATO_DE_CONDUCAO.md` — Relato de condução com a tabela comparativa (Previsto x Realizado) e distribuição das responsabilidades por membro.
- `docs/BAREMA_PI_ENTREGA_2.md` — Mapeamento detalhado de conformidade com todos os critérios do Barema de Avaliação.
- `banco-de-dados/` — Scripts SQL físicos, modelo relacional e diagramas conceituais/lógicos.
