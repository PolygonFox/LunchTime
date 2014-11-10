<?php


Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/login', 'UserController@showLogin');
Route::post('/login', 'UserController@login');

/* Protected */
Route::group(array('before' => 'auth'), function()
{
	/* Account */
	Route::get('/account/edit', 'UserController@showEdit');
	Route::post('/account/edit', 'UserController@edit');
	/* Admin dingen */
	Route::get('/account/new', 'UserController@showNewuser');
	Route::post('/account/new', 'UserController@newuser');
	Route::get('/logout', 'UserController@logout');
	Route::get('/beheer', 'UserController@beheer');

	/*	Shopping List */
	Route::get('/new', 'ShoppinglistController@getNew');
	Route::post('/new', 'ShoppinglistController@postNew');
});