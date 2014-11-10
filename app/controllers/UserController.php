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

	public function logout(){
		Auth::logout();
		return Redirect::intended("login");
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
						$errors[] = "Het oude wachtwoord is niet onjuist.";
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
		return View::make('account.edit')->withErrors($errors);
	}

	public function showNew()
	{
		return View::make('account.new');
	}

	public function newn()
	{

	}

}