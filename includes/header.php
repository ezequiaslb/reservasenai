<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/pt-br.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<!-- Barra de navegação -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
    <a class="navbar-brand" href="/reservasenai/index.php">
                
        <?php if (isset($_SESSION['usuario_logado'])) : ?>
        <button class="btn btn-secondary">
                Sistema de Reservas
        </button>
        <?php endif; ?>

    </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['usuario_logado']) && isset($_SESSION['usuario_tipousuario']) && $_SESSION['usuario_tipousuario'] === 'administrador') : ?>
                 <li class="nav-item">
                    <a class="nav-link" href="/reservasenai/templates/administracao.php">Administração</a>
                </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['usuario_logado']) && isset($_SESSION['usuario_tipousuario']) && $_SESSION['usuario_tipousuario'] === 'administrador') : ?>
                 <li class="nav-item">
                    <a class="nav-link" href="/reservasenai/templates/gerenciar_recursos.php">Recursos</a>
                </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['usuario_logado']) && isset($_SESSION['usuario_tipousuario']) && $_SESSION['usuario_tipousuario'] === 'administrador') : ?>
                 <li class="nav-item">
                    <a class="nav-link" href="/reservasenai/templates/gerenciar_usuarios.php">Usuários</a>
                </li>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['usuario_logado'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/reservasenai/templates/reserva.php">Reservas</a>
                </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['usuario_logado'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/reservasenai/php/sair.php">Sair</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Conteúdo principal começa aqui -->
<div class="container mt-4">
