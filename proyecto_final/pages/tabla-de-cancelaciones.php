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
    <h1 class="text-center p-3">CANCELACIONES</h1>
    <div class="container">
        <!-- Utiliza la clase table-responsive para hacer que la tabla sea responsive en dispositivos móviles -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Numero de la reserva</th>
                        <th>Reserva de la cancha</th>
                        <th>Fecha de cancelación</th>
                        <th>Motivo de la cancelación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Incluir archivo de conexión
                    include '../php/conexion.php';

                    // Consultar las cancelaciones
                    $sql = "SELECT cancelaciones.id, cancelaciones.id_reserva, reserva.fecha_de_reserva AS fecha_reserva, 
                            cancelaciones.fecha_de_cancelacion AS fecha_cancelada, cancelaciones.motivo_de_cancelacion AS motivo
                            FROM cancelaciones JOIN reserva ON cancelaciones.id_reserva = reserva.id";
                            
                    
                    try {
                        $result = $conexion->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr id='cancelaciones-{$row['id']}'>";
                                echo "<td>{$row['id']}</td>";
                                echo "<td>{$row['id_reserva']}</td>"; // Mostrar id_reserva como número de reserva
                                echo "<td>{$row['fecha_reserva']}</td>";
                                echo "<td>{$row['fecha_cancelada']}</td>";
                                echo "<td>{$row['motivo']}</td>";
                                echo "<td>
                                        <form method='POST' action='../php/eliminar_cancelaciones.php'>
                                            <input type='hidden' name='id_cancelacion' value='{$row['id']}'>
                                            <button type='submit' class='btn btn-danger'>Eliminar</button>
                                        </form>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No hay cancelaciones registradas.</td></tr>";
                        }
                    } catch (mysqli_sql_exception $e) {
                        echo "<tr><td colspan='5'>Error en la consulta SQL: " . $e->getMessage() . "</td></tr>";
                    }

                    // Cerrar conexión
                    $conexion->close();
                    ?>
                </tbody>
            </table>
            <div class="container d-flex justify-content-between p-0"> 
                <div>
                    <a href="../pages/usuario-admin.php" class="btn btn-warning ">Volver</a>
                </div>
            <div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

