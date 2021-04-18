<?
 if(session_id() == '') {
    session_start();
}  
$Servidor="database";
$BaseDeDatos= $_SESSION["BaseDeDatos"];
$Usuario= $_SESSION["Usuario_DB"];
$Password= $_SESSION["Password_DB"];
?>