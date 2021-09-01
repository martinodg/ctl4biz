<?php
require_once("../conectar7.php");
$id_resource='6';
$id_sresource='26';
require_once("../racf/purePhpVerify.php");





?>
<html>
	<head>
		<title>Listas de Precios</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
		<script type="text/javascript" src="../funciones/paginar.js"></script>
		 
        
        <script language="javascript">

		$(document).ready(function(){
			
			getPriceListLines('%','%',0,1,0,1);
			$("#codlista,#nombre").change(function(){	
				var codigo='%'+$("#codlista").val()+'%';
				var nombreLista=$("#nombre").val()+'%';
				if (codigo==""){var codigo='%';}
				if (nombreLista==""){var nombreLista='%';}
				getPriceListLines(codigo,nombreLista,0,1,0,1);
			});
		
			var cursor;
			if (document.all) {
			// Está utilizando EXPLORER
			cursor='hand';
			} else {
			// Está utilizando MOZILLA/NETSCAPE
			cursor='pointer';
			}
		});
	

		function nueva_lista() {
			location.href="nueva_lista.php";
		}

		/*function imprimir() {
			var codtrabajador=document.getElementById("codtrabajador").value;
			var nombre=document.getElementById("nombre").value;
			var nif=document.getElementById("nif").value;
			var provincia=document.getElementById("cboProvincias").value;
			var localidad=document.getElementById("localidad").value;
			var telefono=document.getElementById("telefono").value;
			window.open("../fpdf/trabajadores.php?codtrabajador="+codtrabajador+"&nombre="+nombre+"&nif="+nif+"&provincia="+provincia+"&localidad="+localidad+"&telefono="+telefono);
		}*/

		

		function paginar() {
			document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
			//document.getElementById("form_busqueda").submit();
				var codigo='%'+$("#codlista").val()+'%';
				var nombreLista=$("#nombre").val()+'%';
				if (codigo==""){var codigo='%';}
				if (nombreLista==""){var nombreLista='%';}
				getPriceListLines(codigo,nombreLista,0,1,0,1);
		}

		

		function limpiar() {
			document.getElementById("form_busqueda").reset();
		}

		function abreVentana(){
			miPopup = window.open("ventana_trabajadores.php","miwin","width=700,height=380,scrollbars=yes");
			miPopup.focus();
		}

	
		function getPriceListLines(id_pricelist,pl_name,ver,modifica,seleccionar,eliminar) {	
			$.get( "../funciones/BackendQueries/getPriceListLines.php" , 
					{ 
						idPriceList: id_pricelist, 
						pLName: pl_name,
						toolVer: ver, 
						toolModificar: modifica,
						toolSeleccionar: seleccionar,
						toolEliminar: eliminar,
						iniciopagina: $("#iniciopagina").val()
					},
					function ( data ) { 
                            $('#div_datos').html( data );
							calculaPaginacion();
                    }
            );
		}

		function remove(id_list) {
			
			$.get( "../funciones/BackendQueries/removePriceListLine.php" , 
					{ 	idList: id_list
					},
					function ( data ) { 
                            $('#div_datos2').html( data );
							var codigo='%'+$("#codlista").val()+'%';
							var nombreLista=$("#nombre").val()+'%';
							if (codigo==""){var codigo='%';}
							if (nombreLista==""){var nombreLista='%';}
							getPriceListLines(codigo,nombreLista,0,1,0,1);
                    }
            );
		}
		
		function modify(id_list) {
			location.href="nueva_lista.php" + "#" + id_list;
		}
		</script>

	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
			<div id="modal">
  				<div class="modal__window">
      				<a class="modal__close" href="#"><img src="../img/borrar.svg" width="16" height="16" border="0" onMouseOver="this.style.cursor='pointer'"></a>
      				<div id="windowFilter">
					  <form id="formulario_filtro" name="formulario_filtro">
						<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
							<tr>
						 		<td><span  id="flia">Tipo de articulo</span></td>
								<td>
						  			<select id="cboFamily" class="comboMedio" name="cboFamily">
									</select> 
								</td>
				      		</tr>	
							<tr>
								<td width="10%"><span  id="referenc">Referencia</span> </td>
								<td colspan="10" valign="middle"><input NAME="referencia" type="text" class="cajaMedia" id="referencia" size="15" maxlength="15"> </td>
				 			</tr>
							<tr>
								<td width="10%"><span  id="descri">Descripcion</span> </td>
								<td colspan="10" valign="middle"><input NAME="descripcion" type="text" class="cajaGrande" id="descripcion" size="15" maxlength="15"> </td>
				 			</tr>
						</table>
					  </form>	
				  	</div>	
					<div  class="header">
						<table>
							<tr>
								<td width="5%"><div align="center"><span class="header" id="tcodigo">Codigo</span></div></td>
								<td width="15%"><div align="center"><span class="header" id="tflia">Familia</div</span></td>
								<td width="15%"><div align="center"><span class="header" id="tdescri">Descripcion</span></div></td>
								<td width="20%"><div align="center"><span class="header" id="tprecio">Precio</span></div></td>
								<td width="18%"><div align="center"><span class="header" id="tundmed">Unidad</span></div></td>
								<td width="15%"><div align="center"><span class="header" id="tflia">Impuesto</span></div></td>
								<td width="12%">&nbsp;</td>
		  					</tr>
							<tr>
								<td width="5%">&nbsp;</td>
							</tr>
		  				</table>  
						  </br>
						  </br>
						  </br>
					</div>
				  	<div id="windowData"></div>	
				</div> 
			</div>
				<div align="center">
                    <div id="tituloForm" class="header"><span  id="lstprecios">Listado de Precios</span></div>
				<div id="frmBusqueda">
				<form id="form_busqueda" name="form_busqueda" method="post" action="rejilla.php" target="frame_rejilla">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="16%"><span  id="tcodlstprecios">Codigo de lista de precios </span></td>
							<td width="68%"><input id="codlista" type="text" class="cajaPequena" NAME="codlista" maxlength="10" > 
							<a href="#modal"><img src="../img/ver.svg" width="16" height="16"  onMouseOver="style.cursor=cursor" data-ttitle="valcodbar" title="Validar codigo de barras">  </a>
							</td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="6%" align="right"></td>
						</tr>
						<tr>
							<td><span  id="tnomb">Nombre</span></td>
							<td><input id="nombre" name="nombre" type="text" class="cajaGrande" maxlength="45" ></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						
					
					</table>
			  </div>
		 	  <div id="botonBusqueda">
                <button type="button" id="btnlimpiar"  onClick="limpiar()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span  id="tlimpiar">Limpiar</span> </button>
                <button type="button" id="btnnuevo" onClick="nueva_lista()" onMouseOver="style.cursor=cursor"> <img src="../img/nuevo.svg" alt="nuevo" /> <span  id="tnuevo">Nuevo</span> </button>
                <button type="button" id="btnimprimir"  onClick="imprimir()" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span  id="timpr">Imprimir</span> </button>
               </div>
			  <div id="lineaResultado">
			  <table class="fuente8" width="80%" cellspacing=0 cellpadding=3 border=0>
			  	<tr>
				<td width="50%" class="paginar" align="left"><span  id="tnrolstpen">N de listas encontrados</span> <input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				<td width="50%" class="paginar" align="right"><span  id="tmostra">Mostrados</span> <select name="paginas" id="paginas" onChange="paginar()">
		          </select></td>
			  </table>
				</div>
				<div id="cabeceraResultado" class="header">
					<span  id="lstsprecios">relacion de LISTA DE PRECIOS</span> </div>
				<div id="frmResultado">
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							
							<td width="10%"><span  id="tcodigo">CODIGO</span></td>
							<td width="40%"><span  id="tnomb">NOMBRE</span></td>
							<td width="10%"><span  id="porcdefault">PORCENTAJE PREDEFINIDO</span></td>
							<td width="10%">&nbsp;</td>
							<td width="10%">&nbsp;</td>
							<td width="10%">&nbsp;</td>
							<td width="10%">&nbsp;</td>
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
