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
            <div class="d-md-flex justify-content-md-end">
                <i class="fa-solid fa-user icono"></i>   
                <a class="btn btn-success" href="../php/cerrarsesion.php">Cerrar sesion</a>
            </div>
        </div>
    </header>

    <main class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <form class="row g-3 mt-3" name="cancelar_reserva" method="POST" autocomplete="off" action="../php/cancelar_reserva.php">
                <?php
                $id_reserva = isset($_GET['id_reserva']) ? (int)$_GET['id_reserva'] : 0;
                $fecha = isset($_GET['fecha']) ? htmlspecialchars($_GET['fecha']) : '';
                ?>
                <input type="hidden" name="id_reserva" value="<?php echo $id_reserva; ?>">
                <div class="col-md-12">
                    <label for="fecha" class="form-label">Fecha de reserva</label>
                    <input type="date" name="fecha" class="form-control" id="fecha" readonly value="<?php echo $fecha; ?>">
                </div> 
                <div class="col-md-12">
                    <label for="fecha-cancelada" class="form-label">Fecha de cancelacion</label>
                    <input type="date" name="fecha-cancelada" class="form-control" id="fecha-cancelada" readonly value="<?php echo date('Y-m-d'); ?>">
                </div>  
                <div class="col-md-12">
                    <label for="cancel" class="form-label">Motivo de cancelación</label>
                    <select name="cancel" id="cancel" class="form-select" aria-label="Default select example">
                        <option value="Cambio de planes" selected>Cambio de planes</option>
                        <option value="Problemas de salud">Problemas de salud</option>
                        <option value="Condiciones climáticas">Condiciones climáticas</option>
                        <option value="Falta de jugadores">Falta de jugadores</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-danger mt-3 col-md-12">Cancelar Reserva</button>
                </div>
                <div class="col-md-6">
                    <a href="../pages/tabla-reservas.php" class="btn btn-warning mt-3 col-md-12">Volver</a>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>