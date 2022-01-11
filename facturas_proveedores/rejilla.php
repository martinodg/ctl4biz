<?php
require_once("../conectar7.php");
require_once("../mysqli_result.php");
require_once("../funciones/fechas.php");

$codproveedor=$_POST["codproveedor"];
$nombre=$_POST["nombre"];
$numfactura=$_POST["numfactura"];
$estado=$_POST["cboEstados"];
$fechainicio=$_POST["fechainicio"];
if ($fechainicio<>"") { $fechainicio=explota($fechainicio); }
$fechafin=$_POST["fechafin"];
if ($fechafin<>"") { $fechafin=explota($fechafin); }

$cadena_busqueda=$_POST["cadena_busqueda"];

$zerocodprov= sprintf("%08d",$codproveedor);
//echo $zerocodprov;

$where="1=1";
if ($codproveedor <> "") { $where.=" AND facturas.codproveedor=$codproveedor"; }
if ($nombre <> "") { $where.=" AND proveedores.nombre like '%".$nombre."%'"; }
if ($numfactura <> "") { $where.=" AND (codfactura*1)='$numfactura'"; }
if ($estado > "0") { $where.=" AND estado='$estado'"; }
if (($fechainicio<>"") and ($fechafin<>"")) {
	$where.=" AND fecha between '".$fechainicio."' AND '".$fechafin."'";
} else {
	if ($fechainicio<>"") {
		$where.=" and fecha>='".$fechainicio."'";
	} else {
		if ($fechafin<>"") {
			$where.=" and fecha<='".$fechafin."'";
		}
	}
}

$where.=" ORDER BY codfactura DESC";
$query_busqueda="SELECT count(*) as filas FROM facturasp,proveedores WHERE facturasp.borrado=0 AND facturasp.codproveedor=proveedores.codproveedor AND ".$where;
//echo $query_busqueda;
$rs_busqueda=mysqli_query($conexion,$query_busqueda);
$filas=mysqli_result($rs_busqueda,0,"filas");

?>
<html>
	<head>
		<title>Clientes</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
		<script language="javascript">
		
		function ver_factura(codfactura,codproveedor) {
			parent.location.href="ver_factura.php?codfactura=" + codfactura + "&codproveedor=" + codproveedor;
		}
		
		function modificar_factura(codfactura,codproveedor,marcaestado) {
			if (marcaestado==1) {
				parent.location.href="modificar_factura.php?codfactura=" + codfactura + "&codproveedor=" + codproveedor;
			} else {
				alert ("No puede modificar una factura ya pagada.");
			}
		}
		
		function eliminar_factura(codfactura,codproveedor) {
			if (confirm("Atencion va a proceder a la eliminacion de una factura. Desea continuar?")) {
				parent.location.href="eliminar_factura.php?codfactura=" + codfactura + "&codproveedor="+codproveedor+"&cadena_busqueda=<? echo $cadena_busqueda?>";
			}
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
			<div id="zonaContenido">
			<div align="center">
			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
			<input type="hidden" name="numfilas" id="numfilas" value="<? echo $filas?>">
				<? $iniciopagina=$_POST["iniciopagina"];
				if (empty($iniciopagina)) { $iniciopagina=$_GET["iniciopagina"]; } else { $iniciopagina=$iniciopagina-1;}
				if (empty($iniciopagina)) { $iniciopagina=0; }
				if ($iniciopagina>$filas) { $iniciopagina=0; }
					if ($filas > 0) { ?>
						<? $sel_resultado="SELECT facturasp.codfactura as codfactura,proveedores.nombre as nombre,facturasp.fecha as fecha,totalfactura,estado, facturasp.codproveedor as codproveedor FROM facturasp,proveedores WHERE facturasp.borrado=0 AND facturasp.codproveedor=proveedores.codproveedor AND ".$where;
						   //echo $sel_resultado;
						   $sel_resultado=$sel_resultado."  limit ".$iniciopagina.",10";
						   $res_resultado=mysqli_query($conexion,$sel_resultado);
						   $contador=0;
						   $marcaestado=0;						   
						   while ($contador < mysqli_num_rows($res_resultado)) { 
								$marcaestado=mysqli_result($res_resultado,$contador,"estado");
								if (mysqli_result($res_resultado,$contador,"estado") == 1) { $estado="Sin pagar"; } else { $estado="Pagada"; } 
								if ($contador % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }?>
						<tr class="<?php echo $fondolinea?>">
							<td class="aCentro" width="8%"><? echo $contador+1;?></td>
							<td width="8%"><div align="center"><? echo mysqli_result($res_resultado,$contador,"codfactura")?></div></td>
							<td width="38%"><div align="left"><? echo mysqli_result($res_resultado,$contador,"nombre")?></div></td>							
							<td width="8%"><div align="center"><? echo number_format(mysqli_result($res_resultado,$contador,"totalfactura"),2,",",".")?></div></td>
							<td class="aDerecha" width="10%"><div align="center"><? echo implota(mysqli_result($res_resultado,$contador,"fecha"))?></div></td>
							<td class="aDerecha" width="10%"><div align="center"><? echo $estado?></div></td>
							<td width="6%"><div align="center"><a href="#"><img src="../img/modificar.svg" width="16" height="16" border="0" onClick="modificar_factura(&apos;<?php echo mysqli_result($res_resultado,$contador,"codfactura")?>&apos;,&apos;<?php echo mysqli_result($res_resultado,$contador,"codproveedor")?>&apos;,&apos;<? echo $marcaestado?>&apos;)" data-ttitle="modificar" title="Modificar"></a></div></td>
							<td width="6%"><div align="center"><a href="#"><img src="../img/ver.svg" width="16" height="16" border="0" onClick="ver_factura(&apos;<?php echo mysqli_result($res_resultado,$contador,"codfactura")?>&apos;,&apos;<?php echo mysqli_result($res_resultado,$contador,"codproveedor")?>&apos;)" data-ttitle="visualizar" title="Visualizar"></a></div></td>
							<td width="6%"><div align="center"><a href="#"><img src="../img/eliminar.svg" width="16" height="16" border="0" onClick="eliminar_factura(&apos;<?php echo mysqli_result($res_resultado,$contador,"codfactura")?>&apos;,&apos;<?php echo mysqli_result($res_resultado,$contador,"codproveedor")?>&apos;)" data-ttitle="eliminar" title="Eliminar"></a></div></td>
						</tr>
						<? $contador++;
							}
						?>			
					</table>
					<? } else { ?>
					<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="100%" class="mensaje"><span  id="tnhnfqccbu">No hay ninguna factura que cumpla con los criterios de búsqueda</span></td>
					    </tr>
					</table>					
					<? } ?>					
				</div>
			</div>
		  </div>			
		</div>
	</body>
</html>
