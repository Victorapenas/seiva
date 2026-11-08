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

## 🧪 Modo de Avaliação para Testes da Banca
No topo da tela você encontrará o menu suspenso **🧪 Modo Avaliação**:
- **Limpar Banco (Zero):** Deixa o banco de dados completamente vazio para testar o fluxo de criação de conta nova, cadastro de rendas e configuração inicial do Lar.
- **Carregar Duda & Ian (Demo):** Popula instantaneamente todas as contas, o Lar "Nosso Cantinho", rateios de aluguel/luz, acordos e metas com os dados reais apresentados nos slides.

---

## 📂 Estrutura de Documentação
- `docs/apresentacao-pi.html` — Slides oficiais da apresentação.
- `docs/RELATO_DE_CONDUCAO.md` — Relato de condução com a tabela comparativa (Previsto x Realizado).
- `docs/BAREMA_PI_ENTREGA_2.md` — Mapeamento de conformidade com os critérios do Barema.
- `banco-de-dados/` — Scripts SQL físicos, diagramas ER e modelos do Workbench.
