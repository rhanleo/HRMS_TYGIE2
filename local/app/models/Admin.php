<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Admin extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	public  static $rules_add=[
		'name'                  =>  'required',
		'email'                 =>  'required|email|unique:admins',
		'password'              =>  'required|confirmed',
		'password_confirmation' =>  'required|min:5',
		'level' 				=>  'required'

	];

	public  static $rules_edit=[
		'name'                  =>  'required',
		'email'                 =>  'required|email|unique:admins,email,:id',
		'password'              =>  'confirmed',
		'password_confirmation' =>  'min:5'

	];

    public  static $rules=[
        'name'  =>  'required',
        'email' =>  'required|email',
		'level' =>  'required'
    ];

    public  static $rules_password=[
        'password'              =>  'required|confirmed',
        'password_confirmation' =>  'required|min:5'
    ];

	public static function rules($id=false,$merge=[])
	{
		$rules = self::$rules_edit;
		if ($id) {
			foreach ($rules as &$rule) {
				$rule = str_replace(':id', $id, $rule);
			}
		}
		return array_merge( $rules, $merge );
	}
	protected $hidden = array('password', 'remember_token');
    protected $fillable = ['name' ,'email', 'password', 'level'];

}
