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

/**
 * Routes for resource goods-controller
 */
$router->get('goods', 'GoodsController@all');
$router->get('goods/paged', 'GoodsController@allPaged');
$router->get('goods/find', 'GoodsController@findGoods');
$router->get('goods/{id}', 'GoodsController@get');
$router->post('goods', 'GoodsController@add');
$router->put('goods/{id}', 'GoodsController@put');
$router->delete('goods/{id}', 'GoodsController@remove');

/**
 * Authentication
 */
$router->post('users', 'RegisterController@register');
$router->post('auth/swap-sign-in', 'LoginController@login_with_swap');
$router->post('auth/google-sign-in', 'LoginController@login_with_google_signin');

/**
 * Users
 */
$router->get('users/{id}/goods', 'UsersController@getUserGoods');
$router->put("users/fcm-instance-id", 'UsersController@putFCMInstanceId');
$router->delete("users/fcm-instance-id", "UsersController@removeFCMInstanceId");



/**
 * Routes for resource offers
 */
$app->get('offers', 'OffersController@all');
$app->get('offers/{id}', 'OffersController@get');
$app->post('offers', 'OffersController@add');
$app->put('offers/{id}', 'OffersController@put');
$app->delete('offers/{id}', 'OffersController@remove');
