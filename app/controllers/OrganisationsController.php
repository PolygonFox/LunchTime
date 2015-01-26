<?php
class OrganisationsController extends BaseController {

	//Shows all organisations
	public function showOrganisations(){
		$organisations = Auth::user()->organisations;
		return View::make('organisations.showAll')->withOrganisations($organisations);
	}
}