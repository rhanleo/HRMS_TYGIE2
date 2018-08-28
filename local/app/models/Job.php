<?php

class Job extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'position'     => 'required',
		 'description'  => 'required|min:10'
	];

	// Don't forget to fill this array
	protected $fillable = ['position','description','posted_date','last_date','close_date','status'];

	public function setPostedDateAttribute($value)
	{
		$this->attributes['posted_date'] = date('Y-m-d',strtotime($value));
	}

	public function setLastDateAttribute($value)
	{
		$this->attributes['last_date'] = date('Y-m-d',strtotime($value));
	}

	public function setCloseDateAttribute($value)
	{
		$this->attributes['close_date'] = date('Y-m-d',strtotime($value));
	}

}