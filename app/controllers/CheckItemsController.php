<?php

class CheckItemsController extends BaseController {

	//Show Checkitem list
	public function show(){
		$checklist = Checkitem::all();
		$checklist->user = User::where('user_id');
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
		$checkitem = checkitem::find($id);
		$item = new item;
		$item->name = $checkitem->name;
		$item->shoppinglist_id = $list['id'];
		$item->amount = $checkitem->amount;
		$item->save();
		//Return with sting so javascript can handle it on the front
		return "Success";
	}
}
?>