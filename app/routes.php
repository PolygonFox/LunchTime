<?php



Route::get('/login', array('as' => 'login', 'uses' => 'UserController@getLogin'))->before('guest');
Route::post('login', array('uses' => 'UserController@postLogin'))->before('csrf');

/* Forgot Password */
Route::get('/account/forgot', 'UserController@showForgot');
Route::post('/account/forgot', 'UserController@Forgot');
Route::get('/account/forgot/{string}', 'UserController@showReset');
Route::post('/account/forgot/{string}', 'UserController@Reset');

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
	Route::post('/boodschappenlijst/{lijst_id}/item/{item_id}', 'ShoppinglistController@editItem');
	Route::get('/boodschappenlijst/{lijst_id}/item/{item_id}/check', 'ShoppinglistController@toggleItemCheck');
	Route::get('/boodschappenlijsten', 'ShoppinglistController@getNew');
	Route::post('/new', 'ShoppinglistController@postNew');
	Route::post('/boodschappenlijst/{id}','ShoppinglistController@newItem');
	Route::get('boodschappenlijst/lock/{id}', 'ShoppinglistController@lock');

	/* Checkitem List */
	Route::get('/controleitems', 'CheckItemsController@show');
	Route::post('/controleitems', 'CheckItemsController@newItem');
	Route::get('/controleitems/del/{id}', 'CheckItemsController@delete');
	Route::get('/controleitems/add/{id}', 'CheckItemsController@add');

	Route::get('/', function()
	{
		return View::make('hello');
	});

	/* Staticitem List*/
	Route::get('/standaarditems', 'StaticItemsController@show');
	Route::post('/standaarditems', 'StaticItemsController@newItem');
	Route::get('/standaarditems/del/{id}', 'StaticItemsController@delete');
	Route::get('/standaarditems/add/{id}', 'StaticItemsController@add');

	/* Admin Only*/
	Route::group(array('before' =>'beheerder'), function()
	{
		Route::get('/beheer/GebruikerToevoegen', 'AdminController@showNewuser');
		Route::post('/beheer/GebruikerToevoegen', 'AdminController@newuser');
		Route::get('/beheer', 'AdminController@overview');
		Route::get('/beheer/user/{id}/delete', 'AdminController@deleteUser');
	});
});
