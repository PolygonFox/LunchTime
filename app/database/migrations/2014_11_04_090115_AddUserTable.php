<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table){
			$table->increments('id');
			$table->string('email', 255);
			$table->string('password', 1024);
			$table->boolean('admin')->default(false);
			$table->boolean('blocked')->default(false);
			$table->string('key', 255);
			$table->dateTime('key_time');
			$table->string('activation', 255);
			$table->string('remember_token', 100);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
