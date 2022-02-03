<?php
//Mostrar y reportar errores
define('ERROR_DEBUG',0);
//Rol id a utilizar en la creacion de usuario por default
define('ROL_ID_DEFAULT',3);
//Datos de conexión a la base de datos de ctrl4b
define('DB_CTRL4B_HOST','xxxx');
define('DB_CTRL4B_USER','xxxx');
define('DB_CTRL4B_PASSWORD','xxxx');
define('DB_CTRL4B_DATABASE','xxxx');
//Datos de conexión a la base de datos de del cliente Solo host ya que las demas salen de una tabla
define('DB_CLIENTE_HOST','xxxx');
//errores
ini_set('display_errors', ERROR_DEBUG);
ini_set('display_startup_errors', ERROR_DEBUG);
error_reporting(ERROR_DEBUG);