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
Route::group(array('before' => 'checklogout'), function() {
	// GET
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
	// In production, this page can only be accessed over https connection
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
