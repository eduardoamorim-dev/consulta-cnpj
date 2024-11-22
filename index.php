<?php
require_once __DIR__ . '/api/cnpjApi.php'; // Inclui o arquivo com a função buscarCNPJ

// Exemplo de uso
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['cnpj'])) {
    $cnpj = preg_replace('/[^0-9]/', '', $_GET['cnpj']);
    $dados = buscarCNPJ($cnpj); // Chama a função de cnpjApi.php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de CNPJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Consulta de CNPJ</h1>

        <form method="GET" class="card p-4 shadow">
            <div class="mb-3">
                <label for="cnpj" class="form-label">Digite o CNPJ:</label>
                <input type="text" id="cnpj" name="cnpj" class="form-control" placeholder="00.000.000/0000-00" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </form>

        <?php if (isset($dados)): ?>
            <div class="card mt-4 p-4 shadow">
                <h2 class="text-center">Resultado</h2>
                <?php if (isset($dados['error'])): ?>
                    <div class="alert alert-danger mt-3">
                        <?= htmlspecialchars($dados['error']) ?>
                    </div>
                <?php else: ?>
                    <ul class="list-group mt-3">
                        <li class="list-group-item"><strong>Nome Fantasia:</strong> <?= htmlspecialchars($dados['nome_fantasia'] ?? 'N/A') ?></li>
                        <li class="list-group-item"><strong>Razão Social:</strong> <?= htmlspecialchars($dados['razao_social'] ?? 'N/A') ?></li>
                        <li class="list-group-item"><strong>CNPJ:</strong> <?= htmlspecialchars($dados['cnpj']) ?></li>
                        <li class="list-group-item"><strong>UF:</strong> <?= htmlspecialchars($dados['uf'] ?? 'N/A') ?></li>
                        <li class="list-group-item"><strong>Município:</strong> <?= htmlspecialchars($dados['municipio'] ?? 'N/A') ?></li>
                        <li class="list-group-item"><strong>Atividade Principal:</strong> <?= htmlspecialchars($dados['cnae_fiscal_descricao'] ?? 'N/A') ?></li>
                    </ul>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/np