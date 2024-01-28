<?php
// Inclua o arquivo header.php para incluir a barra de navegação e os scripts necessários
include('../includes/header.php');
?>

<!-- Conteúdo da Página de Gerenciamento de Usuários -->
<div class="container mt-4">
    <h1 class="mb-4">Gerenciar Usuários</h1>

    <!-- Botão para Adicionar Novo Usuário -->
    <a href="cadastrar_usuario.php" class="btn btn-success mb-4">Cadastrar Novo Usuário</a>

    <!-- Tabela de Usuários -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <!-- Cabeçalho da tabela -->
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <!-- Corpo da tabela -->
            <tbody>
                <!-- Placeholder para listar os usuários -->
                <tr>
                    <td>Nome do Usuário 1</td>
                    <td>usuario1@example.com</td>
                    <td>
                        <a href="editar_usuario.php?id=1" class="btn btn-primary">Editar</a>
                        <a href="#" onclick="confirmarExclusao(<?php echo $usuario_id; ?>);" class="btn btn-danger">Excluir Usuário</a>
                   </td>
                </tr>
                <!-- Adicione mais linhas conforme necessário -->
            </tbody>
        </table>
    </div>
</div>
<script>
    function confirmarExclusao(usuarioId) {
        if (confirm("Tem certeza de que deseja excluir este usuário?")) {
            // Se o usuário confirmar, redirecione para usuarios.php com a ação de exclusão e o ID do usuário
            window.location.href = "usuarios.php?action=excluir&id=" + usuarioId;
        }
        }
</script>
<?php
// Inclua o arquivo footer.php para encerrar a página
include('../includes/footer.php');
?>
