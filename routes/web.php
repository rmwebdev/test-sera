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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Soal no 1.
$router->get('/members', 'MemberController@index');
$router->post('/member', 'MemberController@store');
$router->get('/member/{id}', 'MemberController@show');
$router->put('/member/{id}', 'MemberController@update');
$router->delete('/member/{id}', 'MemberController@destroy');

// Soal no 3

$router->get('courses', 'FirebaseCrudController@index');
$router->post('course', 'FirebaseCrudController@store');
$router->get('course/{id}', 'FirebaseCrudController@show');
$router->put('course/{id}', 'FirebaseCrudController@update');
$router->delete('course/{id}', 'FirebaseCrudController@destroy');
