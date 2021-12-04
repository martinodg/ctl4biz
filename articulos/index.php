<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 

require_once("../conectar7.php");
$id_resource='2';
$id_sresource='4';
require_once("../racf/purePhpVerify.php");
require_once("../mysqli_result.php");

$cadena_busqueda=$_GET["cadena_busqueda"];

$query_familias="SELECT * FROM familias ORDER BY nombre ASC";
$res_familias=mysqli_query($conexion,$query_familias);


if (!isset($cadena_busqueda)) {
    $cadena_busqueda="";
    $codarticulo="";
    $referencia="";
    $codfamilia="";
    $descripcion="";
    $codproveedor="";
    $codubicacion="";
}
else{
    $array_cadena_busqueda = explode('~',$cadena_busqueda);
    $codarticulo=$array_cadena_busqueda[1];
    $referencia=$array_cadena_busqueda[2];
    $codfamilia=$array_cadena_busqueda[3];
    $descripcion=$array_cadena_busqueda[4];
    $codproveedor=$array_cadena_busqueda[5];
    $codubicacion=$array_cadena_busqueda[6];
}

?>
<html>
	<head>
		<title>Articulos</title>
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
		
		function inicio() {
			document.getElementById("form_busqueda").submit();
		}
		function nuevo_articulo() {
			location.href="nuevo_articulo.php";
		}
		
		function imprimir() {
			var codarticulo=document.getElementById("codarticulo").value;
			var referencia=document.getElementById("referencia").value;
			var descripcion=document.getElementById("descripcion").value;
			var proveedores=document.getElementById("cboProveedores").value;			
			var familia=document.getElementById("cboFamilias").value;
			var ubicacion=document.getElementById("cboUbicacion").value;
			window.open("../fpdf/articulos.php?codarticulo="+codarticulo+"&referencia="+referencia+"&descripcion="+descripcion+"&proveedores="+proveedores+"&familia="+familia+"&ubicacion="+ubicacion);
		}
		
		function limpiar_busqueda() {
			document.getElementById("codarticulo").value="";
			document.getElementById("referencia").value="";
			document.getElementById("descripcion").value="";
			document.form_busqueda.cboFamilias.options[0].selected = true;
			document.form_busqueda.cboProveedores.options[0].selected = true;
			document.form_busqueda.cboUbicacion.options[0].selected = true;
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
			var codarticulo=document.getElementById("codarticulo").value;
			var referencia=document.getElementById("referencia").value;
			var descripcion=document.getElementById("descripcion").value;
			var proveedores=document.getElementById("cboProveedores").value;			
			var familia=document.getElementById("cboFamilias").value;
			var ubicacion=document.getElementById("cboUbicacion").value;
			var cadena="";
			cadena="~"+codarticulo+"~"+referencia+"~"+familia+"~"+descripcion+"~"+proveedores+"~"+ubicacion+"~";
			return cadena;
			}
		
		function ventanaArticulos(){
			miPopup = window.open("ventana_articulos.php","miwin","width=700,height=500,scrollbars=yes");
			miPopup.focus();
		}
		</script>
	</head>
	<body onLoad="inicio()">
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header"><span  id="tbuscaart">Buscar ARTICULO</span></div>
				<div id="frmBusqueda">
				<form id="form_busqueda" name="form_busqueda" method="post" action="rejilla.php" target="frame_rejilla">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>					
						<tr>
                            <td width="16%"><span  id="tcodart">C&oacute;digo de art&iacute;culo</span></td>
							<td width="68%"><input id="codarticulo" type="text" class="cajaPequena" NAME="codarticulo" maxlength="15" value="<? echo $codarticulo?>" > <img src="../img/ver.svg" width="16" height="16" onClick="ventanaArticulos()" onMouseOver="style.cursor=cursor" data-opttrad="tbuscaart" title="Buscar articulos"></td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="6%" align="right"></td>
						</tr>
						<tr>
							<td><span  id="trefren">Referencia</span></td>
							<td><input id="referencia" name="referencia" type="text" class="cajaGrande" maxlength="20" value="<? echo $referencia?>"></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<?php
					  	$query_familias="SELECT * FROM familias ORDER BY nombre ASC";
						$res_familias=mysqli_query($conexion,$query_familias);
						$contador=0;
					  ?>
						<tr>
							<td><span  id="tflia">FAMILIA</span></td>
							<td><select id="cboFamilias" name="cboFamilias" class="comboMedio">
							<option value="0" data-opttrad="tdsfam" >Todas las familias</option>
								<?php
								while ($contador < mysqli_num_rows($res_familias)) { 
									if ( mysqli_result($res_familias,$contador,"codfamilia") == $familia) { ?>
								<option value="<?php echo mysqli_result($res_familias,$contador,"codfamilia")?>" selected><?php echo mysqli_result($res_familias,$contador,"nombre")?></option>
								<? } else { ?>
								<option value="<?php echo mysqli_result($res_familias,$contador,"codfamilia")?>"><?php echo mysqli_result($res_familias,$contador,"nombre")?></option>
								<? }
								$contador++;
								} ?>				
								</select>							</td>
					    </tr>
						<tr>
							<td><span  id="tdescri">Descripci&oacute;n</span></td>
							<td><input id="descripcion" name="descripcion" type="text" class="cajaGrande" maxlength="60" value="<? echo $descripcion?>"></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<?php
					  	$query_proveedores="SELECT codproveedor,nombre,nif FROM proveedores WHERE borrado=0 ORDER BY nombre ASC";
						$res_proveedores=mysqli_query($conexion,$query_proveedores);
						$contador=0;
					  ?>
						<tr>
							<td><span  id="tprov">Proveedor</span></td>
							<td><select id="cboProveedores" name="cboProveedores" class="comboGrande">
							<option value="0" data-opttrad="todprov">Todos los proveedores</option>
								<?php
								while ($contador < mysqli_num_rows($res_proveedores)) { 
									if ( mysqli_result($res_proveedores,$contador,"codproveedor") == $proveedor) { ?>
								<option value="<?php echo mysqli_result($res_proveedores,$contador,"codproveedor")?>" selected><?php echo mysqli_result($res_proveedores,$contador,"nif")?> -- <?php echo mysqli_result($res_proveedores,$contador,"nombre")?></option>
								<? } else { ?> 
								<option value="<?php echo mysqli_result($res_proveedores,$contador,"codproveedor")?>"><?php echo mysqli_result($res_proveedores,$contador,"nif")?> -- <?php echo mysqli_result($res_proveedores,$contador,"nombre")?></option>
								<? }
								$contador++;
								} ?>				
								</select>							</td>
					    </tr>
					<?php
					  	$query_ubicacion="SELECT codubicacion,nombre FROM ubicaciones WHERE borrado=0 ORDER BY nombre ASC";
						$res_ubicacion=mysqli_query($conexion,$query_ubicacion);
						$contador=0;
					  ?>
						<tr>
							<td><span  id="tubicacion">Ubicaci&oacute;n</span></td>
							<td><select id="cboUbicacion" name="cboUbicacion" class="comboGrande">
							<option value="0" data-opttrad="todubic">Todas las ubicaciones</option>
								<?php
								while ($contador < mysqli_num_rows($res_ubicacion)) {
									if ( mysqli_result($res_ubicacion,$contador,"codubicacion") == $ubicacion) { ?>
								<option value="<?php echo mysqli_result($res_ubicacion,$contador,"codubicacion")?>" selected><?php echo mysqli_result($res_ubicacion,$contador,"nombre")?></option>
								<? } else { ?> 
								<option value="<?php echo mysqli_result($res_ubicacion,$contador,"codubicacion")?>"><?php echo mysqli_result($res_ubicacion,$contador,"nombre")?></option>
								<? }
								$contador++;
								} ?>
								</select>							</td>
					    </tr>
					</table>
			  </div>
				<div id="botonBusqueda">	
					<button type="button" id="btnbuscar" onClick="buscar()" onMouseOver="style.cursor=cursor"> <img src="../img/ver.svg" alt="limpiar" /> <span  id="tbuscar">Buscar</span> </button>
					<button type="button" id="btnlimpiar" onClick="limpiar_busqueda()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span  id="tlimpiar">Limpiar</span> </button>
               		<button type="button" id="btnnuevo" onClick="nuevo_articulo()" onMouseOver="style.cursor=cursor"> <img src="../img/nuevo.svg" alt="nuevo" /> <span  id="tnuevo">Nuevo</span> </button>
               		<button type="button" id="btnimprimir" onClick="imprimir()" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span  id="timpr">Imprimir</span> </button>
				</div>	

				<div id="lineaResultado">
			  <table class="fuente8" width="80%" cellspacing=0 cellpadding=3 border=0>
			  	<tr>
				<td width="50%" class="paginar" align="left"><span  id="tndartenctn">N de articulos encontrados</span> <input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				<td width="50%" class="paginar" align="right"><span  id="tmostra">Mostrados</span> <select name="paginas" id="paginas" onChange="paginar()">
		          </select></td>
			  </table>
				</div>
                    <div id="cabeceraResultado" class="header" ><span  id="ttrealcionart">Relación de articulos</span></div>
				<div id="frmResultado">
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="4%"><span  id="titem">ITEM</span></td>
							<td width="5%"><span  id="tcodigo">CODIGO</span></td>
							<td width="19%"><span  id="referenc">REFERENCIA</span></td>
							<td width="25%"><span  id="tdescri">DESCRIPCION</span></td>
							<td width="11%"><span  id="tflia">FAMILIA</span></td>
							<td width="11%"><span  id="tpreciot">PRECIO T.</span></td>
							<td width="5%"><span  id="tstock">Stock</span></td>
                            <td width="5%"><span  id="tundmed">Und./medida</span></td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							
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
				</div>
			</div>
		  </div>			
		</div>
	</body>
</html>
