<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
// GET
Route::group(array('before' => 'checklogout'), function() {
	Route::get('/', array('uses' => 'HomeController@home'));
	Route::get('/home', array( 'as' => 'home',
							   						 'uses' => 'HomeController@home'));
	Route::get('/features', array( 'as' => 'features',
								   							 'uses' => 'FeaturesController@features'));
	Route::get('/rensai', array( 'as' => 'rensai',
								 							 'uses' => 'RensaiController@rensai'));
	Route::get('/gadgets', array( 'as' => 'gadgets',
								  						  'uses' => 'GadgetsController@gadgets'));
	Route::get('/news', array( 'as' => 'news',
							   						 'uses' => 'NewsController@news'));
	Route::get('/editors', array( 'as' => 'editors',
								  							'uses' => 'EditorsController@editors'));
	Route::get('/poems', array( 'as' => 'poems',
														  'uses' => 'PoemsController@poems'));
	Route::get('/contributors', array( 'as' => 'contributors',
														  			 'uses' => 'ContributorsController@contributors'));
	Route::get('/howto', array( 'as' => 'howto',
																		 'uses' => 'HowToController@howto'));
	Route::get('/login', array( 'as' => 'login',
															'before' => 'canshowlogin',
															'uses' => 'LoginController@login'));
	Route::get('/features/{postId}', array( 'uses' => 'FeaturesController@featuresPost'));
	Route::get('/rensai/{categoryId}', array( 'uses' => 'RensaiController@rensaiCategory'));
	Route::get('/rensai/{categoryId}/{postId}', array( 'uses' => 'RensaiController@rensaiPost'));
	Route::get('/news/{postId}', array( 'uses' => 'NewsController@newsPost'));
	Route::get('/gadgets/{pageId}', array( 'uses' => 'GadgetsController@gadgetPost'));
});

// POST
// In production, this page can only be accessed over https connection
Route::post('/login', array( 'uses' => 'LoginController@postLogin' ));

/* CMS Routes */
Route::group(array('before' => 'cmsauth|checklogout'), function() {
	// GET
	Route::get('/cms', array('uses' => 'HomeCmsController@homeCms'));
	Route::get('/cms/home', array( 'as' => 'homeCms',
								   'uses' => 'HomeCmsController@homeCms')
			  );
	Route::get('/cms/features', array( 'as' => 'featuresCms',
									   'uses' => 'FeaturesCmsController@featuresCms')
			  );
	Route::get('/cms/rensai', array( 'as' => 'rensaiCms',
									 'uses' => 'RensaiCmsController@rensaiCms')
			  );
	Route::get('/cms/gadgets', array( 'as' => 'gadgetsCms',
									  'uses' => 'GadgetsCmsController@gadgetsCms')
			  );
	Route::get('/cms/news', array( 'as' => 'newsCms',
								   'uses' => 'NewsCmsController@newsCms')
			  );
	Route::get('/cms/editors', array( 'as' => 'editorsCms',
									  'uses' => 'EditorsCmsController@editorsCms')
			  );
	Route::get('/cms/poems', array( 'as' => 'poems',
														  		'uses' => 'PoemsController@poemsCms'));
	Route::get('/cms/contributors', array( 'as' => 'contributors',
														  			 		 'uses' => 'ContributorsController@contributorsCms'));
	Route::get('/cms/howto', array( 'as' => 'howto',
																  'uses' => 'HowToController@howtoCms'));
	Route::get('/cms/rensai/{categoryId}', array( 'uses' => 'RensaiCmsController@rensaiCategoryCms') );
	Route::get('/cms/rensai/{categoryId}/{postId}', array( 'uses' => 'RensaiCmsController@rensaiPostCms'));
	// POST
	Route::group(array('before' => 'csrf'), function() {
		Route::post('/cms/home', array( 'as' => 'postHomeCms',
										'uses' => 'HomeCmsController@postHomeCms')
				   );
		Route::post('/cms/features', array( 'as' => 'postFeaturesCms',
											'uses' => 'FeaturesCmsController@postFeaturesCms')
				   );
		Route::post('/cms/rensai', array( 'as' => 'postRensaiCms',
										  'uses' => 'RensaiCmsController@postRensaiCms')
				   );
		Route::post('/cms/gadgets', array( 'as' => 'postGadgetsCms',
										   'uses' => 'GadgetsCmsController@postGadgetsCms')
				   );
		Route::post('/cms/news', array( 'as' => 'postNewsCms',
										'uses' => 'NewsCmsController@postNewsCms')
				   );
		Route::post('/cms/editors', array( 'as' => 'postEditorsCms',
										   'uses' => 'EditorsCmsController@postEditorsCms')
				   );

		Route::post('/cms/rensai/{categoryId}', array( 'uses' => 'RensaiCmsController@postRensaiCategoryCms') );
		Route::post('/cms/rensai/{categoryId}/{postId}', array( 'uses' => 'RensaiCmsController@postRensaiPostCms'));
	});
});

