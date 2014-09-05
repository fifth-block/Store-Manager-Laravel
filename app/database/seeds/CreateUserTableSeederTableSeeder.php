<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CreateUserTableSeederTableSeeder extends Seeder {

	public function run()
	{
		//$faker = Faker::create();

		
		User::create([
			"username" => "manager",
			"password" => Hash::make("manager"),
			"email" => "manager@email.com"
		]);
		
	}

}