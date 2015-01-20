<?php

class CheckItemsController extends BaseController {

	//Show Checkitem list
	public function show(){
		$shoppinglist = Shoppinglist::orderBy('created_at', 'desc')->First();
		$checklist = Checkitem::all();
		if(!$shoppinglist){return View::make('checkitems.show')->withChecklist($checklist)->withnolist(true);}
		$checklist->user = User::where('user_id');
		foreach($shoppinglist->item as $x => $item){
			foreach($checklist as $y => $compareList)
			{
				// We checked this item allready and don't need to check it twice
				if(isset($item->active))
					continue;
				//we dont have to compare again
				if($x != $y){
					//Check if name and amount match with last shoppinglist 
					//
					if($item->name == $compareList->name && $item->amount == $compareList->amount){
						// Mark the item with the class active
						$compareList->active = $item->active = true;
					}
				}
			}
		}
		return View::make('checkitems.show')->withChecklist($checklist);
	}

	//Delete an item on the checkitemlist
	public function delete($id)
	{
		$checklist = Checkitem::destroy($id);
		return Redirect::to("/controleitems");
	}
	
	//Add a new item to the checkitemlist
	public function newItem(){
		$input= Input::all();
		if(empty($input['Hoeveelheid']) || empty($input['Naam'])){
			return "Velden mogen niet leeg zijn.";
		}
		$item = new Checkitem();
		$item->name = $input['Naam'];
		$item->amount = $input['Hoeveelheid'];
		$item->user_id = Auth::User()->id;
		$item->save();
		//Return with sting so javascript can handle it on the front
		return "Success||". Auth::User()->email ."||". $item->id;
	}
	//Add an item to the latest shoppinglist
	public function add($id){
		$list = shoppinglist::orderBy('id', 'desc')->First();

		if($list->locked){
			return "Kan het item niet toevoegen omdat de boodschappenlijst vergrendeld is.";
		}

		$checkitem = checkitem::find($id);
		$item = new item;
		$item->name = $checkitem->name;
		$item->shoppinglist_id = $list['id'];
		$item->amount = $checkitem->amount;
		$item->save();
		//Return a string so javascript can handle it on the front
		return "Success";
	}
}
?>