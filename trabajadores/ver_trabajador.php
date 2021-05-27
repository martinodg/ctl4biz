<?
require_once("../conectar7.php");
require_once("../mysqli_result.php");
$codtrabajador=$_GET["codtrabajador"];
$cadena_busqueda=$_GET["cadena_busqueda"];

$query="SELECT * FROM trabajadores WHERE codtrabajador='$codtrabajador'";
$rs_query=mysqli_query($conexion,$query);

?>

<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">

		function aceptar() {
			location.href="index.php?cadena_busqueda=<? echo $cadena_busqueda?>";
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
                    <div id="tituloForm" class="header"><span  id="tvtrb">VER TRABAJADOR</span></div>
				<div id="frmBusqueda">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="15%"><span  id="tcod">C&Oacute;DIGO</span></td>
							<td width="85%" colspan="2"><?php echo $codtrabajador?></td>
					    </tr>
						<tr>
							<td width="15%"><span  id="tnomb">Nombre</span></td>
						    <td width="85%" colspan="2"><?php echo mysqli_result($rs_query,0,"nombre")?></td>
					    </tr>
						<tr>
						  <td><span  id="tnip">NIF / CIF</span></td>
						  <td colspan="2"><?php echo mysqli_result($rs_query,0,"nif")?></td>
					  </tr>
						<tr>
						  <td><span  id="tdireccion">Direcci&oacute;n</span></td>
						  <td colspan="2"><?php echo mysqli_result($rs_query,0,"direccion")?></td>
					  </tr>
						<tr>
						  <td><span  id="tlocal">Localidad</span></td>
						  <td colspan="2"><?php echo mysqli_result($rs_query,0,"localidad")?></td>
					  </tr>
					  <?php
					  	$codprovincia=mysqli_result($rs_query,0,"codprovincia");
						if ($codprovincia<>0) {
							$query_provincias="SELECT * FROM provincias WHERE codprovincia='$codprovincia'";
							$res_provincias=mysqli_query($conexion,$query_provincias);
							$nombreprovincia=mysqli_result($res_provincias,0,"nombreprovincia");
						} else {
							$nombreprovincia="Sin determinar";
						}
					  ?>
						<tr>
							<td width="15%"><span  id="tpcia">Provincia</span></td>
							<td width="85%" colspan="2"><?php echo $nombreprovincia?></td>
					    </tr>
						<?php
						$codformapago=mysqli_result($rs_query,0,"codformapago");
						if ($codformapago<>0) {
							$query_formapago="SELECT * FROM formapago WHERE codformapago='$codformapago'";
							$res_formapago=mysqli_query($conexion,$query_formapago);
							$nombrefp=mysqli_result($res_formapago,0,"nombrefp");
						} else {
							$nombrefp="Sin determinar";
						}
					  ?>
						<tr>
							<td width="15%"><span  id="tforpago">Forma de pago</span></td>
							<td width="85%" colspan="2"><?php echo $nombrefp?></td>
					    </tr>
						<?php
						$codentidad=mysqli_result($rs_query,0,"codentidad");
						if ($codentidad<>0) {
							$query_entidades="SELECT * FROM entidades WHERE codentidad='$codentidad'";
							$res_entidades=mysqli_query($conexion,$query_entidades);
							$nombreentidad=mysqli_result($res_entidades,0,"nombreentidad");
						} else {
							$nombreentidad="Sin determinar";
						}
					  ?>
						<tr>
							<td width="15%"><span  id="tentiban">Entidad Bancaria</span></td>
							<td width="85%" colspan="2"><?php echo $nombreentidad?></td>
					    </tr>
						<tr>
							<td><span  id="tctabcaria">Cuenta bancaria</span></td>
							<td colspan="2"><?php echo mysqli_result($rs_query,0,"cuentabancaria")?></td>
						</tr>
						<tr>
							<td><span  id="tcodpostal">C&oacute;digo postal</span></td>
							<td colspan="2"><?php echo mysqli_result($rs_query,0,"codpostal")?></td>
						</tr>
						<tr>
							<td><span  id="ttelef">Tel&eacute;fono</span></td>
							<td><?php echo mysqli_result($rs_query,0,"telefono")?></td>
						</tr>
						<tr>
							<td><span  id="tmovil">M&oacute;vil</span></td>
							<td colspan="2"><?php echo mysqli_result($rs_query,0,"movil")?></td>
						</tr>
						<tr>
							<td><span  id="tcorrelec">Correo electr&oacute;nico</span></td>
							<td colspan="2"><?php echo mysqli_result($rs_query,0,"email")?></td>
						</tr>
												<tr>
							<td><span  id="tdirrcweb">Direcci&oacute;n web</span></td>
							<td colspan="2"><?php echo mysqli_result($rs_query,0,"web")?></td>
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
