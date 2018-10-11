<?php

class MyCalendar extends \Eloquent {
	// Add your validation rules here
	public static $rules = [
		 'start_date'           => 'required',
		 'end_date'             => 'required',
		 'title'               => 'required'
	];

	protected $table = 'mycalendar';
	protected $fillable = [];
	protected $guarded  =   ['id'];

	

}