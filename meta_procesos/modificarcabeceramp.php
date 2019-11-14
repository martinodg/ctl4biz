<?php
include ("../conectar7.php"); 

$codigo=$_GET["codmproceso"];
$nombre=$_GET["nombremproceso"];
$batch=$_GET["batch"];
//echo $batch;
$query_modificarcabeceramp="UPDATE metaprocesos SET nombre = '$nombre', esbatch='$batch' where codproceso='$codigo';";
$rs_modificarcabeceramp=mysqli_query($conexion,$query_modificarcabeceramp);
echo "<h1><center>Datos del meta-proceso modificados</h1></center>";