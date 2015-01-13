<?php

class UserController extends BaseController {

	//Show login form
	public function getLogin(){
		return View::make('account.login');
	}

	//Check if login details are legit
	public function postLogin(){
		$input = Input::all();
		$rules = array('e-mail' => 'required', 'wachtwoord' => 'required');
		$validator = Validator::make($input, $rules);
		//return login if inputs dont match the rules
		Input::flashOnly('e-mail');
		if ($validator->fails()){
			return View::make('account.login')->withErrors($validator);
		}
		$auth = Auth::attempt(array(
			'email' => $input['e-mail'],
			'password' => $input['wachtwoord'],
			'blocked' => 0
		), false);
		//If username is not set then show error
		$user = User::where('email', $input['e-mail'])->First();
		if (isset($user->blocked) && $user->blocked==1){
			return Redirect::to('login')->withErrors('Je account is geblokkeerd');
		}
		//return login if details are not legit
		if (!$auth){
			return View::make('account.login')->withErrors(array(
				'Verkeerde wachtwoord en/of email'
		));
		}


		//redirect to home when login is legit
		return Redirect::to('/');
	}

	//logout function
	public function logout(){
		Auth::logout();
		return Redirect::intended("login");
	}

	//Show "Mijn account"
	public function show()
	{
		return View::make('account.show')->withUser(Auth::User());
	}

	//Show Wachtwoord wijzigen
	public function showEdit()
	{
		$user = Auth::User();
		return View::make('account.edit');
	}

	//Deals with password reset values.
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

	//Show Wachtwoord reset
	public function showForgot(){
		return View::make('account.forgot');
	}

	//Sends an email to the user with a reset link
	public function Forgot(){
		$input = Input::all();
		$input['key'] = str_random(8);
		$validator = Validator::make(
			$input, 
			array('key' => 'required|unique:users')
		);
		$error = "Als het account bestaat word er een email naar toegestuurd.";
		if($validator->Fails()){ return View::make('account.forgot')->withMessage($error); }
		//Get user and save reset key used in the email
		$user = User::where('email', $input['email'])->First();
		if(!$user){ return View::make('account.forgot')->withMessage($error); }
		$user->key = $input['key'];
		$user->save();
		$sendto = $user->email;
		//send email to user with reset link
		Mail::send('emails.reset', array('key' => $input['key']), function($message) use ($sendto)
		{
		    $message->to($sendto, $sendto)->from('LunchTime@G51.nl')->subject('Wachtwoord reset LunchTime');
		});
		return View::make('account.forgot')->withMessage($error);;
	}
	//Show password reset when forget key is legit
	public function showReset($string){
		$user = User::where('key', $string)->First();
		if(!isset($user->email)){return "Sorry deze resetlink werkt niet meer.";}
		return View::make('account.reset');
	}
	//Deals with reset password
	public function reset($string){
		$input = Input::all();
		$user = User::where('key', $string)->First();
		$validator = Validator::make(
	    $input,
	    array(
	        'new_password' => 'required|min:8',
	        'new_password_repeat' => 'required|same:new_password'
	    ),
	    array(
	    	'new_password.required' => 'Nieuw wachtwoord is verplicht',
	    	'new_password.min' => 'Nieuw wachtwoord moet minimaal 8 karakters bevatten',
	    	'new_password_repeat.required' => 'Herhaal wachtwoord is verplicht',
	    	'new_password_repeat.same' => 'Wachtwoord en herhaal wachtwoord komen niet overeen'
	    )
	    );
	    $failed = $validator->failed();
	    //return samepage with errors when inputs are not matching the rules
	    if ($validator->fails()){
	    	return View::make('account.reset')->withErrors($validator->messages());
	    }
	    //if forget key is legit and new passwords are legit we save it to the user.
		if(isset($user->email)){
			$user->password = Hash::make($input['new_password']);
			$user->save();
		}
		return Redirect::to('/login');
	}

	public function showBlocked(){

		if(Auth::check()){
			if(Auth::user()->blocked === 1){
				return View::make('account.blocked');
			}
		}
		
		return Redirect::to('/');
	}
}