<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	// If the request was sent via AJAX, look for the token in the headers, and if not,
	// then just proceed as normal, using the default hidden input "_token"
	$token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
	if (Session::token() != $token) {
		throw new Illuminate\Session\TokenMismatchException;
	}
	/*
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}*/
});

/*
|--------------------------------------------------------------------------
| [ Custom ] - Cartalyst Sentry 2's CMS Access Filter
|--------------------------------------------------------------------------
*/

Route::filter('cmsauth', function()
{
	// NOTE : For demo purpose, lets disable the login throttling feature of this site.
	// disable sentry's throttling feature
	$provider = Sentry::getThrottleProvider();
	if ($provider->isEnabled()) {
		$provider->disable();
	}
	$throttle = Sentry::findThrottlerByUserId(1);
	// unban the only account in this site if this account is banned
	if ($throttle->isBanned()) {
		$throttle->unBan();
	}
	// unsuspend the only account in this site if this account is suspended
	if ($throttle->isSuspended()) {
		$throttle->unsuspend();
	}

	if (Sentry::check()) {
		// NOTE : Considering the scale of the website, there will only be 1 account - which
		// means only 1 person can access the cms at a time. Creating user groups is not
		// needed for this website.
		/*
		$user = Sentry::getUser();
		$admin = Sentry::findGroupByName('Admins');
		if ( !$user->inGroup($admin) ) {
			Redirect::to('login');
		}
		*/
	} else {
		return Redirect::to("login");
	}
});

Route::filter('checklogout', function()
{
	if(Input::get("logout")) {
		Sentry::logout();
		if (!Sentry::check()) {
			return Redirect::route('home');
		}
	}
});

Route::filter('canshowlogin', function()
{
		if (Sentry::check()) {
				// don't show the login page if the user is login
				return Redirect::route('home');
		}
});
