<?php

class Designation extends \Eloquent {

	protected $fillable = [];
    protected $table    =   'designation';
    protected $guarded  = ['id'];

    protected function department()
    {
        return $this->belongsTo('Department','deptID','id');
    }

    protected function branch()
    {
        return $this->hasmany('Branch','designationID','id');
    }

}