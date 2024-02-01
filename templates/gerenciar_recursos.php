<?php
// Inclua o cabeçalho da página
include('../includes/header.php');

// Verifique se o usuário está logado e é um administrador
if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_tipousuario'] !== 'administrador') {
    header('Location: ../index.php');
    exit();
}

?>

<!-- Conteúdo da Página de Gerenciamento de Recursos -->
<div class="container mt-4">
    <h1 class="mb-4 display-4">Gerenciar Recursos</h1>

    <a href="cadastrar_recurso.php" class="btn btn-info mb-4">Cadastrar Novo recurso</a>


    <!-- Lista de Recursos -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <!-- Outras colunas necessárias -->
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop para exibir todos os recursos
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['nome'] . '</td>';
                    echo '<td>' . $row['tipo'] . '</td>';
                    // Outras colunas
                    echo '<td>';
                    // Botão de exclusão que redireciona para excluir_recurso.php com o ID do recurso
                    echo '<a href="excluir_recurso.php?id=' . $row['id'] . '" class="btn btn-danger">Excluir</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Inclua o rodapé da página
include('../includes/footer.php');
?>
