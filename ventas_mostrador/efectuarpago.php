<?
if(session_id() == '') {
    session_start();
}
$moneda= $_SESSION['company_currency_sign'];
require_once("../conectar7.php");
require_once("../mysqli_result.php");

$codfactura=$_GET["codfactura"];
$codcliente=$_GET["codcliente"];
$importe=$_GET["importe"]; 

$sel_clientes="SELECT nombre FROM clientes WHERE codcliente='$codcliente'";
$rs_clientes=mysqli_query($conexion,$sel_clientes);
$nombre_cliente=mysqli_result($rs_clientes,0,"nombre");


$descstock=$_GET["descstock"];
$codart=$_GET["codart"];

//define stock actual
$query_sctokActual="SELECT * FROM articulos WHERE codarticulo=$codart";
$rs_query=mysqli_query($conexion,$query_sctokActual);
$stockAct=mysqli_result($rs_query,0,"stock");//stock actual

?>

<html>
<head>
<title>Pago Mostrador Venta</title>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
<link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
<script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>
<script type="text/JavaScript" language="javascript" src="../calendario/calendar-setup.js"></script>
<script type="text/javascript" src="../jquery/jquery331.js"></script>
<script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>

<script>

var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
function actualizarimporte() {
	var importe=document.getElementById("importe").value;
	var importevale=document.getElementById("importevale").value;
	if( importevale.search('[^0-9.]') == -1 ) 
		{
			var resta=parseFloat(importe-importevale);
			var valor=Math.round(resta*100)/100 ;
			document.getElementById("apagar").value=valor;
		} else {
			alert ("El importe del vale no es correcto.");
		}		
}

function actualizarimportedevolver() {
	var importe=document.getElementById("importe").value;
	var pagado=document.getElementById("pagado").value;
	if( pagado.search('[^0-9.]') == -1 ) 
		{
			var resta=parseFloat(pagado-importe);
			var valor=Math.round(resta*100)/100 ;
			document.getElementById("adevolver").value=valor;
		} else {
			alert ("El importe pagado no es correcto.");
		}		
}

function imprimir(codfactura) {
	var pagado=document.getElementById("pagado").value;
	var adevolver=document.getElementById("adevolver").value;
	location.href="../fpdf/imprimir_ticket_html.php?codfactura=" + codfactura + "&pagado=" + pagado + "&adevolver=" + adevolver;
}

function descontarAlstock(){
            window.open("../funciones/descontandostock.php?cantdescontar="+"<?php echo $descstock ?>"+"&codigoarticulo="+"<?php echo $codart ?>");
}

function enviar() {
    descontarAlstock();
					$.getJSON('../funciones/BackendQueries/insertCollection.php', 
															{codfactura:$("#codfactura").val(),
															codcliente:$("#codcliente").val(),
															importe:$("#importe").val(),
															importevale:$("#importevale").val(),
															numdocumento:$("#numdocumento").val(),
															fechacobro:$("#fechacobro").val(),
															//fechacobro:$("#fechacobro").val(),
															formapago:$("#formapago").val() 
															},function(data) {
																//alert(data.answer);
                            													if (data.answer == 0){
																					talert('msgfacyacbr');
																					$("#botticket").attr("disabled",false);
																					$("#botaceptar").attr("disabled",true);
																					//parent.window.close()
																				}else{
																					talert('msgcbrok');
																					$("botticket").attr("disabled",false);
																					$("botaceptar").attr("disabled",true);
																					//parent.window.close()
																				}
																				alert(data.messages);
																			}
                    														
            );
}
</script>
</head>

