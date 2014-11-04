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

	public function showEdit()
	{
		$user = Auth::User();
		return View::make('account.edit');
	}

	public function edit()
	{
		$input = Input::all();
		dd($input);

		return View::make('account.edit');
	}

	public function showNew()
	{
		return View::make('account.new');
	}

	public function new()
	{

	}
}
