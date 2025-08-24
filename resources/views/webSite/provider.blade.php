<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fornecedores - GestãoPro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.html">GestãoPro</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="estoque.html">Estoque</a></li>
          <li class="nav-item"><a class="nav-link active" href="fornecedores.html">Fornecedores</a></li>
          <li class="nav-item"><a class="nav-link" href="clientes.html">Clientes</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Conteúdo -->
  <div class="container py-5">
    <h1 class="mb-4">Fornecedores</h1>

    <div class="d-flex justify-content-between mb-3">
      <input type="text" class="form-control w-25" placeholder="Buscar fornecedor...">
      <button class="btn btn-primary"><i class="bi bi-plus-circle"></i> Adicionar Fornecedor</button>
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Cidade</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>#F001</td>
            <td>Tech Supplies</td>
            <td>(11) 98888-7777</td>
            <td>contato@techsupplies.com</td>
            <td>São Paulo - SP</td>
            <td>
              <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
              <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
            </td>
          </tr>
          <tr>
            <td>#F002</td>
            <td>Distribuidora XYZ</td>
            <td>(21) 97777-6666</td>
            <td>vendas@xyz.com</td>
            <td>Rio de Janeiro - RJ</td>
            <td>
              <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
              <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net
