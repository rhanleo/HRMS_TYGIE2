<?php

use Faker\Factory as Faker;
class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Eloquent::unguard();

		$this->call('AdminsTableSeeder');
		$this->command->info('User table seeded!');

		$this->call('DepartmentTableSeeder');
		$this->command->info('Department table seeded!');
		$this->command->info('Designation also table seeded!');

		$this->call('EmployeesTableSeeder');
		$this->command->info('Employees table seeded!');


        $this->call('LeaveTypeTableSeeder');
        $this->command->info('LeaveType table seeded!');

		$this->call('CountriesTableSeeder');
		$this->command->info('Countries table seeded!');


        $this->call('SettingTableSeeder');
        $this->command->info('Setting table seeded!');

        $this->call('NoticeBoardTableSeeder');
        $this->command->info('Notice Board seeded');

		$this->call('JobsTableSeeder');
		$this->command->info('Jobs Table seeded');


		$this->call('JobApplicationsTableSeeder');
		$this->command->info('JobApplications Table seeded');

		$this->call('LanguageTableSeeder');
		$this->command->info('LanguageTableSeeder Table seeded');

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }

}

// Seeding admins table
class AdminsTableSeeder extends Seeder {
 
    public function run() {
        DB::table('admins')->truncate(); // deleting old records.

        Admin::create(
        	[
                'name'  =>  'Ajay Kumar Choudhary',
                'email' => 'ajay@froiden.com',
                'password' => Hash::make('123456')
                
            ]
        );

    }
}

//Seeding Department Table
class DepartmentTableSeeder extends Seeder {

	public function run()
	{

		DB::table('department')->truncate(); // deleting old records.

		DB::table('designation')->truncate(); // deleting old records.


		//        PHP Department
		$dept =  Department::create([
			'deptName'    =>  'PHP',

		]);
		Designation::create([
			'deptID'    =>  $dept->id,
			'designation'   =>'Fresher PHP Developer'
		]);

		Designation::create([
			'deptID'    =>  $dept->id,
			'designation'   =>'Senior PHP Developer'
		]);

		// Android Department
		$dept = Department::create([
			'deptName'    =>  'Android Developer',
		]);
		Designation::create([
			'deptID'    =>  $dept->id,
			'designation'   =>'Fresher Android Developer'
		]);

		Designation::create([
			'deptID'    =>  $dept->id,
			'designation'   =>'Senior Android Developer'
		]);


		// HR Department
		$dept = Department::create([
			'deptName'    =>  'Human Resource',
		]);
		Designation::create([
			'deptID'    =>  $dept->id,
			'designation'   =>'Assistant Manager '
		]);

		Designation::create([
			'deptID'    =>  $dept->id,
			'designation'   =>'Manager'
		]);

		// Data Collection Department
		$dept = Department::create([
			'deptName'    =>  'Data Collection',
		]);
		Designation::create([
			'deptID'    =>  $dept->id,
			'designation'   =>'Assistant Surveyor '
		]);

		Designation::create([
			'deptID'    =>  $dept->id,
			'designation'   =>'Surveyor'
		]);
	}

}


//Notice Board Seeds
class EmployeesTableSeeder extends Seeder {

	public function run()
	{

		DB::table('employees')->truncate(); // deleting old records.
		DB::table('awards')->truncate(); // deleting old records.
		$faker = Faker::create();

		Employee::create([
			'employeeID'    => $faker->randomNumber(10),
			'fullName'      => $faker->firstName.' '.$faker->lastName,
			'email'         => 'demo@froiden.com',
			'password'      => Hash::make('123456'),
			'gender'        => 'male',
			'fatherName'    => $faker->name,
			'mobileNumber'  => $faker->phoneNumber,
			'designation'   => rand(1, 4),
			'joiningDate'   => $faker->dateTimeBetween('-2 years'),
			'localAddress'  => $faker->address, 'permanentAddress' => $faker->address,
			'status'        => 'active', 'last_login' => $faker->dateTime,


		]);

		for ($i=0; $i < 20; $i++) {
			$employeeID[ $i ] = $faker->randomNumber(10);
			Employee::create([
				'employeeID'    => $employeeID[ $i ],
				'fullName'      => $faker->firstName.' '.$faker->lastName,
				'email'         => $faker->email,
				'password'      => Hash::make('123456'),
				'gender'        => 'male',
				'fatherName'    => $faker->name,
				'mobileNumber'  => $faker->phoneNumber,
				'designation'   => rand(1, 4),
				'joiningDate'   => $faker->dateTimeBetween('-2 years'),
				'localAddress'  => $faker->address, 'permanentAddress' => $faker->address,
				'status'        => 'active', 'last_login' => $faker->dateTime,


			]);
		}
			for ($i=0; $i < 10; $i++) {
				Award::create([

					'employeeID' => $employeeID[rand(0,19)],
					'awardName'  => 'Employee of the Month',
					'gift'       => 'pen',
					'cashPrice'  => rand(100,4000),
					'forMonth'   => strtolower($faker->monthName),
					'foryear'    => '2014'

				]);
			}



	}

}



class LeaveTypeTableSeeder extends Seeder {

    public function run()
    {
        DB::table('leavetypes')->truncate(); // deleting old records.
        $faker = Faker::create();


        Leavetype::create([

            'leaveType'    =>  'sick',
            'num_of_leave'    =>  5
        ]);

        Leavetype::create([
            'leaveType'    =>  'casual',
            'num_of_leave'    =>  5
        ]);

        Leavetype::create([
            'leaveType'    =>  'half day',
            'num_of_leave'    =>  5
        ]);

        Leavetype::create([

            'leaveType'    =>  'maternity',
            'num_of_leave'    =>  0
        ]);
	    Leavetype::create([

		    'leaveType'    =>  'annual',
		    'num_of_leave'    =>  0
	    ]);
	    Leavetype::create([
		    'leaveType'    =>  'unpaid',
		    'num_of_leave'    =>  0
	    ]);
        Leavetype::create([
            'leaveType'    =>  'others',
            'num_of_leave'    =>  0
        ]);
    }

}

//Setting Seeds
class SettingTableSeeder extends Seeder {

    public function run()
    {
        DB::table('settings')->delete(); // deleting old records.
        DB::table('settings')->truncate(); // Truncating old records.
        $faker = Faker::create();


        Setting::create([

            'website'    =>  'HRM',
            'email'      =>  'ajay@froiden.com',
            'Name'       =>  'Administrator',
            'logo'       =>  'logo.png',
            'currency'   =>  'INR',
            'contact'   =>  '1234567891',
            'address'   =>  'SNAP HRM ,Jaipur INDIA,302017',
            'currency_symbol' =>  '₹',
            'award_notification'    =>  1,
            'leave_notification'    =>  1,
            'notice_notification'    => 1,
            'attendance_notification'    => 0,
            'payroll_notification'    =>    0,
            'expense_notification'    =>    0,
            'employee_add'    =>    0,
            'job_notification'    =>    0,
            'admin_add'    =>    0,
	        'admin_theme'         =>'darkblue',
	        'front_theme'         =>'dark-blue',


        ]);


    }

}


//Notice Board Seeds
class NoticeBoardTableSeeder extends Seeder {

    public function run()
    {

        DB::table('noticeboards')->truncate(); // deleting old records.
        $faker = Faker::create();

        for ($i=0; $i < 10; $i++) {
            Noticeboard::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'status' => 'active'

            ]);
        }


    }

}

