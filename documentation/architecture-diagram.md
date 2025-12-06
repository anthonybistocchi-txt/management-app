# Diagrama da Arquitetura Clean

## Fluxo de Requisição

```
┌─────────────────────────────────────────────────────────────────────────┐
│                           CLIENT REQUEST                                 │
│                    (HTTP GET/POST/PUT/DELETE)                           │
└─────────────────────────────────────────────────────────────────────────┘
                                   │
                                   ▼
┌─────────────────────────────────────────────────────────────────────────┐
│                          ROUTES (web.php)                                │
│  • Define endpoints                                                      │
│  • Map URLs to Controllers                                               │
│  • Group by resource (users, products, providers)                        │
└─────────────────────────────────────────────────────────────────────────┘
                                   │
                                   ▼
┌─────────────────────────────────────────────────────────────────────────┐
│                         CONTROLLERS                                      │
│  • UserController                                                        │
│  • ProductController                                                     │
│  • ProviderController                                                    │
│                                                                          │
│  Responsibilities:                                                       │
│  ✓ Receive HTTP requests                                                │
│  ✓ Validate using FormRequests                                          │
│  ✓ Call Service methods                                                 │
│  ✓ Return standardized responses (via ApiResponse trait)                │
│  ✗ NO business logic                                                    │
│  ✗ NO database access                                                   │
└─────────────────────────────────────────────────────────────────────────┘
                                   │
                    ┌──────────────┴──────────────┐
                    │    ApiResponse Trait        │
                    │  • successResponse()        │
                    │  • createdResponse()        │
                    │  • errorResponse()          │
                    │  • notFoundResponse()       │
                    │  • validationErrorResponse()│
                    └─────────────────────────────┘
                                   │
                                   ▼
┌─────────────────────────────────────────────────────────────────────────┐
│                           SERVICES                                       │
│  • UserService                                                           │
│  • ProductService                                                        │
│  • ProviderService                                                       │
│                                                                          │
│  Responsibilities:                                                       │
│  ✓ Business logic                                                       │
│  ✓ Data transformation (ex: hash passwords)                             │
│  ✓ Orchestrate repositories                                             │
│  ✓ Handle transactions                                                  │
│  ✗ NO direct Model access                                               │
│  ✗ NO HTTP concerns                                                     │
└─────────────────────────────────────────────────────────────────────────┘
                                   │
                    ┌──────────────┴──────────────┐
                    │  Dependency Injection       │
                    │  (via Interfaces)           │
                    │                             │
                    │  UserRepositoryInterface    │
                    │  ProductRepositoryInterface │
                    │  ProviderRepositoryInterface│
                    └─────────────────────────────┘
                                   │
                                   ▼
┌─────────────────────────────────────────────────────────────────────────┐
│                    REPOSITORY INTERFACES                                 │
│  (Contracts - Define o que precisa ser feito)                           │
│                                                                          │
│  • UserRepositoryInterface                                               │
│  • ProductRepositoryInterface                                            │
│  • ProviderRepositoryInterface                                           │
│                                                                          │
│  Methods:                                                                │
│  • create(array $data)                                                  │
│  • update(int $id, array $data)                                         │
│  • delete(int $id)                                                      │
│  • findById(int $id)                                                    │
│  • findAll()                                                            │
└─────────────────────────────────────────────────────────────────────────┘
                                   │
                                   ▼
┌─────────────────────────────────────────────────────────────────────────┐
│                  REPOSITORY IMPLEMENTATIONS                              │
│  (Eloquent - Como será feito)                                           │
│                                                                          │
│  • UserRepository                                                        │
│  • ProductRepository                                                     │
│  • ProviderRepository                                                    │
│                                                                          │
│  Responsibilities:                                                       │
│  ✓ Database queries                                                     │
│  ✓ Eloquent operations                                                  │
│  ✓ Data persistence                                                     │
│  ✗ NO business logic                                                    │
└─────────────────────────────────────────────────────────────────────────┘
                                   │
                                   ▼
┌─────────────────────────────────────────────────────────────────────────┐
│                            MODELS                                        │
│  • User                                                                  │
│  • Product                                                               │
│  • Provider                                                              │
│                                                                          │
│  Responsibilities:                                                       │
│  ✓ Database table representation                                        │
│  ✓ Define relationships                                                 │
│  ✓ Casts and accessors/mutators                                         │
│  ✗ NO queries (moved to Repositories)                                   │
└─────────────────────────────────────────────────────────────────────────┘
                                   │
                                   ▼
┌─────────────────────────────────────────────────────────────────────────┐
│                           DATABASE                                       │
│  • MySQL/PostgreSQL                                                      │
│  • Tables: users, products, providers, etc.                             │
└─────────────────────────────────────────────────────────────────────────┘
```

