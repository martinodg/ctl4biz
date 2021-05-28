<?php
require_once("../conectar7.php");
require_once("../mysqli_result.php");
?>

<script>
function eliminar_linea(codfacturatmp,numlinea,importe)
{
	if (confirm(" Desea eliminar esta linea ? "))
		parent.document.formulario_lineas.baseimponible.value=parseFloat(parent.document.formulario_lineas.baseimponible.value) - parseFloat(importe);
		var original=parseFloat(parent.document.formulario_lineas.baseimponible.value);
		var result=Math.round(original*100)/100 ;
		parent.document.formulario_lineas.baseimponible.value=result;

		parent.document.formulario_lineas.baseimpuestos.value=parseFloat(result * parseFloat(parent.document.formulario.iva.value / 100));
		var original1=parseFloat(parent.document.formulario_lineas.baseimpuestos.value);
		var result1=Math.round(original1*100)/100 ;
		parent.document.formulario_lineas.baseimpuestos.value=result1;
		var original2=parseFloat(result + result1);
		var result2=Math.round(original2*100)/100 ;
		parent.document.formulario_lineas.preciototal.value=result2;
		
		document.getElementById("frame_datos").src="eliminar_linea.php?codfacturatmp="+codfacturatmp+"&numlinea=" + numlinea;
}
</script>

<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
<?php 

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
				$consultaprevia = "SELECT max(numlinea) as maximo FROM factulineaptmp WHERE codfactura=$codfacturatmp";
				//echo $consultaprevia;
				$rs_consultaprevia=mysqli_query($conexion,$consultaprevia);
				$codlineatmp=mysqli_result($rs_consultaprevia,0,"maximo");
				//If the result of the query is null then this will be the rist entry on the table and 0 is assigned as previews entry code.
				if ($codlineatmp=="") { $codlineatmp=0;} 
				$codlineatmp++;
				//insert the new entry on meta-process table.
				
				$sel_insert="INSERT INTO factulineaptmp (codfactura,numlinea,codigo,codfamilia,cantidad,precio,importe,dcto) VALUES ('$codfacturatmp','$codlineatmp','$codarticulo','$codfamilia','$cantidad','$precio','$importe','$descuento')";
				//echo $sel_insert;
				$rs_insert=mysqli_query($conexion,$sel_insert);
		}
}
?>
<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
<?php
$sel_lineas="SELECT factulineaptmp.*,articulos.*,familias.nombre as nombrefamilia FROM factulineaptmp,articulos,familias WHERE factulineaptmp.codfactura='$codfacturatmp' AND factulineaptmp.codigo=articulos.codarticulo AND factulineaptmp.codfamilia=articulos.codfamilia AND articulos.codfamilia=familias.codfamilia ORDER BY factulineaptmp.numlinea ASC";
$rs_lineas=mysqli_query($conexion,$sel_lineas);
for ($i = 0; $i < mysqli_num_rows($rs_lineas); $i++) {
	$numlinea=mysqli_result($rs_lineas,$i,"numlinea");
	$codfamilia=mysqli_result($rs_lineas,$i,"codfamilia");
	$nombrefamilia=mysqli_result($rs_lineas,$i,"nombrefamilia");
	$codarticulo=mysqli_result($rs_lineas,$i,"codarticulo");
	$descripcion=mysqli_result($rs_lineas,$i,"descripcion");
	$cantidad=mysqli_result($rs_lineas,$i,"cantidad");
	$precio=mysqli_result($rs_lineas,$i,"precio");
	$importe=mysqli_result($rs_lineas,$i,"importe");
	$referencia=mysqli_result($rs_lineas,$i,"referencia");
	$descuento=mysqli_result($rs_lineas,$i,"dcto");
	if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; } ?>
			<tr class="<? echo $fondolinea?>">
				<td width="5%"><? echo $i+1?></td>
				<td width="20%"><? echo $referencia?></td>
				<td width="36%"><? echo $descripcion?></td>
				<td width="8%" class="aCentro"><? echo $cantidad?></td>
				<td width="8%" class="aCentro"><? echo $precio?></td>
				<td width="7%" class="aCentro"><? echo $descuento?></td>
				<td width="8%" class="aCentro"><? echo $importe?></td>
				<td width="3%"><a href="javascript:eliminar_linea(<?php echo $codfacturatmp?>,<?php echo $numlinea?>,<?php echo $importe ?>)"><img src="../img/eliminar.svg" height="16px" width="16px" border="0"></a></td>
			</tr>
<? } ?>
</table>
<iframe id="frame_datos" name="frame_datos" width="0%" height="0" frameborder="0">
	<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
</iframe>