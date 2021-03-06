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

$router->get('/orders/user/{user_id}', 'OrderController@list');
$router->post('/orders', 'OrderController@store');
$router->delete('/orders/{id}', 'OrderController@destroy');
$router->delete('/orders/complete/{user_id}', 'OrderController@complete');