## Dependency Injection Flow

```
┌──────────────────────────────────────────────────────────────────┐
│                  AppServiceProvider                               │
│                                                                   │
│  Register bindings:                                               │
│  ┌────────────────────────────────────────────────────────────┐  │
│  │ UserRepositoryInterface  →  UserRepository                 │  │
│  │ ProductRepositoryInterface  →  ProductRepository           │  │
│  │ ProviderRepositoryInterface  →  ProviderRepository         │  │
│  └────────────────────────────────────────────────────────────┘  │
└──────────────────────────────────────────────────────────────────┘
                          │
                          ▼
┌──────────────────────────────────────────────────────────────────┐
│                 Laravel Container                                 │
│  Automatically injects the correct implementation                 │
│  when a Service requests an Interface                             │
└──────────────────────────────────────────────────────────────────┘
```

## Example: Create User Request Flow

```
1. POST /users/createUser
   ↓
2. Route → UserController@createUser
   ↓
3. CreateUserRequest validates data
   ↓
4. UserController calls UserService
   ↓
5. UserService uses UserRepositoryInterface
   ↓
6. Laravel injects UserRepository (bound in AppServiceProvider)
   ↓
7. UserRepository creates User via Eloquent Model
   ↓
8. User saved to database
   ↓
9. UserRepository returns User object to Service
   ↓
10. UserService returns User to Controller
    ↓
11. UserController uses ApiResponse trait
    ↓
12. Return standardized JSON response:
    {
      "status": true,
      "message": "User created successfully",
      "data": { user object },
      "code": 201
    }
```

## Benefits Visualization

```
┌─────────────────────┐      ┌─────────────────────┐
│   OLD ARCHITECTURE  │      │  NEW ARCHITECTURE   │
├─────────────────────┤      ├─────────────────────┤
│ Routes              │      │ Routes              │
│   ↓                 │      │   ↓                 │
│ Controllers         │      │ Controllers         │
│   ↓ (tight)         │      │   ↓ (+ ApiResponse) │
│ Services            │      │ Services            │
│   ↓ (coupled)       │      │   ↓ (via Interface) │
│ Models (direct)     │      │ Repositories        │
│                     │      │   ↓                 │
│                     │      │ Models              │
└─────────────────────┘      └─────────────────────┘

Problems:                     Solutions:
❌ Tight coupling            ✅ Loose coupling
❌ Hard to test              ✅ Easy mocking
❌ Code duplication          ✅ DRY principle
❌ No abstraction            ✅ Clear interfaces
❌ Difficult maintenance     ✅ Easy maintenance
```

## File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── UserController.php         [Layer 1: HTTP]
│   │   ├── ProductController.php
│   │   └── ProviderController.php
│   ├── Requests/                       [Validation]
│   └── Traits/
│       └── ApiResponse.php             [Response Helper]
│
├── Services/
│   ├── UserService.php                 [Layer 2: Business Logic]
│   ├── ProductService.php
│   └── ProviderService.php
│
├── Repositories/
│   ├── Contracts/                      [Layer 3a: Abstraction]
│   │   ├── UserRepositoryInterface.php
│   │   ├── ProductRepositoryInterface.php
│   │   └── ProviderRepositoryInterface.php
│   └── Eloquent/                       [Layer 3b: Implementation]
│       ├── UserRepository.php
│       ├── ProductRepository.php
│       └── ProviderRepository.php
│
├── Models/                             [Layer 4: Data]
│   ├── User.php
│   ├── Product.php
│   └── Provider.php
│
└── Providers/
    └── AppServiceProvider.php          [DI Configuration]
```

## Testing Strategy

```
┌────────────────────────────────────────────────────────────┐
│                    UNIT TESTS                               │
├────────────────────────────────────────────────────────────┤
│                                                             │
│ Service Tests (Mock Repositories)                          │
│ ├─ UserService                                             │
│ │  └─ Mock UserRepositoryInterface                         │
│ │                                                           │
│ Repository Tests (Use In-Memory DB)                        │
│ ├─ UserRepository                                          │
│ │  └─ Test actual DB operations                            │
└────────────────────────────────────────────────────────────┘

┌────────────────────────────────────────────────────────────┐
│                 INTEGRATION TESTS                           │
├────────────────────────────────────────────────────────────┤
│                                                             │
│ Controller → Service → Repository → Model                  │
│ (Test the whole flow)                                       │
└────────────────────────────────────────────────────────────┘
```
