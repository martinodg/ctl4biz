<?php
require_once("../conectar7.php");
require_once("../mysqli_result.php");
require_once("../funciones/fechas.php");
require_once("../funciones/changelanguage.php");
$lang = new ChangeLanguage();
$codfactura=$_GET["codfactura"];
$pagado=$_GET["pagado"];
$adevolver=$_GET["adevolver"];

$sel_facturas="SELECT * FROM facturas INNER JOIN cobros ON facturas.codfactura=cobros.codfactura INNER JOIN formapago ON cobros.codformapago=formapago.codformapago WHERE facturas.codfactura='$codfactura'";
$rs_factura=mysqli_query($conexion,$sel_facturas); 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ticket</title>
<script language="javascript">
function imprimir() {
	window.print();
	window.close();
}
</script>
</head>

<body onLoad="imprimir()">
<style type="text/css">
<!--
.Estilo3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
-->
</style>

<table width="85%" border="0">
  <tr>
    <td><span class="Estilo3"><?php echo $lang->t('codeka');?></span></td>
  </tr>
  <tr>
    <td><span class="Estilo3"><?php echo $lang->t('c_nro_ticket');?> </span></td>
  </tr>
  <tr>
    <td><span class="Estilo3"><?php echo $lang->t('tel');?>.: 0000000000 </span></td>
  </tr>
  <tr>
    <td><span class="Estilo3">00000-XXXXXXXX</span></td>
  </tr>
  <tr>
    <td><span class="Estilo3"><?php echo $lang->t('ticket_nro');?>.: <? echo $codfactura?></span></td>
  </tr>
  <tr>
    <td><span class="Estilo3"><?php echo $lang->tu('fecha');?>: <? echo implota(mysqli_result($rs_factura,0,"fechacobro"))?></span></td>
  </tr>
  <tr>
    <td><span class="Estilo3"><?php echo $lang->tu('form_pago');?>: <? echo mysqli_result($rs_factura,0,"nombrefp")?></span></td>
  </tr>
</table>
<table width="85%" border="0">
  <tr>
    <td width="12%" class="Estilo3"><div align="center"><?php echo $lang->tu('cant');?>.</div></td>
    <td width="64%" class="Estilo3"><div align="center"><?php echo $lang->tu('articulo');?></div></td>
    <td width="12%" class="Estilo3"><div align="center"><?php echo $lang->tu('precio_unitario');?></div></td>
    <td width="12%" class="Estilo3"><div align="center"><?php echo $lang->tu('importe');?></div></td>

  </tr>
<?

	$sel_lineas="SELECT factulinea.*,articulos.*,impuestos.valor AS alicuota FROM factulinea,articulos,impuestos WHERE factulinea.codfactura='$codfactura' AND factulinea.codigo=articulos.codarticulo AND impuestos.codimpuesto=factulinea.TAX ORDER BY factulinea.numlinea ASC";
  $rs_lineas=mysqli_query($conexion,$sel_lineas);
	$baseimponible=0;
  $totalImpuestos=0;
	for ($i = 0; $i < mysqli_num_rows($rs_lineas); $i++) { 	
		$descripcion=mysqli_result($rs_lineas,$i,"descripcion");
		$cantidad=mysqli_result($rs_lineas,$i,"cantidad");
		$precio=mysqli_result($rs_lineas,$i,"precio");
		$importe=$cantidad*$precio;
		$baseimponible=$baseimponible+$importe; 
    $alicuota=mysqli_result($rs_lineas,$i,"alicuota");
    $impuestosArticulo=($importe*$alicuota)/100;

    $totalImpuestos=$totalImpuestos+$impuestosArticulo;
    ?>
		<tr>
    		<td width="12%" class="Estilo3"><div align="center"><? echo $cantidad?></div></td>
			<td width="64%" class="Estilo3"><div align="center"><? echo substr($descripcion,0,25)?></div></td>
			<td width="12%" class="Estilo3"><div align="center"><? echo number_format($precio,2,",",".")?></div></td>
      <td width="12%" class="Estilo3"><div align="center"><? echo number_format($importe,2,",",".")?></div></td>

      </tr>
		<?
	}
$totalImpuestos=number_format($totalImpuestos,2,",",".");	
$totalAPagar=$totalImpuestos+$baseimponible;
$totalAPagar=number_format($totalAPagar,2,",",".");	
$baseimponible=number_format($baseimponible,2,",",".");	
?>
</table>
<table width="85%" border="0">
  <tr>
    <td class="Estilo3"><div align="right"><?php echo $lang->tc('gracias_visita');?>: <? echo $baseimponible?> <?php echo $lang->t('euros');?></div></td>
  </tr>
  <tr>
    <td class="Estilo3"><div align="right"><?php echo $lang->tc('total_impuestos');?>: <? echo $totalImpuestos?>  <?php echo $lang->t('euros');?></div></td>
  </tr>
  <tr>
    <td class="Estilo3"><div align="right"><?php echo $lang->tc('total_pagar');?>: <? echo $totalAPagar?>  <?php echo $lang->t('euros');?></div></td>
  </tr>
</table>
<br />
<table width="85%" border="0">
  <tr>
    <td class="Estilo3"><div align="left"><?php echo $lang->tc('pagado');?>: <? echo number_format($pagado,2,",",".")?>  <?php echo $lang->t('euros');?></div>      <div align="right"></div></td>
  </tr>
  
  <tr>
    <td class="Estilo3"><?php echo $lang->tc('a_devolver');?>: <? echo number_format($adevolver,2,",",".")?>  <?php echo $lang->t('euros');?></td>
  </tr>
</table>
<br />
<table width="85%" border="0">
  <tr>
    <td class="Estilo3"><div align="center"><?php echo $lang->tu('gracias_visita');?></div></td>
  </tr>
</table>
</body>
</html>