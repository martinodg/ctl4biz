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
    
if(isset($_GET['idLine'])) {$idLine=$_GET['idLine'];
	}else{ $errorMessage.= "Error. IdLine is needed to delette the line."; }

if(isset($_GET['codFacturat'])) {$codFacturat=$_GET['codFacturat'];
	}else{ $errorMessage.= "Error. codFacturat is needed to delette the line."; }

 
//if($errorMessage<>""){echo $errorMessage;
	//					return; }else{


					

	//INSERT INVOICE
	//$prueba=newNumberLine($table,$codFacturat);
	//$codLineTmp=1;
	//$codLineTmp=newNumberLine($table,$codFacturat);
	//echo $codLineTmp;
	$query_borrar="DELETE FROM $table WHERE codfactura='$codFacturat' and numlinea='$idLine';";
	echo $query_borrar;
	$rs_borrar=mysqli_query($conexion,$query_borrar);
	mysqli_close($conexion);
	echo $errorMessage;
//}


?>