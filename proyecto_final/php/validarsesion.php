<?php

//validacion nos pregunta si el valor de login es verdadera o falsa 
//esto es para no ing directo desde la url sin haber iniciado sesion antes

session_start(); //inicia una nueva sesion o reanuda la existente.

$login=$_SESSION['login']; //hacemos nuevament recambio de variable

if (!$login) // si logim no es verdadero te manda a la pag de inic sesion que es admin.php
    {
        header ('Location: ../pages/admin.php');
    }
else //de lo contrario si nos deja pasar a la pag web pqe ya se inicio sesion validad
    {
        $usuario=$_SESSION['usuario']; //hacemos recambio de variable de nuevo para despues volver a llamar la variab usuario si es enecesario

    }

?>