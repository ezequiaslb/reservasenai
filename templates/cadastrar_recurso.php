<?php
include('../includes/header.php');

if (!isset($_SESSION['usuario_logado']) && $_SESSION['usuario_tipousuario'] !== 'administrador') {
    $_SESSION['mensagem'] = 'Acesso negado.';
    header('Location: ../templates/reserva.php');
    exit();
}
?>

<div class="container mt-4">
<h1>Cadastrar Recurso</h1>
        <form action="../php/recursos.php" method="post">
        <input type="hidden" name="action" value="cadastrar">
            <div class="form-group">
                <label for="nome">Nome do Recurso</label>
                <input type="text" id="nome" name="nome" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo de Recurso</label>
                <select id="tipo" name="tipo" class="form-control" required>
                    <option value="espaço">Espaço</option>
                    <option value="equipamento">Equipamento</option>
                </select>
            </div>
            <div class="form-group">
                <label for="quantidade_pessoas">Quantidade de Pessoas (apenas para espaços)</label>
                <input type="number" id="quantidade_pessoas" name="quantidade_pessoas" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
</div>

<?php
include('../includes/footer.php');
?>
