<?php

require_once("../../conectar7.php");
require_once("../../funciones/cargaImagenes.php");

function salvarAvatarUsuario($nombreUsuario, $valorFile){
	if(isset($_FILES[$valorFile])){
		return cargarAvatarUsuario($nombreUsuario,$_FILES[$valorFile]);
	}
	return false;
}

$accion=$_POST["accion"];
$codusuario=$_POST["codusuario"];
$nombre=$_POST["name"];
$mail=$_POST["email"];
$password=$_POST["password"];
$estado=$_POST["estado"];

if ($accion=="alta") {
	$query_operacion="INSERT INTO intUsersTable (intUser_name, user_name, password, codstatus, borrado) VALUES ('$nombre','$mail', '$password', '4', '0')";
	$rs_operacion=mysqli_query($conexion,$query_operacion);
	if ($rs_operacion) { $mensaje="El Usuario ha sido dado de alta correctamente"; }
	try{
		salvarAvatarUsuario($nombre,'avatarfile');
	} catch (Exception $e) {
		$mensaje =  "No se ha podido cargar la imagen " . $e->getMessage() ;
	}
}

if ($accion=="modificar") {
	$query="UPDATE intUsersTable SET user_name='$mail', password='$password', codstatus='$estado' WHERE intUser_name='$nombre'";
	$rs_query=mysqli_query($conexion,$query);
	if ($rs_query) { $mensaje="Los datos del usuario han sido modificados correctamente"; }
	try{
		salvarAvatarUsuario($nombre,'avatarfile');
	} catch (Exception $e) {
		$mensaje =  "No se ha podido cargar la imagen " . $e->getMessage() ;
	}
	$cabecera1="Settings >> Modificar Usuarios &gt;&gt; Modificar Usuarios ";
	$cabecera2="MODIFICAR Usuarios ";
}

if (!empty($_GET['accion']) && $_GET['accion']=="ver") {
	$codtrabajador=$_GET["codtrabajador"];

$codtrabajador=$_GET["codtrabajador"];

$query="SELECT * FROM trabajadores WHERE codtrabajador='$codtrabajador'";
$rs_query=mysqli_query($conexion,$query);

$nombre = mysqli_result($rs_query,0,"nombre");
$nif = mysqli_result($rs_query,0,"nif");
$password = mysqli_result($rs_query,0,"password");
$telefono = mysqli_result($rs_query,0,"telefono");
$movil = mysqli_result($rs_query,0,"movil");
$movilavisos = mysqli_result($rs_query,0,"movilavisos");
$email = mysqli_result($rs_query,0,"email");
$emailavisos = mysqli_result($rs_query,0,"emailavisos");

$cabecera1="Inicio >> Trabajadores &gt;&gt; Ver Trabajador ";
	$cabecera2="VER TRABAJADOR ";
}


echo $mensaje;
?>

