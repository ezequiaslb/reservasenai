<?php
include('../includes/header.php');

if (!isset($_SESSION['usuario_logado'])) {
    $_SESSION['mensagem'] = 'Acesso negado.';
    header('Location: ../index.php');
    exit();
}
    include('../php/conexao.php');
//depuração de erro
    if (isset($_POST['tipo'])) {
        $tipo = $_POST['tipo'];
    
        echo "O valor de 'tipo' é: " . $tipo;
    } else {
        echo "A variável 'tipo' não foi definida no formulário.";
    }
?>

<div class="container mt-2">
    <div class="container mt-2">
        <h1 class="mb-2">Reservar Sala ou Equipamento</h1>
        <?php 
            if (isset($_SESSION['mensagem'])) {
                echo '<div class="alert alert-danger text-center">' . $_SESSION['mensagem'] . '</div>';
                unset($_SESSION['mensagem']);
            } 
        ?>

        <div class="row">
            <div class="col-md-6">
                <form action="processar_reserva.php" method="post">
                    <div class="form-group">

                        <label for="tipo">Tipo</label>
                        <select id="tipo" name="tipo" class="form-control" required>
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
    <script>
        console.log(tipoSelecionado);
    </script>

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
</div>
<script>
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
    var tipoSelecionado;
    $(document).ready(function() {
        $('#tipo').change(function() {
            var tipoSelecionado = $(this).val();
        
            $.ajax({
                url: '../php/buscar_recursos.php', 
                method: 'POST',
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
