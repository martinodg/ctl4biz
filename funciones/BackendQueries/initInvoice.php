<?
require_once("../../conectar7.php"); 
$errorMessage='initInvoice.php messages: ';

//check doctype argument
if (isset($_GET['docType'])) { 
	$doctype=$_GET['docType'];
	if ($doctype=="tempInvoice"){
		$table="facturastmp";
	}else{ $errorMessage.= "Unknown doctype. "; }
	//INIT INVOICE
	$today=date("Y-m-d");
	$sel_invoice="INSERT INTO $table (codfactura,fecha) VALUE ('','$today')";
	$rs_invoice=mysqli_query($conexion,$sel_invoice);
	$id_invoice=mysqli_insert_id($conexion);
	mysqli_close($conexion);
}else{ $errorMessage.="Doctype is a required parameter to init invoce. "; }

$data['today']= $today;
$data['idInvoice']= $id_invoice;
$data['messages']= $errorMessage;
echo json_encode($data);

?>