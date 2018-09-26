<?php

class ScheduleFrontController extends \FrontBaseController {

	public function __construct()
    {

        parent::__construct();
        $this->data['pageTitle']   =   'Schedule';
		$this->data['scheduleActive']   =   'active';
    }



	public function index($id)
	{
		$this->data['schedule']      =      Schedule::where('employeeID','=',$id)->get();
		return View::make('front.schedule.index',$this->data);
	}


}