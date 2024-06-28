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
            <a class="btn btn-success" href="../php/cerrarsesion.php">Cerrar sesión</a>
        </div>
    </div>
</header>

<main>
    <h1 class="text-center p-3">DEPORTE-CANCHA-HORA</h1>
    <div class="container mt-4 mb-2">
        <div class="table-responsive">
            <!-- Campo de búsqueda -->
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        <select id="search-deporte" class="form-select">
                            <option value="">Seleccionar Deporte</option>
                            <option value="futbol">Futbol</option>
                            <option value="voley">Voley</option>
                            <option value="basquet">Basquet</option>
                            <option value="hockey">Hockey</option>
                        </select>
                    </div>
                    <div class="col">
                        <select id="search-dia" class="form-select">
                            <option value="">Seleccionar Día</option>
                            <option value="1">Lunes</option>
                            <option value="2">Martes</option>
                            <option value="3">Miércoles</option>
                            <option value="4">Jueves</option>
                            <option value="5">Viernes</option>
                            <option value="6">Sábado</option>
                            <option value="7">Domingo</option>
                        </select>
                    </div>
                    <div class="col">
                        <select id="search-cancha" class="form-select">
                            <option value="">Seleccionar Cancha</option>
                        </select>
                    </div>
                </div>
            </div>
            <form>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Deporte</th>
                            <th>Dia</th>
                            <th>Cancha</th>
                            <th>Hora</th>
                            <th>Activa s/n</th>
                        </tr>
                    </thead>
                    <tbody id="deporte-cancha-hora-table-body">
                        <?php
                            include '../php/conexion.php';

                            // Verificar si la conexión se realizó correctamente
                            if ($conexion->connect_error) {
                                die("Error en la conexión: " . $conexion->connect_error);
                            }

                            // Variables para la paginación
                            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
                            $records_per_page = 35;
                            $offset = ($page - 1) * $records_per_page;

                            $sql = "SELECT deporte_cancha_hora.id, deporte.Descripcion AS deporte, dias.Descripcion AS dia, 
                                    deporte_cancha_hora.cancha AS cancha, deporte_cancha_hora.hora_inicio AS hora_inicio, 
                                    deporte_cancha_hora.hora_finalizado AS hora_finalizado, 
                                    deporte_cancha_hora.activa_s_n AS activa_s_n
                                    FROM deporte_cancha_hora
                                    JOIN deporte ON deporte_cancha_hora.id_deporte = deporte.id
                                    JOIN dias ON deporte_cancha_hora.id_dia = dias.id
                                    ORDER BY deporte_cancha_hora.id ASC
                                    LIMIT $offset, $records_per_page";

                            try {
                                $result = $conexion->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr id='deporte_cancha_hora-{$row['id']}'>
                                                <td>{$row['id']}</td>
                                                <td>{$row['deporte']}</td>
                                                <td>{$row['dia']}</td>
                                                <td>{$row['cancha']}</td>
                                                <td>{$row['hora_inicio']} a {$row['hora_finalizado']}</td>
                                                <td>
                                                    <div class='d-flex'>
                                                        <div class='mx-2'>
                                                            <input type='radio' name='activo_{$row['id']}' id='activo_si_{$row['id']}' value='SI' ".($row['activa_s_n'] == 'SI' ? 'checked' : '')." onclick='cambiarEstadoDeporteCanchaHora({$row['id']}, \"SI\")'>
                                                            <label class='text-dark' for='activo_si_{$row['id']}'>Activo</label>
                                                        </div>
                                                        <div class='mx-2'>
                                                            <input type='radio' name='activo_{$row['id']}' id='activo_no_{$row['id']}' value='NO' ".($row['activa_s_n'] == 'NO' ? 'checked' : '')." onclick='cambiarEstadoDeporteCanchaHora({$row['id']}, \"NO\")'>
                                                            <label class='text-dark' for='activo_no_{$row['id']}'>No activo</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='10'>No hay reservas</td></tr>";
                                }
                            } catch (mysqli_sql_exception $e) {
                                echo "<tr><td colspan='10'>Error en la consulta SQL: " . $e->getMessage() . "</td></tr>";
                            }

                            // Calcula el número total de páginas
                            $sql_count = "SELECT COUNT(*) AS total_rows FROM deporte_cancha_hora";
                            $result_count = $conexion->query($sql_count);
                            $row_count = $result_count->fetch_assoc();
                            $total_rows = $row_count['total_rows'];
                            $total_pages = ceil($total_rows / $records_per_page);

                            $conexion->close();
                        ?>
                    </tbody>
                </table>
            </form>
        <div class="container d-flex justify-content-between p-0"> 
            <div>
                <a href="../pages/agregar-horario-cancha.php" class="btn btn-primary">Agregar</a>
                <a href="../pages/usuario-admin.php" class="btn btn-warning">Volver</a>
            </div>
        <div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
                        // Enlaces de paginación
                        $previous_page = $page - 1;
                        $next_page = $page + 1;

                        echo "<li class='page-item " . ($page <= 1 ? 'disabled' : '') . "'><a class='page-link' href='?page=$previous_page'>Anterior</a></li>";

                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='?page=$i'>$i</a></li>";
                        }

                        echo "<li class='page-item " . ($page >= $total_pages ? 'disabled' : '') . "'><a class='page-link' href='?page=$next_page'>Siguiente</a></li>";
                    ?>
                </ul>
            </nav>
        </div>
        </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    function cambiarEstadoDeporteCanchaHora(id, estado) {
        $.ajax({
            url: '../php/cambiar_estado_deporte_cancha_hora.php',
            type: 'POST',
            data: { id: id, estado: estado },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.status !== 'success') {
                    alert("Error: " + data.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error al realizar la solicitud AJAX: " + textStatus + " - " + errorThrown);
            }
        });
    }

    $(document).ready(function() {
        function updateCanchas() {
            var deporte = $('#search-deporte').val();
            var canchas = $('#search-cancha');
            canchas.empty();
            if (deporte === 'futbol') {
                canchas.append('<option value="1">1</option>');
                canchas.append('<option value="2">2</option>');
                canchas.append('<option value="3">3</option>');
            } else {
                canchas.append('<option value="1">1</option>');
            }
        }

        function fetchFilteredResults() {
            var deporte = $('#search-deporte').val();
            var dia = $('#search-dia').val();
            var cancha = $('#search-cancha').val();

            $.ajax({
                url: '../php/buscar_deporte_cancha_hora.php',
                type: 'GET',
                data: { deporte: deporte, dia: dia, cancha: cancha },
                success: function(data) {
                    $('#deporte-cancha-hora-table-body').html(data);
                }
            });
        }

        $('#search-deporte').on('change', function() {
            updateCanchas();
            fetchFilteredResults();
        });
        $('#search-dia').on('change', fetchFilteredResults);
        $('#search-cancha').on('change', fetchFilteredResults);
        $('#filter-btn').on('click', fetchFilteredResults);

        updateCanchas();  // Inicializar las opciones de cancha al cargar la página
    });
</script>
</body>
</html>



