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
        <h1 class="text-center p-3">TIPOS DE DEPORTES</h1>
        <div class="container">
            <div class="table-responsive">
                <table class="table  table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Tipo de deportes</th>
                            <th>Activo s/n</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    include '../php/conexion.php';

                    // Verificar si la conexión se realizó correctamente
                    if ($conexion->connect_error) {
                        die("Error en la conexión: " . $conexion->connect_error);
                    }

                    $sql = "SELECT ID, Descripcion AS tipo_de_deportes, activa_s_n FROM deporte";

                    try {
                        $result = $conexion->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo"<tr id='deporte-{$row['ID']}'>
                                            <td>{$row['ID']}</td>
                                            <td>{$row['tipo_de_deportes']}</td>
                                            <td>
                                                <div class='d-flex'>
                                                    <div class='mx-2'>
                                                        <input type='radio' name='activo_{$row['ID']}' id='activo_si_{$row['ID']}' value='SI' ".($row['activa_s_n'] == 'SI' ? 'checked' : '')." onclick='cambiarEstadoDeporte({$row['ID']}, \"SI\")'>
                                                        <label class='text-dark' for='activo_si_{$row['ID']}'>Activo</label>
                                                    </div>
                                                    <div class='mx-2'>
                                                        <input type='radio' name='activo_{$row['ID']}' id='activo_no_{$row['ID']}' value='NO' ".($row['activa_s_n'] == 'NO' ? 'checked' : '')." onclick='cambiarEstadoDeporte({$row['ID']}, \"NO\")'>
                                                        <label class='text-dark' for='activo_no_{$row['ID']}'>No activo</label>
                                                    </div>
                                                </div>
                                            </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No hay deportes</td></tr>";
                        }
                    } catch (mysqli_sql_exception $e) {
                        echo "Error en la consulta SQL: " . $e->getMessage();
                    }

                    $conexion->close();
                    ?>
                    </tbody>
                </table>
                <a href='../pages/form-de-agregar-deporte.php?id={$row[id]}' class='btn btn-success'>Agregar</a>
                <a href="./usuario-admin.php" class="btn btn-danger mx-1">Volver</a>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function cambiarEstadoDeporte(id, estado) {
            $.ajax({
                url: '../php/cambiar_estado_deporte.php',
                type: 'POST',
                data: { id: id, estado: estado },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        alert("El estado del deporte ha sido cambiado con exito ");
                    } else {
                        alert("Error: " + data.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error al realizar la solicitud AJAX: " + textStatus + " - " + errorThrown);
                }
            });
        }
    </script>
</body>
</html>