<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCheckitemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema:create('checkitems', function($table){
			$table->increments('id');
			$table->string('name', 255);
			$table->integer('amount');
			$table->integer('user_id');
	});

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema:drop('checkitems');
	}

}
