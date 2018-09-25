<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPurposeCashAdvance extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cash_advance', function(Blueprint $table)
		{
			$table->string('purpose')->nullable()->after('remarks');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cash_advance', function(Blueprint $table)
		{
			$table->dropColumn('purpose');
		});
	}

}
