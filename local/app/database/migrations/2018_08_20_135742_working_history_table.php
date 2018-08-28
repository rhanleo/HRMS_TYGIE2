<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WorkingHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('working_history', function(Blueprint $table)
		{
            $table->increments('id');

            $table->string('employeeID',20);
            $table->index('employeeID');
            $table->foreign('employeeID')
                ->references('employeeID')->on('employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');
			$table->string('companyName',100);
			$table->string('role',100);
			$table->date('startDate')->nullable();
			$table->date('endDate')->nullable();
            $table->string('reasonToLeave');
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
		Schema::drop('working_history');
	}

}
