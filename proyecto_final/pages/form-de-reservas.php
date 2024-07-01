<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLUB SOCIAL Y DEPORTIVO SAN CARLOS</title>
    <script src="https://kit.fontawesome.com/bfbcf1faa2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                <a href="admin.php"><button type="button" class="btn btn-success">Administrador</button></a>
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
                    <a class="nav-link active" href="../index.html">INCIO</a>
                </li>
                <li class="nav-item px-4">
                  <a class="nav-link active" href="../pages/socio.php">SOCIO</a>
                </li>
                <li class="nav-item px-4">
                  <a class="nav-link active" href="club.html">CLUB</a>
                </li>
                <li class="nav-item px-4">
                  <a class="nav-link active" href="../pages/reserva-de-canchas.html">RESERVAS DE CANCHA</a>
                </li>
                <li class="nav-item px-4">
                  <a class="nav-link active" href="../index.html#contacto">CONTACTO</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">DEPORTES</a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="dropdown-item">Futbol</a></li>
                        <li><a href="#" class="dropdown-item">Voley</a></li>
                        <li><a href="#" class="dropdown-item">Basquet</a></li>
                        <li><a href="#" class="dropdown-item">Natacion</a></li>
                        <li><a href="#" class="dropdown-item">Hockey</a></li>
                    </ul>
                </li>
                </ul>
            </div>
            </div>
        </nav>
    </header>

    <main>
        <h1 id="header" class="text-center mt-4"></h1>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <!-- Aquí va el formulario de reservas -->
                    <form class="row g-3 mt-3" name="nuevo socio" method="POST" autocomplete="off" action="../php/registro_reserva.php">  <!--aqui abre el form-->
                        <div class="col-md-2">
                            <p class="text-white"><strong>¿Sos socio?</strong></p>
                        </div>

                        <!--AQUI VA EL NOMBRE DEL DEPORTE-->
                        <input type="hidden" name="deporte" id="deporte">
                        <div class="form-check col-md-1">
                            <input class="form-check-input" type="radio" name="radiosocio" id="flexRadioDefault1" value="si">
                            <label class="form-check-label" for="flexRadioDefault1">SI</label>
                        </div>
                        <div class="form-check col-md-1">
                            <input class="form-check-input" type="radio" name="radiosocio" id="flexRadioDefault2" value="no" checked>
                            <label class="form-check-label" for="flexRadioDefault2">NO</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="nrsocio" class="form-control input" pattern="[0-9]+" id="nrsocio" placeholder="Nº" disabled>
                        </div>
                        
                        <div id="error-message" class="text" style="display:none; color:white;"></div>

                        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" pattern="[a-zA-Z\s]+" id="nombre" placeholder="Nombre" maxlength="20" required>
                            <div class="error-message text" style="display:none; color:white;"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" name="apellido" pattern="[a-zA-Z\s]+" id="apellido" placeholder="Apellido" maxlength="20" required>
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
                        <div class="col-md-6 mt-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="correo" class="form-control" id="email" placeholder="Email" maxlength="50" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="fecha-de-nacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nac" class="form-control" id="fecha-de-nacimiento" required>
                        </div>
                        <div class="col-md-6 mt-3" id="selectFutbol">
                            <label for="numero-cancha" class="form-label">Numero de cancha</label>
                            <select name="nrdecancha" class="form-select" id="numero_cancha_futbol" aria-label="Default select example">
                            <?php
                                    require("../php/conexion.php");
                                    $sql="SELECT cancha FROM deporte_cancha_hora JOIN deporte ON deporte_cancha_hora.id_deporte= deporte.ID WHERE deporte.Descripcion= '" . $_GET['deporte'] . "' GROUP BY id_deporte, cancha" ;
                                    $resultado = $conexion->query($sql);
                                    while ($valores = mysqli_fetch_array($resultado)) {
                                        echo '<option value ="'.$valores['cancha'].'">'.$valores['cancha'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" name="telefono" pattern="[0-9]+" class="form-control" id="telefono" placeholder="Teléfono" maxlength="10" required>
                            <div class="error-message text" style="display:none; color:white;"></div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="fecha_rese" class="form-label">Dia de reserva</label>
                            <input type="date" name="fecha_rese" class="form-control" id="fecha_rese" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="sexo" class="form-label">Horario de reserva</label>
                            <select multiple name="horario_inic[]" class="form-select single-height" id="horario_inic" aria-label="Default select example">
                            <!-- Los horarios disponibles se cargarán aquí -->
                            </select>
                        </div>
                        <style>
                            .single-height {
                            height: calc(3rem + 2px); /* Ajusta esta altura según el select single */
                            }
                        </style>
                        <!-- selector para diferentes deportes -->
                        
                        <div class="col-md-4 mt-3">
                            <label for="direccion" class="form-label">Localidad</label>
                            <input type="text" name="localidad" pattern="[a-zA-Z\s]+" class="form-control" id="direccion" placeholder="Localidad" maxlength="25" required>
                            <div class="error-message text" style="display:none; color:white;"></div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="direccion" class="form-label">Calle</label>
                            <input type="text" name="calle" pattern="[a-zA-Z\s]+" class="form-control" id="direccionca" placeholder="Nombre de calle o Av" maxlength="20" required>
                            <div class="error-message text" style="display:none; color:white;"></div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="direccion" class="form-label">Altura</label>
                            <input type="text" name="altura" pattern="[0-9]+" class="form-control" id="direccionalt" placeholder="Altura" maxlength="5" required>
                            <div class="error-message text" style="display:none; color:white;"></div>
                        </div>
                        <input type="hidden" id="id_dia" name="id_dia">
                        <div class="row mt-4 justify-content-center">
                            <div class="col-auto">
                                <input type="submit" name="reservar" class="btn btn-success" value="Reservar">
                            </div>
                            <div class="col-auto">
                                <input type="reset" name="cancelar_reserva" class="btn btn-danger" value="Cancelar">
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
    </main>
                        <!--AQUI VA LA PARTE DEL FORMATO DEL TEXTO INPUT AVISAR EN TIEMPO REAL-->
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

    // Mostrar/ocultar campo de número de socio
    $('input[name="radiosocio"]').on('change', function() {
        if ($('#flexRadioDefault1').is(':checked')) {
            $('#nrsocio').prop('disabled', false);
            // Deshabilitar campos
            $('#nombre, #apellido, #numero, #email, #telefono, #direccion, #direccionca, #direccionalt').prop('readonly', true);
        } else {
            $('#nrsocio').prop('disabled', true).val('');
            // Habilitar campos y limpiar valores
            $('#nombre, #apellido, #numero, #email, #telefono, #direccion, #direccionca, #direccionalt').prop('readonly', false).val('');
        }
    });
});
</script>
<!--ID DIA PARA EL FORMULARIO Y ENVIARLO POST:-->
<script>
    document.getElementById('fecha_rese').addEventListener('change', function() {
        var fecha = new Date(this.value);
        var diaSemana = fecha.getDay(); 
        var diaMap = {
            0: 1, // lunes
            1: 2, // martes
            2: 3, // Miercoles
            3: 4, // jueves
            4: 5, // viernes
            5: 6, // sabado
            6: 7,  // domingo
        };

        var idDia = diaMap[diaSemana];
        document.getElementById('id_dia').value = idDia;
    });
