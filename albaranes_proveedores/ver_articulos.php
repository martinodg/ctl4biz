<html>
<head>
<title>Buscador de Articulos</title>
<script>
var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
function buscar() {
	if (document.getElementById("iniciopagina").value=="") {
		document.getElementById("iniciopagina").value=1;
	} else {
		document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
	}
	document.getElementById("form1").submit();
	document.getElementById("tabla_resultado").style.display="";
}

function inicio() {

	var combo_familia=document.getElementById("cmbfamilia").value;
	if (combo_familia==0) {
		buscar();
	} else {
		document.getElementById("tabla_resultado").style.display="none";
	}
			
}

function paginar() {
	document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
	document.getElementById("form1").submit();
}

function enviar() {
	document.getElementById("form1").submit();
}

</script>
    <link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="../jquery/jquery331.js"></script>
    <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>
<? 
require_once("../conectar7.php"); 
$codproveedor=$_GET["codproveedor"];
?>
<body onLoad="buscar()">
<form name="form1" id="form1" method="post" action="frame_articulos.php" target="frame_resultado" onSubmit="buscar()">
 <div id="frmBusqueda2">
 <div align="center">
	<table class="fuente8" align="center" width="95%">
     <tr>
	    <td width="36%"><span id="tflia">Familia</span>:</td>
	    <td width="64%">
		  <select id="cmbfamilia" name="cmbfamilia" class="comboGrande">
		  <?
		    $consultafamilia="select * from familias where borrado=0 order by nombre ASC";
			$queryfamilia=mysqli_query($conexion,$consultafamilia);
			?><option value="0" data-opttrad="tdart" >Todos los articulos</option><?
			while ($rowfamilia=mysqli_fetch_row($queryfamilia))
			  { 
			  	if ($anterior==$rowfamilia[0]) { ?>
					<option value="<? echo $rowfamilia[0]?>" selected><? echo utf8_encode($rowfamilia[1])?></option>
			<?	} else { ?>
					<option value="<? echo $rowfamilia[0]?>"><? echo utf8_encode($rowfamilia[1])?></option>
			<?	}   
		   	  };
		  ?>
	    </select>		</td></tr>
		<tr>
		<td width="36%" class="busqueda"><span id="trefren">Referencia</span>:</td>
	    <td width="64%"><input name="referencia" type="text" id="referencia" size="20" class="cajaMedia"></td></tr>
		<tr><td width="36%" class="busqueda"><span id="tdescri">Descripción</span>:</td>
	    <td width="64%"><input name="descripcion" type="text" id="descripcion" size="50" class="cajaGrande"></td></tr>
		<tr><td width="36%" class="busqueda"><span id="tvart">Mostrar todos los art&iacute;culos</span>:</td>
	    <td width="64%"><select name="todos" id="todos" class="comboPequeno">
						<option data-opttrad="no" value=0 selected="selected"data-opttrad="no">No</option>
						<option data-opttrad="si" value=1>Si</option>
						</select></td></tr>
		<tr>
		  <td class="busqueda">&nbsp;</td>
		  <td><button type="button" id="btnbuscar" onClick="enviar()" onMouseOver="style.cursor=cursor"> <img src="../img/ver.svg" alt="buscar" /> <span id="busc">Buscar</span> </button></td>
	  </tr>
</table>
</div>
  <table width="95%" id="tabla_resultado" name="tabla_resultado" style="display:none" align="center">
	<tr>
  		<td>
			<iframe width="100%" height="300" id="frame_resultado" name="frame_resultado">
				<ilayer width="100%" height="300" id="frame_resultado" name="frame_resultado"></ilayer>
			</iframe>
		</td>
	</tr>
</table>
<input type="hidden" id="iniciopagina" name="iniciopagina">
<input type="hidden" id="codproveedor" name="codproveedor" value="<? echo $codproveedor?>">
<table width="100%" border="0">
  <tr>
    <td><div align="center">
      <button type="button" id="btncerrar"  onClick="window.close()" onMouseOver="style.cursor=cursor"> <img src="../img/cerrar.svg" alt="cerrar" /> <span id="tcerrar">Cerrar</span> </button>
    </div></td>
  </tr>
</table>
<iframe id="frame_datos" name="frame_datos" width="0%" height="0" frameborder="0">
	<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
</iframe>
</form>
</div>
</body>
</html>