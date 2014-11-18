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

	public function showForgot(){
		return View::make('account.forgot');
	}
	public function Forgot(){
		$input = Input::all();
		$input['key'] = str_random(8);
		$validator = Validator::make($input, array('key' => 'required|unique:users'));
		if($validator->Fails()){ return View::make('account.forgot')->withMessage('Something went wrong, Please try again.'); }
		$user = User::where('email', $input['email'])->First();
		$user->key = $input['key'];
		$user->save();
		Mail::send('emails.reset', array('key' => $input['key']), function($message)
		{
		    $message->to('me@nightduty.nl', 'me@nightduty.nl')->subject('Wachtwoord reset LunchTime');
		});
		return View::make('account.forgot')->withMessage($input['key']);
	}
	public function showReset($string){
		$user = User::where('key', $string)->First();
		if(!isset($user->email)){return "Sorry deze resetlink werkt niet meer.";}
		return View::make('account.reset');
	}
	public function reset($string){
		$input = Input::all();
		$user = User::where('key', $string)->First();
		$validator = Validator::make(
	    $input,
	    array(
	        'new_password' => 'required|min:8',
	        'new_password_repeat' => 'required|same:new_password'
	    ));
	    $failed = $validator->failed();
	    if ($validator->fails()){
	    	return View::make('account.reset')->withErrors($validator);
	    }
		if(isset($user->email)){
			$user->password = Hash::make($input['new_password']);
			$user->save();
		}
		return Redirect::to('/login');
	}
}