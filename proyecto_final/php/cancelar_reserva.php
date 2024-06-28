<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include '../php/conexion.php';

    // Obtener los datos del formulario y sanitizarlos
    $id_reserva = isset($_POST['id_reserva']) ? (int) $_POST['id_reserva'] : null;
    $fecha_cancelacion = isset($_POST['fecha-cancelada']) ? htmlspecialchars($_POST['fecha-cancelada']) : '';
    $motivo = isset($_POST['cancel']) ? htmlspecialchars($_POST['cancel']) : '';

    // Preparar y ejecutar la consulta SQL para insertar los datos
    if ($id_reserva !== null && !empty($fecha_cancelacion) && !empty($motivo)) {
        $stmt = $conexion->prepare("INSERT INTO cancelaciones (id_reserva, fecha_de_cancelacion, motivo_de_cancelacion) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $id_reserva, $fecha_cancelacion, $motivo);

        if ($stmt->execute()) {
            echo '<script type="text/javascript">
                    setTimeout(function(){
                        alert("Reserva cancelada con exito.");
                    }, 1000);
                    setTimeout(function(){
                        window.location.href = "../pages/tabla-reservas.php";
                    }, 3000);
                </script>';
            
        } else {
            $alert_message = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Por favor, complete todos los campos requeridos.";
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    // Redirigir si el acceso no es vía POST
    header("Location: ../pages/tabla-reservas.php");
    exit();
}
?>
