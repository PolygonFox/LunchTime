<?php

class Organisation extends Eloquent{

	public $timestamps = false;

	public function shoppinglists(){
		return $this->hasMany("Shoppinglist");
	}

	public function owner(){
		return $this->belongsTo('User', 'owner_id');
	}
	
}