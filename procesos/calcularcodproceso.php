<?php

// Connects to your Database 

 include "../conectar7.php";
 include "../mysqli_result.php";


 $consultaprevia = "SELECT max(codproceso) as maximo FROM procesos";
 $rs_consultaprevia = mysqli_query($conexion, $consultaprevia);
 $codproceso = mysqli_result($rs_consultaprevia, 0, "maximo");
 if ($codproceso == "") {
     $codproceso = 0;
 }
 $codproceso++;


//insert in DB
$query_creaproceso="INSERT INTO procesos (codproceso, unidadmedida, codstatus, codestacion, codtrabajador, borrado) VALUES ('$codproceso', '1', '5', '1', '1', '0')";		
$rs_operacion=mysqli_query($conexion,$query_creaproceso);
//return codproceso as json
$codigo['codproceso']=$codproceso;
 echo json_encode($codigo); 
?>

 
