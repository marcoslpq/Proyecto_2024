<?php
$mensaje = ""; // Variable para almacenar el mensaje de alerta

include("../php/conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    // Obtener los datos del usuario actual
    $consultaUsuario = "SELECT usuario FROM administradores WHERE ID = ?";
    $stmt = $conexion->prepare($consultaUsuario);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuarioActual = $resultado->fetch_assoc();
    
    // Cerrar declaración
    $stmt->close();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario de manera segura
    $id = mysqli_real_escape_string($conexion, $_POST['id']);
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $password = mysqli_real_escape_string($conexion, $_POST['password']);
    
    // Hashear la contraseña
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Actualizar los datos del usuario en la base de datos
    $consultaActualizar = "UPDATE administradores SET usuario = ?, password = ? WHERE ID = ?";
    $stmt = $conexion->prepare($consultaActualizar);
    $stmt->bind_param("ssi", $usuario, $passwordHash, $id);

    if ($stmt->execute()) {
        $mensaje = "Datos actualizados correctamente.";
    } else {
        $mensaje = "Error al actualizar los datos.";
    }

    // Cerrar declaración y conexión
    $stmt->close();
    $conexion->close();
        // Redirigir y mostrar el mensaje de alerta
    echo "<script>
        alert('$mensaje');
        window.location.href = 'tabla-administradores.php';
    </script>";
    exit();
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

    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form class="row g-3 mt-3" name="nuevo_socio" method="POST" autocomplete="off" action="">
                        <div class="col-md-12">
                            <label for="nombresocio" class="form-label">Modifique su usuario</label>
                            <input type="text" class="form-control" name="usuario" pattern="[a-zA-Z\s]+" id="usuario" placeholder="Usuario" value="<?php echo htmlspecialchars($usuarioActual['usuario']); ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label for="apellidosocio" class="form-label">Nueva password</label>
                            <input type="password" class="form-control" name="password" autocomplete="off" id="password" placeholder="Password" required>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-warning mt-3 col-md-12">Aceptar cambios</button>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-danger mt-3 col-md-12" href="../pages/tabla-administradores.php">Volver</a>
                        </div>
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    </form>
                    <?php if (!empty($mensaje)): ?>
                        <div class="alert alert-warning mt-3"><?php echo $mensaje; ?></div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>