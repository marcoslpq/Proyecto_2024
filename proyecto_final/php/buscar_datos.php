<?php

include("conexion.php");

// Obtener el valor del parámetro GET
$nrsocio = $_GET['nrsocio'];

// Validar que el parámetro sea un número
if (!is_numeric($nrsocio)) {
    echo json_encode(["error" => "Número de socio inválido"]);
    exit;
}

// Preparar y ejecutar la consulta
$sql = "SELECT * FROM persona WHERE Numero_de_socio = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $nrsocio);  // "i" indica que el parámetro es un entero
$stmt->execute();
$result = $stmt->get_result();

// Mostrar los resultados
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['activa_s_n'] == 'NO') {
        echo json_encode(["error" => "Socio no activo"]);
    } else {
        echo json_encode($row);
    }
} else {
    echo json_encode(["error" => "Número de socio no encontrado"]);
}


// Cerrar la conexión
$conexion->close();
?>