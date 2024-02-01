User
<?php
//página de roteamento para ações de recursos
include_once('conexao.php');
// Verifique se uma ação foi definida

session_start();

    $action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : null);

       switch ($action) {
        
        case 'cadastrar':
            // Verifique se os campos obrigatórios estão definidos
            if (isset($_POST['nome']) && isset($_POST['tipo'])) {
                // Obtenha os dados do formulário
                $nome = $_POST['nome'];
                $tipo = $_POST['tipo'];
        
                // Inicialize a quantidade de pessoas como NULL
                $quantidade_pessoas = NULL;
        
                // Se o tipo de recurso for "espaço", verifique e defina a quantidade de pessoas
                if ($tipo === "espaço" && isset($_POST['quantidade_pessoas'])) {
                    $quantidade_pessoas = $_POST['quantidade_pessoas'];
        
                    // Valide a quantidade de pessoas (por exemplo, verifique se é um número válido)
                }
        
                // Valide os dados, por exemplo, verificando se o tipo é válido
        
                // Insira os dados no banco de dados (usando declaração preparada para segurança)
                $sql = "INSERT INTO recursos (nome, tipo, quantidade_pessoas) VALUES (?, ?, ?)";
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param("sss", $nome, $tipo, $quantidade_pessoas);
        
                if ($stmt->execute()) {
                    // Cadastro bem-sucedido, redirecione para uma página de sucesso ou de gerenciamento de recursos
                    header('Location: cadastro_sucesso.php');
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
                


            break;
            
    }

?>