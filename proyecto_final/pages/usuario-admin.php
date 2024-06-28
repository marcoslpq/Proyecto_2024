<?php
include("../php/conexion.php");
include("../php/validarsesion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLUB SOCIAL Y DEPORTIVO SAN CARLOS</title>
    <script src="https://kit.fontawesome.com/bfbcf1faa2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin.css">
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
        <div class= " d-md-flex justify-content-md-end">
            <i class="fa-solid fa-user icono"></i>   
            <a class="btn btn-success" href="../php/cerrarsesion.php">Cerrar sesion</a>
        </div>
    </div>
    </header> 
<main>
<h1 class="text-center p-4">ADMINISTRACION</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="row g-3 mt-3">
<!-- <div class="container-fluid d-flex justify-content-center p-4"> -->
                <div class="col-md-6">
                <a class="btn btn-light border border-3 border-dark px-4 mx-2 col-12" href="tabla-reservas.php"><strong>RESERVAS</strong></a>
                </div>
                <div class="col-md-6">
                <a class="btn btn-light border border-3 border-dark px-4 mx-2 col-12" href="tabla-socios.php"><strong>PERSONAS</strong></a>
                </div>
                <div class="col-md-6">
                <a class="btn btn-light border border-3 border-dark px-4 mx-2 col-12" href="tabla-administradores.php"><strong>ADMINISTRADORES</strong></a>
                </div>
                <div class="col-md-6">
                <a class="btn btn-light border border-3 border-dark px-4 mx-2 col-12" href="tabla-tipo-de-documento.php"><strong>DOCUMENTOS DE IDENTIDAD</strong></a>
                </div>
                <div class="col-md-6">
                <a class="btn btn-light border border-3 border-dark px-4 mx-2 col-12" href="tabla-de-cancelaciones.php"><strong>CANCELACIONES</strong></a>
                </div>
                <div class="col-md-6">
                <a class="btn btn-light border border-3 border-dark px-4 mx-2 col-12" href="tabla-de-deportes.php"><strong>DEPORTES</strong></a>
                </div>
                <div class="col-md-6 offset-md-3">
                <a class="btn btn-light border border-3 border-dark px-4 mx-2 col-12" href="./tabla-deporte-cancha-hora.php"><strong>DEPORTE-CANCHA-HORA</strong></a>
                </div>
            </div>
        </div>
    </div>
</div>

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>