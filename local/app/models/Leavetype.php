<?php

class Leavetype extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'leaveType' => 'required|unique:leavetypes,leaveType,:id'
	];


	// Don't forget to fill this array
	protected $fillable = ['leaveType','num_of_leave'];

	public static function rules($id=false,$merge=[])
	{
		$rules = self::$rules;
		if ($id) {
			foreach ($rules as &$rule) {
				$rule = str_replace(':id', $id, $rule);
			}
		}
		return array_merge( $rules, $merge );
	}

}