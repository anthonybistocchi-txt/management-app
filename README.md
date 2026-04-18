# Management App

Aplicação web de gestão operacional com foco em estoque, cadastros e relatórios, construída com Laravel no backend e TypeScript no frontend.

Este README foi atualizado para refletir o estado atual do código.

## Visão geral

O sistema atende operações de estoque e gestão administrativa com dois grandes contextos:
- operação diária (entrada e saída de estoque para usuários autenticados);
- gestão administrativa (dashboard, cadastros, relatórios e exportações para perfis admin/gestor).

Principais entregas:
- autenticação com controle de sessão;
- dashboard com indicadores e gráficos por período;
- CRUD de usuários, fornecedores, produtos e localizações;
- consultas de categorias, UF, cidades e CEP;
- movimentações de estoque (`in`, `out`, `transfer`);
- relatórios de entrada/saída, ficha de estoque, giro e inventário;
- exportação de relatórios em CSV e PDF.

Documentos relacionados:
- `FEATURES.md`: escopo funcional por área e observações de evolução.
- `documentation/database.md`: documento de banco existente no repositório (atenção: contém conteúdo legado e não reflete totalmente o schema atual das migrations).

## Stack tecnológica

Backend:
- PHP `^8.2`
- Laravel `^12`
- Eloquent ORM
- Form Requests para validação
- Camada de serviços e repositórios (interfaces + implementação Eloquent)
- `barryvdh/laravel-dompdf` para exportação PDF

Frontend:
- TypeScript
- Vite 5
- Axios
- jQuery
- DataTables
- Tom Select
- Flatpickr
- SweetAlert2
- Chart.js e ApexCharts
- Tailwind CSS (configuração presente no projeto)

## Arquitetura e organização

Principais diretórios:
- `app/Http/Controllers`: controllers HTTP (API e views).
- `app/Http/Requests`: validações de entrada por endpoint.
- `app/Services`: regras de negócio por domínio.
- `app/Repositories`: interfaces + classes Eloquent para acesso a dados.
- `app/Models`: modelos de domínio.
- `resources/views`: páginas Blade e templates auxiliares (incluindo template PDF).
- `resources/ts`: frontend modular por domínio (`pages`, `components`, `services`, `controllers`, `types`, `utils`).
- `routes/web.php`: rotas de páginas web.
- `routes/api.php`: endpoints JSON consumidos pelo frontend.
- `database/migrations`: estrutura de banco.
- `database/seeders`: carga inicial para ambiente local.

Padrões observados:
- separação em camadas (Controller -> Service -> Repository);
- frontend por domínio com inicializadores por página;
- DataTables server-side para listagens e relatórios;
- filtro + consulta + exportação compartilhando o mesmo payload.

## Módulos funcionais

### Autenticação e sessão
- login via `POST /login`;
- logout via `POST /logout`;
- middleware `auth` exige usuário logado e sessão válida (`login_ip` e `login_at`);
- redirecionamento inicial por perfil:
  - admin/gestor -> dashboard;
  - colaborador -> fluxo de estoque.

### Dashboard
- disponível para admin/gestor;
- consulta por período;
- cartões de indicadores e gráficos com dados da API `POST /api/admin/dashboard`.

### Gestão de usuários
- listagem paginada;
- criação, edição e remoção lógica;
- endpoint de usuário logado para cabeçalho e contexto da UI.

### Gestão de fornecedores
- listagem e CRUD;
- integração com consultas de CEP/cidade para preenchimento de endereço.

### Gestão de produtos
- listagem e CRUD;
- vínculo com categoria;
- usado nas movimentações e relatórios.

### Gestão de categorias
- listagem e cadastro/edição disponíveis nas telas administrativas;
- usada como filtro em produtos e relatórios.

### Gestão de localizações
- listagem e CRUD;
- localizações são obrigatórias para posição de estoque e filtragem operacional.

### Estoque e movimentações
- entrada (`/api/stock/in`);
- saída (`/api/stock/out`);
- transferência (`/api/stock/transfer`, restrita a admin/gestor);
- histórico em `stock_movements` com tipo, quantidades antes/depois e data.

### Relatórios
Relatórios atualmente disponíveis:
- Entrada e saída (`/api/reports/in-out`);
- Ficha de estoque / Kardex (`/api/reports/stock-card`);
- Giro de estoque (`/api/reports/stock-turnover`);
- Inventário (`/api/reports/inventory`).

Todos possuem filtros na UI e carregamento server-side.

## Exportação de relatórios (CSV e PDF)

A exportação foi estruturada para ser reutilizável entre todos os relatórios.

Backend:
- requests específicos de export em `app/Http/Requests/Reports/Exports`;
- serviços por relatório em `app/Services/Reports/Exports/*ExportService.php`;
- payload comum em `ReportExportPayload`;
- colunas formatáveis em `ReportExportColumn`;
- exportador CSV em `ReportCsvExporter`;
- exportador PDF em `ReportPdfExporter` com template único em `resources/views/exports/pdf/report.blade.php`.

