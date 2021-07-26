<?
require_once("../../varConnUserDB.php"); 
require_once("getNewLineNumber.php"); 
//require_once("../../conectar7.php"); 
//require_once("../../mysqli_result.php");

$errorMessage='';
$conexion=mysqli_connect($Servidor,$Usuario,$Password,$BaseDeDatos) or die("Error: La Funcion insertTempInvoice no puede conectar con la base de datos");
$where="";
//check doctype argument

    
if(isset($_GET['idList'])) { $idList=$_GET['idList'];
	$where="AND codLista='".$idList."'";
	}


 
//if($errorMessage<>""){echo $errorMessage;
	//					return; }else{


					

	//INSERT INVOICE
	//$prueba=newNumberLine($table,$codFacturat);
	//$codLineTmp=1;
	//$codLineTmp=newNumberLine($table,$codFacturat);
	//echo $codLineTmp;
	$query_borrar="DELETE FROM listaDePrecios WHERE 1=1 ".$where.";";
	echo $query_borrar;
	$rs_borrar=mysqli_query($conexion,$query_borrar);
	mysqli_close($conexion);
	echo $errorMessage;
//}


?>