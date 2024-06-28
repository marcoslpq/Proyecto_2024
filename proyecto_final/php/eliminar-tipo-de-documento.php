<?php
include 'conexion.php';

// Configurar el encabezado para la respuesta JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    try {
        // Verificar si hay personas con este tipo de documento
        $sql_check = "SELECT COUNT(*) AS count FROM persona WHERE id_tipo_de_documento = ?";
        $stmt_check = $conexion->prepare($sql_check);
        $stmt_check->bind_param("i", $id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row_check = $result_check->fetch_assoc();

        if ($row_check['count'] > 0) {
            // Si hay personas con este tipo de documento, no eliminar y enviar mensaje de error
            echo json_encode(['status' => 'error', 'message' => 'No se puede eliminar este tipo de documento porque está asociado a personas.']);
        } else {
            // Proceder a eliminar el tipo de documento
            $sql = "DELETE FROM tipo_documento WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el tipo de documento. No se puede eliminar este tipo de documento porque está asociado a personas.']);
            }
        }

        $stmt_check->close();
        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el tipo de documento: No se puede eliminar este tipo de documento porque está asociado a personas. ' . $e->getMessage()]);
    }

    $conexion->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no válido.']);
}
?>