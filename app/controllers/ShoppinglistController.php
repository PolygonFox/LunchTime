<?php

class ShoppinglistController extends BaseController {

public function showlist(){

}

public function getNew(){

	return View::make('new');

}
public function postNew(){


	$shoppinglist = new shoppinglist;
	$shoppinglist->save();

	
	return Redirect::intended('/');
}


}
?>