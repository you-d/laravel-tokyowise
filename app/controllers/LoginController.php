<?php

class LoginController extends BaseController {
	/* view file name */
	public function getViewName($pageType) {
		switch ($pageType) {
			case "hub" :
				// login.blade.php
				$output = 'login';
				break;
		}
		return $output;
	}
	/* alias */
	public function getAlias() {
		return 'login';
	}
	/* xml node label */
	public function getXmlNodeLabel() {
		return null;
	}
	/* Redirect back to home.blade.php */
	public function redirectBack() {
		return Redirect::route('home');
	}	
	/* Shows login.blade.php */
	public function login() {		
		return View::make( $this->getViewName("hub") );
	}
	
	/* Handle Post */
	public function postLogin() {	
		$messages = array(
			'username.required' => '<b>[Username]</b> This field is required.',
			'password.required' => '<b>[Password]</b> This field is required.',
			'username.email' => '<b>[Username]</b> Must be a valid email address.',
		);
		$rules = array(
        	'username'  => 'required|email',
         	'password' => 'required',
     	);
     	$input = Input::get();
     	$validator = Validator::make($input, $rules, $messages);
     	if ( $validator->fails() ) {
     		return Redirect::route($this->getViewName("hub"))->withErrors($validator)
     									   					 ->withInput(Input::except('password'))
     									  	 			     ->with('message', 'There were validation errors.');
     	}   	
     	try {
			$credentials = array( 'email'=> Input::get('username'), 
								  'password'=> Input::get('password') );
     		// authenticate the user
     		$pass = Sentry::authenticate($credentials, false);
     	} catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
     		// wrong password exception (TODO : Sum Ting Wong here)
     		return Redirect::route($this->getViewName("hub"))->withInput(Input::except('password'))
     									  	 			     ->with('message', 'There is a validation error.')
     									  	 			     ->with('wrongpasswordmsg', 'Wrong Password!');
     	} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {	
     		// user not found exception
     		return Redirect::route($this->getViewName("hub"))->withInput(Input::except('password'))
     									  	 			     ->with('message', 'There is a validation error.')
     									  	 			     ->with('usernotfoundmsg', 'User Not Found!');
     	}
     	
     	if ($pass) {
     		return Redirect::to($this->getCmsViewFolder() . "home");
     	}					  
	}
}

