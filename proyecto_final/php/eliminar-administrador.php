<?php
include 'conexion.php';

// Configuración del encabezado para permitir solicitudes desde otros dominios
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

if ($conexion->connect_error) {
    die(json_encode(["status" => "error", "message" => "Error en la conexión: " . $conexion->connect_error]));
}

if ($stmt = $conexion->prepare("DELETE FROM administradores WHERE id = ?")) {
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al eliminar administrador."]);
    }
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Error en la preparación de la consulta."]);
}

$conexion->close();
?>
