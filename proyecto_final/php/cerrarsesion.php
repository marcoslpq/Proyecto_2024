<?php

session_start();  //inicia nueva sesion o reanuda la existente

//destruimos todas las variables

$_SESSION=array(); //array esta vacio y hago que agarre ese valor vacion la varriable global _session

//destruimos session

session_destroy();
header ('Location: ../pages/admin.php');

?>