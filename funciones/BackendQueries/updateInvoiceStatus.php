<?php
header('Cache-Control: no-cache');
header('Pragma:no-cache'); 
require_once("../../conectar7.php"); 
if (isset($_GET["estado"])){$estado=$_GET["estado"];}
if (isset($_GET["codfactura"])){$codfactura=$_GET["codfactura"];}
if (isset($_GET["tipoFactura"])){$tipoFactura=$_GET["tipoFactura"];}
if (isset($_GET["codproveedor"])){$codproveedor=$_GET["codproveedor"];
	$where="AND codproveedor='$codproveedor'";
}else{$where="";}

	
	$act_factura="UPDATE $tipoFactura SET estado='$estado' WHERE codfactura='$codfactura' $where;";
	$rs_act=mysqli_query($conexion,$act_factura);

	echo '<span id="testactual"> El estado ha sido acturalizado</span>';
?>
</body>
</html>
