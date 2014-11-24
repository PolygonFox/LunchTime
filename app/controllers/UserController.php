<?php

class UserController extends BaseController {

	public function getLogin(){
		return View::make('account.login');
	}

	public function postLogin(){
		$rules = array('email' => 'required', 'password' => 'required');
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()){
			return Redirect::to('login')->withErrors($validator);
		}

		$auth = Auth::attempt(array(
			'email' => Input::get('email'),
			'password' => Input::get('password'),
			'blocked' => 0
		), false);

		if (!$auth){
			return Redirect::to('login')->withErrors(array(
				'Verkeerde wachtwoord en/of Username <br> Of je account is geblokt'
		));
		}

		return Redirect::to('/');
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
}