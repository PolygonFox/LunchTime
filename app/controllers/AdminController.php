<?php

class AdminController extends BaseController {

	public function overview()
	{
		$users = User::all();

		return View::make('admin.overview')->withUsers($users);
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
	public function deleteUser($id)
	{
		User::destroy($id);
		return Redirect::to('beheer');
	}
}
?>