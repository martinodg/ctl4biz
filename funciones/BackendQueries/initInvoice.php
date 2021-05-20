<?
require_once("../../conectar7.php"); 
$errorMessage='initInvoice.php messages: ';
$today=date("Y-m-d");
if(isset($_GET['fecha'])) {$fecha=$_GET['fecha'];}
if(isset($_GET['codcliente'])) {$codcliente=$_GET['codcliente'];}
if(isset($_GET['impuestos'])) {$impuestos=$_GET['impuestos'];}
if(isset($_GET['baseimponible'])) {$baseimponible=$_GET['baseimponible'];}
if(isset($_GET['totalfactura'])) {$totalfactura=$_GET['totalfactura'];}
//check doctype argument
if (isset($_GET['docType'])) { 
	$doctype=$_GET['docType'];
	if ($doctype=="tempInvoice"){
		$sel_invoice="INSERT INTO facturastmp (codfactura,fecha) VALUE ('','$today')";
	}else{ if ($doctype=="Invoice"){
				
				$sel_invoice="INSERT INTO facturas (codfactura,fecha,codcliente,estado,impuestos,totalfactura,borrado) VALUE ('','$fecha','$codcliente','1',$impuestos,'$totalfactura','0')";
			}else{$errorMessage.= "Unknown doctype. "; }
	}
	//INIT INVOICE	
	$rs_invoice=mysqli_query($conexion,$sel_invoice);
	$id_invoice=mysqli_insert_id($conexion);
	mysqli_close($conexion);
}else{ $errorMessage.="Doctype is a required parameter to init invoce. "; }

$data['today']= $today;
$data['idInvoice']= $id_invoice;
$data['messages']= $errorMessage;
echo json_encode($data);

?>