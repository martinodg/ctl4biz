<?
require_once("../../conectar7.php"); 
$errorMessage='initInvoice.php messages: ';
$today=date("Y-m-d");
$codLista=$_POST["Nid"];
$nombre=$_POST["Anombre"];
$porcentaje=$_POST["Rporcentaje"];
$userid=$_SESSION['id'];

if ($codLista==""){
		$ins_plist="INSERT INTO listaDePrecios (codLista,nombre,porcentaje,codusuario,fechaInser) VALUE ('','$nombre','$porcentaje','$userid','$today')";	
}else{
		$ins_plist="UPDATE listaDePrecios SET nombre='$nombre' ,porcentaje='$porcentaje' ,codusuario='$userid' ,fechaInser='$today' WHERE codLista='$codLista'";
}
				
	//INIT INVOICE	
	$rs_insPlist=mysqli_query($conexion,$ins_plist);
	if ($codLista==""){
		$id_plist=mysqli_insert_id($conexion);
	}
	mysqli_close($conexion);
	header("Location: ../../lista_de_precios/index.php");

?>