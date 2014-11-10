<?php

class ShoppinglistController extends BaseController {

public function showlist(){

}

public function getNew(){
	$shoppinglists=Shoppinglist::all();

	return View::make('new')->withShoppinglists($shoppinglists);

}
public function postNew(){


	$shoppinglist = new shoppinglist;
	$shoppinglist->save();

	
	return Redirect::intended('/');
}


}
?>