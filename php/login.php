<?php
session_start();
include('conexao.php'); // Certifique-se de que o arquivo de conexão ao banco de dados está incluído aqui

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consultar o banco de dados para verificar o login
    $sql = "SELECT id, email, senha, tipousuario FROM usuarios WHERE email = ? LIMIT 1";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $dbEmail, $dbSenha, $tipousuario);
        $stmt->fetch();

        // Verificar a senha (você pode usar a função password_verify se estiver usando senhas hash)
        if ($senha === $dbSenha) {
            // Login bem-sucedido
            $_SESSION['usuario_logado'] = true;
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario_email'] = $dbEmail;
            $_SESSION['usuario_tipousuario'] = $tipousuario;

            // Redirecionar com base no tipo de usuário
            if ($tipousuario === 'administrador') {
                header('Location: administracao.php'); // Redirecionar para a página de administrador
            } else {
                header('Location: reservas.php'); // Redirecionar para a página de reservas padrão
            }
        } else {
            // Senha incorreta
            $_SESSION['mensagem'] = 'Senha incorreta. Tente novamente.';
            header('Location: index.php'); // Redirecionar de volta para a página de login
        }
    } else {
        // Email não encontrado no banco de dados
        $_SESSION['mensagem'] = 'Email não encontrado. Tente novamente ou crie uma conta.';
        header('Location: index.php'); // Redirecionar de volta para a página de login
    }

    $stmt->close();
    $conexao->close();
}
?>

