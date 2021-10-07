<?php
require_once("../conectar7.php");
$id_resource='3';
$id_sresource='13';
require_once("../racf/purePhpVerify.php");

$cadena_busqueda=$_GET["cadena_busqueda"];

if (!isset($cadena_busqueda)) { $cadena_busqueda=""; } else { $cadena_busqueda=str_replace("",",",$cadena_busqueda); }

if ($cadena_busqueda<>"") {
	$array_cadena_busqueda=split("~",$cadena_busqueda);
	$codcliente=$array_cadena_busqueda[1];
	$nombre=$array_cadena_busqueda[2];
	$numalbaranini=$array_cadena_busqueda[3];
	$numalbaranfin=$array_cadena_busqueda[4];
	$fechainicio=$array_cadena_busqueda[5];
	$fechafin=$array_cadena_busqueda[6];
} else {
	$codcliente="";
	$nombre="";
	$numalbaranini="";
	$numalbaranfin="";
	$fechainicio="";
	$fechafin="";
}

?>
<html>
	<head>
		<title>Albaranes</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>
		<!-- <script type="text/JavaScript" language="javascript" src="../calendario/lang/calendar-sp.js"></script> -->
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar-setup.js"></script>
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
		
		function activartodos() {
			if (document.formulario.todos.checked==true) {
				for (i=0;i<frames['frame_rejilla'].document.form1.elements.length;i++)
				  if(frames['frame_rejilla'].document.form1.elements[i].type == "checkbox")
					 frames['frame_rejilla'].document.form1.elements[i].checked=1
			} else {
				for (i=0;i<frames['frame_rejilla'].document.form1.elements.length;i++)
				  if(frames['frame_rejilla'].document.form1.elements[i].type == "checkbox")
					 frames['frame_rejilla'].document.form1.elements[i].checked=0
			}
		}
		
		function devolver_cadena_checks(frame,check) {
			cadena="";
			existe=false;
			contador_check=0;
			opciones=0;
		
			for (i=0;i<eval("frames['"+frame+"'].document.form1.elements.length");i++) {
				if (eval("frames['"+frame+"'].document.form1.elements[i].name=='"+check+"'")) {
					contador_check=contador_check+1;
					existe=true;				
				}				
			}
		
			if (existe) {
				if (contador_check==1) {
				//sólo hay un check, o sea, que no se forma un array con los checks y hay que 
				//evaluarlo independientemente
					if (eval("frames['"+frame+"'].document.getElementById('"+check+"').checked")) {
						cadena=eval("frames['"+frame+"'].document.getElementById('"+check+"').value+'~'");
						opciones=1;
					}
				} else {		
		
					for (i=0;i<eval("frames['"+frame+"'].document.form1.elements.length");i++) { 
						if (eval("(frames['"+frame+"'].document.form1.elements[i].checked)") && eval("(frames['"+frame+"'].document.form1.elements[i].name=='"+check+"')")) {
							cadena=cadena+eval("frames['"+frame+"'].document.form1.elements[i].value+'~'");
							opciones=opciones+1;
						}
					} 
				}
			}
							
			if (cadena=="") {
				return "";
			} else {
				cadena="~"+cadena;
				return cadena;
			}		
		}
		
		function abreVentana(){
			miPopup = window.open("ver_clientes.php","miwin","width=700,height=380,scrollbars=yes");
			miPopup.focus();
		}
		
		function validarcliente(){
			var codigo=document.getElementById("codcliente").value;
			miPopup = window.open("comprobarcliente.php?codcliente="+codigo,"frame_datos","width=700,height=80,scrollbars=yes");
		}
		
		function facturar_albaran() {
			var cadena_elegidos="";
			cadena_elegidos=devolver_cadena_checks("frame_rejilla","checkbox_socio");
			if (opciones==0)  {
				alert("No hay albaranes seleccionados.");
			} else {
                //@todo traducir esto
				if (confirm("Va a facturar "+opciones+" albaranes. Desea continuar?")) {
					window.location.href="configurar_lote.php?cadena_busqueda="+cadena_busqueda+"&cadena_elegidos="+cadena_elegidos;
                }
			}
		}
		
		function buscar() {
			var cadena;
			var nombre=document.getElementById("nombre").value;
			if (nombre=="") {
				alert ("Debe seleccionar un cliente.");
			} else {
				cadena=hacer_cadena_busqueda();
				document.getElementById("cadena_busqueda").value=cadena;
				if (document.getElementById("iniciopagina").value=="") {
					document.getElementById("iniciopagina").value=1;
				} else {
					document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
				}
				document.getElementById("formulario").submit();
			}
		}
		
		function paginar() {
			document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
			document.getElementById("formulario").submit();
		}
		
		function hacer_cadena_busqueda() {
			var codcliente=document.getElementById("codcliente").value;
			var nombre=document.getElementById("nombre").value;
			var numalbaranini=document.getElementById("numalbaranini").value;			
			var numalbaranfin=document.getElementById("numalbaranfin").value;
			var fechainicio=document.getElementById("fechainicio").value;
			var fechafin=document.getElementById("fechafin").value;
			var cadena="";
			cadena="~"+codcliente+"~"+nombre+"~"+numalbaranini+"~"+numalbaranfin+"~"+fechainicio+"~"+fechafin+"~";
			return cadena;
			}
		
		function limpiar() {
			document.getElementById("formulario").reset();
		}
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
                    <div id="tituloForm" class="header"><span  id="tbalbaranes">Buscar ALBARANES</span></div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="rejilla.php" target="frame_rejilla">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>					
						<tr>
							<td width="16%"><span  id="tcod_cliente">Codigo de cliente</span></td>
							<td width="68%"><input id="codcliente" type="text" class="cajaPequena" NAME="codcliente" maxlength="10"><img src="../img/ver.svg" width="16" height="16" onClick="abreVentana()" data-ttitle="bcliente" title="Buscar cliente"> <img src="../img/cliente.svg" width="16" height="16" onClick="validarcliente()" data-ttitle="tvalclt" title="Validar cliente"></td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="6%" align="right"></td>
						</tr>
						<tr>
							<td><span  id="tnomb">Nombre</span></td>
							<td><input id="nombre" name="nombre" type="text" class="cajaGrande" maxlength="45" readonly="yes"></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><span  id="tnif">NIF</span></td>
							<td><input id="nif" name="nif" type="text" class="cajaMedia" maxlength="20" readonly="yes"></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
						  <td><span  id="tnrortoini">Num. Albaran Inicial</span></td>
						  <td><input id="numalbaranini" type="text" class="cajaPequena" NAME="numalbaranini" maxlength="15" value="<? echo $numalbaranini?>"></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					  <tr>
						  <td><span  id="tntortofin">Num. Albaran Final</span></td>
						  <td><input id="numalbaranfin" type="text" class="cajaPequena" NAME="numalbaranfin" maxlength="15" value="<? echo $numalbaranfin?>"></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					  <tr>
						  <td><span  id="tfechin">Fecha de inicio</span></td>
						  <td>
                              <input id="fechainicio" type="text" class="cajaPequena" NAME="fechainicio" maxlength="10" value="<? echo $fechainicio?>" readonly>
                              <img src="../img/calendario.svg" id="Image1" width="16" height="16" border="0" onMouseOver="this.style.cursor='pointer'" data-ttitle="cal" title="Calendario">
                                <script type="text/javascript">
                                            Calendar.setup(
                                              {
                                            inputField : "fechainicio",
                                            ifFormat   : "%d/%m/%Y",
                                            button     : "Image1"
                                              }
                                            );
                                </script>
                            </td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
						<tr>
						  <td><span  id="tfchafin">Fecha de fin</span></td>
						  <td>
                              <input id="fechafin" type="text" class="cajaPequena" NAME="fechafin" maxlength="10" value="<? echo $fechafin?>" readonly>
                              <img src="../img/calendario.svg"  width="16" height="16" border="0" id="Image2" onMouseOver="this.style.cursor='pointer'">
                              <script type="text/javascript">
                                Calendar.setup(
                                  {
                                inputField : "fechafin",
                                ifFormat   : "%d/%m/%Y",
                                button     : "Image2"
                                  }
                                );
                            </script>
                         </td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					</table>
			  </div>
			 	<div id="botonBusqueda">
                    <button type="button" id="btnbuscar" onClick="buscar()"  onMouseOver="style.cursor=cursor"> <img src="../img/ver.svg" alt="buscar" /> <span  id="tbuscar">Buscar</span> </button>
      		 	    <button type="button" id="btnlimpiar"  onClick="limpiar()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span  id="tlimpiar">Limpiar</span> </button>
					<button type="button" id="btnfacturarremito" onClick="facturar_albaran()"  onMouseOver="style.cursor=cursor"> <img src="../img/convertir.svg" alt="facturar remito" /> <span>Facturar remito</span> </button>
				</div>
			  <div id="lineaResultado">
			  <table class="fuente8" width="80%" cellspacing=0 cellpadding=3 border=0>
			  	<tr>
				<td width="50%" class="paginar" align="left"><span  id="tndalbaranese">N de albaranes encontrados</span> <input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				<td width="50%" class="paginar" align="right"><span  id="tmostra">Mostrados</span> <select name="paginas" id="paginas" onChange="paginar()">
		          </select></td>
			  </table>
				</div>
				<div id="cabeceraResultado" class="header">
					<span  id="trelalbaranes">Relación de ALBARANES</span> </div>
				<div id="frmResultado">
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="10%"><input name="todos" type="checkbox" value="todos" onClick="activartodos()"></td>
							<td width="15%"><span  id="titem">ITEM</span></td>
							<td width="25%"<span  id="tndalbaran">N. ALBARAN</span>
							<td width="25%"><span  id="timporte">IMPORTE</span></td>
							<td width="25%"><span  id="tfecha">Fecha</span></td>
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
