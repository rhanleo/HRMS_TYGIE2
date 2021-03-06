<?php

class CashAdvance extends \Eloquent {
    // Don't forget to fill this array
    protected $fillable = [];
    protected $table    =   'cash_advance';
    protected $guarded  = ['id'];

    public static $rules = [
		'amount'    =>  'required'

    ];
    public function getEmployeeDetails(){

        return $this->belongsTo('Employee','employeeID','employeeID');
    }

}