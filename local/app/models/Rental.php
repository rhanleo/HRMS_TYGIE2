<?php

class Rental extends \Eloquent {
    // Don't forget to fill this array
    protected $fillable = [];
    protected $table    =   'rentals';
    protected $guarded  = ['id'];

    public static $rules = [
        'amount'        =>  'required',
        'date_covered'  => 'required',
        'status'        => 'required'

    ];
    public function getEmployeeDetails(){

        return $this->belongsTo('Employee','employeeID','employeeID');
    }

}