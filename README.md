# Management App

Sistema de gestão operacional com foco em estoque, cadastros e controle de usuários, construído com Laravel no backend e TypeScript no frontend.

## 1. Visão Geral

O projeto entrega uma aplicação web com autenticação e módulos administrativos para operação diária.

Principais capacidades:
- Login e sessão autenticada.
- Dashboard de vendas com métricas por período.
- Gestão de usuários (operadores), produtos, fornecedores, categorias e localizações.
- Movimentações de estoque (entrada, saída e transferência via API).
- Relatório de entrada/saída com filtros.

Arquivos de apoio:
- [FEATURES.md](FEATURES.md): escopo funcional e itens não implementados.
- [documentation/database.md](documentation/database.md): referência de banco de dados.

## 2. Funcionalidades

### 2.1 Autenticação
- Tela de login.
- Logout em sessão autenticada.
- Telas de criação e reset de senha no fluxo web.

### 2.2 Dashboard
- Consulta por intervalo de datas.
- KPIs de vendas:
	- valor total vendido;
	- produto mais vendido;
	- total de pedidos;
	- ticket médio;
	- variação percentual vs. período anterior.
- Gráficos:
	- série temporal de vendas por volume/faturamento;
	- vendas por categoria.
- Blocos adicionais:
	- top produtos;
	- vendas recentes;
	- alerta de baixo estoque.

### 2.3 Gestão de Usuários
- Listagem paginada com filtros e busca.
- Criação de usuário.
- Edição de usuário.
- Exclusão/inativação via fluxo da API.

### 2.4 Gestão de Fornecedores
- Listagem e filtros.
- Criação, edição e exclusão.
- Preenchimento assistido de endereço por CEP.

### 2.5 Gestão de Produtos
- Listagem e filtros por categoria, fornecedor e localização.
- Criação, edição e exclusão.
- Campos de preço e estoque inicial.

### 2.6 Gestão de Categorias
- Listagem e busca.
- Fluxo de criação e edição estruturado no frontend.
- Observação: exclusão de categorias ainda não está implementada na API.

### 2.7 Gestão de Localizações
- Listagem e filtros por estado/cidade.
- Criação, edição e exclusão.

### 2.8 Estoque
- Entrada de estoque com produto, fornecedor, quantidade, data e localização.
- Saída de estoque com produto, quantidade, data e localização.
- Transferência disponível via endpoint de API.

### 2.9 Relatórios
- Relatório de entrada/saída com filtros por produto, local, tipo de movimentação, fornecedor, categoria e período.
- Rotas previstas para relatórios de giro e inventário.

## 3. Stack Tecnológica

### Backend
- PHP 8.2+
- Laravel 12
- Eloquent ORM
- Requests de validação
- Camada Service/Repository

### Frontend
- TypeScript
- Vite
- jQuery
- DataTables
- TomSelect
- Flatpickr
- Chart.js
- SweetAlert2
- Axios

## 4. Arquitetura do Projeto

Organização principal:
- [app](app): controllers, services, repositories, models, requests.
- [resources/ts](resources/ts): frontend modular por domínio (pages, components, controllers, services, utils, types).
- [resources/views](resources/views): views Blade.
- [routes/web.php](routes/web.php): rotas web e páginas.
- [routes/api.php](routes/api.php): endpoints JSON consumidos pelo frontend.
- [database/migrations](database/migrations): estrutura de banco.
- [database/seeders](database/seeders): carga inicial de dados.

Padrões adotados no frontend:
- Componentes por domínio (Products, Providers, Locations, Users, Categories, Dashboard).
- Helpers compartilhados para formulários, selects e ações de tabela.
- Tipos centralizados em [resources/ts/types](resources/ts/types).

## 5. Permissões e Acesso

Resumo de acesso por middleware:
- `auth`: exige usuário autenticado.
- `admin.or.gestor`: restringe módulos administrativos.

Rotas operacionais de estoque (entrada/saída) ficam sob autenticação.
Rotas administrativas (dashboard, usuários, cadastros e relatórios) exigem perfil administrativo/gestor.

## 6. Requisitos

| Ferramenta | Versão recomendada |
|------------|-------------------|
| PHP        | ^8.2              |
| Composer   | 2.x               |
| Node.js    | 18+               |
| npm        | 9+                |
| MySQL      | 8.x (ou compatível) |

Extensões PHP usuais do Laravel:
- openssl
- pdo
- mbstring
- tokenizer
- xml
- ctype
- json
- bcmath

## 7. Instalação

### 7.1 Clonar repositório
```bash
git clone <url-do-repositorio>
cd management-app
```

### 7.2 Instalar dependências backend
```bash
composer install
```

### 7.3 Configurar ambiente
```bash
copy .env.example .env
php artisan key:generate
```

Configurar no .env:
- APP_URL
- DB_HOST
- DB_PORT
- DB_DATABASE
- DB_USERNAME
- DB_PASSWORD

### 7.4 Migrar e semear banco
```bash
php artisan migrate
php artisan db:seed
```

### 7.5 Instalar dependências frontend
```bash
npm install
```

## 8. Execução em Desenvolvimento

Executar em terminais separados:

Terminal 1:
```bash
php artisan serve
```

Terminal 2:
```bash
npm run dev
```

Opcional (fila):
```bash
php artisan queue:listen --tries=1
```

Também é possível usar o script integrado do Composer:
```bash
composer run dev
```

## 9. Build de Produção

```bash
npm run build
```

Os assets serão gerados em `public/build`.

## 10. Comandos Úteis

| Comando | Descrição |
|---------|-----------|
| php artisan migrate | Executa migrações |
| php artisan db:seed | Executa seeders |
| php artisan optimize:clear | Limpa caches da aplicação |
| php artisan test | Executa testes |
| npm run dev | Frontend em modo desenvolvimento |
| npm run build | Build de produção frontend |

## 11. Endpoints Principais (Resumo)

Principais grupos de API em [routes/api.php](routes/api.php):
- `/users/*`
- `/products/*`
- `/product-categories/*`
- `/providers/*`
- `/locations/*`
- `/stock/*`
- `/admin/dashboard`
- `/reports/*`
- `/uf/getAll`
- `/cities/getAll`
- `/cep/get/{cep}`

Páginas web principais em [routes/web.php](routes/web.php):
- `/login`
- `/index/dashboard`
- `/index/users`
- `/index/providers`
- `/index/locations`
- `/index/products`
- `/index/categories`
- `/index/movements`
- `/index/stock-in`
- `/index/stock-out`
- `/index/report-in-out`

## 12. Observações de Negócio

- O sistema utiliza regra de preço em inteiro (centavos) com conversão para moeda no frontend.
- O dashboard trabalha com filtros de período validados no frontend e backend.
- Algumas funcionalidades de relatório avançado continuam em evolução.

## 13. Troubleshooting

### Erro de CSRF em requests autenticadas
- Garantir meta `csrf-token` presente na view que dispara requisições Axios.

### Vite/HMR com websocket inválido
- Verificar se há arquivo `public/hot` com host/porta incompatíveis com o ambiente atual.

### Sem dados em tabelas ou dashboard
- Validar sessão autenticada.
- Verificar filtros de data.
- Verificar seed e dados base no banco.

## 14. Contribuição

Fluxo sugerido:
1. Criar branch de feature/fix.
2. Implementar alteração com foco em domínio.
3. Validar com `npm run build` e `php artisan test`.
4. Abrir PR com contexto, impacto e checklist de teste.

## 15. Licença

Projeto sob licença MIT, conforme ecossistema Laravel.
