<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLUB SOCIAL Y DEPORTIVO SAN CARLOS</title>
    <script src="https://kit.fontawesome.com/bfbcf1faa2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .table-responsive {
            overflow-x: hidden;
        }

        .table th, .table td {
            white-space: nowrap;
            text-align: center;
            padding: 0.5rem;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .d-flex {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .d-flex div {
            margin: 0 0.1rem;
        }

        .table th, .table td {
            max-width: 150px; /* Ajusta el ancho máximo según tus necesidades */
        }

        .btn {
            padding: 0.25rem 0.5rem;
        }

        .col-activo {
            max-width: 10px; /* Ajusta el ancho máximo para la columna "Activo s/n" */
        }

        .col-accion {
            max-width: 500px; /* Ajusta el ancho máximo para la columna "Acción" */
        }

        .label-activo {
            color: black;
        }
    </style>
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
        <h1 class="text-center p-3">PERSONAS</h1>
        <div class="container mt-4 mb-2">
                <div class="table-responsive">
                    <!-- Campo de búsqueda -->
                    <div class="mb-3">
                        <input type="text" id="search-query" class="form-control" placeholder="Buscar por Número de socio o Número de Documento">
                    </div>
                    <form>
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Nr Documento</th>
                                    <th>Nr socio</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Activo S/N</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="socios-table-body">
                                <?php
                                    include '../php/conexion.php';

                                    // Verificar si la conexión se realizó correctamente
                                    if ($conexion->connect_error) {
                                        die("Error en la conexión: " . $conexion->connect_error);
                                    }

                                    $sql = "SELECT persona.id, persona.Nombre AS socio_nombre, persona.Apellido AS socio_apellido, 
                                            persona.Numero_Documento AS socio_documento, persona.Numero_de_socio AS socio_Numero_de_socio, 
                                            persona.Email AS socio_Email, persona.telefono AS socio_telefono, 
                                            persona.activa_s_n AS socio_activa_s_n
                                            FROM persona";

                                    try {
                                        $result = $conexion->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr id='persona-{$row['id']}'>
                                                        <td>{$row['id']}</td>
                                                        <td>{$row['socio_nombre']}</td>
                                                        <td>{$row['socio_apellido']}</td>
                                                        <td>{$row['socio_documento']}</td>
                                                        <td>{$row['socio_Numero_de_socio']}</td>
                                                        <td>{$row['socio_Email']}</td>
                                                        <td>{$row['socio_telefono']}</td>
                                                        <td>
                                                            <div class='d-flex'>
                                                                <div class='mx-2'>
                                                                    <input type='radio' name='activo_{$row['id']}' id='activo_si_{$row['id']}' value='SI' ".($row['socio_activa_s_n'] == 'SI' ? 'checked' : '')." onclick='cambiarEstadoSocio({$row['id']}, \"SI\")'>
                                                                    <label class='text-dark' for='activo_si_{$row['id']}'>Activo</label>
                                                                </div>
                                                                <div class='mx-2'>
                                                                    <input type='radio' name='activo_{$row['id']}' id='activo_no_{$row['id']}' value='NO' ".($row['socio_activa_s_n'] == 'NO' ? 'checked' : '')." onclick='cambiarEstadoSocio({$row['id']}, \"NO\")'>
                                                                    <label class='text-dark' for='activo_no_{$row['id']}'>No activo</label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a class='btn btn-info' href='../php/detalles_persona.php?id={$row['id']}'>Ver detalles</a>
                                                        </td>
                                                    </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='9'>No hay socios</td></tr>";
                                        }
                                    } catch (mysqli_sql_exception $e) {
                                        echo "Error en la consulta SQL: " . $e->getMessage();
                                    }

                                    $conexion->close();
                                ?>
                            </tbody>
                        </table>
                    </form>
                <a href="usuario-admin.php" class="btn btn-danger mx-1">Volver</a>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function cambiarEstadoSocio(id, estado) {
            $.ajax({
                url: '../php/cambiar_estado_socio.php',
                type: 'POST',
                data: { id: id, estado: estado },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        alert("El estado del socio ha sido cambiado con exito");
                    } else {
                        alert("Error: " + data.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error al realizar la solicitud AJAX: " + textStatus + " - " + errorThrown);
                }
            });
        }


        $(document).ready(function() {
            // Función para buscar socios en tiempo real
            $('#search-query').on('keyup', function() {
                var searchQuery = $(this).val();
                if (searchQuery === '') {
                    location.reload();  // Recarga la página si el campo de búsqueda está vacío
                } else {
                    $.ajax({
                        url: '../php/buscar_socio.php',
                        type: 'GET',
                        data: { query: searchQuery },
                        success: function(data) {
                            $('#socios-table-body').html(data);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>


    
