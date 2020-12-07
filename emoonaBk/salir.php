<?
$usuarios_sesion="prueba";

session_name($usuarios_sesion);

if(session_id() == '') {
    session_start();
}

session_destroy();

header ("Location: central2.php");
?>
