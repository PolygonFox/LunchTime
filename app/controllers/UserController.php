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
		    return Redirect::to('');
		}
		return View::make('account.login')->with('message', 'Login mislukt');
	}

	public function logout(){
		Auth::logout();
		return Redirect::intended("login");
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
		$errors = [];

		if(isset($input['new_password'][0][0]) && isset($input['new_password'][1][0]) && isset($input['old_password'][0])){
			if(isset($input['new_password'][0][8]) && isset($input['new_password'][1][8])){
				if($input['new_password'][0] == $input['new_password'][1]){
					if(Auth::validate(array('email' => $user->email, 'password' => $input['old_password']))){
						$user->password = Hash::make($input['new_password'][0]);
						$user->save();
					}
					else{
						$errors[] = "Het oude wachtwoord is onjuist.";
					}
				}
				else{
					$errors[] = "Het nieuwe wachtwoord komt niet overeen met het herhalingswachtwoord.";
				}
			}
			else{
				$errors[] = "Het nieuwe wachtwoord moet minimaal 8 karakters bevatten.";
			}
		}
		else{
			$errors[] = "Er zijn een of meerdere velden niet ingevuld.";
		}
		if(count($errors))
			return View::make('account.edit')->withErrors($errors);
		else
			return Redirect::intended('/account');
	}

	public function showNewuser()
	{
		return View::make('account.new');
	}

	public function newuser()
	{
		$input = Input::all();
		$validator = Validator::make(
	    $input,
	    array(
	        'email' => 'required|email|unique:users',
	        'password' => 'required|min:8',
	        'repeatpassword' => 'required|same:password'
	    ));
	    $failed = $validator->failed();if ($validator->fails())
	    {
	    	return View::make('account.new')->withErrors($validator);
	    }
	    if(!isset($input['admin'])){$input['admin'] = 0;}
	    DB::table('users')->insert(
    		array('email' => $input['email'], 'admin' => $input['admin'], 'password' => Hash::make($input['password']))
    	);
    	return Redirect::to('beheer');
	}

	public function beheer(){
		return "beheer";
	}
}