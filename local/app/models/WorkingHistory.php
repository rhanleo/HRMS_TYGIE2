<?php

class WorkingHistory extends \Eloquent {
	protected $fillable = [];
	protected $guarded  =['id'];
	protected $table = 'working_history';


	public function getDetails(){

		return $this->belongsTo('Employee','employeeID','employeeID');
	}
}