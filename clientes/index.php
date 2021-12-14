<?php
require_once("../conectar7.php");
require_once("../mysqli_result.php");
$id_resource='3';
$id_sresource='110';
require_once("../racf/purePhpVerify.php");
$cadena_busqueda=$_GET["cadena_busqueda"];

if (!isset($cadena_busqueda)) { $cadena_busqueda=""; } else { $cadena_busqueda=str_replace("",",",$cadena_busqueda); }

if ($cadena_busqueda<>"") {
	$array_cadena_busqueda=split("~",$cadena_busqueda);
	$codcliente=$array_cadena_busqueda[1];
	$nombre=$array_cadena_busqueda[2];
	$nif=$array_cadena_busqueda[3];
	$provincia=$array_cadena_busqueda[4];
	$localidad=$array_cadena_busqueda[5];
	$telefono=$array_cadena_busqueda[6];
} else {
	$codcliente="";
	$nombre="";
	$nif="";
	$provincia="";
	$localidad="";
	$telefono="";
}

?>
<html>
	<head>
		<title>Clientes</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
		<!script type="text/javascript" src="/racf/verify.js"><!/script>
		<script language="javascript">
		// 
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		 /* Ajax para completar comboBox cboProvincias basado en el pais elejido en comboBox cboPais */
		 $( document ).ready(function(){
                $('#cboPais').change(function(){
                    console.log($(this));
                    $.get( "../funciones/BackendQueries/sel_provincias7.php" , { pais : $(this).val() } , function ( data ) {
                        $ ( '#cboProvincias' ) . html ( data ) ;
                    });
                });
         });
		function inicio() {
			document.getElementById("form_busqueda").submit();
		}
		
		function nuevo_cliente() {
			location.href="nuevo_cliente.php";
		}

		function imprimir() {
			var codcliente=document.getElementById("codcliente").value;
			var nombre=document.getElementById("nombre").value;
			var nif=document.getElementById("nif").value;			
			var provincia=document.getElementById("cboProvincias").value;
			var localidad=document.getElementById("localidad").value;
			var telefono=document.getElementById("telefono").value;
			window.open("../fpdf/clientes.php?codcliente="+codcliente+"&nombre="+nombre+"&nif="+nif+"&provincia="+provincia+"&localidad="+localidad+"&telefono="+telefono+"&lang="+getLanguajeCode());
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
		
		function paginar() {
			document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
			document.getElementById("form_busqueda").submit();
		}
		
		function hacer_cadena_busqueda() {
			var codcliente=document.getElementById("codcliente").value;
			var nombre=document.getElementById("nombre").value;
			var nif=document.getElementById("nif").value;			
			var provincia=document.getElementById("cboProvincias").value;
			var localidad=document.getElementById("localidad").value;
			var telefono=document.getElementById("telefono").value;
			var cadena="";
			cadena="~"+codcliente+"~"+nombre+"~"+nif+"~"+provincia+"~"+localidad+"~"+telefono+"~";
			return cadena;
			}
			
		function limpiar() {
			document.getElementById("form_busqueda").reset();
		}
		
		function abreVentana(){
			miPopup = window.open("ventana_clientes.php","miwin","width=700,height=380,scrollbars=yes");
			miPopup.focus();
		}
		
		function validarcliente(){
			var codigo=document.getElementById("codcliente").value;
			miPopup = window.open("comprobarcliente.php?codcliente="+codigo,"frame_datos","width=700,height=80,scrollbars=yes");
		}	


		</script>
	</head>
	<body onLoad="inicio()">
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
                    <div id="tituloForm" class="header"><span  id="tbcliente">Buscar CLIENTE</span></div>
				<div id="frmBusqueda">
				<form id="form_busqueda" name="form_busqueda" method="post" action="rejilla.php" target="frame_rejilla">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>					
						<tr>
							<td width="16%" id="tcodcli">Codigo de cliente</td>
							<td width="68%"><input id="codcliente" type="text" class="cajaPequena" NAME="codcliente" maxlength="10" value="<? echo $codcliente?>"> <img src="../img/ver.svg" width="16" height="16" onClick="abreVentana()" data-ttitle="bcliente" title="Buscar cliente" onMouseOver="style.cursor=cursor"> <img src="../img/cliente.svg" width="16" height="16" onClick="validarcliente()" data-ttitle="tvalclt" title="Validar cliente" onMouseOver="style.cursor=cursor"></td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="6%" align="right"></td>
						</tr>
						<?php
					  	$query_pais="SELECT * FROM pais ORDER BY nombrePais ASC";
						$res_pais=mysqli_query($conexion,$query_pais);
						$contador=0;
					  ?>
<tr>
							<td id="pais">Pais</td>
							<td><select id="cboPais" name="cboPais" class="comboMedio">
								<option value="0" selected>Todos los paises</option>
								<?php
								while ($contador < mysqli_num_rows($res_pais)) { 
									if ( mysqli_result($res_pais,$contador,"codPais") == $pais) { ?>
								<option value="<?php echo mysqli_result($res_pais,$contador,"codPais")?>" selected><?php echo mysqli_result($res_pais,$contador,"nombrePais")?></option>
                              
								<? } else { ?> 
								<option value="<?php echo mysqli_result($res_pais,$contador,"codPais")?>"><?php echo mysqli_result($res_pais,$contador,"nombrePais")?></option>
								<? }
                               
								$contador++;
                                
								} ?>				
								</select>							</td>
					    </tr>
						<tr>
							<td><span  id="tnomb">Nombre</span></td>
							<td><input id="nombre" name="nombre" type="text" class="cajaGrande" maxlength="45" value="<? echo $nombre?>"></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
						  <td><span  id="tnip">NIF / CIF</span></td>
						  <td><input id="nif" type="text" class="cajaPequena" NAME="nif" maxlength="15" value="<? echo $nif?>"></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					  <tr>
							<td><span  id="tpcia">Provincia</span></td>
							<td><select id="cboProvincias" name="cboProvincias" class="comboMedio">
							
								</select>							</td>
					    </tr>
					  <tr>
						  <td><span  id="tlocal">Localidad</span></td>
						  <td><input id="localidad" type="text" class="cajaGrande" NAME="localidad" maxlength="30" value="<? echo $localidad?>"></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
						<tr>
						  <td><span  id="ttelef">Tel&eacute;fono</span></td>
						  <td><input id="telefono" type="text" class="cajaPequena" NAME="telefono" maxlength="15" value="<? echo $telefono?>"></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					</table>
			  </div>
			 	<div id="botonBusqueda">                    
					<button type="button" id="btnbuscar" onClick="buscar()"  onMouseOver="style.cursor=cursor"> <img src="../img/ver.svg" alt="buscar" /> <span  id="tbuscar">Buscar</span> </button>
					<button type="button" id="btnlimpiar"  onClick="limpiar()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span  id="tlimpiar">Limpiar</span> </button>
					<button type="button" id="btnnuevo"  onClick="nuevo_cliente()" onMouseOver="style.cursor=cursor"> <img src="../img/nuevo.svg" alt="nuevo" /> <span  id="tnuevo">Nuevo</span> </button>
					<button type="button" id="btnimprimir"  onClick="imprimir()" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span  id="timpr">Imprimir</span> </button>
				</div>
			  <div id="lineaResultado">
			  <table class="fuente8" width="80%" cellspacing=0 cellpadding=3 border=0>
			  	<tr>
                    <td width="50%" class="paginar" align="left"><span  id="tnroclifnd">N de clientes encontrados</span><input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				<td width="50%" class="paginar" align="right"><span  id="tmostra">Mostrados</span> <select name="paginas" id="paginas" onChange="paginar()">
		          </select></td>
			  </table>
				</div>
				<div id="cabeceraResultado" class="header"><span  id="trelcli">relacion de CLIENTES</span></div>
				<div id="frmResultado">
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="8%"><span  id="titem">ITEM</span></td>
							<td width="6%"><span  id="tcodigo">CODIGO</span></td>
							<td width="38%"><span  id="tnomb">NOMBRE</span></td>
							<td width="13%"><span  id="tnip">NIF/CIF</span></td>
							<td width="19%"><span  id="ttelef">TELEFONO</span></td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
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
					<iframe id="frame_datos" name="frame_datos" width="0" height="0" frameborder="0">
					<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
					</iframe>
				</div>
			</div>
		  </div>			
		</div>
	</body>
</html>
