<?php
require_once("../conectar7.php");
$id_resource='8';
$id_sresource='30';
require_once("../racf/purePhpVerify.php");

$hoy=date("d/m/Y");
?>
<html>
	<head>
		<title>Restaurar copia de seguridad</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>
		<!-- <script type="text/JavaScript" language="javascript" src="../calendario/lang/calendar-sp.js"></script> -->
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar-setup.js"></script>
		<script language="javascript">
		
		function inicio() {
			document.getElementById("form_busqueda").submit();
		}
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		function buscar() {
			var cadena;
			cadena=hacer_cadena_busqueda();
			document.getElementById("cadena_busqueda").value=cadena;
			if (document.getElementById("iniciopagina").value=="") {
				document.getElementById("iniciopagina").value=1;
			} else {
				document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
			}
			document.getElementById("form_busqueda").submit();
		}
		
		function imprimir() {
			var fechainicio=document.getElementById("fechainicio").value;
			var fechafin=document.getElementById("fechafin").value;
			var denominacion=document.getElementById("denominacion").value;
			window.open("../fpdf/copiasseguridad.php?fechainicio="+fechainicio+"&denominacion="+denominacion+"&fechafin="+fechafin);
		}
		
		function paginar() {
			document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
			document.getElementById("form_busqueda").submit();
		}
		
		function hacer_cadena_busqueda() {
			var fechainicio=document.getElementById("fechainicio").value;
			var fechafin=document.getElementById("fechafin").value;
			var denominacion=document.getElementById("denominacion").value;
			var cadena="";
			cadena="~"+fechainicio+"~"+denominacion+"~"+fechafin+"~";
			return cadena;
			}
			
		function limpiar() {
			document.getElementById("form_busqueda").reset();
		}
		</script>
	</head>
	<body onLoad="inicio()">
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">Buscar COPIAS DE SEGURIDAD</div>
				<div id="frmBusqueda">
				<form id="form_busqueda" name="form_busqueda" method="post" action="rejilla_restaurar.php" target="frame_rejilla">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>					
						<tr>
						  <td><span  id="tfechin">Fecha de inicio</span></td>
						  <td><input id="fechainicio" type="text" class="cajaPequena" NAME="fechainicio" maxlength="10" value="<? echo $hoy?>" readonly><img src="../img/calendario.svg" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'" data-ttitle="cal" title="Calendario">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fechainicio",
					ifFormat   : "%d/%m/%Y",
					button     : "Image1"
					  }
					);
		</script>	</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					  <tr>
						  <td><span  id="tfchafin">Fecha de fin</span></td>
						  <td><input id="fechafin" type="text" class="cajaPequena" NAME="fechafin" maxlength="10" value="<? echo $hoy?>" readonly>
                              <img src="../img/calendario.svg" name="Image2" width="16" height="16" border="0" id="Image2" onMouseOver="this.style.cursor='pointer'" data-ttitle="cal" title="Calendario">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fechafin",
					ifFormat   : "%d/%m/%Y",
					button     : "Image2"
					  }
					);
		</script>	</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					  <tr>
						  <td>Denominacion de la copia</td>
						  <td><input id="denominacion" type="text" class="cajaGrande" NAME="denominacion" maxlength="50"></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					</table>
			  </div>
			 	<div id="botonBusqueda">
					                    <button type="button" id="btnbuscar" onClick="buscar()"  onMouseOver="style.cursor=cursor"> <img src="../img/ver.svg" alt="buscar" /> <span  id="tbuscar">Buscar</span> </button>

			 	  <button type="button" id="btnlimpiar"  onClick="limpiar()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span  id="tlimpiar">Limpiar</span> </button>


					<button type="button" id="btnimprimir"  onClick="imprimir()" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span  id="timpr">Imprimir</span> </button>


														
				</div>
			  <div id="lineaResultado">
			  <table class="fuente8" width="80%" cellspacing=0 cellpadding=3 border=0>
			  	<tr>
				<td width="50%" class="paginar" align="left">N de copias de seguridad encontradas <input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				<td width="50%" align="right"><span  id="tmostradas">Mostradas</span> <select name="paginas" id="paginas" onChange="paginar()">
		          </select></td>
			  </table>
				</div>
				<div id="cabeceraResultado" class="header">
					relacion de COPIAS DE SEGURIDAD</div>
				<div id="frmResultado">
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="6%"><span  id="titem">ITEM</span></td>
							<td width="50%">DENOMINACION</td>
							<td width="16">FECHA </td>
							<td width="16%">HORA</td>
							<td width="6%">&nbsp;</td>
							<td width="6%">&nbsp;</td>
						</tr>
				</table>
				</div>
				<input type="hidden" id="iniciopagina" name="iniciopagina">
				<input type="hidden" id="cadena_busqueda" name="cadena_busqueda">
			</form>
				<div id="lineaResultado">
					<iframe width="100%" height="250" id="frame_rejilla" name="frame_rejilla" frameborder="0">
						<ilayer width="100%" height="300" id="frame_rejilla" name="frame_rejilla"></ilayer>
					</iframe>
				</div>
			</div>
		  </div>			
		</div>
	</body>
</html>
