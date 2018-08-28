<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExpenseToPayrolls extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('payrolls', function(Blueprint $table)
		{
			$table->float('expense');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('payrolls', function(Blueprint $table)
		{
			$table->dropColumn('expense');
		});
	}

}
