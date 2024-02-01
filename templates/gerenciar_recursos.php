<?php
// Inclua o cabeçalho da página
include('../includes/header.php');

// Verifique se o usuário está logado e é um administrador
if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_tipousuario'] !== 'administrador') {
    header('Location: ../index.php');
    exit();
}

// Inclua o arquivo de conexão com o banco de dados
include('../php/conexao.php');

// Consulte o banco de dados para obter a lista de tipos de recurso
$sqlTipos = "SELECT DISTINCT tipo FROM recursos";
$resultTipos = mysqli_query($conexao, $sqlTipos);

// Inicialize a variável de filtro
$tipoFiltro = isset($_GET['tipo']) ? $_GET['tipo'] : '';

// Consulte o banco de dados para obter a lista de recursos com base no tipo selecionado
$sqlRecursos = "SELECT * FROM recursos";
if (!empty($tipoFiltro)) {
    $sqlRecursos .= " WHERE tipo = '$tipoFiltro'";
}
$resultRecursos = mysqli_query($conexao, $sqlRecursos);

?>

<!-- Conteúdo da Página de Gerenciamento de Recursos -->
<div class="container mt-4">
    <h1 class="mb-4 display-4">Gerenciar Recursos</h1>

    <a href="cadastrar_recurso.php" class="mb-4 btn btn-info">Cadastrar Novo Recurso</a>


    <form method="get" class="mb-4 form-inline">
        <div class="form-group mr-2">
            <label for="tipoFiltro" class="mr-2">Filtrar</label>
            <select id="tipoFiltro" name="tipo" class="form-control">
                <option value="">Todos</option>
                <?php
                while ($rowTipo = mysqli_fetch_assoc($resultTipos)) {
                    $tipo = $rowTipo['tipo'];
                    $selected = ($tipo == $tipoFiltro) ? 'selected' : '';
                    echo '<option value="' . $tipo . '" ' . $selected . '>' . ucfirst($tipo) . '</option>';
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>
    <?php 
    // Verifique se há uma mensagem para exibir
    if (isset($_SESSION['mensagem'])) {
        echo '<div class="alert alert-info text-center">' . $_SESSION['mensagem'] . '</div>';
        unset($_SESSION['mensagem']);
    }
    ?>
    <!-- Lista de Recursos -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Quantidade de Pessoas</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop para exibir todos os recursos
                while ($rowRecurso = mysqli_fetch_assoc($resultRecursos)) {
                    echo '<tr>';
                    echo '<td>' . $rowRecurso['nome'] . '</td>';
                    echo '<td>' . $rowRecurso['tipo'] . '</td>';
                    echo '<td>' . $rowRecurso['quantidade_pessoas'] . '</td>';
                    // Outras colunas
                    echo '<td>';
                    // Botão de exclusão que redireciona para excluir_recurso.php com o ID do recurso
                    echo '<a href="../php/recursos.php?action=excluir&id=' . $rowRecurso['id'] . '" class="btn btn-danger">Excluir</a>';
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

// Feche a conexão com o banco de dados
mysqli_close($conexao);
?>
