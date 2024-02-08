<?php 
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario_logado'])) {
    $_SESSION['mensagem'] = 'Acesso negado.';
    header('Location: ../index.php');
    exit();
}

// Verificar se o ID da reserva foi fornecido na URL
if (!isset($_GET['reserva_id'])) {
    $_SESSION['mensagem'] = 'ID de reserva não fornecido.';
    header('Location: ../templates/reserva.php');
    exit();
}

$reservaId = $_GET['reserva_id'];

include('../php/conexao.php');

$response = array();

$query = "UPDATE reservas SET status = 'cancelada' WHERE id = ?";
$stmt = $conexao->prepare($query);

if ($stmt) {
    $stmt->bind_param("i", $reservaId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response['status'] = 'sucesso'; // Mensagem de sucesso
    } else {
        $response['status'] = 'erro'; // Mensagem de erro
    }
} else {
    $response['status'] = 'erro'; // Mensagem de erro
}

// Enviar a resposta como JSON
header('Content-Type: application/json');
echo json_encode($response);
exit();


?>