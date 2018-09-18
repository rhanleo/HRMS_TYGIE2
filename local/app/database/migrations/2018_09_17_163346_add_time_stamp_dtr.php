<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeStampDtr extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('daily_time_record', function(Blueprint $table)
		{
			$table->timestamps()->after('status');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('daily_time_record', function(Blueprint $table)
		{
			$table->dropColumn('status');
		});
	}

}
