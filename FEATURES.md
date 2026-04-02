# Funcionalidades do projeto

Este documento descreve o escopo funcional do **Inventa-App** — sistema voltado à gestão de estoque, cadastros e operadores — e deixa explícito o que ainda está **em desenvolvimento** ou **não implementado**.

---

## Visão geral

A aplicação oferece:

- Autenticação de usuários
- Painel (dashboard) com indicadores e gráficos em período selecionável
- Gestão de **operadores** (usuários do sistema) com perfis por tipo
- Cadastro e consulta de **fornecedores** e **produtos**
- **Entrada** e **saída** de estoque, com vínculo a produtos, localizações e, quando aplicável, fornecedores
- Tela de **movimentações** (listagem/visualização conforme implementação atual)
- Navegação por módulos a partir do layout principal (sidebar)

O back-end expõe rotas REST/JSON sob prefixos como `users`, `products`, `providers`, `stock`, `admin`, etc., consumidas pelo front-end em TypeScript (Axios + Vite).

---

## Funcionalidades por área

### Autenticação

- Tela de **login**
- Fluxo de **logout**
- Fluxo de **recuperação / reset de senha** (conforme telas e rotas configuradas)

### Dashboard

- Resumo de vendas / indicadores e gráficos (ex.: por categoria, movimentações)
- Filtro por **intervalo de datas** (date range)
- Dados carregados via API (`admin/dashboard`)

### Usuários (operadores)

- Listagem paginada (DataTables) com busca e filtros
- **Criação** de usuário (modal)
- **Edição** e **exclusão** (soft delete / inativação conforme regra de negócio)
- Perfis por tipo (ex.: administrador, gestor, operador)

### Fornecedores

- Listagem e integração com fluxos que dependem de fornecedor (ex.: entrada de estoque)
- Telas de gestão conforme rotas `providers` e views em `index`

### Produtos

- Listagem e uso em movimentações de estoque
- CRUD conforme API e telas disponíveis

### Localizações

- Cadastro/consulta de locais de armazenamento usados nas movimentações

### Estoque

- **Entrada de estoque** (`stock/in`)
- **Saída de estoque** (`stock/out`)
- **Transferência** (`stock/transfer`) — rota prevista na API; validar comportamento na interface

### Movimentações

- Rota e view de **movimentações** para acompanhamento histórico (detalhes dependem da implementação atual da tela)

---

## Relatórios

O módulo de relatórios está acessível pelo menu **Relatórios** na sidebar e conta com:

- **Entrada e saída** — listagem paginada de todas as movimentações (entrada, saída, transferência) com filtros por produto, período, localização, tipo, categoria e fornecedor.
- **Ficha de estoque (Kardex)** — histórico de movimentações de um produto específico com saldo antes/após cada operação, filtros por produto, período e localização.
- **Giro de estoque** — análise de rotatividade por produto no período selecionado (fórmula: saídas / estoque médio), com filtros por período, categoria e localização.
- **Inventário** — posição atual do estoque (snapshot da tabela `stock`) com produto, categoria, local, quantidade, preço unitário e valor total. Filtros por categoria e localização.

Todas as telas utilizam DataTables com paginação server-side via API REST.

---

## Stack técnica (referência)

| Camada | Tecnologias |
|--------|-------------|
| Back-end | Laravel 12, PHP 8.2+ |
| Front-end | TypeScript, Vite, jQuery, DataTables, Axios, SweetAlert2, Flatpickr, Chart.js / ApexCharts |
| Estilo | Tailwind (via CDN em várias views), CSS da aplicação |

---

## Instalação e execução

Instruções de instalação, variáveis de ambiente e comandos para rodar localmente estão no **[README.md](./README.md)**.
