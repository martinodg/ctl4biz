<?
if(session_id() == '') {
    session_start();
}
require_once("../conectar7.php");
require_once("../mysqli_result.php");

?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../funciones/validar.js"></script>
		<script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
        <script language="javascript">
		
        /* Ajax para completar comboBox cboProvincias basado en el pais elejido en comboBox cboPais */
        $( document ).ready(function(){
                $('#cboPais').change(function(){
                    //console.log($(this));
                    $.get( "../funciones/BackendQueries/sel_provincias7.php" , { pais : $(this).val() } , function ( data ) {
                        $ ( '#cboProvincias' ) . html ( data ) ;
                    });
                });
         });

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
		
		function limpiar() {
			document.getElementById("formulario").reset();
		}
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
                    <div id="tituloForm" class="header"><span  id="tinsprvdr">INSERTAR PROVEEDOR</span></div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_proveedor.php">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
                       
						<tr>
							<td width="15%"><span  id="tnomb">Nombre</span></td>
						    <td width="43%"><input NAME="Anombre" type="text" class="cajaGrande" id="nombre" size="45" maxlength="45"></td>
					        <td width="42%" rowspan="12" align="left" valign="top"><ul id="lista-errores"></ul></td>
						</tr>
						<tr>
						  <td><span  id="tnip">NIF / CIF</span></td>
						  <td><input id="nif" type="text" class="cajaPequena" NAME="anif" maxlength="15"></td>
				      </tr>
						<tr>
						  <td><span  id="tdireccion">Direcci&oacute;n</span></td>
						  <td><input NAME="adireccion" type="text" class="cajaGrande" id="direccion" size="45" maxlength="45"></td>
				      </tr>
					  <?php
					  	$query_pais="SELECT * FROM pais ORDER BY nombrePais ASC";
						$res_pais=mysqli_query($conexion,$query_pais);
						$contador=0;
                        
					  ?>
<tr>
							<td>Pais</td>
							<td><select id="cboPais" name="cboPais" class="comboMedio">
								<option value="0"  data-opttrad="selepais" selected>Seleccione un pais</option>
								<?php
								while ($contador < mysqli_num_rows($res_pais)) { 
								?> 
								<option value="<?php echo mysqli_result($res_pais,$contador,"codPais")?>"><?php echo mysqli_result($res_pais,$contador,"nombrePais")?></option>
							
                               <?
								$contador++;
                                
								} ?>				
								</select>							</td>
					    </tr>
						<tr>
						  <td><span  id="tlocal">Localidad</span></td>
						  <td><input NAME="alocalidad" type="text" class="cajaGrande" id="localidad" size="35" maxlength="35"></td>
				      </tr>
					  <?php
					  	$query_provincias="SELECT * FROM provincias ORDER BY nombreprovincia ASC";
						$res_provincias=mysqli_query($conexion,$query_provincias);
						$contador=0;
					  ?>
						<tr>
							<td width="15%"><span  id="tpcia">Provincia</span></td>
							<td width="43%"><select id="cboProvincias" name="cboProvincias" class="comboGrande">
							<option value="0" data-opttrad="selprovincia" >Seleccione una provincia</option>
						
								</select>							</td>
				        </tr>
						<?php
					  	$query_entidades="SELECT * FROM entidades WHERE borrado=0 ORDER BY nombreentidad ASC";
						$res_entidades=mysqli_query($conexion,$query_entidades);
						$contador=0;
					  ?>
						<tr>
							<td width="15%"><span  id="tentiban">Entidad Bancaria</span></td>
							<td width="43%"><select id="cboBanco" name="cboBanco" class="comboGrande">
							<option value="0" data-opttrad="selntiban" >Seleccione una entidad bancaria<</option>
									<?php
								while ($contador < mysqli_num_rows($res_entidades)) { ?>
								<option value="<?php echo mysqli_result($res_entidades,$contador,"codentidad")?>"><?php echo mysqli_result($res_entidades,$contador,"nombreentidad")?></option>
								<? $contador++;
								} ?>
											</select>							</td>
				        </tr>
						<tr>
							<td><span  id="tctabcaria">Cuenta bancaria</span></td>
							<td><input id="cuentabanco" type="text" class="cajaGrande" NAME="acuentabanco" maxlength="20"></td>
					    </tr>
						<tr>
							<td><span  id="tcodpostal">C&oacute;digo postal</span></td>
							<td><input id="codpostal" type="text" class="cajaPequena" NAME="acodpostal" maxlength="5"></td>
					    </tr>
						<tr>
							<td><span  id="ttelef">Tel&eacute;fono</span></td>
							<td><input id="telefono" name="atelefono" type="text" class="cajaPequena" maxlength="14"></td>
					    </tr>
						<tr>
							<td><span  id="tmovil">M&oacute;vil</span></td>
							<td><input id="movil" name="amovil" type="text" class="cajaPequena" maxlength="14"></td>
					    </tr>
						<tr>
							<td><span  id="tcorrelec">Correo electr&oacute;nico</span></td>
							<td><input NAME="aemail" type="text" class="cajaGrande" id="email" size="35" maxlength="35"></td>
					    </tr>
												<tr>
							<td><span  id="tdirrcweb">Direcci&oacute;n web</span></td>
							<td><input NAME="aweb" type="text" class="cajaGrande" id="web" size="45" maxlength="45"></td>
					    </tr>
					</table>
			  </div>
				<div id="botonBusqueda">
					<button type="button" id="btnaceptar" onClick="validar(formulario,true)"  onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span  id="taceptar">Aceptar</span> </button>

					<button type="button" id="btnlimpiar"  onClick="limpiar()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span  id="tlimpiar">Limpiar</span> </button>
					<button type="button" id="btncancelar"  onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/cancelar.svg" alt="cancelar" /> <span  id="tcancelar">Cancelar</span> </button>
					<input id="accion" name="accion" value="alta" type="hidden">
					<input id="id" name="id" value="" type="hidden">
			  </div>
			  </form>
		  </div>
		  </div>
		</div>
	</body>
</html>
