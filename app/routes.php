<?php



Route::get('/login', 'UserController@showLogin');
Route::post('/login', 'UserController@login');

/* Protected */
Route::group(array('before' => 'auth'), function()
{

	/* Account */
	Route::get('/account/edit', 'UserController@showEdit');
	Route::post('/account/edit', 'UserController@edit');
	Route::get('/account', 'UserController@show');

		/*	Shopping List */
	Route::get('/boodschappenlijst/{id}', 'ShoppinglistController@show');
	Route::get('/boodschappenlijst/{lijst_id}/item/{item_id}/verwijderen', 'ShoppinglistController@delete');
	Route::get('/boodschappenlijsten', 'ShoppinglistController@getNew');
	Route::post('/new', 'ShoppinglistController@postNew');
	Route::post('/boodschappenlijst/{id}','ShoppinglistController@newItem');

	Route::get('/', function()
	{
		return View::make('hello');
	});

	/* Admin Only*/
	Route::group(array('before' =>'beheerder'), function()
	{
		Route::get('/account/new', 'UserController@showNewuser');
		Route::post('/account/new', 'UserController@newuser');
		Route::get('/logout', 'UserController@logout');
		Route::get('/beheer', 'UserController@beheer');
		Route::get('boodschappenlijst/lock/{id}', 'ShoppinglistController@lock');
	});
});