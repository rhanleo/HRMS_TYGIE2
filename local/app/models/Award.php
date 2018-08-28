<?php

class Award extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'awardName'     =>  'required',
        'employeeID'     =>  'required',
        'gift'           =>   'required'

	];

	// Don't forget to fill this array
    protected $guarded = ['id'];
//    protected $fillable = ['username', 'email', 'password'];

    public function employeeDetails(){

        return $this->belongsTo('Employee','employeeID','employeeID');
    }

}