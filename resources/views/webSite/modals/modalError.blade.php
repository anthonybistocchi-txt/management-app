<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validação com Modal</title>
    @vite(['resources/css/app.css', 'resources/ts/app.ts'])
</head>

<body>
    <div class="container">
        <form id="form">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome">
            <button type="submit">Enviar</button>
        </form>
    </div>

    <!-- Modal -->
    <div id="modalError" class="modal">
        <div class="modal-content">
            <h3><span id="modalErrorMsg" class="close">;</h3></span>
            <p id="modalSubMessage"></p>
        </div>
    </div>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/modalError.js') }}"></script>
