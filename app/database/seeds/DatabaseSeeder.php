<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		User::create(array('email' => 'admin@admin.com', 'password' => '$2y$10$XYcMFTLjjkvf/8rk4noEeO99Ni.lVNDEtCItZfvtJATdBDvwUV7hK', 'admin' => '1'));
	}

}
