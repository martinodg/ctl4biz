<?php
require_once("../conectar7.php");
$id_resource='7';
$id_sresource='29';
require_once("../racf/purePhpVerify.php");

$cadena_busqueda=$_GET["cadena_busqueda"];

if (!isset($cadena_busqueda)) { $cadena_busqueda=""; } else { $cadena_busqueda=str_replace("",",",$cadena_busqueda); }

if ($cadena_busqueda<>"") {
	$array_cadena_busqueda=explode("~",$cadena_busqueda);
	$codembalaje=$array_cadena_busqueda[1];
	$nombre=$array_cadena_busqueda[2];
} else {
	$codembalaje="";
	$nombre="";
}

?>
<html>
	<head>
		<title>Familias</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
		 
        
        <script language="javascript">
         
		
		function inicio() {
			document.getElementById("form_busqueda").submit();
		}
		function nuevo_embalaje() {
			location.href="nuevo_embalaje.php";
		}
		
		function limpiar_busqueda() {
			document.getElementById("codembalaje").value="";
			document.getElementById("nombre").value="";
		}
		
		function imprimir() {
			var codembalaje=document.getElementById("codembalaje").value;
			var nombre=document.getElementById("nombre").value;
			window.open("../fpdf/embalajes.php?codembalaje="+codembalaje+"&nombre="+nombre+"&lang="+getLanguajeCode());
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
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		function paginar() {
			document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
			document.getElementById("form_busqueda").submit();
		}
		
		function hacer_cadena_busqueda() {
			var codembalaje=document.getElementById("codembalaje").value;
			var nombre=document.getElementById("nombre").value;
			var cadena="";
			cadena="~"+codembalaje+"~"+nombre+"~";
			return cadena;
			}
		</script>
	</head>
	<body onLoad="inicio()">
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
                    <div id="tituloForm" class="header"><span  id="tbusembj">Buscar EMBALAJE</span></div>
				<div id="frmBusqueda">
				<form id="form_busqueda" name="form_busqueda" method="post" action="rejilla.php" target="frame_rejilla">
					<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0>					
						<tr>
                            <td width="16%"><span  id="tcodembal">C&oacute;digo de embalaje</span></td>
							<td width="68%"><input id="codembalaje" type="text" class="cajaPequena" NAME="codembalaje" maxlength="3" value="<? echo $codembalaje?>"></td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="6%" align="right"></td>
						</tr>
						<tr>
							<td><span  id="tnomb">Nombre</span></td>
							<td><input id="nombre" name="nombre" type="text" class="cajaGrande" maxlength="30" value="<? echo $nombre?>"></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</table>
			  </div>
			 	<div id="botonBusqueda">
					                    <button type="button" id="btnbuscar" onClick="buscar()"  onMouseOver="style.cursor=cursor"> <img src="../img/ver.svg" alt="buscar" /> <span  id="tbuscar">Buscar</span> </button>
										<button type="button" id="btnlimpiar"  onClick="limpiar_busqueda()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span  id="tlimpiar">Limpiar</span> </button>
					 					<button type="button" id="btnnuevo" onClick="nuevo_embalaje()" onMouseOver="style.cursor=cursor"> <img src="../img/nuevo.svg" alt="nuevo" /> <span  id="tnuevo">Nuevo</span> </button>
										<button type="button" id="btnimprimir"  onClick="imprimir()" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span  id="timpr">Imprimir</span> </button>
				</div>
			  <div id="lineaResultado">
			  <table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0>
			  	<tr>
                    <td width="50%" class="paginar" align="left"><span  id="tnroemben">Nro.de embalajes encontrados</span> <input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				<td width="50%" class="paginar" align="right"><span  id="tmostra">Mostrados</span> <select name="paginas" id="paginas" onChange="paginar()">
		          </select></td>
			  </table>
				</div>
                    <div id="cabeceraResultado" class="header"><span  id="trelacenb">relacion de EMBALAJES</span></div>
				<input type="hidden" id="iniciopagina" name="iniciopagina">
				<input type="hidden" id="cadena_busqueda" name="cadena_busqueda">
			</form>
				<div id="lineaResultado">
					<iframe width="100%" height="300" id="frame_rejilla" name="frame_rejilla" frameborder="0">
						<ilayer width="100%" height="300" id="frame_rejilla" name="frame_rejilla"></ilayer>
					</iframe>
				</div>
			</div>
		  </div>			
		</div>
	</body>
</html>
