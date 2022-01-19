<?php
if(session_id() == '') {
    session_start();
}
include_once(__DIR__.DIRECTORY_SEPARATOR.'enviroment.php');
$Servidor="database";
$BaseDeDatos= $_SESSION["BaseDeDatos"];
$Usuario= $_SESSION["Usuario_DB"];
$Password= $_SESSION["Password_DB"];
$conexion=mysqli_connect($Servidor,$Usuario,$Password,$BaseDeDatos) or die("Error: El servidor no puede conectar con la base de datos");
?>