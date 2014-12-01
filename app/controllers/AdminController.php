<?php

class AdminController extends BaseController {

	//Show list of all the users
	public function overview()
	{
		$users = User::all();
		return View::make('admin.overview')->withUsers($users);
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
	    ));
	    $failed = $validator->failed();if ($validator->fails())
	    {
	    	return View::make('account.new')->withErrors($validator);
	    }
	    //If checkbox issn't set default value set to 0
	    if(!isset($input['admin'])){$input['admin'] = 0;}

    	$user = new User();
    	$user->email = $input['email'];
    	$user->admin = $input['admin'];
    	$user->password = Hask::make($input['password']);
    	$user->save();

    	return Redirect::to('beheer');
	}

	//Disable a user, This does not remove the user from the database!
	public function deleteUser($id)
	{
		$user = User::find($id);
		$user->blocked = true;
		$user->save();
		return Redirect::to('beheer');
	}
}
?>