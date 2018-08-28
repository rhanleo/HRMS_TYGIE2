<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class JobsTableSeeder extends Seeder {

	public function run()
	{
		Job::truncate(); // deleting old records.
		$faker = Faker::create();
		$designation = Designation::all();
		foreach(range(1, 3) as $index)
		{
			Job::create([
				'position'      =>  $designation[rand(0,count($designation)-1)]->designation,
				'description'	=>  $faker->paragraph,
				//'posted_date'   =>  $faker->dateTimeBetween('-1 years'),
				//'last_date'     =>  $faker->dateTimeBetween('-'.rand(0,9).' days'),
				//'close_date'    =>  $faker->dateTimeBetween('0 days'),
				'status'        =>  'active'
			]);
		}
	}

}