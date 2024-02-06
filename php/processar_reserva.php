<?php

session_start();
include('../php/conexao.php');


$tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$recurso = filter_input(INPUT_POST, 'recurso', FILTER_VALIDATE_INT);
$horario = filter_input(INPUT_POST, 'horario', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$selectedDates = filter_input(INPUT_POST, 'calendar', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


if (empty($tipo) || empty($recurso) || empty($horario) || empty($selectedDates)) {
    $_SESSION['mensagem'] = 'Preencha todos os campos.';
    header("Location: ../templates/reserva.php");
    exit();
}

if (!$recurso) {
    $_SESSION['mensagem'] = 'Recurso inválido.';
    header("Location: ../templates/reserva.php");
    exit();
}

$datesArray = explode(" - ", $selectedDates);

    // Formate as datas no formato "AAAA-MM-DD"
    $data_inicio = date('Y-m-d', strtotime($datesArray[0]));
    $data_fim = date('Y-m-d', strtotime($datesArray[1]));

    // Verifique se a data de início é menor que a data de fim
    if ($data_inicio > $data_fim) {
        $_SESSION['mensagem'] = 'Data de início maior que a data de fim.';
        header("Location: ../templates/reserva.php");
        exit();
    }    

$query = "INSERT INTO reservas (recursos_id, usuario_id, data_inicio, data_fim, horario, status) VALUES (?, ?, ?, ?, ?, 'pendente')";
$stmt = $conexao->prepare($query);

if ($stmt) {
    
    $usuario_id = $_SESSION['usuario_id'];

    $stmt->bind_param("iisss", $recurso, $usuario_id, $data_inicio, $data_fim, $horario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['mensagem'] = 'Reserva realizada com sucesso!';
        header("Location: ../templates/reserva.php");
        exit();
    } else {
        $_SESSION['mensagem'] = 'Erro ao realizar a reserva. Tente novamente.';
        header("../templates/reserva.php");
        exit();
    }
} else {
    $_SESSION['mensagem'] = 'Erro ao realizar a reserva. Tente novamente.';
    header("../templates/reserva.php");
    exit();
}
?>
