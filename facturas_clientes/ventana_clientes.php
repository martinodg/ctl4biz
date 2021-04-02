<? require_once("../conectar7.php"); ?>
<html>
<head>
<script type="text/javascript" src="../jquery/jquery331.js"></script>
<script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
<title>Buscador de Clientes</title>
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

</script>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
</head>

<body onLoad="buscar()">
<form name="form1" id="form1" method="post" action="frame_clientes_ini.php" target="frame_resultado" onSubmit="buscar()">
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
</body>
</html>
