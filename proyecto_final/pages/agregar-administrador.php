<?php
$mensaje = ""; // Variable para almacenar el mensaje de alerta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("../php/conexion.php");

    // Obtener los datos del formulario de manera segura
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $password = mysqli_real_escape_string($conexion, $_POST['password']);

    // Hashear la contraseña
    $passwordHash = password_hash($password, PASSWORD_BCRYPT); //nos da 60 caracteres encriptados

    // Verificar si el usuario ya existe en la base de datos
    $consultaId = "SELECT usuario FROM administradores WHERE usuario = ?";
    $stmt = $conexion->prepare($consultaId);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si la consulta devolvió algún resultado
    if ($resultado->num_rows > 0) {
        // Si el usuario ya existe
        $mensaje = "El usuario ya existe";
    } else {
        // Si el usuario no existe, insertar nuevo usuario
        $sql = "INSERT INTO administradores (usuario, password) VALUES (?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $usuario, $passwordHash);

        if ($stmt->execute()) {
            $mensaje = "Usuario creado";
        } else {
            $mensaje = "Error al crear el usuario: " . $stmt->error;
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

    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form class="row g-3 mt-3" name="nuevo_socio" method="POST" autocomplete="off" action="./agregar-administrador.php">
                        <div class="col-md-12">
                            <label for="nombresocio" class="form-label">Usuario</label>
                            <input type="text" class="form-control" name="usuario" pattern="[a-zA-Z\s]+" id="usuario" placeholder="Usuario" required>
                        </div>
                        <div class="col-md-12">
                            <label for="apellidosocio" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" autocomplete="off" id="password" placeholder="Password" required>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-warning mt-3 col-md-12">Registrar</button>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-danger mt-3 col-md-12" href="../pages/tabla-administradores.php">Volver</a>
                        </div>
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