<?
require_once("../conectar7.php");
require_once("../mysqli_result.php");

?>


<script>
function eliminar_linea(codfacturatmp,numlinea,importe)
{
	if (confirm(" Desea eliminar esta linea ? ")) {

		//GET original base imponible and repalce with the new value
		var bi_original=parseFloat(parent.document.formulario_lineas.baseimponible.value);
		var nueva_bi=bi_original - parseFloat(importe);
		parent.document.formulario_lineas.baseimponible.value=Math.round(nueva_bi*100)/100;
	
		//Get original impuestos and replace with the new value
		var iva=parseFloat(parent.document.formulario.iva.value);
		var nuevos_impuestos=(nueva_bi*iva)/100;

		//Calculate new total
		var nuevo_total=nueva_bi+nuevos_impuestos;
		parent.document.formulario_lineas.baseimpuestos.value=Math.round(nuevos_impuestos*100)/100;
		parent.document.formulario_lineas.preciototal.value=Math.round(nuevo_total*100)/100;
		parent.document.formulario.preciototal2.value=Math.round(nuevo_total*100)/100;
	
		document.getElementById("frame_datos").src="eliminar_linea.php?codfacturatmp="+codfacturatmp+"&numlinea="+numlinea;
	}	
}
</script>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
<?php 
if (isset($_GET["codfacturatmp"])){$codfacturatmp=$_GET["codfacturatmp"];} 
$codfacturatmp=$_POST["codfacturatmp"];
if (isset($_GET["modif"])){$modif=$_GET["modif"];} 
$modif=$_POST["modif"];
$retorno=0;
if ($modif<>1) {
		if (!isset($codfacturatmp)) { 
			$codfacturatmp=$_GET["codfacturatmp"]; 
			$retorno=1; }
		if ($retorno==0) {	
				$codfamilia=$_POST["codfamilia"];
				$codarticulo=$_POST["codarticulo"];
				$cantidad=$_POST["cantidad"];
				$precio=$_POST["precio"];
				$importe=$_POST["importe"];
				$descuento=$_POST["descuento"];   

				//Ask for last codproceso and assing new value
				$consultaprevia = "SELECT max(numlinea) as maximo FROM factulineatmp WHERE codfactura=$codfacturatmp";
				$rs_consultaprevia=mysqli_query($conexion,$consultaprevia);
				$codlineatmp=mysqli_result($rs_consultaprevia,0,"maximo");
				//If the result of the query is null then this will be the rist entry on the table and 0 is assigned as previews entry code.
				if ($codlineatmp=="") { $codlineatmp=0;} 
				$codlineatmp++;
				//insert the new entry on meta-process table.
				
				$sel_insert="INSERT INTO factulineatmp (codfactura,numlinea,codigo,codfamilia,cantidad,precio,importe,dcto) VALUES ('$codfacturatmp','$codlineatmp','$codarticulo','$codfamilia','$cantidad','$precio','$importe','$descuento')";
				$rs_insert=mysqli_query($conexion,$sel_insert);
		}
}
?>
<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1"> 
<?php
$sel_lineas="SELECT factulineatmp.*,articulos.*,familias.nombre as nombrefamilia FROM factulineatmp,articulos,familias WHERE factulineatmp.codfactura='$codfacturatmp' AND factulineatmp.codigo=articulos.codarticulo AND factulineatmp.codfamilia=articulos.codfamilia AND articulos.codfamilia=familias.codfamilia ORDER BY factulineatmp.numlinea ASC";
$rs_lineas=mysqli_query($conexion,$sel_lineas);
for ($i = 0; $i < mysqli_num_rows($rs_lineas); $i++) {
	$numlinea=mysqli_result($rs_lineas,$i,"numlinea");
	$codfamilia=mysqli_result($rs_lineas,$i,"codfamilia");
	$nombrefamilia=mysqli_result($rs_lineas,$i,"nombrefamilia");
	$referencia=mysqli_result($rs_lineas,$i,"referencia");
	$codarticulo=mysqli_result($rs_lineas,$i,"codarticulo");
	$descripcion=mysqli_result($rs_lineas,$i,"descripcion");
	$cantidad=mysqli_result($rs_lineas,$i,"cantidad");
	$precio=mysqli_result($rs_lineas,$i,"precio");
	$importe=mysqli_result($rs_lineas,$i,"importe");
	$descuento=mysqli_result($rs_lineas,$i,"dcto");
	if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; } ?>
			<tr class="<? echo $fondolinea?>">
				<td width="5%"><? echo $i+1?></td>
				<td width="18%"><? echo $referencia?></td>
				<td width="41%"><? echo $descripcion?></td>
				<td width="8%" class="aCentro"><? echo $cantidad?></td>
				<td width="8%" class="aCentro"><? echo $precio?></td>
				<td width="7%" class="aCentro"><? echo $descuento?></td>
				<td width="8%" class="aCentro"><? echo $importe?></td>
				<td width="3%"><a href="javascript:eliminar_linea(<?php echo $codfacturatmp?>,<?php echo $numlinea?>,<?php echo $importe ?>)"><img src="../img/eliminar.svg" height="16" width="16" border="0"></a></td>
			</tr>
<? } ?>
</table>
<iframe id="frame_datos" name="frame_datos" width="0%" height="0" frameborder="0">
	<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
</iframe>