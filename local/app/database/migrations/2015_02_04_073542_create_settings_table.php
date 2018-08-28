<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('website',100);
			$table->string('email',100);
			$table->string('name',100);
			$table->string('logo',100);
			$table->string('address');
			$table->string('contact',20);
			$table->string('currency',20);
			$table->string('currency_symbol',10);
            $table->enum('award_notification', ['1', '0']);
            $table->enum('attendance_notification', ['1', '0']);
            $table->enum('leave_notification', ['1', '0']);
            $table->enum('notice_notification', ['1', '0']);
            $table->enum('payroll_notification', ['1', '0']);
            $table->enum('expense_notification', ['1', '0']);
            $table->enum('employee_add', ['1', '0']);
            $table->enum('job_notification', ['1', '0']);
            $table->enum('admin_add', ['1', '0']);
			$table->string('admin_theme');
			$table->string('front_theme');
			$table->string('locale',10)->default('en');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('settings');
	}

}
