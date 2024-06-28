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
        <div class= " d-md-flex justify-content-md-end">
            <i class="fa-solid fa-user icono"></i>   
            <a class="btn btn-success" href="../php/cerrarsesion.php">Cerrar sesion</a>
        </div>
    </div>
    </header>

    <main>
        <h1 class="text-center p-3">ADMINISTRADORES</h1>
        <div class="container">
            <!-- Utiliza la clase table-responsive para hacer que la tabla sea responsive en dispositivos móviles -->
            <div class="table-responsive">
                <form></form>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Administradores</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include '../php/conexion.php';

                            // Verificar si la conexión se realizó correctamente
                            if ($conexion->connect_error) {
                                die("Error en la conexión: " . $conexion->connect_error);
                            }

                            $sql = "SELECT administradores.id, administradores.usuario FROM administradores";

                            try {
                                $result = $conexion->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr id='administradores-{$row['id']}'>
                                                <td>{$row['id']}</td>
                                                <td>{$row['usuario']}</td>
                                                <td><a class='btn btn-danger' onclick='eliminarAdministrador({$row['id']})'>Eliminar</a>
                                                <a class='btn btn-info' onclick='modificarAdministrador({$row['id']})'>Modificar</a></td>
                                            </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No hay administradores</td></tr>";
                                }
                            } catch (mysqli_sql_exception $e) {
                                echo "Error en la consulta SQL: " . $e->getMessage();
                            }

                            $conexion->close();
                        ?>
                    </tbody>
                </table>
                </form>
                <a href="./agregar-administrador.php" class="btn btn-warning mx-1">Agregar</a>
                <a href="./usuario-admin.php" class="btn btn-danger mx-1">Volver</a>
            </div>
        </div>
    </main>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    async function eliminarAdministrador(id) {
        if (confirm("¿Estás seguro de que deseas eliminar a este administrador?")) {
            try {
                const response = await fetch('../php/eliminar-administrador.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: id })
                });

                const data = await response.json();
                if (data.status === 'success') {
                    document.getElementById('administradores-' + id).remove();
                } else {
                    alert("Error: " + data.message);
                }
            } catch (error) {
                alert("Error al realizar la solicitud: " + error.message);
            }
        }
    }
    function modificarAdministrador(id) {
        window.location.href = './modificar-administrador.php?id=' + id;
    }
</script>
</body>
</html>