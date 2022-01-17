<?php 
require_once("../../conectar7.php");
require_once("../fechas.php");
//error_reporting(E_ALL);
//ini_set('display_errors', -1);

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

//$errorMessage=$sel_comprueba;
$rs_comprueba=mysqli_query($conexion,$sel_comprueba);
$answer = 0;
try {
	if (mysqli_num_rows($rs_comprueba) > 0) {
		//devuelve flag para script uno
		//$answer = 0;
		throw new ErrorException('La factura ya fue pagada previamente');
	} else {

		//descontar stock
		$query_articulos = "SELECT cantidad, codigo   FROM  factulinea WHERE codfactura='$codfactura'";
		if ($rs_articulos_vendidos = mysqli_query($conexion, $query_articulos)) {
			$query_update_stock = '';
			while ($fila = mysqli_fetch_assoc($rs_articulos_vendidos)) {
				$codigo_producto = intval($fila['codigo']);
				$cantidad_producto_vendido = intval($fila['cantidad']);
				$rs_articulo_stock = mysqli_query($conexion, sprintf("SELECT codarticulo, stock FROM `articulos` WHERE codarticulo = %d", $codigo_producto));
				if (!$rs_articulo_stock) {
					throw new ErrorException(sprintf('El stock del producto %d no tiene existe', $codigo_producto));
				}
				$fila_articulo = mysqli_fetch_assoc($rs_articulo_stock);
				$stock = intval($fila_articulo['stock']);
				if ($stock <  $cantidad_producto_vendido ) {
					throw new ErrorException(sprintf('El stock del producto %d es de %d y se vendio %d', $codigo_producto, $stock, $cantidad_producto_vendido));
				}
				$query_update_stock .= sprintf("UPDATE articulos SET stock = stock-%d WHERE articulos.codarticulo = %d;", $cantidad_producto_vendido, $codigo_producto);
			}
			$rs_query = mysqli_query($conexion, $query_update_stock);
			/* liberar el conjunto de resultados */
			//mysqli_free_result($query_update_stock);
		}

		$sel_insert = "INSERT INTO cobros (id,codfactura,codcliente,importe,codformapago,numdocumento,fechacobro,observaciones) VALUES ('','$codfactura','$codcliente','$importe','$formapago','$numdocumento','$fechacobro','')";
		$rs_insert = mysqli_query($conexion, $sel_insert);

		$sel_insert2 = "INSERT INTO librodiario (id,fecha,tipodocumento,coddocumento,codcomercial,codformapago,numpago,total) VALUES ('','$fechacobro','2','$codfactura','$codcliente','$formapago','$numdocumento','$importe')";
		$rs_insert2 = mysqli_query($conexion, $sel_insert2);

		$sel_insert3 = "UPDATE facturas SET estado=2 WHERE codfactura='$codfactura'";
		$rs_insert3 = mysqli_query($conexion, $sel_insert3);

		//Devuleve flag para scirpt 2
		$answer = 1;
	}

}catch( Exception $e ){
	$answer = 0;
	$errorMessage = $e->getMessage();
}
$data['answer'] = $answer;
$data['messages'] = $errorMessage;
echo json_encode($data);
 ?>
