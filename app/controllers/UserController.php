<?php

class UserController extends BaseController {

	public function showLogin()
	{
		return View::make('account.login');
	}

	public function login(){
		if (Auth::attempt(Input::only('email', 'password')))
		{
		    return Redirect::to('/');
		}
		return View::make('account.login')->with('message', 'Login mislukt');
	}

	public function logout(){
		Auth::logout();
		return Redirect::to("/");
	}
	public function show()
	{
		return View::make('account.show')->withUser(Auth::User());
	}
	public function showEdit()
	{
		$user = Auth::User();
		return View::make('account.edit');
	}

	public function edit()
	{
		$input = Input::all();
		$user = Auth::User();
		$validator = Validator::make(
	    $input,
	    array(
	    	'old_password' => 'required',
	        'new_password' => 'required|min:8',
	        'new_password_repeat' => 'required|same:new_password'
	    ));
	    $failed = $validator->failed();
	    if ($validator->fails()){
	    	return View::make('account.edit')->withErrors($validator);
	    }
		if(Auth::validate(array('email' => $user->email, 'password' => $input['old_password']))){
			$user->password = Hash::make($input['new_password']);
			$user->save();
		}
		return Redirect::to('/account');
	}
}