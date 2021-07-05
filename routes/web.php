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

$router->get('user[/{id}]', 'UserController@show');
$router->post('user', 'UserController@store');
$router->put('user/{id}', 'UserController@update');
$router->delete('user/{id}', 'UserController@delete');

$router->get('task[/{id}]', 'TaskController@show');
$router->post('task', 'TaskController@store');
$router->put('task/{id}', 'TaskController@update');
$router->delete('task/{id}', 'TaskController@delete');

$router->get('user/{id}/task', 'UserController@showTasks');
