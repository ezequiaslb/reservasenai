<?php

include_once('conexao.php');
// Verifique se uma ação foi definida

session_start();

    $action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : null);

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
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'editar') {
                    // Verifique se o ID do usuário está presente nos dados do formulário
                    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
                        $usuarioId = $_POST['id'];
                        
                        // Recupere os dados do formulário
                        $novoNome = $_POST['novo_nome'];
                        $novoTipoUsuario = $_POST['novo_tipousuario'];
                        
                        // Atualize o usuário no banco de dados usando prepared statement
                        $consulta = "UPDATE usuarios SET nome = ?, tipousuario = ? WHERE id = ?";
                        $stmt = $conexao->prepare($consulta);
                        $stmt->bind_param("ssi", $novoNome, $novoTipoUsuario, $usuarioId);
                        
                        if ($stmt->execute()) {
                            // Atualização bem-sucedida
                            $_SESSION['mensagem'] = 'Usuário atualizado com sucesso!';
                        } else {
                            // Erro na atualização
                            $_SESSION['mensagem'] = 'Erro ao atualizar o usuário. Tente novamente.';
                        }
                    } else {
                        // ID de usuário inválido
                        $_SESSION['mensagem'] = 'ID de usuário inválido.';
                    }
                    
                    // Redirecione de volta para a página de gerenciamento de usuários
                    header('Location: ../templates/gerenciar_usuarios.php');
                    exit();
                } else {
                    // Caso de acesso inválido
                    header('Location: ../templates/gerenciar_usuarios.php');
                    exit();
                }
                break;
            

            case 'excluir':
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $usuarioId = $_GET['id'];
                    
                    // Verifique se o usuário existe antes de excluir
                    $consulta = "SELECT id FROM usuarios WHERE id = ?";
                    $stmt = $conexao->prepare($consulta);
                    $stmt->bind_param("i", $usuarioId);
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                    
                    if ($resultado->num_rows > 0) {
                        // O usuário existe, execute a exclusão
                        $consulta = "DELETE FROM usuarios WHERE id = ?";
                        $stmt = $conexao->prepare($consulta);
                        $stmt->bind_param("i", $usuarioId);
                        
                        if ($stmt->execute()) {
                            // Exclusão bem-sucedida
                            $_SESSION['mensagem'] = 'Usuário excluído com sucesso!';
                        } else {
                            // Erro na exclusão
                            $_SESSION['mensagem'] = 'Erro ao excluir o usuário. Tente novamente.';
                        }
                    } else {
                        // O usuário não existe
                        $_SESSION['mensagem'] = 'Usuário não encontrado.';
                    }
                } else {
                    // ID de usuário inválido
                    $_SESSION['mensagem'] = 'ID de usuário inválido.';
                }
                
                // Redirecione de volta para a página de gerenciamento de usuários
                header('Location: ../templates/gerenciar_usuarios.php');
                exit();
                break;
            
    }

?>

