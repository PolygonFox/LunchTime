<?php

class CheckItem extends Eloquent {

	public $timestamps = false;
	public $table = 'checkitems';

	public function user()
	{
		return $this->belongsTo("User");
	}

	public function organisation()
	{
		return $this->belongsTo("Organisation");
	}
}