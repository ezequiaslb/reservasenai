<?php

include('../includes/header.php');
?>

<div class="container mt-4">
    <h1 class="mb-4">Cadastro de Usuário</h1>

    <?php
        session_start();

        // Verifique se a variável de sessão 'mensagem' está definida
        if (isset($_SESSION['mensagem'])) {
            echo '<div class="alert alert-error">' . $_SESSION['mensagem'] . '</div>';

            // Após exibir a mensagem, você pode removê-la para não exibi-la novamente na próxima página
            unset($_SESSION['mensagem']);
        }
    ?>

    <form action="../php/usuarios.php" method="post">
        <div class="form-group">
            <label for="nome">Nome do Usuário</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="tipousuario">Tipo de Usuário</label>
            <select id="tipousuario" name="tipousuario" class="form-control" required>
                <option value="padrao">Padrão</option>
                <option value="administrador">Administrador</option>
            </select>
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <input type="hidden" name="action" value="cadastrar">

        <!-- Outros campos do usuário, se necessário -->
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

<?php
include('../includes/footer.php');
?>
