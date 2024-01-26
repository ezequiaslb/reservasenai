<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario_logado'])) {
    // Redirecionar para a página de login se o usuário não estiver autenticado
    header('Location: login.php');
    exit();
}

// Verificar se o usuário possui reservas ativas (faça a consulta ao banco de dados aqui)

// Incluir o cabeçalho da página


// Incluir o rodapé da página
include('includes/footer.php');
?>

