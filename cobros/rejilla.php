<?php
require_once("../conectar7.php");
require_once("../mysqli_result.php");
require_once("../funciones/fechas.php");
$filas=0;
$codcliente=$_POST["codcliente"];
$estado=$_POST["cboEstados"];
$fechainicio=$_POST["fechainicio"];
if ($fechainicio<>"") { $fechainicio=explota($fechainicio); }
$fechafin=$_POST["fechafin"];
if ($fechafin<>"") { $fechafin=explota($fechafin); }

$cadena_busqueda=$_POST["cadena_busqueda"];

$where="1=1";
if ($codcliente <> "") { $where.=" AND facturas.codcliente='$codcliente'"; }
if ($estado <> 0) { $where.=" AND estado='$estado'"; }
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

$where.=" ORDER BY facturas.codfactura DESC";
//$query_busqueda="SELECT count(*) FROM facturas  WHERE facturas.borrado=0";

$query_busqueda="SELECT count(*) as filas FROM facturas LEFT JOIN cobros ON facturas.codfactura=cobros.codfactura INNER JOIN clientes ON facturas.codcliente=clientes.codcliente WHERE facturas.borrado=0 AND ".$where;
//echo $query_busqueda;
$rs_busqueda=mysqli_query($conexion,$query_busqueda);
$filas=mysqli_result($rs_busqueda,0,"filas");

?>
<html>
	<head>
		<title>Clientes</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">        <script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
		<script language="javascript">

		function ver_cobros(codfactura) {
			parent.location.href="ver_cobros.php?codfactura=" + codfactura + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function inicio() {
			var numfilas=document.getElementById("numfilas").value;
			var indi=parent.document.getElementById("iniciopagina").value;
			var contador=1;
			var indice=0;
			if (indi>numfilas) { 
				indi=1; 
			}
			parent.document.formulario.filas.value=numfilas;
			parent.document.formulario.paginas.innerHTML="";		
			while (contador<=numfilas) {
				texto=contador + "-" + parseInt(contador+9);
				if (indi==contador) {
					parent.document.formulario.paginas.options[indice]=new Option (texto,contador);
					parent.document.formulario.paginas.options[indice].selected=true;
				} else {
					parent.document.formulario.paginas.options[indice]=new Option (texto,contador);
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
			<form name="form1" id="form1">
			<input type="hidden" name="numfilas" id="numfilas" value="<? echo $filas?>">
				<?	if ($filas > 0) { ?>
						<? $sel_resultado="SELECT distinct facturas.codfactura,facturas.fecha as fecha,totalfactura,estado,fechavencimiento,clientes.nombre as nombre FROM facturas LEFT JOIN cobros ON facturas.codfactura=cobros.codfactura INNER JOIN clientes ON facturas.codcliente=clientes.codcliente WHERE facturas.borrado=0 AND ".$where;
						   $res_resultado=mysqli_query($conexion,$sel_resultado);
						   $contador=0;					   
						   while ($contador < mysqli_num_rows($res_resultado)) { 
						   		if (mysqli_result($res_resultado,$contador,"estado") == 1) { $estado="Sin pagar"; } else { $estado="Pagada"; } 
								if ($contador % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }?>
						<tr class="<?php echo $fondolinea?>">
							<td class="aCentro" width="8%"><? echo $contador+1;?></td>
							<td width="8%"><div align="center"><? echo mysqli_result($res_resultado,$contador,"codfactura")?></div></td>
							<td width="30%"><div align="left"><? echo mysqli_result($res_resultado,$contador,"nombre")?></div></td>							
							<td width="9%"><div align="center"><? echo number_format(mysqli_result($res_resultado,$contador,"totalfactura"),2,",",".")?></div></td>
							<? $sel_cobros="SELECT sum(importe) as aportaciones FROM cobros WHERE codfactura='".mysqli_result($res_resultado,$contador,"codfactura")."'";
								$rs_cobros=mysqli_query($conexion,$sel_cobros);
								$aportaciones=mysqli_result($rs_cobros,0,"aportaciones"); 
								$pendiente=mysqli_result($res_resultado,$contador,"totalfactura") - $aportaciones; ?>
							<td class="aDerecha" width="10%"><div align="center"><? echo number_format($pendiente,2,",",".")?></div></td>
							<td class="aDerecha" width="10%"><div align="center"><? echo implota(mysqli_result($res_resultado,$contador,"fecha"))?></div></td>
							<td class="aDerecha" width="10%"><div align="center"><? echo $estado?></div></td>							
							<td width="10%"><div align="center"><? echo implota(mysqli_result($res_resultado,$contador,"fechavencimiento"));?></div></td>
							<td width="5%"><div align="center"><a href="#"><img src="../img/dinero.svg" width="16" height="16" border="0" onClick="ver_cobros(<?php echo mysqli_result($res_resultado,$contador,"codfactura")?>)" title="Ver Cobros"></a></div></td>
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
					</form>				
				</div>
			</div>
		  </div>			
		</div>
	</body>
</html>
