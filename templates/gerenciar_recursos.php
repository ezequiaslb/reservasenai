<?php
// Inclua o cabeçalho da página
include('../includes/header.php');

// Consulta SQL para buscar todos os recursos cadastrados
// Substitua 'sua_tabela_recursos' pelo nome real da tabela de recursos em seu banco de dados
$query = "SELECT * FROM sua_tabela_recursos";
// Execute a consulta e recupere os recursos

?>

<!-- Conteúdo da Página de Gerenciamento de Recursos -->
<div class="container mt-4">
    <h1 class="mb-4">Gerenciar Recursos</h1>

    <a href="cadastrar_recurso.php" class="btn btn-success mb-4">Cadastrar Novo recurso</a>


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
                    // Botão de edição que redireciona para editar_recurso.php com o ID do recurso
                    echo '<a href="editar_recurso.php?id=' . $row['id'] . '" class="btn btn-primary">Editar</a>';
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