<?
require_once("../conectar7.php"); 
require_once("../mysqli_result.php");

$codembalaje=$_GET["codembalaje"];
$cadena_busqueda=$_GET["cadena_busqueda"];

$query="SELECT * FROM embalajes WHERE codembalaje='$codembalaje' AND borrado=0";
$rs_query=mysqli_query($conexion,$query);

$cod_unimedida = mysqli_result($rs_query,0,'codunidadmedida');

$query_unimedida ="SELECT * FROM unidadesmedidas WHERE codunidadmedida='$cod_unimedida'";
$rs_queryUnimedida = mysqli_query($conexion,$query_unimedida);

$uniMedida = mysqli_result($rs_queryUnimedida,0,'nombre');

?>

<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
		<script language="javascript">
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		function aceptar(codembalaje) {
			location.href="guardar_embalaje.php?codembalaje=" + codembalaje +"&codunimedida=<? echo $uniMedida;?>" + "&accion=baja" + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function cancelar() {
			location.href="index.php?cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
                    <div id="tituloForm" class="header"><span  id="telemb">ELIMINAR EMBALAJE</span></div>
				<div id="frmBusqueda">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="15%"><span  id="tcod">C&Oacute;DIGO</span></td>
							<td width="85%" colspan="2"><?php echo $codembalaje?></td>
					    </tr>
						<tr>
							<td width="15%"><span  id="tnomb">Nombre</span></td>
						    <td width="85%" colspan="2"><?php echo mysqli_result($rs_query,0,"nombre")?></td>
					    </tr>
                        <tr>
							<td width="15%"><span  id="tcant">Cantidad</span></td>
						    <td width="85%" colspan="2"><?php echo mysqli_result($rs_query,0,"cantidad")?></td>
					    </tr>
                        <tr>
                            <?php
                            $cod_uniMedida = mysqli_result($rs_query,0,"codunidadmedida");
                            $consulta_uniMedida = mysqli_query($conexion,"SELECT nombre FROM `unidadesmedidas` WHERE codunidadmedida = $cod_uniMedida");
                            $uniMedida = mysqli_result($consulta_uniMedida,0,'nombre');
                            ?>
							<td width="15%"><span id="tunidad">Unidad de Medida</span></td>
						    <td width="85%" colspan="2" name="Aunimedida"><?php echo $uniMedida; ?></td>
					    </tr>
					</table>
			  </div>
				<div id="botonBusqueda">
					<button type="button" id="btnaceptar" onClick="aceptar(<? echo $codembalaje?>)" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span  id="taceptar">Aceptar</span> </button>
					<button type="button" id="btncancelar"  onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/cancelar.svg" alt="cancelar" /> <span  id="tcancelar">Cancelar</span> </button>
			  </div>
			 </div>
		  </div>
		</div>
	</body>
</html>
