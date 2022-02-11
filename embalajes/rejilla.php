<?php
require_once("../conectar7.php");
require_once("../mysqli_result.php");

$codembalaje=$_POST["codembalaje"];
$nombre=$_POST["nombre"];
$cadena_busqueda=$_POST["cadena_busqueda"];

$where="1=1";
if ($codembalaje <> "") { $where.=" AND codembalaje='$codembalaje'"; }
if ($nombre <> "") { $where.=" AND nombre like '%".$nombre."%'"; }

$where.=" ORDER BY nombre ASC";
$query_busqueda="SELECT count(*) as filas FROM embalajes WHERE borrado=0 AND ".$where;
$rs_busqueda=mysqli_query($conexion,$query_busqueda);
$filas=mysqli_result($rs_busqueda,0,"filas");

?>
<html>
	<head>
		<title>Familias</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
		<script language="javascript">
		
		function ver_embalaje(codembalaje) {
			parent.location.href="ver_embalaje.php?codembalaje=" + codembalaje + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function modificar_embalaje(codembalaje) {
			parent.location.href="modificar_embalaje.php?codembalaje=" + codembalaje + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function eliminar_embalaje(codembalaje) {
			parent.location.href="eliminar_embalaje.php?codembalaje=" + codembalaje + "&cadena_busqueda=<? echo $cadena_busqueda?>";
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
            <div style="width: 100%; height: 33px; background-color: #251d1d;position: absolute; top: -8px;"></div>
			<div id="zonaContenido">
			<div align="center">
			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
                <tr class="cabeceraTabla">
                    <td class="aCentro" width="12%"><span id="titem">ITEM</span></td>
                    <td class="aCentro" width="12%"><span id="tcodio">CODIGO</span></td>
                    <td width="30%"><span id="tnomb">NOMBRE</span></td>
                    <td class="aCentro" width="20%"><span id="tunidad">UNIDAD DE MEDIDA</span></td>
                    <td width="6%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                </tr>
			<input type="hidden" name="numfilas" id="numfilas" value="<? echo $filas?>">
				<? $iniciopagina=$_POST["iniciopagina"];
				if (empty($iniciopagina)) { $iniciopagina=$_GET["iniciopagina"]; } else { $iniciopagina=$iniciopagina-1;}
				if (empty($iniciopagina)) { $iniciopagina=0; }
				if ($iniciopagina>$filas) { $iniciopagina=0; }
					if ($filas > 0) { ?>
						<? $sel_resultado="SELECT * FROM embalajes WHERE borrado=0 AND ".$where;
						   $sel_resultado=$sel_resultado."  limit ".$iniciopagina.",10";
                            $res_resultado=mysqli_query($conexion,$sel_resultado);


                        $contador=0;
						   while ($contador < mysqli_num_rows($res_resultado)) {
                               $cod_unimedida = mysqli_result($res_resultado,$contador,'codunidadmedida');
                               $query_unimedida ="SELECT * FROM unidadesmedidas WHERE codunidadmedida='$cod_unimedida'";
                               $rs_queryUnimedida = mysqli_query($conexion,$query_unimedida);
                               if ($contador % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }?>
						<tr class="<?php echo $fondolinea?>">
							<td class="aCentro" width="12%"><? echo $contador+1;?></td>
							<td width="12%"><div align="center"><? echo mysqli_result($res_resultado,$contador,"codembalaje")?></div></td>
							<td width="30%"><div align="center"><? echo mysqli_result($res_resultado,$contador,"nombre")?></div></td>
							<td width="20%"><div align="center"><? echo mysqli_result($rs_queryUnimedida,0,"nombre");?></div></td>
							<td width="6%"><div align="center"><a href="#"><img src="../img/modificar.svg" width="16" height="16" border="0" onClick="modificar_embalaje(<?php echo mysqli_result($res_resultado,$contador,"codembalaje")?>)" data-ttitle="modificar" title="Modificar"></a></div></td>
							<td width="6%"><div align="center"><a href="#"><img src="../img/ver.svg" width="16" height="16" border="0" onClick="ver_embalaje(<?php echo mysqli_result($res_resultado,$contador,"codembalaje")?>)" data-ttitle="visualizar" title="Visualizar"></a></div></td>
							<td width="6%"><div align="center"><a href="#"><img src="../img/eliminar.svg" width="16" height="16" border="0" onClick="eliminar_embalaje(<?php echo mysqli_result($res_resultado,$contador,"codembalaje")?>)" data-ttitle="eliminar" title="Eliminar"></a></div></td>
						</tr>
						<? $contador++;
							}
						?>			
					</table>
					<? } else { ?>
					<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0>
						<tr>
                            <td width="100%" class="mensaje"><span  id="tmsgctrbsq">No hay ning&uacute;n embalaje que cumpla con los criterios de b&uacute;squeda</span></td>
					    </tr>
					</table>					
					<? } ?>					
				</div>
			</div>
		  </div>			
		</div>
	</body>
</html>
