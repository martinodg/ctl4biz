<?php
require_once("../conectar7.php");
/**
 * @param $conexion
 * @param int $id_company
 * @return array|null
 */
function getCompanyData($conexion, $id_company = 0 )
{
    $query_companyData="SELECT company_data.id, company_data.razon_soc, company_data.address, company_data.zip_code,company_data.cod_fiscal, company_data.leyenda, company_data.logo, monedas.simbolo, monedas.moneda FROM company_data JOIN monedas ON monedas.id_moneda = company_data.moneda_id WHERE company_data.id = ".$id_company;
    $rs_companyData= mysqli_query($conexion,$query_companyData);
    if(!$rs_companyData){
        return  null;
    }
    return mysqli_fetch_array($rs_companyData);
}

$companyData = getCompanyData($conexion);