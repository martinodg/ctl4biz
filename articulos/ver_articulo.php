<?
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 

require_once("../conectar7.php"); 
require_once("../mysqli_result.php");
require_once("../funciones/fechas.php");
require_once("../funciones/cargaImagenes.php");

//require_once("../barcode/barcode.php");

$codarticulo=$_GET["codarticulo"];
$cadena_busqueda=$_GET["cadena_busqueda"];

//$query="SELECT * FROM articulos WHERE codarticulo='$codarticulo'";
$query="SELECT a.*, (SELECT b1.nombre FROM unidadesmedidas b1 WHERE b1.codunidadmedida = a.codunidadmedida ) AS umstock, (SELECT b2.nombre FROM unidadesmedidas b2 WHERE b2.codunidadmedida = a.codumstock_minimo ) AS umstock_min, (SELECT b3.nombre FROM unidadesmedidas b3 WHERE b3.codunidadmedida = a.codumunidades_caja ) AS umunidades_caja FROM articulos a WHERE codarticulo='$codarticulo'";
$rs_query=mysqli_query($conexion,$query);
$codigobarras=mysqli_result($rs_query,0,"codigobarras");

$directorioItemsEmpresa = '../'.$_SESSION[''];

?>

<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
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
		
		function aceptar() {
			location.href="index.php?cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
                    <div id="tituloForm" class="header"><span  id="tvarticulo">VER ARTICULO</span></div>
				<div id="frmBusqueda">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="22%"><span  id="tcodigo">CODIGO</span></td>
						    <td width="38%"><? echo mysqli_result($rs_query,0,"codarticulo")?></td>
					        <td width="40%" rowspan="11" align="center" valign="top"><img src="<?php echo traerUrlImagenProducto(mysqli_result($rs_query,0,"imagen"));?>" width="160px" height="140px" border="1"></td>
						</tr>
						<tr>
							<td width="22%"><span  id="trefren">Referencia</span></td>
							<? $referencia=mysqli_result($rs_query,0,"referencia"); ?>
							<td width="38%"><? echo mysqli_result($rs_query,0,"referencia")?></td>
				        </tr>
						<?php
						$codfamilia=mysqli_result($rs_query,0,"codfamilia");
					  	$query_familia="SELECT * FROM familias WHERE codfamilia='$codfamilia'";
						$res_familia=mysqli_query($conexion,$query_familia);
						$nombrefamilia=mysqli_result($res_familia,0,"nombre");
					  ?>
						<tr>
							<td width="22%"><span  id="tflia">FAMILIA</span></td>
							<td width="38%"><?php echo $nombrefamilia?></td>
				        </tr>
						<tr>
							<td width="22%"><span  id="tdescri">Descripci&oacute;n</span></td>
						    <td width="38%"><? echo mysqli_result($rs_query,0,"descripcion")?></td>
				        </tr>
						<tr>
						  <td><span  id="timpuesto">Impuesto</span></td>
						  <td><? echo mysqli_result($rs_query,0,"impuesto")?> %</td>
				      </tr>
					  <?php
					  	$codproveedor1=mysqli_result($rs_query,0,"codproveedor1");
					  	if ($codproveedor1<>0) {
							$query_proveedor="SELECT * FROM proveedores WHERE codproveedor='$codproveedor1'";
							$res_proveedor=mysqli_query($conexion,$query_proveedor);
							$nombreproveedor=mysqli_result($res_proveedor,0,"nombre");
						} else {
							$nombreproveedor="Sin determinar";
						}
					  ?>
						<tr>
							<td width="22%"><span  id="tprov">Proveedor 1</span></td>
							<td width="38%"><?php echo $nombreproveedor?></td>
				        </tr>
					<?php
						$codproveedor2=mysqli_result($rs_query,0,"codproveedor2");
					  	if ($codproveedor2<>0) {
							$query_proveedor="SELECT * FROM proveedores WHERE codproveedor='$codproveedor2'";
							$res_proveedor=mysqli_query($conexion,$query_proveedor);
							$nombreproveedor=mysqli_result($res_proveedor,0,"nombre");
						} else {
							$nombreproveedor="Sin determinar";
						}
					  ?>
						<tr>
							<td width="22%"><span  id="tprov2">Proveedor 2</span></td>
							<td width="38%"><?php echo $nombreproveedor?></td>
				        </tr>
						<tr>
							<td width="22%"><span  id="tdesccorta">Descripci&oacute;n corta</span></td>
						    <td width="38%"><?php echo mysqli_result($rs_query,0,"descripcion_corta")?></td>
				        </tr>
						<?php
						$codubicacion=mysqli_result($rs_query,0,"codubicacion");
					  	if ($codubicacion<>0) {
							$query_ubicacion="SELECT * FROM ubicaciones WHERE codubicacion='$codubicacion'";
							$res_ubicacion=mysqli_query($conexion,$query_ubicacion);
							$nombreubicacion=mysqli_result($res_ubicacion,0,"nombre");
						} else {
							$nombreubicacion="Sin determinar";
						}
					  ?>
						<tr>
							<td width="22%"><span  id="tubicacion">Ubicaci&oacute;n</span></td>
							<td width="38%"><?php echo $nombreubicacion?></td>
				        </tr>
						<tr>
							<td><span  id="tstock">Stock</span></td>
							<td><?php echo mysqli_result($rs_query,0,"stock")?> <?php echo mysqli_result($rs_query,0,"umstock")?></td>
					    </tr>
						<tr>
							<td><span  id="tstkmin">Stock minimo</span></td>
							<td><?php echo mysqli_result($rs_query,0,"stock_minimo")?> <?php echo mysqli_result($rs_query,0,"umstock_min")?></td>
					    </tr>
						<tr>
							<td><span  id="tavisominimo">Aviso M&iacute;nimo</span></td>
							<td colspan="2"><?php if (mysqli_result($rs_query,0,"aviso_minimo")==0) { echo "No"; } else { echo "Si"; }?></td>
						</tr>
						<tr>
							<td width="22%"><span  id="tdatroduc">Datos del producto</span></td>
							<td colspan="2"><?php echo mysqli_result($rs_query,0,"datos_producto")?></td>
					    </tr>
						<tr>
							<td width="22%"><span  id="tfchaalta">Fecha de alta</span></td>
							<td colspan="2"><?php echo implota(mysqli_result($rs_query,0,"fecha_alta"))?></td>
					    </tr>
						<?php
						$codembalaje=mysqli_result($rs_query,0,"codembalaje");
					  	if ($codembalaje<>0) {
							$query_embalaje="SELECT * FROM embalajes WHERE codembalaje='$codembalaje'";
							$res_embalaje=mysqli_query($conexion,$query_embalaje);
							$nombreembalaje=mysqli_result($res_embalaje,0,"nombre");
						} else {
							$nombreembalaje="Sin determinar";
						}
					  ?>
						<tr>
							<td width="22%"><span  id="tembalaje">Embalaje</span></td>
							<td colspan="2"><?php echo $nombreembalaje?></td>
					    </tr>
						<tr>
							<td><span  id="tunidcaja">Unidades por caja</span></td>
							<td colspan="2"><?php echo mysqli_result($rs_query,0,"unidades_caja")?> <?php echo mysqli_result($rs_query,0,"umunidades_caja")?></td>
						</tr>
						<tr>
							<td><span  id="tpregpciotk">Preguntar precio ticket</span></td>
							<td colspan="2"><?php if (mysqli_result($rs_query,0,"precio_ticket")==0) { echo "No"; } else { echo "Si"; }?></td>
						</tr>
						<tr>
							<td><span  id="tmdesctick">Modificar descrip. ticket</span></td>
							<td colspan="2"><?php if (mysqli_result($rs_query,0,"modificar_ticket")==0) { echo "No"; } else { echo "Si"; }?></td>
						</tr>
						<tr>
							<td><span  id="tobsev">Observaciones</span></td>
							<td colspan="2"><?php echo mysqli_result($rs_query,0,"observaciones")?></td>
						</tr>
						<tr>
							<td><span  id="tpciocomp">Precio de compra</span></td>
							<td colspan="2"><?php echo mysqli_result($rs_query,0,"precio_compra")?> &#8364;</td>
						</tr>
						<tr>
							<td><span  id="tpcioalma">Precio almac&eacute;n</span></td>
							<td colspan="2"><?php echo mysqli_result($rs_query,0,"precio_almacen")?> &#8364;</td>
						</tr>												
						<tr>
							<td><span  id="tprectienda">Precio en tienda</span></td>
							<td colspan="2"><?php echo mysqli_result($rs_query,0,"precio_tienda")?> &#8364;</td>
						</tr>
						<!--<tr>
							<td>Pvp</td>
							<td colspan="2"><?php echo mysqli_result($rs_query,0,"precio_pvp")?> &#8364;</td>
						</tr>-->
						<tr>
							<td><span  id="tprcciva">Precio con iva</span></td>
							<td colspan="2"><?php echo mysqli_result($rs_query,0,"precio_iva")?> &#8364;</td>
						</tr>
						<tr>
							<!--td><span  id="tcodbarr">Codigo de barras</span></td>
							<td colspan="2"><?php //echo "<img src='../barcode/barcode.php?encode=EAN-13&bdata=".$codigobarras."&height=50&scale=2&bgcolor=%23FFFFEC&color=%23333366&type=jpg'>"; ?></td-->
						</tr>
					</table>
			  </div>
				<div id="botonBusqueda">
					<button type="button" id="btnaceptar" onClick="aceptar()" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="limpiar" /> ><span  id="taceptar">Aceptar</span></td> </button>

			  </div>
			 </div>
		  </div>
		</div>
	</body>
</html>
