<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMycalendar extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mycalendar', function(Blueprint $table)
		{
			$table->increments('id');  
			$table->string('title');  
			$table->date('start_date');  
			$table->date('end_date');
			$table->enum('status', ['done', 'ongoing']);
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
		Schema::drop('mycalendar');
	}

}
