# Management App

Sistema de gestão de estoque e operadores construído com **Laravel 12** (API e views) e **TypeScript + Vite** no front-end.

Documentação das funcionalidades: veja **[FEATURES.md](./FEATURES.md)**.

---

## Requisitos

| Ferramenta | Versão recomendada |
|------------|-------------------|
| PHP        | ^8.2              |
| Composer   | 2.x               |
| Node.js    | 18+ (LTS)         |
| npm        | 9+                |
| MySQL      | 8.x (ou compatível) |

Extensões PHP usuais do Laravel: `openssl`, `pdo`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`.

---

## Instalação na máquina local

### 1. Clonar o repositório

```bash
git clone <url-do-repositorio>
cd management-app
```

### 2. Dependências PHP

```bash
composer install
```

### 3. Ambiente (`.env`)

```bash
copy .env.example .env
```

Edite o `.env` e configure pelo menos:

- `APP_URL` — URL base (ex.: `http://localhost:8000`)
- **Banco de dados:** `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, `DB_HOST`, `DB_PORT`

O projeto usa sessão em banco (`SESSION_DRIVER=database` no `.env.example`). Garanta que `DB_*` está correto antes das migrações.

Gere a chave da aplicação:

```bash
php artisan key:generate
```

### 4. Banco de dados

```bash
php artisan migrate
```

Para popular dados de desenvolvimento (tipos de usuário, usuários, fornecedores, categorias, locais, produtos, estoque e movimentações — respeitando a ordem das FKs):

```bash
php artisan db:seed
```

*(Use apenas em ambiente local; revise credenciais dos usuários seedados.)*

### 5. Dependências JavaScript e build

```bash
npm install
```

Para desenvolvimento (hot reload do Vite):

```bash
npm run dev
```

Para gerar os assets de produção:

```bash
npm run build
```

---

## Executar o projeto localmente

É necessário **dois terminais** em desenvolvimento:

**Terminal 1 — servidor Laravel**

```bash
php artisan serve
```

Por padrão: `http://127.0.0.1:8000` (ajuste `APP_URL` no `.env` se usar outra porta).

**Terminal 2 — Vite (assets TS/CSS)**

```bash
npm run dev
```

Abra no navegador a URL do `php artisan serve` (ex.: `http://127.0.0.1:8000/login`).

> Em produção, rode `npm run build` e sirva a aplicação com o servidor web configurado para o `public/` do Laravel; não é obrigatório manter o `npm run dev` ligado.

---

## Comandos úteis

| Comando | Descrição |
|---------|-----------|
| `php artisan migrate` | Executa migrações pendentes |
| `php artisan db:seed` | Executa seeders |
| `npm run dev` | Vite em modo desenvolvimento |
| `npm run build` | Compila assets para `public/build` |
| `php artisan optimize:clear` | Limpa caches de config/rota/view |

---

## Estrutura (resumo)

- `app/` — Lógica Laravel (controllers, services, requests)
- `resources/ts/` — TypeScript (páginas, componentes, serviços de API)
- `resources/views/` — Blade
- `routes/web.php` — Rotas web e API usadas pelo front
- `vite.config.js` — Entradas Vite (ex.: `app.ts`, páginas por rota)

---

## Mais informações

- **[FEATURES.md](./FEATURES.md)** — Visão geral das funcionalidades e itens ainda não implementados (incluindo **relatórios**).
