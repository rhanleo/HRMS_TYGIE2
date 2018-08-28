<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePayrollsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payrolls', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('employeeID',20);
			$table->index('employeeID');
			$table->foreign('employeeID')
			      ->references('employeeID')->on('employees')
			      ->onUpdate('cascade')
			      ->onDelete('cascade');
			$table->string('month');
			$table->string('year');
			$table->enum('payment_mode',['cash','paypal','bank_transfer','cheque']);
			$table->float('basic');
			$table->float('overtime_hours');
			$table->float('overtime_pay');

			$table->string('allowances');
			$table->float('total_allowance');

			$table->string('deductions');
			$table->float('total_deduction');

			$table->string('additionals');
			$table->float('total_additional');
			$table->float('net_salary');
			$table->date('pay_date');
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
		Schema::drop('payrolls');
	}

}
