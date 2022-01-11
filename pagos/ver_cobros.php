<?php
if(session_id() == '') {
    session_start();
}
$moneda= $_SESSION['company_currency_sign'];
require_once("../conectar7.php");
require_once("../mysqli_result.php");
require_once("../funciones/fechas.php");
 
$codfactura=$_GET["codfactura"];
$codproveedor=$_GET["codproveedor"]; 


$select_facturas="SELECT proveedores.codproveedor,proveedores.nombre,facturasp.codfactura,estado,facturasp.fechapago,totalfactura FROM facturasp LEFT JOIN pagos ON facturasp.codfactura=pagos.codfactura AND facturasp.codproveedor=pagos.codproveedor INNER JOIN proveedores ON facturasp.codproveedor=proveedores.codproveedor WHERE facturasp.codfactura='$codfactura' AND facturasp.codproveedor='$codproveedor'";

$rs_facturas=mysqli_query($conexion,$select_facturas);

$hoy=date("d/m/Y");

$sel_cobros="SELECT sum(importe) as aportaciones FROM pagos WHERE codfactura='$codfactura' AND codproveedor='$codproveedor'";
$rs_cobros=mysqli_query($conexion,$sel_cobros);
$aportaciones=mysqli_result($rs_cobros,0,"aportaciones");

