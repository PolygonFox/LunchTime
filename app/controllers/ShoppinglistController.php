<?php

class ShoppinglistController extends BaseController {

	//Show shoppinglist with the requested id
	public function show($id){
		$shoppinglist = Shoppinglist::find($id);
		return View::make('Shoppinglist.show')->withShoppinglist($shoppinglist);
	}

	public function showLatest(){
		$shoppinglist = Shoppinglist::orderBy('created_at', 'desc')->First();
		return Redirect::to('boodschappenlijst/'. $shoppinglist['id']);
	}

	//Delete item from a shoppinglist
	public function delete($lijst_id, $item_id)
	{
		Item::destroy($item_id);
		return "Ja!";
	}

	//Show all shoppinglists
	public function showShoppinglists()
	{
		$shoppinglists = Shoppinglist::orderBy('created_at', 'desc')->get();
		foreach($shoppinglists as $x => $shoppinglist){
		foreach($shoppinglists as $y => $compareList)
		{
			// Als we deze datum al hebben vergeleken, dan skippen we.
			if(isset($shoppinglist->detailed))
				continue;
			// We gaan niet 2 dezelfde dingen vergelijken
			if($x != $y){
				// Als de datums overeenkomen 
				if(date('dmy', strtotime($shoppinglist->created_at)) == date('dmy', strtotime($compareList->created_at)))	 {
					// Markeer de lijst zodat de datum wordt weergegeven in de View.
					$compareList->detailed = $shoppinglist->detailed = true;
				}
			}
		}
		}

		return View::make('new')->withShoppinglists($shoppinglists);
	}

	//Add new shoppinglist
	public function postNew(){
		$shoppinglist = new shoppinglist;
		$shoppinglist->user_id = Auth::User()->id;
		$shoppinglist->save();
		//add all static items to the new list
		$statics = Staticitem::all();
		foreach($statics as $static){
			$item = new Item();
			$item->user_id = 0;
			$item->shoppinglist_id = $shoppinglist->id;
			$item->name = $static->name;
			$item->amount = $static->amount;
			$item->save();
		}
		//redirect to new shoppinglist
		return Redirect::to('/boodschappenlijst/'. $shoppinglist->id);
	}

	//Locks a shoppinglist
	public function lock($id, $lockStatus){
		$list = Shoppinglist::find($id);
		$list->locked = ($lockStatus == 0) ? 1 : 0;
		$list->save();
		// Redirect to the same page.
		return Redirect::to('boodschappenlijst/'. $id);
	}
	
	//Add new item to shoppinglist
	public function newItem($shoppinglist_id){
		//Check if shoppinglist issnt locked
		if(!Shoppinglist::find($shoppinglist_id)->locked)
		{
		$input= Input::all();

		$validator = Validator::make($input, array('Naam' => 'required', 'Hoeveelheid' => 'required'));
		if($validator->fails()){
			return$validator->messages()->first();
		}
		//Check if itemname looks like an other item on the list
		if(!Input::has('Confirm')){
			$lookalike = Item::where('name', 'LIKE', '%'.$input['Naam'].'%')->where('shoppinglist_id','=',$shoppinglist_id)->first();
			if($lookalike)
				return "duplicated||{$lookalike->name}";
		}


		//create new item and save the item.
		$item = new Item();
		$item->name = $input['Naam'];
		$item->amount = $input['Hoeveelheid'];
		$item->user_id = Auth::User()->id;
		$item->shoppinglist_id = $shoppinglist_id;
		$item->save();

		//return string so javascript can handle the front
		return "Success||" . Auth::User()->email . "||" . $item->id;
		}
		else
			return "Deze boodschappenlijst is vergrendeld.";
	}

	//edit an item.
	public function editItem($lijst_id, $id)
	{
		$data = Input::all();
		$item = Item::find($id);
		if(isset($data['name']))
			$item->name = $data['name'];
		
		if(isset($data['amount']))	
			$item->amount = $data['amount'];
		
		$item->save();
		return "Success||" . $item->name;
	}

	//Toggle checked items on the list.
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