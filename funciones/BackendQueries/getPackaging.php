<?php
include "../../conectar7.php";

if (isset($_GET["unidadmedida"])) {
    $cod_unidadmedida = $_GET["unidadmedida"];
}
if (isset($_GET["campo"])) {
    $campo = $_GET["campo"];
}
if (isset($_GET["idEmbalaje_remove"])) {
    $idEmbalaje_remove = $_GET["idEmbalaje_remove"];
}

if (isset($campo) & isset($unidadmedida)) {
    $query_value = "SELECT $campo FROM `embalajes` WHERE codunidadmedida='$cod_unidadmedida' AND borrado = 0;";
    //echo $query_value;
    $res_value = mysqli_query($conexion, $query_value);
    $pre_value = mysqli_fetch_array($res_value);
    $value = $pre_value[$campo];
}

$query_embalajes = "SELECT codembalaje, nombre FROM `embalajes` WHERE codunidadmedida='$cod_unidadmedida' AND borrado = 0 ORDER BY nombre ASC";
$res_embalajes = mysqli_query($conexion, $query_embalajes);
$nr_embalajes = mysqli_num_rows($res_embalajes);
if ($nr_embalajes) {
    while ($nr_embalajes > 0) {
        $row = mysqli_fetch_row($res_embalajes);
        if ($row[0] == $value) {
            $selected = 'selected="selected"';
        } else {
            $selected = '';
        }
        echo '<option value="' . $row[0] . '" ' . $selected . '>' . $row[1] . '</option>';
        $nr_embalajes--;
    }
} else {
    echo '<option value="">Sin Embalajes para</option>';
}

if (isset($idEmbalaje_remove)){
    $remove_embalaje = mysqli_query($conexion,"DELETE FROM articulosEmbalajes WHERE articulosEmbalajes.codembalaje = $idEmbalaje_remove");
}
?>


