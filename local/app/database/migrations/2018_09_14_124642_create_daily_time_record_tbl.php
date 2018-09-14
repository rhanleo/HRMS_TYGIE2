<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyTimeRecordTbl extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('daily_time_records', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('employeeID',20);
			$table->index('employeeID');
			$table->foreign('employeeID')
      			  ->references('employeeID')->on('employees')
      			  ->onUpdate('cascade')
				  ->onDelete('cascade');
			$table->dateTime('timeIn');
			$table->dateTime('timeOut');
			$table->dateTime('breakIn');
			$table->dateTime('breakOut');
			$table->integer('status');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('daily_time_records');
	}

}
