<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestOtherTbl extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('request_others', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('employeeID',20);
			$table->index('employeeID');
			$table->foreign('employeeID')
      			  ->references('employeeID')->on('employees')
      			  ->onUpdate('cascade')
				  ->onDelete('cascade');
			$table->string('description', 150);
			$table->integer('quantity');
			$table->string('approved_by');
			$table->string('remarks');
			$table->enum('status', ['approved', 'rejected','pending']);
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
		Schema::drop('request_others');
	}

}
