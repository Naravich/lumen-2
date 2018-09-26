<?php

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

$router->get('/books', 'BooksController@index');
$router->get('/books/{id:[\d]+}', 'BooksController@show');

$router->get('/hello/world', function () use ($router) {
    return "HELLO SEAGAME WORLD";
});

$router->get('/hello/{name}', ['middleware' => 'hello', function ($name) use ($router) {
    return "HELLO MR.{$name}";
}]);

$router->get('/request', function (Illuminate\Http\Request $request) {
    return "Hello " . $request->get('name', 'stranger');
});

// $router->get('/response', function (Illuminate\Http\Request $request) {
//     return (new Illuminate\Http\Response('Hello stranger', 200))
//     ->header('Content-Type', 'text/plain');
// });

$router->get('/response', function (Illuminate\Http\Request $request) {
    if ($request->wantsJson()) {
        return response()->json(['greeting' => 'Hello Stranger Res']);
    }
    return (new Illuminate\Http\Response('Hello stranger', 200))
    ->header('Content-Type', 'text/plain');
});
    