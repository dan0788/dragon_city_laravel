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

$router->get('/listaDragones', 'ListaDragonesController@index');
$router->get('/listaDragones/{id}', 'ListaDragonesController@show');
$router->post('/listaDragones', 'ListaDragonesController@store');
$router->put('/listaDragones/{id}', 'ListaDragonesController@update');
$router->delete('/listaDragones/{id}', 'ListaDragonesController@destroy');
$router->delete('/listaDragones/all', 'ListaDragonesController@destroyAll');
