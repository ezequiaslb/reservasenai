<?php
// Inclua o arquivo header.php para incluir a barra de navegação e os scripts necessários
include('../includes/header.php');

if (!isset($_SESSION['usuario_logado']) && $_SESSION['usuario_tipousuario'] !== 'administrador') {
    $_SESSION['mensagem'] = 'Acesso negado.';
    header('Location: ../templates/reserva.php');
    exit();
}

?>

<!-- Conteúdo da Página de Administração -->
<div class="container mt-4">
    <h1 class="mb-4">Administração</h1>

    <!-- Links para Cadastro de Recursos e Usuários -->
    <div class="mb-4">
        <a href="gerenciar_recursos.php" class="btn btn-primary">Gerenciar Recursos</a>
        <a href="gerenciar_usuarios.php" class="btn btn-success">Gerenciar Usuários</a>
    </div>

    <!-- Lista de Reservas Pendentes -->
    <h2>Reservas Pendentes</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <!-- Cabeçalho da tabela -->
            <thead>
                <tr>
                    <th>ID da Reserva</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Sala</th>
                    <th>Usuário</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <!-- Corpo da tabela -->
            <tbody>
                <!-- Placeholder para listar as reservas pendentes -->
                <tr>
                    <td>1</td>
                    <td>2024-01-31</td>
                    <td>09:00 - 10:00</td>
                    <td>Sala 1</td>
                    <td>Usuário 1</td>
                    <td>Pendente</td>
                    <td>
                        <button class="btn btn-success">Aprovar</button>
                        <button class="btn btn-danger">Rejeitar</button>
                    </td>
                </tr>
                <!-- Adicione mais linhas conforme necessário -->
            </tbody>
        </table>
    </div>

    <!-- Lista de Reservas Aprovadas/Rejeitadas -->
    <h2>Reservas Aprovadas/Rejeitadas</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <!-- Cabeçalho da tabela -->
            <thead>
                <tr>
                    <th>ID da Reserva</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Sala</th>
                    <th>Usuário</th>
                    <th>Status</th>
                </tr>
            </thead>
            <!-- Corpo da tabela -->
            <tbody>
                <!-- Placeholder para listar as reservas aprovadas/rejeitadas -->
                <tr>
                    <td>3</td>
                    <td>2024-02-05</td>
                    <td>11:00 - 12:00</td>
                    <td>Sala 1</td>
                    <td>Usuário 3</td>
                    <td>Aprovada</td>
                </tr>
                <!-- Adicione mais linhas conforme necessário -->
            </tbody>
        </table>
    </div>
</div>

<?php
// Inclua o arquivo footer.php para encerrar a página
include('../includes/footer.php');
?>
