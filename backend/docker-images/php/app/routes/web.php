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


use Symfony\Component\HttpFoundation\Response;

$router->get('/verify-email/{token}', ['uses' => 'AuthController@verifyEmail', 'as' => 'verify-email']);

$router->group(['prefix' => 'api'], function () use ($router) {
	$router->get('/', function () use ($router) {
		return $router->app->version();
	});
	$router->get('/healthy', function (){
		return Response::HTTP_OK;
	});
	// no need login
	$router->post('/register', 'AuthController@createUser');
	$router->post('/login', 'AuthController@postLogin');
	$router->get('/products', 'ProductController@getList');
	$router->get('/product/{productId}', 'ProductController@getProduct');
	
	// need login
	$router->group(['middleware' => 'jwt'], function () use ($router) {
		$router->post('/logout', 'AuthController@postLogout');
		$router->post('/add-cart', 'CartController@postCreate');
		$router->get('/orders', 'OrderController@getList');
		$router->get('/order/{orderId}', 'OrderController@getOrder');
	});
});

