<?php
class Shoppinglist extends Eloquent{

	public function user(){
		return $this->belongsTo('user');
	}

	public function item(){
		return $this->hasMany('item');
	}

	public function importStaticItems(){
		$statics = Staticitem::all();
		foreach($statics as $static){
			$item = new Item();
			$item->user_id = 0;
			$item->shoppinglist_id = $this->id;
			$item->name = $static->name;
			$item->amount = $static->amount;
			$item->save();
		}
	}

	static function markDetailedTimestamps($shoppinglists){
		foreach($shoppinglists as $x => $shoppinglist){
		foreach($shoppinglists as $y => $compareList)
		{
			// Als we deze datum al hebben vergeleken, dan skippen we.
			if(isset($shoppinglist->detailed))
				continue;
			// We gaan niet 2 dezelfde dingen vergelijken
			if($x != $y){
				// Als de datums overeenkomen 
				if(date('dmy', strtotime($shoppinglist->created_at)) == date('dmy', strtotime($compareList->created_at)))	 {
					// Markeer de lijst zodat de datum wordt weergegeven in de View.
					$compareList->detailed = $shoppinglist->detailed = true;
				}
			}
		}
		}
	}
}