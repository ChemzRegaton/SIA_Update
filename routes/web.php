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

$router->get('/dashboard', function () {
    return file_get_contents(__DIR__ . '/../public/index.html');
});
$router->get('/login', function () {
    return file_get_contents(public_path('login.html'));
});

$router->get('/register', function () {
    return file_get_contents(public_path('register.html'));
});

$router->post('/login', 'AuthController@login');
$router->post('/register', 'AuthController@register');


$router->get('/news', 'NewsController@getNews');
$router->get('/quote', 'QuoteController@getRandomQuote');
$router->get('/search', 'SearchController@getSearchResults');
$router->get('/weather', 'WeatherController@getWeather');
$router->get('/all-data', 'GatewayController@getAllData');

