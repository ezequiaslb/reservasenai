<?php

if (!isset($_SESSION['usuario_logado'])) {
    include('includes/header.php');
    
    echo '
    <!-- Conteúdo da Página Inicial -->
    <div class="jumbotron">
        <h1 class="display-4 row justify-content-center">Sistema de Reservas</h1>';
        

            if (isset($_SESSION['mensagem'])) {
                echo '<div class="alert alert-success text-center">' . $_SESSION['mensagem'] . '</div>';

                unset($_SESSION['mensagem']);
            }
          
        echo '<p class="lead row justify-content-center">Faça login para continuar</p>        
        
        <!-- Formulário de Login Centralizado -->
        <div class="text-center mt-4">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form action="php/login.php" method="post">
                        <div class="form-group">
                            <label for="email" class="sr-only"></label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="form-group">
                            <label for="senha" class="sr-only"></label>
                            <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-5">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>';

    include('includes/footer.php');
} else {
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
