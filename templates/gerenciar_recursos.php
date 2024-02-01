<?php
include('../includes/header.php');

if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_tipousuario'] !== 'administrador') {
    header('Location: ../index.php');
    exit();
}

include('../php/conexao.php');

$sqlTipos = "SELECT DISTINCT tipo FROM recursos";
$resultTipos = mysqli_query($conexao, $sqlTipos);

$tipoFiltro = isset($_GET['tipo']) ? $_GET['tipo'] : '';

$sqlRecursos = "SELECT * FROM recursos";
if (!empty($tipoFiltro)) {
    $sqlRecursos .= " WHERE tipo = '$tipoFiltro'";
}
$resultRecursos = mysqli_query($conexao, $sqlRecursos);

?>

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
    if (isset($_SESSION['mensagem'])) {
        echo '<div class="alert alert-info text-center">' . $_SESSION['mensagem'] . '</div>';
        unset($_SESSION['mensagem']);
    }
    ?>
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
                while ($rowRecurso = mysqli_fetch_assoc($resultRecursos)) {
                    echo '<tr>';
                    echo '<td>' . $rowRecurso['nome'] . '</td>';
                    echo '<td>' . $rowRecurso['tipo'] . '</td>';
                    echo '<td>' . $rowRecurso['quantidade_pessoas'] . '</td>';
                    echo '<td>';
                    echo '<a href="javascript:void(0);" onclick="confirmarExclusao(' . $rowRecurso['id'] . ');" class="btn btn-danger">Excluir</a>';

                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

    <script>
    function confirmarExclusao(idRecurso) {
        if (confirm('Tem certeza de que deseja excluir este recurso? Essa ação não pode ser desfeita.')) {
            window.location.href = '../php/recursos.php?action=excluir&id=' + idRecurso;
        }
    }
    </script>


<?php
include('../includes/footer.php');

mysqli_close($conexao);
?>
