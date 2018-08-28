<?php

class LeaveApplication extends \Eloquent {
	// Add your validation rules here
	public static $rules = [
		 'start_date'           => 'required',
		 'end_date'             => 'required',
		 'reason'               => 'required',
		 'leaveType'            => 'required'
	];

	protected $table = 'leave_applications';
	protected $fillable = [];
	protected $guarded  =   ['id'];

	public static function rules_single_leaves($input)
	{


		foreach($input as $key => $val)
		{
			$rules_single_leaves['date.'.$key] = 'unique:leave_applications,start_date,NULL,id,employeeID,'.Auth::employees()->get()->employeeID;
		}
		$rules_single_leaves['date.0'] = 'required|date|unique:leave_applications,start_date,NULL,id,employeeID,'.Auth::employees()->get()->employeeID;
		return $rules_single_leaves;
	}

	public static function messages_single_leaves($input)
	{
		$messages = [];
		foreach($input as $key => $val)
		{
			$messages['date.'.$key.'.unique'] = "You have already applied for <b>$val</b> date.So change this date";
		}
		$messages['date.0.unique']   = "You have already applied for <b>$input[0]</b> date.So change this date";
		$messages['date.0.required'] = "Date 0 field is required";
		return $messages;
	}





	public function setStartDateAttribute($value)
	{
		$date = date('Y-m-d', strtotime(str_replace('/', '-', $value)));

		$this->attributes['start_date'] = $date;
	}

	public function setEndDateAttribute($value)
	{
		if($value==NULL){
			$this->attributes['end_date'] = NULL;
		}else{
			$date = date('Y-m-d', strtotime(str_replace('/', '-', $value)));
			$this->attributes['end_date'] = $date;
		}

	}

	//    Get employee Details
	public function employeeDetails(){

		return $this->belongsTo('Employee','employeeID','employeeID');
	}

}