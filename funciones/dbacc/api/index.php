<?php

ini_set('display_errors', -1);
ini_set('display_startup_errors', -1);
ini_set('error_reporting', -1);
define('APP', __DIR__ . DIRECTORY_SEPARATOR);
define('LIB', APP . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR);
require_once(LIB . 'Router.php');
require_once(LIB . 'Database.php');
require_once(LIB . 'SelectQuery.php');
require_once(LIB . 'MultiDatabase.php');
require_once(LIB . 'Query.php');
require_once(LIB . 'QueryDbs.php');
require_once(LIB . 'ListaDbs.php');
require_once(LIB . 'Auth.php');
try {
    if (!is_file(APP . '..' . DIRECTORY_SEPARATOR . 'config.ini')) {
        throw new ErrorException('config.ini not defined');
    }
    $params = parse_ini_file(APP . '..' . DIRECTORY_SEPARATOR . 'config.ini');
    $auth = Auth::fromConfig();
    if (!$auth->validateHeader()) {
        header('Forbiden', 403);
        header('Content-Type: application/json; charset=utf-8');
        die(json_encode(['message' => 'Not allowed']));
    }
    $dbRoot = new Database($params['server'], $params['mainDatabase'], $params['user'], $params['pass'], $params['useDefaultDBClient']);
    $dbRoot->tryConnect();
    $router = new Router($_GET, $_POST);
    $respuesta = $dbRoot->procesar($router->getClient());
    header('Response ', 200);
    header('Content-Type: application/json; charset=utf-8');
    die(json_encode($respuesta));
} catch (Exception $e) {
    $statusCode = (in_array($e->getCode(), [500, 402, 404, 420])) ? $e->getCode() : 500;
    header('Error', $statusCode);
    header('Content-Type: application/json; charset=utf-8');
    die(json_encode(['message' => $e->getMessage()]));
}
