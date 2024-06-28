<?php
    $id_reserva = $_GET['id_reserva'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLUB SOCIAL Y DEPORTIVO SAN CARLOS</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                <button type="button" class="btn btn-success">Administracion</button>
                <select name="idioma" id="idioma">
                    <option value="español">Español</option>
                    <option value="ingles">Inglés</option>
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
                            <a class="nav-link active" href="socio.php">SOCIO</a>
                        </li>
                        <li class="nav-item px-4">
                            <a class="nav-link active" href="club.html">CLUB</a>
                        </li>
                        <li class="nav-item px-4">
                            <a class="nav-link active" href="reserva-de-canchas.html">RESERVAS DE CANCHA</a>
                        </li>
                        <li class="nav-item px-4">
                            <a class="nav-link active" href="contacto.html">CONTACTO</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">DEPORTES</a>
                            <ul class="dropdown-menu">
                                <li><a href="#" class="dropdown-item">Fútbol</a></li>
                                <li><a href="#" class="dropdown-item">Vóley</a></li>
                                <li><a href="#" class="dropdown-item">Básquet</a></li>
                                <li><a href="#" class="dropdown-item">Natación</a></li>
                                <li><a href="#" class="dropdown-item">Hockey</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <h1 id="header" class="text-center mt-4">METODO DE PAGO</h1>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form class="row g-3 mt-5">
                        <div class="form-check col-sm-3">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="mostrarFormulario1">
                            <label class="form-check-label" for="mostrarFormulario1">QR</label>
                        </div>
                        <div class="form-check col-md-2">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="mostrarFormulario2">
                            <label class="form-check-label" for="mostrarFormulario2">Tarjeta</label>
                        </div>
                        <div class="form-check col-md-2">
                        </div>
                        <div class="col-2 input">
                            <button type="button" class="btn btn-success" id="aceptarButton" name="Aceptar" >Aceptar</button>
                        </div>
                        <div class="col-1 input">
                            <button type="button" class="btn btn-danger" id="atrasButton" name="Cancelar">Atras</button>
                        </div>
                    </form>
                    
                    <div id="formulario-1" class="text-center" style="display:none;">
                        <form class="row" name="formulario-1" method="POST" action="../php/actualizar_reserva.php">
                            <div class="col-md-12">
                                <h1>Escanea el QR para pagar</h1>
                                <img src="../img/icono_QR.png" alt="Icono de QR" class="mx-auto d-block">
                            </div>
                            <div class="col-md-12 mt-3">
                                <input type="hidden" id="reserva_id" value="<?php echo $id_reserva; ?>">
                                <button type="button" class="btn btn-success btn-separado" id="echoButton" name="Echo" >Echo</button>
                                <button type="button" class="btn btn-danger" id="Cancelar_pago1" name="Cancelar_pago1">Cancelar</button>
                            </div>
                            
                        </form>
                    </div>
                    
                    <div id="formulario-2" style="display:none;">
                        <form class="row g-3 mt-3" name="formulario-2"  method="POST" action="../php/actualizar_reserva.php">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Tarjetas de crédito</label>
                            </div>
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Tarjetas de débito</label>
                            </div>
                            <div class="col-md-1">
                                <i class="fa-brands fa-cc-visa icono"></i>
                            </div>
                            <div class="col-md-1">
                                <i class="fa-brands fa-cc-mastercard icono"></i>
                            </div>
                            <div class="col-md-1 offset-md-4">
                                <i class="fa-brands fa-cc-visa icono"></i>
                            </div>
                            <div class="col-md-1">
                                <i class="fa-brands fa-cc-mastercard icono"></i>
                            </div>
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre del titular</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                            </div>
                            <div class="col-md-6">
                                <label for="apellido" class="form-label">Número de tarjeta</label>
                                <input type="text" class="form-control" id="apellido" placeholder="Número de tarjeta">
                            </div>
                            <div class="col-md-6">
                                <label for="fecha" class="form-label">Fecha de caducidad</label>
                                <input type="text" class="form-control" id="fecha" placeholder="MM/AA">
                            </div>
                            <div class="col-md-6">
                                <label for="codigo" class="form-label">Código de seguridad</label>
                                <input type="text" class="form-control" id="codigo" placeholder="3 dígitos">
                            </div>
                            <div class="col-auto offset-md-5 mt-5">
                                <input type="hidden" id="reserva_id" value="<?php echo $id_reserva; ?>">
                                <button type="button" class="btn btn-success" id="pagarButton" name="Pagar">Pagar</button>
                                <button type="button" class="btn btn-danger" id="Cancelar_pago2" name="Cancelar_pago2">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        const reservaId = document.getElementById("reserva_id").value;

        document.getElementById("Cancelar_pago1").addEventListener("click", function() {
            alert(`Recuerda que debes pagar en caja antes de hacer uso de la cancha te esperamos. Tu Número de reserva: ${reservaId}`);
            window.location.href = "../pages/reserva-de-canchas.html";
        });

        document.getElementById("Cancelar_pago2").addEventListener("click", function() {
            alert(`Recuerda que debes pagar en caja antes de hacer uso de la cancha te esperamos. Tu Número de reserva: ${reservaId}`);
            window.location.href = "../pages/reserva-de-canchas.html";
        });
    </script>
<!-- es este mismo el de arriba pero sin el id reserva
    <script>
        document.getElementById("Cancelar_pago1").addEventListener("click", function() {
            alert("Recuerda pagar en caja antes de hacer uso de la cancha te esperamos");
            window.location.href = "../pages/reserva-de-canchas.html";
        });

        document.getElementById("Cancelar_pago2").addEventListener("click", function() {
            alert("Recuerda pagar en caja antes de hacer uso de la cancha te esperamos");
            window.location.href = "../pages/reserva-de-canchas.html";
        });
    </script> -->
    <script>
        document.getElementById('aceptarButton').addEventListener('click', function() {
            const formularioQR = document.getElementById('formulario-1');
            const formularioTarjeta = document.getElementById('formulario-2');

            if (document.getElementById('mostrarFormulario1').checked) {
                formularioQR.style.display = 'block';
                formularioTarjeta.style.display = 'none';
            } else if (document.getElementById('mostrarFormulario2').checked) {
                formularioQR.style.display = 'none';
                formularioTarjeta.style.display = 'block';
            } else {
                formularioQR.style.display = 'none';
                formularioTarjeta.style.display = 'none';
            }
        });

        document.getElementById('atrasButton').addEventListener('click', function() {
            document.getElementById('formulario-1').style.display = 'none';
            document.getElementById('formulario-2').style.display = 'none';
        });

        function actualizarReserva() {
            const reservaId = document.getElementById('reserva_id').value;

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../php/actualizar_reserva.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    alert(response.message); // Muestra la respuesta del servidor
                    if (response.success) {
                    // Si la actualización fue exitosa, redirigir al usuario
                    window.location.href = '../pages/reserva-de-canchas.html';
                }
                }
            };
            xhr.send("reserva_id=" + reservaId);
        }

        document.getElementById('echoButton').addEventListener('click', actualizarReserva);
        document.getElementById('pagarButton').addEventListener('click', actualizarReserva);
    </script>
    <script>
      // Función para mostrar el mensaje de alerta
      function mostrarAlerta() {
          alert('La tienda esta en mantenimiento, perdon por las molestias ocasionadas.');
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>





