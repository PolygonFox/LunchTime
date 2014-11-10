<?php

class ShoppinglistController extends BaseController {

public function show($id){
	$shoppinglist = Shoppinglist::find($id);
	return View::make('Shoppinglist.show')->withShoppinglist($shoppinglist);
}

public function delete($lijst_id, $item_id)
{
	$shoppinglist = Shoppinglist::destroy($item_id);
	return Redirect::intended("/boodschappenlijst/{$lijst_id}");
}

public function getNew(){
	$shoppinglists=Shoppinglist::all();

	return View::make('new')->withShoppinglists($shoppinglists);

}
public function postNew(){


	$shoppinglist = new shoppinglist;
	$shoppinglist->save();

	
	return Redirect::intended('/boodschappenlijsten');
}

}