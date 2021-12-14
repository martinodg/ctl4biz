<?php
if(session_id() == '') {
    session_start();
}
//ini_set('display_errors', '0');
$Servidor="database";
$BaseDeDatos= $_SESSION["BaseDeDatos"];
$Usuario= $_SESSION["Usuario_DB"];
$Password= $_SESSION["Password_DB"];
$conexion=mysqli_connect($Servidor,$Usuario,$Password,$BaseDeDatos) or die("Error: El servidor no puede conectar con la base de datos");
?>
