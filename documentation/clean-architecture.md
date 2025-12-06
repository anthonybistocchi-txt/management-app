# Clean Architecture - Guia de Arquitetura

## Visão Geral

Este documento descreve a nova arquitetura limpa implementada no sistema de gerenciamento. A arquitetura foi refatorada para seguir os princípios SOLID e Clean Architecture, melhorando a manutenibilidade, testabilidade e organização do código.

## Estrutura da Arquitetura

### Antes (Estrutura Antiga)
```
Routes → Controllers → Services → Models
```

### Depois (Clean Architecture)
```
Routes → Controllers (+ ApiResponse Trait) → Services → Repositories (Interfaces) → Models
```

## Camadas da Aplicação

### 1. **Routes** (`routes/web.php`)
- Define os endpoints da API
- Mapeia URLs para Controllers
- Agrupa rotas relacionadas por prefixo

### 2. **Controllers** (`app/Http/Controllers/`)
- Recebe requisições HTTP
- Valida dados usando FormRequests
- Delega lógica de negócio para Services
- Retorna respostas padronizadas usando o trait `ApiResponse`
- **Não contém lógica de negócio**

### 3. **Services** (`app/Services/`)
- Contém a lógica de negócio da aplicação
- Orquestra operações entre diferentes repositórios
- Manipula transações quando necessário
- **Não acessa diretamente os Models**

### 4. **Repositories** (`app/Repositories/`)
- **Interfaces** (`Contracts/`): Definem contratos para acesso a dados
- **Implementações** (`Eloquent/`): Implementam as interfaces usando Eloquent ORM
- Responsáveis por toda interação com banco de dados
- Encapsulam queries e operações de persistência

### 5. **Models** (`app/Models/`)
- Representam entidades do banco de dados
- Definem relacionamentos
- Contém casts e acessores/mutadores

## Novos Componentes

### ApiResponse Trait (`app/Http/Traits/ApiResponse.php`)

Padroniza as respostas da API com métodos utilitários:

```php
// Resposta de sucesso
$this->successResponse($data, 'Mensagem', 200);

// Resposta de criação
$this->createdResponse($data, 'Criado com sucesso', 201);

// Resposta de erro
$this->errorResponse('Mensagem de erro', $error, 500);

// Resposta de validação
$this->validationErrorResponse('Dados inválidos', $errors, 422);

// Resposta de não encontrado
$this->notFoundResponse('Recurso não encontrado', 404);
```

### Repository Pattern

Exemplo de uso no UserService:

```php
class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    public function createUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }
}
```

### Service Provider (`app/Providers/AppServiceProvider.php`)

Configura a injeção de dependência, vinculando interfaces às suas implementações:

```php
$this->app->bind(UserRepositoryInterface::class, UserRepository::class);
$this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
$this->app->bind(ProviderRepositoryInterface::class, ProviderRepository::class);
```

## Benefícios da Nova Arquitetura

### 1. **Separação de Responsabilidades**
- Cada camada tem uma responsabilidade única e bem definida
- Controllers não conhecem detalhes de persistência
- Services não conhecem detalhes de HTTP

### 2. **Testabilidade**
- Fácil criar mocks de repositórios para testes unitários
- Services podem ser testados independentemente do banco de dados
- Controllers podem ser testados sem Services reais

### 3. **Manutenibilidade**
- Código organizado e fácil de localizar
- Mudanças em uma camada não afetam as outras
- Respostas padronizadas facilitam alterações globais

### 4. **Flexibilidade**
- Fácil trocar implementação de repositório (ex: de Eloquent para Query Builder)
- Possível adicionar cache na camada de repositório
- Controllers reutilizáveis com diferentes services

### 5. **SOLID Principles**
- **S**ingle Responsibility: Cada classe tem uma responsabilidade
- **O**pen/Closed: Aberto para extensão, fechado para modificação
- **L**iskov Substitution: Repositórios podem ser substituídos
- **I**nterface Segregation: Interfaces específicas para cada repositório
- **D**ependency Inversion: Dependências via interfaces, não implementações

## Exemplos de Uso

### Criando um Novo Recurso

1. **Criar o Model**
```php
// app/Models/Category.php
class Category extends Model { ... }
```

2. **Criar a Interface do Repositório**
```php
// app/Repositories/Contracts/CategoryRepositoryInterface.php
interface CategoryRepositoryInterface
{
    public function create(array $data): Category;
    public function findAll(): array;
}
```

3. **Implementar o Repositório**
```php
// app/Repositories/Eloquent/CategoryRepository.php
class CategoryRepository implements CategoryRepositoryInterface
{
    public function create(array $data): Category
    {
        return Category::create($data);
    }
}
```

4. **Criar o Service**
```php
// app/Services/CategoryService.php
class CategoryService
{
    public function __construct(
        protected CategoryRepositoryInterface $repository
    ) {}
    
    public function createCategory(array $data): Category
    {
        return $this->repository->create($data);
    }
}
```

5. **Criar o Controller**
```php
// app/Http/Controllers/CategoryController.php
class CategoryController extends Controller
{
    use ApiResponse;
    
    public function store(Request $request, CategoryService $service)
    {
        try {
            $category = $service->createCategory($request->validated());
            return $this->createdResponse($category);
        } catch (\Exception $e) {
            return $this->errorResponse('Erro ao criar categoria', $e->getMessage());
        }
    }
}
```

6. **Registrar no Service Provider**
```php
// app/Providers/AppServiceProvider.php
$this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
```

## Padrões e Convenções

### Nomenclatura
- Repositories: `{Model}Repository` e `{Model}RepositoryInterface`
- Services: `{Model}Service`
- Controllers: `{Model}Controller`

### Estrutura de Diretórios
```
app/
├── Http/
│   ├── Controllers/      # Camada de apresentação
│   ├── Requests/         # Validações
│   └── Traits/           # Traits reutilizáveis (ApiResponse)
├── Services/             # Lógica de negócio
├── Repositories/
│   ├── Contracts/        # Interfaces
│   └── Eloquent/         # Implementações
├── Models/               # Entidades do banco
└── Providers/            # Service providers
```

## Migração de Código Legado

Para migrar código antigo:

1. Criar interface do repositório
2. Criar implementação do repositório
3. Atualizar service para usar repositório
4. Atualizar controller para usar trait ApiResponse
5. Registrar binding no AppServiceProvider
6. Testar funcionalidade

## Considerações Finais

Esta arquitetura foi projetada para crescer com o projeto, facilitando:
- Adição de novos recursos
- Manutenção do código existente
- Testes automatizados
- Trabalho em equipe
- Substituição de componentes

Para dúvidas ou sugestões sobre a arquitetura, consulte a equipe de desenvolvimento.
