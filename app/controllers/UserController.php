<?php

class UserController extends BaseController {

	public function showWelcome()
	{
		return View::make('hello');
	}
}
