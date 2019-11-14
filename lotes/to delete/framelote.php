<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache');
?>
<html>
<head>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
</head>
<script language="javascript">

function pon_prefijo(codlote,codarticulo,cantidad) {
	parent.opener.document.form_busqueda.parametro1.value=parametro1;
	parent.opener.document.form_busqueda.parametro2.value=parametro2;
	parent.opener.document.form_busqueda.parametro3.value=parametro3;
	parent.window.close();
}

</script>
<? 
include ("../conectar7.php");
include ("../mysqli_result.php");
 ?>
<body>
<?

	$consulta="SELECT * FROM lote WHERE borrado=0 ORDER BY codlote ASC";
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nrs=mysqli_num_rows($rs_tabla);
?>
<div id="tituloForm2" class="header">
<div align="center">
<form id="form1" name="form1">
<? if ($nrs>0) { ?>
		<table class="fuente8" width="98%" cellspacing=0 cellpadding=7 border=0>
		  <tr>
			<td width="10%"><div align="center"><b>Codigo</b></div></td>
			<td width="60%"><div align="center"><b>Articulo asociado</b></div></td>
			<td width="20%"><div align="center"><b>Cantidad</b></div></td>
			<td width="20%"><div align="center"><b>Fecha de inicio</b></div></td>
			<td width="20%"><div align="center"><b>Hora de inicio</b></div></td>
			<td width="20%"><div align="center"><b>Fecha de finalizacion</b></div></td>
			<td width="20%"><div align="center"><b>hora de finalizacion</b></div></td>
			<td width="10%"><div align="center"></td>
		  </tr>
		<?php
			for ($i = 0; $i < mysqli_num_rows($rs_tabla); $i++) {
				$codlote=mysqli_result($rs_tabla,$i,"codlote");
				$codarticulo=mysqli_result($rs_tabla,$i,"codarticulo");
				$cantidad=mysqli_result($rs_tabla,$i,"cantidad");
                $fechai=mysqli_result($rs_tabla,$i,"fechai");
                $horai=mysqli_result($rs_tabla,$i,"horai");
                $fechaf=mysqli_result($rs_tabla,$i,"fechaf");
                $horaf=mysqli_result($rs_tabla,$i,"horaf");
				 if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }?>
						<tr class="<?php echo $fondolinea?>">
					<td>
        <div align="center"><?php echo $codlote;?></div></td>
					<td>
        <div align="left"><?php echo $codarticulo;?></div></td>
					<td>
        <div align="center"><?php echo $cantidad;?></div></td>
                    <td>
        <div align="center"><?php echo $fechai;?></div></td>
                    <td>
        <div align="center"><?php echo $horai;?></div></td>
                    <td>
        <div align="center"><?php echo $fechaf;?></div></td>
                    <td>
        <div align="center"><?php echo $horaf;?></div></td>
        
					<td align="center"><div align="center"><a href="javascript:pon_prefijo(<?php echo $codlote?>,'<?php echo $codarticulo?>','<?php echo $cantidad?>')"><img src="../img/convertir.svg" width="16px" height="16px" border="0" title="Seleccionar"></a></div></td>
				</tr>
			<?php }
		?>
  </table>
		<?php
		}  ?>
<iframe id="frame_datos" name="frame_datos" width="0%" height="0" frameborder="0">
	<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
</iframe>
<input type="hidden" id="accion" name="accion">
</form>
</div>
</div>
</body>
</html>
