<?php
if(session_id() == '') {
    session_start();
}
$moneda= $_SESSION['company_currency_sign'];
require_once("../conectar7.php");
require_once("../mysqli_result.php");
require_once("../funciones/fechas.php");
 
$codfactura=$_GET["codfactura"];

$select_facturas="SELECT clientes.codcliente,clientes.nombre,facturas.codfactura,estado,fechavencimiento,totalfactura FROM facturas LEFT JOIN cobros ON facturas.codfactura=cobros.codfactura INNER JOIN clientes ON facturas.codcliente=clientes.codcliente WHERE facturas.codfactura='$codfactura'";
$rs_facturas=mysqli_query($conexion,$select_facturas);

$hoy=date("d/m/Y");

$sel_cobros="SELECT sum(importe) as aportaciones FROM cobros WHERE codfactura='$codfactura'";
$rs_cobros=mysqli_query($conexion,$sel_cobros);
$aportaciones=mysqli_result($rs_cobros,0,"aportaciones");

?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="../funciones/validar.js"></script>		
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
		
		
		function cancelar() {
			location.href="index.php";
		}
		
		function cambiar_estado() {
			
			var estado=$("#cboEstados").val();
			var codfactura=$("#codfactura").val();
			$.get( "../funciones/BackendQueries/updateInvoiceStatus.php" , { codfactura:codfactura,
																				tipoFactura:"facturas",
																				estado:estado	
                                                                     },function ( data ) { 
                                                                                        $('#frame_datos2').html(data);    
                                                                                  }
                );
			
			
			
			
		//	miPopup = window.open("actualizarestado.php?estado="+estado+"&codfactura="+codfactura,"frame_datos","width=700,height=80,scrollbars=yes");
		}
		
		function cambiar_vencimiento() {
			var fechavencimiento=document.getElementById("fechavencimiento").value;
			var codfactura=document.getElementById("codfactura").value;
			miPopup = window.open("actualizarvencimiento.php?fechavencimiento="+fechavencimiento+"&codfactura="+codfactura,"frame_datos","width=700,height=80,scrollbars=yes");
		}
			
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
                    <div id="tituloForm" class="header"><span  id="tcobros">COBROS</span></div>
				<div id="frmBusqueda">
				<form id="formdatos" name="formdatos" method="post" action="guardar_cobro.php">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
					<? 
					 	$codcliente=mysqli_result($rs_facturas,0,"codcliente");
						$nombre=mysqli_result($rs_facturas,0,"nombre");
						$codfactura=mysqli_result($rs_facturas,0,"codfactura");
						$totalfactura=mysqli_result($rs_facturas,0,"totalfactura");
						$estado=mysqli_result($rs_facturas,0,"estado"); 
						$fechavencimiento=mysqli_result($rs_facturas,0,"fechavencimiento");
						if ($fechavencimiento=="0000-00-00") { $fechavencimiento=""; } else { $fechavencimiento=implota($fechavencimiento); } 						
						?>
						<tr>
                            <td width="15%"><span  id="tcod_cliente">C&oacute;digo de cliente</span></td>
						    <td width="43%"><? echo $codcliente?></td>
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
								<option value="2" data-opttrad="pagada" >Pagada</option><? } else { ?>
								<option value="1" data-opttrad="sinpagar" >Sin Pagar</option>
								<option value="2" data-opttrad="pagada" selected="selected">Pagada</option>
								<? } ?> 			
								</select></td>
					        <td width="42%" rowspan="14" align="left" valign="top"></td>
						</tr>	
						<tr>
                            <td width="15%"><span  id="tfchavto">Fecha de vencimiento</span></td>
						    <td width="43%"><input id="fechavencimiento" type="text" class="cajaPequena" NAME="fechavencimiento" maxlength="10" value="<? echo $fechavencimiento?>" readonly><img src="../img/calendario.svg" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'" data-ttitle="cal" title="Calendario">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fechavencimiento",
					ifFormat   : "%d/%m/%Y",
					button     : "Image1"
					  }
					);
		</script><img src="../img/disco.svg" name="Image2" id="Image2" width="16" height="16" border="0" id="Image2" onMouseOver="this.style.cursor='pointer'" title="Guardar fecha" onClick="cambiar_vencimiento()"></td>
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
							<td width="15%">Fecha de cobro</td>
						    <td width="35%"><input id="fechacobro" type="text" class="cajaPequena" NAME="fechacobro" maxlength="10" value="<? echo $hoy?>" readonly><img src="../img/calendario.svg" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'" data-ttitle="cal" title="Calendario">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fechacobro",
					ifFormat   : "%d/%m/%Y",
					button     : "Image1"
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
					<input type="hidden" name="codcliente" id="codcliente" value="<? echo $codcliente?>">
					<input type="hidden" name="codfactura" id="codfactura" value="<? echo $codfactura?>">
					<button type="button" id="btnaceptar" onClick="javascript:validar(formulario,true);" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span  id="taceptar">Aceptar</span> </button>
					<button type="button" id="btncancelar"  onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/cancelar.svg" alt="cancelar" /> <span  id="tcancelar">Cancelar</span> </button>
			  </div>
			  </form>
			  <br>
			  <div id="frmBusqueda">
			  <div id="cabeceraResultado2" class="header"><span  id="treldcob">relacion de COBROS</span> </div>
				<div id="frmResultado2">
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="10%"><span  id="titem">ITEM</span></td>
							<td width="12%"><span  id="tfecha">Fecha</span></td>
							<td width="12%"><span  id="timporte">IMPORTE</span></td>
							<td width="20%"><span  id="tforpago">FORMA PAGO</span></td>
							<td width="20%"><span  id="tnrodocum">N. DOCUMENTO</span></td>
							<td width="15%"><span  id="tfcvencrt">FECHA VTO.</span></td>
							<td width="5%"><span  id="tobv">OBV.</span></td>
							<td width="6%">&nbsp;</td>
						</tr>
				</table>
				</div>
					<div id="lineaResultado">
					<iframe width="100%" height="250" id="frame_cobros" name="frame_cobros" frameborder="0" src="frame_cobros.php?accion=ver&codfactura=<? echo $codfactura?>">
						<ilayer width="100%" height="250" id="frame_cobros" name="frame_cobros"></ilayer>
					</iframe>
					<iframe id="frame_datos" name="frame_datos" width="0" height="0" frameborder="0">
					<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
					</iframe>
					<iframe id="frame_datos2" name="frame_datos2" width="0" height="0" frameborder="0">
					<ilayer width="0" height="0" id="frame_datos2" name="frame_datos2"></ilayer>
					</iframe>
				</div>
				</div>
			  </div>
		  </div>
		</div>
	</body>
</html>
