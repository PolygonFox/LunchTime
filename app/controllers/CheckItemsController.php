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
	$item = new Checkitem();
	$item->name = $input['New_item'];
	$item->amount = $input['amount'];
	$item->user_id = Auth::User()->id;
	$item->save();
	return Redirect::to('/controleitems');
}

}
?>