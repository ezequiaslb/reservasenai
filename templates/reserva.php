<?php
// Inclua o arquivo header.php para incluir a barra de navegação e os scripts necessários
include('../includes/header.php');
?>

<!-- Conteúdo da Página de Reservas -->
<div class="container mt-2">
    <!-- Formulário para Nova Reserva -->
    <div class="container mt-2">
        <h1 class="mb-2">Reservar Sala ou Equipamento</h1>
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
                format: 'MM-DD-YYYY', // Formato da data
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
                $('#selectedDates').val(info.start.format('YYYY-MM-DD') + ' até ' + info.end.format('YYYY-MM-DD'));
            },
            locale: 'pt-br'
        });
        calendar.render();
    });
</script>
<br>
<br>
<?php
include('../includes/footer.php');
?>
