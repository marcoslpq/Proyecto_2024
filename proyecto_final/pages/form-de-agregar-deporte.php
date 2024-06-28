<?php
$mensaje = ""; // Variable para almacenar el mensaje de alerta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("../php/conexion.php");

    // Obtener los datos del formulario de manera segura
    $input = mysqli_real_escape_string($conexion, $_POST['input']);


    // Verificar si el usuario ya existe en la base de datos
    $consultaId = "SELECT Descripcion FROM deporte WHERE Descripcion = ?";
    $stmt = $conexion->prepare($consultaId);
    $stmt->bind_param("s", $input);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si la consulta devolvió algún resultado
    if ($resultado->num_rows > 0) {
        // Si el usuario ya existe
        $mensaje = "El deporte ya existe";
    } else {
        // Si el deporte no existe, insertar nuevo deporte
        $sql = "INSERT INTO deporte (Descripcion) VALUES (?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $input);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Deporte nuevo creado');
                    window.location.href = 'tabla-de-deportes.php';
                </script>";
        } else {
            $mensaje = "Error al crear el deporte: " . $stmt->error;
        }
    }

    // Cerrar declaración y conexión
    $stmt->close();
    $conexion->close();
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

    <form class="row g-3 mt-3" name="formularioAgregar" method="POST" autocomplete="off" action="./form-de-agregar-deporte.php">
        <div class="col-md-12">
            <label for="agregar" class="form-label">Agregar tipo de deporte</label>
            <input type="text" name="input" class="form-control" id="input" value="">
        </div>
        <div class="col-md-6">
            <button type="submit" class="btn btn-danger mt-3 col-md-12">Agregar</button>
        </div>
        <div class="col-md-6">
            <a href="../pages/tabla-de-deportes.php" class="btn btn-warning mt-3 col-md-12">Volver</a>
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
</body>
</html>