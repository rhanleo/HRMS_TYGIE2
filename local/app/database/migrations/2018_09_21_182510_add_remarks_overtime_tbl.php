<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemarksOvertimeTbl extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('overtime_applications', function(Blueprint $table)
		{
			$table->string('remarks')->nullable()->after('reason');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('overtime_applications', function(Blueprint $table)
		{
			$table->dropColumn('remarks');
		});
	}

}
