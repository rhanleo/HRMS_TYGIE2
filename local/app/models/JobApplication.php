<?php

class JobApplication extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'resume' => 'required|mimes:pdf,doc,docx|max:4000',
		 'name'   => 'required',
		 'email'  => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['jobID','name','phone','email','resume','cover_letter','submitted_by'];

	protected function job()
	{
		return $this->belongsTo('Job','jobID','id');
	}

	public function employeeDetails(){

		return $this->belongsTo('Employee','submitted_by','employeeID');
	}
}