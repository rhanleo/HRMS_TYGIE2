<?php

class Employee_document extends \Eloquent {
	protected $fillable = [];
    protected $guarded  =['id'];


	public function employeeDetails(){

		return $this->belongsTo('Employee','employeeID','employeeID');
	}
}