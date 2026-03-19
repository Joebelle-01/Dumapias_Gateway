<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Public route (no API key needed)
$router->get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'timestamp' => time(),
        'services' => [
            'users1' => env('USERS1_SERVICE_BASE_URL'),
            'users2' => env('USERS2_SERVICE_BASE_URL'),
        ]
    ]);
});

// Protected API routes (require API key)
$router->group(['middleware' => 'api.key'], function () use ($router) {
    
    // Site 1 routes
    $router->group(['prefix' => 'api/users1'], function () use ($router) {
        $router->get('/', 'User1Controller@index');
        $router->post('/', 'User1Controller@add');
        $router->get('/{id}', 'User1Controller@show');
        $router->put('/{id}', 'User1Controller@update');
        $router->patch('/{id}', 'User1Controller@update');
        $router->delete('/{id}', 'User1Controller@delete');
    });

    // Site 2 routes
    $router->group(['prefix' => 'api/users2'], function () use ($router) {
        $router->get('/', 'User2Controller@index');
        $router->post('/', 'User2Controller@add');
        $router->get('/{id}', 'User2Controller@show');
        $router->put('/{id}', 'User2Controller@update');
        $router->patch('/{id}', 'User2Controller@update');
        $router->delete('/{id}', 'User2Controller@delete');
    });
});