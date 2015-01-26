<?php
class  OrganisationsController extends BaseController {

	//Shows all organisations
	public function showOrganisations(){
		$organisations = Auth::user()->organisations;
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
		$Organisation = new Organisation;
		$Organisation->owner_id = Auth::User()->id;
		$Organisation->name = $input['name'];
		$Organisation->save();
		$Organisation->linkuser(Auth::User()->id,$Organisation->id);
		return "REDIRECT TO GROEPEN -> MESSAGE SUCCESS!";
	}
}