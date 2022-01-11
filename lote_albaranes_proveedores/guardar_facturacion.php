<?
if(session_id() == '') {
    session_start();
}
$moneda= $_SESSION['company_currency_sign'];
require_once("../conectar7.php"); 
require_once("../mysqli_result.php");
require_once("../funciones/fechas.php"); 

$albaranes=$_POST["albaranes"];
$codproveedor=$_POST["codproveedor"];
$codfactura=$_POST["Afactura"];
$totalfactura=$_POST["totalfactura"];
$totalfacturasiniva=$_POST["totalfacturasiniva"];
$iva=$_POST["iva"];
$auxiva=$iva/100;
$totalfacturafinal=$totalfacturasiniva+($totalfacturasiniva*$auxiva);
$fecha=$_POST["fecha"];
$fecha=explota($fecha);


$query_comprobar="SELECT * FROM facturasp WHERE codfactura='$codfactura' AND codproveedor='$codproveedor'";
	$rs_comprobar=mysqli_query($conexion,$query_comprobar);
	if (mysqli_num_rows($rs_comprobar) > 0 ) {
			?><script>
				//alert ("No se puede dar de alta este numero de factura con este proveedor, ya existe uno en el sistema.");
                talert('msgvnmfacrep');
				location.href="index.php";
			</script><?
	} else {
	$ins_factura="INSERT INTO facturasp (codfactura,codproveedor,fecha,iva,estado,totalfactura,borrado) VALUES ('$codfactura','$codproveedor','$fecha','$iva',1,'$totalfacturafinal',0)";
	$rs_factura=mysqli_query($conexion,$ins_factura);
	
	$select_albaranes="SELECT * FROM albaranesp WHERE codalbaran IN (".$albaranes.") AND codproveedor='$codproveedor'";
	$rs_albaranes=mysqli_query($conexion,$select_albaranes); 
	
	$contador=0;
	
	while ($contador < mysqli_num_rows($rs_albaranes)) {
		$codalbaran=mysqli_result($rs_albaranes,$contador,"codalbaran");
		$iva=mysqli_result($rs_albaranes,$contador,"iva");
		$codproveedor=mysqli_result($rs_albaranes,$contador,"codproveedor");
		$totalalbaran=mysqli_result($rs_albaranes,$contador,"totalalbaran");
		$sel_lineas="SELECT * FROM albalineap WHERE codalbaran='$codalbaran' AND codproveedor='$codproveedor'";
		$rs_lineas=mysqli_query($conexion,$sel_lineas);
		$contador2=0;
		while ($contador2 < mysqli_num_rows($rs_lineas)) {
			$codfamilia=mysqli_result($rs_lineas,$contador2,"codfamilia");
			$codigo=mysqli_result($rs_lineas,$contador2,"codigo");
			$cantidad=mysqli_result($rs_lineas,$contador2,"cantidad");
			$precio=mysqli_result($rs_lineas,$contador2,"precio");
			$importe=mysqli_result($rs_lineas,$contador2,"importe");
			$dcto=mysqli_result($rs_lineas,$contador2,"dcto");
			$sel_insert="INSERT INTO factulineap (codfactura,codproveedor,numlinea,codfamilia,codigo,cantidad,precio,importe,dcto) VALUES 
			('$codfactura','$codproveedor','$numlinea','$codfamilia','$codigo','$cantidad','$precio','$importe','$dcto')";
			$rs_insert=mysqli_query($conexion,$sel_insert); 		
			$contador2++;
		}
		$contador++;
	}
	
	$act_alb="UPDATE albaranesp SET codfactura='$codfactura',estado=2 WHERE codalbaran IN (".$albaranes.") AND codproveedor='$codproveedor'";
	$rs_alb=mysqli_query($conexion,$act_alb);
	    //@todo analizar como traducir esto
		$cabecera1="Inicio >> Compras &gt;&gt; Facturar Albaranes ";
		$cabecera2="FACTURAR ALBARANES";
	?>
	
	<html>
		<head>
			<title>Principal</title>
			<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
            <script type="text/javascript" src="../jquery/jquery331.js"></script>
            <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
			<script language="javascript">
			
			var cursor;
			if (document.all) {
			// Está utilizando EXPLORER
			cursor='hand';
			} else {
			// Está utilizando MOZILLA/NETSCAPE
			cursor='pointer';
			}
			function aceptar() {
				location.href="index.php";
			}
			
			function imprimir(codfactura,codproveedor) {
				location.href="../fpdf/imprimir_factura_proveedor.php?codfactura="+codfactura+"&codproveedor="+codproveedor+"&lang="+getLanguajeCode();
			}
			
			</script>
		</head>
		<body>
			<div id="pagina">
				<div id="zonaContenido">
					<div align="center">
					<div id="tituloForm" class="header"><?php echo $cabecera2?></div>
					<div id="frmBusqueda">
						<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
							<tr>
								<td width="15%"></td>
								<td width="85%" colspan="2" class="mensaje"><?php echo $mensaje;?></td>
							</tr>
							<? 
							 $sel_cliente="SELECT * FROM proveedores WHERE codproveedor='$codproveedor'"; 
							  $rs_cliente=mysqli_query($conexion,$sel_cliente); ?>
							<tr>
								<td width="15%"><span  id="tprov">Proveedor</span></td>
								<td width="85%" colspan="2"><?php echo mysqli_result($rs_cliente,0,"nombre");?></td>
							</tr>
							<tr>
								<td width="15%"><span  id="tnip">NIF / CIF</span></td>
								<td width="85%" colspan="2"><?php echo mysqli_result($rs_cliente,0,"nif");?></td>
							</tr>
							<tr>
							  <td><span  id="tdireccion">Direcci&oacute;n</span></td>
							  <td colspan="2"><?php echo mysqli_result($rs_cliente,0,"direccion"); ?></td>
						  </tr>
							<tr>
							  <td><span  id="tcodfactura">C&oacute;digo de factura</span></td>
							  <td colspan="2"><?php echo $codfactura?></td>
						  </tr>
						  <tr>
							  <td><span  id="tfecha">Fecha</span></td>
							  <td colspan="2"><?php echo implota($fecha)?></td>
						  </tr>
						  <tr>
							  <td><span  id="tiva">IVA</span></td>
							  <td colspan="2"><?php echo $iva?> %</td>
						  </tr>
						  <tr>
							  <td></td>
							  <td colspan="2"></td>
						  </tr>
					  </table>
						 <table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
							<tr class="cabeceraTabla">
								<td width="5%"><span  id="titem">ITEM</span></td>
								<td width="20%"><span  id="tflia">FAMILIA</span></td>
								<td width="15%"><span  id="tcodigo">CODIGO</span></td>
								<td width="30%"><span  id="descri">descripcion</span></td>
								<td width="7%"><span  id="tcant">CANTIDAD</span></td>
								<td width="8%"><span  id="tprecio">PRECIO</span></td>
								<td width="7%"><span  id="tdctop">DCTO %</span></td>
								<td width="8%"><span  id="timporte">IMPORTE</span></td>
							</tr>
						</table>
						<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						  <? $sel_lineas="SELECT factulineap.*,articulos.*,familias.nombre as nombrefamilia FROM factulineap,articulos,familias WHERE factulineap.codfactura='$codfactura' AND factulineap.codproveedor='$codproveedor' AND factulineap.codigo=articulos.codarticulo AND factulineap.codfamilia=articulos.codfamilia AND articulos.codfamilia=familias.codfamilia ORDER BY factulineap.numlinea ASC";
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
								$baseimponible=$baseimponible+$importe;
								$descuento=mysqli_result($rs_lineas,$i,"dcto");
								if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; } ?>
										<tr class="<? echo $fondolinea?>">
											<td width="5%" class="aCentro"><? echo $i+1?></td>
											<td width="20%"><? echo $nombrefamilia?></td>
											<td width="15%"><? echo $codarticulo?></td>
											<td width="30%"><? echo $descripcion?></td>
											<td width="7%" class="aCentro"><? echo $cantidad?></td>
											<td width="8%" class="aCentro"><? echo $precio?></td>
											<td width="7%" class="aCentro"><? echo $descuento?></td>
											<td width="8%" class="aCentro"><? echo $importe?></td>
										</tr>
						<? } ?>
						</table>
				  </div>
					  <?
					  $baseimpuestos=$baseimponible*($iva/100);
					  $preciototal=$baseimponible+$baseimpuestos;
					  $preciototal=number_format($preciototal,2);
					  ?>
						<div id="frmBusqueda">
						<table width="25%" border=0 align="right" cellpadding=3 cellspacing=0 class="fuente8">
							<tr>
								<td width="15%"><span  id="tbaseimp">Base imponible</span></td>
								<td width="15%"><?php echo number_format($baseimponible,2).' '.$moneda;?></td>
							</tr>
							<tr>
								<td width="15%"><span  id="tiva">IVA</span></td>
								<td width="15%"><?php echo number_format($baseimpuestos,2).' '.$moneda;?></td>
							</tr>
							<tr>
								<td width="15%"><span  id="ttotal">Total</span></td>
								<td width="15%"><?php echo $preciototal.' '.$moneda;?></td>
							</tr>
						</table>
				  </div>
					<div id="botonBusqueda">
						<div align="center">
						        <button type="button" id="btnaceptar" onClick="aceptar()" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span  id="taceptar">Aceptar</span> </button>
                                <button type="button" id="btnimprimir"  onClick="imprimir('<? echo $codfactura?>',<? echo $codproveedor?>)" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span  id="timpr">Imprimir</span> </button>
							</div>
						</div>
				  </div>
			  </div>
			</div>
			<? } ?>
		</body>
	</html>