</script>

<script>
    document.getElementById('fecha_rese').addEventListener('change', function() {
        $('#numero_cancha_futbol').on('change', function () {
                $('#fecha_rese').val(''); // Limpiar la fecha de reserva
                $('#horario_inic').empty(); // Limpiar los horarios disponibles
        });
        $('#numero_cancha_futbol').on('change input', function () {
            var nrdecancha = $(this).val();
            obtenerHorariosDisponibles();
        });
        
        $('#deporte').on('input', function(){
            var deporte = $(this).val();
        }) 
        var fecha = new Date(this.value);
        var diaSemana = fecha.getDay(); 
        var diaMap = {
            0: 1, // lunes
            1: 2, // martes
            2: 3, // Miercoles
            3: 4, // jueves
            4: 5, // viernes
            5: 6, // sabado
            6: 7,  // domingo
        };

        var idDia = diaMap[diaSemana];
        var fechaReserva = this.value; // Obtener la fecha de reserva seleccionada
        var deporte = document.getElementById('deporte').value;
        var nrdecancha = $('#numero_cancha_futbol').val();
      
       obtenerHorariosDisponibles(idDia, fechaReserva, deporte, nrdecancha);
    });
        
    function obtenerHorariosDisponibles(idDia, fechaReserva, deporte, nrdecancha) {
        $.ajax({
            url: '../php/obtener_horarios.php',
            method: 'GET',
            data: { id_dia: idDia, fecha_rese: fechaReserva, deporte: deporte, nrdecancha: nrdecancha },
            dataType: 'json',
            success: function(data) {
                var horarioSelect = $('#horario_inic');
                horarioSelect.empty(); // Vaciar el select de horarios
               
                if (data && data.length > 0) {
                    
                    data.forEach(function(horario) {
                        //alert(idDia/* + '-' + deporte + '-' + nrdecancha*/);
                        horarioSelect.append(new Option(horario.hora_inicio + ' - ' + horario.hora_finalizado, horario.id));
                    });
                } else {
                    //alert(idDia/* + '-' + deporte + '-' + nrdecancha*/);
                    horarioSelect.append(new Option('No hay horarios disponibles', ''));
                }
            },
        error: function() {
            //alert(idDia + '-' + fechaReserva);
            alert('Error al obtener los horarios disponibles.');
        }
    });
}

