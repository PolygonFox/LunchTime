<?php

class UserController extends BaseController {

	public function showLogin()
	{
		return View::make('account.login');
	}

	public function login(){
		$input = Input::only('email', 'password');

		if (Auth::attempt(array('email' => $input['email'], 'password' => $input['password'])))
		{
		    echo 'succes!';
		    return View::make('hello');
		}
		return View::make('account.login');
	}
}
