# SEIVA — Gestão Financeira Pessoal e Compartilhada

**Projeto Integrador — 4º Período — Análise e Desenvolvimento de Sistemas**  
Instituto Federal de Educação, Ciência e Tecnologia da Bahia — Campus Eunápolis  
Orientador: Prof. Júlio Oliveira  
Semestre: 2026.2

---

## Equipe

| Integrante | Responsabilidade Principal |
|---|---|
| Victor Hugo Santana Sousa | Arquitetura geral, backend, Caixa Preta, Cobrador Diplomata, infraestrutura |
| Ian Marcos Rocha Santos | Mesa de Acordos, Metas e Projetos (RF006, RF007, RF008) |
| Jhon Abner Santos Almeida | Gestão do Lar, rateio de despesas e convites (RF004, RF010) |
| Maria Eduarda Lima Silveira | Perfil do usuário, LGPD e documentação do PI (RF011) |
| Quételi Tourinho de Oliveira | Autenticação, cadastro e segurança de acesso (RF001) |

---

## Sobre o Projeto

O SEIVA é uma plataforma web que resolve um problema recorrente em lares e relacionamentos: a dificuldade de organizar finanças compartilhadas sem abrir mão da privacidade individual. O sistema permite que dois ou mais moradores de um mesmo lar acompanhem despesas conjuntas, definam regras de rateio e estabeleçam metas em comum, enquanto cada um mantém sua vida financeira pessoal protegida em um espaço chamado **Caixa Preta**, acessível apenas mediante PIN.

O projeto foi desenvolvido do zero durante o semestre, partindo de um protótipo no Figma e evoluindo para uma aplicação web funcional com banco de dados real.

---

## Funcionalidades Implementadas

- **RF001 — Cadastro, Autenticação e Recuperação de Senha:** registro de usuário com renda declarada, banco principal, senha criptografada (bcrypt), fluxo completo de recuperação de senha por e-mail com token temporário (60 min) e controle de sessão seguro.
- **RF002 — Caixa Preta Privada:** espaço protegido por PIN de quatro dígitos para lançamentos, metas e reservas pessoais que ficam invisíveis ao parceiro.
- **RF003 — Lançamentos e Contas Bancárias:** cadastro e edição de contas bancárias/carteiras, registro de transações de entrada e saída com categorias.
- **RF004 — Criar Lar e Convites:** criação de ambiente compartilhado (Lar), geração de convite por e-mail com token único e aceite pelo parceiro.
- **RF005 — Cobrador Diplomata:** sistema de lembretes amigáveis para pendências de rateio, com templates de mensagem (Diplomático / Descontraído) e chave PIX.
- **RF006 — Mesa de Acordos:** criação de propostas financeiras compartilhadas com votação bilateral (Apoiar / Recusar) antes da efetivação.
- **RF007 — Metas do Lar:** cofres virtuais com valor alvo, progresso percentual e depósitos parciais.
- **RF008 — Projetos e Produtos de Olho:** listas de itens desejados com estimativas de valor, segmentadas entre individuais e do Lar.
- **RF009 — Painel Consolidado (Dashboard):** saldo livre vs. comprometido, fluxo de caixa mensal e saúde financeira calculada automaticamente.
- **RF010 — Despesas do Lar:** lançamento de gastos compartilhados com divisão igualitária (50/50) ou proporcional à renda de cada membro.
- **RF011 — Perfil e LGPD:** edição de perfil, foto de avatar, exportação de dados em JSON e opção de exclusão/anonimização da conta (Lei 13.709/2018).

---

## Como Executar o Projeto

### Requisitos

- PHP 8.2 ou superior
- Composer (gerenciador de dependências do PHP)
- XAMPP (ou qualquer instalação local de PHP — o PHP do XAMPP pode ser usado diretamente)
- Navegador moderno (Chrome, Firefox, Edge)

> O projeto usa **SQLite** como banco de dados. Nenhuma configuração de servidor de banco de dados é necessária — o arquivo do banco é gerado automaticamente dentro da pasta `database/`.

---

### Passo a Passo para Iniciar (XAMPP)

**1. Clone o repositório**

```bash
git clone https://github.com/seu-usuario/seiva.git
cd seiva
```

**2. Instale as dependências PHP**

