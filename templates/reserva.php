<?php
// Inclua o arquivo header.php para incluir a barra de navegação e os scripts necessários
include('../includes/header.php');
?>

<!-- Conteúdo da Página de Reservas -->
<div class="container mt-4">
    <h1 class="mb-4">Suas Reservas</h1>

    <!-- Seção de Reservas Ativas -->
    <h2>Reservas Ativas</h2>
    <div class="row">
        <!-- Placeholder para listar as reservas ativas -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Reserva Ativa 1</h5>
                    <p class="card-text">Informações da reserva...</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Reserva Ativa 2</h5>
                    <p class="card-text">Informações da reserva...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulário para Nova Reserva -->
    <h2>Fazer Nova Reserva</h2>
    <div class="row">
        <div class="col-md-6">
            <form action="#" method="post">
                <div class="form-group">
                    <label for="sala">Selecione uma Sala</label>
                    <select class="form-control" id="sala" name="sala" required>
                        <option value="sala1">Sala 1</option>
                        <option value="sala2">Sala 2</option>
                        <!-- Adicione mais opções aqui -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="data">Data da Reserva</label>
                    <input type="date" class="form-control" id="data" name="data" required>
                </div>
                <div class="form-group">
                    <label for="horario">Horário da Reserva</label>
                    <input type="time" class="form-control" id="horario" name="horario" required>
                </div>
                <button type="submit" class="btn btn-primary">Fazer Reserva</button>
            </form>
        </div>
    </div>
</div>

<?php
include('../includes/footer.php');
?>
