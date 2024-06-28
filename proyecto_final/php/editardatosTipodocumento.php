<?php
require("conexion.php");

$vl           = 0 ; 
$id           = $_POST['id']; 

$verificodatos = "SELECT tipo_documento.id as id_tipodocumento , 
                  tipo_documento.activo as activo 
                  from tipo_documento 
                  where tipo_documento.id='$id' " ; 

$resultadodatos = mysqli_query($conn, $verificodatos); 
$datos = $resultadodatos->fetch_assoc();

if(isset($_POST['tipodocumento'])){
    $tipodocumento= $_POST['tipodocumento'];  
} else {
    $tipodocumento= $datos['id_tipodocumento'];  
}

if(isset($_POST['activo'])){
    $estado= $_POST['activo'];  
} else {
    $estado= $datos['activo'];  
}
if($estado=='SI'){
    $idestado=1;  
} else {
    $idestado=0;  
}

// 1) VERIFICO SI ESTOS DATOS NO ESTAN REPETIDOS 
$verificoduplicado = "SELECT COUNT(tipo_documento.id) AS total from tipo_documento
where tipo_documento.activo = 1 and 
tipo_documento.id='$tipodocumento' "; 

$result = mysqli_query($conn, $verificoduplicado); 
$total = $result->fetch_assoc();

if($total['total']>0){    
            ?>
            <script>
                alert ("Datos Repetidos. Ya existe este Tipo de Documento");
                window.location.href = "";   // ACA TIENEN QE PONER LA REDIRECCION A SU PAGINA DE ADMINISTRACION  
            </script>
          <?php
    $v1= 1;
} 

 
if($vl == 0 ){
    $sql = "UPDATE tipo_documento set 
    descripcion='$descripcion_tipodocumento', 
    activo='$idestado' 
    where id=".$id ; 
    
    $resultado = mysqli_query($conn, $sql); 
    if($resultado === TRUE){
        header("location: "); // ACA TIENEN QE PONER LA REDIRECCION A SU PAGINA DE ADMINISTRACION  
    } else {
        echo "Datos NO modificados"; 
    }
}
