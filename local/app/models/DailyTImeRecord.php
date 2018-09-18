<?php

class DailyTImeRecord extends \Eloquent {

	protected $fillable = [];
    protected $table    =   'daily_time_records';
    protected $guarded  = ['id'];
    public $timestamps = false;
    public static $rules = [
		'employeeID'    =>  'required',
        'timeIn'        =>  'required',
        'timeOut'       =>   'required'

    ];
    
    protected function getEmployeeDetails()
    {
        return $this->belongsTo('Employee','employeeID','employeeID');
    }

    function totalHours($start, $end){
        
        $startDate = new DateTime($start);
        $endDate = new DateTime($end);
        
        $periodInterval = new DateInterval( "PT1H" );
        
        $period = new DatePeriod( $startDate, $periodInterval, $endDate );
        $count = 0;
   
        foreach($period as $date){
   
        $startofday = clone $date;
        $startofday->setTime(9,30);
              
        $endofday = clone $date;
        $endofday->setTime(18,30);
   
            if($date > $startofday && $date <= $endofday && !in_array($date->format('l'), array('Sunday','Saturday'))){
    
                $count++;
            }

        }
       return $count;
    }
   

}