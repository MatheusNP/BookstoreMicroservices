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

$router->group(['prefix' => 'api'], function() use ($router) {

    $router->group(['middleware' => 'client.credentials'], function() use ($router) {

        $router->get('/books', 'BookController@index');
        $router->get('/books/category/', 'BookController@list');
        $router->get('/books/{product_id}', 'BookController@show');

        $router->get('/orders/me/', 'OrderController@list');
        $router->post('/orders', 'OrderController@store');
        $router->delete('/orders/{id}', 'OrderController@destroy');

        $router->get('/tickets/me/', 'TicketController@list');
        $router->post('/tickets', 'TicketController@store');

        $router->get('/search', 'SearchController@show');
    });
});
