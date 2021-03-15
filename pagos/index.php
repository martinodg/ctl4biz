<?php
require_once("../conectar7.php");
$id_resource='5';
$id_sresource='19';
require_once("../racf/purePhpVerify.php");

$cadena_busqueda=$_GET["cadena_busqueda"];

if (!isset($cadena_busqueda)) { $cadena_busqueda=""; } else { $cadena_busqueda=str_replace("",",",$cadena_busqueda); }

if ($cadena_busqueda<>"") {
	$array_cadena_busqueda=split("~",$cadena_busqueda);
	$codproveedor=$array_cadena_busqueda[1];
	$nombre=$array_cadena_busqueda[2];
	$cboEstados=$array_cadena_busqueda[3];
	$fechainicio=$array_cadena_busqueda[4];
	$fechafin=$array_cadena_busqueda[5];
} else {
	$codproveedor="";
	$nombre="";
	$cboEstados="";
	$fechainicio="";
	$fechafin="";
}

?>
<html>
	<head>
		<title>Cobros</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>
		<!-- <script type="text/JavaScript" language="javascript" src="../calendario/lang/calendar-sp.js"></script> -->
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar-setup.js"></script>
		<script type="text/javascript" src="/jquery/jquery331.js"></script>
		 
        
        <script language="javascript">
         
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		function abreVentana(){
			miPopup = window.open("ver_proveedores.php","miwin","width=700,height=380,scrollbars=yes");
			miPopup.focus();
		}
		
		function validarproveedor(){
			var codigo=document.getElementById("codproveedor").value;
			miPopup = window.open("comprobarproveedor.php?codproveedor="+codigo,"frame_datos","width=700,height=80,scrollbars=yes");
		}
		
		function inicio() {
			document.getElementById("formulario").submit();
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
			document.getElementById("formulario").submit();
		}
		
		function paginar() {
			document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
			document.getElementById("formulario").submit();
		}
		
		function hacer_cadena_busqueda() {
			var codproveedor=document.getElementById("codproveedor").value;
			var nombre=document.getElementById("nombre").value;
			var cboEstados=document.getElementById("cboEstados").value;			
			var fechainicio=document.getElementById("fechainicio").value;
			var fechafin=document.getElementById("fechafin").value;
			var cadena="";
			cadena="~"+codproveedor+"~"+nombre+"~"+cboEstados+"~"+fechainicio+"~"+fechafin+"~";
			return cadena;
			}
		
		function limpiar() {
			document.getElementById("formulario").reset();
		}
		</script>
	</head>
	<body onLoad="inicio()">
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header"><span id="tbuscmov">Buscar MOVIMIENTOS</span></div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="rejilla.php" target="frame_rejilla">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>					
						<tr>
							<td width="16%"><span id="tcodprov">Codigo de proveedor</span></td>
							<td width="68%"><input id="codproveedor" type="text" class="cajaPequena" NAME="codproveedor" maxlength="10"><img src="../img/ver.svg" width="16" height="16" onClick="abreVentana()"  data-ttitle="bprov" title="Buscar PROVEEDOR" > <img src="../img/cliente.svg" width="16" height="16" onClick="validarproveedor()" title="Validar proveedor"></td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="6%" align="right"></td>
						</tr>
						<tr>
							<td><span id="tnomb">Nombre</span></td>
							<td><input id="nombre" name="nombre" type="text" class="cajaGrande" maxlength="45" readonly="yes"></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><span id="tnif">NIF</span></td>
							<td><input id="nif" name="nif" type="text" class="cajaMedia" maxlength="20" readonly="yes"></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><span id="testado">ESTADO</span></td>
							<td><select id="cboEstados" name="cboEstados" class="comboMedio">
								<option value="0" selected data-opttrad="todosest">Todos los estados</option>
								<option value="1">Sin Pagar</option>
								<option value="2">Pagada</option>			
								</select></td>
					    </tr>
					  <tr>
						  <td><span id="tfechin">Fecha de inicio</span></td>
						  <td><input id="fechainicio" type="text" class="cajaPequena" NAME="fechainicio" maxlength="10" value="<? echo $fechainicio?>" readonly><img src="../img/calendario.svg" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'" title="Calendario">
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
						  <td><span id="tfchafin">Fecha de fin</span></td>
						  <td><input id="fechafin" type="text" class="cajaPequena" NAME="fechafin" maxlength="10" value="<? echo $fechafin?>" readonly><img src="../img/calendario.svg" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fechafin",
					ifFormat   : "%d/%m/%Y",
					button     : "Image1"
					  }
					);
		</script></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					</table>
			  </div>
			 	<div id="botonBusqueda">
				                    <button type="button" id="btnbuscar" onClick="buscar()"  onMouseOver="style.cursor=cursor"> <img src="../img/ver.svg" alt="buscar" /> <span id="tbuscar">Buscar</span> </button>

			 	  <button type="button" id="btnlimpiar"  onClick="limpiar()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span id="tlimpiar">Limpiar</span> </button>

		
				</div>
			  <div id="lineaResultado">
			  <table class="fuente8" width="80%" cellspacing=0 cellpadding=3 border=0>
			  	<tr>
				<td width="50%" class="paginar" align="left"><span id="nrofcenco">N de facturas encontradas</span> <input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				<td width="50%" align="right"><span id="tmostradas">Mostradas</span> <select name="paginas" id="paginas" onChange="paginar()">
		          </select></td>
			  </table>
				</div>
				<div id="cabeceraResultado" class="header">
					<span id="trelfac">relacion de FACTURAS</span> </div>
				<div id="frmResultado">
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="8%"><span id="titem">ITEM</span></td>
							<td width="12%"><span id="tnrofac">N. FACTURA</span></td>
                            <td width="26%"><span id="tprovs">PROVEEDOR</span></td>
							<td width="9%"><span id="timporte">IMPORTE</span></td>
							<td width="10%"><span id="tpendient">PENDIENTE</span></td>
							<td width="10%"><span id="tfecha">Fecha</span></td>
							<td width="10%"><span id="testado">ESTADO</span></td>
							<td width="10%"><span id="tfcpago">FECHA PAGO</span></td>
							<td width="5%">&nbsp;</td>
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
				<iframe id="frame_datos" name="frame_datos" width="0" height="0" frameborder="0">
					<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
					</iframe>
				</div>
		  </div>			
		</div>
	</body>
</html>
