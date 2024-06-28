<?php
$servidor ="localhost"; 
$usuario="root";        
$contraseña="";         
$BD="clubsancarlos";          

//creamos con una variable la conexion es un comando que usaremos

$conexion =mysqli_connect($servidor, $usuario, $contraseña, $BD); 

//verificamos la conexion atraves de un if

if (!$conexion) {
    echo"fallo la conexion <br>";
    die("Connection failed:" . mysqli_connect_error()); 
}

//else {
 //   echo "conexion exitosa";
//}

?>