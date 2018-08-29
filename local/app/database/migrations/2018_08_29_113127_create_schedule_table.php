<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schedule', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('employeeID',20);
            $table->index('employeeID');
            $table->foreign('employeeID')
                ->references('employeeID')->on('employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');
			$table->date('dateFrom');
			$table->date('dateTo');
			$table->string('timeFrom');
			$table->string('timeTo');
			$table->string('shift');
            $table->string('remarks')->nullable();
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
		Schema::drop('schedule');
	}

}
