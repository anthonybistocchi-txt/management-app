@vite(['resources/js/register/index.ts'])

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro - GestãoPro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center min-vh-100">

    <div class="card shadow-lg register-card">
        <div class="card-body p-4" id="card">
            <div class="text-center mb-4">
                <i class="bi bi-person-plus-fill" id="person" style="font-size: 3rem;"></i>
                <h2 class="mt-2 fw-semibold">Criar conta</h2>
                <p class="text-muted">Preencha os dados para se cadastrar</p>
            </div>

            <form id="form-register">
                <div class="mb-3">
                    <label for="name" class="form-label fw-medium">Nome completo</label>
                    <input type="text" class="form-control" id="name" placeholder="Digite seu nome completo" required>
                </div>
                <div class="mb-3">
                    <label for="cpf" class="form-label fw-medium">CPF</label>
                    <input type="text" class="form-control" id="cpf" placeholder="Digite seu cpf" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-medium">E-mail</label>
                    <input type="email" class="form-control" id="email" placeholder="Digite seu e-mail" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label fw-medium">Senha</label>
                    <input type="password" class="form-control" id="password" placeholder="Crie uma senha" required>
                </div>
                <div class="mb-3">
                    <label for="confirmar-senha" class="form-label fw-medium">Confirmar senha</label>
                    <input type="password" class="form-control" id="confirm-password" placeholder="Repita sua senha" required>
                </div>

                <div class="d-flex align-items-center mb-3">
                    <input type="checkbox" class="form-check-input me-2" id="termos" required>
                    <label for="termos" class="form-check-label small">
                        Concordo com os <a href="#" class="text-decoration-none" id="terms-link">termos de uso</a>
                    </label>
                </div>

                <button type="submit" id="btn-submit-register" class="btn btn-primary w-100">Cadastrar</button>
            </form>

            <div class="text-center mt-3">
                <p class="mb-0">Já tem uma conta? <a href="login" class="text-decoration-none" id="back-login">Entrar</a></p>
            </div>
        </div>
    </div>

    <!-- Modal de sucesso -->
    <div id="modalSuccess" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Cadastro realizado!</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p>Seu cadastro foi concluído com sucesso. Agora você pode fazer login.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bibliotecas externas -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<style>
    body {
        background: linear-gradient(135deg, #0d1b2a, #1b263b);
        font-family: 'Inter', sans-serif;
        color: #1b263b;
    }

    .register-card {
        max-width: 420px;
        width: 100%;
        border-radius: 1rem;
        background-color: #ffffff;
        border: none;
    }

    #card {
        border-radius: 10px;
    }

    #person {
        color: #213e75;
    }

    #btn-submit-register {
        background-color: #213e75;
        border: none;
        color: #fff;
        font-weight: 600;
        transition: all 0.2s ease-in-out;
    }

    #btn-submit-register:hover {
        background-color: #0056b3;
    }

    #back-login,
    #terms-link {
        color: #007bff;
        font-weight: 500;
    }

    #back-login:hover,
    #terms-link:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 0.5rem;
        box-shadow: none;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.15rem rgba(0, 123, 255, 0.25);
    }

    .card-body {
        background-color: #ffffff;
    }
</style>