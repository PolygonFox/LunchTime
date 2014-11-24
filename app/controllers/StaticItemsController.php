<?php

class StaticItemsController extends BaseController {

	public function show(){
		$staticlist = Staticitem::all();
		$staticlist->user = User::where('user_id');
		return View::make('staticitems.show')->withStaticlist($staticlist);
	}

	public function delete($id)
	{
		$staticlist = Staticitem::destroy($id);
		return Redirect::to("/standarditems");
	}
	
	public function newItem(){
		$input= Input::all();
		if(empty($input['Hoeveelheid']) || empty($input['Naam'])){
			return "Velden mogen niet leeg zijn.";
		}
		$item = new Staticitem();
		$item->name = $input['Naam'];
		$item->amount = $input['Hoeveelheid'];
		$item->user_id = Auth::User()->id;
		$item->save();
		return "Success||". Auth::User()->email ."||". $item->id;
	}
}
?>