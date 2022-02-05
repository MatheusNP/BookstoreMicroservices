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

    $router->post('/users/login', 'UserController@login');    
    $router->post('/users', 'UserController@store');

    $router->group(['middleware' => 'auth:api'], function () use ($router) {
        $router->get('/users/me', 'UserController@me');
        $router->post('/users/logout', 'UserController@logout');    
    });

    $router->group(['middleware' => 'client.credentials'], function() use ($router) {

        $router->get('/books', 'BookController@index');
        $router->get('/books/category/', 'BookController@listCategory');    
        $router->get('/books/author/', 'BookController@listAuthor');    
        $router->get('/books/{product_id}', 'BookController@show');    

        $router->get('/orders/me/', 'OrderController@list');    
        $router->post('/orders', 'OrderController@store');    
        $router->delete('/orders/{id}', 'OrderController@destroy');    

        $router->get('/tickets/me/', 'TicketController@list');
        $router->post('/tickets', 'TicketController@store');

        $router->get('/search', 'SearchController@show');    
    });
});
