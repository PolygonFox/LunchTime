<?php


Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/new', array('as' => 'new', 'uses' => 'ShoppinglistController@getNew'));
Route::post('/new', array('uses' => 'ShoppinglistController@postNew'))->before('csrf');

Route::get('/login', function()
{
	return View::make('account.login');
});