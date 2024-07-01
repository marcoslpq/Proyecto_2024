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

    <main>
        <h1 class="text-center p-3">RESERVAS DE CANCHA</h1>
        <div class="container mt-4 mb-2">
            <!-- Campo de búsqueda -->
            <div class="mb-3">
                <input type="text" id="search-id" class="form-control" placeholder="Buscar numero de reserva">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Nº de socio</th>
                            <th>Deporte</th>
                            <th>Cancha</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Abono de reserva</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="reservas-table-body">
                        <?php
                        include '../php/conexion.php';

                        // Variables para la paginación
                        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
                        $records_per_page = 5;
                        $offset = ($page - 1) * $records_per_page;

                        // Consulta SQL con paginación
                        $sql = "SELECT reserva.id, persona.Nombre AS socio_nombre, persona.Apellido AS socio_apellido, persona.Numero_de_socio AS numero_de_socio, 
                                deporte.Descripcion AS deporte_nombre, deporte_cancha_hora.cancha AS cancha, reserva.fecha_de_reserva AS fecha, 
                                deporte_cancha_hora.hora_inicio AS hora_inicio, deporte_cancha_hora.hora_finalizado AS hora_finalizado, 
                                reserva.abono_reserva
                                FROM reserva
                                JOIN persona ON reserva.id_persona = persona.id
                                JOIN deporte_cancha_hora ON reserva.id_deporte_cancha_hora = deporte_cancha_hora.id
                                JOIN deporte ON deporte_cancha_hora.id_deporte = deporte.id
                                LEFT JOIN cancelaciones ON reserva.id = cancelaciones.id_reserva
                                WHERE cancelaciones.id_reserva IS NULL
                                ORDER BY reserva.id ASC
                                LIMIT $offset, $records_per_page";

                        try {
                            $result = $conexion->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Compara la fecha de reserva con la fecha actual
                                    $fecha_reserva = strtotime($row['fecha']);
                                    $fecha_actual = strtotime(date('Y-m-d'));

                                    echo "<tr id='reserva-{$row['id']}'>
                                            <td>{$row['id']}</td>
                                            <td>{$row['socio_nombre']}</td>
                                            <td>{$row['socio_apellido']}</td>
                                            <td>{$row['numero_de_socio']}</td>
                                            <td>{$row['deporte_nombre']}</td>
                                            <td>{$row['cancha']}</td>
                                            <td>{$row['fecha']}</td>
                                            <td>{$row['hora_inicio']} a {$row['hora_finalizado']}</td>
                                            <td>{$row['abono_reserva']}</td>";
                                    
                                    // Solo muestra el botón de cancelar si la fecha de reserva es futura o igual a la fecha actual
                                    if ($fecha_reserva >= $fecha_actual) {
                                        echo "<td><a href='../pages/form-de-cancelar.php?id_reserva={$row['id']}&fecha={$row['fecha']}' class='btn btn-danger'>Cancelar</a></td>";
                                    } else {
                                        echo "<td></td>";
                                    }

                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='10'>No hay reservas</td></tr>";
                            }
                        } catch (mysqli_sql_exception $e) {
                            echo "<tr><td colspan='10'>Error en la consulta SQL: " . $e->getMessage() . "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="container d-flex justify-content-between p-0"> 
                    <div>
                        <a href="../pages/usuario-admin.php" class="btn btn-warning">Volver</a>
                    </div>
                <div>
                <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php
            // Calcula el número total de páginas
            $sql_count = "SELECT COUNT(*) AS total_rows FROM reserva";
            $result_count = $conexion->query($sql_count);
            $row_count = $result_count->fetch_assoc();
            $total_rows = $row_count['total_rows'];
            $total_pages = ceil($total_rows / $records_per_page);

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
    </main>

    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Función para buscar reservas en tiempo real
            $('#search-id').on('keyup', function() {
                var searchId = $(this).val();
                if (searchId === '') {
                    location.reload();  // Recarga la página si el campo de búsqueda está vacío
                } else {
                    $.ajax({
                        url: '../php/buscar_reserva.php',
                        type: 'GET',
                        data: { id: searchId },
                        success: function(data) {
                            $('#reservas-table-body').html(data);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>



