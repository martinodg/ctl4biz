<?php
require_once("../../conectar7.php"); 
$errorMessage='';

// Get arguments 
if(isset($_GET['codList'])) {$codList=$_GET['codList'];}else{$errorMessage.="getPriceListData.php Messages: List price Code is needed in order to get Price list data";}


    $query_priceList="SELECT listaDePrecios.nombre, listaDePrecios.porcentaje  FROM listaDePrecios WHERE listaDePrecios.codLista='$codList'";    
	$rs_priceList = mysqli_query($conexion,$query_priceList);
    $priceListNumber= mysqli_num_rows($rs_priceList);
                while ($priceListNumber > 0) {
                            
                            $row = mysqli_fetch_row($rs_priceList);
                                    $data['nombre']= $row[0];
                                    $data['porcentaje']= $row[1];
                                    $data['messages']= $errorMessage;
                                    echo json_encode($data);
                                    
                                    $priceListNumber--;
                }
mysqli_close($conexion); 
?>
