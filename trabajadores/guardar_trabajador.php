<?
require_once("../conectar7.php");
require_once("../mysqli_result.php");


$accion=$_POST["accion"];
if (!isset($accion)) { $accion=$_GET["accion"]; }

$nombre=$_POST["anombre"];
$nif=$_POST["anif"];
$password=$_POST["apassword"];
$telefono=$_POST["atelefono"];
$movil=$_POST["amovil"];
$movilavisos=$_POST["amovilavisos"];
$email=$_POST["aemail"];
$emailavisos=$_POST["aemailavisos"];
$sel_maximo="SELECT max(codtrabajador) as maximo FROM trabajadores";
	$rs_maximo=mysqli_query($conexion,$sel_maximo);
    $codtrabajador=mysqli_result($rs_maximo,0,"maximo");
$nuevocodigo=$codtrabajador++;
if ($accion=="alta") {
	$query_operacion="INSERT INTO trabajadores (codtrabajador,nombre, nif, password, telefono, movil, movilavisos, email, emailavisos, borrado ) VALUES ('$nuevocodigo','$nombre', '$nif', '$password', '$telefono', '$movil', '$movilavisos', '$email', '$emailavisos', '0')";
	$rs_operacion=mysqli_query($conexion,$query_operacion);
	if ($rs_operacion) { $mensaje="El trabajador ha sido dado de alta correctamente"; }
	$cabecera1="Inicio >> Trabajadores &gt;&gt; Nuevo Trabajador ";
	$cabecera2="INSERTAR TRABAJADOR ";
	
	
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
//@todo revisar como traducir esto
$cabecera1="Inicio >> Trabajadores &gt;&gt; Ver Trabajador ";
	$cabecera2="VER TRABAJADOR ";
}

?>

<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">

		function aceptar() {
			location.href="index.php";
		}

		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}

		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header"><?php echo $cabecera2?></div>
				<div id="frmBusqueda">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="15%"></td>
							<td width="85%" colspan="2" class="mensaje"><?php echo $mensaje;?></td>
					    </tr>
						<tr>
							<td width="15%"><span id="tcod">C&Oacute;DIGO</span></td>
							<td width="85%" colspan="2"><?php echo $codtrabajador?></td>
					    </tr>
						<tr>
							<td width="15%"><span id="tnomb">Nombre</span></td>
						    <td width="85%" colspan="2"><?php echo $nombre?></td>
					    </tr>
						<tr>
						  <td><span id="tnip">NIF / CIF</span></td>
						  <td colspan="2"><?php echo $nif?></td>
					  </tr>
						<tr>
                            <td><span id="tpassword">Contrase&ntilde;a</span></td>
						  <td colspan="2"><?php echo $password?></td>
					  </tr>
						<tr>
						  <td><span id="ttelef">Tel&eacute;fono</span></td>
						  <td colspan="2"><?php echo $telefono?></td>
					  </tr>
						<tr>
							<td width="15%"><span id="tmovil">M&oacute;vil</span></td>
							<td width="85%" colspan="2"><?php echo $movil?></td>
					    </tr>
						<tr>
                            <td width="15%"><span id="tmovavi">M&oacute;vil Avisos</span></td>
							<td width="85%" colspan="2"><?php echo $movilavisos?></td>
					    </tr>
						<tr>
							<td width="15%"><span id="tcorrelec">Correo electr&oacute;nico</span></td>
							<td width="85%" colspan="2"><?php echo $email?></td>
					    </tr>
						<tr>
							<td><span id="tcorrelecavs">Correo electr&oacute;nico Avisos</span></td>
							<td colspan="2"><?php echo $emailavisos?></td>
						</tr>
					</table>
			  </div>
				<div id="botonBusqueda">
					<button type="button" id="btnaceptar" onClick="aceptar()" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span id="taceptar">Aceptar</span> </button>
			  </div>
			 </div>
		  </div>
		</div>
	</body>
</html>
