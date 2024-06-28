<?php
include("conexion.php");


if (/*isset($_GET['deporte']) && */isset($_GET['nrdecancha'])) {
    //echo "El deporte es: " . $_GET['deporte'];
    echo "El nr de cancha es: " . $_GET['nrdecancha'];
} else {

    echo "La clave 'deporte' no está definida.";
}

$conexion->close();
?>