Endpoints:
- `POST /api/reports/in-out/export/csv`
- `POST /api/reports/in-out/export/pdf`
- `POST /api/reports/stock-card/export/csv`
- `POST /api/reports/stock-card/export/pdf`
- `POST /api/reports/stock-turnover/export/csv`
- `POST /api/reports/stock-turnover/export/pdf`
- `POST /api/reports/inventory/export/csv`
- `POST /api/reports/inventory/export/pdf`

Detalhes importantes:
- CSV usa separador `;` e BOM UTF-8 para compatibilidade com Excel em pt-BR;
- PDF tem limite defensivo de linhas (constante `PDF_MAX_ROWS`, atualmente `500`);
- quando há truncamento no PDF, o backend envia headers `X-Pdf-*` e o frontend informa o usuário para usar CSV no dataset completo.

## Permissões e perfis

Middlewares:
- `auth`: exige autenticação e sessão íntegra;
- `admin.or.gestor`: restringe módulos administrativos.

Perfis observados:
- `1` = Admin
- `2` = Gestor
- `3` = Colaborador

Regra prática de acesso:
- Colaborador opera principalmente entradas e saídas de estoque;
- Admin/Gestor acessam dashboard, cadastros, relatórios e exportações.

## Banco de dados (resumo real das migrations)

Tabelas centrais de negócio:
- `type_user`
- `users`
- `providers`
- `product_categories`
- `products`
- `locations`
- `stock`
- `stock_movements`
- `login_activities`

Suporte de infraestrutura Laravel:
- `sessions`
- `cache` e `cache_locks`

Seeders disponíveis:
- tipos de usuário;
- usuários;
- fornecedores;
- categorias;
- localizações;
- produtos;
- estoque;
- movimentações de estoque.

## Pré-requisitos

- PHP `^8.2`
- Composer 2.x
- Node.js 18+ (recomendado)
- npm 9+ (recomendado)
- MySQL 8+ (ou compatível)
- Docker Desktop 4+ e Docker Compose v2 (para execução containerizada)

Extensões PHP comuns para Laravel:
- `openssl`
- `pdo`
- `mbstring`
- `tokenizer`
- `xml`
- `ctype`
- `json`
- `bcmath`

## Instalação

1) Clonar repositório

```bash
git clone <url-do-repositorio>
cd laravel
```

2) Instalar dependências do backend

```bash
composer install
```

3) Configurar ambiente

Windows (PowerShell):

```powershell
Copy-Item .env.example .env
php artisan key:generate
```

Linux/macOS:

```bash
cp .env.example .env
php artisan key:generate
```

4) Configurar credenciais no `.env`
- `APP_URL`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

5) Rodar migrations e seeders

```bash
php artisan migrate
php artisan db:seed
```

6) Instalar dependências do frontend

```bash
npm install
```

## Rodando com Docker (recomendado para onboarding rápido)

O projeto já possui infraestrutura Docker pronta:
- `Dockerfile` com build multi-stage (assets frontend + runtime PHP-FPM);
- `docker-compose.yml` com serviços `app` (PHP), `nginx`, `mysql` e `node` (profile `assets`);
- scripts em `docker/` para bootstrap e build de assets.

### 1) Configurar variáveis de ambiente

O `docker-compose.yml` usa variáveis próprias para banco no container MySQL:
- `COMPOSE_DB_DATABASE`
- `COMPOSE_DB_USERNAME`
- `COMPOSE_DB_PASSWORD`
- `COMPOSE_MYSQL_ROOT_PASSWORD`
- `HTTP_PORT` (default `8080`)
- `MYSQL_PORT` (default `33060`)

Exemplo rápido no PowerShell:

```powershell
Copy-Item .env.example .env
```

No `.env`, garanta ao menos:
- `APP_URL=http://localhost:8080`
- `DB_CONNECTION=mysql`
- `DB_HOST=mysql`
- `DB_PORT=3306`
- `DB_DATABASE` com o mesmo valor de `COMPOSE_DB_DATABASE`
- `DB_USERNAME` com o mesmo valor de `COMPOSE_DB_USERNAME`
- `DB_PASSWORD` com o mesmo valor de `COMPOSE_DB_PASSWORD`

### 2) Subir containers

```bash
docker compose up -d --build
```

Na primeira inicialização, o `entrypoint` do serviço `app` já:
- copia `.env.example` para `.env` (se necessário);
- gera `APP_KEY` (se ausente);
- tenta rodar `php artisan migrate`.

### 3) Rodar seeders (opcional, recomendado em ambiente local)

```bash
docker compose exec app php artisan db:seed
```

### 4) Acessar a aplicação

