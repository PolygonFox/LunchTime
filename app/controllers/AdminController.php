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
		$input['activation'] = str_random(8);
		$validator = Validator::make(
		    $input,
		    array(
		        'email' => 'required|email|unique:users',
		        'activation' => 'required|unique:users'
	    	),
	    	array(
	    		'email.required' => 'E-mail is verplicht.',
	    		'email.unique' => 'Dit e-mail adres is al in gebruik.',
	    		'email.email' => 'Voer een geldig e-mail adres in.'
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
    	$user->activation = $input['activation'];
    	$sendto = $user->email;
    	Mail::send('emails.newaccount', array('key' => $input['activation']), function($message) use ($sendto)
		{
		    $message->to($sendto, $sendto)->from('LunchTime@G51.nl')->subject('LunchTime account activatie');
		});
		$user->save();
    	return Redirect::to('beheer');
	}

	//Disable a user, This does not remove the user from the database!
	public function deleteUser($id)
	{
		$user = User::find($id);
		$user->blocked = true;
		$user->save();
		return Redirect::to('beheer')->with("Message", $user->email . " is nu geblokkeerd.");
	}

	//Activate a user, Unblock the user.
	public function activateUser($id)
	{
		$user = User::find($id);
		$user->blocked = false;
		$user->save();
		return Redirect::to('beheer')->with("Message", $user->email . " is nu geactiveerd.");
	}
}
?>