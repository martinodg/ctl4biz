<?php 
require_once("../../conectar7.php");
require_once("../fechas.php");  

$codfactura=$_GET["codfactura"];
$codcliente=$_GET["codcliente"];
$importe=$_GET["importe"];
$importevale=$_GET["importevale"];
$importe=$importe-$importevale;
$numdocumento=$_GET["numdocumento"];
$fechacobro=$_GET["fechacobro"];
$fechacobro=explota($_GET["fechacobro"]);
$formapago=$_GET["formapago"];
$errorMessage="";
$sel_comprueba="SELECT * FROM cobros WHERE codfactura='$codfactura'";
$errorMessage=$sel_comprueba;
$rs_comprueba=mysqli_query($conexion,$sel_comprueba);

if (mysqli_num_rows($rs_comprueba) > 0 ) {
	
		//devuelve flag para script uno
        $answer=0;

} else {

		$sel_insert="INSERT INTO cobros (id,codfactura,codcliente,importe,codformapago,numdocumento,fechacobro,observaciones) VALUES ('','$codfactura','$codcliente','$importe','$formapago','$numdocumento','$fechacobro','')";
		$rs_insert=mysqli_query($conexion,$sel_insert);
		
		$sel_insert2="INSERT INTO librodiario (id,fecha,tipodocumento,coddocumento,codcomercial,codformapago,numpago,total) VALUES ('','$fechacobro','2','$codfactura','$codcliente','$formapago','$numdocumento','$importe')";
		$rs_insert2=mysqli_query($conexion,$sel_insert2);
		
		$sel_insert3="UPDATE facturas SET estado=2 WHERE codfactura='$codfactura'";
		$rs_insert3=mysqli_query($conexion,$sel_insert3);
		
		
		//Devuleve flag para scirpt 2
		$answer=1;
 } 
 $data['answer']= $answer;
 $data['messages']= $errorMessage;
 echo json_encode($data);
 ?>
