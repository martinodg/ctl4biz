<?
header('Cache-Control: no-cache');
header('Pragma: no-cache');

require_once("../conectar7.php");
require_once("../mysqli_result.php");
require_once("../funciones/fechas.php");
require_once("../funciones/cargaImagenes.php");

function salvarFotoArticulo($codigoArticulo, $valorFile){
    if(isset($_FILES[$valorFile])){
        try{
            $data = cargarFotorticulo($codigoArticulo,$_FILES[$valorFile]);
            return $data['fileName'];
        } catch (Exception $e) {
            echo "<h2>No se ha podido cargar la imagen " . $e->getMessage() . " </h2>\n";
        }
    }
    return false;
}
//require_once("../barcode/barcode.php");
function getumtext(int $valor)
{
    global $conexion;
    $getum_query = "SELECT nombre FROM unidadesmedidas WHERE codunidadmedida=$valor";
    $rs_getum = mysqli_query($conexion, $getum_query);
    $txt = mysqli_fetch_array($rs_getum);
    return $txt['nombre'];
}
$accion = $_POST["accion"];
if (!isset($accion)) {
    $accion = $_GET["accion"];
}
if ($accion == "baja") {
    $codarticulo = $_GET["codarticulo"];
    $query = "UPDATE articulos SET borrado=1 WHERE codarticulo='$codarticulo'";
    $rs_query = mysqli_query($conexion, $query);
    if ($rs_query) {
        $mensaje = "El articulo ha sido eliminado correctamente";
    }
    $cabecera1 = "Inicio >> Articulos &gt;&gt; Eliminar Articulo ";
    $cabecera2 = "ELIMINAR ARTICULO ";
    $query_mostrar = "SELECT * FROM articulos WHERE codarticulo='$codarticulo'";
    $rs_mostrar = mysqli_query($conexion, $query_mostrar);
    $codarticulo = mysqli_result($rs_mostrar, 0, "codarticulo");
    $referencia = mysqli_result($rs_mostrar, 0, "referencia");
    $codfamilia = mysqli_result($rs_mostrar, 0, "codfamilia");
    $descripcion = mysqli_result($rs_mostrar, 0, "descripcion");
    $codimpuesto = mysqli_result($rs_mostrar, 0, "impuesto");
    $codproveedor1 = mysqli_result($rs_mostrar, 0, "codproveedor1");
    $codproveedor2 = mysqli_result($rs_mostrar, 0, "codproveedor2");
    $descripcion_corta = mysqli_result($rs_mostrar, 0, "descripcion_corta");
    $codubicacion = mysqli_result($rs_mostrar, 0, "codubicacion");
    $stock_minimo = mysqli_result($rs_mostrar, 0, "stock_minimo");
    $stock = mysqli_result($rs_mostrar, 0, "stock");
    $aviso_minimo = mysqli_result($rs_mostrar, 0, "aviso_minimo");
    $datos = mysqli_result($rs_mostrar, 0, "datos_producto");
    $fecha = mysqli_result($rs_mostrar, 0, "fecha_alta");
    if ($fecha <> "0000-00-00") {
        $fechalis = implota($fecha);
    }
    $codembalaje = mysqli_result($rs_mostrar, 0, "codembalaje");
    $unidades_caja = mysqli_result($rs_mostrar, 0, "unidades_caja");
    $precio_ticket = mysqli_result($rs_mostrar, 0, "precio_ticket");
    $modif_descrip = mysqli_result($rs_mostrar, 0, "modificar_ticket");
    $observaciones = mysqli_result($rs_mostrar, 0, "observaciones");
    $precio_compra = mysqli_result($rs_mostrar, 0, "precio_compra");
    $precio_almacen = mysqli_result($rs_mostrar, 0, "precio_almacen");
    $precio_tienda = mysqli_result($rs_mostrar, 0, "precio_tienda");
    //$pvp=mysqli_result($rs_mostrar,0,"precio_pvp");
    $precio_iva = mysqli_result($rs_mostrar, 0, "precio_iva");
    $foto_name = mysqli_result($rs_mostrar, 0, "imagen");
    $codigobarras = mysqli_result($rs_mostrar, 0, "codigobarras");
}
else {
    $aliasArt1 = $_POST["alias1"];
    $aliasArt2 = $_POST["alias2"];
    $aliasArt3 = $_POST["alias3"];
    $codigobarras = $_POST["codigobarras"];
    $referencia = $_POST["areferencia"];
    $codfamilia = $_POST["AcboFamilias"];
    $descripcion = $_POST["Adescripcion"];
    $codimpuesto = $_POST["AcboImpuestos"];
    $codproveedor1 = $_POST["acboProveedores1"];
    $codproveedor2 = $_POST["acboProveedores2"];
    $descripcion_corta = $_POST["adescripcion_corta"];
    $codubicacion = $_POST["AcboUbicacion"];
    $stock_minimo = $_POST["nstock_minimo"];
    $umstock_minimo = $_POST["umnstock_minimo"];
    $stock = $_POST["nstock"];
    $umstock = $_POST["umnstock"];
    $aviso_minimo = $_POST["aaviso_minimo"];
    $datos = $_POST["adatos"];
    $fecha = $_POST["fecha"];
    $fechalis = $fecha;
    if ($fecha <> "") {
        $fecha = explota($fecha);
    } else {
        $fecha = "0000-00-00";
    }
    $codembalaje = $_POST["AcboEmbalaje"];
    $unidades_caja = $_POST["nunidades_caja"];
    $umunidades_caja = $_POST["umnunidades_caja"];
    $precio_ticket = $_POST["aprecio_ticket"];
    $modif_descrip = $_POST["amodif_descrip"];
    $observaciones = $_POST["aobservaciones"];
    $precio_compra = $_POST["qprecio_compra"];
    $precio_almacen = $_POST["qprecio_almacen"];
    $precio_tienda = $_POST["qprecio_tienda"];
    //$pvp=$_POST["qpvp"];
    $precio_iva = $_POST["qprecio_iva"];
    $txtumstock = getumtext($umstock);
    $txtumstock_minimo = getumtext($umstock_minimo);
    $txtumunidades_caja = getumtext($umunidades_caja);
    if ($accion == "alta") {
        $consultaprevia = "SELECT max(codarticulo) as maximo FROM articulos";
        $rs_consultaprevia = mysqli_query($conexion, $consultaprevia);
        $codarticulo = mysqli_result($rs_consultaprevia, 0, "maximo");
        //@todo VerConMartin revisar esto, creo que se le podria dejar al autoincrement , si se hace por la imagen se la puede volver un md5 y en caso de precisarla con el codigo de igual manera se puede actulizar la fila despues de cargarla
        if ($codarticulo == "") {
            //@todo VerConMartin en caso de dejar esto creo que deberia ser 1
            $codarticulo = 0;
        }
        $codarticulo++;
        $imgUrl = '';
        $aux = salvarFotoArticulo($codarticulo, 'foto');
        if ($aux !== false) {
            $imgUrl = $aux;
        }
        $query_operacion = "INSERT INTO articulos (codarticulo, codfamilia, referencia, descripcion, impuesto, codproveedor1, codproveedor2, descripcion_corta, codubicacion, stock, codunidadmedida, stock_minimo, codumstock_minimo, aviso_minimo, datos_producto, fecha_alta, codembalaje, unidades_caja, codumunidades_caja, precio_ticket, modificar_ticket, observaciones, precio_compra, precio_almacen, precio_tienda, precio_iva, codigobarras, borrado, imagen) 
						VALUES ('', '$codfamilia', '$referencia', '$descripcion', '$codimpuesto', '$codproveedor1', '$codproveedor2', '$descripcion_corta', '$codubicacion', '$stock', '$umstock', '$stock_minimo', '$umstock_minimo', '$aviso_minimo', '$datos', '$fecha', '$codembalaje', '$unidades_caja', '$umunidades_caja', '$precio_ticket', '$modificar_ticket', '$observaciones', '$precio_compra', '$precio_almacen', '$precio_tienda', '$precio_iva', '', '0','$imgUrl')";
        $rs_operacion = mysqli_query($conexion, $query_operacion);
        if (!empty($aliasArt1)){
            $query_alias = "INSERT INTO alias_articulos (id_alias, codarticulo, alias) 
                                VALUES ('', '$codarticulo', '$aliasArt1')";
            $rs_alias = mysqli_query($conexion, $query_alias);
        }
        if (!empty($aliasArt2)){
            $query_alias = "INSERT INTO alias_articulos (id_alias, codarticulo, alias) 
                                VALUES ('', '$codarticulo', '$aliasArt2')";
            $rs_alias = mysqli_query($conexion, $query_alias);
        }
        if (!empty($aliasArt3)){
            $query_alias = "INSERT INTO alias_articulos (id_alias, codarticulo, alias) 
                                VALUES ('', '$codarticulo', '$aliasArt3')";
            $rs_alias = mysqli_query($conexion, $query_alias);
        }

        $codarticulo = mysqli_insert_id($conexion);
        $codaux = $codarticulo;
        while (strlen($codaux) < 6) {
            $codaux = "0" . $codaux;
        }
        // el 84 lo he puesto por lo de españa el 0000 representa el código de la empresa
        $codigobarras = "840000" . $codaux;
        $pares = $codigobarras[0] + $codigobarras[2] + $codigobarras[4] + $codigobarras[6] + $codigobarras[8] + $codigobarras[10];
        $impares = $codigobarras[1] + $codigobarras[3] + $codigobarras[5] + $codigobarras[7] + $codigobarras[9] + $codigobarras[11];
        $impares = $impares * 3;
        $total = $impares + $pares;
        $resto = $total % 10;
        if ($resto == 0) {
            $valor = 0;
        } else {
            $valor = 10 - $resto;
        }
        $codigobarras = $codigobarras . "" . $valor;
        $sel_actualizar = "UPDATE articulos SET codigobarras='$codigobarras' WHERE codarticulo='$codarticulo'";
        $rs_actualizar = mysqli_query($conexion, $sel_actualizar);
        if ($rs_operacion) {
            $mensaje = "El articulo ha sido dado de alta correctamente";
        }
        $cabecera1 = "Inicio >> Articulos &gt;&gt; Nuevo Articulo ";
        $cabecera2 = "INSERTAR ARTICULO ";
    }
    elseif ($accion == "modificar") {
        $codarticulo = $_POST["id"];
        $cadena = "";
        $query = "UPDATE articulos SET codfamilia='$codfamilia', codigobarras='$codigobarras', referencia='$referencia', descripcion='$descripcion', impuesto='$codimpuesto', codproveedor1='$codproveedor1', codproveedor2='$codproveedor2', descripcion_corta='$descripcion_corta', codubicacion='$codubicacion', stock='$stock',codunidadmedida='$umstock', stock_minimo='$stock_minimo',codumstock_minimo='$umstock_minimo', aviso_minimo='$aviso_minimo', datos_producto='$datos', fecha_alta='$fecha', codembalaje='$codembalaje', unidades_caja='$unidades_caja', codumunidades_caja='$umunidades_caja', precio_ticket='$precio_ticket', modificar_ticket='$modif_descrip', observaciones='$observaciones', precio_compra='$precio_compra', precio_almacen='$precio_almacen', precio_tienda='$precio_tienda', precio_iva='$precio_iva', " . $cadena . " borrado=0 ";
        try {
            if ($url = salvarFotoArticulo($codarticulo, 'foto')) {
                $query .= ', imagen=' . $url;
            }
        } catch (Exception $e) {
            echo "<h2>No se ha podido cargar la imagen " . $e->getMessage() . " </h2>\n";
        }
        $query .= " WHERE codarticulo='" . $codarticulo . "' ";
        $rs_query = mysqli_query($conexion, $query);
        if ($rs_query) {
            $mensaje = "Los datos del articulo han sido modificados correctamente";
        }
        $cabecera1 = "Inicio >> Articulos &gt;&gt; Modificar Articulo ";
        $cabecera2 = "MODIFICAR ARTICULO ";
    }
    $sel_img = "SELECT imagen,codigobarras FROM articulos WHERE codarticulo='$codarticulo'";
    $rs_img = mysqli_query($conexion, $sel_img);
    $foto_name = mysqli_result($rs_img, 0, "imagen");
    $codigobarras = mysqli_result($rs_img, 0, "codigobarras");
}
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
			location.href="index.php";
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
							<td colspan="2" class="mensaje"><?php echo $mensaje;?></td>
					    </tr>
						<tr>
							<td width="15%"><span  id="tcod">C&Oacute;DIGO</span></td>
							<td width="58%"><?php echo $codarticulo?></td>
					        <td width="27%" rowspan="11" align="center" valign="top"><img src="<?php echo traerUrlImagenProducto($foto_name); ?>" width="160px" height="140px" border="1"></td>
						</tr>
						<tr>
							<td width="15%"><span  id="trefren">Referencia</span></td>
							<td width="58%"><?php echo $referencia?></td>
				        </tr>
						<?php
					  	$query_familia="SELECT * FROM familias WHERE codfamilia='$codfamilia'";
						$res_familia=mysqli_query($conexion,$query_familia);
						$nombrefamilia=mysqli_result($res_familia,0,"nombre");
					  ?>
						<tr>
							<td width="15%"><span  id="tflia">FAMILIA</span></td>
							<td width="58%"><?php echo $nombrefamilia?></td>
				        </tr>
						<tr>
							<td width="15%"><span  id="tdescri">Descripci&oacute;n</span></td>
						    <td width="58%"><?php echo $descripcion?></td>
				        </tr>
						<tr>
						  <td><span  id="timpuesto">Impuesto</span></td>
						  <td><?php echo $codimpuesto?> %</td>
				      </tr>
					  <?php
					  	if ($codproveedor1<>0) {
							$query_proveedor="SELECT * FROM proveedores WHERE codproveedor='$codproveedor1'";
							$res_proveedor=mysqli_query($conexion,$query_proveedor);
							$nombreproveedor=mysqli_result($res_proveedor,0,"nombre");
						} else {
							$nombreproveedor="Sin determinar";
						}
					  ?>
						<tr>
							<td width="15%"><span  id="tprov">Proveedor1</span></td>
							<td width="58%"><?php echo $nombreproveedor?></td>
				        </tr>
					<?php
					  	if ($codproveedor2<>0) {
							$query_proveedor="SELECT * FROM proveedores WHERE codproveedor='$codproveedor2'";
							$res_proveedor=mysqli_query($conexion,$query_proveedor);
							$nombreproveedor=mysqli_result($res_proveedor,0,"nombre");
						} else {
							$nombreproveedor="Sin determinar";
						}
					  ?>
						<tr>
							<td width="15%"><span  id="tprov2">Proveedor2</span></td>
							<td width="58%"><?php echo $nombreproveedor?></td>
				        </tr>
						<tr>
							<td width="15%"><span  id="tdesccorta">Descripci&oacute;n corta</span></td>
						    <td width="58%"><?php echo $descripcion_corta?></td>
				        </tr>
						<?php
					  	if ($codubicacion<>0) {
							$query_ubicacion="SELECT * FROM ubicaciones WHERE codubicacion='$codubicacion'";
							$res_ubicacion=mysqli_query($conexion,$query_ubicacion);
							$nombreubicacion=mysqli_result($res_ubicacion,0,"nombre");
						} else {
							$nombreubicacion="Sin determinar";
						}
					  ?>
						<tr>
							<td width="15%"><span  id="tubicacion">Ubicaci&oacute;n</span></td>
							<td width="58%"><?php echo $nombreubicacion?></td>
				        </tr>
						<tr>
							<td><span  id="tstock">Stock</span></td>
							<?php echo "<td>".$stock." ".$txtumstock."</td>";?>
					    </tr>
						<tr>
							<td><span  id="tstkmin">Stock minimo</span></td>
							<?php echo "<td>".$stock_minimo." ".$txtumstock_minimo."</td>";?>
						
					    </tr>
						<tr>
							<td><span  id="tavisominimo">Aviso M&iacute;nimo</span></td>
							<td colspan="2"><?php if ($aviso_minimo==0) { echo "No"; } else { echo "Si"; }?></td>
						</tr>
						<tr>
							<td width="15%"><span  id="tdatroduc">Datos del producto</span></td>
							<td colspan="2"><?php echo $datos?></td>
					    </tr>
						<tr>
							<td width="15%"><span  id="tfchaalta">Fecha de alta</span></td>
							<td colspan="2"><?php echo $fechalis?></td>
					    </tr>
						<?php
					  	if ($codembalaje<>0) {
							$query_embalaje="SELECT * FROM embalajes WHERE codembalaje='$codembalaje'";
							$res_embalaje=mysqli_query($conexion,$query_embalaje);
							$nombreembalaje=mysqli_result($res_embalaje,0,"nombre");
						} else {
							$nombreembalaje="Sin determinar";
						}
					  ?>
						<tr>
							<td width="15%"><span  id="tembalaje">Embalaje</span></td>
							<td colspan="2"><?php echo $nombreembalaje?></td>
					    </tr>
						<tr>
							<td><span  id="tunidcaja">Unidades por caja</span></td>
							<?php echo "<td>".$unidades_caja." ".$txtumunidades_caja."</td>";?>
							
						</tr>
						<tr>
							<td><span  id="tpregpciotk">Preguntar precio ticket</span></td>
							<td colspan="2"><?php if ($precio_ticket==0) { echo "No"; } else { echo "Si"; }?></td>
						</tr>
						<tr>
							<td><span  id="tmdesctick">Modificar descrip. ticket</span></td>
							<td colspan="2"><?php if ($modif_descrip==0) { echo "No"; } else { echo "Si"; }?></td>
						</tr>
						<tr>
							<td><span  id="tobsev">Observaciones</span></td>
							<td colspan="2"><?php echo $observaciones?></td>
						</tr>
						<tr>
							<td><span  id="tpciocomp">Precio de compra</span></td>
							<td colspan="2"><?php echo $precio_compra?> &#8364;</td>
						</tr>
						<tr>
							<td><span  id="tpcioalma">Precio almac&eacute;n</span></td>
							<td colspan="2"><?php echo $precio_almacen?> &#8364;</td>
						</tr>												
						<tr>
							<td><span  id="tprectienda">Precio en tienda</span></td>
							<td colspan="2"><?php echo $precio_tienda?> &#8364;</td>
						</tr>
						<!--<tr>
							<td>Pvp</td>
							<td colspan="2"><?php echo $pvp?> &#8364;</td>
						</tr>-->
						<tr>
							<td><span  id="tprcciva">Precio con iva</span></td>
							<td colspan="2"><?php echo $precio_iva?> &#8364;</td>
						</tr>
						<tr>
							<td><span  id="tcodbarr">Codigo de barras</span></td>
							
							<td colspan="2"><?php echo '<img src="../funciones/barcode/barcode.php?s=ean-13&wq=1&d='.$codigobarras.'">'; ?></td>
							
						</tr>
					</table>
			  </div>
				<div id="botonBusqueda">
					<button type="button" id="btnaceptar" onClick="aceptar()" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="Aceptar" /> ><span  id="taceptar">Aceptar</span></td> </button>
			  </div>
			 </div>
		  </div>
		</div>
	</body>
</html>