<body>
<div id="pagina">
<div id="zonaContenido">
<div id="tituloForm2" class="header"><span  id="tcobro">COBRO</span> </div>
<div id="frmBusqueda2">
<div align="center">
<form id="formulario" name="formulario" method="post" action="guardar_cobro.php" target="frame_datos">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=2 border=0>
						<tr>
							<td width="25%"><span  id="tcodfactura">C&oacute;digo Factura</span> </td>
				        	<td width="75%"><input NAME="codfactura" type="text" class="cajaPequena" id="codfactura" size="15" maxlength="15" value="<? echo $codfactura?>" readonly="yes">						</tr>
						<tr>
							<td><span  id="tcliente">Cliente</span></td>
						    <td><input NAME="nombre_cliente" type="text" class="cajaGrande" id="nombre_cliente" size="45" maxlength="45" value="<? echo $nombre_cliente?>" readonly></td>
			            </tr>
						<tr>
							<td><span  id="timporte">IMPORTE</span></td>
						    <td><input NAME="importe" type="text" class="cajaPequena" id="importe" size="10" maxlength="10" value="<? echo $importe?>" readonly> <?echo $moneda;?></td>
			            </tr>
						<tr>
							<td><span  id="timpvl">Importe vale</span></td>
						    <td><input NAME="importevale" type="text" class="cajaPequena" id="importevale" size="10" maxlength="10" value="0"> <?echo $moneda;?><img src="../img/disco.svg" name="Image2" id="Image2" width="16" height="16" border="0" id="Image2" onMouseOver="this.style.cursor='pointer'" title="Aplicar Vale" onClick="actualizarimporte()"></td>
			            </tr>
						<tr>
							<td><span  id="tapgr">A pagar</span></td>
						    <td><input NAME="apagar" type="text" class="cajaPequena" id="apagar" size="10" maxlength="10" value="<? echo $importe?>" readonly> <?echo $moneda;?></td>
			            </tr>
						<tr>
							<td><span  id="tdineroEnt">Dinero Entregado</span></td>
						    <td><input NAME="pagado" type="text" class="cajaPequena" id="pagado" size="10" maxlength="10"> <?echo $moneda;?></td>
			            </tr>
						<tr>
							<td><span  id="tadevolver">A devolver</span></td>
						    <td><input NAME="adevolver" type="text" class="cajaPequena" id="adevolver" size="10" maxlength="10" readonly> <?echo $moneda;?></td>
			            </tr>
						<?
						$query_fp="SELECT * FROM formapago WHERE borrado=0 ORDER BY nombrefp ASC";
						$res_fp=mysqli_query($conexion,$query_fp);
						$contador=0; ?>
						<tr>
							<td><span  id="tforpago">Forma de pago</span></td>
						    <td><select id="formapago" name="formapago" class="comboGrande">
								<?php
								while ($contador < mysqli_num_rows($res_fp)) { 
									if (mysqli_result($res_fp,$contador,"codformapago") ==1) { ?>
								<option value="<?php echo mysqli_result($res_fp,$contador,"codformapago")?>" selected="selected"><?php echo mysqli_result($res_fp,$contador,"nombrefp")?></option> 
								<? } else { ?>
								<option value="<?php echo mysqli_result($res_fp,$contador,"codformapago")?>"><?php echo mysqli_result($res_fp,$contador,"nombrefp")?></option>
								<? 
									}
									$contador++;
								} ?>				
								</select></td>
			            </tr>
						<tr>
							<td>N&uacute;mero de documento</td>
						    <td><input NAME="numdocumento" type="text" class="cajaGrande" id="numdocumento" size="40" maxlength="40"></td>
			            </tr>
						<? $hoy=date("d/m/Y"); ?>
						<tr>
							<td>Fecha de cobro</td>
						    <td><input NAME="fechacobro" type="text" class="cajaPequena" id="fechacobro" size="10" maxlength="10" value="<? echo $hoy?>" readonly> <img src="../img/calendario.svg" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fechacobro",
					ifFormat   : "%d/%m/%Y",
					button     : "Image1"
					  }
					);
		</script></td>
			            </tr>
					</table>										
			  </div>
			  <br><br>
			  <div align="center">
                    <button type="button" id="btnaceptar" onClick="enviar()"onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span  id="taceptar">Aceptar</span> </button>
					<button type="button" id="btnimprimir"  onClick="imprimir(<? echo $codfactura?>)" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span>Imprimir Tkt</span> </button>
					<button type="button" id="btncancelar"  onClick="window.close()"  onMouseOver="style.cursor=cursor"> <img src="../img/cancelar.svg" alt="cancelar" /> <span  id="tcancelar">Cancelar</span> </button>
				</div>
			  <input id="codfactura" name="codfactura" value="<? echo $codfactura?>" type="hidden">
			  <input id="codcliente" name="codcliente" value="<? echo $codcliente?>" type="hidden">
			  <input id="importe" name="importe" value="<? echo $importe?>" type="hidden">
</form>
			  </div>
			  </div>
			  </div>
			  </div>
<iframe id="frame_datos" name="frame_datos" width="0%" height="0" frameborder="0">
	<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
</iframe>
</body>
</html>
