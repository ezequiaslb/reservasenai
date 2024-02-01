<?php 



include('conexao.php');
var_dump($_POST['tipo']);

if (isset($_POST['tipo'])) {
    $tipo = $_POST['tipo'];


    $query = "SELECT id, nome FROM recursos WHERE tipo = '$tipo'";
    $result = mysqli_query($conexao, $query);

    $recursos = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $recursos[] = $row;
    }
    var_dump($recursos);

    
    echo json_encode($recursos);
}

?>
