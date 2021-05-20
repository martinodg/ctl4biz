<?
require_once("../conectar7.php"); 
require_once("../mysqli_result.php");
require_once("../funciones/fechas.php"); 

$accion=$_POST["accion"];
if (!isset($accion)) { $accion=$_GET["accion"]; }

$codfacturatmp=$_POST["codfacturatmp"];
$codcliente=$_POST["codcliente"];
$fecha=$_POST["fecha"];
$baseimponible=$_POST["baseimponible2"];
$impuestos=$_POST["baseimpuestos2"];
$total=$_POST["preciototal2"];
$minimo=0;
$mensaje_minimo="";

if ($accion=="alta") {
	$query_operacion="INSERT INTO facturas (codfactura, fecha, impuestos, totalfactura, codcliente, estado, borrado) VALUES ('', '$fecha', '$impuestos', '$total', '$codcliente', '1', '0')";					
	$rs_operacion=mysqli_query($conexion,$query_operacion);
	$codfactura=mysqli_insert_id($conexion);
	if ($rs_operacion) { $mensaje="La factura ha sido dada de alta correctamente"; }
	$query_tmp="SELECT * FROM factulineatmp WHERE codfactura='$codfacturatmp' ORDER BY numlinea ASC";
	$rs_tmp=mysqli_query($conexion,$query_tmp);
	$contador=0;
	while ($contador < mysqli_num_rows($rs_tmp)) {
		$codfamilia=mysqli_result($rs_tmp,$contador,"codfamilia");
		$numlinea=mysqli_result($rs_tmp,$contador,"numlinea");
		$codigo=mysqli_result($rs_tmp,$contador,"codigo");
		$cantidad=mysqli_result($rs_tmp,$contador,"cantidad");
		$precio=mysqli_result($rs_tmp,$contador,"precio");
		$importe=mysqli_result($rs_tmp,$contador,"importe");
		$dcto=mysqli_result($rs_tmp,$contador,"dcto");
		$tax=mysqli_result($rs_tmp,$contador,"TAX");
		$sel_insertar="INSERT INTO factulinea (codfactura,numlinea,codfamilia,codigo,cantidad,precio,importe,dcto,TAX) VALUES 
		('$codfactura','$numlinea','$codfamilia','$codigo','$cantidad','$precio','$importe','$dcto','$tax')";
		$rs_insertar=mysqli_query($conexion,$sel_insertar);		
		$sel_articulos="UPDATE articulos SET stock=(stock-'$cantidad') WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_articulos=mysqli_query($conexion,$sel_articulos);
		$sel_minimos = "SELECT stock,stock_minimo,descripcion FROM articulos where codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_minimos= mysqli_query($conexion,$sel_minimos);
		if ((mysqli_result($rs_minimos,0,"stock") < mysqli_result($rs_minimos,0,"stock_minimo")) or (mysqli_result($rs_minimos,0,"stock") <= 0))
	   		{ 
		  		$mensaje_minimo=$mensaje_minimo . " " . mysqli_result($rs_minimos,0,"descripcion")."<br>";
				$minimo=1;
   			};
		$contador++;
	}

	$cabecera1="Inicio >> Ventas &gt;&gt; Venta Mostrador ";
	$cabecera2="NUEVA VENTA ";
}

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
		$( document ).ready(function(){
			//call function to get invoice lines
			var nrofact=$("#")
			getInvoiceLines('Invoice',$codfactura);

		}
		function aceptar() {
			location.href="index.php";
		}
		
		function imprimir(codfactura) {
			window.open("../fpdf/imprimir_factura.php?codfactura="+codfactura);
		}
		
		function efectuarpago(codfactura,codcliente,importe) {
			miPopup = window.open("efectuarpago.php?codfactura="+codfactura+"&codcliente="+codcliente+"&importe="+importe,"miwin","width=500,height=360,scrollbars=yes");			
		}
		function getInvoiceLines(d_type,id_invoice) {	
			alert("entro en getinvocelines");
			$.get( "../funciones/BackendQueries/getInvoiceLines.php" , 
					{ 
						docType: d_type,
						idInvoice: id_invoice                                                
					},
					function ( data ) { 
                            $('#div_datos').html( data );
                    }
            );
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
						<? if ($minimo==1) { ?>
						<tr>
							<td width="15%"></td>
							<td width="85%" colspan="2" class="mensajeminimo"><span id="tartimpmin">Los siguientes art&iacute;culos est&aacute;n bajo m&iacute;nimo</span>:<br><?php echo $mensaje_minimo;?></td>
					    </tr>
						<? } 
						 $sel_cliente="SELECT * FROM clientes WHERE codcliente='$codcliente'"; 
						  $rs_cliente=mysqli_query($conexion,$sel_cliente); ?>
						<tr>
							<td width="15%"><span id="tcliente">Cliente</span></td>
							<td width="85%" colspan="2"><?php echo mysqli_result($rs_cliente,0,"nombre");?></td>
					    </tr>
						<tr>
							<td width="15%"><span id="tnip">NIF / CIF</span></td>
						    <td width="85%" colspan="2"><?php echo mysqli_result($rs_cliente,0,"nif");?></td>
					    </tr>
						<tr>
						  <td><span id="tdireccion">Direcci&oacute;n</span></td>
						  <td colspan="2"><?php echo mysqli_result($rs_cliente,0,"direccion"); ?></td>
					  </tr>
						<tr>
						  <td><span id="tcodfactura">C&oacute;digo de factura</span></td>
						  <td colspan="2"><?php echo $codfactura?></td>
					  </tr>
					  <tr>
						  <td><span id="tfecha">Fecha</span></td>
						  <td colspan="2"><?php echo implota($fecha)?></td>
					  </tr>
					  <tr>
						  <td></td>
						  <td colspan="2"></td>
					  </tr>
				  </table>
				  
					 <table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="5%"><span id="titem">ITEM</span></td>
							<td width="20%"><span id="tflia">FAMILIA</span></td>
							<td width="15%"><span id="referenc">REFERENCIA</span></td>
							<td width="30%"><span id="descri">descripcion</span></td>
							<td width="7%"><span id="tcant">CANTIDAD</span></td>
							<td width="8%"><span id="tprecio">PRECIO</span></td>
							<td width="7%"><span id="tdctop">DCTO %</span></td>
							<td width="8%"><span id="timporte">IMPORTE</span></td>
						</tr>
					</table>
					<div id="div_datos"></div>
				
			  </div>
				 
					<div id="frmBusqueda">
					<table width="25%" border=0 align="right" cellpadding=3 cellspacing=0 class="fuente8">
						<tr>
							<td width="15%"><span id="tbaseimp">Base imponible</span></td>
							<td width="15%"><?php echo $baseimponible;?> &#8364;</td>
						</tr>
						<tr>
							<td width="15%"><span id="tiva">IVA</span></td>
							<td width="15%"><?php echo $impuestos;?> &#8364;</td>
						</tr>
						<tr>
							<td width="15%"><span id="ttotal">Total</span></td>
							<td width="15%"><?php echo $total;?> &#8364;</td>
						</tr>
					</table>
			  </div>
				<div id="botonBusqueda">
					<div align="center">
					  <button type="button" id="btnaceptar" onClick="aceptar()" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span id="taceptar">Aceptar</span> </button>
					   <button type="button" id="btnimprimir"  onClick="imprimir(<? echo $codfactura?>)" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span id="timpr">Imprimir</span> </button>
				        </div>
						<br>
						<div align="center" id="cajareg">
					  <img src="../img/caja.jpg" width="80" height="77" border="1" onClick="efectuarpago(<? echo $codfactura?>,<? echo $codcliente?>,<? echo $preciototal?>)" onMouseOver="style.cursor=cursor" data-ttitle="efcpag" title="Efectuar pago">
				        </div>
					</div>
			  </div>
		  </div>
		</div>
	</body>
</html>
