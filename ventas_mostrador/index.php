<?php 
require_once("../conectar7.php"); 
if(session_id() == '') {
    session_start();
}
$id_resource='3';
$id_sresource='10';
require_once("../racf/purePhpVerify.php");



?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>
		<!-- <script type="text/JavaScript" language="javascript" src="../calendario/lang/calendar-sp.js"></script> -->
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar-setup.js"></script>
		<script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
		<script language="javascript">   
		
        
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
        //INITIALIZE INVOICE NUMBER AND DATA
        initInvoice('tempInvoice');
        
		//Perform when DOM is full loaded
		$( document ).ready(function(){

			$('#codcliente').on('keyup', function(){
				var seleccion=$(this).val();
				getClientData(seleccion);
			});
			//LOAD INVOICE ADDED ITEMS LINES
			var id_tmpInvoice=$("#codfacturatmp").val();
			getInvoiceLines('tempInvoice',id_tmpInvoice);
			
			var id_cliente=$("#codcliente").val();
			getClientData(id_cliente);

			

             
			//load process combo vacio
			$.get("../sel_unidadmedida.php", function(data) {
            	    $('.cboUnidadmedida').html(data);
            });
		});
        function initInvoice(d_type) {
            
			$.getJSON('../funciones/BackendQueries/initInvoice.php', 
					{
                        docType: d_type
					}, 
					function(data) {
                            $('#fecha').val(data.today);
                            $('#codfacturatmp').val(data.idInvoice);
							//$('#errorMessages').val(data.messages);
							console.log(data.messages);
                    }
            );
		} 
		function getInvoiceLines(d_type,id_invoice) {	
			$.get( "../funciones/BackendQueries/getInvoiceLines.php" , 
					{ 
						docType: d_type,
						idInvoice: id_invoice                                                
					},
					function ( data ) { 
                            $('#div_datos').html( data );
                    }
            );
		}
		function getClientData(id_client) {
			$.getJSON('../funciones/BackendQueries/getClientData.php', 
					{
                        idClient: id_client
					}, 
					function(data) {
                            $('#nombreCliente').val(data.ClientName);
							console.log(data.messages);
					}
			);
		}
		function getItemData(id_category) {
			$.getJSON('../funciones/BackendQueries/getItemsData.php', 
					{
                        idCategory: id_category
					}, 
					function(data) {
                            $('.modal__window').html( data );
					}
			);
		}
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
			<div id="modal">
  				<div class="modal__window">
      				<a class="modal__close" href="#"><img src="../img/borrar.svg" width="16" height="16" border="0" onMouseOver="this.style.cursor='pointer'"></a>
      			<div id="windownData"></div>	
			</div> 
			  </div>
				<div align="center">
				<div id="tituloForm" class="header" id="tvntmst">VENTA MOSTRADOR</div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_factura.php">
				<input id="codfacturatmp" name="codfacturatmp" type="hidden">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="10%"><span id="cod_cliente">C&oacute;digo Cliente</span></td>
					      <td width="50%"><input NAME="codcliente" value="1" type="text" class="cajaPequena" id="codcliente" size="6" maxlength="5" onClick="limpiarcaja()">
					        <img src="../img/ver.svg" width="16" height="16" onClick="abreVentana()" data-ttitle="bcliente" title="Buscar cliente" onMouseOver="style.cursor=cursor"> <img src="../img/cliente.svg" width="16" height="16" onClick="validarcliente()" data-ttitle="tvalclt" title="Validar cliente" onMouseOver="style.cursor=cursor"></td>
						  <td width="10%"></td>
                          <td width="50%"></td>	
                        </tr>
						<tr>
							<td>Nombre Cliente</td>
						    <td><input NAME="nombreCliente" type="text" class="cajaGrande" id="nombreCliente" size="45" maxlength="45" readonly></td>
				            <td></td>
				            <td></td>
						</tr>
						
						<tr>
							<td><span id="tfecha">Fecha</span></td>
						    <td><input NAME="fecha" type="text" class="cajaPequena" id="fecha" size="10" maxlength="10" " readonly> <img src="../img/calendario.svg" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fecha",
					ifFormat   : "%Y-%m-%d", //"%d/%m/%Y",
					button     : "Image1"
					  }
					);
		</script></td>
				            <td></td>
				            <td></td>
						</tr>
					</table>										
			  </div>
			  
			
			  </form>
			  
			  <br>
			  <div id="frmBusqueda">
				<form id="formulario_lineas" name="formulario_lineas" method="post" action="frame_lineas.php" target="frame_lineas">
				<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
				  <tr>
					<td width="10%"><span id="tcodbarr">Codigo barras</span> </td>
					<td colspan="10" valign="middle"><input NAME="codbarras" type="text" class="cajaMedia" id="codbarras" size="15" maxlength="15"> </td>
				  </tr>
                   <tr>
					<td width="10%"><span id="tcodart">Codigo de articulo</span> </td>
					<td colspan="10" valign="middle"><input NAME="codArticulo" type="text" class="cajaMedia" id="codArticulo" size="15" maxlength="15"> 
						<a href="#modal"><img src="../img/ver.svg" width="16" height="16"  onMouseOver="style.cursor=cursor" data-ttitle="valcodbar" title="Validar codigo de barras">  </a>
					</td>
				  </tr>
				  <tr>
					<td width="5%"><span id="descri">descripcion</span></td>
					<td width="20%"><input NAME="descripcion" type="text" class="cajaMedia" id="descripcion" size="30" maxlength="30" readonly></td>
					<td width="5%"><span id="tprecio">PRECIO</span></td>
					<td width="20%"><input NAME="precio" type="text" class="cajaPequena2" id="precio" size="10" maxlength="10" onChange="actualizar_importe()"> &#8364;</td>
					<td width="5%"><span id="tcant">CANTIDAD</span></td>
					<td width="25%"><input NAME="cantidad" type="text" class="cajaMinima" id="cantidad" size="10" maxlength="10" value="1" onChange="actualizar_importe()">
					<select id="umnstock" class="cboUnidadmedida" name="umnstock" onChange="actualizar_importe()" >
                                
								</select></td>
                    <td width="20%"></td>
                 </tr>
                 <tr>
					<td><span id="tdcto">Dcto.</span></td>
					<td><input NAME="descuento" type="text" class="cajaMinima" id="descuento" size="10" maxlength="10" onChange="actualizar_importe()"> %</td>
					<td><span id="timporte">IMPORTE</span></td>
					<td><input NAME="importe" type="text" class="cajaPequena2" id="importe" size="10" maxlength="10" value="0" readonly> &#8364;</td>
					<td><span id="tiva">IVA</span></td>
                    <td><select id="impuesto" class="cboImpuesto" name="impuesto" onChange="actualizar_importe()" >
                                
								</select></td>
                    <td><button type="button" id="btnagregar" onClick="validar()" onMouseOver="style.cursor=cursor"> <img src="../img/agregar.svg" alt="agregar" /> <span id="tagregar">Agregar</span> </button></td>
				  </tr>
				</table>
				</div>
				<div id="errorMessages"></div>
				<br>
				<div id="frmBusqueda">
				<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="5%"><span id="titem">ITEM</span></td>
							<td width="12%"><span id="tflia">FAMILIA</span></td>
							<td width="14%"><span id="referenc">REFERENCIA</span></td>
							<td width="33%"><span id="descri">descripcion</span></td>
							<td width="8%"><span id="tcant">CANTIDAD</span></td>
							<td width="8%"><span id="tprecio">PRECIO</span></td>
							<td width="7%"><span id="tdctop">DCTO %</span></td>
							<td width="8%"><span id="timporte">IMPORTE</span></td>
							<td width="3%">&nbsp;</td>
						</tr>
				</table>
				<div ID="div_datos" name="div_datos" > </div> 			
			  </div>
			  <div id="frmBusqueda">
			<table width="25%" border=0 align="right" cellpadding=3 cellspacing=0 class="fuente8">
			  <tr>
			    <td width="27%" class="busqueda"><span id="subtotal">Subtotal</span></td>
				<td width="73%" align="right"><div align="center">
			      <input class="cajaTotales" name="baseimponible" type="text" id="baseimponible" size="12" value=0 align="right" readonly> 
		        &#8364;</div></td>
			  </tr>
			  <tr>
				<td class="busqueda"><span id="tiva">IVA</span></td>
				<td align="right"><div align="center">
			      <input class="cajaTotales" name="baseimpuestos" type="text" id="baseimpuestos" size="12" align="right" value=0 readonly> 
		        &#8364;</div></td>
			  </tr>
			  <tr>
				<td class="busqueda"><span id="tpciototal">Precio Total</span></td>
				<td align="right"><div align="center">
			      <input class="cajaTotales" name="preciototal" type="text" id="preciototal" size="12" align="right" value=0 readonly> 
		        &#8364;</div></td>
			  </tr>
		</table>
			  </div>
				<div id="botonBusqueda">					
				  <div align="center">
				  	<button type="button" id="btnaceptar" onClick="validar_cabecera()" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span id="taceptar">Aceptar</span> </button>
               		<button type="button" id="btncancelar" onClick="cancelar()"onMouseOver="style.cursor=cursor"> <img src="../img/borrar.svg" alt="nuevo" /> <span id="tcancelar">Cancelar</span> </button>
				    <input id="codfamilia" name="codfamilia" value="<? echo $codfamilia?>" type="hidden">
				    <input id="codfacturatmp" name="codfacturatmp" value="<? echo $codfacturatmp?>" type="hidden">	
					<input id="preciototal2" name="preciototal" value="<? echo $preciototal?>" type="hidden">			    
			      </div>
				</div>
			  		<iframe id="frame_datos" name="frame_datos" width="0" height="0" frameborder="0">
					<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
					</iframe>
			  </form>
			 </div>
		  </div>
		</div>
		
	</body>
</html>
