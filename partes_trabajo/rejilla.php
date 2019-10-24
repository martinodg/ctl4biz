<?php
include ("../conectar.php");
include ("../funciones/fechas.php");

$codtrabajador=$_POST["codtrabajador"];
$nombre=$_POST["nombre"];
$numparte=$_POST["numparte"];
$estado=$_POST["cboEstados"];
$fechacomienzo=$_POST["fechacomienzo"];
$titulo = $_POST["titulo"];

if ($fechacomienzo<>"") { $fechacomienzo=explota($fechacomienzo); }
#$fechafin=$_POST["fechafin"];
#if ($fechafin<>"") { $fechafin=explota($fechafin); }

$cadena_busqueda=$_POST["cadena_busqueda"];

$where="1=1";
if ($codtrabajador <> "") { $where.=" AND partestrabajo.codtrabajador='$codtrabajador'"; }
if ($nombre <> "") { $where.=" AND partestrabajo.nombre like '%".$nombre."%'"; }
if ($numparte <> "") { $where.=" AND codtrabajo='$numparte'"; }
if ($titulo <> "") { $where.=" AND partestrabajo.titulo like '%" . $titulo . "%'"; }
if ($estado > "0") { $where.=" AND estado='$estado'"; }
if (($fechacomienzo<>"") and ($fechafin<>"")) {
	$where.=" AND fecha between '".$fechainicio."' AND '".$fechafin."'";
} else {
	if ($fechacomienzo<>"") {
		$where.=" and fechacomienzo>='".$fechacomienzo."'";
	} else {
		if ($fechafin<>"") {
			$where.=" and fecha<='".$fechafin."'";
		}
	}
}

$where.=" ORDER BY fechacomienzo,codtrabajo DESC";
$query_busqueda="SELECT count(*) as filas FROM partestrabajo,trabajadores WHERE partestrabajo.codtrabajador=trabajadores.codtrabajador AND ".$where;
#echo "SQL: $query_busqueda <br>";

$rs_busqueda=mysql_query($query_busqueda);
$filas=mysql_result($rs_busqueda,0,"filas");

?>
<html>
	<head>
		<title>Trabajadores</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">

		function ver_parte(codalbaran) {
			parent.location.href="guardar_parte.php?codtrabajo=" + codalbaran + "&accion=ver";
		}


		function imprimir_etiquetas(codalbaran) {
				window.open("../fpdf/codigocontinuo.php?codalbaran="+codalbaran);
		}

		function modificar_parte(codtrabajo) {
				parent.location.href="modificar_parte.php?codtrabajo=" + codtrabajo + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}

		function convertir_parte(codtrabajo) {
			if (marcaestado==1) {
				parent.location.href="convertir_albaran.php?codtrabajo=" + codtrabajo + "&cadena_busqueda=<? echo $cadena_busqueda?>";
			} else {
				alert ("No se puede convertir en factura un albaran ya facturado");
			}
		}

		function eliminar_parte(codtrabajo) {
			parent.location.href="eliminar_parte.php?codtrabajo=" + codtrabajo + "&cadena_busqueda=<? echo $cadena_busqueda?>";
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
				texto=contador + "-" + parseInt(contador+49);
				if (indi==contador) {
					parent.document.form_busqueda.paginas.options[indice]=new Option (texto,contador);
					parent.document.form_busqueda.paginas.options[indice].selected=true;
				} else {
					parent.document.form_busqueda.paginas.options[indice]=new Option (texto,contador);
				}
				indice++;
				contador=contador+50;
			}
		}
		</script>
	</head>

	<body onload=inicio()>
		<div id="pagina">
			<div id="zonaContenido">
			<div align="center">
			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
			<input type="hidden" name="numfilas" id="numfilas" value="<? echo $filas?>">
				<? $iniciopagina=$_POST["iniciopagina"];
				if (empty($iniciopagina)) { $iniciopagina=$_GET["iniciopagina"]; } else { $iniciopagina=$iniciopagina-1;}
				if (empty($iniciopagina)) { $iniciopagina=0; }
				if ($iniciopagina>$filas) { $iniciopagina=0; }
					if ($filas > 0) { ?>
						<? $sel_resultado =  "SELECT titulo, horasprevistas, preciohora, codtrabajo,trabajadores.nombre as nombre,partestrabajo.fechacomienzo as fechacomienzo,estado FROM partestrabajo,trabajadores WHERE partestrabajo.codtrabajador=trabajadores.codtrabajador AND ".$where;
						   $sel_resultado .= " LIMIT ".$iniciopagina.",50";
#						   echo "SQL: $sel_resultado <br>";
						   $res_resultado=mysql_query($sel_resultado);
						   $contador=0;
						   $marcaestado=0;
						   while ($contador < mysql_num_rows($res_resultado)) {
						   		$marcaestado=mysql_result($res_resultado,$contador,"estado");
								$estado = $estados_partestrabajo[mysql_result($res_resultado,$contador,"estado")];
								if ($contador % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }?>
						<tr class="<?php echo $fondolinea?>">
							<td class="aCentro" width="8%"><? echo $contador+1;?></td>
							<td width="8%"><div align="center"><? echo mysql_result($res_resultado,$contador,"codtrabajo")?></div></td>
							<td width="12%"><div align="left"><? echo mysql_result($res_resultado,$contador,"nombre")?></div></td>
							<td width="20%"><div align="center"><?php echo mysql_result($res_resultado,$contador,"titulo"); ?></div></td>
							<td class="aDerecha" width="10%"><div align="center"><? echo implota(mysql_result($res_resultado,$contador,"fechacomienzo"))?></div></td>
							<td width="10%"><div align="center"><? echo mysql_result($res_resultado,$contador,"horasprevistas"); ?></div></td>
							<td width="10%"><div align="center"><? echo mysql_result($res_resultado,$contador,"preciohora"); ?></div></td>
							<td width="10%"><div align="center"><? echo $estado?></div></td>
							<td width="5%"><div align="center"><a href="#"><img src="../img/modificar.svg" width="16" height="16" border="0" onClick="modificar_parte(<?php echo mysql_result($res_resultado,$contador,"codtrabajo")?>)" title="Modificar"></a></div></td>
							<td width="5%"><div align="center"><a href="#"><img src="../img/ver.svg" width="16" height="16" border="0" onClick="ver_parte(<?php echo mysql_result($res_resultado,$contador,"codtrabajo")?>)" title="Visualizar"></a></div></td>
							<td width="5%"><div align="center"><a href="#"><img src="../img/eliminar.svg" width="16" height="16" border="0" onClick="if (confirm('�Est� seguro de eliminar el parte de trabajo?')) { eliminar_parte(<?php echo mysql_result($res_resultado,$contador,"codtrabajo")?>) }" title="Eliminar"></a></div></td>
<!--							<td width="5%"><div align="center"><a href="#"><img src="../img/imprimir.png" width="16" height="16" border="0" onClick="imprimir_etiquetas(<?php echo mysql_result($res_resultado,$contador,"codalbaran")?>)" title="Imprimir etiquetas"></a></div></td> -->
						</tr>
						<? $contador++;
							}
						?>
					</table>
					<? } else { ?>
					<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="100%" class="mensaje"><?php echo "No hay ning&uacute;n parte que cumpla con los criterios de b&uacute;squeda";?></td>
					    </tr>
					</table>
					<? } ?>
				</div>
			</div>
		  </div>
		</div>
	</body>
</html>
