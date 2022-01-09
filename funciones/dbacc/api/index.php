<?php

ini_set('display_errors', -1);
ini_set('display_startup_errors', -1);
ini_set('error_reporting', -1);
define('APP', __DIR__ . DIRECTORY_SEPARATOR );
define('LIB', APP . DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR );

require_once(APP . 'config.php');
require_once(LIB . 'Router.php');
require_once(LIB . 'Database.php');
require_once(LIB . 'SelectQuery.php');
require_once(LIB . 'MultiDatabase.php');
require_once(LIB . 'Query.php');
require_once(LIB . 'QueryDbs.php');
require_once(LIB . 'ListaDbs.php');

if(
    !defined('SERVER')
    || !defined('MAIN_DATABASE')
    || !defined('USER')
    || !defined('PASS')

){
    throw  new ErrorException('Db configuracion not defined.');
}
try{
    $dbRoot = new Database(SERVER, MAIN_DATABASE, USER, PASS);
    $dbRoot->tryConnect();
    $router = new Router($_GET,$_POST);
    $respuesta =  $dbRoot->procesar($router->getClient());
    header('Response ',200);
    header('Content-Type: application/json; charset=utf-8');
    die(json_encode($respuesta));
}catch(Exception $e){
    $statusCode = (in_array($e->getCode(),[500,402,404,420])) ? $e->getCode():500;
    header('Error',$statusCode);
    header('Content-Type: application/json; charset=utf-8');
    die(json_encode(['message'=>$e->getMessage()]));
}
