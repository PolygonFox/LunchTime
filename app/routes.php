<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/login', 'UserController@showLogin');
Route::post('/login', 'UserController@login');
Route::get('/logout', 'UserController@logout');
Route::get('/account/edit', 'UserController@showEdit');
Route::post('/account/edit', 'UserController@edit');
Route::get('/account/new', 'UserController@showNew');
Route::post('/account/new', 'UserController@new');