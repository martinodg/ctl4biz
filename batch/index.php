
<?php
$language="spanish";
$Busqueda="Busqueda de Batch";

if ($language<>"spanish"){$Busqueda="Search for batch";}
?>
<html>
    <head>
	
	<title>batchs</title>
	<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
    <link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>
		<script type="text/JavaScript" language="javascript" src="../calendario/lang/calendar-sp.js"></script>
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar-setup.js"></script>
        <script type="text/javascript" src="../jquery/jquery331.js"></script>
       
        <script language="javascript">
          
          //---------------------------------------------------------------------------------------------------           
          //lots search fucnction
          function buscabatch(){
                                    $.get( "buscarbatch.php" , { criterio1 : 'codstatus',
                                                                    parametro1 : document.getElementById('param1').value,
                                                                    criterio2 : document.getElementById('crit2').value,
                                                                    parametro2 : document.getElementById('param2').value,
                                                                    criterio3 : document.getElementById('crit3').value,
                                                                    parametro3 : document.getElementById('param3').value
                                                              },function ( data ) { 
                                                                                        $('#div_datos').html( data );
                                                                                  }
                                         );
                              }
          //---------------------------------------------------------------------------------------------------         
          //modify lot function
          function modificar(codbt) {
                                        location.href="modificarbatch.html" + "#" +codbt;
                                  }
          //---------------------------------------------------------------------------------------------------             
          //set mouse cursor for different browsers
          var cursor;
		  if (document.all) {
		                        // Está utilizando EXPLORER
		                        cursor='hand';
		                     } else {
		                                // Está utilizando MOZILLA/NETSCAPE
		                                cursor='pointer';
		                             }
          //---------------------------------------------------------------------------------------------------   
          //Perform when DOM is full loaded
          $( document ).ready(function(){
            
                //Load lots data
                buscabatch();
                //---------------------------------------------------------------------------------------------------   
                //Add or remove calendar for cirt1
                $('#crit2, #crit3').change(function(){
                    var seleccion=$(this).val();
                    var campo="param"+$(this).attr('name');
                    var agregar="#entrada"+$(this).attr('name');
                    var calend="calendario"+$(this).attr('name');
                    var calendid="#calendario"+$(this).attr('name');
                    if (seleccion == "fechai" || seleccion == "fechaf") {
                                                                         if ($(calendid).length == 0) {
                                                                                                            //Add it to the dom
                                                                                                            $(agregar).append("\
                                                                                                            <img src='../img/calendario.png' name='"+calend+"' width='16' height='16' border='0' id='"+calend+"' onMouseOver='this.style.cursor=&apos;pointer&apos;'>");
                                                                                                            Calendar.setup(
					                                                                                                        {
					                                                                                                            inputField : campo,
					                                                                                                            ifFormat   : "%Y-%m-%d",
                                                                                                                                button     : calend,
                                                                                                                                onUpdate    : function() {
                                                                                                                                                         buscabatch();
                                                                                                                                                        
                                                                                                                                                        }       
					                                                                                                        }
                                                                                                                           )
                                                                                                            ;
                                                                                                            }
                                                                        }else{
                                                                                $(calendid).detach();
                                                                                $('#'+campo).val('');
                                                                                buscabatch();
                                                                        }
                                             }
                                            )
                ;
                //---------------------------------------------------------------------------------------------------
                //filter for lots search   
                $('#param1, #param2').on("change", buscabatch);
                $('#param2, #param3').on("input", buscabatch);
                
                //---------------------------------------------------------------------------------------------------
                //when we press clean button
                $('#btnlimpiar').click(function(){
                                                    document.getElementById("form_busqueda").reset();
                                                 }
                                      )
                ;
                //---------------------------------------------------------------------------------------------------
                //when we press new button
                $('#btnnuevo').click(function(){
                                                    location.href="nuevobatch.html";
                                                }
                                    )
                ;
                //---------------------------------------------------------------------------------------------------
                //when we press print button
                $('#btnimprimir').click(function(){
                                                        document.getElementById("form_busqueda").reset();
                                                  }
                                        )
                ;
               
             
            });
            //-----------------------------END Perform when DOM is full loaded----------------------------------------------------------------------
            //---------------------------------------------------------------------------------------------------
          
	 </script>
    </head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header"><?echo $Busqueda;?> </div>
				<div id="frmBusqueda">
				<form id="form_busqueda" name="form_busqueda">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="20%">Estado </td>
						
                            <td id="entrada1" with="20%">
                          
                                  <select id='param1' name='param1' class='comboMedio'>
                                    <option value='' selected >Todos los estados</option>
                                    <option value='0'>Inicializado</option>
                                    <option value='1'>Finalizado</option>
                                    <option value='2'>Descartado</option>
                                </select>
                             
                            </td>
                            <td width="20%">&nbsp;</td>
							<td width="40%">&nbsp;</td>
							
						</tr>
