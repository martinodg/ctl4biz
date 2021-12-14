<?php

ini_set('display_errors', -1);
ini_set('display_startup_errors', -1);
error_reporting(E_ALL);

header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
require_once("../conectar7.php");
require_once("../mysqli_result.php");

?>
<html>
<head>
    <link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
</head>
<script language="javascript">

function pon_prefijo(codfamilia,pref,nombre,precio,codarticulo) {
	parent.opener.document.formulario_lineas.codfamilia.value=codfamilia;
	parent.opener.document.formulario_lineas.referencia.value=pref;
	parent.opener.document.formulario_lineas.descripcion.value=nombre;
	parent.opener.document.formulario_lineas.precio.value=precio;
	parent.opener.document.formulario_lineas.codarticulo.value=codarticulo;
	parent.opener.actualizar_importe();
	parent.window.close();
}

</script>
<? 

$codproveedor=$_POST["codproveedor"];
$familia=$_POST["cmbfamilia"];
$referencia=$_POST["referencia"];
$descripcion=$_POST["descripcion"];
$todos=$_POST["todos"];
$where="";

if ($familia<>0) { $where.=" AND articulos.codfamilia='$familia'"; }
if ($referencia<>"") { $where.=" AND articulos.referencia like '%$referencia%'"; }
if ($descripcion<>"") { $where.=" AND articulos.descripcion like '%$descripcion%'"; }

 ?>
<body>
<?
	if ($todos==1) {
        $consulta="SELECT * FROM (
            SELECT
                articulos.codarticulo ,
                articulos.codfamilia,
                articulos.referencia,
                articulos.descripcion,
                articulos.impuesto,
                articulos.codproveedor1,
                articulos.codproveedor2,
                articulos.codproveedor3,
                articulos.codproveedor4,
                articulos.descripcion_corta,
                articulos.codubicacion,
                articulos.stock,
                articulos.codunidadmedida,
                articulos.stock_minimo,
                articulos.codumstock_minimo,
                articulos.aviso_minimo,
                articulos.datos_producto,
                articulos.fecha_alta,
                articulos.codembalaje,
                articulos.unidades_caja,
                articulos.codumunidades_caja,
                articulos.precio_ticket,
                articulos.modificar_ticket,
                articulos.observaciones,
                articulos.precio_compra,
                articulos.precio_almacen,
                articulos.precio_tienda,
                articulos.precio_pvp,
                articulos.precio_iva,
                articulos.codigobarras,
                articulos.imagen,
                articulos.borrado,
                familias.nombre AS nombrefamilia
            FROM articulos
            JOIN familias ON  articulos.codfamilia = familias.codfamilia 
            WHERE articulos.borrado = 0
            ".$where."
            UNION 
                SELECT
                articulos.codarticulo ,
                articulos.codfamilia,
                articulos.referencia,
                alias_articulos.alias AS descripcion,
                articulos.impuesto,
                articulos.codproveedor1,
                articulos.codproveedor2,
                articulos.codproveedor3,
                articulos.codproveedor4,
                articulos.descripcion_corta,
                articulos.codubicacion,
                articulos.stock,
                articulos.codunidadmedida,
                articulos.stock_minimo,
                articulos.codumstock_minimo,
                articulos.aviso_minimo,
                articulos.datos_producto,
                articulos.fecha_alta,
                articulos.codembalaje,
                articulos.unidades_caja,
                articulos.codumunidades_caja,
                articulos.precio_ticket,
                articulos.modificar_ticket,
                articulos.observaciones,
                articulos.precio_compra,
                articulos.precio_almacen,
                articulos.precio_tienda,
                articulos.precio_pvp,
                articulos.precio_iva,
                articulos.codigobarras,
                articulos.imagen,
                articulos.borrado,
                familias.nombre AS nombrefamilia
            FROM articulos   
            JOIN familias ON  articulos.codfamilia = familias.codfamilia 
            JOIN alias_articulos ON  alias_articulos.codarticulo = articulos.codarticulo
            WHERE articulos.borrado = 0
            ".$where."
        ) 
        articulos_con_alias
        ORDER BY
        codfamilia ASC,
        descripcion ASC;";
	}
	if ($todos==0) {
        $consulta ="SELECT * FROM (
            SELECT
                artpro.precio AS pcosto,
                articulos.codarticulo ,
                articulos.codfamilia,
                articulos.referencia,
                articulos.descripcion,
                articulos.impuesto,
                articulos.codproveedor1,
                articulos.codproveedor2,
                articulos.codproveedor3,
                articulos.codproveedor4,
                articulos.descripcion_corta,
                articulos.codubicacion,
                articulos.stock,
                articulos.codunidadmedida,
                articulos.stock_minimo,
                articulos.codumstock_minimo,
                articulos.aviso_minimo,
                articulos.datos_producto,
                articulos.fecha_alta,
                articulos.codembalaje,
                articulos.unidades_caja,
                articulos.codumunidades_caja,
                articulos.precio_ticket,
                articulos.modificar_ticket,
                articulos.observaciones,
                articulos.precio_compra,
                articulos.precio_almacen,
                articulos.precio_tienda,
                articulos.precio_pvp,
                articulos.precio_iva,
                articulos.codigobarras,
                articulos.imagen,
                articulos.borrado,
                familias.nombre AS nombrefamilia
            FROM articulos
            JOIN familias ON  articulos.codfamilia = familias.codfamilia 
            JOIN artpro ON  articulos.codarticulo =  articulos.codarticulo 
            WHERE articulos.borrado = 0        
            AND artpro.codfamilia = articulos.codfamilia 
            ".$where."
            UNION     
                SELECT
                artpro.precio AS pcosto,
                articulos.codarticulo ,
                articulos.codfamilia,
                articulos.referencia,
                alias_articulos.alias AS descripcion,
                articulos.impuesto,
                articulos.codproveedor1,
                articulos.codproveedor2,
                articulos.codproveedor3,
                articulos.codproveedor4,
                articulos.descripcion_corta,
                articulos.codubicacion,
                articulos.stock,
                articulos.codunidadmedida,
                articulos.stock_minimo,
                articulos.codumstock_minimo,
                articulos.aviso_minimo,
                articulos.datos_producto,
                articulos.fecha_alta,
                articulos.codembalaje,
                articulos.unidades_caja,
                articulos.codumunidades_caja,
                articulos.precio_ticket,
                articulos.modificar_ticket,
                articulos.observaciones,
                articulos.precio_compra,
                articulos.precio_almacen,
                articulos.precio_tienda,
                articulos.precio_pvp,
                articulos.precio_iva,
                articulos.codigobarras,
                articulos.imagen,
                articulos.borrado,
                familias.nombre AS nombrefamilia
            FROM articulos   
            JOIN familias ON  articulos.codfamilia = familias.codfamilia 
            JOIN artpro ON  articulos.codarticulo =  articulos.codarticulo 
            JOIN alias_articulos ON  alias_articulos.codarticulo = articulos.codarticulo
            WHERE articulos.borrado = 0        
            AND artpro.codfamilia = articulos.codfamilia 
            ".$where."
        ) 
        articulos_con_alias
        ORDER BY
        codfamilia ASC,
        descripcion ASC;";
	}
	$rs_tabla = mysqli_query($conexion,$consulta);

	$nrs=mysqli_num_rows($rs_tabla);

