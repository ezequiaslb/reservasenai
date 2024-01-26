<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario_logado'])) {
    // Exibir o formulário de login apenas se o usuário não estiver autenticado
    include('includes/header.php');
    echo '
    <!-- Conteúdo da Página Inicial -->
    <div class="jumbotron">
        <h1 class="display-4 row justify-content-center">Sistema de Reservas</h1>
        <p class="lead row justify-content-center">Faça suas reservas de salas e equipamentos</p>
        <hr class="my-4">
        
        
        <!-- Formulário de Login Centralizado -->
        <div class="text-center mt-4">
            <h2>Login</h2>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="username" class="sr-only"></label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Nome de Usuário" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only"></label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Senha" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-5">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>';

    include('includes/footer.php');
} else {
    // O restante do conteúdo da página continua aqui
    include('includes/header.php');
    echo '
    <!-- Conteúdo da Página Inicial -->
    <div class="jumbotron">
        <h1 class="display-4">Bem-vindo ao Sistema de Reservas</h1>
        <p class="lead">Faça suas reservas de salas e equipamentos de forma fácil e eficiente.</p>
        <hr class="my-4">
        <p>Utilize as opções de navegação para fazer uma reserva ou acessar a administração.</p>
    </div>';

    include('includes/footer.php');
}
?>
