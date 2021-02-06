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

// $router->get('/test', function () use ($router) {
//     return view('index');
// });


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

// Soal no 6

$router->post('register-user', 'IntegrasiController@register');
$router->post('login-user', 'IntegrasiController@login');

// Soal no 7
$router->get('filter', 'IntegrasiController@filter');


// Soal no 2

$router->group(['prefix' => 'api'], function () use ($router) {
   $router->post('register', 'AuthController@register');
   $router->post('login', 'AuthController@login');
   $router->post('logout', 'UserController@logout');
   $router->get('profile', 'UserController@profile');
   $router->get('users/{id}', 'UserController@singleUser');
   $router->get('users', 'UserController@allUsers');
});


