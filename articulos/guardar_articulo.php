<?
header('Cache-Control: no-cache');
header('Pragma: no-cache');

if (session_id() == '') {
    session_start();
}
$moneda = $_SESSION['company_currency_sign'];
require_once("../conectar7.php");
require_once("../mysqli_result.php");
require_once("../funciones/fechas.php");
require_once("../funciones/cargaImagenes.php");
function salvarFotoArticulo($codigoArticulo, $valorFile)
{
    if (isset($_FILES[$valorFile])) {
        try {
            $data = cargarFotoArticulo($codigoArticulo, $_FILES[$valorFile]);
            return $data['fileName'];
        } catch (Exception $e) {
            //echo "<h2>No se ha podido cargar la imagen " . $e->getMessage() . " </h2>\n";
        }
    }
    return false;
}

//require_once("../barcode/barcode.php");
function getumtext( $valor)
{
    global $conexion;
    $getum_query = "SELECT nombre FROM unidadesmedidas WHERE codunidadmedida=$valor";
    $rs_getum = mysqli_query($conexion, $getum_query);
    $txt = mysqli_fetch_array($rs_getum);
    return $txt['nombre'];
}

$errores = array();
//@todo Ver con Martin averiguar para que esta este parametro que tiraba un 500 en la base esta no nullable con default 0
$modificar_ticket = 0;
$accion = $_POST["accion"];
if (!isset($accion)) {
    $accion = $_GET["accion"];
}
//############################### BAJA ####################################################
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
    $codembalaje = $_POST['AEmbalajes'];
    $aliasEnviados = $_POST["alias"];
    $embalajesEnviados = $_POST["AEmbalajes"];
    $codigobarras = $_POST["codigobarras"];
    $referencia = $_POST["areferencia"];
    $codfamilia = $_POST["AcboFamilias"];
    $descripcion = $_POST["Adescripcion"];
    $codimpuesto = $_POST["rcboImpuestos"];
    $codproveedor1 = $_POST["acboProveedores1"];
    $codproveedor2 = $_POST["acboProveedores2"];
    $descripcion_corta = $_POST["adescripcion_corta"];
    $codubicacion = $_POST["AcboUbicacion"];
    $cod_unimedida = $_POST["Aunimedida"];
    $stock_minimo = $_POST["nstock_minimo"];
    $stock = $_POST["nstock"];
    $aviso_minimo = $_POST["aaviso_minimo"];
    $datos = $_POST["adatos"];
    $fecha = $_POST["fecha"];
    $fechalis = $fecha;
    if ($fecha <> "") {
        $fecha = explota($fecha);
    } else {
        $fecha = "0000-00-00";
    }
    $codembalaje = $_POST["AEmbalaje"];
    $precio_ticket = $_POST["aprecio_ticket"];
    $modif_descrip = $_POST["amodif_descrip"];
    $observaciones = $_POST["aobservaciones"];
    $precio_compra = $_POST["qprecio_compra"];
    $precio_almacen = $_POST["qprecio_almacen"];
    $precio_tienda = $_POST["qprecio_tienda"];
    //$pvp=$_POST["qpvp"];
    $precio_iva = $_POST["qprecio_iva"];
    $txtumstock = getumtext($cod_unimedida);
    $txtumstock_minimo = getumtext($cod_unimedida);
    //############################### ALTA ####################################################
    if ($accion == "alta") {
        // insercion del articulo
        $query_articulo = "INSERT INTO articulos (codarticulo, codfamilia, referencia, descripcion, impuesto, codproveedor1, codproveedor2, descripcion_corta, codubicacion, stock, codunidadmedida, stock_minimo, aviso_minimo, datos_producto, fecha_alta, codembalaje, precio_ticket, modificar_ticket, observaciones, precio_compra, precio_almacen, precio_tienda, precio_iva, codigobarras, borrado, imagen) 
						VALUES (NULL,'$codfamilia', '$referencia', '$descripcion', '$codimpuesto', '$codproveedor1', '$codproveedor2', '$descripcion_corta', '$codubicacion', '$stock', '$cod_unimedida', '$stock_minimo', '$aviso_minimo', '$datos', '$fecha', '$codembalaje', '$precio_ticket', $modificar_ticket, '$observaciones', '$precio_compra', '$precio_almacen', '$precio_tienda', '$precio_iva', '', '0','')";
        $rs_articulo = mysqli_query($conexion, $query_articulo);
        if ($rs_articulo === false) {
            $errores[] = printf("Error al crear el articulo : %s\n", mysqli_error($conexion));
        }
        $codarticulo = mysqli_insert_id($conexion);
        //Salvar el logo y asociarlo al artiulo
        $imgUrl = salvarFotoArticulo($codarticulo, 'foto');
        if ($imgUrl !== false) {
            $agregar_imagen_articulo = "UPDATE articulos SET imagen='$imgUrl' WHERE codarticulo='$codarticulo'";
            $rs_logo = mysqli_query($conexion, $agregar_imagen_articulo);
            if ($rs_logo === false) {
                $errores[] = printf("Error al actualizar el logo  : %s\n", mysqli_error($conexion));
            }
        }
        /*insert alias*/
        if (!empty($aliasEnviados)) {
            $values = array();
            foreach ($aliasEnviados as $alia) {
                $values[] = "( '$codarticulo', '$alia')";
            }
            $query_alias = "INSERT INTO alias_articulos ( codarticulo, alias) VALUES " . implode(',', $values);
            $rs_alias = mysqli_query($conexion, $query_alias);
            if ($rs_alias === false) {
                $errores[] = printf("Error al actualizar el logo  : %s\n", mysqli_error($conexion));
            }
        }
        /*insert embalajes*/
        if (!empty($embalajesEnviados)) {
            $values = array();
            $embalajesEnviados = array_unique($embalajesEnviados);
            foreach ($embalajesEnviados as $embalaje) {
                $values[] = "( '$codarticulo', '$embalaje')";
            }
            $query_embalajes = "INSERT INTO articulosEmbalajes ( codarticulo, codembalaje) VALUES " . implode(',', $values);
            $rs_embalajes = mysqli_query($conexion, $query_embalajes);
            if ($rs_embalajes === false) {
                $errores[] = printf("Error al actualizar el logo  : %s\n", mysqli_error($conexion));
            }
        }
        /*unidad de medida*/
        $unimedida_query = "SELECT nombre FROM unidadesmedidas WHERE codunidadmedida=$cod_unimedida";
        $rs_unimedida = mysqli_query($conexion, $unimedida_query);
        $unidadMedida = mysqli_result($rs_unimedida, 0, 'nombre');
        /**/
        //creacion del codigo de barras
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
        if ($rs_actualizar === false) {
            $errores[] = printf("Error al actualizar el codigo de barras : %s\n", mysqli_error($conexion));
        }
        $mensaje = "El articulo ha sido dado de alta correctamente";
        $cabecera1 = "Inicio >> Articulos &gt;&gt; Nuevo Articulo ";
        $cabecera2 = "INSERTAR ARTICULO ";
    }
    //############################### MODIFICAR ###############################################
    elseif ($accion == "modificar") {
        $codarticulo = $_POST["id"];
        $codimpuesto = $_POST['cboImpuestos'];
        //borro todos los alias que tiene
        $query_alias = "DELETE FROM  alias_articulos WHERE codarticulo='$codarticulo' ";
        $rs_alias = mysqli_query($conexion, $query_alias);
        if ($rs_alias === false) {
            $errores[] = printf("Error al eliminar los alias   : %s\n", mysqli_error($conexion));
        }
        /*insert alias*/
        if (!empty($aliasEnviados)) {
            $values = array();
            foreach ($aliasEnviados as $alia) {
                $values[] = "( '$codarticulo', '$alia')";
            }
            $query_alias = "INSERT INTO alias_articulos ( codarticulo, alias) VALUES " . implode(',', $values);
            $rs_alias = mysqli_query($conexion, $query_alias);
            if ($rs_alias === false) {
                $errores[] = printf("Error al actualizar el logo  : %s\n", mysqli_error($conexion));
            }
        }
        /*check packaging database*/
        $query_check_embalajes_db = "SELECT * FROM `articulosEmbalajes` WHERE codarticulo=$codarticulo";
        $rs_find_packaging = mysqli_query($conexion,$query_check_embalajes_db);
        /*insert embalajes*/
        if (!empty($embalajesEnviados)) {
            $values = array();
            $embalajesEnviados = array_unique($embalajesEnviados);
            foreach ($embalajesEnviados as $embalaje) {
                $values[] = "( '$codarticulo', '$embalaje')";
            }
            $query_embalajes = "INSERT INTO articulosEmbalajes ( codarticulo, codembalaje) VALUES " . implode(',', $values);
            $rs_embalajes = mysqli_query($conexion, $query_embalajes);
            $emb = mysqli_query($conexion, "SELECT embalajes.nombre, embalajes.codembalaje FROM embalajes INNER JOIN articulosEmbalajes ON embalajes.codembalaje=articulosEmbalajes.codembalaje WHERE articulosEmbalajes.codarticulo=$codarticulo");
            if ($rs_embalajes === false) {
                $errores[] = printf("Error al actualizar el logo  : %s\n", mysqli_error($conexion));
            }
        }
        else{
            $emb = mysqli_query($conexion, "SELECT embalajes.nombre, embalajes.codembalaje FROM embalajes INNER JOIN articulosEmbalajes ON embalajes.codembalaje=articulosEmbalajes.codembalaje WHERE articulosEmbalajes.codarticulo=$codarticulo");
        }
        /*unidad de medida*/
        $unimedida_query = "SELECT nombre FROM unidadesmedidas WHERE codunidadmedida=$cod_unimedida";
        $rs_unimedida = mysqli_query($conexion, $unimedida_query);
        $unidadMedida = mysqli_result($rs_unimedida, 0, 'nombre');

        $query = "UPDATE articulos SET codfamilia='$codfamilia', codigobarras='$codigobarras', referencia='$referencia', descripcion='$descripcion', impuesto='$codimpuesto', codproveedor1='$codproveedor1', codproveedor2='$codproveedor2', descripcion_corta='$descripcion_corta', codubicacion='$codubicacion', stock='$stock',codunidadmedida='$cod_unimedida', stock_minimo='$stock_minimo', aviso_minimo='$aviso_minimo', datos_producto='$datos', fecha_alta='$fecha', codembalaje='$codembalaje', precio_ticket='$precio_ticket', modificar_ticket='$modif_descrip', observaciones='$observaciones', precio_compra='$precio_compra', precio_almacen='$precio_almacen', precio_tienda='$precio_tienda', precio_iva='$precio_iva', borrado=0 ";
        try {
            if ($url = salvarFotoArticulo($codarticulo, 'foto')) {
                $query .= ', imagen=' . $url;
            }
        } catch (Exception $e) {
            $errores[] = sprintf("No se ha podido cargar la imagen %s", $e->getMessage());
        }
        $query .= " WHERE codarticulo='" . $codarticulo . "' ";
        $rs_query = mysqli_query($conexion, $query);
        $mensaje = "Los datos del articulo han sido modificados correctamente";
        if ($rs_query === false) {
            $errores[] = printf("Error al modificar el articulo : %s\n", mysqli_error($conexion));
        }
        $cabecera1 = "Inicio >> Articulos &gt;&gt; Modificar Articulo ";
        $cabecera2 = "MODIFICAR ARTICULO ";
    }
}
if (count($errores)) {
    $mensaje = 'Ocurrio un error al procesar el Articulo ';
    if (defined('ERROR_DEBUG') && ERROR_DEBUG) {
        $mensaje .= implode('<br/>', $errores);
    }
}
$sel_img = "SELECT imagen,codigobarras FROM articulos WHERE codarticulo='$codarticulo'";
$rs_img = mysqli_query($conexion, $sel_img);
$foto_name = mysqli_result($rs_img, 0, "imagen");
$codigobarras = mysqli_result($rs_img, 0, "codigobarras");

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
            cursor = 'hand';
        } else {
            // Está utilizando MOZILLA/NETSCAPE
            cursor = 'pointer';
        }

        function aceptar() {
            location.href = "index.php";
        }

    </script>