?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		
		<script type="text/javascript" src="../funciones/validar.js"></script>		
		<link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>
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
		
		
		function cancelar() {
			location.href="index.php";
		}
		
		function cambiar_estado() {
			var estado=$("#cboEstados").val();
			var codFactura=$("#codfactura").val();
			var codProveedor=$("#codproveedor").val();
			$.get( "../funciones/BackendQueries/updateInvoiceStatus.php" , { codfactura:codFactura,
																				tipoFactura:"facturasp",
																				codproveedor:codProveedor,
																				estado:estado	
                                                                     },function ( data ) { 
                                                                                        $('#frame_datos2').html(data);    
                                                                                  }
                );
			

			
			//var estado=document.getElementById("cboEstados").value;
			//var codfactura=document.getElementById("codfactura").value;
			//var codproveedor=document.getElementById("codproveedor").value;
			//miPopup = window.open("actualizarestado.php?estado="+estado+"&codfactura="+codfactura+"&codproveedor="+codproveedor,"frame_datos","width=700,height=80,scrollbars=yes");
		}
		
		function cambiar_vencimiento() {
			var fechapago=document.getElementById("fechapago").value;
			var codfactura=document.getElementById("codfactura").value;
			var codproveedor=document.getElementById("codproveedor").value;
			miPopup = window.open("actualizarvencimiento.php?fechapago="+fechapago+"&codfactura="+codfactura+"&codproveedor="+codproveedor,"frame_datos","width=700,height=80,scrollbars=yes");
		}
			
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
                    <div id="tituloForm" class="header"><span  id="tpagos">PAGOS</span></div>
				<div id="frmBusqueda">
				<form id="formdatos" name="formdatos" method="post" action="guardar_cobro.php">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
					<? 
					 	$codproveedor=mysqli_result($rs_facturas,0,"codproveedor");
						$nombre=mysqli_result($rs_facturas,0,"nombre");
						$codfactura=mysqli_result($rs_facturas,0,"codfactura");
						$totalfactura=mysqli_result($rs_facturas,0,"totalfactura");
						$estado=mysqli_result($rs_facturas,0,"estado"); 
						$fechapago=mysqli_result($rs_facturas,0,"fechapago");
						
						if ($fechapago=="0000-00-00") { $fechapago=""; } else { $fechapago=implota($fechapago); } 		
						echo $fechapago;				
						?>
						<tr>
                            <td width="15%"><span  id="tcodprov">C&oacute;digo de proveedor</span></td>
						    <td width="43%"><? echo $codproveedor?></td>
					        <td width="42%" rowspan="14" align="left" valign="top"></td>
						</tr>
						<tr>
							<td width="15%"><span  id="tnomb">Nombre</span></td>
						    <td width="43%"><? echo $nombre?></td>
					        <td width="42%" rowspan="14" align="left" valign="top"></td>
						</tr>	
						<tr>
							<td width="15%"><span  id="tcodfactura">C&oacute;digo de factura</span></td>
						    <td width="43%"><? echo $codfactura?></td>
					        <td width="42%" rowspan="14" align="left" valign="top"></td>
						</tr>
						<tr>
							<td width="15%"><span  id="timpfactura">Importe de la factura</span></td>
						    <td width="43%"><? echo number_format($totalfactura,2)?></td>
					        <td width="42%" rowspan="14" align="left" valign="top"></td>
						</tr>
						<? $pendiente=$totalfactura-$aportaciones; ?>
						<tr>
							<td width="15%"><span  id="tpndpagar">Pendiente por pagar</span></td>
						    <td width="43%"><input type="text" name="pendiente" id="pendiente" value="<? echo number_format($pendiente,2,".","")?>" readonly="yes" class="cajaTotales"> <?echo $moneda;?></td>
					        <td width="42%" rowspan="14" align="left" valign="top"></td>
						</tr>
						<tr>
							<td width="15%"><span  id="tetdfac">Estado de la factura</span></td>
						    <td width="43%"><select id="cboEstados" name="cboEstados" class="comboMedio" onChange="cambiar_estado()">
								<? if ($estado==1) { ?><option value="1" selected="selected" data-opttrad="sinpagar" >Sin Pagar</option>
								<option value="2"data-opttrad="pagada" >Pagada</option><? } else { ?>
								<option value="1" data-opttrad="sinpagar" >Sin Pagar</option>
								<option value="2" selected="selected"data-opttrad="pagada" >Pagada</option>
								<? } ?> 			
								</select></td>
					        <td width="42%" rowspan="14" align="left" valign="top"></td>
						</tr>	
						<tr>
                            <td width="15%"><span  id="tfchpago">Fecha de pago</span></td>
						    <td width="43%"><input id="fechapago" type="text" class="cajaPequena" NAME="fechapago" maxlength="10" value="<? echo $fechapago?>" ><img src="../img/calendario.svg" name="Image1" id="Image1" width="16" height="16" border="0" onMouseOver="this.style.cursor='pointer'" data-ttitle="cal" title="Calendario">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fechapago",
					ifFormat   : "%d/%m/%Y",
					button     : "Image1"
					  }
					);
        </script>
                                <img src="../img/disco.svg" name="Image2" id="Image2" width="16" height="16" border="0" onMouseOver="this.style.cursor='pointer'" data-ttitle="grdfecha" title="Guardar fecha" onClick="cambiar_vencimiento()"></td>
					        <td width="42%" rowspan="14" align="left" valign="top"></td>
						</tr>										
					</table>
					</form>
			  </div>
			  <br>
			  <div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="frame_cobros.php" target="frame_cobros">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
                            <td width="15%"><span  id="fchdlpago">Fecha del pago</span></td>
						    <td width="35%"><input id="fechapago2" type="text" class="cajaPequena" NAME="fechapago2" maxlength="10" value="<? echo $hoy?>" ><img src="../img/calendario.svg" name="Image3" id="Image3" width="16" height="16" border="0" onMouseOver="this.style.cursor='pointer'" data-ttitle="cal" title="Calendario">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fechapago2",
					ifFormat   : "%d/%m/%Y",
					button     : "Image3"
					  }
					);
		</script></td>
					        <td width="50%" rowspan="14" align="left" valign="top"><ul id="lista-errores"></ul></td>
						</tr>
						<tr>
							<td width="15%"><span  id="timporte">IMPORTE</span></td>
						    <td width="35%"><input id="Rimporte" type="text" class="cajaPequena" NAME="Rimporte" maxlength="12"> <?echo $moneda;?></td>
					        <td width="50%" rowspan="14" align="left" valign="top"></td>
						</tr>	
						<?php
					  	$query_fp="SELECT * FROM formapago WHERE borrado=0 ORDER BY nombrefp ASC";
						$res_fp=mysqli_query($conexion,$query_fp);
						$contador=0;
					  ?>
						<tr>
							<td width="15%"><span  id="tforpago">Forma de pago</span></td>
							<td width="35%"><select id="AcboFP" name="AcboFP" class="comboGrande">
							
								<option value="0" data-opttrad="selfrmpago" >Seleccione una forma de pago</option>
								<?php
								while ($contador < mysqli_num_rows($res_fp)) { ?>
								<option value="<?php echo mysqli_result($res_fp,$contador,"codformapago")?>"><?php echo mysqli_result($res_fp,$contador,"nombrefp")?></option>
								<? $contador++;
								} ?>				
								</select>							</td>
								<td width="50%" rowspan="14" align="left" valign="top"></td>
				        </tr>
						<tr>
							<td width="15%"><span  id="tnrodocum">Num. Documento</span></td>
						    <td width="35%"><input id="anumdocumento" type="text" class="cajaMedia" NAME="anumdocumento" maxlength="30"></td>
					        <td width="50%" rowspan="14" align="left" valign="top"></td>
						</tr>	
						<tr>
							<td width="15%"><span  id="tobsev">Observaciones</span></td>
						    <td width="35%"><textarea rows="5" cols="30" class="areaTexto" name="observaciones" id="observaciones"></textarea></td>
					        <td width="40%" rowspan="14" align="left" valign="top"></td>
						</tr>																	
					</table>
			  </div>
				<div id="botonBusqueda">
					<input type="hidden" name="id" id="id">
					<input type="hidden" name="accion" id="accion" value="insertar">
					<input type="hidden" name="codproveedor" id="codproveedor" value="<? echo $codproveedor?>">
					<input type="hidden" name="codfactura" id="codfactura" value="<? echo $codfactura?>">
					<button type="button" id="btnaceptar" onClick="validar(formulario,true)"  onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span  id="taceptar">Aceptar</span> </button>
					<button type="button" id="btncancelar"  onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/cancelar.svg" alt="cancelar" /> <span  id="tcancelar">Cancelar</span> </button>
			  </div>
			  </form>
			  <br>
			  <div id="frmBusqueda">
			  <div id="cabeceraResultado2" class="header">
					relacion de PAGOS </div>
				<div id="frmResultado2">
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="10%"><span  id="titem">ITEM</span></td>
							<td width="12%"><span  id="tfecha">Fecha</span></td>
							<td width="12%"><span  id="timporte">IMPORTE</span></td>
							<td width="20%"><span  id="tforpago">FORMA PAGO</span></td>
							<td width="20%"><span  id="tnrodocum">N. DOCUMENTO</span></td>
                            <td width="15%"><span  id="tfcpago">FECHA PAGO</span></td>
							<td width="5%"><span  id="tobv">OBV.</span></td>
							<td width="6%">&nbsp;</td>
						</tr>
				</table>
				</div>
					<div id="lineaResultado">
					<iframe width="100%" height="250" id="frame_cobros" name="frame_cobros" frameborder="0" src="frame_cobros.php?accion=ver&codfactura=<? echo $codfactura?>&codproveedor=<? echo $codproveedor?>">
						<ilayer width="100%" height="250" id="frame_cobros" name="frame_cobros"></ilayer>
					</iframe>
					<iframe id="frame_datos" name="frame_datos" width="0" height="0" frameborder="0">
					<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
					</iframe>
				</div>
			</div>
			  </div>
		  </div>
		</div>
	</body>
</html>
