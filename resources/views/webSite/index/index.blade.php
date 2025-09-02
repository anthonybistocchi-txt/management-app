<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Painel de Gestão</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Ícones -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#">GestãoPro</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarGestao">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarGestao">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-person-circle"></i> Perfil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-box-arrow-right"></i> Sair</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse vh-100 border-end">
        <div class="position-sticky p-3">
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center mb-3 text-muted">
            <span>Menu</span>
          </h6>
          <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link active" href="#"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-box-seam"></i> Estoque</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-people"></i> Clientes</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-cart4"></i> Vendas</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-gear"></i> Configurações</a></li>
          </ul>
        </div>
      </nav>

      <!-- Conteúdo principal -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
        <h1 class="h2 mb-4">Dashboard</h1>

        <!-- Cards de resumo -->
        <div class="row g-4">
          <div class="col-md-3">
            <div class="card text-bg-primary shadow-sm">
              <div class="card-body">
                <h5 class="card-title">Vendas Hoje</h5>
                <p class="card-text fs-4">R$ 1.250,00</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-bg-success shadow-sm">
              <div class="card-body">
                <h5 class="card-title">Clientes Ativos</h5>
                <p class="card-text fs-4">320</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-bg-warning shadow-sm">
              <div class="card-body">
                <h5 class="card-title">Pedidos Pendentes</h5>
                <p class="card-text fs-4">15</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-bg-danger shadow-sm">
              <div class="card-body">
                <h5 class="card-title">Produtos em Falta</h5>
                <p class="card-text fs-4">8</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Tabela de últimos registros -->
        <div class="mt-5">
          <h4>Últimas Vendas</h4>
          <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
              <thead class="table-dark">
                <tr>
                  <th>ID</th>
                  <th>Cliente</th>
                  <th>Produto</th>
                  <th>Data</th>
                  <th>Status</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>#1001</td>
                  <td>Ana Souza</td>
                  <td>Teclado Gamer</td>
                  <td>24/08/2025</td>
                  <td><span class="badge bg-success">Pago</span></td>
                  <td>R$ 250,00</td>
                </tr>
                <tr>
                  <td>#1002</td>
                  <td>Lucas Lima</td>
                  <td>Mouse Wireless</td>
                  <td>24/08/2025</td>
                  <td><span class="badge bg-warning text-dark">Pendente</span></td>
                  <td>R$ 120,00</td>
                </tr>
                <tr>
                  <td>#1003</td>
                  <td>Maria Oliveira</td>
                  <td>Headset</td>
                  <td>23/08/2025</td>
                  <td><span class="badge bg-danger">Cancelado</span></td>
                  <td>R$ 300,00</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
