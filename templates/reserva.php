<?php
include('../includes/header.php');

if (!isset($_SESSION['usuario_logado'])) {
    $_SESSION['mensagem'] = 'Acesso negado.';
    header('Location: ../index.php');
    exit();
}
include('../php/conexao.php');

?>

<div class="container mt-2">
    <div class="container mt-2">
        <h1 class="mb-2 display-4">Reservar Sala ou Equipamento</h1>
        <?php 
            if (isset($_SESSION['mensagem'])) {
                echo '<div class="alert alert-danger text-center">' . $_SESSION['mensagem'] . '</div>';
                unset($_SESSION['mensagem']);
            } 
        ?>

        <div class="row">
            <div class="col-md-6">
                <form action="../php/processar_reserva.php" method="post">
                    <div class="form-group">

                        <label for="tipo">Tipo</label>
                        <select id="tipo" name="tipo" class="form-control" required>
                            <option value="">Selecione um tipo</option>
                            <option value="espaço">Espaço</option>
                            <option value="equipamento">Equipamento</option>
                        </select>

                        <label for="recurso">Recurso</label>
                        <select id="recurso" name="recurso" class="form-control" required>
                            <option value="">Selecione um recurso</option>
                        </select>

                        <label for="horario">Horário</label>
                        <select id="horario" name="horario" class="form-control" required>
                            <option value="Matutino">Matutino</option>
                            <option value="Vespertino">Vespertino</option>
                            <option value="Noturno">Noturno</option>
                        </select>

                        <label for="calendar">Intervalo de Datas</label>
                        <input type="text" id="calendar" name="calendar" class="form-control" required>
                        <input type="hidden" id="selectedDates" name="selectedDates">

                        <button type="submit" class="btn btn-primary mt-4 mb-5">Reservar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <h2 class="display-4">Reservas</h2>
    <div class="row">
<?php
include('../php/conexao.php');

$query = "SELECT r.nome AS nome_recurso, r.tipo AS tipo_recurso, 
                rs.id, rs.data_inicio, rs.data_fim, rs.horario, rs.status
          FROM reservas rs
          INNER JOIN recursos r ON rs.recursos_id = r.id
          WHERE rs.usuario_id = {$_SESSION['usuario_id']}
          ORDER BY rs.data_criacao DESC
          ";
$result = mysqli_query($conexao, $query);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="card-deck">';
    while ($row = mysqli_fetch_assoc($result)) {
        // Determina a classe com base no status
        $statusClass = '';
        switch ($row['status']) {
            case 'pendente':
                $statusClass = 'status-pendente';
                break;
            case 'ativa':
                $statusClass = 'status-ativa';
                break;
            case 'concluída':
                $statusClass = 'status-concluida';
                break;
            case 'cancelada':
                $statusClass = 'status-cancelada';
                break;
        }
        $data_inicio = date('d/m/Y', strtotime($row['data_inicio']));
        $data_fim = date('d/m/Y', strtotime($row['data_fim'])); 

        echo '<div class="card mb-3">
                <div class="card-body ' . $statusClass . '">
                    <h3 class="card-text display-6">' . $row['nome_recurso'] . '</h3>               
                    <p class="card-text">Data de Início: ' . $data_inicio . '</p>
                    <p class="card-text">Data de Fim: ' . $data_fim . '</p>
                    <p class="card-text">Horário: ' . $row['horario'] . '</p>
                    <p class="card-text">Status: ' . $row['status'] . '</p>
                    <a href="cancelar_reserva.php?id=' . $row['id'] . '" class="btn btn-danger">Cancelar Reserva</a>
                    <!-- Outras informações da reserva aqui -->
                </div>
            </div>';
    }
    echo '</div>'; // Fecha a card-deck
} else {
    echo '<div class="alert alert-info text-center">Nenhuma reserva ativa.</div>';
}
?>

    
</div>
    

<script>
    var tipoSelecionado; // Declaração global

document.addEventListener('DOMContentLoaded', function() {
    $('#calendar').daterangepicker({
        opens: 'center', 
        autoApply: true, 
        locale: {
            format: 'DD-MM-YYYY', 
        },
    });

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        businessHours: true,
        select: function(info) {
            $('#selectedDates').val(info.start.format('DD-MM-YYYY') + ' - ' + info.end.format('DD-MM-YYYY'));
        },
        locale: 'pt-br'
    });
    calendar.render();
});

$(document).ready(function() {
    $('#tipo').change(function() {
        tipoSelecionado = $(this).val(); // Atribuição à variável global

        $.ajax({
            url: '../php/buscar_recursos.php', 
            method: 'GET',
            data: { tipo: tipoSelecionado },
            dataType: 'json',
            success: function(data) {
                $('#recurso').empty();
                $('#recurso').append('<option value="">Selecione um recurso</option>');

                $.each(data, function(index, recurso) {
                    $('#recurso').append('<option value="' + recurso.id + '">' + recurso.nome + '</option>');
                });
            },
            error: function() {
                console.error('Erro ao buscar recursos.');
            }
        });
    });
});

</script>

<?php
   include('../includes/footer.php');
?>
