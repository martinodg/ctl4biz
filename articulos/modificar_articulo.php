<?php 
header('Cache-Control: no-cache');
header('Pragma: no-cache');
if(session_id() == '') {
    session_start();
}
$moneda= $_SESSION['company_currency_sign'];

require_once("../conectar7.php"); 
require_once("../mysqli_result.php");
require_once("../funciones/fechas.php");
require_once("../funciones/cargaImagenes.php");


$codarticulo=$_GET["codarticulo"];
$cadena_busqueda=$_GET["cadena_busqueda"];


$query="SELECT * FROM articulos WHERE codarticulo='$codarticulo'";
$rs_query=mysqli_query($conexion,$query);
$codigobarras=mysqli_result($rs_query,0,"codigobarras");

//para los alias
$queryAlias="SELECT * FROM alias_articulos WHERE codarticulo='$codarticulo' ORDER BY id_alias ASC ";
$rsAlias_query=mysqli_query($conexion,$queryAlias);
$alias=mysqli_result($rsAlias_query,0,"id_alias");

?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../funciones/validar.js"></script>
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
//Perform when DOM is full loaded
$( document ).ready(function(){

    //@todo cargar todos los selects con la misma peticion de unidades
			//load stock mesure units combo
			$.get( "../funciones/BackendQueries/getMeassuresUnits.php" , { articulo : document.getElementById('id').value,
                                                                   campo : 'codunidadmedida'
                                                              },function ( data ) { 
                                                                                        $('#umnstock').html(data);
                                                                                       
                                                                                  }
                );
			//load stock minimo mesure units combo
			$.get( "../funciones/BackendQueries/getMeassuresUnits.php" , { articulo : document.getElementById('id').value,
                                                                   campo : 'codumstock_minimo'
                                                              },function ( data ) { 
                                                                                        $('#umnstock_minimo').html(data);
                                                                                       
                                                                                  }
                );
			//load stock minimo mesure units combo
			$.get( "../funciones/BackendQueries/getMeassuresUnits.php" , { articulo : document.getElementById('id').value,
                                                                   campo : 'codumunidades_caja'
                                                              },function ( data ) {
                                                                                        $('#umnunidades_caja').html(data);
                                                                                       
                                                                                  }
                );
});
/*----------------------------------------------------------------------------------------------------------------------*/
		function cancelar() {
			location.href="index.php?cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function limpiar() {
			document.getElementById("aliasArt1").value="";
			document.getElementById("aliasArt2").value="";
			document.getElementById("aliasArt3").value="";
			document.getElementById("codigobarras").value="";
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
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
                    <div id="tituloForm" class="header"><span  id="tmodarticulo">MODIFICAR ARTICULO</span></div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_articulo.php" enctype="multipart/form-data">
				<input id="accion" name="accion" value="modificar" type="hidden">
				<input id="id" name="id" value="<?php echo $codarticulo?>" type="hidden">
				<input id="codarticulo" name="codarticulo" value="<?php echo $codarticulo?>" type="hidden">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
						<td width="20%"><span  id="tcodbarr">Codigo de barras</span></td>
						
					      <td colspan="2"><input name="codigobarras" id="codigobarras" value="<?php echo $codigobarras?>" maxlength="20" class="cajaGrande" type="text"></td>
				          <td colspan="1"><?php echo '<img src="../funciones/barcode/barcode.php?s=ean-13&wq=1&d='.$codigobarras.'">'; ?></td>
						</tr>
						<tr>
						<td width="20%"><span  id="trefren">Referencia</span></td>
						<?php $referencia=mysqli_result($rs_query,0,"referencia");?>
					      <td colspan="2"><input name="areferencia" id="mreferencia" value="<?php echo mysqli_result($rs_query,0,"referencia")?>" maxlength="20" class="cajaGrande" type="text"></td>
                        <!--alias start-->
                        <tr>
                            <td><span>Alias 1</span></td>
                            <td colspan="2"><input NAME="alias[<?php echo mysqli_result($rsAlias_query,0,"id_alias") ;?>]" type="text" class="cajaGrande" id="aliasArt1" size="20" maxlength="20" value="<?php echo mysqli_result($rsAlias_query,0,"alias")?>"></td>
                        </tr>
                        <tr>
                            <td><span>Alias 2</span></td>
                            <td colspan="2"><input NAME="alias[<?php echo mysqli_result($rsAlias_query,1,"id_alias") ;?>] type="text" class="cajaGrande" id="aliasArt2" size="20" maxlength="20" value="<?php echo mysqli_result($rsAlias_query,1,"alias")?>"></td>
                        </tr>
                        <tr>
                            <td><span>Alias 3</span></td>
                            <td colspan="2"><input NAME="alias[<?php echo mysqli_result($rsAlias_query,2,"id_alias") ;?>] type="text" class="cajaGrande" id="aliasArt3" size="20" maxlength="20" value="<?php echo mysqli_result($rsAlias_query,2,"alias")?>"></td>
                        </tr>
                        <!--alias start-->
						</tr>
						<?php
						$familia=mysqli_result($rs_query,0,"codfamilia");
					  	$query_familias="SELECT * FROM familias WHERE borrado=0 ORDER BY nombre ASC";
						$res_familias=mysqli_query($conexion,$query_familias);
						$contador=0;
					  ?>
						<tr>
							<td width="11%"><span  id="tflia">FAMILIA</span></td>
							<td colspan="2"><select id="cboFamilias" name="AcboFamilias" class="comboGrande">
							
								<option value="0" data-opttrad="selecflia">Seleccione una familia</option>
								<?php
								while ($contador < mysqli_num_rows($res_familias)) { 
									if ($familia==mysqli_result($res_familias,$contador,"codfamilia")) {?>
								<option value="<?php echo mysqli_result($res_familias,$contador,"codfamilia")?>" selected="selected"><?php echo mysqli_result($res_familias,$contador,"nombre")?></option>
								<? } else { ?>
								<option value="<?php echo mysqli_result($res_familias,$contador,"codfamilia")?>"><?php echo mysqli_result($res_familias,$contador,"nombre")?></option>
								<? } 
									$contador++;
								} ?>				
								</select>							</td>
				        </tr>
						<tr>
							<td width="11%"><span  id="tdescri">Descripci&oacute;n</span></td>
						    <td colspan="2"><textarea name="Adescripcion" cols="41" rows="2" id="descripcion" class="areaTexto"><?php echo mysqli_result($rs_query,0,"descripcion")?></textarea></td>
				        </tr>
						<?php
						$impuesto=mysqli_result($rs_query,0,"impuesto");
					  	$query_impuesto="SELECT codimpuesto,valor FROM impuestos WHERE borrado=0 ORDER BY nombre ASC";
						$res_impuesto=mysqli_query($conexion,$query_impuesto);
						$contador=0;
					  ?>
						<tr>
							<td width="11%"><span  id="timpuesto">Impuesto</span></td>
							<td colspan="2"><select id="cboImpuestos" name="cboImpuestos" class="comboMedio">
							
								<option value="0" data-opttrad="selecimp">Seleccione un impuesto</option>
								<?php
								while ($contador < mysqli_num_rows($res_impuesto)) { 
									if ($impuesto==mysqli_result($res_impuesto,$contador,"valor")) { ?>
								<option value="<?php echo mysqli_result($res_impuesto,$contador,"valor")?>" selected="selected"><?php echo mysqli_result($res_impuesto,$contador,"valor")?></option>
								<? } else { ?>
								<option value="<?php echo mysqli_result($res_impuesto,$contador,"valor")?>"><?php echo mysqli_result($res_impuesto,$contador,"valor")?></option>
								<? } 
								$contador++;
								} ?>				
								</select> %							</td>
				        </tr>
						<?php
						$proveedor1=mysqli_result($rs_query,0,"codproveedor1");
					  	$query_proveedores="SELECT codproveedor as codproveedor1,nombre,nif FROM proveedores WHERE borrado=0 ORDER BY nombre ASC";
						$res_proveedores=mysqli_query($conexion,$query_proveedores);
						$contador=0;
					  ?>
						<tr>
							<td><span  id="tprov1">Proveedor 1</span></td>
							<td colspan="2"><select id="cboProveedores1" name="acboProveedores1" class="comboGrande">
							<? if ($proveedor1==0) { ?>
							<option value="0" selected="selected" data-opttrad="todprov">Todos los proveedores</option>
							<? } else { ?>
							<option value="0" data-opttrad="todprov">Todos los proveedores</option>
							<? } ?>
								<?php
								while ($contador < mysqli_num_rows($res_proveedores)) { 
									if ( mysqli_result($res_proveedores,$contador,"codproveedor1") == $proveedor1) { ?>
								<option value="<?php echo mysqli_result($res_proveedores,$contador,"codproveedor1")?>" selected><?php echo mysqli_result($res_proveedores,$contador,"nif")?> -- <?php echo mysqli_result($res_proveedores,$contador,"nombre")?></option>
								<? } else { ?> 
								<option value="<?php echo mysqli_result($res_proveedores,$contador,"codproveedor1")?>"><?php echo mysqli_result($res_proveedores,$contador,"nif")?> -- <?php echo mysqli_result($res_proveedores,$contador,"nombre")?></option>
								<? }
								$contador++;
								} ?>				
								</select>							</td>
					    </tr>
					<?php
						$proveedor2=mysqli_result($rs_query,0,"codproveedor2");
					  	$query_proveedores="SELECT codproveedor as codproveedor2,nombre,nif FROM proveedores WHERE borrado=0 ORDER BY nombre ASC";
						$res_proveedores=mysqli_query($conexion,$query_proveedores);
						$contador=0;
					  ?>
						<tr>
							<td><span  id="tprov2">Proveedor 2</span></td>
							<td colspan="2"><select id="cboProveedores2" name="acboProveedores2" class="comboGrande">
							<option value="0" data-opttrad="todprov">Todos los proveedores</option>
								<?php
								while ($contador < mysqli_num_rows($res_proveedores)) { 
									if ( mysqli_result($res_proveedores,$contador,"codproveedor2") == $proveedor2) { ?>
								<option value="<?php echo mysqli_result($res_proveedores,$contador,"codproveedor2")?>" selected><?php echo mysqli_result($res_proveedores,$contador,"nif")?> -- <?php echo mysqli_result($res_proveedores,$contador,"nombre")?></option>
								<? } else { ?> 
								<option value="<?php echo mysqli_result($res_proveedores,$contador,"codproveedor2")?>"><?php echo mysqli_result($res_proveedores,$contador,"nif")?> -- <?php echo mysqli_result($res_proveedores,$contador,"nombre")?></option>
								<? }
								$contador++;
								} ?>				
								</select>							</td>
					    </tr>
						<tr>
						  <td><span  id="tdesccorta">Descripci&oacute;n corta</span></td>
						  <td colspan="2"><input NAME="descripcion_corta" id="descripcion_corta" type="text" class="cajaGrande"  maxlength="30" value="<?php echo mysqli_result($rs_query,0,"descripcion_corta")?>"></td>
				      </tr>
					  <?php
					  	$codubicacion=mysqli_result($rs_query,0,"codubicacion");
					  	$query_ubicacion="SELECT codubicacion,nombre FROM ubicaciones WHERE borrado=0 ORDER BY nombre ASC";
						$res_ubicacion=mysqli_query($conexion,$query_ubicacion);
						$contador=0;
					  ?>
						<tr>
							<td><span  id="tubicacion">Ubicaci&oacute;n</span></td>
							<td colspan="2"><select id="cboUbicacion" name="AcboUbicacion" class="comboGrande">
							<option value="0"  data-opttrad="todubic" >Todas las ubicaciones</option>
								<?php
								while ($contador < mysqli_num_rows($res_ubicacion)) { 
									if ( mysqli_result($res_ubicacion,$contador,"codubicacion") == $codubicacion) { ?>
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
						  <td colspan="2"><input NAME="nstock" type="text" class="cajaPequena" id="stock" size="10" maxlength="10" value="<?php echo mysqli_result($rs_query,0,"stock")?>"> 
						  <select id="umnstock" class="cboUnidadmedida" name="umnstock" >
                                
								</select> </td>
				      </tr>
					  	<tr>
						 <td><span  id="tstkmin">Stock m&iacute;nimo</span></td>
						  <td colspan="2"><input NAME="nstock_minimo" type="text" class="cajaPequena" id="stock_minimo" size="8" maxlength="8" value="<?php echo mysqli_result($rs_query,0,"stock_minimo")?>">   
						  <select id="umnstock_minimo" class="cboUnidadmedida" name="umnstock_minimo">
                                
								</select> </td>
				      </tr>
					  	<tr>
						 <td><span  id="tavisominimo">Aviso M&iacute;nimo</span></td>
						  <td colspan="2"><select name="aaviso_minimo" id="aviso_minimo" class="comboPequeno">
						  <?php if (mysqli_result($rs_query,0,"aviso_minimo")==0) { ?>
						  <option value="0" selected="selected" data-opttrad="no">No</option>
						  <option value="1" data-opttrad="si" >Si</option>
						  <? } else { ?>
						  <option value="0" data-opttrad="no" >No</option>
						  <option value="1" selected="selected" data-opttrad="si"">Si</option>
						  <? } ?>
						  </select></td>
				      </tr>
					  <tr>
							<td width="11%"><span  id="tdatroduc">Datos del producto</span></td>
						    <td colspan="2"><textarea name="adatos" cols="41" rows="2" id="datos" class="areaTexto"><?php echo mysqli_result($rs_query,0,"datos_producto")?></textarea></td>
				        </tr>
						<tr>
							<td><span  id="tfchaalta">Fecha de alta</span></td>
							<td colspan="2"><input NAME="fecha" type="text" class="cajaPequena" id="fecha" size="10" maxlength="10" readonly value="<?php echo implota(mysqli_result($rs_query,0,"fecha_alta"))?>"> <img src="../img/calendario.svg" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'">
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
						 $embalaje=mysqli_result($rs_query,0,"codembalaje");
					  	$query_embalaje="SELECT codembalaje,nombre FROM embalajes WHERE borrado=0 ORDER BY nombre ASC";
						$res_embalaje=mysqli_query($conexion,$query_embalaje);
						$contador=0;
					  ?>
						<tr>
							<td><span  id="tembalaje">Embalaje</span></td>
							<td colspan="2"><select id="cboEmbalaje" name="cboEmbalaje" class="comboGrande">
							<option value="0" data-opttrad="tdsembalajes">Todos los embalajes</option>
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
						  <td colspan="2"><input NAME="nunidades_caja" type="text" class="cajaPequena" id="unidades_caja" size="10" maxlength="10" value="<?php echo mysqli_result($rs_query,0,"unidades_caja")?>">  
						  <select id="umnunidades_caja" class="cboUnidadmedida" name="umnunidades_caja" >
                                
								</select> </td>
				      </tr>
					  <tr>
						 <td><span  id="tpregpciotk">Preguntar precio ticket</span></td>
						  <td colspan="2"><select name="aprecio_ticket" id="precio_ticket" class="comboPequeno">
						  <? if (mysqli_result($rs_query,0,"precio_ticket")==0) { ?> 
						  <option value="0" selected="selected"data-opttrad="no">No</option>
						  <option value="1" data-opttrad="si">Si</option>
						  <? } else { ?>
						   <option value="0" data-opttrad="no">No</option>
						  <option value="1" selected="selecteddata-opttrad="si">Si</option>
						  <? } ?>
						  </select></td>
				      </tr>
					  <tr>
						 <td><span  id="tmoddesctick">Modificar descrip. en ticket</span></td>
						  <td colspan="2"><select name="amodif_descrip" id="modif_descrip" class="comboPequeno">
						   <? if (mysqli_result($rs_query,0,"modificar_ticket")==0) { ?>
						  <option value="0" selected="selected"data-opttrad="no">No</option>
						  <option value="1" data-opttrad="si">Si</option>
						  <? } else { ?>
						  <option value="0" data-opttrad="no">No</option>
						  <option value="1" selected="selecteddata-opttrad="si">Si</option>
						  <? } ?>
						  </select></td>
				      </tr>
					  	 <tr>
							<td width="11%"><span  id="tobsev">Observaciones</span></td>
						    <td colspan="2"><textarea name="aobservaciones" cols="41" rows="2" id="observaciones" class="areaTexto"><?php echo mysqli_result($rs_query,0,"observaciones")?></textarea></td>
				        </tr>
						<tr>
						  <td><span  id="tpciocomp">Precio de compra</span></td>
						  <td colspan="2"><input NAME="qprecio_compra" type="text" class="cajaPequena" id="precio_compra" size="10" maxlength="10" value="<?php echo mysqli_result($rs_query,0,"precio_compra")?>">
						  <?echo $moneda;?></td>
				      </tr>
					  	<tr>
						  <td><span  id="tpalmacen">Precio de almac&eacute;n</span></td>
						  <td colspan="2"><input NAME="qprecio_almacen" type="text" class="cajaPequena" id="precio_almacen" size="10" maxlength="10" value="<?php echo mysqli_result($rs_query,0,"precio_almacen")?>">
						  <?echo $moneda;?></td>
				      </tr>
						<tr>
						  <td><span  id="tptienda">Precio de tienda</span></td>
						  <td colspan="2"><input NAME="qprecio_tienda" type="text" class="cajaPequena" id="precio_tienda" size="10" maxlength="10" value="<?php echo mysqli_result($rs_query,0,"precio_tienda")?>">
						  <?echo $moneda;?></td>
				      </tr>
					  	<!--<tr>
						  <td>Pvp</td>
						  <td colspan="2"><input NAME="qpvp" type="text" class="cajaPequena" id="pvp" size="10" maxlength="10" value="<?php echo mysqli_result($rs_query,0,"precio_pvp")?>">
						  <?echo $moneda;?></td>
				      </tr>-->
					  <tr>
						  <td><span  id="tprcciva">Precio con iva</span></td>
						  <td colspan="2"><input NAME="qprecio_iva" type="text" class="cajaPequena" id="precio_iva" size="10" maxlength="10" value="<?php echo mysqli_result($rs_query,0,"precio_iva")?>">
						  <?echo $moneda;?></td>
				      </tr>
					  <tr>
						  <td><span  id="timgfrmjpg">Imagen</span> </td>
					    <td width="55%"><input type="file" name="foto" id="foto" class="cajaMedia" accept="image/jpg" /></td>
				        <td width="30%" align="center" valign="top"><img src="<?php echo traerUrlImagenProducto(mysqli_result($rs_query,0,"imagen"));?>" width="160px" height="140px" border="1"></td>
					  </tr>
					  							<tr>
							<td><span  id="tcodbarr">Codigo de barras</span></td>
							<td colspan="2"><?php echo '<img src="../funciones/barcode/barcode.php?s=ean-13&wq=1&d='.$codigobarras.'">'; ?></td>
							
						</tr>
					</table>
			  </div>
			  <div id="lista-errores"></div>
				<div id="botonBusqueda">
					<button type="button" id="btnaceptar" onClick="validar(formulario,true)" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="Aceptar" /> <span  id="taceptar">Aceptar</span></td> </button>
					<button type="button" id="btnlimpiar" onClick="limpiar()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span  id="tlimpiar">Limpiar</span> </button>
               		<button type="button" id="btncancelar" onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/borrar.svg" alt="nuevo" /> <span  id="tcancelar">Cancelar</span> </button>
								
			    </div>
			  </form>
			 </div>				
		  </div>
		</div>
	</body>
</html>			
