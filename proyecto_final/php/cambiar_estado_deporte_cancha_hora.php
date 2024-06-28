<?php
include 'conexion.php';

if (isset($_POST['id']) && isset($_POST['estado'])) {
    $id = $_POST['id'];
    $estado = $_POST['estado'];

    $sql = "UPDATE deporte_cancha_hora SET activa_s_n = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('si', $estado, $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
}
?>


