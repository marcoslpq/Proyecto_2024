<?php
require("../php/conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_deporte = $_POST['tipo-deporte'];
    $dia = $_POST['dia'];
    $cancha = $_POST['numero-de-cancha'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_finalizado = $_POST['hora_finalizado'];

    // Obtener ID del día de la tabla días
    $dias = array("Lunes" => 1, "Martes" => 2, "Miercoles" => 3, "Jueves" => 4, "Viernes" => 5, "Sabado" => 6, "Domingo" => 7);
    $id_dia = $dias[$dia];

    // Verificar si ya existe un registro con los mismos detalles
    $sql = "SELECT * FROM deporte_cancha_hora 
            WHERE id_deporte = ? 
            AND id_dia = ? 
            AND cancha = ? 
            AND ((hora_inicio <= ? AND hora_finalizado > ?) 
            OR (hora_inicio < ? AND hora_finalizado >= ?))";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iiissss", $id_deporte, $id_dia, $cancha, $hora_inicio, $hora_inicio, $hora_finalizado, $hora_finalizado);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "<script>alert('Ya existe el registro que quieres asignar'); window.location.href = 'agregar-horario-cancha.php';</script>";
    } else {
        // Si no existe, insertar el nuevo registro
        $sql = "INSERT INTO deporte_cancha_hora (id_deporte, id_dia, cancha, hora_inicio, hora_finalizado, activa_s_n) 
                VALUES (?, ?, ?, ?, ?, 'SI')";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("iiiss", $id_deporte, $id_dia, $cancha, $hora_inicio, $hora_finalizado);
        if ($stmt->execute()) {
            echo "<script>alert('Horario agregado exitosamente'); window.location.href = 'agregar-horario-cancha.php';</script>";
        } else {
            echo "<script>alert('Error al agregar el horario'); window.location.href = 'agregar-horario-cancha.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLUB SOCIAL Y DEPORTIVO SAN CARLOS</title>
    <script src="https://kit.fontawesome.com/bfbcf1faa2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<header>
        <div class="conteiner">
            <div class="inicio px-4">
                <a href="../index.html">
                    <img src="../img/1.png" alt="emblema" class="img">
                </a>
                <h4 class="texto">CLUB SOCIAL Y DEPORTIVO SAN CARLOS</h4>
            </div>
            <div class="d-md-flex justify-content-md-end">
                <i class="fa-solid fa-user icono"></i>   
                <a class="btn btn-success" href="../php/cerrarsesion.php">Cerrar sesion</a>
            </div>
        </div>
    </header>

    <main class="container">
    <div class="row justify-content-center">
    <div class="col-md-5">

    <form class="row g-3 mt-3" name="formularioAgregar" method="POST" autocomplete="off" action="./agregar-horario-cancha.php">
        <div class="col-md-12">
                    <label for="tipo-deporte" class="form-label">Tipo de deporte</label>
                    <select name="tipo-deporte" id="tipo-deporte" class="form-select" aria-label="Default select example">
                        <option value="" selected disabled>Seleccione un deporte</option>
                        <?php
                            require("../php/conexion.php");
                            $sql="SELECT ID, Descripcion FROM deporte WHERE activa_s_n = 'SI'";
                            $resultado = $conexion->query($sql);
                            while ($valores = mysqli_fetch_array($resultado)) {
                                echo '<option value ="'.$valores['ID'].'">'.$valores['Descripcion'].'</option>';
                            }
                        ?>
                    </select>
        </div>
        <div class="col-md-12">
                    <label for="dia" class="form-label">Dia</label>
                    <select name="dia" id="dia" class="form-select" aria-label="Default select example">
                        <option value="Lunes" selected>Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miercoles">Miercoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                        <option value="Sabado">Sabado</option>
                        <option value="Domingo">Domingo</option>
                    </select>
        </div>
        <div class="col-md-12">
            <label for="numero-de-cancha" class="form-label">Nº de Cancha</label>
            <select name="numero-de-cancha" id="numero-de-cancha" class="form-select" aria-label="Default select example">
                <option value="" selected disabled></option>
            </select>
        </div>
        <div class="col-md-6 mt-3">
            <label for="hora_inic" class="form-label">Horario Inicio</label>
            <select name="hora_inicio" class="form-select" id="hora_inic" required>
                <option value="07:00">07:00</option>
                <option value="08:00">08:00</option>
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
                <option value="17:00">17:00</option>
                <option value="18:00">18:00</option>
                <option value="19:00">19:00</option>
                <option value="20:00">20:00</option>
                <option value="21:00">21:00</option>
                <option value="22:00">22:00</option>
                <option value="23:00">23:00</option>
                <option value="23:30">00:00</option>
            </select>
        </div>
        <div class="col-md-6 mt-3">
            <label for="hora_fin" class="form-label">Horario Final</label>
            <select name="hora_finalizado" class="form-select" id="hora_fin" required>
                <option value="08:00">08:00</option>
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
                <option value="17:00">17:00</option>
                <option value="18:00">18:00</option>
                <option value="19:00">19:00</option>
                <option value="20:00">20:00</option>
                <option value="21:00">21:00</option>
                <option value="22:00">22:00</option>
                <option value="23:00">23:00</option>
                <option value="23:30">00:00</option>
            </select>
        </div>
        <div class="col-md-6">
            <button type="submit" class="btn btn-warning mt-3 col-md-12">Agregar</button>
        </div>
        <div class="col-md-6">
            <a href="../pages/tabla-deporte-cancha-hora.php" class="btn btn-danger mt-3 col-md-12">Volver</a>
        </div>
    </form>
    <?php if (!empty($mensaje)): ?>
    <div class="alert alert-warning mt-3"><?php echo $mensaje; ?></div>
    <?php endif; ?>
    </div>

        </div>
    </div>
</main>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
        $(document).ready(function() {
            $('#tipo-deporte').change(function() {
                var deporteId = $(this).val();
                $.ajax({
                    url: '../php/obtener_canchas.php',
                    method: 'GET',
                    data: { id_deporte: deporteId },
                    success: function(data) {
                        $('#numero-de-cancha').html(data);
                    }
                });
            });
        });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const horaInicio = document.getElementById('hora_inic');
        const horaFin = document.getElementById('hora_fin');
        const todasLasHoras = Array.from(horaFin.options);

    horaInicio.addEventListener('change', function () {
        const horaSeleccionada = this.value;
        const [hora, minuto] = horaSeleccionada.split(':').map(Number);

    // Limpiar las opciones actuales de hora_fin
        horaFin.innerHTML = '';

        // Filtrar y agregar las nuevas opciones
        todasLasHoras.forEach(option => {
            const [opHora, opMinuto] = option.value.split(':').map(Number);
            if (opHora > hora || (opHora === hora && opMinuto > minuto)) {
                horaFin.appendChild(option);
            }
        });
    });
    });
</script>
</body>
</html>
