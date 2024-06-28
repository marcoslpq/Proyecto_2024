<?php
include ("conexion.php");

session_start(); 

$_SESSION['login'] = false; 

// Asignamos los valores a estas variables desde HTML
$usuario = $_POST["usuario"];
$password = $_POST["contraseña"];

// Evaluamos si existe el usuario ingresado: vamos a la BD con estos comandos
$consulta = "SELECT * FROM administradores WHERE usuario = '$usuario'";
$consulta = mysqli_query($conexion, $consulta);  //ejecutamp la consulta
$consulta = mysqli_fetch_array($consulta);   // Extraemos solo la primera fila que sería el array de la tabla de BD

if ($consulta) { // Si la consulta consigue un valor entonces
    if (password_verify($password, $consulta['password'])) { // Comparamos el password ingresado con el almacenado
        // Si es verdadero, es decir, que los 2 passwords coincidan
        $_SESSION['login'] = true;  // Cambiamos de falso a verdadero el login si coinciden las contraseñas
        $_SESSION['usuario']= $consulta['usuario'];
        header('Location: ../pages/usuario-admin.php'); // Redirige a la página del administrador

    } else {
        header('Location: ../pages/admin.php?error=Contraseña+incorrecta');
    }

} else {
    header('Location: ../pages/admin.php?error=El+usuario+no+existe');
}

// Cerramos la conexión
mysqli_close($conexion);
?>

