<?php
include('conexao.php'); // Certifique-se de ajustar o caminho conforme necessário

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Verificar se o email já está cadastrado
    $sql = "SELECT email FROM usuarios WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'indisponivel';
    } else {
        echo 'disponivel';
    }
}
?>
