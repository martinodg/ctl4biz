<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../funciones/validar.js"></script>
		<script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
		 
		<script language="javascript">
		$( document ).ready(function(){ 
			$.get( "../funciones/BackendQueries/loadCboFamily.php" , { defaulSelect:"1"
                                                                     },function ( data ) { 
                                                                                        $('#cboFamily').html(data);   
																						traducirOptions(); 
                                                                                  }
                );
			var codlst = window.location.hash.substring(1);
			if (codlst!=""){
				$("#id").val(codlst);
				$.getJSON("../funciones/BackendQueries/getPriceListData.php", {
                    codList: codlst
					},
                	function(data) {
                    		/*alert(data);*/
                    		$('#nombre').val(data.nombre);
							$('#porcentaje').val(data.porcentaje);
					}
				);

			}
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
					<input id="id" name="Nid" value="" type="hidden">
			  </div>
			  <div id="frameBusqueda" class="header">
					<span  id="tbuscaart">Buequeda de Articulos</span> </div>
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td><span  id="tflia">FAMILIA</span></td>
							<td>
						  		<select id="cboFamily" class="comboMedio" name="cboFamily">
								</select> 
							</td>
					    </tr>
						<tr>
						  <td><span  id="tcodart">Codigo de Articulo</span></td>
						  <td><input NAME="codarticulo" type="text" class="cajaMedia" id="codarticulo" size="6" maxlength="6"> 
						</td>
						
						<tr>
						  <td width="19%"><span  id="tnomb">Nombre</span></td>
						  <td width="80%"><input NAME="Anombre" type="text" class="cajaGrande" id="nombre" size="50" maxlength="50"></td>
					      <td width="1%" rowspan="14" align="left" valign="top"><ul id="lista-errores"></ul></td>
					  </tr>		
					</table>
					<div id="cabeceraResultado" class="header">
					<span  id="articu">Articulos</span> </div>
				<div id="frmResultado">
			  
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							
							<td width="10%"><span  id="tcodigo">CODIGO</span></td>
							<td width="20%"><span  id="tipodart">FAMILIA</span></td>
							<td width="40%"><span  id="tnomb">NOMBRE DEL ITEM</span></td>
							<td width="10%"><span  id="ulticost">ULTIMO COSTO</span></td>
							<td width="10%"><span  id="costref">COSTO DE REFERENCIA</span></td>
							<td width="10%"><span  id="margen">MARGEN</span></td>
							<td width="10%"><span  id="precioantimpuestos">PRECIO ANTES DE IMPUESTOS</span></td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
						</tr>
				</table>
				</div>
				
				<input type="hidden" id="iniciopagina" name="iniciopagina">
				
			</form>
			<div ID="div_datos" name="div_datos" > </div> 	
			<div ID="div_datos2" name="div_datos2" > </div> 
			 </div>
		  </div>
		</div>
	</body>
</html>
