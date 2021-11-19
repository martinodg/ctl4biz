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
        //load family item combo
			$.get( "../funciones/BackendQueries/loadCboFamily.php" , { defaulSelect:"1"
                                                                     },function ( data ) { 
                                                                                        $('#cboFamily').html(data);    
                                                                                  }
                );
				$.get( "../funciones/BackendQueries/loadCboTax.php" , { defaulSelect:"1"
                                                                     },function ( data ) { 
                                                                                        $('#impuesto').html(data);    
																						$('#impuesto').attr('class', 'comboMedio');
                                                                                  }
                );

				
		//Perform when DOM is full loaded
		$( document ).ready(function(){

			$('#divNumeroFactura').hide();
			//filter for procs search   
			$('#cboFamily').change(function(){
				var idcat=$(this).val();
				var des=$('#descripcion').val();
				var ref=$('#referencia').val();
				//alert(idcat);
				getItemList(idcat,ref,des);
			});

            $("#referencia").keyup( function() {
				var ref=$(this).val();
				var des=$('#descripcion').val();
				var idcat=$('#cboFamily').val();
				getItemList(idcat,ref,des);
			});
			
			$('#descripcion').keyup(function(){
				var des=$(this).val();
				var ref=$('#referencia').val();
				var idcat=$('#cboFamily').val();
				//alert(des);
				getItemList(idcat,ref,des);
			});


			$('#codcliente').on('keyup', function(){
				var seleccion=$(this).val();
				getClientData(seleccion);
			});
			//LOAD INVOICE ADDED ITEMS LINES
			var id_tmpInvoice=$("#codfacturatmp").val();
			getInvoiceLines('tempInvoice',id_tmpInvoice,0,0,0,1);
			
			var id_cliente=$("#codcliente").val();
			getClientData(id_cliente);

			getItemList();

			

             
			//load process combo vacio
			$.get("../funciones/BackendQueries/getMeassuresUnits.php", function(data) {
            	    $('.cboUnidadmedida').html(data);
            });
		});
		function actualizar_importe()
			{
				var ai_precio=document.getElementById("iprecio").value;
				var ai_cantidad=document.getElementById("cantidad").value;
				var ai_descuento=document.getElementById("descuento").value;
				ai_descuento=ai_descuento/100;
				total=ai_precio*ai_cantidad;
				ai_descuento=total*ai_descuento;
				total=total-ai_descuento;
				var original=parseFloat(total);
				var result=Math.round(original*100)/100 ;
				document.getElementById("importe").value=result;
			}
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
		function getInvoiceLines(d_type,id_invoice,ver,modifica,seleccionar,eliminar) {	
			$.get( "../funciones/BackendQueries/getInvoiceLines.php" , 
					{ 
						docType: d_type,
						idInvoice: id_invoice,
						toolVer: ver, 
						toolModificar: modifica,
						toolSeleccionar: seleccionar,
						toolEliminar: eliminar                                             
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
		function getItemList(id_category, referenc, descrip) {
			$.get( "../funciones/BackendQueries/getItemList.php" , 
					{ 
						idCategory: id_category,
						referencia: referenc,
						descripcion: descrip,
						toolSeleccionar: "1"                                               
					},
					function ( data ) { 
                            $('#windowData').html( data );
                    }
            );
		}
		function select(id_item) {
			$.getJSON('../funciones/BackendQueries/getItemData.php', 
					{
                        idItem: id_item
					}, 
					function(data) {
							$('#icodArticulo').val(id_item);
							$('#icodbarras').val(data.codBar);
                            $('#icodfamilia').val(data.codFamily);
							$('#ireferencia').val(data.reference);
							$('#idescripcion').val(data.description);
							$('#iprecio').val(data.price);   
							$('#umnstock').val(data.codUM);   
							$('#impuesto').val(data.tax);    
							$('#impuesto').attr('class', 'comboNano');                         
							console.log(data.messages);
					}
			);

		}
		function validar() {
			//alert("entre a la funcion validar");
				var vcodFacturat=$('#codfacturatmp').val();
				var vcodfamilia=$('#icodfamilia').val();
				var vcodArticulo=$('#icodArticulo').val();
				var vcantidad=$('#cantidad').val();
				var vprecio=$('#iprecio').val();
				var vimporte=$('#importe').val();
				var vdscto=$('#descuento').val();
				var vimpuesto=$('#impuesto').val();
			
				

			$.get("../funciones/BackendQueries/insertInvoiceLines.php", { docType:"tempInvoice",
						codFacturat: vcodFacturat,
						codfamilia: vcodfamilia,
						codArticulo: vcodArticulo,
						cantidad: vcantidad,
						precio: vprecio, 
						importe: vimporte, 
						dscto: vdscto, 
						impuesto: vimpuesto									                                          
					}, function (data) { $("#div_datos").html(data);
						getInvoiceLines('tempInvoice',vcodFacturat,0,0,0,1);
						calculaTaxYTotal();
						$('#icodfamilia').val('');
						$('#icodArticulo').val('');
						$('#cantidad').val('1');
						$('#iprecio').val('');
						$('#importe').val('');
						$('#descuento').val('0');
						$('#impuesto').val('');
						$('#idescripcion').val('');
						$('#icodbarras').val('');
                    }
            );           
		}
		function remove(id_line,bimporte,balicuotaProducto) {
			var vcodfact = $('#codfacturatmp').val();
			//All the variables are rounded using Math.round() function to avoid errors on the float point operations.
			var baseImponibleOriginal1=parseFloat($('#baseimponible').val());
			var baseImponibleOriginal=Math.round(baseImponibleOriginal1*100)/100 ;
			var impuestosOriginal1=parseFloat($('#baseimpuestos').val());
			var impuestosOriginal=Math.round(impuestosOriginal1*100)/100 ;
			var impuestoProducto1= (bimporte*balicuotaProducto)/100;
			var impuestoProducto=Math.round(impuestoProducto1*100)/100 ;
			var nuevaBaseImponible1=baseImponibleOriginal-bimporte;
			var nuevaBaseImponible=Math.round(nuevaBaseImponible1*100)/100 ;
			var nuevoImpuestos1=impuestosOriginal-impuestoProducto;
			var nuevoImpuestos=Math.round(nuevoImpuestos1*100)/100 ;
			$('#baseimponible,#baseimponible2').val(nuevaBaseImponible);
			$('#baseimpuestos,#baseimpuestos2').val(nuevoImpuestos);
			$('#preciototal,#preciototal2').val(Math.round((nuevaBaseImponible+nuevoImpuestos)*100)/100);

			$.get( "../funciones/BackendQueries/removeTempInvoiceLine.php" , 
					{ 	docType:"tempInvoice",
						idLine: id_line,
						codFacturat: vcodfact
					},
					function ( data ) { 
                            $('#div_datos2').html( data );
							getInvoiceLines('tempInvoice',vcodfact,0,0,0,1);
                    }
            );
		}
		function calculaTaxYTotal() {
			var importe1=parseFloat($('#importe').val());
			var importe=Math.round(importe1*100)/100 ;
			var alicuotaProducto1=parseFloat($('#impuesto').find('option:selected').text());
			//All the variables are rounded using Math.round() function to avoid errors on the float point operations.
			var alicuotaProducto=Math.round(alicuotaProducto1*100)/100 ;
			var impuestoProducto= (importe*alicuotaProducto)/100;
			var baseImponibleOriginal1=parseFloat($('#baseimponible').val());
			var baseImponibleOriginal=Math.round(baseImponibleOriginal1*100)/100 ;
			var impuestosOriginal1=parseFloat($('#baseimpuestos').val());
			var impuestosOriginal=Math.round(impuestosOriginal1*100)/100 ;
			var nuevaBaseImponible1=baseImponibleOriginal+importe;
			var nuevaBaseImponible=Math.round(nuevaBaseImponible1*100)/100 ;
			var nuevoImpuestos1=impuestosOriginal+impuestoProducto;
			var nuevoImpuestos=Math.round(nuevoImpuestos1*100)/100 ;
			$('#baseimponible,#baseimponible2').val(nuevaBaseImponible);
			$('#baseimpuestos,#baseimpuestos2').val(nuevoImpuestos);
			$('#preciototal,#preciototal2').val(Math.round((nuevaBaseImponible+nuevoImpuestos)*100)/100);
		}	
		function cancelar() {
			var vcodfact = $('#codfacturatmp').val();
			$.get( "../funciones/BackendQueries/removeTempInvoiceLine.php" , 
					{ 	docType:"tempInvoice",
						codFacturat: vcodfact
					},
					function ( data ) { 
                            $('#div_datos2').html( data );
                    }
            );
			$.get( "../funciones/BackendQueries/removeTempInvoice.php" , 
					{ 	docType:"tempInvoice",
						codFacturat: vcodfact
					},
					function ( data ) { 
                            $('#div_datos3').html( data );
                    }
            );
			alert("La factura "+vcodfact+" ha sido cancelada");
			window.top.location.href ="../index.php";
		}
		function validar_cabecera() {
				//alert("valido cabecera");
				var mensaje="";
				if ($("nombre").val=="") mensaje+="  - Nombre\n";
				if ($("fecha").val=="") mensaje+="  - Fecha\n";
				if (mensaje!="") {
					alert(getTranslationText('msgvgn')+"\n\n"+mensaje);
				} else {
					$.getJSON('../funciones/BackendQueries/initInvoice.php', 
						{	docType: 'Invoice',
							fecha: $("#fecha").val(),
							codcliente: $("#codcliente").val(),
							impuestos: $("#baseimpuestos").val(),
							baseimponible: $("#baseimponible").val(),
							totalfactura: $("#preciototal").val()
						}, 
					function(data) {
						$('#numfactura').val(data.idInvoice);
						console.log(data.idInvoice);
							
							$.get('../funciones/BackendQueries/insertInvoiceLines.php',
								{
									docType: 'Invoice',
									codFactura: data.idInvoice,
									codFacturat: $('#codfacturatmp').val()
								},
								function (data2) { $("#botonBusqueda").html(data2);
													$('#divNumeroFactura').show();
													$('#frameFiltroArticulos').html('<span class="mensaje" id="msgfacreasucc">Msj Creacion de factura</span>');
													traducirVista();
													$("#image1,#valcliente,#buscacliente").hide();
													$("#codcliente").attr('readonly', true);
													getInvoiceLines('Invoice',data.idInvoice,0,0,0,0);					
                    			}
            				);
					
						}
					);
			}
		}	
		function salir() {
			location.href="index.php";
		}
		
		function imprimir() {
			var codfactura=$("#numfactura").val();
			window.open("../fpdf/imprimir_factura.php?codfactura="+codfactura+"&lang="+getLanguajeCode());
		}
		
		function pagar() {
			var codfactura=$("#numfactura").val();
			var codcliente=$("#codcliente").val();
			var importe=$("#preciototal").val();
			miPopup = window.open("efectuarpago.php?codfactura="+codfactura+"&codcliente="+codcliente+"&importe="+importe,"miwin","width=700,height=500,scrollbars=yes");			
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
				<div id="tituloForm" class="header"><span  id="tvntmst">VENTA MOSTRADOR</span></div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" >
				<input id="codfacturatmp" name="codfacturatmp" type="hidden">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="10%"><span  id="cod_cliente">C&oacute;digo Cliente</span></td>
					      <td width="40%"><input NAME="codcliente" value="1" type="text" class="cajaPequena" id="codcliente" size="6" maxlength="5" onClick="limpiarcaja()">
					        <img id="buscacliente" src="../img/ver.svg" width="16" height="16" onClick="abreVentana()" data-ttitle="bcliente" title="Buscar cliente" onMouseOver="style.cursor=cursor"> <img src="../img/cliente.svg" id="valcliente" width="16" height="16" onClick="validarcliente()" data-ttitle="tvalclt" title="Validar cliente" onMouseOver="style.cursor=cursor"></td>
						  <td width="10%"></td>
                          <td width="40%"></td>	
                        </tr>
						
							<tr id="divNumeroFactura">
								<td><span  id="tnrofc">Factura N.</span></td>
						    	<td><input NAME="numfactura" type="text" class="cajaGrande" id="numfactura" size="45" maxlength="45" readonly></td>
				            	<td></td>
				            	<td></td>
							</tr>
					
						<tr>
							<td><span  id="tnombcliente">Nombre Cliente</span></td>
						    <td><input NAME="nombreCliente" type="text" class="cajaGrande" id="nombreCliente" size="45" maxlength="45" readonly></td>
				            <td></td>
				            <td></td>
						</tr>
						
						<tr>
							<td><span  id="tfecha">Fecha</span></td>
						    <td><input NAME="fecha" type="text" class="cajaMedia" id="fecha" size="10" maxlength="10" " readonly> <img src="../img/calendario.svg" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'">
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
			  <!--div id="frmBusqueda"-->
			  <div id="frameFiltroArticulos">
				<form id="formulario_lineas" name="formulario_lineas" method="post" action="frame_lineas.php" target="frame_lineas">
				<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
				  <tr>
					<td width="10%"><span  id="tcodbarr">Codigo barras</span> </td>
					<td colspan="10" valign="middle"><input NAME="icodbarras" type="text" class="cajaMedia" id="icodbarras" size="15" maxlength="15"> </td>
				  </tr>
                   <tr>
					<td width="10%"><span  id="tcodart">Codigo de articulo</span> </td>
					<td colspan="10" valign="middle"><input NAME="codArticulo" type="text" class="cajaMedia" id="icodArticulo" size="15" maxlength="15"> 
						<a href="#modal"><img src="../img/ver.svg" width="16" height="16"  onMouseOver="style.cursor=cursor" data-ttitle="valcodbar" title="Validar codigo de barras">  </a>
					</td>
				  </tr>
				  <tr>
					<td width="5%"><span  id="descri">descripcion</span></td>
					<td width="20%"><input NAME="descripcion" type="text" class="cajaMedia" id="idescripcion" size="30" maxlength="30" readonly></td>
					<td width="5%"><span  id="tprecio">PRECIO</span></td>
					<td width="20%"><input NAME="precio" type="text" class="cajaPequena2" id="iprecio" size="10" maxlength="10" onChange="actualizar_importe()"> &#8364;</td>
					<td width="5%"><span  id="tcant">CANTIDAD</span></td>
					<td width="25%"><input NAME="cantidad" type="text" class="cajaMinima" id="cantidad" size="10" maxlength="10" value="1" onChange="actualizar_importe()">
					<select id="umnstock" class="cboUnidadmedida" name="umnstock" onChange="actualizar_importe()" >
                                
								</select></td>
                    <td width="20%"></td>
                 </tr>
                 <tr>
					<td><span  id="tdcto">Dcto.</span></td>
					<td><input NAME="descuento" type="text" class="cajaMinima" id="descuento" size="10" maxlength="10" onChange="actualizar_importe()"> %</td>
					<td><span  id="timporte">IMPORTE</span></td>
					<td><input NAME="importe" type="text" class="cajaPequena2" id="importe" size="10" maxlength="10" value="0" readonly> &#8364;</td>
					<td><span  id="tiva">IVA</span></td>
                    <td><select id="impuesto" class="cboImpuesto, comboMedio" name="impuesto" onChange="actualizar_importe()" >
                                
								</select> %</td>
                    <td><button type="button" id="btnagregar" onClick="validar()" onMouseOver="style.cursor=cursor"> <img src="../img/agregar.svg" alt="agregar" /> <span  id="tagregar">Agregar</span> </button></td>
				  </tr>
				</table>
				</div>
				<div id="errorMessages"></div>
				<br>
				<div id="frmBusqueda">
				<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="10%"><span  id="titem">ITEM</span></td>
							<td width="20%"><span  id="descri">DESCRIPCION</span></td>
							<td width="10%"><span  id="tprecio">PRECIO</span></td>
							<td width="10%"><span  id="tcant">CANTIDAD</span></td>
							<td width="10%"><span ></span></td>
							<td width="10%"><span  id="tdcto">DCTO </span></td>						
							<td width="10%"><span  id="timporte">IMPORTE</span></td>
							<td width="10%"><span  id="tiva">IVA</span></td>
							<td width="10%">&nbsp;</td>
						</tr>
				</table>
				<div ID="div_datos" name="div_datos" > </div> 		
				<div ID="div_datos2" name="div_datos2" > </div> 		
					

			  </div>
			  <div id="frmBusqueda">
			<table width="25%" border=0 align="right" cellpadding=3 cellspacing=0 class="fuente8">
			  <tr>
			    <td width="27%" class="busqueda"><span  id="subtotal">Subtotal</span></td>
				<td width="73%" align="right"><div align="center">
			      <input class="cajaTotales" name="baseimponible" type="text" id="baseimponible" size="12" value=0 align="right" readonly> 
		        &#8364;</div></td>
			  </tr>
			  <tr>
				<td class="busqueda"><span  id="tiva">IVA</span></td>
				<td align="right"><div align="center">
			      <input class="cajaTotales" name="baseimpuestos" type="text" id="baseimpuestos" size="12" align="right" value=0 readonly> 
		        &#8364;</div></td>
			  </tr>
			  <tr>
				<td class="busqueda"><span  id="tpciototal">Precio Total</span></td>
				<td align="right"><div align="center">
			      <input class="cajaTotales" name="preciototal" type="text" id="preciototal" size="12" align="right" value=0 readonly> 
		        &#8364;</div></td>
			  </tr>
		</table>
			  </div>
				<div id="botonBusqueda">					
				  <div align="center">
				  	<button type="button" id="btnaceptar" onClick="validar_cabecera()" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span  id="taceptar">Aceptar</span> </button>
               		<button type="button" id="btncancelar" onClick="cancelar()"onMouseOver="style.cursor=cursor"> <img src="../img/borrar.svg" alt="nuevo" /> <span  id="tcancelar">Cancelar</span> </button>		    
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
