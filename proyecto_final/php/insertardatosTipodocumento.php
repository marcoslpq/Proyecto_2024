<?php
require("conexion.php");

$idtipodocumento            = $_POST['id_tipodocumento']; 
$descripciontipodocumento   = $_POST['descripcion_tipodocumento']; 
$V1                         = 0; 

// 1) VERIFICO SI ESTOS DATOS NO ESTAN REPETIDOS 
$verificoduplicado = "SELECT COUNT(tipo_documento.id) AS total from tipo_documento
where tipo_documento.activo = 1 and 
tipo_documento.id='$idtipodocumento' "; 

$result = mysqli_query($conn, $verificoduplicado); 
$total = $result->fetch_assoc();

if($total['total']>0){    
             ?>
             <script>
                 alert ("Datos Repetidos. Ya existe este Tipo de Documento");
                 window.location.href = "";  // ACA DEBEN PONER LA REDIRECCION A LA PAGINA DE ADMINISTRACION OTRA VEZ 
             </script>
           <?php
           $V1= 1; 
 } 

if($v1 == 0){
    $sql = "INSERT INTO tipo_documento 
    (descripcion, activo) 
    VALUES ('$descripciontipodocumento', '1')"; 

    $resultado = mysqli_query($conn, $sql); 
    
    if($resultado === TRUE){
        header("location: ");  // ACA DEBEN PONER LA REDIRECCION A LA PAGINA DE ADMINISTRACION OTRA VEZ CON ALGUN MENSAJE DE DTO GRABADO CON EXITO
    } else {
        echo "Datos NO insertados"; 
    }
}


