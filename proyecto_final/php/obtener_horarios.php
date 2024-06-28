
<?php 
include("conexion.php");


if (isset($_GET['id_dia']) && isset($_GET['deporte']) && isset($_GET['nrdecancha'])) { 
  
  $id_dia = intval($_GET['id_dia']);
  $deporte = intval($_GET['deporte']);
  $nrdecancha = intval($_GET['nrdecancha']);
  
    $sql = "SELECT hora_inicio, hora_finalizado FROM deporte_cancha_hora LEFT JOIN Reserva ON deporte_cancha_hora.ID = Reserva.id_deporte_cancha_hora 
            LEFT JOIN deporte ON deporte.ID = deporte_cancha_hora.id_deporte WHERE deporte_cancha_hora.id_dia = ? 
            AND deporte.ID = ? AND deporte_cancha_hora.cancha = ? AND deporte_cancha_hora.activa_s_n = 'SI' AND Reserva.id IS NULL; ";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('iii', $id_dia, $deporte, $nrdecancha); 
    $stmt->execute();
    $result = $stmt->get_result();
    $horarios = array();

    while ($row = $result->fetch_assoc()) {
      $horarios[] = $row;
    }

    echo json_encode($horarios);
} else {
    
    echo json_encode(array('error' => 'Parametros faltantes'));
    }


$conexion->close();
?> 

