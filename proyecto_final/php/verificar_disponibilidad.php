<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deporte = $_POST['deporte'];

    try {
        $sql = "SELECT activa_s_n FROM deporte WHERE Descripcion = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $deporte);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            if ($row['activa_s_n'] === 'SI') {
                echo json_encode(['disponible' => true]);
            } else {
                echo json_encode(['disponible' => false]);
            }
        } else {
            echo json_encode(['disponible' => false]);
        }

        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        echo json_encode(['disponible' => false, 'message' => 'Error en la consulta SQL: ' . $e->getMessage()]);
    }

    $conexion->close();
} else {
    echo json_encode(['disponible' => false, 'message' => 'Método de solicitud no válido.']);
}
?>
