<?php 
header('Cache-Control: no-cache');
header('Pragma: no-cache');
if(session_id() == '') {
    session_start();
}
$moneda= $_SESSION['company_currency_sign'];
require_once("../conectar7.php");
require_once("../mysqli_result.php");
 ?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>
		<!-- <script type="text/JavaScript" language="javascript" src="../calendario/lang/calendar-sp.js"></script> -->
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar-setup.js"></script>
		<script type="text/javascript" src="../funciones/validar.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
		<script language="javascript">
		
		function cancelar() {
			location.href="index.php";
		}
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}

		//Perform when DOM is full loaded
		$( document ).ready(function(){
            
			//load process combo
			$.get("../funciones/BackendQueries/getMeassuresUnits.php", function(data) {
            	    $('.cboUnidadmedida').html(data);
            });
		});
/*----------------------------------------------------------------------------------------------------------------------*/
		function limpiar() {
			document.getElementById("campo_alias").value="";
			document.getElementById("referencia").value="";
			document.getElementById("descripcion").value="";
			document.getElementById("descripcion_corta").value="";
			document.getElementById("stock_minimo").value="";
			document.getElementById("stock").value="";
			document.getElementById("datos").value="";
			document.getElementById("fecha").value="";
			document.getElementById("unidades_caja").value="";
			document.getElementById("observaciones").value="";
			document.getElementById("precio_compra").value="";
			document.getElementById("precio_almacen").value="";
			document.getElementById("precio_tienda").value="";
			//document.getElementById("pvp").value="";
			document.getElementById("precio_iva").value="";
			document.getElementById("foto").value="";
			document.formulario.cboFamilias.options[0].selected = true;
			document.formulario.cboImpuestos.options[0].selected = true;
			document.formulario.cboProveedores1.options[0].selected = true;
			document.formulario.cboProveedores2.options[0].selected = true;
			document.formulario.cboUbicacion.options[0].selected = true;
			document.formulario.cboEmbalaje.options[0].selected = true;
			document.formulario.Aaviso_minimo.options[0].selected = true;
			document.formulario.Aprecio_ticket.options[0].selected = true;
			document.formulario.Amodif_descrip.options[0].selected = true;
		}
        // script de alias
        $(document).ready(function(){
            var maxCampos = 15; //Limitación de incremento de campos de entrada
            var addButton = $('.add_button'); //Añadir selector de botón
            var wrapper = $('#campo_alias'); //Campo de entrada
            var campoHTML = '<div class="alia_add" style="margin-bottom: 10px;"><input type="text"  class="cajaGrande" name="alias[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field" style="text-decoration: none;"><img src="../img/eliminar.svg" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" style="cursor:pointer; margin-left: 5px;"></a></div>'; //New input field html
            var x = 0; //El contador de campo inicial es 1
            $(addButton).click(function(){ //Una vez que se hace clic en el botón Agregar
                if(x < maxCampos){ //Comprobar el número máximo de campos de entrada
                    x++; //Incrementar contador de campo
                    $(wrapper).append(campoHTML); // Add CAMPO html
                }
            });
            $(wrapper).on('click', '.remove_button', function(e){ //Una vez que se hace clic en el botón Eliminar
                e.preventDefault();
                $(this).parent('.alia_add').remove(); //Remueve el campo html
                x--; //Contador de campo decrementor
            });
        });
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido"> 
				<div align="center">
                    <div id="tituloForm" class="header"><span  id="tinsart">INSERTAR ARTICULO</span></div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_articulo.php" enctype="multipart/form-data">
				<input id="accion" name="accion" value="alta" type="hidden">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
						<td width="15%"><span  id="trefren">Referencia</span></td>
					      <td width="30%"><input name="areferencia" id="mreferencia" value="" maxlength="20" class="cajaGrande" type="text"></td>
				          <td width="55%" rowspan="15" align="left" valign="top"><ul id="lista-errores"></ul></td>
						</tr>
						<?php
					  	$query_familias="SELECT * FROM familias WHERE borrado=0 ORDER BY nombre ASC";
						$res_familias=mysqli_query($conexion,$query_familias);
						$contador=0;
					  ?>
						<tr>
							<td width="17%"><span  id="tflia">FAMILIA</span></td>
							<td><select id="cboFamilias" name="AcboFamilias" class="comboGrande">
							
								<option value="0" data-opttrad="selecflia">Seleccione una familia</option>
								<?php
								while ($contador < mysqli_num_rows($res_familias)) { ?>
								<option value="<?php echo mysqli_result($res_familias,$contador,"codfamilia")?>"><?php echo mysqli_result($res_familias,$contador,"nombre")?></option>
								<? $contador++;
								} ?>				
								</select>							</td>
				        </tr>
                        <!--alias start-->
                        <tr>
                            <td><span id="talias">Alias</span></td>
                            <td id="campo_alias">
                                <div class="alia_add">
                                    <button class="add_button" type="button" onMouseOver="style.cursor=cursor" style="text-decoration: none; color: #ffff;">
                                        <img src="../img/agregar.svg" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'"><span id="add-alias"> AGREGAR ALIAS</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!--alias end-->
						<tr>
							<td width="17%"><span  id="tdescri">Descripci&oacute;n</span></td>
						    <td><textarea name="Adescripcion" cols="41" rows="2" id="descripcion" class="areaTexto"></textarea></td>
				        </tr>
						<?php
					  	$query_impuesto="SELECT codimpuesto,valor FROM impuestos WHERE borrado=0 ORDER BY nombre ASC";
						$res_impuesto=mysqli_query($conexion,$query_impuesto);
						$contador=0;
					  ?>
						<tr>
							<td width="17%"><span  id="timpuesto">Impuesto</span></td>
							<td><select id="cboImpuestos" name="rcboImpuestos" class="comboMedio">
							
								<option value="0" data-opttrad="selecimp">Seleccione un impuesto</option>
								<?php
								while ($contador < mysqli_num_rows($res_impuesto)) { ?>
								<option value="<?php echo mysqli_result($res_impuesto,$contador,"valor")?>"><?php echo mysqli_result($res_impuesto,$contador,"valor")?></option>
								<? $contador++;
								} ?>				
								</select> %							</td>
				        </tr>
						<?php
					  	$query_proveedores="SELECT codproveedor,nombre,nif FROM proveedores WHERE borrado=0 ORDER BY nombre ASC";
						$res_proveedores=mysqli_query($conexion,$query_proveedores);
						$contador=0;
					  ?>
						<tr>
							<td><span  id="tprov1">Proveedor 1</span></td>
							<td><select id="cboProveedores1" name="acboProveedores1" class="comboGrande">
							<option value="0" data-opttrad="todprov">Todos los proveedores</option>
								<?php
								while ($contador < mysqli_num_rows($res_proveedores)) { 
									if ( mysqli_result($res_proveedores,$contador,"codproveedor") == $proveedor) { ?>
								<option value="<?php echo mysqli_result($res_proveedores,$contador,"codproveedor")?>" selected><?php echo mysqli_result($res_proveedores,$contador,"nif")?> -- <?php echo mysqli_result($res_proveedores,$contador,"nombre")?></option>
								<? } else { ?> 
								<option value="<?php echo mysqli_result($res_proveedores,$contador,"codproveedor")?>"><?php echo mysqli_result($res_proveedores,$contador,"nif")?> -- <?php echo mysqli_result($res_proveedores,$contador,"nombre")?></option>
								<? }
								$contador++;
								} ?>				
								</select>							</td>
					    </tr>
					<?php
					  	$query_proveedores="SELECT codproveedor,nombre,nif FROM proveedores WHERE borrado=0 ORDER BY nombre ASC";
						$res_proveedores=mysqli_query($conexion,$query_proveedores);
						$contador=0;
					  ?>
						<tr>
							<td><span  id="tprov2">Proveedor 2</span></td>
							<td><select id="cboProveedores2" name="acboProveedores2" class="comboGrande">
							<option value="0" data-opttrad="todprov">Todos los proveedores</option>
								<?php
								while ($contador < mysqli_num_rows($res_proveedores)) { 
									if ( mysqli_result($res_proveedores,$contador,"codproveedor") == $proveedor) { ?>
								<option value="<?php echo mysqli_result($res_proveedores,$contador,"codproveedor")?>" selected><?php echo mysqli_result($res_proveedores,$contador,"nif")?> -- <?php echo mysqli_result($res_proveedores,$contador,"nombre")?></option>
								<? } else { ?> 
								<option value="<?php echo mysqli_result($res_proveedores,$contador,"codproveedor")?>"><?php echo mysqli_result($res_proveedores,$contador,"nif")?> -- <?php echo mysqli_result($res_proveedores,$contador,"nombre")?></option>
								<? }
								$contador++;
								} ?>				
								</select>							</td>
					    </tr>
						<tr>
						  <td><span  id="tdesccorta">Descripci&oacute;n corta</span></td>
						  <td><input NAME="adescripcion_corta" id="descripcion_corta" type="text" class="cajaGrande"  maxlength="30"></td>
				      </tr>
					  <?php
					  	$query_ubicacion="SELECT codubicacion,nombre FROM ubicaciones WHERE borrado=0 ORDER BY nombre ASC";
						$res_ubicacion=mysqli_query($conexion,$query_ubicacion);
						$contador=0;
					  ?>
						<tr>
							<td><span  id="tubicacion">Ubicaci&oacute;n</span></td>
							<td><select id="cboUbicacion" name="AcboUbicacion" class="comboGrande">
							<option value="0" data-opttrad="todubic">Todas las ubicaciones</option>
								<?php
								while ($contador < mysqli_num_rows($res_ubicacion)) { 
									if ( mysqli_result($res_ubicacion,$contador,"codubicacion") == $ubicacion) { ?>
								<option value="<?php echo mysqli_result($res_ubicacion,$contador,"codubicacion")?>" selected><?php echo mysqli_result($res_ubicacion,$contador,"nombre")?></option>
								<? } else { ?> 
								<option value="<?php echo mysqli_result($res_ubicacion,$contador,"codubicacion")?>"><?php echo mysqli_result($res_ubicacion,$contador,"nombre")?></option>
								<? }
								$contador++;
								} ?>				
								</select>							</td>
					    </tr>
						<tr>
						 <td><span  id="tstock">Stock</span></td>
						  <td><input NAME="nstock" type="text" class="cajaPequena" id="stock" size="10" maxlength="10"> 
						  <select id="umnstock" class="cboUnidadmedida" name="umnstock" >
                                
								</select> </td>
				      </tr>
					  	<tr>
						 <td><span  id="tstkmin">Stock m&iacute;nimo</span></td>
						  <td><input NAME="nstock_minimo" type="text" class="cajaPequena" id="stock_minimo" size="8" maxlength="8">  
						  <select id="umnstock_minimo" class="cboUnidadmedida" name="umnstock_minimo">
                                
								</select> </td>
				      </tr>
					  	<tr>
						 <td><span  id="tavisominimo">Aviso M&iacute;nimo</span></td>
						  <td><select name="aaviso_minimo" id="aviso_minimo" class="comboPequeno">
						  <option value="0" selected="selected"data-opttrad="no">No</option>
						  <option value="1" data-opttrad="si">Si</option>
						  </select></td>
				      </tr>
					  <tr>
							<td width="17%"><span  id="tdatroduc">Datos del producto</span></td>
						    <td><textarea name="adatos" cols="41" rows="2" id="datos" class="areaTexto"></textarea></td>
				        </tr>
						<tr>
							<td><span  id="tfchaalta">Fecha de alta</span></td>
							<td><input NAME="fecha" type="text" class="cajaPequena" id="fecha" size="10" maxlength="10" readonly> <img src="../img/calendario.svg" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fecha",
					ifFormat   : "%d/%m/%Y",
					button     : "Image1"
					  }
					);
		</script></td>
					    </tr>
						 <?php
					  	$query_embalaje="SELECT codembalaje,nombre FROM embalajes WHERE borrado=0 ORDER BY nombre ASC";
						$res_embalaje=mysqli_query($conexion,$query_embalaje);
						$contador=0;
					  ?>
						<tr>
							<td><span  id="tembalaje">Embalaje</span></td>
							<td><select id="cboEmbalaje" name="AEmbalajes" class="comboGrande">
							<option value="0"data-opttrad="tdsembalajes">Todos los embalajes</option>
								<?php
								while ($contador < mysqli_num_rows($res_embalaje)) { 
									if ( mysqli_result($res_embalaje,$contador,"codembalaje") == $embalaje) { ?>
								<option value="<?php echo mysqli_result($res_embalaje,$contador,"codembalaje")?>" selected><?php echo mysqli_result($res_embalaje,$contador,"nombre")?></option>
								<? } else { ?> 
								<option value="<?php echo mysqli_result($res_embalaje,$contador,"codembalaje")?>"><?php echo mysqli_result($res_embalaje,$contador,"nombre")?></option>
								<? }
								$contador++;
								} ?>				
								</select>							</td>
					    </tr>
						<tr>
						 <td><span  id="tunidcaja">Unidades por caja</span></td>
						  <td><input NAME="nunidades_caja" type="text" class="cajaPequena" id="unidades_caja" size="10" maxlength="10">  
						  <select id="umnunidades_caja" class="cboUnidadmedida" name="umnunidades_caja" >
                                
								</select> </td>
				      </tr>
					  <tr>
						 <td><span  id="tpregpciotk">Preguntar precio ticket</span></td>
						  <td><select name="aprecio_ticket" id="precio_ticket" class="comboPequeno">
						  <option value="0" selected="selected"data-opttrad="no">No</option>
						  <option value="1" data-opttrad="si">Si</option>
						  </select></td>
				      </tr>
					  <tr>
						 <td><span  id="tmoddesctick">Modificar descrip. en ticket</span></td>
						  <td><select name="amodif_descrip" id="modif_descrip" class="comboPequeno">
						  <option value="0" selected="selected"data-opttrad="no">No</option>
						  <option value="1" data-opttrad="si">Si</option>
						  </select></td>
				      </tr>
					  	 <tr>
							<td width="17%"><span  id="tobsev">Observaciones</span></td>
						    <td><textarea name="aobservaciones" cols="41" rows="2" id="observaciones" class="areaTexto"></textarea></td>
				        </tr>
						<tr>
						  <td><span  id="tpciocomp">Precio de compra</span></td>
						  <td><input NAME="qprecio_compra" type="text" class="cajaPequena" id="precio_compra" size="10" maxlength="10"> <?echo $moneda;?></td>
				      </tr>
					  	<tr>
						  <td><span  id="tpalmacen">Precio de almac&eacute;n</span></td>
						  <td><input NAME="qprecio_almacen" type="text" class="cajaPequena" id="precio_almacen" size="10" maxlength="10"> <?echo $moneda;?></td>
				      </tr>
						<tr>
						  <td><span  id="tptienda">Precio de tienda</span></td>
						  <td><input NAME="qprecio_tienda" type="text" class="cajaPequena" id="precio_tienda" size="10" maxlength="10"> <?echo $moneda;?></td>
				      </tr>
						<tr>
                            <td><span  id="tprcventpub">Precio venta al publico</span></td>
						  <td><input NAME="qpvp" type="text" class="cajaPequena" id="pvp" size="10" maxlength="10"> <?echo $moneda;?></td>
				      </tr>
					 
					  <tr>
						  <td><span  id="timgfrmjpg">Imagen</span></td>
						  <td><input type="file" name="foto" id="foto" class="cajaMedia" accept="image/jpg" /></td>
				      </tr>
					</table>
			  </div>
				<div id="botonBusqueda">
					<button type="button" id="btnaceptar" onClick="validar(formulario,true)" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="limpiar" /> <span  id="taceptar">Aceptar</span></td> </button>
					<button type="button" id="btnlimpiar" onClick="limpiar()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span  id="tlimpiar">Limpiar</span> </button>
               		<button type="button" id="btncancelar" onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/borrar.svg" alt="nuevo" /> <span  id="tcancelar">Cancelar</span> </button>
				
					<input type="hidden" name="id" id="id" value="">					
			  </div>
			  </form>	
			 </div>			
		  </div>
		</div>
	</body>
</html>
