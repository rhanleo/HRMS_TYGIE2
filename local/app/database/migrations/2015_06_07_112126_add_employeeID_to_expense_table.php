<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmployeeIDToExpenseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('expenses', function(Blueprint $table)
		{
			$table->string('employeeID',20)->nullable();;
			$table->index('employeeID');
			$table->foreign('employeeID')
			      ->references('employeeID')->on('employees')
			      ->onUpdate('cascade')
			      ->onDelete('cascade');
			$table->enum('status',['pending','approved','rejected']);
			//
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('expenses', function(Blueprint $table)
		{
			$table->dropForeign('expenses_employeeid_foreign');
			$table->dropColumn('employeeID');
			$table->dropColumn('status');
		});
	}

}
