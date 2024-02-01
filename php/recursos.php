User
<?php
include_once('conexao.php');

session_start();

    $action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : null);

       switch ($action) {
        
        case 'cadastrar':
            if (isset($_POST['nome']) && isset($_POST['tipo'])) {
                $nome = $_POST['nome'];
                $tipo = $_POST['tipo'];
        
                $quantidade_pessoas = NULL;
        
                if ($tipo === "espaço" && isset($_POST['quantidade_pessoas'])) {
                    $quantidade_pessoas = $_POST['quantidade_pessoas'];
        
                }
        
            
                $sql = "INSERT INTO recursos (nome, tipo, quantidade_pessoas) VALUES (?, ?, ?)";
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param("sss", $nome, $tipo, $quantidade_pessoas);
        
                if ($stmt->execute()) {
                    $_SESSION['mensagem'] = 'Recurso cadastrado com sucesso.';
                    header('Location: ../templates/gerenciar_recursos.php');
                    exit();
                } else {
                    // Erro no cadastro, redirecione de volta ao formulário de cadastro
                    $_SESSION['mensagem'] = 'Erro ao cadastrar o recurso.';
                    header('Location: cadastrar_recurso.php');
                    exit();
                }
            } else {
                // Campos obrigatórios não definidos, redirecione de volta ao formulário de cadastro
                $_SESSION['mensagem'] = 'Campos obrigatórios não preenchidos.';
                header('Location: cadastrar_recurso.php');
                exit();
            }
            break;
        
        
        
        case 'excluir':
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $idRecurso = $_GET['id'];
        
                // Verifique se o recurso existe
                $sqlVerificar = "SELECT id FROM recursos WHERE id = $idRecurso";
                $resultVerificar = mysqli_query($conexao, $sqlVerificar);
        
                if (mysqli_num_rows($resultVerificar) > 0) {
                    // O recurso existe, você pode prosseguir com a exclusão
                    $sqlExcluir = "DELETE FROM recursos WHERE id = $idRecurso";
                    if (mysqli_query($conexao, $sqlExcluir)) {
                        // Recurso excluído com sucesso
                        $_SESSION['mensagem'] = 'Recurso excluído com sucesso.';
                        header('Location: ../templates/gerenciar_recursos.php');
                        exit();
                    } else {
                        // Erro ao excluir o recurso
                        $_SESSION['mensagem'] = 'Erro ao excluir o recurso.';
                        header('Location: recursos.php');
                        exit();
                    }
                } else {
                    // O recurso não existe
                    $_SESSION['mensagem'] = 'Recurso não encontrado.';
                    header('Location: recursos.php');
                    exit();
                }
            } else {
                // ID inválido
                $_SESSION['mensagem'] = 'ID de recurso inválido.';
                header('Location: recursos.php');
                exit();
            }        


            break;
            
    }

?>