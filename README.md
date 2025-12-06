This project is a management system developed with Laravel on the back-end and HTML, Bootstrap, and JavaScript with TypeScript on the front-end.

**Note:** This project now follows **Clean Architecture** principles with a Repository pattern for better code organization and maintainability. See [Clean Architecture Documentation](documentation/clean-architecture.md) for details.

It provides a clean and responsive interface for handling key business operations, including:

📦 Product Inventory – manage stock levels, categories, and pricing.

🏭 Suppliers – register and organize supplier information.

👥 Clients – maintain a customer database with contact details.

📊 Dashboard – view business insights with quick summaries and tables.

🔐 Authentication – login page for secure access to the system.

📩 Contact & About pages – company information and communication form.

## Architecture

The application follows **Clean Architecture** with the following layers:

```
Routes → Controllers (+ ApiResponse) → Services → Repositories (Interfaces) → Models
```

### Key Benefits:
- **Separation of Concerns**: Each layer has a single, well-defined responsibility
- **Testability**: Easy to mock repositories for unit testing
- **Maintainability**: Organized code structure with standardized responses
- **Flexibility**: Easy to swap implementations or add features

For detailed architecture documentation, see [documentation/clean-architecture.md](documentation/clean-architecture.md).

The goal is to deliver a simple, scalable, and user-friendly management tool that combines the power of Laravel with a modern Bootstrap-based UI