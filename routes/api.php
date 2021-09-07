<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/*$router->get('/apimobile', function () use ($router) {
    return $router->app->version();
});*/

$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->get('/apimobile', function () use ($router) {
        return $router->app->version();
    });
});

$router->group(['prefix' => 'api/cliente'], function () use ($router) {
    $router->post('store', 'App\Cliente\ClienteController@store');
    $router->post('login', 'App\Cliente\ClienteController@login');
    $router->get('verify/{id}', 'App\Cliente\ClienteController@verify');
});

$router->group(['prefix' => 'api/ubicacion'], function () use ($router) {
    $router->get('/index[/{id}]', 'App\UbicacionController@index');
});