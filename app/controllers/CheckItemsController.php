<?php

class CheckItemsController extends BaseController {

	public function show(){
		$checklist = Checkitem::all();
		$checklist->user = User::where('user_id');
		return View::make('checkitems.show')->withChecklist($checklist);
	}

	public function delete($id)
	{
		$checklist = Checkitem::destroy($id);
		return Redirect::to("/controleitems");
	}
	 
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
		return "Success||". Auth::User()->email ."||". $item->id;
	}

	public function add($id){
		$list = shoppinglist::orderBy('id', 'desc')->First();
		$checkitem = checkitem::find($id);
		$item = new item;
		$item->name = $checkitem->name;
		$item->shoppinglist_id = $list['id'];
		$item->amount = $checkitem->amount;
		$item->save();
		return "Success";
	}
}
?>