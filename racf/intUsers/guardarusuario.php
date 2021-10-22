<?php

require_once("../../conectar7.php");
require_once("../../funciones/cargaImagenes.php");



$accion=$_POST["accion"];
$codusuario=$_POST["codusuario"];
$nombre=$_POST["name"];
$mail=$_POST["email"];
$password=$_POST["password"];
$estado=(!isset($_POST["estado"])) ? 1:intval($_POST["estado"]);
if ($accion=="alta") {
	try{
		$avatar = salvarAvatarUsuario($nombre,'avatarfile');
		$avatarUrl = ($avatar === false) ?  "":$avatar['dbUrl'];
	} catch (Exception $e) {
		throw  new ErrorException("No se ha podido cargar la imagen " . $e->getMessage() );
	}
	$rolId=(empty($_POST["rolId"])) ? 4 : intval($_POST["rolId"]);
	$query_operacion="INSERT INTO intUsersTable (intUser_name, user_name, password, codstatus, borrado, avatar)  VALUES ('$nombre','$mail', '$password', '$rolId', '0','".$avatarUrl."')";
	$rs_operacion=mysqli_query($conexion,$query_operacion) or trigger_error('Error al insertar el usuario:'.mysqli_error($conexion));
	$usuarioId = mysqli_insert_id($conexion);
	//rol
	$query_operacion1="INSERT INTO `rolesToUsersTable` (`id_rtu`, `id_role`, `id_intUser`, `borrado`) VALUES (NULL,".$rolId.",".intval($usuarioId).",0)";
	$rs_operacion=mysqli_query($conexion,$query_operacion1) or trigger_error('Error al insertar el rol:'.mysqli_error($conexion));
	if ($rs_operacion) { $mensaje="El Usuario ha sido dado de alta correctamente"; }
}

if ($accion=="modificar") {
	$query="UPDATE intUsersTable SET user_name='$mail', password='$password', codstatus='$estado'";
	try{
		$avatar = salvarAvatarUsuario($nombre,'avatarfile');
		if( $avatar !== false){
			$query.=", avatar='".$avatar['dbUrl']."' ";
		}
	} catch (Exception $e) {
		$mensaje =  "No se ha podido cargar la imagen " . $e->getMessage() ;
	}
	$query.=" WHERE intUser_name='$nombre'";
	$rs_query=mysqli_query($conexion,$query);
	if ($rs_query) { $mensaje="Los datos del usuario han sido modificados correctamente"; }
	
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

