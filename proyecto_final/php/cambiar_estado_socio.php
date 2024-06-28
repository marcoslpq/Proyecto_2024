<?php
include 'conexion.php';

$id = isset($_POST['id']) ? $_POST['id'] : '';
$estado = isset($_POST['estado']) ? $_POST['estado'] : '';

if ($id !== '' && $estado !== '') {
    $sql = "UPDATE persona SET activa_s_n = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $estado, $id);

    try {
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar el estado del socio']);
        }
    } catch (mysqli_sql_exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error en la consulta SQL: ' . $e->getMessage()]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
}

$conexion->close();
?>
