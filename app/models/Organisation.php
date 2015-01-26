<?php

class Organisation extends Eloquent{

	public $timestamps = false;

	public function shoppinglists(){
		return $this->hasMany("Shoppinglist");
	}

	public function owner(){
		return $this->belongsTo('User', 'owner_id');
	}

	public function users(){
		return $this->hasMany('User');
	}

	public function linkuser($user_id,$organisation_id){
		if(!empty($user_id|$organisation_id)){
			DB::table('organisation_user')->insert(array('user_id' => $user_id, 'organisation_id' => $organisation_id));
		}
	}
	
}