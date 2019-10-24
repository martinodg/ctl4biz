<?php 
include ("../conectar7.php"); 

$fechahoy=date("Y-m-d");
$sel_proc="INSERT INTO procesostmp (codproceso,fecha) VALUE ('','$fechahoy')";
$rs_proc=mysqli_query($conexion,$sel_proc);
$codprocesotmp=mysqli_insert_id($conexion);
?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>
		<script type="text/JavaScript" language="javascript" src="../calendario/lang/calendar-sp.js"></script>
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
			miPopup = window.open("ver_empleados.php","miwin","width=700,height=380,scrollbars=yes");
			miPopup.focus();
		}
		
		function ventanaArticulos(){
			var codigo=document.getElementById("codcliente").value;
			if (codigo=="") {
				alert ("Debe introducir el codigo del cliente");
			} else {
				miPopup = window.open("ver_articulos.php","miwin","width=700,height=500,scrollbars=yes");
				miPopup.focus();
			}
		}
		function VentanaBatch(){
			miPopup = window.open("ver_batch.php","miwin","width=700,height=380,scrollbars=yes");
			miPopup.focus();
		}
		function validarbatch(){
			var codigo=document.getElementById("codbatch").value;
			miPopup = window.open("comprobarbatch.php?codbatch="+codigo,"frame_datos","width=700,height=80,scrollbars=yes");
		}
        function validarestacion(){
			var codigo=document.getElementById("codestacion").value;
			miPopup = window.open("comprobarestacion.php?codestacion="+codigo,"frame_datos","width=700,height=80,scrollbars=yes");
		}
        function validarempleado(){
			var codigo=document.getElementById("codempleado").value;
			miPopup = window.open("comprobarempleado.php?codempleado="+codigo,"frame_datos","width=700,height=80,scrollbars=yes");
		}
		function validarArticulo(){
			var codigo=document.getElementById("codbarras").value;
			miPopup = window.open("comprobararticulo.php?codbarras="+codigo,"frame_datos","width=700,height=80,scrollbars=yes");
		}		
		
		function cancelar() {
			location.href="index.php";
		}
		
		function limpiarcaja() {
			document.getElementById("nombre").value="";
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
				var mensaje="";
				if (document.getElementById("nombre").value=="") mensaje+="  - Nombre\n";
				if (document.getElementById("fecha").value=="") mensaje+="  - Fecha\n";
				if (mensaje!="") {
					alert("Atencion, se han detectado las siguientes incorrecciones:\n\n"+mensaje);
				} else {
					document.getElementById("formulario").submit();
				}
			}	
		
		function validar() 
			{
				var mensaje="";
				var entero=0;
				var enteroo=0;
		
				if (document.getElementById("codbarras").value=="") mensaje="  - Codigo de barras\n";
				if (document.getElementById("descripcion").value=="") mensaje+="  - Descripcion\n";
				if (document.getElementById("precio").value=="") { 
							mensaje+="  - Falta el precio\n"; 
						} else {
							if (isNaN(document.getElementById("precio").value)==true) {
								mensaje+="  - El precio debe ser numerico\n";
							}
						}
				if (document.getElementById("cantidad").value=="") 
						{ 
						mensaje+="  - Falta la cantidad\n";
						} else {
							enteroo=parseInt(document.getElementById("cantidad").value);
							if (isNaN(enteroo)==true) {
								mensaje+="  - La cantidad debe ser numerica\n";
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
								mensaje+="  - El descuento debe ser numerico\n";
							} else {
								document.getElementById("descuento").value=entero;
							}
						} 
				if (document.getElementById("importe").value=="") mensaje+="  - Falta el importe\n";
				
				if (mensaje!="") {
					alert("Atencion, se han detectado las siguientes incorrecciones:\n\n"+mensaje);
				} else {
					document.getElementById("baseimponible").value=parseFloat(document.getElementById("baseimponible").value) + parseFloat(document.getElementById("importe").value);	
					cambio_iva();
					document.getElementById("formulario_lineas").submit();
					document.getElementById("codbarras").value="";
					document.getElementById("descripcion").value="";
					document.getElementById("precio").value="";
					document.getElementById("cantidad").value=1;
					document.getElementById("importe").value="";
					document.getElementById("descuento").value=0;						
				}
			}
		
		function inicio() {
			document.getElementById("codcliente").value="1";
			document.getElementById("nombre").value="Venta Mostrador";
			document.getElementById("codbarras").focus();
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
		</script>
	</head>
	<body onload=inicio()>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">NUEVO PROCESO #<? echo $codprocesotmp;?></div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_proceso.php">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="15%">C&oacute;digo de Batch </td>
					      <td colspan="3"><input NAME="codbatch" type="text" class="cajaMediana" id="codbatch" size="6" maxlength="5" onClick="limpiarcaja()">
					        <img src="../img/ver.svg" width="16" height="16" onClick="VentanaBatch()" title="Buscar Batch" onMouseOver="style.cursor=cursor"> <img src="../img/batch.png" width="16" height="16" onClick="validarbatch()" title="Validar batch" onMouseOver="style.cursor=cursor"></td>					
						</tr>
                        <tr>
							<td width="15%">C&oacute;digo de Estacion de trabajo </td>
					      <td colspan="3"><input NAME="codestacion" type="text" class="cajaPequena" id="codestacion" size="6" maxlength="5" onClick="limpiarcaja()">
					        <img src="../img/ver.svg" width="16" height="16" onClick="abreVentana()" title="Buscar estacion de trabajo" onMouseOver="style.cursor=cursor"> <img src="../img/workbench.png" width="16" height="16" onClick="validarestacion()" title="Validar estacion" onMouseOver="style.cursor=cursor"></td>					
						</tr>
                        <tr>
							<td width="15%">C&oacute;digo de Empleado </td>
					      <td colspan="3"><input NAME="codempleado" type="text" class="cajaPequena" id="codempleado" size="6" maxlength="5" onClick="limpiarcaja()">
					        <img src="../img/ver.svg" width="16" height="16" onClick="abreVentana()" title="Buscar empleado" onMouseOver="style.cursor=cursor"> <img src="../img/cliente.svg" width="16" height="16" onClick="validarempleado()" title="Validar empleado" onMouseOver="style.cursor=cursor"></td>					
						</tr>
						<tr>
							<td width="6%">Decripcion del Proceso </td>
						    <td width="27%"><input NAME="descripcion" type="text" class="cajaGrande" id="descripcion" size="45" maxlength="45" readonly></td>
				            <td width="3%"></td>
				            <td width="64%"></td>
						</tr>
						<? $hoy=date("d/m/Y"); ?>
						<tr>
							<td width="6%">Fecha de Inicio</td>
						    <td width="27%"><input NAME="fechai" type="text" class="cajaPequena" id="fechai" size="10" maxlength="10" value="<? echo $hoy?>" readonly> <img src="../img/calendario.svg" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fecha",
					ifFormat   : "%d/%m/%Y",
					button     : "Image1"
					  }
					);
		</script></td>
                            <? $hora=date("H:i:s", time()); ?>
				            <td width="10%">Hora de inicio</td>
				            <td width="27%"><input NAME="horai" type="text" class="cajaPequena" id="horai" size="10" maxlength="10" value="<? echo $hora;?>" onChange="cambio_horai()"></td>
						</tr>
					</table>										
			  </div>
			  <input id="codprocesotmp" name="codprocesotmp" value="<? echo $codprocesotmp?>" type="hidden">
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
                    <td width="11%">Materias primas del proceso </td>
                </tr>
                <tr>
					<td width="11%">Codigo barras </td>
					<td colspan="10" valign="middle"><input NAME="codbarras" type="text" class="cajaMedia" id="codbarras" size="15" maxlength="15"> <img src="../img/calculadora.svg" border="1" align="absmiddle" onClick="validarArticulo()" onMouseOver="style.cursor=cursor" title="Validar codigo de barras">     <img src="../img/ver.svg" width="16" height="16" onClick="ventanaArticulos()" onMouseOver="style.cursor=cursor" title="Buscar articulo"></td>
				  </tr>
				  <tr>
					<td>Descripcion</td>
					<td width="19%"><input NAME="descripcion" type="text" class="cajaMedia" id="descripcion" size="30" maxlength="30" readonly></td>
					<td width="5%">Cantidad</td>
					<td width="5%"><input NAME="cantidad" type="text" class="cajaMinima" id="cantidad" size="10" maxlength="10" value="1" onChange="actualizar_importe()"></td>
					
				    <td width="15%"><img src="../img/botonagregar.jpg" border="1" align="absbottom" onClick="validar()" onMouseOver="style.cursor=cursor"></td>
				  </tr>
				</table>
				</div>
				<br>
				<div id="frmBusqueda">
				<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="5%">ITEM</td>
							<td width="12%">FAMILIA</td>
							<td width="14%">DESCRIPCION</td>
							<td width="8%">CANTIDAD</td>
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
			
			  </div>
				<div id="botonBusqueda">					
				  <div align="center">
				    <img src="../img/botoninicio.jpg" width="85" height="22" onClick="validar_cabecera()" border="1" onMouseOver="style.cursor=cursor">
                    <img src="../img/botonfinalizar.jpg" width="85" height="22" onClick="validar_cabecera()" border="1" onMouseOver="style.cursor=cursor">
					<img src="../img/botoncancelar.jpg" width="85" height="22" onClick="cancelar()" border="1" onMouseOver="style.cursor=cursor">
				    <input id="codfamilia" name="codfamilia" value="<? echo $codfamilia?>" type="hidden">
				    <input id="codprocesotmp" name="codprocesotmp" value="<? echo $codprocesotmp?>" type="hidden">	
					<input id="preciototal2" name="preciototal" value="<? echo $preciototal?>" type="hidden">			    
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