- App web: `http://localhost:8080` (ou valor de `HTTP_PORT`)
- MySQL host: `127.0.0.1`
- MySQL porta: `33060` (ou valor de `MYSQL_PORT`)

### 5) Comandos úteis com Docker

Subir/derrubar stack:

```bash
docker compose up -d
docker compose down
```

Ver logs:

```bash
docker compose logs -f app
docker compose logs -f nginx
docker compose logs -f mysql
```

Executar comandos Laravel dentro do container:

```bash
docker compose exec app php artisan migrate
docker compose exec app php artisan test
docker compose exec app php artisan optimize:clear
```

Rebuild dos assets frontend usando serviço `node`:

```bash
docker compose --profile assets run --rm node
```

Reset completo (inclui volume do banco):

```bash
docker compose down -v
docker compose up -d --build
```

## Execução local

Use esta seção se você preferir executar sem Docker (ambiente nativo no host).

Opção 1 (terminais separados):

```bash
php artisan serve
```

```bash
npm run dev
```

Opcional para fila:

```bash
php artisan queue:listen --tries=1
```

Opção 2 (script único):

```bash
composer run dev
```

## Build de produção

```bash
npm run build
```

Assets serão gerados em `public/build`.

## Scripts e comandos úteis

- `php artisan migrate`: executa migrations.
- `php artisan db:seed`: executa seeders.
- `php artisan optimize:clear`: limpa caches.
- `php artisan test`: executa testes.
- `npm run dev`: frontend em desenvolvimento.
- `npm run build`: build frontend para produção.
- `composer run dev`: sobe backend + queue + Vite em paralelo.
- `docker compose up -d --build`: sobe ambiente completo com Docker.
- `docker compose exec app php artisan <comando>`: roda comandos artisan no container.
- `docker compose --profile assets run --rm node`: gera assets de frontend no container.

## Fluxo de rotas (resumo)

Web (`routes/web.php`):
- `/login`
- `/index/stock-in`
- `/index/stock-out`
- `/index/dashboard`
- `/index/users`
- `/index/providers`
- `/index/locations`
- `/index/products`
- `/index/categories`
- `/index/movements`
- `/index/report-in-out`
- `/index/report-stock-turnover`
- `/index/report-inventory`
- `/reports/stock-card`

API (`routes/api.php`):
- `/api/users/*`
- `/api/products/*`
- `/api/product-categories/*`
- `/api/providers/*`
- `/api/locations/*`
- `/api/stock/*`
- `/api/reports/*`
- `/api/admin/dashboard`
- `/api/uf/getAll`
- `/api/cities/*`
- `/api/cep/get/{cep}`

## Credenciais seed (somente desenvolvimento)

O `UserSeeder` cria usuários com senhas simples para ambiente local.

Exemplos:
- `bruno.costa` (admin) com senha `12345678`
- `carla.dias` (gestor) com senha `12345678`
- `ana.silva` (colaborador) com senha `12345678`

Nunca reutilizar essas credenciais fora de ambiente local.

## Pontos de atenção para novos devs

- `documentation/database.md` contém modelagem ampla/legada e não representa fielmente as migrations atuais.
- `routes/api.php` possui endpoints de cidades (`/api/cities/*`) fora do grupo autenticado.
- `bootstrap/providers.php` referencia `AppServiceProvider`; confirme a presença desse provider no projeto antes de alterações estruturais de bootstrap.
- o projeto ignora `public/build` e `storage/framework/views`; não versionar artefatos gerados.
- pode haver inconsistências visuais de caminho com `\` e `/` em ambientes Windows no status do git; valide pelo path real do arquivo antes de deduplicar.

## Troubleshooting

Erro de CSRF em requests autenticadas:
- garantir meta `csrf-token` na view;
- confirmar sessão ativa e cookies válidos.

Vite/HMR não conecta:
- revisar arquivo `public/hot` (host/porta inválidos para o ambiente atual).
- em Docker, prefira `npm run build` (ou o profile `assets`) em vez de HMR para evitar problemas de websocket entre host/container.

Tela vazia ou sem dados:
- confirmar login;
- revisar filtros de data/local/produto;
- validar se seeders foram executados.

Erro de conexão com banco no Docker:
- conferir se `DB_HOST=mysql` e `DB_PORT=3306` no `.env`;
- validar se `COMPOSE_DB_*` e `DB_*` estão consistentes;
- aguardar healthcheck do MySQL e reexecutar `docker compose exec app php artisan migrate`.

PDF muito grande:
- refinar filtros;
- usar exportação CSV para volume completo.

## Contribuição

Fluxo sugerido:
1. Criar branch de feature/fix.
2. Implementar alterações por domínio.
3. Validar com `php artisan test` e `npm run build`.
4. Abrir PR com contexto funcional, impacto técnico e checklist de testes.

## Licença

MIT.
