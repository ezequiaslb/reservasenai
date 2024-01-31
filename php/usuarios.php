<?php

include_once('conexao.php');
// Verifique se uma ação foi definida

session_start();

    if (isset($_POST['action']) && $_POST['action'] === 'cadastrar') {
    $action = $_POST['action'];
       switch ($action) {
        case 'cadastrar':
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cadastrar') {
                // Recupere os dados do formulário
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $tipousuario = $_POST['tipousuario'];
                $senha = $_POST['senha'];
                     
                $senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);
            
                // Insira o novo usuário no banco de dados usando prepared statement
                $stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, tipousuario, senha) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $nome, $email, $tipousuario, $senhaCriptografada);
            
                if ($stmt->execute()) {
                    // Cadastro bem-sucedido
                    $_SESSION['mensagem'] = 'Cadastro realizado com sucesso!';
                    header('Location: ../index.php');
                    exit();
                } else {
                    // Erro no cadastro
                    $_SESSION['mensagem'] = 'Erro ao cadastrar o usuário. Tente novamente.';
                    header('Location: ../templates/cadastrar_usuario.php'); 
                    exit();
                }
            } else {
                header('Location: pagina_inicial.php');
                exit();
            }
            break;
        
        case 'editar':
            // Lógica para editar um usuário existente
            // Recupere os dados do formulário usando $_POST
            // Valide os dados
            // Atualize o usuário no banco de dados
            // Redirecione o usuário para a página apropriada (sucesso ou erro)
            break;

        case 'excluir':
            // Lógica para excluir um usuário
            // Recupere o ID do usuário a ser excluído
            // Exclua o usuário do banco de dados
            // Redirecione o usuário para a página apropriada (sucesso ou erro)
            break;
        
        // Outros casos para outras ações, se necessário
        
        default:
            // Ação inválida, redirecione o usuário para uma página de erro
            break;
    }
} else {
    // Nenhuma ação definida, redirecione o usuário para uma página apropriada
}
?>

