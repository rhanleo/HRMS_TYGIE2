<?php

class Branch extends \Eloquent {

	protected $fillable = [];
    protected $table    =   'branch';
    protected $guarded  = ['id'];

    protected function designation()
    {
        return $this->belongsTo('Designation','designationID','id');
    }
}