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

	static function linkuser($user_id,$organisation_id,$mod = false){
		if(!empty($user_id|$organisation_id)){
			$check = DB::table('organisation_user')->where('user_id',$user_id)->where('organisation_id',$organisation_id)->First();
			if(isset($check->user_id)){
				return false;
			}
			DB::table('organisation_user')->insert(array('user_id' => $user_id, 'organisation_id' => $organisation_id, 'mod' => $mod));
			return true;
		}
	}

	static function isowner($user_id,$organisation_id){
		return DB::table('organisation_user')->where('user_id', $user_id)->where('organisation_id', $organisation_id)->first();
	}

	static function GetMembers($organisation_id){
		$members = DB::table('organisation_user')->where('organisation_id',$organisation_id)->get();
		foreach($members as $member){
			$member->user = User::find($member->user_id);
		}
		return $members;
	}

	static function DeleteUser($organisation_id, $user_id){
		return DB::table('organisation_user')->where('user_id', $user_id)->where('organisation_id', $organisation_id)->delete();
	}
	
}