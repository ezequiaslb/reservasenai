<?php

include('../includes/header.php');
?>

<div class="container mt-4">
    <h1 class="mb-4">Cadastro de Usuário</h1>

    <?php
        if (isset($_SESSION['mensagem'])) {
            echo '<div class="alert alert-error">' . $_SESSION['mensagem'] . '</div>';

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
            <div class="btn-danger center" id="email-availability-message"></div>
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

        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#email').on('blur', function() {
        var email = $(this).val();
        
        if (email) {
            $.ajax({
                url: '../php/verificar_disponibilidade.php',
                type: 'POST',
                data: {email: email},
                success: function(response) {
                    if (response == 'disponivel') {
                        $('#email-availability-message').html('');
                    } else if (response == 'indisponivel') {
                        $('#email-availability-message').html('Email já cadastrado. Por favor, escolha outro.');
                    }
                }
            });
        }
    });
});
</script>


<?php
include('../includes/footer.php');
?>
