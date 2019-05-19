<?php 
include ("../conectar7.php"); 
?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script language="javascript">
                
 
 
          $( document ).ready(function(){
                //filter for search   
                $('#codarticulo, #nombrearticulo').keyup(function(){
                  /*  console.log($(this));*/
                    $.get( "../articulos/buscararticulo.php" , { codart : document.getElementById('codarticulo').value,
                                nombreart : document.getElementById('nombrearticulo').value
                              },
                              function ( data ) {
                        $('#div_datos').html( data );
                    });
                } );
                //when we press clean button
                $('#btnlimpiar').click(function(){
                    document.getElementById("form_busqueda").reset();

                });
                //when we press new button
                $('#btnnuevo').click(function(){
                    location.href="nuevolote.php";

                });
                //when we press print button
                $('#btnimprimir').click(function(){
                    document.getElementById("form_busqueda").reset();

                });
                      
          });

		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">Nuevo Lote </div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_trabajador.php">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="10%">Codigo de lote</td>
						    <td width="20%"><input NAME="anombre" type="text" class="cajaPequena" id="nombre" size="10"></td>
						</tr>
                                                <tr>
							<td width="10%">Asignar articulo por</td>
                                                        <td width="20%">codigo de Articulo <input id="codarticulo" type="text" class="cajaPequena" NAME="codarticulo" maxlength="15"></td>
						        <td width="20%">nombre de Articulo <input id="nombrearticulo" type="text" class="cajaGrande" NAME="nombrearticulo" size="45"></td>
					        
						</tr>
						<tr>
						  <td>Cantidad</td>
						  <td><input id="nif" type="text" class="cajaPequena" NAME="anif" maxlength="15"></td>
				      </tr>
						<tr>
						  <td>Fecha de inicio</td>
						  <td><input NAME="apassword" type="text" class="cajaPequena" id="password" size="20" maxlength="20"></td>
				      </tr>
						<tr>
							<td>Hora de inicio</td>
							<td><input id="cuentabanco" type="text" class="cajaPequena" NAME="atelefono" maxlength="20"></td>
					    </tr>
						
												<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
					    </tr>
					</table>
			  </div>
<div id="botonBusqueda">
					<img src="../img/botonaceptar.jpg" width="85" height="22" onClick="validar(formulario,true)" border="1" onMouseOver="style.cursor=cursor">
					<img src="../img/botonlimpiar.jpg" width="69" height="22" onClick="limpiar()" border="1" onMouseOver="style.cursor=cursor">
					<img src="../img/botoncancelar.jpg" width="85" height="22" onClick="cancelar()" border="1" onMouseOver="style.cursor=cursor">
					<input id="accion" name="accion" value="alta" type="hidden">
					<input id="id" name="Zid" value="" type="hidden">
			  </div>
			  </form>
                                      <div id="lineaResultado">
			  <table class="fuente8" width="80%" cellspacing=0 cellpadding=3 border=0>
			  	<tr>
				<td width="50%" align="left">N de trabajadores encontrados <input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				<td width="50%" align="right">Mostrados <select name="paginas" id="paginas" onChange="paginar()">
		          </select></td>
			  </table>
				</div>
				<div id="cabeceraResultado" class="header">
					Articulo del lote </div>
				<div id="frmResultado">
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="8%">CODIGO de articulo</td>
							<td width="6%">Nombre de ARTICULO</td>
                                                        <td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="6%">&nbsp;</td>
						</tr>
				</table>
				</div>
                                       <div ID="div_datos" name="div_datos" > </div> 	
			  </div>
		  </div>
		</div>
	</body>
</html>