?>
<div id="tituloForm2" class="header">
<form id="form1" name="form1">
<? if ($nrs>0) { ?>
		<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
		  <tr>
			<td width="20%"><div align="center"><b><span class="header" id="tflia">Familia</span></b></div></td>
			<td width="20%"><div align="center"><b><span class="header" id="trefren">Referencia</span></b></div></td>
			<td width="40%"><div align="center"><b><span class="header" id="tdescri">Descripci&oacute;n</span></b></div></td>
			<td width="10%"><div align="center"><b><span class="header" id="tprecio">Precio</span></b></div></td>
			<td width="10%"><div align="center"></td>
		  </tr>
		<?php
			for ($i = 0; $i < mysqli_num_rows($rs_tabla); $i++) {
				$codfamilia=mysqli_result($rs_tabla,$i,"codfamilia");
				$nombrefamilia=mysqli_result($rs_tabla,$i,"nombrefamilia");
				$codarticulo=mysqli_result($rs_tabla,$i,"codarticulo");
				$referencia=mysqli_result($rs_tabla,$i,"referencia");				
				$descripcion=mysqli_result($rs_tabla,$i,"descripcion");
				if ($todos==0) { $precio=mysqli_result($rs_tabla,$i,"pcosto"); }
				if ($todos==1) { $precio=mysqli_result($rs_tabla,$i,"precio_compra"); }
                if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }?>
						<tr class="<?php echo $fondolinea?>">
					<td>
        <div align="center"><?php echo $nombrefamilia;?></div></td>
		<td>
        <div align="center"><?php echo $referencia;?></div></td>
					<td>
        <div align="left"><?php echo utf8_encode($descripcion);?></div></td>
					<td><div align="center"><?php echo $precio;?></div></td>
					<td align="center"><div align="center"><a href="javascript:pon_prefijo(<?php echo $codfamilia?>,'<?php echo $referencia?>','<?php echo str_replace('"','',$descripcion)?>','<?php echo $precio?>',<? echo $codarticulo?>)"><img src="../img/convertir.svg" width="16px" height="16px" border="0" data-ttitle="tsel" title="Seleccionar"></a></div></td>
				</tr>
			<?php }
		?>
  </table>
		<?php 
		}  else { 
			echo "Este proveedor no ha servido ning&uacute;n art&iacute;culo hasta el momento";
		} ?>
<iframe id="frame_datos" name="frame_datos" width="0%" height="0" frameborder="0">
	<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
</iframe>
<input type="hidden" id="accion" name="accion">
</form>
</div>
</body>
</html>
