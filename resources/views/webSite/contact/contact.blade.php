<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contato - GestãoPro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.html">GestãoPro</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.html">Início</a></li>
          <li class="nav-item"><a class="nav-link" href="sobre.html">Sobre Nós</a></li>
          <li class="nav-item"><a class="nav-link active" href="contato.html">Contato</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Conteúdo -->
  <div class="container py-5">
    <h1 class="mb-4 text-center">Fale Conosco</h1>
    <div class="row g-4">
      <!-- Formulário -->
      <div class="col-md-7">
        <div class="card shadow-sm">
          <div class="card-body">
            <form>
              <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" placeholder="Digite seu nome">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" placeholder="Digite seu e-mail">
              </div>
              <div class="mb-3">
                <label for="mensagem" class="form-label">Mensagem</label>
                <textarea id="mensagem" class="form-control" rows="4" placeholder="Escreva sua mensagem"></textarea>
              </div>
              <button type="submit" class="btn btn-primary w-100">Enviar</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Infos de contato -->
      <div class="col-md-5">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5><i class="bi bi-geo-alt-fill"></i> Endereço</h5>
            <p>Av. Principal, 123 - São Paulo, SP</p>
            <h5><i class="bi bi-telephone-fill"></i> Telefone</h5>
            <p>(11) 99999-9999</p>
            <h5><i class="bi bi-envelope-fill"></i> E-mail</h5>
            <p>contato@gestaopro.com</p>
            <h5><i class="bi bi-clock-fill"></i> Horário</h5>
            <p>Seg - Sex: 09h - 18h</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p class="mb-0">&copy; 2025 GestãoPro - Todos os direitos reservados</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script> src="js/contact/index.ts"</script>
</body>
</html>
