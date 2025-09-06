@vite(['resources/js/login/index.ts'])

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - GestãoPro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>
    <div class="card shadow-lg login-card">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <i class="bi bi-person-circle text-primary" style="font-size: 3rem;"></i>
                <h4 class="mt-2">GestãoPro</h4>
                <p class="text-muted">Acesse sua conta</p>
            </div>

            <!-- Formulário -->
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
                    <a href="#" class="text-decoration-none small">Esqueci a senha</a>
                </div>
                <button type="submit" id="btn-submit-login" class="btn btn-primary w-100">Entrar</button>
            </form>

            <!-- Cadastro -->
            <div class="text-center mt-3">
                <p class="mb-0">Não tem conta? <a href="#" class="text-decoration-none">Cadastre-se</a></p>
            </div>
        </div>
    </div>

    <!DOCTYPE html>
<html lang="pt-BR">
@vite(['resources/js/modals/modalError.ts'])

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validação com Modal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Modal -->
    <div id="modalError" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-danger text-white">
                    <div class="modal-title">
                        <h5 id="modalErrorMsg"></h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Fechar"></button>
                </div>

                <div class="modal-body">
                    <p id="modalSubMessage" class="mb-0"></p>
                </div>

            </div>
        </div>
    </div>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<style>
     body {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            max-width: 400px;
            width: 100%;
            border-radius: 1rem;
        }
</style>