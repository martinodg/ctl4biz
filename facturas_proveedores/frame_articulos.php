<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
require_once("../conectar7.php");
require_once("../mysqli_result.php");
?>
<html>
<head>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="../../jquery/jquery331.js"></script>
    <script type="text/javascript" src="../../funciones/languages/changelanguage.js"></script>

</head>
<script language="javascript">

function pon_prefijo(codfamilia,pref,nombre,precio,codarticulo,unidadmedida) {
	parent.opener.document.formulario_lineas.codfamilia.value=codfamilia;
	parent.opener.document.formulario_lineas.referencia.value=pref;
	parent.opener.document.formulario_lineas.descripcion.value=nombre;
	parent.opener.document.formulario_lineas.precio.value=precio;
	parent.opener.document.formulario_lineas.codarticulo.value=codarticulo;
	parent.opener.document.formulario_lineas.unidadmedida.value=unidadmedida;
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
$where=" borrado = 0 ";

if ($familia<>0) { $where.=" AND codfamilia='$familia'"; }
if ($referencia<>"") { $where.=" AND referencia like '%$referencia%'"; }
if ($descripcion<>"") { $where.=" AND descripcion like '%$descripcion%'"; }

 ?>
<body>
<?
    if ($todos==1) {
        $consulta="SELECT * FROM listado_articulos_alias  WHERE ".$where." ORDER BY  codfamilia ASC, descripcion ASC;";
    }
    if ($todos==0) {
        $where .= " AND codproveedor='".$codproveedor."' ";
        $consulta ="SELECT * FROM  listado_articulos_precios_alias WHERE ".$where."  ORDER BY codfamilia ASC,  descripcion ASC;";
    }
	$rs_tabla = mysqli_query($conexion,$consulta) or trigger_error("Query Failed! SQL: $consulta - Error: ".mysqli_error($conexion), E_USER_ERROR);
	$nrs = mysqli_num_rows($rs_tabla);
?>
<div id="tituloForm2" class="header">
<form id="form1" name="form1">
<? if ($nrs>0) { ?>
		<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
		  <tr>
			<td width="20%"><div align="center"><b><span  id="tflia">Familia</span></b></div></td>
			<td width="20%"><div align="center"><b><span  id="trefren">Referencia</span></b></div></td>
			<td width="40%"><div align="center"><b><span  id="tdescri">Descripci&oacute;n</span></b></div></td>
			<td width="10%"><div align="center"><b><span  id="tprecio">Precio</span></b></div></td>
			<td width="10%"><div align="center"></td>
		  </tr>
		<?php
			for ($i = 0; $i < mysqli_num_rows($rs_tabla); $i++) {
				$codfamilia=mysqli_result($rs_tabla,$i,"codfamilia");
				$referencia=mysqli_result($rs_tabla,$i,"referencia");
				$nombrefamilia=mysqli_result($rs_tabla,$i,"nombrefamilia");
				$codarticulo=mysqli_result($rs_tabla,$i,"codarticulo");				
				$descripcion=mysqli_result($rs_tabla,$i,"descripcion");
                $unidad_medida=mysqli_result($rs_tabla,$i,"codunidadmedida");
                if($unidad_medida){
                    $consulta_unimedida = "SELECT nombre FROM unidadesmedidas";
                    $rs_uni = mysqli_query($conexion, $consulta_unimedida);
                    $nombreunidad_medidad = mysqli_result($rs_uni,$unidad_medida,"nombre");
                }
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
					<td align="center"><div align="center"><a href="javascript:pon_prefijo(<?php echo $codfamilia?>,'<?php echo $referencia?>','<?php echo str_replace('"','',$descripcion)?>','<?php echo $precio?>',<? echo $codarticulo?>,'<?php echo $nombreunidad_medidad?>')"><img src="../img/convertir.svg" width="16px" height="16px" border="0" data-ttitle="tsel" title="Seleccionar"></a></div></td>
				</tr>
			<?php }
		?>
  </table>
		<?php 
		}  else { 
			echo '<span id="msjProveedorSinArticulos">Este proveedor no ha servido ning&uacute;n art&iacute;culo hasta el momento</span>';
		} ?>
<iframe id="frame_datos" name="frame_datos" width="0%" height="0" frameborder="0">
	<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
</iframe>
<input type="hidden" id="accion" name="accion">
</form>
</div>
</body>
</html>
