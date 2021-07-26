<?
require_once("../../conectar7.php"); 
$errorMessage='initInvoice.php messages: ';
$today=date("Y-m-d");
$nombre=$_POST["Anombre"];
$porcentaje=$_POST["Rporcentaje"];
$userid=$_SESSION['id'];

				
				$ins_plist="INSERT INTO listaDePrecios (codLista,nombre,porcentaje,codusuario,fechaInser) VALUE ('','$nombre','$porcentaje','$userid','$today')";
	//echo "<script>console.log($ins_plist);</script>";	
	//INIT INVOICE	
	$rs_insPlist=mysqli_query($conexion,$ins_plist);
	$id_plist=mysqli_insert_id($conexion);
	mysqli_close($conexion);
	header("Location: ../../lista_de_precios/index.php");

?>