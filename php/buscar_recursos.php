<?php 
// Conexão com o banco de dados
include('conexao.php');
var_dump($_POST);

if (isset($_POST['tipo'])) {
    $tipo = $_POST['tipo'];

    // Consulta SQL para buscar recursos do tipo selecionado
    $query = "SELECT id, nome FROM recursos WHERE tipo = '$tipo'";
    $result = mysqli_query($conexao, $query);

    $recursos = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $recursos[] = $row;
    }
    var_dump($recursos);

    // Retorne os recursos como JSON
    echo json_encode($recursos);
}

?>
