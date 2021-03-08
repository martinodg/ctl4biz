<?php

  require_once("config.php"); 
  $conexion=mysqli_connect($Servidor,$Usuario,$Password,'ctl4biz') ;//or die("Error: El servidor no puede conectar con la base de datos");

if (!$conexion) {
  echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
  echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
  echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
  exit;
}
  //$descriptor=mysqli_select_db('ctl4biz',$conexion);

?>
