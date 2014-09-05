<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CompaniesTableSeeder extends Seeder {

	public function run()
	{
		
			Company::insert(
				array(
					array(
						"name" => "Apex"
					),
					array(
						"name" => "Pharmaco"
					),
					array(
						"name" => "Reckitt"
					),
					array(
						"name" => "ACME"
					),
					array(
						"name" => "Medimet"
					),
					array(
						"name" => "Gonoshasthaya"
					),
					array(
						"name" => "Gaco"
					),
					array(
						"name" => "ACI"
					),
					array(
						"name" => "Eskayef"
					),
					array(
						"name" => "Incepta"
					),
					array(
						"name" => "Square"
					),
					array(
						"name" => "Mystic"
					),
					array(
						"name" => "Zenith"
					),
					array(
						"name" => "BIOPHARMA"
					),
					array(
						"name" => "Elixir"
					),
					array(
						"name" => "Ambee"
					),
					array(
						"name" => "SOMATEC"
					),
				)
			);
		
	}

}