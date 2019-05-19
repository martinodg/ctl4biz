<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache');

?>
<html>
<head>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
</head>
<script language="javascript">

function pon_prefijo(par2,par3) {
	parent.document.form_busqueda.parametro2.value=par2;
	parent.document.form_busqueda.parametro3.value=par3;
}

function limpiar() {
	parent.document.form_busqueda.parametro1.value="";
	parent.document.form_busqueda.parametro2.value="";
	parent.document.form_busqueda.parametro3.value="";
}

</script>
<?
include ("../conectar7.php"); 
include ("../mysqli_result.php");
?>
<body>

<?

	$criterio1=$_GET["criterio1"];
    $parametro1=$_GET["parametro1"];
    $criterio2=$_GET["criterio2"];
    $parametro2=$_GET["parametro2"];
    $criterio3=$_GET["criterio3"];
    $parametro3=$_GET["parametro3"];
    
       
    $donde=$criterio1."=".$parametro1." AND ";
    if ($parametro2<>"") $donde=$donde.$criterio2."=".$parametro2." AND ";
    if ($parametro3<>""), $donde=$donde.$criterio3."=".$parammetro3." AND ";


	$consulta="SELECT * FROM lote WHERE ".$donde."borrado=0";
	$rs_tabla = mysqli_query($conexion,$consulta);
	if (mysqli_num_rows($rs_tabla)>0) {
		?>
		<script languaje="javascript">
		pon_prefijo("<? echo mysqli_result($rs_tabla,0,"'$criterio2'") ?>","<? echo mysqli_result($rs_tabla,0,"'$criterio3'") ?>");
		 
        </script>
		<?
	} else { ?>
	<script>
	alert ("No existe ningun lote con ese codigo");
	limpiar();
	</script>
	<? }
?>
</div>
</body>
</html>
