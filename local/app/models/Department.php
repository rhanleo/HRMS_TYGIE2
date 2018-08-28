<?php

class Department extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'deptName' => 'required|unique:department,deptName,:id',
		 "designation.0"=>'required',
	];



    protected $table="department";

	// Don't forget to fill this array
	protected $fillable = [];

    protected $guarded  =   ['id'];

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


    protected  function Designations(){
        return $this->hasMany('Designation','deptID','id');
    }


}