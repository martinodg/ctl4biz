<?php
$conexion = null;
if(session_id() == '') {
    session_start();
}
require_once("../../conectar7.php");
require_once("../../funciones/cargaImagenes.php");
require_once("../../funciones/changelanguage.php");
try {
    $l = new ChangeLanguage();
    $accion = mysqli_real_escape_string($conexion, $_POST["accion"]);
    $nameCompany = mysqli_real_escape_string($conexion, $_POST["nameCompany"]);
    $cfCompany = mysqli_real_escape_string($conexion, $_POST["cfCompany"]);
    $nameContact = mysqli_real_escape_string($conexion, $_POST["nameContact"]);
    $emailCompany = mysqli_real_escape_string($conexion, $_POST["emailCompany"]);
    $telCompany = mysqli_real_escape_string($conexion, $_POST["telCompany"]);
    $domicilioCompany = mysqli_real_escape_string($conexion, $_POST["domicilioCompany"]);
    $leyenda = mysqli_real_escape_string($conexion, $_POST["leyenda"]);
    $paisCompany = mysqli_real_escape_string($conexion, $_POST["paisCompany"]);
    $languageCompany = mysqli_real_escape_string($conexion, $_POST["languageCompany"]);
    $monedaCompany = intval($_POST["monedaCompany"]);
    $zipCompany = mysqli_real_escape_string($conexion, $_POST["zipCompany"]);
    $logoUrl = null;
    if (requestHasFile('logofile')) {
        try {
            $logo = salvarLogoCompania('logofile');
            if ($logo === false) {
                throw new Exception($l->t('error_subir_archivo'));
            }
            $logoUrl = $logo['dbUrl'];
        } catch (Exception $e) {
            throw  new ErrorException($l->t('error_cargar_imagen') .':'. $e->getMessage());
        }
    }

    $query_updateCompany = "UPDATE company_data SET razon_soc = '$nameCompany', contact_name = '$nameContact', contact_telephone = '$telCompany', main_email = '$emailCompany', country = '$paisCompany', language = '$languageCompany', address = '$domicilioCompany', zip_code = '$cfCompany', moneda_id = '$monedaCompany', cod_fiscal = '$cfCompany', leyenda = '$leyenda'";
    if (isset($logoUrl)) {
        $query_updateCompany .= ", logo = '$logoUrl'";
    }
    $query_updateCompany .= " WHERE company_data.id = 0";
    $rs_updateCompany = mysqli_query($conexion, $query_updateCompany);
    if ($rs_updateCompany) {
        echo $l->t('actualizacion_completa');
    }
}catch(Exception $e){
    die($e->getMessage());
}
?>