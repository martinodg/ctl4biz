<?php
require_once("../../conectar7.php"); 
$errorMessage='';

// Get arguments 
if(isset($_GET['idClient'])) {$idClient=$_GET['idClient'];}else{$errorMessage.="getClientData.php Messages: idClient is needed in order to get Client data";}


    $query_clients="SELECT clientes.nombre FROM clientes WHERE clientes.codcliente='$idClient'";    
	$rs_clients = mysqli_query($conexion,$query_clients);
    $clientsNumber= mysqli_num_rows($rs_clients);
                while ($clientsNumber > 0) {
                            
                            $row = mysqli_fetch_row($rs_clients);
                                    $data['ClientName']= $row[0];
                                    $data['messages']= $errorMessage;
                                    echo json_encode($data);
                                    
                                    $clientsNumber--;
                }
mysqli_close($conexion); 
?>
