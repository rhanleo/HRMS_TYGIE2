<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranch extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('branch', function(Blueprint $table)
		{
			$table->increments('id');			
			$table->unsignedInteger('designationID');
			
			$table->foreign('designationID')
      			  ->references('id')->on('designation')
      			  ->onUpdate('cascade')
      			  ->onDelete('cascade');

      		$table->string('branch',100);
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
		Schema::drop('branch');
	}

}
