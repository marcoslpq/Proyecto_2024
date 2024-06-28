<?php
$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$descripcion = $_POST["descripcion"];

try {
    // Enviar el correo electrónico de confirmación
    $to = $correo;
    $subject = "Nueva consulta";  //ASUNTO DEL CORREO
    $message = "Consulta por parte de $nombre,\n\n La consulta es, $descripcion.\n";  //CONTENIDO DEL CORREO
    $headers = "From: clubsancarlos@gmail.com\r\n" .  //el correo desde donde vamos a enviar
               "Reply-To: clubsancarlos@gmail.com\r\n" .
               "X-Mailer: PHP/" . phpversion();

    mail($to, $subject, $message, $headers); 
    echo '<script type="text/javascript">
        setTimeout(function(){
            alert("Gracias por tu consulta a la brevedad nos pondremos en contacto.");
        }, 1000);
        setTimeout(function(){
            window.location.href = "../index.html";
        }, 3000);
    </script>';

} catch (Exception $e) {
    echo "Error al enviar el correo electrónico: {$e->getMessage()}";
}
?>