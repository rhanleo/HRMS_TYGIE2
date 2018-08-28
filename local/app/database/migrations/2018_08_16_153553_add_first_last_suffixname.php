<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFirstLastSuffixname extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employees', function(Blueprint $table)
		{
			$table->string('firstName', 100)->after('fullName');
			$table->string('lastName', 100)->after('firstName');
			$table->string('middleName', 100)->nullable()->after('lastName');
			$table->string('suffix', 10)->nullable()->after('middleName');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('employees', function(Blueprint $table)
		{
			$table->dropColumn('firstName');
			$table->dropColumn('lastName');
			$table->dropColumn('middleName');
			$table->dropColumn('suffix');
		});
	}

}
