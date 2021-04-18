<?
require_once("../../varConnUserDB.php"); 
require_once("getNewLineNumber.php"); 
//require_once("../../conectar7.php"); 
//require_once("../../mysqli_result.php");

$errorMessage='';
$conexion=mysqli_connect($Servidor,$Usuario,$Password,$BaseDeDatos) or die("Error: La Funcion insertTempInvoice no puede conectar con la base de datos");

//check doctype argument

if (isset($_GET['docType'])) { $doctype=$_GET['docType'];

	if ($doctype=="tempInvoice"){
		$table="factulineatmp";
	}else{ $errorMessage.= "Unknown doctype. "; }}


if(isset($_GET['codFacturat'])) {$codFacturat=$_GET['codFacturat'];
    }else{ $errorMessage.= "Error. temporary invoice number is mandatory."; }
    
if(isset($_GET['codfamilia'])) {$codfamilia=$_GET['codfamilia'];
	}else{ $errorMessage.= "Error. Item family code is mandatory."; }

if(isset($_GET['codArticulo'])) {$codArticulo=$_GET['codArticulo'];
	}else{ $errorMessage.= "Error. Item  code is mandatory."; }

if(isset($_GET['cantidad'])) {$cantidad=$_GET['cantidad'];
	}else{ $errorMessage.= "Error. Item  quantity is mandatory."; }

 if(isset($_GET['precio'])) {$precio=$_GET['precio'];
 }else{ $errorMessage.= "Error. Item  price is mandatory."; }

 if(isset($_GET['importe'])) {$importe=$_GET['importe'];
	}else{ $errorMessage.= "Error. total amount is mandatory."; }

 if(isset($_GET['dscto'])) {$dscto=$_GET['dscto'];
	}

 if(isset($_GET['impuesto'])) {$impuesto=$_GET['impuesto'];
	}else{ $errorMessage.= "Error. Item  TAX is mandatory."; }
 
//if($errorMessage<>""){echo $errorMessage;
	//					return; }else{


					

	//INSERT INVOICE
	//$prueba=newNumberLine($table,$codFacturat);
	//$codLineTmp=1;
	$codLineTmp=newNumberLine($table,$codFacturat);
	echo $codLineTmp;
	$insert_invoice="INSERT INTO $table (codfactura, numlinea, codfamilia, codigo, cantidad, precio, importe, dcto, TAX) VALUE ('$codFacturat','$codLineTmp','$codfamilia','$codArticulo','$cantidad','$precio','$importe','$dscto','$impuesto');";
	echo $insert_invoice;
	$rs_invoice=mysqli_query($conexion,$insert_invoice);
	mysqli_close($conexion);

//}


?>