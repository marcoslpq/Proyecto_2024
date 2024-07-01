<?php
require("conexion.php");

$id_deporte = isset($_GET['id_deporte']) ? $_GET['id_deporte'] : '';
$dia = isset($_GET['dia']) ? $_GET['dia'] : '';
$cancha = isset($_GET['cancha']) ? $_GET['cancha'] : '';

$where_clauses = [];
if ($id_deporte != '') {
    $where_clauses[] = "deporte_cancha_hora.id_deporte = '$id_deporte'";
}
if ($dia != '') {
    $where_clauses[] = "deporte_cancha_hora.id_dia = '$dia'";
}
if ($cancha != '') {
    $where_clauses[] = "deporte_cancha_hora.cancha = '$cancha'";
}

$where_sql = '';
if (!empty($where_clauses)) {
    $where_sql = 'WHERE ' . implode(' AND ', $where_clauses);
}

$sql = "SELECT deporte_cancha_hora.id, deporte.Descripcion AS deporte, dias.Descripcion AS dia, 
        deporte_cancha_hora.cancha AS cancha, deporte_cancha_hora.hora_inicio AS hora_inicio, 
        deporte_cancha_hora.hora_finalizado AS hora_finalizado, 
        deporte_cancha_hora.activa_s_n AS activa_s_n
        FROM deporte_cancha_hora
        JOIN deporte ON deporte_cancha_hora.id_deporte = deporte.id
        JOIN dias ON deporte_cancha_hora.id_dia = dias.id
        $where_sql
        ORDER BY deporte_cancha_hora.id ASC";

try {
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr id='deporte_cancha_hora-{$row['id']}'>
                    <td>{$row['id']}</td>
                    <td>{$row['deporte']}</td>
                    <td>{$row['dia']}</td>
                    <td>{$row['cancha']}</td>
                    <td>{$row['hora_inicio']} a {$row['hora_finalizado']}</td>
                    <td>
                        <div class='d-flex'>
                            <div class='mx-2'>
                                <input type='radio' name='activo_{$row['id']}' id='activo_si_{$row['id']}' value='SI' ".($row['activa_s_n'] == 'SI' ? 'checked' : '')." onclick='cambiarEstadoDeporteCanchaHora({$row['id']}, \"SI\")'>
                                <label class='text-dark' for='activo_si_{$row['id']}'>Activo</label>
                            </div>
                            <div class='mx-2'>
                                <input type='radio' name='activo_{$row['id']}' id='activo_no_{$row['id']}' value='NO' ".($row['activa_s_n'] == 'NO' ? 'checked' : '')." onclick='cambiarEstadoDeporteCanchaHora({$row['id']}, \"NO\")'>
                                <label class='text-dark' for='activo_no_{$row['id']}'>No activo</label>
                            </div>
                        </div>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='10'>No hay registros</td></tr>";
    }
} catch (mysqli_sql_exception $e) {
    echo "<tr><td colspan='10'>Error en la consulta SQL: " . $e->getMessage() . "</td></tr>";
}

$conexion->close();
?>



