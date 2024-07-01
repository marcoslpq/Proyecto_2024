<?php
require("conexion.php");

if (isset($_GET['id_deporte'])) {
    $id_deporte = $_GET['id_deporte'];
    $sql = "SELECT cancha FROM deporte_cancha_hora WHERE id_deporte = ? GROUP BY cancha";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_deporte);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    $canchas = array();
    while ($row = $resultado->fetch_assoc()) {
        $canchas[] = $row;
    }
    
    echo json_encode($canchas);
    
    $stmt->close();
}
$conexion->close();
?>
