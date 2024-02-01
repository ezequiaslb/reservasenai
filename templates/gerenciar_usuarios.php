<?php
include('../includes/header.php');
include('../php/conexao.php'); 

// Verifique se o usuário está logado e se é um administrador
if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_tipousuario'] !== 'administrador') {
    header('Location: ../index.php');
    exit();
}

function listarUsuarios($conexao) {
    $usuarios = array();
    $sql = "SELECT * FROM usuarios";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        while ($usuario = mysqli_fetch_assoc($resultado)) {
            $usuarios[] = $usuario;
        }
        mysqli_free_result($resultado);
    } else {
        echo "Erro na consulta: " . mysqli_error($conexao);
    }
    return $usuarios;
}
$usuarios = listarUsuarios($conexao); 
?>

<div class="container mt-4">
    <h1 class="mb-4">Gerenciar Usuários</h1>

    <a href="cadastrar_usuario.php" class="btn btn-success mb-4">Cadastrar Novo Usuário</a>

    <?php
        // Verifique se a variável de sessão 'mensagem' está definida
        if (isset($_SESSION['mensagem'])) {
            echo '<div class="alert alert-error">' . $_SESSION['mensagem'] . '</div>';

            // Após exibir a mensagem, você pode removê-la para não exibi-la novamente na próxima página
            unset($_SESSION['mensagem']);
        }
    ?>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario) : ?>
                    <tr>
                        <td><?php echo $usuario['nome']; ?></td>
                        <td><?php echo $usuario['email']; ?></td>
                        <td>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editarUsuarioModal<?php echo $usuario['id']; ?>">Editar Cadastro</a>
                            <a href="#" onclick="confirmarExclusao(<?php echo $usuario['id']; ?>, '<?php echo $usuario['nome']; ?>');" class="btn btn-danger">Excluir Usuário</a>
                        </td>
                    </tr>
                    <!-- Modal de Edição para o usuário atual -->
                    <div class="modal fade" id="editarUsuarioModal<?php echo $usuario['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuário</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="../php/usuarios.php" method="post">
                                    <input type="hidden" name="action" value="editar">
                                    <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>"> <!-- Adicione este campo -->
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="editUserName<?php echo $usuario['id']; ?>">Nome do Usuário</label>
                                            <input type="text" class="form-control" id="editUserName<?php echo $usuario['id']; ?>" name="novo_nome" value="<?php echo $usuario['nome']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editUserType<?php echo $usuario['id']; ?>">Tipo de Usuário</label>
                                            <select id="editUserType<?php echo $usuario['id']; ?>" name="novo_tipousuario" class="form-control" required>
                                                <option value="padrao" <?php if ($usuario['tipousuario'] == 'padrao') echo 'selected'; ?>>Padrão</option>
                                                <option value="administrador" <?php if ($usuario['tipousuario'] == 'administrador') echo 'selected'; ?>>Administrador</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmarExclusao(usuarioId, nomeUsuario) {
    if (confirm("Tem certeza de que deseja excluir o usuário " + nomeUsuario + "? Essa ação não pode ser desfeita.")) {
        // Se o usuário confirmar, redirecione para usuarios.php com a ação de exclusão e o ID do usuário
        window.location.href = "../php/usuarios.php?action=excluir&id=" + usuarioId;
    }
}

</script>

<?php
// Inclua o arquivo footer.php para encerrar a página
include('../includes/footer.php');
?>
