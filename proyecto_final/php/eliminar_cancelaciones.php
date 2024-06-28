<?php
// Incluir archivo de conexión
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cancelacion = $_POST['id_cancelacion'];

    // Obtener el ID de la reserva asociada
    $sql_reserva = "SELECT id_reserva FROM cancelaciones WHERE id = ?";
    $stmt_reserva = $conexion->prepare($sql_reserva);
    $stmt_reserva->bind_param("i", $id_cancelacion);
    $stmt_reserva->execute();
    $stmt_reserva->bind_result($id_reserva);
    $stmt_reserva->fetch();
    $stmt_reserva->close();

    // Iniciar una transacción
    $conexion->begin_transaction();

    try {
        // Eliminar la cancelación
        $sql_delete_cancelacion = "DELETE FROM cancelaciones WHERE id = ?";
        $stmt_delete_cancelacion = $conexion->prepare($sql_delete_cancelacion);
        $stmt_delete_cancelacion->bind_param("i", $id_cancelacion);
        $stmt_delete_cancelacion->execute();
        $stmt_delete_cancelacion->close();

        // Eliminar la reserva asociada
        $sql_delete_reserva = "DELETE FROM reserva WHERE id = ?";
        $stmt_delete_reserva = $conexion->prepare($sql_delete_reserva);
        $stmt_delete_reserva->bind_param("i", $id_reserva);
        $stmt_delete_reserva->execute();
        $stmt_delete_reserva->close();

        // Confirmar la transacción
        $conexion->commit();
        echo '<script type="text/javascript">
                    setTimeout(function(){
                        alert("Fue eliminada con exito.");
                    }, 1000);
                    setTimeout(function(){
                        window.location.href = "../pages/tabla-de-cancelaciones.php";
                    }, 3000);
                </script>';

        
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conexion->rollback();
        echo "Error al eliminar la cancelación y la reserva: " . $e->getMessage();
        exit;
    }
    exit;
}

// Cerrar la conexión
$conexion->close();
?>
