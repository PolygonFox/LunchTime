<?php
class  OrganisationsController extends BaseController {

	//Shows all organisations
	public function showOrganisations(){
		$organisations = Auth::user()->organisations;
		//dd($organisations);
		foreach($organisations as $organisation){
			$organisation->beheerder = Organisation::isowner(Auth::user()->id,$organisation->id)->mod;
		}
		
		return View::make('organisations.showAll')->withOrganisations($organisations);
	}

	public function createnew(){
		return View::make('organisations.createnew');
	}

	public function postcreatenew(){
		$input = Input::all();
		$validator = Validator::make(
			$input,
			array('name' => 'required|unique:organisations'),
			array(
				'name.required' => 'De nieuwe groep heeft een naam nodig.',
				'name.unique' => 'Er bestaat al een groep met deze naam.'
			)
		);
		if ($validator->fails()){
	    	return View::make('organisations.createnew')->withMessage($validator->messages());
	    }
		$organisation = new Organisation;
		$organisation->name = $input['name'];
		$organisation->owner_id = Auth::User()->id;
		$organisation->save();
		$organisation->linkuser(Auth::User()->id,$organisation->id, true);
		return Redirect::to('/groepen')->withMessage("De groep '". $input['name'] ."' is toegevoegd.");
	}

	public function showAdminpanel($organisation_id){
		if(!Organisation::isowner(Auth::user()->id,$organisation_id)->mod){
			return "U heeft geen toegang tot het adminpanel.";
		}
		return View::make('organisations.adminpanel');
	}

	public function addusertogroup($organisation_id){
		$email = Input::get('email');
		$user = User::where('email', $email)->First();
		if(!$user){ return View::make('organisations.adminpanel')->withMessage('Deze gebruiker is niet gevonden en kan niet worden toegevoegd op dit moment.');}
		$organisation = new Organisation;
		if($organisation::linkuser($user->id, $organisation_id)){
		return View::make('organisations.adminpanel')->withMessage('Gebruiker is toegevoegd.');
		}
		return View::make('organisations.adminpanel')->withMessage('Gebruiker heeft al toegang.');
	}
	public function delete($organisation_id){
		Organisation::destroy($organisation_id);
		if(!Request::ajax())
		{
			return Redirect::to('/beheer/groepen');
		}
	}
}