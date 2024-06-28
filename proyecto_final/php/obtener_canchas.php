<?php
require("conexion.php");

if (isset($_GET['id_deporte'])) {
    $id_deporte = $_GET['id_deporte'];
    $sql = "SELECT cancha FROM deporte_cancha_hora 
            WHERE id_deporte = $id_deporte AND activa_s_n = 'SI' 
            GROUP BY cancha";
    $resultado = $conexion->query($sql);
    
    $options = '';
    while ($valores = mysqli_fetch_array($resultado)) {
        $options .= '<option value="'.$valores['cancha'].'">'.$valores['cancha'].'</option>';
    }
    echo $options;
}
?>
