<?php
if(session_id() == '') {
    session_start();
}
require_once("../../conectar7.php");
require_once("../../funciones/cargaImagenes.php");

// datos que vienen de la SESSION
$moneda_secssion= $_SESSION['company_current'];
echo '$_SESSION[company_current]:    ',$moneda_secssion,'<br>';
echo 'datos de la SESSION:','<br>';
foreach ($_SESSION as $dato) {
    echo $dato.'<br>';
}

$accion = $_POST["accion"];

$nameCompany= $_POST["nameCompany"];
$cfCompany= $_POST["cfCompany"];
$nameContact= $_POST["nameContact"];
$emailCompany= $_POST["emailCompany"];
$telCompany= $_POST["telCompany"];
$domicilioCompany= $_POST["domicilioCompany"];
$leyenda= $_POST["leyenda"];

$paisCompany= $_POST["paisCompany"];
$languageCompany= $_POST["languageCompany"];
$monedaCompany= $_POST["monedaCompany"];
$zipCompany= $_POST["zipCompany"];
$logofile= $_POST["logofile"];//logo por default
if(empty($logofile) or $logofile==""){
    $logofile="ctl4bizlogo.jpg";
}

$query_updateCompany = "UPDATE company_data SET razon_soc = '$nameCompany', contact_name = '$nameContact', contact_telephone = '$telCompany', main_email = '$emailCompany', country = '$paisCompany', language = '$languageCompany', address = '$domicilioCompany', zip_code = '$cfCompany', moneda = '$monedaCompany', cod_fiscal = '$cfCompany', leyenda = '$leyenda', logo = '$logofile' WHERE company_data.id = 0";
$rs_updateCompany = mysqli_query($conexion, $query_updateCompany);
if($rs_updateCompany){
    echo '<script>alert("DATOS ACTUALIZADOS");</script>';
}

?>