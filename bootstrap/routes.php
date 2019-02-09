<?php

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'index@HomeController');
    $r->addRoute('GET', '/user/{id:\d+}', 'show@UserController');
    $r->addRoute('GET', '/users', 'index@UserController');
});