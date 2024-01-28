<?php
include('../includes/header.php');
?>

<div class="container mt-4">
    <h1 class="mb-4">Cadastro de Usuário</h1>

    <form action="usuarios.php?action=cadastrar" method="post">
        <div class="form-group">
            <label for="nome">Nome do Usuário</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <!-- Outros campos do usuário, se necessário -->
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

<?php
include('../includes/footer.php');
?>
