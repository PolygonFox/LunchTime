<?php
class Shoppinglist extends Eloquent{

	public function user(){
		return $this->belongsTo('user');
	}

	public function item(){
		return $this->hasMany('item');
	}
}