<?php
require("conexion.php");
$reserva_id = $_POST['reserva_id'];

$sql = "UPDATE reserva SET abono_reserva='SI' WHERE ID=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $reserva_id);

$response = array(); // Crear un array para la respuesta

if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = "Su Pago fue exitoso";
} else {
    // Si hubo un error
    $response['success'] = false;
    $response['message'] = "Error actualizando el registro: ". $conexion->error;
}
$conexion->close();
// Devolver la respuesta como JSON
echo json_encode($response);
?>