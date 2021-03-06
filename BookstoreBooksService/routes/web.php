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

$router->get('/books', 'BookController@index');
$router->get('/books/category/', 'BookController@listCategory');
$router->get('/books/author/', 'BookController@listAuthor');
$router->get('/books/ordered/', 'BookController@ordered');
$router->get('/books/{product_id}', 'BookController@show');
