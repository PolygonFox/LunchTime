<?php

class ShoppinglistController extends BaseController {

public function show($id){
	$shoppinglist = Shoppinglist::find($id);
	$shoppinglist->user = User::where('user_id');
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
	$shoppinglist->user_id = Auth::User()->id;
	$shoppinglist->save();

	
	return Redirect::intended('/boodschappenlijsten');
}
public function lock($id){
	$list = Shoppinglist::find($id);
	if($list->locked == 1){ $list->locked = 0; }
	else{ $list->locked = 1; }
	$list->save();
	return Redirect::to('boodschappenlijst/'. $id);
}
 
public function newItem($id){
	$input= Input::all();
	$item = new Item();
	$item->name = $input['New_item'];
	$item->amount = $input['amount'];
	$item->user_id = Auth::User()->id;
	$item->shoppinglist_id = $id;
	$item->save();
	return Redirect::to('/boodschappenlijst/' . $id);
}

}
?>