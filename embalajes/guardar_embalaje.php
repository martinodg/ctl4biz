<?
require_once("../conectar7.php"); 
require_once("../mysqli_result.php");

$accion=$_POST["accion"];
if (!isset($accion)) { $accion=$_GET["accion"]; }

$nombre=$_POST["Anombre"];
$cantidad=$_POST["Acantidad"];
$coduniMedida=$_POST["Aunimedida"];

if ($accion=="alta") {
    $q_nameUniMedida="SELECT nombre FROM `unidadesmedidas` WHERE `codunidadmedida` = '$coduniMedida'";
    $rs_nameUniMedida=mysqli_query($conexion,$q_nameUniMedida);
    $nameUniMedida=mysqli_result($rs_nameUniMedida,0,"nombre");
    $query_operacion="INSERT INTO embalajes (codembalaje, nombre, cantidad, codunidadmedida, borrado) 
					VALUES ('', '$nombre', '$cantidad', '$coduniMedida', '0')";

	$rs_operacion=mysqli_query($conexion,$query_operacion);
	if ($rs_operacion) { $mensaje="El embalaje ha sido dado de alta correctamente"; }
	$cabecera1="Inicio >> Embalajes &gt;&gt; Nuevo Embalaje ";
	$cabecera2="INSERTAR EMBALAJE ";
	$sel_maximo="SELECT max(codembalaje) as maximo FROM embalajes";
	$rs_maximo=mysqli_query($conexion,$sel_maximo);
	$codembalaje=mysqli_result($rs_maximo,0,"maximo");
}

if ($accion=="modificar") {
	$codembalaje=$_POST["Zid"];
	$query="UPDATE embalajes SET  codembalaje='$codembalaje', nombre='$nombre', cantidad='$cantidad', codunidadmedida='$coduniMedida', borrado=0 WHERE codembalaje='$codembalaje'";
	$rs_query=mysqli_query($conexion,$query);
	if ($rs_query) { $mensaje="Los datos del embalaje han sido modificados correctamente"; }
	$cabecera1="Inicio >> Embalajes &gt;&gt; Modificar Embalaje ";
    $cabecera2="<span id='tmodembalaje'>MODIFICAR EMBALAJE</span>";

    $q_nameUniMedida = "SELECT * FROM `unidadesmedidas` WHERE `codunidadmedida` = '$coduniMedida'";
    $rs_nameUniMedida = mysqli_query($conexion, $q_nameUniMedida);
    $nameUniMedida = mysqli_result($rs_nameUniMedida, 0, "nombre");
}

if ($accion=="baja") {
	$codembalaje=$_GET["codembalaje"];
    $nameUniMedida=$_GET["codunimedida"];

	$query_comprobar="SELECT * FROM articulos WHERE codembalaje='$codembalaje' AND borrado=0";
    $rs_comprobar=mysqli_query($conexion,$query_comprobar);

    $query_embalajes="SELECT * FROM embalajes WHERE codembalaje='$codembalaje' AND borrado=0";
    $rs_consultaEmbalajes=mysqli_query($conexion,$query_embalajes);
    $cantidad = mysqli_result($rs_consultaEmbalajes,0,'cantidad');

    if (mysqli_num_rows($rs_comprobar) > 0 ) {
		?><script>
			alert ("No se puede eliminar este embalaje porque tiene articulos asociados.");
			location.href="eliminar_ubicacion.php?codubicacion=<? echo $codubicacion?>";
		</script>
		<?
	} else {
		$query="UPDATE embalajes SET borrado=1 WHERE codembalaje='$codembalaje'";
		$rs_query=mysqli_query($conexion,$query);
		if ($rs_query) { $mensaje="El embalaje ha sido eliminada correctamente"; }
		$cabecera1="Inicio >> Embalajes &gt;&gt; Eliminar Embalaje ";
		$cabecera2="ELIMINAR EMBALAJE ";
		$query_mostrar="SELECT * FROM embalajes WHERE codembalaje='$codembalaje'";
		$rs_mostrar=mysqli_query($conexion,$query_mostrar);
		$codembalaje=mysqli_result($rs_mostrar,0,"codembalaje");
		$nombre=mysqli_result($rs_mostrar,0,"nombre");
	}
}

?>

<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
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
							<td width="15%"><span  id="tcod">C&Oacute;DIGO</span></td>
							<td width="85%" colspan="2"><?php echo $codembalaje?></td>
					    </tr>
						<tr>
							<td width="15%"><span  id="tnomb">Nombre</span></td>
						    <td width="85%" colspan="2"><?php echo $nombre?></td>
					    </tr>
                        <tr>
                            <td width="15%"><span id="tcant">Cantidad</span></td>
                            <td width="85%" colspan="2"><?php echo $cantidad?></td>
                        </tr>
                        <tr>
                            <td width="15%"><span id="tunidad">Unidad de Medida</span></td>
                            <td width="85%" colspan="2"><?php echo $nameUniMedida;?></td>
                        </tr>
					</table>
			  </div>
				<div id="botonBusqueda">
					<button type="button" id="btnaceptar" onClick="aceptar()" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span  id="taceptar">Aceptar</span> </button>
			  </div>
			 </div>
		  </div>
		</div>
	</body>
</html>
