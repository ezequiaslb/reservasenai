<?php
// Inclua o arquivo header.php para incluir a barra de navegação e os scripts necessários
include('../includes/header.php');
?>

    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>

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
            <div id="calendario">

            
            </div>
                <div class="form-group">
                    <label for="horario">Horário</label>
                    <select id="horario" name="horario" class="form-control" required>
                        <option value="Matutino">Matutino</option>
                        <option value="Vespertino">Vespertino</option>
                        <option value="Noturno">Noturno</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Reservar</button>
            </form> 
        </div>
    </div>
</div>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>


<?php
include('../includes/footer.php');
?>
