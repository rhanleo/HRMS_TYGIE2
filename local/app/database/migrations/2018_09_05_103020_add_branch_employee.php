<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBranchEmployee extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employees', function(Blueprint $table)
		{
			
			$table->integer('branch')->unsigned()->nullable();
			$table->foreign('branch')
			      ->references('id')->on('branch')
			      ->onUpdate('cascade')
				  ->onDelete('cascade');
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
			$table->dropColumn('branch');
		});
	}

}
