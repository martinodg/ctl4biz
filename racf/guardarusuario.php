<?
include ("../conectar7.php");

$accion=$_GET["accion"];
$nombre=$_GET["name"];
$mail=$_GET["email"];
$password=$_GET["password"];


if ($accion=="alta") {
	$query_operacion="INSERT INTO internalUsersTable (intUserName, intUserMail, intUserPass, codstatus, borrado) VALUES ('$nombre','$mail', '$password', '4', '0')";
	$rs_operacion=mysqli_query($conexion,$query_operacion);
	if ($rs_operacion) { $mensaje="El Usuario ha sido dado de alta correctamente"; }
	
	
}

if ($accion=="modificar") {
	$codtrabajador=$_POST["codtrabajador"];
	$query="UPDATE trabajadores SET nombre='$nombre', nif='$nif', password='$password', telefono='$telefono', movil='$movil', movilavisos='$movilavisos', email='$email', emailavisos='$emailavisos' WHERE codtrabajador='$codtrabajador'";
	$rs_query=mysqli_query($conexion,$query);
	if ($rs_query) { $mensaje="Los datos del trabajador han sido modificados correctamente"; }
	$cabecera1="Inicio >> Trabajadores &gt;&gt; Modificar Trabajador ";
	$cabecera2="MODIFICAR TRABAJADOR ";
}

if ($_GET['accion']=="ver") {
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

