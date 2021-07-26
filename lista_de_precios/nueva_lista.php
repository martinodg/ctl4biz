<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../funciones/validar.js"></script>
		<script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
		 
		<script language="javascript">
		$( document ).ready(function(){ 
			var codlst = window.location.hash.substring(1);
			alert(codlst);
		});

		function cancelar() {
			location.href="index.php";
		}
		
		function limpiar() {
			document.getElementById("nombre").value=""; 
		}
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header"><span  id="tinsnuelst">INSERTAR LISTA DE PRECIOS</span> </div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="../funciones/BackendQueries/insertPriceListName.php">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
						  <td width="19%"><span  id="tnomb">Nombre</span></td>
						  <td width="80%"><input NAME="Anombre" type="text" class="cajaGrande" id="nombre" size="50" maxlength="50"></td>
					      <td width="1%" rowspan="14" align="left" valign="top"><ul id="lista-errores"></ul></td>
					  </tr>		
					  <tr>
						  <td><span  id="porcdefault">Porcentaje Predefinido</span></td>
						  <td><input NAME="Rporcentaje" type="text" class="cajaMedia" id="porcentaje" size="6" maxlength="6"> %</td>
						  

					</table>
			  </div>
				<div id="botonBusqueda">
					<button type="button" id="btnaceptar" onClick="validar(formulario,true)"  onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span  id="taceptar">Aceptar</span> </button>

					<button type="button" id="btnlimpiar"  onClick="limpiar()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span  id="tlimpiar">Limpiar</span> </button>
					<button type="button" id="btncancelar"  onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/cancelar.svg" alt="cancelar" /> <span  id="tcancelar">Cancelar</span> </button>
					<input id="accion" name="accion" value="alta" type="hidden">
					<input id="id" name="id" value="" type="hidden">
			  </div>
			  </form>
			 </div>
		  </div>
		</div>
	</body>
</html>
