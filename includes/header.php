<!DOCTYPE html>
<html lang="pt-br">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas</title>
    <link rel="stylesheet" href="/reservasenai/css/bootstrap.min.css">
    <script src="/reservasenai/js/jquery.min.js"></script>
    <script src="/reservasenai/js/bootstrap.min.js"></script>
    <script src="/reservasenai/js/script.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
</head>
<body>

<!-- Barra de navegação -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
    <a class="navbar-brand" href="/reservasenai/index.php">
        <button class="btn btn-secondary">
                Sistema de Reservas
        </button>
    </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/reservasenai/templates/reserva.php">Reservas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/reservasenai/templates/administracao.php">Administração</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Conteúdo principal começa aqui -->
<div class="container mt-4">
