<?php
if(session_id() == '') {
    session_start();
}
$moneda= $_SESSION['company_currency_sign'];
require_once("../conectar7.php");
require_once("../mysqli_result.php");
require_once("../funciones/fechas.php");

$fechainicio=$_POST["fechainicio"];
if ($fechainicio<>"") { $fechainicio=explota($fechainicio); }

$cadena_busqueda=$_POST["cadena_busqueda"];

//$sel_facturas="SELECT max(codfactura) as maximo, min(codfactura) as minimo, sum(totalfactura) as totalfac FROM facturas WHERE fecha='$fechainicio'";
$sel_facturas="SELECT max(cobros.codfactura) as maximo, min(cobros.codfactura) as minimo, sum(totalfactura) as totalfac FROM cobros INNER JOIN facturas ON cobros.codfactura=facturas.codfactura WHERE fechacobro='$fechainicio'";
$rs_facturas=mysqli_query($conexion,$sel_facturas);

if (mysqli_num_rows($rs_facturas) > 0 ) {
	$minimo=mysqli_result($rs_facturas,0,"minimo");
	$maximo=mysqli_result($rs_facturas,0,"maximo");
	$total=mysqli_result($rs_facturas,0,"totalfac");
} else {
	$minimo=0;
	$maximo=0;
	$total=0;
}
$neto=$total/1.16;
$iva=$total-$neto;

$sel_cobros="SELECT sum(importe) as suma,codformapago FROM cobros WHERE fechacobro='$fechainicio' GROUP BY codformapago ORDER BY codformapago ASC";

$rs_cobros=mysqli_query($conexion,$sel_cobros);

if (mysqli_num_rows($rs_cobros) > 0) { $contado=mysqli_result($rs_cobros,0,"suma"); } else { $contado=0; }
if (mysqli_num_rows($rs_cobros) > 1) { $tarjeta=mysqli_result($rs_cobros,1,"suma"); } else { $tarjeta=0; }

?>
<html>
	<head>
		<title>Cierre Caja</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
		<script>
		
		var cursor;
		if (document.all) {
		// Est� utilizando EXPLORER
		cursor='hand';
		} else {
		// Est� utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		 function imprimir(fechainicio,minimo,maximo,neto,iva,total,contado,tarjeta) {
			location.href="../fpdf/cerrarcaja_html.php?fechainicio="+fechainicio+"&minimo="+minimo+"&maximo="+maximo+"&neto="+neto+"&iva="+iva+"&total="+total+"&contado="+contado+"&tarjeta="+tarjeta;	
		 }
		</script>
	</head>

	<body>	
		<div id="pagina">
			<div id="zonaContenido">
			<div align="center">
				<form id="formulario" name="formulario" method="post" action="rejilla.php" target="frame_rejilla">
					<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0>					
					  <tr>
                          <td width="18%"><span  id="tfchacja">Caja Fecha</span></td>
						  <td width="14%"><? echo implota($fechainicio)?>	</td>
						  <td width="12%">&nbsp;</td>
						  <td width="50%">&nbsp;</td>
						  <td width="6%">&nbsp;</td>
					  </tr>
					  <tr>
                          <td><span  id="tdelticktnro">Del ticket n&deg;</span></td>
						  <td><? echo $minimo?>	</td>
                          <td><span  id="taltktnro">al ticket n&deg;</span></td>
						  <td><? echo $maximo?></td>
						  <td>&nbsp;</td>
					  </tr>
					  <tr>
                          <td><span  id="tneto">Neto</span></td>
						  <td><? echo number_format($neto,2,",",".")?> <?echo $moneda;?></td>
						  <td></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					  <tr>
                          <td>16 % <span  id="tiva">IVA</span></td>
						  <td><? echo number_format($iva,2,",",".")?> <?echo $moneda;?></td>
						  <td></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					  <tr>
						  <td><span  id="ttotal">Total</span></td>
						  <td><? echo number_format($total,2,",",".")?> <?echo $moneda;?></td>
						  <td></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					  <tr>
                          <td><span  id="ttotalcdo">Total contado</span></td>
						  <td><? echo number_format($contado,2,",",".")?> <?echo $moneda;?></td>
						  <td></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					  <tr>
                          <td><span  id="ttotaltj">Total tarjetas</span></td>
						  <td><? echo number_format($tarjeta,2,",",".")?> <?echo $moneda;?></td>
						  <td></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					  <tr>
						  <td><span  id="ttotal">Total</span></td>
						  <td><? echo number_format($total,2,",",".")?> <?echo $moneda;?></td>
						  <td></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					</table>
			  </div>
			  <div id="botonBusqueda">
			  <button type="button" id="btnimprimir"  onClick="imprimir('<? echo $fechainicio?>','<? echo $minimo?>','<? echo $maximo?>','<? echo $neto?>','<? echo $iva?>','<? echo $total?>','<? echo $contado?>','<? echo $tarjeta?>')" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span  id="timpr">Imprimir</span> </button>
				</div>
			</div>	
		</div>
	</body>
</html>
