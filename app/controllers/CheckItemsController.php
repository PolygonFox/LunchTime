<?php

class CheckItemsController extends BaseController {

	public function show(){
		$checklist = Checkitem::all();
		$checklist->user = User::where('user_id');
		return View::make('CheckItems.show')->withChecklist($checklist);
	}

	public function delete($id)
	{
		$checklist = Checkitem::destroy($id);
		return Redirect::to("/controleitems");
	}
	 
	public function newItem(){
		$input= Input::all();
		if(empty($input['amount']) || empty($input['new_item'])){
			return Redirect::to('/controleitems');
		}
		$item = new Checkitem();
		$item->name = $input['new_item'];
		$item->amount = $input['amount'];
		$item->user_id = Auth::User()->id;
		$item->save();
		return Redirect::to('/controleitems');
	}

	public function add($id){
		$list = shoppinglist::orderBy('id', 'desc')->First();
		$checkitem = checkitem::find($id);
		$item = new item;
		$item->name = $checkitem->name;
		$item->shoppinglist_id = $list['id'];
		$item->amount = $checkitem->amount;
		$item->save();
		return Redirect::to('/controleitems');
	}
}
?>