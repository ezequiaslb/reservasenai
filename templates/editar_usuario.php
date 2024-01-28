<?php
include('../includes/header.php');

// Lógica para verificar se o usuário está logado como administrador (você pode adicionar essa verificação)

// Lógica para carregar os dados do usuário a ser editado do banco de dados
$usuario_id = $_GET['id']; // Supondo que você receba o ID do usuário a ser editado na URL

// Realize uma consulta ao banco de dados para obter os dados do usuário com base no $usuario_id
// Preencha os campos do formulário com os dados do usuário

?>

<div class="container mt-4">
    <h1 class="mb-4">Editar Usuário</h1>

    <form action="usuarios.php?action=editar" method="post">
        <!-- Inclua campos ocultos para enviar o ID do usuário a ser editado -->
        <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">

        <div class="form-group">
            <label for="nome">Nome do Usuário</label>
            <input type="text" class="form-control" id="nome" name="nome" required value="<?php echo $nome_do_usuario; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required value="<?php echo $email_do_usuario; ?>">
        </div>
        <div class="form-group">
            <label for="senha">Nova Senha (opcional)</label>
            <input type="password" class="form-control" id="senha" name="senha">
        </div>
        <!-- Outros campos do usuário, se necessário -->
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>

<?php
include('../includes/footer.php');
?>
