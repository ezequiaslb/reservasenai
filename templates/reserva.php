<?php
include('../includes/header.php');

if (!isset($_SESSION['usuario_logado'])) {
    $_SESSION['mensagem'] = 'Acesso negado.';
    header('Location: ../index.php');
    exit();
}

?>

<!-- Conteúdo da Página de Reservas -->
<div class="container mt-2">
    <!-- Formulário para Nova Reserva -->
    <div class="container mt-2">
        <h1 class="mb-2">Reservar Sala ou Equipamento</h1>
        <?php 
            if (isset($_SESSION['mensagem'])) {
                echo '<div class="alert alert-danger text-center">' . $_SESSION['mensagem'] . '</div>';
                unset($_SESSION['mensagem']);
            } 
            
    //var_dump($_SESSION['usuario_tipousuario']);
        ?>
        <div class="row">
            <div class="col-md-6">
                <form action="processar_reserva.php" method="post">
                    <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select id="tipo" name="tipo" class="form-control" required>
                        <option value="tipo1">Espaço</option>
                        <option value="tipo2">Projetores</option>
                        <option value="tipo3">Notebooks</option>
                    </select>

                    <label for="equipamento">Equipamento</label>
                    <select id="equipamento" name="equipamento" class="form-control" required>
                        <option value="Equipamento 1">Equipamento 1</option>
                        <option value="Equipamento 2">Equipamento 2</option>
                        <option value="Equipamento 3">Equipamento 3</option>
                    </select>
                    <label for="horario">Horário</label>
                    <select id="horario" name="horario" class="form-control" required>
                        <option value="Matutino">Matutino</option>
                        <option value="Vespertino">Vespertino</option>
                        <option value="Noturno">Noturno</option>
                    </select>
                    <Label for="calendar">Intervalo de Datas</Label>
                    <input type="text" id="calendar" name="calendar" class="form-control" required>
                    <input type="hidden" id="selectedDates" name="selectedDates">

                    <button type="submit" class="btn btn-primary mt-4 mb-5">Reservar</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

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
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicialize o Date Range Picker
        $('#calendar').daterangepicker({
            opens: 'center', // Define a posição do calendário
            autoApply: true, // Aplica automaticamente o intervalo selecionado
            locale: {
                format: 'DD-MM-YYYY', // Formato da data
                locale: "pt-br"
            },
        });

        // Inicialize o FullCalendar
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,
            businessHours: true,
            select: function(info) {
                // Quando o usuário selecionar um intervalo de datas, atualize o campo oculto
                $('#selectedDates').val(info.start.format('DD-MM-YYYY') + ' - ' + info.end.format('DD-MM-YYYY'));
            },
            locale: 'pt-br'
        });
        calendar.render();
    });
</script>

<?php
include('../includes/footer.php');
?>
