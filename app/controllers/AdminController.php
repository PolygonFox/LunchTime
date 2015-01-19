<?php

class AdminController extends BaseController {

	//Show list of all the users
	public function overview()
	{
		$users = User::all();
		return View::make('admin.overview')->withUsers($users)->withMessage(Session::get('Message'));
	}

	//Show new user form
	public function showNewuser()
	{
		return View::make('account.new');
	}

	//Create a new user
	public function newuser()
	{
		$input = Input::all();
		$validator = Validator::make(
		    $input,
		    array(
		        'email' => 'required|email|unique:users',
		        'password' => 'required|min:8',
		        'repeatpassword' => 'required|same:password'
	    	),
	    	array(
	    		'password.required' => 'Wachtwoord is verplicht.',
	    		'password.min' => 'Het wachtwoord moet minimaal 8 karakters bevatten.',
	    		
	    		'email.required' => 'E-mail is verplicht.',
	    		'email.unique' => 'Dit e-mail adres is al in gebruik.',
	    		'email.email' => 'Voer een geldig e-mail adres in.',

	    		'repeatpassword.same' => 'Wachtwoord en herhaal wachtwoord komen niet overeen.',
	    		'repeatpassword.required' => 'Herhaal wachtwoord is verplicht.'
	    	)
	    );
	    $failed = $validator->failed();if ($validator->fails())
	    {
	    	return View::make('account.new')->withErrors($validator);
	    }
	    //If checkbox issn't set default value set to 0
	    if(!isset($input['admin'])){$input['admin'] = 0;}

    	$user = new User();
    	$user->email = $input['email'];
    	$user->admin = $input['admin'];
    	$user->password = Hash::make($input['password']);
    	$user->save();

    	return Redirect::to('beheer');
	}

	//Disable a user, This does not remove the user from the database!
	public function deleteUser($id)
	{
		$user = User::find($id);
		$message = "";
		if($user->id == Auth::user()->id)
		{
			$message = "U kunt uzelf niet verwijderen.";
		}
		else
		{
			$message = $user->email . " is nu geblokkeerd.";
			$user->blocked = true;
			$user->save();
		}
		return Redirect::to('beheer')->with("Message", $message);
	}

	//Activate a user, Unblock the user.
	public function activateUser($id)
	{
		$user = User::find($id);
		$user->blocked = false;
		$user->save();
		return Redirect::to('beheer')->with("Message", $user->email . " is nu geactiveerd.");
	}
	//Make user Admin.
	public function makeadmin($id)
	{
		$user = User::find($id);
		$user->admin = true;
		$user->save();
		return Redirect::to('beheer')->with("Message", $user->email . " is nu admin.");
	}
	//Make a admin user again.
	public function makeuser($id)
	{
		$user = User::find($id);
		$message = "";
		if($user->id == Auth::user()->id)
		{
			$message = "U kunt uzelf geen gebruiker maken.";
		}
		else
		{
			$message = $user->email . " is nu geblokkeerd.";
			$user->admin = false;
			$user->save();
		}
		return Redirect::to('beheer')->with("Message", $message);
	}
}
?>