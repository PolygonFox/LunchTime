<?php

class AdminController extends BaseController {

	//Show list of all the users
	public function overview()
	{
		$users = User::all();
		return View::make('admin.overview')->withUsers($users)->withMessage(Session::get('Message'));
	}



	//Disable a user, This does not remove the user from the database!
	public function deleteUser($id)
	{
		$user = User::find($id);
		$message = "";
		if($user->id == Auth::user()->id)
		{
			$message = "U kunt uzelf niet blokkeren.";
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
		return Redirect::to('beheer')->with("Message", $user->email . " is nu beheerder.");
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
			$message = $user->email . " is nu gebruiker.";
			$user->admin = false;
			$user->save();
		}
		return Redirect::to('beheer')->with("Message", $message);
	}

	//Show a list of all organisations.
	public  function showOrganisations()
	{
		$organisations = Organisation::all();
		return View::make('admin.organisations')->withOrganisations($organisations);
	}
}
?>