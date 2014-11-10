<?php


Route::get('/', function()
{
	return View::make('hello');
});

<<<<<<< HEAD
Route::get('/new', array('as' => 'new', 'uses' => 'ShoppinglistController@getNew'));
Route::post('/new', array('uses' => 'ShoppinglistController@postNew'))->before('csrf');

Route::get('/login', function()
{
	return View::make('account.login');
});
=======
Route::get('/login', 'UserController@showLogin');
Route::post('/login', 'UserController@login');
Route::get('/logout', 'UserController@logout');
Route::get('/account/edit', 'UserController@showEdit');
Route::post('/account/edit', 'UserController@edit');
Route::get('/account/new', 'UserController@showNew');
Route::post('/account/new', 'UserController@new');
>>>>>>> origin/master
