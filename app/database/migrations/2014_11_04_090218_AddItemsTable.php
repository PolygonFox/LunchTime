<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('items', function($table){
			$table->increments("id");
			$table->string("name", 32);
			$table->string("amount", 32);
			$table->integer("shoppinglist_id");
			$table->boolean("checked");
			$table->integer("user_id");
		});
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("items");
	}
}
