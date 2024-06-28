<?php
include 'conexion.php';

$deporte = $_GET['deporte'] ?? '';
$dia = $_GET['dia'] ?? '';
$cancha = $_GET['cancha'] ?? '';

$sql = "SELECT deporte_cancha_hora.id, deporte.Descripcion AS deporte, dias.Descripcion AS dia, 
        deporte_cancha_hora.cancha AS cancha, deporte_cancha_hora.hora_inicio AS hora_inicio, 
        deporte_cancha_hora.hora_finalizado AS hora_finalizado, 
        deporte_cancha_hora.activa_s_n AS activa_s_n
        FROM deporte_cancha_hora
        JOIN deporte ON deporte_cancha_hora.id_deporte = deporte.id
        JOIN dias ON deporte_cancha_hora.id_dia = dias.id
        WHERE (deporte.Descripcion LIKE ?)
        AND (dias.id LIKE ?)
        AND (deporte_cancha_hora.cancha LIKE ?)
        ORDER BY deporte_cancha_hora.id ASC";

$stmt = $conexion->prepare($sql);
$search_deporte = $deporte ? "%$deporte%" : "%%";
$search_dia = $dia ? "$dia" : "%";
$search_cancha = $cancha ? "$cancha" : "%";

$stmt->bind_param("sss", $search_deporte, $search_dia, $search_cancha);

$stmt->execute();
$result = $stmt->get_result();

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
    echo "<tr><td colspan='10'>No hay reservas</td></tr>";
}

$stmt->close();
$conexion->close();
?>


