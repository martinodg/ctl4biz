<html>
    <head>
	
	 <title>Lotes</title>
	 <link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
         <script type="text/javascript" src="../jquery/jquery331.js"></script>
         <script language="javascript">
                
 
 
        $( document ).ready(function(){
                    
                $('#param1, #param2, #param3').keyup(function(){
                  /*  console.log($(this));*/
                    $.get( "buscarlote.php" , { criterio1 : document.getElementById('crit1').value,
                                parametro1 : document.getElementById('param1').value,
                                criterio2 : document.getElementById('crit2').value,
                                parametro2 : document.getElementById('param2').value,
                                criterio3 : document.getElementById('crit3').value,
                                parametro3 : document.getElementById('param3').value
                              },
                              function ( data ) {
                        $('#div_datos').html( data );
                    });
                } );
                $('#btnlimpiar').click(function(){
                  			document.getElementById("form_busqueda").reset();

                });
                $('#btnnuevo').click(function(){
                  			location.href="nuevo_proveedor7.php";

                });
                $('#btnimprimir').click(function(){
                  			document.getElementById("form_busqueda").reset();

                });
                      
        });


                
                
                
                
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
				<div id="tituloForm" class="header">Buscar Lote </div>
				<div id="frmBusqueda">
				<form id="form_busqueda" name="form_busqueda" method="post" action="rejilla.php" target="frame_rejilla">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="25%">Criterio de busqueda #1 </td>
							<td> 
                                <select id="crit1" name="crit1" class="comboMedio" >
                                    <option value="codlote">Codigo de Lote</option>
                                    <option value="codarticulo">Articulo del lote</option>
                                    <option value="cantidad">Cantidad</option>
                                    <option value="fechai">Fecha de inicio</option>
                                    <option value="horai">Hora de inicio</option>
                                    <option value="fechaf">Fecha de finalizacion</option>
                                    <option value="horaf">Hora de finalizacion</option>
                                </select>
                           <input id="param1" name="param1" type="text" class="cajaMediana" maxlength="45" value="<? echo $parametro1?>">
                              
                                                       </td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="6%" align="right"></td>
						</tr>
<tr>
							<td width="25%">Criterio de busqueda #2 </td>
							<td> 
                                <select id="crit2" name="crit2" class="comboMedio" >
                                    <option value="codarticulo">Articulo del lote</option>
                                    <option value="codlote">Codigo de lote</option>
                                    <option value="cantidad">Cantidad</option>
                                    <option value="fechai">Fecha de inicio</option>
                                    <option value="horai">Hora de inicio</option>
                                    <option value="fechaf">Fecha de finalizacion</option>
                                    <option value="horaf">Hora de finalizacion</option>
                                </select>
                           <input id="param2" name="param2" type="text" class="cajaMediana" maxlength="45" value="<? echo $parametro2?>">
                            </td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="6%" align="right"></td>
						</tr>
<tr>
							<td width="25%">Criterio de busqueda #3 </td>
							<td> 
                                <select id="crit3" name="crit3" class="comboMedio" >
                                    <option value="cantidad">Cantidad</option>
                                    <option value="codarticulo">Articulo del lote</option>
                                    <option value="codlote">Codigo de lote</option>
                                    <option value="fechai">Fecha de inicio</option>
                                    <option value="horai">Hora de inicio</option>
                                    <option value="fechaf">Fecha de finalizacion</option>
                                    <option value="horaf">Hora de finalizacion</option>
                                </select>
                           <input id="param3" name="param3" type="text" class="cajaMediana" maxlength="45" value="<? echo $parametro3?>">
                            </td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="6%" align="right"></td>
						</tr>
						
						
					</table>
			  </div>
		 	  <div id="botonBusqueda">
                                         <button type="button" id="btnlimpiar" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span>Limpiar</span> </button>
					 <button type="button" id="btnnuevo" onMouseOver="style.cursor=cursor"> <img src="../img/nuevo.svg" alt="nuevo" /> <span>Nuevo</span> </button>
					<button type="button" id="btnimprimir" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span>Imprimir</span> </button>
			  <div id="lineaResultado">
			  <table class="fuente8" width="80%" cellspacing=0 cellpadding=3 border=0>
			  	<tr>
				<td width="50%" class="paginar" align="left">N de trabajadores encontrados <input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				<td width="50%" class="paginar" align="right">Mostrados <select name="paginas" id="paginas" onChange="paginar()">
		          </select></td>
			  </table>
				</div>
				<div id="cabeceraResultado" class="header">
					relacion de LOTES </div>
				<div id="frmResultado">
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="8%">CODIGO</td>
							<td width="6%">ARTICULO</td>
							<td width="38%">CANTIDAD</td>
							<td width="13%">FECHA DE INICIO</td>
							<td width="19%">HORA DE INICIO</td>
                                                        <td width="19%">FECHA DE FIN</td>
							<td width="19%">HORA DE FIN</td>
                                                        <td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="6%">&nbsp;</td>
						</tr>
				</table>
				</div>
				<input type="hidden" id="iniciopagina" name="iniciopagina">
				<input type="hidden" id="cadena_busqueda" name="cadena_busqueda">
			</form>
                        <div ID="div_datos" name="div_datos" > </div> 	
			
			</div>
		  </div>
		</div>
	</body>

