<?php
require_once("../conectar7.php");
require_once("../mysqli_result.php");

$codarticulo=$_POST["codarticulo"];
$descripcion=$_POST["descripcion"];
$codfamilia=$_POST["cboFamilias"];
$referencia=$_POST["referencia"];
$codproveedor=$_POST["cboProveedores"];
$codubicacion=$_POST["cboUbicacion"];

$cadena_busqueda=$_POST["cadena_busqueda"];

$where="1=1";
if ($codarticulo <> "") { $where.=" AND codarticulo='$codarticulo'"; }
if ($descripcion <> "") { $where.=" AND descripcion like '%".$descripcion."%'"; }
if ($codfamilia > "0") { $where.=" AND codfamilia='$codfamilia'"; }
if ($codproveedor > "0") { $where.=" AND (codproveedor1='$codproveedor' OR codproveedor2='$codproveedor')"; }
if ($codubicacion > "0") { $where.=" AND codubicacion='$codubicacion'"; }
if ($referencia <> "") { $where.=" AND referencia like '%".$referencia."%'"; }

$where.=" ORDER BY descripcion ASC";
$query_busqueda="SELECT count(*) as filas FROM articulos WHERE borrado=0 AND ".$where;
$rs_busqueda=mysqli_query($conexion,$query_busqueda);
$filas=mysqli_result($rs_busqueda,0,"filas");

?>
<html>
	<head>
		<title>Articulos</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
		<script language="javascript">
		
		function ver_articulo(codarticulo) {
			parent.location.href="ver_articulo.php?codarticulo=" + codarticulo + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function modificar_articulo(codarticulo) {
			parent.location.href="modificar_articulo.php?codarticulo=" + codarticulo + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function eliminar_articulo(codarticulo) {
			parent.location.href="eliminar_articulo.php?codarticulo=" + codarticulo + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}

		function inicio() {
			var numfilas=document.getElementById("numfilas").value;
			var indi=parent.document.getElementById("iniciopagina").value;
			var contador=1;
			var indice=0;
			if (indi>numfilas) { 
				indi=1; 
			}
			parent.document.form_busqueda.filas.value=numfilas;
			parent.document.form_busqueda.paginas.innerHTML="";		
			while (contador<=numfilas) {
				texto=contador + "-" + parseInt(contador+9);
				if (indi==contador) {
					parent.document.form_busqueda.paginas.options[indice]=new Option (texto,contador);
					parent.document.form_busqueda.paginas.options[indice].selected=true;
				} else {
					parent.document.form_busqueda.paginas.options[indice]=new Option (texto,contador);
				}
				indice++;
				contador=contador+10;
			}
		}
		</script>
	</head>

	<body onload=inicio()>	
		<div id="pagina">
			<div id="zonaContenido"  style="margin-left:0">
			<div align="center">
			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
			<input type="hidden" name="numfilas" id="numfilas" value="<? echo $filas?>">
				<? $iniciopagina=$_POST["iniciopagina"];
				if (empty($iniciopagina)) { $iniciopagina =  (isset($_GET["iniciopagina"])) ? intval($_GET["iniciopagina"]):0; } else { $iniciopagina=$iniciopagina-1;}
				if (empty($iniciopagina)) { $iniciopagina=0; }
				if ($iniciopagina>$filas) { $iniciopagina=0; }
					if ($filas > 0) { ?>
						<? $sel_resultado="SELECT articulos.*, unidadesmedidas.nombre AS unidaddemedida FROM articulos, unidadesmedidas WHERE articulos.codunidadmedida=unidadesmedidas.codunidadmedida AND borrado=0 AND ".$where;
						   $sel_resultado=$sel_resultado."  limit ".$iniciopagina.",10";
						   $res_resultado=mysqli_query($conexion,$sel_resultado);
						   $contador=0;
						   while ($contador < mysqli_num_rows($res_resultado)) { 
						   		if ($contador % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla";	}?>
						<tr class="<?php echo $fondolinea?>">
							<td class="aCentro" width="4%"><? echo $contador+1;?></td>
							<td width="5%"><div align="center"><? echo mysqli_result($res_resultado,$contador,"codarticulo")?></div></td>
							<td width="19%"><div align="center"><? echo mysqli_result($res_resultado,$contador,"referencia")?></div></td>
							<td width="25%"><div align="center"><? echo mysqli_result($res_resultado,$contador,"descripcion")?></div></td>
							<td width="11%"><div align="center">
							<? $codfamilia=mysqli_result($res_resultado,$contador,"codfamilia");
							$query_familia="SELECT nombre FROM familias WHERE codfamilia='$codfamilia'";
							$rs_familia=mysqli_query($conexion,$query_familia);
							$nombre_familia=mysqli_result($rs_familia,0,"nombre");
							echo $nombre_familia;			
							?>
                            </td>
							<td class="aCentro" width="11%"><div align="center"><? echo mysqli_result($res_resultado,$contador,"precio_tienda")?></div></td>
							<td class="aCentro" width="5%"><? echo mysqli_result($res_resultado,$contador,"stock")?></td>
							<td class="aCentro" width="5%"><? echo mysqli_result($res_resultado,$contador,"unidaddemedida")?></td>
							<td width="5%"><div align="center"><a href="#"><img src="../img/modificar.svg" width="16" height="16" border="0" onClick="modificar_articulo(<?php echo mysqli_result($res_resultado,$contador,"codarticulo")?>)" data-ttitle="modificar" title="Modificar"></a></div></td>
														<td width="5%"><div align="center"><a href="#"><img src="../img/ver.svg" width="16" height="16" border="0" onClick="ver_articulo(<?php echo mysqli_result($res_resultado,$contador,"codarticulo")?>)" data-ttitle="visualizar" title="Visualizar"></a></div></td>
							<td width="5%"><div align="center"><a href="#"><img src="../img/eliminar.svg" width="16" height="16" border="0" onClick="eliminar_articulo(<?php echo mysqli_result($res_resultado,$contador,"codarticulo")?>)" data-ttitle="eliminar" title="Eliminar"></a></div></td>
						</tr>
						<? $contador++;
							}
						?>			
					</table>
					<? } else { ?>
					<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 >
						<tr>
                            <td width="100%" class="mensaje"><span  id="tmsgsinrbus">No hay ning&uacute;n art&iacute;culo que cumpla con los criterios de b&uacute;squeda</span></td>
					    </tr>
					</table>					
					<? } ?>					
				</div>
			</div>
		  </div>			
		</div>
	</body>
</html>
