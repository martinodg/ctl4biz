<?php
require_once("../conectar7.php");
if(session_id() == '') {
    session_start();
}
require_once("../mysqli_result.php");

$descstock=(int)$_GET["cantdescontar"];
$codart=(int)$_GET["codigoarticulo"];

if ($descstock == ''){
    $descstock = 0;
}

//define stock actual
$query_sctokActual="SELECT * FROM articulos WHERE codarticulo=$codart";
$rs_query=mysqli_query($conexion,$query_sctokActual);
$stockAct=mysqli_result($rs_query,0,"stock");//stock actual

$stockActualizado = $stockAct - $descstock;

$query_apdatestock="UPDATE articulos SET stock = $stockActualizado WHERE articulos.codarticulo = $codart";
$rs_query=mysqli_query($conexion,$query_apdatestock);
?>
