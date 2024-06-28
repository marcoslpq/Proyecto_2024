<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLUB SOCIAL Y DEPORTIVO SAN CARLOS</title>
    <script src="https://kit.fontawesome.com/bfbcf1faa2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/sesion.css">
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
        

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="admin.php"><button type="button" class="btn btn-success">Administrador</button></a>
            <select name="idioma" id="idioma">
                <option value="español">Español</option>
                <option value="ingles">Ingles</option>
                <option value="otros idiomas">Otros idiomas...</option>
            </select> 
        </div>
    </div>
    </header> 
    <main class="posicion-sesion d-flex justify-content-center"> 
    <div class="wrapper">
        <form name="sesion" method="POST" action="../php/iniciarsesion.php">
            <h1>Iniciar sesion</h1>
            <div class="input-box">
                <input type="text" name="usuario" autocomplete="off" placeholder="Usuario" required> <i class="fa-solid fa-user"></i>
            </div>
            <div class="input-box">
                <input type="password" name="contraseña" autocomplete="off" placeholder="Contraseña" required> <i class="fa-solid fa-lock"></i>
            </div>
            <?php
                if (isset($_GET['error'])) {
                    echo '<p style="color: white;">' . htmlspecialchars($_GET['error']) . '</p>';
                }
                ?>
            <input type="submit" name="enviar" class="btn btn-success" value="Ingresar">
        </form>

    </div>
    </main> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>