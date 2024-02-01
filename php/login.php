<?php
session_start();
include('conexao.php'); // Certifique-se de que o arquivo de conexão ao banco de dados está incluído aqui

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consultar o banco de dados para verificar o login
    $sql = "SELECT id, nome, email, senha, tipousuario FROM usuarios WHERE email = ? LIMIT 1";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $dbnome, $dbEmail, $dbSenha, $tipousuario);
        $stmt->fetch();

    
        if (password_verify($senha, $dbSenha)) {
        
            $_SESSION['usuario_logado'] = true;
            $_SESSION['usuario_nome'] = $dbnome;
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario_email'] = $dbEmail;
            $_SESSION['usuario_tipousuario'] = $tipousuario;

            if ($tipousuario === 'administrador') {
                header('Location: ../templates/administracao.php'); 
            } else {
                header('Location: ../templates/reserva.php');
            }
        } else {
           
            $_SESSION['mensagem'] = 'Senha incorreta. Tente novamente.';
            header('Location: ../index.php'); 
        }
    } else {
        
        $_SESSION['mensagem'] = 'Email não encontrado. Tente novamente ou crie uma conta.';
        header('Location: ../index.php'); 
    }

    $stmt->close();
    $conexao->close();
}
?>
