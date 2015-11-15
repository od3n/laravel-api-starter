<?php
$api = app('Dingo\Api\Routing\Router');

// Version 1 of our API
$api->version('v1', function ($api) {

	// Set our namespace for the underlying routes
	$api->group(['namespace' => 'Api\Controllers', 'middleware' => 'cors'], function ($api) {

		// Index route
		$api->get('/', function () {
			return response()->json(['Welcome to Laravel API Starter']);
		});

		// Login route
		$api->post('login', 'AuthController@authenticate');
		$api->post('register', 'AuthController@register');

		// Cats! All routes in here are protected and thus need a valid token
		//$api->group([ 'protected' => true, 'middleware' => 'jwt.refresh'], function ($api) {
		$api->group([ 'middleware' => 'jwt.refresh'], function ($api) {

			$api->get('users/me', 'AuthController@me');
			$api->get('validate_token', 'AuthController@validateToken');

			$api->get('cats', 'CatController@index');
			$api->post('cats', 'CatController@store');
			$api->get('cats/{id}', 'CatController@show');
			$api->delete('cats/{id}', 'CatController@destroy');
			$api->put('cats/{id}', 'CatController@update');

		});

	});

});