</script>  
                        

        <!--aqui va el script de buscar datos del socio si llega hacer socio-->
<script>
    $(document).ready(function(){
        $('#nrsocio').on('input', function(){
            var nrsocio = $(this).val();
            if(nrsocio.length > 0){
                $.ajax({
                    url: '../php/buscar_datos.php',
                    method: 'GET',
                    data: {nrsocio: nrsocio},
                    dataType: 'json',
                    success: function(data){
                        if (data && Object.keys(data).length > 0 && !data.error) {
                            $('#nombre').val(data.Nombre).prop('readonly', true);
                            $('#apellido').val(data.Apellido).prop('readonly', true);
                            $('#tipo-de-documento').val(data.id_tipo_de_documento).prop('disabled', true);
                            $('#tipo-de-documento-hidden').val(data.id_tipo_de_documento);
                            $('#numero').val(data.Numero_Documento).prop('readonly', true);
                            $('#sexo').val(data.id_genero).prop('disabled', true);
                            $('#sexo-hidden').val(data.id_genero);
                            $('#email').val(data.Email).prop('readonly', true);
                            $('#fecha-de-nacimiento').val(data.fecha_nac).prop('readonly', true);
                            $('#telefono').val(data.telefono).prop('readonly', true);
                            $('#direccion').val(data.Localidad).prop('readonly', true);
                            $('#direccionca').val(data.Calle).prop('readonly', true);
                            $('#direccionalt').val(data.Altura).prop('readonly', true);

                            // Ocultar mensaje de error si la respuesta es exitosa
                            $('#error-message').hide();
                        } else {
                            $('#nombre').val('');
                            $('#apellido').val('');
                            $('#tipo-de-documento').val('');
                            $('#numero').val('');
                            $('#sexo').val('');
                            $('#email').val('');
                            $('#fecha-de-nacimiento').val('');
                            $('#telefono').val('');
                            $('#direccion').val('');
                            $('#direccionca').val('');
                            $('#direccionalt').val('');

                            // Mostrar mensaje de error
                            $('#error-message').text(data.error ? data.error : "Número de socio no encontrado").show();
                        }
                    },
                    error: function() {
                        // Manejar errores de la solicitud AJAX
                        $('#error-message').text("Error en la solicitud. Por favor, intente nuevamente.").show();
                    }
                });
            } else {
                $('#nombre').val('');
                $('#apellido').val('');
                $('#tipo-de-documento').val('');
                $('#numero').val('');
                $('#sexo').val('');
                $('#email').val('');
                $('#fecha-de-nacimiento').val('');
                $('#telefono').val('');
                $('#direccion').val('');
                $('#direccionca').val('');
                $('#direccionalt').val('');

                // Ocultar mensaje de error si no hay entrada
                $('#error-message').hide();
            }
        });
    });