<tr>
							<td width="20%">Criterio de busqueda #2 </td>
							<td width="20%"> 
                                <select id="crit2" name="2" class="comboMedio" >
                                    <option value="codarticulo">Articulo del batch</option>
                                    <option value="codbatch">Codigo de batch</option>
                                    <option value="cantidad">Cantidad</option>
                                    <option value="fechai">Fecha de inicio</option>
                                    <option value="horai">Hora de inicio</option>
                                    <option value="fechaf">Fecha de finalizacion</option>
                                    <option value="horaf">Hora de finalizacion</option>
                                </select>
                            </td>
                            <td id="entrada2" with="20%">
                           <input id="param2" name="param2" type="text" class="cajaMediana datepicker" maxlength="45" >
        
                            </td>
							<td width="40%">&nbsp;</td>
						</tr>
<tr>
							<td width="20%">Criterio de busqueda #3 </td>
							<td width="20%"> 
                                <select id="crit3" name="3" class="comboMedio" >
                                    <option value="codbatch">Codigo de batch</option>
                                    <option value="codarticulo">Articulo del batch</option>
                                    <option value="cantidad">Cantidad</option>
                                    <option value="fechai">Fecha de inicio</option>
                                    <option value="horai">Hora de inicio</option>
                                    <option value="fechaf">Fecha de finalizacion</option>
                                    <option value="horaf">Hora de finalizacion</option>
                                </select>
                            </td>
                            <td id="entrada3" with="20%">
                           <input id="param3" name="param3" type="text" class="cajaMediana" maxlength="45" ">
                            </td>
							<td width="40%">&nbsp;</td>
						</tr>
						
						
					</table>
			  </div>
		 	  <div id="botonBusqueda">
                                         <img src="../img/botonlimpiar.jpg" width="69" height="22" border="1" id="btnlimpiar" onMouseOver="style.cursor=cursor">
					 <img src="../img/botonnuevo.jpg" width="58" height="22" border="1" id="btnnuevo" onMouseOver="style.cursor=cursor">
					<img src="../img/botonimprimir.jpg" width="79" height="22" border="1" id="btnimprimir" onMouseOver="style.cursor=cursor"></div>
			  <div id="lineaResultado">
			  <table class="fuente8" width="80%" cellspacing=0 cellpadding=3 border=0>
			  	<tr>
				<td width="50%" align="left">N de batchs encontrados <input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				<td width="50%" align="right">Mostrados <select name="paginas" id="paginas" onChange="paginar()">
		          </select></td>
                </tr>
			  </table>
                               <div ID="div_datos" name="div_datos" > </div> 
				</div>
				
				<input type="hidden" id="iniciopagina" name="iniciopagina">
				<input type="hidden" id="cadena_busqueda" name="cadena_busqueda">
			</form>
                       	
			
			</div>
		  </div>
		</div>
	</body>

