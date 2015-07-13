<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';

/*
|--------------------------------------------------------------------------
| [Custom] - Global Error handlers
|--------------------------------------------------------------------------
*/
App::error(function($exception, $code)
{
	if ($code === 500 && $exception->getTrace()[0]['function'] === "determineAccessToken" &&
			strpos($_SERVER['HTTP_USER_AGENT'], "Mozilla") !== false) {
				// In this case, users are trying to access an api endpoint without providing an access token from a web browser.
				// Recall, we configured the oauth2 package to receive an access token over header only.
				// Users will get error 500 status code, and  $exception->getTrace()[0]['function'] that returns
				// 'determineAccessToken' string. So, we will use these two signatures to gracefully throw error 403 status code.
				return Response::view('errors.error-403', array(), 403);
	} else if ($code === 405 && $exception->getTrace()[0]['function'] === "methodNotAllowed" &&
						 strpos($_SERVER['HTTP_USER_AGENT'], "Mozilla") !== false) {
				return Response::view('errors.error-405', array(), 405);
	} else {
			$request = $exception->getTrace()[0]['args'][0];
			$path = $request->path();
			// if the first 6 chars is 'api/v[version number]' ...
			if(in_array(substr($path, 0, 6), ApiController::$apiVersions)) {
					// Users are trying to access an api resource (identified as <base url>/api/v<version num>/<endpoint url>...),
					// and encountered an error.
					return ApiController::apiErrorHandler(Request::url(), $code);
			} else {
				// Users are trying to access any other pages and then encountered an error
				switch($code) {
					case 403:
						// shows error-403.blade.php
						return Response::view('errors.error-403', array(), 403);
						break;
					case 404:
						// shows error-404.blade.php
						return Response::view('errors.error-404', array(), 404);
						break;
					case 500:
						// shows error-500.blade.php
						return Response::view('errors.error-500', array(), 500);
						break;
					default:
						// shows error-default.blade.php
						return Response::view('errors.error-default', array(), $code);
						break;
				}
			}
	}
});
