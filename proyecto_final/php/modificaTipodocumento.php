<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modifcación de Tipos de Documento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

  <!-- JS PARA REFACTORIZAR Y VER SI SE PUEDE USAR EN ALGUNA OTRA TABLA 
  <script language="javascript">
    $(document).ready(function() {
      $("#profesional").on('change', function() {
        $("#profesional option:selected").each(function() {
          var id_profesional = $(this).val();
          $.post("seleccionarespecialidadesporprofesional.php", {
            id_profesional: id_profesional
          }, function(data) {
            $("#especialidad").html(data);
          });
        });
      });

    });
  </script>
 -->
</head>

<body>
  <h1 class="bg-black p-2 text-white text-center">Modificación de Tipos de Documento</h1>
  <div class="container">
    <form class="row" action="editardatosTipodocumento.php" method="POST">
      <input type="Hidden" class="form-control" name="id" value="<?php echo $_GET['id']; ?>">

      <div class="mb-3">
        <label>Tipo de Documento</label>
        <select class="form-select mb-3" name="tipodocumento" id="tipodocumento" required="required">
          <option selected disabled>--Agregar Tipo de Documento--</option>
          <?php
          include("conexion.php");

          $recuperodatos = "SELECT tipo_documento.id as id_tipodocumento, 
          descripcion as descripcion_tipodocumento 
          from tipo_documento
          where tipo_documento.id = " . $_GET['id'];

          $resultadotipodocumento = $conn->query($recuperodatos);
          $rowtipodocumento       = $resultadotipodocumento->fetch_assoc();
          echo "<option selected disabled value='" . $rowprofesional['id_tipodocumento'] . "'>" . $rowtipodocumento['descripcion_tipodocumento'] . "</option>";

          ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Estado</label>
        <br>
        <input type="radio" name="activo" id="activo_si" value="SI" <?php if ($rowtipodocumento['estado'] == '1') echo 'checked'; ?> />
        <label for="contact_email">Activo</label>
        <input type="radio" name="activo" id="activo_no" value="NO" <?php if ($rowtipodocumento['estado'] == '0') echo 'checked'; ?> />
        <label for="contact_email">No Activo</label>
      </div>


      <div class="text-center">
        <button type="submit" id="submit" name="modificaTipodocumento" value="Modificar Datos" class="btn btn-danger">Grabar</button>
        <a href="abmTipodocumento.php" class="btn btn-dark">Volver</a>
      </div>
    </form>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>