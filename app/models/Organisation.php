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
		return $this->belongsToMany('User');
	}

	public function linkuser($user_id,$organisation_id,$mod = false){
		if(!empty($user_id|$organisation_id)){
			DB::table('organisation_user')->insert(array('user_id' => $user_id, 'organisation_id' => $organisation_id, 'mod' => $mod));
		}
	}

	static function isowner($user_id,$organisation_id){
		return DB::table('organisation_user')->where('user_id', $user_id)->where('organisation_id', $organisation_id)->first();
	}
	
}