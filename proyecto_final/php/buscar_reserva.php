<?php
include 'conexion.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

$sql = "SELECT reserva.id, persona.Nombre AS socio_nombre, persona.Apellido AS socio_apellido, persona.Numero_de_socio AS numero_de_socio, 
        deporte.Descripcion AS deporte_nombre, deporte_cancha_hora.cancha AS cancha, reserva.fecha_de_reserva AS fecha, 
        deporte_cancha_hora.hora_inicio AS hora_inicio, deporte_cancha_hora.hora_finalizado AS hora_finalizado, 
        reserva.abono_reserva
        FROM reserva
        JOIN persona ON reserva.id_persona = persona.id
        JOIN deporte_cancha_hora ON reserva.id_deporte_cancha_hora = deporte_cancha_hora.id
        JOIN deporte ON deporte_cancha_hora.id_deporte = deporte.id
        LEFT JOIN cancelaciones ON reserva.id = cancelaciones.id_reserva
        WHERE cancelaciones.id_reserva IS NULL";

if ($id !== '') {
    $sql .= " AND reserva.id LIKE '%$id%'";
}

$sql .= " ORDER BY reserva.id ASC LIMIT 5";

try {
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fecha_reserva = strtotime($row['fecha']);
            $fecha_actual = strtotime(date('Y-m-d'));
            echo "<tr id='reserva-{$row['id']}'>
                    <td>{$row['id']}</td>
                    <td>{$row['socio_nombre']}</td>
                    <td>{$row['socio_apellido']}</td>
                    <td>{$row['numero_de_socio']}</td>
                    <td>{$row['deporte_nombre']}</td>
                    <td>{$row['cancha']}</td>
                    <td>{$row['fecha']}</td>
                    <td>{$row['hora_inicio']} a {$row['hora_finalizado']}</td>
                    <td>{$row['abono_reserva']}</td>";
            if ($fecha_reserva >= $fecha_actual) {
                echo "<td><a href='../pages/form-de-cancelar.php?id_reserva={$row['id']}&fecha={$row['fecha']}' class='btn btn-danger'>Cancelar</a></td>";
            } else {
                echo "<td></td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='10'>No hay reservas</td></tr>";
    }
} catch (mysqli_sql_exception $e) {
    echo "<tr><td colspan='10'>Error en la consulta SQL: " . $e->getMessage() . "</td></tr>";
}
?>
