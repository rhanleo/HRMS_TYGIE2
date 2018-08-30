<?php

class Schedule extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];


	// Don't forget to fill this array
	protected $fillable =   [];

    protected $table    =   'schedule';
    protected $guarded  =   ['id'];

//    Get employee Details
    public function getEmployee(){

        return $this->belongsTo('Employee','employeeID','employeeID');
    }


}