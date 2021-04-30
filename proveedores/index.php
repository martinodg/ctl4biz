<?php
require_once("../conectar7.php");
require_once("../mysqli_result.php"); 
$id_resource='4';
$id_sresource='100';
require_once("../racf/purePhpVerify.php");
if(array_key_exists('cadena_busqueda', $_GET)){
	$cadena_busqueda=$_GET["cadena_busqueda"];
}

    
if (!isset($cadena_busqueda)) { $cadena_busqueda=""; } else { $cadena_busqueda=str_replace("",",",$cadena_busqueda); }

if ($cadena_busqueda<>"") {
	$array_cadena_busqueda=split("~",$cadena_busqueda);
	$codproveedor=$array_cadena_busqueda[1];
    $pais=$array_cadena_busqueda[2];
	$nombre=$array_cadena_busqueda[3];
	$nif=$array_cadena_busqueda[4];
	$provincia=$array_cadena_busqueda[5];
	$localidad=$array_cadena_busqueda[6];
	$telefono=$array_cadena_busqueda[7];
} else {
	$codproveedor="";
    $pais="";
	$nombre="";
	$nif="";
	$provincia="";
	$localidad="";
	$telefono="";
}

  
  
  
?>
<html>
	<head>
		<title>Proveedores</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">

        <script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
		 
        
        <script language="javascript">
         
 /* Ajax para completar comboBox cboProvincias basado en el pais elejido en comboBox cboPais */
        $( document ).ready(function(){
                $('#cboPais').change(function(){
                    console.log($(this));
                    $.get( "sel_provincias7.php" , { pais : $(this).val() } , function ( data ) {
                        $ ( '#cboProvincias' ) . html ( data ) ;
                    });
                });
         });

		function inicio() {
			document.getElementById("form_busqueda").submit();
		}
		
		function nuevo_proveedor() {
			location.href="nuevo_proveedor7.php";
		}
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		function imprimir() {
			var codproveedor=document.getElementById("codproveedor").value;
            var pais=document.getElementById("cboPais").value;
			var nombre=document.getElementById("nombre").value;
			var nif=document.getElementById("nif").value;			
			var provincia=document.getElementById("cboProvincias").value;
			var localidad=document.getElementById("localidad").value;
			var telefono=document.getElementById("telefono").value;
			window.open("../fpdf/proveedores.php?codproveedor="+codproveedor+"&pais="+pais+"&nombre="+nombre+"&nif="+nif+"&provincia="+provincia+"&localidad="+localidad+"&telefono="+telefono);
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
			var codproveedor=document.getElementById("codproveedor").value;
            var pais=document.getElementById("cboPais").value;			
            var nombre=document.getElementById("nombre").value;
          	var nif=document.getElementById("nif").value;			
			var provincia=document.getElementById("cboProvincias").value;
			var localidad=document.getElementById("localidad").value;
			var telefono=document.getElementById("telefono").value;
			var cadena="";
			cadena="~"+codproveedor+"~"+pais+"~"+nombre+"~"+nif+"~"+provincia+"~"+localidad+"~"+telefono+"~";
			return cadena;
			}
			
		function limpiar() {
			document.getElementById("form_busqueda").reset();
		}
			
		
		var miPopup
		function abreVentana(){
			miPopup = window.open("ventana_proveedores.php","miwin","width=700,height=380,scrollbars=yes");
			miPopup.focus();
		}
		
		function validarproveedor(){
			var codigo=document.getElementById("codproveedor").value;
			miPopup = window.open("comprobarproveedor.php?codproveedor="+codigo,"frame_datos","width=700,height=80,scrollbars=yes");

		}
		</script>
	</head>
	<body onLoad="inicio()">
		<div id="pagina">
			<div id="zonaContenido">
			<div align="center">
                <div id="tituloForm" class="header"><span id="tbprov">Buscar PROVEEDOR</span></div>
				<div id="frmBusqueda">
				<form id="form_busqueda" name="form_busqueda" method="post" action="rejilla.php" target="frame_rejilla">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>					
						<tr>
							<td width="16%"><span id="tcodprov">Codigo de proveedor</span></td>
							<td width="68%"><input id="codproveedor" type="text" class="cajaPequena" NAME="codproveedor" maxlength="10" value="<? echo $codproveedor?>">  <img src="../img/ver.svg" width="16" height="16" onClick="abreVentana()"  data-ttitle="bprov" title="Buscar PROVEEDOR"  onMouseOver="style.cursor=cursor"> <img src="../img/cliente.svg" width="16" height="16" onClick="validarproveedor()" title="Validar proveedor" onMouseOver="style.cursor=cursor"></td>
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
							<td>Pais</td>
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
							<td><span id="tnomb">Nombre</span></td>
							<td><input id="nombre" name="nombre" type="text" class="cajaGrande" maxlength="45" value="<? echo $nombre?>"></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
						  <td><span id="tnip">NIF / CIF</span></td>
						  <td><input id="nif" type="text" class="cajaPequena" NAME="nif" maxlength="15" value="<? echo $nif?>"></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					
						<tr>
							<td><span id="tpcia">Provincia</span></td>
							<td><select id="cboProvincias" name="cboProvincias" class="comboMedio">
							
								</select>							</td>
					    </tr>
                                            <tr>
						  <td><span id="tlocal">Localidad</span></td>
						  <td><input id="localidad" type="text" class="cajaGrande" NAME="localidad" maxlength="30" value="<? echo $localidad?>"></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
						<tr>
						  <td><span id="ttelef">Tel&eacute;fono</span></td>
						  <td><input id="telefono" type="text" class="cajaPequena" NAME="telefono" maxlength="15" value="<? echo $telefono?>"></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					</table>
			  </div>
			 	<div id="botonBusqueda">
					<button type="button" id="btnbuscar" onClick="buscar()"  onMouseOver="style.cursor=cursor"> <img src="../img/ver.svg" alt="buscar" /> <span id="tbuscar">Buscar</span> </button>
					<button type="button" id="btnlimpiar"  onClick="limpiar()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span id="tlimpiar">Limpiar</span> </button>
					<button type="button" id="btnnuevo"  onClick="nuevo_proveedor()" onMouseOver="style.cursor=cursor"> <img src="../img/nuevo.svg" alt="nuevo" /> <span id="tnueprov">Nuevo Proveedor</span> </button>
					<button type="button" id="btnimprimir"  onClick="imprimir()" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span id="timpr">Imprimir</span> </button>
				</div>
			  <div id="lineaResultado">
			  <table class="fuente8" width="80%" cellspacing=0 cellpadding=3 border=0>
			  	<tr>
                    <td width="50%" class="paginar" align="left"><span id="tnroproven">N de proveedores encontrados</span> <input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				<td width="50%" class="paginar" align="right"><span id="tmostra">Mostrados</span> <select name="paginas" id="paginas" onChange="paginar()">
		          </select></td>
			  </table>
				</div>
                <div id="cabeceraResultado" class="header"><span id="trelacprov">relacion de PROVEEDORES</span></div>
				<div id="frmResultado">
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="8%"><span id="titem">ITEM</span></td>
							<td width="6%"><span id="tcodigo">CODIGO</span></td>
							<td width="38%"><span id="tnomb">NOMBRE</span></td>
							<td width="13%"><span id="tnip">NIF/CIF</span></td>
							<td width="19%"><span id="ttelef">TELEFONO</span></td>
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
					<iframe width="100%" height="300" id="frame_rejilla" name="frame_rejilla" frameborder="0">
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
