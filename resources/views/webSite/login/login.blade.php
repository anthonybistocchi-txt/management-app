@vite(['resources/js/login/index.ts'])

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - GestãoPro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center min-vh-100 bg-primary">

    <div class="card shadow-lg login-card">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <i class="bi bi-person-circle" id="person" style="font-size: 3rem;"></i>
                <h2 class="mt-2">GestãoPro</h2>
                <p class="text-muted">Acesse sua conta</p>
            </div>

            <form id="form-login">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" placeholder="Digite seu e-mail">
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" placeholder="Digite sua senha">
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="lembrar">
                        <label class="form-check-label" for="lembrar">Lembrar-me</label>
                    </div>
                    <a href="#" class="text-decoration-none small" id="forgot-pwd">Esqueci a senha</a>
                </div>
                <button type="submit" id="btn-submit-login" class="btn btn-primary w-100">Entrar</button>
            </form>

            <div class="text-center mt-3">
                <p class="mb-0">Não tem conta? <a href="#" class="text-decoration-none" id="create-account">Cadastre-se</a></p>
            </div>
        </div>
    </div>

    <!-- Modal de erro -->
    <div id="modalError" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <div class="modal-title">
                        <h5 id="modalErrorMsg"></h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p id="modalSubMessage" class="mb-0"></p>
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
       background: linear-gradient(135deg, #1a1a1a, #3a3a3a);
        height: 100vh;
        font-family: 'Inter', sans-serif;
    }

    .login-card {
        max-width: 400px;
        width: 100%;
        border-radius: 1rem;
    }

    #btn-submit-login {
        background: #6c0cc7;
        border: none;
        color: #fff;
    }

    #btn-submit-login:hover {
        background: #490886ff;
    }

    #create-account, #forgot-pwd {
        color: #6c0cc7
    }

    #create-account:hover, #forgot-pwd:hover {
        color: #490886ff
    }

    #person {
        color: #6c0cc7;
    }
</style>