<?php

include("conexion.php");

$nombresocio = $_POST["nombresocio"];
$apellidosocio = $_POST["apellidosocio"];
$tipo_documento = $_POST["tipo_documento"];
$nr_documento = $_POST["nr_documento"];
$genero = $_POST["genero"];
$correo = $_POST["correo"];
$fecha_nac = $_POST["fecha_nac"];
$telefono = $_POST["telefono"];
$localidad = $_POST["localidad"];
$calle = $_POST["calle"];
$altura = $_POST["altura"];

// Verificar si existe un registro con el número de documento
$consulta = "SELECT Numero_Documento, Numero_de_socio FROM persona WHERE Numero_Documento = '$nr_documento'";
$resultado = mysqli_query($conexion, $consulta);
$fila = mysqli_fetch_array($resultado);

if (!$fila) {
    // No existe el documento, generar un número de socio único
    do {
        $nrsocio = rand(1000, 9999);
        $check_query = "SELECT Numero_de_socio FROM persona WHERE Numero_de_socio = '$nrsocio'";
        $check_result = mysqli_query($conexion, $check_query);
    } while (mysqli_num_rows($check_result) > 0);

    // Insertar el nuevo usuario con el número de socio único
    $sql = "INSERT INTO persona (Numero_Documento, id_tipo_de_documento, Apellido, Nombre, Numero_de_socio, Email, id_genero, telefono, fecha_nac, Localidad, Calle, Altura)
            VALUES ('$nr_documento', '$tipo_documento', '$apellidosocio', '$nombresocio', '$nrsocio', '$correo', '$genero', '$telefono', '$fecha_nac', '$localidad', '$calle', '$altura')";

    if (mysqli_query($conexion, $sql)) {
        echo "<script>
                alert('Ya sos parte del club. Tu número de socio es: $nrsocio');
                window.location.href = '../pages/socio.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($conexion) . "');
                window.location.href = '../pages/socio.php';
              </script>";
    }
} else {
    // Existe el documento, verificar si tiene número de socio
    if (empty($fila['Numero_de_socio'])) {
        // No tiene número de socio, generar un número de socio único
        do {
            $nrsocio = rand(1000, 9999);
            $check_query = "SELECT Numero_de_socio FROM persona WHERE Numero_de_socio = '$nrsocio'";
            $check_result = mysqli_query($conexion, $check_query);
        } while (mysqli_num_rows($check_result) > 0);

        // Actualizar el registro existente con el nuevo número de socio
        $sql = "UPDATE persona SET id_tipo_de_documento = '$tipo_documento', Apellido = '$apellidosocio', Nombre = '$nombresocio', Numero_de_socio = '$nrsocio', Email = '$correo', id_genero = '$genero', telefono = '$telefono', fecha_nac = '$fecha_nac', Localidad = '$localidad' 
                WHERE Numero_Documento = '$nr_documento'";

        if (mysqli_query($conexion, $sql)) {
            echo "<script>
                    alert('Ya sos parte del club. Tu número de socio es: $nrsocio');
                    window.location.href = '../pages/socio.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . mysqli_error($conexion) . "');
                    window.location.href = '../pages/socio.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('El socio ya existe con el número de socio: " . $fila['Numero_de_socio'] . "');
                window.location.href = '../pages/socio.php';
              </script>";
    }
}

mysqli_close($conexion);

?>

