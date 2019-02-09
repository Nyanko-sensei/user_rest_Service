<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;

/** @var ContainerBuilder $containerBuilder */
$containerBuilder = require_once 'bootstrap/app.php';
require_once 'bootstrap/routes.php';

$responseHandler = $containerBuilder->get(\UserListRest\Interfaces\ResponseInterface::class);

// setuping router and prcessing route
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
        $responseHandler->fail('Route not found');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $responseHandler->fail('Method not allowed');
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = explode('@',$routeInfo[1]);

        $vars = $routeInfo[2];

        $controllerClass =  "UserListRest\\Controllers\\".$handler[1];
        $method =  $handler[0];

        if (!$containerBuilder->has($controllerClass)) {
            $responseHandler->fail('Class not loaded');
            break;
        }

        $controller = $containerBuilder->get($controllerClass);

        if(!(method_exists($controller, $method))) {
            $responseHandler->fail('Method does not exist');
            break;
        }

        $controller->$method($vars);

        break;
}