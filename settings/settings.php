
<html>
	<head>
		<title>Settings</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../jquery/jquery331.js"></script>
		<script type="text/javascript" src="../funciones/paginar.js"></script>

		<script language="javascript">
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		usuarios();
		buscaUsuarios();

		//-----------------------------------------------------------------------
		//FUNCTIONS
		//-----------------------------------------------------------------------
		function usuarios(){
			$.get("usuarios.php", function(data) {
            	    $('#busqueda').html(data);
            	});      	
		}
		function roles(){
			$.get("roles.php", function(data) {
            	    $('#busqueda').html(data);
            	});      	
		}
		//this function setup pagination and reload 
		function paginar(){
            //alert(document.getElementById("paginas").value);
            document.getElementById("iniciopagina").value = document.getElementById("paginas").value;
            buscaUsuarios();
          }
		function buscaUsuarios(){
                                $.get("buscarUsuario.php", { criterio1 : 'intUserName',
                                                                    parametro1 : document.getElementById('nombreUsuario').value,
                                                                    criterio2 : 'intUserMail',
                                                                    parametro2 : document.getElementById('mailUsuario').value,
                                                                    paginainicio: document.getElementById('iniciopagina').value
                                                              	 },function ( data ) { 
                                                                                        $('#div_datos').html( data );
                                                                                        calculaPaginacion();
                                                                                  }
                                         );
		}
		//function limpiarBusqueda(){
		//	document.getElementById("form_busqueda").reset();
		//}				 
		
	//when we write on the 
	$(document).on('keyup','#nombreUsuario',buscaUsuarios);
				$(document).on('keyup','#mailUsuario',buscaUsuarios);
				
			 //---------------------------------------------------------------------------------------------------
				//when we press clean button
				$(document).on('click','#btnlimpiar',function(){
					document.getElementById("form_busqueda").reset();
				});
		//Perform when DOM is full loaded
       /* $( document ).ready(function(){

			//usuarios();
			buscaUsuarios();

				
                //$('#btnlimpiar').click(function(){
                //                                    document.getElementById("form_busqueda").reset();
                //                                 }
                //                      )
                //;
                //---------------------------------------------------------------------------------------------------
                //when we press new button
                $('#btnnuevo').click(function(){
                                                    location.href="nuevolote.html";
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
		});	*/
		
		</script>
	</head>
	<body >
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				    <div id="tituloForm" class="header">Copias de Respaldo </div>
				    <div id="frmBusqueda">
				
					    		<br>	
						  
							   
								<button type="button" id="btnhacerrespaldo" onClick="window.location.href = '../backup/hacerbak.php';" onMouseOver="style.cursor=cursor"> <img src="../img/upload.svg" alt="limpiar" /> <span>Hacer copia de respaldo</span> </button>
								
							    
						   
								
								<button type="button" id="btnhacerrespaldo" onClick="window.location.href = '../backup/restaurarbak.php';" onMouseOver="style.cursor=cursor"> <img src="../img/download.svg" alt="limpiar" /> <span>Restaurar copia de respaldo</span> </button> 
						   
                    </div>
				</div>
                   
                    
                    
                    
                    
				<div id="tituloForm" class="header">Administracion de Seguridad </div>
				<div id="frmBusqueda">
					<div id="botonBusqueda">
               			<button type="button" id="btnusuarios" onClick="usuarios()" onMouseOver="style.cursor=cursor"> <img src="../img/usuarios.svg" alt="limpiar" /> <span>Usuarios</span> </button>
               			<button type="button" id="btnroles" onClick="roles()" onMouseOver="style.cursor=cursor"> <img src="../img/roles.svg" alt="nuevo" /> <span>Roles</span> </button>

					</div>
				</div>
				<form id="form_busqueda" name="form_busqueda">
					<div id="busqueda"></div>  
				</form>
				<div id="botonBusqueda">
                    <button type="button" id="btnlimpiar" onClick="limpiarBusqueda()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span>Limpiar</span> </button>
               		<button type="button" id="btnnuevo" onMouseOver="style.cursor=cursor"> <img src="../img/usuariog.svg" alt="nuevo" /> <span>Nuevo</span> </button>
               		<button type="button" id="btnimprimir" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span>Imprimir</span> </button>
              	</div>
			  		<div id="lineaResultado">
			  			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0>
			  				<tr>
				  				<td width="50%" align="left" class="paginar">N de lotes encontrados <input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				  				<td width="50%" align="right" class="paginar">Mostrados <select name="paginas" id="paginas" onChange="paginar()">
																		  </select>
								</td>
                			</tr>
			  			</table>
                        <div id="div_datos" name="div_datos" ></div> 
					</div>
				
					<input type="hidden" id="iniciopagina" name="iniciopagina" value="0">
					<input type="hidden" id="cadena_busqueda" name="cadena_busqueda">
				
            </div>
		</div>		  			
	</body>
</html>
