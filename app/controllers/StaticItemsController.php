<?php

class StaticItemsController extends BaseController {

	//Show staticitemlist
	public function show($organisation_id){
		$staticlist = Staticitem::where('organisation_id', $organisation_id)->get();
		return View::make('staticitems.show')->withStaticlist($staticlist);
	}

	//Delete item from staticitemlist
	public function delete($organisation_id, $id)
	{
		$staticlist = Staticitem::destroy($id);
		return "Oke";
	}
	
	//Add a new item to the staticitemlist
	public function newItem($organisation_id){
		$input= Input::all();
		//check if fields aren't empty
		if(empty($input['Hoeveelheid']) || empty($input['Naam'])){
			return "Velden mogen niet leeg zijn.";
		}
		$item = new Staticitem();
		$item->name = $input['Naam'];
		$item->amount = $input['Hoeveelheid'];
		$item->user_id = Auth::User()->id;
		$item->organisation_id = $organisation_id;
		$item->save();
		//return string so javascript can handle it on the front.
		return "Success||". Auth::User()->email ."||". $item->id;
	}
}
?>