<?php
class ShoppinglistController extends BaseController {

	//Show shoppinglist with the requested id
	public function show($id){
		return View::make('organisations.createnew');
	}
}