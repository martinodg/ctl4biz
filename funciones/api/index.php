<?php

ini_set('display_errors', -1);
ini_set('error_reporting', -1);
require_once(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config.php');
define('LIB',__DIR__.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR);
require_once(LIB.'Database.php');
require_once(LIB.'Router.php');
require_once(LIB.'Query.php');
require_once(LIB.'CobrosQuery.php');
require_once(LIB.'CobrosFormaPagoQuery.php');

if(!isset($Servidor, $BaseDeDatos, $Usuario, $Password)){
    throw  new ErrorException('Db configuracion not defined.');
}
try{
    $dbRoot = new Database($Servidor, $BaseDeDatos, $Usuario, $Password);
    $connection = $dbRoot->tryConnect();
    $router = new Router($_GET);
    $dbCliente = $dbRoot->fromRootConection($router->getClient());
    $dbCliente->tryConnect();
    $data = $dbCliente->getJson( $router->getQuery());
    header('Response ',200);
    header('Content-Type: application/json; charset=utf-8');
    die(json_encode($data));
}catch(Exception $e){
    $statusCode = (in_array($e->getCode(),[500,402,404,420])) ? $e->getCode():500;
    header('Error',$statusCode);
    header('Content-Type: application/json; charset=utf-8');
    die(json_encode(['message'=>$e->getMessage()]));
}
