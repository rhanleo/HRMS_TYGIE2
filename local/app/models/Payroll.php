<?php

class Payroll extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 //'allowanceTitle.0' => 'required',
		 //'allowance.0'      => 'required',
	];

	// Don't forget to fill this array
	protected $fillable = [];
	protected $guarded=['id'];

	public function employeeDetails(){

		return $this->belongsTo('Employee','employeeID','employeeID');
	}

}