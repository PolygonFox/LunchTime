<?php


/* login */
Route::get('/login', array('as' => 'login', 'uses' => 'UserController@getLogin'))->before('guest');
Route::post('login', array('uses' => 'UserController@postLogin'))->before('csrf');

/* Forgot Password */
Route::get('/account/forgot', 'UserController@showForgot');
Route::post('/account/forgot', 'UserController@Forgot');
Route::get('/account/forgot/{string}', 'UserController@showReset');
Route::post('/account/forgot/{string}', 'UserController@Reset');
Route::get('/account/blocked', 'UserController@showBlocked');
Route::get('/account/new/{string}', 'UserController@showNewaccount');
Route::post('/account/new/{string}', 'UserController@Newaccount');
Route::get('/register', 'UserController@Register');
Route::post('/register', 'UserController@PostRegister');


/* Protected */
Route::group(array('before' => 'auth'), function()
{
	/* Organisations */
	Route::get('/', 'OrganisationsController@showOrganisations');
	Route::get('/groepen', 'OrganisationsController@showOrganisations');
	Route::get('/groep/nieuw', 'OrganisationsController@createnew');
	Route::post('/groep/nieuw', 'OrganisationsController@postcreatenew');

	Route::group(array('before' => 'organisationAccess'), function(){
		Route::get('/{organisation_id}/beheer', 'OrganisationsController@showAdminpanel');
		Route::post('/{organisation_id}/beheer', 'OrganisationsController@addusertogroup');
		Route::get('/{organisation_id}/delete', 'OrganisationsController@delete');
		Route::get('/{organisation_id}/deleteuser/{user_id}', 'OrganisationsController@deleteuser');
		/*	Shopping List */
		Route::get('{organisation_id}/boodschappenlijst/{id}', 'ShoppinglistController@show');
		Route::get('{organisation_id}/boodschappenlijst/{lijst_id}/item/{item_id}/verwijderen', 'ShoppinglistController@delete');
		Route::post('{organisation_id}/boodschappenlijst/{lijst_id}/item/{item_id}', 'ShoppinglistController@editItem');
		Route::get('{organisation_id}/boodschappenlijst/{lijst_id}/item/{item_id}/check', 'ShoppinglistController@toggleItemCheck');
		Route::get('{organisation_id}/boodschappenlijsten', 'ShoppinglistController@showShoppinglists');
		Route::post('{organisation_id}/new', 'ShoppinglistController@postNew');
		Route::post('{organisation_id}/boodschappenlijst/{id}','ShoppinglistController@newItem');
		Route::get('{organisation_id}/boodschappenlijst/lock/{id}/{lockStatus}', 'ShoppinglistController@lock');
		
		/* Checkitem List */
		Route::get('{organisation_id}/controleitems', 'CheckItemsController@show');
		Route::post('{organisation_id}/controleitems', 'CheckItemsController@newItem');
		Route::get('{organisation_id}/controleitems/del/{id}', 'CheckItemsController@delete');
		Route::get('{organisation_id}/controleitems/add/{id}', 'CheckItemsController@add');

		/* Staticitem List*/
		Route::get('{organisation_id}/standaarditems', 'StaticItemsController@show');
		Route::post('{organisation_id}/standaarditems', 'StaticItemsController@newItem');
		Route::get('{organisation_id}/standaarditems/del/{id}', 'StaticItemsController@delete');
		Route::get('{organisation_id}/standaarditems/add/{id}', 'StaticItemsController@add');
	});

	/* Account */
	Route::get('/account/edit', 'UserController@showEdit');
	Route::post('/account/edit', 'UserController@edit');
	Route::get('/account/show', 'UserController@return');
	Route::get('/account', 'UserController@show');
	Route::get('/logout', 'UserController@logout');

	/* Admin Only*/
	Route::group(array('before' =>'beheerder'), function()
	{
		Route::get('/beheer/GebruikerToevoegen', 'AdminController@showNewuser');
		Route::post('/beheer/GebruikerToevoegen', 'AdminController@newuser');
		Route::get('/beheer', 'AdminController@overview');

		Route::get('/beheer/groepen', 'AdminController@showOrganisations');

		Route::get('/beheer/user/{id}/makeadmin', 'AdminController@makeadmin');
		Route::get('/beheer/user/{id}/makeuser', 'AdminController@makeuser');
		Route::get('/beheer/user/{id}/delete', 'AdminController@deleteUser');
		Route::get('/beheer/user/{id}/activate', 'AdminController@activateUser');
	});
});
