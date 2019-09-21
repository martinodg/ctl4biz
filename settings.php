
<html>
	<head>
		<title>Settings</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		
		<script language="javascript">
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
	<body >
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				    <div id="tituloForm" class="header">Copias de Respaldo </div>
				    <div id="frmBusqueda">
				
					    <table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>					
						    <tr>
							    <td width="20%"><img src="./img/upload.svg" class="iconolado" width="34" height="34" alt="hacer copia"></td>
							    <td width="80%"><a href="./backup/hacerbak.php" target="principal" id="tipoarticulos">Hacer copia de respaldo</a></td>
							    
						    </tr>
						    <tr>
                            <td width="20%"><img src="./img/download.svg" class="iconolado" width="34" height="34" alt="restaurar copia"></td>
							    <td width="80%"><a href="./backup/restaurarbak.php" target="principal" id="tipoarticulos">Restaurar copia de respaldo</a></td>
							    
						    </tr>
						
					    </table>
                    </div>
                    
                    <div style="margin-bottom:8px;"></div>
                    
                    
                    
                    
                    <div id="tituloForm" class="header">Administracion de Usuarios </div>
				    <div id="frmBusqueda">
				
					    <table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>					
						    <tr>
							    <td width="16%">Codigo de cliente </td>
							    <td width="68%"><input id="codcliente" type="text" class="cajaPequena" NAME="codcliente" maxlength="10" value="<? echo $codcliente?>"> <img src="../img/ver.png" width="16" height="16" onClick="abreVentana()" title="Buscar cliente" onMouseOver="style.cursor=cursor"> <img src="../img/cliente.png" width="16" height="16" onClick="validarcliente()" title="Validar cliente" onMouseOver="style.cursor=cursor"></td>
							    <td width="5%">&nbsp;</td>
							    <td width="5%">&nbsp;</td>
							    <td width="6%" align="right"></td>
						    </tr>
						    <tr>
							    <td>Nombre</td>
							    <td><input id="nombre" name="nombre" type="text" class="cajaGrande" maxlength="45" value="<? echo $nombre?>"></td>
							    <td>&nbsp;</td>
							    <td>&nbsp;</td>
						    </tr>
						
					    </table>
			        </div>
                </div>
				
			</div>
		  			
		</div>
	</body>
</html>
