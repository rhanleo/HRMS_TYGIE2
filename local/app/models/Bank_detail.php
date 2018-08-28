<?php

class Bank_detail extends \Eloquent {
	protected $fillable = [];
    protected $guarded=[''];

	public function employeeDetails(){

		return $this->belongsTo('Employee','employeeID','employeeID');
	}
}