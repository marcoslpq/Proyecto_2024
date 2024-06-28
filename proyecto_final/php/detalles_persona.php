<?php
include 'conexion.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id === '') {
    die('ID de socio no proporcionado');
}

$sql = "SELECT * FROM persona WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$persona = $result->fetch_assoc();

if (!$persona) {
    die('Socio no encontrado');
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Persona</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Detalles de la Persona</h1>
        <form id="form-detalles" method="POST">
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id" name="id" value="<?php echo htmlspecialchars($persona['ID'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="num_socio" class="form-label">Número de Socio</label>
                <input type="text" class="form-control" id="num_socio" name="num_socio" value="<?php echo $persona['Numero_de_socio']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" pattern="[a-zA-Z\s]+" maxlength="20" value="<?php echo $persona['Nombre']; ?>" required>
                <div class="error-message text" style="display:none; color:white;"></div>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" pattern="[a-zA-Z\s]+" maxlength="20" value="<?php echo $persona['Apellido']; ?>" required>
                <div class="error-message text" style="display:none; color:white;"></div>
            </div>
            <div class="mb-3">
                <label for="tipo-de-documento" class="form-label">Tipo de documento</label>
                <select name="tipo_documento" class="form-select" id="tipo-de-documento" aria-label="Default select example">
                    <?php
                        require("../php/conexion.php");
                        $sql = "SELECT ID, Descripcion FROM tipo_documento";
                        $resultado = $conexion->query($sql);
                        while ($valores = mysqli_fetch_array($resultado)) {
                            $selected = ($valores['ID'] == $persona['id_tipo_de_documento']) ? 'selected' : '';
                            echo '<option value="' . $valores['ID'] . '" ' . $selected . '>' . $valores['Descripcion'] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="documento" class="form-label">Número de Documento</label>
                <input type="text" class="form-control" id="documento" name="documento" pattern="[0-9]+" minlength="8" maxlength="11" value="<?php echo $persona['Numero_Documento']; ?>" required>
                <div class="error-message text" style="display:none; color:white;"></div>
            </div>
            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select name="genero" class="form-select" id="sexo" aria-label="Default select example">
                    <?php
                        require("../php/conexion.php");
                        $sql = "SELECT ID, Descripcion FROM genero";
                        $resultado = $conexion->query($sql);
                        while ($valores = mysqli_fetch_array($resultado)) {
                            $selected = ($valores['ID'] == $persona['id_genero']) ? 'selected' : '';
                            echo '<option value="' . $valores['ID'] . '" ' . $selected . '>' . $valores['Descripcion'] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" maxlength="30" value="<?php echo $persona['Email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" pattern="[0-9]+" maxlength="12" value="<?php echo $persona['telefono']; ?>" required>
                <div class="error-message text" style="display:none; color:white;"></div>
            </div>
            <div class="mb-3">
                <label for="fecha-de-nacimiento" class="form-label">Fecha de nacimiento</label>
                <input type="date" name="fecha_nac" class="form-control" id="fecha-de-nacimiento" value="<?php echo $persona['fecha_nac']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Localidad</label>
                <input type="text" name="localidad" pattern="[a-zA-Z\s]+" class="form-control" id="direccion" maxlength="25" value="<?php echo $persona['Localidad']; ?>" maxlength="25" required>
                <div class="error-message text" style="display:none; color:white;"></div>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Calle</label>
                <input type="text" name="calle" pattern="[a-zA-Z\s]+" class="form-control" id="direccionca" maxlength="20"  value="<?php echo $persona['Calle']; ?>" maxlength="20" required>
                <div class="error-message text" style="display:none; color:white;"></div>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Altura</label>
                <input type="text" name="altura" pattern="[0-9]+" class="form-control" id="direccionalt" maxlength="5" value="<?php echo $persona['Altura']; ?>" maxlength="5" required>
                <div class="error-message text" style="display:none; color:white;"></div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="javascript:history.back()" class="btn btn-danger">Volver</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        // Función para validar en tiempo real las cajas de texto o input
        function validateInput(input, regex, errorMessage) {
            $(input).on('input', function() {
                const value = $(this).val();
                if (!regex.test(value)) {
                    $(this).css('border-color', 'black');
                    $(this).next('.error-message').text(errorMessage).show();
                } else {
                    $(this).css('border-color', '');
                    $(this).next('.error-message').hide();
                }
            });
        }

        // Validar campos en tiempo real
        validateInput('#nombre', /^[a-zA-Z\s]+$/, 'Solo se permiten letras y espacios.');
        validateInput('#apellido', /^[a-zA-Z\s]+$/, 'Solo se permiten letras y espacios.');
        validateInput('#documento', /^[0-9]+$/, 'Solo se permiten números.');
        validateInput('#telefono', /^[0-9]+$/, 'Solo se permiten números.');
        validateInput('#direccion', /^[a-zA-Z\s]+$/, 'Solo se permiten letras y espacios.');
        validateInput('#direccionca', /^[a-zA-Z\s]+$/, 'Solo se permiten letras y espacios.');
        validateInput('#direccionalt', /^[0-9]+$/, 'Solo se permiten números.');
    });
</script>

    <script>
    $(document).ready(function() {
        $('#form-detalles').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'actualizar_persona.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        alert('Datos actualizados correctamente');
                        // Redireccionar después de mostrar el mensaje de éxito
                        window.location.href = '../pages/tabla-socios.php';
                    } else {
                        alert('Error: ' + data.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error al realizar la solicitud AJAX: ' + textStatus + ' - ' + errorThrown);
                }
            });
        });
    });
    </script>
</body>
</html>
