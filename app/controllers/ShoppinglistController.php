<?php

class ShoppinglistController extends BaseController {

public function show($id){
	$shoppinglist = Shoppinglist::find($id);
	return View::make('Shoppinglist.show')->withShoppinglist($shoppinglist);
}

public function delete($lijst_id, $item_id)
{
	Item::destroy($item_id);
	return "Ja!";
}

public function getNew()
{
	$shoppinglists = Shoppinglist::all();
	return View::make('new')->withShoppinglists($shoppinglists);
}

public function postNew(){
	$shoppinglist = new shoppinglist;
	$shoppinglist->user_id = Auth::User()->id;
	$shoppinglist->save();
	$statics = Staticitem::all();
	foreach($statics as $static){
		$item = new Item();
		$item->user_id = 0;
		$item->shoppinglist_id = $shoppinglist->id;
		$item->name = $static->name;
		$item->amount = $static->amount;
		$item->save();
	}

	return Redirect::to('/boodschappenlijst/'. $shoppinglist->id);
}

public function lock($id){
	$list = Shoppinglist::find($id);
	if($list->locked == 1){ $list->locked = 0; }
	else{ $list->locked = 1; }
	$list->save();
	return Redirect::to('boodschappenlijst/'. $id);
}
 
public function newItem($shoppinglist_id){
	if(!Shoppinglist::find($shoppinglist_id)->locked)
	{
	$input= Input::all();

	$validator = Validator::make($input, array('Naam' => 'required', 'Hoeveelheid' => 'required'));
	if($validator->fails()){
		return$validator->messages()->first();
	}
	if(!Input::has('Confirm')){
		$lookalike = Item::where('name', 'LIKE', '%'.$input['Naam'].'%')->first();
		if($lookalike)
			return "duplicated||{$lookalike->name}";
	}


	
	$item = new Item();
	$item->name = $input['Naam'];
	$item->amount = $input['Hoeveelheid'];
	$item->user_id = Auth::User()->id;
	$item->shoppinglist_id = $shoppinglist_id;
	$item->save();

	return "Success||" . Auth::User()->email . "||" . $item->id;
	}
	else
		return "Deze boodschappenlijst is vergrendeld.";
}


public function editItem($lijst_id, $id)
{
	$data = Input::all();
	$item = Item::find($id);
	$item->name = $data['name'];
	$item->amount = $data['amount'];
	$item->save();
	return "Success";
}

public function toggleItemCheck($lijst_id, $id)
{
	$item = Item::find($id);
	if($item->shoppinglist_id == $lijst_id)	{
		$item->checked = !$item->checked;
		$item->save();
		return 'Success||' . $item->checked;
	}
	else{
		return "Dit item staat niet op deze boodschappenlijst.";
	}
}

}
?>