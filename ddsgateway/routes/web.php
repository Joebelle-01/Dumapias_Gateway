<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/test', function () {
    return 'TEST ROUTE IS WORKING!';
});

// Use the controller
$router->get('/users1', 'User1Controller@index');