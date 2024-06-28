<?php
include 'conexion.php';

$query = isset($_GET['query']) ? $_GET['query'] : '';

$sql = "SELECT persona.id, persona.Nombre AS socio_nombre, persona.Apellido AS socio_apellido, 
        persona.Numero_Documento AS socio_documento, persona.Numero_de_socio AS socio_Numero_de_socio, 
        persona.Email AS socio_Email, persona.telefono AS socio_telefono, persona.activa_s_n AS socio_activa_s_n
        FROM persona";

if ($query !== '') {
    $sql .= " WHERE persona.Numero_de_socio LIKE '%$query%' OR persona.Numero_Documento LIKE '%$query%'";
}

try {
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr id='persona-{$row['id']}'>
                    <td>{$row['id']}</td>
                    <td>{$row['socio_nombre']}</td>
                    <td>{$row['socio_apellido']}</td>
                    <td>{$row['socio_documento']}</td>
                    <td>{$row['socio_Numero_de_socio']}</td>
                    <td>{$row['socio_Email']}</td>
                    <td>{$row['socio_telefono']}</td>
                    <td>
                        <div class='d-flex'>
                            <div class='mx-2'>
                                <input type='radio' name='activo_{$row['id']}' id='activo_si_{$row['id']}' value='SI' ".($row['socio_activa_s_n'] == 'SI' ? 'checked' : '').">
                                <label for='activo_si_{$row['id']}'>Activo</label>
                            </div>
                            <div class='mx-2'>
                                <input type='radio' name='activo_{$row['id']}' id='activo_no_{$row['id']}' value='NO' ".($row['socio_activa_s_n'] == 'NO' ? 'checked' : '').">
                                <label for='activo_no_{$row['id']}'>No activo</label>
                            </div>
                        </div>
                    </td>
                    <td><a class='btn btn-danger' onclick='eliminarSocio({$row['id']})'>Eliminar</a>
                        <a class='btn btn-info' href='../php/detalles_persona.php?id={$row['id']}'>Ver detalles</a>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No hay socios</td></tr>";
    }
} catch (mysqli_sql_exception $e) {
    echo "Error en la consulta SQL: " . $e->getMessage();
}

$conexion->close();
?>
