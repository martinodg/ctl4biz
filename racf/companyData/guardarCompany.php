<?php
session_start();

var_dump('-------------------------company_name:   ',$_SESSION['company_name']);
echo "<br>";
var_dump('-------------------------id:   ',$_SESSION['id']);
echo "<br><br><br><br>";

//$accion= $_POST["accion"];
$nameCompany= $_POST["nameCompany"];
$cfCompany= $_POST["cfCompany"];
$nameContact= $_POST["nameContact"];
$emailCompany= $_POST["emailCompany"];
$telCompany= $_POST["telCompany"];
$domicilioCompany= $_POST["domicilioCompany"];
$leyenda= $_POST["leyenda"];

$paisCompany= "";//$_POST["paisCompany"];
$languageCompany= "";//$_POST["languageCompany"];
$monedaCompany= "";//$_POST["monedaCompany"];
$zipCompany= "";//$_POST["zipCompany"];
$logofile= "";//$_POST["logofile"];


//$query_updateCompany = "UPDATE company_data SET razon_soc = '$nameCompany', contact_name = '$nameContact', contact_telephone = '$telCompany', main_email = '$emailCompany', country = '$paisCompany', language = '$languageCompany', address = '$domicilioCompany', zip_code = '$cfCompany', moneda = '$monedaCompany', cod_fiscal = '$cfCompany', leyenda = '$leyenda', logo = '$logofile' WHERE company_data.id = 0"
//$rs_updateCompany = mysqli_query($conexion, $query_update);


?>