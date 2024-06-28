<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $estado = $_POST['estado'];

    // Validar los datos recibidos
    if (isset($id) && isset($estado) && ($estado == 'SI' || $estado == 'NO')) {
        $sql = "UPDATE deporte SET activa_s_n = ? WHERE id = ?";
        
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param("si", $estado, $id);
            
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Estado actualizado correctamente"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al actualizar el estado"]);
            }

            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Error en la preparación de la consulta"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Datos inválidos"]);
    }

    $conexion->close();
} else {
    echo json_encode(["status" => "error", "message" => "Solicitud no válida"]);
}
?>
