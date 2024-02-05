<?php 
include('conexao.php');


if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];


    $query = "SELECT id, nome FROM recursos WHERE tipo = '$tipo'";
    $result = mysqli_query($conexao, $query);

    $recursos = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $recursos[] = $row;

    }
    
    echo json_encode($recursos);
}

?>