</script>

  
    <script>
        // Función para obtener el valor del parámetro 'deporte' de la URL
        function getDeporteFromURL() {
            const params = new URLSearchParams(window.location.search);
            return params.get('deporte');
        }

            // Función para actualizar el título de la página con el nombre del deporte
        function actualizarTituloDeporte() {
            const deporte = getDeporteFromURL();
            if (deporte) {
                const header = document.getElementById('header');
                header.textContent = deporte.toUpperCase();

                // Mapear el nombre del deporte al ID correspondiente
                const deporteMap = {
                    "futbol": 1,
                    "voley": 2,
                    "hockey": 3,
                    "basquet": 4,
                };
                
                // Asignar el valor del ID del deporte al campo oculto
                const deporteInput = document.getElementById('deporte');
                deporteInput.value = deporteMap[deporte.toLowerCase()];
                deporteIdInput.value = deporteInput.value;
            }
        }
    
        // Función para habilitar o deshabilitar el input de número de socio y limpiar el formulario
        function toggleNrsocioInput() {
            const radioSi = document.getElementById('flexRadioDefault1');
            const radioNo = document.getElementById('flexRadioDefault2');
            const nrsocioInput = document.getElementById('nrsocio');
            const form = document.forms['nuevo socio'];

            if (radioSi.checked) {
                nrsocioInput.disabled = false;
            } 
            else if (radioNo.checked) {
                nrsocioInput.disabled = true;
                nrsocioInput.value = '';
                // Limpiar todos los campos del formulario
                form.reset();
            }
        }

        // Agregar event listeners a los botones de radio
        document.getElementById('flexRadioDefault1').addEventListener('change', toggleNrsocioInput);
        document.getElementById('flexRadioDefault2').addEventListener('change', toggleNrsocioInput);

        // Llamar a la función para actualizar el título al cargar la página
        window.onload = function() {
            actualizarTituloDeporte();
            toggleNrsocioInput();
        };

        // Obtener parámetros de la URL
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const deporte = urlParams.get('deporte');
        document.getElementById('header').innerText = deporte;
        document.getElementById('deporte').value = deporte;

        // Habilitar/Deshabilitar campo de número de socio
        const radioSocioSi = document.getElementById('flexRadioDefault1');
        const radioSocioNo = document.getElementById('flexRadioDefault2');
        const nrSocioInput = document.getElementById('nrsocio');

        radioSocioSi.addEventListener('change', () => {
            nrSocioInput.disabled = !radioSocioSi.checked;
        });

        radioSocioNo.addEventListener('change', () => {
            nrSocioInput.disabled = radioSocioNo.checked;
        });
    </script>
    <script>
      // Función para mostrar el mensaje de alerta
      function mostrarAlerta() {
          alert('La tienda esta en mantenimiento, perdon por las molestias ocasionadas.');
      }
    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzG6LR1Knn8eJ2z9ndiN8QwI1xzC1H6wXH7xR6A9dakt" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-qljovkHYa/Q5PoF6NHTQQ1/2e6bJVjy3Eds5DZjw+grc5mrbLU5S8e1moP6KTKP6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   

</body>
</html>