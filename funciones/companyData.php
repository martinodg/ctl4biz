<?php
$conexion = null;
require_once("../conectar7.php");

function getCompanyData($conexion, $id_company = 0 ){
    $query_companyData="SELECT * FROM company_data WHERE id = ".$id_company;
    $rs_companyData=mysqli_query($conexion,$query_companyData);
    $data =  mysqli_fetch_array($rs_companyData);
    //@todo harcodear la ruta o completarla
    $data['logo'] = ''.$data['logo'];
    return $data;
}


$companyData = getCompanyData($conexion);