Se o PHP do XAMPP estiver em `C:\xampp\php\`:

```powershell
& "C:\xampp\php\php.exe" "C:\xampp\php\composer.phar" install
```

Ou, se o Composer estiver no PATH:

```bash
composer install
```

**3. Configure o arquivo de ambiente**

```bash
cp .env.example .env
```

Abra o arquivo `.env` e confirme que as linhas de banco de dados estão assim:

```
DB_CONNECTION=sqlite
```

As demais linhas de banco (`DB_HOST`, `DB_DATABASE`, etc.) podem permanecer comentadas ou removidas — o SQLite não as usa.

**4. Gere a chave da aplicação**

```powershell
& "C:\xampp\php\php.exe" artisan key:generate
```

**5. Crie as tabelas do banco de dados**

```powershell
& "C:\xampp\php\php.exe" artisan migrate
```

Isso cria o arquivo `database/database.sqlite` automaticamente.

**6. (Opcional) Popule com dados de demonstração**

```powershell
& "C:\xampp\php\php.exe" artisan db:seed
```

Isso cria usuários e dados de exemplo para facilitar a avaliação do sistema.

**7. Inicie o servidor**

```powershell
& "C:\xampp\php\php.exe" artisan serve
```

Acesse: [http://localhost:8000](http://localhost:8000)

---

### Solução de Problemas Comuns

**"Class not found" ou erros de autoload:**
```powershell
& "C:\xampp\php\php.exe" composer.phar dump-autoload
```

**Erros de permissão em `storage/` ou `bootstrap/cache/`:**

No Windows, isso raramente acontece. Caso ocorra, verifique se a pasta `storage/` não está marcada como somente leitura nas propriedades do Windows Explorer.

**Banco de dados não encontrado:**

Se o arquivo `database/database.sqlite` não existir, crie-o manualmente:
```powershell
New-Item database/database.sqlite
& "C:\xampp\php\php.exe" artisan migrate
```

---

## Estrutura de Pastas

A estrutura segue o padrão do framework Laravel. Abaixo, uma explicação de cada pasta relevante para quem não conhece o framework:

```
seiva/
├── app/
│   ├── Http/
│   │   └── Controllers/     # Recebem as requisições HTTP e retornam respostas
│   └── Models/              # Representam as tabelas do banco de dados (Eloquent ORM)
│
├── database/
│   ├── migrations/          # Definem a estrutura das tabelas (criadas com artisan migrate)
│   ├── seeders/             # Populam o banco com dados iniciais/de demonstração
│   └── database.sqlite      # Arquivo do banco de dados (gerado automaticamente)
│
├── resources/
│   └── views/               # Arquivos de interface (Blade Templates — equivalente a HTML+PHP)
│       ├── auth/            # Telas de login e cadastro (Quételi)
│       ├── modulos/         # Painéis de cada funcionalidade (Lar, Metas, Acordos, etc.)
│       └── componentes/     # Elementos reutilizáveis: sidebar, modais, topbar
│
├── routes/
│   └── web.php              # Define todas as rotas da aplicação (URLs e seus controllers)
│
├── config/                  # Arquivos de configuração do Laravel (banco, sessão, e-mail, etc.)
├── public/                  # Pasta pública: index.php (ponto de entrada), CSS, JS e imagens
├── storage/                 # Logs, arquivos gerados e cache de sessão (não versionar conteúdo)
├── bootstrap/               # Inicialização do framework; cache/ é gerado automaticamente
├── vendor/                  # Dependências instaladas pelo Composer (não versionar)
│
├── artisan                  # CLI do Laravel: execute comandos como migrate, serve, tinker
├── composer.json            # Lista de dependências PHP e configurações do projeto
├── composer.lock            # Versões exatas das dependências (garantia de reprodutibilidade)
├── .env                     # Variáveis de ambiente locais (não versionar — contém senhas)
├── .env.example             # Modelo do .env sem dados sensíveis (versionar este)
└── package.json             # Dependências JavaScript (Vite, Tailwind — se utilizadas)
```

---

## Documentação do Projeto

A documentação completa do Projeto Integrador está organizada na pasta `docs/`:

```
docs/
├── apresentacoes/
│   ├── apresentacao_slides_pi.pdf       # Slides da apresentação acadêmica
│   └── apresentacao_interativa.html     # Versão interativa dos slides
├── diagramas/
│   ├── diagrama_casos_de_uso.pdf        # Diagrama de Casos de Uso (UML)
│   ├── diagrama_conceitual_bd.pdf       # Modelo Conceitual do Banco de Dados
│   └── diagrama_entidade_relacionamento.pdf  # Modelo Entidade-Relacionamento
└── academicos/
    └── especificacao_requisitos_v2.pdf  # Documento de Requisitos Funcionais e Não Funcionais
```

Os documentos entregues à coordenação (Relatório Técnico Final e Relato de Condução) foram submetidos separadamente no repositório da coordenação, em formato PDF, conforme as instruções do barema.

---

## Tecnologias Utilizadas

| Tecnologia | Uso |
|---|---|
| PHP 8.2 / Laravel 11 | Backend e roteamento |
| SQLite | Banco de dados (arquivo local, sem servidor) |
| Blade Templates | Sistema de templates para as views |
| Tailwind CSS | Estilização e design responsivo |
| JavaScript (vanilla) | Interatividade das telas sem framework adicional |
| Composer | Gerenciamento de dependências PHP |

---

## Observação Acadêmica

Este projeto foi desenvolvido exclusivamente como trabalho acadêmico do Projeto Integrador do curso de Análise e Desenvolvimento de Sistemas do IFBA, Campus Eunápolis. Não possui fins comerciais. Todos os dados utilizados nas demonstrações são fictícios.
