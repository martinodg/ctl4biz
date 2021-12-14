<?
require_once("../conectar7.php"); 
require_once("../mysqli_result.php");
require_once("../funciones/fechas.php"); 

$accion=$_POST["accion"];
if (!isset($accion)) { $accion=$_GET["accion"]; }

$codalbarantmp=$_POST["codalbarantmp"];
$codcliente=$_POST["codcliente"];
$fecha=explota($_POST["fecha"]);
$iva=$_POST["iva"];
$minimo=0;

if ($accion=="alta") {
	$query_operacion="INSERT INTO albaranes (codalbaran, codfactura, fecha, iva, codcliente, estado, borrado) VALUES ('', '0', '$fecha', '$iva', '$codcliente', '1', '0')";					
	$rs_operacion=mysqli_query($conexion,$query_operacion);
	$codalbaran=mysqli_insert_id($conexion);
	if ($rs_operacion) { $mensaje="El albar&aacute;n ha sido dado de alta correctamente"; }
	$query_tmp="SELECT * FROM albalineatmp WHERE codalbaran='$codalbarantmp' ORDER BY numlinea ASC";
	$rs_tmp=mysqli_query($conexion,$query_tmp);
	$contador=0;
	$baseimponible=0;
	while ($contador < mysqli_num_rows($rs_tmp)) {
		$codfamilia=mysqli_result($rs_tmp,$contador,"codfamilia");
		$numlinea=mysqli_result($rs_tmp,$contador,"numlinea");
		$codigo=mysqli_result($rs_tmp,$contador,"codigo");
		$cantidad=mysqli_result($rs_tmp,$contador,"cantidad");
		$precio=mysqli_result($rs_tmp,$contador,"precio");
		$importe=mysqli_result($rs_tmp,$contador,"importe");
		$baseimponible=$baseimponible+$importe;
		$dcto=mysqli_result($rs_tmp,$contador,"dcto");
		$sel_insertar="INSERT INTO albalinea (codalbaran,numlinea,codfamilia,codigo,cantidad,precio,importe,dcto) VALUES 
		('$codalbaran','$numlinea','$codfamilia','$codigo','$cantidad','$precio','$importe','$dcto')";
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
	$baseimpuestos=$baseimponible*($iva/100);
	$preciototal=$baseimponible+$baseimpuestos;
	//$preciototal=number_format($preciototal,2);	
	$sel_act="UPDATE albaranes SET totalalbaran='$preciototal' WHERE codalbaran='$codalbaran'";
	$rs_act=mysqli_query($conexion,$sel_act);
	$baseimponible=0;
	$preciototal=0;
	$baseimpuestos=0;
	$cabecera1="Inicio >> Ventas &gt;&gt; Nuevo Albar&aacute;n ";
	$cabecera2='<span  id="tinsalbaran">INSERTAR ALBAR&Aacute;N</span>';
}

if ($accion=="modificar") {
	$codalbaran=$_POST["codalbaran"];
	$act_albaran="UPDATE albaranes SET codcliente='$codcliente', fecha='$fecha', iva='$iva' WHERE codalbaran='$codalbaran'";
	$rs_albaran=mysqli_query($conexion,$act_albaran);
	$sel_lineas = "SELECT codigo,codfamilia,cantidad FROM albalinea WHERE codalbaran='$codalbaran' order by numlinea";
	$rs_lineas = mysqli_query($conexion,$sel_lineas);
	$contador=0;
	while ($contador < mysqli_num_rows($rs_lineas)) {
		$codigo=mysqli_result($rs_lineas,$contador,"codigo");
		$codfamilia=mysqli_result($rs_lineas,$contador,"codfamilia");
		$cantidad=mysqli_result($rs_lineas,$contador,"cantidad");
		$sel_actualizar="UPDATE `articulos` SET stock=(stock+'$cantidad') WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_actualizar = mysqli_query($conexion,$sel_actualizar);
		$contador++;
	}
	$sel_borrar = "DELETE FROM albalinea WHERE codalbaran='$codalbaran'";
	$rs_borrar = mysqli_query($conexion,$sel_borrar);
	$sel_lineastmp = "SELECT * FROM albalineatmp WHERE codalbaran='$codalbarantmp' ORDER BY numlinea";
	$rs_lineastmp = mysqli_query($conexion,$sel_lineastmp);
	$contador=0;
	$baseimponible=0;
	while ($contador < mysqli_num_rows($rs_lineastmp)) {
		$numlinea=mysqli_result($rs_lineastmp,$contador,"numlinea");
		$codigo=mysqli_result($rs_lineastmp,$contador,"codigo");
		$codfamilia=mysqli_result($rs_lineastmp,$contador,"codfamilia");
		$cantidad=mysqli_result($rs_lineastmp,$contador,"cantidad");
		$precio=mysqli_result($rs_lineastmp,$contador,"precio");
		$importe=mysqli_result($rs_lineastmp,$contador,"importe");
		$baseimponible=$baseimponible+$importe;
		$dcto=mysqli_result($rs_lineastmp,$contador,"dcto");
	
		$sel_insert = "INSERT INTO albalinea (codalbaran,numlinea,codigo,codfamilia,cantidad,precio,importe,dcto) 
		VALUES ('$codalbaran','$numlinea','$codigo','$codfamilia','$cantidad','$precio','$importe','$dcto')";
		$rs_insert = mysqli_query($conexion,$sel_insert);
		
		$sel_actualiza="UPDATE articulos SET stock=(stock-'$cantidad') WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_actualiza = mysqli_query($conexion,$sel_actualiza);
		$sel_bajominimo = "SELECT codarticulo,codfamilia,stock,stock_minimo,descripcion FROM articulos WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_bajominimo= mysqli_query($conexion,$sel_bajominimo);
		$stock=mysqli_result($rs_bajominimo,0,"stock");
		$stock_minimo=mysqli_result($rs_bajominimo,0,"stock_minimo");
		$descripcion=mysqli_result($rs_bajominimo,0,"descripcion");
		
		if (($stock < $stock_minimo) or ($stock <= 0))
		   { 
			  $mensaje_minimo=$mensaje_minimo . " " . $descripcion."<br>";
			  $minimo=1;
		   };
		$contador++;
	}
	$baseimpuestos=$baseimponible*($iva/100);
	$preciototal=$baseimponible+$baseimpuestos;
	//$preciototal=number_format($preciototal,2);	
	$sel_act="UPDATE albaranes SET totalalbaran='$preciototal' WHERE codalbaran='$codalbaran'";
	$rs_act=mysqli_query($conexion,$sel_act);
	$baseimponible=0;
	$preciototal=0;
	$baseimpuestos=0;
	if ($rs_query) { $mensaje="Los datos del albar&aacute;n han sido modificados correctamente"; }
	$cabecera1="Inicio >> Ventas &gt;&gt; Modificar Albar&aacute;n ";
	$cabecera2='<span  id="tmalbaran">MODIFICAR ALBAR&Aacute;N</span>';
}

if ($accion=="baja") {
	$codalbaran=$_GET["codalbaran"];
	$query="UPDATE albaranes SET borrado=1 WHERE codalbaran='$codalbaran'";
	$rs_query=mysqli_query($conexion,$query);
	$query="SELECT * FROM albalinea WHERE codalbaran='$codalbaran' ORDER BY numlinea ASC";
	$rs_tmp=mysqli_query($conexion,$query);
	$contador=0;
	$baseimponible=0;
	while ($contador < mysqli_num_rows($rs_tmp)) {
		$codfamilia=mysqli_result($rs_tmp,$contador,"codfamilia");
		$codigo=mysqli_result($rs_tmp,$contador,"codigo");
		$cantidad=mysqli_result($rs_tmp,$contador,"cantidad");
		$sel_articulos="UPDATE articulos SET stock=(stock+'$cantidad') WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_articulos=mysqli_query($conexion,$sel_articulos);
		$contador++;
	}
	if ($rs_query) { $mensaje="El albar&aacute;n ha sido eliminado correctamente"; }
	$cabecera1="Inicio >> Ventas &gt;&gt; Eliminar Albar&aacute;n";
	$cabecera2='<span  id="eliminarRto">ELIMINAR ALBAR&Aacute;N</span>';
	$query_mostrar="SELECT * FROM albaranes WHERE codalbaran='$codalbaran'";
	$rs_mostrar=mysqli_query($conexion,$query_mostrar);
	$codcliente=mysqli_result($rs_mostrar,0,"codcliente");
	$fecha=mysqli_result($rs_mostrar,0,"fecha");
	$iva=mysqli_result($rs_mostrar,0,"iva");
}

if ($accion=="convertir") {
	$codalbaran=$_POST["codalbaran"];
	$fecha=$_POST["fecha"];
	$fecha=explota($fecha);
	$sel_albaran="SELECT * FROM albaranes WHERE codalbaran='$codalbaran'";
	$rs_albaran=mysqli_query($conexion,$sel_albaran);
	$iva=mysqli_result($rs_albaran,0,"iva");
	$codcliente=mysqli_result($rs_albaran,0,"codcliente");
	$totalfactura=mysqli_result($rs_albaran,0,"totalalbaran");
	$sel_factura="INSERT INTO facturas (codfactura,fecha,iva,codcliente,estado,totalfactura,borrado) VALUES 
		('','$fecha','$iva','$codcliente','1','$totalfactura','0')";
	$rs_factura=mysqli_query($conexion,$sel_factura);
	$codfactura=mysqli_insert_id($conexion);
	$act_albaran="UPDATE albaranes SET codfactura='$codfactura',estado='2' WHERE codalbaran='$codalbaran'";
	$rs_act=mysqli_query($conexion,$act_albaran);
	$sel_lineas="SELECT * FROM albalinea WHERE codalbaran='$codalbaran' ORDER BY numlinea ASC";
	$rs_lineas=mysqli_query($conexion,$sel_lineas);
	$contador=0;
	while ($contador < mysqli_num_rows($rs_lineas)) {
		$codfamilia=mysqli_result($rs_lineas,$contador,"codfamilia");
		$codigo=mysqli_result($rs_lineas,$contador,"codigo");
		$cantidad=mysqli_result($rs_lineas,$contador,"cantidad");
		$precio=mysqli_result($rs_lineas,$contador,"precio");
		$importe=mysqli_result($rs_lineas,$contador,"importe");
		$dcto=mysqli_result($rs_lineas,$contador,"dcto");
		$sel_insert="INSERT INTO factulinea (codfactura,numlinea,codfamilia,codigo,cantidad,precio,importe,dcto) VALUES 
			('$codfactura','','$codfamilia','$codigo','$cantidad','$precio','$importe','$dcto')";
		$rs_insert=mysqli_query($conexion,$sel_insert);
		$contador++;
	}
	$mensaje="El albar&aacute;n ha sido convertido correctamente";
	$cabecera1="Inicio >> Ventas &gt;&gt; Convertir Albar&aacute;n";
	$cabecera2='<span  id="tconvalbaran">CONVERTIR ALBAR&Aacute;N</span>';
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
		
		function aceptar() {
			location.href="index.php";
		}
		
		function imprimir(codalbaran) {
			window.open("../fpdf/imprimir_albaran.php?codalbaran="+codalbaran+"&lang="+getLanguajeCode());
		}
		
		function imprimirf(codfactura) {
			window.open("../fpdf/imprimir_factura.php?codfactura="+codfactura+"&lang="+getLanguajeCode());
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
                            <td width="85%" colspan="2" class="mensajeminimo" ><span  id="artbajomin"><span  id="tartimpmin">Los siguientes art&iacute;culos est&aacute;n bajo m&iacute;nimo</span>:</span><br><?php echo $mensaje_minimo;?></td>
					    </tr>
						<? } 
						 $sel_cliente="SELECT * FROM clientes WHERE codcliente='$codcliente'"; 
						  $rs_cliente=mysqli_query($conexion,$sel_cliente); ?>
						<tr>
                            <td width="15%"><span  id="cliente">Cliente</span></td>
							<td width="85%" colspan="2"><?php echo mysqli_result($rs_cliente,0,"nombre");?></td>
					    </tr>
						<tr>
                            <td width="15%"><span  id="nip">NIF / CIF</span></td>
						    <td width="85%" colspan="2"><?php echo mysqli_result($rs_cliente,0,"nif");?></td>
					    </tr>
						<tr>
                            <td><span  id="direccion">Direcci&oacute;n</span></td>
						  <td colspan="2"><?php echo mysqli_result($rs_cliente,0,"direccion"); ?></td>
					  </tr>
					  <? if ($accion=="convertir") { ?>
						<tr>
                            <td><span  id="codfactura">C&oacute;digo de factura</span></td>
						  <td colspan="2"><?php echo $codfactura?></td>
					  </tr>
					  <? } else { ?>
					  	<tr>
						  <td id="codalbaran"><span  id="tcodalbaran">C&oacute;digo de albar&aacute;n</span></td>
						  <td colspan="2"><?php echo $codalbaran?></td>
					  </tr>
					  <? } ?>
					  <tr>
                          <td><span  id="fecha">Fecha</span></td>
						  <td colspan="2"><?php echo implota($fecha)?></td>
					  </tr>
					  <tr>
                          <td><span  id="iva">IVA</span></td>
						  <td colspan="2"><?php echo $iva?> %</td>
					  </tr>
					  <tr>
						  <td></td>
						  <td colspan="2"></td>
					  </tr>
				  </table>
					 <table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="5%"><span  id="item">ITEM</span></td>
                            <td width="25%"><span  id="referenc">REFERENCIA</span></td>
                            <td width="30%"><span  id="descri">DESCRIPCION</span></td>
                            <td width="10%"><span  id="tcant">CANTIDAD</span></td>
                            <td width="10%"><span  id="precio">PRECIO</span></td>
                            <td width="10%"><span  id="dctop">DCTO %</span></td>
							<td width="10%"><span  id="importe">IMPORTE</span></td>
						</tr>
					</table>
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
					  <? $sel_lineas="SELECT albalinea.*,articulos.*,familias.nombre as nombrefamilia FROM albalinea,articulos,familias WHERE albalinea.codalbaran='$codalbaran' AND albalinea.codigo=articulos.codarticulo AND albalinea.codfamilia=articulos.codfamilia AND articulos.codfamilia=familias.codfamilia ORDER BY albalinea.numlinea ASC";
$rs_lineas=mysqli_query($conexion,$sel_lineas);
						for ($i = 0; $i < mysqli_num_rows($rs_lineas); $i++) {
							$numlinea=mysqli_result($rs_lineas,$i,"numlinea");
							$codfamilia=mysqli_result($rs_lineas,$i,"codfamilia");
							$nombrefamilia=mysqli_result($rs_lineas,$i,"nombrefamilia");
							$codarticulo=mysqli_result($rs_lineas,$i,"codarticulo");
							$referencia=mysqli_result($rs_lineas,$i,"referencia");
							$descripcion=mysqli_result($rs_lineas,$i,"descripcion");
							$cantidad=mysqli_result($rs_lineas,$i,"cantidad");
							$precio=mysqli_result($rs_lineas,$i,"precio");
							$importe=mysqli_result($rs_lineas,$i,"importe");
							$baseimponible=$baseimponible+$importe;
							$descuento=mysqli_result($rs_lineas,$i,"dcto");
							if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; } ?>
									<tr class="<? echo $fondolinea?>">
										<td width="5%" class="aCentro"><? echo $i+1?></td>
										<td width="20%"><? echo $referencia?></td>
										<td width="30%"><? echo $descripcion?></td>
										<td width="10%" class="aCentro"><? echo $cantidad?></td>
										<td width="10%" class="aCentro"><? echo $precio?></td>
										<td width="10%" class="aCentro"><? echo $descuento?></td>
										<td width="10%" class="aCentro"><? echo $importe?></td>
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
                            <td width="15%"><span  id="baseimp">Base imponible</span></td>
							<td width="15%"><?php echo number_format($baseimponible,2);?> &#8364;</td>
						</tr>
						<tr>
							<td width="15%"><span  id="iva">IVA</span></td>
							<td width="15%"><?php echo number_format($baseimpuestos,2);?> &#8364;</td>
						</tr>
						<tr>
                            <td width="15%"><span  id="total">Total</span></td>
							<td width="15%"><?php echo $preciototal?> &#8364;</td>
						</tr>
					</table>
			  </div>
				<div id="botonBusqueda">
					<div align="center">
					 <button type="button" id="btnaceptar" onClick="aceptar()" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span  id="aceptar">Aceptar</span> </button>
					  <? if ($accion=="convertir") { ?>
						<button type="button" id="btnimprimir"  onClick="imprimirf(<? echo $codfactura?>)" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span  id="impr">Imprimir</span> </button>
					   <? } else { ?>
						<button type="button" id="btnimprimir"  onClick="imprimir(<? echo $codalbaran?>)" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span  id="impr" >Imprimir</span> </button>
					   <? } ?>
				        </div>
					</div>
			  </div>
		  </div>
		</div>
	</body>
</html>
