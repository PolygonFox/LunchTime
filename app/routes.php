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
	Route::get('/logout', 'UserController@logout');

		/*	Shopping List */
	Route::get('/boodschappenlijst/{id}', 'ShoppinglistController@show');
	Route::get('/boodschappenlijst/{lijst_id}/item/{item_id}/verwijderen', 'ShoppinglistController@delete');
	Route::get('/boodschappenlijsten', 'ShoppinglistController@getNew');
	Route::post('/new', 'ShoppinglistController@postNew');
	Route::post('/boodschappenlijst/{id}','ShoppinglistController@newItem');
	Route::get('/boodschappenlijst/{lijst_id}/item/{item_id}', 'ShoppinglistController@editItem');
	Route::post('/boodschappenlijst/{lijst_id}/item/{item_id}', 'ShoppinglistController@saveItem');

	/* Checkitem List */
	Route::get('/controleitems', 'CheckItemsController@show');
	Route::post('/controleitems', 'CheckItemsController@newItem');
	Route::get('/controleitems/del/{id}', 'CheckItemsController@delete');

	Route::get('/', function()
	{
		return View::make('hello');
	});

	/* Admin Only*/
	Route::group(array('before' =>'beheerder'), function()
	{
		Route::get('/beheer/GebruikerToevoegen', 'AdminController@showNewuser');
		Route::post('/beheer/GebruikerToevoegen', 'AdminController@newuser');
		Route::get('/beheer', 'AdminController@overview');
		Route::get('/beheer/user/{id}/delete', 'AdminController@deleteUser');
		Route::get('boodschappenlijst/lock/{id}', 'ShoppinglistController@lock');
	});
});