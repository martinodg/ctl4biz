<?php require_once("../conectar7.php"); ?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../funciones/validar.js"></script>
		<script language="javascript">
		
		function cancelar() {
			location.href="index.php";
		}
		
		function limpiar() {
			document.getElementById("nombre").value="";
			document.getElementById("valor").value="";
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
                    <div id="tituloForm" class="header"><span id="tinsimp">INSERTAR IMPUESTO</span></div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_impuesto.php">
				  <table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
                    <tr>
                      <td width="4%"><span id="tnomb">Nombre</span></td>
                      <td width="32%"><input name="Anombre" type="text" class="cajaGrande" id="nombre" size="20" maxlength="20"></td>
                      <td width="64%" rowspan="2" align="left" valign="top"><ul id="lista-errores">
                      </ul></td>
                    </tr>
                    <tr>
                      <td><span id="tvalor">Valor</span></td>
                      <td><input name="Qvalor" type="text" class="cajaPequena" id="valor" size="5" maxlength="5">%</td>
                    </tr>
                  </table>
				  </div>
                  <div id="botonBusqueda">
					<button type="button" id="btnaceptar" onClick="validar(formulario,true)"  onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span id="taceptar">Aceptar</span> </button>
					<button type="button" id="btnlimpiar"  onClick="limpiar()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span id="tlimpiar">Limpiar</span> </button>
					<button type="button" id="btncancelar"  onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/cancelar.svg" alt="cancelar" /> <span id="tcancelar">Cancelar</span> </button>
					<input id="accion" name="accion" value="alta" type="hidden">
					<input id="id" name="id" value="" type="hidden">
			      </div>
			  </form>
			 </div>
		  </div>
		</div>
	</body>
</html>
