<?php
require_once("../../conectar7.php"); 
$errorMessage='';
//echo "<script>console.log('entro en la funcion de backend getItemData.php');</script>";
// Get arguments 
if(isset($_GET['idItem'])) {$idItem=$_GET['idItem'];}else{$errorMessage.="getItemData.php Messages: idItem is needed in order to get Client data back";}


    $query_articulos="SELECT articulos.codfamilia, articulos.referencia, articulos.descripcion, articulos.precio_pvp, articulos.codigobarras, articulos.codunidadmedida, articulos.impuesto FROM articulos WHERE articulos.codarticulo='$idItem'";    
	$rs_articulos = mysqli_query($conexion,$query_articulos);
    $itemNumber= mysqli_num_rows($rs_articulos);
                while ($itemNumber > 0) {
                            
                            $row = mysqli_fetch_row($rs_articulos);
                                    $data['codFamily']= $row[0];
                                    $data['reference']= $row[1];
                                    $data['description']= $row[2];
                                    $data['price']= $row[3];
                                    $data['codBar']= $row[4];
                                    $data['codUM']= $row[5];
                                    $data['tax']= $row[6];
                                    $data['messages']= $errorMessage;
                                    echo json_encode($data);
                                    
                            $itemNumber--;
                }
mysqli_close($conexion); 
?>
