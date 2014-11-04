<?php

class UserController extends BaseController {

	public function showLogin()
	{
		return View::make('account.login');
	}

	public function login(){
		$input = Input::only('email', Hash::make('password'));

		return View::make('account.login');
	}
}
