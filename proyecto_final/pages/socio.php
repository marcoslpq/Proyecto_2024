<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLUB SOCIAL Y DEPORTIVO SAN CARLOS</title>
    <script src="https://kit.fontawesome.com/bfbcf1faa2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header>
        <div class="conteiner">
            <div class="inicio px-4">
                <a href="../index.html">
                    <img src="../img/1.png" alt="emblema" class="img">
                </a>
                <h4 class="texto">CLUB SOCIAL Y DEPORTIVO SAN CARLOS</h4>
            </div>
            <nav>
                <ul class="nav-link">
                    <li><a href="#" onclick="mostrarAlerta()">TIENDA</a></li>
                    <li><a href="https://www.instagram.com/san_carlos_oficial/?hl=es"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="https://www.facebook.com/club.sancarlos.10/"><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                </ul>
            </nav>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="../pages/admin.php"><button type="button" class="btn btn-success">Administrador</button></a>
                <select name="idioma" id="idioma">
                    <option value="español">Español</option>
                    <option value="ingles">Ingles</option>
                    <option value="otros idiomas">Otros idiomas...</option>
                </select> 
        </div>
        </div>
        <nav class="navbar navbar-expand-lg bg-success navbar-dark">

            <div class="container">
            <div class="collapse navbar-collapse">
        
                <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                <li class="nav-item px-4">
                    <a class="nav-link active" href="../index.html">INICIO</a>
                </li>
                <li class="nav-item px-4">
                    <a class="nav-link active" href="../pages/socio.php">SOCIO</a>
                </li>
                    <a class="nav-link active" href="../pages/club.html">CLUB</a>
                </li>    
                <li class="nav-item px-4">
                    <a class="nav-link active" href="../pages/reserva-de-canchas.html">RESERVAS DE CANCHA</a>
                </li>
                <li class="nav-item px-4">
                    <a class="nav-link active" href="#contacto">CONTACTO</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">DEPORTES</a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="dropdown-item">Futbol</a></li>
                        <li><a href="#" class="dropdown-item">Voley</a></li>
                        <li><a href="#" class="dropdown-item">Basquet</a></li>
                        <li><a href="#" class="dropdown-item">Hockey</a></li>
                    </ul>
                </li>
                </ul>
            </div>
            
            </div>
        </nav>
    </header>
    <section>
        <h2 class="text-center p-4 text-white">Hacete socio y se parte de nuestra familia</h2>
    </section>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-4">
                            <p class="text-white">Por favor completa los datos <strong>:</strong></p>
                        </div>
                    </div>
                    <form class="row g-3 mt-3" name="nuevo socio" method="POST" autocomplete="off" action="../php/registro_ing_socio.php">  <!--aqui abre el form-->
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombresocio" pattern="[a-zA-Z\s]+" id="nombre" placeholder="Nombre" maxlength="20" required>
                            <div class="error-message text" style="display:none; color:white;"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" name="apellidosocio" pattern="[a-zA-Z\s]+" id="apellido" placeholder="Apellido" maxlength="20" required>
                            <div class="error-message text" style="display:none; color:white;"></div>
                        </div>  
                            <div class="col-md-4 mt-3">
                                <label for="tipo-de-documento" class="form-label">Tipo de documento</label>
                                <select  name="tipo_documento" class="form-select" id="tipo-de-documento" aria-label="Default select example">
                                    <?php
                                        require("../php/conexion.php");
                                        $sql="SELECT ID, Descripcion from tipo_documento" ;
                                        $resultado = $conexion->query($sql);
                                        while ($valores = mysqli_fetch_array($resultado)) {
                                            echo '<option value ="'.$valores['ID'].'">'.$valores['Descripcion'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="numero" class="form-label">Número</label>
                                <label for="numero" class="form-label">(de 8 a 11 digitos)</label>
                                <input type="text" name="nr_documento" pattern="[0-9]+" class="form-control" id="numero" placeholder="Nº" minlength="8" maxlength="11" required>
                                <div class="error-message text" style="display:none; color:white;"></div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select  name="genero" class="form-select" id="sexo" aria-label="Default select example">
                                    <?php
                                        require("../php/conexion.php");
                                        $sql="SELECT ID, Descripcion from genero" ;
                                        $resultado = $conexion->query($sql);
                                        while ($valores = mysqli_fetch_array($resultado)) {
                                            echo '<option value ="'.$valores['ID'].'">'.$valores['Descripcion'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="correo" class="form-control" id="email" placeholder="Email" maxlength="20" required>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha-de-nacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nac" class="form-control" id="fecha-de-nacimiento" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" name="telefono" pattern="[0-9]+" class="form-control" id="telefono" placeholder="Teléfono" maxlength="10" required>
                            <div class="error-message text" style="display:none; color:white;"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="direccion" class="form-label">Localidad</label>
                            <input type="text" name="localidad" pattern="[a-zA-Z\s]+" class="form-control" id="direccion"  placeholder="Localidad" maxlength="25" required>
                            <div class="error-message text" style="display:none; color:white;"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="direccion" class="form-label">Calle</label>
                            <input type="text" name="calle" pattern="[a-zA-Z\s]+" class="form-control" id="direccionca"  placeholder="Nombre de calle o Av" maxlength="20" required>
                            <div class="error-message text" style="display:none; color:white;"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="direccion" class="form-label">Altura</label>
                            <input type="text" name="altura" pattern="[0-9]+" class="form-control" id="direccionalt"  placeholder="Altura" maxlength="5" required>
                            <div class="error-message text" style="display:none; color:white;"></div>
                        </div>
                        <div class="row mt-4 justify-content-center">
                            <div class="col-auto">
                                <input type="submit" name="registrar" class="btn btn-success" value="Aceptar">
                            </div>
                            <div class="col-auto">
                                <input type="reset" name="cancelar_regist" class="btn btn-danger" value="Cancelar">
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
        validateInput('#numero', /^[0-9]+$/, 'Solo se permiten números.');
        validateInput('#telefono', /^[0-9]+$/, 'Solo se permiten números.');
        validateInput('#direccion', /^[a-zA-Z\s]+$/, 'Solo se permiten letras y espacios.');
        validateInput('#direccionca', /^[a-zA-Z\s]+$/, 'Solo se permiten letras y espacios.');
        validateInput('#direccionalt', /^[0-9]+$/, 'Solo se permiten números.');
    });
</script>
<script>
      // Función para mostrar el mensaje de alerta
      function mostrarAlerta() {
          alert('La tienda esta en mantenimiento, perdon por las molestias ocasionadas.');
      }
</script>
<section class="bg-success mt-3" id="contacto">
        <div class="container posicion-conteiner">
          <div class="row justify-content-center">
              <div class="col-md-8">
                <form name="Contacto" class="row g-3" action="../php/mandarmail.php" method="POST">
                    <div class="col-md-3 mt-5 offset-md-2 ">
                        <p class="text-white parrafo"><strong>Contacto</strong></p>
                    </div>
                    <div class="col-md-3 mt-5 offset-md-4">
                        <p class="text-white parrafo"><strong>Direccion</strong></p>
                    </div>
                    <div class="col-md-6 text-center">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
                        <label for="correo" class="form-label mt-2">Correo Electronico</label>
                        <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo" required>
                        <label for="consulta" class="form-label mt-2">Dejanos tu consulta</label>
                        <textarea name="descripcion" class="form-control" cols="45" rows="5" id="detalles" placeholder="Ingrese su consulta" required></textarea>
                        <div class="col-auto mt-3 mb-3">
                            <input type="submit" name="enviar" class="btn btn-light" value="ENVIAR"> 
                            <input type="reset" name="borrar" class="btn btn-light" value="BORRAR"> 
                        </div>
                    </div>
                    <div class="col-md-6 px-3">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4699.03323505802!2d-59.79947380969555!3d-34.179924227885095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bbd83298154d17%3A0x1c9857d60d815d81!2sCLUB%20SOCIAL%20Y%20DEPORTIVO%20SAN%20CARLOS!5e0!3m2!1ses-419!2sar!4v1716605343188!5m2!1ses-419!2sar" width="500" height="320" style="border:10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                  </form> 
                </div>
              </div>
          </div>
  
          <div class="card-group">
            <div class="card anch-card alt-card">
              <div class="card-body">
                <h5 class="card-title">Horarios de atencion</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary mt-3">Lunes a Viernes 8:00 a 12:00 y de 16:00 a 20:00</h6>
                <p class="card-subtitle mb-2 text-body-secondary">Sabados 6:30 a 11:30 y Domingos cerrado</p>
              </div>
            </div>
            <div class="card anch-card ">
              <div class="card-body">
                <h5 class="card-title">Comunicate con nosotros</h5>
                <h6 class="card-subtitle text-body-secondary mt-3">Tel: 2478-410231</h6>
              </div>
            </div>
            <div class="card anch-card ">
              <div class="card-body">
                <h5 class="card-title">Mail</h5>
                <h6 class="card-subtitle  text-body-secondary mt-3">clubsancarlos1941@yahoo.com.ar</h6>
              </div>
            </div>
          </div>
  
        </div>
      </section>
   
      <footer class=" mt-4 text-center">
          <p>
            <img id="tamaño_copyright" src="/img/simbolo-de-copyright.png" alt="copyright">
            Copyright; 2024 - Club San Carlos.
          </p>
      </footer>

</body>
</html>