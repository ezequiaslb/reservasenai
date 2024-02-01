<?php
include('../includes/header.php');

if (!isset($_SESSION['usuario_logado']) && $_SESSION['usuario_tipousuario'] !== 'administrador') {
    $_SESSION['mensagem'] = 'Acesso negado.';
    header('Location: ../templates/reserva.php');
    exit();
}

?>

<div class="container mt-4">
    <h1 class="mb-4 display-4">Administração</h1>

    <h2>Reservas Pendentes</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
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
            <tbody>
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
            </tbody>
        </table>
    </div>

    <h2>Reservas Aprovadas/Rejeitadas</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
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
            <tbody>
                <tr>
                    <td>3</td>
                    <td>2024-02-05</td>
                    <td>11:00 - 12:00</td>
                    <td>Sala 1</td>
                    <td>Usuário 3</td>
                    <td>Aprovada</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
include('../includes/footer.php');
?>
