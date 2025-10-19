# Esquema do Banco de Dados

## 📖 Visão Geral

Esta documentação detalha a estrutura do banco de dados do projeto, incluindo uma descrição da finalidade de cada entidade (tabela) e os relacionamentos entre elas, com base nas *migrations* do Laravel.

## 🗂️ Entidades (Tabelas)

Abaixo está a descrição de cada tabela, agrupada por funcionalidade do sistema.

### 🔐 Controle de Acesso (ACL)

* **`roles`**: Armazena os perfis de usuário (ex: Administrador, Cliente, Funcionário).
* **`permissions`**: Armazena permissões granulares (ex: criar-produto, ver-relatorio-financeiro).
* **`role_permissions`**: Tabela *pivot* (N:M) que conecta `roles` e `permissions`, definindo quais permissões cada perfil possui.

### 👥 Usuários e Clientes

* **`users`**: Armazena os dados de autenticação (login, senha) dos usuários que acessam o sistema (ex: administradores, equipe interna).
* **`customers`**: Armazena os dados cadastrais completos dos clientes que compram no sistema. Pode ou não estar vinculado a um `user`.

### 🚚 Fornecedores e Unidades

* **`providers`**: Cadastro dos fornecedores de produtos.
* **`units_of_measure`**: Tabela de domínio para armazenar as unidades de medida (ex: KG, UN, LT, M²).

### 📦 Produtos e Detalhes

* **`products`**: O catálogo principal de produtos, contendo nome, preço, estoque e descrição.
* **`product_details`**: Informações técnicas ou logísticas adicionais de um produto (ex: peso, dimensões, cor, material).

### 🧾 Pedidos e Status

* **`order_statuses`**: Tabela de domínio para os diferentes status de um pedido (ex: Pendente, Pago, Enviado, Cancelado).
* **`orders`**: O cabeçalho dos pedidos de venda, ligando um cliente a um status e ao valor total.
* **`order_product`**: Tabela *pivot* (N:M) que armazena os itens de um pedido (quais produtos, a quantidade e o preço praticado).

### 🏭 Controle de Estoque

* **`warehouses`**: Cadastro de armazéns ou depósitos físicos onde o estoque está localizado.
* **`inventory_movements`**: Um log detalhado de todas as movimentações de estoque (entradas, saídas, ajustes) de um produto, indicando o usuário responsável.

### 💰 Financeiro

* **`financial_transactions`**: Um "livro-caixa" geral, registrando todas as entradas e saídas de dinheiro, com referência opcional à sua origem (ex: um pedido).
* **`accounts_payable`**: Contas a pagar, geralmente associadas a fornecedores ou compras.
* **`accounts_receivable`**: Contas a receber, geralmente associadas a pedidos de clientes ou notas fiscais.
* **`cash_flow`**: Uma tabela para consolidar o fluxo de caixa diário (total de entradas, saídas e saldo).

### 📜 Contratos e Notas Fiscais

* **`contracts`**: Armazena registros de contratos firmados, que podem ser tanto com Clientes quanto com Fornecedores (relação polimórfica).
* **`invoices`**: Armazena os dados das notas fiscais emitidas, geralmente ligadas a um pedido.

### 🔔 Notificações

* **`notifications`**: Tabela para armazenar mensagens e alertas a serem exibidos para os usuários dentro do sistema.

---

## 🔗 Relacionamentos do Banco de Dados

A tabela a seguir detalha todas as chaves estrangeiras (foreign keys) e como as entidades se conectam.

| Entidade (Origem)   |       Tabela (Origem)    | Tipo|       Entidade Relacionada (Destino)   |    Tabela (Destino)   |                           Descrição                                              |
| :-----------------  |------------------------- | :---| :----------------------------------------------------------    | :------------------------------------------------------------------------------  |
| **Perfil**          | `roles`                  | 1:N |               **Usuário**              | `users`               | Um perfil (ex: Admin) pode ser atribuído a vários usuários.                      |
| **Perfil**          | `roles`                  | N:M |               **Permissão**            | `permissions`         | Um perfil pode ter várias permissões (via `role_permissions`).                   |
| **Usuário**         | `users`                  | 1:N |               **Cliente**              | `customers`           | Um usuário do sistema pode estar opcionalmente ligado a um cadastro de cliente.  |
| **Usuário**         | `users`                  | 1:N |               **Mov. de Estoque**      | `inventory_movements` | Um usuário registra várias movimentações de estoque.                             |
| **Usuário**         | `users`                  | 1:N |               **Notificação**          | `notifications`       | Um usuário pode receber múltiplas notificações.                                  |
| **Cliente**         | `customers`              | 1:N |               **Pedido**               | `orders`              | Um cliente pode realizar múltiplos pedidos.                                      |
| **Cliente**         | `customers`              | 1:N |               **Contas a Receber**     | `accounts_receivable` | Um cliente pode ter múltiplas contas a receber.                                  |
| **Fornecedor**      | `providers`              | 1:N |               **Produto**              | `products`            | Um fornecedor pode fornecer múltiplos produtos.                                  |
| **Fornecedor**      | `providers`              | 1:N |               **Contas a Pagar**       | `accounts_payable`    | Um fornecedor pode ter múltiplas contas a pagar.                                 |
| **Un. de Medida**   | `units_of_measure`       | 1:N |               **Detalhes do Produto**  | `product_details`     | Uma unidade (ex: 'KG') pode ser usada em vários produtos.                        |
| **Produto**         | `products`               | 1:1 |               **Detalhes do Produto**  | `product_details`     | Cada produto tem uma (e apenas uma) entrada de detalhes.                         |
| **Produto**         | `products`               | 1:N |               **Mov. de Estoque**      | `inventory_movements` | Um produto pode ter múltiplas movimentações de estoque.                          |
| **Produto**         | `products`               | N:M |               **Pedido**               | `orders`              | Um produto pode estar em múltiplos pedidos (via `order_product`).                |
| **Status do Pedido**| `order_statuses`         | 1:N |               **Pedido**               | `orders`              | Um status (ex: 'Pago') pode ser aplicado a múltiplos pedidos.                    |
| **Pedido**          | `orders`                 | 1:N |               **Contas a Receber**     | `accounts_receivable` | Um pedido pode gerar uma ou mais contas a receber (ex: parcelas).                |
| **Pedido**          | `orders`                 | 1:N |               **Nota Fiscal**          | `invoices`            | Um pedido pode ter uma ou mais notas fiscais associadas.                         |
| **Transação**       | `financial_transactions` | N:1 (Polimórfico) | **(Vários)**             | `(reference_type)`    | Uma transação financeira pode estar ligada a um Pedido, Compra, etc.             |
| **Contrato**        | `contracts`              | N:1 (Polimórfico) | **(Vários)**             | `(party_type)`        | Um contrato pode ser de um Cliente (`customers`) ou Fornecedor (`providers`).    |