<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class JobApplicationsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		$employee   =   Employee::all();
		foreach(range(1, 10) as $index)
		{
			JobApplication::create([
				'jobID'          => rand(1,3),
				'name'           =>  $faker->firstName,
				'email'          =>  $faker->email,
				'phone'          => $faker->phoneNumber,
				'cover_letter'  =>   $faker->paragraph,
				'submitted_by'  =>  $employee[rand(0,count($employee)-1)]->employeeID


			]);
		}
	}

}