<?php
// archivo: obtener_horas_reservadas.php

require('conexion.php');

if (isset($_GET['fecha_rese'])) {
    $fecha = $_GET['fecha_rese'];
    $id_deporte = $_GET['id_deporte']; 

    $sql = "SELECT dch.hora_inicio, dch.hora_finalizado 
            FROM reserva r 
            JOIN deporte_cancha_hora dch 
            ON r.id_deporte_cancha_hora = dch.ID 
            WHERE r.fecha_de_reserva = ? AND dch.id_deporte = ?";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('si', $fecha, $id_deporte);
    $stmt->execute();
    $result = $stmt->get_result();

    $horas_reservadas = array();
    while ($row = $result->fetch_assoc()) {
        $horas_reservadas[] = $row;
    }
    echo json_encode($horas_reservadas);
}
?>