/* RESTful API endpoints */
/*
	Ref :
	- https://gist.github.com/m13z/6270524
	- https://stackoverflow.com/questions/20733963/using-oauth2-in-php-for-accessing-twitter-moving-it-to-google-app-engine

	Note :
	- Don't use PHP built-in web-server (php artisan serve) to test
    the web service consumption because the file_get_contents()/curl functions
    will block requests. the reason is because PHP built-in server is single
    threaded, therefore requesting another url on your server will halt first
    request and it gets timed-out. Use Apache or other web servers instead.
	- You would typically put your API key as part of your header - preferably
	  the "Authorization" header so it would be encrypted when using HTTPS/SSL.
	  That means in the config file, set "http_headers_only" option to true.
  - $consumerKey refers to "id" column, not the "name" column in the oauth_clients
    db table.
 */
Route::get('apitest', function() {
		/*
			Note :
			- OAuth 2 Grant Type : Client Credentials Grant
			- Client Credentials Grant Type -> Must use "oauth-owner" filter.
		*/

		// login credentials
		$consumerKey = "1";
		$consumerSecret = "ssshdonttellanybody";
		// specify the oauth2 authorization url
		$oauth2url = url('api/oauth2');

		// request token
		$basicCredentials = base64_encode(($consumerKey).':'.($consumerSecret));
		$authContext = stream_context_create(
				array(
					'http' => array(
							'method' => 'POST',
							'header' => "Authorization: Basic " . $basicCredentials . "\r\n" .
	                			  "Content-type: application/x-www-form-urlencoded;charset=UTF-8\r\n",
							'content' => 'grant_type=client_credentials',
					),
				)
		);

		// send requests
		try {
				$preTokenResponse = file_get_contents($oauth2url, false, $authContext);
				var_dump("[REQUESTING ACCESS TOKEN IS SUCCESSFUL]");echo "<br><br>";
				var_dump(json_decode($preTokenResponse, true));echo "<br><br>";
		} catch (Exception $e) {
				var_dump("[REQUESTING ACCESS TOKEN HAS FAILED]");echo "<br><br>";
				var_dump($http_response_header);echo "<br><br>";
		}

		var_dump("[GOT THE ACCESS TOKEN, NOW GET THE RESOURCE]");echo "<br><br>";
		$token = json_decode($preTokenResponse, true);
		var_dump($token);echo "<br><br>";

		if (isset($token["token_type"]) && $token["token_type"] == "Bearer") {
				$context = stream_context_create(
						array(
							'http' => array(
									'method'  => 'GET',
									'header'  => 'Authorization: Bearer '.$token["access_token"]
							),
						)
				);

				// specify the api endpoint url
				$api = url('api/v1');
				// sample resource request url
				//$url = $api . "/rensai/posts/3";
				$url = $api . "/rensai/categories/3/posts";

				// try to connect to web API endpoints
				try {
						$response = file_get_contents($url, false, $context);
						var_dump("[OBTAINING RESOURCE IS SUCCESSFUL]");echo "<br><br>";
						var_dump(json_decode($response, true));
				} catch (Exception $e) {
						var_dump("[OBTAINING RESOURCE HAS FAILED]");echo "<br><br>";
						var_dump($http_response_header);
				}
		} else {
				echo "SIGH...";
		}
});
Route::get('apitest2', function() {
		/*
			Note :
			- OAuth 2 Grant Type : Password Grant
		*/

});
Route::group(array('prefix' => 'api/v1/rensai/', 'before' => 'oauth-owner'), function() {
		Route::get('categories.posts', 'RensaiCategoryApiController@showPosts');
		Route::resource('categories.posts', 'RensaiCategoryApiController@showPosts');
		Route::resource('categories', 'RensaiCategoryApiController');
		Route::resource('posts', 'RensaiPostApiController');
});
Route::post('api/oauth2', 'OAuthController@postAccessToken');

// CUSTOM VALIDATIONS
Validator::extend('custom_is_rectangular_img', function($field, $value, $parameters) {
	$file = Request::file($field);
	$img_info = getimagesize($file);
	$img_width = $img_info[0];
	$img_height = $img_info[1];
	if ( intval($img_width) == intval($img_height) ) {
		return true;
	}
	return false;
});
Validator::extend('custom_valid_file_ext', function($field, $value, $parameters) {
	$file = Request::file($field);
	$ext = $file->getClientOriginalExtension();
	foreach ($parameters as $parameter) {
		if ( isset($parameter) ) {
			if ($parameter == $ext) {
				return true;
			}
		}
	}
	return false;
});
