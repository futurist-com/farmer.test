<?php

//use Controller\Outline\OutlineController;
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require 'vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/api/v1/outline/{id:\d+}', 'App\Controller\Outline\OutlineController@index');
    $r->addRoute('POST', '/api/v1/outline/', 'App\Controller\Outline\OutlineController@store');
    $r->addRoute('PUT', '/api/v1/outline/{id:\d+}', 'App\Controller\Outline\OutlineController@update');
    $r->addRoute('GET', '/api/v1/owner-outline/{id:\d+}', 'App\Controller\Outline\OutlineController@getOwnerId');
    
    $r->addRoute('GET', '/api/v1/outline-check-adress/{id:\d+}', 'App\Controller\Outline\CheckAdressController@checkAdress');
    // {id} must be a number (\d+)
    // The /{title} suffix is optional
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $classMethodAr = explode('@', $routeInfo[1]);
        $classController = new $classMethodAr[0];
        $method = $classMethodAr[1];
        $parametr = array_values($vars);
        $return = $classController->$method(...$parametr);
        if ($return)
             echo json_encode($return);
        break;
}
