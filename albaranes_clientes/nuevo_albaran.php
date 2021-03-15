<?php 
require_once("../conectar7.php"); 

$fechahoy=date("Y-m-d");
$sel_albaran="INSERT INTO albaranestmp (codalbaran,fecha) VALUE ('','$fechahoy')";
$rs_albaran=mysqli_query($conexion,$sel_albaran);
$codalbarantmp=mysqli_insert_id($conexion);
?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>
		<!-- <script type="text/JavaScript" language="javascript" src="../calendario/lang/calendar-sp.js"></script> -->
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar-setup.js"></script>
		<script language="javascript">
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		var miPopup
		function abreVentana(){
			miPopup = window.open("ver_clientes.php","miwin","width=700,height=380,scrollbars=yes");
			miPopup.focus();
		}
		
		function ventanaArticulos(){
			var codigo=document.getElementById("codcliente").value;
			if (codigo=="") {
			    //@todo Revisar la traduccion de esto
                talert('msgintcl')
			} else {
				miPopup = window.open("ver_articulos.php","miwin","width=700,height=500,scrollbars=yes");
				miPopup.focus();
			}
		}
		
		function validarcliente(){
			var codigo=document.getElementById("codcliente").value;
			miPopup = window.open("comprobarcliente.php?codcliente="+codigo,"frame_datos","width=700,height=80,scrollbars=yes");
		}	
		
		function cancelar() {
			location.href="index.php";
		}
		
		function limpiarcaja() {
			document.getElementById("nombre").value="";
			document.getElementById("nif").value="";
		}
		
		function actualizar_importe()
			{
				var precio=document.getElementById("precio").value;
				var cantidad=document.getElementById("cantidad").value;
				var descuento=document.getElementById("descuento").value;
				descuento=descuento/100;
				total=precio*cantidad;
				descuento=total*descuento;
				total=total-descuento;
				var original=parseFloat(total);
				var result=Math.round(original*100)/100 ;
				document.getElementById("importe").value=result;
			}
			
		function validar_cabecera()
			{
			    //@todo revisar si traducir esto
				var mensaje="";
				if (document.getElementById("nombre").value=="") mensaje+="  - Nombre\n";
				if (document.getElementById("fecha").value=="") mensaje+="  - Fecha\n";
				if (mensaje!="") {
					alert(getTranslationText('msgvgn')+":\n\n"+mensaje);
				} else {
					document.getElementById("formulario").submit();
				}
			}	
		
		function validar() 
			{
                //@todo revisar si traducir esto
				var mensaje="";
				var entero=0;
				var enteroo=0;
		
				if (document.getElementById("codarticulo").value=="") mensaje="  - Referencia\n";
				if (document.getElementById("descripcion").value=="") mensaje+="  - Descripcion\n";
				if (document.getElementById("precio").value=="") { 
							mensaje+="  - "+getTranslationText('vfprec')+"\n";
						} else {
							if (isNaN(document.getElementById("precio").value)==true) {
								mensaje+="  - "+getTranslationText('vprnm')+"\n";
							}
						}
				if (document.getElementById("cantidad").value=="") 
						{ 
						mensaje+="  - "+getTranslationText('vfc')+"\n";
						} else {
							enteroo=parseInt(document.getElementById("cantidad").value);
							if (isNaN(enteroo)==true) {
								mensaje+="  - "+getTranslationText('vcnm')+"\n";
							} else {
									document.getElementById("cantidad").value=enteroo;
								}
						}
				if (document.getElementById("descuento").value=="") 
						{ 
						document.getElementById("descuento").value=0 
						} else {
							entero=parseInt(document.getElementById("descuento").value);
							if (isNaN(entero)==true) {
								mensaje+="  - "+getTranslationText('vdcnm')+"\n";
							} else {
								document.getElementById("descuento").value=entero;
							}
						} 
				if (document.getElementById("importe").value=="") mensaje+="  - "+getTranslationText('msgfimp')+"\n";
				
				if (mensaje!="") {
					alert(getTranslationText('msgvgn')+"\n\n"+mensaje);
				} else {
					document.getElementById("baseimponible").value=parseFloat(document.getElementById("baseimponible").value) + parseFloat(document.getElementById("importe").value);	
					cambio_iva();
					document.getElementById("formulario_lineas").submit();
					document.getElementById("referencia").value="";
					document.getElementById("descripcion").value="";
					document.getElementById("precio").value="";
					document.getElementById("cantidad").value=1;
					document.getElementById("importe").value="";
					document.getElementById("descuento").value=0;						
				}
			}
			
		function cambio_iva() {
			var original=parseFloat(document.getElementById("baseimponible").value);
			var result=Math.round(original*100)/100 ;
			document.getElementById("baseimponible").value=result;
			document.getElementById("baseimpuestos").value=parseFloat(result * parseFloat(document.getElementById("iva").value / 100));
			var original1=parseFloat(document.getElementById("baseimpuestos").value);
			var result1=Math.round(original1*100)/100 ;
			document.getElementById("baseimpuestos").value=result1;
			var original2=parseFloat(result + result1);
			var result2=Math.round(original2*100)/100 ;
			document.getElementById("preciototal").value=result2;
		}	
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
                    <div id="tituloForm" class="header"><span id="calbaran">CREAR ALBAR&Aacute;N</span></div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_albaran.php">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
                            <td width="15%"><span id="cod_cliente">C&oacute;digo Cliente</span></td>
					      <td colspan="3"><input NAME="codcliente" type="text" class="cajaPequena" id="codcliente" size="6" maxlength="5" onClick="limpiarcaja()">
					        <img src="../img/ver.svg" width="16" height="16" onClick="abreVentana()" data-ttitle="bcliente" title="Buscar cliente" onMouseOver="style.cursor=cursor"> <img src="../img/cliente.svg" width="16" height="16" onClick="validarcliente()" data-ttitle="tvalclt" title="Validar cliente" onMouseOver="style.cursor=cursor"></td>
						</tr>
						<tr>
                            <td width="6%"><span id="nombre2">Nombre</span></td>
						    <td width="27%"><input NAME="nombre" type="text" class="cajaGrande" id="nombre" size="45" maxlength="45" readonly></td>
                            <td width="3%"><span id="nip">NIF</span></td>
				            <td width="64%"><input NAME="nif" type="text" class="cajaMedia" id="nif" size="20" maxlength="15" readonly></td>
						</tr>
						<? $hoy=date("d/m/Y"); ?>
						<tr>
							<td width="6%"><span id="fecha2">Fecha</span></td>
						    <td width="27%"><input NAME="fecha" type="text" class="cajaPequena" id="fecha" size="10" maxlength="10" value="<? echo $hoy?>" readonly> <img src="../img/calendario.svg" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fecha",
					ifFormat   : "%d/%m/%Y",
					button     : "Image1"
					  }
					);
		</script></td>
				            <td width="3%"><span id="tiva">IVA</span></td>
				            <td width="64%"><input NAME="iva" type="text" class="cajaPequena" id="iva" size="5" maxlength="5" value="16" onChange="cambio_iva()"> %</td>
						</tr>
					</table>										
			  </div>
			  <input id="codalbarantmp" name="codalbarantmp" value="<? echo $codalbarantmp?>" type="hidden">
			  <input id="baseimpuestos2" name="baseimpuestos" value="<? echo $baseimpuestos?>" type="hidden">
			  <input id="baseimponible2" name="baseimponible" value="<? echo $baseimponible?>" type="hidden">
			  <input id="preciototal2" name="preciototal" value="<? echo $preciototal?>" type="hidden">
			  <input id="accion" name="accion" value="alta" type="hidden">
			  </form>
			  <br>
			  <div id="frmBusqueda">
				<form id="formulario_lineas" name="formulario_lineas" method="post" action="frame_lineas.php" target="frame_lineas">
				<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
				  <tr>
					<td width="11%"><span id="refren">Referencia</span></td>
					<td colspan="10"><input NAME="referencia" type="text" class="cajaMedia" id="referencia" size="15" maxlength="15" readonly> <img src="../img/ver.svg" width="16" height="16" onClick="ventanaArticulos()" onMouseOver="style.cursor=cursor" title="Buscar articulos"></td>
				  </tr>
				  <tr>
                    <td><span id="descri">Descripción</span></td>
					<td width="19%"><input NAME="descripcion" type="text" class="cajaMedia" id="descripcion" size="30" maxlength="30" readonly></td>
                    <td width="5%"><span id="precio2">Precio</span></td>
					<td width="11%"><input NAME="precio" type="text" class="cajaPequena" id="precio" size="10" maxlength="10" onChange="actualizar_importe()"> &#8364;</td>
                    <td width="5%"><span id="cant2">Cantidad</span></td>
					<td width="5%"><input NAME="cantidad" type="text" class="cajaMinima" id="cantidad" size="10" maxlength="10" value="1" onChange="actualizar_importe()"></td>
                    <td width="4%"><span id="dcto">Dcto.</span></td>
					<td width="9%"><input NAME="descuento" type="text" class="cajaMinima" id="descuento" size="10" maxlength="10" onChange="actualizar_importe()"> %</td>
					<td width="5%"><span id="importe2">Importe</span></td>
					<td width="11%"><input NAME="importe" type="text" class="cajaPequena" id="importe" size="10" maxlength="10" value="0" readonly> &#8364;</td>
					<td width="15%"><button type="button" id="btnagregar" onClick="validar()"  onMouseOver="style.cursor=cursor"> <img src="../img/agregar.svg" alt="agregar" /> <span id="agregar">Agregar</span> </button></td>
				  </tr>
				</table>
				</div>
				<input name="codarticulo" value="<? echo $codarticulo?>" type="hidden" id="codarticulo">
				<br>
				<div id="frmBusqueda">
				<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
                            <td width="5%"><span id="titem">ITEM</span></td>
							<td width="26%"><span id="treferenc">REFERENCIA</span></td>
                            <td width="35%"><span id="tdescri">DESCRIPCION</span></td>
                            <td width="8%"><span id="tcant">CANTIDAD</span></td>
                            <td width="8%"><span id="tprecio">PRECIO</span></td>
                            <td width="7%"><span id="tdctop">DCTO %</span></td>
                            <td width="8%"><span id="timporte">IMPORTE</span></td>
							<td width="3%">&nbsp;</td>
						</tr>
				</table>
				<div id="lineaResultado">
					<iframe width="100%" height="250" id="frame_lineas" name="frame_lineas" frameborder="0">
						<ilayer width="100%" height="250" id="frame_lineas" name="frame_lineas"></ilayer>
					</iframe>
				</div>					
			  </div>
			  <div id="frmBusqueda">
			<table width="25%" border=0 align="right" cellpadding=3 cellspacing=0 class="fuente8">
			  <tr>
			    <td width="27%" class="busqueda"><span id="subtotal">Subtotal</span></td>
				<td width="73%" align="right"><div align="center">
			      <input class="cajaTotales" name="baseimponible" type="text" id="baseimponible" size="12" value=0 align="right" readonly> 
		        &#8364;</div></td>
			  </tr>
			  <tr>
				<td class="busqueda"><span id="iva2">IVA</span></td>
				<td align="right"><div align="center">
			      <input class="cajaTotales" name="baseimpuestos" type="text" id="baseimpuestos" size="12" align="right" value=0 readonly> 
		        &#8364;</div></td>
			  </tr>
			  <tr>
                  <td class="busqueda"><span id="tpciototal">Precio Total</span></td>
				<td align="right"><div align="center">
			      <input class="cajaTotales" name="preciototal" type="text" id="preciototal" size="12" align="right" value=0 readonly> 
		        &#8364;</div></td>
			  </tr>
		</table>
			  </div>
				<div id="botonBusqueda">					
				  <div align="center">
				    <button type="button" id="btnaceptar" onClick="validar_cabecera()" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span id="taceptar">Aceptar</span> </button>
					<button type="button" id="btncancelar"  onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/cancelar.svg" alt="cancelar" /> <span id="tcancelar">Cancelar</span> </button>
				    <input id="codfamilia" name="codfamilia" value="<? echo $codfamilia?>" type="hidden">
				    <input id="codalbarantmp" name="codalbarantmp" value="<? echo $codalbarantmp?>" type="hidden">				    
			      </div>
				</div>
			  		<iframe id="frame_datos" name="frame_datos" width="0" height="0" frameborder="0">
					<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
					</iframe>
			  </form>
			 </div>
		  </div>
		</div>
	</body>
</html>
