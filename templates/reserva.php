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
    <div class="container mt-4">
        <h1 class="mb-4">Reservar Sala ou Equipamento</h1>
        <div class="row">
            <div class="col-md-6">
                <form action="processar_reserva.php" method="post">
                    <input type="text" id="calendar" name="calendar" class="form-control" required>
                    
                    <label for="horario">Horário</label>
                    <select id="horario" name="horario" class="form-control" required>
                        <option value="Matutino">Matutino</option>
                        <option value="Vespertino">Vespertino</option>
                        <option value="Noturno">Noturno</option>
                    </select>

                    <!-- Adicione um campo oculto para armazenar as datas selecionadas pelo Date Range Picker -->
                    <input type="hidden" id="selectedDates" name="selectedDates">

                    <button type="submit" class="btn btn-primary">Reservar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- No final do seu arquivo HTML, antes de fechar o </body> -->
<script src="https://cdn.jsdelivr.net/momentjs/2.29.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/4/daterangepicker.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicialize o Date Range Picker
        $('#calendar').daterangepicker({
            opens: 'left', // Define a posição do calendário
            autoApply: true, // Aplica automaticamente o intervalo selecionado
            locale: {
                format: 'MM-DD-YYYY', // Formato da data
                "language": "pt-br"
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
                $('#selectedDates').val(info.start.format('YYYY-MM-DD') + ' - ' + info.end.format('YYYY-MM-DD'));
            },
            locale: 'pt-br'
        });
        calendar.render();
    });
</script>
<?php
include('../includes/footer.php');
?>
