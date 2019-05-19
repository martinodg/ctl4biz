<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
?>
<html>
<head>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
</head>
<script language="javascript">

function pon_prefijo(pref,nombre) {
	parent.opener.document.formulario.codbatch.value=pref;
	parent.opener.document.formulario.desrcipcion.value=nombre;
	parent.window.close();
}

</script>
<? include ("../conectar7.php"); 
include ("../mysqli_result.php");?>
<body>
<?
	
	$consulta="SELECT * FROM batch WHERE borrado=0 ORDER BY codbatch ASC";
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nrs=mysqli_num_rows($rs_tabla);
?>
<div id="tituloForm2" class="header">
<div align="center">
<form id="form1" name="form1">
<? if ($nrs>0) { ?>
		<table class="fuente8" width="98%" cellspacing=0 cellpadding=5 border=0>
		  <tr>
			<td width="10%"><div align="center"><b>Codigo</b></div></td>
			<td width="60%"><div align="center"><b>Descripcion</b></div></td>
			<td width="20%"><div align="center"><b>Cantidad</b></div></td>
            <td width="20%"><div align="center"><b>Fecha de Inicio</b></div></td>
            <td width="20%"><div align="center"><b>Hora de Inicio</b></div></td>
			<td width="10%"><div align="center"></td>
		  </tr>
		<?php
			for ($i = 0; $i < mysqli_num_rows($rs_tabla); $i++) {
				$codbatch=mysqli_result($rs_tabla,$i,"codbatch");
				$descripcion=mysqli_result($rs_tabla,$i,"descripcion");
				$cantidad=mysqli_result($rs_tabla,$i,"cantidad");
                $fechai=mysqli_result($rs_tabla,$i,"fechai");
                $horai=mysqli_result($rs_tabla,$i,"horai");+
                

				 if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }?>
						<tr class="<?php echo $fondolinea?>">
					<td>
        <div align="center"><?php echo $codbatch;?></div></td>
					<td>
        <div align="left"><?php echo utf8_encode($descripcion);?></div></td>
					<td><div align="center"><?php echo $cantidad;?></div></td>
					<td align="center"><div align="center"><a href="javascript:pon_prefijo(<?php echo $codbatch?>,'<?php echo $descripcion?>')"><img src="../img/convertir.png" border="0" title="Seleccionar"></a></div></td>					
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