</head>
<body>
<div id="pagina">
    <div id="zonaContenido">
        <div align="center">
            <div id="tituloForm" class="header"><?php echo $cabecera2 ?></div>
            <div id="frmBusqueda">
                <table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
                    <tr>
                        <td width="15%"></td>
                        <td colspan="2" class="mensaje"><?php echo $mensaje; ?></td>
                    </tr>
                    <tr>
                        <td width="15%"><span id="tcod">C&Oacute;DIGO</span></td>
                        <td width="58%"><?php echo $codarticulo; ?></td>
                        <td width="27%" rowspan="11" align="center" valign="top"><img
                                    src="<?php echo traerUrlImagenProducto($foto_name); ?>" width="160px" height="140px"
                                    border="1"></td>
                    </tr>
                    <tr>
                        <td width="15%"><span id="trefren">Referencia</span></td>
                        <td width="58%"><?php echo $referencia ?></td>
                    </tr>
                    <?php
                    $query_familia = "SELECT * FROM familias WHERE codfamilia='$codfamilia'";
                    $res_familia = mysqli_query($conexion, $query_familia);
                    $nombrefamilia = mysqli_result($res_familia, 0, "nombre");
                    ?>
                    <tr>
                        <td width="15%"><span id="tflia">FAMILIA</span></td>
                        <td width="58%"><?php echo $nombrefamilia ?></td>
                    </tr>
                    <!--ALIAS start-->
                    <tr>
                        <td width="15%"><span>ALIAS</span></td>
                        <td width="58%">
                            <?php
                            $queryAlias = "SELECT * FROM alias_articulos WHERE codarticulo='$codarticulo' ORDER BY id_alias ASC ";
                            $respAlias_query = mysqli_query($conexion, $queryAlias);
                            $cont = 0;
                            if (!empty($aliasEnviados)) {
                                foreach ($aliasEnviados as $aliasname => $alia) {
                                    echo $alia, '  ';
                                    $cont++;
                                }
                            } else {
                                echo 'No Existen Alias para este Articulo';
                            }
                            ?>
                        </td>
                    </tr>
                    <!--ALIAS end-->
                    <tr>
                        <td width="15%"><span id="tdescri">Descripci&oacute;n</span></td>
                        <td width="58%"><?php echo $descripcion ?></td>
                    </tr>
                    <tr>
                        <td><span id="timpuesto">Impuesto</span></td>
                        <td><?php echo $codimpuesto ?> %</td>
                    </tr>
                    <?php
                    if ($codproveedor1 <> 0) {
                        $query_proveedor = "SELECT * FROM proveedores WHERE codproveedor='$codproveedor1'";
                        $res_proveedor = mysqli_query($conexion, $query_proveedor);
                        $nombreproveedor = mysqli_result($res_proveedor, 0, "nombre");
                    } else {
                        $nombreproveedor = "Sin determinar";
                    }
                    ?>
                    <tr>
                        <td width="15%"><span id="tprov">Proveedor1</span></td>
                        <td width="58%"><?php echo $nombreproveedor ?></td>
                    </tr>
                    <?php
                    if ($codproveedor2 <> 0) {
                        $query_proveedor = "SELECT * FROM proveedores WHERE codproveedor='$codproveedor2'";
                        $res_proveedor = mysqli_query($conexion, $query_proveedor);
                        $nombreproveedor = mysqli_result($res_proveedor, 0, "nombre");
                    } else {
                        $nombreproveedor = "Sin determinar";
                    }
                    ?>
                    <tr>
                        <td width="15%"><span id="tprov2">Proveedor2</span></td>
                        <td width="58%"><?php echo $nombreproveedor ?></td>
                    </tr>
                    <tr>
                        <td width="15%"><span id="tdesccorta">Descripci&oacute;n corta</span></td>
                        <td width="58%"><?php echo $descripcion_corta ?></td>
                    </tr>
                    <?php
                    if ($codubicacion <> 0) {
                        $query_ubicacion = "SELECT * FROM ubicaciones WHERE codubicacion='$codubicacion'";
                        $res_ubicacion = mysqli_query($conexion, $query_ubicacion);
                        $nombreubicacion = mysqli_result($res_ubicacion, 0, "nombre");
                    } else {
                        $nombreubicacion = "Sin determinar";
                    }
                    ?>
                    <tr>
                        <td width="15%"><span id="tubicacion">Ubicaci&oacute;n</span></td>
                        <td width="58%"><?php echo $nombreubicacion ?></td>
                    </tr>
                    <tr>
                        <td><span id="tunidad">Unidad de Medida</span></td>
                        <?php echo "<td>$unidadMedida</td>"; ?>
                    </tr>
                    <tr>
                        <td><span id="tstock">Stock</span></td>
                        <?php echo "<td>".$stock."</td>"; ?>
                    </tr>
                    <tr>
                        <td><span id="tstkmin">Stock minimo</span></td>
                        <?php echo "<td>".$stock_minimo."</td>"; ?>
                    </tr>
                    <tr>
                        <td><span id="tavisominimo">Aviso M&iacute;nimo</span></td>
                        <td colspan="2"><?php if ($aviso_minimo == 0) {
                                echo "No";
                            } else {
                                echo "Si";
                            } ?></td>
                    </tr>
                    <tr>
                        <td width="15%"><span id="tdatroduc">Datos del producto</span></td>
                        <td colspan="2"><?php echo $datos ?></td>
                    </tr>
                    <tr>
                        <td width="15%"><span id="tfchaalta">Fecha de alta</span></td>
                        <td colspan="2"><?php echo $fechalis ?></td>
                    </tr>
                    <tr>
                        <td width="15%"><span id="tembalaje">Embalaje</span></td>
                        <td>
                            <?php
                            if (!empty(mysqli_fetch_array($emb)) or !empty($embalajesEnviados)){
                                $cont=0;
                                foreach ($emb as $namePacking => $packing_code) {
                                    $packing_name = mysqli_result($emb,$cont,"nombre");
                                    echo $packing_name,'  ';
                                    $cont++;
                                }
                            }
                            else{
                                echo "<span id='tsindet'>No definido</span>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span id="tpregpciotk">Preguntar precio ticket</span></td>
                        <td colspan="2"><?php if ($precio_ticket == 0) {
                                echo "No";
                            } else {
                                echo "Si";
                            } ?></td>
                    </tr>
                    <tr>
                        <td><span id="tmdesctick">Modificar descrip. ticket</span></td>
                        <td colspan="2"><?php if ($modif_descrip == 0) {
                                echo "No";
                            } else {
                                echo "Si";
                            } ?></td>
                    </tr>
                    <tr>
                        <td><span id="tobsev">Observaciones</span></td>
                        <td colspan="2"><?php echo $observaciones ?></td>
                    </tr>
                    <tr>
                        <td><span id="tpciocomp">Precio de compra</span></td>
                        <td colspan="2"><?php echo $precio_compra . ' ' . $moneda; ?></td>
                    </tr>
                    <tr>
                        <td><span id="tpcioalma">Precio almac&eacute;n</span></td>
                        <td colspan="2"><?php echo $precio_almacen . ' ' . $moneda; ?></td>
                    </tr>
                    <tr>
                        <td><span id="tprectienda">Precio en tienda</span></td>
                        <td colspan="2"><?php echo $precio_tienda . ' ' . $moneda; ?></td>
                    </tr>
                    <!--<tr>
							<td>Pvp</td>
							<td colspan="2"><?php //echo $pvp.$moneda;?></td>
						</tr>-->
                    <tr>
                        <td><span id="tprcciva">Precio con iva</span></td>
                        <td colspan="2"><?php echo $precio_iva . ' ' . $moneda; ?></td>
                    </tr>
                    <tr>
                        <td><span id="tcodbarr">Codigo de barras</span></td>

                        <td colspan="2"><?php echo '<img src="../funciones/barcode/barcode.php?s=ean-13&wq=1&d=' . $codigobarras . '">'; ?></td>

                    </tr>
                </table>
            </div>
            <div id="botonBusqueda">
                <button type="button" id="btnaceptar" onClick="aceptar()" onMouseOver="style.cursor=cursor"><img
                            src="../img/ok.svg" alt="Aceptar"/> ><span id="taceptar">Aceptar</span></td> </button>
            </div>
        </div>
    </div>
</div>
</body>
</html>