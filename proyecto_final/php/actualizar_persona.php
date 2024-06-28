<?php
include 'conexion.php';

$id = isset($_POST['id']) ? $_POST['id'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
$documento = isset($_POST['documento']) ? $_POST['documento'] : '';
$tipo_documento = isset($_POST['tipo_documento']) ? $_POST['tipo_documento'] : '';
$genero = isset($_POST['genero']) ? $_POST['genero'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$fecha_nac = isset($_POST['fecha_nac']) ? $_POST['fecha_nac'] : '';
$localidad = isset($_POST['localidad']) ? $_POST['localidad'] : '';
$calle = isset($_POST['calle']) ? $_POST['calle'] : '';
$altura = isset($_POST['altura']) ? $_POST['altura'] : '';

if ($id && $nombre && $apellido && $documento && $tipo_documento && $genero && $email && $telefono && $fecha_nac && $localidad && $calle && $altura) {
    $sql = "UPDATE persona SET Nombre = ?, Apellido = ?, Numero_Documento = ?, id_tipo_de_documento = ?, id_genero = ?, Email = ?, telefono = ?, fecha_nac = ?, Localidad = ?, Calle = ?, Altura = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssisssssssi", $nombre, $apellido, $documento, $tipo_documento, $genero, $email, $telefono, $fecha_nac, $localidad, $calle, $altura, $id);

    try {
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar los datos del socio']);
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

