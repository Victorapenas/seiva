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

## Limitações do Projeto e Requisitos Não Cumpridos

- **RNF001 — Criptografia AES-256-GCM dos dados:** O requisito de criptografia em repouso dos dados no banco de dados não foi implementado. A proteção das informações pessoais é realizada na camada de aplicação através de autenticação por sessão e controle de acesso restrito via PIN de 4 dígitos na Caixa Preta. Durante o desenvolvimento, foram consultados materiais sobre arquitetura e criptografia no Laravel ([Laravel Encryption](https://www.youtube.com/results?search_query=laravel+encryption+aes+256) e [Arquitetura POO no Laravel](https://www.youtube.com/results?search_query=laravel+service+pattern+poo)), optando-se por manter apenas a implementação compreendida e mantida pela equipe.
- **Banco de Dados Local (SQLite):** Optou-se pela utilização do SQLite em substituição ao MySQL 8.0 previsto no planejamento inicial, visando facilitar a execução local no ambiente acadêmico e simplificar a execução dos testes automatizados sem a necessidade de um servidor de banco dedicado.

---

## Como Executar o Projeto

### Requisitos

- PHP 8.2 ou superior
- Composer (gerenciador de dependências do PHP)
- XAMPP (ou qualquer instalação local de PHP)
- Navegador moderno (Chrome, Firefox, Edge)

> O projeto usa **SQLite** como banco de dados. Nenhuma configuração de servidor de banco de dados é necessária, o arquivo do banco é gerado automaticamente dentro da pasta `database/`.

---

### Passo a Passo para Iniciar (XAMPP)

**1. Clone o repositório**

```bash
git clone https://github.com/Victorapenas/seiva.git
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

**5. Crie as tabelas do banco de dados e popule os dados**

```powershell
& "C:\xampp\php\php.exe" artisan migrate --seed
```

Isso cria o arquivo `database/database.sqlite` e insere os dados de demonstração automaticamente.

**6. Inicie o servidor**

```powershell
& "C:\xampp\php\php.exe" artisan serve
```

Acesse: [http://localhost:8000](http://localhost:8000)

---

### Usuários de Demonstração para Teste

| Usuário | E-mail | Senha | PIN Caixa Preta | Perfil |
|---|---|---|---|---|
| Victor Hugo | `victor@seiva.app` | `senha123` | `1234` | Individual |
| Maria Eduarda (Duda) | `duda@seiva.app` | `senha123` | `2026` | Casal (Lar Cantinho) |
| Ian Marcos | `ian@seiva.app` | `senha123` | `4321` | Casal (Lar Cantinho) |

---

### Testes Automatizados

O projeto possui 81 testes automatizados cobrindo os módulos de autenticação, contas, despesas do lar, acordos, metas e caixa preta:

```powershell
& "C:\xampp\php\php.exe" artisan test
```

---

### Solução de Problemas Comuns

**"Class not found" ou erros de autoload:**
```powershell
& "C:\xampp\php\php.exe" composer.phar dump-autoload
```

**Erros de permissão em `storage/` ou `bootstrap/cache/`:**

No Windows, verifique se a pasta `storage/` não está marcada como somente leitura nas propriedades do Windows Explorer.

**Banco de dados não encontrado:**

Se o arquivo `database/database.sqlite` não existir, crie-o manualmente:
```powershell
New-Item database/database.sqlite
& "C:\xampp\php\php.exe" artisan migrate --seed
```

---

## Estrutura de Pastas

A estrutura segue o padrão do framework Laravel:

```
seiva/
├── app/
│   ├── Dominio/             # Classes de domínio em POO pura (Casal, CaixaPreta, etc.)
│   ├── Http/
│   │   └── Controllers/     # Recebem as requisições HTTP e retornam respostas
│   ├── Models/              # Representam as tabelas do banco de dados (Eloquent ORM)
│   └── Services/            # Serviços de autenticação e regras de apoio
│
├── database/
│   ├── migrations/          # Estrutura das tabelas do banco de dados
│   ├── seeders/             # Populam o banco com dados iniciais/de demonstração
│   └── database.sqlite      # Arquivo do banco de dados local
│
├── resources/
│   └── views/               # Arquivos de interface (Blade Templates)
│       ├── auth/            # Telas de login e cadastro
│       ├── modulos/         # Painéis de cada funcionalidade (Lar, Metas, Acordos, etc.)
│       └── componentes/     # Elementos reutilizáveis: sidebar, modais, topbar
│
├── routes/
│   └── web.php              # Rotas da aplicação (URLs e seus controllers)
│
├── config/                  # Arquivos de configuração do Laravel
├── public/                  # Pasta pública: index.php, assets, imagens
├── storage/                 # Logs, arquivos gerados e cache
├── bootstrap/               # Inicialização do framework
├── tests/                   # Testes automatizados (Feature e Unit)
│
├── artisan                  # CLI do Laravel
├── composer.json            # Dependências PHP do projeto
├── .env.example             # Modelo de configuração de ambiente
└── package.json             # Dependências frontend
```

---

## Documentação do Projeto

A documentação completa do Projeto Integrador está organizada na pasta `docs/`:

```
docs/
├── academicos/
│   ├── SEIVA_Documento_de_Entrega_PI.pdf   # Documento oficial simples de entrega com links de acesso
│   ├── SEIVA_Relatorio_Tecnico_Final.pdf   # Relatório Técnico Final completo
│   ├── SEIVA_Relato_de_Conducao.pdf        # Relato de Condução
│   └── especificacao_requisitos_v2.pdf     # Documento de Requisitos Funcionais e Não Funcionais
├── apresentacoes/
│   ├── apresentacao_slides_pi.pdf          # Slides da apresentação acadêmica
│   └── apresentacao_interativa.html        # Versão interativa dos slides
└── diagramas/
    ├── diagrama_casos_de_uso.pdf           # Diagrama de Casos de Uso (UML)
    ├── diagrama_conceitual_bd.pdf          # Modelo Conceitual do Banco de Dados
    └── diagrama_entidade_relacionamento.pdf # Modelo Entidade-Relacionamento
```

Os documentos entregues à coordenação (Relatório Técnico Final e Relato de Condução) foram submetidos separadamente no repositório da coordenação, em formato PDF, conforme as instruções do barema.

---

## Tecnologias Utilizadas

| Tecnologia | Uso |
|---|---|
| PHP 8.2 / Laravel 12 | Backend e roteamento |
| SQLite | Banco de dados (arquivo local, sem servidor) |
| Blade Templates | Sistema de templates para as views |
| Tailwind CSS | Estilização e design responsivo |
| JavaScript (vanilla) | Interatividade das telas sem framework adicional |
| Composer | Gerenciamento de dependências PHP |

---

## Observação Acadêmica

Este projeto foi desenvolvido exclusivamente como trabalho acadêmico do Projeto Integrador do curso de Análise e Desenvolvimento de Sistemas do IFBA, Campus Eunápolis. Não possui fins comerciais. Todos os dados utilizados nas demonstrações são fictícios.


obs: Diga não a projetos robusto para PI.
